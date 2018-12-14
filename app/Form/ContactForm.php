<?php
namespace App\Form;
use Core\Form\PostForm;
use Core\Form\InputType;
use Core\Config;
use Core\Form\Email;

class ContactForm extends PostForm
{
    protected $submitName = 'Contacter';
    protected $success_message = 'Votre demande a été envoyée';
    protected $inputModel = array(
        'username' => ['Nom et Prenom', InputType::TEXT],
        'email' => ['Email', InputType::EMAIL],
        'objet' => ['Objet', InputType::TEXT],
        'message' => ['Message', InputType::TEXTAREA]
    );

    public function __construct($post) {parent::__construct($post);}

    public function sendMail() {
        $receiver = Config::getInstance(CONFIG_FILE)->get('contact_mail');
        $sender = $this->data['email'];
        $objet = $this->data['objet'];
        $name = $this->data['username'];
        $content = $this->data['message'];
        //
        $message = '<p>Sujet : ' . $objet . '<br />';
        $message .= 'Email : ' . $sender . '</p>';
        $message .= '<p>' . htmlspecialchars($content) . '</p>';
        $Mail = New Email($name.' vous contact', $sender);
        $result = $Mail->SendMail($receiver, 'Contact de ' . $name, $message);
        if (!$result) {
            $this->error_message = "Le mail n'a pas pu ètre envoyé, réessayer plus tard.";
        }
    }
}