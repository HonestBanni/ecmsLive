<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class   SearchController extends AdminController {
	function __construct()
	{
            parent::__construct();
            $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
            $this->load->model('FeeModel');
	}

 
    public function search_admission_challan(){
        $this->data['form_no']      = '';
        $this->data['student_name'] = '';
        $this->data['father_name']  = '';
        
        if($this->input->post('search')):
            
            $form_no        = $this->input->post('form_no');
            $student_name   = $this->input->post('student_name');
            $father_name    = $this->input->post('father_name');
            $where = '';
//            $where['student_status.s_status_id']    = 1;
//             $where['student_record.batch_id']      = 19;
//             $where['student_record.batch_id']      = 1;
            $like= '';
            if($form_no):
                $this->data['form_no']      = $form_no;
                $where['form_no']      = $form_no;
            endif;
            if($father_name):
                $this->data['father_name']  = $father_name;
                $like['father_name']      = $father_name;
            endif;
            if($student_name):
                $this->data['student_name'] = $student_name;
                $like['student_name']      = $student_name;
            endif;
            
           $this->data['result'] = $this->FeeModel->get_apply_student_merit($where,$like);
//          echo '<pre>';print_r( $this->data['result'] );die;
        endif;
        
        
        $this->data['page']         = 'Fee/Admission/Challan/search_with_merit'; 
        $this->data['page_header']  = 'New Admission Challan ( Merit ) ';
        $this->data['page_title']   = 'New Admission Challan ( Merit ) | ECMS';
        $this->load->view('common/common',$this->data);
    }  
    
       public function generate_admission_challan(){
        
       
        $uri2 = $this->uri->segment(2);
        
        if($uri2):
            $this->data['student_info'] = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$uri2));
//            $this->data['bank']         = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name',array('bank_id'=>8));
                   
            $this->data['bank']         = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name',array('category_type'=>1));
            $this->data['default_bank'] = $this->DefaultFeeBank->bank_id;
//      degree_type_id
            if($this->data['student_info']->degree_type_id == 3):
                $where = array(
//                'fee_category_titles.cat_title_id'  => 1,
                'fee_payment_category.sub_pro_id'   => $this->data['student_info']->sub_pro_id,
                'fee_payment_category.batch_id'     => $this->data['student_info']->batch_id
            );
                else:
                $where = array(
                'fee_category_titles.cat_title_id'  => 1,
                'fee_payment_category.sub_pro_id'   => $this->data['student_info']->sub_pro_id,
                'fee_payment_category.batch_id'     => $this->data['student_info']->batch_id
            );
            endif;
            
        if($this->input->post()):
            ob_start();
            $userInfo           = json_decode(json_encode($this->getUser()), FALSE);
            $update_amount      = $this->input->post('update_amount');
            $student_id         = $this->input->post('student_id');
            $bank_id            = $this->input->post("bank_id");
            $pc_id              = $this->input->post("pc_id");
            $update_amount_id   = $this->input->post('update_amount_id');
            $fromDate           = $this->input->post("fromDate");
            $dueDate            = $this->input->post("dueDate");
            $issueDate          = $this->input->post("issueDate");
            $uptoDate           = $this->input->post("uptoDate");
            $comment            = $this->input->post("fee_comments");
            
            
            
            $studentRow = $this->CRUDModel->get_where_row('student_record',array('student_id'=>$student_id));
            $challan_id = $this->CRUDModel->get_where_row('fee_challan',array('fc_student_id'=>$studentRow->student_id,'fc_pay_cat_id'=>$pc_id));
            
            $fee_challan_exist = $this->CRUDModel->key_exists('fee_challan',array('fc_student_id'=>$studentRow->student_id,'fc_pay_cat_id'=>$pc_id));
          
            //******************************************************************************************************            
            //********************            FEE CHALLAN CHECKING IF EXIST                       ******************
            //******************************************************************************************************
            
            if(!empty($fee_challan_exist)):
                 
          
                    $this->session->set_flashdata('error_payment', 'Challan Already Exist..<a href="feeChallanPrintAdmission/'.$challan_id->fc_challan_id.'/'.$studentRow->student_id.'"><p class="btn btn-danger btn-xs"> Challan Print</p></a>');
                     redirect('admissionChallanGent/'.$student_id);
                   else:
                       
//                 $total_balanc_an = $this->CRUDModel->get_where_row('fee_total_anual',array('sub_pro_id'=>$studentRow->sub_pro_id));
//******************************************************************************************************            
//********************            CHECKING ANNUAL AMOUNT AGISNT SUB PROGRAM           ******************
//****************************************************************************************************** 
            
//                   if(!empty($total_balanc_an)):
            
                    $check_balance =  $this->CRUDModel->get_where_row('fee_total_balance',array('student_id'=>$studentRow->student_id,'batch_id'=>$studentRow->batch_id,'sub_por_id'=>$studentRow->sub_pro_id));
                   
//******************************************************************************************************            
//********************    CHECKING AMOUNT AGISNT STUDENT (FIST PAYMENT OR 2ND PAYMENT) ******************
//******************************************************************************************************                       
                      if(!empty($check_balance)):
//                   
//                        $total_balace_update = array(
//                            'total_r_amount' => $total_balanc_an->total_amount+$check_balance->total_r_amount,
//                            'timestamp'      => date('Y-m-d H:i:s'), 
//                            'userId'         => $userInfo->user_id );
//                      $this->CRUDModel->update('fee_total_balance',$total_balace_update,array('student_id'=>$studentRow->student_id));
                            else:
                      
//                        $total_balance_inset = array(
//                            'student_id'     =>$studentRow->student_id,
//                            'batch_id'       =>$studentRow->batch_id,
//                            'sub_por_id'     =>$studentRow->sub_pro_id,
//                            'total_r_amount' =>$total_balanc_an->total_amount,
//                            'timestamp'      => date('Y-m-d H:i:s'), 
//                            'userId'         => $userInfo->user_id );
//                       $this->CRUDModel->insert('fee_total_balance',$total_balance_inset);
                        endif;
                        
                           
//                         else:    
//                     $this->session->set_flashdata('error_payment', 'Total Annual Amount Not Enter Challan Not Generate');
//                     redirect('admissionChallanGent/'.$student_id);
//                
//                   endif;
                   $fy_id = $this->db->where('status','1')->get('financial_year')->row();
                  
                    $section = $this->db->get_where('student_group_allotment',array('student_id'=>$student_id))->row();


                    $sectionID = '';
                                    if($section):
                                        $sectionID =$section->section_id;
                                        else:
                                        $sectionID = 0;
                                    endif;
                   
                   
           $data = array(
                    'fc_student_id'     => $studentRow->student_id,
                    'program_id_paid'   => $studentRow->programe_id,
                    'batch_id_paid'     => $studentRow->batch_id,
                    'sub_pro_id_paid'   => $studentRow->sub_pro_id,
                    'section_id_paid'   =>$sectionID,
                    'fc_ch_status_id'   => 1, //Challan status not paid
                    'fc_paid_form'      => date_format(date_create($fromDate),"Y-m-d"), 
                    'fc_paid_upto'      => date_format(date_create($uptoDate),"Y-m-d"), 
                    'fc_dueDate'        => date_format(date_create($dueDate),"Y-m-d"), 
                    'fc_issue_date'     => date('Y-m-d', strtotime($issueDate)), 
                    'fc_pay_cat_id'     => $pc_id, 
                    'financial_id'      => $fy_id->id, 
                    'fc_bank_id'        => $bank_id, 
                    'fc_comments'       => $comment, 
                    'fc_timestamp'      => date('Y-m-d H:i:s'), 
                    'fc_userId'         => $userInfo->user_id
                    );
                        //Insert challan info against the student
                        $challan_id = $this->CRUDModel->insert('fee_challan',$data);
                         //Search info about installement detials and insert to fee_challan_detail table
//                       $fee_setups = $this->CRUDModel->get_where_result('fee_class_setups',array('pc_id'=>1));
                    
                        $this->RQ($challan_id,'assets/RQ/challan_rq/');
                        $this->CRUDModel->update('fee_challan',array('fc_challan_rq'=>$challan_id.'.png'),array('fc_challan_id'=>$challan_id));
             
                            $student_balance = 0;
                            $actual_amount  = '';
                            $paid_amount    = '';
                               $combine = array_combine($update_amount_id,$update_amount);
                                foreach($combine as $key=>$row):
                                    
                                $fee_setups_details = $this->CRUDModel->get_where_row('fee_class_setups',array('fcs_id'=>$key));
                         
                                
                                $datafs = array(
                                'challan_id'    => $challan_id,
                                'fee_id'        => $key,
                                'actual_amount' => $fee_setups_details->fcs_amount,
                                'paid_amount'   => $row,
                                'balance'       => $fee_setups_details->fcs_amount,
                                'challan_status'=> 1,
                                'timestamp'     => date('Y-m-d H:i:s'),
                                'useId'         => $userInfo->user_id
                            );
                            $actual_amount   += $fee_setups_details->fcs_amount;
                            $paid_amount     += $row;
                            $student_balance +=$row;
                          $this->CRUDModel->insert('fee_actual_challan_detail',$datafs);
                                    
                         
                          
                          endforeach;
                    
                        if($actual_amount == $paid_amount):
                            
                            $this->CRUDModel->update('fee_challan',array('fc_challan_type'=>1),array('fc_challan_id'=> $challan_id,));
                        
                            else:
                            $this->CRUDModel->update('fee_challan',array('fc_challan_type'=>2),array('fc_challan_id'=> $challan_id,));
                        endif;
                              
                    $id = $this->CRUDModel->key_exists('fee_balance',array('student_id'=>$studentRow->student_id));
                    if($id):
                        $oldBalance     = $this->CRUDModel->get_where_row('fee_balance',array('student_id'=>$studentRow->student_id));
                        $total_balance  = $oldBalance->r_amount + $student_balance;
                        $student_balance_update = array(
                        'pay_cat_id'    =>$pc_id,
                        'r_amount'      =>$total_balance,
                        );
                        $where_sb_update = array('student_id'=>$studentRow->student_id);
                        $this->CRUDModel->update('fee_balance',$student_balance_update,$where_sb_update);
                  
                    else:
                        $student_balance_insert = array(
                                'student_id'    =>$studentRow->student_id,
                                'pay_cat_id'    =>$pc_id,
                                'r_amount'      =>$student_balance);
                        $this->CRUDModel->insert('fee_balance',$student_balance_insert);
                    
                    endif;
                    
                    //Fee Challan Details
                    
                        $student_balance_insert = array(
                                'challan_id'    =>$challan_id,
                                'student_id'    =>$studentRow->student_id,
                                'ch_status_id'  =>1,
                                'date'          =>date_format(date_create($fromDate),"Y-m-d"),
                                'timestamp'     =>date('Y-m-d H:i:s'),
                                'userId'        => $userInfo->user_id

                                );
                        $this->CRUDModel->insert('fee_challan_history',$student_balance_insert);
                   echo 'challan not Exist';
                   
                endif;
               redirect('feeChallanPrintAdmission/'.$challan_id.'/'.$studentRow->student_id);
        endif;
        endif;
        $this->data['result'] = $this->FeeModel->admission_challan_gen($where);
//        echo '<pre>';print_r($this->data['student_info']);die;
        $this->data['page']         = 'Fee/fee_admission_challan';
        $this->data['page_header']  = 'New Admission Challan';
        $this->data['page_title']   = 'New Admission Challan | ECMS';
        $this->load->view('common/common',$this->data);
        
    }   
    
}

 