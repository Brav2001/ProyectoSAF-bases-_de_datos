<?php
    class company_MO
    {
        private $connect;
        function __construct($connect)
        {
            $this->connect=$connect;
        }

        function show($user)
        {
            
            $sql="select comp_id,comp_name,comp_date_create,comp_date_update from proyecto.companias where user_id='$user' order by comp_id;";
            $this->connect->out($sql);
            return $this->connect->extract(); 
        }
        function deleteEmpty($comp_id,$user_id)
        {
            
            $sql="delete from proyecto.companias where comp_id='$comp_id' and user_id='$user_id' ;";
            $this->connect->out($sql);
            return $this->connect->extract(); 
        }
        function formAdd()
        {
            $sql="select * from proyecto.inf_financiera;";
            $this->connect->out($sql);
            return $this->connect->extract();

        }
        function consultName($user,$company_name)
        {
            $sql="select comp_id from proyecto.companias where user_id='$user' and comp_name='$company_name';";
            $this->connect->out($sql);
            return $this->connect->extract();
        }

        function addCompany($user,$company_name,$current_date)
        {
            
            $array=$this->consultName($user,$company_name);
            if($array)
            {
                return false;
            }
            else
            {
                $sql="insert into proyecto.companias(comp_id,user_id,comp_name,comp_date_create,comp_date_update) values(default,'$user','$company_name','$current_date','$current_date');";
                $this->connect->out($sql);
                $sql="select comp_id from proyecto.companias where user_id='$user' and comp_name='$company_name'; ";
                $this->connect->out($sql);
                return $this->connect->extract();
                
            }
            
        }

        function compName($user,$id)
        {
            $sql="select comp_name from proyecto.companias where user_id='$user' and comp_id='$id';";
            $this->connect->out($sql);
            return $this->connect->extract();
        }

        function addInff($id,$inff_id,$year1,$year2,$year3,$year4,$year5)
        {
            $sql="insert into proyecto.companias_inf_financiera(compinff_id,comp_id,inff_id,time_id,valor) 
            values(default,'$id','$inff_id',1,'$year1'),
            (default,'$id','$inff_id',2,'$year2'),
            (default,'$id','$inff_id',3,'$year3'),
            (default,'$id','$inff_id',4,'$year4'),
            (default,'$id','$inff_id',5,'$year5');";
            $this->connect->out($sql);
        }
        function upInff($id,$inff_id,$year1,$year2,$year3,$year4,$year5)
        {
            $sql="update proyecto.companias_inf_financiera set valor='$year1' where comp_id='$id' and inff_id='$inff_id' and time_id=1;";
            $this->connect->out($sql);
            $sql="update proyecto.companias_inf_financiera set valor='$year2' where comp_id='$id' and inff_id='$inff_id' and time_id=2;";
            $this->connect->out($sql);
            $sql="update proyecto.companias_inf_financiera set valor='$year3' where comp_id='$id' and inff_id='$inff_id' and time_id=3;";
            $this->connect->out($sql);
            $sql="update proyecto.companias_inf_financiera set valor='$year4' where comp_id='$id' and inff_id='$inff_id' and time_id=4;";
            $this->connect->out($sql);
            $sql="update proyecto.companias_inf_financiera set valor='$year5' where comp_id='$id' and inff_id='$inff_id' and time_id=5;";
            $this->connect->out($sql);
        }
        function modCompInf($comp_id)
        {
            $sql="select distinct inff_id from proyecto.companias_inf_financiera where comp_id='$comp_id';";
            $this->connect->out($sql);
            $array=$this->connect->extract();
            $contador=0;
            $dato=0;
            $sql="select * from proyecto.inf_financiera where inff_id in (";
            while($contador<count($array))
            {
                $dato=$array[$contador]->inff_id;
                $sql=$sql."$dato,";
                $contador++;
            }
            $sql=substr($sql, 0, -1);
            $sql=$sql.");";
            $this->connect->out($sql);
            return $this->connect->extract();
        }
        function modComp_Inf($comp_id)
        {
            $sql="select valor from proyecto.companias_inf_financiera where comp_id='$comp_id' order by inff_id,time_id;";
            $this->connect->out($sql);
            return $this->connect->extract();
        }
        function modCompany($comp_id,$current_date)
        {
            $sql="UPDATE proyecto.companias SET comp_date_update='$current_date' WHERE comp_id='$comp_id';";
            $this->connect->out($sql);
        }
    }
?>