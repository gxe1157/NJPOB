<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  if( isset( $default['flash']) ) {
    echo $this->session->flashdata('item');
    unset($_SESSION['item']);
  }

  $arrImgNames = [];
  $form_location = base_url().$this->uri->segment(1)."/create/".$update_id;
  $admin_mode = $default['admin_mode'] == 'admin_portal' ? 0 : 1;
?>

<h2 ><small><?= $default['headline'] ?></small>
  <span style="font-size: .6em; color: red;"><?= $headline_sub ?></span>
</h2>

<!-- form -->
<div class="row">    
  <div class="col-md-12">

          <!-- Nav tabs -->
          <div class="card">
            <ul class="nav nav-tabs nav-clr" role="tablist">
              <!-- role="presentation" class="active" -->
              <li role="presentation "><a href="#panel1" aria-controls="pane1" role="tab" data-toggle="tab"><i class="fa fa-user"></i>  <span>Membership Plan</span></a></li>

              <li role="presentation" ><a href="#panel2" aria-controls="panel2" role="tab" data-toggle="tab"><i class="fa fa-info" aria-hidden="true"></i>  <span>Member Benifits</span></a></li>

              <?php if( is_numeric($update_id)) : ?>
              <li <?= $li_upload ?> role="presentation"><a href="#panel3" aria-controls="panel3" role="tab" data-toggle="tab"><i class="fa fa-upload" aria-hidden="true"></i>  <span>Upload Images</span></a></li>
            <?php endif; ?>
            </ul>

    <form id="myForm" class="form-horizontal" method="post" action="<?= $form_location ?>" >
           <input type="hidden" id="show_panel" name="show_panel"
                 value="<?= $show_panel ?>" >

            <!-- Tab panes -->
            <div class="tab-content">

              <div role="tabpanel" class="tab-pane" id="panel1">
                <?php 
                  $data['start'] = 0;
                  $data['end'] =10;
                  $this->load->view( 'create_partial', $data);
                ?>
              </div>

              <div role="tabpanel" class="tab-pane" id="panel2">
                <?php 
                  $data['start'] = 10;
                  $data['end'] = 14;                  
                  $this->load->view( 'create_partial', $data);
                ?>
              </div>

              <?php if( is_numeric($update_id)) : ?>
              <div role="tabpanel" class="tab-pane" id="panel3">
                <?php 
                    $this->load->view('partial_upload');    
                ?>
              </div>
            <?php endif; ?>
            </div> <!-- Tab panes -->

          </div> <!-- card end -->
    </form>

    <!-- //form -->
  </div>  
</div> <!-- // end row -->

<!-- Modal -->
<?= $this->load->view( 'partial_upload_modal');?>
