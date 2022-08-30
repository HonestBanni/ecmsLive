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
$route['404_override']          = '';
$route['translate_uri_dashes']  = FALSE;
 
  

//admin Routes
$route['login']                 ='UserController/index';
$route['logout']                ='UserController/logout';
$route['userAuth']              ='UserController/loginAuthentication';
$route['Dashboard']             ='DashboardController/index';

//student Route
$route['student_login']         ='UserController/student_login';
$route['student_logout']        ='UserController/student_logout';
$route['studentuserAuth']       ='UserController/studentloginAuthentication';
$route['whiteCardShow/:num/:num']  ='StudentController/student_attendance_white_card_show/:num/:num';

//auto complete 
//get_teacher_names_with_desgination
$route['GTNWD']                 ='ReportsController/get_teacher_names_with_desgination';


//Reports section

//$route['interMerit']             ='ReportsController/inter_merit_list'; Old Merit list
$route['interMerit']             ='ReportsController/inter_merit_list_new';
$route['olevelMerit']            ='ReportsController/olevel_merit_list';
$route['excelExprot']            ='ReportsController/merit_list_excel';
$route['adminRecord']            ='ReportsController/adminRecord';

$route['grandReport']           ='ReportsController/grand_report';
$route['grandReportNew']        = 'ReportsController/grand_report_new';
$route['grandReportFinance']        = 'ReportsController/grand_report_finance';
$route['grandReportStatus']        = 'ReportsController/grand_report_status';

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
$route['TMAR/:num/:num/:num/:num'] = 'AttendanceController/teacher_monthly_attendance_history_report/:num/:num/:num/:num';


$route['whiteCardInter']            = 'ReportsController/student_attendance_white_card_inter';
$route['whiteCardHND']              = 'ReportsController/student_attendance_white_card_hnd';
$route['whiteCardBBA']              = 'ReportsController/student_attendance_white_card_bba';
$route['whiteCardGrand']            = 'ReportsController/student_attendance_white_card_grand';
$route['whiteCardGrandGui']         = 'ReportsController/student_attendance_white_card_grand_gui';
$route['whiteCardDegree']           = 'ReportsController/student_attendance_white_card_degree';
$route['whiteCardLaw']              = 'ReportsController/student_attendance_white_card_law';
$route['whiteCardPrint/:num/:num']  = 'ReportsController/student_attendance_white_card_print/:num/:num';

$route['TMSI']                      = 'ReportsController/teacher_missing_test_inter';
$route['TMSD']                      = 'ReportsController/teacher_missing_test_degree';
$route['TMSHND']                    = 'ReportsController/teacher_missing_test_hnd';
$route['TMSAL']                     = 'ReportsController/teacher_missing_test_alevel';
$route['TMSBCS']                    = 'ReportsController/teacher_missing_test_bcs';
$route['TMSR/:num/:num/:num/:num/:num/:any'] = 'ReportsController/teacher_missing_test_result/:num/:num/:num/:num/:num/:any';

$route['positionWiseInter']         = 'ReportsController/student_position_wise_inter';
$route['positionWiseBcs']         = 'ReportsController/student_position_wise_bcs';
$route['positionWiseBs_English']  = 'ReportsController/student_position_wise_bs_english';
$route['positionWiseBs_Law']      = 'ReportsController/student_position_wise_bs_law';
$route['positionWiseA_Level']     = 'ReportsController/student_position_wise_a_level';
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
$route['GPSetting/:num']        = 'PolicyController/group_policy_Lthree/:num';
$route['policySetups/:num']     = 'PolicyController/groupPolicySetup/:num';
$route['policySave']            = 'PolicyController/policySave';
$route['policyThirdLayer']      = 'PolicyController/policy_third_layer';


$route['menuLevel1']            = 'PolicyController/menu_Level1';
$route['menuLevel1/:num']       = 'PolicyController/menu_Level1/:num';
$route['deleteM1/:num']         = 'PolicyController/delete_menu_Level1/:num';

$route['menuLevel2']            = 'PolicyController/menu_Level2';
$route['menuLevel2/:num']       = 'PolicyController/menu_Level2/:num';
$route['deleteM2/:num']         = 'PolicyController/delete_menu_Level2/:num';

$route['menuLevel3']            = 'PolicyController/menu_Level3';
$route['menuLevel3/:num']       = 'PolicyController/menu_Level3/:num';
$route['deleteM3/:num']         = 'PolicyController/delete_menu_Level3/:num';

$route['menu2Section']          = 'PolicyController/menu2_section'; //selection 


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
$route['BRS']                   = 'FinanceController/bank_reconciliation_statement';
$route['BRSReport']             = 'FinanceController/bank_reconciliation_statement_report';
$route['BRSReportAdmin']        = 'FinanceController/bank_reconciliation_statement_report_admin';
$route['BRSPrint/:num']         = 'FinanceController/brs_report_print/:num';
$route['BRSEdit/:num']          = 'FinanceController/brs_report_edit/:num';
$route['general_ledgerOld']     = 'FinanceController/general_ledger_old';
$route['GenderLedger']          = 'FinanceController/general_ledger_new';
$route['gl_autocomplete']       = 'FinanceController/gl_autocomplete';
$route['trialBalance']          = 'FinanceController/trial_balance';
$route['trialBalanceOld']       = 'FinanceController/trial_balance_old';
$route['trialBalanceNew']       = 'FinanceController/trail_balance_new';
$route['BalanceSheet']          = 'FinanceController/balance_sheet';
$route['incomeStatement']       = 'FinanceController/income_statument';
//$route['trialBalanceNew']       = 'FinanceController/trial_balance_detail_new';
$route['TBDetail']              = 'FinanceController/trial_balance_detail';
$route['TBDetailOld']           = 'FinanceController/trial_balance_detail_old';
$route['AmountTransReport']     = 'FinanceController/amount_transition_info';
$route['AmountTransReport/:num']= 'FinanceController/amount_transition_info/:num';
$route['delteATI/:num']         = 'FinanceController/delte_ammount_transition_info/:num';
$route['amountTrnsSearch']      = 'FinanceController/amount_transition_search';
$route['trans_details']         = 'FinanceController/transition_PaymentDetails';
$route['detailsSearch']         = 'FinanceController/transition_details_search';

$route['defaulterNoties']       = 'FinanceController/student_defaulter_noties';

//$route['dNotiesUpdate/:num']         = 'FinanceController/student_defaulter_noties_update/:num';

$route['generalJournal']        = 'FinanceController/general_journal';

$route['Voucher']               = 'FinanceController/bank_voucher';
$route['BankVoucherEdit/:num']  = 'FinanceController/bank_voucher_edit/:num';
$route['fnEmployeeInfo']        = 'FinanceController/finance_employee_info';
$route['fnSupplierInfo']        = 'FinanceController/finance_supplier_info';


$route['FnEmployee']            = 'FinanceController/finance_employee_auto';
$route['FnSupplierAuto']        = 'FinanceController/finance_supplier_auto';
$route['VoucherUpdate']         = 'FinanceController/update_voucher';
$route['VoucherSave']           = 'FinanceController/save_vouchers';
$route['VoucherPrint/:num']     = 'FinanceController/print_vouchers/:num';
$route['FnSupplier']            = 'FinanceController/finance_supplier';
$route['FnSupplier/:num']       = 'FinanceController/finance_supplier/:num';
$route['FnSuppDelete/:num']     = 'FinanceController/finance_supplier_delete/:num';
$route['FnYear']                = 'FinanceController/financial_year';
$route['FnYear/:num']           = 'FinanceController/financial_year/:num';
$route['FnYearDelete/:num']     = 'FinanceController/financial_year_delete/:num';
$route['FyBudget']              = 'FinanceController/financial_year_budget';

$route['AddFyBudget']           = 'FinanceController/finance_budget_add';
$route['searchVoucher']         = 'FinanceController/finance_voucher_search';
$route['voucherApproval/:num']  = 'FinanceController/voucher_approval/:num';
$route['ApprovalPersons']       = 'FinanceController/voucher_approval_persons';

$route['voucherApprovals/:num'] = 'FinanceController/voucher_approval_persons/:num';
$route['VochApprDelete/:num']   = 'FinanceController/voucher_approval_delete/:num';
$route['checkDateRange']        = 'FinanceController/check_date_range';
$route['FnCashier']             = 'FinanceController/finance_cashier';
$route['FnCashier/:num']        = 'FinanceController/finance_cashier/:num';
$route['FnCashierDelete:/']     = 'FinanceController/finance_cashier_delete:/';



 

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




//Fee Module

$route['feeCOAHead']            = 'FeeController/fee_chart_of_account';
$route['feeCOAHead/:num']       = 'FeeController/fee_chart_of_account/:num';
$route['deltefeeCOAP/:num']     = 'FeeController/fee_coa_perent_delte/:num';
 
$route['feeCOAChild']           = 'FeeController/fee_coa_master_child';
$route['feeCOAChild/:num']      = 'FeeController/fee_coa_master_child/:num';
$route['deltefeeCOAC/:num']     = 'FeeController/fee_coa_child_delte/:num';

$route['feeSubChild']           = 'FeeController/fee_coa_sub_child';
$route['feeSubChild/:num']      = 'FeeController/fee_coa_sub_child/:num';
$route['feeMasterRecord']        = 'FeeController/fee_get_master_record';
$route['delteFeeCOAS/:num']     = 'FeeController/fee_coa_master_sub_delte/:num';
//$route['feeHeadCOA']            = 'FeeController/get_fee_coa_heads';


$route['feeHeads']              = 'FeeController/fee_heads';
$route['feeHeads/:num']         = 'FeeController/fee_heads/:num';
$route['feeHeadsDelete/:num']   = 'FeeController/fee_heads_delete/:num';
$route['feeHeadCOA']            = 'FeeController/get_fee_coa_heads';

$route['addPaymentCategory']    = 'FeeController/add_payment_category';
$route['paymentCategoryUpdate'] = 'FeeController/payment_category_update';
$route['paymentCategorySearch'] = 'FeeController/payment_category_search';
$route['paymentCategoryCheck']  = 'FeeController/payment_category_check';
$route['paymentCategoryUpdate/:num']  = 'FeeController/payment_category_update/:num';
$route['pcDelete/:num']         = 'FeeController/payment_category_delete/:num';

$route['payment_autocomplete']  = 'FeeController/payment_autocomplete';
$route['classSetups']           = 'FeeController/class_setups';
$route['classSetupsAdv']        = 'FeeController/class_setups_advance';
$route['showSubProgramAddInstallmentHead']          = 'FeeController/show_Sub_program_add_installment_head'; 
$route['installnameCheck']      = 'FeeController/installment_name_dublicate_check';
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

$route['challanStatus']             = 'FeeController/fee_challan_status'; 
$route['challanStatus/:num']        = 'FeeController/fee_challan_status/:num'; 
$route['challanStatusDelete/:num']  = 'FeeController/challan_status_delete/:num'; 

$route['Comments']                  = 'FeeController/fee_comments'; 
$route['Comments/:num']             = 'FeeController/fee_comments/:num'; 
$route['CommentsDelete/:num']       = 'FeeController/comments_delete/:num'; 

$route['ConcessionType']            = 'FeeController/concession_type'; 
$route['ConcessionType/:num']       = 'FeeController/concession_type/:num'; 
$route['ConcessionTypeDelete/:num'] = 'FeeController/concession_type_delete/:num'; 

$route['feeChallan']                            = 'FeeController/fee_challan'; 
$route['feeChallanSearch']                      = 'FeeController/fee_challan_filters'; 
$route['feeChallanSearchAdmin']                 = 'FeeController/fee_challan_filters_admin'; 
$route['feeNewHead/:num/:num']                  = 'FeeController/fee_new_head/:num/:num'; 
$route['AdminFeeNewHead/:num/:num']             = 'FeeController/admin_fee_new_head/:num/:num'; 
$route['deleteNewHead/:num/:num/:num']          = 'FeeController/fee_new_head_delete/:num/:num/:num';
$route['updateNewHead/:num/:num/:num']          = 'FeeController/fee_new_head_update/:num/:num/:num'; 
$route['ChallanCommentUpdate']                  = 'FeeController/challan_comment_update'; 
$route['feeChallanDetail/:num/:num']            = 'FeeController/fee_Challan_Detail/:num/:num'; 
$route['feeChallanPrint/:num/:num']             = 'FeeController/fee_Challan_Print/:num/:num'; 
$route['feeChallanPrintAdmission/:num/:num']    = 'FeeController/fee_challan_print_admission/:num/:num'; 
$route['feeChallanPrintOthrInstal/:num/:num']   = 'FeeController/fee_challan_other_installments/:num/:num'; 
$route['PrintClassWise/:num/:num/:num/:num']    = 'FeeController/print_challan_class_wise/:num/:num/:num/:num'; 
$route['PrintClassWiseGroup/:num/:num/:num']    = 'ReportsController/student_attendance_white_card_print_group/:num/:num/:num';
$route['PrintBatch/:num']                       = 'FeeController/print_challan_wise/:num'; 
$route['feeLedgerRpt']                          = 'FeeController/fee_ledger_report';
$route['hostelLedgerRpt']                       = 'HostelController/hostel_ledger_report'; 

$route['feePayment']                = 'FeeController/fee_challan_payment';
$route['feeInstallment']            = 'FeeController/fee_installment';
$route['admissionChallan']          = 'FeeController/admission_challan';
$route['admissionChallanGent/:num'] = 'FeeController/admission_challan_generate/:num';

$route['feeRefund']                 = 'FeeController/fee_refund';
$route['feeChangeDate']             = 'FeeController/fee_challan_change_date';
$route['concStdSearch']             = 'FeeController/fee_concession_student_search';
$route['feeConcession/:num']        = 'FeeController/fee_concession/:num';
$route['feeConcession']             = 'FeeController/fee_concession';
$route['UnPaidChallan/:num']        = 'FeeController/un_paid_challan/:num';
 
//Fee Modul Reports 
$route['Reconcilition']             = 'FeeController/bank_reconciliation_statment';
$route['PaidAmount']                = 'FeeController/fee_paid_amount';
$route['concessionReport']          = 'FeeController/fee_concession_report';
$route['concessionForm']            = 'FeeController/fee_concession_form';
$route['printConcessonForm/:num']   = 'FeeController/print_concession_form/:num';
$route['annualFee']                 = 'FeeController/annual_fee';
$route['annualFeeBill/:num']        = 'FeeController/annual_fee_genearte/:num';
$route['installmentDate']           = 'FeeController/installment_date';
$route['feeRefundRpt']              = 'FeeController/fee_refund_report';
$route['updateChallan']             = 'FeeController/fee_challan_update';
$route['updatePaidChallan']         = 'FeeController/fee_paid_challan_update';
$route['updateChallanUri/:num']     = 'FeeController/fee_challan_update_uri/:num';

$route['otherInstallment']          = 'FeeController/search_other_installment';
$route['generateOthrInstll/:num']   = 'FeeController/generate_other_installment/:num';
$route['balanceChallan/:num/:num']     = 'FeeController/balance_challan_generate/:num//:num';
$route['fullDetails/:num']          = 'FeeController/student_full_details/:num';
$route['Clearence']                 = 'FeeController/student_clearence';
//$route['Clearence/:num']          = 'FeeController/student_clearence/:num';

$route['feeExtraheads']             = 'FeeController/fee_extra_heads';
$route['addExtraHeads/:num']        = 'FeeController/add_extra_heads/:num';
$route['viewExtraHeads/:num']       = 'FeeController/view_extra_heads/:num';
$route['updateExtraHeads/:num/:num']= 'FeeController/update_extra_heads/:num/:num';
$route['cancelChallan']             = 'FeeController/fee_cancel_challan'; 
$route['insertExtraHead']           = 'FeeController/add_extra_head_insert';
$route['addHeads']                  = 'FeeController/add_heads_view';
$route['ajaxAddHead']               = 'FeeController/ajax_add_heads';
$route['ajaxAddNewHeadStudents']    = 'FeeController/ajax_add_new_heads_students';
$route['cancelChallanURI/:num']     = 'FeeController/fee_cancel_challan_uri/:num';
$route['feeDefaulter']              = 'FeeController/fee_defaulter';
$route['TransfarStudent']           = 'FeeController/transfar_student'; 

$route['BRRLock']                   = 'FeeController/bank_reconciliation_report_lock'; 
$route['editRecLock/:num']          = 'FeeController/bank_reconciliation_report_lock_edit/:num'; 

$route['fixedItems']                = 'InventoryController/fixed_items';
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
$route['IssueItemEdit/:num']    = 'InventoryController/issue_item_edit/:num';



$route['inventoryDeptSearch']       = 'InventoryController/inventory_dept_value_search';
//$route['autocompleteSupplier']   = 'InventoryController/autocomplete_supplier';
$route['inventoryDeptValue']        = 'InventoryController/inventory_dept_value';
$route['deptItemsValues/:num']      = 'InventoryController/inventory_dept_value_update/:num';

$route['inventoryReportDetails']    = 'InventoryController/inventory_report_details';
$route['inventorySearchDetails']    = 'InventoryController/inventory_report_search_details';

$route['fixedItemEdit']             = 'InventoryController/fixed_item_edit';
$route['fixedItemSearchEdit']       = 'InventoryController/fixed_item_edit_search_result';
$route['fixedItemEditPage/:num']    = 'InventoryController/fixed_item_edit_page';

$route['GuiDashobard']              = 'GuiController/gui_dashobard';
$route['StudentGUI']                = 'GuiController/studetn_gui_dashobard';
$route['GuiHR']                     = 'GuiController/gui_hr';
$route['GuiInvenotry']              = 'GuiController/gui_invenotry';
$route['deprtIssueDetails/:num']    = 'GuiController/deprt_issue_detail/:num';
$route['inventoryDetails/:num']     = 'GuiController/inventory_details/:num';
$route['GuiReports']                = 'GuiController/gui_reports';
$route['GuiAttandance']             = 'GuiController/gui_attandance';
$route['grandReportGui']            = 'GuiController/grand_report_gui';
$route['StdAttendance']             = 'GuiController/student_attence';
$route['teacherClassWise']          = 'GuiController/teacher_class_wise_report';
$route['facultyMembers']            = 'GuiController/faculty_members';
$route['facultyReport']            = 'GuiController/faculty_report';
$route['Teachers_Attendance']       = 'GuiController/teachers_attendance';
$route['employeeDetails/:num']      = 'GuiController/employee_details/:num';
$route['perSubject']                = 'GuiController/student_per_subject_alloted';
$route['montlyWise']                = 'GuiController/teacher_montly_wise';
$route['studentAttendanceDetail']   = 'GuiController/student_attendance_detail';
//$route['studentAttendanceView/:num/:num/:num/:num']   = 'GuiController/student_attendance_view/:num/:num/:num/:num';
$route['teacherCurriculum']         = 'GuiController/teacher_curriculum';

//$route['teacherClassWiseMonthly/:any']= 'GuiController/teacher_attendance_Monthly_wise/:any';

$route['PerformanceSubject']        = 'GuiController/teacher_performance_subject_wise';
 $route['Promotions']          = 'PromotionController/student_promotion';
 
 //Hostel and mess 
$route['hostelMess']                = 'HostelController/hostel_mess';
 
$route['hostelMessHeads']           = 'HostelController/hostel_mess_heads';
$route['addHostelHead']             = 'HostelController/add_hostel_head_demo';
$route['hostelMessHeadsNew']        = 'HostelController/hostel_mess_heads_new';
$route['hostelMessHeads/:num']      = 'HostelController/hostel_mess_heads/:num';
$route['hostelMessHeadsNewEdit/:num']= 'HostelController/hostel_mess_heads_new_edit/:num';
$route['HMDelete/:num']             = 'HostelController/hostel_mess_heads_delete/:num';
$route['checkHostelHead']           = 'HostelController/hostel_heads_check';


$route['hostelFee']                     = 'HostelController/hostel_fee';
$route['messFee']                       = 'HostelController/mess_fee';
$route['hostelFeeGroup']                            = 'HostelController/hostel_fee_group';
//$route['hostelPrintChallanNew/:num/:num/:num']  = 'HostelController/hostel_challan_print_new/:num/:num/:num';
$route['hostelPrintChallan/:num/:num']  = 'HostelController/hostel_challan_print/:num/:num';
$route['hostelPrintChallanGroup/:num/:num/:num']    = 'HostelController/hostel_challan_print_group/:num/:num/:num';

$route['hostelAddHead/:num/:num']           = 'HostelController/hostel_add_head/:num/:num';
$route['hostelUpdateChallan/:num/:num']     = 'HostelController/hostel_challan_update/:num/:num';
$route['hostelCancelChallan/:num/:num']     = 'HostelController/hostel_challan_cancel/:num/:num';
$route['updateHostelHead/:num/:num/:num']   = 'HostelController/hostel_head_update/:num/:num/:num';
$route['deleteHostelHead/:num/:num/:num']   = 'HostelController/hostel_head_delete/:num/:num/:num';

$route['HMPayments']                        = 'HostelController/hostel_mess_payment';
$route['hostePaymentRpt']                   = 'HostelController/hostel_payment_report';
$route['hosteChallanSearch']                = 'HostelController/hostel_challan_search';
$route['AdminhostelChallanSearch']           = 'HostelController/hostel_admin_challan_search';
$route['hostelRefundRpt']                   = 'HostelController/hostel_refund_report';
 $route['HMRefund']                         = 'HostelController/hostel_mess_refund';
$route['whiteCardBCS']                      = 'ReportsController/student_attendance_white_card_bcs';
$route['whiteCardAlevel']                   = 'ReportsController/student_attendance_white_card_alevel';
$route['PrintGroupWisePractical/:num']      = 'ReportsController/student_practical_white_card_group/:num';
 $route['MSChangeDate']                     = 'HostelController/hoste_mess_change_date';
 
$route['AuditSearchVoucher']               = 'AuditController/audit_finance_voucher_search';
$route['AuditFeeSearch']                   = 'AuditController/audit_fee_search_filter';