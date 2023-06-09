<?php error_reporting(E_ALL & ~E_NOTICE); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <base href="<?php echo base_url(); ?>"/>
    <title><?php echo $page_items->meta_title; ?></title>
    <meta name="title" content="<?php echo $page_items->meta_title; ?>" />
    <meta name="keywords" content="<?php echo $page_items->meta_keywords; ?>" />
    <meta name="description" content="<?php echo $page_items->meta_description; ?>" />
    <link rel="shortcut icon" href="assets/images/icon.ico" type="image/x-icon" />
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
	

    <link rel="stylesheet" href="<?php echo base_url('/assets/css/main.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/responsive.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/jquery.fancybox.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/font-awesome.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/jquery.owl.carousel.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/animate.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/aos.css">
    <link rel="stylesheet" type="text/css" href="assets/rs-plugin/css/settings.css" media="screen" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<!--styles -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>