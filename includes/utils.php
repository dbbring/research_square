<?php
  declare(strict_types=1);
  require_once('includes/interfaces/iOrder.php');


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


  function DateCompare(iResponseBase $baseItem1, iResponseBase $baseItem2): int {
    
    if ($baseItem1->getCreatedDate() < $baseItem2->getCreatedDate()) 
        return 1; 
    else if ($baseItem1->getCreatedDate() > $baseItem2->getCreatedDate())  
        return -1; 
    else
        return 0; 
  }

  function TotalPriceCompare(iOrder $order1, iOrder $order2): int {
    if ($order1->getTotalPrice() < $order2->getTotalPrice()) 
        return 1; 
    else if ($order1->getTotalPrice() > $order2->getTotalPrice())  
        return -1; 
    else
        return 0; 
  }
?>