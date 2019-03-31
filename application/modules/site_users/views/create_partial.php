

 				<div class="row">
 				<div class="col-md-12 ">
 				<?php
					// $users
					for($i = 0; $i < count($fld_group); $i++ ) {
						$key = $fld_group[$i]; 
						$data['key']  = $fld_group[$i]; 
						$data['type'] = ($labels[$key] == "Social Security" && substr($columns->$key,0,6) !='xxx-xx') ? 'password':'text';

						$data['pos'] = explode("|", $input_type[$key]);

						switch ($data['pos'][0]) {
						    case "drop_down_sel":
						    	$this->load->view( 'site_users/partial_dropdown', $data);	
						        break;

						    case "textarea":

								break;

						    default:
						    	$this->load->view( 'site_users/partial_text', $data);
						}						
					}
				?>
	            </div>

				<div class="col-sm-6 col-sm-offset-4 col-md-6 col-md-offset-3">
	                <ul class="list-inline">
		                <li><button type="button" 
		                            class="btn btn-default tab-button <?= $cancel ?>"
		                            >Cancel</button></li>                                                              
		                <li><button type="button"  
		                            id="<?= $submit_id ?>-<?= $update_id ?>" 
		                            class="btn btn-primary">Save Changes</button></li>


	            	</ul>
				</div>

				<?php
					/* I positioned to show after spouse information */
				 	if( !empty($add_on) )
				 		$this->load->view( $add_on, $data);
			    ?>							

	            </div>