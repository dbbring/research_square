<?php
  require_once("includes/config.php");
  require_once("includes/utils.php");
  require_once("includes/classes/customer.php");
  require_once("includes/classes/orders.php");

  $config = Config::getInstance();
  $customers = [];
  $orders = [];
  $response = json_decode(file_get_contents('response.json'), true);

  foreach($response['customers'] as $customerResponse) {
    $customer = new CustomerV1();
    if ($customer->loadFromJson($customerResponse)) {
      array_push($customers, $customer);
    }
  }

  foreach($response['orders'] as $orderResponse) {
    $order = new OrderV1;
    if ($order->loadFromJson($orderResponse)) {
      array_push($orders, $order);
    }
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

  // usort($orders, "TotalPriceCompare");
  // echo($orders[0]->getTotalPrice());


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

  // $currentYear = new DateTime();

  // // Move back to 2020. See example and test oringation date.
  // $currentYear->sub(new \DateInterval('P1Y'));

  // for($i=0; $i < $config->getYearsToGoBack(); $i++) {
  //   echo(GetTotalOrdersFromYear($currentYear, ...$orders) . "\r\n");
  //   $currentYear->sub(new \DateInterval('P1Y'));
  // }


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
    $totalCustOrderAmt = $customer->getTotalPurchasesAmount(...$orders);
    if ($totalOrderAmt < $totalCustOrderAmt) {
      $totalOrderAmt = $totalCustOrderAmt;
      $topCustomer = $customer;
    }
  }

  $msg = $topCustomer ? "Customer with the most orders = [{$topCustomer->getId()}] {$topCustomer->getName()}" : 'Error.';

  echo($msg);

?>