<?php
   if(isset($_POST['upload'])){
            
        
	$fileExistsFlag = 0; 
	$fileName = @$_FILES['Filename']['name'];
        
       
	/* 
	*	Checking whether the file already exists in the destination folder 
	*/
	$sql                  = "SELECT * FROM house WHERE FileName ='$fileName'";	
	$result                 = $con->query($sql);
        $resultLst              = $result['result'];
	while($row              = $resultLst->fetch(PDO::FETCH_ASSOC)) {
                if($row['FileName']    == $fileName) {
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
                $Housenumber      = $_POST ['txtHouseNo'];
                $Rent             = $_POST ['txtRent'];
		$result = move_uploaded_file($tempFileName,$fileTarget);
		/*
		*	If file was successfully uploaded in the destination folder
		*/
                
		if($result) { 
                        echo '<div class="alert alert-success">Your file <html><b><i>".$fileName."</i></b></html> has been successfully uploaded</div>';
			$sql2 = "INSERT INTO house (
                                                    HouseNumber
                                                   ,Rent
                                                   ,HouseType
                                                   ,FilePath
                                                   ,FileName
                                                 ) VALUES ('$Housenumber','$Rent','$fileDescription','$fileTarget','$fileName')";
			$File_upload=$con->query($sql2);			
		}
		else {		
                        echo '<div class="alert alert-success"><strong>Sorry !!!</strong>  There was an error in uploading your file.</div>';
		}
		
	}
	/*
	* 	If file is already present in the destination folder
	*/
	else {
		 echo '<div class="alert alert-danger"><strong>File <i>'.$fileName.'</i></strong> already exists in your folder. Please rename the file and try again.</div>';

	}
    }      
    
?>
<section id="service" class="section section-padded">
    <div class="aa-sidebar-widget">
        <h3>House List</h3>
    </div>
    <div class="row">
        <div class="col-sm-9">
            <div class="col-sm-5">
                <div class="input-group">
                    <input class="aa-add-to-cart-btn" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search House" />
                </div>
            </div>
        </div>
        
        <div class="col-sm-3">
            <div class="btn-group">
                <a class="aa-browse-btn" href="<?php echo $url; ?>?pg=03">New House</a>
            </div>
        </div>
    </div>
      
    <div class="row">
        <div class="col-sm-12">
            <table id="myTable" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="example_info" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>House Number</th>
                        <th>House Image</th>
                        <th>Rent</th>
                        <th>House Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
//                        
//                        
//                        $sql          = "SELECT * FROM house";
//                        $result       = $con->query($sql);
//                        $resultLst    = $result['result'];
//
//                        while($row        = $resultLst->fetch(PDO::FETCH_ASSOC)){
//                            
//                            if ($handle = opendir('files/')) {
//                              while (false !== ($file = readdir($handle))) {
//                                if ($file != "." && $file != "..") {
//                                  $thelist = '<tr><td></td><td>'  .  $row['HouseNumber']   .'</td><td><a href="'.$row['FilePath'].'">'.$row['FILE_NAME'].'</a></td><td>'   . $row['Rent']  .   '</td><td>' . $row['HouseType']  . '</td><tr/>';
//                                }
//                              }
//                              closedir($handle);
//                            }
//                                              
//                           echo $thelist; 
//                             
//                         }
                    ?>
                       <?php 
                //Pagination Variables
                $perpage = 5;
                if(isset($_GET["dat"])){
                    $curpage = $_GET["dat"];
                }else{
                    $curpage = 1;
                }
                $start = ($curpage * $perpage) - $perpage;
                $totalres = 0;
                //Query DB For Results
                $stmtA = $conn->prepare("SELECT * FROM house");
                $stmtA->execute();
                foreach($stmtA->fetchAll() as $k=>$rowA){$totalres++;}
                $stmt = $conn->prepare("SELECT * FROM house LIMIT $start,$perpage");
                $stmt->execute();
                //Records Style & Count Variables
                $count = 1;
                $tr_light = "style='background: #f5f5f5;'";
                $tr_dark = "style='background: #dedede;'";
                //Display Records
                foreach($stmt->fetchAll() as $k=>$row){
                    $no = $count * $curpage;
                    if($count%2 == 0){$stl = $tr_light;}
                    else{ $stl = $tr_dark;}
                    echo '<tr '.$stl.'><td></td><td>'  .  $row['HouseNumber']   .'</td><td><a href="'.$row['FilePath'].'">'.$row['FILE_NAME'].'</a></td><td>'   . $row['Rent']  .   '</td><td>' . $row['HouseType']  . '</td></tr>
                    ';
                    $count++;
                }
                $endpage = ceil($totalres/$perpage);
                $startpage = 1;
                if($curpage < $endpage){
                    $nextpage = $curpage + 1;
                }else {
                    $nextpage = $endpage;
                }
                if($curpage >= 2){
                    $previouspage = $curpage - 1;
                }else{
                    $previouspage = 1;
                }
            ?>
                </tbody>
            </table>
            <?php 
            //Display Pagination Buttons
            require_once ("./paginationNav.php"); 
        ?>
        </div>
    </div>
</section>                                    
                    
<script>
    $(document).ready(function() {
        var table = $('#example1').DataTable();
     
        $('#example1 tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
        } );
     
        $('#button').click( function () {
            alert(table.rows('.selected').data().length +' row(s) selected');
        } );
    } );
    
    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i;
        input   = document.getElementById("myInput");
        filter  = input.value.toUpperCase();
        table   = document.getElementById("myTable");
        tr      = table.getElementsByTagName("tr");
    
        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

</script>	