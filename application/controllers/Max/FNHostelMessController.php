<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');
class FNHostelMessController extends AdminController {

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
            
    public function hm_voucher_approval_persons(){
        
        if($this->input->post()):
         //Insert Code 
        $designation    = $this->input->post('designation');
        $name           = $this->input->post('name');
        $order          = $this->input->post('order');
        $status         = $this->input->post('status');
        $fy_id          = $this->input->post('fy_id');
        $time_stamp     = date('Y-m-d H:i:s');
         
        

         if($fy_id):

             $data = array(
             'designation'  =>$designation,
             'name'         =>$name,
             'appr_order'   =>$order,
             'status'       =>$status,
             'up_user_id'   =>$this->userInfo->user_id,
             'up_timestamp' =>$time_stamp,
             );
         
             $where = array('id'=>$fy_id);
             $this->CRUDModel->update('fn_vocher_approvalby',$data,$where);
             redirect('HmApprovalPersons');
             else:
                 $data = array(
                    'designation'           => $designation,
                    'name'                  => $name,
                    'appr_order'            => $order,
                    'fn_account_type_id'    => 2,
                     'status'               =>'1',
                    'user_id'               => $this->userInfo->user_id,
                    'timestamp'             => $time_stamp,
                    );
                $this->CRUDModel->insert('fn_vocher_approvalby',$data);
                 redirect('HmApprovalPersons');
             endif;

        endif;

        $id = $this->uri->segment(2);
        if($id):
            $this->data['update_row']   = $this->CRUDModel->get_where_row('fn_vocher_approvalby',array('id'=>$id));
        endif;
                                            $this->db->select('fn_vocher_approvalby.*,fn_account_types.title');
                                            $this->db->join('fn_account_types','fn_account_types.id=fn_vocher_approvalby.fn_account_type_id');    
        $this->data['fnYear']           = $this->db->get_where('fn_vocher_approvalby',array('fn_account_type_id'=>2))->result();
        $this->data['page']             = "Finance/HM/Setups/hm_finance_approval_persons";
        $this->data['page_heading']     = "HM Approval Persons";
        $this->data['page_title']       = 'HM Approval Persons | ECMS';
        $this->load->view('common/common',$this->data);
    } 
    public function voucher_approval_delete_hostel_and_mess(){
       $deletId = $this->uri->segment(2);
       $this->CRUDModel->deleteid('fn_vocher_approvalby',array('id'=>$deletId,'fn_account_type_id' => 2,));
       redirect('HmApprovalPersons');
   }
    public function hm_chart_of_account(){
        $this->data['coa_id_type'] = 2;
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
             'fn_coa_code'          =>$code,
             'fn_coa_title'         =>strtoupper($title),
             'fn_coa_commnet'       =>$comments,
             'fn_coa_udpateTime'    =>$currnetDate,
             'fn_coa_UpdateUser'    =>$this->userInfo->user_id,
             'fn_coa_status'        =>$status,
             );

             $where = array('fn_coaId'=>$coa_id);
             $this->CRUDModel->update('fn_coa_parent',$data,$where);
             redirect('COA_prents');
             else:
                 $data = array(
                    'fn_coa_code'       => $code,
                    'fn_coa_title'      => strtoupper($title),
                    'fn_coa_commnet'    => $comments,
                    'fn_account_type_id'=> 2,
                    'fn_coa_timestamp'  => $currnetDate,
                    'fn_coa_userId'     => $this->userInfo->user_id,
                    );
                $this->CRUDModel->insert('hm_fn_coa_parent',$data);
                 redirect('COA_prents');
             endif;

        endif;

        $COA_id = $this->uri->segment(2);
        if($COA_id):
            $this->data['coaResult']    = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$COA_id));
        endif;
                                            $this->db->select('fn_coa_parent.*,fn_account_types.title');
                                            $this->db->join('fn_account_types','fn_account_types.id=fn_coa_parent.fn_account_type_id');   
//        $this->data['coa']              =   $this->db->get_where('fn_coa_parent',array('fn_coa_trash'=>1))->result();
        $this->data['coa']              =   $this->db->get_where('fn_coa_parent',array('fn_coa_trash'=>1,'fn_account_type_id'=>2))->result();
        $this->data['page']             = "Finance/HM/Setups/hm_coa_parents";
        $this->data['page_title']       = 'HM Chart of Accounts| ECMS';
        $this->data['page_header']       = 'HM Chart of Accounts';
        $this->load->view('common/common',$this->data);

    }
    
     public function hm_coa_master_child(){
          $this->data['coa_id_type'] = 2;
           if($this->input->post()):
             //Insert Code 
             $code          = $this->input->post('code');
             $title         = $this->input->post('title');
             $comments      = $this->input->post('comments');
             $COAPId        = $this->input->post('COAP');
             $coa_id        = $this->input->post('coa_id');
             $status        = $this->input->post('coa_status');
             $currnetDate   =  date('Y-m-d H:i:s');
             $userInfo      = $this->getUser();
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
                 redirect('HmCOAChild');
                 else:
                     $data = array(
                        'fn_coa_m_pId'          =>$COAPId,
                        'fn_coa_m_code'         =>$code,
                        'fn_coa_m_title'        =>strtoupper($title),
                        'fn_coa_m_comments'     =>$comments,
                        'fn_account_type_id'    =>2,
                        'fn_coa_m_timestamp'    =>$currnetDate,
                        'fn_coa_m_userId'       =>$this->userInfo->user_id,
                        );
                    $this->CRUDModel->insert('fn_coa_master_child',$data);
                     redirect('HmCOAChild');
                 endif;
             
            endif;
            
            $COA_id = $this->uri->segment(2);
            if($COA_id):
                $this->data['coaResult']    = $this->CRUDModel->get_where_row('fn_coa_master_child',array('fn_coa_m_cId'=>$COA_id));
            endif;
            
            $wherePrg                       = array(
                                                'fn_coa_status' =>'1',
                                                'fn_account_type_id'    =>2,
                                                'fn_coa_trash'  =>1);
            $this->data['COAP']             = $this->CRUDModel->dropDown('fn_coa_parent', 'Select Account Head', 'fn_coaId', 'fn_coa_title',$wherePrg);  
            $where                          = array(
                                                'fn_coa_trash'          =>1,
                                                'fn_coa_master_child.fn_account_type_id'    =>2,
                                                'fn_coa_status'         =>1,
                                                'fn_coa_m_trash'        =>1);
            $this->data['coa_master']       = $this->FinanceModel->coa_master('fn_coa_master_child',$where);
           
            $this->data['page']             = "Finance/HM/Setups/hm_coa_master_child";
            $this->data['page_title']       = 'HM Chart of Accounts| ECMS';
            $this->data['page_header']      = 'HM Chart of Accounts';
            $this->load->view('common/common',$this->data);
     
        }
        
    public function hm_coa_master_sub_child(){
            
             $this->data['coa_id_type'] = 2;
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
                    redirect('HmCOASubChild');
                   else:
                $data  = array(
                   'fn_coa_pId'         =>$coa_parent_id,
                   'fn_coa_mc_mId'      =>$coa_master_child,
                   'fn_coa_mc_code'     =>$master_subChild_code,
                   'fn_account_type_id' =>2,
                   'fn_coa_mc_title'    =>strtoupper($title),
                   'fn_coa_mc_comments' =>$comments,
                   'fn_coa_mc_timestamp'=>date('Y-m-d H:i:s'),
                   'fn_coa_mc_userId'   =>$this->userInfo->user_id,
                       );
               $this->CRUDModel->insert('fn_coa_master_sub_child',$data);
               redirect('HmCOASubChild');
               endif;
            endif;
            
            $COA_id = $this->uri->segment(2);
             
            if($COA_id):
                
//                $this->data[] = 
                $this->data['master_subResult'] = $this->FinanceModel->coa_master_subChildRow('fn_coa_master_sub_child',array('fn_coa_mc_id'=>$COA_id));
                
            endif;
            
            $wherePrg                   = array(
                'fn_coa_status'         =>'1',
                'fn_account_type_id'    =>'2'
                
                );
            $this->data['COAP']         = $this->CRUDModel->dropDown('fn_coa_parent', 'Select Account Head', 'fn_coaId', 'fn_coa_title',$wherePrg);  
           $where = array(
              'fn_coa_mc_trash'     =>1, 
              'fn_coa_m_trash'      =>1, 
              'fn_coa_trash'        =>1, 
              'fn_coa_status'       =>1, 
              'fn_coa_master_sub_child.fn_account_type_id'  =>2, 
              'fn_coa_m_status'     =>1, 
               
           );
            $this->data['master_sub']   = $this->FinanceModel->coa_master_subChild('fn_coa_master_sub_child',$where); 
//            echo '<pre>';print_r($this->data['COAP']);die;
            $this->data['page']         = "Finance/HM/Setups/hm_coa_master_sub_child";
            $this->data['page_title']        = 'HM Master Sub Child| ECMS';
            $this->data['page_header']  = 'HM Master Sub Child';
            $this->load->view('common/common',$this->data);
        }
    public function hm_financial_year(){
        
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
                 'fn_account_type_id'   => 2, 
                 'id !='                => $fy_id 
             );
             $active = $this->CRUDModel->get_where_row('financial_year',$whereAc);
//             echo '<pre>';print_r($fy_id);die;
             if($active):
                 $this->session->set_flashdata('financial_year', 'Allowed only 1 Active Year');
                 else:
                    $where = array('id'=>$fy_id);
                    $this->CRUDModel->update('financial_year',$data,$where);
                    redirect('HmFinanceYear');
             endif;
          else:
                 $data = array(
                    'year'               => $year,
                    'year_start'         => date('Y-m-d', strtotime($start)),
                    'year_end'           => date('Y-m-d', strtotime($end)),
                    'user_id'            => $this->userInfo->user_id,
                    'timestamp'          => $time_stamp,
                    'fn_account_type_id' => 2,
                     'status'            => 0,
                    );
                $this->CRUDModel->insert('financial_year',$data);
                 redirect('HmFinanceYear');
             endif;

        endif;

        $id = $this->uri->segment(2);
        if($id):
            $this->data['update_row']    = $this->CRUDModel->get_where_row('financial_year',array('id'=>$id));
        endif;                          $this->db->select('fn_account_types.title,financial_year.*');
                                        $this->db->join('fn_account_types','fn_account_types.id=financial_year.fn_account_type_id');    
        $this->data['fnYear']       =   $this->db->get_where('financial_year',array('fn_account_type_id'=>2))->result();
        $this->data['page']             = "Finance/HM/Setups/hm_financial_year";
        $this->data['page_heading']     = "HM Finincial Year";
        $this->data['page_title']       = 'HM Finincial Year | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function hm_finance_supplier(){
        if($this->input->post()):
            
             
            //Insert Code 
            $company_name      = $this->input->post('company_name');
            $proper_name       = $this->input->post('proper_name');
            $businerss_name    = $this->input->post('businerss_name');
            $address           = $this->input->post('address');
            $phone_no          = $this->input->post('phone_no');
            $ntn               = $this->input->post('ntn');
            $sale_tax          = $this->input->post('sale_tax');
            $supp_id           = $this->input->post('supp_id');
            $time_stamp        = date('Y-m-d H:i:s');
         
        

         if($supp_id):

             $data = array(
             'company_name'         =>$company_name,
             'propertier_name'      =>$proper_name,
             'business_details'     =>$businerss_name,
             'address'              =>$address,
             'phone_no'             =>$phone_no,
             'fn_account_type_id'   => 2,
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
                    'ntn'                  =>$ntn,
                     'fn_account_type_id'   => 2,
                    'sale_tax_no'          =>$sale_tax,
                    'user_id'              =>$this->userInfo->user_id,
                    'timestamp'            =>$time_stamp,
                    );
                $this->CRUDModel->insert('fn_supplier',$data);
                 redirect('HmFnSupplier');
             endif;

        endif;

        $id = $this->uri->segment(2);
        if($id):
            $this->data['supp_row']    = $this->CRUDModel->get_where_row('fn_supplier',array('fn_supp_id'=>$id));
        endif;
                                          $this->db->join('fn_account_types','fn_account_types.id=fn_supplier.fn_account_type_id');  
        $this->data['FnSupplier']       = $this->db->get_where('fn_supplier',array('fn_account_type_id'=>2))->result();
//        echo '<pre>';print_r($this->data['FnSupplier']);die;
        $this->data['page']             = "Finance/HM/Setups/hm_finance_supplier";
        $this->data['page_title']       = 'HM Finance Supplier| ECMS';
        $this->data['page_header']      = 'HM Finance Supplier';
        $this->load->view('common/common',$this->data);
    }
    
    public function hm_financial_year_budget(){
        
          $this->data['COAP'] =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1,'fn_account_type_id'=>2));
         $this->data['financialYear']    = $this->CRUDModel->dropDown('financial_year','', 'id', 'year',array('status'=>1,'fn_account_type_id'=>2));  
       
        $this->data['fnYearBduget']     = $this->FinanceModel->get_financial_budget('fn_year_budget',array('financial_year.status'=>1,'fn_year_budget.fn_account_type_id'=>2));
        
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
              'fn_account_type_id'=>2,
              'user_id'         => $this->userInfo->user_id,
              'timestamp'       => date('Y-m-d H:i:s'),
          );
        
        $this->CRUDModel->insert('fn_year_budget',$data);
            
        
        endforeach;
          $this->CRUDModel->deleteid('fn_year_budget_demo',array('formCode'=>$formCode));
          redirect('HmFyBudget');
        endif;
        
        $this->data['page']             = "Finance/HM/Setups/hm_financial_year_budget";
        $this->data['page_header']      = "HM Finincial Year Budget";
        $this->data['page_title']       = 'HM Finincial Year Budget | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function hm_autocomplete_amount(){
        
//        $term = trim(strip_tags($_GET['term']));
            $term = trim(strip_tags($this->input->get('term')));
            $where = array(
                   'fn_coa_mc_status'   => 1, 
                   'fn_coa_mc_trash'    => 1, 
                   'fn_account_type_id' => 2, 
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
    public function hm_bank_voucher(){
      
            $query1                         = $this->db->where(array('status'=>'1','fn_account_type_id'=>2))->get('financial_year')->row();
            $vocherNum                      = $this->CRUDModel->get_max_value('gl_at_vocher','gl_amount_transition',array('gl_fy_id'=>$query1->id,'fn_account_type_id'=>2));
//           echo '<pre>';print_r($query1);die;
//        $vocherNum                      = $this->CRUDModel->get_max_where('gl_at_vocher','gl_amount_transition');
//            $this->data['stt']              = $this->CRUDModel->dropDown('fn_trm_type','', 'ftt_id', 'ftt_title');  
            $this->data['financialYear']    = $this->CRUDModel->dropDown('financial_year','', 'id', 'year',array('status'=>1,'fn_account_type_id'=>2));  
            $this->data['voucherType']      = $this->CRUDModel->dropDown('fn_voucher_type','Select Vocher Type', 'id', 'voch_name',array('status'=>1,'fn_account_type_id'=>2));  
            $this->data['voucher_attach']    = $this->CRUDModel->get_where_result('fn_attachments',array('status'=>1));
            $this->data['voucher_status']    = $this->CRUDModel->dropDown('fn_vocher_status','', 'id', 'status_title',array('status'=>1)); 
            
            if(empty($vocherNum->gl_at_vocher)):
                $this->data['vocherId']     = 1;
                else:
                 $this->data['vocherId']     = $vocherNum->gl_at_vocher+1;    
                //$this->data['vocherId']     = 1;
            endif;
            
            $this->data['COAP'] =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1,'fn_account_type_id'=>2));
        $this->data['page']         = 'Finance/HM/Forms/hm_bank_vochers';
        $this->data['page_header']  = 'HM Bank Vochers';
        $this->data['page_title']   = 'HM Bank Vochers | ECMS';
        $this->load->view('common/common',$this->data);  
    }
    public function hm_check_date_range(){
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
   public function hm_save_vouchers(){
           
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
                'fn_account_type_id'    => 2,
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
           
            $this->CRUDModel->deleteid('gl_amount_details_demo',array('gl_ad_formCode'=>$formCode));
            $msg = array('msg'=>'Record Successfully Updated','status'=>2)  ;  
                else:
                $msg = array('msg'=>'Credit Amount = ('.$gl_ad_credit.') Not equal to  Debit Amount = ('.$gl_ad_depit.') Please Check Transition Amount','status'=>1)  ;
            endif;
           
            
            redirect('HmVoucherPrint/'.$atInsert);
    endif;
    }    
    public function hm_print_vouchers(){
        
        $voucher_id = $this->uri->segment(2);
        $where = array(
            'gl_at_id'=>$voucher_id
        );
        $this->data['voucher_info']         = $this->FinanceModel->voucher_info($where);
        //attachment details
        $where_att = array(
            'amount_tra_id'=>$voucher_id
        );
        $this->data['attachment_details']   = $this->FinanceModel->attach_details($where_att);
        
        //Chart of account Info 
        $where_chart_of_acct = array(
            'gl_ad_atId'=>$voucher_id
        );
        
     
      $order['column']  = 'appr_order';
      $order['order']   = 'asc';
        $this->data['approval']         = $this->CRUDModel->get_where_result_order('fn_vocher_approvalby',array('status'=>1,'fn_account_type_id'=> 2),$order); 
        
        $this->data['chart_of_acct']    = $this->FinanceModel->chart_of_acct($where_chart_of_acct);
        $this->data['page']             = "Finance/HM/print/hm_print_vochers";
        $this->data['page_title']            = 'HM Vocher| ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function hm_finance_voucher_search(){
        $this->data['voucher_status_ml']   = $this->CRUDModel->dropDown('fn_vocher_status','Voucher Status', 'id', 'status_title',array('status'=>1)); 
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
          'fn_account_type_id'  =>2  
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
            $where                      = '';
            $where['fn_account_type_id']=  '2';
            $processdate                =  '';
            $payDate                    =  '';
            $like                       =  '';
            $deposit_amount             = '';
            
             
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
                $where['gl_amount_transition.vocher_status']     = $vocher_status;
                $this->data['statusid']     = $vocher_status;  
            endif;
            if($desc):
                $like['gl_at_description']  = $desc;
                $this->data['desc']         = $desc;  
            endif;
           
            $this->data['result'] =$this->FinanceModel->search_date_range($where,$processdate,$like,$payDate,$deposit_amount);
 endif;
        
        
        $this->data['page']         = 'Finance/HM/Search/hm_finance_voucher_search';
        $this->data['page_header']   = 'HM Finance Voucher Search';
        $this->data['page_title']   = 'HM Finance Voucher Search | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function hm_finance_voucher_search_with_cheque_print(){
        $this->data['voucher_status_ml']   = $this->CRUDModel->dropDown('fn_vocher_status','Voucher Status', 'id', 'status_title',array('status'=>1)); 
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
          'fn_account_type_id'  =>2  
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
            $where                      = '';
            $where['fn_account_type_id']=  '2';
            $processdate                =  '';
            $payDate                    =  '';
            $like                       =  '';
            $deposit_amount             = '';
            
             
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
                $where['gl_amount_transition.vocher_status']     = $vocher_status;
                $this->data['statusid']     = $vocher_status;  
            endif;
            if($desc):
                $like['gl_at_description']  = $desc;
                $this->data['desc']         = $desc;  
            endif;
           
            $this->data['result'] =$this->FinanceModel->search_date_range($where,$processdate,$like,$payDate,$deposit_amount);
 endif;
        
        
        $this->data['page']         = 'Finance/HM/Search/hm_search_voucher_cheque_print';
        $this->data['page_header']   = 'HM Finance Voucher Search';
        $this->data['page_title']   = 'HM Finance Voucher Search | ECMS';
        $this->load->view('common/common',$this->data);
    }
     public function hm_finance_voucher_search22(){
        $this->data['voucher_status']                       = $this->CRUDModel->dropDown('fn_vocher_status','Select Status', 'id', 'status_title',array('status'=>1)); 
        $date['from_date'] = $this->data['from_date']       = date('d-m-Y');
        $date['to_date'] = $this->data['to_date']           = date('d-m-Y');
        $this->data['voucehr_no']                           = '';
        $this->data['statusid']                             = '';
        
        $where = array(
          'vocher_status'=>1,  
          'fn_account_type_id'=>2  
        );
        $this->data['result'] =$this->FinanceModel->search_date_range_limit($where,$date);
        
        if($this->input->post()):
            $from_date                 = $this->input->post('from_date');
            $to_date                    = $this->input->post('to_date');
            $voucher_id                 = $this->input->post('voucher_id');
            $vocher_status              = $this->input->post('voucher_status');
            
            $where['fn_account_type_id']=  2;
//            $date['from_date']        = $from_date;
//            $date['to_date']          = $to_date;
           
            if($from_date):
                $date['from_date']         = $from_date;
                $this->data['from_date']    = $from_date;  
            endif;
            if($to_date):
                $date['to_date']         = $to_date;
                $this->data['to_date']   = $to_date;  
            endif;
            if($voucher_id):
                $where ['gl_at_id'] = $voucher_id;
                $this->data['voucehr_no']   = $voucher_id;  
            endif;
            
            if($vocher_status):
                $where ['vocher_status'] = $vocher_status;
                $this->data['statusid']   = $vocher_status;  
            endif;
            
             
            $this->data['result'] =$this->FinanceModel->search_date_range($where,$date);
 
        endif;
 
        
        $this->data['page']         = 'Finance/HM/Search/hm_finance_voucher_search';
        $this->data['page_header']   = 'HM Finance Voucher Search';
        $this->data['page_title']   = 'HM Finance Voucher Search | ECMS';
        $this->load->view('common/common',$this->data);
    }  
    
    public function hm_bank_voucher_edit(){
         
            $vocherNum                      = $this->CRUDModel->get_max_where('gl_at_vocher','gl_amount_transition',array('fn_account_type_id'=>2));
           
            $this->data['stt']              = $this->CRUDModel->dropDown('fn_trm_type','', 'ftt_id', 'ftt_title');  
            

            $this->data['employee_drop']      = $this->FinanceModel->dropDownEmployee('hr_emp_record','Select Employee', 'emp_id', 'emp_name');  
            $this->data['supplier_drop']      = $this->CRUDModel->dropDown('fn_supplier','Select Supplier', 'fn_supp_id', 'company_name');  
            $this->data['financialYear']    = $this->CRUDModel->dropDown('financial_year','', 'id', 'year',array('fn_account_type_id'=>2));  
            $where = array(
                'gl_at_id'          => $this->uri->segment(2),
                'fn_account_type_id'=> 2
                    );
            $this->data['update_records']   =$this->FinanceModel->get_update_record('gl_amount_transition',$where);
            
            
            $this->data['voucherType']      = $this->CRUDModel->dropDown('fn_voucher_type','Select Vocher Type', 'id', 'voch_name',array('status'=>1,'fn_account_type_id'=> 2));  
            $this->data['voucher_attach']    = $this->CRUDModel->get_where_result('fn_attachments',array('status'=>1));
            $this->data['voucher_status']    = $this->CRUDModel->dropDown('fn_vocher_status','', 'id', 'status_title',array('status'=>1)); 
            
            
            if(empty($vocherNum->gl_at_vocher)):
                $this->data['vocherId']     = 1;
                else:
                 $this->data['vocherId']     = $vocherNum->gl_at_vocher+1;    
   
            endif;
            
            $this->data['COAP'] =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1,'fn_account_type_id'=> 2));

           
            
           // echo '<pre>';print_r($this->data['vocherId']);die;
            $this->data['page']         = "Finance/HM/Forms/hm_bank_voucher_edit";
            $this->data['page_title']        = 'HM Update Bank Voucher| ECMS';
            $this->data['page_header']  = 'HM Update Bank Voucher';
            $this->load->view('common/common',$this->data);
    }
    public function hm_save_amount_update(){
 
        $userInfo = $this->getUser();
        if($this->input->post()):
            
            
            
         
            $invoice_date       = date('Y-m-d', strtotime($this->input->post('invoice_date')));
            $payment_date       = date('Y-m-d', strtotime($this->input->post('payment_date')));
            $empId              = $this->input->post('payee');
            $supplier_id         = $this->input->post('supplier_id');
            $employee_id         = $this->input->post('employee_id');
            $financial          = $this->input->post('financial');
            $voucherType        = $this->input->post('voucherType');
            $description        = $this->input->post('description');
            $cheque             = $this->input->post('cheque');
            $voucher_status     = $this->input->post('voucher_status');
             
            $formCode           = $this->input->post('formCode');
            $account_id         = $this->input->post('account_id');
            $print_value2       = $this->input->post('print_value2');
            
            $voucher_att        = $this->input->post('voucher_att');
            
            
            
            $atData = array(
                'gl_at_date'            => $invoice_date,
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
                'payment_date'          => $payment_date,
                
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
                    'gl_ad_date'            => $invoice_date,
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
          
            redirect('HmVoucherPrint/'.$account_id);
            
            
//         echo    json_encode($msg);
            
       endif;
    }
      public function hm_voucher_approval(){
          
            $this->data['voucher_status']       = $this->CRUDModel->dropDown('fn_vocher_status','', 'id', 'status_title',array('status'=>1)); 
            $where = array('gl_at_id'           => $this->uri->segment(2));
            $this->data['update_records']       = $this->FinanceModel->get_update_record('gl_amount_transition',$where);

            if($this->input->post()):
                $cheque         = $this->input->post('cheque');
                $trans_id       = $this->input->post('trans_id');
                $payment_date   = $this->input->post('payment_date');
                $voucher_no     = $this->input->post('voucher_no');
                $voucher_status = $this->input->post('voucher_status');
                 
                $voucher_exist = $this->CRUDModel->get_where_row('gl_amount_transition',array('gl_at_id'=>$trans_id,'fn_account_type_id'=> 2));
                  
                  
                 if($voucher_exist->gl_at_vocher == 0):
                     //auto define
                        $query1 = $this->db->where('status','1')->get('financial_year')->row();
                        $check_voch_whrer = array(
                           'gl_fy_id'           => $query1->id, 
                           'gl_at_vocher'       => $voucher_no,
                            'fn_account_type_id'=> 2
                             
                        );
                        $voucher_check = $this->CRUDModel->get_where_row('gl_amount_transition',$check_voch_whrer);
                      
                     if(empty($voucher_check)):
                          $data = array(
                                        'gl_at_cheque'      => $cheque,  
                                        'payment_date'      => date('Y-m-d', strtotime($payment_date)),  
                                        'gl_at_vocher'      => $voucher_no,  
                                        'vocher_status'     => $voucher_status,
                                        'fn_account_type_id'=> 2
                                      );
                                  $where = array(
                                      'gl_at_id'=>$trans_id
                                  );
                                       $this->CRUDModel->update('gl_amount_transition',$data,$where);
                                       
                                       redirect('HmSearchVoucher');
                         else:
                          $this->session->set_flashdata('voucher_exist', 'Voucher Number Already Exist 1');
                             redirect('HmVoucherApproval/'.$trans_id);
                     endif;
                     
                    
                 else:
                   
                     
                     //33 
                     
                     //Check If exist 
                      $query1 = $this->db->where('status','1')->get('financial_year')->row();
                        $check_voch_whrer = array(
                           'gl_fy_id'=>$query1->id, 
                           'gl_at_vocher'=>$voucher_no,
                            'gl_at_id !='=>$trans_id,
                             'fn_account_type_id'=> 2
                        );
                        $voucher_check = $this->CRUDModel->get_where_row('gl_amount_transition',$check_voch_whrer);
                      
                        if(!empty($voucher_check)):
                             $this->session->set_flashdata('voucher_exist', 'Voucher Number Already Exist 2');
                             redirect('HmSearchVoucher/'.$trans_id);
                            else:
                                     $data = array(
                                        'gl_at_cheque' =>$cheque,  
                                        'payment_date' =>date('Y-m-d', strtotime($payment_date)),  
                                        'gl_at_vocher' =>$voucher_no,  
                                        'vocher_status' =>$voucher_status,
                                          'fn_account_type_id'=> 2
                                      );
                                  $where = array(
                                      'gl_at_id'=>$trans_id
                                  );
                                       $this->CRUDModel->update('gl_amount_transition',$data,$where);
                                       redirect('HmSearchVoucher');
                        endif;
                 
                 endif;
               
            endif;
//            echo '<pre>';print_r($this->data);die;
            $this->data['page']         = "Finance/HM/Forms/hm_finance_voucher_approval";
            $this->data['page_title']        = 'HM Voucher Approval| ECMS';
            $this->data['page_header']  = 'HM Voucher Approval';
            $this->load->view('common/common',$this->data);
    }
     public function hm_bank_reconciliation_statement(){
        
            $this->data['COAP']         = $this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1,'fn_account_type_id'=>2));
            $this->data['tran_type']    = $this->CRUDModel->dropDown('fn_brs_tran_type', 'Selecct Type', 'id', 'tran_type');  
    
        
            $this->data['page']             = "Finance/HM/Forms/hm_BRS";
            $this->data['page_title']       = 'HM Bank Reconciliation Statement | ECMS';
            $this->data['page_header']      = 'HM Bank Reconciliation Statement';
            $this->load->view('common/common',$this->data);
    }
        public function hm_brs_month_check(){
             $dateto = $this->input->post('dateto');
             $coa = $this->input->post('coa');
             
            $where = array(
              'month(for_month)'=>date('m',strtotime($dateto)),  
              'year(for_month)'=>date('Y',strtotime($dateto)),  
              'COA_id'=>$coa,  
              'fn_account_type_id'=>2  
            );
            $check = $this->db->get_where('fn_brs_report',$where)->row();
             
            if(empty($check)):
                echo  0;
            else:
                echo  1;    
                endif;
             
         }
    public function hm_search_bank_reconciliation_statement(){
                    
             
             
             if($this->input->post()):
                $from_date = date('m-Y',  strtotime($this->input->post('dateto')));
                $this->data['dateFrom']       = '01-'.$from_date;
                $this->data['toDate']         = $this->input->post('dateto');
                $formCode                       = $this->input->post('formCode');
              
                $this->data['recordTo']       = $this->input->post('recordTo');
                $this->data['recordFrom']     = $this->input->post('recordFrom');
                
                $this->data['recordToCode']       = $this->input->post('recordToCode');
                $this->data['recordFromCode']     = $this->input->post('recordFromCode');
 
               $search_brs   =  $this->FinanceModel->search_result_brs_hm(
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
                                                $parentId               = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId));
                                                       
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
                                                        array('gl_ad_coa_mc_pk'=>$GLRow->gl_ad_coa_mc_pk),$this->data['dateFrom'],$this->data['toDate']);

                                               $credit_total    = '';
                                               $debit_total     = '';
                                                foreach($detail as $dRow):
                                                    $date=date_create($dRow->payment_date);
                                                 
                                                
                                                       $debit_total +=$dRow->gl_ad_depit;
                                                       $credit_total +=$dRow->gl_ad_credit;
                                                    
                                        
                                            endforeach;
                                       
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
        public function hm_show_result_bank_reconciliation_statument(){
             
             $formCode = $this->input->post('formCode');
             
                                    $this->db->order_by('id','asc');
             $bank_as_per_balance = $this->db->get_where('fn_brs_report_details_demo',array('brs_type'=>1,'formCode'=>$formCode,'create_by'=>$this->userInfo->user_id))->result();
             
              $bank_book = 0;
              if($bank_as_per_balance):
             echo '<div class="table-responsive">  
                        <table  id="table" class="table table-hover" style="font-size:12px" border="1">';
           
                 foreach($bank_as_per_balance as $bnks):
                 echo '<tr>';
                    echo '<td colspan="7" style="text-align:  left;width: 31%">'.$bnks->description.'</td>';
                  
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
               $g_total                    = 0;
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
                        else:
                            echo '0';
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
                    
                      $g_total = $bank_book+$unprested_cheks+$gAdd_amount-$gSub_amount;
                    
                    echo '<tr>';
                    echo '<td colspan="9" style="text-align:  right;"><strong>Balance as per Bank Statement</strong></td>';
                     echo '<td style="text-align:  right; width: 5%">';
                        if(!empty($g_total)):
                            echo number_format($g_total, 0, ',', ','); 
                        else:
                            echo '0';
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
                                 url : 'FNHostelMessController/hm_unpresent_check_delte',
                                 data: {'deletId':deletId},
                                 success : function(result){
                                    var del = deletId+'Delete';
                                    jQuery('#'+del).hide(); 
 

                                 },complete : function(result){
            
            jQuery.ajax({
                type    : 'post',
                url     : 'FNHostelMessController/hm_show_result_bank_reconciliation_statument',
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
    public function hm_unpresent_check_delte(){
        $id = $this->input->post('deletId');
         $this->CRUDModel->deleteid('fn_brs_report_details_demo',array('id'=>$id));
    }
    
       public function insert_unpresent_tran_amount_hm(){
             
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
   public function hm_bank_reconciliation_statement_save(){
        
            
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
                     'fn_account_type_id'=>2
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
    
      public function hm_balance_sheet(){
                $this->data['dateFrom']     = date('d-m-Y');
                $this->data['dateTo']       = date('d-m-Y');
            
            
            if($this->input->post('search')):
               $this->data['dateFrom']       = $this->input->post('dateFrom');
                $this->data['dateTo']         = $this->input->post('dateto');
                $where = array(
                  'gl_amount_transition.fn_account_type_id'=>2  
                );
               $this->data['balance_sheet']   =  $this->FinanceModel->hm_income_statement(
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
                $this->excel->getActiveSheet()->setTitle('HM Balance Sheet');
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
                                 $query          = $this->db->where(array('status'=>1,'fn_account_type_id'=>2))->get('financial_year')->row();

                                 $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId       = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>2));

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
                                 $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>2));

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
                                 $query          =  $this->db->where(array('status'=>1,'fn_account_type_id'=>2))->get('financial_year')->row();

                                 $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId       = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>2));

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
                                 $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>2));

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
                                 $query          = $this->db->where(array('status'=>1,'fn_account_type_id'=>2))->get('financial_year')->row();

                                 $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId       = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>2));

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
                                 $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>2));

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
                                 $query          =  $this->db->where(array('status'=>1,'fn_account_type_id'=>2))->get('financial_year')->row();

                                 $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId       = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>2));

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
                                 $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>2));

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
                $filename='HM Balance Sheet From '.$date.'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
            endif;
                   
        $this->data['page']         = "Finance/HM/Reports/hm_balance_sheet";
        $this->data['page_title']        = 'HM Balance Sheet | ECMS';
        $this->data['page_header']  = 'HM Balance Sheet';
        $this->load->view('common/common',$this->data);
    }
    
    public function hm_trail_balance_new(){
                $this->data['dateFrom']       = date('d-m-Y');
                $this->data['toDate']         = date('d-m-Y');
        
            if($this->input->post('search')):
               
                $this->data['dateFrom']       = $this->input->post('dateFrom');
                $this->data['toDate']         = $this->input->post('dateto');
                
                $this->data['recordTo']       = $this->input->post('recordTo');
                $this->data['recordFrom']     = $this->input->post('recordFrom');
                
                $this->data['recordToCode']   = $this->input->post('recordToCode');
                $this->data['recordFromCode'] = $this->input->post('recordFromCode');
                
            $this->data['TrailBalanceFullHeads']   =  $this->FinanceModel->hm_trail_balance_new('gl_amount_details',
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
                $this->excel->getActiveSheet()->setTitle('HM TRAIL BALANCE');
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
                
               $GeneralLeader =  $this->FinanceModel->hm_trail_balance_new('gl_amount_details',
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
                          'gl_amount_transition.fn_account_type_id' => 2,
                             'payment_date <'=>date('Y-m-d', strtotime($this->data['dateFrom'])),
                             );
                         $open_balance       = $this->FinanceModel->open_balance($where);

                             $grandCredit_open   = 0;
                             $grandDebit_open    = 0;
                             $debit_total_open   = 0;
                             $credit_total_open  = 0;

                             foreach($open_balance as $obRow):
                                 $query          =  $this->db->where(array('status'=>1,'fn_account_type_id'=>2))->get('financial_year')->row();

                                 $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId       = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>2));
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
                                     $timeStart = $dateDiff->format("%R%a"); 

                                     if($timeStart > 0):
                                         $debit_total_open       += $obRow->gl_ad_depit ;
                                         $credit_total_open      += $obRow->gl_ad_credit;
                                         $grandDebit_open        = $debit_total_open- $credit_total_open;
                                         $grandCredit_open       = '';
                                         else:
                                         endif;
                                 endif;
                                 endif;
                             
                                 
                                 

                                
                                
                             endforeach; 
                             
                                    $final_total_op_debit  += $grandDebit_open;
                                    $final_total_op_credit  += $grandCredit_open;
                            

                         $detail = $this->FinanceModel->get_amountDetails(
                                 'gl_amount_transition',
                                 array(
                                     'gl_ad_coa_mc_pk'=>$GLRow->gl_ad_coa_mc_pk,
                                      'gl_amount_transition.fn_account_type_id' => 2
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
                                 $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>2));
                                  if(!empty($parentId)):
                                    if($parentId->fn_coa_code == 200000):
                                        $grandCredit = $credit_total-$debit_total;
                                        $grandDebit     = '';
                                 endif;
                                  endif;
                                  if(!empty($parentId)):
                                    if($parentId->fn_coa_code == 400000):
                                        $grandCredit = $credit_total-$debit_total;
                                         $grandDebit     = '';   
                                    endif;  
                                  endif;
                                  if(!empty($parentId)):
                                     if($parentId->fn_coa_code == 300000):
                                        $grandDebit = $debit_total- $credit_total;
                                         $grandCredit    = '';
                                 endif; 
                                  endif;
                                  if(!empty($parentId)):
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
                $filename='HM TRIAL BALANCE From '.$date.'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
            endif;
                    
               
              
           
        
             $this->data['page']            = "Finance/HM/Reports/hm_trail_balance_new";
            $this->data['page_title']       = 'HM Trial Balance | ECMS';
            $this->data['page_header']      = 'HM Trial Balance';
            $this->load->view('common/common',$this->data);
    }
    
     public function hm_trial_balance(){
        
            $this->data['fromDate']       = date('d-m-Y');
            $this->data['toDate']         = date('d-m-Y');
        
        if($this->input->post('export')):
            $date['fromDate']       = $this->input->post('dateFrom');
            $date['toDate']         = $this->input->post('todate');
            
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('HM Trial balance');
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
         
        $this->data['page']         = 'Finance/HM/Reports/hm_trial_balance';
        $this->data['page_title']   = 'HM Trial Balance | ECMS';
        $this->data['page_header']   = 'HM Trial Balance';
        $this->load->view('common/common',$this->data);
    }
    
    public function hm_trial_balance_detail(){
     
        
                $fromDate       = $this->input->post('dateFrom');
                $toDate         = $this->input->post('todate');
               
                $where = array(
                   'fn_coa_status'  =>1,
                   'fn_coa_trash'   =>1, 
                   'fn_account_type_id'=>2
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
                                                             
                                                                $master_child = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_pId'=>$GLRow->fn_coaId,'fn_account_type_id'=>2));
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
                                                                                $where_TB['gl_amount_transition.fn_account_type_id']    =2;
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
                                    </div>
                                </div>';
        
    }
    
    
     public function hm_general_ledger(){
        
            $this->data['COAP'] =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1,'fn_account_type_id'=>2));
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
                

               $this->data['GeneralLeader']   =  $this->FinanceModel->hm_get_leader_dw('gl_amount_details',
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
                $this->excel->getActiveSheet()->setTitle('HM General Ledger');
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
                
               $GeneralLeader =  $this->FinanceModel->hm_get_leader_dw('gl_amount_details',
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
                        array(
                                'gl_ad_coa_mc_pk'=>$GLRow->gl_ad_coa_mc_pk,
                             'gl_amount_transition.fn_account_type_id' => 2
                                ),$this->data['dateFrom'],$this->data['toDate']);
                        $credit_total    = '';
                        $debit_total     = '';
                        
                        $gl_ad_coa_mc_name = '';
                        foreach($detail as $dRow):
                            $date=date_create($dRow->gl_at_date);
                             if($dRow->gl_ad_depit):
                                                            
                                $vocDet = array(
                                'gl_ad_atId'=>$dRow->gl_at_id,
                                'gl_ad_depit '=>'');
                                             $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');   
                            $VocDetail =    $this->db->get_where('gl_amount_details',$vocDet)->result();

                            foreach($VocDetail as $VCName):

                                    if($VCName == $dRow->gl_ad_coa_mc_id):
                                        else:
                                             $gl_ad_coa_mc_name =  $VCName->fn_coa_mc_title.',';
                                    endif;

                            endforeach;
                                else:

                                 $vocDet = array(
                                'gl_ad_atId'=>$dRow->gl_at_id,
                                'gl_ad_credit '=>'');
                                             $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');   
                            $VocDetail =    $this->db->get_where('gl_amount_details',$vocDet)->result();

                            foreach($VocDetail as $VCName):

                                    if($VCName == $dRow->gl_ad_coa_mc_id):
                                        else:

                                        $gl_ad_coa_mc_name =  $VCName->fn_coa_mc_title.',';

                                     
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
                             'gl_ad_depit'          =>  $dRow->gl_ad_depit,
                             'gl_ad_credit'         =>  $dRow->gl_ad_credit,
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
                            'total_depit'       =>   $debit_total,
                             'total_credit'      =>   $credit_total
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
                $filename='HM General Ledger From '.$date.'.xls'; //save our workbook as this file name
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
        
             $this->data['page']         = "Finance/HM/Reports/hm_general_leader_dw";
            $this->data['page_title']        = 'HM General Leader | ECMS';
            $this->data['page_header']        = 'HM General Leader';
            $this->load->view('common/common',$this->data);
    }
    
     public function hm_income_statument(){
             
//            $this->data['COAP'] =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1));
            
                $this->data['dateFrom']     = date('d-m-Y');
                $this->data['dateTo']       = date('d-m-Y');
            
            
            if($this->input->post('search')):
               $this->data['dateFrom']       = $this->input->post('dateFrom');
                $this->data['dateTo']         = $this->input->post('dateto');
                $where = array(
                  'gl_amount_transition.fn_account_type_id'=>2 
                );
               $this->data['IncomeStatment']   =  $this->FinanceModel->hm_income_statement(
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
                $this->excel->getActiveSheet()->setTitle('HM Income Report');
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
                  'gl_amount_transition.fn_account_type_id'=>2  
                );
               $incomeStatment =  $this->FinanceModel->hm_income_statement(
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
                                 'gl_amount_transition.fn_account_type_id' =>2,
                             'payment_date <'=>date('Y-m-d', strtotime($this->data['dateFrom'])),
                             );
                         $open_balance       = $this->FinanceModel->open_balance($where);

                             $grandCredit_open   = 0;
                             $grandDebit_open    = 0;
                             $debit_total_open   = 0;
                             $credit_total_open  = 0;

                             foreach($open_balance as $obRow):
                                 $query          =  $this->db->where(array('status'=>1,'fn_account_type_id'=>2))->get('financial_year')->row();

                                 $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId       = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>2));

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
                                      'gl_amount_transition.fn_account_type_id' =>2,
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
                                 $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>2));

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
                                 $query          =  $this->db->where(array('status'=>1,'fn_account_type_id'=>2))->get('financial_year')->row();

                                 $grandDebit     = '';
                                 $grandCredit    = '';
                                 $parentId       = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>2));

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
                                 array('gl_ad_coa_mc_pk'=>$GLRow->gl_ad_coa_mc_pk,'gl_amount_transition.fn_account_type_id' =>2),$this->data['dateFrom'],$this->data['toDate']);

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
                                 $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>2));

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
                $filename='HM Income Statment From '.$date.'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
            endif;
                   
        $this->data['page']         = "Finance/HM/Reports/hm_income_statement";
        $this->data['page_title']   = 'OP Income Statement | ECMS';
        $this->data['page_header']  = 'OP Income Statement';
        $this->load->view('common/common',$this->data);
    }
    
    public function hm_bank_reconciliation_statement_report(){
        
            $this->data['COAP']         = $this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1,'fn_account_type_id'=>2));
            $this->data['tran_type']    = $this->CRUDModel->dropDown('fn_brs_tran_type', 'Selecct Type', 'id', 'tran_type');  
            
            $this->data['dateTo']           = '';
            $this->data['recordFrom']       = '';
            $this->data['recordFromCode']   = '';
            
            
            if($this->input->post()):
               
                  
                $where['fn_brs_report.fn_account_type_id'] = 2;
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
            
            $this->data['page']         = "Finance/HM/Reports/hm_BRS_report";
            $this->data['page_title']   = 'HM BRS Report| ECMS';
            $this->data['page_header']  = 'HM BRS Report';
            $this->load->view('common/common',$this->data);
    }  
    
       public function hm_brs_report_print(){
        
            
                                        $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=fn_brs_report.COA_id');
            $this->data['title_info'] = $this->db->get_where('fn_brs_report',array('fn_brs_report.fn_account_type_id'=>2,'fn_brs_report.id'=>$this->uri->segment(2)))->row();
            
            $where_type1 = array(
              'fn_brs_report.id'=>$this->uri->segment(2),  
              'brs_type'=>1, 
              'fn_account_type_id'=>2  
            );
            
                                                    $this->db->order_by('fn_brs_report_details.brs_type','asc');
                                                    $this->db->join('fn_brs_report_details','fn_brs_report.id=fn_brs_report_details.brs_id');
             $this->data['bank_as_per_balance']  =  $this->db->get_where('fn_brs_report',$where_type1)->result();
//                     echo '<pre>';print_r($this->data['title_info']);die;
             $where_type2 = array(
              'fn_brs_report.id'=>$this->uri->segment(2),  
              'brs_type'=>2,
              'fn_account_type_id'=>2 
            );
            
                                                    $this->db->order_by('fn_brs_report_details.brs_type','asc');
                                                    $this->db->join('fn_brs_report_details','fn_brs_report.id=fn_brs_report_details.brs_id');
             $this->data['unpresented']  =  $this->db->get_where('fn_brs_report',$where_type2)->result();
            
             $where_type3 = array(
              'fn_brs_report.id'=>$this->uri->segment(2),  
              'brs_type'=>3,
              'fn_account_type_id'=>2    
            );
            
                                                    $this->db->order_by('fn_brs_report_details.brs_type','asc');
                                                    $this->db->join('fn_brs_report_details','fn_brs_report.id=fn_brs_report_details.brs_id');
                                                    $this->db->join('fn_brs_tran_type','fn_brs_tran_type.id=fn_brs_report_details.brs_type'); 
             $this->data['add_unpres_amount']  =  $this->db->get_where('fn_brs_report',$where_type3)->result();
             
             $where_type4 = array(
              'fn_brs_report.id'=>$this->uri->segment(2),  
              'brs_type'=>4,
               'fn_account_type_id'=>2  
            );
            
                                                    $this->db->order_by('fn_brs_report_details.brs_type','asc');
                                                    $this->db->join('fn_brs_report_details','fn_brs_report.id=fn_brs_report_details.brs_id');
                                                    $this->db->join('fn_brs_tran_type','fn_brs_tran_type.id=fn_brs_report_details.brs_type'); 
             $this->data['sub_unpres_amount']  =  $this->db->get_where('fn_brs_report',$where_type4)->result();
             

            
            $this->data['page']         = "Finance/HM/Reports/hm_BRS_report_print";
            $this->data['page_title']   = 'HM BRS Report Print| ECMS';
            $this->data['page_header']  = 'HM BRS Report Print';
            $this->load->view('common/common',$this->data);
    } 
    
      public function hm_bank_reconciliation_statement_report_admin(){
        
            $this->data['COAP']         = $this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1,'fn_account_type_id'=>2));
            $this->data['tran_type']    = $this->CRUDModel->dropDown('fn_brs_tran_type', 'Selecct Type', 'id', 'tran_type');  
            
            $this->data['dateTo']           = '';
            $this->data['recordFrom']       = '';
            $this->data['recordFromCode']   = '';
            
            
            if($this->input->post()):
               
                  
                $where['fn_brs_report.fn_account_type_id'] = 2;
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
            
            $this->data['page']         = "Finance/HM/Reports/hm_BRS_report_admin";
            $this->data['page_title']   = 'HM BRS Report Admin| ECMS';
            $this->data['page_header']  = 'HM BRS Report Admin';
            $this->load->view('common/common',$this->data);
    }  
       public function hm_brs_report_edit(){
        
            $brs_id                     = $this->uri->segment(2);
            $this->data['tran_type']    = $this->CRUDModel->dropDown('fn_brs_tran_type', 'Selecct Type', 'id', 'tran_type'); 
                                           $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=fn_brs_report.COA_id'); 
            $this->data['report_info']  =  $this->db->get_where('fn_brs_report',array('id'=>$brs_id,'fn_brs_report.fn_account_type_id'=>2))->row();
            $report_details             = $this->db->get_where('fn_brs_report_details',array('brs_id'=>$brs_id))->result();
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
            $this->data['page']         = "Finance/HM/Forms/hm_BRS_edit";
            $this->data['page_title']   = 'HM BRS Edit| ECMS';
            $this->data['page_header']  = 'HM BRS Edit';
            $this->load->view('common/common',$this->data);
    }  
    
     public function hm_brs_report_update(){
         
          
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
            
            redirect('HmBRSReportAdmin','refresh'); 
           endif;
    }
public function cheque_prints_hostel_mess(){
         
        $gl_id = $this->uri->segment(2);
        
        if(!empty($gl_id)):
                                              $this->db->join('fn_supplier','fn_supplier.fn_supp_id=gl_amount_transition.supplier_id','left outer');  
            $this->data['result']           = $this->db->get_where('gl_amount_transition',array('gl_at_id'=>$gl_id))->row();
            
                                              $this->db->join('hr_emp_record','hr_emp_record.emp_id=gl_cheque_signature_list.emp_id'); 
                                              $this->db->order_by('gl_cs_order','asc');
            $this->data['gl_sign_list']     = $this->db->get_where('gl_cheque_signature_list',array('gl_cs_status'=>1))->result();
            
            $this->data['bank_COA']         = $this->DropdownModel->dropDown_coa_chk_print('gl_amount_details', 'Selecct COA', 'fn_coa_mc_id', 'fn_coa_mc_title',array('gl_amount_details.gl_ad_atId'=>$gl_id)); 
//            echo '<pre>';print_R($this->data['bank_COA']);die;
            $this->data['cheque_type']      = $this->CRUDModel->dropDown('gl_bank_cheque_type', 'Selecct Type', 'gl_ct_id', 'gl_ct_title'); 
            
        else:
            redirect('searchVoucher','refresh');
        endif;
        
        $this->data['page']         = 'Finance/OP/Forms/op_bank_cheque_v';
        $this->data['page_header']   = 'Bank Cheque HM';
        $this->data['page_title']   = 'Bank Cheque HM | ECMS';
        $this->load->view('common/common',$this->data);
    }
}
