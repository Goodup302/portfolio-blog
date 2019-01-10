<?php

namespace Core\HTML;


class Button
{
    private $name;
    private $type;
    private $style;
    private $url;
    private $args;

    /**
     * Button constructor.
     * @param null $name
     * @param null $type
     * @param string $style
     */
    public function __construct($name = null, $type = null, $style = BootstrapStyle::primary)
    {
        $this->name = $name;
        $this->style = "btn btn-$style";
        $this->type = $type;
    }

    /**
     * Set if is a redirect button
     *
     * @param $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Add attr on tag
     *
     * @param $args
     * @return $this
     */
    public function setArgs($args)
    {
        $this->args = $args;
        return $this;
    }

    /**
     * show html button
     */
    public function show()
    {
        if (empty($this->url)) {
            echo "<button class='$this->style' type='$this->type' $this->args>$this->name</button>";
        } else {
            echo "<a href='$this->url' class='$this->style' role='button' $this->args>$this->name</a>";
        }
    }
}
