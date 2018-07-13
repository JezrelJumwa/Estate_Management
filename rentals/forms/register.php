<?php
    $NationalId             =   "";
    $FirstName              =   "";
    $LastName               =   "";
    $OtherName              =   "";
    $male                   =   "";
    $female                 =   "";
    $statu                  =   "";
    $gender                 =   "";
    
   
    
    
    if(isset($ac) && $ac == 01 && isset($dt) && $dt !== ""){
        $getgdddt           = "SELECT `systemusers`.`SystemUserId` AS `SystemUserId`,`systemusers`.`IdNumber` AS `IdNumber`, `systemusers`.`FirstName` AS `FirstName`,`systemusers`.`LastName` AS `LastName`,`systemusers`.`Gender` AS `Gender`,`systemusers`.`OtherName` AS `OtherName`,`status`.`StatusId` AS `StatusId`, `status`.`StatusName` AS `StatusName`
,`systemuserstatus`.`SystemUserStatusId` AS `SystemUserStatusId` FROM `systemusers` JOIN `systemuserstatus` ON `systemusers`.`SystemUserId` = `systemuserstatus`.`SystemUserId` JOIN `status` ON `systemuserstatus`.`StatusId` = `status`.`StatusId` AND `systemusers`.`SystemUserId` =" . $dt;
                                
	$result            = $con->query($getgdddt);
        $resultGuardian     = $result['result'];
    
    while($rowGd      = $resultGuardian->fetch(PDO::FETCH_ASSOC)){
        
      $NationalId       = $rowGd ['IdNumber'];
      $FirstName        = $rowGd ['FirstName'];
      $LastName         = $rowGd ['LastName'];
      $OtherName        = $rowGd ['OtherName'];
      $gender           = $rowGd ['Gender'];
      $statu            = $rowGd ['StatusId'];
      $dt               = $rowGd ['SystemUserId'];
      
      
    }
            if(isset($gender) && $gender == 'Female'){
            $female         = "checked=\"checked\"";
            
        }elseif(isset($gender) && $gender == 'Male'){
            $male           = "checked=\"checked\"";
            
        }
        
    
    }
?>
<section id="service" class="section section-padded">
    <div class="container">
        <form class="form-horizontal col-md-10" action="<?php echo $url;?>?pg=<?PHP if(isset($ac) && $ac == 1){ echo "02"; }else{ echo "02"; } ?>" method="POST" id="frmst" name="frmst" onsubmit="return ValidateUsers();">
            <div class="aa-sidebar-widget">
    			<h3>User Registration</h3>
    		</div>
            <input type="hidden" name="frmname" value="frmusrs" />
            <input type="hidden" name="humancode" value="G125ian" />
            <input type="hidden" name="txtaction" value="<?php echo $ac; ?>" />
            <input type="hidden" name="txtdt" value="<?php echo $dt; ?>" />
            
            
            <section id="service" class="section section-padded">
                    <!-- <div class="aa-sidebar-widget">
                		<h3>Section One</h3>
                	</div> -->
            
            <div class="form-group">
                <label for="inputFname" class="control-label col-xs-2">National Id<span class="asteriskField">*</span></label>
                <div class="col-xs-8">
                    <input class="input-md textinput textInput form-control" value="<?php echo $NationalId; ?>" id="id_staffname" maxlength="30" name="txtId" placeholder="National Id" style="margin-bottom: 10px" type="text" required="required"/>
                </div>
            </div>
            <div class="form-group">
                <label for="inputFname" class="control-label col-xs-2">First Name<span class="asteriskField">*</span></label>
                <div class="col-xs-8">
                    <input class="input-md textinput textInput form-control" value="<?php echo $FirstName; ?>" id="id_gdname" maxlength="30" name="txtFName" placeholder="First Name" style="margin-bottom: 10px" type="text" required="required"/>
                </div>
            </div>

            <div class="form-group">
                <label for="inputLname" class="control-label col-xs-2">Last Name<span class="asteriskField">*</span></label>
                <div class="col-xs-8">
                    <input class="input-md textinput textInput form-control" value="<?php echo $LastName; ?>" id="id_oname" maxlength="30" name="txtlname" placeholder="Last Name" style="margin-bottom: 10px" type="text" required="required"/>
                </div>
            </div>
            <div class="form-group">
                <label for="mpesaNames" class="control-label col-xs-2">Other Name<span class="asteriskField">*</span></label>
                <div class="col-xs-8">
                    <input class="input-md textinput textInput form-control" value="<?php echo $OtherName; ?>" id="relation" maxlength="30" name="txtoname" placeholder="Other Name" style="margin-bottom: 10px" type="text" required="required"/>
                </div>
            </div>
                        
            <div class= "form-group">
                <label for="idGender"class="control-label col-xs-2"> Gender <span class="asteriskField">*</span></label>
                <div class="col-xs-8" style="margin-bottom: 10px">
                    <label class="radio-inline"> <input type="radio" name="gender" id="id_gender_1" value="Male"  style="margin-bottom: 10px" <?php echo $male; ?> >Male</label>
                    <label class="radio-inline"> <input type="radio" name="gender" id="id_gender_2" value="Female"  style="margin-bottom: 10px" <?php echo $female; ?> >Female </label>
                </div>
            </div>
            </section>
                 <div class="form-group">
                    <label for="phoneNumber" class="control-label col-xs-2">Status<span class="asteriskField">*</span></label>
                    <div class="col-xs-8">
                        <select class="input-md textinput textInput form-control" value="<?php echo $statu; ?>" id="id_phone" name="txtStat" placeholder="Class Name" style="margin-bottom: 10px" type="text" required="required">
                                                 <?php
                                                $sel          = "";
                                                
                                                $sql_guard    = "SELECT StatusId, StatusName FROM status ORDER BY StatusName";
                                                
                                                $result       = $con->query($sql_guard);
                                                $resultGuard  = $result['result'];
                                                
                                                while($row_stat  = $resultGuard->fetch(PDO::FETCH_ASSOC)){
                                                    if($statu   == $row_stat['StatusId']){
                                                        $sel      = "selected=\"selected\"";
                                                        
                                                    }
                                                    
                                                    echo "<option value=\"" . $row_stat['StatusId'] . "\" " . $sel . ">" . $row_stat['StatusName'] . "</option>";
                                                    
                                                    $sel        = "";
                                                    
                                                }
                                            
                                            ?>
                    </select>
                    </div>
                </div>
        
            </section>
        
        <div class="form-group"> 
            
            <div class="aa-sidebar-widget">
                <button class="aa-browse-btn" type="submit" class="btn btn-blue">Save</button>
                <button class="aa-browse-btn" type="reset" class="btn btn-blue">Clear</button>
            </div>
										
        </div>     
        </form>
    </div>
</section>

				