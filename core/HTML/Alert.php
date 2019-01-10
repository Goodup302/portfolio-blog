<?php

namespace Core\HTML;


class Alert
{
    private $message;
    private $type;

    /**
     * Alert constructor.
     * @param $message
     * @param string $type
     */
    public function __construct($message, $type = 'primary')
    {
        $this->message = $message;
        $this->type = $type;
    }

    public function show()
    {
        echo "
        <div class='col-md-12'>
            <div class='d-flex justify-content-center'>
                <div class='alert alert-$this->type' role='alert'>
                    $this->message
                </div>
            </div>
        </div>
        ";
    }
}
