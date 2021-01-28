<?php
  declare(strict_types=1);
  require_once('includes/interfaces/iOrder.php');


  /**
   * Method for getting yearly totals
   *
   * 
   * @param  DateTime $year A date time value indicating which year
   * @param  iOrder ...$orders A array of IOrder items
   * @return float
   */
  function GetTotalOrdersFromYear(DateTime $year, iOrder ...$orders): float
  {
    usort($orders, "DateCompare");
    $total = 0.00;

    foreach ($orders as $order) {
      $sameYear = strcmp($order->getCreatedDate()->format('Y'), $year->format('Y'));

      if ($sameYear === 0) {
       $total += $order->getTotalPrice();
      }
    }
    return $total;
  }


  // ================ Sorting functions =============================


  /**
   * Give to usort for custom comparsion of created dates
   *
   *
   * @param  iResponseBase $baseItem1 First elememnt to compare
   * @param  iResponseBase $baseItem2 Second element to compare
   * @return int
   */
  function DateCompare(iResponseBase $baseItem1, iResponseBase $baseItem2): int {
    
    if ($baseItem1->getCreatedDate() < $baseItem2->getCreatedDate()) 
        return 1; 
    else if ($baseItem1->getCreatedDate() > $baseItem2->getCreatedDate())  
        return -1; 
    else
        return 0; 
  }


  /**
   * Give to usort for custom comparsion of order total prices
   *
   *
   * @param  iOrder $order1 First elememnt to compare
   * @param  iOrder $order2 Second element to compare
   * @return int
   */
  function TotalPriceCompare(iOrder $order1, iOrder $order2): int {
    if ($order1->getTotalPrice() < $order2->getTotalPrice()) 
        return 1; 
    else if ($order1->getTotalPrice() > $order2->getTotalPrice())  
        return -1; 
    else
        return 0; 
  }
?>