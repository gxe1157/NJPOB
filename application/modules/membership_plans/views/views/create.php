<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  if( isset( $default['flash']) ) {
    echo $this->session->flashdata('item');
    unset($_SESSION['item']);
  }

	$form_location = base_url().$this->uri->segment(1)."/create/".$update_id;
  $show_buttons = false;
  $admin_mode = $default['admin_mode'] == 'admin_portal' ? 0 : 1;
?>

<div class="row">
  <div class="col-md-12">
    <?php
        if( $default['is_deleted'] ){
          $show_buttons = false;
          echo '<div class="col-md-12 alert alert-danger">
                    <strong>Alert!</strong> This user account has been Deleted.
                </div>';      
        } else if( $status == 2 ) {
          echo '<div class="col-md-12 alert alert-warning">
                    <strong>Alert!</strong> This user account has been Suspened.
                </div>';      
        }             
    ?>      
    </div> <!-- // col-md-12 -->

<!-- Member Details Banner -->
<?php 
    if( $default['admin_mode'] == 'admin_portal' ) $this->load->view( 'default_module/admin_banner')
?>
<!-- Member Details Banner -->

<!-- form -->
<div class="row">    
  <div class="col-md-12">

          <!-- Nav tabs -->
          <div class="card">
            <ul class="nav nav-tabs nav-clr" role="tablist">
              <!-- role="presentation" class="active" -->
              <li role="presentation "><a href="#company_info" aria-controls="user" role="tab" data-toggle="tab"><i class="fa fa-user"></i>  <span>Company Information</span></a></li>

              <li role="presentation" ><a href="#services_provided" aria-controls="Address" role="tab" data-toggle="tab"><i class="fa fa-info" aria-hidden="true"></i>  <span>Service Provided</span></a></li>

              <li role="presentation"><a href="#upload_files" aria-controls="Address" role="tab" data-toggle="tab"><i class="fa fa-upload" aria-hidden="true"></i>  <span>Upload Photos</span></a></li>
            </ul>

    <form id="business_app" class="form-horizontal" method="post" action="<?= $form_location ?>" >
          <input type="hidden" id="set_dir_path" name="set_dir_path"
                 value="<?= $admin_mode ?>">
          <input type="hidden" id="cnt_errors" name="cnt_errors"
                 value="<?= $cnt_errors ?>" >
          <input type="hidden" id="error_mess" name="error_mess"
                 value="<?= $error_mess ?>" >
          <input type="hidden" id="show_panel" name="show_panel"
                 value="<?= $show_panel ?>" >
                 
            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane" id="company_info">
                <?php 
                  $data['start'] = 0;
                  $data['end'] = 10;
                  $this->load->view( 'business_listings/create_partial', $data);
                ?>
              </div>

              <div role="tabpanel" class="tab-pane" id="services_provided">
                <?php 
                  $data['start'] = 10;
                  $data['end'] = 14;                  
                  $this->load->view( 'business_listings/create_partial', $data);
                ?>
              </div>
    </form>
              <div role="tabpanel" class="tab-pane" id="upload_files">
                <?php 
                  $this->load->view( 'business_listings/partial_upload');    
                ?>
              </div>

            </div> <!-- Tab panes -->

          </div> <!-- card end -->


    <!-- //form -->
  </div>  
</div> <!-- // end row -->

<div class="row">
<div class="col-md-12" style="margin-top: -15px;" >
  <?php if( is_numeric($update_id) && $show_buttons && ($default['admin_mode'] == 'admin_portal') ): ?>
    <!-- use bootstrap alert codes: warning, danger etc. -->
    <a class ="btnConfirm" id="reset_pswrd-warning"
       href="<?= base_url().$this->uri->segment(1) ?>/update_password/<?= $update_id ?>">
      <button type="button" class="btn btn-primary ">Reset Password</button></a>
   
    <?php if($status == 2): ?>
      <a href="<?= base_url().$this->uri->segment(1) ?>/change_account_status/<?= $update_id ?>/1">
        <button type="button" class="btn btn-primary">Re-activate Account</button></a>
    <?php else: ?>    
      <a href="<?= base_url().$this->uri->segment(1) ?>/change_account_status/<?= $update_id ?>/2">      
        <button type="button" class="btn btn-primary">Suspend Account</button></a>
    <?php endif; ?>    


    <a href="<?= base_url().$this->uri->segment(1) ?>/update_password/<?= $update_id ?>">
      <button type="button" class="btn btn-primary tab-button">Payments</button></a>

    <a href="<?= base_url().$this->uri->segment(1) ?>/manage_uploads/<?= $update_id ?>">
      <button type="button" class="btn btn-info tab-button">Uploaded Image</button></a>


    <a class ="btnConfirm " id="delete-danger"
       href="<?= base_url().$this->uri->segment(1) ?>/delete/<?= $update_id ?>/<?= $default['username'] ?>">
      <button type="button" class="btn btn-danger">Delete Account</button></a>
  <?php endif ?>   
</div>
</div> <!-- row end -->

