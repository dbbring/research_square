<?php
  declare(strict_types=1);
  require_once('includes/interfaces/iOrder.php');
  require_once('includes/classes/orderItem.php');

  class OrderV1 implements iOrder
  {
    private $id = String;
    private $customer_id = String;
    private $created_date = DateTime;
    private $fulfilled_date = DateTime;
    private $items = array();
    private $total_price = float;

    public function __construct() {
        $this->$customer_id = '';
        $this->$created_date = new DateTime();
        $this->$fulfilled_date = new DateTime();
        $this->$items = [];
        $this->$total_price = 0.00;
    }

    public function loadFromJson(stdObj $jsonObject): boolean {
      try {
        $this->id = $jsonObject['id'];
        $this->customer_id = $jsonObject['customer_id'];
        $this->created_date = $this->created_date->createFromFormat('Y-m-d', $jsonObject['created_date']);
        $this->fulfilled_date = $this->$fulfilled_date->createFromFormat('Y-m-d', $jsonObject['fulfilled_date']);
        $this->$total_price = (float) $jsonObject['total_price'];

        foreach ($orderItem as $item) {
          $this->items.append(
            new OrderItemV1($item['name'], (float) $item['price'])
          );
        }

        return TRUE;
      } catch (Exception $ex) {
        return FALSE;
      }
    }
  }
?>
