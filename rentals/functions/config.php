<?php
    /***************************************************************
    ***************      Load Classes/ Functions      **************
    ***************************************************************/
    require_once("./functions/variables.php");
    require_once("./functions/connection.php");
    require_once("./functions/site.php");
    require_once("./functions/module.php");
    require_once("./functions/login.php");
    require_once("./functions/config.php");
    
    
    
    //  Classes
    $module         = New module();
    $pages          = New site();
    $con            = New conn();
    $user           = New login();
    $menu           = New menu();    
    
    
    //  Site Variables
    $conn           = $con->conn_open();
    $url            = $site['url'];
    $url2           = $site2['url'];
    $logout         = $pages->logout();
    $ac             = $pages->action();
    $pg             = $pages->page();
    $dt             = $pages->data();
    
    $role           = $user->userRole();
    
    $run            = 0;
    $change_pass    = 0;
    