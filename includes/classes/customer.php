<?php
  declare(strict_types=1);
  require_once('includes/interfaces/iCustomer.php');

  class CustomerV1 implements iCustomer
  {
    private $id = String;
    private $created_date = DateTime;
    private $email = String;
    private $name = String;

    public function __construct() {
        $this->id = '';
        $this->created_date = new DateTime();
        $this->email = '';
        $this->name = '';
    }

    public function loadFromJson(stdObj $jsonObject): boolean {
      try {
        $this->id = $jsonObject['id'];
        $this->created_date = $this->created_date->createFromFormat('Y-m-d', $jsonObject['created_date']);
        $this->email = $jsonObject['email'];
        $this->name = $jsonObject['name'];
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