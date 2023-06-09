<?php
$line = $w->widget_content->event_short_desc;
if (preg_match('/^.{1,' . $settings->AREA1_CONTENT_SIZE . '}\b/s', $w->widget_content->event_short_desc, $match)) {
    $line = $match[0];
}
if ($w->area_id == 1 && $page_items->template_id == 1) {
    ?>
<div class="col-md-5">
    <div class="chrty small-seperator">
        <h2><span><?php echo substr($w->widget_title, 0, 20); ?></span></h2>
        <ul class="events-compact-list">
            <li class="event-list-item">	
                <span class="event-date">
                    <span class="date"><?php echo date("d", strtotime($w->widget_content->event_date)); ?></span>
                    <span class="month"><?php echo date("M", strtotime($w->widget_content->event_date)); ?><br><?php echo date("Y", strtotime($w->widget_content->event_date)); ?></span>
                </span>
                <div class="event-list-cont">
                    <h4><a href="<?php echo (!empty($w->widget_url)) ? base_url().$w->widget_url :  base_url(). 'events/' . $w->widget_content->event_slug; ?>"><?php echo substr($w->widget_content->event_title, 0, 60); ?></a></h4>
                    <p><?php echo strip_tags($line); ?></p>
                </div>
            </li>
        </ul>
    </div>
</div>
<?php } ?>