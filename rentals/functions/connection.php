<?php
    
    class conn{
        var $host           = "localhost";
        var $user           = "root";
        var $pass           = "";
        var $db             = "rentals";
        var $charset        = "utf8";
        
        function conn_open(){
            $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
            $opt = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $con            = new PDO($dsn, $this->user, $this->pass, $opt);
            
            if(!$con){
                $con        = "Error : Unable to open database \n";
            }
            
            return $con;
        }
        
        function conn_query($conn,$query){
            $val            = $this->query($query);
            
            return $val;
        }
        
        function conn_lastinsertid($conn){
            $val            = $conn->insert_id;
            
            return $val;            
        }
        
        function query($sql){
            global $conn;
            
            try{
                $result     = $conn->prepare($sql);
                $result->execute();
                $lastId     = $conn->lastInsertId();
                //$rowCount   = $result->rowCount();
                
            }catch(PDOException $exception){
                $err        = $exception->getMessage();
                $result     = "";
                //$rowCount   = 0;
                
            }
            
           // $val['result']  = $result;
            $val                = [
                                    'result' =>$result,
                                    'lastId' =>$lastId
                                    ];
            
            //$val['rowCount']= $rowCount;
            
            return $val;
            
        }
        
    }