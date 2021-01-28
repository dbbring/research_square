<?php
  require_once('iResponseBase.php');

  interface iOrder extends iResponseBase
  {
    //   private $customer_id;
    //   private $created_date;
    //   private $fulfilled_date;
    //   private $items;
    //   private $total_price;

    public function getCustomerId(): String;
    public function setCustomerId(String $newCustomerId): void;
    
    public function getCreatedDate(): DateTime;

    public function getFulfilledDate(): DateTime;

    public function getItems(): array;

    public function getTotalPrice(): float;
  }

?>