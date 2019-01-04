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

    public function __construct($email_title, $email_sender, $email_receiver)
    {
        $this->sender = $email_sender;
        $this->receiver = $email_receiver;
        $this->header = array(
            "MIME-Version: 1.0",
            "From: '$email_title' <{$this->sender}>",
            "Content-Type:text/html; charset='utf-8'",
            //"Reply-To: <{$this->receiver}>",
            "Content-Transfer-Encoding: 8bit"
        );
    }

    public function setObjet($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function setHtmlContent($content)
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
        return mail($this->receiver, $this->subject, $this->htmlContent, implode("\r\n", $this->header));
    }
}
