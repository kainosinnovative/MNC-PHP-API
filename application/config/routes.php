<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|    example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|    https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|    $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|    $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|    $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:    my-controller/index    -> my_controller/index
|        my-controller/my-method    -> my_controller/my_method
 */
$route['default_controller'] = 'test';
$route['otp/send'] = 'app/generateOtp';
$route['otp/verify'] = 'app/verifyOtp';
$route['registration'] = 'app/registration';

$route['car/brands'] = 'app/getBrands';
$route['car/models'] = 'app/getModels';
$route['car/variants'] = 'app/getVariantList';

$route['dashboard/leads'] = 'app/getLeadData';
$route['profile'] = 'dealer/getProfileInfo';

$route['test/otp'] = 'test/otp';
$route['delete/dealer'] = 'test/deleteDealer';

$route['404_override'] = '';
$route['translate_uri_dashes'] = false;

/*Baswaraj */
$route['profile/overview'] = 'app/getOverview';

// About Notes Routes
$route['lead/list'] = 'Dealer/leadList';
$route['lead/notes/create'] = 'Dealer/noteCreate';
$route['lead/notes/edit'] = 'Dealer/noteEdit';
$route['lead/notes/delete'] = 'Dealer/noteDelete';
$route['lead/notes/list'] = 'Dealer/note';

//Test Drive Car List
$route['drive/car/list'] = 'Dealer/getTestDriveCarList';
$route['drive/car/edit'] = 'Dealer/editTestDriveCar';
$route['drive/car/delete'] = 'Dealer/deleteTestDriveCar';
$route['drive/car/create'] = 'Dealer/createTestDriveCar';

// About showroom data
$route['lead/showroom/create'] = 'Dealer/insertShowroom';
$route['lead/showroom/edit'] = 'Dealer/showroomEdit';
$route['lead/showroom/delete'] = 'Dealer/deleteShowroom';
$route['lead/showroom/list'] = 'Dealer/getShowRoomInformation';
