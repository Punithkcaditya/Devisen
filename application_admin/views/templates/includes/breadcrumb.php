<section class="content-header">
    <h1><?php echo $page_heading; ?> <?php if (!empty($sub_heading)) { ?><small><?php echo $sub_heading; ?></small><?php } ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i><?php echo HOME; ?></a></li>
        <li class="active"><?php echo $breadcrumb; ?></li>
    </ol>
</section>