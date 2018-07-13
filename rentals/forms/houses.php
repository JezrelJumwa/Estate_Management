<section id="service" class="section section-padded">
    <div class="container">
        <form class="form-horizontal col-md-10" action="<?php echo $url;?>?pg=<?PHP if(isset($ac) && $ac == 1){ echo "03"; }else{ echo "03"; } ?>" method="POST" id="frmst" name="frmst" onsubmit="return ValidateUsers();">
            <div class="aa-sidebar-widget">
    			<h3>House Registration</h3>
    		</div>
            <input type="hidden" name="frmname" value="frmHS" />
            <input type="hidden" name="humancode" value="H0u5e" />
            <input type="hidden" name="txtaction" value="<?php echo $ac; ?>" />
            <input type="hidden" name="txtdt" value="<?php echo $dt; ?>" />
            
            
            <section id="service" class="section section-padded">
                    
            <div class="form-group">
                <label for="inputFname" class="control-label col-xs-2">House Number<span class="asteriskField">*</span></label>
                <div class="col-xs-8">
                    <input class="input-md textinput textInput form-control"  id="id_staffname" maxlength="30" name="txtHouseNo" placeholder="House Number" style="margin-bottom: 10px" type="number" required="required"/>
                </div>
            </div>
            <div class="form-group">
                <label for="mpesaNames" class="control-label col-xs-2">Rent<span class="asteriskField">*</span></label>
                <div class="col-xs-8">
                    <input class="input-md textinput textInput form-control"  id="relation" maxlength="30" name="txtRent" placeholder="Rent" style="margin-bottom: 10px" type="number" required="required"/>
                </div>
            </div>
           
            <div class="form-group">
                <label for="Images" class="control-label col-xs-2">Image <span class="asteriskField">*</span></label>
                <div class="col-xs-8"> 
                    <input class="aa-browse-btn" type="file" name="Filename" required="required">
                </div>
            </div>
            <div class="form-group"> 
            <label for="Descript" class="control-label col-xs-2">Description<span class="asteriskField">*</span></label>
                <div class="col-xs-8">
                    <textarea rows="10" cols="35" name="Description" required="required" ></textarea>
                </div>
            </div>
            

        <div class="form-group"> 
            
            <div class="aa-sidebar-widget">
                <button class="aa-browse-btn" name="upload" type="submit" class="btn btn-blue">Save</button>
                <button class="aa-browse-btn" type="reset" class="btn btn-blue">Clear</button>
            </div>
										
        </div>     
        </form>
    </div>
</section>
<?php
   if(isset($_POST['upload'])){
            
        
	$fileExistsFlag = 0; 
	$fileName = @$_FILES['Filename']['name'];

	/* 
	*	Checking whether the file already exists in the destination folder 
	*/
	$sql                  = "SELECT * FROM house WHERE FILE_NAME ='$fileName'";	
	$result                 = $con->query($sql);
        $resultLst              = $result['result'];
	while($row              = $resultLst->fetch(PDO::FETCH_ASSOC)) {
                if($row['FILE_NAME']    == $fileName) {
                        $fileExistsFlag = 1;
                }		
	}
	/*
	* 	If file is not present in the destination folder
	*/
	if($fileExistsFlag == 0) { 
		$target = "files/";		
		$fileTarget = $target.$fileName;	
		@$tempFileName = $_FILES["Filename"]["tmp_name"];
		@$fileDescription = $_POST['Description'];	
		$result = move_uploaded_file($tempFileName,$fileTarget);
		/*
		*	If file was successfully uploaded in the destination folder
		*/
		if($result) { 
			echo "Your file <html><b><i>".$fileName."</i></b></html> has been successfully uploaded";		
			$sql2 = "INSERT INTO files (
   FILE_PATH
  ,FILE_NAME
  ,DESCRIPTION
  ,USER_ID
) VALUES ('$fileTarget','$fileName','$fileDescription',$uid)";
			$File_upload=$con->query($sql2);			
		}
		else {			
			echo "Sorry !!! There was an error in uploading your file";
                        
		}
		
	}
	/*
	* 	If file is already present in the destination folder
	*/
	else {
		echo "File <html><b><i>".$fileName."</i></b></html> already exists in your folder. Please rename the file and try again.";
		
	}
    }				