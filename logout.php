<?php

require_once __DIR__."/controller_base.php";
require_once __DIR__."/functions.php";

class logout extends controller_base
{
    public function logout($login){

        session_start();

        checkLogin(!empty($_SESSION['logged_in']),true);

        unset($_SESSION['logged_in']);
        header('Location: http://registration/main/show');
    }
}