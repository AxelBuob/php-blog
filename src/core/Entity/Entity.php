<?php

namespace Core\Entity;

class Entity
{
    public function __get($key)
    {
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method(); // $this->url = $this getUrl();
        return $this->$key; // return $this->getUrl();
    }
}