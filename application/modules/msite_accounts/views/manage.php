<?php
	if( isset( $default['flash']) ) {
		echo $this->session->flashdata('item');
		unset($_SESSION['item']);
	}
?>

<h2 style="margin-top: -5px;"><small><?= $default['headline'] ?></small></h2>
<p style="margin-top: 30px,">
	<a href="<?= base_url().$this->uri->segment(1) ?>/create" >
		<button type="button" class="btn btn-primary"><?= $default['add_button'] ?></button></a>
</p>

<div class="row">		
	<div class="col-md-12">
			<table id="example" class="table table-striped table-bordered"
				   cellspacing="0" width="100%">
			  <thead>
				  <tr>
					  <th>First Name</th>
					  <th>Last Name</th>
					  <th>Company</th>
					  <th>Date Created</th>
					  <th>-----</th>					  
					  <th>Actions</th>
				  </tr>
			  </thead>   
			  <tbody>

					<?php
						$this->load->module('timedates');					
						foreach( $columns->result() as $row ) {
						$edit_url = $redirect_url."/".$row->id;	
						$create_date = $this->timedates->get_nice_date($row->create_date, 'cool')			
					?>
						<tr>
							<td class="right"><?= $row->firstname ?></td>
							<td class="right"><?= $row->lastname ?></td>
							<td class="right"><?= $row->company ?></td>
							<td class="right"><?= $create_date ?></td>
							<td class="right">&nbsp;</td>

							<td class="center">
								<a class="btn btn-success" href="#">
									<i class="halflings-icon white zoom-in"></i>  
								</a>
								<a class="btn btn-info" href="<?= $edit_url ?>">
									<i class="halflings-icon white edit"></i>  
								</a>
							</td>
						</tr>
			    	<?php } ?>			    

			  </tbody>
		  </table>            
	</div><!--/span-->

</div><!--/row-->