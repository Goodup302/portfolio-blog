<?php

namespace Core\Form;
use Core\HTML\Alert;
use Core\HTML\BootstrapStyle;
use Core\HTML\Form;

class PostForm
{
    protected $data;
    //Exemple inputModel:
    //  array('id' => ['label', 'type']);
    protected $inputModel;
    protected $submitName;
    protected $error_message;
    protected $success_message;
    protected $hasLabel = false;

    public function __construct($post)
    {
        $this->data = $post;
    }

    public function isPost()
    {
        foreach ($this->inputModel as $id => $item) {
            if (empty($this->data[$id])) {
                return false;
            }
        }
        return true;
    }


    public function isValid() {
        foreach ($this->data as $index => $item) {
            $value = $this->data[$index];
            $type = $this->inputModel[$index][1];
            $name = $this->inputModel[$index][0];

            if ($type == InputType::NOFILTER) {

            } else if ($type == InputType::TEXT) {
                if ($value != strip_tags($value)) {
                    $this->error_message = "Certain des caractères ne sont pas accepté";
                    break;
                }
                if (strlen($value) > InputType::TEXT_MAX_SIZE) {
                    $this->error_message = "le champ '$name' est trop long";
                    break;
                }

            } else if ($type == InputType::TEXTAREA) {
                if ($value != strip_tags($value)) {
                    $this->error_message = "Certain des caractères ne sont pas accepté";
                    break;
                }
                if (strlen($value) > InputType::TEXTAREA_MAX_SIZE) {
                    $this->error_message = "le champ '$name' est trop long";
                    break;
                }

            } else if ($type == InputType::EMAIL) {
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->error_message = "le champ '$name' n'est pas valide";
                    break;
                }
            }
        }
        if (empty($this->error_message)) {
            return true;
        } else {
            return false;
        }


    }

    public function show() {
        if ($this->isPost()) {
            if (empty($this->error_message)) {
                (new Alert($this->success_message, BootstrapStyle::success))->show();
            } else {
                (new Alert($this->error_message, BootstrapStyle::danger))->show();
            }

        }

        if (empty($this->error_message)) {
            $form = new Form();
        } else {
            $form = new Form($_POST);
        }
        foreach ($this->inputModel as $id => $item) {
            $type = $this->inputModel[$id][1];
            $label = null;
            if ($this->hasLabel) {
                $label = $item[0];
            }
            if ($type == InputType::TEXT || $type == InputType::PASSWORD) {
                $form->input($id, $label, $item[1], null, $item[0], 'required maxlength="'.InputType::TEXT_MAX_SIZE.'"');
            } else if ($type == InputType::TEXTAREA) {
                $form->input($id, $label, $item[1], null, $item[0], 'required maxlength="'.InputType::TEXTAREA_MAX_SIZE.'"');
            } else {
                $form->input($id, $label, $item[1], null, $item[0], 'required');
            }

        }
        $form->submit($this->submitName);
    }
}