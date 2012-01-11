<?php

/**
 * Mailer class for controlling the mail engine attatched.
 *
 * @author Martin Ricken <kreean@gmail.com>
 * @package Mailer
 */
class Mailer {
  
  /**
   * @var MailEngine
   */
  private $engine = NULL;
  
  /**
   * Constructor
   */
  public function __construct(MailCredentials $credentials, MailEngine $engine) {
    $this->engine = $engine;
    $this->engine->setCredentials($credentials);
  }
  
  /**
   * Connect the engine to the mail host
   */
  public function connect() {
    $this->engine->connect();
  }
  
  /**
   * Disconnect the engine from the mail host
   */
  public function disconnect() {
    $this->engine->disconnect();
  }
  
  /**
   * Change mail credentials for the host. This requires a reconnect if done at runtime.
   *
   * @param MailCredentials $credentials
   */
  public function changeCredentials(MailCredentials $credentials) {
    $this->engine->setCredentials($credentials);
  }
  
  /*
  public function changeEngine(MailEngine $engine) {
    $cred = $this->engine->getCredentials();
    $this->engine->disconnect();
    $this->engine = $engine;
    $this->engine->setCredentials($cred);
  }
  */
  
  /**
   * Get a count of all e-mails in the current mail folder.
   * @return int
   */
  public function countMessages() {
    return $this->engine->getMessageCount();
  }
  
  /**
   * Get a list of messages.
   */ 
  public function getMessages($limit = 10, $offset = 0, $options = 0) {
    return $this->engine->getMessageArray($limit, $offset, $options);
  }
}