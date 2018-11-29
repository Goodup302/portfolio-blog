<?php

namespace Core\HTML;


class Alert
{

    const primary = 'primary';
    const secondary ='secondary';
    const success = 'success';
    const danger = 'danger';
    const warning = 'warning';
    const info = 'info';
    const light = 'light';
    const dark = 'dark';

    private $message;
    private $type;
    public function __construct($message, $type) {
        $this->message = $message;
        $this->type = $type;
    }

    public function show() {
        echo "
        <div class='alert alert-$this->type' role='alert'>
            $this->message
        </div>
        ";
    }
}

?>