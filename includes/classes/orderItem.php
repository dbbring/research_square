<?php
  declare(strict_types=1);

  class OrderItemV1
  {
    private $name;
    private $price;

    public function __construct(String $name, float $price) {
        $this->name = $name;
        $this->price = $price;
    }


    public function getName(): String {
      return $this->name;
    }


    public function setName(String $newName): void {
      $this->name = $newName;
    }


    public function getPrice(): float {
      return $this->price;
    }

    
    public function setPrice(float $newPrice): void {
      $this->price = $newPrice;
    }
  }
?>