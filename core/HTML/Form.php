<?php

namespace Core\HTML;

class Form
{
    private $data;
    public function __construct($data = null) {
        $this->data = $data;
    }

    public function input($name, $label, $type, $value = null) {
        if (is_null($value) && isset($this->data[$name])) {
            $value = $this->data[$name];
        }

        //input
        if ($type == 'textarea') {
            $input = "<textarea class='form-control' style='height: 200px;' name='$name'>$value</textarea>";
        } else {
            $input = "<input class='form-control' type='$type' name='$name' value='$value'>";
        }

        echo "
            <div class='form-group'>
                <label>$label</label>
                $input
            </div>
        ";
    }

    public function addValue($id, $value) {
        echo "<input  type='hidden' name='$id' value='$value'>";
    }

    public function submit($name, $type = 'primary') {
        echo "<button class='btn btn-$type' type='submit'>$name</button>";
    }
}