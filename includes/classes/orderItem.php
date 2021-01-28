<?php
  declare(strict_types=1);

    /**
   * Class for holding items that where in a particular order.
   *
   * @author  Derek Bringewatt
   * @license MIT
   */
  class OrderItemV1
  {
    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;


    /**
     * Constructor
     *
     * 
     * 
     * @param  string $name The order items name
     * @param  float $price The order items price
     */
    public function __construct(string $name, float $price) {
        $this->name = $name;
        $this->price = $price;
    }


    /**
     * Getter for name.
     *
     * 
     * 
     * 
     * @return string
     */
    public function getName(): string {
      return $this->name;
    }


    /**
     *  Setter for name.
     *
     * 
     * 
     * @param  string $newName The new name value
     * @return void
     */
    public function setName(string $newName): void {
      $this->name = $newName;
    }


    /**
     * Getter for price.
     *
     * Method longer description and help
     * 
     *
     * @return float
     */
    public function getPrice(): float {
      return $this->price;
    }

    
    /**
     * Setter for price.
     *
     *
     * 
     * @param  float $newPrice The new price value
     * @return void
     */
    public function setPrice(float $newPrice): void {
      $this->price = $newPrice;
    }
  }
?>