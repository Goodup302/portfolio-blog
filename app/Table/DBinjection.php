<?php

namespace App\Table;

trait DBinjection
{
    /**
     * Add db on class extend of Table
     */
    public function __construct()
    {
        parent::__construct();
        $this->db = \App::getInstance()->getDatabase();
    }
}
