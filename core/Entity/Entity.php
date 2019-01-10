<?php

namespace Core\Entity;

class Entity
{
    /**
     * Get fields of a database
     * 
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        $this->$name = $this->$method();
        return $this->$name;
    }
}
