<!DOCTYPE html>
<html>
    <?php $this->load->view('templates/includes/head'); ?>
    <body class="hold-transition skin-blue sidebar-mini">
        <?php if(empty($popup_view)){ ?>
        <div class="wrapper">
            <?php $this->load->view('templates/includes/navigation') ?>
            <?php $this->load->view('templates/includes/sidebar_menu') ?>
            <div class="content-wrapper">
                <?php $this->load->view('templates/includes/breadcrumb') ?>
                <?php $this->load->view('templates/includes/body') ?>
            </div>
            <footer class="main-footer">
                <strong>Copyright &copy; 2019-2020. Design and developed by <a href="https://www.superiorcodelabs.com/" target="_blank">Superior Codelabs</a></strong>
            </footer>
        </div>
        <?php }else{ ?>
        <?php $this->load->view('templates/includes/body') ?>
        <?php } ?>
        <?php $this->load->view('templates/includes/scripts'); ?>
        <!-- scripts related to this page -->
        <?php if (!empty($scripts) && count($scripts) > 0): ?>
            <?php foreach ($scripts as $script): ?>
                <script src="/myadmin/<?php echo $script; ?>"></script>
            <?php endforeach ?>
        <?php endif ?>
    </body>
</html>
