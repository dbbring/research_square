<?php

  interface iResponseBase
  {
    // private $id;
    // private $created_date;
    
    public function getId(): String;
    public function setId(String $newId): void;
    public function getCreatedDate(): DateTime;

    public function loadFromJson(array $jsonObject): bool;
  }

?>