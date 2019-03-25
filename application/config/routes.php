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
$route['default_controller'] = 'auth/auth/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;
/**
 * Auth
 */
$route['admin/login'] = 'auth/auth/index';
$route['admin/logout'] = 'admin/admin/admin_logout';

/**
 * Admin
 */

$route['schools/all-schools'] = 'admin/school/index';
$route['schools/all-schools/(:any)'] = 'admin/school/index/$1';
$route['schools/all-schools/(:any)/(:any)'] = 'admin/school/index/$1/$2';
$route['schools/all-schools/(:any)/(:any)/(:num)'] = 'admin/school/index/$1/$2/$3';
$route['schools/add-school'] = 'admin/school/add_school';
$route['schools/edit-school/(:num)'] = 'admin/school/edit_school/$1';
$route['schools/deactivate-school/(:num)/(:num)'] = 'admin/school/deactivate_school/$1/$2';
$route['schools/delete-school/(:num)'] = 'admin/school/delete_school/$1';
$route['schools/view-school/(:num)']= 'admin/school/view_school/$1';
$route['schools/export-schools'] = 'admin/school/export_schools';
$route['schools/import-schools'] = 'admin/school/import_schools';

/**
 * Categories
 */
$route['category/add-category'] = 'admin/category/add_category';
$route['category/edit-category'] = 'admin/category/edit_category';
$route['admin/category'] = 'admin/category/add_category';
$route['admin/all_category'] = 'admin/category/index';
$route['admin/category/(:any)/(:any)/(:num)'] = 'admin/category/index/$1/$2/$3';
$route['admin/category/(:any)/(:any)'] = 'admin/category/index/$1/$2';
$route['admin/deactivate-category/(:num)/(:num)'] = 'admin/category/deactivate_category/$1/$2';
$route['categories/delete-category/(:num)'] = 'admin/category/delete_category/$1';
$route['categories/search-categories'] = 'admin/category/search_categories';
$route['categories/edit-category/(:num)'] = 'admin/category/edit_category/$1';
