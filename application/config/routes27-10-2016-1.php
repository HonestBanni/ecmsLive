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
$route['default_controller'] = 'UserController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
 
  

//admin Routes
$route['login']                 ='UserController/index';
$route['logout']                ='UserController/logout';

$route['userAuth']              ='UserController/loginAuthentication';
$route['Dashboard']             ='DashboardController/index';
 

//Reports section

$route['interMerit']             ='ReportsController/inter_merit_list';
$route['excelExprot']            ='ReportsController/merit_list_excel';
$route['adminRecord']            ='ReportsController/adminRecord';

$route['grandReport']            ='ReportsController/grand_report';
$route['yearHead']            ='ReportsController/year_head_report';

//User Poclicy
$route['userRole']              = 'PolicyController/userRole';
$route['userRole/:num']         = 'PolicyController/userRole/:num';

$route['userRoleCreate']        = 'PolicyController/userRoleCreate';
$route['userRoleCreate/:num']   = 'PolicyController/userRoleCreate/:num';

$route['dbUser']                = 'PolicyController/dbUser';
$route['dbUser/:num']           = 'PolicyController/dbUser/:num';
$route['dbUserCreate']          = 'PolicyController/dbUserCreate';

$route['groupPolicy/:num']      = 'PolicyController/groupPolicy/:num';
$route['policySave']            = 'PolicyController/policySave';


$route['menuLevel1']            = 'PolicyController/menu_Level1';
$route['menuLevel1/:num']       = 'PolicyController/menu_Level1/:num';
$route['deleteM1/:num']         = 'PolicyController/delete_menu_Level1/:num';


//Finance Routes
$route['COA_prents']            = 'FinanceController/chart_of_account';
$route['COA_prents/:num']       = 'FinanceController/chart_of_account/:num';
$route['check_coa_parent']      = 'FinanceController/check_coa_parent';
$route['delteCOAP/:num']        = 'FinanceController/coa_perent_delte/:num';

$route['coa_master_child']      = 'FinanceController/coa_master_child';
$route['coa_master_child/:num'] = 'FinanceController/coa_master_child/:num';
$route['check_coa_master']      = 'FinanceController/check_coa_master';
$route['check_coa_master']      = 'FinanceController/check_coa_master';
$route['delteCOAC/:num']             = 'FinanceController/coa_child_delte/:num';



$route['master_sub_child']      = 'FinanceController/coa_master_sub_child';
$route['get_master_record']     = 'FinanceController/get_master_record';
$route['check_master_subChild'] = 'FinanceController/check_master_subChild';
$route['master_sub_child/:num'] = 'FinanceController/coa_master_sub_child/:num';
$route['delteCOAS/:num']        = 'FinanceController/coa_master_sub_delte/:num';

$route['fee_heads']             = 'FinanceController/fee_heads';
$route['AmountTransition']      = 'FinanceController/amount_transition';

$route['autocompleteAmount']    = 'FinanceController/autocomplete_amount';
$route['autocompleteEmp']       = 'FinanceController/autocomplete_emp';

$route['updateAmount']          = 'FinanceController/updateAmount';
$route['amountDetailDelete']    = 'FinanceController/amountDetailDelete';
$route['check_vocher']          = 'FinanceController/check_vocher';
$route['saveAmount']            = 'FinanceController/saveAmount';


$route['general_ledger']        = 'FinanceController/general_ledger';
$route['gl_autocomplete']       = 'FinanceController/gl_autocomplete';

$route['trialBalance']          = 'FinanceController/trial_balance';
$route['TBDetail']              = 'FinanceController/trial_balance_detail';
$route['TBDetail']              = 'FinanceController/trial_balance_detail';

$route['AmountTransReport']     = 'FinanceController/amount_transition_info';

$route['amountTrnsSearch']      = 'FinanceController/amount_transition_search';
$route['trans_details']         = 'FinanceController/transition_PaymentDetails';

$route['AmountTransReport/:num']= 'FinanceController/amount_transition_info/:num';
$route['delteATI/:num']         = 'FinanceController/delte_ammount_transition_info/:num';

//Inventory Module

$route['bulidingBlock']         = 'InventoryController/buliding_block';
$route['bulidingBlock/:num']    = 'InventoryController/buliding_block/:num';
$route['delteBuldingBlock/:num']= 'InventoryController/delte_bulding_block/:num';

$route['rooms']                 = 'InventoryController/rooms';
$route['rooms/:num']            = 'InventoryController/rooms/:num';
$route['delterooms/:num']       = 'InventoryController/delterooms/:num';
$route['checkAssetName']        = 'InventoryController/check_asset_name';


$route['items']                 = 'InventoryController/items';
$route['items/:num']            = 'InventoryController/items/:num';
$route['deleteItems/:num']      = 'InventoryController/deleteItems/:num';
$route['checkItemName']         = 'InventoryController/check_item_name';
$route['checkItemCode']         = 'InventoryController/check_item_code';
$route['checkItemSrtCode']      = 'InventoryController/check_item_shortcode';


$route['fixedItems']            = 'InventoryController/fixed_items';
//$route['itemsIssuance']         = 'InventoryController/items_issuance';
$route['autocompleteFixEmp']    = 'InventoryController/autocomplete_fix_emp';
$route['autocompleteFixBlock']    = 'InventoryController/autocomplete_fix_block';
$route['autocompleteItems']     = 'InventoryController/autocomplete_items';
$route['autocompleteRoom']      = 'InventoryController/autocomplete_rooms';

$route['saveQuantityDemo']      = 'InventoryController/save_quantity_demo';
$route['saveQuantity']          = 'InventoryController/save_quantity';
$route['udpateFixedItems/:num'] = 'InventoryController/udpate_fixed_items/:num';
$route['inventoryReport']      = 'InventoryController/inventory_report';
$route['inventoryResult']      = 'InventoryController/inventory_result';





//$route['consumableItems']          = 'InventoryController/consumable_items';

