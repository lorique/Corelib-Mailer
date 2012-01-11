<?php

class GmailEngine extends ImapEngine {
  
  public function __construct(){
    $this->setHost('imap.gmail.com');
    $this->setPort(993);
    $this->setSslEnabled(TRUE);
  }
}