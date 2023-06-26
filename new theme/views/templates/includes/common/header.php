<?php error_reporting(E_ALL & ~E_NOTICE); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <base href="<?php echo base_url(); ?>"/>
    <title><?php echo $page_items->meta_title; ?></title>
    <meta name="title" content="<?php echo $page_items->meta_title; ?>" />
    <meta name="keywords" content="<?php echo $page_items->meta_keywords; ?>" />
    <meta name="description" content="<?php echo $page_items->meta_description; ?>" />
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon" />
    <?php $parts = $this->uri->segment(1); ?>
    <?php if (!empty($page_url) && $page_url > 1) {
        ?>   <link rel="canonical" href="<?php echo base_url() . $parts . '/' . $page_url; ?>"/>
    <?php } else if (!empty($page_items->canonical_url)) { ?>
        <link rel="canonical" href="<?php echo $page_items->canonical_url; ?>"/>
        <?php
    } if (!empty($page_items->redirection_link)) {
        header('Location:' . $page_items->redirection_link);
    }
    ?>
    <?php
    if ((!empty($prev)) && ($prev > 0)):
        if ($prev > 1) {
            $prev_no = '/' . $prev;
        } else {
            $prev_no = "";
        }
        ?>
        <link rel="prev" href="<?php echo(!empty($prev)) && ($prev > 0) ? base_url() . $parts . $prev_no : ''; ?>" />
    <?php endif ?>
    <?php if ((!empty($next)) && ($next > 0)): ?>
        <link rel="next" href="<?php echo(!empty($next)) ? base_url() . $parts . '/' . $next : ''; ?>"/>
    <?php endif ?>
    <?php
    $robots = array();
    if (!empty($page_items->nofollow_ind)) {
        $robots[] = 'NOINDEX';
    }
    if (!empty($page_items->noindex_ind)) {
        $robots[] = 'NOFOLLOW';
    }
    if (count($robots) > 0):
        ?>
        <META NAME="ROBOTS" CONTENT="<?php echo implode(', ', $robots); ?>" />
    <?php endif ?>
	



    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" >
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/flaticon-set.css" >
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/magnific-popup.css" >
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.min.css" >
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.theme.default.min.css" >
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.css" >
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootsnav.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive.css" >

    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap" rel="stylesheet">
	<!--styles -->

    
</head>