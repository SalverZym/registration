<?php

class model_base
{

    public $data_base;

    public function __construct()
    {
        $this->data_base=new mysqli('localhost', 'root', '', 'registration');
    }

    public function unique( $get , $req, $table){

        $result=$this->data_base->query("SELECT * FROM {$table} WHERE {$get}='".$req."' ");

        if ($result->num_rows > 0) {
            return "должно быть уникально";
        }else {
            return "success";
        }
    }

    public function required($get, $req, $table){
        echo "success";
    }


    public function validate($rules, $table){
        foreach ($_POST as $k=>$v){

            if(!empty($_POST[$k])) {

                if(!empty($rules[$k])) {

                    foreach ($rules[$k] as $key => $val) {
                        if ($val != "required") {
                            $result = $this->{$val}($k, $v, $table);

                            if ($result != "success") {
                                goto error;
                            }

                        }
                    }
                }

                echo "success";
                die;

                error:
                echo $result;
                die;

            }else{
                if(in_array('required', $rules[$k])){
                    echo "Поле обязательно к заполнению";
                }else{
                    echo"success";
                }
            }
        }
    }
}