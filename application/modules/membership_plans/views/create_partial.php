 				<div class="row">
 				<div class="col-md-12 ">
	 				<?php
	 					$disable_submit = '';
						for($i = $start; $i < $end ; $i++ ) {
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
	            </div/>

				<div class="col-sm-6 col-sm-offset-4 col-md-6 col-md-offset-3">
	                <ul class="list-inline">
		                <li><button type="submit" 
		                			name="cancel"
		                			value="cancel"
		                            class="btn btn-default" >Cancel</button></li>                                                              
		                <li><button type="submit"  
		                			name="submit"
		                			value="Submit"
		                			id="submit_btn" 
		                            class="btn btn-primary"><?= $action ?></button></li>
	            	</ul>
				</div>
	            </div>