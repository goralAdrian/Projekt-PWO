<?php
/**
 * @var $pageno
 * @var $total_pages
 * @var $total_rows
 */
if($total_pages > 1){ ?>
    <ul class="corefortress-slider-pagination">
        <?php
        echo $total_rows . ' items';
        if ($pageno > 2){ ?>
            <li><a href="<?php echo admin_url('admin.php?page=corefortress_slider_themes&pageno=1'); ?>">‹‹</a></li>
        <?php } else{ ?>
            <li><span>‹‹</span></li>
        <?php }
        if ( $pageno > 1 ) { ?>
            <li>
                <a href="<?php if($pageno <= 1){ echo '#'; } else { echo admin_url("admin.php?page=corefortress_slider_themes&pageno=" . ($pageno - 1)); } ?>">‹</a>
            </li>
        <?php } else { ?>
            <li><span>‹</span></li>
        <?php }
        echo $pageno . ' of '. $total_pages;
        if ( $pageno < $total_pages ) { ?>
            <li>
                <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo admin_url("admin.php?page=corefortress_slider_themes&pageno=" . ($pageno + 1)); } ?>">›</a>
            </li>
        <?php } else { ?>
            <li><span>›</span></li>
        <?php }
        if ($total_pages - $pageno > 1) { ?>
            <li><a href="<?php echo admin_url("admin.php?page=corefortress_slider_themes&pageno=" . $total_pages); ?>">››</a></li>
        <?php }else{ ?>
            <li><span>››</span></li>
        <?php } ?>

    </ul>
<?php } ?>