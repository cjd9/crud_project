<div>
    <?php
    $hiddenfields = array('redirect' => $redirect, 'access_token'=>$this->session->access_token,'user_id'=>$this->session->user_id);
    $attributes = array('id' => 'signinform', 'name' => 'signinform');
    echo form_open(base_url('signin'), $attributes, $hiddenfields);
    echo '<pre>';print_r($this->session->user_details); echo '</pre>';
    ?>
    <p><?php echo $this->common_Model->getMessage(); echo validation_errors(); ?></p>
    <p>Username: <input type="text" name="user_name" id="user_name" placeholder="User Name" /></p>
    <p>Password: <input type="password" name="password" id="password" placeholder="Password" /></p>
    <p><input type="submit" value="Login" /></p>
    <?php echo form_close(); ?>
</div>