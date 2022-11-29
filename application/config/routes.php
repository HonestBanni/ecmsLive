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
$route['default_controller']    = 'UserController';
$route['404_override']          = '404Error';
$route['translate_uri_dashes']  = FALSE;
 

// User Login 

$route['Login']                 = 'UserController/index';
$route['UserAuth']              = 'UserController/login_authentication';
$route['Logout']                = 'UserController/logout';




//Dashboard 
$route['Dashboard']             = 'DashboardController/index';

 
//App Setting

$route['Navigation']            = 'AppSettingController/navigation';
$route['Navigation/:num']       = 'AppSettingController/navigation/:num';
$route['DelNav/:num']           = 'AppSettingController/delete_navigation/:num';


$route['Menu']                  = 'AppSettingController/menu';
$route['Menu/:num']             = 'AppSettingController/menu/:num';
$route['DelMenu/:num']          = 'AppSettingController/delete_menu_Level2/:num';


$route['SubMenu']               = 'AppSettingController/sub_menu';
$route['SubMenu/:num']          = 'AppSettingController/sub_menu/:num';
$route['DelSubMenu/:num']       = 'AppSettingController/delete_sub_menu/:num';


$route['userRole']              = 'AppSettingController/user_role';
$route['userRole/:num']         = 'AppSettingController/user_role/:num';

$route['userRoleCreate']        = 'AppSettingController/user_role_create';
$route['userRoleCreate/:num']   = 'AppSettingController/user_role_create/:num';

//Menu Setting 
$route['MenuSetting/:num']      = 'AppSettingController/menu_setting/:num';
$route['MenuSettingSave']       = 'AppSettingController/menu_setting_save';

//Sub Menu Setting
$route['SMenuSetting/:num']     = 'AppSettingController/sub_menu_setting/:num';
$route['SMenuSettingSave']      = 'AppSettingController/sub_menu_setting_save';

//User managements
$route['DataBaseUsers']         = 'AppSettingController/data_base_users';

$route['menu2Section']          = 'DropdownController/get_parent_menu';
$route['Get-Category-Type']     = 'DropdownController/get_category_type'; 
$route['Get-Designation-Type']  = 'DropdownController/get_designation_type'; 
$route['Get-Department']        = 'DropdownController/get_department'; 
$route['Get-Branch']            = 'DropdownController/get_branch';
$route['EmployeeNameAtuo']      = 'DropdownController/employee_name_auto';
 
 //Hr Setups Start
 $route['Staff-Categories']             = 'HrSetupsController/staff_categories'; 
 $route['Stafft-CategoriesRst']         = 'HrSetupsController/staff_categories_results'; 
 $route['Staff-Categories-Type']        = 'HrSetupsController/staff_categories_type'; 
 $route['Staff-Categories-Type-Rst']    = 'HrSetupsController/staff_categories_type_result'; 
 $route['Staff-Categories-Design']      = 'HrSetupsController/staff_categories_designations'; 
 $route['Staff-Categories-Design-Rst']  = 'HrSetupsController/staff_categories_designations_result'; 
 $route['Departments']                  = 'HrSetupsController/staff_departments'; 
 $route['Departments-Rst']              = 'HrSetupsController/staff_departments_result';
 $route['Bank']                         = 'HrSetupsController/staff_bank'; 
 $route['Bank-Rst']                     = 'HrSetupsController/staff_bank_result'; 
 $route['Bank-Branch']                  = 'HrSetupsController/staff_bank_branch'; 
 $route['Bank-Branch-Rst']              = 'HrSetupsController/staff_bank_branch_result'; 
 $route['Scale']                        = 'HrSetupsController/staff_scale'; 
 $route['Scale-Rst']                    = 'HrSetupsController/staff_scale_result'; 
 $route['Emp-Status']                   = 'HrSetupsController/staff_status'; 
 $route['Emp-Status-Rst']               = 'HrSetupsController/staff_status_result'; 
 
 //Hr Setups  End

//HR Controller Start
$route['EmployeeForm']          = 'HrController/employee_form';
$route['RegisterEmployee']      = 'HrController/register_employee';
$route['UpdateEmployee/:num']   = 'HrController/update_employee/:num';


//Hr Wedgets
$route['PersonalInformation']   = 'HrController/employee_information_details';
$route['CheckTab']              = 'HrController/check_tab';

$route['EmployeeRecords']       = 'HrController/all_employee_reocrd';
//$route['EmployeeRecords/:num']  = 'HrController/all_employee_reocrd/:num';
$route['EmployeeProfile/:num']  = 'HrController/employee_profile/:num';
//$route['EmployeePicture/:num']  = 'HrController/upload_employee_picture/:num';

 
$route['ContractDetails/:num']  = 'HrController/contract_details/:num';
$route['EditContract']          = 'HrController/edit_contract';
$route['EmployeeBank']          = 'HrController/employee_bank_info';
$route['EditEmployeeBank']      = 'HrController/edit_employee_bank_info';

//HR Controller End

// PayRoll Controller routes
$route['Financial-Year']            = 'PayrollController/financial_year';
$route['Financial-Year-Grid']       = 'PayrollController/financial_year_grid';
// PayRoll Controller routes
$route['Payroll-Category']          = 'PayrollController/payroll_category';
$route['Payroll-Categories-Grid']   = 'PayrollController/payroll_category_grid';
// PayRoll Controller routes
$route['Payroll-Category-Type']         = 'PayrollController/payroll_categories_type';
$route['Payroll-Categories-Type-Grid']  = 'PayrollController/payroll_category_type_grid';

$route['Payroll-Steps']             = 'PayrollController/payroll_steps';
$route['Payroll-Steps-Grid']        = 'PayrollController/payroll_steps_grid';

$route['PayScale']              = 'PayrollController/pay_scale';
$route['PayScale-Grid']         = 'PayrollController/pay_scale_grid';
$route['Pay-Scale-Details']     = 'PayrollController/pay_scale_details';
$route['Pay-Scale-Print/:num']     = 'PayrollController/pay_scale_print/:num';
$route['Pay-Scale-Edit/:num']     = 'PayrollController/pay_scale_edit/:num';

$route['EmployeeSalary']            = 'PayrollController/employee_salary';
$route['SalarySetting/:num']        = 'PayrollController/employee_salary_setting/:num';
$route['Pay-Scale-Details-Edit']    = 'PayrollController/pay_scale_details_edit';

$route['Pay-Scale-Allowance/:num']  = 'PayrollController/pay_scale_allowance/:num';
$route['Pay-Scale-Allowance-Grid']  = 'PayrollController/pay_scale_allowance_grid';


//CronRoute
$route['CronRun.php']           = 'CronController/index';

