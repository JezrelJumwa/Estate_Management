<?php
    
    class module{
        function loadPage(){
            global $pg;
          //  $val=null;
            
            switch($pg){
				case 01:
					$val       =  $this->forms('register');
					break;
				case 02:
					$val       = $this->lists('users');
					break;
				case 03:
					$val       = $this->forms('houses');
					break;
				case 04:
					$val       = $this->lists('houselist');
					break;
				case 05:
                                        $val        = $this->forms('estate');
					break;
				case 06:
					$val       = $this->lists('estatelist');
					break;
                                case 07:
                                   $val       = $this->forms('housebooking');
                                    break;
				 case 8:
				 	$val        = $this->lists('bookinglist');
				 	break;
				 case 9:
				 	$val        = $this->forms('passwordreset');
				 	break;
				 case 10:
				 	$val       = $this->lists('userdata');
				 	break;
				// case 11:
				// 	$val       = $this->forms('cash');
				// 	break;
				// case 12:
				// 	$val       = $this->forms('accounting');
				// 	break;
				default:
					$val       = $this->forms('register');
					break;
				
			}
            
            return $val;
            
        }
        
        function forms($val){
            return "forms/" . $val . ".php";
            
        }
        
        function lists($val){
            return "lists/" . $val . ".php";
            
        }
        
        function pages($val){
            return "pages/" . $val . ".php";
            
        }
        
        function reports($val){
            return "reports/" . $val . ".php";
            
        }
        
        /*function directory(){
            $page[] = $this->moduleName();
            
            $val    = "modules/" . $page[0]['md'] ."/" . $page[0]['pg'] . ".php";
            
            return $val;
            
        }
        
        function moduleName(){
            global $md;
            
            switch($md){
                case 00:
                    // Get Default Module And Page From RoleTable
                    $val['md']      = "admin";
                    $val['pg']      = $this->pageAdmin();
                    break;
                case 01:
                    $val['md']      = "admin";
                    $val['pg']      = $this->pageAdmin();
                    break;
                
            }
            
            return $val;
            
        }
        
        function pageAdmin(){
            #####################################################
            #   Function Sets The Pages For Admin Role          #
            #   This Function Is For Development Process Only   #
            #   As All The Pages Will Be Called From Db         #
            #####################################################
            
            // Get Page Value
            global $pg;
            
            // Set Page Name Depending On The Page Numeric Value
            switch($pg){
                case 00:
                    // Get Default Page From User Role Settings
                    $val            = "listRole";
                    break;
                case 01:
                    $val            = "listRole";
                    break;
                case 02:
                    $val            = "listUsers";
                    break;
                case 03:
                    $val            = "frmRole";
                    break;
                
            }
            
            return $val;
            
        }*/
        
    }
    class menu{
        function products(){
            
            
        }
        
    }