<?php

error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 'on');
ini_set('error_log', __DIR__ . '/errors.log');

$request = $_SERVER['REQUEST_URI'];
$request= explode("?", $request);
$request=explode("/", $request[0]);

if(file_exists(__DIR__."/$request[1].php")){

    require_once __DIR__."/$request[1].php";
    $cont=new $request[1]();
    if(method_exists($cont, $request[2])){
        if($_SERVER["REQUEST_METHOD"]=="GET"){
            call_user_func_array(array($cont, "$request[2]"), array_slice(array_values($_GET),1));
        }elseif ($_SERVER["REQUEST_METHOD"]=="POST"){
            $cont->{$request[2]}();
        }
    }
}

?>

