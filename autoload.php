<?php

function autoloader(string $alias)
{
    $classMap = [
        'helpers\\Database' => __DIR__ . '/helpers/Database.php',
        'helpers\\View' => __DIR__ . '/helpers/View.php',
        'helpers\\Validator' => __DIR__.'/helpers/Validator.php',
        'helpers\\Captcha' => __DIR__.'/helpers/Captcha.php',
        'controllers\\Controller' => __DIR__.'/controllers/Controller.php',
        'controllers\\Router' => __DIR__.'/controllers/Router.php',
        'controllers\\Api' => __DIR__.'/controllers/Api.php',
        'controllers\\Guestbook' => __DIR__.'/controllers/Guestbook.php',
        'models\\Model' => __DIR__.'/models/Model.php',
        'models\\Post' => __DIR__.'/models/Post.php',
        'models\\User' => __DIR__.'/models/User.php'
    ];

    if(file_exists($classMap[$alias]))
        require_once ($classMap[$alias]);
}

spl_autoload_register('autoloader', true, true);