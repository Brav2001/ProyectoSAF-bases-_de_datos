<?php
    class login_VI
    {
        function __construct(){}

        function log_in()
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
                            <h5 class="center-align">Log In</h5>
                            <br>
                                <form action="#" method="post">
                                    <div class="col s12 input-field ">
                                        <i class="material-icons prefix">person</i>
                                        <input type="email" id="user" name="username" class="validate" required >
                                        <label for="user">User Name</label>
                                        
                                    </div>
                                    <div class="col s12 input-field">
                                    <i class="material-icons prefix">vpn_key</i>
                                        <input type="password" id="password1" name="userpassword" maxlength="45" minlength="8" class="validate" required>
                                        <label for="password1">Password</label>
                                    </div>
                                    <div class="center-align col s12 right-align">
                                        <button class="btn waves-effect waves-light " type="submit" name="btnlogin">Iniciar sesión<i class="material-icons left">send</i></button>
                                        
                                    </div>
                                </form>
                                    <br>
                                <form action="#" method="post">
                                    <div class="center-align"> <button class=" waves-effect waves-light btn" name="btnregister" type="submit"><i class="material-icons left">person_add</i>Registrar</button></div>
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
                
            </body>
            </html>
            <?php
        }
    }
?>    