<?php
  declare(strict_types=1);
  require_once('includes/interfaces/iCustomer.php');
  require_once('includes/utils.php');


  /**
   *  Version 1 
   *  Customer
   *   
   *
   * @author  Derek Bringewatt
   * @license MIT 
   */
  class CustomerV1 implements iCustomer
  {
    /**
     * @var string
     */
    private $id;

    /**
     * @var DateTime
     */
    private $created_date;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $name;


    /**
     * Constructor
     *
     * Initiliaze with default values
     */
    public function __construct() {
        $this->id = '';
        $this->created_date = new DateTime();
        $this->email = '';
        $this->name = '';
    }


    /**
     * Getter for ID
     *
     *
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
     * 
     * @param  string $newId The new ID 
     * @return void
     */
    public function setId(string $newId): void {
      $this->id = $newId;
    }


    /**
     * Getter for ID
     *
     *
     * @return string
     */
    public function getCreatedDate(): DateTime {
      return $this->created_date;
    }


    /**
     * Getter for ID
     *
     * 
     * @return string
     */
    public function getEmail(): string {
      return $this->email;
    }


    /**
     * Setter for email
     *
     *
     * @param  string $newEmail The new email address
     * @return void
     */
    public function setEmail(string $newEmail): void {
      $this->email = $newEmail;
    }


    /**
     * Getter for ID
     *
     *
     * @return string
     */
    public function getName(): string {
      return $this->name;
    }


    /**
     * Setter for namme
     *
     *
     * @param  string $newName The new name value
     * @return void
     */
    public function setName(string $newName): void {
      $this->name = $newName;
    }


    /**
     * Populate a customer item with the response from a API.
     *
     * Only returns true if its a complelety valid object. Bad data in =
     *  bad data out. Using a 1 : 1 ratio incase we encounter additional 
     *  fields, we dont want to carry them forward and pollute things.
     * 
     * @param  array $jsonObject A array from a API response. Set true in   the file get contents args. 
     * @return bool
     */
    public function loadFromJson(array $jsonObject): bool {
      try {
        $this->id = SanitizeStr($jsonObject['id']);
        $this->created_date = $this->created_date->createFromFormat('Y-m-d', $jsonObject['created_date']);
        $this->email = SanitizeStr($jsonObject['email']);
        $this->name = SanitizeStr($jsonObject['name']);

        // Other validating logic here
        return TRUE;
      } catch (Exception $ex) {
        return FALSE;
      }
    }


    /**
     * Get the orders associated with this customer
     *
     *  Give the order array you would like use, whether it would be 
     *  all the orders or a array of filtered orders.
     * 
     * @param  iOrder $orders A array of IOrder items
     * @return array
     */
    public function getOrders(iOrder ...$orders): array 
    {
      $customerOrders = [];

      foreach($orders as $order) {
        $isCustomerOrder = strcmp($this->id, $order->getCustomerId());

        if ($isCustomerOrder === 0) {
          array_push($customerOrders, $order);
        }
      }

      return $customerOrders;
    }


    /**
     * Calculate the total amount of purchase associated with this customer.
     *
     *  Give the order array you would like use, whether it would be 
     *  all the orders or a array of filtered orders.
     * 
     * @param  iOrder $orders A Array of iOrder items
     * @return float
     */
    public function getTotalPurchasesAmount(iOrder ...$orders): float {
      $allOrders = $this->getOrders(...$orders);
      $total = 0.00;

      foreach($allOrders as $order) {
        $total += $order->getTotalPrice();
      }

      return $total;
    }
  }
?>