<nav>
    <ul class="pagination">
        <!-- First Page Button -->
        <li class="page-item">
            <a class="page-link" title="1" href="<?php echo $url ."?pg=".$pg."&&"?>dat=1" tabindex="-1" aria-label="First">
                <span aria-hidden="true">&par;&laquo;</span>
                <span class="sr-only">First</span>
            </a>
        </li>
        <!-- Previous Page Button -->
        <li class="page-item">
            <a class="page-link" href="<?php echo $url ."?pg=".$pg."&&"?>dat=<?php echo $previouspage; ?>" tabindex="-1" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">First</span>
            </a>
        </li>
        <!-- Current Page Pagination Button -->
        <li class="page-item active">
            <a class="page-link" href="<?php echo $url ."?pg=".$pg."&&"?>dat=<?php echo $curpage; ?>"><?php echo $curpage; ?></a>
        </li>
        <?php 
            $startcounter = $curpage + 1;
            $endcounter = $curpage + 4;
            for($p = $startcounter; $p <= $endcounter; $p++){
                if($p <= $endpage){
                    echo '
                    <li class="page-item">
                        <a class="page-link" href="' .$url ."?pg=". $pg.'&&dat='.$p.'">'.$p.'</a>
                    </li>';
                }
            }
        ?>
        <!-- Next Page Button -->
        <li class="page-item">
            <a class="page-link" href="<?php echo $url ."?pg=".$pg."&&"?>dat=<?php echo $nextpage; ?>" tabindex="-1" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Last</span>
            </a>
        </li>
        <!-- Last Page Button -->
        <li class="page-item">
            <a class="page-link" href="<?php echo $url ."?pg=".$pg."&&"?>dat=<?php echo $endpage; ?>" tabindex="-1" aria-label="First">
                <span aria-hidden="true">&raquo;&par;</span>
                <span class="sr-only">First</span>
            </a>
        </li>
    </ul>
</nav>
