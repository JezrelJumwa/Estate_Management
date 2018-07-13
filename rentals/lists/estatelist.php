<?php
    if(isset($_POST['frmname']) && $_POST['frmname'] == "frmEst" && $_POST['humancode'] == "3st273"){
        $EstateName                = $_POST['txtEstName'];
        $EstateLocation            = $_POST ['txtEstateLocation'];
        $HoueNumber                = $_POST['txthsno'];
        $dt                        =  $_POST['txtdt'];
        
        
        
         
        if($_POST['txtaction'] == 0){
            // Save new Empl
            $workerDetail       = "INSERT INTO estate (
   EstateName
  ,EstateLocation
  ,HouseId
) VALUES (
 '"   . $EstateName  .   "'
  ,'"  . $EstateLocation  .   "'
  ,"  . $HoueNumber  .   "
)";
        
        }elseif($_POST['txtaction'] == 1){
            // Update Empl
            $workerDetail       = "UPDATE estate SET
  EstateName = '"   . $EstateName  .   "'
  ,EstateLocation = '"  . $EstateLocation  .   "'
  ,HouseId = "  . $HoueNumber  .   "
WHERE EstateId ="  .$dt ." ";


            
        }


        
        $sql=$con->query($workerDetail);
        
}
    
?>
<section id="service" class="section section-padded">
    <div class="aa-sidebar-widget">
        <h3>Estate List</h3>
    </div>
    <div class="row">
        <div class="col-sm-9">
            <div class="col-sm-5">
                <div class="input-group">
                    <input class="aa-add-to-cart-btn" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search Estate" />
                </div>
            </div>
        </div>
        
        <div class="col-sm-3">
            <div class="btn-group">
                <a class="aa-browse-btn" href="<?php echo $url; ?>?pg=05">New Estate</a>
            </div>
        </div>
    </div>
      
    <div class="row">
        <div class="col-sm-12">
            <table id="myTable" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="example_info" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Estate Name</th>
                        <th>Estate Location</th>
                        <th>House Number</th>
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
                $stmtA = $conn->prepare("SELECT `estate`.`EstateId` AS `EstateId`, `estate`.`EstateName` AS `EstateName`,`estate`.`EstateLocation` AS `EstateLocation`, `house`.`HouseId` AS `HouseID`,`house`.`HouseNumber` AS `HouseNumber` FROM house JOIN estate ON `estate`.`HouseId` = `house`.`HouseId`");
                $stmtA->execute();
                foreach($stmtA->fetchAll() as $k=>$rowA){$totalres++;}
                $stmt = $conn->prepare("SELECT `estate`.`EstateId` AS `EstateId`, `estate`.`EstateName` AS `EstateName`,`estate`.`EstateLocation` AS `EstateLocation`, `house`.`HouseId` AS `HouseID`,`house`.`HouseNumber` AS `HouseNumber` FROM house JOIN estate ON `estate`.`HouseId` = `house`.`HouseId` LIMIT $start,$perpage");
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
                        <tr '.$stl.'><td></td><td>' .$row['EstateName'] .'</td><td>'.$row['EstateLocation'] . '</td><td>' . $row['HouseNumber'].'</td><td><a href="' . $url . '?pg=05&ac=01&dt=' . $row['EstateId'] . '">Edit</a></td></tr>
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