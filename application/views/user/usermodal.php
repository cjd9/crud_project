<div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
    <div class="cd-user-modal-container "> <!-- this is the container wrapper -->
        
        <ul class="cd-switcher">
             <li><a href="#0">Log in</a></li>
             <li><a href="#0">Register</a></li>
             </ul>

        <div id="cd-login"> <!-- log in form -->
            <?php
            $hiddenfields = array('redirect' => $redirect);
            $attributes = array('id' => 'signinform', 'name' => 'signinform', 'class'=>'cd-form');
            echo form_open(base_url('signin'), $attributes, $hiddenfields);
            ?>
            <div id="error_login"></div>
                <p class="fieldset">
                    <label class="image-replace cd-email" for="signin-email">E-maile</label>
                    <input class="full-width has-padding has-border" name="user_name" id="signin-email" type="email" placeholder="E-mail/Mobile" />
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-password" for="signin-password">Password</label>
                    <input class="full-width has-padding has-border" name="password" id="signin-password" type="password"  placeholder="Password"/>
                    <a href="#0" class="hide-password">Show</a>
                </p>
                <button type="button" class="btn-info btnlgn" value="submit" id="login_submit_btn" name="login_submit_btn">LOGIN</button>
                    <a class="frgt-pswd fk-font-12 lpadding20 frgtpssd" href="javascript:void(0)">forgot password?</a>
            </form>

            <div class="social-share">
                <ul>
                    <li><a href="javascript:void(0);" onclick="fblogin();return false;"><img src="<?php echo IMG_URL; ?>fb.png" alt="Login Via Facebook"></a></li>
                    <li><a href="javascript:void(0);" ><img src="<?php echo IMG_URL; ?>google.png" id="gp" alt="Login Via Google+"></a></li>
                </ul>
            </div>
            
            <div class="g-signin2" style="visibility: hidden;" data-onsuccess="onSignIn" data-theme="dark" data-width="250" data-height="50" data-longtitle="true"></div>


            <!-- <a href="#0" class="cd-close-form">Close</a> -->
        </div> <!-- cd-login -->

        <div id="cd-signup"> <!-- sign up form -->
          
                
                 <?php
                 //'redirect' => base_url()
    $hiddenfields = array("redirect' => base_url()", 'access_token'=>$this->session->access_token,'user_id'=>$this->session->user_id);
    $attributes = array('id' => 'signupform', 'name' => 'signupform','class'=>'cd-form');
    echo form_open(base_url('register'), $attributes, $hiddenfields);
    //echo '<pre>';print_r($this->session->user_details); echo '</pre>';
    ?>
    <p><?php echo $this->common_Model->getMessage(); echo validation_errors(); ?></p>
    <div id="signup_error"> </div>
                <p class="fieldset">
                    <label class="image-replace cd-username" for="signup_full_name">Full Name</label>
                    <input class="full-width has-padding has-border" id="signup_full_name" name="full_name" type="text" placeholder="Full Name">
                    <span class="cd-error-message" id="signup_full_name_error">Error message here!</span>
                </p>
<!--                  <input class="full-width has-padding has-border" id="user_name" name="user_name" type="hidden" value="testname12z" placeholder="Username">-->

                <p class="fieldset">
                    <label class="image-replace cd-email" for="signup-email">E-mail</label>
                    <input class="full-width has-padding has-border" name="email_id" id="signup_email" type="text" placeholder="E-mail">
                    <span class="cd-error-message">Error message here!</span>
                </p>
                <p class="fieldset">
                    <label class="image-replace cd-mobile" for="signup-email">Mobile</label>
                    <input class="full-width has-padding has-border"  id="signup_mobile_no" name="mobile_no" id="signup-mobile" type="text" placeholder="Mobile" >
                    <span class="cd-error-message">Error message here!</span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-password" for="signup-password">Password</label>
                    <input class="full-width has-padding has-border" name="password" id="signup_password" type="text"  placeholder="Password">
                    <a href="#0" class="hide-password">Hide</a>
                    <span class="cd-error-message">Error message here!</span>
                </p>
                

                <p class="fieldset">
                    <p> I agree to the <a href="javascript:void(0);">Terms &amp; Conditions </a></p>
                </p>
 <p> <input type="hidden" name="user_source" id="user_source" value="web_app" /></p>
                <p class="fieldset">
                    <input class="full-width has-padding" id="register_submit_btn" type="submit" value="Create account">
                </p>
                
                  <?php echo form_close(); ?>
                
           

            <!-- <a href="#0" class="cd-close-form">Close</a> -->
        </div> <!-- cd-signup -->

        <div id="cd-reset-password"> <!-- reset password form -->
            <p class="cd-form-message">Lost your password? Please enter your email address. You will receive a link to create a new password.</p>

            <form class="cd-form">
                <p class="fieldset">
                    <label class="image-replace cd-email" for="reset-email">E-mail</label>
                    <input class="full-width has-padding has-border" id="reset-email" type="email" placeholder="E-mail">
                    <span class="cd-error-message">Error message here!</span>
                </p>

                <p class="fieldset">
                    <input class="full-width has-padding" type="submit" value="Reset password">
                </p>
            </form>

            <p class="cd-form-bottom-message"><a href="#0">Back to log-in</a></p>
        </div> <!-- cd-reset-password -->
        <a href="#0" class="cd-close-form">Close</a>
    </div> <!-- cd-user-modal-container -->
</div> <!-- cd-user-modal -->






<div id="fb-root"></div>
