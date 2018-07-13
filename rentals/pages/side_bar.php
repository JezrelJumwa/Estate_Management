<div class="aa-sidebar-widget">
    <h3>Menu</h3>
    <ul class="aa-catg-nav">
            <?php
                $getMenu        = "SELECT `systemusers`.`SystemUserId` AS 'SystemUserId',`systemusers`.`IdNumber` AS 'IdNumber', `systemusers`.`FirstName` AS 'FirstName',`systemusers`.`LastName` AS 'LastName',`systemusers`.`OtherName` AS 'OtherName',`status`.`StatusId` AS 'StatusId', `status`.`StatusName` AS 'StatusName',`systemusercridentials`.`SystemUserCridentialsId` AS 'SystemUserCridentialsId',`systemusercridentials`.`Password` AS 'Password',
`systemroles`.`SystemRoleId` AS 'SystemRoleId',`systemright`.`SystemRightId` AS 'SystemRightId',`systemright`.`MenuName` AS 'MenuName',`systemright`.`Page` AS 'Page', `systemuserstatus`.`SystemUserStatusId` AS 'SystemUserStatusId' FROM `systemusers` JOIN `systemuserstatus` ON `systemusers`.`SystemUserId` = `systemuserstatus`.`SystemUserId` JOIN `systemusercridentials` ON `systemusercridentials`.`SystemUserId`=`systemusers`.`SystemUserId`
JOIN `systemroles` ON `systemusers`.`SystemUserId` = `systemroles`.`SystemUserId` JOIN `systemright` ON `systemroles`.`SystemRoleId` = `systemright`.`SystemRoleId` JOIN `status` ON `systemuserstatus`.`StatusId` = `status`.`StatusId` WHERE `systemusers`.`SystemUserId` = 1 ORDER BY `systemright`.`MenuName`";
                                    
                $result         = $con->query($getMenu);
                $resultMenu     = $result['result'];
                
                while($rowMenu  = $resultMenu->fetch(PDO::FETCH_ASSOC)){
                    echo "<li><a href=\"" . $url . $rowMenu['Page'] . "\"  style=\"font: #0000FF;\">" . $rowMenu['MenuName'] . "</a></li>";
                    
                }
                
            ?>
    </ul>
</div>

<div class="aa-sidebar-widget">
    <h3>Profile</h3>
    <ul class="aa-catg-nav">
            <li><a href="?pg=10"  style="font: #0000FF;">User Data</a></li>
            <li><a href="?pg=9"  style="font: #0000FF;">Change Password</a></li>
            <li><a href="<?php echo $url; ?>?logout=logout"  style="font: #0000FF;">Sign Out</a></li>
    </ul>
</div>

