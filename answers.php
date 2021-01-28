<?php
  require_once("includes/config.php");
  require_once("includes/utils.php");
  require_once("includes/classes/customer.php");
  require_once("includes/classes/orders.php");

  echo(" 
  _____                           _        _____                            
 |  __ \                         | |      / ____|                           
 | |__) |___  ___  ___  __ _  ___| |__   | (___   __ _ _   _  __ _ _ __ ___ 
 |  _  // _ \/ __|/ _ \/ _` |/ __| '_ \   \___ \ / _` | | | |/ _` | '__/ _ \
 | | \ \  __/\__ \  __/ (_| | (__| | | |  ____) | (_| | |_| | (_| | | |  __/
 |_|  \_\___||___/\___|\__,_|\___|_| |_| |_____/ \__, |\__,_|\__,_|_|  \___|
                                                    | |                     
                                                    |_|                    \r\n\r\n");

  echo("Config.php is located in ./includes. Defaults are Set.\r\n\r\n");                                              

  $config = Config::getInstance();
  $customers = [];
  $orders = [];
  $response = json_decode(file_get_contents($config->getResourceUrl()), true);

  foreach($response['customers'] as $customerResponse) {
    $customer = new CustomerV1();
    try {
      if ($customer->loadFromJson($customerResponse)) {
        array_push($customers, $customer);
      }
    } catch (Exception $ex) {
      echo(' ----- Error adding a customer to array.');
    }
  }

  foreach($response['orders'] as $orderResponse) {
    $order = new OrderV1;
    try {
      if ($order->loadFromJson($orderResponse)) {
        array_push($orders, $order);
      }
    } catch (Exception $ex) {
      echo(' ----- Error adding a order to array.');
    }
  }

  // Validate data before trying to use it later
  if (empty($orders)) {
    echo(' ------ No orders are available.');
    return;
  }

  if (empty($customers)) {
    echo(' ------ No customers are available.');
    return;
  }



  ///////////////////////////////////////////////////////////////////////////////
  //
  // TASK #1
  //
  // Summary:
  //
  //   The data file below contains a list of customers and their orders. Use
  //   these data to find and print the price of the most expensive order.
  //
  //   Hint: Open the data file and look at its contents. The `total_price` field
  //   holds the price of an order.
  //
  // Expected output:
  //
  //   Most expensive order = 500.00
  //
  ///////////////////////////////////////////////////////////////////////////////

  usort($orders, "TotalPriceCompare");
  $highestOrder =  number_format($orders[0]->getTotalPrice(), 2, '.', ',');
  echo(" - Most expensive order = \${$highestOrder} \r\n");


  ///////////////////////////////////////////////////////////////////////////////
  //
  // TASK #2
  //
  // Summary:
  //
  //   Using this same data file, calculate and print the sum of prices for all
  //   orders created in the previous three years, grouped by year.
  //
  // Expected output:
  //
  //   Total price of orders in 2018 = 275.00
  //   Total price of orders in 2019 = 860.00
  //   Total price of orders in 2020 =  20.00
  //
  ///////////////////////////////////////////////////////////////////////////////

  $currentYear = new DateTime();

  // Move back to 2020. See example and test origination date.
  $currentYear->sub(new \DateInterval('P1Y'));

  for($i=0; $i < $config->getYearsToGoBack(); $i++) {
    try {
      $strCurrYr = $currentYear->format('Y');
      $totalYrOrders = GetTotalOrdersFromYear($currentYear, ...$orders);
      $totalYrOrders = number_format($totalYrOrders, 2, '.', ',');
      echo(" - Total price of orders in {$strCurrYr} = \${$totalYrOrders} \r\n");
    } catch (Exception $ex) {
      echo("Error calculating total orders for {$strCurrYr}");
    }

    $currentYear->sub(new \DateInterval('P1Y'));
  }


  ///////////////////////////////////////////////////////////////////////////////
  //
  // TASK #3
  //
  // Summary:
  //
  //   Using the same data file, find and print the ID and name of the customer
  //   with the most orders.
  //
  // Expected output:
  //
  //   Customer with the most orders = [CUST-0001] Yoda
  //
  ///////////////////////////////////////////////////////////////////////////////

  $totalOrderAmt = 0.00;
  $topCustomer = null;

  foreach ($customers as $customer) {
    try {
      $totalCustOrderAmt = $customer->getTotalPurchasesAmount(...$orders);
      if ($totalOrderAmt < $totalCustOrderAmt) {
        $totalOrderAmt = $totalCustOrderAmt;
        $topCustomer = $customer;
      }
    } catch (Exception $ex) {
      echo("Error checking total purchases for {$customer->getName()}");
    }

  }

  $msg = $topCustomer ? " - Customer with the most orders = [{$topCustomer->getId()}] {$topCustomer->getName()}" : 'Error.';

  echo($msg);

?>