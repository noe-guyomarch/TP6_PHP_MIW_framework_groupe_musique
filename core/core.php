<?php
//fichier de configuration

spl_autoload_register(function ($class) {
    //$class = StreamerController
    if (preg_match("/Controller$/", $class)) { //vérfier si Controller est dans $class
        //require le controller
        $controller = substr($class, 0, -10);

        if (file_exists('controllers/'.$controller.'.php')) {
            require 'controllers/'.$controller.'.php';
        } else {
            echo '404 - Controller not found';
        }
    } elseif (preg_match("/Model$/", $class)) { //vérfier si model est dans $class
        //require le model
        $controller = substr($class, 0, -5);

        if (file_exists('models/'.$controller.'.php')) {
            require 'models/'.$controller.'.php';
        } else {
            echo '404 - Model not found';
        }
    }
});

function p($data = null)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}
function d($data = null)
{
    p($data);
    die;
}
