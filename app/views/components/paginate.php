<?php
$paginate_btn_path = $_SERVER['PATH_INFO'];

$page_limit = 5;
$prev = $paginated->current_page - 1;
$prev = $prev ? $prev : 0;

$next = $paginated->current_page + 1;
$next = $next > $paginated->page_count ? 0 : $next;

// print_r($paginated);
?>

<div class="pagination-container">
    <a
        href="<?php echo $paginate_btn_path . "?page=$prev"; ?>"
        class="button previous <?php echo !$prev ? "paginate-btn-disabled" : "" ?>"
    >
        <img src="<?php echo asset('icons/', 'gt.svg'); ?>" alt="greater-than">
    </a>
    <?php for($ndx=1;$ndx<=$paginated->page_count;$ndx++):?>
        <a
            href="<?php echo $paginate_btn_path . "?page=$ndx"; ?>"
            class="items button <?php echo $paginated->current_page == $ndx ? "paginate-active" : "" ?>"
        >
            <?php echo $ndx; ?>
        </a>
    <?php endfor;?>
    <a
        href="<?php echo $paginate_btn_path . "?page=$next"; ?>"
        class="next button <?php echo !$next ? "paginate-btn-disabled" : "" ?>"
    >
        <img src="<?php echo asset('icons/', 'lt.svg'); ?>" alt="less-than">
    </a>
</div>

