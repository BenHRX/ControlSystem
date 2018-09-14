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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// 用户控制
$route['user'] = 'user_controller';
$route['login'] = 'user_controller/user_login';
$route['user_add'] = 'user_controller/add_user_view';
$route['user_update/(:num)'] = 'user_controller/update_user_view/$1';
$route['user_delete/(:num)'] = 'user_controller/delete_user_view/$1';

// 城市控制
$route['city'] = 'city_controller';
$route['city_add'] = 'city_controller/add_city_view';
$route['city_delete/(:any)'] = 'city_controller/delete_city_view/$1';
$route['city_update/(:any)'] = 'city_controller/update_city_view/$1';

// 医院,部门控制
$route['hospital'] = 'hospital_controller';
$route['hospital_by_city'] = 'hospital_controller/response_by_city';
$route['department_by_hospital'] = 'hospital_controller/response_by_hospital';
$route['hospital_add'] = 'hospital_controller/add_hospital_view';
$route['department_add'] = 'hospital_controller/add_department_view';
$route['hospital_delete/(:any)'] = 'hospital_controller/delete_hospital_view/$1';
$route['department_delete/(:any)/(:any)'] = 'hospital_controller/delete_department_view/$1/$2';
$route['hospital_update/(:any)'] = 'hospital_controller/update_hospital_view/$1';
$route['department_update/(:any)/(:any)'] = 'hospital_controller/update_department_view/$1/$2';

// 排班安排控制
$route['duty'] = 'duty_controller';
$route['duty_add'] = 'duty_controller/add_duty_view';
//$route['duty_delete/(:num)/(:any)/(:any)'] = 'duty_controller/delete_duty_view/$1/$2/$3';
//$route['duty_update/(:num)/(:any)/(:any)'] = 'duty_controller/update_duty_view/$1/$2/$3';
$route['duty_delete/(:any)'] = 'duty_controller/delete_duty_view/$1';
$route['duty_update/(:any)'] = 'duty_controller/update_duty_view/$1';

// 订单控制
$route['order'] = 'order_controller';
