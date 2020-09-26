<?php

if($_GET['url'] == ""){
    $_GET['url'] = '/';
}
define('URL', trim($_GET['url']));

$routes = file_get_contents('app/routes.json');

spl_autoload_register(function($class){
    $class = strtolower($class);
    require("core/$class.php");
});

$app = new Bootstrap(URL, $routes);

$app->route();
