<?php

namespace controllers;

abstract class Controller
{
    public function __call($method, $parameters)
    {
        throw new \Exception("Method {$method} does not exist");
    }
}