<?php
  declare(strict_types=1);
  require_once('includes/interfaces/iCustomer.php');

  class CustomerV1 implements iCustomer
  {
    private $id;
    private $created_date;
    private $email;
    private $name;


    public function __construct() {
        $this->id = '';
        $this->created_date = new DateTime();
        $this->email = '';
        $this->name = '';
    }


    public function getId(): String {
      return $this->id;
    }


    public function setId(String $newId): void {
      $this->id = $newId;
    }


    public function getCreatedDate(): DateTime {
      return $this->created_date;
    }


    public function getEmail(): String {
      return $this->email;
    }


    public function setEmail(String $newEmail): void {
      $this->email = $newEmail;
    }


    public function getName(): String {
      return $this->name;
    }


    public function setName(String $newName): void {
      $this->name = $newName;
    }


    public function loadFromJson(array $jsonObject): bool {
      // Must have a valid json response for a valid customer object
      try {
        $this->id = $jsonObject['id'];
        $this->created_date = $this->created_date->createFromFormat('Y-m-d', $jsonObject['created_date']);
        $this->email = $jsonObject['email'];
        $this->name = $jsonObject['name'];

        // Other validating logic here
        return TRUE;
      } catch (Exception $ex) {
        return FALSE;
      }
    }

    public function getCustomerOrders(iOrder ...$orders): array 
    {

    }
  }
?>