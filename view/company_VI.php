<?php
    require_once "models/company_MO.php";
    class company_VI
    {
        function __construct(){}

        function show()
        {
            $connect=new connect('client');
            $company_MO=new company_MO($connect);
            $array=$company_MO->show($_SESSION['user_id']);
            $contador=0;

            ?>
                <div class="container">
                    <div class="cols12">
                        <h2>Compa&ntilde&iacuteas</h2>
                    </div>
                    <div class="col s12">
                    <table class="centered highlight responsive-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha de Creación</th>
                                <th>Fecha ult. modificación</th>
                                <th>Modificar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($contador<count($array)){?>
                                <tr>
                                    <td><?php echo($array[$contador]->comp_name); ?></td>
                                    <td><?php echo($array[$contador]->comp_date_create); ?></td>
                                    <td><?php echo($array[$contador]->comp_date_update); ?></td>
                                    <td><a class="btn-flat" onclick="modCompany('<?php echo($array[$contador]->comp_id);?>')"><i class="material-icons">edit</i></a> </td>
                                </tr>
                            <?php
                                $contador++;
                                }?>
                            
                        </tbody>
                    </table>
                    </div>
                    <br>
                    <div class="col s4">
                        <a class="btn tooltipped btn-floating btn-large waves-effect waves-light green teal lighten-2" data-position="right" data-tooltip="Agregar compañia" href="#" onclick="pages('company_VI/addCompany')"><i class="material-icons">add</i></a>
                        
                    </div>
                    <br>
                </div>
                <script src="dist/js/buttons.js"></script>
                <script>
                    function modCompany(comp_id)
                    {
                        $.post("company_VI/modCompany",{comp:comp_id},function(respuesta){
                            $('#content').html(respuesta);
                        })
                    }
                </script>
            <?php
        }
        function addcompany()
        {
        ?>
        <br>
            <div class="container">
                <a class="btn-floating  waves-effect waves-light light-blue darken-2" onclick="pages('company_VI/show')"><i class="material-icons">arrow_back</i></a>
            </div>
            <div class="container">
                <div class="row">
                    <form id="addCompany">
                    <div class=" col s12 input-field">
                                <input id="company_name" name="company_name" type="text" data-length="100" class="validate" >
                                <label for="company_name">Nombre de la compañia:</label>
                    </div>
                    <div class="right-align">
                                <button class=" btn  waves-effect waves-light light-blue darken-2" type="button" name="action" onclick="addCompany()" >Guardar
                                    <i class="material-icons right">save</i>
                                </button>
                                <br>
                    </div>
                    </form>
                </div>
            </div>
            <script>
                function addCompany()
                {
                    let string=$('#addCompany').serialize();
                    $.post('company_CO/addCompany',string,function(respuesta)
                    {
                        if((respuesta=="registrado"))
                        {
                            pages("company_VI/addInff");
                        }
                        else if((respuesta=="yaregistrado"))
                        {
                            M.toast({html: 'Esta compañia ya existe'});
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
        function addInff()
        {
            $connect=new connect('client');
            $company_MO=new company_MO($connect);
            $array=$company_MO->formAdd();
            $array2=$company_MO->compName($_SESSION['user_id'],$_SESSION['comp_id']);
            
            $contador=0;
            ?>
            
            <div class="container">
                <div class="row">
                    <div class=" col s12 input-field">
                        <label>Nombre de la compañia:</label>
                        <br>
                        <input disabled value="<?php echo($array2[0]->comp_name);?>" id="disabled" name="company_name" type="text" class="validate" >
                        
                    </div>
                    <br>
                    <form id="addInff">
                    <div class="col s12  input-field">
                        <select name="inff_id" id="inf_company">
                            <option value="" disabled selected>Escoja la opción</option>
                            <?php while($contador<count($array)){?>
                            <option value="<?php echo($array[$contador]->inff_id) ?>"><?php echo($array[$contador]->inff_name) ?></option>
                            <?php
                                $contador++; 
                            }?>    
                        </select>
                        <label>Información financiera</label>
                    </div>
                    <div class=" col s12 m2 input-field">
                        <input placeholder="" name="year_1" type="number" step="0.0001" class="validate" id="year_1">
                        <label for="year_1" >2016:</label>
                    </div>
                    <div class=" col s12 m2 input-field">
                        <input placeholder="" name="year_2" type="number" step="0.0001" class="validate" id="year_2" >
                        <label for="year_2" >2017:</label>
                    </div>
                    <div class=" col s12 m2 input-field">
                        <input placeholder=""name="year_3" type="number" step="0.0001" class="validate" id="year_3">
                        <label for="year_3">2018:</label>
                    </div>
                    <div class=" col s12 m2 input-field">
                        <input placeholder=""name="year_4" type="number" step="0.0001" class="validate" id="year_4">
                        <label for="year_4">2019:</label>
                    </div>
                    <div class=" col s12 m2 input-field">
                        <input placeholder=""name="year_5" type="number" step="0.0001" class="validate" id="year_5">
                        <label for="year_5">2020:</label>
                    </div>
                    </div>
                    </form>
                    <div class="right-align">
                        
                        <button  class=" btn  waves-effect waves-light light-blue darken-2"  name="action" onclick="add()" data-target="modal1" >Guardar
                            <i class="material-icons right">save</i>
                        </button>
                        <br>
                    </div>
                    <div class="col s12">
                        <table class="responsive-table centered highlight">
                            <thead>
                                <th>Información financiera</th>
                                <th>2016</th>
                                <th>2017</th>
                                <th>2018</th>
                                <th>2019</th>
                                <th>2020</th>
                                <th>Editar</th>
                                
                            </thead>
                            <tbody id="table1">

                            </tbody>
                        </table>
                    </div>
                    <div class="right-align">
                        <br>
                        <button  class=" btn waves-effect waves-light light-blue darken-2"  onclick="endCompany()" name="action" >Terminar
                            <i class="material-icons right">save</i>
                        </button>
                        <br>
                    </div>
                    <div id="modal1" class="modal">
                        <div class="modal-content">
                        <h4 class="red-text ">Advertencia</h4>
                        <p>Los valores de la información financiera <span id="name">hjkjh</span> ya fueron registrados.</p><p><strong>¿Desea reemplazarlos?</strong></p>
                        </div>
                        <div class="modal-footer">
                            <a  class="modal-close waves-effect waves-green btn-flat" onclick="update()">Aceptar</a>
                            <a  class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
                        </div>
                    </div>
                    <br>
                <div>

            </div>
           
            <script src="dist/js/forms.js"></script>
            <script src="dist/js/addCompany.js"></script>

            <?php
        }
    
        function modCompany()
        {
            $comp_id=$_POST['comp'];
        
            $connect=new connect('client');
            $company_MO=new company_MO($connect);
            $array=$company_MO->formAdd();
            $array2=$company_MO->compName($_SESSION['user_id'],$comp_id);
            $array3=$company_MO->modCompInf($comp_id);
            $array4=$company_MO->modComp_Inf($comp_id);
            $contador=0;
                ?>
                <br>
                <div class="container" >
                    <a class="btn-floating  waves-effect waves-light light-blue darken-2" onclick="pages('company_VI/show')"><i class="material-icons">arrow_back</i></a>
                </div>
                <div class="container">
                    <div class="row">
                        <div class=" col s12 input-field">
                            <label>Nombre de la compañia:</label>
                            <br>
                            <input disabled value="<?php echo($array2[0]->comp_name);?>" id="disabled" name="company_name" type="text" class="validate" >
                            
                        </div>
                        <br>
                        <form id="mod_addInff">
                        <div class="col s12  input-field">
                            <select name="inff_id" id="mod_inf_company">
                                <option value="" disabled selected>Escoja la opción</option>
                                <?php while($contador<count($array)){?>
                                <option value="<?php echo($array[$contador]->inff_id) ?>"><?php echo($array[$contador]->inff_name) ?></option>
                                <?php
                                    $contador++; 
                                }?>    
                            </select>
                            <label>Información financiera</label>
                        </div>
                        <div class=" col s12 m2 input-field">
                            <input placeholder="" name="year_1" type="number" step="0.0001" class="validate" id="mod_year_1">
                            <label for="mod_year_1" >2016:</label>
                        </div>
                        <div class=" col s12 m2 input-field">
                            <input placeholder="" name="year_2" type="number" step="0.0001" class="validate" id="mod_year_2" >
                            <label for="mod_year_2" >2017:</label>
                        </div>
                        <div class=" col s12 m2 input-field">
                            <input placeholder=""name="year_3" type="number" step="0.0001" class="validate" id="mod_year_3">
                            <label for="mod_year_3">2018:</label>
                        </div>
                        <div class=" col s12 m2 input-field">
                            <input placeholder=""name="year_4" type="number" step="0.0001" class="validate" id="mod_year_4">
                            <label for="mod_year_4">2019:</label>
                        </div>
                        <div class=" col s12 m2 input-field">
                            <input placeholder=""name="year_5" type="number" step="0.0001" class="validate" id="mod_year_5">
                            <label for="mod_year_5">2020:</label>
                        </div>
                        </div>
                        </form>
                        <div class="right-align">
                            
                            <button  class=" btn  waves-effect waves-light light-blue darken-2"  name="action" onclick=" mod_add()" data-target="modal2" >Guardar
                                <i class="material-icons right">save</i>
                            </button>
                            <br>
                        </div>
                        <div class="col s12">
                            <table class="responsive-table centered highlight">
                                <thead>
                                    <th>Información financiera</th>
                                    <th>2016</th>
                                    <th>2017</th>
                                    <th>2018</th>
                                    <th>2019</th>
                                    <th>2020</th>
                                    <th>Editar</th>
                                    
                                </thead>
                                <tbody id="mod_table1">
                                    <?php
                                    $contador=0;
                                    $contador2=0;
                                    while($contador<count($array3))
                                    {
                                        ?>
                                        <tr id="l1<?php echo($array3[$contador]->inff_id)?>">
                                            <td><?php echo($array3[$contador]->inff_name)?></td>
                                            <td><?php $var1=$array4[$contador2]->valor;
                                            echo($var1); $contador2++;?></td>
                                            <td><?php $var2=$array4[$contador2]->valor;
                                            echo($var2); $contador2++;?></td>
                                            <td><?php $var3=$array4[$contador2]->valor;
                                            echo($var3); $contador2++;?></td>
                                            <td><?php $var4=$array4[$contador2]->valor;
                                            echo($var4); $contador2++;?></td>
                                            <td><?php $var5=$array4[$contador2]->valor;
                                            echo($var5); $contador2++;?></td>
                                            <td><a class="btn-flat" onclick="mod_mod(<?php echo($array3[$contador]->inff_id)?>,<?php echo($var1);?>,<?php echo($var2);?>,<?php echo($var3);?>,<?php echo($var4);?>,<?php echo($var5);?>)"><i class="material-icons">edit</i></a> </td></td>
                                        </tr>
                                        <?php
                                        $contador++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="right-align">
                            <br>
                            <button  class=" btn waves-effect waves-light light-blue darken-2"  onclick=" mod_endCompany()" name="action" >Terminar
                                <i class="material-icons right">save</i>
                            </button>
                            <br>
                        </div>
                        <div id="modal2" class="modal">
                            <div class="modal-content">
                            <h4 class="red-text ">Advertencia</h4>
                            <p>Los valores de la información financiera <span id="name"></span> ya fueron registrados.</p><p><strong>¿Desea reemplazarlos?</strong></p>
                            </div>
                            <div class="modal-footer">
                                <a  class="modal-close waves-effect waves-green btn-flat" onclick=" mod_update()">Aceptar</a>
                                <a  class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
                            </div>
                        </div>
                        <br>
                    <div>

                </div>
            
                <script src="dist/js/forms.js"></script>
                <script>
                    var mod_inf_financiera=[];
                    var  comp_id='<?php echo($comp_id)?>';
                    <?php
                    $contador=0;
                    while($contador<count($array3))
                    {
                        ?>
                        mod_inf_financiera.push(<?php echo($array3[$contador]->inff_id)?>);
                        <?php
                        $contador++;
                    } 
                    ?>

                    function mod_add()
                    {
                        let input_inf=document.getElementById("mod_inf_company").value;
                        let input_year_1=document.getElementById("mod_year_1").value;
                        let input_year_2=document.getElementById("mod_year_2").value;
                        let input_year_3=document.getElementById("mod_year_3").value;
                        let input_year_4=document.getElementById("mod_year_4").value;
                        let input_year_5=document.getElementById("mod_year_5").value;
                        let busqueda=parseInt(input_inf);
                        var combo = document.getElementById("mod_inf_company");
                        var selected = combo.options[combo.selectedIndex].text;
                        if((input_inf=="") || (input_year_1=="" || input_year_1=="0") || (input_year_2=="" || input_year_2=="0") || (input_year_3=="" || input_year_3=="0") || (input_year_4=="" || input_year_4=="0") || (input_year_5=="" || input_year_5=="0") )
                        {
                            M.toast({html: 'Existen campos vacios'});
                        }
                        else if(mod_inf_financiera.find(element => element == busqueda)){
                            
                            document.getElementById("name").innerHTML = selected;
                            $(document).ready(function(){
                                $('.modal').modal();
                                $('#modal2').modal('open');
                            });
                            
                        }
                        else
                        {
                            $.post("company_CO/modCompany",{comp:comp_id},function(respuesta){});
                            mod_inf_financiera.push(parseInt(input_inf));
                            M.toast({html: 'Información registrada'});
                            const table=document.querySelector("#mod_table1");
                            //let string=$("#mod_addInff").serialize();
                            $.post("company_CO/modaddInff",{comp_id:comp_id,mod_inff_id:input_inf,mod_year_1:input_year_1,mod_year_2:input_year_2,mod_year_3:input_year_3,mod_year_4:input_year_4,mod_year_5:input_year_5},function(){});
                            table.insertAdjacentHTML("afterbegin", `<tr id=l1${input_inf}><td>${selected}</td><td>${input_year_1}</td><td>${input_year_2}</td><td>${input_year_3}</td><td>${input_year_4}</td><td>${input_year_5}</td><td><a class="btn-flat" onclick=" mod_mod(${input_inf},${input_year_1},${input_year_2},${input_year_3},${input_year_4},${input_year_5})"><i class="material-icons">edit</i></a> </td></tr>`);
                            
                               
                        }
                        
                    }

                    function mod_update()
                    {
                        $(document).ready(function(){
                            $('.modal').modal();
                            $('#modal2').modal('close');
                        });
                        $.post("company_CO/modCompany",{comp:comp_id},function(){});
                        //let string=$("#addInff").serialize();
                        let input_inf=document.getElementById("mod_inf_company").value;
                        let input_year_1=document.getElementById("mod_year_1").value;
                        let input_year_2=document.getElementById("mod_year_2").value;
                        let input_year_3=document.getElementById("mod_year_3").value;
                        let input_year_4=document.getElementById("mod_year_4").value;
                        let input_year_5=document.getElementById("mod_year_5").value;
                        $.post("company_CO/modupInff",{comp_id:comp_id,mod_inff_id:input_inf,mod_year_1:input_year_1,mod_year_2:input_year_2,mod_year_3:input_year_3,mod_year_4:input_year_4,mod_year_5:input_year_5},function(){});
                        
                        var combo = document.getElementById("mod_inf_company");
                        var selected = combo.options[combo.selectedIndex].text;
                        const tr =document.querySelector("#l1"+input_inf);
                        tr.innerHTML=`<td>${selected}</td><td>${input_year_1}</td><td>${input_year_2}</td><td>${input_year_3}</td><td>${input_year_4}</td><td>${input_year_5}</td><td><a class="btn-flat" onclick=" mod_mod(${input_inf},${input_year_1},${input_year_2},${input_year_3},${input_year_4},${input_year_5})"><i class="material-icons">edit</i></a> </td>`;
                        M.toast({html: 'Información actualizada'});
                        
                    }
                    function mod_endCompany()
                    {
                        
                        while(mod_inf_financiera.length) {
                            mod_inf_financiera.pop();
                        }
                        M.toast({html: 'Información enviada'});
                        pages('company_VI/show');
                    }
                    function mod_mod(id,year_1,year_2,year_3,year_4,year_5)
                    {
                        M.toast({html: "Ingrese los nuevos valores y pulse el boton 'GUARDAR'"});
                        document.getElementById("mod_inf_company").value =id;
                        $(document).ready(function(){
                            $('select').formSelect();
                        });
                        document.getElementById("mod_year_1").value =year_1;
                        document.getElementById("mod_year_2").value =year_2;
                        document.getElementById("mod_year_3").value =year_3;
                        document.getElementById("mod_year_4").value =year_4;
                        document.getElementById("mod_year_5").value =year_5;
                    }
                </script>

            <?php

        }
    }
?>