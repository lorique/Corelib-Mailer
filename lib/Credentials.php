<?php
/**
 * Class for storing credentials (username / password) for any sort of access controlled environment
 *
 * @author Martin Ricken <kreean@gmail.com>
 * @package Mailer
 */
class Credentials implements Singleton {
  
  /**
   * @var string $password
   */
  private $password = NULL;
  
  /**
   * @var string $username
   */
  private $username = NULL;
  
  /**
   * @var Credentials $_instance
   */
  private static $_instance = NULL;
  
  /**
   * Constructor
   * @param string $password
   * @param string $username
   */
  public function __construct($username, $password) {
    if(!is_null($password)){
      $this->password = $password;
    }
    if(!is_null($username)){
      $this->username = $username;
    }
  }
  
  /**
   * Get an instance of the current class
   * @return Credentials
   */
  public static function getInstance($username = NULL, $password = NULL){
    if(is_null(self::$_instance)) {
      self::$_instance = new Credentials($username, $password);
    }
    return self::$_instance;
  }
  
  /**
   * Get the password
   * @return string $password
   */
  public function getPassword(){
    return $this->password;
  }
  
  /**
   * Get the username
   * @return string $username
   */
  public function getUsername(){
    return $this->username;
  }
  
  /**
   * Set the username
   */
  public function setUsername($username){
    $this->username = $username;
  }
  
  /**
   * Set the password
   */
  public function setPassword($password){
    $this->password = $password;
  }
}