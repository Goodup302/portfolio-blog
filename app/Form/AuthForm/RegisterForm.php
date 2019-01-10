<?php

namespace App\Form\AuthForm;
use App\Entity\UserEntity;
use App\Table\UserTable;
use Core\Form\PostForm;
use Core\Form\InputType;

class RegisterForm extends PostForm
{
    const LOGIN_EXIST_ERROR = 'Le pseudo entré est déjà utilisé';
    const EMAIL_EXIST_ERROR = 'Le mail entré est déjà utilisé';
    const REGISTER_ERROR = 'Création du compte impossible, Réessayer plus tard.';

    protected $submitName = "S'enregistrer";
    protected $success_message = 'Votre compte vient d\'ètre créé (Un mail de confirmation vous a été envoyé)';
    protected $hasLabel = true;
    protected $inputModel = array(
        'username' => ['Nom et Prenom', InputType::TEXT],
        'login' => ['Pseudo', InputType::TEXT],
        'email' => ['Email', InputType::EMAIL],
        'password' => ['Mot de passe', InputType::PASSWORD]
    );

    /**
     * Register an new user
     */
    public function register()
    {
        $userTable = new UserTable();
        //Check if account already exist
        $error = null;
        if ($userTable->loginExist($this->get('login'))) {
            $error = self::LOGIN_EXIST_ERROR;
        }
        if ($userTable->emailExist($this->get('email'))) {
            $error = self::EMAIL_EXIST_ERROR;
        }
        if (is_null($error)) {
            //Create Account
            $user = $userTable->register(
                $this->get('username'),
                $this->get('login'),
                $this->get('password'),
                $this->get('email')
            );
            if ($user instanceof UserEntity) {
                $user->sendConfirmMail();
            } else {
                $this->setError(self::REGISTER_ERROR);
            }
        } else {
            $this->setError($error);
        }
    }
}
