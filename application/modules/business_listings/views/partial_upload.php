<?php defined('BASEPATH') OR exit('No direct script access allowed');
  $arrImgNames = [];
  // $admin_mode = $default['admin_mode'] == 'admin_portal' ? 0 : 1;
?>

<div class="row">
  <div style="padding: 0px 0px 10px 20px;">  
    <button type="button" class="btn btn-primary" id="openUploadModal" > Add Image
    </button>
  </div>
</div>  

<div class="row">
  <div class="col-md-12">

      <table class="table table-striped table-bordered"
             id="table_contents" cellspacing="0" width="90%">
        <thead>
          <tr>
            <th style="width: 20%;">Image</th>
            <th style="width: 25%;">Caption</th>
            <th style="width: 20%;">Image Name</th>
            <th style="width: 10%;">Upload Date</th>
            <th style="width: 25%;">Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php
            $x = 0;

            foreach( $images_list as $key => $value ) {
              $record_id = $value->id;
              $show_img  = base_url().'upload/business_listings/'.$value->image;

              $image_recno = $value->id;
              $remove_name  = explode("_",$value->image);
              $image_name  = $value->image;
              $image_org_name = $value->orig_name;
              $caption = $value->caption;
              
              if(!empty($image_name))
                         $arrImgNames[] = $image_org_name;
              $create_date = convert_timestamp( $value->create_date, 'datepicker_us');
          ?>
            <tr id="tr<?= $x ?>" >
              <td>
                <img src="<?= $show_img ?>"
                     class = "img img-responsive"
                     style="width: 100%;">
              </td>

              <td class="right">
                  <?= $caption ?>
              </td>
              <td class="right" id="image_name_<?= $x ?>"><?= $image_org_name;  ?></td>
              <td class="right" id="image_date_<?= $x ?>"><?= $create_date;  ?></td>
              <td class="center">
                        <button class="btn btn-danger btn-sm"
                                id="<?= $record_id ?>|<?= $x ?>"
                                value="<?= $remove_name[1] ?>"
                                type="button"
                                onClick="javascript: remove(this)" >
                              <i class="fa fa-trash-o" aria-hidden="true"></i> Remove
                        </button>                     

                        <button  class="btn btn-info btn-sm btn-edit"
                                 id="<?= $record_id ?>|2"
                                 type="button"
                                 onClick="javascript: edit(this) "> Edit
                        </button>
            </td>       

            </tr>
            <?php $x++; } ?>
        </tbody>
      </table>
  </div><!-- //col-md-12-->


</div><!-- //row-->

<div class="row">
<div class="col-md-12 ">
  <!-- use bootstrap alert codes: warning, danger etc. -->
  <a href="<?= base_url().$return_url ?>">
    <button type="button" class="btn btn-default tab-button">Cancel</button></a>
</div>




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
                      id="get_property"
                      type="submit"> Upload
              </button>   
            </div>
            
          </div>

          <div class="form-group" id='update_button' style="display: none;">
            <div class="col-sm-6 col-sm-offset-3">
              <button class="btn btn-primary"
                      id="updateRecord"
                      type="button"
                      onClick="javascript: update_record()">Update
              </button>   
            </div>
            
          </div>

        </form>
      </div>
 
    </div>

  </div>
</div>
</div>
