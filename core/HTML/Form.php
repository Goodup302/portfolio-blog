<?php

namespace Core\HTML;

/**
 * Class Form
 * @package Core\HTML
 */
class Form
{
    private $data;

    /**
     * Form constructor.
     * @param null $data
     */
    public function __construct($data = null)
    {
        $this->data = $data;
    }

    /**
     * @param $name
     * @param string $label
     * @param string $type
     * @param null $value
     * @param string $placeholder
     * @param string $attrs
     */
    public function input($name, $label = '', $type = 'text', $value = null, $placeholder = '', $attrs = '')
    {
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

    /**
     * @param $id
     * @param $value
     */
    public function addValue($id, $value)
    {
        echo "<input  type='hidden' name='$id' value='$value'>";
    }

    /**
     * @param $name
     * @param string $type
     */
    public function submit($name, $type = 'primary')
    {
        echo "<button class='btn btn-$type submit btn btn--primary btn--large full-width' type='submit'>$name</button>";
    }
}
