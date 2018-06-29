<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name] Evelio scftp
class Default_module extends MX_Controller
{


function __construct()
{
    parent::__construct();
// checkField(uri_string(),1);

}

function index()
{
	$first_bit = trim($this->uri->segment(1) );
	$this->load->module('webpages');
	$query = $this->webpages->get_where_custom('page_url', $first_bit);
	$num_rows = $query->num_rows();

	if($num_rows > 0) {
		/* special case data fetch */
		$Advertise_Your_Business = $this->webpages->_get_first_record( $query, 'page_url');
		if( $Advertise_Your_Business == 'Advertise-Your-Business') {
				$data['ad_plans'] = $this->_ad_plan_select_options();
		}

		//we have found content... load page
		foreach($query->result() as $row ){
			$data['status'] = $row->status;
			$data['left_side_nav'] = $row->left_side_nav == 'accept' ? false : true;
			if( $row->left_side_nav == 'accept' )  $data['menu_level'] = 1;

			$data['image_repro'] = $row->image_repro;
			$data['imgDir']  = 'public/images/'.$row->page_url;

			$data['page_title'] = $row->page_title;
			$data['page_keywords'] = $row->page_keywords;
			$data['page_description'] = $row->page_description;
			$data['page_content'] = $row->page_content;

		    /* get images from directory` */
		    $data['image_repro'] = isset($data['image_repro']) ? $data['image_repro'] : null;
		    $data['bm_pages']    = $data['image_repro'] == 'accept' ?
                           image_pagination( $data['imgDir'] ) : null;


			switch ($data['status']) {
			    case "0":
					if ( $data['image_repro'] == 'accept' ) {
						 $data['page_url'] = 'site_pdf-page';
					} else {
						 $data['page_url'] = $row->page_url;
					}

			        $file_name = APPPATH.'modules/templates/views/public_main/partials/'.$data['page_url'].'.php';
					if( !file_exists( $file_name ) && !empty($data['page_url']) ){
            quit('File '.$file_name.' not found....',1);
						$data['page_url'] = 'site_404page';
					}

			        break;

			    case "1":
					$data['page_url'] = 'site_404page';
			        // echo "inactive ".$data['page_url']." | ";
			        break;

			    case "2":
					$data['page_url'] = 'site_under_construction';
			        // echo "Under construction ".$data['page_url']." | ";
			        break;
			}
		}

	} else {
		//	echo "<h5>Default_page page not found</h5>";
		$data['page_url'] = 'site_404page';
		$data['page_title'] = 'Page not found';
		$data['image_repro'] = '';
		$data['left_side_nav'] = false;
		$data['view_module'] = 'partials';
	}

	$this->load->module('templates');
	$this->templates->public_main($data);

}


function _ad_plan_select_options(){
	$this->load->module('msite_buy_ads');
	$mysql_query = 'SELECT DISTINCT(item_title) AS ad_plan FROM msite_ads';
	$ad_plans = $this->msite_buy_ads->_custom_query($mysql_query)->result();
	return  $ad_plans;
}


function formSubmit()
{
	echo "<h1>form submitted</h1>";
 	$this->lib->checkArray($_POST,1);
quit('formSubmit');

}


function ajaxPost()
{
    $fullname  = $this->input->post('fullname', TRUE);
    $child_fname = $this->input->post('child_fname', TRUE);
    // $update_id   = $this->input->post('update_id', TRUE);
    // $this->_update( $update_id, $data);

    // echo "Id: ".$update_id." Selected: ".$data['item_setup'];
    echo "fullname: $child_fname";
    return;
}


} // End class Controller
