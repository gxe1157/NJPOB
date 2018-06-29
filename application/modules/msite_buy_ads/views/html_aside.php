<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if( !isset($ad_plans) ) return; ?>


<style>

.profile-usermenu ul li {
  border-bottom: 0px solid #999;
}

.profile-usermenu ul li:last-child {
//  border-bottom: none;
}

.profile-usermenu ul li a {
  color: #93a3b5;
  font-size: 14px;
  font-weight: 400;
}

.profile-usermenu ul li a i {
  margin-right: 8px;
  font-size: 14px;
}

.profile-usermenu ul li a:hover {
  background-color: #fafcfd;
  color: #000;
}

.profile-usermenu ul li.active {
  border-bottom: none;
}

/*.profile-usermenu ul li.active a {
  color: #5b9bd1;
  background-color: #f6f9fb;
  border-left: 2px solid #000;
  margin-left: -2px;
}*/

</style>

<!--  -->
<div class="profile-sidebar">
  <!-- SIDEBAR MENU -->
<div class="profile-usermenu">
  <?php
	echo '<ul class="nav">';
	foreach($ad_plans as $row){
   	echo  '<li><a href="'.base_url().'msite_buy_ads/ad_form/'.url_title($row->ad_plan).'">'.$row->ad_plan.'</a></li>';
	}
	echo'</ul>';

  ?>
</div>
<!-- END MENU -->
</div>
<!--  -->
