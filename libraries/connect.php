<?php
    class connect
    {
        private $link;
        private $result;
        function __construct($user)
        {
            $server=SERVER;
            $dbname=DBNAME;
            $port=PORT;
            if($user=="client")
            {
                $user=DBUSER_CLIENT_NAME;
                $password=DBUSER_CLIENT_PASSWORD;
            }
            else
            {
                echo "usuario denegado";
            }
            try {
                $this->link = new PDO("pgsql:host=$server;port=$port;dbname=$dbname", $user, $password);
                $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                echo "Ocurrió un error con la base de datos: " . $e->getMessage();
            }
        }

        function out($sql)
        {
            $this->result=$this->link->query($sql);
            
        }

        function extract_log_in()
        {
            $array=array();
            if($this->result){
                $array=$this->result->fetchAll(PDO::FETCH_OBJ);
                $id=$array[0]->acce_id;
                $sql="select user_id from proyecto.usuario where acce_id='$id';";
                $this->out($sql);
            }
            return  $this->result->fetchAll(PDO::FETCH_OBJ);
        }

        function extract()
        {
            return $this->result->fetchAll(PDO::FETCH_OBJ);
        }
    }
?>