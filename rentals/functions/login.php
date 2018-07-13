<?php
    class login{
        function uid(){
            if(isset($_SESSION["RentalsUid"]) && $_SESSION["RentalsUid"] !== ""){
                $val    = $_SESSION["RentalsUid"];
                
            }else{
                $val    = "";
                
            }
            
            return $val;
            
        }
        
        function usernames(){
            if(isset($_SESSION["RentalsFName"]) && $_SESSION["RentalsFName"] !== ""){
                $val    = $_SESSION['RentalsFName'] . " " . substr($_SESSION['RentalsLName'] , 0, 20);
                
            }else{
                $val    = "";
                
            }
            
            return $val;
            
        }
        
        function userRole(){
            if(isset($_SESSION["RentalsRoleId"]) && $_SESSION["RentalsRoleId"] !== ""){
                $val    = $_SESSION['RentalsRoleId'];
                
            }else{
                $val    = "";
                
            }
            
            return $val;
            
        }
        
    }
    