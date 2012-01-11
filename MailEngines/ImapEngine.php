<?php

class ImapEngine extends BaseMailEngine implements MailEngine {
  
  protected $connection = NULL;
  
  /**
   * @var MailCredentials
   */
  private $credentials = NULL;
  
  public function __construct(){}
  
  public function __destruct(){
    $this->disconnect();
  }
  
  /** UTILITY **/
  
  /**
   * Connect to mail server.
   *
   * @return boolean
   */
  public function connect(){
    $this->disconnect();
    $this->connection = imap_open($this->getConnectionString(),$this->credentials->getUsername(),$this->credentials->getPassword());
    if(!$this->connection){
      throw new MailEngineException('Cannot connect using Imap: ' . imap_last_error());
    }
    return TRUE;
  }
  
  /**
   * Disconnect from mail server
   */
  public function disconnect(){
    if (!is_null($this->connection)) {
      imap_close($this->connection);
      $this->connection = NULL;
    }
  }
  
  public function getConnection(){
    return $this->connection;
  }
  
  public function getCredentials() {
    return $this->credentials;
  }
  
  public function setCredentials(MailCredentials $credentials) {
    $this->credentials = $credentials;
    $this->disconnect();
    $this->connect();
  }
  
  /*** UTILITY ***/
  
  public function getMessageCount() {
    return imap_num_msg($this->connection);
  }
  
  private function getConnectionString(){
    if($this->isSslEnabled()){
      $ssl = 'ssl';
    }else{
      $ssl = '';
    }
    return '{'.$this->getHost().':'.$this->getPort().'/imap/'.$ssl.'}INBOX';
  }
  
  public function getMessageArray($limit = 10, $offset = 0, $options = 0) {
    $sequence = $this->getImapSequence($limit, $offset);
    $result = imap_fetch_overview($this->getConnection(), $sequence, $options);
    
    if(is_array($result) && !empty($result)){
      krsort($result);
      return $result;
    }
    return array();
  }
  
  private function getImapSequence($limit = 10, $offset = 0){
    $count = $this->getMessageCount();
    $start = $count - $limit - $offset ;
    if($start == 0){
      $start = 1;
    }
    $end = $start + $limit;
    
    $seq = ($start).':'.$end;
    
    return $seq;
  }
}