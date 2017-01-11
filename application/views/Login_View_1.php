<div class="content-wrapper">
    <div class="col-md-6 col-md-offset-3"> 
        <h4></span>Login form<span class="glyphicon glyphicon-user"></h4><br/>
        <div class="block-margin-top">
            <?php echo form_open(base_url('login'), array('class' => 'form-signin col-md-8 col-md-offset-2', 'role' => 'form')); ?>
                <?php 
                $mes = $this->common_Model->getMessage();
                if($mes):
                    ?>
            <div class="row alert alert-danger alert-dismissible"><?php echo $mes; ?></div>
                        <?php
                endif;
                ?>
                
                        <?php echo form_error('user_name'); ?>
                Username:<input type="text" name="user_name" class="form-control" placeholder="User Name" value="<?php echo set_value('user_name'); ?>" required autofocus><br/><br/>
                <?php echo form_error('password'); ?>
                password:<input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password'); ?>" required><br/><br/><?php echo ""; ?>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button><br/>
                <?php echo form_close(); ?>
        </div>
    </div>
</div>
<style>
    .error{
        
        color: #FF0000;
        font-size:13px;
    }
</style>

