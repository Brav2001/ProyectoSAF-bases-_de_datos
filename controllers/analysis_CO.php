<?php
    require_once "models/analysis_MO.php";
    class analysis_CO
    {
        function __construct(){}

        function checkAnalysis()
        {
            $analysis_name=$_POST['analysis_name'];
            if($analysis_name=="")
            {
                echo "dato vacio";

            }
            else{
                $connect=new connect('client');
                $analysis_MO=new analysis_MO($connect);
                $array=$analysis_MO->ConsultName($_SESSION['user_id'],$analysis_name);
                if($array)
                {
                    
                    echo "yaregistrado";
                }
                else
                {
                    $_SESSION['anali_name']=$analysis_name;
                    echo "registrado";
                }
                
            }  
        }
        function addAnalysis()
        {
            $analysis_name=$_SESSION['anali_name'];
            if($analysis_name=="")
            {
                echo "dato vacio";

            }
            else{
                $connect=new connect('client');
                $analysis_MO=new analysis_MO($connect);
                $current_date=date('d-m-Y H:i:s');
                $array=$analysis_MO->addAnalysis($_SESSION['user_id'],$analysis_name,$current_date);
                if($array)
                {
                    $_SESSION['anali_id']=$array[0]->anali_id;
                    echo "registrado";
                }
                else
                {
                    echo "yaregistrado";
                }
                
            }     
        }
        function addCompAnalysis()
        {
            $anali_id=$_SESSION['anali_id'];
            $comp_id=$_POST['select_comp_names'];
            $connect=new connect('client');
            $analysis_MO=new analysis_MO($connect);
            $contador=0;
            while($contador<count($comp_id))
            {
                $analysis_MO->addCompAnalysis($comp_id[$contador],$anali_id);
                $contador++;
            }

        }
        function addIndAnalysis()
        {
            $comp=$_POST['comp_names'];
            $ind=$_POST['indi_names'];
            $cant_comp=$_POST['cant_comp'];
            $cant_inf=$_POST['cant_inf'];
            $indicador_id=$_POST['indicador_id'];
            $connect=new connect('client');
            $analysis_MO=new analysis_MO($connect);
            $array1=$analysis_MO->consultIndAnalysis($comp,$ind,1);
            $array2=$analysis_MO->consultIndAnalysis($comp,$ind,2);
            $array3=$analysis_MO->consultIndAnalysis($comp,$ind,3);
            $array4=$analysis_MO->consultIndAnalysis($comp,$ind,4);
            $array5=$analysis_MO->consultIndAnalysis($comp,$ind,5);
            $ind_inf=$analysis_MO->ind_if();
            $contador=0;
            ?>
            <script>
                var inf_id=[];
                var data1=[];
                var data2=[];
                var data3=[];
                var data4=[];
                var data5=[];
                var year=[];
                var year2=[];
                var year3=[];
                var year4=[];
                var year5=[];
                var indi_id=[];
                var cant_comp=<?php echo $cant_comp?>;
                var cant_inf=<?php echo $cant_inf?>;
                var indicador_id="<?php echo $indicador_id?>";
                <?php
                while ($contador<count($array1))
                {
                    ?>
                    data1.push(<?php echo($array1[$contador]->valor) ?>);
                    data2.push(<?php echo($array2[$contador]->valor) ?>);
                    data3.push(<?php echo($array3[$contador]->valor) ?>);
                    data4.push(<?php echo($array4[$contador]->valor) ?>);
                    data5.push(<?php echo($array5[$contador]->valor) ?>);
                    if(!(inf_id.includes(<?php echo($array1[$contador]->inff_id)?>)))
                    {
                        inf_id.push(<?php echo($array1[$contador]->inff_id)?>);
                    }
                    <?php
                    $contador++;
                }
                $contador=0;
                while ($contador<count($ind_inf))
                {
                    ?>
                    indi_id.push(<?php echo($ind_inf[$contador]->indi_id)?>);
                    <?php
                    $contador++;
                }
                ?>
               for(var i=0;i<cant_inf;i++)
               {
                year.push(0);
                year2.push(0);
                year3.push(0);
                year4.push(0);
                year5.push(0);
               }
                
                if (cant_comp>1){
                    for(var i=0;i<cant_inf;i++)
                    {
                        
                        for(var j=0;j<cant_comp;j++)
                        {
                            // alert("year en "+i+" vale: "+year[i]+" y le suma: "+data1[i+(j*cant_inf)]+" del indice: "+(i+(j*cant_inf)));
                            year[i]=year[i]+data1[i+(j*cant_inf)];
                            year2[i]=year2[i]+data2[j*cant_inf];
                            year3[i]=year3[i]+data3[j*cant_inf];
                            year4[i]=year4[i]+data4[j*cant_inf];
                            year5[i]=year5[i]+data5[j*cant_inf];
                            // alert("ahora year vale: "+year[i]);
                             
                        }
                        year[i]=year[i]/cant_comp;
                        year2[i]=year2[i]/cant_comp;
                        year3[i]=year3[i]/cant_comp;
                        year4[i]=year4[i]/cant_comp;
                        year5[i]=year5[i]/cant_comp;  
                    } 
                }
                else
                {
                    for(var i=0;i<inf_id.length;i++)
                        {
                            year[i]=data1[i];
                            year2[i]=data2[i];
                            year3[i]=data3[i];
                            year4[i]=data4[i];
                            year5[i]=data5[i];
                        }
                }
                if(indicador_id.indexOf("(1)")!=(-1))
                {
                    //alert("entra al if del indicador");
                    var valores1=[]
                    var valores2=[]
                    var valores3=[]
                    var valores4=[]
                    var valores5=[]
                    for(var i=0;i<indi_id.length;i++)
                    {
                       //alert("entra al for");
                        if(indi_id[i]==1)
                        {
                             //alert("encuentra el indice");
                            for(var j=0;j<inf_id.length;j++)
                            {
                                //alert("entra al segundo for");
                                if(inf_id[j]==inf_ind[i])
                                {
                                   // alert("eencuentra y asigna");
                                    valores1.push(year[j]);
                                    valores2.push(year2[j]);
                                    valores3.push(year3[j]);
                                    valores4.push(year4[j]);
                                    valores5.push(year5[j]);
                                }
                            }
                            
                        }
                    }
                    for( var i=1;i<=5;i++)
                        {
                            var dato=(eval("valores"+i+"[0]")/eval("valores"+i+"[1]"));
                            dato=round(dato);
                            $.post('analysis_CO/addIndicadores',{indi_id:1,inan_valor:dato,time_id:i},function(respuesta){
                               // alert(respuesta);
                            })
                        }
                   // alert(" valor 1:"+valores1[0]);
                }
                if(indicador_id.indexOf("(2)")!=(-1))
                {
                    //alert("entra al if del indicador");
                    var valores1=[]
                    var valores2=[]
                    var valores3=[]
                    var valores4=[]
                    var valores5=[]
                    for(var i=0;i<indi_id.length;i++)
                    {
                       //alert("entra al for");
                        if(indi_id[i]==2)
                        {
                             //alert("encuentra el indice");
                            for(var j=0;j<inf_id.length;j++)
                            {
                                //alert("entra al segundo for");
                                if(inf_id[j]==inf_ind[i])
                                {
                                   // alert("eencuentra y asigna");
                                    valores1.push(year[j]);
                                    valores2.push(year2[j]);
                                    valores3.push(year3[j]);
                                    valores4.push(year4[j]);
                                    valores5.push(year5[j]);
                                }
                            }
                            
                        }
                    }
                    for( var i=1;i<=5;i++)
                        {
                            var dato=(eval("valores"+i+"[0]")-eval("valores"+i+"[1]"));
                            dato=round(dato);
                            $.post('analysis_CO/addIndicadores',{indi_id:2,inan_valor:dato,time_id:i},function(respuesta){
                                //alert(respuesta);
                            })
                        }
                    //alert(" valor 1:"+valores1[0]);
                }
                if(indicador_id.indexOf("(3)")!=(-1))
                {
                    //alert("entra al if del indicador");
                    var valores1=[]
                    var valores2=[]
                    var valores3=[]
                    var valores4=[]
                    var valores5=[]
                    for(var i=0;i<indi_id.length;i++)
                    {
                       //alert("entra al for");
                        if(indi_id[i]==3)
                        {
                             //alert("encuentra el indice");
                            for(var j=0;j<inf_id.length;j++)
                            {
                                //alert("entra al segundo for");
                                if(inf_id[j]==inf_ind[i])
                                {
                                   // alert("eencuentra y asigna");
                                    valores1.push(year[j]);
                                    valores2.push(year2[j]);
                                    valores3.push(year3[j]);
                                    valores4.push(year4[j]);
                                    valores5.push(year5[j]);
                                }
                            }
                            
                        }
                    }
                    for( var i=1;i<=5;i++)
                        {
                            var dato=((eval("valores"+i+"[1]")/eval("valores"+i+"[0]")))*100;
                            dato=round(dato);
                            $.post('analysis_CO/addIndicadores',{indi_id:3,inan_valor:dato,time_id:i},function(respuesta){
                                //alert(respuesta);
                            })
                        }
                    //alert(" valor 1:"+valores1[0]);
                }
                if(indicador_id.indexOf("(4)")!=(-1))
                {
                    //alert("entra al if del indicador");
                    var valores1=[]
                    var valores2=[]
                    var valores3=[]
                    var valores4=[]
                    var valores5=[]
                    for(var i=0;i<indi_id.length;i++)
                    {
                       //alert("entra al for");
                        if(indi_id[i]==4)
                        {
                             //alert("encuentra el indice");
                            for(var j=0;j<inf_id.length;j++)
                            {
                                //alert("entra al segundo for");
                                if(inf_id[j]==inf_ind[i])
                                {
                                   // alert("eencuentra y asigna");
                                    valores1.push(year[j]);
                                    valores2.push(year2[j]);
                                    valores3.push(year3[j]);
                                    valores4.push(year4[j]);
                                    valores5.push(year5[j]);
                                }
                            }
                            
                        }
                    }
                    for( var i=1;i<=5;i++)
                        {
                            var dato=((eval("valores"+i+"[1]")/eval("valores"+i+"[0]")))*100;
                            //alert((eval("valores"+i+"[1]")));
                            //alert(eval("valores"+i+"[0]"));
                            //alert(((eval("valores"+i+"[1]")+"/"+eval("valores"+i+"[0]")))*100);
                            //alert(dato);
                            dato=round(dato);
                            //alert(dato);
                            $.post('analysis_CO/addIndicadores',{indi_id:4,inan_valor:dato,time_id:i},function(respuesta){
                                //alert(respuesta);
                            })
                        }
                    //alert(" valor 1:"+valores1[0]);
                }
                if(indicador_id.indexOf("(5)")!=(-1))
                {
                    //alert("entra al if del indicador");
                    var valores1=[]
                    var valores2=[]
                    var valores3=[]
                    var valores4=[]
                    var valores5=[]
                    for(var i=0;i<indi_id.length;i++)
                    {
                       //alert("entra al for");
                        if(indi_id[i]==5)
                        {
                             //alert("encuentra el indice");
                            for(var j=0;j<inf_id.length;j++)
                            {
                                //alert("entra al segundo for");
                                if(inf_id[j]==inf_ind[i])
                                {
                                   // alert("eencuentra y asigna");
                                    valores1.push(year[j]);
                                    valores2.push(year2[j]);
                                    valores3.push(year3[j]);
                                    valores4.push(year4[j]);
                                    valores5.push(year5[j]);
                                }
                            }
                            
                        }
                    }
                    for( var i=1;i<=5;i++)
                        {
                            var dato=((eval("valores"+i+"[0]"))/(eval("valores"+i+"[1]")));
                            //alert((eval("valores"+i+"[0]")));
                            //alert((eval("valores"+i+"[1]")));
                            //alert(eval("valores"+i+"[0]")+"/"+eval("valores"+i+"[1]"));
                            //alert(dato);
                            dato=round(dato);
                            //alert(dato);
                            $.post('analysis_CO/addIndicadores',{indi_id:5,inan_valor:dato,time_id:i},function(respuesta){
                                //alert(respuesta);
                            })
                        }
                    //alert(" valor 1:"+valores1[0]);
                }
                if(indicador_id.indexOf("(6)")!=(-1))
                {
                    //alert("entra al if del indicador");
                    var valores1=[]
                    var valores2=[]
                    var valores3=[]
                    var valores4=[]
                    var valores5=[]
                    for(var i=0;i<indi_id.length;i++)
                    {
                       //alert("entra al for");
                        if(indi_id[i]==6)
                        {
                             //alert("encuentra el indice");
                            for(var j=0;j<inf_id.length;j++)
                            {
                                //alert("entra al segundo for");
                                if(inf_id[j]==inf_ind[i])
                                {
                                   // alert("eencuentra y asigna");
                                    valores1.push(year[j]);
                                    valores2.push(year2[j]);
                                    valores3.push(year3[j]);
                                    valores4.push(year4[j]);
                                    valores5.push(year5[j]);
                                }
                            }
                            
                        }
                    }
                    for( var i=1;i<=5;i++)
                        {
                            var dato=((eval("valores"+i+"[1]"))/(eval("valores"+i+"[0]")))*100;
                            //alert((eval("valores"+i+"[0]")));
                            //alert((eval("valores"+i+"[1]")));
                            //alert(eval("valores"+i+"[0]")+"/"+eval("valores"+i+"[1]"));
                            //alert(dato);
                            dato=round(dato);
                            //alert(dato);
                            $.post('analysis_CO/addIndicadores',{indi_id:6,inan_valor:dato,time_id:i},function(respuesta){
                                //alert(respuesta);
                            })
                        }
                    //alert(" valor 1:"+valores1[0]);
                }
                if(indicador_id.indexOf("(7)")!=(-1))
                {
                    //alert("entra al if del indicador");
                    var valores1=[]
                    var valores2=[]
                    var valores3=[]
                    var valores4=[]
                    var valores5=[]
                    for(var i=0;i<indi_id.length;i++)
                    {
                       //alert("entra al for");
                        if(indi_id[i]==7)
                        {
                             //alert("encuentra el indice");
                            for(var j=0;j<inf_id.length;j++)
                            {
                                //alert("entra al segundo for");
                                if(inf_id[j]==inf_ind[i])
                                {
                                   // alert("eencuentra y asigna");
                                    valores1.push(year[j]);
                                    valores2.push(year2[j]);
                                    valores3.push(year3[j]);
                                    valores4.push(year4[j]);
                                    valores5.push(year5[j]);
                                }
                            }
                            
                        }
                    }
                    for( var i=1;i<=5;i++)
                        {
                            var dato=((eval("valores"+i+"[1]"))/(eval("valores"+i+"[0]")))*100;
                            //alert((eval("valores"+i+"[0]")));
                            //alert((eval("valores"+i+"[1]")));
                            //alert(eval("valores"+i+"[0]")+"/"+eval("valores"+i+"[1]"));
                            //alert(dato);
                            dato=round(dato);
                            //alert(dato);
                            $.post('analysis_CO/addIndicadores',{indi_id:7,inan_valor:dato,time_id:i},function(respuesta){
                                //alert(respuesta);
                            })
                        }
                    //alert(" valor 1:"+valores1[0]);
                }
                if(indicador_id.indexOf("(8)")!=(-1))
                {
                    //alert("entra al if del indicador");
                    var valores1=[]
                    var valores2=[]
                    var valores3=[]
                    var valores4=[]
                    var valores5=[]
                    for(var i=0;i<indi_id.length;i++)
                    {
                       //alert("entra al for");
                        if(indi_id[i]==8)
                        {
                             //alert("encuentra el indice");
                            for(var j=0;j<inf_id.length;j++)
                            {
                                //alert("entra al segundo for");
                                if(inf_id[j]==inf_ind[i])
                                {
                                   // alert("eencuentra y asigna");
                                    valores1.push(year[j]);
                                    valores2.push(year2[j]);
                                    valores3.push(year3[j]);
                                    valores4.push(year4[j]);
                                    valores5.push(year5[j]);
                                }
                            }
                            
                        }
                    }
                    for( var i=1;i<=5;i++)
                        {
                            var dato=((eval("valores"+i+"[1]"))/(eval("valores"+i+"[0]")))*100;
                            //alert((eval("valores"+i+"[0]")));
                            //alert((eval("valores"+i+"[1]")));
                            //alert(eval("valores"+i+"[0]")+"/"+eval("valores"+i+"[1]"));
                            //alert(dato);
                            dato=round(dato);
                            //alert(dato);
                            $.post('analysis_CO/addIndicadores',{indi_id:8,inan_valor:dato,time_id:i},function(respuesta){
                                //alert(respuesta);
                            })
                        }
                    //alert(" valor 1:"+valores1[0]);
                }
                if(indicador_id.indexOf("(9)")!=(-1))
                {
                    //alert("entra al if del indicador");
                    var valores1=[]
                    var valores2=[]
                    var valores3=[]
                    var valores4=[]
                    var valores5=[]
                    for(var i=0;i<indi_id.length;i++)
                    {
                       //alert("entra al for");
                        if(indi_id[i]==9)
                        {
                             //alert("encuentra el indice");
                            for(var j=0;j<inf_id.length;j++)
                            {
                                //alert("entra al segundo for");
                                if(inf_id[j]==inf_ind[i])
                                {
                                   // alert("eencuentra y asigna");
                                    valores1.push(year[j]);
                                    valores2.push(year2[j]);
                                    valores3.push(year3[j]);
                                    valores4.push(year4[j]);
                                    valores5.push(year5[j]);
                                }
                            }
                            
                        }
                    }
                    for( var i=1;i<=5;i++)
                        {
                            var dato=((eval("valores"+i+"[1]"))/(eval("valores"+i+"[0]")))*100;
                            //alert((eval("valores"+i+"[0]")));
                            //alert((eval("valores"+i+"[1]")));
                            //alert(eval("valores"+i+"[0]")+"/"+eval("valores"+i+"[1]"));
                            //alert(dato);
                            dato=round(dato);
                            //alert(dato);
                            $.post('analysis_CO/addIndicadores',{indi_id:9,inan_valor:dato,time_id:i},function(respuesta){
                                //alert(respuesta);
                            })
                        }
                    //alert(" valor 1:"+valores1[0]);
                }
                function round(num) {
                    var m = Number((Math.abs(num) * 100).toPrecision(15));
                    return Math.round(m) / 100 * Math.sign(num);
                }
                //alert(indicador_id);
                console.log(data1);
                console.log(year);
                console.log(inf_id);
                M.toast({html: 'Analisis creado'});
                pages('analysis_VI/showCharts');
            </script>
            <?php
        }
        function addIndicadores()
        {
            $anali_id=$_SESSION['anali_id'];
            $indi_id=$_POST['indi_id'];
            $valor=$_POST['inan_valor'];
            $time=$_POST['time_id'];
            $connect=new connect('client');
            $analysis_MO=new analysis_MO($connect);
            $analysis_MO->addIndAnalysis($anali_id,$indi_id,$valor,$time);
        }
        function eye()
        {
            $anali_id=$_POST['id'];
            $_SESSION['anali_id']=$anali_id;
        }
    }
?>