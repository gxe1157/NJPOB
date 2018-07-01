
<?php
   		$this->load->module($site_controller);
		$show_parent_id = '';

		/* Add New Sub Catergory title */
        if ( $columns['parent_cat_id'] == 0 ) {
			$parent_cat_title = $this->$site_controller->_get_cat_title($update_id);        	
			$columns['parent_cat_id'] = $update_id;
			if($this->uri->segment(4) == null) {
				$columns['cat_title'] = '';
				$show_parent_id  ='<h4>Parent Category:
							   <span style="margin-left: 5px; color: blue; ">'.$parent_cat_title.'['.$update_id.']</span></h4>';

				$parent_cat_id = $update_id == '' ? 0: $update_id;
				$update_id ='';
			}

			$form_location = $redirect_base."/create/".$update_id;			
			$Category_button = 'Return';
		}

		/* Edit Mode for Sub Catergory title */
		if( $show_parent_id == '' && $columns['parent_cat_id'] != 0 )
			$show_dropdown = 'Show Dropdown Options';

		if( $Category_button == 'Return' && $sub_cats == 0 )
			$columns['parent_cat_id'] = 0;
?>

		<form class="form-horizontal" method="post" action="<?= $form_location ?>" >
		  <fieldset>

			<?= ddf($show_dropdown.' | '.$num_dropdown_options.' | '.$columns['parent_cat_id'],1).' | '.$this->uri->segment(4); ?>

			<?php if( $show_dropdown && $num_dropdown_options > 1 && $this->uri->segment(4) != 0){ ?>
					<div class="control-group">
						<label class="control-label" for="selectStatus">Parent Category:</label>
							<div class="input-group">
	                            <?php
	                              $additional_dd_code = 'class="form-control"';
	                              $additional_dd_code .=' id="selectStatus"';

	                              echo form_dropdown(
	                                    'parent_cat_id',
										$options,
	                                    $columns['parent_cat_id'], // selected option value
	                                    $additional_dd_code);
	                            ?>
                        	</div>					
					</div>
					<br>	
			<?php } else { ?>			
					<?= $parent_cat_id ?>
					<?= form_hidden('parent_cat_id', $parent_cat_id); ?>
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
