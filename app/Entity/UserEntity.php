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

    public function canEditPost(PostEntity $post)
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
        $key = urlencode($this->validatekey);
        $url = Config::getInstance(CONFIG_FILE)->get('webroot') . "index.php?p=activate&key=$key";
        $objet = "Activation du compte de {$_SERVER['SERVER_NAME']}";
        $message = "
            <p>
                Nous vous confirmons votre inscription sur <b>{$_SERVER['SERVER_NAME']}</b><br>
                veuillez <a target='_blank' href='$url'>cliquer ici</a> pour valider votre compte
            </p>
        ";
        //
        $mail = (new Email('Activation', $sender, $receiver))
            ->setObjet($objet)
            ->setHtmlContent($message)
        ;
        return $mail->send();
        //"Le mail de confirmation n'a pas pu ètre envoyé, réessayer plus tard."
    }
}
