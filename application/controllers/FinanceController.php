<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');
 

class FinanceController extends AdminController {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
     public $userInfo = ''; 
     public function __construct() {
             parent::__construct();
             $this->load->model('CRUDModel');
             $this->load->model('FinanceModel');
             $this->load->library("pagination");
              $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
            }
    
    public function voucher_approval_persons(){
                   
        $employeer_id   = $this->input->post('employeer_id');
        $designation    = $this->input->post('set_designation');
        $name           = $this->input->post('set_name');
        $order          = $this->input->post('order');
        $fy_id          = $this->input->post('fy_id');
        $this->data['financialYear']    = $this->CRUDModel->dropDown('financial_year','', 'id', 'year',array('status'=>1,'fn_account_type_id'=>1)); 
        if($this->input->post('btn-save')):
            
            $data = array(
             'fn_va_emp_id'         => $employeer_id,
             'designation'          => $designation,
             'name'                 => $name,
             'appr_order'           => $order,
             'fn_account_type_id'   => 1,
             'status'               => 1,
             'fn_va_fy_id'          => $fy_id,
             'user_id'              => $this->userInfo->user_id,
             'timestamp'            => date('Y-m-d H:i:s'),
             );
                   
                $this->CRUDModel->insert('fn_vocher_approvalby',$data);
            redirect('ApprovalPersons');
        endif;
                   
                                            $this->db->select('fn_vocher_approvalby.*,fn_account_types.title,hr_emp_record.*');
                                            $this->db->join('fn_account_types','fn_account_types.id=fn_vocher_approvalby.fn_account_type_id');    
                                            $this->db->join('hr_emp_record','hr_emp_record.emp_id=fn_vocher_approvalby.fn_va_emp_id','left outer'); 
                                            $this->db->order_by('appr_order','asc');
        $this->data['fnYear']           = $this->db->get_where('fn_vocher_approvalby',array('fn_account_type_id'=>1))->result();
        
        
        
        $this->data['page']             = "Finance/OP/Setups/op_finance_approval_persons";
        $this->data['page_heading']     = "OP Approval Persons";
        $this->data['page_title']       = 'OP Approval Persons | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function voucher_approval_persons_edit(){
    
        
        $this->data['designation']      = '';
        $this->data['emp_name']         = '';
        $this->data['order']            = '';
        
        $employeer_id   = $this->input->post('employeer_id');
        $designation    = $this->input->post('set_designation');
        $name           = $this->input->post('set_name');
        $order          = $this->input->post('order');
        $fy_id          = $this->input->post('fy_id');
        $status_id      = $this->input->post('status_id');
        
        if($this->input->post('btn-update')):
            
            $data = array(
             'fn_va_emp_id'         => $employeer_id,
             'designation'          => $designation,
             'name'                 => $name,
             'appr_order'           => $order,
             'fn_account_type_id'   => 1,
             'status'               => $status_id,
             'fn_va_fy_id'          => $fy_id,
             'up_user_id'           => $this->userInfo->user_id,
             'up_timestamp'         => date('Y-m-d H:i:s'),
             );
                   
                $this->CRUDModel->update('fn_vocher_approvalby',$data,array('id'=>$this->uri->segment(2)));
            redirect('ApprovalPersons');
        endif;

        
        
                                                    $this->db->select('fn_vocher_approvalby.*,fn_account_types.title,hr_emp_record.*');
                                                    $this->db->join('fn_account_types','fn_account_types.id=fn_vocher_approvalby.fn_account_type_id');    
                                                    $this->db->join('hr_emp_record','hr_emp_record.emp_id=fn_vocher_approvalby.fn_va_emp_id','left outer');    
        $this->data['result_query']           =     $this->db->get_where('fn_vocher_approvalby',array('fn_account_type_id'=>1,'fn_vocher_approvalby.id'=>$this->uri->segment(2)))->row();
        $this->data['financialYear']    = $this->CRUDModel->dropDown('financial_year','', 'id', 'year',array('id'=>$this->data['result_query']->fn_va_fy_id,'fn_account_type_id'=>1)); 
//        echo '<pre>';print_r($this->data['result_query']);die;
        
        $this->data['page']             = "Finance/OP/Setups/op_finance_voucher_approval_edit";
        $this->data['page_heading']     = "OP Approval Persons Edit";
        $this->data['page_title']       = 'OP Approval Persons Edit | ECMS';
        $this->load->view('common/common',$this->data);
    }

      public function voucher_approval_delete(){
       $deletId = $this->uri->segment(2);
       $this->CRUDModel->deleteid('fn_vocher_approvalby',array('id'=>$deletId));
       redirect('ApprovalPersons');
   }      
            
            
            
            
            
    public function chart_of_account(){

       $this->data['coa_id_type'] = 1; 
       if($this->input->post()):
         //Insert Code 
         $code          = $this->input->post('code');
         $title         = $this->input->post('title');
         $comments      = $this->input->post('comments');
         $coa_id        = $this->input->post('coa_id');
         $status        = $this->input->post('coa_status');
         $currnetDate   =  date('Y-m-d H:i:s');
//         $userInfo      = $this->getUser();


         if($coa_id):

             $data = array(
             'fn_coa_code'          => $code,
             'fn_coa_title'         => strtoupper($title),
             'fn_coa_commnet'       => $comments,
             'fn_coa_udpateTime'    => $currnetDate,
             'fn_coa_UpdateUser'    => $this->userInfo->user_id,
             'fn_coa_status'        => $status,
             );

            $where     = array('fn_coaId'=>$coa_id);
            $this->CRUDModel->update('fn_coa_parent',$data,$where);
            redirect('COA_prents');
        else:
                $data = array(
                   'fn_coa_code'       => $code,
                   'fn_coa_title'      => strtoupper($title),
                   'fn_coa_commnet'    => $comments,
                   'fn_account_type_id'=> 1,
                   'fn_coa_timestamp'  => $currnetDate,
                   'fn_coa_userId'     => $this->userInfo->user_id,
                   );
                $this->CRUDModel->insert('fn_coa_parent',$data);
                 redirect('COA_prents');
             endif;

        endif;

        $COA_id = $this->uri->segment(2);
        if($COA_id):
            $this->data['coaResult']    = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$COA_id));
        endif;
                                            $this->db->select('fn_coa_parent.*,fn_account_types.title');
                                            $this->db->join('fn_account_types','fn_account_types.id=fn_coa_parent.fn_account_type_id');   
        $this->data['coa']              =   $this->db->get_where('fn_coa_parent',array('fn_coa_trash'=>1,'fn_account_type_id'=>1))->result();
        $this->data['page']             = "Finance/OP/Setups/op_coa_parents";
        $this->data['page_title']       = 'OP Chart of Accounts| ECMS';
        $this->data['page_header']      = 'OP Chart of Accounts';
        $this->load->view('common/common',$this->data);

    }
    public function coa_perent_delte(){
        $id     = $this->uri->segment(2);
        $data   = array('fn_coa_trash'=>0);
        $where  = array('fn_coaId'=>$id);
        $this->CRUDModel->update('fn_coa_parent',$data,$where);
        redirect('admin/admin_home');
    }
    
    public function check_coa_parent(){
            $fn_coa_code        = $this->input->post('fn_coa_code');
            $coa_id_type        = $this->input->post('coa_id_type');
             $result            = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coa_code'=>$fn_coa_code,'fn_account_type_id'=>$coa_id_type));
             if($result):
                    echo 1;
                 else:
                     echo 0;
             endif;
        }
    public function coa_master_child(){
            $this->data['coa_id_type'] = 1;
           if($this->input->post()):
             //Insert Code 
             $code          = $this->input->post('code');
             $title         = $this->input->post('title');
             $comments      = $this->input->post('comments');
             $COAPId        = $this->input->post('COAP');
             $coa_id        = $this->input->post('coa_id');
             $status        = $this->input->post('coa_status');
             $currnetDate   =  date('Y-m-d H:i:s');
//             $userInfo = $this->getUser();
             if($coa_id):
                 
                 $data = array(
                 'fn_coa_m_pId'           =>$COAPId,
                 'fn_coa_m_code'          =>$code,
                 'fn_coa_m_title'         =>strtoupper($title),
                 'fn_coa_m_comments'      =>$comments,
                 'fn_coa_m_updateTime'    =>$currnetDate,
                 'fn_coa_m_updateUser'    =>$this->userInfo->user_id,
                 'fn_coa_m_status'        =>$status,
                 );
                 
                 $where = array('fn_coa_m_cId'=>$coa_id);
                 $this->CRUDModel->update('fn_coa_master_child',$data,$where);
                 redirect('coa_master_child');
                 else:
                     $data = array(
                        'fn_coa_m_pId'          =>$COAPId,
                        'fn_coa_m_code'         =>$code,
                        'fn_coa_m_title'        =>strtoupper($title),
                        'fn_coa_m_comments'     =>$comments,
                        'fn_account_type_id'    =>1,
                        'fn_coa_m_timestamp'    =>$currnetDate,
                        'fn_coa_m_userId'       =>$this->userInfo->user_id,
                        );
                    $this->CRUDModel->insert('fn_coa_master_child',$data);
                     redirect('coa_master_child');
                 endif;
             
            endif;
            
            $COA_id = $this->uri->segment(2);
            if($COA_id):
                $this->data['coaResult']    = $this->CRUDModel->get_where_row('fn_coa_master_child',array('fn_coa_m_cId'=>$COA_id));
            endif;
            
            $wherePrg                       = array(
                                                'fn_coa_status' =>'1',
                                                'fn_account_type_id'    =>1,
                                                'fn_coa_trash'  =>1);
            $this->data['COAP']             = $this->CRUDModel->dropDown('fn_coa_parent', 'Select Account Head', 'fn_coaId', 'fn_coa_title',$wherePrg);  
            $where                          = array(
                                                'fn_coa_trash'          =>1,
                                                'fn_coa_master_child.fn_account_type_id'    =>1,
                                                'fn_coa_status'         =>1,
                                                'fn_coa_m_trash'        =>1);
            $this->data['coa_master']       = $this->FinanceModel->coa_master('fn_coa_master_child',$where);
           
            $this->data['page']             = "Finance/OP/Setups/op_coa_master_child";
            $this->data['page_title']       = 'Chart of Accounts| ECMS';
            $this->data['page_header']      = 'OP Chart of Accounts';
            $this->load->view('common/common',$this->data);
     
        }
    public function coa_child_delte(){
            $id         = $this->uri->segment(2);
            $data       = array('fn_coa_m_trash'=>0);
            $where      = array('fn_coa_m_cId'=>$id);
            $this->CRUDModel->update('fn_coa_master_child',$data,$where);
            redirect('admin/admin_home');
        }
    public function check_coa_master(){
            $fn_coa_master_code = $this->input->post('fn_coa_master_code');
            $coa_id             = $this->input->post('coa_id');
            $coa_id_type        = $this->input->post('coa_id_type');
            
            
             $result  = $this->CRUDModel->get_where_row('fn_coa_master_child',array('fn_coa_m_code'=>$fn_coa_master_code,'fn_coa_m_pId'=>$coa_id,'fn_account_type_id'=>$coa_id_type));
             if($result):
                    echo 1;
                 else:
                     echo 0;
             endif;
        }
    public function coa_master_sub_child(){
            
             $this->data['coa_id_type'] = 1;
            if($this->input->post()):
                
                $coa_parent_id          = $this->input->post('coa_parent_id');
                $coa_master_child       = $this->input->post('master_child');
                $master_subChild_code   = $this->input->post('master_subChild_code');
                $coa_status             = $this->input->post('coa_status');
                $title                  = $this->input->post('title');
                $comments               = $this->input->post('comments');
                $coa_id                 = $this->input->post('coa_id');
//               $userInfo                = $this->getUser();
               if($coa_id):
                   
                $where = array('fn_coa_mc_id'=>$coa_id);
                $data  = array(
                'fn_coa_pId'            =>$coa_parent_id,
                'fn_coa_mc_mId'         =>$coa_master_child,
                'fn_coa_mc_code'        =>$master_subChild_code,
                'fn_coa_mc_title'       =>strtoupper($title),
                'fn_coa_mc_comments'    =>$comments,
                 'fn_coa_mc_status'     =>$coa_status,
                'fn_coa_mc_upTimestamp' =>date('Y-m-d H:i:s'),
                'fn_coa_mc_upUserId'    =>$this->userInfo->user_id
                       );
                    $this->CRUDModel->update('fn_coa_master_sub_child',$data,$where);
                    redirect('master_sub_child');
                   else:
                $data  = array(
                   'fn_coa_pId'         =>$coa_parent_id,
                   'fn_coa_mc_mId'      =>$coa_master_child,
                   'fn_coa_mc_code'     =>$master_subChild_code,
                   'fn_account_type_id' =>1,
                   'fn_coa_mc_title'    =>strtoupper($title),
                   'fn_coa_mc_comments' =>$comments,
                   'fn_coa_mc_timestamp'=>date('Y-m-d H:i:s'),
                   'fn_coa_mc_userId'   =>$this->userInfo->user_id,
                       );
               $this->CRUDModel->insert('fn_coa_master_sub_child',$data);
               redirect('master_sub_child');
               endif;
            endif;
            
            $COA_id = $this->uri->segment(2);
             
            if($COA_id):
                
//                $this->data[] = 
                $this->data['master_subResult'] = $this->FinanceModel->coa_master_subChildRow('fn_coa_master_sub_child',array('fn_coa_mc_id'=>$COA_id));
                
            endif;
            
            $wherePrg                   = array(
                'fn_coa_status'=>'1',
                'fn_account_type_id'=>'1'
                
                );
            $this->data['COAP']         = $this->CRUDModel->dropDown('fn_coa_parent', 'Select Account Head', 'fn_coaId', 'fn_coa_title',$wherePrg);  
           $where = array(
              'fn_coa_mc_trash'     =>1, 
              'fn_coa_m_trash'      =>1, 
              'fn_coa_trash'        =>1, 
              'fn_coa_status'       =>1, 
              'fn_coa_master_sub_child.fn_account_type_id'  =>1, 
              'fn_coa_m_status'     =>1, 
               
           );
            $this->data['master_sub']   = $this->FinanceModel->coa_master_subChild('fn_coa_master_sub_child',$where); 
            //echo '<pre>';print_r($this->data['master_sub']);die;
            $this->data['page']         = "Finance/OP/Setups/op_coa_master_sub_child";
            $this->data['page_title']        = 'OP Master Sub Child| ECMS';
            $this->data['page_header']  = 'OP Master Sub Child';
            $this->load->view('common/common',$this->data);
        }
    public function coa_master_sub_delte(){
            $id     = $this->uri->segment(2);
           
            $data   = array('fn_coa_mc_trash'=>0);
            $where  = array('fn_coa_mc_id'=>$id);
            $this->CRUDModel->update('fn_coa_master_sub_child',$data,$where);
            redirect('admin/admin_home');
        }
    public function get_master_record(){
            $coa_parent_id      = $this->input->post('coa_parent_id');
            $coa_id_type        = $this->input->post('coa_id_type');
            $result             = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_pId'=>$coa_parent_id,'fn_account_type_id'=>$coa_id_type,'fn_coa_m_status'=>1));
               echo '<option>Select Head</option>';
                foreach($result as $row):
                    echo '<option value="'.$row->fn_coa_m_cId.'">'.$row->fn_coa_m_title.'('.$row->fn_coa_m_code.')</option>';
                endforeach;
           
        }
    public function check_master_subChild(){
            
             $coa_parent_id         = $this->input->post('coa_parent_id');
             $master_child          = $this->input->post('master_child');
             $master_subChild_code  = $this->input->post('master_subChild_code');
             $coa_id_type           = $this->input->post('coa_id_type');
             $where  = array(
                 'fn_coa_pId'           => $coa_parent_id,
                 'fn_coa_mc_mId'        => $master_child,
                 'fn_coa_mc_code'       => $master_subChild_code,
                 'fn_account_type_id'   => $coa_id_type
                     );
              
             $result  = $this->CRUDModel->get_where_row('fn_coa_master_sub_child',$where);
            
             if($result):
                    echo 1;
                 else:
                     echo 0;
             endif;
        }
        
    //**********************************************************************************************************************
    //
    //
    //                                               FINANCE FORM ENTRY AREA 
    //
    //
    //**********************************************************************************************************************
    
    
    
    
    public function bank_voucher(){
      
            $query1                         = $this->db->where(array('status'=>'1','fn_account_type_id'=>1))->get('financial_year')->row();
            $vocherNum                      = $this->CRUDModel->get_max_value('gl_at_vocher','gl_amount_transition',array('gl_fy_id'=>$query1->id,'fn_account_type_id'=>1));
//           echo '<pre>';print_r($query1);die;
//        $vocherNum                      = $this->CRUDModel->get_max_where('gl_at_vocher','gl_amount_transition');
//            $this->data['stt']              = $this->CRUDModel->dropDown('fn_trm_type','', 'ftt_id', 'ftt_title');  
            $this->data['financialYear']    = $this->CRUDModel->dropDown('financial_year','', 'id', 'year',array('status'=>1,'fn_account_type_id'=>1));  
            $this->data['voucherType']      = $this->CRUDModel->dropDown('fn_voucher_type','Select Vocher Type', 'id', 'voch_name',array('status'=>1,'fn_account_type_id'=>1));  
            $this->data['voucher_attach']    = $this->CRUDModel->get_where_result('fn_attachments',array('status'=>1));
            $this->data['voucher_status']    = $this->CRUDModel->dropDown('fn_vocher_status','', 'id', 'status_title',array('status'=>1)); 
            
            if(empty($vocherNum->gl_at_vocher)):
                $this->data['vocherId']     = 1;
                else:
                 $this->data['vocherId']     = $vocherNum->gl_at_vocher+1;    
                //$this->data['vocherId']     = 1;
            endif;
            
            $this->data['COAP'] =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1,'fn_account_type_id'=>1));
//            $custom['limit'] = '20';
//            $custom['start'] = '0';
//            
//            $custom['column'] = 'gl_at_vocher';
//            $custom['order'] = 'desc';
//            $this->data['AMI'] =$this->CRUDModel->get_where_result_limit_order('gl_amount_transition',$custom);
             
        $this->data['page']         = 'Finance/OP/Forms/op_bank_vochers';
        $this->data['page_header']  = 'OP Bank Vochers';
        $this->data['page_title']   = 'OP Bank Vochers | ECMS';
        $this->load->view('common/common',$this->data);  
    }
    public function save_vouchers(){
           
        $userInfo = $this->getUser();
         if($this->input->post()):
         
            $voucher        = $this->input->post('voucher');
            $voch_need      = $this->input->post('voch_need');
            $voucher_att    = $this->input->post('voucher_att');
            $description    = $this->input->post('description');
            $costCenter     = $this->input->post('costCenter');
            $voucherType    = $this->input->post('voucherType');
            $print_on_check = $this->input->post('print_value2');
            $supplier_id     = $this->input->post('supplier_id');
            $employee_id     = $this->input->post('employee_id');
            
            $cheque         = $this->input->post('cheque');
            $payment_date   = $this->input->post('payment_date');
            $voucher_status = $this->input->post('voucher_status');
              
            //Vocher Data
            $invoice_date   = date('Y-m-d', strtotime($this->input->post('invoice_date')));
            $payee          = $this->input->post('payee');
            $financial      = $this->input->post('financial');
            $formCode       = $this->input->post('formCode');
            
           // $amountId       = $this->input->post('amountId');
          //  $debit          = $this->input->post('debit');
            //$credit         = $this->input->post('credit');
//            $fy_id = $this->CRUDModel->get_where_row('financial_year',array('status'=>1));
            $voucher_no = 0;
            if($voch_need == 1):
              $voucher_no =  $voucher; 
            else:
                $voucher_no =  0; 
            endif;
            $atData = array(
                'gl_at_date'            => $invoice_date,
                'gl_at_cheque'          => $cheque,
                'supplier_id'           => $supplier_id,
                'employee_id'           => $employee_id,
                'gl_at_vocher'          => $voucher_no,
                'gl_at_payeeId'         => $payee,
                'fn_account_type_id'    => 1,
                'vocher_type'           => $voucherType,
                'gl_at_cb_jv'           => $voucherType,
                'gl_fy_id'              => $financial,
                'gl_at_description'     => $description,
                'gl_at_cost_cente'      => $costCenter,
                'vocher_status'         => $voucher_status,
                'print_cheque_value'    => $print_on_check,
                'payment_date'          => date('Y-m-d', strtotime($payment_date)),
                'user_id'               => $this->userInfo->user_id,
            );
            $atInsert = $this->CRUDModel->insert('gl_amount_transition',$atData);
         
             $this->RQ($atInsert,'assets/RQ/vocher_rq/');
             $dataRq = array(
                 'vocher_rq'=>$atInsert.'.png'
             );
             $whereRq = array(
                 'gl_at_id'=>$atInsert
             );
             $this->CRUDModel->update('gl_amount_transition',$dataRq,$whereRq);
           if(!empty($voucher_att)):
                foreach($voucher_att as $key=>$value):
                $data = array(
                  'amount_tra_id'    =>$atInsert, 
                  'attach_id'        =>$value, 
                  'timestamp'       =>date('Y-m-d H:i:s'), 
                  'user_id'         =>$this->userInfo->user_id, 
                );
                $this->CRUDModel->insert('fn_voucher_attachment',$data);
            endforeach;
           endif; 
            $where      = array('gl_ad_formCode'=>$formCode);
            $AdDResult  = $this->CRUDModel->get_where_result('gl_amount_details_demo',$where);
          
            $gl_ad_depit = '';
            $gl_ad_credit = '';
            foreach($AdDResult as $checkCD):
                $gl_ad_depit       += $checkCD->gl_ad_depit;
                $gl_ad_credit      += $checkCD->gl_ad_credit;
            endforeach;
            
           
            if($gl_ad_credit == $gl_ad_depit):
        
            foreach($AdDResult as $rowDemo):
                $data = array(
                    'gl_ad_atId'            => $atInsert,
                    'gl_ad_payeeId'         => $rowDemo->gl_ad_payeeId,
                    'gl_ad_date'            => $invoice_date,
                    'gl_ad_cost_center'     => $rowDemo->gl_ad_cost_center,
                    'gl_ad_coa_mc_id'       => $rowDemo->gl_ad_coa_mc_id,
                    'gl_ad_coa_mc_pk'       => $rowDemo->gl_ad_coa_mc_pk,
                    'gl_ad_coa_mc_name'     => $rowDemo->gl_ad_coa_mc_name,
                    'gl_ad_depit'           => $rowDemo->gl_ad_depit,
                    'gl_ad_credit'          => $rowDemo->gl_ad_credit,
                    'gl_ad_dateTime'        => date('Y-m-d H:i:s'),
                    'gl_ad_userId'          => $this->userInfo->user_id 
                );
                    $this->CRUDModel->insert('gl_amount_details',$data);
                   
            endforeach;
           
            
           $get_apvl_persons = $this->CRUDModel->get_where_result('fn_vocher_approvalby',array('status'=>1,'fn_account_type_id'=>1));
            
           if($get_apvl_persons):
               foreach($get_apvl_persons as $ga_row):
               $aprl_data = array(
                 'trns_ab_amount_trans_id'  => $atInsert,  
                 'trns_ab_emp_id'           => $ga_row->fn_va_emp_id,  
                 'trns_ab_name'             => $ga_row->name,  
                 'trns_ab_designation'      => $ga_row->designation,  
                 'trns_ab_fy_id'            => $ga_row->fn_va_fy_id,  
                 'trns_ab_account_type_id'  => $ga_row->fn_account_type_id,  
                 'trns_ab_appr_order'       => $ga_row->appr_order,  
                 'trns_ab_status'           => $ga_row->status,  
                 'create_date_time'         => date('Y-m-d H:i:s'),  
                 'create_by'                => $this->userInfo->user_id,  
               );
               $this->CRUDModel->insert('gl_at_aprove_by',$aprl_data);
               endforeach;
           endif;
           
//            echo '<pre>';print_r($get_apvl_persons);die;
            
            $this->CRUDModel->deleteid('gl_amount_details_demo',array('gl_ad_formCode'=>$formCode));
            $msg = array('msg'=>'Record Successfully Updated','status'=>2)  ;  
            else:
                $msg = array('msg'=>'Credit Amount = ('.$gl_ad_credit.') Not equal to  Debit Amount = ('.$gl_ad_depit.') Please Check Transition Amount','status'=>1)  ;
            endif;
           
            
            redirect('VoucherPrint/'.$atInsert);
    endif;
    }
     public function bank_voucher_edit(){
        
//                $query1         = $this->db->where('status','1')->get('financial_year')->row();
//                $vocherNum      = $this->CRUDModel->get_max_value('gl_at_vocher','gl_amount_transition',array('gl_fy_id'=>$query1->id));
//           
            $vocherNum                      = $this->CRUDModel->get_max_where('gl_at_vocher','gl_amount_transition',array('fn_account_type_id'=>1));
           
            $this->data['stt']              = $this->CRUDModel->dropDown('fn_trm_type','', 'ftt_id', 'ftt_title');  
            

            $this->data['employee_drop']      = $this->FinanceModel->dropDownEmployee('hr_emp_record','Select Employee', 'emp_id', 'emp_name');  
            $this->data['supplier_drop']      = $this->CRUDModel->dropDown('fn_supplier','Select Supplier', 'fn_supp_id', 'company_name');  
            $this->data['financialYear']    = $this->CRUDModel->dropDown('financial_year','', 'id', 'year',array('fn_account_type_id'=>1));  
            $where = array(
                'gl_at_id'          => $this->uri->segment(2),
                'fn_account_type_id'=> 1
                    );
            $this->data['update_records']   =$this->FinanceModel->get_update_record('gl_amount_transition',$where);
            
            
            $this->data['voucherType']      = $this->CRUDModel->dropDown('fn_voucher_type','Select Vocher Type', 'id', 'voch_name',array('status'=>1,'fn_account_type_id'=> 1));  
            $this->data['voucher_attach']    = $this->CRUDModel->get_where_result('fn_attachments',array('status'=>1));
            $this->data['voucher_status']    = $this->CRUDModel->dropDown('fn_vocher_status','', 'id', 'status_title',array('status'=>1)); 
            
            
            if(empty($vocherNum->gl_at_vocher)):
                $this->data['vocherId']     = 1;
                else:
                 $this->data['vocherId']     = $vocherNum->gl_at_vocher+1;    
                //$this->data['vocherId']     = 1;
            endif;
            
            $this->data['COAP'] =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1,'fn_account_type_id'=> 1));
//            $custom['limit'] = '20';
//            $custom['start'] = '0';
//            
//            $custom['column'] = 'gl_at_vocher';
//            $custom['order'] = 'desc';
           
            
           // echo '<pre>';print_r($this->data['vocherId']);die;
            $this->data['page']         = "Finance/OP/Forms/op_bank_voucher_edit";
            $this->data['page_title']        = 'OP Update Bank Voucher| ECMS';
            $this->data['page_header']  = 'OP Update Bank Voucher';
            $this->load->view('common/common',$this->data);
    }
    
    public function update_voucher(){
        
        $userInfo = $this->getUser();
        if($this->input->post()):
            //$cheque         = $this->input->post('cheque');
            $amountdate     = date('Y-m-d', strtotime($this->input->post('amountdate')));
            //$voucher        = $this->input->post('voucher');
           // $description    = $this->input->post('description');
             $costCenter    = $this->input->post('costCenter');
            $propertier_name          = $this->input->post('propertier_name');
            $amount         = $this->input->post('amount');
            $amountId       = $this->input->post('amountId');
            $coa_sub_chidId = $this->input->post('coa_sub_chidId');
            $debit          = $this->input->post('debit');
            $credit         = $this->input->post('credit');
            $formCode         = $this->input->post('formCode');
            
           
            $dataATD = array(
                'gl_ad_payeeId'         =>$propertier_name,
                'gl_ad_date'            =>$amountdate,
                'gl_ad_cost_center'     =>$costCenter,
                'gl_ad_coa_mc_id'       =>$amountId,
                'gl_ad_coa_mc_pk'       =>$coa_sub_chidId,
                'gl_ad_coa_mc_name'     =>$amount,
                'gl_ad_depit'           =>$debit,
                'gl_ad_credit'          =>$credit,
                'gl_ad_dateTime'        =>date('Y-m-d H:i:s'),
                'gl_ad_userId'          =>$userInfo['user_id'],
                'gl_ad_formCode'        =>$formCode
            );
            
         
            
            
            $ATD = $this->CRUDModel->insert('gl_amount_details_demo',$dataATD);
//            $where = array('gl_ad_userId'=>$userInfo['user_id'],'gl_ad_payeeId'=>$empId,'gl_ad_date'=>$amountdate);
            $where = array('gl_ad_formCode'=>$formCode);
            $ATDResult = $this->CRUDModel->get_where_result('gl_amount_details_demo',$where);
            $debitAmount = '';
            $credittAmount = '';
  
            
            
            echo '<table id="testing123" cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th class="hidden-sm">Cost Center</th>
                            <th>Account</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th><i class="icon-trash" style="color:#fff"></i><b> Delete</b></th>
                        </tr>
                    </thead>
                    <tbody>';
            $total='';
            
                       $class = array(
                                    'info',
                                    'success',
                                    'danger',
                                    'warning',
                                    'active',
                                );
  
                        foreach($ATDResult as $row):
                            $k = array_rand($class);
                            echo '<tr id="'.$row->gl_ad_id.'Delete" class="'.$class[$k].'">
                            
                            <td class="hidden-sm">'.$row->gl_ad_cost_center.'</td>
                            <td>'.$row->gl_ad_coa_mc_name.'</td>
                            <td><input readonly="readonly"  type="text" name="gl_ad_depit" class="gl_ad_depit"    id="gl_ad_depit" value="'.$row->gl_ad_depit.'"></td>
                            <td><input readonly="readonly"  type="text" name="gl_ad_credit" class="gl_ad_credit"    id="gl_ad_credit" value="'.$row->gl_ad_credit.'"></td>
                            
                            <td><a href="javascript:void(0)" id="'.$row->gl_ad_id.'" class="deleteTra"><i class="fa fa-trash"></i></a></td>
                            </tr>';
                        $debitAmount += $row->gl_ad_depit;
                        $credittAmount += $row->gl_ad_credit;
                        $total = $debitAmount-$credittAmount;
                        endforeach;
                    echo '
                        <tr>
                        <td class="hidden-sm"></td>
                        <td>Total</td>
                        <td><input type="number" class="form-control" id="debitAmount" readonly="readonly" value="'.$debitAmount.'"></td>
                        <td><input type="number" class="form-control" id="credittAmount" readonly="readonly" value="'.$credittAmount.'"></td>
                        <td><input id="Fntotal"  type="number" class="form-control "  disabled="disabled" value="'.$total.'"></td>
                        </tr>
                        <tr>
                        <td class="hidden-sm"></td>
                        <td colspan="2">Print on Cheque</td>
                        <td colspan="2"><input id="print_value"  type="number" class="form-control "  readonly="readonly" value="'.$credittAmount.'"></td>
                        </tr>
                    </tbody>
                </table>';
                    
                     ?>
                
                        <script>
                        jQuery(document).ready(function(){
                          
                            jQuery('#print_value2').val(jQuery('#credittAmount').val());
                          
                             jQuery('.deleteTra').on('click',function(){
                             var deletId = this.id;
                            
                             jQuery.ajax({
                                 type:'post',
                                 url : 'FinanceController/amount_Detail_Delete',
                                 data: {'deletId':deletId},
                                 success : function(result){
                                    var del = deletId+'Delete';
                                    jQuery('#'+del).hide(); 

                                 var debitAmount    =  jQuery('#debitAmount').val();
                                 var credittAmount  =  jQuery('#credittAmount').val();
                                 var total          =  parseInt(debitAmount)+parseInt(credittAmount);
                              
                                 jQuery('#Fntotal').val(total);

                                 }
                             });
                        
                         });
                         jQuery('.gl_ad_depit,.gl_ad_credit,#Fntotal,#credittAmount,#debitAmount').dblclick(function(){
                             
                             var cust_print = jQuery(this).val();
                             jQuery('#print_value').val(cust_print);
                             jQuery('#print_value2').val(cust_print);
                         });

                        });

                        </script><?php
           endif;
      
    }
        
        
    public function fee_heads(){
        
            if($this->input->post()):
             //Insert Code 
             $code          = $this->input->post('code');
             $title         = $this->input->post('title');
             $comments      = $this->input->post('comments');
             $COAPId        = $this->input->post('COAP');
             $coa_id        = $this->input->post('coa_id');
             $status        = $this->input->post('coa_status');
             $currnetDate   = date('Y-m-d H:i:s');
             $userInfo = $this->getUser();
             
             
             if($coa_id):
                 
                 $data = array(
                 'fn_coa_m_pId'           =>$COAPId,
                 'fn_coa_m_code'          =>$code,
                 'fn_coa_m_title'         =>strtoupper($title),
                 'fn_coa_m_comments'      =>$comments,
                 'fn_coa_m_updateTime'    =>$currnetDate,
                 'fn_coa_m_updateUser'    =>$userInfo['user_id'],
                 'fn_coa_m_status'        =>$status,
                 );
                 
                 $where = array('fn_coa_m_cId'=>$coa_id);
                 $this->CRUDModel->update('fn_coa_master_child',$data,$where);
                 redirect('coa_master_child');
                 else:
                     $data = array(
                        'fn_coa_m_pId'          =>$COAPId,
                        'fn_coa_m_code'         =>$code,
                        'fn_coa_m_title'        =>strtoupper($title),
                        'fn_coa_m_comments'     =>$comments,
                        'fn_coa_m_timestamp'    =>$currnetDate,
                        'fn_coa_m_userId'       =>$userInfo['user_id'],
                        );
                    $this->CRUDModel->insert('fn_coa_master_child',$data);
                     redirect('coa_master_child');
                 endif;
             
            endif;
            
            $COA_id = $this->uri->segment(2);
            if($COA_id):
                $this->data['coaResult'] = $this->CRUDModel->get_where_row('fn_coa_master_child',array('fn_coa_m_cId'=>$COA_id));
            endif;
            
            $wherePrg                   = array('fn_coa_status'=>'1');
            $this->data['COAP']         = $this->CRUDModel->dropDown('fn_coa_parent', 'Select Account Head', 'fn_coaId', 'fn_coa_title',$wherePrg);  
            $this->data['coa_master']   = $this->FinanceModel->coa_master('fn_coa_master_child');
           
            $this->data['page']         = "Finance/fee_heads";
            $this->data['page_title']        = 'Fee Heads| ECMS';
            $this->load->view('common/common',$this->data);
    }
    public function Amount_Transition(){
            $query1 = $this->db->where('status','1')->get('financial_year')->row();
            $vocherNum                      = $this->CRUDModel->get_max_value('gl_at_vocher','gl_amount_transition',array('gl_fy_id'=>$query1->id));
            $this->data['stt']              = $this->CRUDModel->dropDown('fn_trm_type','', 'ftt_id', 'ftt_title');  
            $this->data['financialYear']    = $this->CRUDModel->dropDown('financial_year','', 'id', 'year',array('status'=>1));  
          
            if(empty($vocherNum->gl_at_vocher)):
                $this->data['vocherId']     = 1;
                else:
                 $this->data['vocherId']     = $vocherNum->gl_at_vocher+1;    
                //$this->data['vocherId']     = 1;
            endif;
            
            $this->data['COAP'] =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1));
            $custom['limit'] = '20';
            $custom['start'] = '0';
            
            $custom['column'] = 'gl_at_vocher';
            $custom['order'] = 'desc';
            $this->data['AMI'] =$this->CRUDModel->get_where_result_limit_order('gl_amount_transition',$custom);
            
           // echo '<pre>';print_r($this->data['vocherId']);die;
            $this->data['page']         = "Finance/amount_transition";
            $this->data['page_title']        = 'Fee Heads| ECMS';
            $this->load->view('common/common',$this->data);
    }
    public function Amount_Transition_Edit(){
        
            $vocherNum                  = $this->CRUDModel->get_max_where('gl_at_vocher','gl_amount_transition');
            $this->data['stt']          = $this->CRUDModel->dropDown('fn_trm_type','', 'ftt_id', 'ftt_title');  
            $this->data['financialYear']    = $this->CRUDModel->dropDown('financial_year','', 'id', 'year');  
            $where = array('gl_at_id'   =>$this->uri->segment(2));
            $this->data['update_records']       =$this->FinanceModel->get_update_record('gl_amount_transition',$where);
//            echo '<pre>';print_r($this->data['update_records']);die;
            if(empty($vocherNum->gl_at_vocher)):
                $this->data['vocherId']     = 1;
                else:
                 $this->data['vocherId']     = $vocherNum->gl_at_vocher+1;    
                //$this->data['vocherId']     = 1;
            endif;
            
            $this->data['COAP'] =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1));
            $custom['limit'] = '20';
            $custom['start'] = '0';
            
            $custom['column'] = 'gl_at_vocher';
            $custom['order'] = 'desc';
           
            
           // echo '<pre>';print_r($this->data['vocherId']);die;
            $this->data['page']         = "Finance/amount_transition_edit";
            $this->data['page_title']        = 'Fee Heads| ECMS';
            $this->data['page_header']  = 'Amount Transition Edit';
            $this->load->view('common/common',$this->data);
    }
      public function get_update_tran_record(){
 
        $tran_id    = $this->input->post('account_id');
        $formCode   = $this->input->post('formCode');
          
        $tranf_info =  $this->CRUDModel->get_where_row('gl_amount_transition',array('gl_at_id'=>$tran_id));
        
        
        $ATDResult_updating_record = $this->CRUDModel->get_where_result('gl_amount_details',array('gl_ad_atId'=>$tran_id));
 
        foreach($ATDResult_updating_record as $value):
            
            $data = array(
                'amount_detail_id'      =>$value->gl_ad_id,
                'gl_ad_atId'            =>$value->gl_ad_atId,
                'gl_ad_payeeId'         =>$value->gl_ad_payeeId,
                'gl_ad_date'            =>$value->gl_ad_date,
                'gl_ad_cost_center'     =>$value->gl_ad_cost_center,
                'gl_ad_coa_mc_id'       =>$value->gl_ad_coa_mc_id,
                'gl_ad_coa_mc_name'     =>$value->gl_ad_coa_mc_name,
                'gl_ad_coa_mc_pk'       =>$value->gl_ad_coa_mc_pk,
                'gl_ad_depit'           =>$value->gl_ad_depit,
                'gl_ad_credit'          =>$value->gl_ad_credit,
                'gl_ad_dateTime'        =>$value->gl_ad_dateTime,
                'gl_ad_userId'          =>$value->gl_ad_userId,
                'gl_ad_formCode'        =>$formCode,
            );
            $this->db->insert('gl_amount_details_demo',$data);
        endforeach;
      
            $debitAmount = '';
            $credittAmount = '';
            $where = array('gl_ad_formCode'=>$formCode);
             $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details_demo.gl_ad_coa_mc_pk');
                         $this->db->where($where);
            $ATDResult = $this->db->get('gl_amount_details_demo')->result();
//            $ATDResult = $this->CRUDModel->get_where_result('gl_amount_details_demo',$where);
         
        
        echo '<table id="testing123" cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th class="hidden-sm">Cost Center</th>
                            <th>Account</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th><i class="icon-trash" style="color:#fff"></i><b> Delete</b></th>
                        </tr>
                    </thead>
                    <tbody>';
            $total='';
            
                       $class = array(
                                    'info',
                                    'success',
                                    'danger',
                                    'warning',
                                    'active',
                                );
  
                        foreach($ATDResult as $row):
                            $k = array_rand($class);
                            echo '<tr id="'.$row->gl_ad_id.'Delete" class="'.$class[$k].'">
                            
                            <td class="hidden-sm">'.$row->gl_ad_cost_center.'</td>
                            <td>'.$row->gl_ad_coa_mc_name.'</td>
                            <td><input readonly="readonly"  type="text" name="gl_ad_depit" class="gl_ad_depit"    id="gl_ad_depit" value="'.$row->gl_ad_depit.'"></td>
                            <td><input readonly="readonly"  type="text" name="gl_ad_credit" class="gl_ad_credit"    id="gl_ad_credit" value="'.$row->gl_ad_credit.'"></td>
                            
                            <td><a href="javascript:void(0)" id="'.$row->gl_ad_id.'" class="deleteTra"><i class="fa fa-trash"></i></a></td>
                            </tr>';
                        $debitAmount += $row->gl_ad_depit;
                        $credittAmount += $row->gl_ad_credit;
                        $total = $debitAmount-$credittAmount;
                        endforeach;
                    echo '
                        <tr>
                        <td class="hidden-sm"></td>
                        <td>Total</td>
                        <td><input type="number" class="form-control" id="debitAmount" readonly="readonly" value="'.$debitAmount.'"></td>
                        <td><input type="number" class="form-control" id="credittAmount" readonly="readonly" value="'.$credittAmount.'"></td>
                        <td><input id="Fntotal"  type="number" class="form-control "  disabled="disabled" value="'.$total.'"></td>
                        </tr>
                        <tr>
                        <td class="hidden-sm"></td>
                        <td colspan="2">Print on Cheque</td>
                        <td colspan="2"><input id="print_value"  type="number" class="form-control "  readonly="readonly" value="'.$tranf_info->print_cheque_value.'"></td>
                        </tr>
                    </tbody>
                </table>';
         ?>
                
                        <script>
                        jQuery(document).ready(function(){
                          
                            jQuery('#print_value2').val(jQuery('#credittAmount').val());
                          
                             jQuery('.deleteTra').on('click',function(){
                             var deletId = this.id;
                            
                             jQuery.ajax({
                                 type:'post',
                                 url : 'FinanceController/amount_Detail_Delete',
                                 data: {'deletId':deletId},
                                 success : function(result){
                                    var del = deletId+'Delete';
                                    jQuery('#'+del).hide(); 

                                 var debitAmount    =  jQuery('#debitAmount').val();
                                 var credittAmount  =  jQuery('#credittAmount').val();
                                 var total          =  parseInt(debitAmount)+parseInt(credittAmount);
                              
                                 jQuery('#Fntotal').val(total);

                                 }
                             });
                        
                         });
                         jQuery('.gl_ad_depit,.gl_ad_credit,#Fntotal,#credittAmount,#debitAmount').dblclick(function(){
                             
                             var cust_print = jQuery(this).val();
                             jQuery('#print_value').val(cust_print);
                             jQuery('#print_value2').val(cust_print);
                         });

                        });
                        
                        
                    jQuery('.deleteUnpresented').on('click',function(){

                        alert('test');

                    });
                        
                        
                        
                        </script><?php
        
    }
    public function get_update_tran_record_before_log(){
 
        $tran_id    = $this->input->post('account_id');
        $formCode   = $this->input->post('formCode');
          
        $tranf_info =  $this->CRUDModel->get_where_row('gl_amount_transition',array('gl_at_id'=>$tran_id));
        
        
        $ATDResult_updating_record = $this->CRUDModel->get_where_result('gl_amount_details',array('gl_ad_atId'=>$tran_id));
 
        foreach($ATDResult_updating_record as $value):
            
            $data = array(
                
                'gl_ad_date'            =>$value->gl_ad_date,
                'gl_ad_cost_center'     =>$value->gl_ad_cost_center,
                'gl_ad_coa_mc_id'       =>$value->gl_ad_coa_mc_id,
                'gl_ad_coa_mc_name'     =>$value->gl_ad_coa_mc_name,
                'gl_ad_coa_mc_pk'       =>$value->gl_ad_coa_mc_pk,
                'gl_ad_depit'           =>$value->gl_ad_depit,
                'gl_ad_credit'          =>$value->gl_ad_credit,
                'gl_ad_dateTime'        =>$value->gl_ad_dateTime,
                'gl_ad_userId'          =>$value->gl_ad_userId,
                'gl_ad_formCode'        =>$formCode,
            );
            $this->db->insert('gl_amount_details_demo',$data);
        endforeach;
      
            $debitAmount = '';
            $credittAmount = '';
            $where = array('gl_ad_formCode'=>$formCode);
             $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details_demo.gl_ad_coa_mc_pk');
                         $this->db->where($where);
            $ATDResult = $this->db->get('gl_amount_details_demo')->result();
//            $ATDResult = $this->CRUDModel->get_where_result('gl_amount_details_demo',$where);
         
        
        echo '<table id="testing123" cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th class="hidden-sm">Cost Center</th>
                            <th>Account</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th><i class="icon-trash" style="color:#fff"></i><b> Delete</b></th>
                        </tr>
                    </thead>
                    <tbody>';
            $total='';
            
                       $class = array(
                                    'info',
                                    'success',
                                    'danger',
                                    'warning',
                                    'active',
                                );
  
                        foreach($ATDResult as $row):
                            $k = array_rand($class);
                            echo '<tr id="'.$row->gl_ad_id.'Delete" class="'.$class[$k].'">
                            
                            <td class="hidden-sm">'.$row->gl_ad_cost_center.'</td>
                            <td>'.$row->gl_ad_coa_mc_name.'</td>
                            <td><input readonly="readonly"  type="text" name="gl_ad_depit" class="gl_ad_depit"    id="gl_ad_depit" value="'.$row->gl_ad_depit.'"></td>
                            <td><input readonly="readonly"  type="text" name="gl_ad_credit" class="gl_ad_credit"    id="gl_ad_credit" value="'.$row->gl_ad_credit.'"></td>
                            
                            <td><a href="javascript:void(0)" id="'.$row->gl_ad_id.'" class="deleteTra"><i class="fa fa-trash"></i></a></td>
                            </tr>';
                        $debitAmount += $row->gl_ad_depit;
                        $credittAmount += $row->gl_ad_credit;
                        $total = $debitAmount-$credittAmount;
                        endforeach;
                    echo '
                        <tr>
                        <td class="hidden-sm"></td>
                        <td>Total</td>
                        <td><input type="number" class="form-control" id="debitAmount" readonly="readonly" value="'.$debitAmount.'"></td>
                        <td><input type="number" class="form-control" id="credittAmount" readonly="readonly" value="'.$credittAmount.'"></td>
                        <td><input id="Fntotal"  type="number" class="form-control "  disabled="disabled" value="'.$total.'"></td>
                        </tr>
                        <tr>
                        <td class="hidden-sm"></td>
                        <td colspan="2">Print on Cheque</td>
                        <td colspan="2"><input id="print_value"  type="number" class="form-control "  readonly="readonly" value="'.$tranf_info->print_cheque_value.'"></td>
                        </tr>
                    </tbody>
                </table>';
         ?>
                
                        <script>
                        jQuery(document).ready(function(){
                          
                            jQuery('#print_value2').val(jQuery('#credittAmount').val());
                          
                             jQuery('.deleteTra').on('click',function(){
                             var deletId = this.id;
                            
                             jQuery.ajax({
                                 type:'post',
                                 url : 'FinanceController/amount_Detail_Delete',
                                 data: {'deletId':deletId},
                                 success : function(result){
                                    var del = deletId+'Delete';
                                    jQuery('#'+del).hide(); 

                                 var debitAmount    =  jQuery('#debitAmount').val();
                                 var credittAmount  =  jQuery('#credittAmount').val();
                                 var total          =  parseInt(debitAmount)+parseInt(credittAmount);
                              
                                 jQuery('#Fntotal').val(total);

                                 }
                             });
                        
                         });
                         jQuery('.gl_ad_depit,.gl_ad_credit,#Fntotal,#credittAmount,#debitAmount').dblclick(function(){
                             
                             var cust_print = jQuery(this).val();
                             jQuery('#print_value').val(cust_print);
                             jQuery('#print_value2').val(cust_print);
                         });

                        });
                        
                        
                    jQuery('.deleteUnpresented').on('click',function(){

                        alert('test');

                    });
                        
                        
                        
                        </script><?php
        
    }
    public function autocomplete_amount(){
        
//        $term = trim(strip_tags($_GET['term']));
            $term = trim(strip_tags($this->input->get('term')));
            $where = array(
                   'fn_coa_mc_status'   => 1, 
                   'fn_coa_mc_trash'    => 1, 
                   'fn_account_type_id' => 1, 
                );
            if( $term == ''){
                $like           = $term;
                

                $result_set     = $this->DropdownModel->autocomplete_amount('fn_coa_master_sub_child',$like,$where);
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            'label'     =>$row_set->fn_coa_mc_title, 
                            'code'     =>$row_set->fn_coa_mc_code, 
                            'value'     =>$row_set->fn_coa_mc_title, 
                            'subPk'     =>$row_set->fn_coa_mc_id  
                    );
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['value']     = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                    $label['subPk']     = $label['subPk']; 
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                $result_set             = $this->DropdownModel->autocomplete_amount('fn_coa_master_sub_child',$like,$where);
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                        'label'     =>$row_set->fn_coa_mc_title, 
                        'code'     =>$row_set->fn_coa_mc_code, 
                        'value'     =>$row_set->fn_coa_mc_title, 
                        'subPk'     =>$row_set->fn_coa_mc_id 
                    );
             }
            $matches                = array();
            foreach($labels as $label){
                     $label['value']    = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                    $label['subPk']     = $label['subPk']; 
                    $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    public function autocomplete_emp(){
        
//        $term = trim(strip_tags($_GET['term']));
        $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
                $like           = $term;
                $result_set     = $this->FinanceModel->autocomplete_emp('hr_emp_record',$like);
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            'label'     =>$row_set->emp_name, 
                            'emptId'     =>$row_set->emp_id, 
                            'value'     =>$row_set->emp_name 
                    ); 
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['value']     = $label['value'];
                    $label['label']     = $label['label']; 
                    $label['emptId']     = $label['emptId']; 
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                $result_set             = $this->FinanceModel->autocomplete_emp('hr_emp_record',$like);
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                        'label'     =>$row_set->emp_name, 
                        'emptId'     =>$row_set->emp_id, 
                        'value'     =>$row_set->emp_name 
                    );
             }
            $matches                = array();
            foreach($labels as $label){
                    $label['value']     = $label['value'];
                    $label['label']     = $label['label']; 
                    $label['emptId']     = $label['emptId']; 
                    $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    public function updateAmount(){
        
     
        
        $userInfo = $this->getUser();
        if($this->input->post()):
            //$cheque         = $this->input->post('cheque');
            $amountdate     = date('Y-m-d', strtotime($this->input->post('amountdate')));
            //$voucher        = $this->input->post('voucher');
           // $description    = $this->input->post('description');
             $costCenter    = $this->input->post('costCenter');
            $empId          = $this->input->post('empId');
            $amount         = $this->input->post('amount');
            $amountId       = $this->input->post('amountId');
            $coa_sub_chidId = $this->input->post('coa_sub_chidId');
            $debit          = $this->input->post('debit');
            $credit         = $this->input->post('credit');
            $formCode       = $this->input->post('formCode');
            
           
            $dataATD = array(
//                'gl_ad_payeeId'         =>$empId,
                'gl_ad_date'            =>$amountdate,
//                'gl_ad_cost_center'     =>$costCenter,
                'gl_ad_coa_mc_id'       =>$amountId,
                'gl_ad_coa_mc_pk'       =>$coa_sub_chidId,
                'gl_ad_coa_mc_name'     =>$amount,
                'gl_ad_depit'           =>$debit,
                'gl_ad_credit'          =>$credit,
                'gl_ad_dateTime'        =>date('Y-m-d H:i:s'),
                'gl_ad_userId'          =>$userInfo['user_id'],
                'gl_ad_formCode'        =>$formCode
            );
            
         
            
            
            $ATD = $this->CRUDModel->insert('gl_amount_details_demo',$dataATD);
//            $where = array('gl_ad_userId'=>$userInfo['user_id'],'gl_ad_payeeId'=>$empId,'gl_ad_date'=>$amountdate);
            $where = array('gl_ad_formCode'=>$formCode);
            $ATDResult = $this->CRUDModel->get_where_result('gl_amount_details_demo',$where);
            $debitAmount = '';
            $credittAmount = '';
  //update
            
            
            echo '<table id="testing123" cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th class="hidden-sm">Cost Center</th>
                            <th>Account</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th><i class="icon-trash" style="color:#fff"></i><b> Delete</b></th>
                        </tr>
                    </thead>
                    <tbody>';
            $total='';
            
                       $class = array(
                                    'info',
                                    'success',
                                    'danger',
                                    'warning',
                                    'active',
                                );
  
                        foreach($ATDResult as $row):
                            $k = array_rand($class);
                            echo '<tr id="'.$row->gl_ad_id.'Delete" class="'.$class[$k].'">
                            
                            <td class="hidden-sm">'.$row->gl_ad_cost_center.'</td>
                            <td>'.$row->gl_ad_coa_mc_name.'</td>
                            <td><input readonly="readonly"  type="text" name="gl_ad_depit" class="gl_ad_depit"    id="gl_ad_depit" value="'.$row->gl_ad_depit.'"></td>
                            <td><input readonly="readonly"  type="text" name="gl_ad_credit" class="gl_ad_credit"    id="gl_ad_credit" value="'.$row->gl_ad_credit.'"></td>
                            
                            <td><a href="javascript:void(0)" id="'.$row->gl_ad_id.'" class="deleteTra"><i class="fa fa-trash"></i></a></td>
                            </tr>';
                        $debitAmount += $row->gl_ad_depit;
                        $credittAmount += $row->gl_ad_credit;
                        $total = $debitAmount-$credittAmount;
                        endforeach;
                    echo '
                        <tr>
                        <td class="hidden-sm"></td>
                        <td>Total</td>
                        <td><input type="number" class="form-control" id="debitAmount" readonly="readonly" value="'.$debitAmount.'"></td>
                        <td><input type="number" class="form-control" id="credittAmount" readonly="readonly" value="'.$credittAmount.'"></td>
                        <td><input id="Fntotal"  type="number" class="form-control "  disabled="disabled" value="'.$total.'"></td>
                        </tr>
                        <tr>
                        <td class="hidden-sm"></td>
                        <td colspan="2">Print on Cheque</td>
                        <td colspan="2"><input id="print_value"  type="number" class="form-control "  readonly="readonly" value="'.$credittAmount.'"></td>
                        </tr>
                    </tbody>
                </table>';
                    
                     ?>
                
                        <script>
                        jQuery(document).ready(function(){
                          
                            jQuery('#print_value2').val(jQuery('#credittAmount').val());
                          
                             jQuery('.deleteTra').on('click',function(){
                             var deletId = this.id;
                            
                             jQuery.ajax({
                                 type:'post',
                                 url : 'FinanceController/amount_Detail_Delete',
                                 data: {'deletId':deletId},
                                 success : function(result){
                                    var del = deletId+'Delete';
                                    jQuery('#'+del).hide(); 

                                 var debitAmount    =  jQuery('#debitAmount').val();
                                 var credittAmount  =  jQuery('#credittAmount').val();
                                 var total          =  parseInt(debitAmount)+parseInt(credittAmount);
                              
                                 jQuery('#Fntotal').val(total);

                                 }
                             });
                        
                         });
                         jQuery('.gl_ad_depit,.gl_ad_credit,#Fntotal,#credittAmount,#debitAmount').dblclick(function(){
                             
                             var cust_print = jQuery(this).val();
                             jQuery('#print_value').val(cust_print);
                             jQuery('#print_value2').val(cust_print);
                         });

                        });

                        </script><?php
           endif;
      
    }
       public function amount_Detail_Delete(){
       $deletId = $this->input->post('deletId');
       
        $AmountRow     = $this->db->get_where('gl_amount_details_demo',array('gl_ad_id'=>$deletId))->row();
//            echo '<pre>';print_r($AmountRow);die;
            $attach_log_data = array(
                
                'gl_ad_atId'          => $AmountRow->gl_ad_atId, 
                'gl_ad_id'            => $AmountRow->amount_detail_id, 
                'gl_ad_payeeId'       => $AmountRow->gl_ad_payeeId, 
                'gl_ad_date'          => $AmountRow->gl_ad_date, 
                'gl_ad_cost_center'   => $AmountRow->gl_ad_cost_center, 
                'gl_ad_coa_mc_id'     => $AmountRow->gl_ad_coa_mc_id, 
                'gl_ad_coa_mc_name'   => $AmountRow->gl_ad_coa_mc_name, 
                'gl_ad_coa_mc_pk'     => $AmountRow->gl_ad_coa_mc_pk, 
                'gl_ad_depit'         => $AmountRow->gl_ad_depit, 
                'gl_ad_credit'        => $AmountRow->gl_ad_credit, 
                'gl_ad_dateTime'      => $AmountRow->gl_ad_dateTime, 
                'gl_ad_userId'        => $AmountRow->gl_ad_userId, 
                'log_comments'        => 'Delete in (OP Update Bank Voucher) Form',
                'log_by'              => $this->userInfo->user_id,
                'log_datetime'        => date('Y-m-d H:i:s'),  
                );
                $this->CRUDModel->insert('gl_amount_details_log',$attach_log_data); //Admount Details Log 
            $this->CRUDModel->deleteid('gl_amount_details_demo',array('gl_ad_id'=>$deletId));
   }
    public function amount_Detail_Delete_before_log(){
       $deletId = $this->input->post('deletId');
       $this->CRUDModel->deleteid('gl_amount_details_demo',array('gl_ad_id'=>$deletId));
   } 
    public function check_vocher(){
        $vocher = $this->input->post('vocher');
        $jbJv   = $this->input->post('jbJv');
        
        $query = $this->CRUDModel->get_where_row('gl_amount_transition',array('gl_at_vocher'=>$vocher,'gl_at_cb_jv'=>$jbJv));
        if($query):
            echo 1;
        else:
            echo 0;
        endif;
    }
    public function check_vocher_number(){
        $vocher = $this->input->post('vocher');
        $jbJv   = $this->input->post('jbJv');
        $query1 = $this->db->where('status','1')->get('financial_year')->row();
        $where = array(
             'gl_fy_id'=>$query1->id,
             'gl_at_cb_jv'=>$jbJv
                );
 
                    $this->db->order_by('gl_at_vocher','desc');
                    $this->db->limit('1');
                    $this->db->where($where);
        $result =   $this->db->get('gl_amount_transition')->row(); 
        $vochid = '';
        if(!empty($result)):
            $vochid =$result->gl_at_vocher +1;
        else:
            $vochid = 1;
        endif;
        echo $vochid;
 
    }
    public function saveAmount(){
       
        $userInfo = $this->getUser();
        
         
        if($this->input->post()):
            $cheque         = $this->input->post('cheque');
            $amountdate     = date('Y-m-d', strtotime($this->input->post('amountdate')));
            $voucher        = $this->input->post('voucher');
            $description    = $this->input->post('description');
            $financial      = $this->input->post('financial');
            $costCenter     = $this->input->post('costCenter');
            $jbJv           = $this->input->post('jbJv');
             $empId         = $this->input->post('empId');
            $formCode       = $this->input->post('formCode');
           // $amountId       = $this->input->post('amountId');
          //  $debit          = $this->input->post('debit');
            //$credit         = $this->input->post('credit');
//            $fy_id = $this->CRUDModel->get_where_row('financial_year',array('status'=>1));
            
            $atData = array(
                'gl_at_date'        => $amountdate,
                'gl_at_cheque'      => $cheque,
                'gl_at_payeeId'     => $empId,
                'gl_at_cb_jv'       => $jbJv,
                 'gl_fy_id'         => $financial,
//                'gl_at_payTypeId'   => 1,
                'gl_at_description' => $description,
                'gl_at_cost_cente'  => $costCenter,
                'gl_at_vocher'      => $voucher,
            );
            $atInsert = $this->CRUDModel->insert('gl_amount_transition',$atData);
            $where = array('gl_ad_formCode'=>$formCode);
//            $where = array('gl_ad_userId'=>$userInfo['user_id'],'gl_ad_payeeId'=>$empId,'gl_ad_date'=>$amountdate);
            
            $AdDResult = $this->CRUDModel->get_where_result('gl_amount_details_demo',$where);
          
            $gl_ad_depit = '';
            $gl_ad_credit = '';
            foreach($AdDResult as $checkCD):
                $gl_ad_depit       += $checkCD->gl_ad_depit;
                $gl_ad_credit      += $checkCD->gl_ad_credit;
            endforeach;
            
           
            if($gl_ad_credit == $gl_ad_depit):
        
            foreach($AdDResult as $rowDemo):
                $data = array(
                    'gl_ad_atId'            => $atInsert,
                    'gl_ad_payeeId'         => $rowDemo->gl_ad_payeeId,
                    'gl_ad_date'            => $amountdate,
                    'gl_ad_cost_center'     => $rowDemo->gl_ad_cost_center,
                    'gl_ad_coa_mc_id'       => $rowDemo->gl_ad_coa_mc_id,
                    'gl_ad_coa_mc_pk'       => $rowDemo->gl_ad_coa_mc_pk,
                    'gl_ad_coa_mc_name'     => $rowDemo->gl_ad_coa_mc_name,
                    'gl_ad_depit'           => $rowDemo->gl_ad_depit,
                    'gl_ad_credit'          => $rowDemo->gl_ad_credit,
                    'gl_ad_dateTime'        => date('Y-m-d H:i:s'),
                    'gl_ad_userId'          => $userInfo['user_id'] 
                );
                    $this->CRUDModel->insert('gl_amount_details',$data);
                   
            endforeach;
           
            $this->CRUDModel->deleteid('gl_amount_details_demo',array('gl_ad_formCode'=>$formCode));
            $msg = array('msg'=>'Record Successfully Updated','status'=>2)  ;  
                else:
                $msg = array('msg'=>'Credit Amount = ('.$gl_ad_credit.') Not equal to  Debit Amount = ('.$gl_ad_depit.') Please Check Transition Amount','status'=>1)  ;
            endif;
            
         echo    json_encode($msg);
            
       endif;
    } 
        public function saveAmountUpdate(){
 
        $userInfo = $this->getUser();
        if($this->input->post()):
            
            
            
            $invoice_date       = date('Y-m-d', strtotime($this->input->post('invoice_date')));
            $payment_date       = date('Y-m-d', strtotime($this->input->post('payment_date')));
            $empId              = $this->input->post('payee');
            $supplier_id        = $this->input->post('supplier_id');
            $employee_id        = $this->input->post('employee_id');
            $financial          = $this->input->post('financial');
            $voucherType        = $this->input->post('voucherType');
            $description        = $this->input->post('description');
            $cheque             = $this->input->post('cheque');
            $voucher_status     = $this->input->post('voucher_status');
            $formCode           = $this->input->post('formCode');
            $account_id         = $this->input->post('account_id');
            $print_value2       = $this->input->post('print_value2');
            $voucher_att        = $this->input->post('voucher_att');
            
           $log_trans_tble =  $this->db->get_where('gl_amount_transition',array('gl_at_id'=>$account_id))->row();
           
//           echo '<pre>';print_r($Log_Attach);die;
             //Insert Into Log Table
            $data_log = array(
                'gl_at_id'              => $log_trans_tble->gl_at_id,
                'gl_at_date'            => $log_trans_tble->gl_at_date,
                'fn_account_type_id'    => $log_trans_tble->fn_account_type_id,
                'gl_at_cheque'          => $log_trans_tble->gl_at_cheque,
                'gl_at_payeeId'         => $log_trans_tble->gl_at_payeeId,
                'employee_id'           => $log_trans_tble->employee_id,
                'gl_at_description'     => $log_trans_tble->gl_at_description,
                'supplier_id'           => $log_trans_tble->supplier_id,
                'gl_at_payTypeId'       => $log_trans_tble->gl_at_payTypeId,
                'gl_at_vocher'          => $log_trans_tble->gl_at_vocher,
                'gl_fy_id'              => $log_trans_tble->gl_fy_id,
                'gl_at_cost_cente'      => $log_trans_tble->gl_at_cost_cente,
                'gl_at_cb_jv'           => $log_trans_tble->gl_at_cb_jv,
                'vocher_type'           => $log_trans_tble->vocher_type,
                'vocher_status'         => $log_trans_tble->vocher_status,
                'print_cheque_value'    => $log_trans_tble->print_cheque_value,
                'vocher_rq'             => $log_trans_tble->vocher_rq,
                'payment_date'          => date('Y-m-d',strtotime($log_trans_tble->payment_date)),
                'timeStamp'             => $log_trans_tble->timeStamp,
                'user_id'               => $log_trans_tble->user_id,
                'log_comments'          => 'Update by:'.date('d-m-Y'),
                'log_by'                => $this->userInfo->user_id,
                'log_dateTime'          => date('Y-m-d H:i:s'));
            
            $Log_Insert     = $this->CRUDModel->insert('gl_amount_transition_log',$data_log);
            $Log_Attach     = $this->db->get_where('fn_voucher_attachment',array('amount_tra_id'=>$account_id))->result();
             
            foreach($Log_Attach as $AttRow):
                $attach_log_data = array(
                 'trans_log_id'         => $Log_Insert, //fn_voucher_attachment_log PK Id  
                 'vocher_atta_id'       => $AttRow->id, // fn_voucher_attachment PK id
                 'amount_tra_id'        => $AttRow->amount_tra_id,
                 'attach_id'            => $AttRow->attach_id,
                 'timestamp'            => $AttRow->timestamp,
                 'user_id'              => $AttRow->user_id,
                 'up_timestamp'         => $AttRow->up_timestamp,
                 'up_user_id'           => $AttRow->up_user_id,
                 'log_by'               => $this->userInfo->user_id,
                'log_dateTime'          => date('Y-m-d H:i:s'),  
                );
                $this->CRUDModel->insert('fn_voucher_attachment_log',$attach_log_data);
            endforeach;
            $Log_amount_details     = $this->db->get_where('gl_amount_details',array('gl_ad_atId'=>$account_id))->result();
             
            foreach($Log_amount_details as $AmountRow):
            $attach_log_data = array(
                'gl_ad_id'            => $AmountRow->gl_ad_id, //fn_voucher_attachment_log PK Id  
                'gl_ad_atId'          => $AmountRow->gl_ad_atId, 
                'gl_ad_payeeId'       => $AmountRow->gl_ad_payeeId, 
                'gl_ad_date'          => $AmountRow->gl_ad_date, 
                'gl_ad_cost_center'   => $AmountRow->gl_ad_cost_center, 
                'gl_ad_coa_mc_id'     => $AmountRow->gl_ad_coa_mc_id, 
                'gl_ad_coa_mc_name'   => $AmountRow->gl_ad_coa_mc_name, 
                'gl_ad_coa_mc_pk'     => $AmountRow->gl_ad_coa_mc_pk, 
                'gl_ad_depit'         => $AmountRow->gl_ad_depit, 
                'gl_ad_credit'        => $AmountRow->gl_ad_credit, 
                'gl_ad_dateTime'      => $AmountRow->gl_ad_dateTime, 
                'gl_ad_userId'        => $AmountRow->gl_ad_userId, 
                'gl_ad_userId_up'     => $AmountRow->gl_ad_userId_up, 
                'gl_ad_dateTime_up'   => $AmountRow->gl_ad_dateTime_up, 
                'log_by'              => $this->userInfo->user_id,
                'log_comments'        => 'Update in (OP Update Bank Voucher) Form',
                'log_datetime'        => date('Y-m-d H:i:s'),  
                );
                $this->CRUDModel->insert('gl_amount_details_log',$attach_log_data); //Admount Details Log 
            endforeach;
             
            $atData = array(
                'gl_at_date'            => date('Y-m-d',strtotime($invoice_date)),
                'gl_at_cheque'          => $cheque,
                'gl_at_payeeId'         => $empId,
                'supplier_id'            => $supplier_id,
                'employee_id'           => $employee_id,
                'gl_at_description'     => $description,
                'gl_fy_id'              => $financial,
                'vocher_type'           => $voucherType,
                'print_cheque_value'    => $print_value2,
                'vocher_status'         => $voucher_status,
                'payment_date'          => date('Y-m-d',strtotime($payment_date)));
            
            $whereTran = array('gl_at_id'=>$account_id);
            $this->CRUDModel->update('gl_amount_transition',$atData,$whereTran);
        $this->CRUDModel->deleteid('fn_voucher_attachment',array('amount_tra_id'=>$account_id));
            if($voucher_att):
                foreach($voucher_att as $row=>$key):
                 $data = array(
                   'amount_tra_id'  => $account_id, 
                   'attach_id'      => $key, 
                   'timestamp'      => date('Y-m-d H:i:s'),
                    'user_id'       => $userInfo['user_id']  
                 );
                 $this->CRUDModel->insert('fn_voucher_attachment',$data);
                 
             endforeach;
            endif; 
             
         
            $where = array('gl_ad_formCode'=>$formCode);
            $AdDResult = $this->CRUDModel->get_where_result('gl_amount_details_demo',$where);
          
            $gl_ad_depit = '';
            $gl_ad_credit = '';
            
            if($AdDResult):
                foreach($AdDResult as $checkCD):
                $gl_ad_depit       += $checkCD->gl_ad_depit;
                $gl_ad_credit      += $checkCD->gl_ad_credit;
            endforeach; 
            endif;
          
            
           
            if($gl_ad_credit == $gl_ad_depit):
                
                $this->CRUDModel->deleteid('gl_amount_details',array('gl_ad_atId'=>$account_id));
            
            foreach($AdDResult as $rowDemo):
                
                $data = array(
                    'gl_ad_atId'            => $account_id,
                    'gl_ad_payeeId'         => $rowDemo->gl_ad_payeeId,
                    'gl_ad_date'            => date('Y-m-d',strtotime($invoice_date)),
                    'gl_ad_cost_center'     => $rowDemo->gl_ad_cost_center,
                    'gl_ad_coa_mc_id'       => $rowDemo->gl_ad_coa_mc_id,
                    'gl_ad_coa_mc_pk'       => $rowDemo->gl_ad_coa_mc_pk,
                    'gl_ad_coa_mc_name'     => $rowDemo->gl_ad_coa_mc_name,
                    'gl_ad_depit'           => $rowDemo->gl_ad_depit,
                    'gl_ad_credit'          => $rowDemo->gl_ad_credit,
                    'gl_ad_dateTime'        => $rowDemo->gl_ad_dateTime,
                    'gl_ad_userId'          => $rowDemo->gl_ad_userId, 
                    'gl_ad_dateTime_up'     => date('Y-m-d H:i:s'),
                    'gl_ad_userId_up'       => $userInfo['user_id'] 
                );
                    $this->CRUDModel->insert('gl_amount_details',$data);
                   
            endforeach;
            $this->CRUDModel->deleteid('gl_amount_details_demo',array('gl_ad_formCode'=>$formCode));
            $msg = array('msg'=>'Record Successfully Updated','status'=>2)  ;  
                else:
                $msg = array('msg'=>'Credit Amount = ('.$gl_ad_credit.') Not equal to  Debit Amount = ('.$gl_ad_depit.') Please Check Transition Amount','status'=>1)  ;
            endif;
          
            redirect('VoucherPrint/'.$account_id);
      endif;
    }
    public function saveAmountUpdate_before_log(){
 
        $userInfo = $this->getUser();
        if($this->input->post()):
            
            
            
         
            $invoice_date       = date('Y-m-d', strtotime($this->input->post('invoice_date')));
            $payment_date       = date('Y-m-d', strtotime($this->input->post('payment_date')));
            $empId              = $this->input->post('payee');
            $supplier_id         = $this->input->post('supplier_id');
            $employee_id         = $this->input->post('employee_id');
            $financial          = $this->input->post('financial');
            $voucherType        = $this->input->post('voucherType');
//            $employee           = $this->input->post('employee');
            $description        = $this->input->post('description');
            $cheque             = $this->input->post('cheque');
            $voucher_status     = $this->input->post('voucher_status');
             
            $formCode           = $this->input->post('formCode');
            $account_id         = $this->input->post('account_id');
            $print_value2       = $this->input->post('print_value2');
            
            $voucher_att        = $this->input->post('voucher_att');
            
            
            
            $atData = array(
                'gl_at_date'            => date('Y-m-d',strtotime($invoice_date)),
                'gl_at_cheque'          => $cheque,
                'gl_at_payeeId'         => $empId,
                'supplier_id'            => $supplier_id,
                'employee_id'            => $employee_id,
                'gl_at_description'     => $description,
                'gl_fy_id'              => $financial,
//                'gl_at_vocher'          => $voucher,
                'vocher_type'           => $voucherType,
                'print_cheque_value'    => $print_value2,
                'vocher_status'         => $voucher_status,
                'payment_date'          => date('Y-m-d',strtotime($payment_date)),
                
            );
            
            $whereTran = array('gl_at_id'=>$account_id);
            $this->CRUDModel->update('gl_amount_transition',$atData,$whereTran);
//            $atInsert = $this->CRUDModel->insert('gl_amount_transition',$atData);
            
             $this->CRUDModel->deleteid('fn_voucher_attachment',array('amount_tra_id'=>$account_id));
            
             
        
            if($voucher_att):
                foreach($voucher_att as $row=>$key):
                 $data = array(
                   'amount_tra_id'  => $account_id, 
                   'attach_id'      => $key, 
                   'timestamp'      => date('Y-m-d H:i:s'),
                    'user_id'       => $userInfo['user_id']  
                 );
                 $this->CRUDModel->insert('fn_voucher_attachment',$data);
                 
             endforeach;
            endif; 
             
         
            $where = array('gl_ad_formCode'=>$formCode);
//            $where = array('gl_ad_userId'=>$userInfo['user_id'],'gl_ad_payeeId'=>$empId,'gl_ad_date'=>$amountdate);
            
            $AdDResult = $this->CRUDModel->get_where_result('gl_amount_details_demo',$where);
          
            $gl_ad_depit = '';
            $gl_ad_credit = '';
            
            if($AdDResult):
                foreach($AdDResult as $checkCD):
                $gl_ad_depit       += $checkCD->gl_ad_depit;
                $gl_ad_credit      += $checkCD->gl_ad_credit;
            endforeach; 
            endif;
          
            
           
            if($gl_ad_credit == $gl_ad_depit):
                
                $this->CRUDModel->deleteid('gl_amount_details',array('gl_ad_atId'=>$account_id));
            
            foreach($AdDResult as $rowDemo):
                
                $data = array(
                    'gl_ad_atId'            => $account_id,
                    'gl_ad_payeeId'         => $rowDemo->gl_ad_payeeId,
                    'gl_ad_date'            => date('Y-m-d',strtotime($invoice_date)),
                    'gl_ad_cost_center'     => $rowDemo->gl_ad_cost_center,
                    'gl_ad_coa_mc_id'       => $rowDemo->gl_ad_coa_mc_id,
                    'gl_ad_coa_mc_pk'       => $rowDemo->gl_ad_coa_mc_pk,
                    'gl_ad_coa_mc_name'     => $rowDemo->gl_ad_coa_mc_name,
                    'gl_ad_depit'           => $rowDemo->gl_ad_depit,
                    'gl_ad_credit'          => $rowDemo->gl_ad_credit,
                    'gl_ad_dateTime'        => $rowDemo->gl_ad_dateTime,
                    'gl_ad_userId'          => $rowDemo->gl_ad_userId, 
                    'gl_ad_dateTime_up'     => date('Y-m-d H:i:s'),
                    'gl_ad_userId_up'       => $userInfo['user_id'] 
                );
                    $this->CRUDModel->insert('gl_amount_details',$data);
                   
            endforeach;
            $this->CRUDModel->deleteid('gl_amount_details_demo',array('gl_ad_formCode'=>$formCode));
            $msg = array('msg'=>'Record Successfully Updated','status'=>2)  ;  
                else:
                $msg = array('msg'=>'Credit Amount = ('.$gl_ad_credit.') Not equal to  Debit Amount = ('.$gl_ad_depit.') Please Check Transition Amount','status'=>1)  ;
            endif;
          
            redirect('VoucherPrint/'.$account_id);
            
            
//         echo    json_encode($msg);
            
       endif;
    }
       public function general_ledger_new(){
           
            $this->data['COAP'] =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1));
            
            if($this->input->post('search')):
               
                $this->data['dateFrom']       = $this->input->post('dateFrom');
                $this->data['toDate']         = $this->input->post('dateto');
                
                $this->data['recordTo']       = $this->input->post('recordTo');
                $this->data['recordFrom']     = $this->input->post('recordFrom');
                
                $this->data['recordToCode']       = $this->input->post('recordToCode');
                $this->data['recordFromCode']     = $this->input->post('recordFromCode');
                
//               $this->data['GeneralLeader']   =  $this->FinanceModel->get_leader_dw(
               $this->data['GeneralLeader']   =  $this->FinanceModel->Genderl_ledger_report(
                       $this->data['dateFrom'], 
                       $this->data['toDate'],
                       $this->data['recordFromCode'],
                       $this->data['recordToCode']
                       );
            endif;
            if($this->input->post('excel')):
             
                
                $this->data['dateFrom']       = $this->input->post('dateFrom');
                $this->data['toDate']         = $this->input->post('dateto');
                
                $this->data['recordTo']       = $this->input->post('recordTo');
                $this->data['recordFrom']     = $this->input->post('recordFrom');
                
                $this->data['recordToCode']       = $this->input->post('recordToCode');
                $this->data['recordFromCode']     = $this->input->post('recordFromCode');
                     
                    
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('General Ledger');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'COA Title');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'Date');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('C1', 'Vocher');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('D1','COA');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);
                
               
                $this->excel->getActiveSheet()->setCellValue('E1', 'Description');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('F1', 'Payee');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('G1', 'Cheque');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('H1', 'Debit');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(12);
                 
               
                $this->excel->getActiveSheet()->setCellValue('I1', 'Credit');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(12);
                 
               
                
               
                
       for($col = ord('A'); $col <= ord('I'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
                
               $GeneralLeader =  $this->FinanceModel->get_leader_dw('gl_amount_details',
                       $this->data['dateFrom'], 
                       $this->data['toDate'],
                       $this->data['recordFromCode'],
                       $this->data['recordToCode']
                       );
          
                 if(!empty($GeneralLeader)):
                     $result = array();
                    foreach($GeneralLeader as $GLRow):
                    $result[] =  array(
                            'title'             => $GLRow->gl_ad_coa_mc_name.'('.$GLRow->gl_ad_coa_mc_id.')',
                            'vocher'            => '', 
                            'gl_ad_coa_mc_name' =>  '',
                            'gl_ad_coa_mc_name' =>   '', 
                            'gl_at_cheque'      =>   '', 
                            'gl_ad_depit'       =>   '',
                            'gl_ad_credit'      =>   '',
                            'total_depit'       =>  '',
                            'total_credit'      =>   ''
                            );
                     
                        
                        $detail = $this->FinanceModel->get_amountDetails(
                                                        'gl_amount_transition',
                                                        array('gl_ad_coa_mc_pk'=>$GLRow->gl_ad_coa_mc_pk),$this->data['dateFrom'],$this->data['toDate']);
                        $credit_total    = '';
                        $debit_total     = '';
                        
                        $gl_ad_coa_mc_name = '';
                        foreach($detail as $dRow):
                            $date=date_create($dRow->payment_date);
                             if($dRow->gl_ad_depit):
                                                            
                                $vocDet = array(
                                'gl_ad_atId'=>$dRow->gl_at_id,
                                'gl_ad_depit '=>'');
                            $VocDetail = $this->CRUDModel->get_where_result('gl_amount_details',$vocDet);

                            foreach($VocDetail as $VCName):

                                    if($VCName == $dRow->gl_ad_coa_mc_id):
                                        else:
                                             $gl_ad_coa_mc_name =  $VCName->gl_ad_coa_mc_name.',';
                                    endif;

                            endforeach;
                                else:

                                 $vocDet = array(
                                'gl_ad_atId'=>$dRow->gl_at_id,
                                'gl_ad_credit '=>'');
                            $VocDetail = $this->CRUDModel->get_where_result('gl_amount_details',$vocDet);

                            foreach($VocDetail as $VCName):

                                    if($VCName == $dRow->gl_ad_coa_mc_id):
                                        else:

                                        $gl_ad_coa_mc_name =  $VCName->gl_ad_coa_mc_name.',';

                                     
                                    endif;

                            endforeach;
                              endif;
                              
                        $result[] = array(
                             'title'                =>  '',   
                             'date'                 =>  date_format($date,"d-m-Y"),
                             'vocher'               =>  $dRow->gl_at_vocher, 
                             'gl_ad_coa_mc_name'    =>  $gl_ad_coa_mc_name,
                             'gl_at_payeeId'        =>  $dRow->gl_at_description, 
                            'gl_at_descr'          =>  $dRow->gl_at_payeeId, 
                            'gl_at_cheque'         =>  $dRow->gl_at_cheque, 
                             'gl_ad_depit'          =>  number_format($dRow->gl_ad_depit, 0, ',', ','),
                             'gl_ad_credit'         =>  number_format($dRow->gl_ad_credit, 0, ',', ','),
                             'total_depit'          =>  '',
                             'total_credit'         =>  ''
                                ); 
                             
                            $debit_total  +=$dRow->gl_ad_depit;
                            $credit_total +=$dRow->gl_ad_credit;
                             
                            endforeach;
                            
                            $result[] =  array(
                             'title'              => '',
                             'vocher'            => '', 
                             'gl_ad_coa_mc_name'  => '',
                             'gl_ad_coa_mc_name'  =>   '', 
                             'gl_at_cheque'      =>   '', 
                             'gl_ad_depit'       =>   '',
                             'gl_ad_credit'      =>   'Total',
                             'total_depit'       =>  number_format($debit_total, 0, ',', ','),
                             'total_credit'      =>   number_format($credit_total, 0, ',', ',')
                            );
                        
                            
                         
                           
                            
                            
                    endforeach;
 

            if(!empty($result)):
                
       
            
        foreach ($result as $row){
               
                $exceldata[] = $row;
                
        }
        
                    
                // echo '<pre>';print_r($exceldata);die;
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $date = $this->data['dateFrom'].' To '.$this->data['toDate'];
                $filename='General Ledger From '.$date.'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
                     endif;
                    
               
                    
                endif;
            endif;
        
            $this->data['page']         = "Finance/reports/general_leader";
            $this->data['page_title']        = 'Trial Balance | ECMS';
            $this->load->view('common/common',$this->data);
    }
    public function general_ledger(){
        
            $this->data['COAP'] =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1,'fn_account_type_id'=>1));
             $this->data['dateFrom']       = date('d-m-Y');
            $this->data['toDate']         = date('d-m-Y');

            $this->data['recordTo']       = '';
            $this->data['recordFrom']     = '';

            $this->data['recordToCode']   = '';
            $this->data['recordFromCode'] = '';
            if($this->input->post('search')):
               
                $this->data['dateFrom']       = $this->input->post('dateFrom');
                $this->data['toDate']         = $this->input->post('dateto');
                
                $this->data['recordTo']       = $this->input->post('recordTo');
                $this->data['recordFrom']     = $this->input->post('recordFrom');
                
                $this->data['recordToCode']   = $this->input->post('recordToCode');
                $this->data['recordFromCode'] = $this->input->post('recordFromCode');
                
                $from_code_value = $this->db->get_where('fn_coa_master_sub_child',array('fn_coa_mc_id'=>$this->data['recordFromCode']))->row();
                $to_code_value = $this->db->get_where('fn_coa_master_sub_child',array('fn_coa_mc_id'=>$this->data['recordToCode']))->row();
                $from_code_value_fld    = '' ;
                $to_code_value_fld      = '' ;
                if(isset($from_code_value) && !empty($from_code_value)):
                    $from_code_value_fld    = $from_code_value->fn_coa_mc_code; 
                    $to_code_value_fld      = $to_code_value->fn_coa_mc_code ;
                else:
                    $from_code_value_fld    = ''; 
                    $to_code_value_fld      = ''; 
                endif;
                $this->data['GeneralLeader']   =  $this->FinanceModel->get_leader_dw('gl_amount_details',
                       $this->data['dateFrom'], 
                       $this->data['toDate'],
                       $from_code_value_fld,
                       $to_code_value_fld
                       );
             endif;
            if($this->input->post('excel')):
             
                
                $this->data['dateFrom']       = $this->input->post('dateFrom');
                $this->data['toDate']         = $this->input->post('dateto');
                
                $this->data['recordTo']       = $this->input->post('recordTo');
                $this->data['recordFrom']     = $this->input->post('recordFrom');
                
                $this->data['recordToCode']       = $this->input->post('recordToCode');
                $this->data['recordFromCode']     = $this->input->post('recordFromCode');
                     
                    
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('General Ledger');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'COA Title');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'Date');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('C1', 'Vocher');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('D1','COA');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);
                
               
                $this->excel->getActiveSheet()->setCellValue('E1', 'Description');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('F1', 'Payee');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('G1', 'Cheque');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('H1', 'Debit');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(12);
                 
               
                $this->excel->getActiveSheet()->setCellValue('I1', 'Credit');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(12);
                 
               
                
               
                
       for($col = ord('A'); $col <= ord('H'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
//                 $this->excel->getActiveSheet()->getStyle(chr($col))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        }
       for($col = ord('G'); $col <= ord('I'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                 
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                 $this->excel->getActiveSheet()->getStyle(chr($col))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        }
       
                
                $from_code_value = $this->db->get_where('fn_coa_master_sub_child',array('fn_coa_mc_id'=>$this->data['recordFromCode']))->row();
                $to_code_value = $this->db->get_where('fn_coa_master_sub_child',array('fn_coa_mc_id'=>$this->data['recordToCode']))->row();
                
                $from_code_value_fld    = '' ;
                $to_code_value_fld      = '' ;
                if(isset($from_code_value) && !empty($from_code_value)):
                    $from_code_value_fld    =   $from_code_value->fn_coa_mc_code; 
                    $to_code_value_fld      =   $to_code_value->fn_coa_mc_code ;
                else:
                    $from_code_value_fld    = ''; 
                    $to_code_value_fld      = ''; 
                endif;
                
                 $GeneralLeader   =  $this->FinanceModel->get_leader_dw('gl_amount_details',
                       $this->data['dateFrom'], 
                       $this->data['toDate'],
                       $from_code_value_fld,
                       $to_code_value_fld
                       );
               
                 if(!empty($GeneralLeader)):
                     $result = array();
                    foreach($GeneralLeader as $GLRow):
                        
                        //Open Balance code start
                        $where = array(
                                                            'gl_ad_coa_mc_pk'                           =>$GLRow->gl_ad_coa_mc_pk,
                                                             'gl_amount_transition.fn_account_type_id'  =>1,
                                                            'payment_date <'                            =>date('Y-m-d', strtotime($this->data['dateFrom'])),
                                                        );
                                                        $open_balance       = $this->FinanceModel->open_balance($where);
                                                        
//                                                        echo '<pre>';print_r($open_balance);die;
                                                        $grandCredit_open   = 0;
                                                        $grandDebit_open    = 0;
                                                        $debit_total_open   = 0;
                                                        $credit_total_open  = 0;
                                                        foreach($open_balance as $obRow):


                                                                $query  =  $this->db->where(array('status'=>1,'fn_account_type_id'=>1))->get('financial_year')->row();

                                                               $grandDebit             = '';
                                                               $grandCredit            = '';
                                                               $parentId               = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));
                                                                 $count = ''; 
                                                               if(!empty($parentId)):
                                                                    if($parentId->fn_coa_code == 200000):
                                                                           $debit_total_open       +=$obRow->gl_ad_depit ;
                                                                           $credit_total_open      +=$obRow->gl_ad_credit;         

                                                                           $grandCredit_open       = $credit_total_open-$debit_total_open;
                                                                           $grandDebit_open        = '';


                                                                       endif;
                                                               endif;
                                                               if(!empty($parentId)):
                                                                      if($parentId->fn_coa_code == 400000):
                                                                              $dateDiff = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
               ////                                                            $dateDiff = date_diff(date_create($obRow->gl_ad_date), date_create(date('Y-m-d', strtotime($query->year_start))));
                                                                           $timeStart = $dateDiff->format("%R%a"); 
               //                                                          
                                                                           if($timeStart > 0):
               //                                                                echo $timeStart;
                                                                                       $debit_total_open       +=$obRow->gl_ad_depit ;
                                                                                       $credit_total_open      +=$obRow->gl_ad_credit; 

                                                                                       $grandCredit_open = $credit_total_open-$debit_total_open;
                                                                           $grandDebit_open     = '';
                                                                            

               //                                                               
                                                                           endif; 
                                                                      endif;
                                                               endif;
                                                               if(!empty($parentId)):
                                                                    if($parentId->fn_coa_code == 300000):

                                                                                  $debit_total_open       +=$obRow->gl_ad_depit ;
                                                                                   $credit_total_open      +=$obRow->gl_ad_credit;
                                                                              $grandDebit_open = $debit_total_open- $credit_total_open;
                                                                               $grandCredit_open    = '';
                                                                       endif;
                                                               endif;
                                                               if(!empty($parentId)):
                                                                        if($parentId->fn_coa_code == 500000):

                                                                           $dateDiff = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
               ////                                                            $dateDiff = date_diff(date_create($obRow->gl_ad_date), date_create(date('Y-m-d', strtotime($query->year_start))));
                                                                           $timeStart = $dateDiff->format("%R%a"); 
               //                                                          
                                                                           if($timeStart > 0):
                                                                               $debit_total_open       +=$obRow->gl_ad_depit ;
                                                                               $credit_total_open      +=$obRow->gl_ad_credit;

                                                                               $grandDebit_open = $debit_total_open- $credit_total_open;
                                                                               $grandCredit_open    = '';


                                                                           endif;




                                                                       endif;
                                                               endif;
                                                       endforeach;  
                        //Open Balance code end
                         $show_op_credit = '';
                         $show_op_debit= '';
                         
                         if(!empty($grandDebit_open)):
                         $show_op_debit =    number_format($grandDebit_open, 0, ',', ','); 
                        endif;
                        if(!empty($grandCredit_open)):
                        $show_op_credit =    number_format($grandCredit_open, 0, ',', ','); 
                        endif;
                        
                    $result[] =  array(
                            'title'             =>  $GLRow->gl_ad_coa_mc_name.'('.$GLRow->gl_ad_coa_mc_id.')',
                            'vocher'            =>  '', 
                            'gl_ad_coa_mc_name' =>  '',
                            'gl_ad_coa_mc_name' =>  '', 
                            'gl_at_cheque'      =>  '', 
                            'gl_ad_depit'       =>  '',
                            'gl_ad_empty'       =>  '',
                             
                            'gl_ad_credit'      =>  'Open Balance',
                            'total_depit'       =>  $show_op_debit,
                            'total_credit'      =>  $show_op_credit
                            );
                     
                        
                    
                    
                        $detail = $this->FinanceModel->get_amountDetails(
                                'gl_amount_transition',
                        array(
                                'gl_ad_coa_mc_pk'=>$GLRow->gl_ad_coa_mc_pk,
                                'gl_amount_transition.fn_account_type_id' => 1
                                ),$this->data['dateFrom'],$this->data['toDate']);
                        $credit_total    = '';
                        $debit_total     = '';
                        
                        $gl_ad_coa_mc_name = '';
                        foreach($detail as $dRow):
                            $date=date_create($dRow->payment_date);
                             if($dRow->gl_ad_depit):
                                                            
                                $vocDet = array(
                                'gl_ad_atId'=>$dRow->gl_at_id,
                                'gl_ad_depit '=>'');
                            $VocDetail = $this->CRUDModel->get_where_result('gl_amount_details',$vocDet);

                            foreach($VocDetail as $VCName):

                                    if($VCName == $dRow->gl_ad_coa_mc_id):
                                        else:
                                             $gl_ad_coa_mc_name .=  $VCName->gl_ad_coa_mc_name.',';
                                    endif;

                            endforeach;
                                else:

                                 $vocDet = array(
                                'gl_ad_atId'=>$dRow->gl_at_id,
                                'gl_ad_credit '=>'');
                            $VocDetail = $this->CRUDModel->get_where_result('gl_amount_details',$vocDet);

                            foreach($VocDetail as $VCName):

                                    if($VCName == $dRow->gl_ad_coa_mc_id):
                                    else:
                                        $gl_ad_coa_mc_name .=  $VCName->gl_ad_coa_mc_name.',';
                                    endif;

                            endforeach;
                              endif;
                   
                        $result[] = array(
                             'title'                =>  '',   
                             'date'                 =>  date_format($date,"d-m-Y"),
                             'vocher'               =>  $dRow->gl_at_vocher, 
                             'gl_ad_coa_mc_name'    =>  preg_replace("/,$/", '', $gl_ad_coa_mc_name),
                             'gl_at_payeeId'        =>  $dRow->gl_at_description, 
                            'gl_at_descr'          =>  $dRow->gl_at_payeeId, 
                            'gl_at_cheque'         =>  $dRow->gl_at_cheque, 
                             'gl_ad_depit'          =>  $dRow->gl_ad_depit,
                             'gl_ad_credit'         =>  $dRow->gl_ad_credit,
//                             'gl_ad_depit'          =>  number_format($dRow->gl_ad_depit, 0, ',', ','),
//                             'gl_ad_credit'         =>  number_format($dRow->gl_ad_credit, 0, ',', ','),
                             'total_depit'          =>  '',
                             'total_credit'         =>  ''
                                ); 
                             
                            $debit_total  +=$dRow->gl_ad_depit;
                            $credit_total +=$dRow->gl_ad_credit;
                             $gl_ad_coa_mc_name = '';
                            endforeach;
                            
                            $result[] =  array(
                             'title'                =>  '',
                             'vocher'               =>  '', 
                             'date'                 =>  '', 
                             'gl_ad_coa_mc_name'    =>  '',
                             'gl_ad_coa_mc_name'    =>  '', 
                             'gl_at_cheque'         =>  '', 
                             'gl_ad_depit'          =>  '',
                             'gl_ad_credit'         =>  'Total',
                             'total_depit'          =>  $debit_total,
                             'total_credit'         =>  $credit_total
                            );
                        
                            
                         
                           
                            
                            
                    endforeach;
 

            if(!empty($result)):
                
       
            
        foreach ($result as $row){
               
                $exceldata[] = $row;
                
        }
        
                    
                // echo '<pre>';print_r($exceldata);die;
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $date = $this->data['dateFrom'].' To '.$this->data['toDate'];
                $filename='General Ledger From '.$date.'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
                     endif;
                    
               
                    
                endif;
            endif;
        
             $this->data['page']         = "Finance/OP/Reports/general_leader_dw";
            $this->data['page_title']        = 'OP General Ledger | ECMS';
            $this->data['page_header']        = 'OP General Ledger';
            $this->load->view('common/common',$this->data);
    }
//    public function general_ledger_old(){
//        
//            $this->data['COAP'] =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1));
//            
//            if($this->input->post('search')):
//               
//                $this->data['dateFrom']       = $this->input->post('dateFrom');
//                $this->data['toDate']         = $this->input->post('dateto');
//                
//                $this->data['recordTo']       = $this->input->post('recordTo');
//                $this->data['recordFrom']     = $this->input->post('recordFrom');
//                
//                $this->data['recordToCode']       = $this->input->post('recordToCode');
//                $this->data['recordFromCode']     = $this->input->post('recordFromCode');
//                
////               $this->data['GeneralLeader']   =  $this->FinanceModel->get_leader_dw(
//               $this->data['GeneralLeader']   =  $this->FinanceModel->get_leader_dw_old('gl_amount_details',
//                       $this->data['dateFrom'], 
//                       $this->data['toDate'],
//                       $this->data['recordFromCode'],
//                       $this->data['recordToCode']
//                       );
////              echo $this->db->last_query();die;  
////              echo '<pre>';print_r($this->data['GeneralLeader']);die; 
//                
//            endif;
//            if($this->input->post('excel')):
//             
//                
//                $this->data['dateFrom']       = $this->input->post('dateFrom');
//                $this->data['toDate']         = $this->input->post('dateto');
//                
//                $this->data['recordTo']       = $this->input->post('recordTo');
//                $this->data['recordFrom']     = $this->input->post('recordFrom');
//                
//                $this->data['recordToCode']       = $this->input->post('recordToCode');
//                $this->data['recordFromCode']     = $this->input->post('recordFromCode');
//                     
//                    
//                $this->load->library('excel');
//                $this->excel->setActiveSheetIndex(0);
//                //name the worksheet
//                $this->excel->getActiveSheet()->setTitle('General Ledger');
//                //set cell A1 content with some text
//                $this->excel->getActiveSheet()->setCellValue('A1', 'COA Title');
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
//                
//                $this->excel->getActiveSheet()->setCellValue('B1', 'Date');
//                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
//                
//                $this->excel->getActiveSheet()->setCellValue('C1', 'Vocher');
//                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
//                
//                $this->excel->getActiveSheet()->setCellValue('D1','COA');
//                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);
//                
//               
//                $this->excel->getActiveSheet()->setCellValue('E1', 'Description');
//                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(12);
//                
//                $this->excel->getActiveSheet()->setCellValue('F1', 'Payee');
//                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(12);
//                
//                $this->excel->getActiveSheet()->setCellValue('G1', 'Cheque');
//                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(12);
//                
//                $this->excel->getActiveSheet()->setCellValue('H1', 'Debit');
//                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(12);
//                 
//               
//                $this->excel->getActiveSheet()->setCellValue('I1', 'Credit');
//                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(12);
//                 
//               
//                
//               
//                
//       for($col = ord('A'); $col <= ord('I'); $col++){
//                //set column dimension
//                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
//                 //change the font size
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
//                 
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
//        }
//                
//               $GeneralLeader =  $this->FinanceModel->get_leader_dw('gl_amount_details',
//                       $this->data['dateFrom'], 
//                       $this->data['toDate'],
//                       $this->data['recordFromCode'],
//                       $this->data['recordToCode']
//                       );
//               
//                 if(!empty($GeneralLeader)):
//                     $result = array();
//                    foreach($GeneralLeader as $GLRow):
//                    $result[] =  array(
//                            'title'             => $GLRow->gl_ad_coa_mc_name.'('.$GLRow->gl_ad_coa_mc_id.')',
//                            'vocher'            => '', 
//                            'gl_ad_coa_mc_name' =>  '',
//                            'gl_ad_coa_mc_name' =>   '', 
//                            'gl_at_cheque'      =>   '', 
//                            'gl_ad_depit'       =>   '',
//                            'gl_ad_credit'      =>   '',
//                            'total_depit'       =>  '',
//                            'total_credit'      =>   ''
//                            );
//                     
//                        
//                        $detail = $this->FinanceModel->get_amountDetails(
//                                                        'gl_amount_transition',
//                                                        array('gl_ad_coa_mc_pk'=>$GLRow->gl_ad_coa_mc_pk),$this->data['dateFrom'],$this->data['toDate']);
//                        $credit_total    = '';
//                        $debit_total     = '';
//                        
//                        $gl_ad_coa_mc_name = '';
//                        foreach($detail as $dRow):
//                            $date=date_create($dRow->gl_at_date);
//                             if($dRow->gl_ad_depit):
//                                                            
//                                $vocDet = array(
//                                'gl_ad_atId'=>$dRow->gl_at_id,
//                                'gl_ad_depit '=>'');
//                            $VocDetail = $this->CRUDModel->get_where_result('gl_amount_details',$vocDet);
//
//                            foreach($VocDetail as $VCName):
//
//                                    if($VCName == $dRow->gl_ad_coa_mc_id):
//                                        else:
//                                             $gl_ad_coa_mc_name =  $VCName->gl_ad_coa_mc_name.',';
//                                    endif;
//
//                            endforeach;
//                                else:
//
//                                 $vocDet = array(
//                                'gl_ad_atId'=>$dRow->gl_at_id,
//                                'gl_ad_credit '=>'');
//                            $VocDetail = $this->CRUDModel->get_where_result('gl_amount_details',$vocDet);
//
//                            foreach($VocDetail as $VCName):
//
//                                    if($VCName == $dRow->gl_ad_coa_mc_id):
//                                        else:
//
//                                        $gl_ad_coa_mc_name =  $VCName->gl_ad_coa_mc_name.',';
//
//                                     
//                                    endif;
//
//                            endforeach;
//                              endif;
//                              
//                        $result[] = array(
//                             'title'                =>  '',   
//                             'date'                 =>  date_format($date,"d-m-Y"),
//                             'vocher'               =>  $dRow->gl_at_vocher, 
//                             'gl_ad_coa_mc_name'    =>  $gl_ad_coa_mc_name,
//                             'gl_at_payeeId'        =>  $dRow->gl_at_description, 
//                            'gl_at_descr'          =>  $dRow->gl_at_payeeId, 
//                            'gl_at_cheque'         =>  $dRow->gl_at_cheque, 
//                             'gl_ad_depit'          =>  number_format($dRow->gl_ad_depit, 0, ',', ','),
//                             'gl_ad_credit'         =>  number_format($dRow->gl_ad_credit, 0, ',', ','),
//                             'total_depit'          =>  '',
//                             'total_credit'         =>  ''
//                                ); 
//                             
//                            $debit_total  +=$dRow->gl_ad_depit;
//                            $credit_total +=$dRow->gl_ad_credit;
//                             
//                            endforeach;
//                            
//                            $result[] =  array(
//                             'title'              => '',
//                             'vocher'            => '', 
//                             'gl_ad_coa_mc_name'  => '',
//                             'gl_ad_coa_mc_name'  =>   '', 
//                             'gl_at_cheque'      =>   '', 
//                             'gl_ad_depit'       =>   '',
//                             'gl_ad_credit'      =>   'Total',
//                             'total_depit'       =>  number_format($debit_total, 0, ',', ','),
//                             'total_credit'      =>   number_format($credit_total, 0, ',', ',')
//                            );
//                        
//                            
//                         
//                           
//                            
//                            
//                    endforeach;
// 
//
//            if(!empty($result)):
//                
//       
//            
//        foreach ($result as $row){
//               
//                $exceldata[] = $row;
//                
//        }
//        
//                    
//                // echo '<pre>';print_r($exceldata);die;
//                //Fill data 
//                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
//                $date = $this->data['dateFrom'].' To '.$this->data['toDate'];
//                $filename='General Ledger From '.$date.'.xls'; //save our workbook as this file name
//                header('Content-Type: application/vnd.ms-excel'); //mime type
//                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
//                header('Cache-Control: max-age=0'); //no cache
// 
//                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//                //if you want to save it as .XLSX Excel 2007 format
//                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//                //force user to download the Excel file without writing it to server's HD
//                $objWriter->save('php://output');
//                     endif;
//                    
//               
//                    
//                endif;
//            endif;
//        
//             $this->data['page']         = "Finance/reports/general_leader_dw_old";
//            $this->data['page_title']        = 'General Ledger Old | ECMS';
//            $this->load->view('common/common',$this->data);
//    }
//    
    public function print_general_ledger(){
                $dateFrom       = $this->uri->segment(3);
                $dateto         = $this->uri->segment(4);
                
                $recordFromCode = $this->uri->segment(5);
                $recordToCode   = $this->uri->segment(6);
        
                $this->data['dateFrom']        = $dateFrom;
                $this->data['dateTo']        = $dateto;
                
                
              $this->data['GeneralLeader']   =  $this->FinanceModel->get_leader_dw('gl_amount_details',$dateFrom,$dateto,$recordFromCode,$recordToCode);
             $this->data['page_title']        = 'Print Leaders | ECMS';
          
            
            $this->load->view('common/header');
            //$this->load->view('common/nav');
            $this->load->view('Finance/printLedger',$this->data);
            $this->load->view('common/footer');
             
    }
    public function trial_balance(){
        
        
            
            $this->data['fromDate']       = date('d-m-Y');
            $this->data['toDate']         = date('d-m-Y');
        
        if($this->input->post('export')):
            $date['fromDate']       = $this->input->post('dateFrom');
            $date['toDate']         = $this->input->post('todate');
            
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('OP Trial balance');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'CODE');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
//                
                $this->excel->getActiveSheet()->setCellValue('B1', 'COA');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);

                $this->excel->getActiveSheet()->setCellValue('C1', 'Debit');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('D1', 'Credit');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);
                 
               
                
               
                
      for($col = ord('A'); $col <= ord('C'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
            $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            //change the font size
           $this->excel->getActiveSheet()->getStyle('D')->getFont()->setSize(10);
           $this->excel->getActiveSheet()->getStyle('D')->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_NUMBER));
              
        
           $result = $this->FinanceModel->trial_balance_export($date);
 
            if(!empty($result)):
              
        foreach ($result as $row){
               
                $exceldata[] = $row;
                
        }
        
                           
                       
                // echo '<pre>';print_r($exceldata);die;
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $date = $date['fromDate'].' To '.$date['toDate'];
                $filename='Trail_balance From '.$date.'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
                     endif;
                     
                    
        endif;
         
        $this->data['page']         = 'Finance/OP/Reports/trial_balance';
        $this->data['page_title']   = 'OP Trial Balance | ECMS';
        $this->data['page_header']   = 'OP Trial Balance';
        $this->load->view('common/common',$this->data);
    }
    public function trial_balance_old(){
//        
//        $mac =  $this->get_mac();
//        echo $mac;die;
        
        if($this->input->post('export')):
             
            
                $date['fromDate']       = $this->input->post('dateFrom');
                $date['toDate']         = $this->input->post('todate');
            
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Trial balance');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'CODE');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);

                $this->excel->getActiveSheet()->setCellValue('B1', 'COA');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
              
               
                $this->excel->getActiveSheet()->setCellValue('C1', 'Debit');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('D1', 'Credit');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);
                 
               
                
               
                
       for($col = ord('A'); $col <= ord('D'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }


           $result = $this->FinanceModel->trial_balance_export($date);
 
            if(!empty($result)):
              
        foreach ($result as $row){
               
                $exceldata[] = $row;
                
        }
        
                           
                       
                // echo '<pre>';print_r($exceldata);die;
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $date = $date['fromDate'].' To '.$date['toDate'];
                $filename='Trail_balance From '.$date.'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
                     endif;
                     
                     die;
        endif;
        
        
        $this->data['page']         = 'Finance/trial_balance_old';
        $this->data['page_title']   = 'Trial Balance | ECMS';
        $this->load->view('common/common',$this->data);
    }
     public function trial_balance_detail_old(){
     
        
                $fromDate       = $this->input->post('dateFrom');
                $toDate         = $this->input->post('todate');
               
                $where = array(
                   'fn_coa_status'  =>1,
                   'fn_coa_trash'   =>1,
                   'fn_account_type_id'=>1
                );
                $class = array(
                    'info',
                    'success',
                    'danger',
                    'warning',
                    'active',
                    );
                    $trialBalance = $this->CRUDModel->get_where_result('fn_coa_parent',$where);
                   
                        echo '<div id="div_print"><div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive"> 
                                    <h3 class="has-divider text-highlight">Trial Balance From : '.date('d-m-Y', strtotime($fromDate)).' To : '.date('d-m-Y', strtotime($toDate)).'  </h3>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Account Code</th>
                                                    <th>COA Description</th>
                                                    <th>Debit</th>
                                                    <th>Credit</th>
                                                </tr>
                                            </thead><tbody>';
                                                if(!empty($trialBalance)):
                                                    $totalCredit = '';
                                                    $totalDebit = '';
                                               
                                                    foreach($trialBalance as $GLRow):
                                                         $k = array_rand($class); 
                                                        echo '<tr>
                                                                <th>'.$GLRow->fn_coa_code.'</th>
                                                                <th>'.$GLRow->fn_coa_title.'</th>
                                                                <th> </th>
                                                                <th> </th>
                                                            </tr>';
                                                             
                                                                $master_child = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_pId'=>$GLRow->fn_coaId,'fn_account_type_id'=>1));
                                                                $where_TB = '';
                                                            
                                                                foreach($master_child as $mcRow):
                                                                   
                                                                       
                                                                        echo '<tr>
                                                                                <td>'.$mcRow->fn_coa_m_code.'</td>
                                                                                <td> &nbsp; &nbsp; &nbsp; &nbsp;'.$mcRow->fn_coa_m_title.'</td>
                                                                                <td> </td>
                                                                                <td> </td>
                                                                            </tr>';
                                                                                $where_TB['fn_coa_mc_mId']      =$mcRow->fn_coa_m_cId;
                                                                                $where_TB['fn_coa_mc_status']   =1;
                                                                                $where_TB['fn_coa_mc_trash']    =1;
                                                                                $where_TB['fn_account_type_id']    =1;
                                                                                
                                                                                $master_child_sub = $this->FinanceModel->amount_transitionDetailsold($where_TB,$fromDate,$toDate);
//                                                                                  echo '<pre>';print_r($master_child_sub); 
                                                                                foreach($master_child_sub as $mscRow):
                                                                                    
                                                                                    $grandDebit     = '';
                                                                                    $grandCredit    = '';    
                                                                                    if(!empty($GLRow)):
                                                                                       if($GLRow->fn_coa_code == 200000):
                                                                                            $grandCredit = $mscRow->sumCredit-$mscRow->sumDebit;
                                                                                            $grandDebit     = '';
                                                                                     endif; 
                                                                                    endif;
                                                                                    if(!empty($GLRow)):
                                                                                        if($GLRow->fn_coa_code == 400000):
                                                                                            $grandCredit = $mscRow->sumCredit-$mscRow->sumDebit;
                                                                                             $grandDebit     = '';   
                                                                                     endif;
                                                                                    endif;
                                                                                    if(!empty($GLRow)):
                                                                                        if($GLRow->fn_coa_code == 300000):
                                                                                            $grandCredit    = '';
                                                                                            $grandDebit = $mscRow->sumDebit- $mscRow->sumCredit;
                                                                                            
                                                                                     endif;
                                                                                    endif;
                                                                                    if(!empty($GLRow)):
                                                                                        if($GLRow->fn_coa_code == 500000):
                                                                                            $grandCredit    = '';
                                                                                            $grandDebit = $mscRow->sumDebit- $mscRow->sumCredit;
                                                                                           
                                                                                     endif;
                                                                                    endif;
                                                                      
                                                                                     
                                                                                     echo '<tr class="'.$class[$k].'">
                                                                                                <td>'.$mscRow->fn_coa_mc_code.'</td>
                                                                                                <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;'.$mscRow->fn_coa_mc_title.'</td>
                                                                                                <td>';
                                                                                            
                                                                                     if(empty($grandDebit)):
                                                                                         $grandDebit = 0;
                                                                                     else:
                                                                                        echo number_format($grandDebit, 0, ',', ',');
                                                                                     endif;
                                                                                 
                                                                                        echo '</td>
                                                                                                <td>';
                                                                                          if(empty($grandCredit)):
                                                                                                $grandCredit = 0;
                                                                                          else:
                                                                                               echo number_format($grandCredit, 0, ',', ',');
                                                                                            endif; 
                                                                                       
                                                                                        echo '</td> </tr>';
                                                                                        $totalCredit +=$mscRow->sumCredit;
                                                                                        $totalDebit  +=$mscRow->sumDebit;

                                                                                endforeach;
                                                                
                                                                endforeach;
                                                                            
                                                        endforeach;
                                                        if($totalDebit):
                                                            echo '<tr>
                                                                <td></td>
                                                                <td>Total</td>
                                                                <td>'.number_format($totalDebit, 0, ',', ',').'</td>
                                                                <td>'.number_format($totalCredit, 0, ',', ',').'</td>
                                                                 
                                                            </tr>';
                                                        endif;
                                                         
                                                    endif;
                                                    
                                                echo '</tbody></table> '.$print_log.'
                                        </div>
                                    </div>
                                    </div>
                                   
                                </div>';
        
    }
    public function trial_balance_detail(){
     
        
                $fromDate       = $this->input->post('dateFrom');
                $toDate         = $this->input->post('todate');
               
                $where = array(
                   'fn_coa_status'  =>1,
                   'fn_coa_trash'   =>1, 
                   'fn_account_type_id'=>1
                );
                $class = array(
                    'info',
                    'success',
                    'danger',
                    'warning',
                    'active',
                    );
                    $trialBalance = $this->CRUDModel->get_where_result('fn_coa_parent',$where);
                   
                        echo '<div id="div_print"><div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive"> 
                                    <h3 class="has-divider text-highlight">Trial Balance From : '.date('d-m-Y', strtotime($fromDate)).' To : '.date('d-m-Y', strtotime($toDate)).'  </h3>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Account Code</th>
                                                    <th>COA Description</th>
                                                    <th>Debit</th>
                                                    <th>Credit</th>
                                                </tr>
                                            </thead><tbody>';
                                                if(!empty($trialBalance)):
                                                    $totalCredit = '';
                                                    $totalDebit = '';
                                               
                                                    foreach($trialBalance as $GLRow):
                                                         $k = array_rand($class); 
                                                        echo '<tr>
                                                                <th>'.$GLRow->fn_coa_code.'</th>
                                                                <th>'.$GLRow->fn_coa_title.'</th>
                                                                <th> </th>
                                                                <th> </th>
                                                            </tr>';
                                                             
                                                                $master_child = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_pId'=>$GLRow->fn_coaId,'fn_account_type_id'=>1));
                                                                $where_TB = '';
                                                            
                                                                foreach($master_child as $mcRow):
                                                                   
                                                                       
                                                                        echo '<tr>
                                                                                <td>'.$mcRow->fn_coa_m_code.'</td>
                                                                                <td> &nbsp; &nbsp; &nbsp; &nbsp;'.$mcRow->fn_coa_m_title.'</td>
                                                                                <td> </td>
                                                                                <td> </td>
                                                                            </tr>';
                                                                                $where_TB['fn_coa_mc_mId']      =$mcRow->fn_coa_m_cId;
                                                                                $where_TB['fn_coa_mc_status']   =1;
                                                                                $where_TB['fn_coa_mc_trash']    =1;
                                                                                $where_TB['gl_amount_transition.fn_account_type_id']    =1;
                                                                                $master_child_sub = $this->FinanceModel->amount_transitionDetails($where_TB,$fromDate,$toDate);
//                                                                                  echo '<pre>';print_r($master_child_sub); 
                                                                                foreach($master_child_sub as $mscRow):
                                                                                    
                                                                                    $grandDebit     = '';
                                                                                    $grandCredit    = '';    
                                                                                    if(!empty($GLRow)):
                                                                                      if($GLRow->fn_coa_code == 200000):
                                                                                            $grandCredit = $mscRow->sumCredit-$mscRow->sumDebit;
                                                                                            $grandDebit     = '';
                                                                                     endif;  
                                                                                    endif;
                                                                                    if(!empty($GLRow)):
                                                                                       if($GLRow->fn_coa_code == 400000):
                                                                                            $grandCredit = $mscRow->sumCredit-$mscRow->sumDebit;
                                                                                             $grandDebit     = '';   
                                                                                     endif; 
                                                                                    endif;
                                                                                    if(!empty($GLRow)):
                                                                                        if($GLRow->fn_coa_code == 300000):
                                                                                            $grandCredit    = '';
                                                                                            $grandDebit = $mscRow->sumDebit- $mscRow->sumCredit;
                                                                                            
                                                                                     endif;
                                                                                    endif;
                                                                                    if(!empty($GLRow)):
                                                                                        if($GLRow->fn_coa_code == 500000):
                                                                                            $grandCredit    = '';
                                                                                            $grandDebit = $mscRow->sumDebit- $mscRow->sumCredit;
                                                                                           
                                                                                     endif;
                                                                                    endif;
                                                                                     
                                                                                     echo '<tr class="'.$class[$k].'">
                                                                                                <td>'.$mscRow->fn_coa_mc_code.'</td>
                                                                                                <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;'.$mscRow->fn_coa_mc_title.'</td>
                                                                                                <td>';
                                                                                            
                                                                                     if(empty($grandDebit)):
                                                                                         $grandDebit = 0;
                                                                                     else:
                                                                                        echo number_format($grandDebit, 0, ',', ',');
                                                                                     endif;
                                                                                 
                                                                                        echo '</td>
                                                                                                <td>';
                                                                                          if(empty($grandCredit)):
                                                                                                $grandCredit = 0;
                                                                                          else:
                                                                                               echo number_format($grandCredit, 0, ',', ',');
                                                                                            endif; 
                                                                                       
                                                                                        echo '</td> </tr>';
                                                                                        $totalCredit +=$mscRow->sumCredit;
                                                                                        $totalDebit  +=$mscRow->sumDebit;

                                                                                endforeach;
                                                                
                                                                endforeach;
                                                                            
                                                        endforeach;
                                                        if($totalDebit):
                                                            echo '<tr>
                                                                <td></td>
                                                                <td>Total</td>
                                                                <td>'.number_format($totalDebit, 0, ',', ',').'</td>
                                                                <td>'.number_format($totalCredit, 0, ',', ',').'</td>
                                                                 
                                                            </tr>';
                                                        endif;
                                                         
                                                    endif;
                                                    
                                                echo '</tbody></table>
                                        </div>
                                    </div>
                                    </div> '.$this->data['print_log'].'
                                </div>';
 
        
    }

    public function gl_autocomplete(){
            //$term                       = trim(strip_tags($_GET['term']));
            $term                       = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
                $like                   = $term;
                $result_set             = $this->DropdownModel->autocomplete_amount('fn_coa_master_sub_child',$like,array('fn_account_type_id' => 1,));
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            'label'     =>$row_set->fn_coa_mc_title, 
                            'code'      =>$row_set->fn_coa_mc_code, 
                            'mc_id'     =>$row_set->fn_coa_mc_id, 
                            'value'     =>$row_set->fn_coa_mc_title 
                    );
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['value']     = $label['value'];
                    $label['code']      = $label['code'];
                    $label['mc_id']     = $label['mc_id'];
                    $label['label']     = $label['label']; 
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                $result_set             = $this->DropdownModel->autocomplete_amount('fn_coa_master_sub_child',$like,array('fn_account_type_id' => 1,));
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                         'label'        =>$row_set->fn_coa_mc_title, 
                        'code'          =>$row_set->fn_coa_mc_code, 
                        'mc_id'         =>$row_set->fn_coa_mc_id, 
                        'value'         =>$row_set->fn_coa_mc_title 
                    );
             }
            $matches                    = array();
            foreach($labels as $label){
                    $label['value']     = $label['value'];
                    $label['code']      = $label['code'];
                    $label['mc_id']     = $label['mc_id'];
                    $label['label']     = $label['label']; 
                    $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
    }
    }
    public function amount_transition_info(){
        
        $this->data['cb_jvId']        = ''; 
        $this->data['cb_jv']          = $this->CRUDModel->dropDown('fn_trm_type', '', 'ftt_id', 'ftt_title');
        
        $this->data['month']            = $this->CRUDModel->dropDownKey('month', '', 'mth_id', 'mth_title');
        $this->data['year']             = $this->CRUDModel->dropDownKey('year', '', 'yr_num', 'yr_title');
         
        $this->data['monthId']          =  date("m",strtotime(date('d-m-y')));
        $this->data['yearId']           =  date("Y",strtotime(date('d-m-Y'))); 
        $this->data['searchText']       = '';        
//           echo '<pre>';print_r($this->data);die;  
        
       
        if($this->input->post()):
            
         
        $cb_jvId        =  $this->input->post('cb_jv'); 
        $monthId        = $this->input->post('month');
        $yearId         = $this->input->post('year');
        $searchText     = $this->input->post('searchText');
        
         
        $where = '';
        if(!empty($cb_jvId)):
             $where['gl_at_cb_jv']  =  $cb_jvId;  
             $this->data['cb_jvId']  =  $cb_jvId;  
        endif;
       
        if(!empty($monthId)):
             $where['month(gl_at_date)']    =  $monthId;  
             $this->data['monthId']         =  $monthId;  
        endif;
       
        if(!empty($yearId)):
             $where['year(gl_at_date)']     =  $yearId;  
             $this->data['yearId']         =  $yearId;  
        endif;
        
 
        if(!empty($searchText)):
              $this->data['searchText']             = $searchText;
              $where = '';
        endif;
       
  
        $this->data['total_rows'] = count($this->FinanceModel->amount_transition_search($where, $searchText));       
        $this->data['AMI']          = $this->FinanceModel->amount_transition_search($where,$searchText); 
   
          
            $this->data['page']         = 'Finance/amount_trans_info';
            $this->data['page_title']   = 'Amount Transition Info | ECMS';
            $this->load->view('common/common',$this->data);
        else:
            
            $order = array('column'     =>'gl_at_vocher','order'=>'asc');
            $config['base_url']         = base_url('AmountTransReport');
            $config['total_rows']       = count($this->CRUDModel->getResults('gl_amount_transition'));  //echo $config['total_rows']; exit;
            $config['per_page']         = 20;
            $config["num_links"]        = 3;
            $config['uri_segment']      = 2;
            $config['full_tag_open']    = "<ul class='pagination'>";
            $config['full_tag_close']   = "</ul>";
            $config['num_tag_open']     = '<li>';
            $config['num_tag_close']    = '</li>';
            $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='javascript:vodid(0)'>";
            $config['cur_tag_close']    = "</a></li>";
            $config['next_tag_open']    = "<li>";
            $config['next_tag_close']   = "</li>";
            $config['prev_tag_open']    = "<li>";
            $config['prev_tag_close']   = "</li>";
            $config['first_tag_open']   = "<li>";
            $config['first_tag_close']  = "</li>";
            $config['last_tag_open']    = "<li>";
            $config['last_tag_close']   = "</li>";
            $config['first_link']       = "<i class='fa fa-angle-double-left'></i>";
            $config['last_link']        = "<i class='fa fa-angle-double-right'></i>";


            $this->pagination->initialize($config);
            $page                       = is_numeric($this->uri->segment(2)) ? $this->uri->segment(2) :  0;
            $this->data['links']        = $this->pagination->create_links();
        
            $this->data['total_rows']   = $config['total_rows'];
            $this->data['AMI']          = $this->CRUDModel->pagination('gl_amount_transition',$config['per_page'], $page,'',$order);
         
              
            $this->data['page']         = 'Finance/amount_trans_info';
            $this->data['page_title']   = 'Amount Transition Info | ECMS';
            $this->load->view('common/common',$this->data);
        endif;
 
            
           
            
          
        
        
    }
    public function delte_ammount_transition_info(){
       $deletId = $this->uri->segment(2);
       
       
       $amountDetail = $this->CRUDModel->get_where_result('gl_amount_details',array('gl_ad_atId'=>$deletId));
       
       //echo '<pre>';print_r($amountDetail);die;
       
       foreach($amountDetail as $delDe):
//          echo '<pre>';print_r($delDe);

            $this->CRUDModel->deleteid('gl_amount_details',array('gl_ad_id'=>$delDe->gl_ad_id)); 
       endforeach;
       
       
        $this->CRUDModel->deleteid('gl_amount_transition',array('gl_at_id'=>$deletId)); 
        
        redirect('AmountTransReport');
       
    }
    public function transition_PaymentDetails(){
        
        $amdId = $this->input->post('amd');
        
        $where = array('gl_ad_atId'=>$amdId);
        
        
                     $this->db->where($where);
                     $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');
         $details  = $this->db->get('gl_amount_details ')->result();   
//        $details = $this->CRUDModel->get_where_result('gl_amount_details',$where);
        
        
        echo ' 
            <table class="table table-boxed table-hover" id="table">
              <thead>
                <tr>
                   <th>#</th>
                    <th>Date</th>
                    <th>COA Description</th>
                    <th>Debit</th>
                    <th>Credit</th>
                   
                </tr>
              </thead>
              <tbody>';
                $sn = '';
                $TotalDebit = '';
                $TotalCredit = '';
                foreach($details as $dRow):
                    $sn++;
                
                    echo ' <tr>
                    <th>'.$sn.'</th>
                    <th>'.date('d-M-Y',strtotime($dRow->gl_ad_date)).'</th>
                     
                    <th>'.$dRow->fn_coa_mc_title.'</th>
                    <th>'.number_format($dRow->gl_ad_depit, 0, ',', ',').'</th>
                    <th>'.number_format($dRow->gl_ad_credit, 0, ',', ',').'</th>
                   
                </tr>';
                   $TotalDebit  +=  $dRow->gl_ad_depit;  
                   $TotalCredit +=  $dRow->gl_ad_credit;  
                endforeach;  
                  
                 if(!empty($TotalDebit )):
                      echo '<tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>'.number_format($TotalDebit, 0, ',', ',').'</th>
                        <th>'.number_format($TotalCredit, 0, ',', ',').'</th>
                
                    </tr>';
                 endif;
               
                
                
                
              echo '</tbody>
            </table>';
        
        
        
        
    }
    public function transition_details_search(){
        
        $this->data['dateFrom']        = date('d-m-Y');
        $this->data['dateTo']          = date('d-m-Y');
        $this->data['recordFrom']      = '';
        $this->data['recordFromCode']  = '';
        $this->data['recordFromCode']  = '';
        $this->data['payeeId']  = '';
        $this->data['amount']  = '';
        
        if($this->input->post()):
//            echo '<pre>';print_r($this->input->post());die;
            $dateFrom       = $this->input->post('dateFrom');
            $dateto         = $this->input->post('dateto');
            $recordFrom     = $this->input->post('recordFrom');
            $recordFromCode = $this->input->post('recordFromCode');
            $payeeId        = $this->input->post('payeeId');
            $Supplier       = $this->input->post('Supplier');
            $amount       = $this->input->post('amount');
            
         
          
            $where      =  '';
            $date       = '';
            $like       = '';
            $amounta    = '';
            
            if($dateFrom):
                 $date['dateform']      = $dateFrom;
                $this->data['dateFrom'] = date('d-m-Y', strtotime($dateFrom));
            endif;
            
            
            if($dateto):
                $date['dateto'] = $dateto;
               $this->data['dateTo'] = date('d-m-Y', strtotime($dateto));
                 
            endif;
           
            if($recordFromCode):
                $where['gl_ad_coa_mc_pk']    = $recordFromCode;
                $this->data['recordFrom']    = $recordFrom;
                $this->data['recordFromCode']   = $recordFromCode;
                
            endif;
           
            if($amount):
                 $amounta   = $amount;
                 $this->data['amount']      = $amount; 
            endif;
            
            if($payeeId):
                $like['gl_at_payeeId']      = $payeeId;
                $this->data['payeeId']      = $payeeId; 
            endif;
            $this->data['result'] =$this->FinanceModel->get_detail_search($where,$date,$like,$amounta);
 
        endif;
        
        
        $this->data['page']         = 'Finance/amount_trans_search';
        $this->data['page_header']   = 'Transition Detail Search';
        $this->data['page_title']   = 'Amount Transition Info | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function student_defaulter_noties_new(){
         
        $this->data['dateFrom']        = date('d-m-Y');
        $this->data['collegeNo']        = '';
          
        if($this->input->post('search')):
            $title = $this->CRUDModel->get_where_row('student_dairy',array('status'=>1));
            
            $collegeno                  = $this->input->post('collegeNo');
            $this->data['collegeNo']    = $collegeno;
            $where= array(
                    'college_no'            => $collegeno,
                    's_status_id'           => 5,
                );
          $this->data['result'] =   $this->FinanceModel->student_dnoties_search('student_record',$where);
          endif;
    
        if($this->input->post('save')):

            $stdId          = $this->input->post('stdId');
            $collegeno      = $this->input->post('collegeNo');
            $stdAddress     = $this->input->post('stdAddress');
            $mobiel1        = $this->input->post('mobiel1');
            $mobiel2        = $this->input->post('mobiel2');
           
            //Update studetn table
            $datastd = array(
                    'app_postal_address'    => $stdAddress,
                    'mobile_no'             => $mobiel1,
                    'mobile_no2'            => $mobiel2
                );
            $whereUpdate = array( 'student_id'=>$stdId);
            $this->CRUDModel->update('student_record',$datastd,$whereUpdate);
            
            //Insert to student_denotice
            $dairyId        = $this->input->post('dairyId');
            $amount         = $this->input->post('amount');
            $dairyCount     = $this->input->post('dairyCount');
            $pdate          = date('Y-m-d', strtotime($this->input->post('pdate')));
            $ldate          = date('Y-m-d', strtotime($this->input->post('ddate'))); 
           
              
                $title = $this->CRUDModel->get_where_row('student_dairy',array('status'=>1));
                    $dairyNo = '';
                        $diaryCount  =   $this->CRUDModel->get_max_value('count','student_denotice',array('sd_id'=>$title->sd_id));
//                         echo $diaryCount->count;die;
                    if(!empty($diaryCount)):
                        $dairyNo  = $diaryCount->count+1;
                    else:
                        $dairyNo = 1;
                    endif;

                
                $dataInsert = array(
                'student_id'    => $stdId,
                'sd_id'         => $dairyId,
                'amount'        => $amount,
                'count'         => $dairyNo,
                'print_date'    => $pdate,
                'due_date'      => $ldate,
                'timestamp'     => date('Y-m-d H:i:s'),
                'userId'        => $this->userInfo->user_id,
                );
                
          $dnoticeId =  $this->CRUDModel->insert('student_denotice',$dataInsert);
          redirect('PrintDeNoties/'.$dnoticeId,'refresh');
        endif;
       
        $this->data['page']         = 'Finance/Defaulter_Notice/student_d_noties_new';
        $this->data['page_header']  = 'Student Defaulter Noties New';
        $this->data['page_title']   = 'Student Defaulter Noties New| ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function print_defaulter_notice(){
        
        $where= array(
                    'student_denotice.dn_id'            => $this->uri->segment(2),
                    's_status_id'                   => 5,
                );
        $this->data['result'] =   $this->FinanceModel->student_dnoties_search('student_record',$where);
        $this->data['page']         = 'Finance/Defaulter_Notice/student_d_noties_print';
        $this->data['page_header']  = 'Student Defaulter Noties New';
        $this->data['page_title']   = 'Student Defaulter Noties New| ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function student_defaulter_noties_update(){
         
            $title = $this->CRUDModel->get_where_row('student_dairy',array('status'=>1));
            $collegeno                  = $this->input->post('collegeNo');
            $this->data['collegeNo']    = $collegeno;
            $where= array(
                'student_denotice.dn_id'            => $this->uri->segment(2),
                's_status_id'           => 5,

                );
          $this->data['result'] =   $this->FinanceModel->student_dnoties('student_record',$where);
 
         
    
        if($this->input->post('update')):

            $stdId          = $this->input->post('stdId');
            $collegeno      = $this->input->post('collegeNo');
            $stdAddress     = $this->input->post('stdAddress');
            $mobiel1        = $this->input->post('mobiel1');
            $mobiel2        = $this->input->post('mobiel2');
           
            //Update studetn table
            $datastd = array(
                    'app_postal_address'    => $stdAddress,
                    'mobile_no'             => $mobiel1,
                    'mobile_no2'            => $mobiel2
                );
            $whereUpdate = array( 'student_id'=>$stdId);
            $this->CRUDModel->update('student_record',$datastd,$whereUpdate);
            
            //Insert to student_denotice
            $dairyId        = $this->input->post('dairyId');
            $amount         = $this->input->post('amount');
            $dairyCount     = $this->input->post('dairyCount');
            $pdate          = date('Y-m-d', strtotime($this->input->post('pdate')));
            $ldate          = date('Y-m-d', strtotime($this->input->post('ddate'))); 
           
           $check = $this->CRUDModel->get_where_row('student_denotice',array('student_id'=> $stdId,'sd_id'=> $dairyId));
            
            if(!empty($check)):
                $dataUp = array(
                'student_id'    => $stdId,
                'sd_id'         => $dairyId,
                'amount'        => $amount,
                'count'         => $dairyCount,
                'print_date'    => $pdate,
                'due_date'      => $ldate,
                'timestamp'     => date('Y-m-d H:i:s'),
                'userId'        => $this->userInfo->user_id,
                );
            
            $whereUpdate = array( 'dn_id'=>$this->uri->segment(2));
            $this->CRUDModel->update('student_denotice',$dataUp,$whereUpdate);
            
               redirect('PrintDeNoties/'.$this->uri->segment(2),'refresh'); 
           
            endif;
           
        endif;
       
        $this->data['page']         = 'Finance/Defaulter_Notice/student_d_noties_update';
        $this->data['page_header']  = 'Student Defaulter Noties Edit';
        $this->data['page_title']   = 'Student Defaulter Noties Edit | ECMS';
        $this->load->view('common/common',$this->data);
    }
     public function fee_defaulter_forum(){
        
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']          = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['student_status']   = $this->CRUDModel->dropDown('student_status', 'Student Status', 's_status_id', 'name');
        $this->data['gender']           = $this->CRUDModel->dropDown('gender', 'Challan Status', 'gender_id', 'title');
        $this->data['batch_name']       = $this->CRUDModel->dropDown('prospectus_batch', 'Batch Name', 'batch_id', 'batch_name');
        $this->data['report_type']      = $this->CRUDModel->dropDown('fee_defaulter_type', '', 'id', 'title');
         
        
        $this->data['collegeNo']        = '';
        $this->data['gender_id']        = '';
        $this->data['batch_id']         = '';
        $this->data['fatherName']       = '';
        $this->data['stdName']          = '';
        $this->data['programe_id']      = '';
        $this->data['sec_id']           = '';
        $this->data['sub_pro_id']       = '';
        $this->data['student_status_id']= '';
        $this->data['form_no']          = '';
        $this->data['challan_no']       = '';
        $this->data['amount']           = 0;
        $this->data['rType_id']         = '';
        $this->data['dueDateFrom']      = '';
        $this->data['dueDateTo']        = date("d-m-Y");
        
        
        if($this->input->post()):
//            $this->load->model('FeeModel');
            
            $collegeNo      = $this->input->post("collegeNo");
            $challan_no      = $this->input->post("challan_no");
            $form_no        = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $pc_id          = $this->input->post("pc_id");
            $batch_id       = $this->input->post("batch_id");
            $std_status     = $this->input->post("std_status");
            $gender         = $this->input->post("gender");
            $from           = $this->input->post("from");
            $amount         = $this->input->post("amount");
            
            $reprot_type_name    = $this->input->post("reprot_type_name");
 
        
            
            if($reprot_type_name):
                $this->data['rType_id']   = $reprot_type_name;
            endif;
            

            $where          = '';
            $whereAmount    = '';
            $like           = '';
//            $where['student_record.college_no'] = '16481';
            
            if($batch_id):
                $where['student_record.batch_id']   = $batch_id;
                $this->data['batch_id']             = $batch_id;
            endif;
            if($gender):
                $where['student_record.gender_id'] = $gender;
                $this->data['gender_id'] = $gender;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
            if($challan_no):
                $where['fee_challan.fc_challan_id'] = $challan_no;
                $this->data['challan_no'] = $challan_no;
            endif;
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['collegeNo'] = $collegeNo;
            endif;
            if($std_status):
                $where['student_record.s_status_id']    = $std_status;
                $this->data['student_status_id']        = $std_status;
            endif;
            
            if(!empty($stdName)):
                $like['student_record.student_name'] = $stdName;
                $this->data['stdName']           = $stdName;
            endif;
            if(!empty($fatherName)):
                $like['student_record.father_name'] = $fatherName;
                $this->data['fatherName']           = $fatherName;
            endif;
            
            if(!empty($pc_id)):
                $like['fee_challan.fc_pay_cat_id'] = $pc_id;
                $this->data['pc_id']           = $pc_id;
            endif;
            
            if($programe_id):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id'] = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
            $this->data['result'] = $this->FinanceModel->full_defaulter_notice_report_search($where,$like);
            
            
        endif;
        
        $this->data['page']         = 'Finance/fee_defaulter_notice_forum';
        $this->data['page_header']  = 'Fee D-Notice ';
        $this->data['page_title']   = 'Fee D-Notice | ECMS';
        $this->load->view('common/common',$this->data);
    }
     
    public function print_vouchers(){
        
        $voucher_id = $this->uri->segment(2);
        $where = array(
            'gl_at_id'=>$voucher_id
        );
        $this->data['voucher_info']         = $this->FinanceModel->voucher_info($where);
//        echo '<pre>';print_r($this->data['voucher_info']);die;
        //attachment details
        $where_att = array(
            'amount_tra_id'=>$voucher_id
        );
        $this->data['attachment_details']   = $this->FinanceModel->attach_details($where_att);
        
        //Chart of account Info 
        $where_chart_of_acct = array(
            'gl_ad_atId'=>$voucher_id
        );
        
     
        $order['column']  = 'trns_ab_appr_order';
        $order['order']   = 'asc';
        $this->data['approval']         = $this->CRUDModel->get_where_result_order('gl_at_aprove_by',array('trns_ab_status'=>1,'trns_ab_amount_trans_id'=>$voucher_id,'trns_ab_account_type_id'=> 1),$order); 
        
        
        
//        echo '<pre>';print_r($this->data['approval']);die;
        $this->data['chart_of_acct']    = $this->FinanceModel->chart_of_acct($where_chart_of_acct);
        $this->data['page']             = "Finance/OP/print/op_print_vochers";
        $this->data['page_title']            = 'OP Vocher| ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function finance_supplier(){
        if($this->input->post()):
            
             
            //Insert Code 
            $company_name      = $this->input->post('company_name');
            $cnic               = $this->input->post('cnic');
            $proper_name       = $this->input->post('proper_name');
            $businerss_name    = $this->input->post('businerss_name');
            $address           = $this->input->post('address');
            $phone_no          = $this->input->post('phone_no');
            $ntn               = $this->input->post('ntn');
            $sale_tax          = $this->input->post('sale_tax');
            $supp_id           = $this->input->post('supp_id');
            $time_stamp        =  date('Y-m-d H:i:s');
         
        

         if($supp_id):

             $data = array(
             'company_name'         =>$company_name,
             'propertier_name'      =>$proper_name,
             'cnic'                 =>$cnic,
             'business_details'     =>$businerss_name,
             'address'              =>$address,
             'phone_no'             =>$phone_no,
             'fn_account_type_id'   => 1,
             'ntn'                  =>$ntn,
             'sale_tax_no'          =>$sale_tax,
             'up_user_id'           =>$this->userInfo->user_id,
             'up_timestamp'         =>$time_stamp,
            
             
             );

             $where = array('fn_supp_id'=>$supp_id);
             $this->CRUDModel->update('fn_supplier',$data,$where);
             redirect('FnSupplier');
             else:
                 $data = array(
                    'company_name'         =>$company_name,
                    'propertier_name'      =>$proper_name,
                    'business_details'    =>$businerss_name,
                    'address'              =>$address,
                    'phone_no'             =>$phone_no,
                    'fn_account_type_id'   => 1, 
                    'ntn'                  =>$ntn,
                    'sale_tax_no'          =>$sale_tax,
                    'user_id'              =>$this->userInfo->user_id,
                    'timestamp'            =>$time_stamp,
                    );
                $this->CRUDModel->insert('fn_supplier',$data);
                 redirect('FnSupplier');
             endif;

        endif;

        $id = $this->uri->segment(2);
        if($id):
            $this->data['supp_row']    = $this->CRUDModel->get_where_row('fn_supplier',array('fn_supp_id'=>$id));
        endif;
                                          $this->db->join('fn_account_types','fn_account_types.id=fn_supplier.fn_account_type_id');  
                                          $this->db->order_by('fn_supp_id','desc');
        $this->data['FnSupplier']       = $this->db->get_where('fn_supplier',array('fn_account_type_id'=>1))->result();
//        echo '<pre>';print_r($this->data['FnSupplier']);die;
        $this->data['page']             = "Finance/OP/Setups/op_finance_supplier";
        $this->data['page_title']       = 'OP Finance Supplier| ECMS';
        $this->data['page_header']      = 'OP Finance Supplier';
        $this->load->view('common/common',$this->data);
    }
     public function finance_supplier_delete(){
       $deletId = $this->uri->segment(2);
       $this->CRUDModel->deleteid('fn_supplier',array('fn_supp_id'=>$deletId));
        redirect('Admin/admin_home');
   } 
    public function financial_year(){
        
        if($this->input->post()):
        $userInfo      = $this->getUser();
             
         //Insert Code 
        $year           = $this->input->post('year');
        $start          = $this->input->post('start');
        $end            = $this->input->post('end');
        $coa_status     = $this->input->post('coa_status');
        $fy_id          = $this->input->post('fy_id');
        $time_stamp     = date('Y-m-d H:i:s');
         
        

         if($fy_id):

             $data = array(
             'year'             => $year,
             'status'           => $coa_status,
             'year_start'       => date('Y-m-d', strtotime($start)),
             'year_end'         => date('Y-m-d', strtotime($end)),
             'up_user_id'       => $this->userInfo->user_id,
             'up_timestamp'     => $time_stamp,
            
             );
         
             $whereAc = array(
                 'status'               => 1, 
                 'fn_account_type_id'   => 1, 
                 'id !='                => $fy_id 
             );
             $active = $this->CRUDModel->get_where_row('financial_year',$whereAc);
             if($active):
                 $this->session->set_flashdata('financial_year', 'Allowed only 1 Active Year');
                 else:
                    $where = array('id'=>$fy_id);
                    $this->CRUDModel->update('financial_year',$data,$where);
                    redirect('FnYear');
             endif;
             
             
             else:
                 $data = array(
                    'year'          =>$year,
                    'year_start'    =>date('Y-m-d', strtotime($start)),
                    'year_end'      =>date('Y-m-d', strtotime($end)),
                    'user_id'       =>$this->userInfo->user_id,
                    'timestamp'     =>$time_stamp,
                    'fn_account_type_id' =>1,
                    );
                $this->CRUDModel->insert('financial_year',$data);
                 redirect('FnYear');
             endif;

        endif;

        $id = $this->uri->segment(2);
        if($id):
            $this->data['update_row']    = $this->CRUDModel->get_where_row('financial_year',array('id'=>$id));
        endif;                          $this->db->select('fn_account_types.title,financial_year.*');
                                        $this->db->join('fn_account_types','fn_account_types.id=financial_year.fn_account_type_id');    
        $this->data['fnYear']       =   $this->db->get_where('financial_year',array('fn_account_type_id'=>1))->result();
        $this->data['page']             = "Finance/OP/Setups/op_financial_year";
        $this->data['page_heading']     = "OP Finincial Year";
        $this->data['page_title']       = 'Finincial Year | ECMS';
        $this->load->view('common/common',$this->data);
    }
   
     public function financial_year_delete(){
       $deletId = $this->uri->segment(2);
       $this->CRUDModel->deleteid('financial_year',array('id'=>$deletId));
        redirect('FnYear');
   } 
   
   
   public function finance_employee_auto(){
       
//        $term = trim(strip_tags($_GET['term']));
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
                $like           = $term;
                $result_set     = $this->FinanceModel->finance_employee($like);
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            'label'     =>$row_set->emp_name.'('.$row_set->title.')', 
                            'code'     =>$row_set->emp_id, 
                            'value'     =>$row_set->emp_name.'('.$row_set->title.')', 
                            'name'     =>$row_set->emp_name, 
                             
                    );
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['value']     = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                    $label['name']      = $label['name']; 
                    
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                $result_set             = $this->FinanceModel->finance_employee($like);
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                         'label'     =>$row_set->emp_name.'('.$row_set->title.')', 
                        'code'     =>$row_set->emp_id, 
                        'value'     =>$row_set->emp_name, 
                        'name'     =>$row_set->emp_name, 
                        
                    );
             }
            $matches                = array();
            foreach($labels as $label){
                     $label['value']    = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                    $label['name']     = $label['name']; 
                      
                    $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
   }
   public function finance_supplier_auto(){
       
//        $term = trim(strip_tags($_GET['term']));
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
                $like           = $term;
                $result_set     = $this->FinanceModel-> finance_supplier_auto($like);
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            'label'     =>$row_set->company_name.'('.$row_set->propertier_name.')', 
                            'code'     =>$row_set->fn_supp_id, 
                            'name'     =>$row_set->propertier_name, 
                            'value'     =>$row_set->company_name, 
                             
                    );
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['value']     = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                    $label['name']     = $label['name']; 
                    
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                $result_set             = $this->FinanceModel->finance_supplier_auto($like);
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                        'label'     =>$row_set->company_name, 
                        'code'     =>$row_set->fn_supp_id, 
                        'value'     =>$row_set->company_name, 
                        'name'     =>$row_set->propertier_name, 
                        
                    );
             }
            $matches                = array();
            foreach($labels as $label){
                     $label['value']    = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                     $label['name']     = $label['name'];  
                    $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
   }

    public function financial_year_budget(){
         $this->data['COAP'] =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1,'fn_account_type_id'=>1));
         $this->data['financialYear']    = $this->CRUDModel->dropDown('financial_year','', 'id', 'year',array('status'=>1,'fn_account_type_id'=>1));  
       
        $this->data['fnYearBduget']     = $this->FinanceModel->get_financial_budget('fn_year_budget',array('financial_year.status'=>1,'fn_year_budget.fn_account_type_id'=>1));
        
        if($this->input->post()):
            $formCode = $this->input->post('formCode');
            $where = array(
                'formCode'=>$formCode
                
            );
            $save_resut = $this->CRUDModel->get_where_result('fn_year_budget_demo',$where);
//            $userInfo      = $this->getUser();
            foreach($save_resut as $row):
            $data = array(
              'fy_id'           => $row->fy_id,
              'coa_id'          => $row->coa_id,
              'budget'          => $row->budget,
              'comments'        => $row->comments,
              'fn_account_type_id'=>1,
              'user_id'         => $this->userInfo->user_id,
              'timestamp'       => date('Y-m-d H:i:s'),
          );
        
        $this->CRUDModel->insert('fn_year_budget',$data);
            
        
        endforeach;
          $this->CRUDModel->deleteid('fn_year_budget_demo',array('formCode'=>$formCode));
          redirect('FyBudget');
        endif;
        
        $this->data['page']             = "Finance/OP/Setups/op_financial_year_budget";
        $this->data['page_header']      = "OP Finincial Year Budget";
        $this->data['page_title']       = 'Finincial Year Budget | ECMS';
        $this->load->view('common/common',$this->data);
    }
      public function finance_budget_add(){
       
          $fy_year      = $this->input->post('fy_year');
          $code_id      = $this->input->post('code_id');
          $budget       = $this->input->post('budget');
          $comments     = $this->input->post('comments');
          $formCode     = $this->input->post('formCode');
//        $userInfo      = $this->getUser();
          
        
       
        $fincial_year_info      = $this->CRUDModel->get_where_row('financial_year',array('id'=>$fy_year)); 
        $budget_check           = $this->CRUDModel->get_where_row('fn_year_budget',array('fy_id'=>$fincial_year_info->id,'fn_account_type_id'=>$fincial_year_info->fn_account_type_id,'coa_id'=>$code_id));
        $budget_check_demo      = $this->CRUDModel->get_where_row('fn_year_budget_demo',array('fy_id'=>$fy_year,'coa_id'=>$code_id,'formCode'=>$formCode));
//        echo '<pre>';print_r($budget_check);die;
         
        $data = array(
              'fy_id'=>$fy_year,
              'coa_id'=>$code_id,
              'budget'=>$budget,
              'comments'=>$comments,
              'formCode'=>$formCode,
              'user_id'=>$this->userInfo->user_id,
              'timestamp'=>date('Y-m-d H:i:s'),
          );
        $msg = '';
        if(empty($budget_check) && empty($budget_check_demo)):
                $msg = '';
                $this->CRUDModel->insert('fn_year_budget_demo',$data);
            else:
                $msg = 'Account Head Already Exist';
        endif;
        
       
        $where = array(
           'formCode'                       => $formCode,
           'fn_year_budget_demo.user_id'    => $this->userInfo->user_id,
        );
        $result = $this->FinanceModel->get_financial_budget('fn_year_budget_demo',$where);
        
            echo '<table id="testing123" cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%"><thead>';
            if($msg):
                echo '<tr>
                            <th  colspan="5"class="hidden-sm">'.$msg.'</th>
                    </tr>';
            endif;
                    
                     echo '   <tr>
                            <th class="hidden-sm">COA CODE</th>
                            <th>Account</th>
                            <th>Year</th>
                            <th>Budget</th>
                             
                            <th><i class="icon-trash" style="color:#fff"></i><b> ddDelete</b></th>
                        </tr>
                    </thead>
                    <tbody>';
            
             
  
                        foreach($result as $row):
                            
                            echo '<tr id="'.$row->id.'Delete">
                            
                            <td>'.$row->fn_coa_mc_code.'</td>
                            <td>'.$row->fn_coa_mc_title.'</td>
                            <td>'.$row->year.'</td>
                            <td>'.$row->budget.'</td>
                            
                            <td><a href="javascript:void(0)" id="'.$row->id.'" class="deleteTra"><i class="fa fa-trash"></i></a></td>
                            </tr>';
                    
                        endforeach;
                    echo '
                         
                    </tbody>
                </table>';
                    
                     ?>
                
                        <script>
                        jQuery(document).ready(function(){
                          
                             
                          
                             jQuery('.deleteTra').on('click',function(){
                             var deletId = this.id;
                            
                             jQuery.ajax({
                                 type:'post',
                                 url : 'FinanceController/fy_budget_delete',
                                 data: {'deletId':deletId},
                                 success : function(result){
                                    var del = deletId+'Delete';
                                    jQuery('#'+del).hide(); 
 

                                 }
                             });
                        
                         });
                         

                        });

                        </script><?php
        
        
    }
           
   public function fy_budget_delete(){
       $id  = $this->input->post('deletId');
       $this->CRUDModel->deleteid('fn_year_budget_demo',array('id'=>$id));
   }
     public function finance_voucher_search_with_print(){
        $this->data['voucher_status']   = $this->CRUDModel->dropDown('fn_vocher_status','Voucher Status', 'id', 'status_title',array('status'=>1)); 
        $this->data['from_date']        = date('d-m-Y');
        $this->data['to_date']          = date('d-m-Y');
        $this->data['pfrom_date']       = '';
        $this->data['pto_date']         = '';
        $this->data['voucehr_no']       = '';
        $this->data['process_no']       = '';
        $this->data['Payee']            = '';
        $this->data['desc']             = '';
        $this->data['amount']            = '';
        $this->data['statusid']         = '';
        
        $where = array(
          'vocher_status'       =>1,  
          'fn_account_type_id'  =>1  
        );
        $this->data['result'] =$this->FinanceModel->search_date_range_limit($where);
        
        if($this->input->post('search')):
           
            $from_date                  = $this->input->post('from_date');
            $to_date                    = $this->input->post('to_date');
            $process_no                 = $this->input->post('process_no');
            $voucher_id                 = $this->input->post('voucher_id');
            $Payee                      = $this->input->post('payee');
            $payfrom_date               = $this->input->post('payfrom_date');
            $payto_date                 = $this->input->post('payto_date');
            
            
            
            $desc                       = $this->input->post('desc');
            $amount                     = $this->input->post('amount');
            $vocher_status              = $this->input->post('voucher_status');
            
            $where=  '';
            $where['fn_account_type_id']=  '1';
            $processdate                =  '';
            $payDate                    =  '';
            $like                       =  '';
             $deposit_amount            = '';
            
             
            if($from_date):
                $processdate['from_date']   = $from_date;
                $this->data['from_date']    = $from_date;  
            endif;
            if($to_date):
                $processdate['to_date']     = $to_date;
                $this->data['to_date']      = $to_date;  
            endif;
             if($process_no):
                $where['gl_at_id']          = $process_no;
                $this->data['process_no']   = $process_no;  
            endif;           
            if($voucher_id):
                $where['gl_at_vocher']      = $voucher_id;
                $this->data['voucehr_no']   = $voucher_id;  
            endif;
            if($Payee):
                $like['gl_at_payeeId']      = $Payee;
                $this->data['Payee']        = $Payee;  
            endif;            
            
            if($payfrom_date):
                $payDate['pfrom_date']         = $payfrom_date;
                $this->data['pfrom_date']    = $payfrom_date;  
            endif;
            if($payto_date):
                $payDate['pto_date']            = $payto_date;
                $this->data['pto_date']      = $payto_date;  
            endif;
            if($amount):
                $deposit_amount         = $amount;
                $this->data['amount']   = $amount;  
            endif;
            if($vocher_status):
                $where['vocher_status']     = $vocher_status;
                $this->data['statusid']     = $vocher_status;  
            endif;

            if($desc):
                $like['gl_at_description']  = $desc;
                $this->data['desc']         = $desc;  
            endif;
 
            $this->data['result'] =$this->FinanceModel->search_date_range($where,$processdate,$like,$payDate,$deposit_amount);
 endif;
        
        
        $this->data['page']             = 'Finance/OP/Search/op_search_voucher_cheque_print';
        $this->data['page_header']      = 'OP Finance Voucher Search ';
        $this->data['page_title']       = 'OP Finance Voucher Search | ECMS';
        $this->load->view('common/common',$this->data);
    }
       public function finance_voucher_search(){
        $this->data['voucher_status']   = $this->CRUDModel->dropDown('fn_vocher_status','Voucher Status', 'id', 'status_title',array('status'=>1)); 
        $this->data['from_date']        = date('d-m-Y');
        $this->data['to_date']          = date('d-m-Y');
        $this->data['pfrom_date']       = '';
        $this->data['pto_date']         = '';
        $this->data['voucehr_no']       = '';
        $this->data['process_no']       = '';
        $this->data['Payee']            = '';
        $this->data['desc']             = '';
        $this->data['amount']            = '';
        $this->data['statusid']         = '';
        
        $where = array(
          'vocher_status'       =>1,  
          'fn_account_type_id'  =>1  
        );
        $this->data['result'] =$this->FinanceModel->search_date_range_limit($where);
        
        if($this->input->post('search')):
           
            $from_date                  = $this->input->post('from_date');
            $to_date                    = $this->input->post('to_date');
            $process_no                 = $this->input->post('process_no');
            $voucher_id                 = $this->input->post('voucher_id');
            $Payee                      = $this->input->post('payee');
            $payfrom_date               = $this->input->post('payfrom_date');
            $payto_date                 = $this->input->post('payto_date');
            
            
            
            $desc                       = $this->input->post('desc');
            $amount                     = $this->input->post('amount');
            $vocher_status              = $this->input->post('voucher_status');
            
            $where=  '';
            $where['fn_account_type_id']=  '1';
            $processdate                =  '';
            $payDate                    =  '';
            $like                       =  '';
             $deposit_amount            = '';
            
             
            if($from_date):
                $processdate['from_date']   = $from_date;
                $this->data['from_date']    = $from_date;  
            endif;
            if($to_date):
                $processdate['to_date']     = $to_date;
                $this->data['to_date']      = $to_date;  
            endif;
             if($process_no):
                $where['gl_at_id']          = $process_no;
                $this->data['process_no']   = $process_no;  
            endif;           
            if($voucher_id):
                $where['gl_at_vocher']      = $voucher_id;
                $this->data['voucehr_no']   = $voucher_id;  
            endif;
            if($Payee):
                $like['gl_at_payeeId']      = $Payee;
                $this->data['Payee']        = $Payee;  
            endif;            
            
            if($payfrom_date):
                $payDate['pfrom_date']         = $payfrom_date;
                $this->data['pfrom_date']    = $payfrom_date;  
            endif;
            if($payto_date):
                $payDate['pto_date']            = $payto_date;
                $this->data['pto_date']      = $payto_date;  
            endif;
            if($amount):
                $deposit_amount         = $amount;
                $this->data['amount']   = $amount;  
            endif;
            if($vocher_status):
                $where['vocher_status']     = $vocher_status;
                $this->data['statusid']     = $vocher_status;  
            endif;

            if($desc):
                $like['gl_at_description']  = $desc;
                $this->data['desc']         = $desc;  
            endif;
 
            $this->data['result'] =$this->FinanceModel->search_date_range($where,$processdate,$like,$payDate,$deposit_amount);
 endif;
        
        
        $this->data['page']             = 'Finance/OP/Search/op_finance_voucher_search';
        $this->data['page_header']      = 'OP Finance Voucher Search';
        $this->data['page_title']       = 'OP Finance Voucher Search | ECMS';
        $this->load->view('common/common',$this->data);
    } 
     public function finance_voucher_search_viewer(){
        $this->data['voucher_status']   = $this->CRUDModel->dropDown('fn_vocher_status','Voucher Status', 'id', 'status_title',array('status'=>1)); 
        $this->data['from_date']        = date('d-m-Y');
        $this->data['to_date']          = date('d-m-Y');
        $this->data['pfrom_date']       = '';
        $this->data['pto_date']         = '';
        $this->data['voucehr_no']       = '';
        $this->data['process_no']       = '';
        $this->data['Payee']            = '';
        $this->data['desc']             = '';
        $this->data['amount']            = '';
        $this->data['statusid']         = '';
        
        $where = array(
          'vocher_status'       =>1,  
          'fn_account_type_id'  =>1  
        );
        $this->data['result'] =$this->FinanceModel->search_date_range_limit($where);
        
        if($this->input->post('search')):
           
            $from_date                  = $this->input->post('from_date');
            $to_date                    = $this->input->post('to_date');
            $process_no                 = $this->input->post('process_no');
            $voucher_id                 = $this->input->post('voucher_id');
            $Payee                      = $this->input->post('payee');
            $payfrom_date               = $this->input->post('payfrom_date');
            $payto_date                 = $this->input->post('payto_date');
            $desc                       = $this->input->post('desc');
            $amount                     = $this->input->post('amount');
            $vocher_status              = $this->input->post('voucher_status');
            
            $where                      =  '';
            $processdate                =  '';
            $payDate                    =  '';
            $like                       =  '';
             $deposit_amount            = '';
            
             
            if($from_date):
                $processdate['from_date']   = $from_date;
                $this->data['from_date']    = $from_date;  
            endif;
            if($to_date):
                $processdate['to_date']     = $to_date;
                $this->data['to_date']      = $to_date;  
            endif;
             if($process_no):
                $where['gl_at_id']          = $process_no;
                $this->data['process_no']   = $process_no;  
            endif;           
            if($voucher_id):
                $where['gl_at_vocher']      = $voucher_id;
                $this->data['voucehr_no']   = $voucher_id;  
            endif;
            if($Payee):
                $like['gl_at_payeeId']      = $Payee;
                $this->data['Payee']        = $Payee;  
            endif;            
            
            if($payfrom_date):
                $payDate['pfrom_date']         = $payfrom_date;
                $this->data['pfrom_date']    = $payfrom_date;  
            endif;
            if($payto_date):
                $payDate['pto_date']            = $payto_date;
                $this->data['pto_date']      = $payto_date;  
            endif;
            if($amount):
                $deposit_amount         = $amount;
                $this->data['amount']   = $amount;  
            endif;
            if($vocher_status):
                $where['vocher_status']     = $vocher_status;
                $this->data['statusid']     = $vocher_status;  
            endif;

            if($desc):
                $like['gl_at_description']  = $desc;
                $this->data['desc']         = $desc;  
            endif;
 
            $this->data['result'] =$this->FinanceModel->search_date_range($where,$processdate,$like,$payDate,$deposit_amount);
 endif;
        
        
        $this->data['page']             = 'Finance/OP/Search/op_finance_voucher_search_viwer';
        $this->data['page_header']      = 'OP Finance Voucher Search';
        $this->data['page_title']       = 'OP Finance Voucher Search | ECMS';
        $this->load->view('common/common',$this->data);
    } 
         public function finance_voucher_search_admin(){
        $this->data['voucher_status']   = $this->CRUDModel->dropDown('fn_vocher_status','Voucher Status', 'id', 'status_title',array('status'=>1)); 
        $this->data['from_date']        = date('d-m-Y');
        $this->data['to_date']          = date('d-m-Y');
        $this->data['pfrom_date']       = '';
        $this->data['pto_date']         = '';
        $this->data['voucehr_no']       = '';
        $this->data['process_no']       = '';
        $this->data['Payee']            = '';
        $this->data['desc']             = '';
        $this->data['amount']            = '';
        $this->data['statusid']         = '';
        
        $this->data['result'] =$this->FinanceModel->search_date_range_limit(array('vocher_status'=>1,'fn_account_type_id'=>1));
        
        if($this->input->post('search')):
           
            $from_date                  = $this->input->post('from_date');
            $to_date                    = $this->input->post('to_date');
            $process_no                 = $this->input->post('process_no');
            $voucher_id                 = $this->input->post('voucher_id');
            $Payee                      = $this->input->post('payee');
            $payfrom_date               = $this->input->post('payfrom_date');
            $payto_date                 = $this->input->post('payto_date');
            
            
            
            $desc                       = $this->input->post('desc');
            $amount                     = $this->input->post('amount');
            $vocher_status              = $this->input->post('voucher_status');
            
//            $where['sfn_account_type_id']    =  '1';
            $where['fn_account_type_id']    =  '1';
            $processdate                    =  '';
            $payDate                        =  '';
            $like                           =  '';
            $deposit_amount                 =  '';
            
             
            if($from_date):
                $processdate['from_date']   = $from_date;
                $this->data['from_date']    = $from_date;  
            endif;
            if($to_date):
                $processdate['to_date']     = $to_date;
                $this->data['to_date']      = $to_date;  
            endif;
             if($process_no):
                $where['gl_at_id']          = $process_no;
                $this->data['process_no']   = $process_no;  
            endif;           
            if($voucher_id):
                $where['gl_at_vocher']      = $voucher_id;
                $this->data['voucehr_no']   = $voucher_id;  
            endif;
            if($Payee):
                $like['gl_at_payeeId']      = $Payee;
                $this->data['Payee']        = $Payee;  
            endif;            
            
            if($payfrom_date):
                $payDate['pfrom_date']         = $payfrom_date;
                $this->data['pfrom_date']    = $payfrom_date;  
            endif;
            if($payto_date):
                $payDate['pto_date']            = $payto_date;
                $this->data['pto_date']      = $payto_date;  
            endif;
            if($amount):
                $deposit_amount         = $amount;
                $this->data['amount']   = $amount;  
            endif;
            if($vocher_status):
                $where['vocher_status']     = $vocher_status;
                $this->data['statusid']     = $vocher_status;  
            endif;

            if($desc):
                $like['gl_at_description']  = $desc;
                $this->data['desc']         = $desc;  
            endif;
 
            $this->data['result'] =$this->FinanceModel->search_date_range($where,$processdate,$like,$payDate,$deposit_amount);
        endif;
        
        
        $this->data['page']             = 'Finance/OP/Search/op_finance_voucher_search_admin';
        $this->data['page_header']      = 'OP Finance Voucher Search Admin';
        $this->data['page_title']       = 'OP Finance Voucher Search Admin | ECMS';
        $this->load->view('common/common',$this->data);
    } 
//   public function finance_voucher_search(){
//        $this->data['voucher_status']   = $this->CRUDModel->dropDown('fn_vocher_status','', 'id', 'status_title',array('status'=>1)); 
//        $this->data['from_date']        = date('d-m-Y');
//        $this->data['to_date']          = date('d-m-Y');
//        $this->data['voucehr_no']       = '';
//        $this->data['statusid']         = 1;
//        
//        $where = array(
//          'vocher_status'=>1,  
//          'fn_account_type_id'=>1  
//        );
//        $this->data['result'] =$this->FinanceModel->search_date_range_limit($where);
//        
//        if($this->input->post()):
//            $from_date                 = $this->input->post('from_date');
//            $to_date                 = $this->input->post('to_date');
//            $voucher_id                 = $this->input->post('voucher_id');
//            $vocher_status              = $this->input->post('voucher_status');
//            $this->data['statusid']     = $vocher_status;
//            $where['fn_account_type_id']=  1;
//            $date                       =  '';
//           
//            if($from_date):
//                $date['from_date']         = $from_date;
//                $this->data['from_date']    = $from_date;  
//            endif;
//            if($to_date):
//                $date['to_date']         = $to_date;
//                $this->data['to_date']      = $to_date;  
//            endif;
//            if($voucher_id):
//                $where ['gl_at_id'] = $voucher_id;
//                $this->data['voucehr_no']   = $voucher_id;  
//            endif;
//            
//            if($vocher_status):
//                $where ['vocher_status'] = $vocher_status;
//                $this->data['statusid']   = $vocher_status;  
//            endif;
//            
//             
//            $this->data['result'] =$this->FinanceModel->search_date_range($where,$date);
// 
//        endif;
// 
//        
//        $this->data['page']             = 'Finance/OP/Search/op_finance_voucher_search';
//        $this->data['page_header']      = 'OP Finance Voucher Search';
//        $this->data['page_title']       = 'OP Finance Voucher Search | ECMS';
//        $this->load->view('common/common',$this->data);
//    }
    
     public function voucher_approval(){
          
            $this->data['voucher_status']    = $this->CRUDModel->dropDown('fn_vocher_status','', 'id', 'status_title',array('status'=>1)); 
            $where = array('gl_at_id'   =>$this->uri->segment(2),'fn_account_type_id'=>1);
            $this->data['update_records']       =$this->FinanceModel->get_update_record('gl_amount_transition',$where);

            if($this->input->post()):
                $cheque         = $this->input->post('cheque');
                $trans_id       = $this->input->post('trans_id');
                $payment_date   = $this->input->post('payment_date');
                $voucher_no     = $this->input->post('voucher_no');
                $voucher_status = $this->input->post('voucher_status');
                 
                $voucher_exist = $this->CRUDModel->get_where_row('gl_amount_transition',array('gl_at_id'=>$trans_id,'fn_account_type_id'=>1));
                 
                $TranLog = array(
                    'gl_at_cheque'          => $voucher_exist->gl_at_cheque,  
                    'payment_date'          => date('Y-m-d',strtotime($voucher_exist->payment_date)),  
                    'gl_at_vocher'          => $voucher_exist->gl_at_vocher,  
                    'vocher_status'         => $voucher_exist->vocher_status,  
                    'fn_account_type_id'    => $voucher_exist->fn_account_type_id,  
                    'log_comments'          => 'Update in (OP Voucher Approval)  At :'.date('d-m-Y'),
                    'log_by'                => $this->userInfo->user_id,
                    'log_dateTime'          => date('Y-m-d H:i:s')
                    );
                $this->CRUDModel->insert('gl_amount_transition_log',$TranLog);
                
                 if($voucher_exist->gl_at_vocher == 0):
                     //auto define
                        $query1 = $this->db->where(array('status'=>'1','fn_account_type_id'=>1))->get('financial_year')->row();
                        $check_voch_whrer = array(
                           'gl_fy_id'           => $query1->id, 
                           'gl_at_vocher'       => $voucher_no,
                           'fn_account_type_id' => 1
                             
                        );
                        $voucher_check = $this->CRUDModel->get_where_row('gl_amount_transition',$check_voch_whrer);
                      
                     if(empty($voucher_check)):
                          $data = array(
                                        'gl_at_cheque' =>$cheque,  
                                        'payment_date' =>date('Y-m-d', strtotime($payment_date)),  
                                        'gl_at_vocher' =>$voucher_no,  
                                        'vocher_status' =>$voucher_status,
                                        'fn_account_type_id' => 1
                                      );
                                  $where = array(
                                      'gl_at_id'=>$trans_id
                                  );
                                       $this->CRUDModel->update('gl_amount_transition',$data,$where);
                                       
                                       redirect('searchVoucher');
                         else:
                          $this->session->set_flashdata('voucher_exist', 'Voucher Number Already Exist 1');
                             redirect('voucherApproval/'.$trans_id);
                     endif;
                     
                    
                 else:
                   
                     
                     //33 
                     
                     //Check If exist 
                      $query1 = $this->db->where(array('status'=>'1','fn_account_type_id'=>1))->get('financial_year')->row();
                        $check_voch_whrer = array(
                           'gl_fy_id'=>$query1->id, 
                           'gl_at_vocher'=>$voucher_no,
                            'gl_at_id !='=>$trans_id, 
                             'fn_account_type_id' => 1   
                        );
                        $voucher_check = $this->CRUDModel->get_where_row('gl_amount_transition',$check_voch_whrer);
                      
                        if(!empty($voucher_check)):
                             $this->session->set_flashdata('voucher_exist', 'Voucher Number Already Exist ');
                             redirect('voucherApproval/'.$trans_id);
                            else:
                                     $data = array(
                                        'gl_at_cheque' =>$cheque,  
                                        'payment_date' =>date('Y-m-d', strtotime($payment_date)),  
                                        'gl_at_vocher' =>$voucher_no,  
                                        'vocher_status' =>$voucher_status,
                                         'fn_account_type_id' => 1
                                      );
                                  $where = array(
                                      'gl_at_id'=>$trans_id
                                  );
                                       $this->CRUDModel->update('gl_amount_transition',$data,$where);
                                       redirect('searchVoucher');
                        endif;
                 
                 endif;
               
            endif;
            
            $this->data['page']         = "Finance/OP/Forms/op_finance_voucher_approval";
            $this->data['page_title']        = 'OP Voucher Approval| ECMS';
            $this->data['page_header']  = 'OP Voucher Approval';
            $this->load->view('common/common',$this->data);
    }
     public function voucher_approval_before_log(){
          
            $this->data['voucher_status']    = $this->CRUDModel->dropDown('fn_vocher_status','', 'id', 'status_title',array('status'=>1)); 
            $where = array('gl_at_id'   =>$this->uri->segment(2),'fn_account_type_id'=>1);
            $this->data['update_records']       =$this->FinanceModel->get_update_record('gl_amount_transition',$where);

            if($this->input->post()):
                $cheque         = $this->input->post('cheque');
                $trans_id       = $this->input->post('trans_id');
                $payment_date   = $this->input->post('payment_date');
                $voucher_no     = $this->input->post('voucher_no');
                $voucher_status = $this->input->post('voucher_status');
                 
                $voucher_exist = $this->CRUDModel->get_where_row('gl_amount_transition',array('gl_at_id'=>$trans_id,'fn_account_type_id'=>1));
                  
                  
                 if($voucher_exist->gl_at_vocher == 0):
                     //auto define
                        $query1 = $this->db->where(array('status'=>'1','fn_account_type_id'=>1))->get('financial_year')->row();
                        $check_voch_whrer = array(
                           'gl_fy_id'           => $query1->id, 
                           'gl_at_vocher'       => $voucher_no,
                           'fn_account_type_id' => 1
                             
                        );
                        $voucher_check = $this->CRUDModel->get_where_row('gl_amount_transition',$check_voch_whrer);
                      
                     if(empty($voucher_check)):
                          $data = array(
                                        'gl_at_cheque' =>$cheque,  
                                        'payment_date' =>date('Y-m-d', strtotime($payment_date)),  
                                        'gl_at_vocher' =>$voucher_no,  
                                        'vocher_status' =>$voucher_status,
                                        'fn_account_type_id' => 1
                                      );
                                  $where = array(
                                      'gl_at_id'=>$trans_id
                                  );
                                       $this->CRUDModel->update('gl_amount_transition',$data,$where);
                                       
                                       redirect('searchVoucher');
                         else:
                          $this->session->set_flashdata('voucher_exist', 'Voucher Number Already Exist 1');
                             redirect('voucherApproval/'.$trans_id);
                     endif;
                     
                    
                 else:
                   
                     
                     //33 
                     
                     //Check If exist 
                      $query1 = $this->db->where(array('status'=>'1','fn_account_type_id'=>1))->get('financial_year')->row();
                        $check_voch_whrer = array(
                           'gl_fy_id'=>$query1->id, 
                           'gl_at_vocher'=>$voucher_no,
                            'gl_at_id !='=>$trans_id, 
                             'fn_account_type_id' => 1   
                        );
                        $voucher_check = $this->CRUDModel->get_where_row('gl_amount_transition',$check_voch_whrer);
                      
                        if(!empty($voucher_check)):
                             $this->session->set_flashdata('voucher_exist', 'Voucher Number Already Exist ');
                             redirect('voucherApproval/'.$trans_id);
                            else:
                                     $data = array(
                                        'gl_at_cheque' =>$cheque,  
                                        'payment_date' =>date('Y-m-d', strtotime($payment_date)),  
                                        'gl_at_vocher' =>$voucher_no,  
                                        'vocher_status' =>$voucher_status,
                                         'fn_account_type_id' => 1
                                      );
                                  $where = array(
                                      'gl_at_id'=>$trans_id
                                  );
                                       $this->CRUDModel->update('gl_amount_transition',$data,$where);
                                       redirect('searchVoucher');
                        endif;
                 
                 endif;
               
            endif;
            
            $this->data['page']         = "Finance/OP/Forms/op_finance_voucher_approval";
            $this->data['page_title']        = 'OP Voucher Approval| ECMS';
            $this->data['page_header']  = 'OP Voucher Approval';
            $this->load->view('common/common',$this->data);
    }

   public function check_date_range(){
       $processdate = date('d-m-Y', strtotime($this->input->post('invoice_date')));
       $fy      = $this->input->post('fy');
       $date    = $this->CRUDModel->get_where_row('financial_year',array('status'=>1,'id'=>$fy));
       
        //if greate then start date/
        $dateDiff = date_diff(date_create($processdate), date_create(date('d-m-Y', strtotime($date->year_start))));
        $timeStart = $dateDiff->format("%R%a"); 
  
       if($timeStart>0):
           echo 1;
       endif;
        //if greate then start date/
        $dateDiff = date_diff(date_create($processdate), date_create(date('d-m-Y', strtotime($date->year_end))));
        $timeEnd = $dateDiff->format("%R%a"); 
  
       if($timeEnd<0):
           echo 1;
       endif;
       
 
   }
   
   public function finance_cashier(){
       
         if($this->input->post()):
        $userInfo      = $this->getUser();
             
         //Insert Code 
      
        $name           = $this->input->post('name');
        $status         = $this->input->post('status');
       
        $fy_id      = $this->input->post('fy_id');
        $time_stamp = date('Y-m-d H:i:s');
         
        

         if($fy_id):

             $data = array(
             
             'name'         =>$name,
              
             'status'       =>$status,
              
             'up_user_id'   =>$userInfo['user_id'],
             'up_timestamp' =>$time_stamp,
             );
         
             $where = array('id'=>$fy_id);
             $this->CRUDModel->update('fn_cashier',$data,$where);
             redirect('FnCashier');
             else:
                 $data = array(
                     
                    'name'         =>$name,
                    
                    'user_id'       =>$userInfo['user_id'],
                    'timestamp'     =>$time_stamp,
                    );
                $this->CRUDModel->insert('fn_cashier',$data);
                 redirect('FnCashier');
             endif;

        endif;

        $id = $this->uri->segment(2);
        if($id):
            $this->data['update_row']    = $this->CRUDModel->get_where_row('fn_cashier',array('id'=>$id));
        endif;
       
       
        $this->data['fnYear']       = $this->CRUDModel->getResults('fn_cashier');
        $this->data['page']             = "Finance/finace_cashier";
        $this->data['page_heading']     = "Finance Cashier";
        $this->data['page_title']       = 'Finance Cashier | ECMS';
        $this->load->view('common/common',$this->data);
   }
   
   public function finance_employee_info(){
       
       
       $employee_id = $this->input->post('employee_id');
       
       
                $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation');
                $query = $this->db->where('emp_id',$employee_id)->get('hr_emp_record')->row();
                 if($query):
                    echo $query->emp_name.' ('.$query->title.')';
                 else:
                     echo '';
                 endif;
                 
       
   }
   public function finance_supplier_info(){
       
       
        $supplier_id = $this->input->post('supplier_id');
        $query = $this->db->where('fn_supp_id',$supplier_id)->get('fn_supplier')->row();
                
                if($query):
                    echo $query->propertier_name;
                else:
                     echo '';
                endif;
                 
       
   }
   
   
   public function get_mac_add(){
       $this->load->library('mac');
   }
       public function trail_balance_new(){
             
//            $this->data['COAP'] =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1));
            
                $this->data['dateFrom']       = date('d-m-Y');
                $this->data['toDate']         = date('d-m-Y');
        
            if($this->input->post('search')):
               
                $this->data['dateFrom']       = $this->input->post('dateFrom');
                $this->data['toDate']         = $this->input->post('dateto');
                
                $this->data['recordTo']       = $this->input->post('recordTo');
                $this->data['recordFrom']     = $this->input->post('recordFrom');
                
                $this->data['recordToCode']   = $this->input->post('recordToCode');
                $this->data['recordFromCode'] = $this->input->post('recordFromCode');
                
            $this->data['TrailBalanceFullHeads']   =  $this->FinanceModel->trail_balance_new('gl_amount_details',
                       $this->data['dateFrom'], 
                       $this->data['toDate'],
                       $this->data['recordFromCode'],
                       $this->data['recordToCode']
                       );

                
            endif;
            
        if($this->input->post('excel')):
             
                
                $this->data['dateFrom']       = $this->input->post('dateFrom');
                $this->data['toDate']         = $this->input->post('dateto');
                
                $this->data['recordTo']       = $this->input->post('recordTo');
                $this->data['recordFrom']     = $this->input->post('recordFrom');
                
                $this->data['recordToCode']       = $this->input->post('recordToCode');
                $this->data['recordFromCode']     = $this->input->post('recordFromCode');
                     
                    
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('OP TRAIL BALANCE');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'CODE');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'COA');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('C1', 'OPENING DEBIT');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('D1','OPENING CREDIT');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);
                
               
                $this->excel->getActiveSheet()->setCellValue('E1', 'PERIOD DEBIT');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('F1', 'PERIOD CREDIT');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('G1', 'CLOSING DEBIT');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('H1', 'CLOSING CREDIT');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(12);
                 
               
               
               //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle('A')->getFont()->setSize(10);
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $this->excel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
               
                
       for($col = ord('B'); $col <= ord('H'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
                
               $GeneralLeader =  $this->FinanceModel->trail_balance_new('gl_amount_details',
                       $this->data['dateFrom'], 
                       $this->data['toDate'],
                       $this->data['recordFromCode'],
                       $this->data['recordToCode']
                       );
          
               
               
               
                    $final_total_op_debit = '';
                    $final_total_op_credit = '';

                    $final_total_current_debit = '';
                    $final_total_current_credit = '';

                    $final_total_close_debit = '';
                    $final_total_close_credit = '';

                     foreach($GeneralLeader as $GLRow):

                     $where = array(
                             'gl_ad_coa_mc_pk'=>$GLRow->fn_coa_mc_id,
                          'gl_amount_transition.fn_account_type_id' => 1,
                             'payment_date <'=>date('Y-m-d', strtotime($this->data['dateFrom'])),
                             );
                         $open_balance       = $this->FinanceModel->open_balance($where);

                             $grandCredit_open   = 0;
                             $grandDebit_open    = 0;
                             $debit_total_open   = 0;
                             $credit_total_open  = 0;

                             foreach($open_balance as $obRow):
                                 $query          =  $this->db->where(array('status'=>1,'fn_account_type_id'=>1))->get('financial_year')->row();

                                 $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId       = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));

                             if($parentId->fn_coa_code == 200000):
                                     $debit_total_open       +=$obRow->gl_ad_depit ;
                                     $credit_total_open      +=$obRow->gl_ad_credit;         
                                     $grandCredit_open       = $credit_total_open-$debit_total_open;
                                     $grandDebit_open        = '';
                                 endif;
                                 $count = '';
                                 if($parentId->fn_coa_code == 400000):
                                     $dateDiff   = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
                                     $timeStart  = $dateDiff->format("%R%a"); 
                                     if($timeStart > 0):
                                         $debit_total_open       += $obRow->gl_ad_depit ;
                                         $credit_total_open      += $obRow->gl_ad_credit; 
                                         $grandCredit_open       = $credit_total_open-$debit_total_open;
                                         $grandDebit_open     = '';
                                         else:
                                     endif; 
                                 endif;

                                 if($parentId->fn_coa_code == 300000):

                                            $debit_total_open       +=$obRow->gl_ad_depit ;
                                             $credit_total_open      +=$obRow->gl_ad_credit;
                                        $grandDebit_open = $debit_total_open- $credit_total_open;
                                         $grandCredit_open    = '';
                                 endif;
                                 if($parentId->fn_coa_code == 500000):
                                     $dateDiff = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
                                     $timeStart = $dateDiff->format("%R%a"); 

                                     if($timeStart > 0):
                                         $debit_total_open       += $obRow->gl_ad_depit ;
                                         $credit_total_open      += $obRow->gl_ad_credit;
                                         $grandDebit_open        = $debit_total_open- $credit_total_open;
                                         $grandCredit_open       = '';
                                         else:
                                         endif;
                                 endif;
                             endforeach; 
                             
                                    $final_total_op_debit  += $grandDebit_open;
                                    $final_total_op_credit  += $grandCredit_open;
                            
                             
                             
                             

                         $detail = $this->FinanceModel->get_amountDetails(
                                 'gl_amount_transition',
                                 array(
                                     'gl_ad_coa_mc_pk'=>$GLRow->fn_coa_mc_id,
                                      'gl_amount_transition.fn_account_type_id' => 1
                                 ),$this->data['dateFrom'],$this->data['toDate']);

                        $credit_total    = '';
                        $debit_total     = '';
                         foreach($detail as $dRow):
                                 $debit_total    +=$dRow->gl_ad_depit;
                                 $credit_total   +=$dRow->gl_ad_credit;
                         endforeach;
                          $final_total_current_debit += $debit_total;
                         $final_total_current_credit += $credit_total;  
                                
                                $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));
                                 if($parentId):
                                     
                                 
                                 if($parentId->fn_coa_code == 200000):
                                        $grandCredit = $credit_total-$debit_total;
                                        $grandDebit     = '';
                                 endif;
                                 if($parentId->fn_coa_code == 400000):
                                        $grandCredit = $credit_total-$debit_total;
                                         $grandDebit     = '';   
                                 endif;

                                 if($parentId->fn_coa_code == 300000):
                                        $grandDebit = $debit_total- $credit_total;
                                         $grandCredit    = '';
                                 endif;
                                 if($parentId->fn_coa_code == 500000):
                                        $grandDebit = $debit_total- $credit_total;
                                 $grandCredit    = '';
                                 endif;
                                 endif;
                                 $grand_open_Dept = $grandDebit+$grandDebit_open;
                                 $final_total_close_debit += $grandDebit+$grandDebit_open;
                                 
                                 $grand_open_Credit = $grandCredit+$grandCredit_open;
                                 $final_total_close_credit +=$grandCredit+$grandCredit_open;
                                $result[] =  array(
                                    'Code'          =>  $GLRow->fn_coa_mc_code,
                                    'title'         =>  $GLRow->fn_coa_mc_title,
                                    'open_debit'    =>  $grandDebit_open,
                                    'open_credit'   =>  $grandCredit_open, 
                                    'period_debit'  =>  $debit_total, 
                                    'period_credit' =>  $credit_total,
                                    'close_debit'   =>  $grandDebit+$grandDebit_open,
                                    'close_credit'  =>  $grandCredit+$grandCredit_open,
                                ); 
                                
                               
                     endforeach;
                     $NET_INCOME_LAST = '';
                     $NET_GRANT_TOTAL = '';
                     $result[] =  array(
                                    'Code'              =>  '',
                                    'title'         =>  'Total [PKR]',
                                    'open_debit'    =>  $final_total_op_debit,
                                    'open_credit'   =>  $final_total_op_credit, 
                                    'period_debit'  =>  $final_total_current_debit, 
                                    'period_credit' =>  $final_total_current_credit,
                                    'close_debit'   =>  $final_total_close_debit,
                                    'close_credit'  =>  $final_total_close_credit,
                                ); 
                     $NET_INCOME_LAST =$final_total_op_debit - $final_total_op_credit;
                     
                     $result[] =  array(
                                    'Code'              =>  '',
                                    'title'         =>  'NET INCOME [PKR]',
                                    'open_debit'    =>  '',
                                    'open_credit'   =>  $NET_INCOME_LAST, 
                                    'period_debit'  =>  '', 
                                    'period_credit' =>  '',
                                    'close_debit'   =>  '',
                                    'close_credit'  =>  '',
                                ); 
                     $NET_GRANT_TOTAL = $NET_INCOME_LAST+$final_total_op_credit;
                     $result[] =  array(
                                    'Code'              =>  '-',
                                    'title'         =>  'GRAND TOTAL [PKR]',
                                    'open_debit'    =>  $final_total_op_debit,
                                    'open_credit'   =>  $NET_GRANT_TOTAL, 
                                    'period_debit'  =>  '', 
                                    'period_credit' =>  '',
                                    'close_debit'   =>  '',
                                    'close_credit'  =>  '',
                                ); 
            
        foreach ($result as $row){
               
                $exceldata[] = $row;
                
        }
        
                    
                // echo '<pre>';print_r($exceldata);die;
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $date = $this->data['dateFrom'].' To '.$this->data['toDate'];
                $filename='OP TRIAL BALANCE From '.$date.'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
            endif;
                    
               
              
           
        
             $this->data['page']         = "Finance/OP/Reports/trail_balance_new";
            $this->data['page_title']        = 'OP Trial Balance | ECMS';
            $this->data['page_header']        = 'OP Trial Balance';
            $this->load->view('common/common',$this->data);
    }
    public function trail_balance_new_excel_issu(){
             
//            $this->data['COAP'] =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1));
            
                $this->data['dateFrom']       = date('d-m-Y');
                $this->data['toDate']         = date('d-m-Y');
        
            if($this->input->post('search')):
               
                $this->data['dateFrom']       = $this->input->post('dateFrom');
                $this->data['toDate']         = $this->input->post('dateto');
                
                $this->data['recordTo']       = $this->input->post('recordTo');
                $this->data['recordFrom']     = $this->input->post('recordFrom');
                
                $this->data['recordToCode']   = $this->input->post('recordToCode');
                $this->data['recordFromCode'] = $this->input->post('recordFromCode');
                
            $this->data['TrailBalanceFullHeads']   =  $this->FinanceModel->trail_balance_new('gl_amount_details',
                       $this->data['dateFrom'], 
                       $this->data['toDate'],
                       $this->data['recordFromCode'],
                       $this->data['recordToCode']
                       );

                
            endif;
            
        if($this->input->post('excel')):
             
                
                $this->data['dateFrom']       = $this->input->post('dateFrom');
                $this->data['toDate']         = $this->input->post('dateto');
                
                $this->data['recordTo']       = $this->input->post('recordTo');
                $this->data['recordFrom']     = $this->input->post('recordFrom');
                
                $this->data['recordToCode']       = $this->input->post('recordToCode');
                $this->data['recordFromCode']     = $this->input->post('recordFromCode');
                     
                    
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('OP TRAIL BALANCE');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'CODE');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'COA');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('C1', 'OPENING DEBIT');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('D1','OPENING CREDIT');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);
                
               
                $this->excel->getActiveSheet()->setCellValue('E1', 'PERIOD DEBIT');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('F1', 'PERIOD CREDIT');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('G1', 'CLOSING DEBIT');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('H1', 'CLOSING CREDIT');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(12);
                 
               
               
               //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle('A')->getFont()->setSize(10);
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $this->excel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
               
                
       for($col = ord('B'); $col <= ord('H'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
                
               $GeneralLeader =  $this->FinanceModel->trail_balance_new('gl_amount_details',
                       $this->data['dateFrom'], 
                       $this->data['toDate'],
                       $this->data['recordFromCode'],
                       $this->data['recordToCode']
                       );
          
               
               
               
                    $final_total_op_debit = '';
                    $final_total_op_credit = '';

                    $final_total_current_debit = '';
                    $final_total_current_credit = '';

                    $final_total_close_debit = '';
                    $final_total_close_credit = '';

                     foreach($GeneralLeader as $GLRow):

                     $where = array(
                             'gl_ad_coa_mc_pk'=>$GLRow->gl_ad_coa_mc_pk,
                          'gl_amount_transition.fn_account_type_id' => 1,
                             'payment_date <'=>date('Y-m-d', strtotime($this->data['dateFrom'])),
                             );
                         $open_balance       = $this->FinanceModel->open_balance($where);

                             $grandCredit_open   = 0;
                             $grandDebit_open    = 0;
                             $debit_total_open   = 0;
                             $credit_total_open  = 0;

                             foreach($open_balance as $obRow):
                                 $query          =  $this->db->where(array('status'=>1,'fn_account_type_id'=>1))->get('financial_year')->row();

                                 $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId       = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));

                             if($parentId->fn_coa_code == 200000):
                                     $debit_total_open       +=$obRow->gl_ad_depit ;
                                     $credit_total_open      +=$obRow->gl_ad_credit;         
                                     $grandCredit_open       = $credit_total_open-$debit_total_open;
                                     $grandDebit_open        = '';
                                 endif;
                                 $count = '';
                                 if($parentId->fn_coa_code == 400000):
                                     $dateDiff   = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
                                     $timeStart  = $dateDiff->format("%R%a"); 
                                     if($timeStart > 0):
                                         $debit_total_open       += $obRow->gl_ad_depit ;
                                         $credit_total_open      += $obRow->gl_ad_credit; 
                                         $grandCredit_open       = $credit_total_open-$debit_total_open;
                                         $grandDebit_open     = '';
                                         else:
                                     endif; 
                                 endif;

                                 if($parentId->fn_coa_code == 300000):

                                            $debit_total_open       +=$obRow->gl_ad_depit ;
                                             $credit_total_open      +=$obRow->gl_ad_credit;
                                        $grandDebit_open = $debit_total_open- $credit_total_open;
                                         $grandCredit_open    = '';
                                 endif;
                                 if($parentId->fn_coa_code == 500000):
                                     $dateDiff = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
                                     $timeStart = $dateDiff->format("%R%a"); 

                                     if($timeStart > 0):
                                         $debit_total_open       += $obRow->gl_ad_depit ;
                                         $credit_total_open      += $obRow->gl_ad_credit;
                                         $grandDebit_open        = $debit_total_open- $credit_total_open;
                                         $grandCredit_open       = '';
                                         else:
                                         endif;
                                 endif;
                             endforeach; 
                             
                                    $final_total_op_debit  += $grandDebit_open;
                                    $final_total_op_credit  += $grandCredit_open;
                            
                             
                             
                             

                         $detail = $this->FinanceModel->get_amountDetails(
                                 'gl_amount_transition',
                                 array(
                                     'gl_ad_coa_mc_pk'=>$GLRow->gl_ad_coa_mc_pk,
                                      'gl_amount_transition.fn_account_type_id' => 1
                                 ),$this->data['dateFrom'],$this->data['toDate']);

                        $credit_total    = '';
                        $debit_total     = '';
                         foreach($detail as $dRow):
                                 $debit_total    +=$dRow->gl_ad_depit;
                                 $credit_total   +=$dRow->gl_ad_credit;
                         endforeach;
                          $final_total_current_debit += $debit_total;
                         $final_total_current_credit += $credit_total;  
                                
                                $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));

                                 if($parentId->fn_coa_code == 200000):
                                        $grandCredit = $credit_total-$debit_total;
                                        $grandDebit     = '';
                                 endif;
                                 if($parentId->fn_coa_code == 400000):
                                        $grandCredit = $credit_total-$debit_total;
                                         $grandDebit     = '';   
                                 endif;

                                 if($parentId->fn_coa_code == 300000):
                                        $grandDebit = $debit_total- $credit_total;
                                         $grandCredit    = '';
                                 endif;
                                 if($parentId->fn_coa_code == 500000):
                                        $grandDebit = $debit_total- $credit_total;
                                 $grandCredit    = '';
                                 endif;
                                 
                                 $grand_open_Dept = $grandDebit+$grandDebit_open;
                                 $final_total_close_debit += $grandDebit+$grandDebit_open;
                                 
                                 $grand_open_Credit = $grandCredit+$grandCredit_open;
                                 $final_total_close_credit +=$grandCredit+$grandCredit_open;
                                $result[] =  array(
                                    'Code'          =>  $GLRow->gl_ad_coa_mc_id,
                                    'title'         =>  $GLRow->gl_ad_coa_mc_name,
                                    'open_debit'    =>  $grandDebit_open,
                                    'open_credit'   =>  $grandCredit_open, 
                                    'period_debit'  =>  $debit_total, 
                                    'period_credit' =>  $credit_total,
                                    'close_debit'   =>  $grandDebit+$grandDebit_open,
                                    'close_credit'  =>  $grandCredit+$grandCredit_open,
                                ); 
                                
                               
                     endforeach;
                     $NET_INCOME_LAST = '';
                     $NET_GRANT_TOTAL = '';
                     $result[] =  array(
                                    'Code'              =>  '',
                                    'title'         =>  'Total [PKR]',
                                    'open_debit'    =>  $final_total_op_debit,
                                    'open_credit'   =>  $final_total_op_credit, 
                                    'period_debit'  =>  $final_total_current_debit, 
                                    'period_credit' =>  $final_total_current_credit,
                                    'close_debit'   =>  $final_total_close_debit,
                                    'close_credit'  =>  $final_total_close_credit,
                                ); 
                     $NET_INCOME_LAST =$final_total_op_debit - $final_total_op_credit;
                     
                     $result[] =  array(
                                    'Code'              =>  '',
                                    'title'         =>  'NET INCOME [PKR]',
                                    'open_debit'    =>  '',
                                    'open_credit'   =>  $NET_INCOME_LAST, 
                                    'period_debit'  =>  '', 
                                    'period_credit' =>  '',
                                    'close_debit'   =>  '',
                                    'close_credit'  =>  '',
                                ); 
                     $NET_GRANT_TOTAL = $NET_INCOME_LAST+$final_total_op_credit;
                     $result[] =  array(
                                    'Code'              =>  '-',
                                    'title'         =>  'GRAND TOTAL [PKR]',
                                    'open_debit'    =>  $final_total_op_debit,
                                    'open_credit'   =>  $NET_GRANT_TOTAL, 
                                    'period_debit'  =>  '', 
                                    'period_credit' =>  '',
                                    'close_debit'   =>  '',
                                    'close_credit'  =>  '',
                                ); 
            
        foreach ($result as $row){
               
                $exceldata[] = $row;
                
        }
        
                    
                // echo '<pre>';print_r($exceldata);die;
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $date = $this->data['dateFrom'].' To '.$this->data['toDate'];
                $filename='OP TRIAL BALANCE From '.$date.'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
            endif;
                    
               
              
           
        
             $this->data['page']         = "Finance/OP/Reports/trail_balance_new";
            $this->data['page_title']        = 'OP Trial Balance | ECMS';
            $this->data['page_header']        = 'OP Trial Balance';
            $this->load->view('common/common',$this->data);
    }
    public function income_statument(){
             
//            $this->data['COAP'] =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1));
            
                $this->data['dateFrom']     = date('d-m-Y');
                $this->data['dateTo']       = date('d-m-Y');
            
            
            if($this->input->post('search')):
               $this->data['dateFrom']       = $this->input->post('dateFrom');
                $this->data['dateTo']         = $this->input->post('dateto');
                $where = array(
                  'gl_amount_transition.fn_account_type_id'=>1  
                );
               $this->data['IncomeStatment']   =  $this->FinanceModel->income_statement(
                       $this->data['dateFrom'], 
                       $this->data['dateTo'],
                       $this->data['recordFromCode'] ='',
                       $this->data['recordToCode'] ='',
                       $where
                       );

                
            endif;
            if($this->input->post('excel')):
             
                
                $this->data['dateFrom']       = $this->input->post('dateFrom');
                $this->data['toDate']         = $this->input->post('dateto');
                
                $this->data['recordTo']       = $this->input->post('recordTo');
                $this->data['recordFrom']     = $this->input->post('recordFrom');
                
                $this->data['recordToCode']       = $this->input->post('recordToCode');
                $this->data['recordFromCode']     = $this->input->post('recordFromCode');
                     
                    
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('OP Income Report');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'CODE');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'COA');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
                
                
                
                $this->excel->getActiveSheet()->setCellValue('C1', 'AMOUNT');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
                
             
                 
               
               
               //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle('A')->getFont()->setSize(10);
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $this->excel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
               
                
       for($col = ord('B'); $col <= ord('C'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
               $where = array(
                  'gl_amount_transition.fn_account_type_id'=>1  
                );
               $incomeStatment =  $this->FinanceModel->income_statement(
                       $this->data['dateFrom'], 
                       $this->data['toDate'],
                       $this->data['recordFromCode'],
                       $this->data['recordToCode'],
                       $where
                       );
          
                    $final_total_op_debit = '';
                    $final_total_op_credit = '';

                    $final_total_current_debit = '';
                    $final_total_current_credit = '';

                    $final_total_close_debit = '';
                    $final_total_close_credit = '';

                     foreach($incomeStatment as $GLRow):

                             if($GLRow->gl_ad_coa_mc_id >=400000 && $GLRow->gl_ad_coa_mc_id <=499999):
                        $where = array(
                             'gl_ad_coa_mc_pk'=>$GLRow->gl_ad_coa_mc_pk,
                                 'gl_amount_transition.fn_account_type_id' => 1,
                             'payment_date <'=>date('Y-m-d', strtotime($this->data['dateFrom'])),
                             );
                         $open_balance       = $this->FinanceModel->open_balance($where);

                             $grandCredit_open   = 0;
                             $grandDebit_open    = 0;
                             $debit_total_open   = 0;
                             $credit_total_open  = 0;

                             foreach($open_balance as $obRow):
                                 $query          =  $this->db->where(array('status'=>1,'fn_account_type_id'=>1))->get('financial_year')->row();

                                 $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId       = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));

                             if($parentId->fn_coa_code == 200000):
                                     $debit_total_open       +=$obRow->gl_ad_depit ;
                                     $credit_total_open      +=$obRow->gl_ad_credit;         
                                     $grandCredit_open       = $credit_total_open-$debit_total_open;
                                     $grandDebit_open        = '';
                                 endif;
                                 $count = '';
                                 if($parentId->fn_coa_code == 400000):
                                     $dateDiff   = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
                                     $timeStart  = $dateDiff->format("%R%a"); 
                                     if($timeStart > 0):
                                         $debit_total_open       += $obRow->gl_ad_depit ;
                                         $credit_total_open      += $obRow->gl_ad_credit; 
                                         $grandCredit_open       = $credit_total_open-$debit_total_open;
                                         $grandDebit_open     = '';
                                         else:
                                     endif; 
                                 endif;

                                 if($parentId->fn_coa_code == 300000):

                                            $debit_total_open       +=$obRow->gl_ad_depit ;
                                             $credit_total_open      +=$obRow->gl_ad_credit;
                                        $grandDebit_open = $debit_total_open- $credit_total_open;
                                         $grandCredit_open    = '';
                                 endif;
                                 if($parentId->fn_coa_code == 500000):
                                     $dateDiff = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
                                     $timeStart = $dateDiff->format("%R%a"); 

                                     if($timeStart > 0):
                                         $debit_total_open       += $obRow->gl_ad_depit ;
                                         $credit_total_open      += $obRow->gl_ad_credit;
                                         $grandDebit_open        = $debit_total_open- $credit_total_open;
                                         $grandCredit_open       = '';
                                         else:
                                         endif;
                                 endif;
                             endforeach; 
                             
                                    $final_total_op_debit  += $grandDebit_open;
                                    $final_total_op_credit  += $grandCredit_open;
                         $detail = $this->FinanceModel->get_amountDetails(
                                 'gl_amount_transition',
                                 array(
                                     'gl_ad_coa_mc_pk'=>$GLRow->gl_ad_coa_mc_pk,
                                      'gl_amount_transition.fn_account_type_id' => 1,
                                 ),$this->data['dateFrom'],$this->data['toDate']);

                        $credit_total    = '';
                        $debit_total     = '';
                         foreach($detail as $dRow):
                                 $debit_total    +=$dRow->gl_ad_depit;
                                 $credit_total   +=$dRow->gl_ad_credit;
                         endforeach;
                          $final_total_current_debit += $debit_total;
                         $final_total_current_credit += $credit_total;  
                                
                                $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));

                                 if($parentId->fn_coa_code == 200000):
                                        $grandCredit = $credit_total-$debit_total;
                                        $grandDebit     = '';
                                 endif;
                                 if($parentId->fn_coa_code == 400000):
                                        $grandCredit = $credit_total-$debit_total;
                                         $grandDebit     = '';   
                                 endif;

                                 if($parentId->fn_coa_code == 300000):
                                        $grandDebit = $debit_total- $credit_total;
                                         $grandCredit    = '';
                                 endif;
                                 if($parentId->fn_coa_code == 500000):
                                        $grandDebit = $debit_total- $credit_total;
                                 $grandCredit    = '';
                                 endif;
                                 
                                 $grand_open_Dept = $grandDebit+$grandDebit_open;
                                 $final_total_close_debit += $grandDebit+$grandDebit_open;
                                 
                                 $grand_open_Credit = $grandCredit+$grandCredit_open;
                                 $final_total_close_credit +=$grandCredit+$grandCredit_open;
                                
                                 
                                 $result[] =  array(
                                    'Code'          =>  $GLRow->gl_ad_coa_mc_id,
                                    'title'         =>  $GLRow->gl_ad_coa_mc_name,
                                    'close_credit'  =>  $grandCredit+$grandCredit_open,
                                ); 
                        endif;        
                               
                     endforeach;
                     
                     $result[] =  array(
                                    'Code'              =>  '',
                                    'Title'         =>  'TOTAL INCOME [PKR] ',
                                    'Amount'  =>  $final_total_close_credit,
                                ); 
                     foreach($incomeStatment as $GLRow):

                             if($GLRow->gl_ad_coa_mc_id >=500000 && $GLRow->gl_ad_coa_mc_id <=599999):
                        $where = array(
                             'gl_ad_coa_mc_pk'=>$GLRow->gl_ad_coa_mc_pk,
                             'gl_amount_transition.fn_account_type_id' => 1,
                             'payment_date <'=>date('Y-m-d', strtotime($this->data['dateFrom'])),
                             );
                         $open_balance       = $this->FinanceModel->open_balance($where);

                             $grandCredit_open   = 0;
                             $grandDebit_open    = 0;
                             $debit_total_open   = 0;
                             $credit_total_open  = 0;

                             foreach($open_balance as $obRow):
                                 $query          =  $this->db->where(array('status'=>1,'fn_account_type_id'=>1))->get('financial_year')->row();

                                 $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId       = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));

                             if($parentId->fn_coa_code == 200000):
                                     $debit_total_open       +=$obRow->gl_ad_depit ;
                                     $credit_total_open      +=$obRow->gl_ad_credit;         
                                     $grandCredit_open       = $credit_total_open-$debit_total_open;
                                     $grandDebit_open        = '';
                                 endif;
                                 $count = '';
                                 if($parentId->fn_coa_code == 400000):
                                     $dateDiff   = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
                                     $timeStart  = $dateDiff->format("%R%a"); 
                                     if($timeStart > 0):
                                         $debit_total_open       += $obRow->gl_ad_depit ;
                                         $credit_total_open      += $obRow->gl_ad_credit; 
                                         $grandCredit_open       = $credit_total_open-$debit_total_open;
                                         $grandDebit_open     = '';
                                         else:
                                     endif; 
                                 endif;

                                 if($parentId->fn_coa_code == 300000):

                                            $debit_total_open       +=$obRow->gl_ad_depit ;
                                             $credit_total_open      +=$obRow->gl_ad_credit;
                                        $grandDebit_open = $debit_total_open- $credit_total_open;
                                         $grandCredit_open    = '';
                                 endif;
                                 if($parentId->fn_coa_code == 500000):
                                     $dateDiff = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
                                     $timeStart = $dateDiff->format("%R%a"); 

                                     if($timeStart > 0):
                                         $debit_total_open       += $obRow->gl_ad_depit ;
                                         $credit_total_open      += $obRow->gl_ad_credit;
                                         $grandDebit_open        = $debit_total_open- $credit_total_open;
                                         $grandCredit_open       = '';
                                         else:
                                         endif;
                                 endif;
                             endforeach; 
                             
                                    $final_total_op_debit  += $grandDebit_open;
                                    $final_total_op_credit  += $grandCredit_open;
                         $detail = $this->FinanceModel->get_amountDetails(
                                 'gl_amount_transition',
                                 array('gl_ad_coa_mc_pk'=>$GLRow->gl_ad_coa_mc_pk,'gl_amount_transition.fn_account_type_id' => 1),$this->data['dateFrom'],$this->data['toDate']);

                        $credit_total    = '';
                        $debit_total     = '';
                         foreach($detail as $dRow):
                                 $debit_total    +=$dRow->gl_ad_depit;
                                 $credit_total   +=$dRow->gl_ad_credit;
                         endforeach;
                          $final_total_current_debit += $debit_total;
                         $final_total_current_credit += $credit_total;  
                                
                                $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));

                                 if($parentId->fn_coa_code == 200000):
                                        $grandCredit = $credit_total-$debit_total;
                                        $grandDebit     = '';
                                 endif;
                                 if($parentId->fn_coa_code == 400000):
                                        $grandCredit = $credit_total-$debit_total;
                                         $grandDebit     = '';   
                                 endif;

                                 if($parentId->fn_coa_code == 300000):
                                        $grandDebit = $debit_total- $credit_total;
                                         $grandCredit    = '';
                                 endif;
                                 if($parentId->fn_coa_code == 500000):
                                        $grandDebit = $debit_total- $credit_total;
                                 $grandCredit    = '';
                                 endif;
                                 
                                 $grand_open_Dept = $grandDebit+$grandDebit_open;
                                 $final_total_close_debit += $grandDebit+$grandDebit_open;
                                 
                                 $grand_open_Credit = $grandCredit+$grandCredit_open;
                                 $final_total_close_credit +=$grandCredit+$grandCredit_open;
                                
                                 
                                 $result[] =  array(
                                    'Code'          =>  $GLRow->gl_ad_coa_mc_id,
                                    'title'         =>  $GLRow->gl_ad_coa_mc_name,
                                    'close_credit'  =>  $grandDebit+$grandDebit_open,
                                ); 
                        endif;        
                               
                     endforeach;
                     
                     $result[] =  array(
                                    'Code'          =>  '',
                                    'Title'         =>  'TOTAL EXPENSES [PKR] ',
                                    'Amount'        =>  $final_total_close_debit,
                                ); 
                     $result[] =  array(
                                    'Code'          =>  '',
                                    'Title'         =>  'NET INCOME [PKR]  ',
                                    'Amount'        =>  $final_total_close_credit-$final_total_close_debit,
                                ); 
          
        foreach ($result as $row){
               
                $exceldata[] = $row;
                
        }
        
                    
                // echo '<pre>';print_r($exceldata);die;
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $date = $this->data['dateFrom'].' To '.$this->data['toDate'];
                $filename='OP Income Statment From '.$date.'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
            endif;
                   
        $this->data['page']         = "Finance/OP/Reports/income_statement";
        $this->data['page_title']   = 'OP Income Statement | ECMS';
        $this->data['page_header']  = 'OP Income Statement';
        $this->load->view('common/common',$this->data);
    }
    public function balance_sheet(){
             
//            $this->data['COAP'] =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1));
            
                $this->data['dateFrom']     = date('d-m-Y');
                $this->data['dateTo']       = date('d-m-Y');
            
            
            if($this->input->post('search')):
               $this->data['dateFrom']       = $this->input->post('dateFrom');
                $this->data['dateTo']         = $this->input->post('dateto');
                $where = array(
                  'gl_amount_transition.fn_account_type_id'=>1  
                );
               $this->data['balance_sheet']   =  $this->FinanceModel->income_statement(
                       $this->data['dateFrom'], 
                       $this->data['dateTo'],
                       $this->data['recordFromCode'] ='',
                       $this->data['recordToCode'] ='',
                       $where
                       );

                
            endif;
            if($this->input->post('excel')):
             
                
                $this->data['dateFrom']       = $this->input->post('dateFrom');
                $this->data['toDate']         = $this->input->post('dateto');
                
                $this->data['recordTo']       = $this->input->post('recordTo');
                $this->data['recordFrom']     = $this->input->post('recordFrom');
                
                $this->data['recordToCode']       = $this->input->post('recordToCode');
                $this->data['recordFromCode']     = $this->input->post('recordFromCode');
                     
                    
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('OP Balance Sheet');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'CODE');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'COA');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
                
                
                
                $this->excel->getActiveSheet()->setCellValue('C1', 'AMOUNT');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
                
             
                 
               
               
               //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle('A')->getFont()->setSize(10);
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $this->excel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
               
                
       for($col = ord('B'); $col <= ord('C'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
                
               $incomeStatment =  $this->FinanceModel->income_statement(
                       $this->data['dateFrom'], 
                       $this->data['toDate'],
                       $this->data['recordFromCode'],
                       $this->data['recordToCode'],
                       array(
                           'gl_amount_transition.fn_account_type_id' => 1
                            )
                       );
          
                    $final_total_op_debit = '';
                    $final_total_op_credit = '';

                    $final_total_current_debit = '';
                    $final_total_current_credit = '';

                    $final_total_close_debit = '';
                    $final_total_close_credit = '';
                     $INCOMES = '';
                     $NET_INCOME = '';
                     
                    
                     
                     
                     foreach($incomeStatment as $GLRow):

                             if($GLRow->gl_ad_coa_mc_id >=400000 && $GLRow->gl_ad_coa_mc_id <=499999):
                        $where = array(
                             'gl_ad_coa_mc_pk'                          =>$GLRow->gl_ad_coa_mc_pk,
                             'gl_amount_transition.fn_account_type_id'  => 1,
                             'payment_date <'=>date('Y-m-d', strtotime($this->data['dateFrom'])),
                             );
                         $open_balance       = $this->FinanceModel->open_balance($where);

                             $grandCredit_open   = 0;
                             $grandDebit_open    = 0;
                             $debit_total_open   = 0;
                             $credit_total_open  = 0;

                             foreach($open_balance as $obRow):
                                 $query          = $this->db->where(array('status'=>1,'fn_account_type_id'=>1))->get('financial_year')->row();

                                 $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId       = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));

                             if($parentId->fn_coa_code == 200000):
                                     $debit_total_open       +=$obRow->gl_ad_depit ;
                                     $credit_total_open      +=$obRow->gl_ad_credit;         
                                     $grandCredit_open       = $credit_total_open-$debit_total_open;
                                     $grandDebit_open        = '';
                                 endif;
                                 $count = '';
                                 if($parentId->fn_coa_code == 400000):
                                     $dateDiff   = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
                                     $timeStart  = $dateDiff->format("%R%a"); 
                                     if($timeStart > 0):
                                         $debit_total_open       += $obRow->gl_ad_depit ;
                                         $credit_total_open      += $obRow->gl_ad_credit; 
                                         $grandCredit_open       = $credit_total_open-$debit_total_open;
                                         $grandDebit_open     = '';
                                         else:
                                     endif; 
                                 endif;

                                 if($parentId->fn_coa_code == 300000):

                                            $debit_total_open       +=$obRow->gl_ad_depit ;
                                             $credit_total_open      +=$obRow->gl_ad_credit;
                                        $grandDebit_open = $debit_total_open- $credit_total_open;
                                         $grandCredit_open    = '';
                                 endif;
                                 if($parentId->fn_coa_code == 500000):
                                     $dateDiff = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
                                     $timeStart = $dateDiff->format("%R%a"); 

                                     if($timeStart > 0):
                                         $debit_total_open       += $obRow->gl_ad_depit ;
                                         $credit_total_open      += $obRow->gl_ad_credit;
                                         $grandDebit_open        = $debit_total_open- $credit_total_open;
                                         $grandCredit_open       = '';
                                         else:
                                         endif;
                                 endif;
                             endforeach; 
                             
                                    $final_total_op_debit  += $grandDebit_open;
                                    $final_total_op_credit  += $grandCredit_open;
                         $detail = $this->FinanceModel->get_amountDetails_balance_sheet('gl_amount_transition',
                                 array(
                                     'gl_ad_coa_mc_pk'                          => $GLRow->gl_ad_coa_mc_pk,
                                      'gl_amount_transition.fn_account_type_id' => 1
                                 ),$this->data['dateFrom'],$this->data['toDate']);

                        $credit_total    = '';
                        $debit_total     = '';
                         foreach($detail as $dRow):
                                 $debit_total    +=$dRow->gl_ad_depit;
                                 $credit_total   +=$dRow->gl_ad_credit;
                         endforeach;
                          $final_total_current_debit += $debit_total;
                         $final_total_current_credit += $credit_total;  
                                
                                $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));

                                 if($parentId->fn_coa_code == 200000):
                                        $grandCredit = $credit_total-$debit_total;
                                        $grandDebit     = '';
                                 endif;
                                 if($parentId->fn_coa_code == 400000):
                                        $grandCredit = $credit_total-$debit_total;
                                         $grandDebit     = '';   
                                 endif;

                                 if($parentId->fn_coa_code == 300000):
                                        $grandDebit = $debit_total- $credit_total;
                                         $grandCredit    = '';
                                 endif;
                                 if($parentId->fn_coa_code == 500000):
                                        $grandDebit = $debit_total- $credit_total;
                                 $grandCredit    = '';
                                 endif;
                                 
                                 $grand_open_Dept = $grandDebit+$grandDebit_open;
                                 $final_total_close_debit += $grandDebit+$grandDebit_open;
                                 
                                 $grand_open_Credit = $grandCredit+$grandCredit_open;
                                 $final_total_close_credit +=$grandCredit+$grandCredit_open;
                                
                                   
                        endif;        
                               
                     endforeach;
                       $INCOMES = $final_total_close_credit;

                       $EXPENSES = '';
                     foreach($incomeStatment as $GLRow):

                             if($GLRow->gl_ad_coa_mc_id >=500000 && $GLRow->gl_ad_coa_mc_id <=599999):
                        $where = array(
                             'gl_ad_coa_mc_pk'=>$GLRow->gl_ad_coa_mc_pk,
                             'gl_amount_transition.fn_account_type_id' => 1,
                             'payment_date <'=>date('Y-m-d', strtotime($this->data['dateFrom'])),
                             );
                         $open_balance       = $this->FinanceModel->open_balance($where);

                             $grandCredit_open   = 0;
                             $grandDebit_open    = 0;
                             $debit_total_open   = 0;
                             $credit_total_open  = 0;

                             foreach($open_balance as $obRow):
                                 $query          =  $this->db->where(array('status'=>1,'fn_account_type_id'=>1))->get('financial_year')->row();

                                 $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId       = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));

                             if($parentId->fn_coa_code == 200000):
                                     $debit_total_open       +=$obRow->gl_ad_depit ;
                                     $credit_total_open      +=$obRow->gl_ad_credit;         
                                     $grandCredit_open       = $credit_total_open-$debit_total_open;
                                     $grandDebit_open        = '';
                                 endif;
                                 $count = '';
                                 if($parentId->fn_coa_code == 400000):
                                     $dateDiff   = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
                                     $timeStart  = $dateDiff->format("%R%a"); 
                                     if($timeStart > 0):
                                         $debit_total_open       += $obRow->gl_ad_depit ;
                                         $credit_total_open      += $obRow->gl_ad_credit; 
                                         $grandCredit_open       = $credit_total_open-$debit_total_open;
                                         $grandDebit_open     = '';
                                         else:
                                     endif; 
                                 endif;

                                 if($parentId->fn_coa_code == 300000):

                                            $debit_total_open       +=$obRow->gl_ad_depit ;
                                             $credit_total_open      +=$obRow->gl_ad_credit;
                                        $grandDebit_open = $debit_total_open- $credit_total_open;
                                         $grandCredit_open    = '';
                                 endif;
                                 if($parentId->fn_coa_code == 500000):
                                     $dateDiff = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
                                     $timeStart = $dateDiff->format("%R%a"); 

                                     if($timeStart > 0):
                                         $debit_total_open       += $obRow->gl_ad_depit ;
                                         $credit_total_open      += $obRow->gl_ad_credit;
                                         $grandDebit_open        =  $debit_total_open- $credit_total_open;
                                         $grandCredit_open       =  '';
                                         else:
                                         endif;
                                 endif;
                             endforeach; 
                             
                                    $final_total_op_debit  += $grandDebit_open;
                                    $final_total_op_credit  += $grandCredit_open;
                         $detail = $this->FinanceModel->get_amountDetails_balance_sheet(
                                 'gl_amount_transition',
                                 array(
                                     'gl_ad_coa_mc_pk'                          => $GLRow->gl_ad_coa_mc_pk,
                                      'gl_amount_transition.fn_account_type_id' => 1
                                 ),
                                 $this->data['dateFrom'],$this->data['toDate']);

                        $credit_total    = '';
                        $debit_total     = '';
                         foreach($detail as $dRow):
                                 $debit_total    +=$dRow->gl_ad_depit;
                                 $credit_total   +=$dRow->gl_ad_credit;
                         endforeach;
                          $final_total_current_debit += $debit_total;
                         $final_total_current_credit += $credit_total;  
                                
                                $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));

                                 if($parentId->fn_coa_code == 200000):
                                        $grandCredit = $credit_total-$debit_total;
                                        $grandDebit     = '';
                                 endif;
                                 if($parentId->fn_coa_code == 400000):
                                        $grandCredit = $credit_total-$debit_total;
                                         $grandDebit     = '';   
                                 endif;

                                 if($parentId->fn_coa_code == 300000):
                                        $grandDebit = $debit_total- $credit_total;
                                         $grandCredit    = '';
                                 endif;
                                 if($parentId->fn_coa_code == 500000):
                                        $grandDebit = $debit_total- $credit_total;
                                 $grandCredit    = '';
                                 endif;
                                 
                                 $grand_open_Dept = $grandDebit+$grandDebit_open;
                                 $final_total_close_debit += $grandDebit+$grandDebit_open;
                                 
                                 $grand_open_Credit = $grandCredit+$grandCredit_open;
                                 $final_total_close_credit +=$grandCredit+$grandCredit_open;
                                

                        endif;        
                               
                     endforeach;
                     
                     $EXPENSES = $final_total_close_debit;
                    $result[] =  array(
                                    'Code'          =>  '',
                                    'Title'         =>  'EXPENSES',
                                    'Amount'        =>  '',
                                ); 
                     $NET_INCOME =$final_total_close_credit-$final_total_close_debit;
                     
                    //LIABILITIES  
                   
                    $final_total_op_debit = '';
                    $final_total_op_credit = '';

                    $final_total_current_debit = '';
                    $final_total_current_credit = '';

                    $final_total_close_debit = '';
                    $final_total_close_credit = '';
                    $LIABILITIES = '';
                     foreach($incomeStatment as $GLRow):

                             if($GLRow->gl_ad_coa_mc_id >=200000 && $GLRow->gl_ad_coa_mc_id <=399999):
                        $where = array(
                             'gl_ad_coa_mc_pk'                          => $GLRow->gl_ad_coa_mc_pk,
                              'gl_amount_transition.fn_account_type_id' => 1,
                             'payment_date <'                           =>date('Y-m-d', strtotime($this->data['dateFrom'])),
                             );
                         $open_balance       = $this->FinanceModel->open_balance($where);

                             $grandCredit_open   = 0;
                             $grandDebit_open    = 0;
                             $debit_total_open   = 0;
                             $credit_total_open  = 0;

                             foreach($open_balance as $obRow):
                                 $query          = $this->db->where(array('status'=>1,'fn_account_type_id'=>1))->get('financial_year')->row();

                                 $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId       = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));

                             if($parentId->fn_coa_code == 200000):
                                     $debit_total_open       +=$obRow->gl_ad_depit ;
                                     $credit_total_open      +=$obRow->gl_ad_credit;         
                                     $grandCredit_open       = $credit_total_open-$debit_total_open;
                                     $grandDebit_open        = '';
                                 endif;
                                 $count = '';
                                 if($parentId->fn_coa_code == 400000):
                                     $dateDiff   = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
                                     $timeStart  = $dateDiff->format("%R%a"); 
                                     if($timeStart > 0):
                                         $debit_total_open       += $obRow->gl_ad_depit ;
                                         $credit_total_open      += $obRow->gl_ad_credit; 
                                         $grandCredit_open       = $credit_total_open-$debit_total_open;
                                         $grandDebit_open     = '';
                                         else:
                                     endif; 
                                 endif;

                                 if($parentId->fn_coa_code == 300000):

                                            $debit_total_open       +=$obRow->gl_ad_depit ;
                                             $credit_total_open      +=$obRow->gl_ad_credit;
                                        $grandDebit_open = $debit_total_open- $credit_total_open;
                                         $grandCredit_open    = '';
                                 endif;
                                 if($parentId->fn_coa_code == 500000):
                                     $dateDiff = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
                                     $timeStart = $dateDiff->format("%R%a"); 

                                     if($timeStart > 0):
                                         $debit_total_open       += $obRow->gl_ad_depit ;
                                         $credit_total_open      += $obRow->gl_ad_credit;
                                         $grandDebit_open        = $debit_total_open- $credit_total_open;
                                         $grandCredit_open       = '';
                                         else:
                                         endif;
                                 endif;
                             endforeach; 
                             
                                    $final_total_op_debit  += $grandDebit_open;
                                    $final_total_op_credit  += $grandCredit_open;
                         $detail = $this->FinanceModel->get_amountDetails(
                                 'gl_amount_transition',
                                 array(
                                     'gl_ad_coa_mc_pk'                          => $GLRow->gl_ad_coa_mc_pk,
                                      'gl_amount_transition.fn_account_type_id' => 1
                                 ),
                                 $this->data['dateFrom'],$this->data['toDate']);

                        $credit_total    = '';
                        $debit_total     = '';
                         foreach($detail as $dRow):
                                 $debit_total    +=$dRow->gl_ad_depit;
                                 $credit_total   +=$dRow->gl_ad_credit;
                         endforeach;
                          $final_total_current_debit += $debit_total;
                         $final_total_current_credit += $credit_total;  
                                
                                $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));

                                 if($parentId->fn_coa_code == 200000):
                                        $grandCredit = $credit_total-$debit_total;
                                        $grandDebit     = '';
                                 endif;
                                 if($parentId->fn_coa_code == 400000):
                                        $grandCredit = $credit_total-$debit_total;
                                         $grandDebit     = '';   
                                 endif;

                                 if($parentId->fn_coa_code == 300000):
                                        $grandDebit = $debit_total- $credit_total;
                                         $grandCredit    = '';
                                 endif;
                                 if($parentId->fn_coa_code == 500000):
                                        $grandDebit = $debit_total- $credit_total;
                                 $grandCredit    = '';
                                 endif;
                                 
                                 $grand_open_Dept = $grandDebit+$grandDebit_open;
                                 $final_total_close_debit += $grandDebit+$grandDebit_open;
                                 
                                 $grand_open_Credit = $grandCredit+$grandCredit_open;
                                 $final_total_close_credit +=$grandCredit+$grandCredit_open;
                                
                                 
                                 $result[] =  array(
                                    'Code'          =>  $GLRow->gl_ad_coa_mc_id,
                                    'title'         =>  $GLRow->gl_ad_coa_mc_name,
                                    'close_credit'  =>  $grandCredit+$grandCredit_open,
                                ); 
                        endif;        
                               
                     endforeach;
                     
                      $result[] =  array(
                                    'Code'          =>  '',
                                    'Title'         =>  'NET INCOME [PKR]  ',
                                    'Amount'        =>  $NET_INCOME,
                                ); 
                     
                     
                     $LIABILITIES = $final_total_close_credit+$NET_INCOME;
                     $result[] =  array(
                                    'Code'          =>  '',
                                    'Title'         =>  'TOTAL LIABILITIES [PKR] ',
                                    'Amount'        =>  $LIABILITIES,
                                );
                     $result[] =  array(
                                    'Code'          =>  '',
                                    'Title'         =>  '',
                                    'Amount'        =>  '',
                                );
                     $result[] =  array(
                                    'Code'          =>  '',
                                    'Title'         =>  '',
                                    'Amount'        =>  '',
                                );
                   
                     
                     $final_total_op_debit = '';
                    $final_total_op_credit = '';

                    $final_total_current_debit = '';
                    $final_total_current_credit = '';

                    $final_total_close_debit = '';
                    $final_total_close_credit = '';
                     
                     
                     $ASSETS = '';
                     
                     
                      $result[] =  array(
                                    'Code'          =>  '',
                                    'Title'         =>  'ASSETS',
                                    'Amount'        =>  '',
                                ); 
                     
                     foreach($incomeStatment as $GLRow):

                             if($GLRow->gl_ad_coa_mc_id >=300000 && $GLRow->gl_ad_coa_mc_id <=399999):
                        $where = array(
                             'gl_ad_coa_mc_pk'                          => $GLRow->gl_ad_coa_mc_pk,
                             'gl_amount_transition.fn_account_type_id'  => 1,
                             'payment_date <'=>date('Y-m-d', strtotime($this->data['dateFrom'])),
                             );
                         $open_balance       = $this->FinanceModel->open_balance($where);

                             $grandCredit_open   = 0;
                             $grandDebit_open    = 0;
                             $debit_total_open   = 0;
                             $credit_total_open  = 0;

                             foreach($open_balance as $obRow):
                                 $query          =  $this->db->where(array('status'=>1,'fn_account_type_id'=>1))->get('financial_year')->row();

                                 $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId       = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));

                             if($parentId->fn_coa_code == 200000):
                                     $debit_total_open       +=$obRow->gl_ad_depit ;
                                     $credit_total_open      +=$obRow->gl_ad_credit;         
                                     $grandCredit_open       = $credit_total_open-$debit_total_open;
                                     $grandDebit_open        = '';
                                 endif;
                                 $count = '';
                                 if($parentId->fn_coa_code == 400000):
                                     $dateDiff   = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
                                     $timeStart  = $dateDiff->format("%R%a"); 
                                     if($timeStart > 0):
                                         $debit_total_open       += $obRow->gl_ad_depit ;
                                         $credit_total_open      += $obRow->gl_ad_credit; 
                                         $grandCredit_open       = $credit_total_open-$debit_total_open;
                                         $grandDebit_open     = '';
                                         else:
                                     endif; 
                                 endif;

                                 if($parentId->fn_coa_code == 300000):

                                            $debit_total_open       +=$obRow->gl_ad_depit ;
                                             $credit_total_open      +=$obRow->gl_ad_credit;
                                        $grandDebit_open = $debit_total_open- $credit_total_open;
                                         $grandCredit_open    = '';
                                 endif;
                                 if($parentId->fn_coa_code == 500000):
                                     $dateDiff = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
                                     $timeStart = $dateDiff->format("%R%a"); 

                                     if($timeStart > 0):
                                         $debit_total_open       += $obRow->gl_ad_depit ;
                                         $credit_total_open      += $obRow->gl_ad_credit;
                                         $grandDebit_open        = $debit_total_open- $credit_total_open;
                                         $grandCredit_open       = '';
                                         else:
                                         endif;
                                 endif;
                             endforeach; 
                             
                                    $final_total_op_debit  += $grandDebit_open;
                                    $final_total_op_credit  += $grandCredit_open;
                         $detail = $this->FinanceModel->get_amountDetails(
                                 'gl_amount_transition',
                                 array(
                                     'gl_ad_coa_mc_pk'                          => $GLRow->gl_ad_coa_mc_pk,
                                      'gl_amount_transition.fn_account_type_id' => 1,
                                 ),$this->data['dateFrom'],$this->data['toDate']);

                        $credit_total    = '';
                        $debit_total     = '';
                         foreach($detail as $dRow):
                                 $debit_total    +=$dRow->gl_ad_depit;
                                 $credit_total   +=$dRow->gl_ad_credit;
                         endforeach;
                          $final_total_current_debit += $debit_total;
                         $final_total_current_credit += $credit_total;  
                                
                                $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));

                                 if($parentId->fn_coa_code == 200000):
                                        $grandCredit = $credit_total-$debit_total;
                                        $grandDebit     = '';
                                 endif;
                                 if($parentId->fn_coa_code == 400000):
                                        $grandCredit = $credit_total-$debit_total;
                                         $grandDebit     = '';   
                                 endif;

                                 if($parentId->fn_coa_code == 300000):
                                        $grandDebit = $debit_total- $credit_total;
                                         $grandCredit    = '';
                                 endif;
                                 if($parentId->fn_coa_code == 500000):
                                        $grandDebit = $debit_total- $credit_total;
                                 $grandCredit    = '';
                                 endif;
                                 
                                 $grand_open_Dept = $grandDebit+$grandDebit_open;
                                 $final_total_close_debit += $grandDebit+$grandDebit_open;
                                 
                                 $grand_open_Credit = $grandCredit+$grandCredit_open;
                                 $final_total_close_credit +=$grandCredit+$grandCredit_open;
                                
                               
                                 $result[] =  array(
                                    'Code'          =>  $GLRow->gl_ad_coa_mc_id,
                                    'title'         =>  $GLRow->gl_ad_coa_mc_name,
                                    'close_credit'  =>  $grandDebit+$grandDebit_open,
                                ); 
                        endif;        
                               
                     endforeach;
                    
                      $ASSETS =  $final_total_close_debit;
                             
                     $result[] =  array(
                                    'Code'          =>  '',
                                    'Title'         =>  'TOTAL ASSETS [PKR] ',
                                    'Amount'        =>  $ASSETS ,
                                ); 
                     $grand_check = '';
                     
                     $grand_check = $ASSETS-$LIABILITIES;
                     $value = '';
                     if(empty($grand_check)):
                         $value = 0;
                         else:
                         $value =$grand_check;
                     endif;
                     $result[] =  array(
                                    'Code'          =>  '',
                                    'Title'         =>  'CROSS CHECK = (NET-INCOME - TOTAL ASSETS)  ',
                                    'Amount'        =>  $value,
                                ); 
          
        foreach ($result as $row){
               
                $exceldata[] = $row;
                
        }
        
                    
                // echo '<pre>';print_r($exceldata);die;
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                $date = $this->data['dateFrom'].' To '.$this->data['toDate'];
                $filename='OP Balance Sheet From '.$date.'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
            endif;
                   
        $this->data['page']         = "Finance/OP/Reports/balance_sheet";
        $this->data['page_title']        = 'OP Balance Sheet | ECMS';
        $this->data['page_header']  = 'OP Balance Sheet';
        $this->load->view('common/common',$this->data);
    }
    
    public function bank_reconciliation_statement(){
        
            $this->data['COAP']         = $this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1,'fn_account_type_id'=>1));
            $this->data['tran_type']    = $this->CRUDModel->dropDown('fn_brs_tran_type', 'Selecct Type', 'id', 'tran_type');  
    
        
            $this->data['page']            = "Finance/OP/Forms/op_BRS";
            $this->data['page_title']            = 'OP Bank Reconciliation Statement | ECMS';
            $this->data['page_header']      = 'OP Bank Reconciliation Statement';
            $this->load->view('common/common',$this->data);
             
    }
    public function search_bank_reconciliation_statement(){
                    
             
             
             if($this->input->post()):
                $from_date                  = date('m-Y',strtotime($this->input->post('dateto')));
                $this->data['dateFrom']     = '01-'.$from_date;
                $this->data['toDate']       = $this->input->post('dateto');
                $formCode                   = $this->input->post('formCode');
              
                $this->data['recordTo']     = $this->input->post('recordTo');
                $this->data['recordFrom']   = $this->input->post('recordFrom');
                
                $this->data['recordToCode'] = $this->input->post('recordToCode');
                $this->data['recordFromCode']= $this->input->post('recordFromCode');
 
               $search_brs   =  $this->FinanceModel->search_result_brs(
                       $this->data['dateFrom'], 
                       $this->data['toDate'],
                       $this->data['recordFromCode'] 
                       );
           
               
               echo '
                    <div class="row">
                        <div class="col-md-12" style="margin-left:80px">';
              
               
               if(!empty($search_brs)):
                   $brs_amount = '';
                   foreach($search_brs as $GLRow):
                   
                echo '  
                        
                                <h3 colspan="2" style="border-top: 1px solid #ffff;font-weight: bold;text-decoration:">
                                        '.$GLRow->gl_ad_coa_mc_name.'
                                        <br/>FOR THE MONTH OF '.strtoupper(date('F -Y',strtotime( $this->data['dateFrom']))).'</h3>';
               
                                       
                                                $where = array(
                                                            'gl_ad_coa_mc_pk'=>$GLRow->gl_ad_coa_mc_pk,
                                                             'gl_amount_transition.fn_account_type_id' => 1,
                                                            'payment_date <'=>date('Y-m-d', strtotime($this->data['dateFrom'])),
                                                    );
                                                        $open_balance       = $this->FinanceModel->open_balance($where);
                                                        
//                                                        echo '<pre>';print_r($open_balance);die;
                                                        $grandCredit_open   = 0;
                                                        $grandDebit_open    = 0;
                                                        $debit_total_open   = 0;
                                                        $credit_total_open  = 0;
                                         foreach($open_balance as $obRow):
                                             
                                             
                                                 $query  = $this->db->where('status',1)->get('financial_year')->row();
                                         
                                                $grandDebit             = '';
                                                $grandCredit            = '';
                                                $parentId               =  $this->db->where(array('status'=>1,'fn_account_type_id'=>1))->get('financial_year')->row();
                                                       
                                                    if($parentId->fn_coa_code == 200000):
                                                            $debit_total_open       +=$obRow->gl_ad_depit ;
                                                            $credit_total_open      +=$obRow->gl_ad_credit;         
                                                        
                                                            $grandCredit_open       = $credit_total_open-$debit_total_open;
                                                            $grandDebit_open        = '';
                                                                 
                                                             
                                                        endif;
                                                        $count = '';
                                                        if($parentId->fn_coa_code == 400000):
                                                               $dateDiff = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
                                                                $timeStart = $dateDiff->format("%R%a"); 

                                                            if($timeStart > 0):

                                                                        $debit_total_open       +=$obRow->gl_ad_depit ;
                                                                        $credit_total_open      +=$obRow->gl_ad_credit; 
                                                                        
                                                                        $grandCredit_open = $credit_total_open-$debit_total_open;
                                                            $grandDebit_open     = '';
                                                                else:
                                                            endif; 
                                                        endif;

                                                        if($parentId->fn_coa_code == 300000):
                                                            
                                                                   $debit_total_open       +=$obRow->gl_ad_depit ;
                                                                    $credit_total_open      +=$obRow->gl_ad_credit;
                                                               $grandDebit_open = $debit_total_open- $credit_total_open;
                                                                $grandCredit_open    = '';
                                                        endif;
                                                        if($parentId->fn_coa_code == 500000):
                                                               
                                                            $dateDiff = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));

                                                            $timeStart = $dateDiff->format("%R%a"); 
//                                                          
                                                            if($timeStart > 0):
                                                                $debit_total_open       +=$obRow->gl_ad_depit ;
                                                                $credit_total_open      +=$obRow->gl_ad_credit;
                                                            
                                                                $grandDebit_open = $debit_total_open- $credit_total_open;
                                                                $grandCredit_open    = '';
                                                                 
                                                                else:
                                                               
                                                            endif;
                                                            
                                                            
                                                            
                                                                 
                                                        endif;
                                          endforeach; 
                                                $detail = $this->FinanceModel->get_amountDetails(
                                                        'gl_amount_transition',
                                                        array(
                                                            'gl_ad_coa_mc_pk'=>$GLRow->gl_ad_coa_mc_pk,
                                                             'gl_amount_transition.fn_account_type_id' => 1,
                                                        ),$this->data['dateFrom'],$this->data['toDate']);

                                               $credit_total    = '';
                                               $debit_total     = '';
                                                foreach($detail as $dRow):
                                                    $date=date_create($dRow->payment_date);
                                                 
                                                
                                                       $debit_total +=$dRow->gl_ad_depit;
                                                       $credit_total +=$dRow->gl_ad_credit;
                                                    
                                        
                                            endforeach;
                                       
                                                        $grandDebit     = '';
                                                        $grandCredit    = '';
                                                        $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));
                                                           
                                                        if($parentId->fn_coa_code == 200000):
                                                               $grandCredit = $credit_total-$debit_total;
                                                               $grandDebit     = '';
                                                        endif;
                                                        if($parentId->fn_coa_code == 400000):
                                                               $grandCredit = $credit_total-$debit_total;
                                                                $grandDebit     = '';   
                                                        endif;
                                                        
                                                        if($parentId->fn_coa_code == 300000):
                                                               $grandDebit = $debit_total- $credit_total;
                                                                $grandCredit    = '';
                                                        endif;
                                                        if($parentId->fn_coa_code == 500000):
                                                               $grandDebit = $debit_total- $credit_total;
                                                        $grandCredit    = '';
                                                        endif;
               
                                                        
                                                          $grandDebit     = '';
                                                        $grandCredit    = '';
                                                        $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId));
                                                           
                                                        if($parentId->fn_coa_code == 200000):
                                                               $grandCredit = $credit_total-$debit_total;
                                                               $grandDebit     = '';
                                                        endif;
                                                        if($parentId->fn_coa_code == 400000):
                                                               $grandCredit = $credit_total-$debit_total;
                                                                $grandDebit     = '';   
                                                        endif;
                                                        
                                                        if($parentId->fn_coa_code == 300000):
                                                               $grandDebit = $debit_total- $credit_total;
                                                                $grandCredit    = '';
                                                        endif;
                                                        if($parentId->fn_coa_code == 500000):
                                                               $grandDebit = $debit_total- $credit_total;
                                                        $grandCredit    = '';
                                                        endif;
                             
                                    
                                 $grand_open_Dept = $grandDebit+$grandDebit_open;
                                                           if(!empty($grand_open_Dept)):
//                                                               echo number_format($grandDebit+$grandDebit_open, 0, ',', ',');
                                                           $brs_amount = $grandDebit+$grandDebit_open;
                                                               endif; 
                                                            $grand_open_Credit = $grandCredit+$grandCredit_open;
                                                           if(!empty($grand_open_Credit)):
//                                                              echo  number_format($grandCredit+$grandCredit_open, 0, ',', ',');
                                                           $brs_amount = $grandCredit+$grandCredit_open;
                                                               endif; 
                                
                   
                   
                   
                   endforeach;
                   
                   
                     $data = array(
                        'description' => 'Balance as per Bank Book',
                        'amount'    => $brs_amount,
                        'brs_type'  => 1,
                        'formCode'  => $formCode,
                        'create_by' =>$this->userInfo->user_id,
                        'create_datetime' =>date('Y-m-d H:i:s'),
                  );
                  $this->CRUDModel->insert('fn_brs_report_details_demo',$data);
               endif;
             endif;  
         }
    public function show_result_bank_reconciliation_statument(){
             
             $formCode = $this->input->post('formCode');
             
                                    $this->db->order_by('id','asc');
             $bank_as_per_balance = $this->db->get_where('fn_brs_report_details_demo',array('brs_type'=>1,'formCode'=>$formCode,'create_by'=>$this->userInfo->user_id))->result();
             
              $bank_book = 0;
              if($bank_as_per_balance):
             echo '<div class="table-responsive">  
                        <table  id="table" class="table table-hover" style="font-size:12px" border="1">';
           
                 foreach($bank_as_per_balance as $bnks):
                 echo '<tr>';
                    echo '<td colspan="6" style="text-align:  left;width: 31%">'.$bnks->description.'</td>';
                  
                     echo '<td style="text-align:  right; width: 5%">';
                    
                    if(!empty($bnks->amount)):
                        echo number_format($bnks->amount, 0, ',', ','); 
                    endif;
                    echo '</td>';
                     echo '<td style="text-align:  left; width: 1%">&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="'.$bnks->id.'"  class="btn btn-danger btn-xs deleteUnpresented" ><i class="fa fa-trash"></i> Delete</button></td>';
                    
                    echo '</tr>';
                 echo '</tr>';
                 $bank_book +=$bnks->amount;
                 endforeach;
            
                        
             echo '</table></div">';
              endif;
                                $this->db->order_by('id','asc');
                $unpresented    = $this->db->get_where('fn_brs_report_details_demo',array('brs_type'=>2,'formCode'=>$formCode,'create_by'=>$this->userInfo->user_id))->result();
               $bank_book_unprested_cheks   = 0;
               $unprested_cheks             = 0;
              if($unpresented):
                        echo '<div class="table-responsive">  
                        <table  id="table" class="table table-hover" style="font-size:12px" border="1">';
                        echo '<tr>';
                        echo '<td style="text-align:  center;width: 3%">V#</td>';
                        echo '<td colspan="3" style="text-align:  center;width: 3%">Date</td>';
                        echo '<td style="text-align:  center; width: 3%">Chq</td>';
                        echo '<td style="text-align:  center; width: 5%">Payee</td>';
                        echo '<td style="text-align:  center; width: 5%">Description</td>';
                        echo '<td style="text-align:  center; width: 5%">Amount[PKR]</td>';
                        echo '<td style="text-align:  center; width: 1%"></td>';

                        echo '</tr>';
                        echo '<tr>';
                        echo '<td style="text-align:  center;width: 3%"></td>';
                        echo '<td style="text-align:  center;width: 1%">DD</td>';
                        echo '<td style="text-align:  center; width: 1%">MM</td>';
                        echo '<td style="text-align:  center; width: 1%">YY</td>';
                        echo '<td style="text-align:  center; width: 3%"></td>';
                        echo '<td style="text-align:  center; width: 5%"></td>';
                        echo '<td style="text-align:  center; width: 5%"></td>';
                        echo '<td style="text-align:  center; width: 5%"></td>';
                        echo '<td style="text-align:  center; width: 1%"></td>';
                        echo '</tr>';
                        
                     echo '</tr>';
                     
                   
                 foreach($unpresented as $unpres):
                 echo '<tr id="'.$unpres->id.'Delete">';
                    echo '<td style="text-align:  center;width: 3%">'.$unpres->voucher_no.'</td>';
                    echo '<td style="text-align:  center;width: 1%">'.date('d',strtotime($unpres->date)).'</td>';
                    echo '<td style="text-align:  center;width: 1%">'.date('m',strtotime($unpres->date)).'</td>';
                    echo '<td style="text-align:  center;width: 1%">'.date('Y',strtotime($unpres->date)).'</td>';
                    echo '<td style="text-align:  center; width: 3%">'.$unpres->chq_no.'</td>';
                    echo '<td style="text-align:  left; width: 10%">'.$unpres->payee.'</td>';
                    echo '<td style="text-align:  left; width: 15%">'.$unpres->description.'</td>';
                    echo '<td style="text-align:  right; width: 5%">';
                        if(!empty($unpres->amount)):
                            echo number_format($unpres->amount, 0, ',', ','); 
                        endif;
                    echo '</td>';
                     echo '<td style="text-align:  left; width: 1%">&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="'.$unpres->id.'"  class="btn btn-danger btn-xs deleteUnpresented" ><i class="fa fa-trash"></i> Delete</button></td>';
                    echo '</tr>';
                 echo '</tr>';
                 $unprested_cheks += $unpres->amount;
                 endforeach;
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td colspan="7" style="text-align:  right;">Total[PKR]</td>';
                     echo '<td style="text-align:  right; width: 5%">';
                        if(!empty($unprested_cheks)):
                            echo number_format($unprested_cheks, 0, ',', ','); 
                        endif;
                    echo '</td>';
                    echo '<td style="text-align:  center; width: 5%"></td>';
                    echo '</tr>';
                    $bank_book_unprested_cheks += $unprested_cheks +$bank_book;
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td colspan="7" style="text-align:  right;"><strong>Bank Book [+] Unpresented Cheque</strong></td>';
                     echo '<td style="text-align:  right; width: 5%">';
                        if(!empty($bank_book_unprested_cheks)):
                            echo number_format($bank_book_unprested_cheks, 0, ',', ','); 
                        endif;
                    echo '</td>';
                    echo '<td style="text-align:  center; width: 1%"></td>';
                    echo '</tr>';

                        
             echo '</table></div">';
             
                endif;
                                    $this->db->select(
                                            'fn_brs_report_details_demo.id,
                                            fn_brs_tran_type.tran_type,
                                            fn_brs_report_details_demo.description,
                                            fn_brs_report_details_demo.amount
                                            ');
                                    $this->db->order_by('fn_brs_report_details_demo.id','asc');
                                    $this->db->join('fn_brs_tran_type','fn_brs_tran_type.id=fn_brs_report_details_demo.brs_type');    
             $add_unpres_amount = $this->db->get_where('fn_brs_report_details_demo',array('brs_type'=>3,'formCode'=>$formCode,'create_by'=>$this->userInfo->user_id))->result();
             
             $addition_gAmounts = 0;
              $gAdd_amount      = 0;
               echo '<div class="table-responsive">  
                        <table  id="table" class="table table-hover" style="font-size:12px" border="1">';
              if($add_unpres_amount):
            
                foreach($add_unpres_amount as $add_unp):
                
                 echo '<tr>';
                    echo '<td colspan="2" style="text-align:  left;width: 15%">'.$add_unp->tran_type.'</td>';
                    echo '<td colspan="7" style="text-align:  left;width: 15%">'.$add_unp->description.'</td>';
                     echo '<td style="text-align:  right; width: 5%">';
                    
                    if(!empty($add_unp->amount)):
                        echo number_format($add_unp->amount, 0, ',', ','); 
                    endif;
                    echo '</td>';
                     
                        '<td style="text-align:  center; width: 4.8%"></td>';
                     echo '<td style="text-align:  left; width: 1%">&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="'.$add_unp->id.'"  class="btn btn-danger btn-xs deleteUnpresented" ><i class="fa fa-trash"></i> Delete</button></td>';
                 echo '</tr>';
                 $gAdd_amount +=$add_unp->amount;
                 endforeach;
                
                    echo '<tr>';
                    echo '<td colspan="9" style="text-align:  right;"><strong>Total Addition Amount</strong></td>';
                     echo '<td style="text-align:  right; width: 5%">';
                        if(!empty($gAdd_amount)):
                            echo number_format($gAdd_amount, 0, ',', ','); 
                        endif;
                    echo '</td>';
                   echo  '<td style="text-align:  center; width: 4.8%"></td>';
                  
                    echo '</tr>';
                   
                  
                 
                 
                        
             
              endif;
                                    $this->db->select(
                                        'fn_brs_report_details_demo.id,
                                        fn_brs_tran_type.tran_type,
                                        fn_brs_report_details_demo.description,
                                        fn_brs_report_details_demo.amount
                                    ');
                                    $this->db->order_by('fn_brs_report_details_demo.id','asc');
                                    $this->db->join('fn_brs_tran_type','fn_brs_tran_type.id=fn_brs_report_details_demo.brs_type');    
             $sub_unpres_amount = $this->db->get_where('fn_brs_report_details_demo',array('brs_type'=>4,'formCode'=>$formCode,'create_by'=>$this->userInfo->user_id))->result();
             
              $Sub_gAmounts = 0;
              $gSub_amount = 0;
           
              if($sub_unpres_amount):
             
               
                    foreach($sub_unpres_amount as $sub_unp):
                 echo '<tr>';
                    echo '<td colspan="2" style="text-align:  left;width: 15%">'.$sub_unp->tran_type.'</td>';
                    echo '<td colspan="7" style="text-align:  left;width: 15%">'.$sub_unp->description.'</td>';
                     echo '<td style="text-align:  right; width: 5%">';
                    
                    if(!empty($sub_unp->amount)):
                        echo number_format($sub_unp->amount, 0, ',', ','); 
                    endif;
                    echo '</td>';
                     
                       
                    echo '<td style="text-align:  left; width: 1%">&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="'.$sub_unp->id.'"  class="btn btn-danger btn-xs deleteUnpresented" ><i class="fa fa-trash"></i> Delete</button></td>';
                    echo '</tr>';
                 $gSub_amount +=$sub_unp->amount;
                 endforeach;
                
                    echo '<tr>';
                    echo '<td colspan="9" style="text-align:  right;"><strong>Total Subtraction Amount</strong></td>';
                     echo '<td style="text-align:  right; width: 5%">';
                        if(!empty($gSub_amount)):
                            echo number_format($gSub_amount, 0, ',', ','); 
                        endif;
                    echo '</td>';
                    echo '<td style="text-align:  center; width: 1%"></td>';
                    echo '</tr>';
                   endif;
                   
                   
                   
                      $Sub_gAmounts = $bank_book+$unprested_cheks+$gAdd_amount-$gSub_amount;
                    
                    echo '<tr>';
                    echo '<td colspan="9" style="text-align:  right;"><strong>Balance as per Bank Statement</strong></td>';
                     echo '<td style="text-align:  right; width: 5%">';
                        if(!empty($Sub_gAmounts)):
                            $grand_total = $addition_gAmounts+$Sub_gAmounts;
                            echo number_format($grand_total, 0, ',', ','); 
                        endif;
                    echo '</td>';
                    echo  '<td style="text-align:  center; width: 4.8%"></td>';
                    echo '</tr>';
                 
                 
                        
             echo '</table></div">';
             
             
             
             
             
             
             
               ?>
                
                        <script>
                        jQuery(document).ready(function(){
                          jQuery('.deleteUnpresented').on('click',function(){
                             var deletId = this.id;
                             
                              var formCode        = jQuery('#formCode').val();
                            
                             jQuery.ajax({
                                 type:'post',
                                 url : 'FinanceController/unpresent_check_delte',
                                 data: {'deletId':deletId},
                                 success : function(result){
                                    var del = deletId+'Delete';
                                    jQuery('#'+del).hide(); 
 

                                 },complete : function(result){
            
            jQuery.ajax({
                type    : 'post',
                url     : 'FinanceController/show_result_bank_reconciliation_statument',
                data    : {'formCode':formCode},
                success  : function(result){
                    
                    
                    
                        jQuery('#result_show_brs').show();
                         jQuery('#save_checks').show();
                        jQuery('#result_show_brs').html(result); 
                    
                                            var voch_no         = jQuery('#voch_no').val('');
                                            var unrep_date      = jQuery('#unrep_date').val('');
                                            var chq_no          = jQuery('#chq_no').val('');
                                            var unpres_amount   = jQuery('#unpres_amount').val('');
                                            var payee_name      = jQuery('#payee_name').val('');
                                            var un_rep_desc     = jQuery('#un_rep_desc').val('');

                                        }

                                    });

                                }
                             });
                        
                         });
                         });
                         
                        </script><?php
             
             
              
         }
    public function unpresent_check_delte(){
        $id = $this->input->post('deletId');
         $this->CRUDModel->deleteid('fn_brs_report_details_demo',array('id'=>$id));
    }
    public function insert_unpresent_check(){
             
             $voch_no       = $this->input->post('voch_no');
             $unrep_date    = $this->input->post('unrep_date');
             $chq_no        = $this->input->post('chq_no');
             $unpres_amount = $this->input->post('unpres_amount');
             $payee_name    = $this->input->post('payee_name');
             $un_rep_desc   = $this->input->post('un_rep_desc');
            $formCode       = $this->input->post('formCode');
             

              $data = array(
                        
                        'brs_type'      => 2,
                        'voucher_no'    => $voch_no,
                        'date'          => date('Y-m-d',strtotime($unrep_date)),
                        'chq_no'        => $chq_no,
                        'payee'         => $payee_name,
                        'description'   => $un_rep_desc,
                        'amount'        => $unpres_amount,
                        'formCode'      => $formCode,
                        'create_by'     => $this->userInfo->user_id,
                        'create_datetime' =>date('Y-m-d H:i:s'),
                  );
                  $this->CRUDModel->insert('fn_brs_report_details_demo',$data);
         }
    public function insert_unpresent_tran_amount(){
             
             $tran_type         = $this->input->post('tran_type');
             $add_unpres_amount = $this->input->post('add_unpres_amount');
             $desc              = $this->input->post('desc');
            $formCode           = $this->input->post('formCode');
             
            
              $data = array(
                        
                        'brs_type'      => $tran_type,
                        'description'   => $desc,
                        'amount'        => $add_unpres_amount,
                        'formCode'      => $formCode,
                        'create_by'     => $this->userInfo->user_id,
                        'create_datetime' =>date('Y-m-d H:i:s'),
                  );
                  $this->CRUDModel->insert('fn_brs_report_details_demo',$data);
         }
    public function brs_month_check(){
             $dateto = $this->input->post('dateto');
             $coa = $this->input->post('coa');
             
            $where = array(
              'month(for_month)'=>date('m',strtotime($dateto)),  
              'year(for_month)'=>date('Y',strtotime($dateto)),  
              'COA_id'=>$coa,  
              'fn_account_type_id'=>1  
            );
            $check = $this->db->get_where('fn_brs_report',$where)->row();
             
            if(empty($check)):
                echo  0;
            else:
                echo  1;    
                endif;
             
         }
    public function bank_reconciliation_statement_save(){
        
            
            if($this->input->post()):
                
                 $formCode          = $this->input->post('formCode');
                 $dateto            = $this->input->post('dateto');
                 $recordFromCode    = $this->input->post('recordFromCode');
                 
                 $for_month         = date('Y-m-d',  strtotime($this->input->post('dateto')));
                 $fromdate          = date('m-Y',  strtotime($this->input->post('dateto')));
                 $from_date         = '01-'.$fromdate;
                 
//                 $from_date         = date('Y-m-d',  strtotime($this->input->post('dateto')));
            
                 $tran_data = array(
                    'COA_id'            => $recordFromCode,
                    'date_from'         => date('Y-m-d',strtotime($from_date)),
                    'date_to'           => date('Y-m-d',strtotime($dateto)),
                    'for_month'         =>$for_month,
                    'create_by'         => $this->userInfo->user_id,
                    'create_datetime'   =>date('Y-m-d H:i:s'),
                     'fn_account_type_id'=>1
                 );
//              echo '<pre>';print_r($tran_data);die;   
             $brs_id =  $this->CRUDModel->insert('fn_brs_report',$tran_data);
                $tran_det_where = array(
                        'formCode'      => $formCode,
                        'create_by'     => $this->userInfo->user_id,
                        );
             $tran_details = $this->db->get_where('fn_brs_report_details_demo',$tran_det_where)->result();
             
             foreach($tran_details as $row):
                  $data = array(
                        
                        'brs_id'        => $brs_id,
                        'brs_type'      => $row->brs_type,
                        'voucher_no'    => $row->voucher_no,
                        'date'          => date('Y-m-d',strtotime($row->date)),
                        'chq_no'        => $row->chq_no,
                        'payee'         => $row->payee,
                        'formCode'      => $row->formCode,
                        'description'   => $row->description,
                        'amount'        => $row->amount,
                        'create_by'     => $this->userInfo->user_id,
                        'create_datetime' =>date('Y-m-d H:i:s'),
                  );
                  $this->CRUDModel->insert('fn_brs_report_details',$data);
                   $this->CRUDModel->deleteid('fn_brs_report_details_demo',array('id'=>$row->id));
             endforeach;
                 
           endif;
         
    }      
    public function bank_reconciliation_statement_report(){
        
            $this->data['COAP']         = $this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1,'fn_account_type_id'=>1));
            $this->data['tran_type']    = $this->CRUDModel->dropDown('fn_brs_tran_type', 'Selecct Type', 'id', 'tran_type');  
            
            $this->data['dateTo']           = '';
            $this->data['recordFrom']       = '';
            $this->data['recordFromCode']   = '';
            
            
            if($this->input->post()):
               
                  
                $where['fn_brs_report.fn_account_type_id'] = 1;
                $dateto = $this->input->post('dateto');
                $year   = date('Y',  strtotime($dateto)); 
                $month  = date('m',  strtotime($dateto)); 
                $code   = $this->input->post('recordFromCode');
                $recordFrom   = $this->input->post('recordFrom');
                
                if($dateto):
                   $where['year(for_month)'] = $year;  
                   $where['month(for_month)'] = $month;  
                   
                   $this->data['dateTo']           = date('M Y',  strtotime($dateto));
                endif;
                if($code):
                    $where['COA_id'] = $code;  
                    $this->data['recordFrom']       = $recordFrom;
                    $this->data['recordFromCode']   = $code ;
                endif;
                
                $this->data['result'] = $this->FinanceModel->get_BRS_report($where);
                 
            endif;
            
            $this->data['page']         = "Finance/OP/Reports/BRS_report";
            $this->data['page_title']   = 'OP BRS Report| ECMS';
            $this->data['page_header']  = 'OP BRS Report';
            $this->load->view('common/common',$this->data);
    }     
    public function bank_reconciliation_statement_report_admin(){
        
            $this->data['COAP']         = $this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1,'fn_account_type_id'=>1));
            $this->data['tran_type']    = $this->CRUDModel->dropDown('fn_brs_tran_type', 'Selecct Type', 'id', 'tran_type');  
            
            $this->data['dateTo']           = '';
            $this->data['recordFrom']       = '';
            $this->data['recordFromCode']   = '';
            
            
            if($this->input->post()):
               
                  
                $where['fn_brs_report.fn_account_type_id'] = 1;
                
                $dateto             = $this->input->post('dateto');
                $year               = date('Y',strtotime($dateto)); 
                $month              = date('m',strtotime($dateto)); 
                $code               = $this->input->post('recordFromCode');
                $recordFrom         = $this->input->post('recordFrom');
                
                if($dateto):
                   $where['year(for_month)']    = $year;  
                   $where['month(for_month)']   = $month;  
                   $this->data['dateTo']        = date('M Y',strtotime($dateto));
                endif;
                if($code):
                    $where['COA_id']                = $code;  
                    $this->data['recordFrom']       = $recordFrom;
                    $this->data['recordFromCode']   = $code ;
                endif;
                
                $this->data['result'] = $this->FinanceModel->get_BRS_report($where);
                 
            endif;
            
            $this->data['page']         = "Finance/OP/Reports/BRS_report_admin";
            $this->data['page_title']   = 'OP BRS Report Admin| ECMS';
            $this->data['page_header']  = 'OP BRS Report Admin';
            $this->load->view('common/common',$this->data);
    }     
    public function brs_report_print(){
        
                                        $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=fn_brs_report.COA_id');
            $this->data['title_info'] = $this->db->get_where('fn_brs_report',array('fn_brs_report.fn_account_type_id'=>1,'fn_brs_report.id'=>$this->uri->segment(2)))->row();
            
            $where_type1 = array(
              'fn_brs_report.id'=>$this->uri->segment(2),  
              'brs_type'=>1, 
              'fn_account_type_id'=>1  
            );
            
                                                    $this->db->order_by('fn_brs_report_details.brs_type','asc');
                                                    $this->db->join('fn_brs_report_details','fn_brs_report.id=fn_brs_report_details.brs_id');
             $this->data['bank_as_per_balance']  =  $this->db->get_where('fn_brs_report',$where_type1)->result();
//                     echo '<pre>';print_r($this->data['title_info']);die;
             $where_type2 = array(
              'fn_brs_report.id'=>$this->uri->segment(2),  
              'brs_type'=>2,
              'fn_account_type_id'=>1 
            );
            
                                                    $this->db->order_by('fn_brs_report_details.brs_type','asc');
                                                    $this->db->join('fn_brs_report_details','fn_brs_report.id=fn_brs_report_details.brs_id');
             $this->data['unpresented']  =  $this->db->get_where('fn_brs_report',$where_type2)->result();
            
             $where_type3 = array(
              'fn_brs_report.id'=>$this->uri->segment(2),  
              'brs_type'=>3,
              'fn_account_type_id'=>1    
            );
            
                                                    $this->db->order_by('fn_brs_report_details.brs_type','asc');
                                                    $this->db->join('fn_brs_report_details','fn_brs_report.id=fn_brs_report_details.brs_id');
                                                    $this->db->join('fn_brs_tran_type','fn_brs_tran_type.id=fn_brs_report_details.brs_type'); 
             $this->data['add_unpres_amount']  =  $this->db->get_where('fn_brs_report',$where_type3)->result();
             
             $where_type4 = array(
              'fn_brs_report.id'=>$this->uri->segment(2),  
              'brs_type'=>4,
               'fn_account_type_id'=>1   
            );
            
                                                    $this->db->order_by('fn_brs_report_details.brs_type','asc');
                                                    $this->db->join('fn_brs_report_details','fn_brs_report.id=fn_brs_report_details.brs_id');
                                                    $this->db->join('fn_brs_tran_type','fn_brs_tran_type.id=fn_brs_report_details.brs_type'); 
             $this->data['sub_unpres_amount']  =  $this->db->get_where('fn_brs_report',$where_type4)->result();
             

            
            $this->data['page']         = "Finance/OP/Reports/BRS_report_print";
            $this->data['page_title']   = 'OP BRS Report Print| ECMS';
            $this->data['page_header']  = 'OP BRS Report Print';
            $this->load->view('common/common',$this->data);
    }     
   
    public function brs_report_edit(){
        
            $brs_id                     = $this->uri->segment(2);
            $this->data['tran_type']    = $this->CRUDModel->dropDown('fn_brs_tran_type', 'Selecct Type', 'id', 'tran_type'); 
                                           $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=fn_brs_report.COA_id'); 
            $this->data['report_info']  =  $this->db->get_where('fn_brs_report',array('id'=>$brs_id,'fn_brs_report.fn_account_type_id'=>1))->row();
            $report_details             = $this->db->get_where('fn_brs_report_details',array('brs_id'=>$brs_id))->result();
             
           if($report_details):
               
           
            $this->data['formCode']     = $report_details[0]->formCode;
            
            $this->CRUDModel->deleteid('fn_brs_report_details_demo',array('formCode'=>$report_details[0]->formCode));
            
            foreach($report_details as $row):
                $data = array(
                        
                        'brs_type'      => $row->brs_type,
                        'voucher_no'    => $row->voucher_no,
                        'date'          => date('Y-m-d',strtotime($row->date)),
                        'chq_no'        => $row->chq_no,
                        'payee'         => $row->payee,
                        'formCode'      => $row->formCode,
                        'description'   => $row->description,
                        'amount'        => $row->amount,
                        'create_by'     => $this->userInfo->user_id,
                        'create_datetime' =>date('Y-m-d H:i:s'),
                  );
                  $this->CRUDModel->insert('fn_brs_report_details_demo',$data);
            endforeach;
          
              endif;
             
            
            
            $this->data['page']         = "Finance/OP/Forms/BRS_edit";
            $this->data['page_title']   = 'OP BRS Edit| ECMS';
            $this->data['page_header']  = 'OP BRS Edit';
            $this->load->view('common/common',$this->data);
    }  
    
    public function brs_report_update(){
        if($this->input->post('update_checks')):
                
                    $formCode       = $this->input->post('formCode');
                    $tran_id        = $this->input->post('tran_id');
                    $dateto         = $this->input->post('dateto');
                    $recordFromCode = $this->input->post('recordFromCode');
                    $fDate          = date('m-Y',strtotime($this->input->post('dateto')));
                    $from_date      = '01-'.$fDate;
          
                      
                  
                    $for_month      = date('Y-m-d',  strtotime($this->input->post('dateto')));
                    $tran_where     = array(
                        'id'        => $tran_id);
                    
                    $tran_data          =  array(
                       'COA_id'         => $recordFromCode,
                       'date_from'      => date('Y-m-d',strtotime($from_date)),
                       'date_to'        => date('Y-m-d',strtotime($dateto)),
                       'for_month'      => $for_month,
                       'up_user_id'     => $this->userInfo->user_id,
                       'up_datetime'    => date('Y-m-d H:i:s'),
                    );
 
                $this->CRUDModel->update('fn_brs_report',$tran_data,$tran_where);
                
                    $this->CRUDModel->deleteid('fn_brs_report_details',array('brs_id'=>$tran_id));
                      $tran_det_where = array(
                        'formCode'      => $formCode,
                     );
             $tran_details = $this->db->get_where('fn_brs_report_details_demo',$tran_det_where)->result(); 
             
             foreach($tran_details as $row):
                    
                 $data_insert = array(
                        'brs_id'            => $tran_id,
                        'brs_type'          => $row->brs_type,
                        'voucher_no'        => $row->voucher_no,
                        'date'              => date('Y-m-d',strtotime($row->date)),
                        'chq_no'            => $row->chq_no,
                        'payee'             => $row->payee,
                        'formCode'          => $row->formCode,
                        'description'       => $row->description,
                        'amount'            => $row->amount,
                        'create_by'         => $row->create_by,
                        'create_datetime'   => $row->create_datetime,
                        'update_by'         => $this->userInfo->user_id,
                        'update_datetime'   => date('Y-m-d H:i:s'),
                  );
                    $this->CRUDModel->insert('fn_brs_report_details',$data_insert);
                    $this->CRUDModel->deleteid('fn_brs_report_details_demo',array('id'=>$row->id));
                
             endforeach;
            
            redirect('BRSReportAdmin','refresh'); 
           endif;
    }
     public function general_journal(){
         
        $this->data['dateFrom']         = date('d-m-Y');
        $this->data['dateTo']           = date('d-m-Y');
        $this->data['recordFrom']       = '';
        $this->data['recordFromCode']   = '';
        $this->data['recordFromCode']   = '';
        $this->data['payeeId']          = '';
        $this->data['amount']           = '';
        
        if($this->input->post()):
//            echo '<pre>';print_r($this->input->post());die;
            $dateFrom       = $this->input->post('dateFrom');
            $dateto         = $this->input->post('dateto');
            $recordFrom     = $this->input->post('recordFrom');
            $recordFromCode = $this->input->post('recordFromCode');
            $payeeId        = $this->input->post('payeeId');
            $Supplier       = $this->input->post('Supplier');
            $amount       = $this->input->post('amount');
            
            
         
          
//            $where['gl_amount_transition.fn_account_type_id']      =  1;
            $where      =  '';
            $date       = '';
            $like       = '';
            $amounta    = '';
            
            if($dateFrom):
                 $date['dateform']      = $dateFrom;
                $this->data['dateFrom'] = date('d-m-Y', strtotime($dateFrom));
            endif;
            
            
            if($dateto):
                $date['dateto'] = $dateto;
               $this->data['dateTo'] = date('d-m-Y', strtotime($dateto));
                 
            endif;
           
            if($recordFromCode):
                $where['gl_ad_coa_mc_pk']    = $recordFromCode;
                $this->data['recordFrom']    = $recordFrom;
                $this->data['recordFromCode']= $recordFromCode;
                
            endif;
           
            if($amount):
                 $amounta   = $amount;
                 $this->data['amount']      = $amount; 
            endif;
            
            if($payeeId):
                $like['gl_at_payeeId']      = $payeeId;
                $this->data['payeeId']      = $payeeId; 
            endif;
            $order = '';
            
            if($this->input->post('date_wise')):
                
                $order = 'gl_at_date';
            endif;
            
            if($this->input->post('date_vocher')):
                
               
            endif;
             $this->data['result'] =$this->FinanceModel->get_detail_search_general_journal($where,$date,$like,$amounta,$order);
 
        endif;
        
        
        $this->data['page']         = 'Finance/reports/general_journal_report';
        $this->data['page_header']   = 'General Journal Report';
        $this->data['page_title']   = 'General Journal Report | ECMS';
        $this->load->view('common/common',$this->data);
    }
         public function cheque_prints(){
         
        $gl_id = $this->uri->segment(2);
        
        if(!empty($gl_id)):
                                                $this->db->join('fn_supplier','fn_supplier.fn_supp_id=gl_amount_transition.supplier_id','left outer');  
            $this->data['result']           =   $this->db->get_where('gl_amount_transition',array('gl_at_id'=>$gl_id))->row();
                                                $this->db->join('hr_emp_record','hr_emp_record.emp_id=gl_cheque_signature_list.emp_id'); 
                                                $this->db->order_by('gl_cs_order','asc');
            $this->data['gl_sign_list']     =   $this->db->get_where('gl_cheque_signature_list',array('gl_cs_status'=>1))->result();
            
            
            
             $this->data['bank_COA']       =   $this->DropdownModel->dropDown_coa_chk_print('gl_amount_details', 'Selecct COA', 'fn_coa_mc_id', 'fn_coa_mc_title',array('gl_amount_details.gl_ad_atId'=>$gl_id)); 
             $this->data['cheque_type']    =   $this->CRUDModel->dropDown('gl_bank_cheque_type', 'Selecct Type', 'gl_ct_id', 'gl_ct_title'); 
            
        else:
            redirect('searchVoucher','refresh');
        endif;
        
        $this->data['page']         = 'Finance/OP/Forms/op_bank_cheque_v';
        $this->data['page_header']   = 'Bank Cheque OP';
        $this->data['page_title']   = 'Bank Cheque OP| ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function save_print_cheque(){
           $return_json['e_status']    = false;
           $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
           $return_json['e_type']      = 'WARNING';

           $this->form_validation->set_rules('date', 'Date', 'required', array('required'=>'1'));
           $this->form_validation->set_rules('payee', 'Check Title', 'required', array('required'=>'2'));
           $this->form_validation->set_rules('bank_name', 'Bank', 'required', array('required'=>'3'));
           $this->form_validation->set_rules('cheque_no', 'Cheque No', 'required|numeric', array('required'=>'4','numeric'=>'7'));
           $this->form_validation->set_rules('cheque_amount', 'Cheque Amount', 'required|numeric', array('required'=>'5','numeric'=>'7'));
           $this->form_validation->set_rules('cheque_type', 'Cheque Type', 'required', array('required'=>'6'));
           $this->form_validation->set_rules('SignaturePersons[]', 'Signature Persons', 'required|callback_count_persons', array('required'=>'8','count_persons'=>'9'));

           if ($this->form_validation->run() == FALSE):
               $this->form_validation->set_error_delimiters('', '');
               $fve =  validation_errors();
               switch ($fve):
                   case 1: $return_json['e_text'] = 'Date is required.'; break;
                   case 2: $return_json['e_text'] = 'Check Title is required.'; break;
                   case 3: $return_json['e_text'] = 'Bank is required.'; break;
                   case 4: $return_json['e_text'] = 'Cheque No is required.'; break;
                   case 5: $return_json['e_text'] = 'Cheque Amount is required.'; break;
                   case 6: $return_json['e_text'] = 'Cheque Type is required.'; break;
                   case 7: $return_json['e_text'] = 'Must be number'; break;
                   case 8: $return_json['e_text'] = 'Signature Persons required'; break;
                   case 9: $return_json['e_text'] = 'Please select 2 person for check.'; break;
               endswitch;
             else:

               $check_print_re = $this->db->get_where('gl_bank_cheques',array('gl_id'=> $this->input->post('gl_id')))->row();
               $bank_cheque_id = '';
               if(!empty($check_print_re)):
                   $bank_cheque_id = $check_print_re->gl_bc_id;
               else:
                   $data_bank_cheque = array(
                       'gl_id'       => $this->input->post('gl_id'),
                       'create_by'   => $this->userInfo->user_id,
                       'create_date' => date('Y-m-d H:i:s'),
                       );
                $bank_cheque_id =  $this->CRUDModel->insert('gl_bank_cheques',$data_bank_cheque); 
               endif;  

               
                $data_bank_cheque = array(
                       'gl_bc_id'        => $bank_cheque_id,
                       'check_no'        => $this->input->post('cheque_no'),
                       'payee'           => $this->input->post('payee'),
                       'check_date'      => date('Y-m-d',strtotime($this->input->post('date'))),     
                       'check_amount'    => $this->input->post('cheque_amount'),     
                       'bank_id'         => $this->input->post('bank_name'),     
                       'check_type'      => $this->input->post('cheque_type'),     
                       'checque_status'  => 1,     
                       'create_by'       => $this->userInfo->user_id,
                       'create_date'     => date('Y-m-d H:i:s'),
                   );
                $bank_cheque_det =  $this->CRUDModel->insert('gl_bank_cheque_details',$data_bank_cheque);
                
                $this->CRUDModel->update('gl_amount_transition',array('gl_at_cheque'=>$this->input->post('cheque_no'),'payment_date'=>date('Y-m-d',strtotime($this->input->post('date')))),array('gl_at_id'=>$this->input->post('gl_id')));
                
                $data_log = array(
                        'gl_at_cheque'  => $this->input->post('cheque_no'),
                        'gl_at_id'      => $this->input->post('gl_id'),
                        'log_comments'  => 'Update From Insert check Form',
                        'log_by'        => $this->userInfo->user_id,
                        'log_dateTime'  => date('Y-m-d H:i:s'),
                    
                );
                $this->CRUDModel->insert('gl_amount_transition_log',$data_log);
                $signatureList = $this->input->post('SignaturePersons');

                foreach($signatureList as $row):

                    $data_sign = array(
                     'gl_bcd_id'   => $bank_cheque_det,
                     'emp_id'      => $row,
                     'create_by'   => $this->userInfo->user_id,
                     'create_date' => date('Y-m-d H:i:s'),
                    );
                    $this->CRUDModel->insert('gl_cheque_sign_by',$data_sign);
                endforeach;
            // $this->CRUDModel->update('lms_lecture_details',$data,array('lect_id'=>$this->input->post('lecture_id'))); 

             $return_json = array(
                         'e_status'  => true,
                         'e_icon'    => '<i class="fa fa-check-circle"></i>',
                         'e_type'   => 'SUCCESS',
                         'e_text'    => 'Record Saved successfully.'
                     );

         endif;
           echo json_encode($return_json); 
      }
    public function count_persons(){

           $count = count($this->input->post('SignaturePersons'));           
          if($count >= 2):
              return true;
              else:
              return false;
          endif;
      }
    public function save_print_cheque_result(){

       $this->data['result']  =  $this->FinanceModel->bank_check_record(array('gl_id'=>$this->input->post('gl_id')));
        $this->load->view('Finance/OP/Ajax_Results/check_preview_v',$this->data);
      }
    public function save_print_cheque_edit(){
                                            $this->db->join('gl_bank_cheque_details','gl_bank_cheque_details.gl_bc_id=gl_bank_cheques.gl_bc_id');
        $this->data['BankEdit']         =   $this->db->get_where('gl_bank_cheques',array('gl_bank_cheque_details.gl_bcd_id'=>$this->input->post('gl_bc_id')))->row();
//        
        
        $this->data['bank_COA']       =   $this->DropdownModel->dropDown_coa_chk_print('gl_amount_details', 'Selecct COA', 'fn_coa_mc_id', 'fn_coa_mc_title',array('gl_amount_details.gl_ad_atId'=>$this->input->post('gl_id'))); 
//        echo '<pre>';print_r( $this->data['bank_COA']);die;
//        $this->data['bank_list']        =   $this->CRUDModel->dropDown('gl_bank_list', '', 'gl_bl_id', 'bank_full_name'); 
        $this->data['cheque_type']       = $this->CRUDModel->dropDown('gl_bank_cheque_type', '', 'gl_ct_id', 'gl_ct_title');
        $this->data['cheque_status']     = $this->CRUDModel->dropDown('gl_bank_cheques_status', '', 'gl_bcs_id', 'gl_bcs_title');
                                            $this->db->join('hr_emp_record','hr_emp_record.emp_id=gl_cheque_signature_list.emp_id'); 
                                            $this->db->order_by('gl_cs_order','asc');
        $this->data['gl_sign_list']     =   $this->db->get_where('gl_cheque_signature_list',array('gl_cs_status'=>1))->result();
        $this->load->view('Finance/OP/Ajax_Results/check_edit_v',$this->data);
       }
       public function save_print_cheque_update_record(){
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';

            $this->form_validation->set_rules('dateup', 'Date', 'required', array('required'=>'1'));
            $this->form_validation->set_rules('payeeup', 'Check Title', 'required', array('required'=>'2'));
            $this->form_validation->set_rules('bank_nameup', 'Bank', 'required', array('required'=>'3'));
            $this->form_validation->set_rules('cheque_noup', 'Cheque No', 'required|numeric', array('required'=>'4','numeric'=>'7'));
            $this->form_validation->set_rules('cheque_amountup', 'Cheque Amount', 'required|numeric', array('required'=>'5','numeric'=>'7'));
            $this->form_validation->set_rules('cheque_typeup', 'Cheque Type', 'required', array('required'=>'6'));
            $this->form_validation->set_rules('SignaturePersonsup[]', 'Signature Persons', 'required|callback_count_persons_up', array('required'=>'8','count_persons_up'=>'9'));

            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('', '');
                $fve =  validation_errors();
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Date is required.'; break;
                    case 2: $return_json['e_text'] = 'Check Title is required.'; break;
                    case 3: $return_json['e_text'] = 'Bank is required.'; break;
                    case 4: $return_json['e_text'] = 'Cheque No is required.'; break;
                    case 5: $return_json['e_text'] = 'Cheque Amount is required.'; break;
                    case 6: $return_json['e_text'] = 'Cheque Type is required.'; break;
                    case 7: $return_json['e_text'] = 'Must be number'; break;
                    case 8: $return_json['e_text'] = 'Signature Persons required'; break;
                    case 9: $return_json['e_text'] = 'Please select 2 person for Cheque.'; break;
                endswitch;
              else:


                    $gl_bcd_id              = $this->input->post('gl_bcd_id');
                    $bank_cheque_id         = $this->input->post('gl_bc_id');
//                    
//                    $bc_log_old = $this->db->get_where('gl_bank_cheques',array('gl_bc_id'=>$gl_bcd_id))->row();
//                    $bc_log = array(
//                            'gl_bc_id'      => $bc_log_old->gl_bc_id,
//                            'gl_id'         => $bc_log_old->gl_id,
//                            'create_by'     => $this->userInfo->user_id,
//                            'create_date'   => date('Y-m-d H:i:s'),
//                        );
//                    $this->CRUDModel->insert('gl_bank_cheques_log',$bc_log);    
                    $data_bank_cheque       = array(
                            'gl_id'         => $this->input->post('gl_id'),
                            'update_by'     => $this->userInfo->user_id,
                            'update_date'   => date('Y-m-d H:i:s'),
                        );
                    $this->CRUDModel->update('gl_bank_cheques',$data_bank_cheque,array('gl_bc_id'=>$gl_bcd_id));    

                     $bcd_log_old = $this->db->get_where('gl_bank_cheque_details',array('gl_bcd_id'=>$gl_bcd_id))->row();
                    
                    $bcd_log_data = array(
                      'gl_bcd_id'       => $bcd_log_old->gl_bcd_id,
                      'gl_bc_id'        => $bcd_log_old->gl_bc_id,
                      'check_no'        => $bcd_log_old->check_no,     
                      'check_date'      => date('Y-m-d',strtotime($bcd_log_old->check_date)),     
                      'check_amount'    => $bcd_log_old->check_amount,     
                      'bank_id'         => $bcd_log_old->bank_id,     
                      'payee'           => $bcd_log_old->payee,     
                      'check_type'      => $bcd_log_old->check_type,     
                      'checque_status'  => $bcd_log_old->checque_status,     
                      'update_by'       => $this->userInfo->user_id,
                      'update_date'     => date('Y-m-d H:i:s'),
                    );
                    
                    $this->CRUDModel->insert('gl_bank_cheque_details_log',$bcd_log_data);
                    
                $data_bank_cheque_details = array(
//                      'gl_bc_id'        => $bank_cheque_id,
                      'check_no'        => $this->input->post('cheque_noup'),     
                      'check_date'      => date('Y-m-d',strtotime($this->input->post('dateup'))),     
                      'check_amount'    => $this->input->post('cheque_amountup'),     
                      'bank_id'         => $this->input->post('bank_nameup'),     
                      'payee'           => $this->input->post('payeeup'),     
                      'check_type'      => $this->input->post('cheque_typeup'),     
                      'checque_status'  => $this->input->post('cheque_statusup'),     
                      'update_by'       => $this->userInfo->user_id,
                      'update_date'     => date('Y-m-d H:i:s'),
                    );
                $this->CRUDModel->update('gl_bank_cheque_details',$data_bank_cheque_details,array('gl_bcd_id'=>$gl_bcd_id));
                $this->CRUDModel->update('gl_amount_transition',array('gl_at_cheque'=>$this->input->post('cheque_noup'),'payment_date'=>date('Y-m-d',strtotime($this->input->post('dateup')))),array('gl_at_id'=>$this->input->post('gl_id')));
                
                $data_log = array(
                        'gl_at_cheque'  => $this->input->post('cheque_noup'),
                        'gl_at_id'      => $this->input->post('gl_id'),
                        'log_comments'  => 'Update From Update cheque Form',
                        'log_by'        => $this->userInfo->user_id,
                        'log_dateTime'  => date('Y-m-d H:i:s'),
                    
                );
                $this->CRUDModel->insert('gl_amount_transition_log',$data_log);
                $signatureList_log = $this->CRUDModel->get_where_result('gl_cheque_sign_by',array('gl_bcd_id'=>$gl_bcd_id));
                
                 foreach($signatureList_log as $LogRow):

                     $data_sign = array(
                      'gl_bcd_id'   => $LogRow->gl_bcd_id,
                      'emp_id'      => $LogRow->emp_id,
                      'update_by'   => $this->userInfo->user_id,
                      'update_date' => date('Y-m-d H:i:s'),
                     );
                     $this->CRUDModel->insert('gl_cheque_sign_by_log',$data_sign);
                 endforeach;
                
               
                $this->CRUDModel->deleteid('gl_cheque_sign_by',array('gl_bcd_id'=>$gl_bcd_id));
                
                $signatureList = $this->input->post('SignaturePersonsup');

                 foreach($signatureList as $row):

                     $data_sign = array(
                      'gl_bcd_id'   => $gl_bcd_id,
                      'emp_id'      => $row,
                      'create_by'   => $this->userInfo->user_id,
                      'create_date' => date('Y-m-d H:i:s'),
                     );
                     $this->CRUDModel->insert('gl_cheque_sign_by',$data_sign);
                 endforeach;
              $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'   => 'SUCCESS',
                          'e_text'    => 'Record Saved successfully.'
                      );

          endif;
            echo json_encode($return_json); 
       }
    public function save_print_cheque_update_record_without_log(){
            $return_json['e_status']    = false;
            $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
            $return_json['e_type']      = 'WARNING';

            $this->form_validation->set_rules('dateup', 'Date', 'required', array('required'=>'1'));
            $this->form_validation->set_rules('payeeup', 'Check Title', 'required', array('required'=>'2'));
            $this->form_validation->set_rules('bank_nameup', 'Bank', 'required', array('required'=>'3'));
            $this->form_validation->set_rules('cheque_noup', 'Cheque No', 'required|numeric', array('required'=>'4','numeric'=>'7'));
            $this->form_validation->set_rules('cheque_amountup', 'Cheque Amount', 'required|numeric', array('required'=>'5','numeric'=>'7'));
            $this->form_validation->set_rules('cheque_typeup', 'Cheque Type', 'required', array('required'=>'6'));
            $this->form_validation->set_rules('SignaturePersonsup[]', 'Signature Persons', 'required|callback_count_persons_up', array('required'=>'8','count_persons_up'=>'9'));

            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('', '');
                $fve =  validation_errors();
                switch ($fve):
                    case 1: $return_json['e_text'] = 'Date is required.'; break;
                    case 2: $return_json['e_text'] = 'Check Title is required.'; break;
                    case 3: $return_json['e_text'] = 'Bank is required.'; break;
                    case 4: $return_json['e_text'] = 'Cheque No is required.'; break;
                    case 5: $return_json['e_text'] = 'Cheque Amount is required.'; break;
                    case 6: $return_json['e_text'] = 'Cheque Type is required.'; break;
                    case 7: $return_json['e_text'] = 'Must be number'; break;
                    case 8: $return_json['e_text'] = 'Signature Persons required'; break;
                    case 9: $return_json['e_text'] = 'Please select 2 person for check.'; break;
                endswitch;
              else:
                    $gl_bcd_id              = $this->input->post('gl_bcd_id');
                    $bank_cheque_id         = $this->input->post('gl_bc_id');
//                    
//                    $bc_log_old = $this->db->get_where('gl_bank_cheques',array('gl_bc_id'=>$gl_bcd_id))->row();
//                    $bc_log = array(
//                            'gl_bc_id'      => $bc_log_old->gl_bc_id,
//                            'gl_id'         => $bc_log_old->gl_id,
//                            'create_by'     => $this->userInfo->user_id,
//                            'create_date'   => date('Y-m-d H:i:s'),
//                        );
//                    $this->CRUDModel->insert('gl_bank_cheques_log',$bc_log);    
                    $data_bank_cheque       = array(
                            'gl_id'         => $this->input->post('gl_id'),
                            'update_by'     => $this->userInfo->user_id,
                            'update_date'   => date('Y-m-d H:i:s'),
                        );
                    $this->CRUDModel->update('gl_bank_cheques',$data_bank_cheque,array('gl_bc_id'=>$gl_bcd_id));    

//                    $bcd_log_old = $this->db->get_where('gl_bank_cheque_details',array('gl_bcd_id'=>$gl_bcd_id))->row();
//                    
//                    $bcd_log_data = array(
//                      'gl_bcd_id'        => $bcd_log_old->gl_bcd_id,
//                      'gl_bc_id'        => $bcd_log_old->gl_bc_id,
//                      'check_no'        => $bcd_log_old->check_no,     
//                      'check_date'      => date('Y-m-d',strtotime($bcd_log_old->check_date)),     
//                      'check_amount'    => $bcd_log_old->check_amount,     
//                      'bank_id'         => $bcd_log_old->bank_id,     
//                      'payee'           => $bcd_log_old->payee,     
//                      'check_type'      => $bcd_log_old->check_type,     
//                      'checque_status'  => $bcd_log_old->checque_status,     
//                      'create_by'       => $this->userInfo->user_id,
//                      'create_date'     => date('Y-m-d H:i:s'),
//                    );
//                    
//                    
//                    $this->CRUDModel->insert('gl_bank_cheque_details_log',$bcd_log_data);


                 $data_bank_cheque_details = array(
//                      'gl_bc_id'        => $bank_cheque_id,
                      'check_no'        => $this->input->post('cheque_noup'),     
                      'check_date'      => date('Y-m-d',strtotime($this->input->post('dateup'))),     
                      'check_amount'    => $this->input->post('cheque_amountup'),     
                      'bank_id'         => $this->input->post('bank_nameup'),     
                      'payee'           => $this->input->post('payeeup'),     
                      'check_type'      => $this->input->post('cheque_typeup'),     
                      'checque_status'  => $this->input->post('cheque_statusup'),     
                      'update_by'       => $this->userInfo->user_id,
                      'update_date'     => date('Y-m-d H:i:s'),
                    );
                 $this->CRUDModel->update('gl_bank_cheque_details',$data_bank_cheque_details,array('gl_bcd_id'=>$gl_bcd_id));

                 
                 $this->CRUDModel->update('gl_amount_transition',array('gl_at_cheque'=>$this->input->post('cheque_noup'),'payment_date'=>date('Y-m-d',strtotime($this->input->post('dateup')))),array('gl_at_id'=>$this->input->post('gl_id')));
                
                $data_log = array(
                        'gl_at_cheque'  => $this->input->post('cheque_noup'),
                        'gl_at_id'      => $this->input->post('gl_id'),
                        'log_comments'  => 'Update From Update check Form',
                        'log_by'        => $this->userInfo->user_id,
                        'log_dateTime'  => date('Y-m-d H:i:s'),
                    
                );
                $this->CRUDModel->insert('gl_amount_transition_log',$data_log);
                    
                 $this->CRUDModel->deleteid('gl_cheque_sign_by',array('gl_bcd_id'=>$gl_bcd_id));
                 $signatureList = $this->input->post('SignaturePersonsup');

                 foreach($signatureList as $row):

                     $data_sign = array(
                      'gl_bcd_id'   => $gl_bcd_id,
                      'emp_id'      => $row,
                      'create_by'   => $this->userInfo->user_id,
                      'create_date' => date('Y-m-d H:i:s'),
                     );
                     $this->CRUDModel->insert('gl_cheque_sign_by',$data_sign);
                 endforeach;
             // $this->CRUDModel->update('lms_lecture_details',$data,array('lect_id'=>$this->input->post('lecture_id'))); 

              $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'   => 'SUCCESS',
                          'e_text'    => 'Record Saved successfully.'
                      );

          endif;
            echo json_encode($return_json); 
       }
    public function count_persons_up(){
         
            $count = count($this->input->post('SignaturePersonsup'));           
           if($count >= 2):
               return true;
               else:
               return false;
           endif;
       }
    public function cheque_print_setting(){
        $gl_bcd_id =$this->uri->segment(2);
                                  $this->db->select('check_date,payee,check_amount,check_type,gl_ct_title');
                                  $this->db->join('gl_bank_cheque_type','gl_bank_cheque_type.gl_ct_id=gl_bank_cheque_details.check_type');
        $this->data['result']   = $this->db->get_where('gl_bank_cheque_details',array('gl_bcd_id'=>$gl_bcd_id))->row();
//        echo '<pre>';print_r($this->data['result']);die;
                    
        $this->load->view('Finance/OP/print/op_print_vochers_cheque',$this->data);
     }     
    public function get_date(){
        $this->db->join('gl_amount_transition','gl_amount_transition.gl_at_id=gl_amount_details.gl_ad_atId')->where('gl_ad_dates BETWEEN "'.date('Y-m-d', strtotime('2016-11-01')).'" and "'.date('Y-m-d', strtotime('2016-11-30')).'"')->get('gl_amount_details')->result();
    }     
    public function bank_coa_amount(){
        
        $return_json['e_status']    = false;
        $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
        $return_json['e_type']      = 'WARNING';

            $this->form_validation->set_rules('coa_id', 'COA', 'required', array('required'=>'1'));
            $this->form_validation->set_rules('gl_d_id', 'PK Id', 'required', array('required'=>'2'));
                    
            if ($this->form_validation->run() == FALSE):
                $this->form_validation->set_error_delimiters('', '');
                $fve =  validation_errors();
                switch ($fve):
                    case 1: $return_json['e_text'] = 'COA is required.'; break;
                    case 2: $return_json['e_text'] = 'PK is required.'; break;
                    
                endswitch;
              else:
                $amount = $this->db->get_where('gl_amount_details',array('gl_ad_coa_mc_pk'=>$this->input->post('coa_id'),'gl_ad_atId'=>$this->input->post('gl_d_id')))->row();
                  if($amount->gl_ad_credit == 0):
                    $return_json['e_status']    = false;
                    $return_json['e_icon']      = '<i class="fa fa-exclamation-triangle"></i>';
                    $return_json['e_type']      = 'WARNING';
                    $return_json['e_text']      = 'Please Select Correct Head';
                    else:
                      $amount = $this->db->get_where('gl_amount_details',array('gl_ad_coa_mc_pk'=>$this->input->post('coa_id'),'gl_ad_atId'=>$this->input->post('gl_d_id')))->row();
                    
                    $return_json = array(
                          'e_status'  => true,
                          'e_icon'    => '<i class="fa fa-check-circle"></i>',
                          'e_type'   => 'SUCCESS',
                          'e_text'    => 'Record Saved successfully.',
                          'e_amount'    => $amount->gl_ad_credit
                      );
                  endif;
                  
              endif;
           echo json_encode($return_json); 
    }   
 public function cheque_print_setting_fonts(){
        $gl_bcd_id =$this->uri->segment(2);
                                  $this->db->select('check_date,payee,check_amount,check_type,gl_ct_title');
                                  $this->db->join('gl_bank_cheque_type','gl_bank_cheque_type.gl_ct_id=gl_bank_cheque_details.check_type');
        $this->data['result']   = $this->db->get_where('gl_bank_cheque_details',array('gl_bcd_id'=>$gl_bcd_id))->row();
//        echo '<pre>';print_r($this->data['result']);die;
                    
        $this->load->view('Finance/OP/print/op_print_vochers_cheque_fonts',$this->data);
     }
     
     public function vouchers_sign_by(){
                   
                    
        if($this->input->post('save_record')):
            $chk_trns = $this->input->post('checked');
            if($chk_trns):
                
                foreach($chk_trns as $row=>$key):
                    $sing_persons = $this->CRUDModel->get_where_row('fn_vocher_approvalby',array('id'=>$key));
                     $aprl_data = array(
                            'trns_ab_amount_trans_id'  => $this->input->post('transactions_id'),  
                            'trns_ab_emp_id'           => $sing_persons->fn_va_emp_id,  
                            'trns_ab_name'             => $sing_persons->name,  
                            'trns_ab_designation'      => $sing_persons->designation,  
                            'trns_ab_fy_id'            => $sing_persons->fn_va_fy_id,  
                            'trns_ab_account_type_id'  => $sing_persons->fn_account_type_id,  
                            'trns_ab_appr_order'       => $sing_persons->appr_order,  
                            'trns_ab_status'           => $sing_persons->status,  
                            'create_date_time'         => date('Y-m-d H:i:s'),  
                            'create_by'                => $this->userInfo->user_id,  
                          );
                          $this->CRUDModel->insert('gl_at_aprove_by',$aprl_data);
            endforeach;
                redirect('VoucherSign/'.$this->input->post('transactions_id'));
            endif;
 
        endif;
        $voucher_id = $this->uri->segment(2);
        
        
                                                $this->db->join('hr_emp_record','hr_emp_record.emp_id=fn_vocher_approvalby.fn_va_emp_id','left outer'); 
                                                
                                                $this->db->order_by('appr_order','asc');
        $this->data['upd_apr_by']           =   $this->db->get_where('fn_vocher_approvalby',array('status'=>1,'fn_account_type_id'=>1))->result();
        
//        echo '<pre>';print_r($this->data['upd_apr_by']);die;
//        
                                            $this->db->join('hr_emp_record','hr_emp_record.emp_id=gl_at_aprove_by.trns_ab_emp_id','left outer'); 
                                            $this->db->order_by('trns_ab_appr_order','asc');
        $this->data['fnYear']           =   $this->db->get_where('gl_at_aprove_by',array('trns_ab_status'=>1,'trns_ab_amount_trans_id'=>$voucher_id))->result();
        
        $this->data['voucher_info']         = $this->FinanceModel->voucher_info(array('gl_at_id'=>$voucher_id));
        $this->data['chart_of_acct']    = $this->FinanceModel->chart_of_acct(array('gl_ad_atId'=>$voucher_id));
        
        $this->data['page']             = "Finance/OP/Forms/op_finance_sign_by_v";
        $this->data['page_heading']     = "OP Voucher Sign By";
        $this->data['page_title']       = 'OP Voucher Sign By | ECMS';
        $this->load->view('common/common',$this->data);
    }
    
    public function vouchers_sign_by_delete(){
        $deletId = $this->uri->segment(2);
        
       $this->CRUDModel->deleteid('gl_at_aprove_by',array('trns_ab_id'=>$deletId));
       redirect('VoucherSign/'.$this->uri->segment(3));
    }
}