<?php

  interface iResponseBase
  {
    public function loadFromJson(stdObj $jsonObject): boolean;
  }

?>