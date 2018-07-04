<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//echo '----->'.$default['status'];
// dd($admin_user);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>

    <!-- Bootstrap core CSS -->

    <link href="<?= base_url() ?>sb-admin/css/bootstrap.css" rel="stylesheet">
 
     <!-- Add custom CSS here -->
    <link href="<?= base_url() ?>sb-admin/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet"
          href="<?= base_url() ?>sb-admin/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css"
          href="<?= base_url() ?>sb-admin/css/datatables.min.css"/>

    <link href="<?= base_url() ?>sb-admin/css/jquery.cleditor.css" rel="stylesheet">    
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>

  </head>

  <body>
 
    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">SB Admin Panel</a> 
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
<?php if( $this->ion_auth->logged_in() ): ?>           
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
<!-- Dash Board -->           
            <li><a href="<?= base_url() ?>site_dashboard/welcome"><i class="fa fa-dashboard fa-lg"></i> Dashboard</a></li>
<!-- CMS Webpages -->
            <li>
                <a href="<?= base_url() ?>webpages/manage""><i class="fa fa-folder fa-lg"></i> Public Websites</a>
            </li>
<!-- Manage Ad Sales -->            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-caret-square-o-down fa-lg"></i> Ad Sales <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?= base_url() ?>msite_ads/manage">
                    <i class="fa fa-angle-double-right"></i> Manage Items</a></li>
                <li><a href="<?= base_url() ?>msite_categories/manage">
                    <i class="fa fa-angle-double-right"></i> Manage Categories</a></li>
                <li><a href="<?= base_url() ?>msite_accounts/manage">
                    <i class="fa fa-angle-double-right"></i> Manage Accounts</a></li>
              </ul>
            </li>
<!-- Blog -->
            <li>
                <a href="<?= base_url() ?>site_dashboard/welcome"><i class="fa fa-edit fa-lg"></i> Blog</a>
            </li>
<!-- Members -->
            <li><a href="<?= base_url() ?>site_users/manage"><i class="fa fa-users fa-lg"></i> Members</a></li>

            <li><a href="<?= base_url() ?>site_users/index"><i class="fa fa-users fa-lg"></i> Index</a></li>
<!-- Members -->
            <li><a href="<?= base_url() ?>enquiries/inbox"><i class="fa fa-users fa-lg"></i> Enquiries</a></li>

<!-- Site Settings -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-cog fa-lg"></i> Site Settings<b class="caret"></b></a>

              <ul class="dropdown-menu">
                <li><a href="<?= base_url() ?>site_dashboard/welcome">
                    <i class="fa fa-angle-double-right"></i>  General Settings</a></li>
                <li><a href="<?= base_url() ?>site_admin_terms_conditions/manage">
                    <i class="fa fa-angle-double-right"></i> Terms-Conditions</a></li>
                <li><a href="<?= base_url() ?>site_admin_emails/manage">
                    <i class="fa fa-angle-double-right"></i> Emails</a></li>
                <li><a href="<?= base_url() ?>site_upload_categories/manage">
                    <i class="fa fa-angle-double-right"></i> Manage Upload Categories</a></li>
              </ul>
            </li>
          </ul>
 <?php endif; ?>
<!-- end of leftside nav -->

          <ul class="nav navbar-nav navbar-right navbar-user" style="border: 1px #fff solid;">
<?php if( $this->ion_auth->logged_in() ): ?>           
            <li class="dropdown messages-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages For Admin <span class="badge">7</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">7 New Messages</li>
                <li class="message-preview">
                  <a href="<?= base_url() ?>site_messages/create/1">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name">John Smith:</span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name">John Smith:</span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name">John Smith:</span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li><a href="#">View Inbox <span class="badge">7</span></a></li>
              </ul>
            </li>
<?php endif; ?>

<?php if( $this->ion_auth->logged_in() ): ?>                     
                <!-- Logged In -->
                <li class="dropdown user-dropdown" style="padding: 0px 30px 0px 0px;">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-user"></i> <?= $default['admin_name'] ?> <span class="label label-success"><?= $default['admin_id'] ?></span> <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                      <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                      <li><a href="#"><i class="fa fa-envelope">
                          </i> Send Message </a></li>
                      <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                      <li class="divider"></li>
                      <li><a href="<?= base_url() ?>auth/logout"><i class="fa fa-power-off"></i> Log Out</a></li>
                  </ul>
                </li>
<?php else:  ?>        
                <li style="padding: 0px 30px 0px 0px;"><a href="<?= base_url() ?>">
                <i class="fa fa-sign-in fa-lg" aria-hidden="true"></i> Home Page</a></li>
<?php endif; ?>

          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <ol class="breadcrumb">
              <li><a href="<?= base_url() ?>site_dashboard/welcome"><i class="icon-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="icon-file-alt"></i><?= $default['page_nav'] ?></li>
              <span class="pull-right"> <?= $default['is_admin'] ?> </span>
            </ol>
            <?php
                if( isset($page_url) ){
                    // echo '<h3>View page: '.$view_module.'/'.$page_url.'</h3>';
                  $this->load->view($view_module.'/'.$page_url);
                }
            ?>        
          </div>
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="<?= base_url() ?>sb-admin/js/jquery-1.10.2.js"></script>
    <script src="<?= base_url(); ?>sb-admin/js/jquery-migrate-1.0.0.min.js"></script>        
    <script src="<?= base_url() ?>sb-admin/js/bootstrap.js"></script>

    <div class="col-md-8 col-md-offset-3">
        <!-- member_app.js -->
        <?php if( !empty($custom_jscript) ){
            foreach ( $custom_jscript as $value) { ?>
              <script src="<?= base_url() ?><?= $value ?>.js"></script>
            <?php }
        }?>
        <div>Page rendered time: {elapsed_time} seconds</div>          
    </div>    

  </body>
</html>