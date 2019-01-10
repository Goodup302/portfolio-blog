<?php
namespace App\Form;
use Core\Form\PostForm;
use Core\Form\InputType;
use Core\Config;
use Core\Form\Email;

class ContactForm extends PostForm
{
    const ERROR_CONTACT = "Le mail n'a pas pu ètre envoyé, réessayer plus tard.";

    protected $submitName = 'Contacter';
    protected $success_message = 'Votre demande a été envoyée';
    protected $inputModel = array(
        'username' => ['Nom et Prenom', InputType::TEXT],
        'email' => ['Email', InputType::EMAIL],
        'objet' => ['Objet', InputType::TEXT],
        'message' => ['Message', InputType::TEXTAREA]
    );

    /**
     * Send contact mail
     */
    public function sendMail()
    {
        $receiver = Config::getInstance(CONFIG_FILE)->get('contact_mail');
        $sender = $this->data['email'];
        $objet = $this->data['objet'];
        $name = $this->data['username'];
        $content = htmlspecialchars($this->data['message']);
        $message = "
            <p>
                Sujet : $objet<br />Email : $sender
            </p>
            <p>$content</p>
        ";
        //
        $mail = (new Email("$name vous contact", $sender, $receiver))
            ->setObjet($objet)
            ->setHtmlContent($message)
        ;
        $result = $mail->send();
        if (!$result) {
            $this->error_message = self::ERROR_CONTACT;
        }
    }
}
