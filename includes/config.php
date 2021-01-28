<?php
  declare(strict_types=1);

/**
 * Singleton class for holding global configuration options.
 *
 * @author  Derek Bringewatt
 * @license MIT
 */
class Config {
  /**
   * @var Config
   */
  private static $instance = null;

  /**
   * @var String
   */
  private static $resource_url;

  /**
   * @var Int
   */
  private static $yearsToGoBack;


  /**
   * Singleton constructor, privately held.
   *
   *
   * 
   */
  private function __construct()
  {
    self::$resource_url = 'https://rs-coding-exercise.s3.amazonaws.com/2020/orders-2020-02-10.json';
    self::$yearsToGoBack = 3;
  }


  /**
   * Create one and only one instance.
   *
   * Method for either creating the single instance or giving back
   * the current instance.
   * 
   * @return Config
   */
  public static function getInstance()
  {
    if (self::$instance == null)
    {
    self::$instance = new Config();
    }

    return self::$instance;
  }


  /**
   *  Getter for the resource URL.
   *
   * 
   * 
   * 
   * @return String
   */
  public static function getResourceUrl(): String
  {
    return self::$resource_url;
  }


  /**
   *  Getter for years to go back.
   *
   *  Years to go back is used to determine how many years
   *  to look back. Currently used in getting past yearly totals.
   * 
   * @return Int
   */
  public static function getYearsToGoBack(): Int {
    return self::$yearsToGoBack;
  }
}
?>