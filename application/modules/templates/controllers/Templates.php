<?php
class Templates extends MX_Controller
{


function __construct()
{
    parent::__construct();
//    echo uri_string();
}


function public_main( $data )
{
    $data['ad_plans'] = isset($ad_plans) ? $ad_plans : '';
    $data['menu_level'] = isset($data['menu_level']) ? $data['menu_level'] : 0;
    $data['parent_titles'] = $this->get_nav($data['menu_level']);
    $data['contents']    = $data['page_url']  ? :'Main';
    $data['target_url_start'] = base_url();

    if( !isset($data['view_module']) ){
        $data['view_module']= $this->uri->segment(2) =='' ? 'partials' : $this->uri->segment(1);
    }

    if( !isset($data['nav_module']) ) {
       $data['nav_module']= $data['view_module'] == 'partials' ? '': $data['view_module'].'/';
    }

    $this->load->view('public_main/html_master_view', $data);
}

function admin( $data = array() )
{
    if( !isset( $data['view_module'] ) )
        $data['view_module']= $this->uri->segment(1);

    $this->load->view('admin/admin', $data);
}





function get_nav($menu_level)
{
    $mysql_query = "SELECT * FROM main_menu
                    WHERE parentid = 0 And level = $menu_level
                    ORDER BY parentid, priority";

    $query = $this->db->query($mysql_query);
    foreach ($query->result() as $row) {
       $sub_nav_titles =  $this->_get_sub_cat($row->id);
       $parent_titles[$row->title] = count($sub_nav_titles)>0 ? $sub_nav_titles : $row->link;
    }
    return $parent_titles;
}


function _get_sub_cat($parentid)
{
    $sql  = "SELECT * FROM main_menu where parentid = $parentid ORDER BY priority";
    $sub_nav_titles = $this->db->query($sql)->result();
    return $sub_nav_titles;
}

} // end Templates
