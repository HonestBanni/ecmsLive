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
 

/***********************
 * 
 * 
 *              Admin Controller Start 
 * 
 *  
 * 
 *  
 */
$route['LeavingCertifcate']                 =   'AdminDeptController/leaving_certificate';
$route['UpdateLeavingCertificate/:num']     =   'AdminDeptController/update_leaving_certficate/:num';
$route['PrintLeaving/:num']                 =   'AdminDeptController/print_leaving_certificate/:num';
$route['CheckLeaving/:num']                 =   'AdminDeptController/leaving_issued_certificate/:num';


/***********************
 * 
 * 
 *              Admin Controller End 
 * 
 *  
 * 
 *  
 */


/***********************
 * 
 * 
 *              Green File Controller Start 
 * 
 *  
 * 
 *  
 */

$route['addGreenFile']                  =   'GreenfileController/add_green_file_student';
$route['GreenFileStudent']              =   'GreenfileController/green_file_student';
$route['GreenFileStudent/:num']         =   'GreenfileController/green_file_student/:num';
$route['GreenFileUpdate/:num']          =   'GreenfileController/green_file_update/:num';
$route['GreenFileShowEdu']              =   'GreenfileController/greenfile_show_educations';
$route['GreenFileShowEduAdd']           =   'GreenfileController/greenfile_show_educations_add';
$route['GreenFileUpdateEdu']            =   'GreenfileController/greenfile_update_educations';
$route['GreenFileAddEdu']               =   'GreenfileController/greenfile_add_educations';
$route['GreenFileDeleteEdu']            =   'GreenfileController/green_file_edu_delete';
$route['GreenFileDeleteEduAdd']         =   'GreenfileController/green_file_edu_delete_add';
$route['GreenFileUpdateData']           =   'GreenfileController/green_file_edu_update_data';
$route['GreenFileUpdateSave']           =   'GreenfileController/green_file_edu_update_save';

/***********************
 * 
 * 
 *              Green File Controller End 
 * 
 *  
 * 
 *  
 */
/***********************
 * 
 * 
 *              Hostel & MessController Start 
 * 
 *  
 * 
 *  
 */
$route['BRRLockHostel']                   = 'HostelController/bank_reconciliation_report_lock_hostel';
$route['editRecLockHostel/:num']          = 'HostelController/bank_reconciliation_report_lock_edit_hostel/:num';
$route['HostelRoomAllotement']          = 'HostelController/hostel_room_allotment';
/***********************
 * 
 * 
 *              Hostel & MessController End 
 * 
 *  
 * 
 *  
 */

/***********************
 * 
 * 
 *              Attendance Controller Start 
 * 
 *  
 * 
 *  
 */
$route['StdAttentWithBalance']              =   'AttendanceController/student_attendance_bs_programs_report_balance';


/***********************
 * 
 * 
 *              Attendance Controller End 
 * 
 *  
 * 
 *  
 */


/***********************
 * 
 * 
 *              Admission Subject Allotments Start 
 * 
 *  
 * 
 *  
 */
$route['ArtSubject']                    = 'SubjectAllottmentController/arts_students';
$route['ArtSubject/:num']               = 'SubjectAllottmentController/arts_students/:num';
$route['ArtSubjectShift']               = 'SubjectAllottmentController/arts_subjects_shifting';
$route['ArtSubjectShiftToAllotted']     = 'SubjectAllottmentController/arts_subjects_allotment_new_students';

$route['ScienceSubject']                = 'SubjectAllottmentController/year_head_subjects';
$route['GroupAllotedDemo_js']           = 'SubjectAllottmentController/group_alloted_demo_js';
$route['GroupAllotedDemoDelete_js']     = 'SubjectAllottmentController/group_alloted_demo_subject_delete_js';
$route['ShowSubjectAllottment']         = 'DropdownController/show_subjct_allottment_auto';



$route['ArtsSubject1st']                    = 'SubjectAllottmentController/arts_students_1st';
$route['AssignSubjects1st']                 = 'SubjectAllottmentController/assign_arts_subjects_1st';
$route['AssignSubjects1st/:num/:num']       = 'SubjectAllottmentController/assign_arts_subjects_1st/:num/:num';
$route['StudentGroups1st']                  = 'admin/student_group_inter_1st';
$route['UpdateStudentGroups1st']            = 'admin/update_group_inter_1st';
$route['UpdateStudentGroupSingle1st/:num']  = 'admin/update_student_by_group_1st/:num';
$route['PracticalGroups1st']                = 'AttendanceController/practical_group_inter_1st';


$route['ArtsSubject2nd']                    = 'SubjectAllottmentController/arts_students_2nd';
$route['AssignSubjects2nd']                 = 'SubjectAllottmentController/assign_arts_subjects_2nd';
$route['AssignSubjects2nd/:num/:num']       = 'SubjectAllottmentController/assign_arts_subjects_2nd/:num/:num';
$route['StudentGroups2nd']                  = 'admin/student_group_inter_2nd';
$route['UpdateStudentGroups2nd']            = 'admin/update_group_inter_2nd';
$route['UpdateStudentGroupSingle2nd/:num']  = 'admin/update_student_by_group_2nd/:num';
$route['PracticalGroups2nd']                = 'AttendanceController/practical_group_inter_2nd';


/***********************
 * 
 * 
 *              Admission Subject Allotments End 
 * 
 *  
 * 
 *  
 */

/***********************
 * 
 * 
 *              Promotions Controller Routes Start 
 * 
 *  
 * 
 *  
 */
$route['ClassAllotedDelete']        = 'PromotionController/class_alloted_delete';
$route['ProgramInfoAuto']           = 'DropdownController/program_info_auto';
$route['ProgramInfoAuto/:any']      = 'DropdownController/program_info_auto/:any';
$route['SubProgramAuto']            = 'DropdownController/sub_prgoram_auto';
$route['SubProgramAuto/:any']       = 'DropdownController/sub_prgoram_auto/:any';



/***********************
 * 
 * 
 *              Promotions Controller Routes End 
 * 
 *  
 * 
 *  
 */
/***********************
 * 
 * 
 *              Admission Controller Routes Start 
 * 
 *  
 * 
 *  
 */


/***********************
 * 
 * 
 *              Dropdown Controller Generals Routes Start 
 * 
 *  
 * 
 *  
 */
$route['GetInvtRooms']                  = 'DropdownController/get_invt_rooms';
$route['EmployeeNameWithSubjectAtuo']   = 'DropdownController/employee_name_with_designation_and_subjects_auto';

/***********************
 * 
 * 
 *              Dropdown Controller Generals Routes End 
 * 
 *  
 * 
 *  
 */

/***********************
 * 
 * 
 *              Time Table Controller Routes Start 
 * 
 *  
 * 
 *  
 */
$route['TeacherSectionTimeTable']                  = 'AttendanceController/get_teacher_sectimetable';
/***********************
 * 
 * 
 *              Time Table Controller Routes End 
 * 
 *  
 * 
 *  
 */

//$route['InterNewAdmissoins']        = 'AdmissionController/inter_new_admissions';
//$route['InterNewAdmissoins/:num']   = 'AdmissionController/inter_new_admissions/:num';
//$route['AddNewInterStudent']        = 'AdmissionController/add_new_inter_student_record';

$route['InterAbsentFine']           = 'AdmissionController/inter_absent_fine';
$route['InterAbsentFine/:num']      = 'AdmissionController/inter_absent_fine/:num';
$route['ShowFineStdRecord']         = 'AdmissionController/show_fine_student_record';
$route['AddStudentFine']            = 'AdmissionController/add_student_fine';
$route['ShowAllFine']               = 'AdmissionController/show_all_fines';
$route['UpdateFine']                = 'AdmissionController/update_fine';
$route['UpdateStudentFine']         = 'AdmissionController/update_student_fine';

$route['NewAdmissonInterSearch']        = 'AdmissionController/new_student_admission_search';
$route['NewAdmissonInterSearch/:num']   = 'AdmissionController/new_student_admission_search/:num';
$route['AddNewAdmissonInter']           = 'AdmissionController/add_new_student_record';
$route['NewAdmissionAcademic/:num']     = 'AdmissionController/new_student_academic_record/:num';
$route['UpdateNewAdmissionInter/:num/:num'] = 'AdmissionController/update_new_admission_record/:num/:num';
$route['UpdateAdmissionAcademic/:num']  = 'AdmissionController/update_new_admission_academic/:num';
$route['NewAdmissionPicture/:num']      = 'AdmissionController/update_new_admission_picture/:num';
$route['UpdateCollegeNoSearch']         = 'AdmissionController/update_college_no_search';
$route['UpdateCollegeNo/:num']          = 'AdmissionController/update_college_no/:num';
$route['BsEnrollmentNo']                = 'AdmissionController/bs_enrollment_no_search';
$route['BsEnrollmentNoUp/:num']         = 'AdmissionController/bs_enrollment_no_update/:num';

$route['UploadPictureSearch']           = 'AdmissionController/upload_picture_search';
$route['UploadPictureSearch/:num']           = 'AdmissionController/upload_picture_search/:num';
$route['UploadPictureSearchRes']        = 'AdmissionController/upload_picture_search_result';
$route['UploadPictureUpdate']           = 'AdmissionController/upload_picture_update';
$route['UploadPicture/:num']            = 'AdmissionController/upload_picture/:num';

$route['StudentRecordBBA']             = 'AdmissionController/student_record_bba';
$route['StudentRecordBBA/:num']        = 'AdmissionController/student_record_bba/:num';

$route['StudentRecordHND']             = 'AdmissionController/student_record_hnd';
$route['StudentRecordHND/:num']        = 'AdmissionController/student_record_hnd/:num';

$route['StudentRecordEDSML']           = 'AdmissionController/student_record_edsml';
$route['StudentRecordEDSML/:num']      = 'AdmissionController/student_record_edsml/:num';
$route['StudentDelete']                = 'AdmissionController/student_delete_by_status';
$route['InterStdView']                 = 'AdmissionController/student_record_inter_view';
$route['InterStdView/:num']            = 'AdmissionController/student_record_inter_view/:num';
$route['GroupAltNoWise']             = 'AdmissionController/group_allotment_inter_no_wise';
/***********************
 * 
 * 
 *              Admission Controller Routes End 
 * 
 *  
 * 
 *  
 */
/***********************
 * 
 * 
 *              Fee Controller Routes Start 
 * 
 *  
 * 
 *  
 */
$route['FeeWorkLog']                    = 'FeeController/fee_manual_work_log';
$route['EnvelopePrint/:num']            = 'FeeController/student_envelope_print/:num';
$route['EnvelopePrintPage/:num']        = 'FeeController/student_envelope_print_page/:num';
$route['AdmChallanVerify']              = 'FeeController/admission_challan_verify';
$route['AdmVerifyPopUp']                = 'FeeController/admission_challan_verify_popup';
$route['ProspectusChallanUpdate']       = 'FeeController/prospectus_challan_update';
$route['ProspectusChallanUpdateGet']    = 'FeeController/prospectus_challan_get_record';
//$route['ProspectusChallanUpdate']       = 'FeeController/applicant_record_admin';
//$route['EmployeeNameWithSubjectAtuo']   = 'DropdownController/employee_name_with_designation_and_subjects_auto';

/***********************
 * 
 * 
 *              Fee Controller Routes End 
 * 
 *  
 * 
 *  
 */


/***********************
 * 
 * 
 *              Finance Grant And Aid Routes Start 
 * 
 *  
 * 
 *  
 */

                    // SETUPS
$route['ChartOfAccountGA']                  = 'FnGrantAidController/chart_of_account_grand_and_aid';
$route['ChartOfAccountGA/:num']             = 'FnGrantAidController/chart_of_account_grand_and_aid/:num';

$route['ChartOfAcctMasterGA']               = 'FnGrantAidController/coa_master_child_grand_and_aid';
$route['ChartOfAcctMasterGA/:num']          = 'FnGrantAidController/coa_master_child_grand_and_aid/:num';

$route['ChartOfAcctChildGA']                = 'FnGrantAidController/coa_child_grand_and_aid';
$route['ChartOfAcctChildGA/:num']           = 'FnGrantAidController/coa_child_grand_and_aid/:num';

$route['EmployeeListGA']                    = 'HrController/employee_reocrd';
$route['FinanceYearGA']                     = 'FnGrantAidController/financial_year_grand_and_aid';
$route['FinanceYearGA/:num']                = 'FnGrantAidController/financial_year_grand_and_aid/:num';
$route['FnSupplierGA']                      = 'FnGrantAidController/finance_supplier_grand_and_aid';
$route['FnSupplierGA/:num']                 = 'FnGrantAidController/finance_supplier_grand_and_aid/:num';


$route['ApprovalPersonsGA']                 = 'FnGrantAidController/voucher_approval_persons_grand_and_aid';
$route['ApprovalPersonsGA/:num']            = 'FnGrantAidController/voucher_approval_persons_grand_and_aid/:num';
$route['VochApprDeleteGA']                  = 'FnGrantAidController/voucher_approval_delete_grand_and_aid';

$route['FyBudgetGA']                        = 'FnGrantAidController/financial_year_budget_grand_and_aid';
$route['AutocompleteAmountGA']              = 'FnGrantAidController/autocomplete_amount_grand_and_aid';


            // ENTRY FORMS
$route['VoucherGA']                         = 'FnGrantAidController/bank_voucher_grand_and_aid';
$route['VoucherUpdateGA']                   = 'FnGrantAidController/update_voucher_grand_and_aid';
$route['SaveVoucherGA']                     = 'FnGrantAidController/save_vouchers_grand_and_aid';
$route['FnEmployeeGA']                      = 'FnGrantAidController/finance_supplier_auto_grand_and_aid';

$route['VoucherSearchGA']                   = 'FnGrantAidController/finance_voucher_search_grand_and_aid';
$route['BankVoucherEditGA/:num']            = 'FnGrantAidController/bank_voucher_edit_grand_and_aid/:num';
$route['VoucherPrintGA/:num']               = 'FnGrantAidController/print_vouchers_grand_and_aid/:num';
$route['SaveAmountUpdateGA']                = 'FnGrantAidController/save_amount_update_grand_and_aid';
$route['voucherApprovalGA/:num']            = 'FnGrantAidController/voucher_approval_grand_and_aid/:num';

$route['BRSGA']                             = 'FnGrantAidController/bank_reconciliation_statement_grand_and_aid';
$route['FnBRSAutoCompleteGA']               = 'FnGrantAidController/fn_brs_auto_complete_grand_and_aid';
$route['FnBRSVoucherAutoGA']                = 'DropdownController/get_voucher_info_grand_and_aid';
$route['BRSSaveGA']                         = 'FnGrantAidController/bank_reconciliation_statement_save_grand_and_aid';



//Reports FORMS 
$route['BalanceSheetGA']                    = 'FnGrantAidController/balance_sheet_grand_and_aid'; 
$route['BRSReportAdminGA']                  = 'FnGrantAidController/bank_reconciliation_statement_report_admin_grand_and_aid';
$route['BRSPrintGA/:num']                   = 'FnGrantAidController/brs_report_print_grand_and_aid/:num';
$route['BRSEditGA/:num']                    = 'FnGrantAidController/brs_report_edit_grand_and_aid/:num';
$route['BRSUpdateRecord']                   = 'FnGrantAidController/brs_report_update_grand_and_aid';
$route['BRSReportGA']                       = 'FnGrantAidController/bank_reconciliation_statement_report_grand_and_aid';
$route['GeneralLeadgerGA']                  = 'FnGrantAidController/general_ledger_date_wise_grand_and_aid';
$route['IncomeStatementGA']                 = 'FnGrantAidController/income_statument_grand_and_aid';
$route['TrialBalanceAllHeadsGA']            = 'FnGrantAidController/trail_balance_all_heads_grand_and_aid'; 
$route['TrialBalanceGA']                    = 'FnGrantAidController/trial_balance_grand_and_aid';
$route['TBDetailGA']                        = 'FnGrantAidController/trial_balance_detail_grand_and_aid';
//
//
//

/***********************
 * 
 * 
 *              Finance Grant And Aid Routes End 
 * 
 *  
 * 
 *  
 */

//admin Routes
$route['login']                 ='UserController/index';
$route['logout']                ='UserController/logout';
$route['userAuth']              ='UserController/loginAuthentication';
$route['Dashboard']             ='DashboardController/index';

//student Route
$route['p-portal']         ='UserController/student_login';
$route['student_logout']        ='UserController/student_logout';
$route['studentuserAuth']       ='UserController/studentloginAuthentication';
$route['whiteCardShow/:num/:num']  ='StudentController/student_attendance_white_card_show/:num/:num';
$route['PracticalwhiteCardShow/:num/:num']  ='StudentController/practical_attendance_white_card/:num/:num';

// Proctor 
$route['proctor']          ='UserController/proctor_login';
$route['proctor_logout']   ='UserController/proctor_logout';
$route['proctorAuth']      ='UserController/proctorAuthentication';
$route['404Error']        = 'Admin/error_four_zero_foure';

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
$route['grandReportMeritList']        = 'ReportsController/grand_report_merit_List';
$route['grandReportFinance']        = 'ReportsController/grand_report_finance';
$route['grandReportBsPrograms']     = 'ReportsController/grand_report_bs_programs';
$route['grandReportStatus']        = 'ReportsController/grand_report_status';
$route['studentSecurity']       = 'admin/student_security';
$route['studentSecurityList']   = 'admin/student_security_list';
$route['GroupChart']            = 'admin/student_group_chart';
$route['GroupStrengthReport']   = 'admin/student_strength_report';

$route['yearHead']               ='ReportsController/year_head_report';
$route['degreeReport']           ='ReportsController/degree_report';
$route['TSWRDG']                  ='ReportsController/teacher_subject_wise_report_degree_graphic';
$route['TSWRDS/:num/:num/:num']  ='ReportsController/teacher_subject_wise_report_degree_students/:num/:num/:num';


$route['SARI']                      = 'ReportsController/student_attendance_report_inter';
$route['SARG']                      = 'ReportsController/student_attendance_report_grand';
$route['SARGTW']                      = 'ReportsController/student_attendance_report_grand_teacherwise';
$route['SARD']                      = 'ReportsController/student_attendance_report_degree';
$route['SARBCS']                    = 'ReportsController/student_attendance_report_bcs';
$route['SARHND']                    = 'ReportsController/student_attendance_report_hnd';
$route['SARAL']                     = 'ReportsController/student_attendance_report_alevel';
$route['SARDR/:num/:num/:num/:num'] = 'ReportsController/student_attendance_report_degree_result/:num/:num/:num/:num';
$route['SARGP/:num/:num/:num'] = 'ReportsController/student_attendance_report_grand_practical/:num/:num/:num';
$route['TMAR/:num/:num/:num/:num'] = 'AttendanceController/teacher_monthly_attendance_history_report/:num/:num/:num/:num';
$route['STCHR/:num/:num/:num/:num'] = 'AttendanceController/students_total_classes_history_report/:num/:num/:num/:num';
$route['SARDRI/:any/:num']          = 'ReportsController/student_attendance_report_degree_results/:any/:num';

$route['TeacherAtndMonthWise']     = 'ReportsController/teacher_attendance_month_wise_report';

$route['TeacherAttendanceEB']         = 'ReportsController/teacher_attendance_date_wise_report_enter_by';



$route['whiteCardInter']            = 'ReportsController/student_attendance_white_card_inter';
$route['whiteCardHND']              = 'ReportsController/student_attendance_white_card_hnd';
$route['whiteCardBBA']              = 'ReportsController/student_attendance_white_card_bba';
$route['whiteCardGrand']            = 'ReportsController/student_attendance_white_card_grand';
$route['whiteCardGrandHostel']      = 'ReportsController/student_attendance_white_card_grand_hostel';
$route['whiteCardGrandGui']         = 'ReportsController/student_attendance_white_card_grand_gui';
$route['whiteCardDegree']           = 'ReportsController/student_attendance_white_card_degree';
$route['whiteCardLaw']              = 'ReportsController/student_attendance_white_card_law';
$route['BSProgramWCard']            = 'ReportsController/bs_white_cards';
$route['whiteCardPrint/:num/:num']  = 'ReportsController/student_attendance_white_card_print/:num/:num';
$route['whiteCardTeacher/:num/:num'] = 'ReportsController/student_attendance_white_card_teacher/:num/:num';
$route['BSProgramAttRpt']            = 'ReportsController/bs_programes_attendance_marks_history';

$route['TMSI']                      = 'ReportsController/teacher_missing_test_inter';
$route['TMSD']                      = 'ReportsController/teacher_missing_test_degree';
$route['TMSHND']                    = 'ReportsController/teacher_missing_test_hnd';
$route['TMSAL']                     = 'ReportsController/teacher_missing_test_alevel';
$route['TMSBCS']                    = 'ReportsController/teacher_missing_test_bcs';
$route['TMSR/:num/:num/:num/:num/:num/:any'] = 'ReportsController/teacher_missing_test_result/:num/:num/:num/:num/:num/:any';

$route['positionWiseInter']         = 'ReportsController/student_position_wise_inter';
$route['positionWiseBcs']           = 'ReportsController/student_position_wise_bcs';
$route['positionWiseBs_English']    = 'ReportsController/student_position_wise_bs_english';
$route['positionWiseBs_Law']        = 'ReportsController/student_position_wise_bs_law';
$route['positionWiseA_Level']       = 'ReportsController/student_position_wise_a_level';
$route['positionWiseDegree']         = 'ReportsController/student_position_wise_degree';

$route['whiteCardInterHostel']      = 'ReportsController/student_attendance_white_card_inter_hostel'; 
$route['whiteCardBSHostel']         = 'ReportsController/student_attendance_white_card_bs_hostel';

$route['StudentStrengthReport']     = 'ReportsController/student_strength';
$route['SearchStrength']            = 'ReportsController/search_student_strength';
$route['StudentSubjects']           = 'ReportsController/subject_alloted_for_study';
$route['BsExameResultLaw']          = 'ReportsController/bs_exame_result_law';
$route['BsPrevExameResultLaw']      = 'ReportsController/bs_prev_exam_result_law';
$route['BsExameResult']             = 'ReportsController/bs_exame_result';
$route['BsPrevExameResult']         = 'ReportsController/bs_prev_exam_result';
$route['BsPrevExameResultLaw']      = 'ReportsController/bslaw_prev_exam_result';
$route['BSExamAwardList/:num']      = 'ReportsController/bs_exam_award_list/:num';
$route['BSExamAwardListPrev/:num']  = 'ReportsController/bs_exam_award_list_prev/:num';
$route['AggregateResult/:num']      = 'ReportsController/aggregate_result/:num';
$route['AggregateResultPrev/:num']  = 'ReportsController/aggregate_result_prev/:num';
$route['UOPResult/:num']            = 'ReportsController/uop_result/:num';
$route['UOPResultPrint/:num']       = 'ReportsController/uop_result_print/:num';
$route['UOPResultPrev/:num']        = 'ReportsController/uop_prev_result/:num';
$route['UOPResultPrintPrev/:num']   = 'ReportsController/uop_prev_result_print/:num';
$route['BsProgramSearch']           = 'ReportsController/bs_program_search';
$route['BsProgramSearchLaw']        = 'ReportsController/bs_program_search_law';
$route['ShiftWiseReport']           = 'ReportsController/student_shit_wise_report';
$route['StudentAbsenteeFine']       = 'ReportsController/student_absent_inter';

//User Poclicy
$route['userRole']                  = 'PolicyController/userRole';
$route['userRole/:num']             = 'PolicyController/userRole/:num';

$route['userRoleCreate']            = 'PolicyController/userRoleCreate';
$route['userRoleCreate/:num']       = 'PolicyController/userRoleCreate/:num';

$route['DataBaseUsers']                = 'PolicyController/data_base_users';
 
//$route['dbUser']                  = 'PolicyController/dbUser';
$route['dbUser/:num']               = 'PolicyController/dbUser/:num';
$route['UserCreateChk']                = 'PolicyController/db_user_create_check'; 
$route['UserCreate']                = 'PolicyController/dbUserCreate';
$route['UserInfo']              = 'PolicyController/get_user_update_info';
$route['UserUpdate']            = 'PolicyController/db_user_update';
$route['EmployeeNameAtuo']      = 'DropdownController/employee_name_with_designation_auto';
$route['EmployeeNameAtuo/:any']      = 'DropdownController/employee_name_with_designation_auto/:any';

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
$route['restricted']            = 'PolicyController/user_restricted_page';
$route['LoginDetails']          = 'PolicyController/login_details';


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



//$route['dNotiesUpdate/:num']         = 'FinanceController/student_defaulter_noties_update/:num';

$route['generalJournal']        = 'FinanceController/general_journal';

$route['Voucher']               = 'FinanceController/bank_voucher';
$route['VoucherEdit/:num']      = 'FinanceController/voucher_approval_persons_edit/:num';
$route['BankVoucherEdit/:num']  = 'FinanceController/bank_voucher_edit/:num';
$route['fnEmployeeInfo']        = 'FinanceController/finance_employee_info';
$route['fnSupplierInfo']        = 'FinanceController/finance_supplier_info';


$route['FnEmployee']            = 'FinanceController/finance_employee_auto';
$route['FnSupplierAuto']        = 'FinanceController/finance_supplier_auto';
$route['VoucherUpdate']         = 'FinanceController/update_voucher';
$route['VoucherSave']           = 'FinanceController/save_vouchers';
$route['VoucherPrint/:num']     = 'FinanceController/print_vouchers/:num';
$route['VoucherSign/:num']      = 'FinanceController/vouchers_sign_by/:num';
$route['VochSingDelete/:num/:num']   = 'FinanceController/vouchers_sign_by_delete/:num/:num';
$route['FnSupplier']            = 'FinanceController/finance_supplier';
$route['FnSupplier/:num']       = 'FinanceController/finance_supplier/:num';
$route['FnSuppDelete/:num']     = 'FinanceController/finance_supplier_delete/:num';
$route['FnYear']                = 'FinanceController/financial_year';
$route['FnYear/:num']           = 'FinanceController/financial_year/:num';
$route['FnYearDelete/:num']     = 'FinanceController/financial_year_delete/:num';
$route['FyBudget']              = 'FinanceController/financial_year_budget';

$route['AddFyBudget']           = 'FinanceController/finance_budget_add';
$route['searchVoucher']         = 'FinanceController/finance_voucher_search';
$route['SearchVhrChqPrint']         = 'FinanceController/finance_voucher_search_with_print';
$route['searchVoucherAdmin']    = 'FinanceController/finance_voucher_search_admin';
$route['voucherApproval/:num']  = 'FinanceController/voucher_approval/:num';
$route['ApprovalPersons']       = 'FinanceController/voucher_approval_persons';

$route['voucherApprovals/:num'] = 'FinanceController/voucher_approval_persons/:num';
//$route['voucherApprovalsEdit/:num'] = 'FinanceController/voucher_approval_personsEdit/:num';
$route['VochApprDelete/:num']   = 'FinanceController/voucher_approval_delete/:num';
$route['checkDateRange']        = 'FinanceController/check_date_range';
$route['FnCashier']             = 'FinanceController/finance_cashier';
$route['FnCashier/:num']        = 'FinanceController/finance_cashier/:num';
$route['FnCashierDelete:/']     = 'FinanceController/finance_cashier_delete:/';

$route['ChequePrint/:num']     = 'FinanceController/cheque_prints/:num';
$route['SaveChequeResult']     = 'FinanceController/save_print_cheque_result';
$route['SaveCheque']            = 'FinanceController/save_print_cheque';
$route['SaveChequeEdit']        = 'FinanceController/save_print_cheque_edit';
$route['ChequeUpdate']          = 'FinanceController/save_print_cheque_update_record';
$route['ChequePrintSetting/:num']      = 'FinanceController/cheque_print_setting/:num';
$route['ChequePrintSettingFonts/:num']      = 'FinanceController/cheque_print_setting_fonts/:num';
$route['BankCoAmount']          = 'FinanceController/bank_coa_amount';

//Hostel Mess
$route['HmChequePrint/:num']     = 'FNHostelMessController/cheque_prints_hostel_mess/:num';

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
$route['fixedAssetsItemwise']   = 'InventoryController/fixed_assets_item_wise';
$route['autocompleteItemsCons']     = 'InventoryController/autocomplete_items_cons';


$route['Quotations']            = 'InventoryController/quotations';
$route['DemoQuotationItem']     = 'InventoryController/demo_quotation_item';
$route['AddQuotationItem']      = 'InventoryController/add_quotation_item';
$route['DeleteSingleItem']      = 'InventoryController/delete_quotation_item';
$route['SaveQuotationItems']    = 'InventoryController/save_quotation_items';
$route['QuotationItemGrid']     = 'InventoryController/quotation_items_grid';
$route['SaveQuotationRecord']   = 'InventoryController/save_quotation_record';
$route['QuotationsGrid']        = 'InventoryController/quotation_grid';
$route['QuotationsRecord']      = 'InventoryController/quotations_record';
$route['SearchQuotations']      = 'InventoryController/search_quotations';

$route['AddMoreQuotations']     = 'InventoryController/quotation_add_more';
$route['AddMoreQuotations/:num'] = 'InventoryController/quotation_add_more/:num';
$route['EditQuotationDetails']  = 'InventoryController/edit_quotation_details';
$route['UpdateQuotationDetails'] = 'InventoryController/update_quotation_details';
$route['DeleteQuotationDetails'] = 'InventoryController/delete_quotation_details';

$route['ComparativeStatement']  = 'InventoryController/comparative_statement';
$route['ComparativeStatement/:num'] = 'InventoryController/comparative_statement/:num';
$route['SaveComparative']       = 'InventoryController/save_comparative_statement';
$route['GenerateComparative']   = 'InventoryController/generate_comparative_statement';
$route['GenerateComparative/:num'] = 'InventoryController/generate_comparative_statement/:num';
$route['ComparativeRecord']     = 'InventoryController/comparative_state_record';
$route['SearchComparative']     = 'InventoryController/search_comparative_statement';


//Purchase Order

$route['ComparativeLTPurchaseOrder'] = 'InventoryController/comparative_state_ps';
$route['SearchComparativeLTPO'] = 'InventoryController/search_cs_for_po';
$route['PurchaseOrderNew']      = 'InventoryController/new_purchase_order';
$route['PurchaseOrderNew/:num/:num'] = 'InventoryController/new_purchase_order/:num/:num';
$route['PurchaseOrderItems']    = 'InventoryController/new_purchase_order_items';
$route['SavePurchaseOrderRecord'] = 'InventoryController/save_purchaseorder_record';


//Work Order

$route['ComparativeLTWorkOrder'] = 'InventoryController/comparative_state_wko';
$route['SearchComparativeLTWO'] = 'InventoryController/search_cs_for_wko';
$route['WorkOrderNew']          = 'InventoryController/new_work_order';
$route['WorkOrderNew/:num/:num'] = 'InventoryController/new_work_order/:num/:num';
$route['WorkOrderItems']        = 'InventoryController/new_work_order_items';
$route['SaveWorkOrderRecord']   = 'InventoryController/save_workorder_record';


//Minute Sheet
//HOD Panel
$route['MinuteSheetInitiate']           = 'MinuteSheetController/minute_sheet_initiate';
$route['MinuteSheetRecord']             = 'MinuteSheetController/minute_sheet_record';
$route['MinuteSheetEdit']               = 'MinuteSheetController/edit_minute_sheet';
$route['MinuteSheetEdit/:num']          = 'MinuteSheetController/edit_minute_sheet/:num';
$route['MinuteSheetHODComments']        = 'MinuteSheetController/minute_sheet_hod_comments';
$route['MinuteSheetHODComments/:num']   = 'MinuteSheetController/minute_sheet_hod_comments/:num';
//Admin Officer Panel
$route['MinuteSheetRecordADO']          = 'MinuteSheetController/ado_minute_sheet_record';
$route['MinuteSheetProcessADO']         = 'MinuteSheetController/ado_process_minute_sheet';
$route['MinuteSheetProcessADO/:num']    = 'MinuteSheetController/ado_process_minute_sheet/:num';
//Finance Officer Panel
$route['MinuteSheetRecordFNO']          = 'MinuteSheetController/fno_minute_sheet_record';
$route['MinuteSheetProcessFNO']         = 'MinuteSheetController/fno_process_minute_sheet';
$route['MinuteSheetProcessFNO/:num']    = 'MinuteSheetController/fno_process_minute_sheet/:num';
//Director Finance Panel
$route['MinuteSheetRecordDFN']          = 'MinuteSheetController/dfn_minute_sheet_record';
$route['MinuteSheetProcessDFN']         = 'MinuteSheetController/dfn_process_minute_sheet';
$route['MinuteSheetProcessDFN/:num']    = 'MinuteSheetController/dfn_process_minute_sheet/:num';
//Vice Principal Panel
$route['MinuteSheetRecordVPAC']         = 'MinuteSheetController/vpac_minute_sheet_record';
$route['MinuteSheetRecordVPAD']         = 'MinuteSheetController/vpad_minute_sheet_record';
$route['MinuteSheetProcessVP']          = 'MinuteSheetController/vp_process_minute_sheet';
$route['MinuteSheetProcessVP/:num']     = 'MinuteSheetController/vp_process_minute_sheet/:num';
//Principal Panel
$route['MinuteSheetRecordPrincipal']        = 'MinuteSheetController/principal_minute_sheet_record';
$route['MinuteSheetProcessPrincipal']       = 'MinuteSheetController/prn_process_minute_sheet';
$route['MinuteSheetProcessPrincipal/:num']  = 'MinuteSheetController/prn_process_minute_sheet/:num';
$route['MinureSheetPrint']                  = 'MinuteSheetController/print_minute_sheet';
$route['MinureSheetPrint/:num']             = 'MinuteSheetController/print_minute_sheet/:num';



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
$route['feeChallanPrintPDC/:num/:num']          = 'FeeController/fee_Challan_Print_print_date_change/:num/:num'; 
$route['feeStudentChallanPrint/:num/:num']      = 'StudentController/fee_student_challan_print/:num/:num'; 

$route['feeChallanPrintAdmission/:num/:num']    = 'FeeController/fee_challan_print_admission/:num/:num'; 

//$route['feeChallanPrintAdmission/:num/:num']    = 'FeeController/fee_challan_print_admission/:num/:num'; 

$route['feeChallanPrintOthrInstal/:num/:num']   = 'FeeController/fee_challan_other_installments/:num/:num'; 
$route['PrintClassWise/:num/:num/:num/:num']    = 'FeeController/print_challan_class_wise/:num/:num/:num/:num'; 
$route['PrintLanguages/:num/:num/:num']         = 'FeeController/print_challan_language_print/:num/:num/:num'; 
$route['PrintClassWiseGroup/:num/:num/:num']    = 'ReportsController/student_attendance_white_card_print_group/:num/:num/:num';
$route['PrintClassWiseGroupHostel/:num/:num/:num']    = 'ReportsController/student_attendance_white_card_print_group_hostel/:num/:num/:num';
$route['PrintBatch/:num/:num/:num/:num']        = 'FeeController/print_challan_wise/:num/:num/:num/:num';
$route['feeLedgerRpt']                          = 'FeeController/fee_ledger_report';
$route['hostelLedgerRpt']                       = 'HostelController/hostel_ledger_report'; 
$route['AudithostelLedgerRpt']                  = 'HostelController/audit_hostel_ledger_report'; 

$route['feePayment']                = 'FeeController/fee_challan_payment';
$route['feePaymentAll']             = 'FeeController/fee_challan_payment_all';
$route['feeInstallment']            = 'FeeController/fee_installment';


$route['feeRefund']                 = 'FeeController/fee_refund';
$route['feeChangeDate']             = 'FeeController/fee_challan_change_date';
$route['concStdSearch']             = 'FeeController/fee_concession_student_search';
$route['feeConcession/:num']        = 'FeeController/fee_concession/:num';
$route['feeConcession']             = 'FeeController/fee_concession';
$route['UnPaidChallan/:num']        = 'FeeController/un_paid_challan/:num';
 
//Fee Modul Reports 
$route['Reconcilition']             = 'FeeController/bank_reconciliation_statment';
$route['FeeDefaulterDetails']       = 'FeeController/fee_defaulter_details_report';
$route['FeeDefaulterHead']          = 'FeeController/fee_defaulter_head_report';
$route['PaidAmount']                = 'FeeController/fee_paid_amount';
$route['concessionReport']          = 'FeeController/fee_concession_report';
$route['concessionForm']            = 'FeeController/fee_concession_form';
$route['printConcessonForm/:num']   = 'FeeController/print_concession_form/:num';
$route['annualFee']                 = 'FeeController/annual_fee';
$route['annualFeeBill/:num']        = 'FeeController/annual_fee_genearte/:num';
$route['installmentDate']           = 'FeeController/installment_date';
$route['feeRefundRpt']              = 'FeeController/fee_refund_report';
$route['feeRefundRptDegree']        = 'FeeController/fee_refund_report_degree';
$route['updateUnpaidChallan']       = 'FeeController/fee_challan_update';
$route['updatePaidChallan']         = 'FeeController/fee_paid_challan_update';
$route['updateChallanUri/:num']     = 'FeeController/fee_challan_update_uri/:num';

$route['otherInstallment']          = 'FeeController/search_other_installment';
$route['generateOthrInstll/:num']   = 'FeeController/generate_other_installment/:num';
$route['balanceChallan/:num/:num']     = 'FeeController/balance_challan_generate/:num//:num';
$route['fullDetails/:num']          = 'FeeController/student_full_details/:num';
$route['AdminFullDetails/:num']     = 'FeeController/admin_student_full_details/:num';
$route['Clearence']                 = 'FeeController/student_clearence';
$route['UpdateFeeHeadDetails']      = 'FeeController/update_fee_head_details';
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
//$route['feeDefaulter']              = 'FeeController/fee_defaulter_forum';
$route['feeDefaulter']              = 'FeeController/fee_defaulter';
$route['DnoticeReport']             =     'FeeController/fee_denotic_report';

$route['defaulterNoties']           = 'FinanceController/fee_defaulter_forum';
$route['NewDeNoties']               = 'FinanceController/student_defaulter_noties_new';
$route['EditDeNoties/:num']         = 'FinanceController/student_defaulter_noties_update/:num';
$route['PrintDeNoties/:num']        = 'FinanceController/print_defaulter_notice/:num';
$route['TransfarStudent']           = 'FeeController/transfar_student';
$route['TransferBalance/:num/:num'] = 'FeeController/transfar_balance/:num/:num'; 

$route['Fee-Message']              = 'FeeController/fee_defaulter_message';
$route['Message-Details']          = 'FeeController/fee_defaulter_message_details';
$route['Fee-Message-Report']        = 'FeeController/fee_defaulter_sms_report';
$route['Fee-Message-Report-Grid']   = 'FeeController/fee_defaulter_sms_report_grid';

$route['Fee-Message-Quota']         = 'FeeController/fee_defaulter_sms_quota';
$route['Fee-Message-Quota-Details'] = 'FeeController/fee_defaulter_sms_quota_details';


$route['BRRLock']                   = 'FeeController/bank_reconciliation_report_lock'; 
$route['editRecLock/:num']          = 'FeeController/bank_reconciliation_report_lock_edit/:num'; 
$route['ProspectusChlnLock']        = 'FeeController/prospectus_challan_lock'; 
$route['ProspectusChlnLockEdit/:num']    = 'FeeController/prospectus_challan_lock_edit/:num'; 
$route['showSubProgramAddInstallmentHead']          = 'FeeController/show_Sub_program_add_installment_head'; 
$route['netReceivable']             = 'FeeController/net_receivable_amount';
$route['FeeCreditChallanAdjust']    = 'FeeController/fee_credit_challan_adjust';
$route['DeleteCreditAdj/:num/:num'] = 'FeeController/delete_credit_adjust/:num/:num';
$route['RemoveDeleteStatus']              = 'FeeController/fee_remove_delete_status';
$route['UpdateRemoveHead/:num/:num'] = 'FeeController/update_remove_head/:num/:num';
$route['FeeHeadDelete/:num/:num']   = 'FeeController/fee_head_delete/:num/:num';

$route['ChallanDateChange']         = 'FeeController/fee_challan_update_date';
$route['Challan-Change-Date-Grid']  = 'FeeController/fee_change_challan_date_grid';



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
$route['itemGRNdate']           = 'InventoryController/item_grn_date';
$route['itemGRNinfo']           = 'InventoryController/item_grn_info';



$route['inventoryDeptSearch']       = 'InventoryController/inventory_dept_value_search';
//$route['autocompleteSupplier']   = 'InventoryController/autocomplete_supplier';
$route['inventoryDeptValue']        = 'InventoryController/inventory_dept_value';
$route['deptItemsValues/:num']      = 'InventoryController/inventory_dept_value_update/:num';

$route['inventoryReportDetails']    = 'InventoryController/inventory_report_details';
$route['GeneralInventoryReport']    = 'InventoryController/general_inventory_report';
$route['GeneralReportResult']       = 'InventoryController/inventory_report_search_details_result';
$route['GeneralReportResultItem']       = 'InventoryController/inventory_report_search_details_result_item_wise';
$route['fixedItemEdit']             = 'InventoryController/fixed_item_edit';
$route['inventorySearchDetails']    = 'InventoryController/inventory_report_search_details';
$route['fixedItemSearchEdit']       = 'InventoryController/fixed_item_edit_search_result';
$route['fixedItemEditPage/:num']    = 'InventoryController/fixed_item_edit_page';


$route['GuiDashobard']              = 'GuiController/gui_dashobard';
$route['GuiDashobardAuditor']       = 'GuiController/gui_dashobard_auditor';
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
$route['Hostel/Challan/Single/Index']         = 'HostelController/hostel_mess';
//$route['hostelMess']                = 'HostelController/hostel_mess';
$route['HostelNewRecord/:num']      = 'HostelController/hostel_new_record/:num';
$route['HostelNewRecordAdmin/:num'] = 'HostelController/hostel_new_record_admin/:num';
$route['HostelNewRecordAdminUpdate/:num'] = 'HostelController/hostel_new_record_admin_update/:num';
$route['HostelNewRecordAdminFee/:num'] = 'HostelController/hostel_new_record_admin_fee/:num';
 
$route['hostelMessHeads']           = 'HostelController/hostel_mess_heads';
$route['addHostelHead']             = 'HostelController/add_hostel_head_demo';
$route['hostelMessHeadsNew']        = 'HostelController/hostel_mess_heads_new';
$route['hostelMessHeadsNewAdmin']   = 'HostelController/hostel_mess_heads_new_admin';
$route['hostelMessHeadsAdv']        = 'HostelController/hostel_mess_heads_adv';
$route['hostelMessHeads/:num']      = 'HostelController/hostel_mess_heads/:num';
$route['hostelMessHeadsNewEdit/:num']= 'HostelController/hostel_mess_heads_new_edit/:num';
$route['HMDelete/:num']             = 'HostelController/hostel_mess_heads_delete/:num';
$route['checkHostelHead']           = 'HostelController/hostel_heads_check';
$route['hosteHeadInstall']          = 'HostelController/search_hotel_setups_info';

$route['Hostel/Challan/Single/Hostel']  = 'HostelController/hostel_fee';
//$route['hostelFee']                   = 'HostelController/hostel_fee';
$route['HosteInstallmetnJS']            = 'HostelController/hostel_installment_info';
$route['Hostel/Challan/Single/Mess']    = 'HostelController/mess_fee';
//$route['messFee']                   = 'HostelController/mess_fee';
$route['hostelFeeGroup']            = 'HostelController/hostel_fee_group';
$route['hostelPrintChallan/:num/:num']  = 'HostelController/hostel_challan_print/:num/:num';
$route['HostelChallanPrint/:num/:num']  = 'StudentController/hostel_print_challan/:num/:num';
$route['hostelPrintChallanGroup/:num/:num/:num']    = 'HostelController/hostel_challan_print_group/:num/:num/:num';

$route['hostelAddHead/:num/:num']           = 'HostelController/hostel_add_head/:num/:num';
$route['hostelUpdateChallan/:num/:num']     = 'HostelController/hostel_challan_update/:num/:num';
$route['hostelCancelChallan/:num/:num']     = 'HostelController/hostel_challan_cancel/:num/:num';
$route['updateHostelHead/:num/:num/:num']   = 'HostelController/hostel_head_update/:num/:num/:num';
$route['deleteHostelHead/:num/:num/:num']   = 'HostelController/hostel_head_delete/:num/:num/:num';

$route['HMPayments']                        = 'HostelController/hostel_mess_payment';
$route['HMInstallment']                     = 'HostelController/hostel_mess_installment';
$route['changeChallanStatus']               = 'HostelController/hostel_mess_challan_change_status';
$route['hostePaymentRpt']                   = 'HostelController/hostel_payment_report';
$route['hosteChallanSearch']                = 'HostelController/hostel_challan_search';
$route['AdminhostelChallanSearch']           = 'HostelController/hostel_admin_challan_search';
$route['hostelRefundRpt']                   = 'HostelController/hostel_refund_report';
 $route['HMRefund']                         = 'HostelController/hostel_mess_refund';
$route['whiteCardBCS']                      = 'ReportsController/student_attendance_white_card_bcs';
$route['whiteCardAlevel']                   = 'ReportsController/student_attendance_white_card_alevel';
$route['PrintGroupWisePractical/:num']      = 'ReportsController/student_practical_white_card_group/:num';
 $route['MSChangeDate']                     = 'HostelController/hoste_mess_change_date';
 $route['ExtraAmountAdjustHM']               = 'HostelController/hm_extra_amount_adjust';
 $route['showHostelMessResut']               = 'HostelController/show_hostel_mess_result_js';
$route['deleteHostelMessResut']             = 'HostelController/delete_hostel_mess_result_js';
$route['getBlockRooms']                     = 'HostelController/get_block_rooms_js';
$route['adStdHostel']                       = 'HostelController/add_student_hostel_js';
$route['HosteChallanDetailsJS']             = 'HostelController/hoste_challan_details_js';
$route['HosteChallanDetailsSaveJS']         = 'HostelController/hoste_challan_details_save_js';
$route['DeleteHostel/:num']                 = 'HostelController/hostel_student_delete/:num';

$route['HMChangeDatePaid']                  = 'HostelController/change_date_paid_challan';
$route['HM-Challan-Change-Date-Grid']                  = 'HostelController/change_challan_date_grid';
 
$route['AuditSearchVoucher']                = 'AuditController/audit_finance_voucher_search';
$route['AuditFeeSearch']                    = 'AuditController/audit_fee_search_filter';


// Hostel & Mess Account Setups Route
$route['HmApprovalPersons']                 = 'FNHostelMessController/hm_voucher_approval_persons';
$route['HmApprovalPersons/:num']            = 'FNHostelMessController/hm_voucher_approval_persons/:num';
$route['HmVoucherEdit/:num']                = 'FNHostelMessController/hm_voucher_approval_persons_edit/:num';
$route['HmVochApprDelete/:num']             = 'FNHostelMessController/voucher_approval_delete_hostel_and_mess/:num';

$route['HmCOAPrents']                       = 'FNHostelMessController/hm_chart_of_account';
$route['HmCOAPrents/:num']                  = 'FNHostelMessController/hm_chart_of_account/:num';

$route['HmCOAChild']                        = 'FNHostelMessController/hm_coa_master_child';
$route['HmCOAChild/:num']                   = 'FNHostelMessController/hm_coa_master_child/:num';

$route['HmCOASubChild']                     = 'FNHostelMessController/hm_coa_master_sub_child';
$route['HmCOASubChild/:num']                = 'FNHostelMessController/hm_coa_master_sub_child/:num';

$route['HmFinanceYear']                     = 'FNHostelMessController/hm_financial_year';
$route['HmFinanceYear/:num']                = 'FNHostelMessController/hm_financial_year/:num';

$route['HmFnSupplier']                        = 'FNHostelMessController/hm_finance_supplier';
$route['HmFnSupplier/:num']                   = 'FNHostelMessController/hm_finance_supplier/:num';

$route['HmFyBudget']                        = 'FNHostelMessController/hm_financial_year_budget';
$route['HmAutocompleteAmount']              = 'FNHostelMessController/hm_autocomplete_amount';


//Hostel & Mess Account Forms Routes 

$route['HmVoucher']                         = 'FNHostelMessController/hm_bank_voucher';
$route['HmCheckDateRange']                  = 'FNHostelMessController/hm_check_date_range';
$route['HmVoucherSave']                     = 'FNHostelMessController/hm_save_vouchers';
$route['HmVoucherPrint/:num']               = 'FNHostelMessController/hm_print_vouchers/:num';


$route['HmSearchVoucher']                   = 'FNHostelMessController/hm_finance_voucher_search';

$route['HmSearchVhrChqPrint']               = 'FNHostelMessController/hm_finance_voucher_search_with_cheque_print';

$route['HmBankVoucherEdit/:num']            = 'FNHostelMessController/hm_bank_voucher_edit/:num';
$route['HmSaveAmountUpdate']                = 'FNHostelMessController/hm_save_amount_update';
$route['HmVoucherApproval/:num']            = 'FNHostelMessController/hm_voucher_approval/:num';
$route['HmVoucherSign/:num']                = 'FNHostelMessController/hm_vouchers_sign_by/:num';
$route['HmVochSingDelete/:num/:num']        = 'FNHostelMessController/hm_vouchers_sign_by_delete/:num/:num';

$route['HmBRS']                             = 'FNHostelMessController/hm_bank_reconciliation_statement';
$route['HmBRSReport']                       = 'FNHostelMessController/hm_bank_reconciliation_statement_report';
$route['HmBRSPrint/:num']                   = 'FNHostelMessController/hm_brs_report_print/:num';
$route['HmBRSEdit/:num']                    = 'FNHostelMessController/hm_brs_report_edit/:num';
$route['HmBRSReportAdmin']                  = 'FNHostelMessController/hm_bank_reconciliation_statement_report_admin';


//HM  Reports 

$route['HmBalanceSheet']                    = 'FNHostelMessController/hm_balance_sheet';
$route['HmTrialBalanceNew']                 = 'FNHostelMessController/hm_trail_balance_new';
$route['HmTrialBalance']                    = 'FNHostelMessController/hm_trial_balance';
$route['HmTBDetail']                        = 'FNHostelMessController/hm_trial_balance_detail';
$route['HmGeneralLedger']                   = 'FNHostelMessController/hm_general_ledger';

$route['HmIncomeStatement']                   = 'FNHostelMessController/hm_income_statument';


//SMS Routes

$route['FeeMessage']                        = 'SmsController/student_fee_sms';
//$route['generalMessage']                  = 'SmsController/general_message';
$route['GuardianMessage']                   = 'SmsController/guardian_message';
$route['StudentGenMessage']                 = 'SmsController/student_general_Message';
$route['staffSms']                          = 'SmsController/staff_message';
$route['attendanceMessage']                 = 'SmsController/attendance_message';
$route['attendanceMessagedw']               = 'SmsController/attendance_message_date_wise';
$route['AttendanceDefMsg']                  = 'SmsController/student_attendance_defaulter_message';
$route['studentSMSReport']                  = 'SmsController/student_sms_report'; 
$route['studentSMSReportInter']             = 'SmsController/student_sms_report_inter';
$route['employeeSmsReport']                 = 'SmsController/employee_sms_report';
$route['ApplcantMessage']                   = 'SmsController/applicant_message';
$route['HostelMessage']                     = 'SmsController/hostel_message';
$route['checkSMSPassword']                  = 'SmsController/check_sms_password';

//Student Subjects Alloted History

$route['InterSubjectsAllotedHistory']       = 'AttendanceController/subject_log_report_inter';
$route['ALevelSubjectAllotedHistory']       = 'AttendanceController/subject_log_report_a_level';
$route['PracticalGroupChart']               = 'AttendanceController/practical_group_chart';
$route['PracticalGroupChartView/:num']           = 'AttendanceController/practical_group_chart_view/:num';
$route['PracticalAttendanceSheet/:num']      = 'AttendanceController/practical_attendance_sheet_print/:num';
//Student Promotions Date History
$route['PromotionDateHistory']              = 'AttendanceController/student_promotions_history';

//Class Alloted History
$route['ClassAllotedHistory']               = 'ReportsController/class_alloted_log_report';
$route['HostelAttendanceMarksDetails']            = 'ReportsController/hostel_attandance_marks_details_report';

$route['DisciplineAction']                  =   'AdminDeptController/discipline_action';
$route['DisciplineAction/:num']             =   'AdminDeptController/discipline_action/:num';
$route['AddDisciplineAction/:num']          =   'AdminDeptController/add_discipline_action/:num';
$route['UpdateAction/:num/:num']            =   'AdminDeptController/update_discipline_action/:num/:num';
$route['DisabledAction/:num/:num']          =   'AdminDeptController/disabled_discipline_action/:num/:num';

$route['BudgetedStudent']                   =    'ReportsController/budgeted_student';
$route['StudentCumulativeMontly']           =    'ReportsController/student_cumulative_montly';
$route['AttendancePercentageWise']          =    'ReportsController/student_attendance_percentage_wise';
$route['StudentDefaulterExcel']             =    'ReportsController/student_attendance_defaulter_excel';






//Online Admission Routes 

$route['OnlineAPI']                         = 'ApiController/live_api_student_info';

$route['FeeVerification']                   = 'OnlineController/student_fee_verfications';
$route['ShowApplicantProfile']              = 'OnlineController/show_applicant_profile';
$route['FeeVerification/:num']              = 'OnlineController/student_fee_verfications/:num';
$route['ChallanPDFu/:num']                  = 'OnlineController/student_challan_pdf_uri/:num';
$route['AdmissionFormDownloadu/:num']       = 'OnlineController/admission_form_download_uri/:num';
$route['savePaidDetals']                    = 'OnlineController/save_paid_challan_info';
$route['DataVerification']                  = 'OnlineController/student_data_verification';
$route['DataVerification/:num']             = 'OnlineController/student_data_verification/:num';
$route['FeeVerfUpdate']                     = 'OnlineController/fee_verification_update';
$route['FeeVerfUpdateDate']                 = 'OnlineController/fee_verification_update_date';
$route['savePaidDetalsUpdate']              = 'OnlineController/save_paid_challan_info_update';
$route['GrandReportv01']                    = 'OnlineController/grand_report_v01';
$route['FeeVerificationReport']             = 'OnlineController/fee_verification_report';
$route['OnlineGeneralMsg']                  = 'OnlineController/online_student_general_message'; //////////
$route['StudentMessageLanguage']            = 'OnlineController/online_student_general_message_language';
$route['OnlineParentMsg']                   = 'OnlineController/online_parent_general_message';
$route['ApplicantRecordOnline']             = 'OnlineController/applicant_record_admin';
$route['ApplicantRecord/:num']              = 'OnlineController/applicant_record_admin/:num';
$route['EditApplicantPicture']              = 'OnlineController/edit_applicant_picture';
$route['UpdateApplicantPicture']            = 'OnlineController/update_applicant_picture';
$route['EditChallanPicture']                = 'OnlineController/edit_challan_picture';
$route['UpdateChallanPicture']              = 'OnlineController/update_challan_picture';
$route['SaveAppStatus']                     = 'OnlineController/save_applicant_status';
$route['EditApplicantRecord/:num']          = 'OnlineController/edit_applicant_record_admin/:num';
$route['UpdateApplicantRecord']             = 'OnlineController/update_applicant_record';
$route['BSAdmissionForm']                   = 'OnlineController/online_bs_admission_form';
$route['SaveOnlineAdmissionForm']           = 'OnlineController/save_online_admission_form';

$route['EditApplicantStatus']               = 'OnlineController/edit_applicant_status';
$route['AllBSRecords']                      = 'OnlineController/all_bs_records_online';
$route['AllBSRecords/:num']                 = 'OnlineController/all_bs_records_online/:num';

$route['DDSubPrograms']                     = 'DropdownController/sub_programs_dropdown';
$route['DDBatch']                           = 'DropdownController/batch_dropdown';
$route['DDSections']                        = 'DropdownController/sections_dropdown';
$route['AdminGrandReportSyn']               = 'DashboardController/admin_grand_report_0_1v';

$route['FeeChallanNewAdmission']            = 'OnlineController/fee_challan_new_admission';
$route['VerifyPDF']                         = 'OnlineController/student_pdf_verify';
$route['VerifyPDF/:num']                    = 'OnlineController/student_pdf_verify/:num';
$route['GenerateSinglePDF/:num']            = 'OnlineController/generate_singale_pdf/:num';
$route['GeneratePDFOnly']                   = 'OnlineController/generate_pdf_only'; //////////////////////
$route['UpdateShift']                       = 'OnlineController/update_students_shift';
 

$route['AdminGrandReport']                  = 'DashboardController/admin_grand_report';
$route['LawRecordReadOnly']                 = 'Admin/law_student_record_readonly';
$route['LawRecordReadOnly/:num']            = 'Admin/law_student_record_readonly/:num';

$route['ALevelRecords']                     = 'AdmissionController/a_level_records';
$route['ALevelRecords/:num']                = 'AdmissionController/a_level_records/:num';

$route['EnglishLanguageRecords']            = 'LanguageController/english_language_records';
$route['EnglishLanguageRecords/:num']       = 'LanguageController/english_language_records/:num';
$route['RegEnglishLangStudent']             = 'LanguageController/english_language_registration';
$route['UpEnglishLangStudent/:num']         = 'LanguageController/english_language_update/:num';

$route['ChineseLanguageRecords']            = 'LanguageController/chinese_language_records';
$route['ChineseLanguageRecords/:num']       = 'LanguageController/chinese_language_records/:num';
$route['RegChineseLangStudent']             = 'LanguageController/chinese_language_registration';
$route['UpChineseLangStudent/:num']         = 'LanguageController/chinese_language_update/:num';




$route['IELTSLanguageRecords']              = 'LanguageController/ilets_language_records';
$route['IELTSLanguageRecords/:num']       = 'LanguageController/ilets_language_records/:num';
$route['RegIELTSLangStudent']             = 'LanguageController/ielts_language_registration';
$route['UpIELTSLangStudent/:num']         = 'LanguageController/ielts_language_update/:num';



$route['BookCategorySetup']                 = 'LibraryController/book_category_setup';



$route['DisciplinaryActions']           = 'AttendanceController/disciplinary_actions';
$route['DisciplinaryActionsVP']         = 'AttendanceController/disciplinary_actions_vp';
$route['EditDisciplinaryAction/:num']   = 'AttendanceController/edit_disciplinary_action/:num'; 
$route['EditDisciplinaryActionVP/:num'] = 'AttendanceController/edit_disciplinary_action_vp/:num'; 
$route['EditWhiteCardRemarksDACP/:num'] = 'AttendanceController/edit_disciplinary_action_wc_remarks_cp/:num'; 
$route['EditWhiteCardRemarksDA/:num']   = 'AttendanceController/edit_disciplinary_action_wc_remarks/:num'; 
$route['ViewDisciplinaryAction/:num']   = 'AttendanceController/view_disciplinary_action/:num'; 



//HR Controller Start
$route['EmployeeRecords']               = 'HrController/all_employee_reocrd';
$route['EmployeeRecords/:any']          = 'HrController/all_employee_reocrd/:any';


//HR Controller End


// ID Card Routes
$route['IDCardExpiry']                      = 'IDCardController/idcard_expiry';
$route['StudentsForIDCards']                = 'IDCardController/students_for_idcards';
$route['IDCardsCredentials/:num']           = 'IDCardController/idcard_credentials/:num';
$route['PrintAndSaveIDCard']                = 'IDCardController/idcard_save_and_print';
$route['RFIDForm/:num']                     = 'IDCardController/rfid_form/:num';
$route['StudentIDCardsPrinted']             = 'IDCardController/printed_student_idcards';
$route['EmploysForIDCards']                 = 'IDCardController/employs_for_idcards';
$route['EmployIDCardsCredentials/:num']     = 'IDCardController/employ_idcard_credentials/:num';
$route['PrintAndSaveEmployIDCard']          = 'IDCardController/employ_idcard_save_and_print';
$route['EmployRFIDForm/:num']               = 'IDCardController/employ_rfid_form/:num';
$route['EmployIDCardsPrinted']              = 'IDCardController/printed_employ_idcards';
$route['BSStudent']                         = 'UserController/enroller_bs_students';
 


$route['Messages/Chief-Proctor']            = 'SmsController/chief_proctor_index';
$route['Messages/Chief-Proctor/Details']    = 'SmsController/chief_proctor_details';
//Report
$route['Messages/Chief-Proctor/Report']         = 'SmsController/chief_proctor_report';
$route['Messages/Chief-Proctor/Report/Grid']    = 'SmsController/chief_proctor_report_grid';



$route['admissionChallan']                      = 'FeeController/admission_challan';
$route['admissionChallanGent/:num']                 = 'FeeController/admission_challan_generate/:num';


//Route By Module Wise

$route['Fee/Admisson/MertiList/Marks/ChangeShif']       = 'Fee/Admission/MeritListSetupController/ChangeShift';
$route['Fee/Admisson/MertiList/Marks/ChangeShif/Grid']  = 'Fee/Admission/MeritListSetupController/ChangeShiftGrid';

$route['Fee/Admisson/Challan/SearchMerit']          = 'Fee/Admission/SearchController/search_admission_challan';
$route['Fee/Admission/Challan/Generate/:num']       = 'Fee/Admission/AdmissionController/generate_admission_challan/:num';


$route['Attendance/Allotted/Groups/List']               = 'Attendance/Allotted/Group/ReportsController/teacher_alloted_groups';
$route['Attendance/List/Percentage/:any/:num/:num']          = 'Attendance/Allotted/Group/ReportsController/teacher_alloted_groups_details';
$route['Attendance/List/Percentage/:any/:num/:num/:num']     = 'Attendance/Allotted/Group/ReportsController/teacher_alloted_groups_details';


$route['Attendance/Setup/TimeTable']                    = 'Attendance/Setup/TimeTable/SetupController/index';
$route['Attendance/Setup/TimeTable/Create']             = 'Attendance/Setup/TimeTable/SetupController/create';
$route['Attendance/Setup/TimeTable/Show']               = 'Attendance/Setup/TimeTable/SetupController/show';
$route['Attendance/Setup/TimeTable/Update/:num']        = 'Attendance/Setup/TimeTable/SetupController/update/:num';
$route['Attendance/Setup/TimeTable/Delete/:num']        = 'Attendance/Setup/TimeTable/SetupController/delete/:num';


$route['AutoComplete/Employee/Teacher/Serving']         = 'DropdownController/auto_employee_teachers_serving';
$route['AutoComplete/Sections']                         = 'DropdownController/auto_section_active';