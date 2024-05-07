<?php

require_once __DIR__."/controller_base.php";

class main extends controller_base
{
    public function show(){

        session_start();

        $this->render('/views/main');
    }
}