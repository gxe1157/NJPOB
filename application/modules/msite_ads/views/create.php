
<?php
	if( isset($flash) ) echo $flash;

	$form_location = base_url()."msite_ads/create/".$update_id;
	/* This is needed to insure the Ad Size drop down get populated  */
	if( empty($columns['item_title']) ) $columns['item_title'] = $first_cat_title;
?>

<?php if( is_numeric($update_id) ) { ?>
	<div class="row">
		<div class="col-md-12">
			<h2 style="margin-top: 0px; ma">
					<small><?= $default['headline'] ?></small></h2>			

			<div class="well">		
				<a href="<?= base_url() ?>msite_ads/deleteconf/<?= $update_id ?>"><button type="button" class="btn btn-danger">Delete Item</button></a>
				<a href="<?= base_url() ?>msite_ads/view/<?= $update_id ?>/preview"><button type="button" class="btn btn-default">Preview Page</button></a>
			</div>
		</div><!-- end 12 span -->
	</div><!-- end row -->
<?php } ?>

<div class="row">
	<div class="col-md-12">
		<div class="content">
			<form class="form-horizontal" method="post" action="<?= $form_location ?>" >
			  <fieldset>

				<div class="form-group">
					<label class="col-sm-4 col-md-3 control-label" for="selectStatus">Ad Title</label>
					<div class="col-sm-6 col-md-5">
						<?php
						$additional_opt = 'id = "item_title"  onChange ="get_ads_sizes(this.value)" class="form-control"';
						$options = $drop_down_title;

						echo form_dropdown('item_title', $options, $columns['item_title'], $additional_opt);
						?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 col-md-3 control-label" for="selectStatus">Ad Size</label>
					<div class="col-sm-6 col-md-5">
						<?php
						$additional_opt = ' id = "ad_id "  class="form-control"';
						// $options = $plan[$plan_selected];
						$options = $plan[ $columns['item_title'] ];

						echo form_dropdown('ad_id', $options, $columns['ad_id'], $additional_opt);
						?>
					</div>
				</div>

				<div class="form-group">
				  <label class="col-sm-4 col-md-3 control-label" for="typeahead">Ad Price </label>
				  <div class="col-sm-6 col-md-5">
					<input type="text" class="form-control"
						   name = "item_price" value="<?= $columns['item_price'] ?>">
				  </div>
				</div>

				<div class="form-group">
				  <label class="col-sm-4 col-md-3 control-label" for="typeahead">Page Order</label>
				  <div class="col-sm-6 col-md-5">
					<input type="text" class="form-control"
						   name = "page_order"
						   value="<?= $columns['page_order'] ?>">
				  </div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 col-md-3 control-label" for="selectStatus">Status</label>
					<div class="col-sm-6 col-md-5">
						<?php
						$additional_opt = ' id = "selectStatus"  class="form-control"';
						$options = array(
						        '' => 'Please Select....',
						        '1' => 'Active',
						        '0' => 'Inactive'
						);
						echo form_dropdown('status', $options, $columns['status'], $additional_opt);
						?>
				</div>
			  </div>

				<div class="form-group">
				  <label class="col-sm-4 col-md-3 control-label" for="textarea2">Item Description</label>
				  <div class="col-sm-6 col-md-5">
					<textarea class="cleditor" id="textarea2" rows="2"
							  name = "item_description">
						<?= $columns['item_description']  ?>
					</textarea>
				  </div>
				</div>

				<div class="form-actions">
				  <div class="col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-3">						
				  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
				  <button type="submit" class="btn" name="submit" value="Cancel">Finished</button>
				  </div>
				</div>

			  </fieldset>
			</form>
        	<hr>
		</div>
	</div><!--/span-->

</div><!--/row-->


<script langauge="Javascript">
	var plans = <?php echo json_encode($plan) ?>;// don't use quotes
	function get_ads_sizes(sel_option){
		var sel_plan = [];
		for ( var name in plans ) {
			for ( var plan in plans[name] ){
				if (plans[name].hasOwnProperty(plan)){
					if( name == sel_option){
						sel_plan.push(plans[name][plan]);
					}
				}				
			}
		}

		if( sel_plan.length>0)
			buildAdId(sel_plan);
		 //alert(sel_option+' | '+sel_plan);
	}

	function buildAdId(sel_plan) {
    	document.getElementById("ad_id").innerHTML = "<option></option>";		
		var catOptions = "";
		for (var categoryId in sel_plan) {
		   catOptions += "<option>" + sel_plan[categoryId] + "</option>";
		}
		document.getElementById("ad_id").innerHTML = catOptions;
	}
</script>
