<?php
    class dashboard
    {
        function __construct(){}

        function app()
        {
            
            require_once "models/analysis_MO.php";
            $connect=new connect('client');
            $analysis_MO=new analysis_MO($connect);
            $array=$analysis_MO->analy_id($_SESSION['user_id']);
            if($array){
                    $_SESSION['anali_id']=$array[0]->anali_id;
                    $indicador=$analysis_MO->showChartsInd($_SESSION['anali_id']);
                    $valores=$analysis_MO->showCharts($_SESSION['anali_id']);
            }
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>SAF</title>
                <!--Import Google Icon Font-->
                <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
                <!-- Compiled and minified CSS -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
                <!-- Size Screen-->
                <link rel="stylesheet" href="dist/css/sizeScreen.css">
                <!--Styles Sidenav-->
                <link rel="stylesheet" href="dist/css/SideNav.css">
                <!--Footer-->
                <link rel="stylesheet" href="dist/css/footer.css">
                
            </head>
            <body class="has-fixed-sidenav">
                <header>
                    <div class="navbar-fixed">
                        <nav class="navbar teal darken-1">
                        <div class="nav-wrapper">
                            <a href="#!" class="brand-logo">S.A.F</a>
                        
                            <a href="#" data-target="slide-out" class="sidenav-trigger left"><i class="material-icons">menu</i></a>
                        </div>
                        </nav>
                    </div>
                    <ul id="slide-out" class="sidenav sidenav-fixed collection with-header collapsible">
                        <li class="collection-header"><h6 class="logo">Opciones<i class="material-icons left">menu</i></h6></li>
                        <li class="collection-item"><a class="waves-effect waves-teal" onclick="pages('analysis_VI/show')" href="#">Analisis<i class="material-icons ">show_chart</i></a></li>
                        <li class="collection-item" ><a class="waves-effect waves-teal" href="#" onclick="pages('company_VI/show')">Compañias<i class="material-icons">domain</i></a></li>
                        <li class="collection-item "><a class="waves-effect waves-teal" onclick="log_out();" href="">Salir<i class="material-icons">exit_to_app</i></a></li>
                    </ul>
                    
                </header>
                <main id="content">
                <div class="container" >
                    <div class="cols12">
                        <h2>Inicio</h2>
                        <h6>Ultimo an&aacutelisis</h6>
                    </div>
                    <div class="col s12">
                        
                        <?php if($array)
                        {?>
                            <div class="col s12">
                                <table class="centered highlight responsive-table">
                                    <thead>
                                        <tr>
                                            <th>Nombre Indicador</th>
                                            <th>2016</th>
                                            <th>2017</th>
                                            <th>2018</th>
                                            <th>2019</th>
                                            <th>2020</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $contador=0;
                                        $contador2=0;
                                        while($contador<count($indicador))
                                        {?>
                                            <tr>
                                                <td><?php echo($indicador[$contador]->indi_name)?></td>
                                                <td><?php echo($valores[$contador2]->inan_valor); $contador2++;?></td>
                                                <td><?php echo($valores[$contador2]->inan_valor); $contador2++;?></td>
                                                <td><?php echo($valores[$contador2]->inan_valor); $contador2++;?></td>
                                                <td><?php echo($valores[$contador2]->inan_valor); $contador2++;?></td>
                                                <td><?php echo($valores[$contador2]->inan_valor); $contador2++;?></td>
                                            </tr>
                                        <?php
                                            $contador++;
                                            }?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <?php
                            $contador=0;
                            while($contador<count($indicador))
                            {
                                ?>
                                <div class=" col s12">
                                    <canvas id="canvas<?php echo($contador)?>"></canvas>
                                </div>
                                <?php
                                $contador++;
                            }
                            ?>
                            <br>
                            <br>

                        <?php
                        }
                        else
                        {
                            ?>
                            <div class="cols12">
                                <h6>A&uacuten no hay an&aacutelisis registrados</h6>
                            </div>
                            <?php
                        }
                        ?>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script src="dist/js/buttons.js"></script>
                        <script>
                        
                        <?php
                        if($array){
                            $contador=0;
                            $contador2=0;
                            while($contador<count($indicador))
                            {
                                ?>
                                var miCanvas<?php echo($contador)?>=document.getElementById("canvas<?php echo($contador)?>").getContext("2d");
                                var chart<?php echo($contador)?>=new Chart(miCanvas<?php echo($contador)?>,{
                                    type: 'line',
                                    data:{
                                        labels:["2016","2017","2018","2019","2020"],
                                        datasets: [{
                                            label: '<?php echo($indicador[$contador]->indi_name)?>',
                                            data: [<?php echo($valores[$contador2]->inan_valor); $contador2++;?>,<?php echo($valores[$contador2]->inan_valor); $contador2++;?>,<?php echo($valores[$contador2]->inan_valor); $contador2++;?>,<?php echo($valores[$contador2]->inan_valor); $contador2++;?>,<?php echo($valores[$contador2]->inan_valor); $contador2++;?>],
                                            fill: false,
                                            borderColor: 'rgb(75, 192, 192)',
                                            tension: 0
                                        }]
                                    }
                                });
                                <?php
                                $contador++;
                            }
                        }    
                        ?>
                    </script>
                    </div>
                </div>
                </main>
                <footer class="page-footer">
                <div class="container">
                    <div class="row">
                    <div class="col s12">

                    </div>
                    </div>
                </div>

                </footer>

                <!-- JQuery -->
                <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
                <!-- Compiled and minified JavaScript -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <!-- SideNav -->
                <script src="dist/js/sidenav.js"></script>
                <!-- Buttons -->
                <script src="dist/js/buttons.js"></script>

                <script src="dist/js/Forms.js"></script>
                <!--Dashboard
                <script src="dist/js/dashboard.js"></script>-->
                <script>
                    function pages(url){
                        $.post(url,function(respuesta)
                        {
                            $('#content').html(respuesta);
                        })
                    }
                    function log_out()
                    {
                        
                        $.post('access_CO/log_out',function()
                        {
                            location.href="index.php";
                        })
                    } 
                </script>
            </body>
            </html>
        <?php
            
        }
    }
?>