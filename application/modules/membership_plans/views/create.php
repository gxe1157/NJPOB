<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  if( isset( $default['flash']) ) {
    echo $this->session->flashdata('item');
    unset($_SESSION['item']);
  }

  $arrImgNames = [];
	$form_location = base_url().$this->uri->segment(1)."/create/".$update_id;
  $show_buttons = false;
  $admin_mode = $default['admin_mode'] == 'admin_portal' ? 0 : 1;
?>


<!-- Member Details Banner -->
<?php 
    // if( $default['admin_mode'] == 'admin_portal' ) $this->load->view( 'default_module/admin_banner')
?>
<!-- Member Details Banner -->

<!-- form -->
<div class="row">    
  <div class="col-md-12">

          <!-- Nav tabs -->
          <div class="card">
            <ul class="nav nav-tabs nav-clr" role="tablist">
              <!-- role="presentation" class="active" -->
              <li role="presentation "><a href="#panel1" aria-controls="pane1" role="tab" data-toggle="tab"><i class="fa fa-user"></i>  <span>Membership Plan</span></a></li>

              <li role="presentation" ><a href="#panel2" aria-controls="panel2" role="tab" data-toggle="tab"><i class="fa fa-info" aria-hidden="true"></i>  <span>Member Benifits</span></a></li>

              <li role="presentation"><a href="#panel3" aria-controls="panel3" role="tab" data-toggle="tab"><i class="fa fa-upload" aria-hidden="true"></i>  <span>Upload Images</span></a></li>
            </ul>

    <form id="business_app" class="form-horizontal" method="post" action="<?= $form_location ?>" >
<!--           <input type="hidden" id="set_dir_path" name="set_dir_path"
                 value="<?= $admin_mode ?>">
 -->          <input type="hidden" id="show_panel" name="show_panel"
                 value="<?= $show_panel ?>" >
<!--           <input type="hidden" id="cnt_errors" name="cnt_errors"
                 value="<?= $cnt_errors ?>" >
          <input type="hidden" id="error_mess" name="error_mess"
                 value="<?= $error_mess ?>" >
 -->              
            <!-- Tab panes -->
            <div class="tab-content">

              <div role="tabpanel" class="tab-pane" id="panel1">
                <?php 
                  $data['start'] = 0;
                  $data['end'] =8;
                  $this->load->view( 'create_partial', $data);
                ?>
              </div>

              <div role="tabpanel" class="tab-pane" id="panel2">
                <?php 
                  $data['start'] = 8;
                  $data['end'] = 9;                  
                  $this->load->view( 'create_partial', $data);
                ?>
              </div>

              <div role="tabpanel" class="tab-pane" id="panel3">
                <?php 
                  $this->load->view( 'partial_upload');    
                ?>
              </div>

            </div> <!-- Tab panes -->

          </div> <!-- card end -->
    </form>

    <!-- //form -->
  </div>  
</div> <!-- // end row -->

<!-- Modal -->
<div id="uploadModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">Close [ &times; ]</button>
        <h4 class="modal-title">File upload form</h4>
      </div>
      <div class="modal-body">
        <!-- Form -->
        <form id="upload-image-form" class="form-horizontal"
              method='post' action='' enctype="multipart/form-data">

          <input type="hidden" id="set_dir_path" name="set_dir_path"
                 value="<?= $admin_mode ?>">
          <input type="hidden" name="member_id" id="member_id"
                 value="<?= $member_id ?>" />
          <input type="hidden" id="base_url" name="base_url"
                   value = "<?= $base_url ?>" />                    
          <input type="hidden" id="module" name="module"
                   value = "<?= $module; ?>" />                    
          <input type="hidden" id="manage_rowid" name="manage_rowid"
                   value = "<?= $manage_rowid; ?>" />                    
          <input type="hidden" name="dbf_images" id="dbf_images"
                   value='<?= json_encode($arrImgNames) ?>' >
          <input type="hidden" name="rowId" id="rowId"
                   value='' >


          <div class="form-group">
            <label class="col-sm-3 control-label" for="show_rowId">Record ID</label>
                <div class="col-sm-2">
                    <input class="form-control"
                         type="text"
                         id="show_rowId"  readonly>
                </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="caption">Caption</label>
                <div class="col-sm-6">
                    <input class="form-control"
                         type="text"
                         id="caption"
                         name="caption"
                         placeholder="Enter Property ID here">
                      <span id="error_'+key+'" style="color:red; font-weight: bold;"></span>
                </div>
          </div>

          <div class="form-group" id='pre_upload'>
            <label class="col-sm-3 control-label" for="caption">Select file : </label>
                <div class="col-sm-6">
                    <input type='file' name='file[]' id='imageFile' class='form-control' >
                    <span id="error_'+key+'" style="color:red; font-weight: bold;"></span>
                </div>
          </div>
          
          <!-- Preview-->
          <div class="form-group" id="preview" style="display: block;">          
            <div class="col-sm-8 col-sm-offset-2">
                <img src="#"
                     class = "img img-responsive"
                     id = "modelPreviewImg"
                     style="width: 100%;">
            </div>
          </div>
          <!-- Preview-->

          <!-- Button Options  -->
          <div class="form-group" id='submit_button' style="display: none;">
            <div class="col-sm-6 col-sm-offset-3">
              <button class="btn btn-info"
                      id="upload"
                      type="submit"> Upload
              </button>   
            </div>
            
          </div>

          <div class="form-group" id='update_button' style="display: none;">
            <div class="col-sm-6 col-sm-offset-3">
              <button class="btn btn-primary"
                      id="updateRecord"
                      type="submit">Update
              </button>   
            </div>
            
          </div>

        </form>
      </div>
 
    </div>

  </div>
</div>