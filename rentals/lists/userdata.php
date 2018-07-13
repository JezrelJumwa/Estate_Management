<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST['frmname']) && $_POST['frmname'] == "frmpassreset" && $_POST['humancode'] == "Rs7p2ss"){
        $NPass                      = md5($_POST ['confirm_password']);
        $AccountId                  = $_POST ['txtaccId'];
         
        if($_POST ['txtaction'] == 1){
            // Update role
            $passreset       = "UPDATE systemusercridentials SET
                                    Password = '"    .  $NPass .   "'
                                 WHERE SystemUserCridentialsId =" .$AccountId;
            
            $sql=$con->query($passreset);
            
            
        }else{
        //something
        }
}
    
?>
<section id="service" class="section section-padded">
            <div class="aa-sidebar-widget">
                <h3>My Profile</h3>
            </div>
            <div class="row">
                <?php
                    $userinfo                  = "SELECT `systemusers`.`SystemUserId` AS 'SystemUserId',`systemusers`.`FirstName` AS 'FirstName',`systemusers`.`LastName` AS 'LastName',`systemusers`.`OtherName` AS 'OtherName',`systemusers`.`IdNumber` AS 'IdNumber',`systemusers`.`Gender` AS 'Gender',`systemusercridentials`.`SystemUserCridentialsId` AS 'SystemUserCridentialsId' FROM `systemusers` JOIN `systemusercridentials` ON `systemusers`.`SystemUserId` = `systemusercridentials`.`SystemUserCridentialsId` WHERE `systemusercridentials`.`SystemUserId` =" . $uid;
                                                            
                    $results                    = $con->query($userinfo);
                    $resultsmessenger           = $results['result'];
                                                            
                    while($rowmessenger         = $resultsmessenger->fetch(PDO::FETCH_ASSOC)){
                        $FirstName              = $rowmessenger['FirstName'];
                        $LastName               = $rowmessenger['LastName'];
                        $OtherName              = $rowmessenger['OtherName'];
                        $IdNumber               = $rowmessenger['IdNumber'];
                        $Gender                 = $rowmessenger['Gender'];
                        $AccountId              = $rowmessenger['SystemUserCridentialsId'];
                        
                    }
                        
                    ?>
                <div class="col-sm-12">
                    <form name="" id="" method="POST" action="<?php echo $url; ?>?pg=10&ac=2&vl=1&dt=<?php echo $dt; ?>">
                        <table id="myTable" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="example_info" cellspacing="0">
                            <tbody>
                                <input type="hidden" name="txtFormName" value="mailer" />
                                <input type="hidden" name="txtHumanCode" value="m1i5e5" />
                                <input type="hidden" name="txtaction" value="<?php echo $ac; ?>" />
                                <input type="hidden" name="txtdt" value="<?php echo $dt; ?>" />
                                
                                
                                <tr><th>Name</th><td colspan="3"><?php echo $FirstName ." ". $LastName." ". $OtherName; ?></td></tr>
                                <tr><th>ID Number</th><td><?php echo $IdNumber; ?></td></tr>
                                <tr><th>Gender</th><td><?php echo $Gender; ?></td></tr>
                                
                                
                                
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </section>