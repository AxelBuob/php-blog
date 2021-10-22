<?php

namespace Core\Mail;

class Mail
{
    protected $to;
    protected $from;
    protected $subject;
    protected $message;
    protected $headers;
    

    public function __construct($to, $from, $subject, $message)
    {
        $this->to = $to;
        $this->from = $from;
        $this->subject = $subject;
        $this->message = $message;
        $this->headers = $this->getHeaders();
    }

    private function getHeaders()
    {
        $headers =  "From: " . $this->from . "\r\n" .
                    "Reply-To: " . $this->from . "\r\n" .
                    "X-Mailer: PHP/" . phpversion();
        return $headers;
    }

    public function send()
    {
        return mail($this->to, $this->subject, $this->message, $this->headers);
    }
}