<?php
    require_once "models/model_MO.php";
    class access_CO
    {
        function __construct(){}

        function log_in($username,$userpassword)
        {
            if(filter_var($username, FILTER_VALIDATE_EMAIL) and (strlen($userpassword)<=45 and strlen($userpassword)>=8))
            {
                $connect=new connect('client');
                $model_MO=new model_MO($connect);
                $array=$model_MO->log_in($username,$userpassword);
                if($array)
                {
                    $id=$array[0]->user_id;
                    $_SESSION['user_id']=$id;
                    
                }
                else
                {
                    $_SESSION['result']="Usuario o contraseña incorrectos";
                }
                
            }
            else
            {
                $_SESSION['result']="existen campos incorrectos";
            }
            header("location:index.php");
        }
        function log_out()
        {
            unset($_SESSION['user_id']);
            unset($_SESSION['result']);
            unset($_SESSION['anali_name']);
            unset($_SESSION['comp_id']);
            session_destroy();
            
        }
        
        function check_in($new_username,$new_useremail,$new_usertelf,$new_userpassword1,$new_userpassword2)
        {
            if((filter_var($new_useremail,FILTER_VALIDATE_EMAIL)) and (strlen($new_username)<=50 and strlen($new_username)>=1) and (strlen($new_userpassword1)<=45 and strlen($new_userpassword1)>=8) and (strlen($new_userpassword2)<=45 and strlen($new_userpassword2)>=8) and (strlen($new_usertelf)<=45 and strlen($new_usertelf)>=8) and($new_userpassword1==$new_userpassword2))
            {
                $connect=new connect('client');
                $model_MO=new model_MO($connect);
                $model_MO->check_in($new_username,$new_useremail,$new_usertelf,$new_userpassword1,$new_userpassword2);
                header("location:index.php");
                
            }
            else
            {
                $_SESSION['result']="existen campos incorrectos";
                header("location:index.php");
            }
        }
    }
?>