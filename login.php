<?php

require_once __DIR__."/controller_base.php";
require_once __DIR__."/model_login.php";
require_once __DIR__."/functions.php";

class login extends controller_base
{
    public function show(){

        checkLogin(!empty($_SESSION['logged_in']),false);

        $label='';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user=new model_login();
            if($user->checkUser()){
                session_start();
                $_SESSION['logged_in'] = $_POST['login'];
                header('Location: http://registration/main/show');
                exit();
            }else{
                $label.='Неверный логин или пароль';
            }
        }


        $this->render('/views/login', compact('label'));
    }
}