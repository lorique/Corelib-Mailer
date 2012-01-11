<?php

/**
 * Basic mail engine exception, created mostly for syntax.
 *
 * @author Martin Ricken <kreean@gmail.com>
 * @package Mailer
 */
class MailEngineException extends Exception {}

/**
 * Basic mail engine to build uppon for specific mailengines.
 * 
 * @author Martin Ricken <kreean@gmail.com>
 * @package Mailer
 */
abstract class BaseMailEngine {
  
  /**
   * @var int $port
   */
  private $port = NULL;
  
  /**
   * @var string $host
   */
  private $host = NULL;
  
  /**
   * @var boolean $ssl_enabled
   */
  private $ssl_enabled = NULL;
  
  /** SETTERS **/
  
  /**
   * Constructor
   */
  public function __construct() {
    $this->setSslEnabled(FALSE);
  }
  
  /**
   * Set the port number to connect to.
   * @param int $port
   */
  public function setPort($port) {
    $this->port = $port;
  }
  
  /**
   * Set the hostname to connect to.
   * @param string $host
   */
  public function setHost($host) {
    $this->host = $host;
  }
  
  /**
   * Set ssl to enabled or disabled.
   * @param boolean $ssl
   */
  public function setSslEnabled($ssl) {
    $this->ssl_enabled = $ssl;
  }
  
  /** GETTERS **/
  
  /**
   * Get the port number
   * @return int
   */
  public function getPort(){
    return $this->port;
  }
  
  /**
   * Get the host to connect to.
   * @return string
   */
  public function getHost(){
    return $this->host;
  }
  
  /** UTILITY **/
  
  /**
   * Determine if ssl is enabled.
   * @return boolean
   */
  public function isSslEnabled(){
    return $this->ssl_enabled;
  }
}