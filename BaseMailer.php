<?php

/**
 * A list of Gmail emails.
 */
class GmailList implements ArrayList {
  
  private $mail_headers = NULL;
  private $count = NULL;
  private $offset = NULL;
  
  /**
   * @var Mailer
   */
  private $mailer = NULL;
  
  public function __construct() {
    $this->mailer = $mail = new Mailer(MailCredentials::getInstance(), new GmailEngine());
    $this->count = 10;
    $this->offset = 0;
  }
  
  public function each() {
    if(is_null($this->mail_headers)){
      return false;
    }
    
    $item = each($this->mail_headers);
    
    if($item) {
      return new Email($item[1]);
    }
    return FALSE;
  }
  
  public function getCount(){
    if (is_null($this->mail_headers)) {
      return $this->mailer->countMessages();
    }
    return count($this->mail_headers);
  }
  
  public function setCount($count) {
    $this->count = $count;
  }
  
  public function setOffset($offset) {
    $this->offset = $offset;
  }
  
  public function loadList(){
    $this->mail_headers = $this->mailer->getMessages($this->count, $this->offset);
  }
  
  private function loadDefaultList(){
    $this->mail_headers = $this->mailer->getMessages(($this->mailer->countMessages()-10).':'.$this->mailer->countMessages());
  }
  
}

class Email implements Content {
  
  private $subject = NULL;
  private $from = NULL;
  private $to = NULL;
  private $date = NULL;
  private $message_id = NULL;
  private $size = NULL;
  private $uid = NULL;
  private $msgno = NULL;
  private $recent = NULL;
  private $flagged = NULL;
  private $answered = NULL;
  private $deleted = NULL;
  private $seen = NULL;
  private $draft = NULL;
  private $udate = NULL;
  
  /**
   * @var Converter
   */
  private $udate_converter = NULL;
  
  /**
   * @var Converter
   */
  private $size_converter = NULL;
  
  public function __construct(stdClass $mail){
    $this->subject = $mail->subject;
    $this->from = $mail->from;
    $this->to = $mail->to;
    $this->date = $mail->date;
    $this->message_id = $mail->message_id;
    $this->size = $mail->size;
    $this->uid = $mail->uid;
    $this->msgno = $mail->msgno;
    $this->recent = $mail->recent;
    $this->flagged = $mail->flagged;
    $this->answered = $mail->answered;
    $this->deleted = $mail->deleted;
    $this->seen = $mail->seen;
    $this->draft = $mail->draft;
    $this->udate = $mail->udate;
  }
  
  public function getSubject(){
    return $this->subject;
  }
  
  public function getFrom(){
    return $this->from;
  }
  
  public function getTo(){
    return $this->to;
  }
  
  public function getDate(){
    return $this->date;
  }
  
  public function getMessageId(){
    return $this->message_id;
  }
  
  public function getSize(){
    if($this->size_converter instanceof Converter) {
      return $this->size_converter->convert($this->size);
    }
    return $this->size;
  }
  
  public function getUid(){
    return $this->uid;
  }
  
  public function getMessageNumber(){
    return $this->msgno;
  }
  
  public function getRecent(){
    return $this->recent;
  }
  
  public function getFlagged(){
    return $this->flagged;
  }
  
  public function getAnswered(){
    return $this->answered;
  }
  
  public function getDeleted(){
    return $this->deleted;
  }
  
  public function getSeen(){
    return $this->seen;
  }
  
  public function getDraft(){
    return $this->draft;
  }
  
  public function getUdate(){
    if($this->udate_converter instanceof Converter){
      return $this->udate_converter->convert($this->udate);
    }
  }
  
  public function getContent(){
    
  }
  
}



?>