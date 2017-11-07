<?php
/**
 * Created by PhpStorm.
 * User: Jirka
 * Date: 2.11.2017
 * Time: 15:34
 */

mb_internal_encoding("UTF-8");

function autoLoader($class)
{
    // Does name of class end with string "Controllers"?
    if (preg_match('/Controller$/', $class))
        require("controllers/" . $class . ".php");
    else
        require("models/" . $class . ".php");
}

spl_autoload_register("autoLoader");

Db::connect("127.0.0.1", "root", "", "mvc_db");
$router = new RouterController();
$router->process(array($_SERVER['REQUEST_URI']));
$router->returnView();