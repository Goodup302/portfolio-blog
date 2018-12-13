<?php

namespace Core\Form;


class Email
{

    private $header;

    function __construct($email_title, $email_sender) {
        $this->header="MIME-Version: 1.0\r\n";
        $this->header.='From:"' . $email_title . '"<' . $email_sender . '>'."\n";
        $this->header.='Content-Type:text/html; charset="utf-8"'."\n";
        $this->header.='Content-Transfer-Encoding: 8bit';
    }

    public function SendMail($email, $titre, $message) {
        $content='
			<html>
				<body>
			';
        $content.= $message;
        $content.='
				</body>
			</html>
			';
        return mail($email, $titre, $content, $this->header);
    }
}