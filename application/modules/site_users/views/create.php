
<?php
	$form_location = base_url().$this->uri->segment(1)."/update_user/".$update_id;
  $show_buttons = true;
  $admin_mode = $default['admin_mode'] == 'admin_portal' ? 0 : 1

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
<?php if( $mode == 'admin_member_profile' )
          $this->load->view( 'default_module/admin_banner');  ?>
<!-- Member Details Banner -->

<!-- form -->
<div class="row" <?= $user_form ?> >    
  <div class="col-md-12">
    <form id="users_admin" class="form-horizontal"
          method="post" action="<?= $form_location ?>" >
          <input type="hidden" id="set_dir_path" name="set_dir_path"
                 value="<?= $admin_mode ?>">

          <input type="hidden" id="base_url" name="base_url"
                 value="<?= $base_url ?>">


          <!-- Nav tabs -->
          <div class="card">
            <ul class="nav nav-tabs nav-clr" role="tablist">
              <li role="presentation" class="active"><a href="#user_main" aria-controls="user" role="tab" data-toggle="tab"><i class="fa fa-user"></i>  <span>User</span></a></li>

              <li role="presentation" ><a href="#user_address" aria-controls="Address" role="tab" data-toggle="tab"><i class="fa fa-home"></i>  <span>Home Address</span></a></li>

              <li role="presentation" ><a href="#user_mail_to" aria-controls="Mail_Address" role="tab" data-toggle="tab"><i class="fa fa-home"></i>  <span>Mail Address</span></a></li>

              <li role="presentation"><a href="#user_info" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-user"></i>  <span>Profile</span></a></li>

              <li role="presentation"><a href="#user_family" aria-controls="family" role="tab" data-toggle="tab"><i class="fa fa-user"></i>  <span>Family</span></a></li>

              <li role="presentation"><a href="#user_employment_le" aria-controls="user_employment_le" role="tab" data-toggle="tab"><i class="fa fa-plus-square-o"></i>  <span>Law Enforcement</span></a></li>

              <li role="presentation"><a href="#user_employment_prv_sector" aria-controls="user_employment_prv_sector" role="tab" data-toggle="tab"><i class="fa fa-plus-square-o"></i>
                <span>Private Sector</span></a></li>
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="user_main">
                <?php 
                  $data['fld_group'] = $users;
                  $data['submit_id']  = 'submit-user_main';
                  $data['add_on'] = '';
                  $this->load->view( 'create_partial', $data);
                ?>
              </div>

              <div role="tabpanel" class="tab-pane" id="user_address">
                <?php 
                  $data['fld_group'] = $user_address;
                  $data['submit_id']  = 'submit-user_address';              
                  $data['add_on'] = '';                  
                  $this->load->view( 'create_partial', $data);
                ?>
              </div>

              <div role="tabpanel" class="tab-pane" id="user_mail_to">
                <?php 
                  $data['fld_group'] = $user_mail_to;
                  $data['submit_id']  = 'submit-user_mail_to';                            
                  $data['add_on'] = '';                  
                  $this->load->view( 'create_partial', $data);
                ?>
              </div>

              <div role="tabpanel" class="tab-pane" id="user_info">
                <?php 
                  $data['fld_group'] = $user_info;
                  $data['submit_id']  = 'submit-user_info';                            
                  $data['add_on'] = '';                  
                  $this->load->view( 'create_partial', $data);
                ?>
              </div>
              <div role="tabpanel" class="tab-pane" id="user_family">
                <?php 
                  $data['fld_group'] = $user_family;
                  $data['submit_id']  = 'submit-user_family';
                  $data['add_on'] = 'partial_children';                           
                  $this->load->view( 'create_partial', $data);
                  unset($data['add_on']);
                ?>
              </div>
              <div role="tabpanel" class="tab-pane" id="user_employment_le">
                <?php 
                  $data['fld_group'] = $user_employment_le;
                  $data['submit_id']  = 'submit-user_employment_le';                            
                  $data['add_on'] = '';                  
                  $this->load->view( 'create_partial', $data);
                ?>
              </div>

              <div role="tabpanel" class="tab-pane" id="user_employment_prv_sector">
                <?php 
                  $data['fld_group'] = $user_employment_prv_sector;
                  $data['submit_id']  = 'submit-user_employment_prv_sector';
                  $this->load->view( 'create_partial', $data);
                ?>
              </div>
            </div> <!-- Tab panes -->

          </div> <!-- card end -->
    </form>
    <!-- //form -->
  </div>  
</div> <!-- // end row -->

<div class="row">
<div class="col-md-12" style="margin-top: -15px;" >
  <?php if( is_numeric($update_id) && $show_buttons && ($mode == 'admin_member_profile') ): ?>
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

