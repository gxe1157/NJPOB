
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	if( isset( $default['flash']) ) {
		echo '<div id="flash">';
			echo $this->session->flashdata('item');
			unset($_SESSION['item']);
		echo '</div>';
	}

    $admin_mode = $default['admin_mode'] == 'admin_portal' ? 0 : 1;	
?>

<?php if( $default['admin_mode'] == 'admin_portal' ) { ?>
	<h2 style="margin-top: -5px;"><small><?= $default['page_title'] ?></small></h2>
<?php } ?>

<!-- Memeber Detail Panel -->
<div class="row">
    <?php if( $default['admin_mode'] == 'admin_portal' ) {
        $this->load->view( 'default_module/admin_banner'); } ?>
</div>
<!-- // Memeber Detail Panel -->
<div class="row">
	<div style="padding: 0px 0px 10px 20px;">
	    <a class ="btnSubmitForm"
	       id="Legislative Out Reach"
	       href="<?= base_url().$this->uri->segment(1) ?>">
	      <button type="button" class="btn btn-primary">Add New Voter</button>
	    </a>
		<a href="<?= $cancel_button_url ?>" >
			<button type="button" class="btn btn-default">Cancel</button>
		</a>
	</div>
</div>	

<div class="row">		
	<div class="col-md-12">
			<form>
				<input type="hidden" name="base_url"
					   id="base_url" value="<?= $base_url ?>" />
      			<input type="hidden" 
      			       id="set_dir_path" name="set_dir_path" value="<?= $admin_mode ?>">
			</form>	

			<table id="example" class="table table-striped table-bordered">
			 <thead>
				  <tr>
					  <th style="width: 16%;">Member Name</th>
					  <th style="width: 16%;">Voter Name</th>
					  <th style="width: 20%;">City</th>					  
					  <th style="width: 28%;">Email</th>
					  <th style="width: 20%;">--</th>					  
				  </tr>
			  </thead>
			  <tbody>

			    <?php
			    	// checkArray($columns->result(),1);
			    	foreach( $columns->result() as $row ){
			    	 	$edit_url = $row->id.'/'.$row->user_id;
			    	 	$remove = $redirect_base.'/delete/'.$row->id;
			    	 	$fullname = $row->first_name.' '.$row->last_name;
			    	 	$member_name = $row->userfirst.' '.$row->userlast;
			    ?>
						<tr>
							<td class="right"><?= $member_name ?></td>
							<td class="right"><?= $fullname ?></td>
							<td class="right"><?= $row->city ?></td>
							<td class="right"><?= $row->email ?></td>
							<td class="center">
								<a class="btn btn-danger btn-sm btnConfirm" id="delete-danger"
							   	style="margin-top: 2px; width: 75px; font-size: 12px; padding: 2px;"
							   	href="<?= $remove ?>">
							  	<i class="fa fa-trash fa-fw"></i> Remove
								</a>
								<a class="btn btn-info btn-sm btn-edit"
								   id="edit-<?= $edit_url ?>"
							   	   style="margin-top: 2px; width: 75px; font-size: 12px; padding: 2px;"
							   	   href="<?= $edit_url ?>">
							  	<i class="fa fa-pencil fa-fw"></i> Edit
								</a>
							</td>    							
						</tr>
			    <?php } ?>
			  </tbody>
		  </table>
	</div><!--/span-->

</div><!--/row-->
