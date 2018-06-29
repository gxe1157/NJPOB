
<?php
   		$this->load->module($site_controller);
		$show_parent_id = '';

		// /* Edit Update Sub Catergory title */
		// if( $mode == 'add_sub-category' ){
		// 	$parent_cat_title = $this->$site_controller->_get_cat_title($columns['parent_cat_id']);
		// 	$show_parent_id  ='<h4>Parent Category:
		// 						   <span style="margin-left: 5px; color: red; ">'.$parent_cat_title.'</span></h4>';
		// }							   

		/* Add New Sub Catergory title */
        if (($columns['parent_cat_id'] == 0) && $update_id && ($mode == 'add_sub-category')) {
			$parent_cat_title = $this->$site_controller->_get_cat_title($update_id);        	
			$columns['parent_cat_id'] = $update_id;
			$columns['cat_title'] ='';
			$update_id ='';
			$form_location = $redirect_base."/create/".$update_id;			

			$show_parent_id  ='<h4>Parent Category:
							   <span style="margin-left: 5px; color: blue; ">'.$parent_cat_title.'</span></h4>';
			$Category_button = 'Return';
		}
		
		/* Edit Mode for Sub Catergory title */
		if( $show_parent_id == '' && $columns['parent_cat_id'] != 0 ) {
			$show_dropdown = 'Show Dropdown Options';
		}		

		if( $Category_button == 'Return' && $sub_cats == 0 )
			$columns['parent_cat_id'] = 0;



?>

		<form class="form-horizontal" method="post" action="<?= $form_location ?>" >
		  <fieldset>
			<?= form_hidden('active_dir_name', $active_dir_name); ?>			
			<!-- <?= form_hidden('mode', $mode); ?> -->

			<?php if( $show_dropdown && $num_dropdown_options > 1 ){ ?>
					<div class="control-group">
						<label class="control-label" for="selectStatus">Parent Category:</label>
						<div class="controls">
							<?php
							$additional_opt = " id = selectStatus";
							echo form_dropdown('parent_cat_id', $options, $columns['parent_cat_id'], $additional_opt);
							?>
						</div>
					</div>
					<br>	
			<?php } else { ?>			
					<?= form_hidden('parent_cat_id', $columns['parent_cat_id']); ?>
			<?php } ?>			

			<?= $show_parent_id ?>

			<div class="form-group">
	            <div class="col-xsm-4 col-sm-6 col-md-4">
				    <label class="control-label" for="typeahead">
				        <?= $Category_Title ?>
				    </label>
				    <input type="text" class="form-control"
						   name = "cat_title" value="<?= $columns['cat_title'] ?>">
	            </div>
			</div>

			<div class="form-actions">
			  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
			  <button type="submit" class="btn" name="submit"
			  		  value="<?= $Category_button ?>"><?= $Category_button ?></button>
			</div>
		  </fieldset>
		</form>
