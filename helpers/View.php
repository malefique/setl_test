<?php

namespace helpers;

class View
{
    private static $path = __DIR__.'/../views';

    public static function print(string $view,array $data)
    {
        if(file_exists(self::$path.'/'.$view.'.php'))
        {
            extract($data);
            require_once (self::$path.'/'.$view.'.php');
        }
        else
            throw new \Exception("View {$view} does not exist");
    }
}