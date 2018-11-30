<?php

namespace Core\HTML;


class Button
{
    private $name;
    private $type;
    private $style;
    private $url;
    private $args;

    public function __construct($name = null, $type = null, $style = BootstrapStyle::primary)
    {
        $this->name = $name;
        $this->style = "btn btn-$style";
        $this->type = $type;
    }

    public function setUrl($url){
        $this->url = $url;
        return $this;
    }

    public function setArgs($args){
        $this->args = $args;
        return $this;
    }

    public function show(){
        if (empty($this->url)) {
            echo "<button class='$this->style' type='$this->type' $this->args>$this->name</button>";
        } else {
            echo "<a href='$this->url' class='$this->style' role='button' $this->args>$this->name</a>";
        }
    }
}