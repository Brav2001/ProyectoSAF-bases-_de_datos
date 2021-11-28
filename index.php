<?php
    require_once "libraries/const.php";
    require_once "libraries/connect.php";
    
    
    if(isset($_SESSION['result']) and $_SESSION['result']!="exito")
    {
        $message=$_SESSION['result'];
        unset($_SESSION['result']);
        echo "<html><body></body></html><script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script><script> swal('Error!', '".$message."', 'error');</script>";
    }
    else if (isset($_SESSION['result']) and $_SESSION['result']=="exito")
    {
        unset($_SESSION['result']);
        echo "<html><body></body></html><script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script><script> swal('Registro exitoso!', 'Usuario registrado con exito', 'success');</script>";   
    }
    if(isset($_SESSION['user_id']))
    {
        require_once "libraries/front_controller.php";

        if(isset($_GET['url'])){$url=$_GET['url'];}else{$url="";} 
        
        $front_controller=new front_controller($url);
    }
    else if(isset($_POST['username'])  and isset($_POST['userpassword']))
    {
        $username=$_POST['username'];
        $userpassword=$_POST['userpassword'];
        require_once "controllers/access_CO.php";
        $access_CO=new access_CO();
        $access_CO->log_in($username,$userpassword);
    }
    else if(isset($_POST['btnregister']) || (isset($_SESSION['result'])and $_SESSION['result']!="exito" and $_SESSION['result']!="Usuario o contraseña incorrectos"))
    {
        unset($_SESSION['result']);
        require_once "view/checkin_VI.php";
        $checkin_VI=new checkin_VI();
        $checkin_VI->check_in();
    }
    else if(isset($_POST['new_username']) and isset($_POST['new_useremail']) and isset($_POST['new_usertelf']) and isset($_POST['new_userpassword1'])  and isset($_POST['new_userpassword2']))
    {
        $new_username=$_POST['new_username'];
        $new_useremail=$_POST['new_useremail'];
        $new_usertelf=$_POST['new_usertelf'];
        $new_userpassword1=$_POST['new_userpassword1'];
        $new_userpassword2=$_POST['new_userpassword2'];
        require_once "controllers/access_CO.php";
        $access_CO=new access_CO();
        $access_CO->check_in($new_username,$new_useremail,$new_usertelf,$new_userpassword1,$new_userpassword2);
    }
    else
    {
        unset($_SESSION['result']);
        require_once "view/login_VI.php";
        $login_VI= new login_VI();
        $login_VI->log_in();
    }
?>