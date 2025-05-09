<?php
class PHP_Email_Form {
  public $to = '';
  public $from_name = '';
  public $from_email = '';
  public $subject = '';
  public $ajax = false;

  private $messages = [];

  public function add_message($content, $label = '', $length = 0) {
    if (!empty($label) && !empty($content)) {
      $this->messages[] = "$label: $content";
    }
  }

  public function send() {
    if (empty($this->to) || empty($this->from_email)) {
      return 'Recipient or sender email not set!';
    }

    $message_body = implode("\n", $this->messages);
    $headers = "From: {$this->from_name} <{$this->from_email}>\r\n";
    $headers .= "Reply-To: {$this->from_email}\r\n";

    if (mail($this->to, $this->subject, $message_body, $headers)) {
      return $this->ajax ? 'OK' : 'Message sent successfully!';
    } else {
      return $this->ajax ? 'ERROR' : 'Message sending failed!';
    }
  }
}
?>
