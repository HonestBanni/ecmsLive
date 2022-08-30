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


//auto complete 
//get_teacher_names_with_desgination
$route['GTNWD']                 ='ReportsController/get_teacher_names_with_desgination';


//Reports section

$route['interMerit']             ='ReportsController/inter_merit_list';
$route['excelExprot']            ='ReportsController/merit_list_excel';
$route['adminRecord']            ='ReportsController/adminRecord';

$route['grandReport']            ='ReportsController/grand_report';

$route['yearHead']               ='ReportsController/year_head_report';
$route['degreeReport']           ='ReportsController/degree_report';
$route['TSWRDG']                  ='ReportsController/teacher_subject_wise_report_degree_graphic';
$route['TSWRDS/:num/:num/:num']  ='ReportsController/teacher_subject_wise_report_degree_students/:num/:num/:num';


$route['SARI']                      = 'ReportsController/student_attendance_report_inter';
$route['SARD']                      = 'ReportsController/student_attendance_report_degree';
$route['SARBCS']                    = 'ReportsController/student_attendance_report_bcs';
$route['SARHND']                    = 'ReportsController/student_attendance_report_hnd';
$route['SARAL']                     = 'ReportsController/student_attendance_report_alevel';
$route['SARDR/:num/:num/:num/:num'] = 'ReportsController/student_attendance_report_degree_result/:num/:num/:num/:num';


$route['whiteCardInter']            = 'ReportsController/student_attendance_white_card_inter';
$route['whiteCardHND']              = 'ReportsController/student_attendance_white_card_hnd';
$route['whiteCardGrand']            = 'ReportsController/student_attendance_white_card_grand';
$route['whiteCardGrandGui']            = 'ReportsController/student_attendance_white_card_grand_gui';
$route['whiteCardDegree']           = 'ReportsController/student_attendance_white_card_degree';
$route['whiteCardPrint/:num/:num']  = 'ReportsController/student_attendance_white_card_print/:num/:num';

$route['TMSI']                      = 'ReportsController/teacher_missing_test_inter';
$route['TMSD']                      = 'ReportsController/teacher_missing_test_degree';
$route['TMSHND']                      = 'ReportsController/teacher_missing_test_hnd';
$route['TMSAL']                      = 'ReportsController/teacher_missing_test_alevel';
$route['TMSBCS']                      = 'ReportsController/teacher_missing_test_bcs';
$route['TMSR/:num/:num/:num/:num/:num/:any'] = 'ReportsController/teacher_missing_test_result/:num/:num/:num/:num/:num/:any';

$route['positionWiseInter']         = 'ReportsController/student_position_wise_inter';
$route['positionWiseDegree']         = 'ReportsController/student_position_wise_degree';

//User Poclicy
$route['userRole']                  = 'PolicyController/userRole';
$route['userRole/:num']             = 'PolicyController/userRole/:num';

$route['userRoleCreate']            = 'PolicyController/userRoleCreate';
$route['userRoleCreate/:num']       = 'PolicyController/userRoleCreate/:num';

$route['dbUser']                = 'PolicyController/dbUser';
$route['dbUser/:num']           = 'PolicyController/dbUser/:num';
$route['dbUserCreate']          = 'PolicyController/dbUserCreate';

$route['groupPolicy/:num']      = 'PolicyController/groupPolicy/:num';
$route['policySetups/:num']      = 'PolicyController/groupPolicySetup/:num';
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
$route['delteCOAC/:num']        = 'FinanceController/coa_child_delte/:num';

$route['master_sub_child']      = 'FinanceController/coa_master_sub_child';
$route['get_master_record']     = 'FinanceController/get_master_record';
$route['check_master_subChild'] = 'FinanceController/check_master_subChild';
$route['master_sub_child/:num'] = 'FinanceController/coa_master_sub_child/:num';
$route['delteCOAS/:num']        = 'FinanceController/coa_master_sub_delte/:num';
 
$route['AmountTransition']      = 'FinanceController/amount_transition';
$route['AmountTransitionEdit/:num']      = 'FinanceController/Amount_Transition_Edit/:num';
$route['getUpdateTranRecord']   = 'FinanceController/get_update_tran_record';
$route['autocompleteAmount']    = 'FinanceController/autocomplete_amount';
$route['autocompleteEmp']       = 'FinanceController/autocomplete_emp';
$route['updateAmount']          = 'FinanceController/updateAmount';
$route['check_vocher']          = 'FinanceController/check_vocher';
$route['check_vocher_number']   = 'FinanceController/check_vocher_number';
$route['saveAmount']            = 'FinanceController/saveAmount';
$route['saveAmountUpdate']      = 'FinanceController/saveAmountUpdate';
$route['general_ledger']        = 'FinanceController/general_ledger';
$route['gl_autocomplete']       = 'FinanceController/gl_autocomplete';
$route['trialBalance']          = 'FinanceController/trial_balance';
$route['TBDetail']              = 'FinanceController/trial_balance_detail';
$route['AmountTransReport']     = 'FinanceController/amount_transition_info';
$route['AmountTransReport/:num']= 'FinanceController/amount_transition_info/:num';
$route['delteATI/:num']         = 'FinanceController/delte_ammount_transition_info/:num';
$route['amountTrnsSearch']      = 'FinanceController/amount_transition_search';
$route['trans_details']         = 'FinanceController/transition_PaymentDetails';
$route['detailsSearch']         = 'FinanceController/transition_details_search';

$route['defaulterNoties']       = 'FinanceController/student_defaulter_noties';
//$route['dNotiesUpdate/:num']         = 'FinanceController/student_defaulter_noties_update/:num';



//Fee Module
$route['feeHeads']              = 'FeeController/fee_heads';
$route['feeHeads/:num']         = 'FeeController/fee_heads/:num';
$route['feeHeadsDelete/:num']   = 'FeeController/fee_heads_delete/:num';
$route['feeHeadCOA']            = 'FeeController/get_fee_coa_heads';

$route['paymentCategory']       = 'FeeController/payment_category';
$route['paymentCategorySearch'] = 'FeeController/payment_category_search';
$route['paymentCategory/:num']  = 'FeeController/payment_category/:num';
$route['pcDelete/:num']         = 'FeeController/payment_category_delete/:num';

$route['payment_autocomplete']  = 'FeeController/payment_autocomplete';
$route['classSetups']           = 'FeeController/class_setups';
$route['classSetups/:num']      = 'FeeController/class_setups/:num';
$route['classSetupsEdit/:num']  = 'FeeController/class_setups_edit/:num';
$route['csDelete/:num']         = 'FeeController/class_setups_delete/:num';

$route['feeCategoryWise']       = 'FeeController/fee_Category_Wise';
$route['feeCategoryWiseSearch'] = 'FeeController/fee_Category_search';
$route['fcwEdit/:num']          = 'FeeController/fee_Category_Wise_Edit/:num';
$route['fcwDelete/:num']        = 'FeeController/fee_Category_Wise_delete/:num';

$route['feeTotalperYear']       = 'FeeController/fee_total_year_Wise';
$route['feeTotalperYear/:num']  = 'FeeController/fee_total_year_Wise/:num';
$route['ftyDelete/:num']        = 'FeeController/fee_total_year_Wise_delete/:num';

$route['challanStatus']         = 'FeeController/fee_challan_status'; 
$route['challanStatus/:num']    = 'FeeController/fee_challan_status/:num'; 
$route['challanStatusDelete/:num']    = 'FeeController/challan_status_delete/:num'; 


$route['feeChallan']            = 'FeeController/fee_challan'; 
$route['feeChallanSearch']      = 'FeeController/fee_challan_filters'; 

$route['feeChallanDetail/:num/:num']            = 'FeeController/fee_Challan_Detail/:num/:num'; 
$route['feeChallanPrint/:num/:num']             = 'FeeController/fee_Challan_Print/:num/:num'; 
$route['PrintClassWise/:num/:num/:num/:num']    = 'FeeController/print_challan_class_wise/:num/:num/:num/:num'; 

$route['feePayment']            = 'FeeController/fee_challan_payment';
$route['feeInstallment']        = 'FeeController/fee_installment';
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
$route['inventoryReport']       = 'InventoryController/inventory_report';
$route['inventoryTotal']        = 'InventoryController/inventory_total_report';
$route['inventoryReportBarcode']= 'InventoryController/inventory_report_barcode';
$route['inventorySearch']       = 'InventoryController/inventory_report_search';
$route['inventorySearchAll']       = 'InventoryController/inventory_report_search_all';
$route['inventoryBarcode']      = 'InventoryController/inventory_barcode';
$route['inventoryResult']       = 'InventoryController/inventory_result';



$route['inventoryDeptSearch']       = 'InventoryController/inventory_dept_value_search';
//$route['autocompleteSupplier']   = 'InventoryController/autocomplete_supplier';
$route['inventoryDeptValue']        = 'InventoryController/inventory_dept_value';
$route['deptItemsValues/:num']      = 'InventoryController/inventory_dept_value_update/:num';

$route['inventoryReportDetails']    = 'InventoryController/inventory_report_details';
$route['inventorySearchDetails']    = 'InventoryController/inventory_report_search_details';


$route['GuiDashobard']              = 'GuiController/gui_dashobard';
$route['GuiHR']                     = 'GuiController/gui_hr';
$route['GuiReports']                = 'GuiController/gui_reports';
$route['GuiAttandance']             = 'GuiController/gui_attandance';
$route['grandReportGui']            = 'GuiController/grand_report_gui';
$route['grandReportGui']            = 'GuiController/grand_report_gui';




 $route['Promotions']          = 'PromotionController/student_promotion';

