<?php
    class analysis_MO
    {
        private $connect;
        function __construct($connect)
        {
            $this->connect=$connect;
        }
        function show($user)
        {
            $sql="select anali_id,anali_name,analy_date_create,analy_date_update from proyecto.analisis where user_id='$user';";
            $this->connect->out($sql);
            return $this->connect->extract(); 
        }
        function consultName($user,$analysis_name)
        {
            $sql="select anali_id from proyecto.analisis where user_id='$user' and anali_name='$analysis_name';";
            $this->connect->out($sql);
            return $this->connect->extract();
        }

        function addAnalysis($user,$analysis_name,$current_date)
        {
            
            $array=$this->consultName($user,$analysis_name);
            if($array)
            {
                return false;
            }
            else
            {
                $sql="insert into proyecto.analisis(anali_id,user_id,anali_name,analy_date_create,analy_date_update) values(default,'$user','$analysis_name','$current_date','$current_date');";
                $this->connect->out($sql);
                $sql="select anali_id from proyecto.analisis where user_id='$user' and anali_name='$analysis_name'; ";
                $this->connect->out($sql);
                return $this->connect->extract();
                
            }
            
        }
        function comp_names($user)
        {
            $sql="select comp_name,comp_id from proyecto.companias where user_id='$user';";
            $this->connect->out($sql);
            return $this->connect->extract();
        }
        function comp_inf($user)
        {
            $comp_id=substr($user,5);
            $comp_id=$comp_id.'%';
            $sql="select comp_id, inff_id FROM PROYECTO.COMPANIAS_INF_FINANCIERA where time_id=1 and comp_id like('$comp_id');";
            $this->connect->out($sql);
            return $this->connect->extract();
        }
        function ind_if()
        {
            $sql="select indi_id,inff_id from proyecto.inf_financiera_indicadores;";
            $this->connect->out($sql);
            return $this->connect->extract();
        }
        function analy_name($user,$id)
        {
            $sql="select anali_name from proyecto.analisis where user_id='$user' and anali_id='$id';";
            $this->connect->out($sql);
            return $this->connect->extract();
        }
        function ind_name()
        {
            $sql="select indi_name from proyecto.indicadores;";
            $this->connect->out($sql);
            return $this->connect->extract();
        }
        function consultIndAnalysis($comp,$ind,$time)
        {
            $contador=0;
            $sql="select inff_id,valor from proyecto.companias_inf_financiera where comp_id in (";
            while($contador<count($comp))
            {
                $sql=$sql."'$comp[$contador]',";
                $contador++;
            }
            $sql=substr($sql, 0, -1);
            $sql=$sql.") and inff_id in ($ind) and time_id=$time order by inff_id,time_id;";
            $this->connect->out($sql);
            return $this->connect->extract();
        }
        function addCompAnalysis($comp_id,$anali_id)
        {
            $sql="INSERT INTO proyecto.companias_analisis(coan_id,comp_id,anali_id)
            VALUES(DEFAULT,'$comp_id','$anali_id');";
            $this->connect->out($sql);
        }
        function addIndAnalysis($anali_id,$indi_id,$valor,$time)
        {
            
            $sql="INSERT INTO PROYECTO.INDICADORES_ANALISIS(inan_id,anali_id,indi_id,inan_valor,time_id)
            VALUES(DEFAULT,'$anali_id','$indi_id','$valor','$time');";
            $this->connect->out($sql);

        }
        function showChartsInd($anali_id)
        {
            $sql="select distinct indi_id from proyecto.indicadores_analisis where anali_id='$anali_id';";
            $this->connect->out($sql);
            $array=$this->connect->extract();
            $sql="select indi_name from proyecto.indicadores where indi_id in (";
            $contador=0;
            $valor=0;
            while($contador<count($array))
            {
                
                $valor=$array[$contador]->indi_id;
                $sql=$sql."$valor,";
                $contador++;
            }
            $sql=substr($sql, 0, -1);
            $sql=$sql.");";
            $this->connect->out($sql);
            return $this->connect->extract();
        }
        function showCharts($anali_id)
        {
            $sql="select inan_valor from proyecto.indicadores_analisis where anali_id='$anali_id' order by indi_id,time_id; ";
            $this->connect->out($sql);
            return $this->connect->extract();
        }
        function analy_id($user)
        {
            $sql="select t1.anali_id from proyecto.analisis  t1 inner join proyecto.indicadores_analisis t2 on t1.anali_id=t2.anali_id and t1.user_id='$user'	order by t1.analy_date_update desc limit 1;";
            $this->connect->out($sql);
            return $this->connect->extract();
            
        }
    }
?>