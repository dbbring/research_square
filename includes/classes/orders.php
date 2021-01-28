<?php
  declare(strict_types=1);
  require_once('includes/interfaces/iOrder.php');
  require_once('includes/classes/orderItem.php');
  require_once('includes/utils.php');


  /**
     * Version 1
     *  Order
     *
     * @author  Derek Bringewatt
     * @license MIT
     */
  class OrderV1 implements iOrder
  {
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $customer_id;

    /**
     * @var DateTime
     */
    private $created_date;

    /**
     * @var DateTime
     */
    private $fulfilled_date;

    /**
     * @var array
     */
    private $items;

    /**
     * @var float
     */
    private $total_price;


    /**
     * Constructor
     *
     * Initialize with some default values
     * 
     *
     *
     */
    public function __construct() {
        $this->customer_id = '';
        $this->created_date = new DateTime();
        $this->fulfilled_date = new DateTime();
        $this->items = [];
        $this->total_price = 0.00;
    }


    /**
     * Getter for ID
     *
     *
     * @return string
     */
    public function getId(): string {
      return $this->id;
    }


    /**
     * Setter for ID
     *
     *
     * @param  string $newId The new ID 
     * @return void
     */
    public function setId(string $newId): void {
      $this->id = $newId;
    }


    /**
     * Getter for customer ID
     *
     *
     * @return string
     */
    public function getCustomerId(): string {
      return $this->customer_id;
    }


    /**
     * Setter for customer ID
     *
     *
     * @param  string $newId The new  customer ID 
     * @return void
     */
    public function setCustomerId(string $newCustomerId): void {
      $this->customer_id = $newCustomerId;
    }
    

    /**
     * Getter for created date
     *
     *
     * @return DateTime
     */
    public function getCreatedDate(): DateTime {
      return $this->created_date;
    }


    /**
     * Getter for fulfilled date
     *
     *
     * @return DateTime
     */
    public function getFulfilledDate(): DateTime {
      return $this->fulfilled_date;
    }


    /**
     * Getter for Items of the order
     *
     *
     * @return array
     */
    public function getItems(): array {
      return $this->items;
    }


    /**
     * Getter for total price of order
     * 
     *
     * @return string
     */
    public function getTotalPrice(): float {
      return $this->total_price;
    }


    /**
     * Populate a order item with the response from a API.
     *
     * Only returns true if its a complelety valid object. Bad data in =
     *  bad data out. Using a 1 : 1 ratio incase we encounter additional 
     *  fields, we dont want to carry them forward and pollute things.
     * 
     * @param  array $jsonObject A array instead of a object from a API response. Set true in   the file get contents args. 
     * @return bool
     */
    public function loadFromJson(array $jsonObject): bool {
      try {
        $this->id = SanitizeStr($jsonObject['id']);
        $this->customer_id = SanitizeStr($jsonObject['customer_id']);
        $this->created_date = $this->created_date->createFromFormat('Y-m-d', $jsonObject['created_date']);
        $this->fulfilled_date = $this->fulfilled_date->createFromFormat('Y-m-d', $jsonObject['fulfilled_date']);
        $this->total_price = (float) $jsonObject['total_price'];

        foreach ($jsonObject['items'] as $itemResponse) {
          $item = new OrderItemV1(
                    SanitizeStr($itemResponse['name']),
                    (float) $itemResponse['price']
                  );

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
