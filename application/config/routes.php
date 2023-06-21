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
|	http://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'index';
$route['404_override'] = '';

$route['live-market'] = "livemarket/index/live-market";
$route['ajax/(:any)'] = "ajax/$1";

$route['calculator'] = "calculator/index/calculator";

$route['broken-calculator'] = "calculator/brokencalculator/broken-calculator";
$route['calculator/ajaxbroken'] = "calculator/ajaxbroken/ajaxbroken";

$route['Spot-Rates'] = "historyrates/spotrates/Spot-Rates";
$route['Forward-Rates'] = "historyrates/forwardrates/Forward-Rates";
$route['LIBOR-Rates'] = "historyrates/liborrates/LIBOR-Rates";

$route['historyrates/ajaxspotrate'] = "historyrates/ajaxspotrate/ajaxspotrate";
$route['historyrates/ajaxforwardrates'] = "historyrates/ajaxforwardrates/ajaxforwardrates";
$route['historyrates/ajaxliborrate'] = "historyrates/ajaxliborrate/ajaxliborrate";

$route['historyrates/sportratexport'] = "historyrates/sportratexport/sportratexport";
$route['historyrates/forwardratexport'] = "historyrates/forwardratexport/forwardratexport";
$route['historyrates/liborrateexport'] = "historyrates/liborrateexport/liborrateexport";


$route['Research'] = "research/index/research";


$route['galleries'] = "gallery/index/galleries";
$route['galleries/(:num)/(:num)'] = "gallery/index/galleries/$1/$2";

$route['sitemap'] = "sitemap/index/sitemap";
$route['contact-us'] = "contact/index/contact-us";

$route['ajax'] = "ajax";

$route['fx'] = "Logincontroller/fxlogin";

$route['login'] = "Logincontroller/index/login";
$route['completeregistration'] = "Logincontroller/register";
$route['loginfun'] = "Logincontroller/loginfun";
$route['logout'] = "Logincontroller/logout";
$route['emailvalidate'] = "Logincontroller/emailvalidate";

$route['my-account'] = "myaccount/index";
$route['my-account/account_update'] = "myaccount/account_update";
$route['change-password'] = "myaccount/change_password";
$route['myaccount/updatepassword'] = "myaccount/updatepassword";

$route['my-alerts'] = "myaccount/myalerts";

$route['alert/(:any)'] = "myaccount/savealert/$1";

$route['api/(:any)'] = "api/$1";

$route['price-alerts'] = "pricealerts/index/research";

$route['(:any)'] = "index/index/$1";
//$route['translate_uri_dashes'] = FALSE;

