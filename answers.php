<?php
  require_once("includes/config.php");
  require_once("includes/utils.php");
  require_once("includes/classes/customer.php");
  require_once("includes/classes/orders.php");

  $config = Config::getInstance();

  $response = json_decode(file_get_contents('response.json'), true);

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


?>