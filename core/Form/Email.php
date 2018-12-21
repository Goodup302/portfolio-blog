<?php

namespace Core\Form;


class Email
{

    private $header;

    //Mail
    private $sender;
    private $receiver;
    //Args
    private $subject;
    private $htmlContent;

    public function __construct($email_title, $email_sender)
    {
        $this->header = "MIME-Version: 1.0\r\n";
        $this->header .= 'From:"' . $email_title . '"<' . $email_sender . '>' . "\n";
        $this->header .= 'Content-Type:text/html; charset="utf-8"' . "\n";
        $this->header .= 'Content-Transfer-Encoding: 8bit';
    }

    public function setMail($sender, $receiver)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        return $this;
    }

    public function setObjet($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function setContent($content)
    {
        $this->htmlContent = "
		<html>
			<body>
                $content
			</body>
		</html>
		";
        return $this;
    }

    public function send()
    {
        return mail($this->receiver, $this->subject, $this->htmlContent, $this->header);
    }
}
