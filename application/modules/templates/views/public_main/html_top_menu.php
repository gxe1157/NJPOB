<?php defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->module('site_security');
    $status = $this->site_security->is_logged_in();
?> 


    <div class="row">
    <?php if( ENVIRONMENT == 'development'){ echo '<div style="display: block; height: 5px; background: red;">&nbsp;</div>';} ?>
    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <?php if( !$status ) { ?>
                <a href="<?= base_url() ?>youraccount/logout"  style="color: white;">
                <button type="button" class="navbar-toggle  pull-left" style="margin-left: 10px;"
                         data-toggle="collapse" data-target="#myNavbar">
                  <span class="glyphicon glyphicon-log-out"> Login Out</span> 
                </button>
                </a>
            <?php } ?>

          <button type="button" class="navbar-toggle"
                   data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
              <?php
                foreach ($parent_titles as $parentid => $sub_title) {
                  if( is_array($sub_title) ) {
                      echo '<li class="dropdown">';
                      echo '<a href="'.$target_url_start.$sub_title[0]->link.'" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">';
                      echo $parentid.'<span class="caret"></span></a>';

                      /* subtiltes*/
                      if($sub_title){
                        echo '<ul class="dropdown-menu">';
                           foreach( $sub_title as $line ) {
                             $link_url = $line->link;
                             echo '<li><a href="'.$target_url_start.$link_url.'">'.$line->title.'</a></li>';
                           }
                        echo '</ul>';
                      }

                      echo '</li>';
                  } else {
                      echo '<li><a href="'.$target_url_start.$sub_title.'">'.$parentid.'
                      </a></li>';
                  } 
              }
            ?>
          </ul>

          <?php
            if( $status ) { ?>
                <ul class="nav navbar-nav navbar-right">
                   <li><a href="<?= base_url() ?>youraccount/login">
                   <span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            <?php } else { ?>         
              <ul class="nav navbar-nav navbar-right">            
                <li><a href="<?= base_url() ?>youraccount/logout">
                <span class="glyphicon glyphicon-log-out"></span> Login Out</a></li>
              </ul>
              
              <ul class="nav navbar-nav navbar-right navbar-user">
                <li class="dropdown messages-dropdown">
                  <a href="<?= base_url() ?>enquiries/user_inbox" ><i class="fa fa-envelope"></i> Messages <span class="badge">7</span></a>
                </li>
<!--                 <li class="dropdown alerts-dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Default <span class="label label-default">Default</span></a></li>
                    <li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>
                    <li><a href="#">Success <span class="label label-success">Success</span></a></li>
                    <li><a href="#">Info <span class="label label-info">Info</span></a></li>
                    <li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>
                    <li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>
                    <li class="divider"></li>
                    <li><a href="#">View All</a></li>
                  </ul>
                </li>
 -->
              </ul>

          <?php } ?>
        </div>
    </nav>
    </div>
