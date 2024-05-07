<?php

class controller_base
{

    public function render($view, $parametrs=[]){

        extract($parametrs);

        require_once __DIR__."/{$view}.php";
    }
}