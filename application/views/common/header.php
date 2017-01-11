<div class="container">
        <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-12">
    <div class="logo">
    <img src="<?php echo IMG_URL; ?>logo.png" alt="logo">
    </div>
    </div>
 
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 login-reg-con">  
    <nav class="main-nav">
        
         <?php 
        $loggedIn = 0;
//        echo $this->session->user_name;
        if ($this->session->user_name != '') 
         {
        $loggedIn = 1;
        echo'<ul>
           Welcome <strong>'. ucfirst ( $this->session->user_name ).'</strong>
               
            <div class="dropdown">
              <a class="btn btn-primary" href="#navigation-main">
                <i class="fa fa-bars" aria-hidden="true" title="Skip to main navigation"></i>
              </a>
           <button class="dropbtn"></button>
           <div class="dropdown-content">
             <a href="#">Profile</a>
             <a href="#">link 2</a>
             <a class="#" href="' . base_url('signout') . '">LogOut</a>
           </div>
          </div>
           </ul>
           ';
       
        }
        else
        {
          echo' <ul>
            <!-- inser more links here -->
            <li><a class="cd-signin top-login-btn" href="#0">Log in</a></li>
            <li><a class="cd-signup btnhvr" href="#0">Register</a></li>
        </ul>';
        }
        ?>
    </nav>
   </div>
  </div>
    