<?php
    require_once "models/analysis_MO.php";
    class analysis_VI
    {
        function __construct(){}

        function show()
        {
            $connect=new connect('client');
            $analysis_MO=new analysis_MO($connect);
            $array=$analysis_MO->show($_SESSION['user_id']);
            $contador=0;
            ?>
            <div class="container">
                    <div class="cols12">
                        <h2>An&aacutelisis</h2>
                    </div>
                    <div class="col s12">
                    <table class="centered highlight responsive-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha de Creación</th>
                                <th>Fecha ult. modificación</th>
                                <th>Visualizar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($contador<count($array)){?>
                                <tr>
                                    <td><?php echo($array[$contador]->anali_name); ?></td>
                                    <td><?php echo($array[$contador]->analy_date_create)?></td>
                                    <td><?php echo($array[$contador]->analy_date_update)?></td>
                                    <td><a class="btn-flat" onclick="eye('<?php echo($array[$contador]->anali_id); ?>')"><i class="material-icons">remove_red_eye</i></a></td>
                                </tr>
                            <?php
                                $contador++;
                                }?>
                            
                        </tbody>
                    </table>
                    </div>
                    <br>
                    <div class="col s4">
                        <a class="btn tooltipped btn-floating btn-large waves-effect waves-light green teal lighten-2" data-position="right" data-tooltip="Agregar análisis" href="#" onclick="pages('analysis_VI/addAnalysis')"><i class="material-icons">add</i></a>
                        
                    </div>
                    <br>
                </div>
                <script src="dist/js/buttons.js"></script>
                <script>
                    function eye(id)
                    {
                        $.post("analysis_CO/eye",{id:id},function(){
                        });
                        pages("analysis_VI/showCharts");
                    }
                </script>
            <?php
        }
        function addAnalysis()
        {
            ?>
            <br>
            <div  class="container">
                <a class="btn-floating  waves-effect waves-light light-blue darken-2" onclick="pages('analysis_VI/show')"><i class="material-icons">arrow_back</i></a>
            </div>
            <div class="container">
                <div class="row">
                    <form id="addAnalysis">
                    <div class=" col s12 input-field">
                                <input id="analysis_name" name="analysis_name" type="text" data-length="100" class="validate" >
                                <label for="analysis_name">Nombre del análisis:</label>
                    </div>
                    <div class="right-align">
                                <button class=" btn  waves-effect waves-light light-blue darken-2" type="button" name="action" onclick="addAnalysis()" >Guardar
                                    <i class="material-icons right">save</i>
                                </button>
                                <br>
                    </div>
                    </form>
                </div>
            </div>
            <script>
                function addAnalysis()
                {
                    let string=$('#addAnalysis').serialize();
                    $.post('analysis_CO/checkAnalysis',string,function(respuesta)
                    {
                        
                        if((respuesta=="registrado"))
                        {
                            
                            pages("analysis_VI/addInd");
                        }
                        else if((respuesta=="yaregistrado"))
                        {
                            M.toast({html: 'Este an&aacutelisis ya existe'});
                        }
                        else if((respuesta=="dato vacio"))
                        {
                            M.toast({html: 'Debe escribir un nombre'});
                        }   
                    })
                }

            </script>
            <?php

        }
        function addInd()
        {
            $connect=new connect("client");
            $analysis_MO=new analysis_MO($connect);
            $array=$analysis_MO->comp_names($_SESSION['user_id']);
            $inf_company=$analysis_MO->comp_inf($_SESSION['user_id']);
            $ind_inf=$analysis_MO->ind_if();
            $ind_name=$analysis_MO->ind_name();
            $array2=$_SESSION['anali_name'];
            $contador=0;
            ?>
            <br>
            <div class="container">
                <div class="row">
                    <div class=" col s12 input-field">
                        <label>Nombre del analisis</label>
                        <br>
                        <input disabled value="<?php echo($array2);?>" id="disabled" name="analysis_name" type="text" class="validate" >
                        
                    </div>
                    <br>
                    <form id="form_indi_comp">
                        <div class="col s6">
                            <label>Nombre de compañias</label>
                            <select onchange="create()" multiple id="select_comp_names" name="select_comp_names[]">
                                <option value="" disabled>Escoja la compañía</option>
                                <?php
                                while ($contador<count($array))
                                {
                                    ?>
                                    <option value="<?php echo ($array[$contador]->comp_id) ?>"><?php echo ($array[$contador]->comp_name) ?></option>
                                    <?php

                                    $contador++;
                                }
                                $contador=0;
                                ?>
                            </select>
                        </div>
                        <div class="col s6">
                            <label>Nombre de indicadores</label>
                            <select multiple id="indi_names"  name="select_indi_names[]">
                                <option  value="" disabled>Indicadores</option>
                            </select>
                        </div>
                        <div class="right-align"><button class=" btn waves-effect waves-light light-blue darken-2 " type="button" name="action" onclick="addIndAnalysis()">Guardar
                            <i class="material-icons right">save</i>
                        </div>
                    </form>   

                </div>
            </div>
            <script src="dist/js/forms.js"></script>
            <script>
                var companias=[];
                var inf_companias=[];
                var ind_id=[];
                var inf_ind=[]; 
                var ind_name=[];
                <?php 
                while ($contador<count($inf_company))
                {
                    ?>
                    companias.push('<?php echo($inf_company[$contador]->comp_id)?>');
                    inf_companias.push('<?php echo($inf_company[$contador]->inff_id)?>');
                    <?php
                    $contador++;
                }
                $contador=0; 
                while ($contador<count($ind_name))
                {
                    ?>
                    ind_name.push('<?php echo($ind_name[$contador]->indi_name)?>');
                    <?php
                    $contador++;
                }
                $contador=0; 
                while ($contador<count($ind_inf))
                {
                    ?>
                    ind_id.push('<?php echo($ind_inf[$contador]->indi_id)?>');
                    inf_ind.push('<?php echo($ind_inf[$contador]->inff_id)?>');
                    <?php
                    $contador++;
                }
                $contador=0;
                ?>
                function create()
                {
                    const tabla = document.querySelector("#indi_names");
                    tabla.innerHTML="";
                    tabla.innerHTML="<option value='' disabled>Indicadores</option>";
                    $(document).ready(function(){
                        $('#indi_names').formSelect();
                    });
                    var ind_cond=[];
                    ind_cond[0]=0;
                    var contador=1;
                    for(var i=1;i<ind_id.length;i++)
                    {
                        var contador2=0;
                        var encontrado=0;
                        if(ind_id[i]==ind_id[i-1]){
                            while(contador2<ind_id.length)
                            {
                                if((ind_id[i])==(ind_id[contador2]))
                                {
                                    encontrado++;
                                }
                                contador2++;
                            }
                            ind_cond.push(encontrado);
                        }
                        
                        
                    }
                    console.log(ind_cond);
                    contador=0;
                    let selectElement = document.getElementById('select_comp_names');
                    let selectedValues = Array.from(selectElement.selectedOptions).map(option => option.value);
                    console.log(selectedValues);
                    dato=1;
                    var cant=0;
                    var indi=0;
                    for(var i=0;i<ind_id.length;i++)
                    {
                        
                        if(indi!=ind_id[i])
                        {
                            indi=ind_id[i];
                            cant++;
                        }
                    }
                    console.log(cant);
                    var found=0;
                    for(var h=1;h<=cant;h++)
                    {
                        found=0;
                        while(ind_id[contador]==dato)
                        {
                            dato=ind_id[contador];
                            
                            
                            for(var i=0;i<selectedValues.length;i++)
                            {
                                var pos=0;
                                for (var j=0;j<companias.length;j++)
                                {
                                    if(companias[j]==selectedValues[i])
                                    {
                                        //pos=companias.indexOf(selectedValues[i],pos);
                                        if(inf_companias[j]==inf_ind[contador])
                                        {
                                            found++;
                                        }
                                    }
                                }
                            }
                            contador++; 
                        }
                        if((found==(selectedValues.length*ind_cond[h])) && (found!=0))
                        {
                            const select=document.querySelector("#indi_names");
                            select.insertAdjacentHTML("beforeend", `<option value='${h}'>${ind_name[h-1]}</option>`);
                            $(document).ready(function(){
                                $('#indi_names').formSelect();
                            });
                        }
                        dato++;


                    }
                }
                function addIndAnalysis()
                {
                    let selectElement = document.getElementById('indi_names');
                    let selectedValues = Array.from(selectElement.selectedOptions).map(option => option.value);

                    let selectComp = document.getElementById('select_comp_names');
                    let selectedComp = Array.from(selectComp.selectedOptions).map(option => option.value);
                    if(selectedValues.length>0)
                    {
                        $.post("analysis_CO/addAnalysis",function(respuesta)
                        {
                            //alert(respuesta);
                            //alert(entra);
                        })
                        let string=$('#form_indi_comp').serialize();
                        $.post('analysis_CO/addCompAnalysis',string,function(respuesta)
                        {
                            //alert(respuesta);
                        })
                        var indi_id="";
                        var indicador_id="";
                        var comp_names_selected=`${selectedComp[0]}`;
                        var cant_inf=0;
                        for(var i=0;i<selectedValues.length;i++)
                        {
                            indicador_id=indicador_id+`(${selectedValues[i]})`+",";
                            for(var j=0;j<ind_id.length;j++)
                            {
                                if(ind_id[j]==selectedValues[i])
                                {
                                    if(indi_id.indexOf(inf_ind[j])==(-1))
                                    {
                                        indi_id=indi_id+inf_ind[j]+",";
                                        cant_inf++;
                                    }
                                }
                            }
                        }
                        indi_id=indi_id.slice(0, -1);
                        indicador_id=indicador_id.slice(0, -1);
                        $.post('analysis_CO/addIndAnalysis',{indi_names:indi_id,comp_names:selectedComp,cant_comp:selectedComp.length,cant_inf:cant_inf,indicador_id:indicador_id},function(respuesta)
                        {
                            $('#script').html(respuesta);
                        });
                        
                    }
                    else
                    {
                        M.toast({html: 'Debe seleccionar una compañia y un análisis minimo'});
                    }
                }
            </script>
            <script id="script"></script>
            <script src="dist/js/indicators.js"></script>
            <?php
        }
        function showCharts()
        {
            $connect=new connect('client');
            $analysis_MO=new analysis_MO($connect);
            $indicador=$analysis_MO->showChartsInd($_SESSION['anali_id']);
            $valores=$analysis_MO->showCharts($_SESSION['anali_id']);
            $array2=$analysis_MO->analy_name($_SESSION['user_id'],$_SESSION['anali_id']);
            ?>
            <br>
            <div  class="container">
                <a class="btn-floating  waves-effect waves-light light-blue darken-2" onclick="pages('analysis_VI/show')"><i class="material-icons">arrow_back</i></a>
            </div>
            <div class="container">
                <div class="col s12">
                    <h2><?php echo($array2[0]->anali_name) ?></h2>
                </div>
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

            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="dist/js/buttons.js"></script>
            <script>
                
                <?php
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
                ?>
            </script>
            <?php
        }
    }
?>