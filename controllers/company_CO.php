<?php

require_once "models/company_MO.php";
    class company_CO
    {
        function __construct()
        {
            
        }
        function addCompany()
        {
            $company_name=$_POST['company_name'];
            if($company_name=="")
            {
                echo "dato vacio";

            }
            else{
                $connect=new connect('client');
                $company_MO=new company_MO($connect);
                $current_date=date('d-m-Y H:i:s');
                $array=$company_MO->addCompany($_SESSION['user_id'],$company_name,$current_date);
                if($array)
                {
                    $_SESSION['comp_id']=$array[0]->comp_id;
                    echo "registrado";
                }
                else
                {
                    echo "yaregistrado";
                }
                
            }        
        }
        function deleteEmpty()
        {
            $comp_id=$_SESSION['comp_id'];
            $user_id=$_SESSION['user_id'];
            $connect=new connect('client');
            $company_MO=new company_MO($connect);
            $company_MO->deleteEmpty($comp_id,$user_id);
        }
        function addInff()
        {
            $year1=$_POST['year_1'];
            $year2=$_POST['year_2'];
            $year3=$_POST['year_3'];
            $year4=$_POST['year_4'];
            $year5=$_POST['year_5'];
            $inff_id=$_POST['inff_id'];
            $connect= new connect ('client');
            $company_MO=new company_MO($connect);
            $company_MO->addInff($_SESSION['comp_id'],$inff_id,$year1,$year2,$year3,$year4,$year5);


        }
        function upinff()
        {
            $year1=$_POST['year_1'];
            $year2=$_POST['year_2'];
            $year3=$_POST['year_3'];
            $year4=$_POST['year_4'];
            $year5=$_POST['year_5'];
            $inff_id=$_POST['inff_id'];
            $connect= new connect ('client');
            $company_MO=new company_MO($connect);
            $company_MO->upInff($_SESSION['comp_id'],$inff_id,$year1,$year2,$year3,$year4,$year5);
        }
        function modaddInff()
        {
            $year1=$_POST['mod_year_1'];
            $year2=$_POST['mod_year_2'];
            $year3=$_POST['mod_year_3'];
            $year4=$_POST['mod_year_4'];
            $year5=$_POST['mod_year_5'];
            $inff_id=$_POST['mod_inff_id'];
            $comp_id=$_POST['comp_id'];
            $connect= new connect ('client');
            $company_MO=new company_MO($connect);
            $company_MO->addInff($comp_id,$inff_id,$year1,$year2,$year3,$year4,$year5);
        }
        function modupInff()
        {
            $year1=$_POST['mod_year_1'];
            $year2=$_POST['mod_year_2'];
            $year3=$_POST['mod_year_3'];
            $year4=$_POST['mod_year_4'];
            $year5=$_POST['mod_year_5'];
            $inff_id=$_POST['mod_inff_id'];
            $comp_id=$_POST['comp_id'];
            $connect= new connect ('client');
            $company_MO=new company_MO($connect);
            $company_MO->upInff($comp_id,$inff_id,$year1,$year2,$year3,$year4,$year5);
        }
        function modCompany()
        {
            
            $comp_id=$_POST['comp'];
            $current_date=date('d-m-Y H:i:s');
            $connect= new connect ('client');
            $company_MO=new company_MO($connect);
            $company_MO->modCompany($comp_id,$current_date);
        }
    }
?>