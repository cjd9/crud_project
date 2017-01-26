
<div class="login-box">
  
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign up to register</p>

     <?php echo form_open(base_url(), array('role' => 'form','id'=>'signup_form'));
     $mes = $this->common_Model->getMessage();
     if($mes):
         ?>
            <div class="row alert alert-danger alert-dismissible"><?php echo $mes; ?></div>
         <?php
     endif;
     ?>
    <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
    <div class="alert alert-danger" style="display:none" id="validationerrors"></div>

      <div class="form-group has-feedback">
        <?php echo form_error('first_name'); ?>
              First Name:<input type="text" name="first_name" id="first_name"  class="form-control" placeholder="First Name" value="<?php echo set_value('first_name'); ?>" required autofocus>
      </div>

      <div class="form-group has-feedback">
        <?php echo form_error('last_name'); ?>
              Last Name:<input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="<?php echo set_value('last_name'); ?>" required autofocus>
      </div>
    
      <div class="form-group has-feedback">
        <?php echo form_error('password'); ?>
              Password:<input type="password" name="password" id="password" class="form-control" placeholder="Password" value="<?php echo set_value('password'); ?>" required><?php echo ""; ?>
               
      </div>

      <div class="form-group has-feedback">
        <?php echo form_error('confirm_password'); ?>
              Confirm Password:<input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" value="<?php echo set_value('confirm_password'); ?>" required><?php echo ""; ?>
               
      </div>

      <div class="form-group has-feedback">
        <?php echo form_error('email_id'); ?>
              Email ID:<input type="text" name="email_id" id="email_id" class="form-control" placeholder="Email ID" value="<?php echo set_value('email_id'); ?>" required autofocus>
      </div>

      <div class="form-group has-feedback">
        <?php echo form_error('mobile_no'); ?>
              Mobile No:<input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile No" value="<?php echo set_value('mobile_no'); ?>" required autofocus>
      </div>
    
      <div class="row">
        <div class="col-xs-4">
           <button class="btn btn-lg btn-primary btn-block" id="register_btn" >Sign up</button>
        </div>
        <!-- /.col -->
      </div>
  <?php echo form_close(); ?>

    <a href="<?php echo base_url('login')?>">Login?</a><br>
 
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


