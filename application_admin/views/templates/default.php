<!DOCTYPE html>
<html>
<?php $this->load->view('templates/includes/head'); ?>
<body class="hold-transition login-page">
<?php $this->load->view($view); ?>

<!-- jQuery 2.2.0 -->
<script src="<?php echo base_url(); ?>../../myadmin/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>../../myadmin/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>../../myadmin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
