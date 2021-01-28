<?php
  declare(strict_types=1);
  require_once('includes/interfaces/iOrder.php');



  function GetTotalOrdersByYear(Date $year, iOrder ...$orders): array
  {

  }

  function DateCompare(iResponseBase $baseItem1, iResponseBase $baseItem2): int {
    if (strtotime($baseItem1->getCreatedDate()) < strtotime($baseItem2->getCreatedDate())) 
        return 1; 
    else if (strtotime($baseItem1->getCreatedDate()) > strtotime($baseItem2->getCreatedDate()))  
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