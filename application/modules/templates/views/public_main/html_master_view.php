<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('html_head');?>

<body>
 <div>Mode: <?= $this->session->admin_mode;?></div> 

  <!--main container for page  -->
  <div class="container">
<!-- header image -->
      <div class="row">
        <div class="col-sm-12" style="padding: 10px 0 0 0; width: 100%;">

<!-- 		<video id="vidplayer" width="100%" height="100%"
		           autoplay="autoplay" loop="loop">

		    <source src="<?= base_url(); ?>public/videos/pob_header1.mp4"
		              type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />

		    <source src="<?= base_url(); ?>public/videos/pob_header1.ogv"
		              type='video/ogg; codecs="theora, vorbis"' />
		</video>
 -->
          <img class="img-responsive"
               src="<?= base_url() ?>public/images/sec_hdr.jpg"
               alt="NJPOB" style="width: 1200px; height: 190px;">
        </div>
      </div>
      <!-- //header image -->

<!-- top nav menu -->
      <!-- data for top nav bar come from template module -->
        <?php  $this->load->view('html_top_menu.php'); ?>
      <!-- // top nav menu -->

<!-- main content row  -->
      <div class="row">
          <!-- aside nav to left-->
            <?php
                if($left_side_nav == true)
                   $this->load->view( $nav_module.'html_aside', $data = null);
            ?>
          <!-- // aside nav to left-->

          <!-- content on right -->
          <?php $col_width = $left_side_nav ? 10 : 12; ?>
          <div class="col-sm-<?= $col_width ?> text-left">
              <!-- breadcrubm line  -->
              <div class="row">
                  <div class="col-sm-12" id="menu-mess-header">
                      <?= $page_title; ?>
                  </div>
              </div>
              <!-- // breadcrubm line  -->

              <div class="row">
                  <div class="col-sm-12" >
                    <?php $this->load->view($view_module.'/'.$contents, $data=null); ?>
                  </div>
              </div>
          </div>
          <!-- //content on right -->
        </div>
        <!-- // main content row  -->

<!-- Footer -->
        <div style="clear:both;"></div>
        <?php $this->load->view('html_footer'); ?>
        <!-- // Footer -->

    </div>
    <!-- // main container for page  -->

</body>
</html>
