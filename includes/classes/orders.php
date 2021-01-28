<?php
  declare(strict_types=1);
  require_once('includes/interfaces/iOrder.php');
  require_once('includes/classes/orderItem.php');

  class OrderV1 implements iOrder
  {
    private $id;
    private $customer_id;
    private $created_date;
    private $fulfilled_date;
    private $items;
    private $total_price;

    public function __construct() {
        $this->customer_id = '';
        $this->created_date = new DateTime();
        $this->fulfilled_date = new DateTime();
        $this->items = [];
        $this->total_price = 0.00;
    }


    public function getId(): String {
      return $this->id;
    }


    public function setId(String $newId): void {
      $this->id = $newId;
    }


    public function getCustomerId(): String {
      return $this->customer_id;
    }


    public function setCustomerId(String $newCustomerId): void {
      $this->customer_id = $newCustomerId;
    }
    

    public function getCreatedDate(): DateTime {
      return $this->created_date;
    }


    public function getFulfilledDate(): DateTime {
      return $this->fulfilled_date;
    }


    public function getItems(): array {
      return $this->items;
    }


    public function getTotalPrice(): float {
      return $this->total_price;
    }


    public function loadFromJson(array $jsonObject): bool {
      // Must have a valid json response to make valid Order object
      try {
        $this->id = $jsonObject['id'];
        $this->customer_id = $jsonObject['customer_id'];
        $this->created_date = $this->created_date->createFromFormat('Y-m-d', $jsonObject['created_date']);
        $this->fulfilled_date = $this->fulfilled_date->createFromFormat('Y-m-d', $jsonObject['fulfilled_date']);
        $this->total_price = (float) $jsonObject['total_price'];

        foreach ($jsonObject['items'] as $itemResponse) {
          $item = new OrderItemV1($itemResponse['name'], (float) $itemResponse['price']);

          array_push($this->items, $item);
        }

        // Other validation logic 
        return TRUE;
      } catch (Exception $ex) {
        return FALSE;
      }
    }
  }
?>
