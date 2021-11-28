<?php
    class checkin_VI
    {
        function __construct(){}

        function check_in()
        {
            ?>
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <!-- Compiled and minified CSS -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
                <!--Import Google Icon Font-->
                <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

                <link rel="stylesheet" href="dist/css/log.css">
                <title>SAF</title>
            </head>
            <body>
                <header>
                </header>
                <main>
                    <div class="container  box">
                        <div class="row"></div>
                            <div class="col s12 card-panel">
                            <h5 class="center-align">Registre su nueva cuenta</h5>
                            <br>
                                <form action="#" method="post" onsubmit="return validateForm()">
                                    <div class="col s12 input-field ">
                                        <i class="material-icons prefix">person</i>
                                        <input type="text" id="user" name="new_username" maxlength="50" minlength="5" class="validate"   required >
                                        <label for="user">Nombre de usuario</label>
                                        
                                    </div>
                                    <div class="col s12 input-field ">
                                        <i class="material-icons prefix">email</i>
                                        <input type="email" id="email" name="new_useremail" class="validate"  required >
                                        <label for="email">Email</label>
                                        
                                    </div>
                                    <div class="col s12 input-field ">
                                        <i class="material-icons prefix">phone_android</i>
                                        <input type="number" id="usertelf" name="new_usertelf" class="validate"  required >
                                        <label for="usertelf">Teléfono</label>
                                        
                                    </div>
                                    <div class="col s12 input-field">
                                    <i class="material-icons prefix">vpn_key</i>
                                        <input type="password" id="password1" name="new_userpassword1" maxlength="45" required  minlength="8" class="validate" >
                                        <label for="password1">contraseña</label> 
                                    </div>
                                    <div class="col s12 input-field">
                                        <i class="material-icons prefix">vpn_key</i>
                                            <input type="password" id="password2" name="new_userpassword2" maxlength="45" required  minlength="8" class="validate" >
                                            <label for="password2">Confirme su contraseña</label> 
                                        </div>
                                    <div class="center-align col s12 right-align">
                                        <button class="btn waves-effect waves-light " type="submit" name="action">Registrarse<i class="material-icons left">person</i></button>
                                        
                                    </div>
                                    <br>
                                    
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </main>
                <footer>
                </footer>




                <!-- JQuery -->
                <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
                <!-- Compiled and minified JavaScript -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
                <!--SweetAlert-->
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <!--Validate-->
                <script src="dist/js/validate.js"></script>
                
            </body>
            </html>
            <?php
        }
    }
?>