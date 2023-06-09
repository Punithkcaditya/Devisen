<!DOCTYPE html>
<html  lang="en">
    <?php $this->load->view('templates/includes/common/header'); ?>
    <body class="main-page pc">
		<?php $this->load->view('templates/includes/common/header_menu'); ?>
		<?php $this->load->view('templates/includes/common/slider'); ?>
		<?php $this->load->view('templates/includes/home_page_body'); ?>
		<?php $this->load->view('templates/includes/common/footer_home'); ?>
		<!-- scripts related to this page -->
		<?php if (!empty($scripts) && count($scripts) > 0): ?>
			<?php foreach ($scripts as $script): ?>
				<script src="<?php echo $script; ?>"></script>
			<?php endforeach ?>
		<?php endif ?>
	
    </body>

</html>