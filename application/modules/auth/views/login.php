<?php
    if( $this->session->flashdata('logout_msg'))
             echo $this->session->flashdata('logout_msg');
?>

<div class='row'>
    <div class="col-sm-6 col-sm-offset-4 col-md-4 col-md-offset-4" >
      <h3>Please sign in</h3>
      <div id="infoMessage"><?php echo $message;?></div>      
      <br />

      <?php echo form_open("auth/login", 'class="form-signin" id="myform"');?>

      <div class="form-group">
        <?php echo lang('login_identity_label', 'identity'); ?>
        <?php echo form_input($identity); ?>
      </div>

      <div class="form-group">
        <?php echo lang('login_password_label', 'password');?>
        <?php echo form_input($password); ?>
      </div>

      <div class="form-group">
        <?php echo lang('login_remember_label', 'remember');?>
        <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
      </div>

      <div class="form-group"><?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-success"');?>
        <a href="<?= base_url(); ?> ">
          <button type="button" class="btn btn-secondary">Home Page</button>
      </div>

      <?php echo form_close();?>

      <div style="margin-bottom: 100px;"><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></div>
  </div>
</div>
