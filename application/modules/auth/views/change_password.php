<div class='row'>
<div class="col-md-4 col-md-offset-4" style="margin-bottom: 50px;"> 

  <!-- <div id="infoMessage"><?php echo $message;?></div> -->
      <h1><?php echo lang('change_password_heading');?></h1>

      <div id="infoMessage"><?php echo $message;?></div>

      <?php echo form_open("auth/change_password");?>
          <?= form_hidden('mode', '0'); ?>

            <p>
                  <?php echo lang('change_password_old_password_label', 'old_password');?> <br />
                  <?php echo form_input($old_password);?>

            </p>

            <p>
                  <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
                  <?php echo form_input($new_password);?>
            </p>

            <p>
                  <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
                  <?php echo form_input($new_password_confirm);?>
            </p>

            <?php echo form_input($user_id);?>

            <p><a class="btn btn-default" href="<?= base_url('youraccount/welcome'); ?>" role="button">Cancel</a>
             <?php echo form_submit('submit', lang('change_password_submit_btn'),
                                                 array( 'class'=>'btn btn-success'));?>            
            </p>

      <?php echo form_close();?>

</div>
</div>

