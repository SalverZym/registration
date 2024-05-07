<?php

require_once __DIR__."/controller_base.php";
require_once __DIR__."/model_registration.php";
require_once __DIR__."/functions.php";

class registration extends controller_base
{

    public function show(){

        checkLogin(!empty($_SESSION['logged_in']),false);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $new_user=new model_registration();
            $new_user->addUser();
        }

        $this->render('/views/registration');
    }

}