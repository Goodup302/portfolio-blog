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
    const ACTIVATION_MAIL_ERROR = "Votre compte n'est pas validé, l'envoi du mail de confirmation a échoué";

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
        $user = $userTable->auth($this->get('login'));
        if ($user instanceof UserEntity) {
            if (password_verify($this->get('password'), $user->password)) {
                if (boolval($user->validate) === true) {
                    Session::setSessionId($user->id);
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
        } else {
            $this->setError(self::LOGIN_ERROR);
        }
    }
}
