<div class="login-box">
    <div class="login-logo">
        <p><b><?php echo SITE_TITLE; ?></b></p>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign In</p>
        <?php
        $msg = $this->session->flashdata('msg');
        if(!empty($msg)): ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <?php echo $msg['txt']; ?>
        </div>
        <?php endif; ?>

        <form action="" method="post">
            <div class="form-group has-feedback">
                <?php echo form_error("username"); ?>
                <input type="text" name="username" id="username" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <?php echo form_error('password'); ?>
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <div class="social-auth-links text-center" style="display: none;">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                Google+</a>
        </div>
        <!-- /.social-auth-links --><br>
        <div class="callout callout-info" style="display: none;">
            <a href="">forgot password</a>
            <a href="" style="float: right;">Sign Up</a>
        </div>
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->