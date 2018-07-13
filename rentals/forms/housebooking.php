<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $HouseId              =   "";
    $BookingId            =   "";
    
    if(isset($ac) && $ac == 01 && isset($dt) && $dt !== ""){
        $getgdddt           = "SELECT `systemusers`.`SystemUserId` AS 'SystemUserId',`systemusers`.`FirstName` AS 'FirstName', `systemusers`.`LastName` AS 'LastName', `systemusers`.`OtherName` AS 'OtherName',`booking`.`BookingId` AS 'BookingId',`booking`.`BookingStatus` AS 'BookingStatus', `housebooking`.`HouseBookingId` AS 'HouseBookingId', `house`.`HouseId` AS 'HouseId', `house`.`HouseNumber` AS 'HouseNumber'
FROM `systemusers` JOIN `housebooking` ON `housebooking`.`SystemUserId` = `systemusers`.`SystemUserId` JOIN `house` ON `house`.`HouseId` = `housebooking`.`HouseId` JOIN `booking` ON `booking`.`BookingId` = `housebooking`.`BookingId` WHERE `systemusers`.`SystemUserId` =" . $dt;
                                
	$result            = $con->query($getgdddt);
        $resultGuardian     = $result['result'];
    
    while($rowGd      = $resultGuardian->fetch(PDO::FETCH_ASSOC)){
        
      $HouseId          = $rowGd ['HouseId'];
      $BookingId        = $rowGd ['BookingId'];
      $dt               = $rowGd ['HouseBookingId'];
      
      
      
        }
            
    }
?>
<section id="service" class="section section-padded">
    <div class="container">
        <form class="form-horizontal col-md-10" action="<?php echo $url;?>?pg=<?PHP if(isset($ac) && $ac == 1){ echo "02"; }else{ echo "02"; } ?>" method="POST" id="frmst" name="frmst" onsubmit="return ValidateUsers();">
            <div class="aa-sidebar-widget">
    			<h3>User Registration</h3>
    		</div>
            <input type="hidden" name="frmname" value="frmBooking" />
            <input type="hidden" name="humancode" value="B00k87g" />
            <input type="hidden" name="txtaction" value="<?php echo $ac; ?>" />
            <input type="hidden" name="txtdt" value="<?php echo $dt; ?>" />
            
            
            <section id="service" class="section section-padded">
                    <!-- <div class="aa-sidebar-widget">
                		<h3>Section One</h3>
                	</div> -->
            
            <div class="form-group">
                    <label for="phoneNumber" class="control-label col-xs-2">House Number<span class="asteriskField">*</span></label>
                    <div class="col-xs-8">
                        <select class="input-md textinput textInput form-control" value="<?php echo $HouseId; ?>" id="id_phone" name="txtHouseNum" placeholder="Class Name" style="margin-bottom: 10px" type="text" required="required">
                                                 <?php
                                                $sel          = "";
                                                
                                                $sql_guard    = "SELECT HouseId, HouseName FROM house ORDER BY HouseNumber";
                                                
                                                $result       = $con->query($sql_guard);
                                                $resultGuard  = $result['result'];
                                                
                                                while($row_stat  = $resultGuard->fetch(PDO::FETCH_ASSOC)){
                                                    if($statu   == $row_stat['HouseId']){
                                                        $sel      = "selected=\"selected\"";
                                                        
                                                    }
                                                    
                                                    echo "<option value=\"" . $row_stat['HouseId'] . "\" " . $sel . ">" . $row_stat['HouseNumber'] . "</option>";
                                                    
                                                    $sel        = "";
                                                    
                                                }
                                            
                                            ?>
                    </select>
                    </div>
                </div>
            
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

		
