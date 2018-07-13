<?php
    if(isset($_POST['frmname']) && $_POST['frmname'] == "frmusrs" && $_POST['humancode'] == "G125ian"){
        $NationalId                 = $_POST['txtId'];
        $FirstName                  = $_POST ['txtFName'];
        $LastName                   = $_POST['txtlname'];
        $OtherName                  = $_POST['txtoname'];
        $gender                     = $_POST['gender'];
        $statu                      = $_POST['txtStat'];
        $dt                         =  $_POST['txtdt'];
        
         
        if($_POST['txtaction'] == 0){
            // Save new Empl
            $workerDetail       = "INSERT INTO systemusers(FirstName,LastName,OtherName,IdNumber,Gender)VALUES ('"  . $FirstName   .   "','"   .  $LastName .   "','"   . $OtherName   .   "'," . $NationalId  .   ", '"    . $gender  .   "')";
        
        }elseif($_POST['txtaction'] == 1){
            // Update Empl
            $workerDetail       = "UPDATE systemusers INNER JOIN systemuserstatus ON `systemusers`.`SystemUserId` = `systemuserstatus`.`SystemUserId` SET
                                  `systemusers`.`FirstName` = '".  $FirstName ."'
                                  ,`systemusers`.`LastName` = '".   $LastName   ."'
                                  ,`systemusers`.`OtherName` = '".  $OtherName  .   "'
                                  ,`systemusers`.`IdNumber` = " .   $NationalId .   "
                                  ,`systemusers`.`Gender` = '"  .   $gender.    "',
                                `systemuserstatus`.`StatusId` = "   .  $statu .   "
                                WHERE `systemusers`.`SystemUserID` = $dt";


            
        }


        
        $sql=$con->query($workerDetail);
        $lastId =$sql['lastId'];
        
        

        if($_POST['txtaction'] == 0 && $sql)
       {
       // echo "insert into class table";
        $UserStatus      = "INSERT INTO systemuserstatus (
                                      SystemUserId
                                      ,StatusId
                                    ) VALUES ("   .   $lastId  .   ","   .    $statu  .  ")";
                                 
        $sql2=$con->query($UserStatus);
        
    }
}
    
?>
<section id="service" class="section section-padded">
    <div class="aa-sidebar-widget">
        <h3>Users List</h3>
    </div>
    <div class="row">
        <div class="col-sm-9">
            <div class="col-sm-5">
                <div class="input-group">
                    <input class="aa-add-to-cart-btn" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search Users" />
                </div>
            </div>
        </div>
        
        <div class="col-sm-3">
            <div class="btn-group">
                <a class="aa-browse-btn" href="<?php echo $url; ?>?pg=01">New User</a>
            </div>
        </div>
    </div>
      
    <div class="row">
        <div class="col-sm-12">
            <table id="myTable" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="example_info" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>National Id</th>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
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
                $stmtA = $conn->prepare("SELECT `systemusers`.`SystemUserId` AS `SystemUserId`,`systemusers`.`IdNumber` AS `IdNumber`, `systemusers`.`FirstName` AS `FirstName`,`systemusers`.`LastName` AS `LastName`,`systemusers`.`Gender` AS `Gender`,`systemusers`.`OtherName` AS `OtherName`,`status`.`StatusId` AS `StatusId`, `status`.`StatusName` AS `StatusName`
,`systemuserstatus`.`SystemUserStatusId` AS `SystemUserStatusId` FROM `systemusers` JOIN `systemuserstatus` ON `systemusers`.`SystemUserId` = `systemuserstatus`.`SystemUserId` JOIN `status` ON `systemuserstatus`.`StatusId` = `status`.`StatusId` ");
                $stmtA->execute();
                foreach($stmtA->fetchAll() as $k=>$rowA){$totalres++;}
                $stmt = $conn->prepare("SELECT `systemusers`.`SystemUserId` AS `SystemUserId`,`systemusers`.`IdNumber` AS `IdNumber`, `systemusers`.`FirstName` AS `FirstName`,`systemusers`.`LastName` AS `LastName`,`systemusers`.`Gender` AS `Gender`,`systemusers`.`OtherName` AS `OtherName`,`status`.`StatusId` AS `StatusId`, `status`.`StatusName` AS `StatusName`
,`systemuserstatus`.`SystemUserStatusId` AS `SystemUserStatusId` FROM `systemusers` JOIN `systemuserstatus` ON `systemusers`.`SystemUserId` = `systemuserstatus`.`SystemUserId` JOIN `status` ON `systemuserstatus`.`StatusId` = `status`.`StatusId` LIMIT $start,$perpage");
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
                    echo ' 
                        <tr '.$stl.'><td></td><td>' .$row['IdNumber'] .'</td><td>'.$row['FirstName'] . " " . $row['LastName']. " " . $row['OtherName']. '</td><td>'.$row['Gender'] .'</td><td>' . $row['StatusName'] . '</td><td><a href="' . $url . '?pg=01&ac=01&dt=' . $row['SystemUserId'] . '">Edit</a> | <a href="">Reset Password</a></td></tr>
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
            td = tr[i].getElementsByTagName("td")[2];
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