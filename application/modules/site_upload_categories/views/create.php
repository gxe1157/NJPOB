<?php
	if( isset($flash) ) echo $flash;
	$data['form_location'] = $redirect_base."/create/".$update_id;
	$data['sub_cats'] = $sub_cats[ $columns['parent_cat_id'] ];
	$data['Category_Title'] = $mode == 'add_sub-category' ? 'Sub Category Title' : 'Category Title';
	$data['Category_button'] = 'Cancel';					   	 
?>

<h2 style="margin-top: 10px;">
	<small><?= $default['page_title'] ?></small>
</h2>	

<?= validation_errors("<p style='color: red;'>", "</p>") ?>

<div class="row">
	<div class="col-md-12">
		<div class="content">
			<?php
// echo 'nunber of sub_cats: '.$data['sub_cats'].'  | parent_id: '.$columns['parent_cat_id'].'  | item_id: '.$update_id;

				$category_form = 'category_form';
				echo $this->load->view($view_module.'/partials/'.$category_form ,$data );
    		?>
		</div>
	</div><!--/span-->

</div><!--/row-->
