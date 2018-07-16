<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <footer class="container text-center">
        <b>POWER * STRENGTH * RESOLVE<br />Together we make the thin blue line stronger!</b><br />
        Copyright &copy; 2013 - 2017 NJLEPOB&nbsp;&nbsp; All rights reserved. <br >
        <a href="#">About Us</a> | <a href="#">Terms and Conditions</a> | <a href="#">Contact Us</a><br >
        Tel 973-256-7390 -- Fax 973-256-7391
    </footer>
</div><br>

<script language="JavaScript1.2"
        type="text/javascript"
        src="<?= base_url(); ?>public/js/html5shiv.js">
</script>  

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-3.0.1.js"></script>
 -->
<script src="<?= base_url(); ?>sb-admin/js/jquery-1.10.2.js"></script>
<script src="<?= base_url(); ?>sb-admin/js/jquery-migrate-1.0.0.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- <script src="<?= base_url(); ?>public/js/site_loader_video.js"></script> -->


<!-- Use only for forms - https://github.com/nghuuphuoc/bootstrapvalidator -->
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js'></script> -->

<!-- member_app.js -->
<?php if( !empty($custom_jscript) ){
    foreach ( $custom_jscript as $value) { ?>
      <script src="<?= base_url() ?><?= $value ?>.js"></script>
    <?php }
}?>
  