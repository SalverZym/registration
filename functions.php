<?php

function checkLogin($object ,$flag){
    if($object!=$flag){
        header('Location: http://registration/main/show');
        exit();
    }
}


