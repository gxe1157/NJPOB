<style>
 .action-btns{
 	text-align: left;
	font-size: 12px;
	padding: 2px 5px;
	width: 125px;
	margin-top: 2px;
 }
</style>


<?php
	if( isset( $default['flash']) ) {
		echo $this->session->flashdata('item');
		unset($_SESSION['item']);
	}
?>

<h2 style="margin-top: -5px;"><small><?= $default['page_header'] ?></small></h2>
<p style="margin-top: 30px,">
	<a href="<?= base_url().$this->uri->segment(1) ?>/create" >
		<button type="button" class="btn btn-primary"><?= $default['add_button'] ?></button></a>
</p>

<div class="row">		
	<div class="col-md-12">
			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			  <thead>
				  <tr>
					  <th style="width: 10%">Last</th>
					  <th style="width: 15%">First</th>
					  <th style="width: 10%">Membership</th>
					  <th style="width: 20%">Email</th>
					  <th style="width: 6%">Joined</th>
					  <th style="width: 6%">Expire Dt</th>					  
					  <th style="width: 6%">Status</th>					  					  
					  <th style="width: 10%">Actions</th>
				  </tr>
			  </thead>   
			  <tbody>

					<?php
						$this->load->module('timedates');	
						foreach( $columns->result() as $row ) {
						    if( $row->is_delete > 0 ){
						        $show_status = 'Deleted';
						        $type = "danger";
						    } else {
						        $show_status = $row->status == 2 ? 'Suspened' : 'Acitve';
						        $type = $row->status == 2 ? 'warning' : 'primary';;
						    }							
							$edit_url = base_url().$this->uri->segment(1)."/update_user/".$row->id;
							$car_shield_url = base_url()."car_shields/manage_admin/".$row->id;
							$legislative_url = base_url()."legislative_outreach/manage_admin/".$row->id;
							$business_listings = base_url()."business_listings/manage_admin/".$row->id;							
							$create_date = convert_timestamp($row->create_date, 'datepicker_us'); ?>

						<tr>
							<td class="right"><?= $row->last_name ?></td>
							<td class="right"><?= $row->first_name ?></td>
							<td class="right"><?= $row->membership_level ?></td>
							<td class="right"><?= $row->email ?></td>
							<td class="right"><?= $create_date ?></td>
							<td class="right"> --- </td>
							<td class="right"><span class="label label-<?= $type ?>"> <?= $show_status ?> </span></td>							

							<td class="center">
								<a class="btn btn-default btn-sm action-btns" href="<?= $edit_url ?>">
									<i class="fa fa-user fa-fw"></i> Profile </a>
								<a class="btn btn-default btn-sm action-btns" href="<?= $car_shield_url ?>">
									<i class="fa fa-shield fa-lg" aria-hidden="true"></i> Car Shield </a>
								<a class="btn btn-default btn-sm action-btns" href="<?= $legislative_url ?>">
									<i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i> Legislative</a>
								<a class="btn btn-default btn-sm action-btns" href="<?= $business_listings ?>">
									<i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i> Business Listings</a>

							</td>
						</tr>
			    	<?php } ?>			    

			  </tbody>
		  </table>            

	</div><!--/span-->

</div><!--/row-->