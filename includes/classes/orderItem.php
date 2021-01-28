<?php
  declare(strict_types=1);

  class OrderItemV1
  {
    private $name = String;
    private $price = float;

    public function __construct(String $name, float $price) {
        $this->name = $name;
        $this->price = $price;
    }
  }
?>