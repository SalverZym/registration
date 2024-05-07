<?php

require_once __DIR__."/model_base.php";

class model_login extends model_base
{


    public function checkUser(){

        $result=$this->data_base->query("SELECT login FROM users WHERE (login='".$_POST['login']."' OR email='".$_POST['login']."') AND password='".$_POST['password']."' ");

        if ($result->num_rows > 0) {
            return true;
        }else {
            return false;
        }
    }
}