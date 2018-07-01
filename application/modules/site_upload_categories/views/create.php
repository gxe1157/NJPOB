<?php
	if( isset($flash) ) echo $flash;

	$add_button_url = $redirect_base."/manage/";
	/* Edit Mode for Sub Catergory title */
	if( $show_parent_id == '' && $columns['parent_cat_id'] != 0 )
		$show_dropdown = 'Show Dropdown Options';
?>

<h2 style="margin-top: 10px;">
	<small><?= $default['page_title'] ?></small>
</h2>	

<?= validation_errors("<p style='color: red;'>", "</p>") ?>

<div class="row">
	<div class="col-md-12">
		<div class="content">

		<form class="form-horizontal" method="post" action="<?= $form_location ?>" >
		  <fieldset>

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

<!-- 			  <button type="submit" class="btn" name="submit"
	  		  value="<?= $Category_button ?>"><?= $Category_button ?></button>

 -->	  		  
		<a href="<?= $add_button_url; ?>" >
		<button type="button" class="btn btn-primary">Return</button></a> 


			</div>
		  </fieldset>
		</form>
		</div>
	</div><!--/span-->

</div><!--/row-->
