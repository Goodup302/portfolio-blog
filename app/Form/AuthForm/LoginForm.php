<?php

namespace App\Form\AuthForm;
use App\Entity\UserEntity;
use App\Table\UserTable;
use Core\Auth\Session;
use Core\Form\PostForm;
use Core\Form\InputType;

class LoginForm extends PostForm
{
    const LOGIN_ERROR = "Les identifiants rentré ne sont pas correctes";
    const ACTIVATION_ERROR = "Votre compte n'est pas validé (Le mail de confirmation vous à été renvoyé)";
    const ACTIVATION_MAIL_ERROR = "Votre compte n'est pas validé et nous n'avons pas pu renvoyer le mail de confirmation";

    protected $submitName = "Se connecter";
    protected $success_message = 'Connection effectuée avec success';
    protected $hasLabel = true;
    protected $inputModel = array(
        'login' => ['Pseudo', InputType::TEXT],
        'password' => ['Mot de passe', InputType::PASSWORD]
    );

    /**
     * Login management
     */
    public function login()
    {
        $userTable = new UserTable();
        $user = $userTable->auth(
            $this->get('login'),
            $this->get('password')
        );
        if ($user instanceof UserEntity) {
            if (boolval($user->validate) === true) {
                $session = new Session();
                $session->setSessionId($user->id);
            } else {
                $this->setError(self::ACTIVATION_ERROR);
                //Mail de confirmation
                if (!$user->sendConfirmMail()) {
                    $this->setError(self::ACTIVATION_MAIL_ERROR);
                }
            }
        } else {
            $this->setError(self::LOGIN_ERROR);
        }
    }
}
