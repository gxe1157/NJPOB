<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Mdl_perfectmodel to Mdl_[name]
class Mdl_msite_ads extends MY_Model
{

function __construct( ) {
    parent::__construct();

}

function get_table() {
	// table name goes here
    $table = "msite_ads";
    return $table;
}

/* ===================================================
    Add custom model functions here
   =================================================== */

function _delete_for_item( $item_id, $store_db_table ){
    // request is from Store_items.php to remove all item content
    $mysql_query = "delete from ".$store_db_table." where item_id=$item_id";
    $query = $this->_custom_query($mysql_query);
}



/* ===============================================
    David Connelly's work from mdl_perctmodel
    is in applications/core/My_Model.php which
    is extened here.
  =============================================== */




}
