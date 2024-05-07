<?php

require_once __DIR__."/model_base.php";

class model_profile extends model_base
{
    public $table='users';

    public $rules=[
        'login'=>['unique', 'required' ],
        'email'=>['unique', 'required'],
        'tel'=>['unique', 'required'],
        'password'=>['required'],
    ];

    public function validate($rules=null, $table=null)
    {
        parent::validate($this->rules, $this->table); // TODO: Change the autogenerated stub
    }

    public function findUser($login){

        $result=$this->data_base->query("SELECT login, email, tel, password FROM {$this->table} WHERE login='".$login."'");

        return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }

    public function changeUser($login){

        session_start();

        $query="UPDATE {$this->table} SET ";

        foreach ($_POST as $k => $v){
            $query.="{$k} = '".$v."' ,";
        }
        $query=substr($query, 0, -1);
        $query.=" WHERE login='".$login."'";

        $_SESSION['logged_in']=$_POST['login'];
        $this->data_base->query($query);



    }
}