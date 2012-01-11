<?php

/**
 * Class for storing mail credentials (username / password). It extends the Credentials class.
 *
 * @author Martin Ricken <kreean@gmail.com>
 * @package Mailer
 */
class MailCredentials extends Credentials {
  
  /**
   * @var MailCredentials $_instance
   */
  private static $_instance = NULL;
  
  /**
   * @return MailCredentials
   */
  public static function getInstance($username = NULL, $password = NULL){
    if(is_null(self::$_instance)) {
      self::$_instance = new MailCredentials($username, $password);
    }
    return self::$_instance;
  }
  
}