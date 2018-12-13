<?php

namespace Core\HTML;

class Form
{
    private $data;
    public function __construct($data = null) {
        $this->data = $data;
    }

    public function input($name, $label, $type, $value = null, $placeholder = '', $attrs = '') {
        if (is_null($value) && isset($this->data[$name])) {
            $value = $this->data[$name];
        }

        //input
        if ($type == 'textarea') {
            $input = "<textarea class='full-width' placeholder='$placeholder' style='height: 200px;' name='$name' $attrs>$value</textarea>";
        } else {
            $input = "<input class='full-width' placeholder='$placeholder' type='$type' name='$name' value='$value' $attrs>";
        }

        //label
        $label = '';
        if (!empty($label)) {
            $label = "<label>$label</label>";
        }

        echo "
            <div class='form-group'>
                $label
                $input
            </div>
        ";
    }

    public function addValue($id, $value) {
        echo "<input  type='hidden' name='$id' value='$value'>";
    }

    public function submit($name, $type = 'primary') {
        echo "<button class='btn btn-$type submit btn btn--primary btn--large full-width' type='submit'>$name</button>";
    }
}