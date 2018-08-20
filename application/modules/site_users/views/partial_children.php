
    <div class="form-group" id="family_info" style="margin: 5px;">
          <div class="col-md-12"" >
              <div class="row"> 
                  <form id="family_info">
<!--                   <input type="hidden" id="base_url" name="base_url" value = "<?= base_url() ?>" >
 -->
                 	<div class="col-md-12 well well-sm">
                 		<h4>Children</h4>
                 	</div>
                   <div class="col-sm-3 no_padding font-smaller">
                      <input type="text" class="form-control" placeholder='First Name'
                             name="child_fname" id="child_fname" value=""/>             
                   </div>
                   <div class="col-sm-3 no_padding font-smaller">
                      <input type="text" class="form-control" placeholder='Last Name'
                             name="child_lname" id="child_lname" value="" />             
                   </div>
                   <div class="col-sm-2 no_padding font-smaller">
                      <input type="text" class="form-control" placeholder='MM/DD/YYYY'
                             name="child_dob" id="child_dob" value="" />             
                   </div>
                   <div class="col-sm-2 no_padding font-smaller">
                        <select class="form-control" name="child_gender" id="child_gender">
                            <option value=''>Select</option>
                            <option value='male'>Male</option>
                            <option value='female'>Female</option>
                            <option value='other'>Other</option>                          
                        </select>
                   </div>
                   <div class="col-sm-2">
  			                <a><button type="button"  
  			                   id="add_name" 
  			                   class="btn btn-info">Add Name</button></a>
                   </div>
                 </form>                   
              </div> 

      				<div class="table-responsive">          
      					<table class="table">
      						<thead>
      						  <tr>
      						    <th width="5%">#</th>
      						    <th width="25%">First Name</th>
      						    <th width="25%">Last Name</th>
      						    <th width="15%">Birthday</th>
      						    <th width="15%">Gender</th>
      						    <th width="15%">Action</th>
      						  </tr>
      						</thead>
      						<tbody id ="table_contents">

                 <?php foreach ($user_children_data->result() as $key => $value) { ?>
                      <tr id="line_<?= $value->id ?>">
                        <td><?= $key+1 ?></td>
                        <td><?= $value->child_fname ?></td>
                        <td><?= $value->child_lname ?></td>
                        <td><?= format_date($value->child_dob) ?></td>
                        <td><?= $value->child_gender ?></td>
                        <td>
                          <a><button type="button" id="<?= $value->id ?>"
                                     class="btn btn-sm btn-danger btnRemoveForm">Remove</button></a>
                        </td>
                      </tr>
                 <?php } ?>

      						</tbody>
      					</table>
      				</div>
          </div>
    </div>