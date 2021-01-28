<?php

  require_once('iResponseBase.php');

  interface iCustomer extends iResponseBase
  {
    // private $created_date;
    // private $email;
    // private $name;

    public function getCreatedDate(): DateTime;

    public function getEmail(): String;
    public function setEmail(String $newEmail): void;

    public function getName(): String;
    public function setName(String $newName): void;
  }

  ?>