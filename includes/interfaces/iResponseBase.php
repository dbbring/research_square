<?php

  interface iResponseBase
  {
    // private $id;
    
    public function getId(): String;
    public function setId(String $newId): void;

    public function loadFromJson(array $jsonObject): bool;
  }

?>