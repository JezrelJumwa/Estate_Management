<?php
    
    session_start();
    
    $change_pass            = 0;
    $msg                    = "";
    $sysPassw               = "";
    
    if(isset($_POST['frmName']) && $_POST['frmName'] == "frmLogin" && $_POST['txtHumanCode'] == "4r37061noo"){
        $userName           = $_POST['txtUName'];
        $userPass           = md5($_POST['txtPasswd']);
        
        $userError          = "";
        
        $getUserDetails     = "SELECT `systemusers`.`SystemUserId` AS `SystemUserId`,`systemusers`.`IdNumber` AS `IdNumber`, `systemusers`.`FirstName` AS `FirstName`,`systemusers`.`LastName` AS `LastName`,`systemusers`.`OtherName` AS `OtherName`,`status`.`StatusId` AS `StatusId`, `status`.`StatusName` AS `StatusName`,`systemusercridentials`.`SystemUserCridentialsId` AS `SystemUserCridentialsId`,`systemusercridentials`.`Password` AS `Password`,
            `systemroles`.`SystemRoleId` AS `SystemRoleId`,`systemright`.`SystemRightId` AS `SystemRightId`,`systemright`.`MenuName` AS `MenuName`, `systemuserstatus`.`SystemUserStatusId` AS `SystemUserStatusId` FROM `systemusers` JOIN `systemuserstatus` ON `systemusers`.`SystemUserId` = `systemuserstatus`.`SystemUserId` JOIN `systemusercridentials` ON `systemusercridentials`.`SystemUserId`=`systemusers`.`SystemUserId`
            JOIN `systemroles` ON `systemusers`.`SystemUserId` = `systemroles`.`SystemUserId` JOIN `systemright` ON `systemusers`.`SystemUserId` = `systemroles`.`SystemUserId`JOIN `status` ON `systemuserstatus`.`StatusId` = `status`.`StatusId` WHERE `systemusers`.`FirstName` ='" . $userName . "'";
        
        $results            = $con->query($getUserDetails);
        $resultUserDetails  = $results['result'];
        
    while($rowUserDetails   = $resultUserDetails->fetch(PDO::FETCH_ASSOC)){
            $sysPassw       = $rowUserDetails['Password'];
            $UsrId          = $rowUserDetails['SystemUserId'];
            $roleId         = $rowUserDetails['SystemRoleId'];
            $UsrFName       = $rowUserDetails['FirstName'];
            $UsrLName       = $rowUserDetails['LastName'];
            $IdUser         = $rowUserDetails['IdNumber'];
            
        }
        
        if(isset($userPass) && $userPass !== "" && $userPass == $sysPassw){
            // Login Sucesful
            $_SESSION['RentalsUid']          = $UsrId;
            $_SESSION['RentorId']            = $IdUser;
            $_SESSION['RentalsRoleId']       = $roleId;
            $_SESSION['RentalsFName']        = $UsrFName;
            $_SESSION['RentalsLName']        = $UsrLName;
            
        }else{
            // Login Failled
            $msg            = '<div class="alert alert-danger alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Invalid User Name or Password</strong></div>';
            echo $msg;
        }
        
        
    }
    
    if(isset($_GET['logout']) && $_GET['logout'] == "logout"){
        // Instantiate logout
        // remove all session variables
        session_unset();
        
        // destroy the session
        session_destroy();
        
    }
    
    $uid                    = $user->uid();
    
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">    
		<title>Rent Management</title>
    	<meta name="description" content="Jezrel Jumwa" />
    	<meta name="keywords" content="Rent, Management" />
    	<meta name="author" content="Jezrel Jumwa - Seven Seas Technologies" />
        
        <!-- ========== FAVICON & APPLE ICONS ========== -->
        <link rel="shortcut icon" href="<?php echo $url; ?>img/logo.ico" />
        <link rel="apple-touch-icon" href="<?php echo $url; ?>img/logo.ico" />
		
		<!-- Font awesome -->
		<link href="<?php echo $url; ?>css/font-awesome.css" rel="stylesheet">
		<!-- Bootstrap -->
		<link href="<?php echo $url; ?>css/bootstrap.css" rel="stylesheet">   
		<!-- SmartMenus jQuery Bootstrap Addon CSS -->
		<link href="<?php echo $url; ?>css/jquery.smartmenus.bootstrap.css" rel="stylesheet">
		<!-- Product view slider -->
		<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>css/jquery.simpleLens.css">    
		<!-- slick slider -->
		<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>css/slick.css">
		<!-- price picker slider -->
		<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>css/nouislider.css">
		<!-- Theme color -->
		<link id="switcher" href="<?php echo $url; ?>css/theme-color/orange-theme.css" rel="stylesheet">
		<!-- <link id="switcher" href="css/theme-color/bridge-theme.css" rel="stylesheet"> -->
		<!-- Data Table -->
		<link href="<?php echo $url; ?>css/dataTables.bootstrap.min.css" rel="stylesheet">

		<!-- Main style sheet -->
		<link href="<?php echo $url; ?>css/style.css" rel="stylesheet">
                
                <!-- Bootstrap -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <!-- ========== LEAFLET ========== -->
    	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>css/leaflet-0.7.css"> 
    	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>css/maps.css">
        <!-- ========== MINIFIED VENDOR CSS ========== -->
        <link rel="stylesheet" href="<?php echo $url; ?>css/vendor.css" media="screen">
        
        <script type="text/javascript" src="<?php echo $url; ?>js/jquery-1.11.3.min.js"></script>
        
        <!-- Social Media buttons-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <!--Ionic Framework-->
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
		<!-- Google Font -->
		<!--<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>-->
		

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		  <script src="<?php echo $url; ?>js/data.js"></script>
		  <script src="<?php echo $url; ?>js/function.js"></script>
		<![endif]-->																									
  

	</head>
	