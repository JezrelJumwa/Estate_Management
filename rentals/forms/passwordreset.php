<?php
                    $passwordupdt                  = "SELECT `systemusers`.`SystemUserId` AS 'SystemUserId',`systemusers`.`FirstName` AS 'FirstName',`systemusers`.`LastName` AS 'LastName',`systemusers`.`OtherName` AS 'OtherName',`systemusers`.`IdNumber` AS 'IdNumber',`systemusers`.`Gender` AS 'Gender',`systemusercridentials`.`SystemUserCridentialsId` AS 'SystemUserCridentialsId' FROM `systemusers` JOIN `systemusercridentials` ON `systemusers`.`SystemUserId` = `systemusercridentials`.`SystemUserCridentialsId` WHERE `systemusercridentials`.`SystemUserId` =" . $uid;
                                                            
                    $results                    = $con->query($passwordupdt);
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
<section id="service" class="section section-padded">
    <div class="container">
            <form class="form-horizontal col-md-10" id="frmst" name="frmst" method="post" action="<?php echo $url;?>?pg=<?PHP if(isset($ac) && $ac == 1){ echo "15"; }else{ echo "15"; } ?>" enctype="multipart/form-data">
            <div class="aa-sidebar-widget">
    			<h3>Password Reset</h3>
                                <input type="hidden" name="frmname" value="frmpassreset" />
                                <input type="hidden" name="humancode" value="Rs7p2ss" />
                                <input type="hidden" name="txtaction" value="<?php echo $ac; ?>" />
                                <input type="hidden" name="txtdt" value="<?php echo $dt; ?>" />
                                <input type="hidden" name="txtaccId" value="<?php echo $AccountId; ?>" />
    		</div>            
            <div class="form-group">
            <label for="inputRolename" class="control-label col-xs-2">Enter Password<span class="asteriskField">*</span></label>
                <div class="col-xs-8">
                    <input class="input-md textinput textInput form-control"  id="password" maxlength="100" name="password" placeholder="Enter Password" style="margin-bottom: 10px" type="password" required="required" title="Enter Password"/>
                </div>
            </div>
            <div class="form-group">
            <label for="inputRolename" class="control-label col-xs-2">Confirm Password<span class="asteriskField">*</span></label>
                <div class="col-xs-8">
                    <input class="input-md textinput textInput form-control"  id="confirm_password" maxlength="100" name="confirm_password" placeholder="Confirm Password" style="margin-bottom: 10px" type="password" required="required" title="Confirm Password"/>
                    <span id='message'></span>
                </div>
            </div>
        <div class="form-group"> 
            
            <div class="aa-sidebar-widget">
                <button class="aa-browse-btn" type="submit" >Save</button>
                <button class="aa-check-btn" type="reset" >Clear</button>
                
										
        </div>
            </form>
        
    </div>
</section>
<!--<div class="container">
  <h2>Small Modal</h2>
   Trigger the modal with a button 
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Small Modal</button>

   Modal 
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>This is a small modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>-->
