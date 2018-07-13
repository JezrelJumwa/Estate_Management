<?php
    
    class site{
        function page(){
            if(isset($_GET['pg']) && $_GET['pg'] !== ""){
                $val    = $_GET['pg'];
            }else{
                $val    = 00;
            }
            
            return $val;
            
        }
        
        function main(){
            if(isset($_GET['mn']) && $_GET['mn'] !== ""){
                $val    = $_GET['mn'];
            }else{
                $val    = 00;
            }
            
            return $val;
            
        }
        
        function client(){
            if(isset($_GET['cl']) && $_GET['cl'] !== ""){
                $val    = $_GET['cl'];
            }else{
                $val    = 00;
            }
            
            return $val;
            
        }
        
        function client_group(){
            if(isset($_GET['cg']) && $_GET['cg'] !== ""){
                $val    = $_GET['cg'];
            }else{
                $val    = 00;
            }
            
            return $val;
            
        }
               
        function role(){
            if(isset($_GET['rl']) && $_GET['rl'] !== ""){
                $val    = $_GET['rl'];
            }else{
                $val    = 00;
            }
            
            return $val;
            
        }
        
        function action(){
            if(isset($_GET['ac']) && $_GET['ac'] !== ""){
                $val    = $_GET['ac'];
            }else{
                $val    = 00;
            }
            
            return $val;
            
        }
        
        function value(){
            if(isset($_GET['vl']) && $_GET['vl'] !== ""){
                $val    = $_GET['vl'];
            }else{
                $val    = 01;
            }
            
            return $val;
            
        }
        
        function data(){
            if(isset($_GET['dt']) && $_GET['dt'] !== ""){
                $val    = $_GET['dt'];
            }else{
                $val    = 01;
            }
            
            return $val;
            
        }
        
        function logout(){
            if(isset($_GET['logout']) && $_GET['logout'] !== ""){
                $val    = $_GET['logout'];
            }else{
                $val    = "";
            }
            
            return $val;
            
        }
        
    }
    