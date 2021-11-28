<?php
    class front_controller
    {
        
        function __construct($url)
        {

            if(empty($url))
            {
                $folder="view";
                $file="dashboard.php";
                $class="dashboard";
                $method="app";
            }
            else
            {
                $array_url=explode('/',$url);
                $class=$array_url[0];
                $method=$array_url[1];
                $file=$class.".php";
                $suffix=substr($class,-2);
                if($suffix=="CO")
                {
                    $folder="controllers";
                }
                else if($suffix=="VI")
                {
                    $folder="view";
                }
                
            }
            require_once "$folder/$file";
            $obj= new $class();
            $obj->$method();
            
        }
    }
?>