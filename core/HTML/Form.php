<?php

namespace Core\HTML;

class Form
{
    private $data;
    public function __construct($data) {
        $this->data = $data;
    }

    public function input($name, $label, $type, $value = null) {
        if (is_null($value) && isset($this->data[$name])) {
            $value = $this->data[$name];
        }


        echo '<div class="form-group">';
        echo "<label>$label</label>";
        if ($type == 'textarea') {
            echo "<textarea class='form-control' style='height: 200px;' name='$name'>$value</textarea>";
        } else {
            echo "<input class='form-control' type='$type' name='$name' value='$value'>";
        }
        echo '</div>';
    }
    public function submit($name) {
        echo "<button class='btn btn-primary' type='submit'>$name</button>";
    }
}