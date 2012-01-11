<?php

/*
interface Singleton {
  public static function getInstance();
}
*/

interface ArrayList {
  
  public function each();
  
  public function getCount();
  
}

interface BaseMailer {}

interface Content {
  public function getContent();
  
}

interface MailEngine {
  
  public function connect();
  
  public function disconnect();
  
  public function getConnection();
  
  public function setCredentials(MailCredentials $credentials);
  
  public function getMessageArray($limit = 10, $offset = 0);
  
}

interface Converter {
  public function convert($data);
}