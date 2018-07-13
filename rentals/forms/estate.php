<?php
    $EstateName            =   "";
    $EstateLocation        =   "";
    $HoueNumber            =   "";
    
    
   
    
    
    if(isset($ac) && $ac == 01 && isset($dt) && $dt !== ""){
        $getgdddt           = "SELECT `estate`.`EstateId` AS `EstateId`, `estate`.`EstateName` AS `EstateName`,`estate`.`EstateLocation` AS `EstateLocation`, `house`.`HouseId` AS `HouseID`,`house`.`HouseNumber` AS `HouseNumber` FROM house JOIN estate ON `estate`.`HouseId` = `house`.`HouseId`
WHERE `estate`.`HouseId` =" . $dt;
                                
	$result                 = $con->query($getgdddt);
    $resultGuardian         = $result['result'];
    
    while($rowGd            = $resultGuardian->fetch(PDO::FETCH_ASSOC)){
        
      $EstateName           = $rowGd ['EstateName'];
      $EstateLocation       = $rowGd ['EstateLocation'];
      $HoueNumber           = $rowGd ['HouseNumber'];
      $dt                   = $rowGd ['EstateId'];
      

      }
  } 
?>
<section id="service" class="section section-padded">
    <div class="container">
        <form class="form-horizontal col-md-10" action="<?php echo $url;?>?pg=<?PHP if(isset($ac) && $ac == 1){ echo "06"; }else{ echo "06"; } ?>" method="POST" id="frmst" name="frmst" onsubmit="return ValidateUsers();">
            <div class="aa-sidebar-widget">
    			<h3>Estate Registration</h3>
    		</div>
            <input type="hidden" name="frmname" value="frmEst" />
            <input type="hidden" name="humancode" value="3st273" />
            <input type="hidden" name="txtaction" value="<?php echo $ac; ?>" />
            <input type="hidden" name="txtdt" value="<?php echo $dt; ?>" />
            
            
            <section id="service" class="section section-padded">
                    <!-- <div class="aa-sidebar-widget">
                		<h3>Section One</h3>
                	</div> -->
            
            <div class="form-group">
                <label for="inputFname" class="control-label col-xs-2">Estate Name<span class="asteriskField">*</span></label>
                <div class="col-xs-8">
                    <input class="input-md textinput textInput form-control" value="<?php echo $EstateName; ?>" id="id_staffname" maxlength="30" name="txtEstName" placeholder="Estate Name" style="margin-bottom: 10px" type="text" required="required"/>
                </div>
            </div>
            <div class="form-group">
                <label for="inputFname" class="control-label col-xs-2">Estate Location<span class="asteriskField">*</span></label>
                <div class="col-xs-8">
                    <input class="input-md textinput textInput form-control" value="<?php echo $EstateLocation; ?>" id="id_gdname" maxlength="30" name="txtEstateLocation" placeholder="Estate Location" style="margin-bottom: 10px" type="text" required="required"/>
                </div>
            </div>
            <div class="form-group">
                    <label for="phoneNumber" class="control-label col-xs-2">House Number<span class="asteriskField"></span></label>
                    <div class="col-xs-8">
                        <input name="txthsno" type="text" list="HouseNm" value="<?php echo $HoueNumber; ?>"  class="input-md textinput textInput form-control" />
                        <datalist id="HouseNm">
                            <?php
                                $sel          = "";
                                
                                $sql_guard    = "SELECT HouseNumber FROM house ORDER BY HouseId";
                                
                                $result       = $con->query($sql_guard);
                                $resultLocation  = $result['result'];
                                
                                while($row_loc  = $resultLocation->fetch(PDO::FETCH_ASSOC)){
                                    if($HoueNumber   == $row_loc['HouseId']){
                                        $sel      = "selected=\"selected\"";
                                        
                                    }
                                    
                                    //echo "<option value=\"" .$row_loc['OccupationId']   .   "\" "    .  $sel .">"    .$row_loc['OccupationName']   ."</option>";
                                    echo "<option value=\"" . $row_loc['HouseNumber'] . "\" </option>";
                                    
                                   // $sel        = "";
                                    
                                }
                            
                            ?>
                        </datalist>
                    <!--</select>-->
                    </div>
                </div>
        
        <div class="form-group"> 
            
            <div class="aa-sidebar-widget">
                <button class="aa-browse-btn" type="submit" class="btn btn-blue">Save</button>
                <button class="aa-browse-btn" type="reset" class="btn btn-blue">Clear</button>
            </div>
										
        </div>     
        </form>
    </div>
</section>

				