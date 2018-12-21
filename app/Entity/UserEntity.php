<?php

namespace App\Entity;

use Core\Config;
use Core\Entity\Entity;
use Core\Form\Email;

class UserEntity extends Entity
{

    public function getAdmin() : bool
    {
        return boolval($this->admin);
    }

    public function canEditPost($post)
    {
        if ($this->getAdmin()) {
            return true;
        } elseif ($post->user_id === $this->id) {
            return true;
        }
        return false;
    }

    public function sendConfirmMail()
    {
        $receiver = $this->email;
        $sender = Config::getInstance(CONFIG_FILE)->get('validation_mail');
        $objet = "Activation du compte : {$_SERVER['SERVER_NAME']}";
        $name = $this->data['username'];
        $content = $this->data['message'];
        //
        $message = '<p>Sujet : ' . $objet . '<br />';
        $message .= 'Email : ' . $sender . '</p>';
        $message .= '<p>' . htmlspecialchars($content) . '</p>';
        $Mail = new Email("$name vous contact", $sender);
        $result = $Mail->SendMail($receiver, 'Contact de ' . $name, $message);
        if (!$result) {
            $this->error_message = "Le mail n'a pas pu ètre envoyé, réessayer plus tard.";
        }
    }
}
