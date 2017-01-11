<?php
define('HOME_URL', base_url());
define('JS_URL', HOME_URL . JS_PATH);
define('CSS_URL', HOME_URL . CSS_PATH);
define('IMG_URL', HOME_URL . IMG_PATH);
define('BS_URL', HOME_URL . BS_PATH);
define('PLUGINS_URL', HOME_URL . PLUGINS_PATH);
define('PRPIC_URL', HOME_URL . PRPIC_PATH);
define('PRPICTH_URL', HOME_URL . PRPICTH_PATH);
#pr($this->session,1);
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $pagetitle; ?> - O Care Doctor</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>/style.css">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" type="text/css" href="<?php echo BS_URL; ?>css/bootstrap.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>/AdminLTE.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo CSS_URL; ?>/skins/_all-skins.min.css">
        <!-- Jquery UI CSS -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <!-- Profile CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL; ?>profile.css">
        <!-- Select2 CSS -->
        <link rel="stylesheet" href="<?php echo PLUGINS_URL; ?>/select2/select2.min.css">
         <!-- Data Table Css-->
        <link href=" https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="<?php echo PLUGINS_URL; ?>/formValidation/formValidation.min.css" rel="stylesheet">
        <link href="<?php echo PLUGINS_URL; ?>/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet">
        
        <link href="<?php echo CSS_URL; ?>/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <link href="<?php echo PLUGINS_URL; ?>bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet">
        
        <link href="<?php echo PLUGINS_URL; ?>toastr/toastr.min.css" rel="stylesheet">
        
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <?php
        if (isset($css)):
            foreach ($css as $v):
                ?><link rel="stylesheet" href="<?php echo $v; ?>"><?php
            endforeach;
        endif;
        ?>
        <!-- jQuery Min -->
       
        <script>
            var HOME_URL = '<?php echo HOME_URL; ?>';
            var JS_URL = '<?php echo JS_URL; ?>';
            var CSS_URL = '<?php echo CSS_URL; ?>';
            var IMG_URL = '<?php echo IMG_URL; ?>';
            var BS_URL = '<?php echo BS_URL; ?>';
            var PLUGINS_URL = '<?php echo PLUGINS_URL; ?>';
            var PRPICTH_URL = '<?php echo PRPICTH_URL; ?>';
            var PRPIC_URL = '<?php echo PRPIC_URL; ?>';
        </script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="<?php echo base_url(); ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>D</b>oc</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><strong>Dashboard</strong></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <?php
                    if (isset($this->session->user_id)):
                        ?>
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">

                                <!-- User Account: style can be found in dropdown.less -->
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <span class="hidden-xs"><?php echo $this->session->fname; ?></span> 
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- User image -->
                                        
                                            <p>
                                                <?php echo $this->session->full_name; ?>
                                            </p> 
                                            <p>
                                                <?php echo '(' . $this->session->user_name . ')'; ?>
                                            </p>
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="<?php echo base_url('myprofile'); ?>" class="btn btn-default btn-flat">Profile</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="<?php echo base_url('logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <!-- Control Sidebar Toggle Button -->
                            </ul>
                        </div>
                    <?php endif; ?>
                </nav>
            </header>
