<?php
    class model_MO
    {
        private $connect;
        function __construct($connect)
        {
            $this->connect=$connect;
        }

        function log_in($username,$userpassword)
        {
            $sql="select acce_id from proyecto.acceso where acce_clave='$userpassword' and acce_user ='$username';";
            $this->connect->out($sql);
            return $this->connect->extract_log_in();
        }
        function consult_user($camp,$data)
        {
            $sql="select * from proyecto.usuario where $camp='$data';";
            $this->connect->out($sql);
            return $this->connect->extract();
        }
        function check_in($new_username,$new_useremail,$new_usertelf,$new_userpassword1,$new_userpassword2)
        {
            $user_name="user_name";
            $user_email="user_email";
            $array1=$this->consult_user($user_name,$new_username);
            $array2=$this->consult_user($user_email,$new_useremail);
            if($array1)
            {
                $_SESSION['result']="El nombre de usuario no esta disponible";
                return false;
            }
            else if($array2)
            {
                $_SESSION['result']="El correo electronico no esta disponible";
            }
            else{
                $sql="insert into proyecto.acceso(acce_id,acce_clave,acce_user) values(default,'$new_userpassword1','$new_useremail');";
                $this->connect->out($sql);
                $sql="select acce_id from proyecto.acceso where acce_user='$new_useremail';";
                $this->connect->out($sql);
                $array=$this->connect->extract();
                $acce_id=$array[0]->acce_id;
                $sql="insert into proyecto.usuario(user_id,acce_id,user_name,user_email,user_telefono) values(default,'$acce_id','$new_username','$new_useremail','$new_usertelf');";
                $this->connect->out($sql);
                $_SESSION['result']="exito";
            }
        }
    }
?>