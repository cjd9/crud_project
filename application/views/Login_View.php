
<div class="login-box">
  
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

     <?php echo form_open(base_url('login'), array('role' => 'form'));
     $mes = $this->common_Model->getMessage();
     if($mes):
         ?>
            <div class="row alert alert-danger alert-dismissible"><?php echo $mes; ?></div>
         <?php
     endif;
     ?>
    <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
      <div class="form-group has-feedback">
        <?php echo form_error('user_name'); ?>
              Username:<input type="text" name="user_name" class="form-control" placeholder="User Name" value="<?php echo set_value('user_name'); ?>" required autofocus>
      </div>
    
      <div class="form-group has-feedback">
        <?php echo form_error('password'); ?>
              Password:<input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password'); ?>" required><br/><br/><?php echo ""; ?>
               
      </div>
    
      <div class="row">
        <div class="col-xs-4">
           <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </div>
        <!-- /.col -->
      </div>
  <?php echo form_close(); ?>

    <a href="#">I forgot my password</a><br>
 
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


