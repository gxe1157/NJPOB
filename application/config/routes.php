<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/


/*
 * Admin Controllers Route
 */
// HOME / LOGIN

$route['admin'] = "site_dashboard/login";
$route['site_settings/update_site_settings/(:any)'] = "site_settings/update_site_settings/$1";

$route['search'] = "car_shields/search";
$route['member_profile'] = "site_users/update_user";
$route['membership_club'] = "default_module";

// $route['password_reset'] = "site_users/change_password";
$route['pay_pal_response'] = "pay_pal/pay_pal_response";
// $route['business_listings/site_upload/site_ajax_upload/ajax_upload_one'] = "site_upload/site_ajax_upload/ajax_upload_one";

// $route['site_upload/upload_categories/(:any)'] = "site_upload/upload_categories/$1";
// $route['site_users/car_shield_upload']  = "site_upload/site_users/car_shield_upload";
// $route['site_users/car_shield_upload/(:any)'] = "site_upload/site_users/car_shield_upload/$1";

// $route['site_users/member_upload']  = "site_upload/site_users/member_upload";
// $route['site_users/manage_uploads/(:any)'] = "site_upload/site_users/manage_uploads/$1";

$route['site_upload/site_ajax_upload/(:any)'] = "site_upload/site_ajax_upload/$1";

// ECOMMERCE GROUP
$route['admin/publish'] = "admin/ecommerce/publish";
$route['admin/publish/(:num)'] = "admin/ecommerce/publish/index/$1";

$route['default_controller'] = 'default_module';
$route['404_override'] = 'default_module';
$route['translate_uri_dashes'] = FALSE;

