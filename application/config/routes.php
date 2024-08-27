<?php

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
$route['default_controller']      = 'home'; 
$route['patient_login']           = 'dashboard/patient_login'; 
$route['registration']            = 'dashboard/registration';
$route['forgot_password']		  = 'dashboard/forgotPassword';
$route['login']                   = 'dashboard';
$route['logout']                  = 'dashboard/logout';

$route['slider/(:num)']           = 'home/slider/$1';
$route['slider/(:num)/(:any)']    = 'home/slider/$1';

$route['details/(:num)']          = 'home/details/$1';
$route['details/(:num)/(:any)']   = 'home/details/$1'; 

$route['patient_info/(:any)']     = 'website/patient/profile/$1';
$route['appointment_info/(:any)'] = 'website/appointment/preview/$1';
$route['page/(:any)']             = 'page/index/$1';

$route['404_override']            = '';
$route['translate_uri_dashes']    = FALSE;
$route['custom-page'] = 'custompage/show';
$route['products'] = 'Home/index';


 $route['eva_about'] = 'website/eva/eva_about';
 $route['eva_partners'] = 'website/eva/eva_partners';
 $route['eva_partners'] = 'website/eva/eva_partners';
 $route['eva_blog'] = 'website/eva/eva_blog';
 $route['eva_branches'] = 'website/eva/eva_branches';
 $route['eva_doctors'] = 'website/eva/eva_doctors';
 $route['eva_reserve'] = 'website/eva/eva_reserve';
 $route['eva_reserve'] = 'website/eva/eva_reserve';
 $route['eva_contact'] = 'website/eva/eva_contact';

// -----------------------------------------------

 $route['divide1'] = 'website/eva/divide1';
 $route['divide2'] = 'website/eva/divide2';
 $route['divide3'] = 'website/eva/divide3';
 $route['divide4'] = 'website/eva/divide4';
 $route['divide5'] = 'website/eva/divide5';
 $route['team'] = 'website/eva/team';
 $route['Dammam'] = 'website/eva/Dammam';

 $route['offer1'] = 'website/eva/offer1';
 $route['offer2'] = 'website/eva/offer2';



$route['appointment/submit_appointment'] = 'appointment/submit_appointment';



$route['serves'] = 'serves/index';

// مسار لإنشاء خدمة جديدة
$route['serves/create'] = 'serves/create';

// مسار لحفظ خدمة جديدة أو تعديل خدمة موجودة
$route['serves/save'] = 'serves/save';

// مسار لتعديل خدمة محددة بناءً على معرفها (ID)
$route['serves/edit/(:num)'] = 'serves/edit/$1';

// مسار لحذف خدمة محددة بناءً على معرفها (ID)
$route['serves/delete/(:num)'] = 'serves/delete/$1';




