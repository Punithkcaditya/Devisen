<?php if ($w->area_id == 1 && $page_items->template_id == 1) { ?>
    <?php
    $line = $w->widget_content->page_short_description;
    if (preg_match('/^.{1,' . 1110 . '}\b/s', $w->widget_content->page_short_description, $match)) {
        $line = $match[0];
    }
    ?>
    <div class="col-md-7">
        <div class="about-right">
            <h2><span><?php echo $w->widget_title; ?></span></h2>
            <div class="about-text">
                <?php echo $line; ?>
                <a class="read-more" href="<?php echo (!empty($w->widget_url)) ? $w->widget_url : $w->widget_content->page_slug; ?>" target="<?php echo $w->link_target; ?>"><?php echo $w->link_text; ?></a>
            </div>
        </div>
    </div>
<?php } ?>