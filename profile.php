<?php

require_once __DIR__."/controller_base.php";
require_once __DIR__."/functions.php";
require_once __DIR__."/model_profile.php";


class profile extends controller_base
{

    public function show($login){

        session_start();
        checkLogin($_SESSION['logged_in'],$login);

        $user=new model_profile();

        $data=$user->findUser($login);

        $this->render('/views/profile', compact('data'));
    }

    public function change(){

        session_start();
        $user=new model_profile();

        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $user->changeUser($_SESSION['logged_in']);
        }

        header("Location: http://registration/profile/show?login={$_SESSION['logged_in']}");
    }
}