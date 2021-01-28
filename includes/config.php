<?php
  declare(strict_types=1);

class Config {
  private static $instance = null;
  private static $resource_url = '';

  private function __construct()
  {
    self::$resource_url = 'https://rs-coding-exercise.s3.amazonaws.com/2020/orders-2020-02-10.json';
  }

  public static function getInstance()
  {
    if (self::$instance == null)
    {
    self::$instance = new Config();
    }

    return self::$instance;
  }

  public static function getResourceUrl()
  {
    return self::$resource_url;
  }
}
?>