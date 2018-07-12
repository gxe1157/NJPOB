
<?php
  if( isset( $default['flash']) ) {
      echo $this->session->flashdata('item');
      unset($_SESSION['item']);
  }

  $form_location = base_url().$this->uri->segment(1)."/create/".$update_id;
?>

<?php if( is_numeric($update_id) ) { ?>
  <div class="row">
    <div class="col-md-12">
    <h2 style="margin-top: -5px;"><small><?= $default['page_header'] ?></small></h2>    
      <div class="well">
          <a class ="btnConfirm " id="delete-danger"
             href="<?= base_url().$this->uri->segment(1) ?>/delete/<?= $update_id ?>/<?= $default['username'] ?>">
          <button type="button" class="btn btn-danger">Delete Account</button></a>
      </div>
    </div><!-- end 12 span -->
  </div><!-- end row -->
<?php } else { ?>
  <div class="well  well-sm">
    <h2 style="margin-top: 0px;"><small><?= $default['page_header'] ?> </small></h2>    
  </div>  
<?php } ?>

        <div class="row">
        <div class="col-md-12 ">
    <form id="business_app" class="form-horizontal" method="post" action="<?= $form_location ?>" >
          <input type="hidden" id="set_dir_path" name="set_dir_path"
                 value="<?= $admin_mode ?>">
          <input type="hidden" id="error_mess" name="error_mess"
                 value="<?= $error_mess ?>" >

          <?php
            $disable_submit = '';
            $end = count($columns);
            for($i = 0; $i < $end ; $i++ ) {
              $data['input_type'] = $columns[$i]['input_type'];           
              $data['label'] = $columns[$i]['label'];
              $data['field_name'] = $columns[$i]['field'];
              $data['placeholder'] = $columns[$i]['placeholder'];           
              $data['value'] = $columns[$i]['value'];
              $data['icon'] = $columns[$i]['icon'];

              switch ($data['input_type']) {
                  case "select":
                    $data['options'] = $bus_categories;
                    $this->load->view( 'default_module/partial_dropdown', $data);   
                      break;

                  case "textarea":
                  $this->load->view( 'default_module/partial_textarea', $data);   
                  break;

                  default:
                    $this->load->view( 'default_module/partial_text', $data);
              }
            } 
          ?>  

          <ul class="list-inline">
              <li><button type="submit" 
                    name="submit"
                    value="Cancel"
                    class="btn btn-default" >Cancel</button></li>                                                              
              <li><button type="submit"  
                    name="submit"
                    value="Submit"
                    id="submit_btn" 
                    class="btn btn-primary"><?= $action ?></button></li>
              <li><button type="button"
                   class="btn btn-primary"
                   id="openUploadModal" >Upload Image</button></li>
          </ul>
</form>                  
        </div>
        </div>

<!-- Modal -->
<div id="uploadModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">File upload form</h4>
      </div>
      <div class="modal-body">
        <!-- Form -->
        <form method='post' action='' enctype="multipart/form-data">
          Select file : <input type='file' name='file' id='file' class='form-control' ><br>
          <input type='button' class='btn btn-info' value='Upload' id='upload'>
        </form>

        <!-- Preview-->
        <div id='preview'></div>
      </div>
 
    </div>

  </div>
</div>
</div>




