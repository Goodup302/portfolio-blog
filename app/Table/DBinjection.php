<?php

namespace App\Table;

trait DBinjection
{
    public function __construct()
    {
        parent::__construct();
        $this->db = \App::getInstance()->getDatabase();
    }
}
