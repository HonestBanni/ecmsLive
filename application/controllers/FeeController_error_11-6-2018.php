<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');
class FeeController extends AdminController {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/roufee_new_headtes.php, it's displayed at http://example.com/
	 *
	 * So any fee_extra_headsother public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
      
    public $userInfo = '';         
    public function __construct() {
             parent::__construct();
             $this->load->model('FeeModel');
             $this->load->model('HostelModel');
             $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
             
          }
    
    public function fee_chart_of_account(){

       if($this->input->post()):
         //Insert Code 
         $code          = $this->input->post('code');
         $title         = $this->input->post('title');
         $comments      = $this->input->post('comments');
         $coa_id        = $this->input->post('coa_id');
         $status        = $this->input->post('coa_status');
         $currnetDate   =  date('Y-m-d H:i:s');
         $userInfo      = $this->getUser();


         if($coa_id):

             $data = array(
             'fn_coa_code'          =>$code,
             'fn_coa_title'         =>strtoupper($title),
             'fn_coa_commnet'       =>$comments,
             'fn_coa_udpateTime'    =>$currnetDate,
             'fn_coa_UpdateUser'    =>$userInfo['user_id'],
             'fn_coa_status'        =>$status,
             );

             $where = array('fn_coaId'=>$coa_id);
             $this->CRUDModel->update('fee_coa_parent',$data,$where);
             redirect('feeCOAHead');
             else:
                 $data = array(
                    'fn_coa_code'      =>$code,
                    'fn_coa_title'     =>strtoupper($title),
                    'fn_coa_commnet'   =>$comments,
                    'fn_coa_timestamp' =>$currnetDate,
                    'fn_coa_userId'    =>$userInfo['user_id'],
                    );
                $this->CRUDModel->insert('fee_coa_parent',$data);
                 redirect('feeCOAHead');
             endif;

        endif;

        $COA_id = $this->uri->segment(2);
        if($COA_id):
            $this->data['coaResult']    = $this->CRUDModel->get_where_row('fee_coa_parent',array('fn_coaId'=>$COA_id));
        endif;

        $this->data['coa']              = $this->CRUDModel->get_where_result('fee_coa_parent',array('fn_coa_trash'=>1));
        $this->data['page']             = "Fee/setups/fee_coa_parents";
        $this->data['page_title']       = 'Fee COA Heads| ECMS';
        $this->data['page_header']       = 'Fee COA Heads';
        $this->load->view('common/common',$this->data);

    }
       public function fee_coa_perent_delte(){
        $id     = $this->uri->segment(2);
        $data   = array('fn_coa_trash'=>0);
        $where  = array('fn_coaId'=>$id);
        $this->CRUDModel->update('fee_coa_parent',$data,$where);
        redirect('feeCOAHead');
    }
          
   public function fee_coa_master_child(){
       
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
                 'fn_coa_m_updateUser'    =>$userInfo['user_id'],
                 'fn_coa_m_status'        =>$status,
                 );
                 
                 $where = array('fn_coa_m_cId'=>$coa_id);
                 $this->CRUDModel->update('fee_coa_master_child',$data,$where);
                 redirect('feeCOAChild');
                 else:
                     $data = array(
                        'fn_coa_m_pId'          =>$COAPId,
                        'fn_coa_m_code'         =>$code,
                        'fn_coa_m_title'        =>strtoupper($title),
                        'fn_coa_m_comments'     =>$comments,
                        'fn_coa_m_timestamp'    =>$currnetDate,
                        'fn_coa_m_userId'       =>$userInfo['user_id'],
                        );
                    $this->CRUDModel->insert('fee_coa_master_child',$data);
                     redirect('feeCOAChild');
                 endif;
             
            endif;
            
            $COA_id = $this->uri->segment(2);
            if($COA_id):
                $this->data['coaResult']    = $this->CRUDModel->get_where_row('fee_coa_master_child',array('fn_coa_m_cId'=>$COA_id));
            endif;
            
            $wherePrg                       = array(
                                                'fn_coa_status' =>'1',
                                                'fn_coa_trash'  =>1);
            $this->data['COAP']             = $this->CRUDModel->dropDown('fee_coa_parent', 'Select Account Head', 'fn_coaId', 'fn_coa_title',$wherePrg);  
            $where                          = array(
                                                'fn_coa_trash'  =>1,
                                                'fn_coa_status' =>1,
                                                'fn_coa_m_trash'=>1);
            $this->data['coa_master']       = $this->FeeModel->fee_coa_master('fee_coa_master_child',$where);
         
            $this->data['page']             = "Fee/setups/fee_coa_master_child";
            $this->data['page_title']       = 'Fee COA Chaild| ECMS';
            $this->data['page_header']       = 'Fee COA Chaild| ECMS';
            $this->load->view('common/common',$this->data);
     
        }
    public function fee_coa_child_delte(){
            $id         = $this->uri->segment(2);
            $data       = array('fn_coa_m_trash'=>0);
            $where      = array('fn_coa_m_cId'=>$id);
            $this->CRUDModel->update('fee_coa_master_child',$data,$where);
            redirect('coa_master_child');
        }  
    public function fee_coa_sub_child(){
            
            if($this->input->post()):
                
                $coa_parent_id          = $this->input->post('coa_parent_id');
                $coa_master_child       = $this->input->post('master_child');
                $master_subChild_code   = $this->input->post('master_subChild_code');
                $coa_status             = $this->input->post('coa_status');
                $title                  = $this->input->post('title');
                $comments               = $this->input->post('comments');
                $coa_id                 = $this->input->post('coa_id');
               $userInfo                = $this->getUser();
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
                'fn_coa_mc_upUserId'    =>$userInfo['user_id']
                       );
                    $this->CRUDModel->update('fee_coa_master_sub_child',$data,$where);
                    redirect('feeSubChild');
                   else:
                $data  = array(
                   'fn_coa_pId'         =>$coa_parent_id,
                   'fn_coa_mc_mId'      =>$coa_master_child,
                   'fn_coa_mc_code'     =>$master_subChild_code,
                   'fn_coa_mc_title'    =>strtoupper($title),
                   'fn_coa_mc_comments' =>$comments,
                   'fn_coa_mc_timestamp'=>date('Y-m-d H:i:s'),
                   'fn_coa_mc_userId'   =>$userInfo['user_id'],
                       );
               $this->CRUDModel->insert('fee_coa_master_sub_child',$data);
               redirect('feeSubChild');
               endif;
            endif;
            
            $COA_id = $this->uri->segment(2);
             
            if($COA_id):
                
//                $this->data[] = 
                $this->data['master_subResult'] = $this->FeeModel->coa_master_subChildRow('fee_coa_master_sub_child',array('fn_coa_mc_id'=>$COA_id));
                
            endif;
            
            $wherePrg                   = array(
                'fn_coa_status'=>'1'
                
                );
            $this->data['COAP']         = $this->CRUDModel->dropDown('fee_coa_parent', 'Select Account Head', 'fn_coaId', 'fn_coa_title',$wherePrg);  
           $where = array(
              'fn_coa_mc_trash'     =>1, 
              'fn_coa_m_trash'      =>1, 
              'fn_coa_trash'        =>1, 
              'fn_coa_status'       =>1, 
              'fn_coa_m_status'     =>1, 
               
           );
            $this->data['master_sub']   = $this->FeeModel->coa_master_subChild('fee_coa_master_sub_child',$where); 
            //echo '<pre>';print_r($this->data['master_sub']);die;
            $this->data['page']         = "Fee/setups/fee_coa_sub_child";
            $this->data['title']        = 'Fee COA SubChild | ECMS';
            $this->data['page_header']        = 'Fee COA SubChild ';
            $this->load->view('common/common',$this->data);
        }
    public function fee_coa_master_sub_delte(){
            $id     = $this->uri->segment(2);
           
            $data   = array('fn_coa_mc_trash'=>0);
            $where  = array('fn_coa_mc_id'=>$id);
            $this->CRUDModel->update('fn_coa_master_sub_child',$data,$where);
            redirect('master_sub_child');
        }
        
    public function fee_get_master_record(){
            $coa_parent_id      = $this->input->post('coa_parent_id');
            $result             = $this->CRUDModel->get_where_result('fee_coa_master_child',array('fn_coa_m_pId'=>$coa_parent_id,'fn_coa_m_status'=>1));
                foreach($result as $row):
                    echo '<option value="'.$row->fn_coa_m_cId.'">'.$row->fn_coa_m_title.'('.$row->fn_coa_m_code.')</option>';
                endforeach;
           
        } 
          
    public function fee_heads(){
        $userInfo =  json_decode(json_encode($this->getUser()), FALSE);
      
        $this->data['feehead']          = '';
        $this->data['recordFrom']       = '';
        $this->data['recordFromCode']   = '';
        $this->data['comment']          = '';
        $this->data['fee_fh_Id']        = '';
    
        if($this->input->post('add')):
            
            $feeHead    = $this->input->post('feehead');
            $coa_title  = $this->input->post('coa_title');
            $coa_id     = $this->input->post('coa_id');
            $comments   = $this->input->post('comment');
            $fee_fh_Id  = $this->input->post('fee_fh_Id');
            if(empty($fee_fh_Id)):
                $data = array(
                    'fh_head'      => $feeHead,
//                    'fn_coa_mc_id' => $coa_id,
                    'fh_comments'  => $comments,
                    'fn_userId'    => $userInfo->user_id,
                    'fh_timestamp' => date('Y-m-d H:i:s'),
                );
                $this->CRUDModel->insert('fee_heads',$data); 
                else:
                $data = array(
                    'fh_head'           => $feeHead,
//                    'fn_coa_mc_id'      => $coa_id,
                    'fh_comments'       => $comments,
                    'fn_userId_up'      => $userInfo->user_id,
                    'fh_timestamp_up'   => date('Y-m-d H:i:s'),
                    );
                 $where = array('fh_Id'=>$fee_fh_Id);   
                 $this->CRUDModel->update('fee_heads',$data,$where);
                 redirect('feeHeads');
            endif;
           endif;
           $fhid = $this->uri->segment(2);
           if(!empty($fhid)):
            $fh_record = $this->FeeModel->get_feeHead_up(array('fh_Id'=>$fhid));

            $this->data['feehead']          = $fh_record->fh_head;
           
            $this->data['comment']          = $fh_record->fh_comments;
            $this->data['fee_fh_Id']        = $fh_record->fh_Id;
           
           endif;
        $this->data['result']    = $this->FeeModel->get_feeHead();
        $this->data['page']         = 'Fee/setups/fee_heads';
        $this->data['page_header']  = 'Fee Heads Mapping';
        $this->data['page_title']   = 'Fee Heads Mapping | ECMS';
        $this->load->view('common/common',$this->data);
    }
    
 //Auto complete 
    public function fee_head_auto(){
                $term                       = trim(strip_tags($this->input->get('term')));
                if( $term == ''){
                    $like                   = $term;
                    $result_set             = $this->db->get('fee_heads')->result();
                    $labels                 = array();
                        foreach ($result_set as $row_set) {
                            $labels[]       = array( 
                                'label'     =>$row_set->fh_head, 
                                'fh_Id'     =>$row_set->fh_Id, 
                                'value'     =>$row_set->fh_head 
                        );
                    }
                $matches    = array();
                    foreach($labels as $label){
                        $label['value']     = $label['value'];
                        $label['fh_Id']     = $label['fh_Id'];
                        $label['label']     = $label['label']; 
                        $matches[]          = $label;
                }
                $matches                    = array_slice($matches, 0, 10);
                    echo  json_encode($matches); 
                }else if($term != ''){
                    $like                   = $term;
                    $result_set             = $this->db->like('fh_head',$like)->get('fee_heads')->result();
                    $labels                 = array();
                        foreach ($result_set as $row_set) {
                        $labels[]           = array( 
                            'label'         =>$row_set->fh_head, 
                            'fh_Id'         =>$row_set->fh_Id, 
                            'value'         =>$row_set->fh_head 
                        );
                 }
                $matches                    = array();
                foreach($labels as $label){
                        $label['value']     = $label['value'];
                        $label['fh_Id']     = $label['fh_Id'];
                        $label['label']     = $label['label']; 
                        $matches[]          = $label;
                }
                    $matches                = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
        }
        }
    public function shift_auto_complete(){
               
                $term                       = trim(strip_tags($this->input->get('term')));
                if( $term == ''){
                    $like                   = $term;
                    $result_set             = $this->db->get('shift')->result();
                    $labels                 = array();
                        foreach ($result_set as $row_set) {
                            $labels[]       = array( 
                                'label'     =>$row_set->name, 
                                'id'      =>$row_set->shift_id, 
                                'value'     =>$row_set->name 
                        );
                    }
                $matches    = array();
                    foreach($labels as $label){
                        $label['value']     = $label['value'];
                        $label['id']        = $label['id'];
                        $label['label']     = $label['label']; 
                        $matches[]          = $label;
                }
                $matches                    = array_slice($matches, 0, 10);
                    echo  json_encode($matches); 
                }else if($term != ''){
                    $like                   = $term;
                    $result_set             = $this->db->like('name',$like)->get('shift')->result();
                    $labels                 = array();
                        foreach ($result_set as $row_set) {
                        $labels[]           = array( 
                             'label'        =>$row_set->name, 
                            'id'            =>$row_set->shift_id, 
                            'value'         =>$row_set->name 
                        );
                 }
                $matches                    = array();
                foreach($labels as $label){
                        $label['value']     = $label['value'];
                        $label['id']        = $label['id'];
                         $label['label']    = $label['label']; 
                        $matches[]          = $label;
                }
                    $matches                = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
        }
        }
    public function comment_auto(){
                //$term                       = trim(strip_tags($_GET['term']));
                $term                       = trim(strip_tags($this->input->get('term')));
                if( $term == ''){
                    $like                   = $term;
                    $result_set             = $this->db->get('fee_challan_comment')->result();
                    $labels                 = array();
                        foreach ($result_set as $row_set) {
                            $labels[]       = array( 
                                'label'     =>$row_set->comment, 
                                'id'        =>$row_set->commentId, 
                                'value'     =>$row_set->comment
                        );
                    }
                $matches    = array();
                    foreach($labels as $label){
                        $label['value']     = $label['value'];
                        $label['id']        = $label['id'];
                        $label['label']     = $label['label']; 
                        $matches[]          = $label;
                }
                $matches                    = array_slice($matches, 0, 10);
                    echo  json_encode($matches); 
                }else if($term != ''){
                    $like                   = $term;
                    $result_set             = $this->db->like('comment',$like)->get('fee_challan_comment')->result();
                    $labels                 = array();
                        foreach ($result_set as $row_set) {
                        $labels[]           = array( 
                             'label'        =>$row_set->comment, 
                            'id'            =>$row_set->commentId, 
                            'value'         =>$row_set->comment 
                        );
                 }
                $matches                    = array();
                foreach($labels as $label){
                        $label['value']     = $label['value'];
                        $label['id']        = $label['id'];
                         $label['label']    = $label['label']; 
                        $matches[]          = $label;
                }
                    $matches                = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
        }
        }
    public function get_fee_coa_heads(){
           
                $term                       = trim(strip_tags($this->input->get('term')));
                if( $term == ''){
                    $like                   = $term;
                    $result_set             = $this->FeeModel->get_fee_coa_heads('fee_coa_master_sub_child',$like);
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
                    $result_set             = $this->FeeModel->get_fee_coa_heads('fee_coa_master_sub_child',$like);
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
    public function fee_heads_delete(){
        $fhid = $this->uri->segment(2);
        $this->CRUDModel->deleteid('fee_heads',array('fh_Id'=>$fhid));
        redirect('feeHeads');
        
    }
    public function add_payment_category(){
        $userInfo =  json_decode(json_encode($this->getUser()), FALSE);
        $this->data['fee_category_titles']     = $this->CRUDModel->DropDown('fee_category_titles', 'Select Payment Cat', 'cat_title_id', 'title');
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['programe_id']  = '';
        $this->data['sub_pro_id']   = '';
        if($this->input->post('add')):
            
            $payCategory    = $this->input->post('payCategory');
            $comments       = $this->input->post('comment');
            $batch_id       = $this->input->post('batch_id_name_code');
            $sub_pro_nameId = $this->input->post('sub_pro_nameId');
            
            
             $where = array(
                    'sub_pro_id'    =>  $sub_pro_nameId, 
                    'batch_id'      =>  $batch_id, 
                    'cat_title_id'  =>  $payCategory, 
                   );

            $result    = $this->CRUDModel->get_where_row('fee_payment_category',$where);
            if(empty($result)):
              $data           = array(
                'cat_title_id'  => $payCategory,
                'batch_id'      => $batch_id,
                'sub_pro_id'    => $sub_pro_nameId,
                'comments'      => $comments,
                'userId'        => $userInfo->user_id,
                'timestamp'     => date('Y-m-d H:i:s')
                );
            $this->CRUDModel->insert('fee_payment_category',$data);  
              $this->session->set_flashdata('add_payment_error', 'Payment Category Succssfully Saved');
            else:
                
                $this->session->set_flashdata('add_payment_error', 'Payment Category Already Exist Record Not Save');
            endif;
            
            
            
        endif;
 
        $this->data['result']       = $this->FeeModel->get_Payment_Category();
        $this->data['page']         = 'Fee/setups/fee_payment_category';
        $this->data['page_header']  = 'Add Installment Names';
        $this->data['page_title']   = 'Add Installment Names | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function payment_category_update(){
        $userInfo =  json_decode(json_encode($this->getUser()), FALSE);
        $this->data['sub_pro_name']     = $this->CRUDModel->sub_proDropDown('sub_programes', '', 'sub_pro_id', 'name');
        
        $this->data['fee_category_titles']  = $this->CRUDModel->DropDown('fee_category_titles', 'Select Payment Cat', 'cat_title_id', 'title');
        $this->data['batch']                = $this->CRUDModel->DropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name');
        $this->data['payCategory_id']       = '';
        $this->data['comment']              = '';
        $this->data['pc_id']                = '';
        $this->data['sub_pro_id']           = '';
        $this->data['program']              = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['programe_id']          = '';
        $this->data['sub_pro_id']           = '';
        
      
        if($this->input->post('add')):
             
         
            $payCategory            = $this->input->post('payCategory');
            $comments               = $this->input->post('comment');
            $pc_id                  = $this->input->post('pc_id');
            $sub_pro_nameId         = $this->input->post('sub_pro_nameId');
            $batch_id               = $this->input->post('batch_id');
           
            
            if(empty($pc_id)):
                $data = array(
                'cat_title_id'      => $payCategory,
                'sub_pro_id'        => $sub_pro_nameId,
                'batch_id'           =>$batch_id,
                'comments'          => $comments,
                'userId'            => $userInfo->user_id,
                'timestamp'         => date('Y-m-d H:i:s')
                );
                $this->CRUDModel->insert('fee_payment_categoryx',$data); 
            else:
 
                $dataUp = array(
                'cat_title_id'      => $payCategory,
                'sub_pro_id'        => $sub_pro_nameId,
                'comments'          => $comments,
                'batch_id'          =>$batch_id,
                'userId'            => $userInfo->user_id,
                'timestamp'         => date('Y-m-d H:i:s')
                  );
                 $where = array('pc_id'=>$pc_id);   
                 $this->CRUDModel->update('fee_payment_category',$dataUp,$where);
                 redirect('addPaymentCategory');
            endif;
           endif;
           $pc_id= $this->uri->segment(2);
           if(!empty($pc_id)):
               $fh_record = $this->CRUDModel->get_where_row('fee_payment_category',array('pc_id'=>$pc_id));
 
            $this->data['payCategory_id']   = $fh_record->cat_title_id;
            $this->data['comment']          = $fh_record->comments;
            $this->data['pc_id']            = $fh_record->pc_id;
            $this->data['batch_id']         = $fh_record->batch_id;
            $this->data['sub_pro_id']       = $fh_record->sub_pro_id;
           
           endif;
        $this->data['result']       = $this->FeeModel->get_Payment_Category();
        $this->data['page']         = 'Fee/setups/fee_payment_category_update';
        $this->data['page_header']  = 'Update Installment Names';
        $this->data['page_title']   = 'Update Installment Names | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function payment_category_search(){
        
         $program_id             = $this->input->post('program_id');
        $showFeeSubPro          = $this->input->post('sub_program_id');
        $pc_id          = $this->input->post('pc_id');
        if($pc_id):
            $where = array(
            'programes_info.programe_id'=>  $program_id, 
            'sub_programes.sub_pro_id'=>  $showFeeSubPro, 
            'pc_id'=>  $pc_id, 
           );
            else:
            $where = array(
            'programes_info.programe_id'=>  $program_id, 
            'sub_programes.sub_pro_id'=>  $showFeeSubPro, 
        );
        endif;

        $result    = $this->FeeModel->get_Payment_Category($where);
        
        echo '<div class="col-md-12">';
                                       
                                        $class = array(
                                                'info',
                                                'success',
                                                'danger',
                                                'warning',
                                                'active',
                                            );
                                
                                      if(!empty($result)):
                                          
                                    
                                       
                                     echo '<div id="div_print">
              
                                        <h3 class="has-divider text-highlight">Result :'; 
                                      echo count($result);
                                      echo '</h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table"  style="font-size:11px;">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Category Title</th>
                                                          <th>Program</th>
                                                          <th>Sub Program</th>
                                                          <th>Comment</th>
                                                          <th>Edit</th>
                                                          <th>Delete</th>

                                                      </tr>
                                                    </thead>
                                                    <tbody>';
                                                        
                                                        $sn = '';
                                                          foreach($result as $row):
//                                                              echo '<pre>';print_r($row);die;
                                                              $k = array_rand($class);
                                                           $sn++;
                                                            echo '<tr class="'.$class[$k].'">
                                                                <th>'.$sn.'</th>
                                                                <th>'.$row->title.'</th>
                                                                <th>'.$row->programe_name.'</th>
                                                                <th>'.$row->name.'</th>
                                                                <th>'.$row->comments.'</th>';
                                                                ?>
                                                            <td><a href="paymentCategory/<?php echo $row->pc_id;?>"  class="productstatus"><button type="button" class="btn btn-theme btn-xs"> Edit </button></a></td> 
                                                            <td><a href="pcDelete/<?php echo $row->pc_id;?>"  onclick="return confirm('Are You Sure to Delete This..?')"  class="productstatus"><button type="button" class="btn btn-danger btn-xs"> Delete</button></a></td>  
                                                                <?php
                                                                    
                                                            echo '</tr>';
                                                         
                                                          endforeach;      
                                               

                                                         

                                               echo      '</tbody>
                                            </table>
                                        </div>';
                                      endif;
                                    
                                    echo '</div>
                                    </div>';
        
    }
        public function payment_category_check(){
        
        $program_id         = $this->input->post('program_id');
        $showFeeSubPro      = $this->input->post('showFeeSubPro');
        $batch_id           = $this->input->post('batch_id');
        $pc_id              = $this->input->post('pc_id');
        
        $where = array(
         'sub_pro_id'   =>  $showFeeSubPro, 
         'batch_id'     =>  $batch_id, 
         'pc_id'        =>  $pc_id, 
        );

        $result    = $this->CRUDModel->get_where_row('fee_payment_category',$where);
         
        if(empty($result)):
            echo 0;
            else:
            echo 1;
        endif;
         
        
    }
    public function payment_category_delete(){
        $pc_id = $this->uri->segment(2);
        $this->CRUDModel->deleteid('fee_payment_category',array('pc_Id'=>$pc_id));
        redirect('addPaymentCategory');
    }
    public function payment_autocomplete(){
                //$term                       = trim(strip_tags($_GET['term']));
                $term                       = trim(strip_tags($this->input->get('term')));
                if( $term == ''){
                     
                    $result_set             = $this->FeeModel->get_Payment_Category_auto();
                    $labels                 = array();
                        foreach ($result_set as $row_set) {
                            $labels[]       = array( 
                                'label'     =>$row_set->title.'('.$row_set->name.')', 
                                'code'      =>$row_set->pc_id, 
                                'mc_id'     =>$row_set->pc_id, 
                                'value'     =>$row_set->title.'('.$row_set->name.')', 
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
                    $result_set             = $this->FeeModel->get_Payment_Category_auto($like);
                    $labels                 = array();
                        foreach ($result_set as $row_set) {
                        $labels[]           = array( 
                                'label'     =>$row_set->title.'('.$row_set->name.')', 
                                'code'      =>$row_set->pc_id, 
                                'mc_id'     =>$row_set->pc_id, 
                                'value'     =>$row_set->title 
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
    public function batch_auto_complete(){
                //$term                       = trim(strip_tags($_GET['term']));
                $term                       = trim(strip_tags($this->input->get('term')));
                if( $term == ''){
                     
                    $result_set             = $this->db->get('prospectus_batch')->result();
                    $labels                 = array();
                        foreach ($result_set as $row_set) {
                            $labels[]       = array( 
                                'label'     =>$row_set->batch_name , 
                                'value'     =>$row_set->batch_name , 
                                'pk_id'     =>$row_set->batch_id , 
                        );
                    }
                $matches    = array();
                    foreach($labels as $label){
                        $label['value']     = $label['value'];
                        $label['pk_id']     = $label['pk_id'];
                        $label['label']     = $label['label']; 
                        $matches[]          = $label;
                }
                $matches                    = array_slice($matches, 0, 10);
                    echo  json_encode($matches); 
                }else if($term != ''){
                     
                    $result_set             = $this->db->like('batch_name',$term)->get('prospectus_batch')->result();
                  
                    $labels                 = array();
                        foreach ($result_set as $row_set) {
                        $labels[]           = array( 
                            'label'     =>$row_set->batch_name , 
                            'value'     =>$row_set->batch_name , 
                            'pk_id'     =>$row_set->batch_id , 
                        );
                 }
                $matches                    = array();
                foreach($labels as $label){
                        $label['value']     = $label['value'];
                        $label['pk_id']     = $label['pk_id'];
                        $label['label']     = $label['label']; 
                        $matches[]          = $label;
                }
                    $matches                = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
        }
        }
    
    public function class_setups(){
        $userInfo =  json_decode(json_encode($this->getUser()), FALSE);
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['fee_shift']    = $this->CRUDModel->dropDown('shift', '', 'shift_id', 'name');
        $this->data['programe_id']  = '';
        $this->data['sub_pro_id']   = '';
        $this->data['fee_shift_id'] = 1;
        
        if($this->input->post()):
            $sub_pro_nameId     = $this->input->post('sub_pro_nameId');
            $batch_id_code      = $this->input->post('batch_id_name_code');
            $pc_id              = $this->input->post('pc_id');
            $fee_from           = date('Y-m-d', strtotime($this->input->post('fee_from')));
            $fee_to             = date('Y-m-d', strtotime($this->input->post('fee_to')));
            $valid_till         = date('Y-m-d', strtotime($this->input->post('valid_till')));
            $comment            = $this->input->post('comment');
            $formCode           = $this->input->post('formCode');
            $shift_name_code    = $this->input->post('shift_name_code');
            
              $result = $this->CRUDModel->get_where_result('fee_class_setups_demo',array('formCode'=> $formCode,'fcs_userId'=> $userInfo->user_id));
            
           $grand_installement = 0;
            foreach($result as $demoRow):
            $data = array(
                'fh_Id'         => $demoRow->fh_Id,
                'sub_pro_id'    => $sub_pro_nameId,
                'shift_id'       => $shift_name_code,
                'fcs_amount'    => $demoRow->fcs_amount,
                'batch_id'      => $batch_id_code,
                'pc_id'         => $pc_id,
                'fee_from'      => $fee_from,
                'fee_to'        => $fee_to,
                'valid_till'    => $valid_till,
                'fcs_comments'  => $comment,
                'fcs_userId'    => $userInfo->user_id,
                'fcs_timestamp' => date('Y-m-d H:i:s')
                );
                
                $this->CRUDModel->insert('fee_class_setups',$data); 
                $this->CRUDModel->deleteid('fee_class_setups_demo',array('formCode'=>$formCode,'fcs_id'=>$demoRow->fcs_id));
                
              endforeach;
              
              
               $install_result_query = $this->CRUDModel->get_where_result('fee_catetory_wise',array('sub_pro_id'=>$sub_pro_nameId,'pc_id'=> $pc_id));
               $install_amount_where = array(
                    'sub_pro_id'    => $sub_pro_nameId,
                    'batch_id'      => $batch_id_code,
                    'pc_id'         => $pc_id,
               );
               
               $grand_installement = '';
              $install_result_amount = $this->CRUDModel->get_where_result('fee_class_setups',$install_amount_where);
               
               foreach($install_result_amount as $rowAmount):
                   $grand_installement +=$rowAmount->fcs_amount;
               endforeach;
               
               //Session Wise fee
               if(empty($install_result_query)):
                   $data_install = array(
                      'sub_pro_id'      => $sub_pro_nameId,
                      'pc_id'           => $pc_id,
                      'batch_id'        => $batch_id_code,
                      'shift_id'        => $shift_name_code, 
                      'fcw_amount'      => $grand_installement, 
                      'fcw_userId'      => $userInfo->user_id, 
                      'fcw_timestamp'   => date('Y-m-d H:i:s'), 
                   );
                    $this->CRUDModel->insert('fee_catetory_wise',$data_install);
                   else:
                    
                  $data_install_where = array(
                      'sub_pro_id'      => $sub_pro_nameId,
                      'pc_id'           => $pc_id,
                      'shift_id'        => $shift_name_code,
                      'batch_id'      => $batch_id_code,
                   );
                   $data_up = array(
                      'fcw_amount'      => $grand_installement, 
                      'fcw_userId'      => $userInfo->user_id, 
                      'fcw_timestamp'   => date('Y-m-d H:i:s'),   
                   );
                $this->CRUDModel->update('fee_catetory_wise',$data_up,$data_install_where);
              
                 endif;
                
              $install_session_wise = $this->CRUDModel->get_where_result('fee_total_anual',array('sub_pro_id'=>$sub_pro_nameId));
              $program_id           = $this->CRUDModel->get_where_row('sub_programes',array('sub_pro_id'=>$sub_pro_nameId));
              $anual_fee            = $this->CRUDModel->get_where_result('fee_class_setups',array('sub_pro_id'=>$sub_pro_nameId));
                                    
                                    $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');   
                $installment_type = $this->db->where('pc_id',$pc_id)->get('fee_payment_category')->row();
              
               
        if($installment_type->inst_type_id == 1):
                
              $anual_fee_balance = 0;
              foreach($anual_fee as $afRow):
                  $anual_fee_balance +=$afRow->fcs_amount;
              endforeach;
            //Annual fee 
              if(empty($install_session_wise)):
                  $data_annual_fee= array(
                      'program_id'      => $program_id->programe_id, 
                      'sub_pro_id'      => $sub_pro_nameId,
                      'total_amount'    => $anual_fee_balance,
                      'shift_id'        => $shift_name_code, 
                      'batch_id'        => $batch_id_code, 
                      'userId'          => $userInfo->user_id, 
                      'timestamp'       => date('Y-m-d H:i:s'), 
                   );
                    $this->CRUDModel->insert('fee_total_anual',$data_annual_fee);
                    
                  else:
                      
                    $data_annual = array(
                        'total_amount'   => $anual_fee_balance,
                        'up_userId'      => $userInfo->user_id, 
                        'up_timestamp'   => date('Y-m-d H:i:s'),
                        'shift_id'        => $shift_name_code, 
                    );  
                      
                    $data_annual_where = array(
                        'program_id'      => $program_id->programe_id, 
                        'sub_pro_id'      => $sub_pro_nameId,
                     
                    );  
                    $this->CRUDModel->update('fee_total_anual',$data_annual,$data_annual_where);
               endif;
             endif;  
                redirect('classSetups');
      
           endif;
         
        $this->data['result']    = $this->FeeModel->get_class_setup();

        $this->data['page']         = 'Fee/setups/class_fee_setup';
        $this->data['page_header']  = 'Installment Heads allotment';
        $this->data['page_title']   = 'Installment Heads allotment | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function installment_name_dublicate_check(){
        
     $batch_id          = $this->input->post('batch_id');
     $showFeeSubPro     = $this->input->post('showFeeSubPro');
     $pc_id             = $this->input->post('pc_id');
  
     $where = array(
       'batch_id'       => $batch_id,
       'sub_pro_id'     => $showFeeSubPro,
       'pc_id'          => $pc_id,
     );
      
    $result =  $this->CRUDModel->get_where_row('fee_class_setups',$where);
    if(empty($result)):
        echo  0;
    else:
        echo  1;
    endif;
    }
      public function class_setup_dublicate_check(){
        
     $fee_head   = $this->input->post('fee_head');
     $formCode   = $this->input->post('formCode');
     $where = array(
       'fh_Id'  =>$fee_head,
       'formCode'  =>$formCode,
       'fcs_userId'  =>$this->userInfo->user_id,
     );
      
    $result =  $this->CRUDModel->get_where_row('fee_class_setups_demo',$where);
    if(empty($result)):
        echo  0;
    else:
        echo  1;
    endif;
    }
public function fee_Category_search(){
        
        $program_id     = $this->input->post('program_id');
        $showFeeSubPro  = $this->input->post('sub_program_id');
        
        $where = array(
         'programes_info.programe_id'=>  $program_id, 
         'sub_programes.sub_pro_id'=>  $showFeeSubPro, 
        );
//        echo '<pre>';print_r($where);die;
        
        $result    = $this->FeeModel->get_class_setup($where);
         echo '<div class="row">
                <div class="col-md-12">';
                

                  if(!empty($result)):
                        echo ' <div id="div_print">
              
                                        <h3 class="has-divider text-highlight">Result :'; echo count($result); echo '</h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table" style="font-size:9px;">
                                                    <thead>
                                                      <tr>

                                                           <th>#</th>
                                                          <th>Fee Head</th>
                                                          <th>Sub program </th>
                                                          <th>Batch</th>
                                                          <th>Amount</th>
                                                          <th>From</th>
                                                          <th>To</th>
                                                          <th>Till</th>
                                                          <th>Instalment Type</th>
                                                          <th>Comment</th>
                                                          <th>Edit</th>
                                                          <th>Delete</th>

                                                      </tr>
                                                    </thead>
                                                    <tbody>';
                                                        
                                                        $sn = '';
                                                          foreach($result as $row):
                                                              
                                                           $sn++;
                                                            echo '<tr ">
                                                                <td>'.$sn.'</td>
                                                                <td>'.$row->fh_head.'</td>
                                                                <td>'.$row->name.'</td>
                                                                <td>'.$row->batch_name.'</td>
                                                                <td>'.$row->fcs_amount.'</td>
                                                                     <td>'.date('d-m-Y',strtotime($row->fee_from)).'</td>
                                                                     <td>'.date('d-m-Y',strtotime($row->fee_to)).'</td>
                                                                     <td>'.date('d-m-Y',strtotime($row->valid_till)).'</td>
                                                                <td>'.$row->title.'('.$row->name.')</td>
                                                                <td>'.$row->fcs_comments.'</td>
                                                                 ';
                                                                       
                                                                    echo '<td>  <a href="classSetupsEdit/'.$row->fcs_id.'"  class="productstatus"><button type="button" class="btn btn-theme btn-xs"> Edit </button></a>
                                                                  </td> 
                                                                  <td>';?> 
                                                                   <a href="csDelete/<?php echo $row->fcs_id;?>"  onclick="return confirm('Are You Sure to Delete This..?')"  class="productstatus"><button type="button" class="btn btn-danger btn-xs"> Delete</button></a>
                                                                  
                                                                <?php echo '</td>';  
                                                                
                                                                    
                                                            echo '</tr>';
                                                         
                                                          endforeach;      
                                               

                                                  

                                                    echo '</tbody>
                                            </table>
                                        </div>';
                                      endif;
                                    echo '</div>
                                    </div>
                                  
                                </div>';
        
    }
    
    public function add_class_setup_demo(){
       
            $userInfo       = json_decode(json_encode($this->getUser()), FALSE);
            $fee_head       = $this->input->post('fee_head');
            $amount         = $this->input->post('amount');
            
             
            $formCode       = $this->input->post('formCode');
            
             $data = array(
                'fh_Id'         => $fee_head,
                'fcs_amount'    => $amount,
                'formCode'      => $formCode,
                'fcs_userId'    => $userInfo->user_id,
                'timestamp'     => date('Y-m-d H:i:s')
                );
             $this->CRUDModel->insert('fee_class_setups_demo',$data); 
             
             $result = $this->FeeModel->get_fee_setup_head(array('formCode'=> $formCode,'fcs_userId'=> $userInfo->user_id,));
        
             
             echo '<div class="panel panel-theme">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Transitions</h3>
                                        </div>
                                        <div class="panel-body">
                                   
                                            <table id="testing123" cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th class="hidden-sm">#</th>
                                                        <th>Fee Head</th>
                                                        <th>Amount</th>
                                                        <th><i class="icon-trash" style="color:#fff"></i><b> Delete</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    ';
                                            $sn = '';
                                          foreach($result as $row):
                                                $sn++;
                                                echo '<tr id="'.$row->fcs_id.'fee_Delete" class="danger">
                                                        <td class="hidden-sm">'.$sn.'</td>
                                                        <td>'.$row->fh_head.'</td>
                                                        <td>'.$row->fcs_amount.'</td>
                                                       <td> &nbsp;<a href="javascript:void(0)" id="'.$row->fcs_id.'" class="deleteFeeHead"><button type="button" class="btn btn-danger btn-xs"> Delete</button></a></td>
                                                        </tr>
                                                     ';
                                            endforeach;          
                                                    echo ' 
                                                </tbody>
                                            </table>
                                   
                                        </div>
                                    </div>';
                                                    
                             ?>                       
                            <script>
                            jQuery(document).ready(function(){

                                 jQuery('.deleteFeeHead').on('click',function(){
                                     
                                 var deletId = this.id;
                                    
                                 jQuery.ajax({
                                     type:'post',
                                     url : 'FeeController/delete_fee_head',
                                     data: {'deletId':deletId},
                                     success : function(result){
                                        var del = deletId+'fee_Delete';
                                        jQuery('#'+del).hide(); 
 
                                     }
                                 });

                             });

                            });

                            </script><?php
    }
    
    public function delete_fee_head(){
        
         $this->CRUDModel->deleteid('fee_class_setups_demo',array('fcs_id'=>$this->input->post('deletId')));
    }
 public function class_setups_edit(){
        $userInfo =  json_decode(json_encode($this->getUser()), FALSE);
        $this->data['fee_head']         = $this->CRUDModel->dropDown('fee_heads', ' Fee Head ', 'fh_Id', 'fh_head');
        $this->data['pc_array']         = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', ' Payment Type', 'pc_id', 'title');
        $this->data['sub_pro_name']     = $this->CRUDModel->sub_proDropDown('sub_programes', '', 'sub_pro_id', 'name');
        $this->data['batch_name']       = $this->CRUDModel->dropDown('prospectus_batch', 'Batch Name', 'batch_id', 'batch_name');
        $this->data['shift_name']       = $this->CRUDModel->dropDown('shift', 'Shift Name', 'shift_id', 'name');
        
        if($this->input->post()):
    
            
            $fee_head       = $this->input->post('fee_head');
            $sub_pro_nameId = $this->input->post('sub_pro_name');
            $amount         = $this->input->post('amount');
            $batch_id       = $this->input->post('batch_id');
            $dateFrom       = date('Y-m-d', strtotime($this->input->post('fee_from')));
            $dateTo         = date('Y-m-d', strtotime($this->input->post('fee_to')));
            $valid_till     = date('Y-m-d', strtotime($this->input->post('valid_till')));
            $pc_id          = $this->input->post('pc_id');
            $shift_id       = $this->input->post('shift_id');
            $comment        = $this->input->post('comment');
            $classSetupId   = $this->input->post('classSetupId');
            
            
             
              $dataUp = array(
                'fh_Id'         => $fee_head,
                'sub_pro_id'    => $sub_pro_nameId,
                'fcs_amount'    => $amount,
                'batch_id'      => $batch_id,
                'shift_id'      => $shift_id,
                'fee_from'      => $dateFrom,
                'fee_to'        => $dateTo,
                'valid_till'    => $valid_till,
                'pc_id'         => $pc_id,
                'fcs_comments'  => $comment,
                'fcs_userId_up'    => $userInfo->user_id,
                'fcs_timestamp_up' => date('Y-m-d H:i:s')
                );
                 $where = array('fcs_id'=>$classSetupId);   
                 $this->CRUDModel->update('fee_class_setups',$dataUp,$where);
                 
                 $install_result_old = $this->CRUDModel->get_where_result('fee_class_setups',array('sub_pro_id'=> $sub_pro_nameId,'pc_id'=> $pc_id));
                 
                 $grand_installement = 0;
                 foreach($install_result_old as $iro):
                     $grand_installement += $iro->fcs_amount;
                 endforeach;
                 
        //Installment wise result save         
            $install_result = $this->CRUDModel->get_where_result('fee_catetory_wise',array('sub_pro_id'=>$sub_pro_nameId,'pc_id'=> $pc_id));
                
               if(empty($install_result)):
                   $data_install = array(
                      'sub_pro_id'      => $sub_pro_nameId,
                      'pc_id'           => $pc_id,
                       'batch_id'       => $batch_id,
                       'shift_id'       => $shift_id,
                      'fcw_amount'      => $grand_installement, 
                      'fcw_userId'      => $userInfo->user_id, 
                      'fcw_timestamp'   => date('Y-m-d H:i:s'), 
                   );
                    $this->CRUDModel->insert('fee_catetory_wise',$data_install);
                   else:
                    
                  $data_install_where = array(
                      'sub_pro_id'      => $sub_pro_nameId,
                      'pc_id'           => $pc_id,
                    );
                   $data_up = array(
                      'fcw_amount'      => $grand_installement, 
                       'shift_id'       => $shift_id,
                       'batch_id'        => $batch_id,
                       'fcw_userId'      => $userInfo->user_id, 
                       'fcw_timestamp'   => date('Y-m-d H:i:s'),   
                   );
                   
                   $this->CRUDModel->update('fee_catetory_wise',$data_up,$data_install_where);
               endif;
               
        //Session wise result save      
               $where_balance = array(
                 'fee_class_setups.sub_pro_id'=>$sub_pro_nameId,
                 'inst_type_id' =>1  
               );                      
                                        $this->db->join("fee_payment_category",'fee_class_setups.pc_id=fee_payment_category.pc_id'); 
                                        $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                                        $annual_total_query  =  $this->db->where($where_balance)->get('fee_class_setups')->result();                        
//              $annual_total_query  = $this->CRUDModel->get_where_result('fee_class_setups',array('sub_pro_id'=>$sub_pro_nameId));
                
               $annual_total_amount = 0;
               foreach($annual_total_query as $rowAnnual):
                   $annual_total_amount +=$rowAnnual->fcs_amount;
               endforeach;
                
               
               $annual_result   = $this->CRUDModel->get_where_result('fee_total_anual',array('sub_pro_id'=>$sub_pro_nameId,'batch_id'=>$batch_id));
               $program_id      = $this->CRUDModel->get_where_row('sub_programes',array('sub_pro_id'=>$sub_pro_nameId));
               
//                        $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');   
//                $installment_type = $this->db->where('pc_id',$pc_id)->get('fee_payment_category')->row();
//               
//               
               
               
//              if($installment_type->inst_type_id == 1):
                 if(empty($annual_result)):
                   $data_anual_insert = array(
                      'program_id'      => $program_id->programe_id,
                      'sub_pro_id'      => $sub_pro_nameId,
                      'total_amount'    => $annual_total_amount, 
                       'batch_id'       =>$batch_id,
                      'userId'          => $userInfo->user_id, 
                      'timestamp'       => date('Y-m-d H:i:s')  
                   );
                    $this->CRUDModel->insert('fee_total_anual',$data_anual_insert);
                      
                   else:
                    
                  $data_annual_where = array(
                      'sub_pro_id'      => $sub_pro_nameId,
                       'program_id'     => $program_id->programe_id,
                       'batch_id'        =>$batch_id,
                     
                   );
                   $data_annual_up = array(
                       'total_amount'    => $annual_total_amount, 
                       'up_userId'       => $userInfo->user_id, 
                       'up_timestamp'    => date('Y-m-d H:i:s') 
                         
                   );
                   
                   $this->CRUDModel->update('fee_total_anual',$data_annual_up,$data_annual_where);
               endif;
//                  endif;
               redirect('classSetups');
            
           endif;
           
           $uri2= $this->uri->segment(2);
           if(!empty($uri2)):
              
            $record = $this->FeeModel->get_class_setup_update(array('fcs_id'=>$uri2));
//           echo '<pre>';print_r($record);die;
           $this->data['fee_headId']   = $record->fh_id;
            $this->data['fcs_id']       = $record->fcs_id;
            $this->data['sub_pro_id']   = $record->sub_pro_id;
            $this->data['pc_id']        = $record->pc_id;
            $this->data['batch_id']     = $record->batch_id;
            $this->data['valid_till']   = date('d-m-Y',strtotime($record->valid_till));
            $this->data['shift_id']     = $record->shift_id;
            $this->data['fcs_amount']   = $record->fcs_amount;
            $this->data['fee_to']       = date('d-m-Y',strtotime($record->fee_to));
            $this->data['fee_from']     = date('d-m-Y',strtotime($record->fee_from));
//            $this->data['fee_from']     = $record->fee_from;
            $this->data['fcs_comments'] = $record->fcs_comments;
//            $this->data['fcs_date_from']= date('d-m-Y', strtotime($record->fcs_date_from));
//            $this->data['fcs_date_to']  = date('d-m-Y', strtotime($record->fcs_date_to));
       
           endif;
        $this->data['result']    = $this->FeeModel->get_class_setup();
 
        $this->data['page']         = 'Fee/setups/class_fee_setup_edit';
        $this->data['page_header']  = 'Installment Heads allotment Update';
        $this->data['page_title']   = 'Installment Heads allotment Update | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function class_setups_delete(){
//        
//        $setup_detail = $this->CRUDModel->get_where_row('fee_class_setups',array('fcs_id'=>$this->uri->segment(2)));
//       //Installment wise delete amount
//        $where_instal_fee = array(
//          'batch_id'=>$setup_detail->batch_id,
//            'sub_pro_id'=>$setup_detail->sub_pro_id,  
//            
//        );
//         $fee_instal_fee = $this->CRUDModel->get_where_row('fee_total_anual',$where_instal_fee);
//        $data_instal_fee = array(
//            'fcw_amount'=>$fee_instal_fee->total_amount -$setup_detail->fcs_amount ,
//        );
//         $this->CRUDModel->update('fee_catetory_wise',$data_instal_fee,$where_instal_fee);
//        
//        // Update annul fee 
//        $where_total_annual = array(
//            'batch_id'=>$setup_detail->batch_id,
//            'sub_pro_id'=>$setup_detail->sub_pro_id,
//                );
//        $fee_total_anual = $this->CRUDModel->get_where_row('fee_total_anual',$where_total_annual);
//       
//        $data_total_annul = array(
//            'total_amount'=>$fee_total_anual->total_amount -$setup_detail->fcs_amount ,
//        );
//     
//        $this->CRUDModel->update('fee_total_anual',$data_total_annul,$where_total_annual);
        $this->CRUDModel->deleteid('fee_class_setups',array('fcs_id'=>$this->uri->segment(2)));
        redirect('classSetups');
    }
    public function updat_trams_fee_record(){
               $pc_id = $this->input->post('pc_id');
         $pc_details  = $this->CRUDModel->get_where_row('fee_payment_category',array('pc_id'=>$pc_id));
        
        $where = array(
          'sub_pro_id'=>$pc_details->sub_pro_id,  
          'pc_id'=>$pc_details->pc_id,  
        );
 
                         $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');   
         $amount_array = $this->db->where($where)->get('fee_class_setups')->result();   
 
         echo '<h3 class="has-divider text-highlight">Challan Details </h3>
                                        <div class="table-responsive">
             <table class="table table-hover" id="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fee Head</th>
                            <th>Adjust Amount</th>
                        </tr>
                        </thead>
                        <tbody>';
                    $sn = '';
                        $grand_actual_amount = '';
                        $grand_paid_amount = '';

                          foreach($amount_array as $row):


                            $sn++;
                            echo '<tr">
                                <th>'.$sn.'</th>
                                <th>'.$row->fh_head.'</th>
                                
                                <th><input value="'.$row->fcs_amount.'" name="update_amount[]" class="update_installment"></th>
                                <th><input type="hidden" value="'.$row->fcs_id.'" name="update_amount_id[]"></th>
                                 </tr>';
                            $grand_actual_amount  += $row->fcs_amount;
                            $grand_paid_amount    += $row->fcs_amount;
                        endforeach;      

                          echo '<tr ">
                                <th> </th>
                                <th>Total Amount</th>
                            
                                <th><input readonly="readonly" type="text" class="total" value="'.$grand_paid_amount.'"></th>
                            </tr>';       
                            echo ' 
                      </tbody>
              </table></div>';
    }
    public function fee_Category_Wise(){
      
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
//        $this->data[' sub_program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
         $this->data['sub_program']     = $this->CRUDModel->dropDown('sub_programes', 'Sub Program', 'sub_pro_id', 'name');
        $this->data['programe_id']      = '';
        $this->data['sub_pro_id']       = '';
        $this->data['result']           = $this->FeeModel->fee_category_wise();
        
    
        if($this->input->post()):

            $sub_pro_id     = $this->input->post('sub_pro_id');
            $programe_id    = $this->input->post('programe_id');
        
            $where = array(
                'sub_programes.sub_pro_id'    => $sub_pro_id,
                'programes_info.programe_id'    => $programe_id,
              );
            $this->data['programe_id']  = $programe_id;
            $this->data['sub_pro_id']   = $sub_pro_id;
            $this->data['result']       = $this->FeeModel->fee_category_wise($where);
//                echo '<pre>';print_r($this->data);die;
           endif;
           
      
           
      
//        echo '<pre>';print_r($this->data['result'] );die;
        $this->data['page']         = 'Fee/setups/class_fee_category_wise';
        $this->data['page_header']  = 'Total Installment Amount';
        $this->data['page_title']   = 'Total Installment Amount | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function fee_Category_Wise_Edit(){
        
        $userInfo =  json_decode(json_encode($this->getUser()), FALSE);
        $this->data['fee_head']         = $this->CRUDModel->dropDown('fee_heads', ' Fee Head ', 'fh_Id', 'fh_head');
        $this->data['pc_array']         = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', ' Payment Type', 'pc_id', 'title');
        $this->data['sub_pro_name']     = $this->CRUDModel->sub_proDropDown('sub_programes', '', 'sub_pro_id', 'name');
        $uri2 = $this->uri->segment(2);
     
           if(!empty($uri2)):
                   
            $record = $this->FeeModel->fee_category_wise_update(array('fcw_id'=>$uri2));

       
            $this->data['sub_pro_id']   = $record->sub_pro_id;
            $this->data['pc_id']        = $record->pc_id;
            $this->data['fcw_Id']       = $record->fcw_Id;
            $this->data['fcw_amount']   = $record->fcw_amount;
            $this->data['fcw_comments'] = $record->fcw_comments;
 
       
           endif;
       
        
        
        if($this->input->post()):
            
            $sub_pro_nameId = $this->input->post('sub_pro_nameId');
            $pc_id          = $this->input->post('pc_id');
            $amount         = $this->input->post('amount');
            $comment        = $this->input->post('comment');
            
            
             $data = array(
                'sub_pro_id'    => $sub_pro_nameId,
                'fcw_amount'    => $amount,
                'pc_id'         => $pc_id,
                'fcw_comments'  => $comment,
                'fcw_userId'    => $userInfo->user_id,
                'fcw_timestamp' => date('Y-m-d H:i:s')
                );
            
            $where = array('fcw_id'=>$this->input->post('fcw_id'));
            $this->CRUDModel->update('fee_catetory_wise',$data,$where);
                redirect('feeCategoryWise');
           endif;
        $this->data['page']         = 'Fee/setups/class_fee_category_wise_edit';
        $this->data['page_header']  = 'Fee Category Wise Edit';
        $this->data['page_title']   = 'Fee Category Wise Edit | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function fee_Category_Wise_delete(){
        $this->CRUDModel->deleteid('fee_catetory_wise',array('fcw_Id'=>$this->uri->segment(2)));
        redirect('feeCategoryWise');
    }
    public function fee_total_year_Wise(){
         
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', 'Batch ', 'batch_id', 'batch_name');
       
        $this->data['sub_pro_id']   = '';
        $this->data['program_id']   = '';
        $this->data['batch_id']     = '';
      
        $this->data['result']    = $this->FeeModel->fee_total_year_wise();
        
        if($this->input->post()):

            $sub_pro_nameId = $this->input->post('sub_pro_id');
            $program        = $this->input->post('programe_id');
            $batch_id       = $this->input->post('batch_id');
           
            $this->data['sub_pro_id']   = $sub_pro_nameId;
            $this->data['program_id']   = $program;
            $this->data['batch_id']     = $batch_id;
            
            
            $where = '';
            if($program):
            $where['program_id']                = $program;
            $this->data['program_id']           = $program;
            endif;
            if($sub_pro_nameId):
            $where['sub_programes.sub_pro_id']  = $sub_pro_nameId;
            $this->data['sub_pro_id']           = $sub_pro_nameId;
            endif;
            if($batch_id):
            $where['prospectus_batch.batch_id'] = $batch_id;
            $this->data['batch_id']             = $batch_id;
            endif;
        
           $this->data['result']    = $this->FeeModel->fee_total_year_wise($where);
          
             
            
        endif;
 
           
  
//         echo '<pre>';print_r($this->data['result'] );die;
        $this->data['page']         = 'Fee/setups/class_fee_year_wise';
        $this->data['page_header']  = 'Total Session Amount';
        $this->data['page_title']   = 'Total Session Amount | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function fee_total_year_Wise_delete(){
        $this->CRUDModel->deleteid('fee_total_anual',array('total_anual_id'=>$this->uri->segment(2)));
        redirect('feeTotalperYear');
    }
    public function fee_challan_status(){
        $userInfo =  json_decode(json_encode($this->getUser()), FALSE);
        $this->data['Description']  = '';
        $this->data['comments']     = '';
        $this->data['fcs_id']       = '';
        
        if($this->input->post()):
        
            $Description    = $this->input->post('Description');
            $comments       = $this->input->post('comments');
            $fcs_id         = $this->input->post('fcs_id');
            
            if($fcs_id):
                $data = array(
                'fcs_title'         => $Description,
                'fcs_comments'      => $comments,
                 'up_userId'        => $userInfo->user_id,
                'up_timestamp'      => date('Y-m-d H:i:s')
            );
            $where = array('ch_status_id'=>$fcs_id);
            $id = $this->CRUDModel->update('fee_challan_status',$data,$where);
           
          
            redirect('challanStatus');
                else:
                $data = array(
                'fcs_title'     =>$Description,
                'fcs_comments'  =>$comments,
                 'userId'       => $userInfo->user_id,
                'timestamp'     => date('Y-m-d H:i:s')
            );
            
            $this->CRUDModel->insert('fee_challan_status',$data);
            endif;

        endif;
        $uri2  = $this->uri->segment(2);
        if($uri2):
            $result = $this->CRUDModel->get_where_row('fee_challan_status',array('ch_status_id'=>$uri2));
            $this->data['Description']  = $result->fcs_title;
            $this->data['comments']     = $result->fcs_comments;
            $this->data['fcs_id']       = $result->ch_status_id;
        endif;
        $this->data['result'] = $this->CRUDModel->getResults('fee_challan_status');
        $this->data['page']         = 'Fee/setups/fee_challan_status';
        $this->data['page_header']  = 'Fee Challan Status';
        $this->data['page_title']   = 'Fee Challan Status | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function challan_status_delete(){
        $this->CRUDModel->deleteid('fee_challan_status',array('ch_status_id'=>$this->uri->segment(2)));
        redirect('challanStatus');
    }
    public function fee_comments(){
        
        $userInfo =  json_decode(json_encode($this->getUser()), FALSE);
        
        $this->data['comments']     = '';
        $this->data['commentId']       = '';
        
        if($this->input->post()):
        
            $comments       = $this->input->post('comments');
            $commentId         = $this->input->post('commentId');
            
            if($commentId):
                $data = array(
              
                'comment'      => $comments,
                'up_userId'    => $userInfo->user_id,
                'up_timestamp' => date('Y-m-d H:i:s')
            );
            $where = array('commentId'=>$commentId);
            $this->CRUDModel->update('fee_challan_comment',$data,$where);
           
          
            redirect('Comments');
                else:
                $data = array(
                
                'comment'  =>$comments,
                 'userId'       => $userInfo->user_id,
                'timestamp'     => date('Y-m-d H:i:s')
            );
            
            $this->CRUDModel->insert('fee_challan_comment',$data);
            endif;

        endif;
        $uri2  = $this->uri->segment(2);
        if($uri2):
            $result = $this->CRUDModel->get_where_row('fee_challan_comment',array('commentId'=>$uri2));
            
            $this->data['comments']     = $result->comment;
            $this->data['commentId']       = $result->commentId;
        endif;
        $this->data['result'] = $this->CRUDModel->getResults('fee_challan_comment');
        $this->data['page']         = 'Fee/setups/fee_comment';
        $this->data['page_header']  = 'Fee Commnets';
        $this->data['page_title']   = 'Fee Commnets | ECMS';
        $this->load->view('common/common',$this->data);
    }
   
    public function comments_delete(){
        $this->CRUDModel->deleteid('fee_challan_comment',array('commentId'=>$this->uri->segment(2)));
        redirect('Comments');
    }
    public function concession_type(){
        
        $userInfo =  json_decode(json_encode($this->getUser()), FALSE);
        
        $this->data['concession']           = '';
        $this->data['concess_type_id']   = '';
        
        if($this->input->post()):
        
            $concession       = $this->input->post('concession');
            $concess_type_id         = $this->input->post('concession_type_id');
            
            if($concess_type_id):
                $data = array(
                'title'   => $concession,
//                'up_userId'    => $userInfo->user_id,
//                'up_timestamp' => date('Y-m-d H:i:s')
            );
            $where = array('concess_type_id'=>$concess_type_id);
            $this->CRUDModel->update('fee_concession_type',$data,$where);
           
          
            redirect('ConcessionType');
                else:
                $data = array(
                
                'title'         =>$concession,
                 'userId'       => $userInfo->user_id,
                'timestamp'     => date('Y-m-d H:i:s')
            );
            
            $this->CRUDModel->insert('fee_concession_type',$data);
            endif;

        endif;
        $uri2  = $this->uri->segment(2);
        if($uri2):
            $result = $this->CRUDModel->get_where_row('fee_concession_type',array('concess_type_id'=>$uri2));
            
            $this->data['concession']     = $result->title;
            $this->data['concess_type_id']       = $result->concess_type_id;
        endif;
        $this->data['result'] = $this->CRUDModel->getResults('fee_concession_type');
        $this->data['page']         = 'Fee/setups/fee_concession_type';
        $this->data['page_header']  = 'Fee Concession Type';
        $this->data['page_title']   = 'Fee Concession Type | ECMS';
        $this->load->view('common/common',$this->data);
    }
   
    public function concession_type_delete(){
        $this->CRUDModel->deleteid('fee_concession_type',array('concess_type_id'=>$this->uri->segment(2)));
        redirect('ConcessionType');
    }
    public function getSections(){
        $sectionId = $this->input->post('sub_program_id');
        $where = array('sub_pro_id'=>$sectionId,'sections.status'=>'On');
        $getSections = $this->FeeModel->getSections($where);
    echo '<option value="">Select</option>';
        foreach($getSections as $secRow):
               echo '<option value="'.$secRow->sec_id.'">'.$secRow->name.'</option>';
        endforeach;
    }
    public function getBatch(){
        $programId = $this->input->post('programId');
        $where = array('programe_id'=>$programId);
        $getbatchs = $this->CRUDModel->get_where_result('prospectus_batch',$where);
         echo '<option value="">Select</option>';
        foreach($getbatchs as $secRow):
               echo '<option value="'.$secRow->batch_id.'">'.$secRow->batch_name.'</option>';
        endforeach;
    }
    public function getPaymentType(){
        $sectionId = $this->input->post('sub_program_id');
        $where = array('sub_pro_id'=>$sectionId);
        $getSections = $this->FeeModel->getSections($where);
         echo '<option value="">Select</option>';
        foreach($getSections as $secRow):
               echo '<option value="'.$secRow->sec_id.'">'.$secRow->name.'</option>';
        endforeach;
    }
    public function getPaymentCategory(){
        $sectionId = $this->input->post('sub_program_id');
        $where = array('sub_programes.sub_pro_id'=>$sectionId);
        $getResult = $this->FeeModel->get_Payment_Category($where);
       echo '<option value="">Select</option>';
        foreach($getResult as $secRow):
               echo '<option value="'.$secRow->pc_id.'">'.$secRow->title.'('.$secRow->name.')-'.$secRow->batch_name.'</option>';
        endforeach;
    }
  public function fee_challan(){
 
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['pc_id']        = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', 'Payment Category', 'pc_id', 'title');
        $this->data['bank']         = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name',array('bank_id'=>8));  
        $this->data['year']         = $this->CRUDModel->dropDown('fee_financial_year','', 'id', 'year');
            
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['sub_pro_id']   = '';
        $this->data['issuDate']     = '';
        
        if($this->input->post()):
            $userInfo       = json_decode(json_encode($this->getUser()), FALSE);
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $pc_id          = $this->input->post("pc_id");
            $fromDate       = $this->input->post("fromDate");
            $uptoDate       = $this->input->post("uptoDate");
            $dueDate        = $this->input->post("dueDate");
            $issuDate       = $this->input->post("issuDate");
            $bank_id        = $this->input->post("bank_id");
            $year_id        = $this->input->post("year_id");
            $comment        = $this->input->post("challan_comment");
           
            $where = '';
//            $where['student_record.rseats_id !='] = 12;
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
            
       
            
            $result = $this->FeeModel->fee_challan_students_fee_generate($where);
//             echo '<pre>';print_r($result);die;
//******************************************************************************************************            
//********************            FEE CHALLAN  GENERATION                             ******************
//******************************************************************************************************

            
             //student name challan
            foreach($result as $studentRow):
               
                            
                $check_payment_type = $this->db->where(array('pc_id'=>$pc_id,'cat_title_id'=>1))->get('fee_payment_category')->row();
            
            if(empty($check_payment_type)):
                    $fee_challan_exist = $this->CRUDModel->key_exists('fee_challan',array('fc_student_id'=>$studentRow->student_id,'fc_pay_cat_id'=>$pc_id,'installment_type'=>1));
          
            else:
                $checking_where =array(
                    
                    'fc_student_id'     => $studentRow->student_id,
                    'fc_pay_cat_id'     => $pc_id,
                    'installment_type'  => 1,
                    'cat_title_id'      => 6
                    );
                   $fee_challan_exist = $this->FeeModel->student_challan_exists('fee_challan',$checking_where); 
                   
                
                endif;
          
//                $fee_challan_exist = $this->CRUDModel->key_exists('fee_challan',);
                 
//             $fee_challan_exist = $this->db->where($checking_where)->get('fee_challan')->num_rows();
//******************************************************************************************************            
//********************            FEE CHALLAN CHECKING IF EXIST                       ******************
//******************************************************************************************************
               
            if(!empty($fee_challan_exist)):
                
            echo 'Exist';
             
                else:

//******************************************************************************************************            
//********************            CHECKING STUDENT PAID ANNUAL PAYMNET                ******************
//****************************************************************************************************** 
                
      
              $fee_challan_exist = $this->CRUDModel->check_student('fee_challan',array('fc_student_id'=>$studentRow->student_id,'installment_type'=>2));
                
                if(empty($fee_challan_exist->fc_student_id)):
                    
                
                 $total_balanc_an = $this->CRUDModel->get_where_row('fee_total_anual',array('sub_pro_id'=>$sub_pro_id));
//******************************************************************************************************            
//********************            CHECKING ANNUAL AMOUNT AGISNT SUB PROGRAM           ******************
//****************************************************************************************************** 
              
                   if(!empty($total_balanc_an)):
            
                    $check_balance =  $this->CRUDModel->get_where_row('fee_total_balance',array('student_id'=>$studentRow->student_id,'batch_id'=>$studentRow->batch_id,'sub_por_id'=>$studentRow->sub_pro_id));
                   
//******************************************************************************************************            
//********************    CHECKING AMOUNT AGISNT STUDENT (FIST PAYMENT OR 2ND PAYMENT) ******************
//******************************************************************************************************                       
                      if(!empty($check_balance)):
//                   
                        $total_balace_update = array(
                            'total_r_amount' => $total_balanc_an->total_amount+$check_balance->total_r_amount,
                            'timestamp'      => date('Y-m-d H:i:s'), 
                            'userId'         => $userInfo->user_id );
                      $this->CRUDModel->update('fee_total_balance',$total_balace_update,array('student_id'=>$studentRow->student_id));
                            else:
                      
                        $total_balance_inset = array(
                            'student_id'     =>$studentRow->student_id,
                            'batch_id'       =>$studentRow->batch_id,
                            'sub_por_id'     =>$studentRow->sub_pro_id,
                            'total_r_amount' =>$total_balanc_an->total_amount,
                            'timestamp'      => date('Y-m-d H:i:s'), 
                            'userId'         => $userInfo->user_id );
                       $this->CRUDModel->insert('fee_total_balance',$total_balance_inset);
                        endif;
                        
                           
                         else:     
                    $this->session->set_flashdata('error_payment', 'Total Annual Amount Not Enter');
                    redirect('feeChallan');
                      echo 'Total Annual Amount Not Enter';die;
              
 
              
                   endif;
              //Insert challan info against the student
                   $data = array(
                    'fc_student_id'     => $studentRow->student_id,
                    'fc_student_id'     => $studentRow->student_id,
                    'program_id_paid'   => $studentRow->programe_id,
                    'batch_id_paid'     => $studentRow->batch_id,
                    'sub_pro_id_paid'   => $studentRow->sub_pro_id,
                    'section_id_paid'   => $studentRow->section_id,
//                    'section_id_paid'   => $section,
                       
                    'fc_ch_status_id'   => 1, //Challan status not paid
                    'fc_paid_form'      => date_format(date_create($fromDate),"Y-m-d"), 
                    'fc_paid_upto'      => date_format(date_create($uptoDate),"Y-m-d"), 
                    'fc_dueDate'        => date_format(date_create($dueDate),"Y-m-d"), 
                    'fc_issue_date'     => date_format(date_create($issuDate),"Y-m-d"), 
                    'fc_pay_cat_id'     => $pc_id, 
                    'fc_bank_id'        => $bank_id, 
                    'challan_id_lock'   => 0, 
                    'financial_id'      => $year_id, 
                    'fc_comments'       => $comment, 
                    'fc_timestamp'      => date('Y-m-d H:i:s'), 
                    'fc_userId'         => $userInfo->user_id
                    );
                       
                        $challan_id = $this->CRUDModel->insert('fee_challan',$data);
                         //Search info about installement detials and insert to fee_challan_detail table
                        
                       $fee_setups = $this->CRUDModel->get_where_result('fee_class_setups',array('pc_id'=>$pc_id,'sub_pro_id'=>$sub_pro_id));
                    
//                       echo '<pre>';print_r($fee_setups);die;
                       
                        $this->RQ($challan_id,'assets/RQ/challan_rq/');
                        $this->CRUDModel->update('fee_challan',array('fc_challan_rq'=>$challan_id.'.png'),array('fc_challan_id'=>$challan_id));
                        //Check old balance amount 
                       
                        
                         
                
                            $old_balance = array(
//                            'fc_student_id'   =>'7096',  
                                'fc_student_id'     => $studentRow->student_id,  
                                'balance >'         => 0,  
                        );
//                                            $this->db->select('student_name,fee_challan.fc_challan_id,fee_actual_challan_detail.balance,');
                                             $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                        $old_balane_amount = $this->db->get_where('fee_challan',$old_balance)->result();
                       
                      if(!empty($old_balane_amount)):
                         foreach($old_balane_amount as $OLBA):
                          
                      
                          $pc_cat  = '';
                                if(empty($OLBA->fc_pay_cat_id)):
                              $pc_cat = '25';
                              else:
                             $pc_cat = $OLBA->fc_pay_cat_id; 
                          endif;
                          
                            $datafs = array(
                                'challan_id'        => $challan_id,
                                'fee_id'            => $OLBA->fee_id,
                                'actual_amount'     => $OLBA->balance,
                                'paid_amount'       => $OLBA->balance,
                                'balance'           => $OLBA->balance,
                                'comment'           => $OLBA->comment,
                                'old_balance_pc_id' => $pc_cat,
                                'challan_status'    => 1,
                                'add_new_heads_flag'=> 1,
                                'timestamp'         => date('Y-m-d H:i:s'),
                                'useId'             => $userInfo->user_id
                            );
                            $this->CRUDModel->insert('fee_actual_challan_detail',$datafs);
                          
                            // add old challan id into New challan 
                            $this->CRUDModel->update('fee_challan',array('old_balance_challan_id'=>$OLBA->fc_challan_id),array('fc_challan_id'=>$challan_id));
                           //Lock Old challan 
                            $this->CRUDModel->update('fee_challan',array('challan_id_lock'=>1),array('fc_challan_id'=>$OLBA->fc_challan_id));
                          
                            //Remove balance from old challan table
                            $this->CRUDModel->update('fee_actual_challan_detail',array('balance'=>0),array('challan_detail_id'=>$OLBA->challan_detail_id));
                          
                        endforeach;
                        
                            
                      endif;
                        
                        
                        $student_balance = 0;
                       foreach($fee_setups as $fsRow):
                    $datafs = array(
                                'challan_id'    => $challan_id,
                                'fee_id'        => $fsRow->fcs_id,
                                'actual_amount' => $fsRow->fcs_amount,
                                'paid_amount'   => $fsRow->fcs_amount,
                                'balance'       => $fsRow->fcs_amount,
                                'challan_status'=> 1,
                                'timestamp'     => date('Y-m-d H:i:s'),
                                'useId'         => $userInfo->user_id
                            );
//                            $student_balance +=$fsRow->fcs_amount;
                          $this->CRUDModel->insert('fee_actual_challan_detail',$datafs);
                       endforeach;
                       
                       
//                       die;
                    //insert Extra Head againt the challan 
                        
                  $fee_setups_heads = $this->CRUDModel->get_where_result('fee_extra_heads',array('student_id'=>$studentRow->student_id,'apply_status'=>1));
                   if($fee_setups_heads):
                      foreach($fee_setups_heads as $fsRow):
                           
                        $fine_setups = array(
                            'fh_Id'            =>$fsRow->fh_id,
                            'fcs_amount'       =>$fsRow->amount,
                            'fcs_timestamp'    => date('Y-m-d H:i:s'), 
                            'fcs_userId'       => $userInfo->user_id
                        );
             
                    $actual_chal_head = $this->CRUDModel->insert('fee_class_setups',$fine_setups);
                                
                    $datafs = array(
                                'challan_id'    => $challan_id,
                                'fee_id'        => $actual_chal_head,
                                'actual_amount' => $fsRow->amount,
                                'paid_amount'   => $fsRow->amount,
                                'balance'       => $fsRow->amount,
                                'challan_status'=> 1,
                                'timestamp'     => date('Y-m-d H:i:s'),
                                'useId'         => $userInfo->user_id
                            );
                           
                          $this->CRUDModel->insert('fee_actual_challan_detail',$datafs);
                       endforeach;
                       
                      $fee_setups_heads = $this->CRUDModel->update('fee_extra_heads',array('apply_status'=>2),array('student_id'=>$studentRow->student_id)); 
                      endif;   
                       //End new Heads
                       $where_fee_balance = array(
                         'challan_id'=>$challan_id  
                       );
                                                      $this->db->select('sum(balance) as balance');  
                                                      $this->db->group_by('challan_id');
                    $challan_installment_balance =    $this->db->get_where('fee_actual_challan_detail',$where_fee_balance)->row();
                       
                    //Insert All Current balance against the Payment Category 
                    //1st Payment,2nd Payments....
                    $student_current_balance = array(
                                'student_id'    => $studentRow->student_id,
                                'pay_cat_id'    => $pc_id,
                                'r_amount'      => $challan_installment_balance ->balance,
                                'timestamp'     => date('Y-m-d H:i:s'),
                                'userId'        => $userInfo->user_id  
                            );
                    $this->CRUDModel->insert('fee_balance',$student_current_balance);
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
//                   echo 'challan not Exist';
                endif;
                endif;
                
                $balance_CREDIT = 0;
                $credit_amount =  $this->db->get_where('fee_challan',array('fc_student_id'=>$studentRow->student_id,'credit_flag'=>1,'fc_challan_credit_amount >'=>0))->row();
                    if(!empty($credit_amount)):
                        $challan_comments = $credit_amount->fc_comments.' Credit apply in challan#'.$challan_id;

                                                $this->db->join('fee_class_setups','fee_class_setups.pc_id=fee_payment_category.pc_id');
                        $check_payment_type =   $this->db->where(array('fee_payment_category.pc_id'=>$pc_id,'fh_Id'=>24))->get('fee_payment_category')->row();


                        $WHERE = array(
                               'challan_id'            => $challan_id,
                               'fee_id'                => $check_payment_type->fcs_id,   
                               'old_balance_pc_id'     => 0
                        );
                       $credit_row     =   $this->db->get_where('fee_actual_challan_detail',$WHERE)->row();

                       $SET_CREDIT     = array(
                           'old_credit_amount'=>$credit_amount->fc_challan_credit_amount 
                        );
                        //Update New Challan Details balance
                        $this->CRUDModel->update('fee_actual_challan_detail',$SET_CREDIT,array('challan_detail_id'=>$credit_row->challan_detail_id));
                        //Update old credit challan for apply credit to new challan
                        $this->CRUDModel->update('fee_challan',array('credit_flag'=>2,'fc_comments'=>$challan_comments),array('fc_challan_id'=>$credit_amount->fc_challan_id));
                    
                        $this->db->order_by('balance_id','desc');     
                        $this->db->limit('0','1');     
                        $current_challan_balance = $this->db->get_where('fee_balance',array('student_id'=>$studentRow->student_id))->row();

                        $balance_CREDIT = $current_challan_balance->r_amount-$credit_amount->fc_challan_credit_amount;  
                        //Update Remove CREDIT from fee Balance table
                        $this->CRUDModel->update('fee_balance',array('r_amount'=>$balance_CREDIT,'comments'=>'Credit Adujst Rs:'.$credit_amount->fc_challan_credit_amount.'/'),array('balance_id'=>$current_challan_balance->balance_id));

                        endif;
            endforeach;
            
 
  
            redirect('PrintClassWise/'.$programe_id.'/'.$sub_pro_id.'/'.$section.'/'.$pc_id);
//            redirect('feeChallan');
        endif;
        
        $this->data['page']         = 'Fee/fee_challan';
        $this->data['page_header']  = 'Groups Fee Challan Generate';
        $this->data['page_title']   = 'Groups Fee Challan Generate | ECMS';
        $this->load->view('common/common',$this->data);
        
    }
   
    public function fee_challan_search(){
        
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $pc_id          = $this->input->post("pc_id");
            $fromDate       = $this->input->post("fromDate");
            $toDate         = $this->input->post("toDate");
            $bank_id        = $this->input->post("bank_id");
            $comment        = $this->input->post("comment");
        
         $where = '';
            if($programe_id):
                $where['programes_info.programe_id']= $programe_id;
                $this->data['programe_id']          = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
            if(!empty($section)):
                $where['sections.sec_id']           = $section;
                $this->data['sec_id']               = $section;
            endif;
            $result = $this->FeeModel->fee_challan_students($where);
            
            
            
        
        echo '<div class="row">
              <div class="col-md-12">';
                                        
                      
                                      if(!empty($result)):
                                        echo '  <div id="div_print">
                                                <h3 class="has-divider text-highlight">Result :'; echo count($result); echo '</h3>
                                                    <div class="table-responsive">
                                                    <table class="table table-hover" id="table">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>College#</th>
                                                          <th>Student Name</th>
                                                          <th>Father Name</th>
                                                          <th>Section</th>
                                                          <th>Status</th>
                                                          

                                                      </tr>
                                                    </thead>
                                                    <tbody>';

                                                        $sn = "";
                                                          foreach($result as $row):
                                                          
                                                           $sn++;
                                                            echo '<tr">
                                                                <th>'.$sn.'</th>
                                                                <th>'.$row->college_no.'</th>
                                                                <th>'.$row->student_name.'</th>
                                                                <th>'.$row->father_name.'</th>
                                                                <th>'.$row->sectionsName.'</th>
                                                                <th>'.$row->current_status.'</th>
                                                                </tr>';
                                                         
                                                          endforeach;      
                                               

                                                      

                                                    echo'</tbody>
                                            </table>
                                        </div>';
                                          
                                      endif;
                                    
                                    echo '</div>
                                    </div>
                                  
                                </div>';
         
        
        
        
    }
    public function fee_challan_filters(){
        
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['pc']           = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', 'Payment Category', 'pc_id', 'title');
        $this->data['challan']      = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Challan Status', 'gender_id', 'title');
        
        $this->data['collegeNo']    = '';
        $this->data['gender_id']    = '';
        $this->data['pc_id']        = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['sub_pro_id']   = '';
        $this->data['challan_id']   = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['from']         = '';
        $this->data['to']           = '';
        
        if($this->input->post()):
            
            $collegeNo      = $this->input->post("collegeNo");
            $challan_no      = $this->input->post("challan_no");
            $form_no        = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $pc_id          = $this->input->post("pc_id");
            $challan_status = $this->input->post("challan_status");
            $gender         = $this->input->post("gender");
            $from         = $this->input->post("from");
            $to         = $this->input->post("to");
  
            if($from == ''):
                $date['from']       = ''; 
                $date['to']         = $to;
                 $this->data['from'] = '';
                $this->data['to']   = $to;
                else:
                
                $date['from']       = $from;
                $date['to']         = $to;
                $this->data['from'] = $from;
                $this->data['to']   = $to;
            endif;
            
      
            
            $where      = '';
            $like       = '';
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
            if($challan_status):
                $where['fee_challan_status.ch_status_id'] = $challan_status;
                $this->data['challan_id'] = $challan_status;
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
            
       
            
            $this->data['result'] = $this->FeeModel->fee_challan_filters($where,$like,$date);
            $this->data['count'] = $this->FeeModel->fee_challan_filters_count($where,$like,$date);
            
//              echo '<pre>';print_r( $this->data['result']);die;
        endif;
        
        $this->data['page']         = 'Fee/fee_challan_filters';
        $this->data['page_header']  = 'Fee Challan Search';
        $this->data['page_title']   = 'Fee Challan Search | ECMS';
        $this->load->view('common/common',$this->data);
    }
     public function fee_challan_filters_admin(){
        
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['pc']           = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', 'Payment Category', 'pc_id', 'title');
        $this->data['challan']      = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Challan Status', 'gender_id', 'title');
        
        $this->data['collegeNo']    = '';
        $this->data['gender_id']    = '';
        $this->data['pc_id']        = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['sub_pro_id']   = '';
        $this->data['challan_id']   = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['from']         = '';
        $this->data['to']           = '';
        
        if($this->input->post()):
            
            $collegeNo      = $this->input->post("collegeNo");
            $challan_no      = $this->input->post("challan_no");
            $form_no        = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $pc_id          = $this->input->post("pc_id");
            $challan_status = $this->input->post("challan_status");
            $gender         = $this->input->post("gender");
            $from           = $this->input->post("from");
            $to             = $this->input->post("to");
  
            if($from == ''):
                $date['from']       = ''; 
                $date['to']         = $to;
                 $this->data['from'] = '';
                $this->data['to']   = $to;
                else:
                
                $date['from']       = $from;
                $date['to']         = $to;
                $this->data['from'] = $from;
                $this->data['to']   = $to;
            endif;
            
      
            
            $where      = '';
            $like       = '';
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
            if($challan_status):
                $where['fee_challan_status.ch_status_id'] = $challan_status;
                $this->data['challan_id'] = $challan_status;
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
            
       
            
            $this->data['result'] = $this->FeeModel->fee_challan_filters($where,$like,$date);
            $this->data['count'] = $this->FeeModel->fee_challan_filters_count($where,$like,$date);
            
//              echo '<pre>';print_r( $this->data['result']);die;
        endif;
        
        $this->data['page']         = 'Fee/fee_challan_filters_admin';
        $this->data['page_header']  = 'Fee Challan Search Admin ';
        $this->data['page_title']   = 'Fee Challan Search Admin | ECMS';
        $this->load->view('common/common',$this->data);
    }
    
public function fee_new_head(){
             
         $this->data['balance_type']  = $this->CRUDModel->dropDown('fee_balance_type', '', 'id', 'type');    
         $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$this->uri->segment(3)));
//            echo '<pre>';print_r( $this->data['studentInfo'] );die;
        $this->data['result']       = $this->FeeModel->get_Student_feeDetails(array('fee_actual_challan_detail.challan_id'=>$this->uri->segment(2)));
//            echo '<pre>';print_r( $this->data['result'] );die;
        $this->data['feeComments']  = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$this->uri->segment(2)));
        
      
        
        if($this->input->post()):
          
            $challan_id         = $this->input->post('challan_id');
            $student_id         = $this->input->post('student_id');
            $head_id            = $this->input->post('fee_head');
            $amount             = $this->input->post('amount');
            $comment            = $this->input->post('comment');
            $balance_type       = $this->input->post('balance_type');
            $credit_amount      = $this->input->post('credit_amount');
            $pc_id              = $this->input->post('pc_id');
             $userInfo          = json_decode(json_encode($this->getUser()), FALSE);
            
             $fine_setups = array(
                    'fh_Id'            =>$head_id,
                    'fcs_amount'       =>$amount,
                    'fcs_timestamp'    => date('Y-m-d H:i:s'), 
                    'fcs_userId'       => $userInfo->user_id
             );
             
              $actual_chal_head = $this->CRUDModel->insert('fee_class_setups',$fine_setups);
             
            $fee_setups_details = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challan_id));
         if($fee_setups_details->fc_ch_status_id == 1):
               $data = array(
              
                'challan_id'        =>$challan_id,
                'fee_id'            => $actual_chal_head,
                'actual_amount'     => $amount,
                'paid_amount'       => $amount,
                'balance'           => $amount,
                'comment'           => $comment,
                'old_balance_pc_id' => $balance_type,
                'challan_status'    => 1,
                'add_new_heads_flag'=> 2,
                'timestamp'         => date('Y-m-d H:i:s'), 
                'useId'             => $userInfo->user_id
            );
            $this->CRUDModel->insert('fee_actual_challan_detail',$data);
          endif;
         if($fee_setups_details->fc_ch_status_id == 2):
               $data = array(
              
                'challan_id'        =>$challan_id,
                'fee_id'            => $actual_chal_head,
                'actual_amount'     => $amount,
                'paid_amount'       => $amount,
//                'balance'           => $amount,
                'comment'           => $comment,
                'old_balance_pc_id' => $balance_type,
                'challan_status'    => 1,
                'add_new_heads_flag'=> 2,
                'timestamp'         => date('Y-m-d H:i:s'), 
                'useId'             => $userInfo->user_id
            );
            $this->CRUDModel->insert('fee_actual_challan_detail',$data);
          endif;
          
                           $this->db->select("sum(actual_amount) as all_amount"); 
            $allBalance = $this->db->get_where('fee_actual_challan_detail',array('challan_id'=>$challan_id))->row();
            
          
            $data_update = array(
              'r_amount'     => $allBalance->all_amount,  
               
            );
            $where_update = array(
              'student_id'  => $student_id,  
              'pay_cat_id'  => $pc_id,  
            );
            
              $this->CRUDModel->update('fee_balance',$data_update,$where_update);
               
            
            redirect('feeNewHead/'.$challan_id.'/'.$student_id);
        endif;
        
        
//       echo '<pre>';print_r( $this->data['feeComments'] );die;
        $this->data['page']         = 'Fee/fee_add_new_heads';
        $this->data['page_header']  = 'Add New Heads';
        $this->data['page_title']   = 'Add New Heads | ECMS';
        $this->load->view('common/common',$this->data);
    }
 public function admin_fee_new_head(){
             
        $uri = $this->uri->segment(2);
    
        $check_challan = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$uri));
        if($check_challan->challan_id_lock == 0):
            $this->data['balance_type']  = $this->CRUDModel->dropDown('fee_balance_type', '', 'id', 'type');   
            else:
            $this->data['balance_type']  = $this->CRUDModel->dropDown('fee_balance_type', '', 'id', 'type',array('id'=>0));   
        endif;
      
         
        $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$this->uri->segment(3)));
        $this->data['result']       = $this->FeeModel->get_Student_feeDetails(array('fee_actual_challan_detail.challan_id'=>$this->uri->segment(2)));
        $this->data['feeComments']  = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$this->uri->segment(2)));
        
      
        
        if($this->input->post()):
          
            $challan_id         = $this->input->post('challan_id');
            $student_id         = $this->input->post('student_id');
            $head_id            = $this->input->post('fee_head');
            $amount             = $this->input->post('amount');
            $comment            = $this->input->post('comment');
            $balance_type       = $this->input->post('balance_type');
            $credit_amount      = $this->input->post('credit_amount');
            $pc_id              = $this->input->post('pc_id');
             $userInfo          = json_decode(json_encode($this->getUser()), FALSE);
            
             $fine_setups = array(
                    'fh_Id'            =>$head_id,
                    'fcs_amount'       =>$amount,
                    'fcs_timestamp'    => date('Y-m-d H:i:s'), 
                    'fcs_userId'       => $userInfo->user_id
             );
             
              $actual_chal_head = $this->CRUDModel->insert('fee_class_setups',$fine_setups);
             
            $fee_setups_details = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challan_id));
         if($fee_setups_details->fc_ch_status_id == 1):
            
             if($fee_setups_details->challan_id_lock == 0):
                
                 $data = array(
              
                'challan_id'        =>$challan_id,
                'fee_id'            => $actual_chal_head,
                'actual_amount'     => $amount,
                'paid_amount'       => $amount,
                'balance'           => $amount,
                'comment'           => $comment,
                'old_balance_pc_id' => $balance_type,
                'challan_status'    => 1,
                'add_new_heads_flag'=> 2,
                'timestamp'         => date('Y-m-d H:i:s'), 
                'useId'             => $userInfo->user_id
            );
             $this->CRUDModel->insert('fee_actual_challan_detail',$data);
                else:
                     
                    $data = array(

                            'challan_id'        =>$challan_id,
                            'fee_id'            => $actual_chal_head,
                            'actual_amount'     => $amount,
                            'paid_amount'       => $amount,
                            'balance'           => 0,
                            'comment'           => $comment,
                            'old_balance_pc_id' => $balance_type,
                            'challan_status'    => 1,
                            'add_new_heads_flag'=> 2,
                            'timestamp'         => date('Y-m-d H:i:s'), 
                            'useId'             => $userInfo->user_id
                       );
                $this->CRUDModel->insert('fee_actual_challan_detail',$data);  
                
                
                                $this->db->order_by('fc_challan_id','asc');
                                $this->db->where('fc_challan_id >',$challan_id);
               $next_challans = $this->db->get_where('fee_challan',array('fc_ch_status_id'=>1,'fc_student_id'=>$fee_setups_details->fc_student_id))->result();
            
               
               
               foreach($next_challans as $next_challan):
                   if($next_challan->challan_id_lock == 0):
                       
                       $data = array(
              
                            'challan_id'        =>$next_challan->fc_challan_id,
                            'fee_id'            => $actual_chal_head,
                            'actual_amount'     => $amount,
                            'paid_amount'       => $amount,
                            'balance'           => $amount,
                            'comment'           => $comment,
                             'old_balance_pc_id' => 25,
                            'challan_status'    => 1,
                            'add_new_heads_flag'=> 2,
                            'timestamp'         => date('Y-m-d H:i:s'), 
                            'useId'             => $userInfo->user_id
                        );
                        $this->CRUDModel->insert('fee_actual_challan_detail',$data); 
                      else:
                          $data = array(

                            'challan_id'        =>$challan_id,
                            'fee_id'            => $actual_chal_head,
                            'actual_amount'     => $amount,
                            'paid_amount'       => $amount,
                            'balance'           => 0,
                            'comment'           => $comment,
                            'old_balance_pc_id' => 25,
                            'challan_status'    => 1,
                            'add_new_heads_flag'=> 2,
                            'timestamp'         => date('Y-m-d H:i:s'), 
                            'useId'             => $userInfo->user_id
                       );
                $this->CRUDModel->insert('fee_actual_challan_detail',$data);  
                   endif;
               endforeach;
               
               
             
             endif;
             
               
            
          endif;
         if($fee_setups_details->fc_ch_status_id == 2):
               $data = array(
              
                'challan_id'        =>$challan_id,
                'fee_id'            => $actual_chal_head,
                'actual_amount'     => $amount,
                'paid_amount'       => $amount,
//                'balance'           => $amount,
                'comment'           => $comment,
                'old_balance_pc_id' => $balance_type,
                'challan_status'    => 1,
                'add_new_heads_flag'=> 2,
                'timestamp'         => date('Y-m-d H:i:s'), 
                'useId'             => $userInfo->user_id
            );
            $this->CRUDModel->insert('fee_actual_challan_detail',$data);
          endif;
          
                           $this->db->select("sum(actual_amount) as all_amount"); 
            $allBalance = $this->db->get_where('fee_actual_challan_detail',array('challan_id'=>$challan_id))->row();
            
          
            $data_update = array(
              'r_amount'     => $allBalance->all_amount,  
               
            );
            $where_update = array(
              'student_id'  => $student_id,  
              'pay_cat_id'  => $pc_id,  
            );
            
              $this->CRUDModel->update('fee_balance',$data_update,$where_update);
               
            
            redirect('AdminFeeNewHead/'.$challan_id.'/'.$student_id);
        endif;
        
        
//       echo '<pre>';print_r( $this->data['feeComments'] );die;
        $this->data['page']         = 'Fee/admin_fee_add_new_heads';
        $this->data['page_header']  = 'Admin Add & Update Heads';
        $this->data['page_title']   = 'Admin Add & Update Heads | ECMS';
        $this->load->view('common/common',$this->data);
    }
        //Update on 8-3-2018
    public function fee_new_head_delete_from_otherChallans(){
        
        $head_id        = $this->uri->segment(2);
        $challan_id     = $this->uri->segment(3);
        $student_id     = $this->uri->segment(4);
                    
            $where_nexts = array(
                'fc_student_id'     => $student_id,
                'fc_ch_status_id'   => 1,
                'fc_challan_id >'  => $challan_id,
                    );
                         $this->db->order_by('fc_challan_id','asc');   
                         $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');   
        $next_challans = $this->db->get_where('fee_challan',$where_nexts)->result();
        $fee_id = $this->db->get_where('fee_actual_challan_detail',array('challan_detail_id'=>$head_id))->row();
        if(!empty($next_challans)):
            
      
        foreach($next_challans as $rows):
            $DATA = array(
              'fee_id'      =>  $fee_id->fee_id,
              'challan_id'  =>  $rows->challan_id,
            );
        
        $this->CRUDModel->deleteid('fee_actual_challan_detail',$DATA);
        
        // update balance in balnce
                             $this->db->select('sum(actual_amount) as all_amount,fee_challan.fc_pay_cat_id');
                            $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
        $allBalance = $this->db->get_where('fee_challan',array('fc_challan_id'=>$rows->challan_id))->row();
         
            $data_update_next = array(
              'r_amount'     => $allBalance->all_amount,  
               
            );
            $where_update_next = array(
              'student_id'  => $rows->fc_student_id,  
              'pay_cat_id'  => $allBalance->fc_pay_cat_id,  
            );
            
              $this->CRUDModel->update('fee_balance',$data_update_next,$where_update_next);
        
        
        
        endforeach;
          endif;
 
        
        $where = array(
          'challan_id'          => $challan_id,  
          'challan_detail_id'   => $head_id,  
        );
        // Update log of delete Heads
        $log_delete = $this->db->get_where('fee_actual_challan_detail',$where)->row();
        
        $data_log = array(
          'challan_detail_id'   => $log_delete->challan_detail_id,  
          'challan_id'          => $log_delete->challan_id,  
          'fee_id'              => $log_delete->fee_id,  
          'actual_amount'       => $log_delete->actual_amount,  
          'paid_amount'         => $log_delete->paid_amount,  
          'balance'             => $log_delete->balance,  
          'challan_status'      => $log_delete->challan_status,  
          'add_new_heads_flag'  => $log_delete->add_new_heads_flag,  
          'old_balance_pc_id'   => $log_delete->old_balance_pc_id,  
          'comment'             => $log_delete->comment,  
          'useId'               => $log_delete->useId,  
          'timestamp'           => $log_delete->timestamp,  
          'up_timestamp'        => $log_delete->up_timestamp,  
          'up_userId'           => $log_delete->up_userId,  
          'up_userId'           => $log_delete->up_userId,  
          'delete_time'         => date('Y-m-d H:i:s'),  
          'delete_by'           => $this->userInfo->user_id,  
        );
         $this->CRUDModel->insert('fee_actual_challan_detail_delete_log',$data_log);
       
        
        
        $this->CRUDModel->deleteid('fee_actual_challan_detail',$where);
        
    
                            $this->db->select('sum(actual_amount) as all_amount,fee_challan.fc_pay_cat_id');
                            $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
        $allBalance = $this->db->get_where('fee_challan',array('fc_challan_id'=>$challan_id))->row();
         
            $data_update = array(
              'r_amount'     => $allBalance->all_amount,  
               
            );
            $where_update = array(
              'student_id'  => $student_id,  
              'pay_cat_id'  => $allBalance->fc_pay_cat_id,  
            );
            
              $this->CRUDModel->update('fee_balance',$data_update,$where_update);
               
             
         redirect('feeNewHead/'.$challan_id.'/'.$student_id);
    }
    
         public function fee_new_head_delete(){
        
        $head_id        = $this->uri->segment(2);
        $challan_id     = $this->uri->segment(3);
        $student_id     = $this->uri->segment(4);
          $where = array(
          'challan_id'          => $challan_id,  
          'challan_detail_id'   => $head_id,  
        );
        // Update log of delete Heads
        $log_delete = $this->db->get_where('fee_actual_challan_detail',$where)->row();
        
        
                    $where_prew = array(
                'fc_student_id'     => $student_id,
//                'fc_ch_status_id'   => 1,
                'fee_id'            => $log_delete->fee_id,
                'fc_challan_id !='  => $challan_id,
                    );
                            $this->db->order_by('fc_challan_id','asc');   
                            $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id'); 
            $old_challans = $this->db->get_where('fee_challan',$where_prew)->result();
            
        
        foreach($old_challans as $updatRow):
            $SET = array(
             'challan_detail_id'=>$updatRow->challan_detail_id   
            );
            
            $Data = array(
                'delete_head_flag'  => 0,
//                'comment'           => '',
                'comment'           => $updatRow->comment.' #This  head is delete in challan #'.$challan_id,
            );
            
            $this->CRUDModel->update('fee_actual_challan_detail',$Data,$SET);
        endforeach;
       
        $data_log = array(
          'challan_detail_id'   => $log_delete->challan_detail_id,  
          'challan_id'          => $log_delete->challan_id,  
          'fee_id'              => $log_delete->fee_id,  
          'actual_amount'       => $log_delete->actual_amount,  
          'paid_amount'         => $log_delete->paid_amount,  
          'balance'             => $log_delete->balance,  
          'challan_status'      => $log_delete->challan_status,  
          'add_new_heads_flag'  => $log_delete->add_new_heads_flag,  
          'old_balance_pc_id'   => $log_delete->old_balance_pc_id,  
          'comment'             => $log_delete->comment,  
          'useId'               => $log_delete->useId,  
          'timestamp'           => $log_delete->timestamp,  
          'up_timestamp'        => $log_delete->up_timestamp,  
          'up_userId'           => $log_delete->up_userId,  
          'up_userId'           => $log_delete->up_userId,  
          'delete_time'         => date('Y-m-d H:i:s'),  
          'delete_by'           => $this->userInfo->user_id,  
        );
         $this->CRUDModel->insert('fee_actual_challan_detail_delete_log',$data_log);
       
        
         
        
        $this->CRUDModel->deleteid('fee_actual_challan_detail',$where);
        
    
                            $this->db->select('sum(actual_amount) as all_amount,fee_challan.fc_pay_cat_id');
                            $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
        $allBalance = $this->db->get_where('fee_challan',array('fc_challan_id'=>$challan_id))->row();
         
            $data_update = array(
              'r_amount'     => $allBalance->all_amount,  
               
            );
            $where_update = array(
              'student_id'  => $student_id,  
              'pay_cat_id'  => $allBalance->fc_pay_cat_id,  
            );
            
              $this->CRUDModel->update('fee_balance',$data_update,$where_update);
               
             
         redirect('feeNewHead/'.$challan_id.'/'.$student_id);
    }
    
//     public function fee_new_head_delete(){
//        
//        $head_id        = $this->uri->segment(2);
//        $challan_id     = $this->uri->segment(3);
//        $student_id     = $this->uri->segment(4);
//                    
////            $where_nexts = array(
////                'fc_student_id'     => $student_id,
////                'fc_ch_status_id'   => 1,
////                'fc_challan_id >'  => $challan_id,
////                    );
////                         $this->db->order_by('fc_challan_id','asc');   
////                         $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');   
////        $next_challans = $this->db->get_where('fee_challan',$where_nexts)->result();
////        $fee_id = $this->db->get_where('fee_actual_challan_detail',array('challan_detail_id'=>$head_id))->row();
////        if(!empty($next_challans)):
////            
////      
////        foreach($next_challans as $rows):
////            $DATA = array(
////              'fee_id'      =>  $fee_id->fee_id,
////              'challan_id'  =>  $rows->challan_id,
////            );
////        
////        $this->CRUDModel->deleteid('fee_actual_challan_detail',$DATA);
////        
////        // update balance in balnce
////                             $this->db->select('sum(actual_amount) as all_amount,fee_challan.fc_pay_cat_id');
////                            $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
////        $allBalance = $this->db->get_where('fee_challan',array('fc_challan_id'=>$rows->challan_id))->row();
////         
////            $data_update_next = array(
////              'r_amount'     => $allBalance->all_amount,  
////               
////            );
////            $where_update_next = array(
////              'student_id'  => $rows->fc_student_id,  
////              'pay_cat_id'  => $allBalance->fc_pay_cat_id,  
////            );
////            
////              $this->CRUDModel->update('fee_balance',$data_update_next,$where_update_next);
////        
////        
////        
////        endforeach;
////          endif;
//// 
//        
//        $where = array(
//          'challan_id'          => $challan_id,  
//          'challan_detail_id'   => $head_id,  
//        );
//        // Update log of delete Heads
//        $log_delete = $this->db->get_where('fee_actual_challan_detail',$where)->row();
//        
//        $data_log = array(
//          'challan_detail_id'   => $log_delete->challan_detail_id,  
//          'challan_id'          => $log_delete->challan_id,  
//          'fee_id'              => $log_delete->fee_id,  
//          'actual_amount'       => $log_delete->actual_amount,  
//          'paid_amount'         => $log_delete->paid_amount,  
//          'balance'             => $log_delete->balance,  
//          'challan_status'      => $log_delete->challan_status,  
//          'add_new_heads_flag'  => $log_delete->add_new_heads_flag,  
//          'old_balance_pc_id'   => $log_delete->old_balance_pc_id,  
//          'comment'             => $log_delete->comment,  
//          'useId'               => $log_delete->useId,  
//          'timestamp'           => $log_delete->timestamp,  
//          'up_timestamp'        => $log_delete->up_timestamp,  
//          'up_userId'           => $log_delete->up_userId,  
//          'up_userId'           => $log_delete->up_userId,  
//          'delete_time'         => date('Y-m-d H:i:s'),  
//          'delete_by'           => $this->userInfo->user_id,  
//        );
//         $this->CRUDModel->insert('fee_actual_challan_detail_delete_log',$data_log);
//       
//        
//        
//        $this->CRUDModel->deleteid('fee_actual_challan_detail',$where);
//        
//    
//                            $this->db->select('sum(actual_amount) as all_amount,fee_challan.fc_pay_cat_id');
//                            $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
//        $allBalance = $this->db->get_where('fee_challan',array('fc_challan_id'=>$challan_id))->row();
//         
//            $data_update = array(
//              'r_amount'     => $allBalance->all_amount,  
//               
//            );
//            $where_update = array(
//              'student_id'  => $student_id,  
//              'pay_cat_id'  => $allBalance->fc_pay_cat_id,  
//            );
//            
//              $this->CRUDModel->update('fee_balance',$data_update,$where_update);
//               
//             
//         redirect('feeNewHead/'.$challan_id.'/'.$student_id);
//    }
public function fee_new_head_update(){
             $this->data['balance_type']  = $this->CRUDModel->dropDown('fee_balance_type', '', 'id', 'type'); 
        $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$this->uri->segment(3)));

                                             $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');   
                                             $this->db->join('fee_heads','fee_heads.fh_id=fee_class_setups.fh_id');   
        $this->data['challan_info']       = $this->db->get_where('fee_actual_challan_detail',array('challan_detail_id'=>$this->uri->segment(4)))->row();
        $this->data['feeComments']  = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$this->uri->segment(2)));
//        echo '<pre>';print_r( $this->data['feeComments']);die;
      if($this->input->post()):
          
          $fee_head_id  = $this->input->post('fee_head_id');
          $amount       = $this->input->post('amount');
          $comment       = $this->input->post('comment');
          $balance_type       = $this->input->post('balance_type');
          $challan_id_lock       = $this->input->post('challan_id_lock');
          
          if($challan_id_lock == 1):
               $SET = array(
            'actual_amount'     => $amount,  
            'paid_amount'       => $amount,  
               
            'comment'           => $comment,  
            'old_balance_pc_id' => $balance_type,  
          );
              else:
              
            $SET = array(
            'actual_amount'     => $amount,  
            'paid_amount'       => $amount,  
            'balance'           => $amount,  
            'comment'           => $comment,  
            'old_balance_pc_id' => $balance_type,  
          );     
          endif;
          
         
          $this->CRUDModel->update('fee_actual_challan_detail',$SET,array('challan_detail_id'=>$fee_head_id));
          
          redirect('feeNewHead/'.$this->uri->segment(2).'/'.$this->uri->segment(3));
      endif;
        $this->data['page']         = 'Fee/fee_add_new_update';
        $this->data['page_header']  = 'Update Fee Heads';
        $this->data['page_title']   = 'Update Fee Heads| ECMS';
        $this->load->view('common/common',$this->data);
       
    }
//    public function fee_new_head_update(){
//             $this->data['balance_type']  = $this->CRUDModel->dropDown('fee_balance_type', '', 'id', 'type'); 
//        $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$this->uri->segment(3)));
//
//                                             $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');   
//                                             $this->db->join('fee_heads','fee_heads.fh_id=fee_class_setups.fh_id');   
//        $this->data['challan_info']       = $this->db->get_where('fee_actual_challan_detail',array('challan_detail_id'=>$this->uri->segment(4)))->row();
//        $this->data['feeComments']  = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$this->uri->segment(2)));
//        
//      if($this->input->post()):
//          
//          $fee_head_id  = $this->input->post('fee_head_id');
//          $amount       = $this->input->post('amount');
//          $comment       = $this->input->post('comment');
//          $balance_type       = $this->input->post('balance_type');
//          $SET = array(
//            'actual_amount'     => $amount,  
//            'paid_amount'       => $amount,  
//            'balance'           => $amount,  
//            'comment'           => $comment,  
//            'old_balance_pc_id' => $balance_type,  
//          );
//          $this->CRUDModel->update('fee_actual_challan_detail',$SET,array('challan_detail_id'=>$fee_head_id));
//          
//          redirect('feeNewHead/'.$this->uri->segment(2).'/'.$this->uri->segment(3));
//      endif;
//        $this->data['page']         = 'Fee/fee_add_new_update';
//        $this->data['page_header']  = 'Update Fee Heads';
//        $this->data['page_title']   = 'Update Fee Heads| ECMS';
//        $this->load->view('common/common',$this->data);
//       
//    }
    public function fee_Challan_Detail(){
        
        $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.s_status_id' => 5,'student_record.student_id'=>$this->uri->segment(3)));
//           echo '<pre>';print_r( $this->data['studentInfo'] );die;
        $this->data['result']       = $this->FeeModel->get_Student_feeDetails(array('fee_actual_challan_detail.challan_id'=>$this->uri->segment(2)));
//            echo '<pre>';print_r( $this->data['result'] );die;
        $this->data['feeComments']  = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$this->uri->segment(2)));
        
      
        
//       echo '<pre>';print_r( $this->data['feeComments'] );die;
        $this->data['page']         = 'Fee/fee_challan_detail';
        $this->data['page_header']  = 'Fee Challan Details';
        $this->data['page_title']   = 'Fee Challan Details | ECMS';
        $this->load->view('common/common',$this->data);
    }
        public function fee_Challan_Print(){
        
//            $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.s_status_id' => 5,'student_record.student_id'=>$this->uri->segment(3)));
            $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$this->uri->segment(3)));
            $this->data['feeComments']  = $this->FeeModel->get_challan_detail(array('fc_challan_id'=>$this->uri->segment(2)));
             $where = array(
                       'fc_student_id '=> $this->data['feeComments'] ->fc_student_id,
                       'fc_paid_form <='=> $this->data['feeComments'] ->fc_paid_form,
                       
                   );
        
             
             
        $this->data['result']       = $this->FeeModel->feeDetails_head_print($where);
        $this->data['page']         = 'Fee/Reports/fee_challan_print';
        $this->data['page_header']  = 'Fee Challan Print';
        $this->data['page_title']   = 'Fee Challan Print | ECMS';
        $this->load->view('common/common',$this->data);
    }
//    public function fee_Challan_Print(){
//        
////            $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.s_status_id' => 5,'student_record.student_id'=>$this->uri->segment(3)));
//            $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$this->uri->segment(3)));
//            $this->data['feeComments']  = $this->FeeModel->get_challan_detail(array('fc_challan_id'=>$this->uri->segment(2)));
//             $where = array(
//                       'fc_student_id '=> $this->data['feeComments'] ->fc_student_id,
//                       'fc_paid_form <='=> $this->data['feeComments'] ->fc_paid_form,
//                       
//                   );
//        
//             
//             
//        $this->data['result']       = $this->FeeModel->feeDetails_head_print($where);
//        $this->data['page']         = 'Fee/Reports/fee_challan_print';
//        $this->data['page_header']  = 'Fee Challan Print';
//        $this->data['page_title']   = 'Fee Challan Print | ECMS';
//        $this->load->view('common/common',$this->data);
//    }
    public function print_challan_class_wise(){
        
        
        $programe_id    = $this->uri->segment(2);
        $showFeeSubPro  = $this->uri->segment(3);
        $section        = $this->uri->segment(4);
        $pc_id          = $this->uri->segment(5);
        
        
//         $where['fee_challan.fc_ch_status_id'] = '1';
              if(!empty($pc_id)):
                $where['fee_challan.fc_pay_cat_id'] = $pc_id;
                $this->data['pc_id']           = $pc_id;
            endif;
            
            if($programe_id):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id'] = $programe_id;
            endif;
            if(!empty($showFeeSubPro)):
                 $where['sub_programes.sub_pro_id'] = $showFeeSubPro;
                $this->data['sub_pro_id']           = $showFeeSubPro;
            endif;
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']           = $section;
            endif;
        
        
        
        
        $this->data['student_info'] = $this->FeeModel->fee_challan_filters_classWise_new($where);
        
 
        
      
        $this->data['page']         = 'Fee/Reports/class_wise_print';
        $this->data['page_header']  = 'Fee Challan Class Wise';
        $this->data['page_title']   = 'Fee Challan Class Wise | ECMS';
        $this->load->view('common/common',$this->data);
    }
        public function fee_challan_payment(){
        
        $this->data['challandId'] = '';
        if($this->input->post('payment_challan_search')):
            $challandId = $this->input->post('challan_no');
            
            $this->data['challandId']       = $challandId;
            $this->data['challan_details']  = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challandId));
            $this->data['studentInfo']      = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$this->data['challan_details']->fc_student_id));
            $this->data['result']           = $this->FeeModel->get_Student_feeDetails_search(array('fee_actual_challan_detail.challan_id'=>$challandId));
            $this->data['result_payment']   = $this->FeeModel->get_Student_feeDetails_search(array('fee_actual_challan_detail.challan_id'=>$challandId,'add_new_heads_flag'=>1));
 
        endif;
        
        if($this->input->post('payment_challan_paid')):
           
            $challan_amount = $this->input->post('challan_amount');
            $challan_Id     = $this->input->post('challan_Id');
            $student_id     = $this->input->post('student_id');
            $challan_id_lock= $this->input->post('challan_id_lock');
            $pdate_id       = $this->input->post('pdate_id');
            $paid_date      = date('Y-m-d',strtotime($this->input->post('challan_date')));
            $a_chln_detl    = $this->CRUDModel->get_where_result('fee_actual_challan_detail',array('challan_id'=>$challan_Id));
            $userInfo       = json_decode(json_encode($this->getUser()), FALSE);
            $date_fix       = $this->input->post('date_fix');
            $challan_comment= $this->input->post('challan_comments');
            
            if($date_fix === 'on'):
                
                $oldDate = $this->CRUDModel->get_where_row('fee_print_date',array('status'=>1));
                if($oldDate->print_date != $paid_date):
                    
                  $update_date_data = array(
                    'status'  =>0,
                    'up_timestamp' =>date('Y-m-d H:i:s'),
                    'up_userId'    => $userInfo->user_id 
                  );          
                $this->CRUDModel->update('fee_print_date',$update_date_data,array('printDate_id'=>$pdate_id));
                $insert_newDate = array(
                        'status'       =>1,
                        'print_date'   =>$paid_date,
                        'timestamp'    =>date('Y-m-d H:i:s'),
                        'userId'       => $userInfo->user_id 
                  );    
                $this->CRUDModel->insert('fee_print_date',$insert_newDate);
                endif;
                
            endif;
            
             // Check if Bank Reconciliation Report Lock 
            
            $BRRL = $this->db->get_where('fee_brr_lock',array('lock_date'=>$paid_date,'status'=>1))->row();
//            echo '<pre>';print_r($BRRL);die;
            if(empty($BRRL)):
               
             $student_status = $this->db->get_where('student_record',array('student_id'=>$student_id))->row();
            if($challan_id_lock==0):
                
           //Update actual Challan 
            $add_new_heads_flag = 0;
            $gBalance = '';
            foreach($a_chln_detl as $ACDRow):
                $balancestd         = '';
                $where_detail_data  = array(
                   'challan_id'     => $challan_Id, 
                   'fee_id'         => $ACDRow->fee_id, 
                );
                
                if($ACDRow->add_new_heads_flag == 2):
                  $add_new_heads_flag += $ACDRow->paid_amount;
                 endif;
            
                $balancestd = $ACDRow->balance-$ACDRow->paid_amount;
          
                $challan_detai_data = array(
                   'challan_status'     => 2,
                   'balance'            => $balancestd,
                   'up_timestamp'       => date('Y-m-d H:i:s'),
                   'up_userId'          => $userInfo->user_id
                );
                 $this->CRUDModel->update('fee_actual_challan_detail',$challan_detai_data,$where_detail_data);
                $gBalance += $balancestd;
            endforeach;
            
            //Remove Extra Head Amount from Annual and installment ..

            $challan_amount =  $challan_amount-$add_new_heads_flag;
            $challan_history = array(
                    'challan_id'    => $challan_Id,
                    'student_id'    => $student_id,
                    'ch_status_id'  => 2,
                    'date'          => date('Y-m-d'),
                    'timestamp'     => date('Y-m-d H:i:s'),
                    'userId'        => $userInfo->user_id
            );
            $this->CRUDModel->insert('fee_challan_history',$challan_history);
            
            $fee_extra = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challan_Id));
            $update_balance = array(
                'r_amount'          => $gBalance,
                'up_timestamp'      => date('Y-m-d H:i:s'),
                'up_userId'         => $userInfo->user_id 
            );
            $this->CRUDModel->update('fee_balance',$update_balance,array('student_id'=>$student_id,'pay_cat_id'=>$fee_extra->fc_pay_cat_id));
            
            if($fee_extra->fc_extra_head_flag == 1):
            
                $student_total_balance = $this->CRUDModel->get_where_row('fee_total_balance',array('student_id'=>$student_id));
                $r_t_balance = $student_total_balance->total_r_amount - $challan_amount;
             $update_balance_total = array(
                'total_r_amount'    => $r_t_balance,
                'timestamp'         => date('Y-m-d H:i:s'),
                'userId'            => $userInfo->user_id 
            );
            $this->CRUDModel->update('fee_total_balance',$update_balance_total,array('student_id'=>$student_id));
 
            
            endif; 
            
            $this->CRUDModel->update('fee_challan',array('fc_ch_status_id'=>2,'fc_paiddate'=>$paid_date,'fc_comments'=>$challan_comment),array('fc_challan_id'=>$challan_Id));
        
                else:
             
             //For lock Bill       
                    
           //Update actual Challan 
            $add_new_heads_flag     = 0;
            $gBalance               = '';
            $balancestd             = '';
            $current_paid_amount   = '';
           
            foreach($a_chln_detl as $ACDRow):
              
                //Current Bill Update
                $where_detail_data  = array(
                   'challan_id'     => $challan_Id, 
                   'fee_id'         => $ACDRow->fee_id, 
                );
            
                if($ACDRow->add_new_heads_flag == 2):
                  $add_new_heads_flag += $ACDRow->paid_amount;
                endif;
            
               
                $challan_detai_data = array(
                   'challan_status'     => 2,
                    'up_timestamp'      => date('Y-m-d H:i:s'),
                   'up_userId'          => $userInfo->user_id
                );
//                 $this->CRUDModel->update('fee_actual_challan_detail',$challan_detai_data,$where_detail_data);
                 
               $challan_info_current  =  $this->db->get_where('fee_challan',array('fc_challan_id'=>$challan_Id))->row(); 
                
               
               
               //Remove Next Bill Balance
               
                $where_next_bill = array(
                    'fc_student_id'     => $student_id,
                    'fc_challan_id >'   => $challan_Id
                   );
               
//                                            $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                $next_bill_remove_balance = $this->db->get_where('fee_challan',$where_next_bill)->result();
                foreach($next_bill_remove_balance as $nxtRow):
                    
                    
                $where_next_ch_details = array(
                      'fee_id'          => $ACDRow->fee_id,  
                      'challan_id'   => $nxtRow->fc_challan_id  
                    );
                    
               $details =  $this->db->get_where('fee_actual_challan_detail',$where_next_ch_details)->row();
                     
               $balancestd             = $ACDRow->actual_amount-$ACDRow->paid_amount;
                    
                    if($balancestd == 0):
                         $this->CRUDModel->deleteid('fee_actual_challan_detail',array('challan_detail_id'=>$details->challan_detail_id));
                        
                        else:
                            
                        $SET = array(
                           'actual_amount'  => $balancestd,  
                           'paid_amount'    => $balancestd,  
                           'balance'        => $balancestd,  
                         );
                         $WHERE = array(
                           'challan_detail_id'=>$details->challan_detail_id  
                         );
                         $this->CRUDModel->update('fee_actual_challan_detail',$SET,$WHERE);
                            
                            
                        
                    endif;
             
                endforeach;
                
 
                $gBalance += $balancestd;
                $current_paid_amount += $ACDRow->paid_amount;
            endforeach;
            
             //Challan History 
            $challan_history = array(
                    'challan_id'    => $challan_Id,
                    'student_id'    => $student_id,
                    'ch_status_id'  => 2,
                    'date'          => date('Y-m-d'),
                    'timestamp'     => date('Y-m-d H:i:s'),
                    'userId'        => $userInfo->user_id
            );
            $this->CRUDModel->insert('fee_challan_history',$challan_history);
             
           //Remove Extra Head Amount from Annual and installment ..
            $challan_amount =  $challan_amount-$add_new_heads_flag;
            $fee_extra = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challan_Id));
           
            $update_balance = array(
                'r_amount'          => $gBalance,
                'up_timestamp'      => date('Y-m-d H:i:s'),
                'up_userId'         => $userInfo->user_id 
            );
            $this->CRUDModel->update('fee_balance',$update_balance,array('student_id'=>$student_id,'pay_cat_id'=>$fee_extra->fc_pay_cat_id));
            
            $new = $this->db->get_where('fee_challan',array('old_balance_challan_id'=>$challan_Id))->row();
            
                                   $this->db->select('fee_challan.fc_pay_cat_id,fee_challan.fc_student_id,sum(actual_amount) as r_balance'); 
                                   $this->db->join('fee_challan','fee_challan.fc_challan_id=fee_actual_challan_detail.challan_id');
           $new_challan_balance =  $this->db->get_where('fee_actual_challan_detail',array('challan_id'=>$new->fc_challan_id))->row();
            
           
           
           $SET_Data = array(
               'r_amount'=>$new_challan_balance->r_balance
           );
           $SET_WHERE = array(
                'student_id'=>$new_challan_balance->fc_student_id,
               'pay_cat_id'=>$new_challan_balance->fc_pay_cat_id, 
           );
           
           $this->CRUDModel->update('fee_balance',$SET_Data,$SET_WHERE);
            
            
            if($fee_extra->fc_extra_head_flag == 1):
            
                $student_total_balance = $this->CRUDModel->get_where_row('fee_total_balance',array('student_id'=>$student_id));
                $r_t_balance = $student_total_balance->total_r_amount - $challan_amount;
             $update_balance_total = array(
                'total_r_amount'    => $r_t_balance,
                'timestamp'         => date('Y-m-d H:i:s'),
                'userId'            => $userInfo->user_id 
            );
            $this->CRUDModel->update('fee_total_balance',$update_balance_total,array('student_id'=>$student_id));
           
            if($student_status->s_status_id == 1): //if student status = Application recevied
              $this->CRUDModel->update('student_record',array('s_status_id'=>5,'admission_date'=>date('Y-m-d')),array('student_id'=>$student_id));
             endif;
            
            $this->CRUDModel->update('student_record',array('s_status_id'=>5),array('student_id'=>$student_id));
            endif; 
            
            $this->CRUDModel->update('fee_challan',array('fc_ch_status_id'=>2,'fc_paiddate'=>$paid_date,'fc_comments'=>$challan_comment),array('fc_challan_id'=>$challan_Id));
           endif;
                  else:
             
                      
                      
                $this->data['error_msg'] = array(
                    'date'      => $BRRL->lock_date                   
                );   
               
                  
                $challandId = $this->input->post('challan_no');
            
                $this->data['challandId']       = $challandId;
                $this->data['challan_details']  = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challandId));
                $this->data['studentInfo']      = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$this->data['challan_details']->fc_student_id));
                $this->data['result']           = $this->FeeModel->get_Student_feeDetails_search(array('fee_actual_challan_detail.challan_id'=>$challandId));
                $this->data['result_payment']   = $this->FeeModel->get_Student_feeDetails_search(array('fee_actual_challan_detail.challan_id'=>$challandId,'add_new_heads_flag'=>1));

                  
                  
                  
            endif;
            
            
              if($student_status->s_status_id == 1): //if student status = Application recevied
              $this->CRUDModel->update('student_record',array('s_status_id'=>5,'admission_date'=>date('Y-m-d')),array('student_id'=>$student_id));
             endif;
            endif;
        
         
        $this->data['challan_date'] = $this->CRUDModel->get_where_row('fee_print_date',array('status'=>1));
        
        $this->data['page']         = 'Fee/fee_payment';
        $this->data['page_header']  = 'Fee Payment';
        $this->data['page_title']   = 'Fee Payment | ECMS';
        $this->load->view('common/common',$this->data);
    }
//    public function fee_challan_payment(){
//        
//        $this->data['challandId'] = '';
//        if($this->input->post('payment_challan_search')):
//            $challandId = $this->input->post('challan_no');
//            
//            $this->data['challandId']       = $challandId;
//            $this->data['challan_details']  = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challandId));
//            $this->data['studentInfo']      = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$this->data['challan_details']->fc_student_id));
//            $this->data['result']           = $this->FeeModel->get_Student_feeDetails_search(array('fee_actual_challan_detail.challan_id'=>$challandId));
//            $this->data['result_payment']   = $this->FeeModel->get_Student_feeDetails_search(array('fee_actual_challan_detail.challan_id'=>$challandId,'add_new_heads_flag'=>1));
// 
//        endif;
//        
//        if($this->input->post('payment_challan_paid')):
//           
//            $challan_amount = $this->input->post('challan_amount');
//            $challan_Id     = $this->input->post('challan_Id');
//            $student_id     = $this->input->post('student_id');
//            $challan_id_lock= $this->input->post('challan_id_lock');
//            $pdate_id       = $this->input->post('pdate_id');
//            $paid_date      = date('Y-m-d',strtotime($this->input->post('challan_date')));
//            $a_chln_detl    = $this->CRUDModel->get_where_result('fee_actual_challan_detail',array('challan_id'=>$challan_Id));
//            $userInfo       = json_decode(json_encode($this->getUser()), FALSE);
//            $date_fix       = $this->input->post('date_fix');
//            $challan_comment= $this->input->post('challan_comments');
//            
//            if($date_fix === 'on'):
//                
//                $oldDate = $this->CRUDModel->get_where_row('fee_print_date',array('status'=>1));
//                if($oldDate->print_date != $paid_date):
//                    
//                  $update_date_data = array(
//                    'status'  =>0,
//                    'up_timestamp' =>date('Y-m-d H:i:s'),
//                    'up_userId'    => $userInfo->user_id 
//                  );          
//                $this->CRUDModel->update('fee_print_date',$update_date_data,array('printDate_id'=>$pdate_id));
//                $insert_newDate = array(
//                        'status'       =>1,
//                        'print_date'   =>$paid_date,
//                        'timestamp'    =>date('Y-m-d H:i:s'),
//                        'userId'       => $userInfo->user_id 
//                  );    
//                $this->CRUDModel->insert('fee_print_date',$insert_newDate);
//                endif;
//                
//            endif;
//            
//             $student_status = $this->db->get_where('student_record',array('student_id'=>$student_id))->row();
//            if($challan_id_lock==0):
//                
//           //Update actual Challan 
//            $add_new_heads_flag = 0;
//            $gBalance = '';
//            foreach($a_chln_detl as $ACDRow):
//                $balancestd         = '';
//                $where_detail_data  = array(
//                   'challan_id'     => $challan_Id, 
//                   'fee_id'         => $ACDRow->fee_id, 
//                );
//                
//                if($ACDRow->add_new_heads_flag == 2):
//                  $add_new_heads_flag += $ACDRow->paid_amount;
//                 endif;
//            
//                $balancestd = $ACDRow->balance-$ACDRow->paid_amount;
//          
//                $challan_detai_data = array(
//                   'challan_status'     => 2,
//                   'balance'            => $balancestd,
//                   'up_timestamp'       => date('Y-m-d H:i:s'),
//                   'up_userId'          => $userInfo->user_id
//                );
//                 $this->CRUDModel->update('fee_actual_challan_detail',$challan_detai_data,$where_detail_data);
//                $gBalance += $balancestd;
//            endforeach;
//            
//            //Remove Extra Head Amount from Annual and installment ..
//
//            $challan_amount =  $challan_amount-$add_new_heads_flag;
//            $challan_history = array(
//                    'challan_id'    => $challan_Id,
//                    'student_id'    => $student_id,
//                    'ch_status_id'  => 2,
//                    'date'          => date('Y-m-d'),
//                    'timestamp'     => date('Y-m-d H:i:s'),
//                    'userId'        => $userInfo->user_id
//            );
//            $this->CRUDModel->insert('fee_challan_history',$challan_history);
//            
//            $fee_extra = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challan_Id));
//            $update_balance = array(
//                'r_amount'          => $gBalance,
//                'up_timestamp'      => date('Y-m-d H:i:s'),
//                'up_userId'         => $userInfo->user_id 
//            );
//            $this->CRUDModel->update('fee_balance',$update_balance,array('student_id'=>$student_id,'pay_cat_id'=>$fee_extra->fc_pay_cat_id));
//            
//            if($fee_extra->fc_extra_head_flag == 1):
//            
//                $student_total_balance = $this->CRUDModel->get_where_row('fee_total_balance',array('student_id'=>$student_id));
//                $r_t_balance = $student_total_balance->total_r_amount - $challan_amount;
//             $update_balance_total = array(
//                'total_r_amount'    => $r_t_balance,
//                'timestamp'         => date('Y-m-d H:i:s'),
//                'userId'            => $userInfo->user_id 
//            );
//            $this->CRUDModel->update('fee_total_balance',$update_balance_total,array('student_id'=>$student_id));
// 
//              if($student_status->s_status_id == 1): //if student status = Application recevied
//              $this->CRUDModel->update('student_record',array('s_status_id'=>5),array('student_id'=>$student_id));
//             endif;
//            endif; 
//            
//            $this->CRUDModel->update('fee_challan',array('fc_ch_status_id'=>2,'fc_paiddate'=>$paid_date,'fc_comments'=>$challan_comment),array('fc_challan_id'=>$challan_Id));
//        
//                else:
//             
//             //For lock Bill       
//                    
//           //Update actual Challan 
//            $add_new_heads_flag     = 0;
//            $gBalance               = '';
//            $balancestd             = '';
//            $current_paid_amount    = '';
//           
//            foreach($a_chln_detl as $ACDRow):
//                $where_detail_data  = array(
//                   'challan_id'     => $challan_Id, 
//                   'fee_id'         => $ACDRow->fee_id, 
//                );
//                
//                if($ACDRow->add_new_heads_flag == 2):
//                  $add_new_heads_flag += $ACDRow->paid_amount;
//                endif;
//            
//               
//                $challan_detai_data = array(
//                   'challan_status'     => 2,
//                    'up_timestamp'      => date('Y-m-d H:i:s'),
//                   'up_userId'          => $userInfo->user_id
//                );
//                 $this->CRUDModel->update('fee_actual_challan_detail',$challan_detai_data,$where_detail_data);
//                 
//               $challan_info_current  =  $this->db->get_where('fee_challan',array('fc_challan_id'=>$challan_Id))->row(); 
//                
//                
//                 $new_bill_where = array(
//                     'fee_id'               => $ACDRow->fee_id,
//                     'old_balance_pc_id'    => $challan_info_current->fc_pay_cat_id,
//                     'fc_student_id'        => $challan_info_current->fc_student_id,
// 
//                 );
//                    
//                                         $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
//                 $get_new_challan_info = $this->db->get_where('fee_challan',$new_bill_where)->row();
//                $balancestd             = $ACDRow->actual_amount-$ACDRow->paid_amount;
//               
//                
//                if($balancestd == 0):
//                     $this->CRUDModel->deleteid('fee_actual_challan_detail',array('challan_detail_id'=>$get_new_challan_info->challan_detail_id));
//                     else:
//                        $SET = array(
//                           'actual_amount'  => $balancestd,  
//                           'paid_amount'    => $balancestd,  
//                           'balance'        => $balancestd,  
//                         );
//                         $WHERE = array(
//                           'challan_detail_id'=>$get_new_challan_info->challan_detail_id  
//                         );
//                         $this->CRUDModel->update('fee_actual_challan_detail',$SET,$WHERE);
//                         
//                 endif;
//                
// 
//                $gBalance += $balancestd;
//                $current_paid_amount += $ACDRow->paid_amount;
//            endforeach;
//            
//             //Challan History 
//            $challan_history = array(
//                    'challan_id'    => $challan_Id,
//                    'student_id'    => $student_id,
//                    'ch_status_id'  => 2,
//                    'date'          => date('Y-m-d'),
//                    'timestamp'     => date('Y-m-d H:i:s'),
//                    'userId'        => $userInfo->user_id
//            );
//            $this->CRUDModel->insert('fee_challan_history',$challan_history);
//             
//           //Remove Extra Head Amount from Annual and installment ..
//            $challan_amount =  $challan_amount-$add_new_heads_flag;
//            $fee_extra = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challan_Id));
//           
//            $update_balance = array(
//                'r_amount'          => $gBalance,
//                'up_timestamp'      => date('Y-m-d H:i:s'),
//                'up_userId'         => $userInfo->user_id 
//            );
//            $this->CRUDModel->update('fee_balance',$update_balance,array('student_id'=>$student_id,'pay_cat_id'=>$fee_extra->fc_pay_cat_id));
//            
//            
//           
//              
//             $new = $this->db->get_where('fee_challan',array('old_balance_challan_id'=>$challan_Id))->row();
//            
//                                   $this->db->select('fee_challan.fc_pay_cat_id,fee_challan.fc_student_id,sum(actual_amount) as r_balance'); 
//                                   $this->db->join('fee_challan','fee_challan.fc_challan_id=fee_actual_challan_detail.challan_id');
//           $new_challan_balance =  $this->db->get_where('fee_actual_challan_detail',array('challan_id'=>$new->fc_challan_id))->row();
//            
//           
//           
//           $SET_Data = array(
//               'r_amount'=>$new_challan_balance->r_balance
//           );
//           $SET_WHERE = array(
//                'student_id'=>$new_challan_balance->fc_student_id,
//               'pay_cat_id'=>$new_challan_balance->fc_pay_cat_id, 
//           );
//           
//           $this->CRUDModel->update('fee_balance',$SET_Data,$SET_WHERE);
//            
//            
//            if($fee_extra->fc_extra_head_flag == 1):
//            
//                $student_total_balance = $this->CRUDModel->get_where_row('fee_total_balance',array('student_id'=>$student_id));
//                $r_t_balance = $student_total_balance->total_r_amount - $challan_amount;
//             $update_balance_total = array(
//                'total_r_amount'    => $r_t_balance,
//                'timestamp'         => date('Y-m-d H:i:s'),
//                'userId'            => $userInfo->user_id 
//            );
//            $this->CRUDModel->update('fee_total_balance',$update_balance_total,array('student_id'=>$student_id));
//           
//              if($student_status->s_status_id == 1): //if student status = Application recevied
//              $this->CRUDModel->update('student_record',array('s_status_id'=>5),array('student_id'=>$student_id));
//             endif;
//            
//            $this->CRUDModel->update('student_record',array('s_status_id'=>5),array('student_id'=>$student_id));
//            endif; 
//            
//            $this->CRUDModel->update('fee_challan',array('fc_ch_status_id'=>2,'fc_paiddate'=>$paid_date,'fc_comments'=>$challan_comment),array('fc_challan_id'=>$challan_Id));
//           endif;
//            
//            endif;
//        
//         
//        $this->data['challan_date'] = $this->CRUDModel->get_where_row('fee_print_date',array('status'=>1));
//        
//        $this->data['page']         = 'Fee/fee_payment';
//        $this->data['page_header']  = 'Fee Payment';
//        $this->data['page_title']   = 'Fee Payment | ECMS';
//        $this->load->view('common/common',$this->data);
//    }
       public function fee_challan_payment23(){
        
        $this->data['challandId'] = '';
        if($this->input->post('payment_challan_search')):
            $challandId = $this->input->post('challan_no');
            
            $this->data['challandId'] = $challandId;
            $this->data['challan_details'] = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challandId));
//                echo '<pre>';print_r($this->data['challan_details'] );die;
            $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$this->data['challan_details']->fc_student_id));
//            echo '<pre>';print_r($this->data['studentInfo']);die;
            $this->data['result']       = $this->FeeModel->get_Student_feeDetails_search(array('fee_actual_challan_detail.challan_id'=>$challandId));
            
            $this->data['result_payment']       = $this->FeeModel->get_Student_feeDetails_search(array('fee_actual_challan_detail.challan_id'=>$challandId,'add_new_heads_flag'=>1));
//            echo '<pre>';print_r($this->data['result']);die;
        endif;
        
        if($this->input->post('payment_challan_paid')):
           
            $challan_amount = $this->input->post('challan_amount');
            $challan_Id     = $this->input->post('challan_Id');
            $student_id     = $this->input->post('student_id');
            $pdate_id       = $this->input->post('pdate_id');
            $paid_date      = date('Y-m-d',strtotime($this->input->post('challan_date')));
            $a_chln_detl    = $this->CRUDModel->get_where_result('fee_actual_challan_detail',array('challan_id'=>$challan_Id));
            $userInfo       = json_decode(json_encode($this->getUser()), FALSE);
            $date_fix       = $this->input->post('date_fix');
            $challan_comment= $this->input->post('challan_comments');
            
            if($date_fix === 'on'):
                
                $oldDate = $this->CRUDModel->get_where_row('fee_print_date',array('status'=>1));
                if($oldDate->print_date != $paid_date):
                    
                  $update_date_data = array(
                    'status'  =>0,
                    'up_timestamp' =>date('Y-m-d H:i:s'),
                    'up_userId'    => $userInfo->user_id 
                  );          
                $this->CRUDModel->update('fee_print_date',$update_date_data,array('printDate_id'=>$pdate_id));
                $insert_newDate = array(
                        'status'       =>1,
                        'print_date'   =>$paid_date,
                        'timestamp'    =>date('Y-m-d H:i:s'),
                        'userId'       => $userInfo->user_id 
                  );    
                $this->CRUDModel->insert('fee_print_date',$insert_newDate);
                endif;
                
            endif;
            
           
           //Update actual Challan 
            $add_new_heads_flag = 0;
            foreach($a_chln_detl as $ACDRow):
                $balancestd         = '';
                $where_detail_data  = array(
                   'challan_id'     => $challan_Id, 
                   'fee_id'         => $ACDRow->fee_id, 
                );
                
                if($ACDRow->add_new_heads_flag == 2):
                  $add_new_heads_flag += $ACDRow->paid_amount;
                 endif;
            
                $balancestd = $ACDRow->balance-$ACDRow->paid_amount;
          
                $challan_detai_data = array(
                   'challan_status'     => 2,
                   'balance'            => $balancestd,
                   'up_timestamp'       => date('Y-m-d H:i:s'),
                   'up_userId'          => $userInfo->user_id
                );
                 $this->CRUDModel->update('fee_actual_challan_detail',$challan_detai_data,$where_detail_data);
                
            endforeach;
            
            //Remove Extra Head Amount from Annual and installment ..
//            echo $add_new_heads_flag;die;
           
          $challan_amount =  $challan_amount-$add_new_heads_flag;
           
            $challan_history = array(
                    'challan_id'    => $challan_Id,
                    'student_id'    => $student_id,
                    'ch_status_id'  => 2,
                    'date'          => date('Y-m-d'),
                    'timestamp'     => date('Y-m-d H:i:s'),
                    'userId'        => $userInfo->user_id
            );
            $this->CRUDModel->insert('fee_challan_history',$challan_history);
            
            $fee_extra = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challan_Id));
//            $student_balance = $this->CRUDModel->get_where_row('fee_balance',array('student_id'=>$student_id));
         
             
            $update_balance = array(
                'r_amount'          => 0,
                'up_timestamp'     => date('Y-m-d H:i:s'),
                'up_userId'        => $userInfo->user_id 
            );
            $this->CRUDModel->update('fee_balance',$update_balance,array('student_id'=>$student_id,'pay_cat_id'=>$fee_extra->fc_pay_cat_id));
            
            if($fee_extra->fc_extra_head_flag == 1):
            
                $student_total_balance = $this->CRUDModel->get_where_row('fee_total_balance',array('student_id'=>$student_id));
                $r_t_balance = $student_total_balance->total_r_amount - $challan_amount;
             $update_balance_total = array(
                'total_r_amount'    => $r_t_balance,
                'timestamp'         => date('Y-m-d H:i:s'),
                'userId'            => $userInfo->user_id 
            );
            $this->CRUDModel->update('fee_total_balance',$update_balance_total,array('student_id'=>$student_id));
 
            $this->CRUDModel->update('student_record',array('s_status_id'=>5),array('student_id'=>$student_id));
            endif; 
            
            $this->CRUDModel->update('fee_challan',array('fc_ch_status_id'=>2,'fc_paiddate'=>$paid_date,'fc_comments'=>$challan_comment),array('fc_challan_id'=>$challan_Id));
         endif;
        
        $this->data['challan_date'] = $this->CRUDModel->get_where_row('fee_print_date',array('status'=>1));
        
        $this->data['page']         = 'Fee/fee_payment';
        $this->data['page_header']  = 'Fee Payment';
        $this->data['page_title']   = 'Fee Payment | ECMS';
        $this->load->view('common/common',$this->data);
    }
    
//       public function fee_challan_payment(){
//        
//        $this->data['challandId'] = '';
//        if($this->input->post('payment_challan_search')):
//            $challandId = $this->input->post('challan_no');
//            
//            $this->data['challandId'] = $challandId;
//            $this->data['challan_details'] = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challandId));
////                echo '<pre>';print_r($this->data['challan_details'] );die;
//            $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$this->data['challan_details']->fc_student_id));
////            echo '<pre>';print_r($this->data['studentInfo']);die;
//            $this->data['result']       = $this->FeeModel->get_Student_feeDetails_search(array('fee_actual_challan_detail.challan_id'=>$challandId));
//            
//            $this->data['result_payment']       = $this->FeeModel->get_Student_feeDetails_search(array('fee_actual_challan_detail.challan_id'=>$challandId,'add_new_heads_flag'=>1));
////            echo '<pre>';print_r($this->data['result']);die;
//        endif;
//        
//        if($this->input->post('payment_challan_paid')):
//           
//            $challan_amount = $this->input->post('challan_amount');
//            $challan_Id     = $this->input->post('challan_Id');
//            $student_id     = $this->input->post('student_id');
//            $pdate_id       = $this->input->post('pdate_id');
//            $paid_date      = date('Y-m-d',strtotime($this->input->post('challan_date')));
//            $a_chln_detl    = $this->CRUDModel->get_where_result('fee_actual_challan_detail',array('challan_id'=>$challan_Id));
//            $userInfo       = json_decode(json_encode($this->getUser()), FALSE);
//            $date_fix       = $this->input->post('date_fix');
//            $challan_comment= $this->input->post('challan_comments');
//            
//            if($date_fix === 'on'):
//                
//                $oldDate = $this->CRUDModel->get_where_row('fee_print_date',array('status'=>1));
//                if($oldDate->print_date != $paid_date):
//                    
//                  $update_date_data = array(
//                    'status'  =>0,
//                    'up_timestamp' =>date('Y-m-d H:i:s'),
//                    'up_userId'    => $userInfo->user_id 
//                  );          
//                $this->CRUDModel->update('fee_print_date',$update_date_data,array('printDate_id'=>$pdate_id));
//                $insert_newDate = array(
//                        'status'       =>1,
//                        'print_date'   =>$paid_date,
//                        'timestamp'    =>date('Y-m-d H:i:s'),
//                        'userId'       => $userInfo->user_id 
//                  );    
//                $this->CRUDModel->insert('fee_print_date',$insert_newDate);
//                endif;
//                
//            endif;
//            
//           
//           //Update actual Challan 
//            $add_new_heads_flag = 0;
//            foreach($a_chln_detl as $ACDRow):
//                $balancestd         = '';
//                $where_detail_data  = array(
//                   'challan_id'     => $challan_Id, 
//                   'fee_id'         => $ACDRow->fee_id, 
//                );
//                
//                if($ACDRow->add_new_heads_flag == 2):
//                  $add_new_heads_flag += $ACDRow->paid_amount;
//                 endif;
//            
//                $balancestd = $ACDRow->balance-$ACDRow->paid_amount;
//          
//                $challan_detai_data = array(
//                   'challan_status'     => 2,
//                   'balance'            => $balancestd,
//                   'up_timestamp'       => date('Y-m-d H:i:s'),
//                   'up_userId'          => $userInfo->user_id
//                );
//                 $this->CRUDModel->update('fee_actual_challan_detail',$challan_detai_data,$where_detail_data);
//                
//            endforeach;
//            
//            //Remove Extra Head Amount from Annual and installment ..
////            echo $add_new_heads_flag;die;
//           
//          $challan_amount =  $challan_amount-$add_new_heads_flag;
//           
//            $challan_history = array(
//                    'challan_id'    =>$challan_Id,
//                    'student_id'    =>$student_id,
//                    'ch_status_id'  =>2,
//                    'date'          =>date('Y-m-d'),
//                    'timestamp'     =>date('Y-m-d H:i:s'),
//                    'userId'        => $userInfo->user_id
//            );
//            $this->CRUDModel->insert('fee_challan_history',$challan_history);
//            
//            $fee_extra = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challan_Id));
//            $student_balance = $this->CRUDModel->get_where_row('fee_balance',array('student_id'=>$student_id));
//         
//            
//            if($fee_extra->fc_extra_head_flag == 1):
//                $r_balance = 0;
//                $r_balance = $student_balance->r_amount - $challan_amount;
//          
//            $update_balance = array(
//               'r_amount'           =>$r_balance,
//               
//                'timestamp'         =>date('Y-m-d H:i:s'),
//                'userId'            => $userInfo->user_id 
//            );
//            $this->CRUDModel->update('fee_balance',$update_balance,array('student_id'=>$student_id));
//            
//            
//            $student_total_balance = $this->CRUDModel->get_where_row('fee_total_balance',array('student_id'=>$student_id));
//           
//            $r_t_balance = $student_total_balance->total_r_amount - $challan_amount;
//             $update_balance_total = array(
//                'total_r_amount'    => $r_t_balance,
//                'timestamp'         => date('Y-m-d H:i:s'),
//                'userId'            => $userInfo->user_id 
//            );
//            $this->CRUDModel->update('fee_total_balance',$update_balance_total,array('student_id'=>$student_id));
// 
//            $this->CRUDModel->update('student_record',array('s_status_id'=>5),array('student_id'=>$student_id));
//            endif; 
//            
//            $this->CRUDModel->update('fee_challan',array('fc_ch_status_id'=>2,'fc_paiddate'=>$paid_date,'fc_comments'=>$challan_comment),array('fc_challan_id'=>$challan_Id));
//            
//            
//            
//            
//        endif;
//        
//        $this->data['challan_date'] = $this->CRUDModel->get_where_row('fee_print_date',array('status'=>1));
//        
//        $this->data['page']         = 'Fee/fee_payment';
//        $this->data['page_header']  = 'Fee Payment';
//        $this->data['page_title']   = 'Fee Payment | ECMS';
//        $this->load->view('common/common',$this->data);
//    }
//    public function fee_challan_payment(){
//        
//        $this->data['challandId'] = '';
//        if($this->input->post('payment_challan_search')):
//            $challandId = $this->input->post('challan_no');
//            
//            $this->data['challandId'] = $challandId;
//            $this->data['challan_details'] = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challandId));
////              echo '<pre>';print_r($challan_details);die;
//            $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$this->data['challan_details']->fc_student_id));
////            echo '<pre>';print_r($this->data['studentInfo']);die;
//            $this->data['result']       = $this->FeeModel->get_Student_feeDetails_search(array('fee_actual_challan_detail.challan_id'=>$challandId));
////            echo '<pre>';print_r($this->data['result']);die;
//        endif;
//        
//        if($this->input->post('payment_challan_paid')):
//           
//            $challan_amount = $this->input->post('challan_amount');
//            $challan_Id     = $this->input->post('challan_Id');
//            $student_id     = $this->input->post('student_id');
//            $pdate_id       = $this->input->post('pdate_id');
//            $paid_date      = date('Y-m-d',strtotime($this->input->post('challan_date')));
//            $a_chln_detl    = $this->CRUDModel->get_where_result('fee_actual_challan_detail',array('challan_id'=>$challan_Id));
//            $userInfo       = json_decode(json_encode($this->getUser()), FALSE);
//            $date_fix       = $this->input->post('date_fix');
//            $challan_comment= $this->input->post('challan_comments');
//            
//            if($date_fix === 'on'):
//                
//                $oldDate = $this->CRUDModel->get_where_row('fee_print_date',array('status'=>1));
//                if($oldDate->print_date != $paid_date):
//                    
//                  $update_date_data = array(
//                    'status'  =>0,
//                    'up_timestamp' =>date('Y-m-d H:i:s'),
//                    'up_userId'    => $userInfo->user_id 
//                  );          
//                $this->CRUDModel->update('fee_print_date',$update_date_data,array('printDate_id'=>$pdate_id));
//                $insert_newDate = array(
//                        'status'       =>1,
//                        'print_date'   =>$paid_date,
//                        'timestamp'    =>date('Y-m-d H:i:s'),
//                        'userId'       => $userInfo->user_id 
//                  );    
//                $this->CRUDModel->insert('fee_print_date',$insert_newDate);
//                endif;
//                
//            endif;
//            
// 
//           //Update actual Challan 
//            foreach($a_chln_detl as $ACDRow):
//                $balancestd         = '';
//                $where_detail_data  = array(
//                   'challan_id'     => $challan_Id, 
//                   'fee_id'         => $ACDRow->fee_id, 
//                );
//       
//                $balancestd = $ACDRow->balance-$ACDRow->paid_amount;
//          
//                $challan_detai_data = array(
//                   'challan_status'     => 2,
//                   'balance'            => $balancestd,
//                   'up_timestamp'       => date('Y-m-d H:i:s'),
//                   'up_userId'          => $userInfo->user_id
//                );
//                $this->CRUDModel->update('fee_actual_challan_detail',$challan_detai_data,$where_detail_data);
//                
//            endforeach;
//            
//            
//            
//            $challan_history = array(
//                    'challan_id'    =>$challan_Id,
//                    'student_id'    =>$student_id,
//                    'ch_status_id'  =>2,
//                    'date'          =>date('Y-m-d'),
//                    'timestamp'     =>date('Y-m-d H:i:s'),
//                    'userId'        => $userInfo->user_id
//            );
//            $this->CRUDModel->insert('fee_challan_history',$challan_history);
//            
//            $student_balance = $this->CRUDModel->get_where_row('fee_balance',array('student_id'=>$student_id));
//          
//            
//            if($fee_extra == 1):
//                
//           
//             
//            
//            $r_balance = 0;
//            $r_balance = $student_balance->r_amount - $challan_amount;
//          
//            $update_balance = array(
//               'r_amount'           =>$r_balance,
//               
//                'timestamp'         =>date('Y-m-d H:i:s'),
//                'userId'            => $userInfo->user_id 
//            );
//            $this->CRUDModel->update('fee_balance',$update_balance,array('student_id'=>$student_id));
//            
//            
//            $student_total_balance = $this->CRUDModel->get_where_row('fee_total_balance',array('student_id'=>$student_id));
//           
//            $r_t_balance = $student_total_balance->total_r_amount - $challan_amount;
//             $update_balance_total = array(
//                'total_r_amount'    => $r_t_balance,
//                'timestamp'         => date('Y-m-d H:i:s'),
//                'userId'            => $userInfo->user_id 
//            );
//            $this->CRUDModel->update('fee_total_balance',$update_balance_total,array('student_id'=>$student_id));
// 
//            $this->CRUDModel->update('student_record',array('s_status_id'=>5),array('student_id'=>$student_id));
//            endif; 
//            
//            $this->CRUDModel->update('fee_challan',array('fc_ch_status_id'=>2,'fc_paiddate'=>$paid_date,'fc_comments'=>$challan_comment),array('fc_challan_id'=>$challan_Id));
//            
//            
//            
//            
//        endif;
//        
//        $this->data['challan_date'] = $this->CRUDModel->get_where_row('fee_print_date',array('status'=>1));
//        
//        $this->data['page']         = 'Fee/fee_payment';
//        $this->data['page_header']  = 'Fee Payment';
//        $this->data['page_title']   = 'Fee Payment | ECMS';
//        $this->load->view('common/common',$this->data);
//    }
    public function fee_installment(){
        
         $this->data['challandId'] = '';
         $this->data['fc_pay_cat_id'] = '';
         $this->data['challan_status'] = '';
         $this->data['challan_lock'] = '';
        if($this->input->post('payment_challan_search')):
            $challandId = $this->input->post('challan_no');
            $this->data['challandId'] = $challandId;
            $challan_details            = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challandId));
            $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(
                    array('student_record.student_id'=>$challan_details->fc_student_id));
 
            $this->data['result']           = $this->FeeModel->get_Student_feeDetails_search(array('fee_actual_challan_detail.challan_id'=>$challandId));
            $this->data['fc_pay_cat_id']    = $challan_details->fc_pay_cat_id;
            $this->data['challan_status']   = $challan_details->fc_ch_status_id;
            $this->data['challan_lock']     = $challan_details->challan_id_lock;
        endif;
        
        
        if($this->input->post('update_challan')):
     
            
            $update_installment = $this->input->post('update_installment');
            $challan_det_id     = $this->input->post('challan_det_id');
            $challan_Id         = $this->input->post('challan_Id');
            $challan_comment    = $this->input->post('challan_comment');
            $student_id         = $this->input->post('student_id');
            $pc_id              = $this->input->post('pc_id');
        
            $combine = array_combine($challan_det_id,$update_installment);
                
            foreach($combine as $key=>$row):
                
                $old_balance = $this->db->get_where('fee_actual_challan_detail',array('challan_detail_id'=>$key))->row();
                
                
                $where = array(
                        'challan_detail_id'=>$key
                    );

                $data2 = array(
                    'paid_amount'=>$row,

                   
                );
                    $this->CRUDModel->update('fee_actual_challan_detail',$data2,$where);
                    
                endforeach;
                $SET_Data  = array(
                    'fc_comments'=>$challan_comment,
                    'fc_challan_type'=>2,
                    'old_balance_challan_id'=>$challan_Id
                  
                    );
                $this->CRUDModel->update('fee_challan',$SET_Data,array('fc_challan_id'=>$challan_Id));     
                  
                redirect('feeChallanPrint/'.$challan_Id.'/'.$student_id);
        endif;
        
        
        
        $this->data['page']         = 'Fee/fee_installment';
        $this->data['page_header']  = 'Fee Installment';
        $this->data['page_title']   = 'Fee Installment | ECMS';
        $this->load->view('common/common',$this->data);
    }
        public function fee_installment22(){
        
         $this->data['challandId'] = '';
         $this->data['fc_pay_cat_id'] = '';
        if($this->input->post('payment_challan_search')):
            $challandId = $this->input->post('challan_no');
            $this->data['challandId'] = $challandId;
            $challan_details            = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challandId));
            $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(
                    array(
 
                        'student_record.student_id'=>$challan_details->fc_student_id));
 
            $this->data['result']       = $this->FeeModel->get_Student_feeDetails_search(array('fee_actual_challan_detail.challan_id'=>$challandId));
            $this->data['fc_pay_cat_id'] = $challan_details->fc_pay_cat_id;
        endif;
        
        
        if($this->input->post('update_challan')):
     
            
            $update_installment = $this->input->post('update_installment');
            $challan_det_id     = $this->input->post('challan_det_id');
            $challan_Id         = $this->input->post('challan_Id');
            $challan_comment    = $this->input->post('challan_comment');
            $student_id    = $this->input->post('student_id');
            $pc_id    = $this->input->post('pc_id');
        
            $combine = array_combine($challan_det_id,$update_installment);
                foreach($combine as $key=>$row):
                $where = array(
                        'challan_detail_id'=>$key
                    );
                $data = array(
                    'paid_amount'=>$row,
                    'fc_pay_cat_id'=>$pc_id
                );
                    $this->CRUDModel->update('fee_actual_challan_detail',$data,$where);
                    
                endforeach;
                $SET_Data  = array(
                    'fc_comments'=>$challan_comment,
                    'fc_challan_type'=>2,
                    'old_balance_challan_id'=>$challan_Id
                  
                    );
                $this->CRUDModel->update('fee_challan',$SET_Data,array('fc_challan_id'=>$challan_Id));     
                  
                redirect('feeChallanPrint/'.$challan_Id.'/'.$student_id);
        endif;
        
        
        
        $this->data['page']         = 'Fee/fee_installment';
        $this->data['page_header']  = 'Fee Installment';
        $this->data['page_title']   = 'Fee Installment | ECMS';
        $this->load->view('common/common',$this->data);
    }
    
//    public function fee_installment(){
//        
//         $this->data['challandId'] = '';
//        if($this->input->post('payment_challan_search')):
//            $challandId = $this->input->post('challan_no');
//            
//            $this->data['challandId'] = $challandId;
//            $challan_details            = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challandId));
////             echo '<pre>';print_r($challan_details);die;
//            $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(
//                    array(
////                        'student_record.s_status_id' => 5,
//                        'student_record.student_id'=>$challan_details->fc_student_id));
////             echo '<pre>';print_r($this->data['studentInfo']);die;
//            $this->data['result']       = $this->FeeModel->get_Student_feeDetails_search(array('fee_actual_challan_detail.challan_id'=>$challandId));
////             echo '<pre>';print_r($this->data['result']);die;
//        endif;
//        
//        
//        if($this->input->post('update_challan')):
//        ob_start();
//            
//            $update_installment = $this->input->post('update_installment');
//            $challan_det_id     = $this->input->post('challan_det_id');
//            $challan_Id         = $this->input->post('challan_Id');
//            $challan_comment    = $this->input->post('challan_comment');
//            $student_id    = $this->input->post('student_id');
//        
//            $combine = array_combine($challan_det_id,$update_installment);
//                foreach($combine as $key=>$row):
//                $where = array(
//                        'challan_detail_id'=>$key
//                    );
//                $data = array(
//                    'paid_amount'=>$row
//                );
//                    $this->CRUDModel->update('fee_actual_challan_detail',$data,$where);
//                    
//                endforeach;
//                $this->CRUDModel->update('fee_challan',array('fc_comments'=>$challan_comment,'fc_challan_type'=>2),array('fc_challan_id'=>$challan_Id));     
//                  
//                redirect('feeChallanPrint/'.$challan_Id.'/'.$student_id);
//        endif;
//        
//        
//        
//        $this->data['page']         = 'Fee/fee_installment';
//        $this->data['page_header']  = 'Fee Installment';
//        $this->data['page_title']   = 'Fee Installment | ECMS';
//        $this->load->view('common/common',$this->data);
//    }
  
    public function admission_challan(){
        $this->data['form_no']      = '';
        $this->data['student_name'] = '';
        $this->data['father_name']  = '';
        
        if($this->input->post('search')):
            
            $form_no        = $this->input->post('form_no');
            $student_name   = $this->input->post('student_name');
            $father_name    = $this->input->post('father_name');
            
            $where['student_status.s_status_id']    = 1;
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
            
           $this->data['result'] = $this->FeeModel->get_apply_student($where,$like);
//          echo '<pre>';print_r( $this->data['result'] );die;
        endif;
        
        
        $this->data['page']         = 'Fee/fee_admission_challan_search';
        $this->data['page_header']  = 'New Admission Challan';
        $this->data['page_title']   = 'New Admission Challan | ECMS';
        $this->load->view('common/common',$this->data);
    }
    
    public function admission_challan_generate(){
        
        
        $uri2 = $this->uri->segment(2);
        
        if($uri2):
            
        
        $this->data['student_info'] = $this->FeeModel->fee_challan_student(array('student_record.s_status_id'=>1,'student_record.student_id'=>$uri2));
        $this->data['bank']         = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name',array('bank_id'=>8));
         
        
         if( $this->data['student_info']->migration_status == 1):
         $where = array(
            'fee_category_titles.cat_title_id'=>6,
            'fee_payment_category.sub_pro_id'=>$this->data['student_info']->sub_pro_id
        );
        
         else:
         $where = array(
            'fee_category_titles.cat_title_id'=>1,
            'fee_payment_category.sub_pro_id'=>$this->data['student_info']->sub_pro_id
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
            //            feeChallanPrintAdmission/'.$challan_id.'/'.$studentRow->student_id
            if(!empty($fee_challan_exist)):
                 
          
                    $this->session->set_flashdata('error_payment', 'Challan Already Exist..<a href="feeChallanPrintAdmission/'.$challan_id->fc_challan_id.'/'.$studentRow->student_id.'"><p class="btn btn-danger btn-xs"> Challan Print</p></a>');
                     redirect('admissionChallanGent/'.$student_id);
                   else:
                       
                 $total_balanc_an = $this->CRUDModel->get_where_row('fee_total_anual',array('sub_pro_id'=>$studentRow->sub_pro_id));
//******************************************************************************************************            
//********************            CHECKING ANNUAL AMOUNT AGISNT SUB PROGRAM           ******************
//****************************************************************************************************** 
            
                   if(!empty($total_balanc_an)):
            
                    $check_balance =  $this->CRUDModel->get_where_row('fee_total_balance',array('student_id'=>$studentRow->student_id,'batch_id'=>$studentRow->batch_id,'sub_por_id'=>$studentRow->sub_pro_id));
                   
//******************************************************************************************************            
//********************    CHECKING AMOUNT AGISNT STUDENT (FIST PAYMENT OR 2ND PAYMENT) ******************
//******************************************************************************************************                       
                      if(!empty($check_balance)):
//                   
                        $total_balace_update = array(
                            'total_r_amount' => $total_balanc_an->total_amount+$check_balance->total_r_amount,
                            'timestamp'      => date('Y-m-d H:i:s'), 
                            'userId'         => $userInfo->user_id );
                      $this->CRUDModel->update('fee_total_balance',$total_balace_update,array('student_id'=>$studentRow->student_id));
                            else:
                      
                        $total_balance_inset = array(
                            'student_id'     =>$studentRow->student_id,
                            'batch_id'       =>$studentRow->batch_id,
                            'sub_por_id'     =>$studentRow->sub_pro_id,
                            'total_r_amount' =>$total_balanc_an->total_amount,
                            'timestamp'      => date('Y-m-d H:i:s'), 
                            'userId'         => $userInfo->user_id );
                       $this->CRUDModel->insert('fee_total_balance',$total_balance_inset);
                        endif;
                        
                           
                         else:    
                     $this->session->set_flashdata('error_payment', 'Total Annual Amount Not Enter Challan Not Generate');
                     redirect('admissionChallanGent/'.$student_id);
                
                   endif;
                   $fy_id = $this->db->where('status','1')->get('financial_year')->row();
                   
           $data = array(
                    'fc_student_id'     => $studentRow->student_id,
                    'program_id_paid'   => $studentRow->programe_id,
                    'batch_id_paid'     => $studentRow->batch_id,
                    'sub_pro_id_paid'   => $studentRow->sub_pro_id,
//                    'section_id_paid'   =>$studentRow->sub_pro_id,
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
 
        $this->data['page']         = 'Fee/fee_admission_challan';
        $this->data['page_header']  = 'New Admission Challan';
        $this->data['page_title']   = 'New Admission Challan | ECMS';
        $this->load->view('common/common',$this->data);
        
    }
     public function fee_challan_print_admission(){
        
            $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$this->uri->segment(3)));
            $this->data['feeComments']  = $this->FeeModel->get_challan_detail(array('fc_challan_id'=>$this->uri->segment(2)));
             $where = array(
                       'fc_student_id '=> $this->data['feeComments'] ->fc_student_id,
                       'fc_paid_form <='=> $this->data['feeComments'] ->fc_paid_form,
                       
                   );
     
        $this->data['result']       = $this->FeeModel->feeDetails_head_print($where);
        $this->data['page']         = 'Fee/Reports/fee_challan_print_admission';
        $this->data['page_header']  = 'Fee Challan Print';
        $this->data['page_title']   = 'Fee Challan Print | ECMS';
        $this->load->view('common/common',$this->data);
    }

    
    public function fee_refund(){
        
         $this->data['challandId'] = '';
        if($this->input->post('payment_challan_search')):
            $challandId = $this->input->post('challan_no');
            
            $this->data['challandId'] = $challandId;
            $challan_details            = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challandId));
             
            $challan_status = $this->CRUDModel->get_where_row('fee_challan_history',array('ch_status_id'=>2,'challan_id'=>$challandId));
             
            if(!empty($challan_status)):
//            echo '<pre>';print_r($challan_details);die;
            $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.s_status_id' => 5,'student_record.student_id'=>$challan_details->fc_student_id));
//             echo '<pre>';print_r($this->data['studentInfo']);die;
            $this->data['result']       = $this->FeeModel->get_Student_feeDetails_search(array('fee_actual_challan_detail.challan_id'=>$challandId));
//             echo '<pre>';print_r($this->data['result']);die;
            
            
            else:
                 $this->session->set_flashdata('refun_message', 'Challan Information  !</strong> Challan are not paid  connect to Finance Department');
            endif;
            

        endif;
        
        
        if($this->input->post('refund_challan')):
       $userInfo           = json_decode(json_encode($this->getUser()), FALSE);
            
            $update_installment = $this->input->post('update_installment');
            $challan_det_id     = $this->input->post('challan_det_id');
            $challan_Id         = $this->input->post('challan_Id');
            $challan_comment     = $this->input->post('challan_comment');
            $student_id     = $this->input->post('student_id');
            $refund_date    = $this->input->post('refund_date');
        
            
            
            
            $refund_where =  array(
                'challan_id'    =>$challan_Id,
                'date'          =>date('Y-m-d',strtotime($refund_date)),
                'comments'      =>$challan_comment,
                'timestamp'     =>date('Y-m-d H:i:s'),
                'userId'        => $userInfo->user_id
            );
           $refund_id =  $this->CRUDModel->insert('fee_refund_challan',$refund_where);
            
            $combine = array_combine($challan_det_id,$update_installment);
            $refund_amount = 0;
                foreach($combine as $key=>$row):
                $fee_challan = $this->CRUDModel->get_where_row('fee_actual_challan_detail',array('challan_detail_id'=>$key));
                $data = array(
                    'refund_challan_id' =>$challan_Id,
                    'refund_id' 		=>$refund_id,
                    'fh_id'         	=>$fee_challan->fee_id,
                    'refund_amount' 	=>$row,
                    'timestamp'     	=>date('Y-m-d H:i:s'),
                    'userId'        	=> $userInfo->user_id,
                    
                );
                $refund_amount +=$row;
                $this->CRUDModel->insert('fee_refund_detail',$data);
                //Update challan details as challan is refund
                $update_challan_detail = array(
                    'up_timestamp'          =>date('Y-m-d H:i:s'),
                    'up_userId'             => $userInfo->user_id,
                    'challan_status'        =>3
                );
                $this->CRUDModel->update('fee_actual_challan_detail',$update_challan_detail,array('challan_id'=>$challan_Id));     
               
               endforeach;
               //Challan History : challan refund status = 3;
           $data_refund_history = array(
                'challan_id'    =>$challan_Id,
                'student_id'    =>$student_id,
                'ch_status_id'  =>3,
                'date'          =>date('Y-m-d'),
                'comments'      =>$challan_comment,
                'timestamp'     =>date('Y-m-d H:i:s'),
                'userId'        => $userInfo->user_id
           );
           $this->CRUDModel->insert('fee_challan_history',$data_refund_history); 
           //update fee_challan Challan status and comment 
           $this->CRUDModel->update('fee_challan',array('fc_comments'=>$challan_comment,'fc_ch_status_id'=>3),array('fc_challan_id'=>$challan_Id));     
           // update student_record table student status = refund
           $this->CRUDModel->update('student_record',array('s_status_id'=>6),array('student_id'=>$student_id));     
           // update total Annul fee balance 
           $annual_balance = $this->CRUDModel->get_where_row('fee_total_balance',array('student_id'=>$student_id));
            
           $this->CRUDModel->update('fee_total_balance',array('total_r_amount'=>$annual_balance->total_r_amount+$refund_amount),array('student_id'=>$student_id));     
           
           $fee_balance = $this->CRUDModel->get_where_row('fee_balance',array('student_id'=>$student_id));
            
           $this->CRUDModel->update('fee_balance',array('r_amount'=>$fee_balance->r_amount+$refund_amount),array('student_id'=>$student_id));     
           
                    
        endif;
        
        $this->data['page']         = 'Fee/fee_refund';
        $this->data['page_header']  = 'Refund Fee Challan';
        $this->data['page_title']   = 'Refund Fee Challan | ECMS';
        $this->load->view('common/common',$this->data);
    }
    
    
      public function fee_challan_change_date(){
         $this->data['challandId'] = '';
         if($this->input->post('payment_challan_search')):
             
            $challandId                         = $this->input->post('challan_no');
            $this->data['challandId']           = $challandId;
            $challan_details                    = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challandId,'fc_ch_status_id'=>2));
            $this->data['challan_paid_date']    = $challan_details->fc_paiddate;
            $this->data['studentInfo']          = $this->FeeModel->fee_challan_student(array('student_record.s_status_id' => 5,'student_record.student_id'=>$challan_details->fc_student_id));
            $this->data['result']               = $this->FeeModel->get_Student_feeDetails_search(array('fee_actual_challan_detail.challan_id'=>$challandId));

        endif;
     
        if($this->input->post('change_date')):
            $userInfo           = json_decode(json_encode($this->getUser()), FALSE);
            $challandId         = $this->input->post('challan_no');
            $challan_new_paid   = date('Y-m-d',strtotime($this->input->post('challan_new_paid')));
            $challan_old_paid   = $this->input->post('challan_old_paid');
            $comment            = $this->input->post('change_date_challan_comment');
            
                
            $BRRL = $this->db->get_where('fee_brr_lock',array('lock_date'=>$challan_new_paid,'status'=>1))->row();
                $erro_msg = '';   
            if(empty($BRRL)):
                
                if($challan_new_paid != $challan_old_paid):
            $date_change = array(
               'challan_id' =>$challandId,
               'comment'    =>$comment,
               'old_date'    =>$challan_old_paid,
               'new_date'    =>$challan_new_paid,
               'timestamp'     =>date('Y-m-d H:i:s'),
               'userId'       => $userInfo->user_id,
                
            );
            $this->CRUDModel->insert('fee_challan_date_change',$date_change);
            
            $this->CRUDModel->update('fee_challan',array('fc_paiddate'=>date('Y-m-d',strtotime($challan_new_paid))),array('fc_challan_id'=>$challandId));
           
            endif;
                
                   $erro_msg = '<div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Payment Date ! Successfully Saved   !</strong></div>';
                    
               
            
                else:
                 
                    
                    $erro_msg = '<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Payment '.date('d-m-Y',strtotime($BRRL->lock_date)).' ! Record not Saved !</strong> Date is locked</div>';
                  
                    
                 
                $challandId                         = $this->input->post('challan_no');
                $this->data['challandId']           = $challandId;
                $challan_details                    = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challandId,'fc_ch_status_id'=>2));
                $this->data['challan_paid_date']    = $challan_details->fc_paiddate;
                $this->data['studentInfo']          = $this->FeeModel->fee_challan_student(array('student_record.s_status_id' => 5,'student_record.student_id'=>$challan_details->fc_student_id));
                $this->data['result']               = $this->FeeModel->get_Student_feeDetails_search(array('fee_actual_challan_detail.challan_id'=>$challandId));
 
                    
                
            endif;
            
             $this->data['error_msg'] = array(
                    'date' => $erro_msg
                );
           
            
        endif;
        
        
        
        
        $this->data['page']         = 'Fee/challan_date_change';
        $this->data['page_header']  = 'Fee Challan Change Date';
        $this->data['page_title']   = 'Fee Challan Change Date | ECMS';
        $this->load->view('common/common',$this->data);
 
         
    }
    
       public function fee_concession_student_search(){
        
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['pc']           = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', 'Payment Category', 'pc_id', 'title');
        $this->data['challan']      = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        
        $this->data['collegeNo']    = '';
        $this->data['pc_id']    = '';
        $this->data['fatherName']    = '';
        $this->data['stdName']    = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['sub_pro_id']   = '';
        $this->data['challan_id']   = '';
        
        
        
        
        if($this->input->post()):
            
            $collegeNo      = $this->input->post("collegeNo");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $pc_id          = $this->input->post("pc_id");
            $challan_status = $this->input->post("challan_status");
 
        
         $where = '';
         $like = '';
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['collegeNo'] = $collegeNo;
            endif;
//            if($challan_status):
                $where['fee_challan_status.ch_status_id '] = 1;
//                $this->data['challan_id'] = $challan_status;
//            endif;
            
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
                $this->data['pc_id']                = $pc_id;
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
            
       
            
            $this->data['result'] = $this->FeeModel->fee_challan_filters($where,$like);
            
//             echo '<pre>';print_r( $this->data['result']);die;
        endif;
        
        
        
        
        
        $this->data['page']         = 'Fee/fee_concession_std_search';
        $this->data['page_header']  = 'Fee Concession Searh';
        $this->data['page_title']   = 'Fee Concession Searh | ECMS';
        $this->load->view('common/common',$this->data);
    }
public function fee_concession(){
        
//        $challandId = $this->uri->segment(2);
       
        $this->data['challandId']       = '';
        if($this->input->post('payment_challan_search')):
            
            $challandId = $this->input->post('challan_no');
            $this->data['concession_type']  = $this->CRUDModel->dropDown('fee_concession_type', 'Concession Type', 'concess_type_id', 'title');
            $this->data['challandId']       = $challandId;
            $challan_details                = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challandId));
            
            $challan_status = $this->CRUDModel->get_where_row('fee_challan_history',array('ch_status_id'=>1,'challan_id'=>$challandId));
            $challan_concession             = $this->CRUDModel->get_where_row('fee_concession_challan',array('challan_id'=>$challandId));
             $this->data['challan_type_id'] = '';
             if(empty($challan_concession)):
                  $this->data['challan_type_id'] = '';
                 else:
                  $this->data['challan_type_id'] = $challan_concession->concess_type_id;
             endif; 
            
            
                                  $this->db->order_by('fc_challan_id','desc');
                                  $this->db->limit('0','1');
             $check_installment = $this->db->get_where('fee_challan',array('fc_student_id'=>$challan_details->fc_student_id))->row();
             
             if($check_installment->fc_challan_id >$challandId):
                 
                 $this->session->set_flashdata('refun_message', 'Challan Information  !</strong> Please Select Last Challan For Concessoin');
                 else:
                     
                     if(!empty($challan_status)):

                        $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$challan_details->fc_student_id));
            //            $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.s_status_id' => 5,'student_record.student_id'=>$challan_details->fc_student_id));
            //             echo '<pre>';print_r($this->data['studentInfo']);die;
                        $this->data['result']       = $this->FeeModel->get_Student_feeDetails_search(array('fee_actual_challan_detail.challan_id'=>$challandId));
            //             echo '<pre>';print_r($this->data['result']);die;


                        else:
                             $this->session->set_flashdata('refun_message', 'Challan Information  !</strong> Connect to Finance Department');
                        endif;
                     
                 
             endif;
        endif;
        if($this->input->post('concession_challan_delete')):
           
             $challan_Id        = $this->input->post('challan_no');
             $student_id        = $this->input->post('student_id');
             $pc_id             = $this->input->post('pc_id');
        
           
            $fee_deteails = $this->CRUDModel->get_where_result('fee_concession_detail',array('challan_id'=>$challan_Id));
            
            foreach($fee_deteails as $detl_row):
                 $fee_head = $this->CRUDModel->get_where_row('fee_actual_challan_detail',array('challan_id'=>$challan_Id,'fee_id'=>$detl_row->fh_id));
                
                $SET = array(
                  'paid_amount' => $fee_head->actual_amount,  
                  'balance'     => $fee_head->actual_amount,  
                );
                $WHERE = array(
                    'challan_detail_id'=>$fee_head->challan_detail_id,
                    
                );
            $this->CRUDModel->update('fee_actual_challan_detail',$SET,$WHERE);
            endforeach;
            $this->db->select_sum('actual_amount'); 
           $total =  $this->db->get_where('fee_actual_challan_detail',array('challan_id'=>$challan_Id))->row();
            
          
            $SET_B = array(
                  
                  'r_amount'     => $total->actual_amount,  
                );
            $WHERE_B = array(
                'student_id'=>$student_id,
                'pay_cat_id'=>$pc_id,
            );
            
             $this->CRUDModel->update('fee_balance',$SET_B,$WHERE_B);
           
            //Delete From Fee Concession Details table
            $this->CRUDModel->deleteid('fee_concession_detail',array('challan_id'=>$challan_Id));
            //Delete From Fee Concession table
            $this->CRUDModel->deleteid('fee_concession_challan',array('challan_id'=>$challan_Id));
            
            redirect('feeConcession');
            
        endif;
        
        if($this->input->post('concession_challan')):
            $userInfo           = json_decode(json_encode($this->getUser()), FALSE);
            
            $update_installment = $this->input->post('update_installment');
            $challan_concess_id = $this->input->post('challan_concess_id');
            $type_id            = $this->input->post('concession_type_id');
            $challan_Id         = $this->input->post('challan_Id');
            $challan_comment    = $this->input->post('challan_comment');
            $student_id         = $this->input->post('student_id');
            $concession_amount  = $this->input->post('concession_amount');
            $pc_id              = $this->input->post('pc_id');
            
            $old_concession = $this->CRUDModel->get_where_row('fee_concession_challan',array('challan_id'=>$challan_Id));
            
           if(!empty($old_concession)):
                
                    $where = array('fee_concession_challan.challan_id'=>$challan_Id);
                                    $this->db->select('fee_concession_challan.challan_id,sum(concession_amount) as total_old_amount');
                                    $this->db->join('fee_concession_detail','fee_concession_detail.concession_id=fee_concession_challan.concession_id');
            $old_amount       =     $this->db->where($where)->get('fee_concession_challan')->row(); 
              
            
              $total_balance_yearly = $this->CRUDModel->get_where_row('fee_total_balance',array('student_id'=>$student_id));  
             
                $this->CRUDModel->update('fee_total_balance',array('total_r_amount'=>$total_balance_yearly->total_r_amount+$old_amount->total_old_amount), array('student_id'=>$student_id));
                $this->CRUDModel->deleteid('fee_concession_challan',array('challan_id'=>$challan_Id));
                $this->CRUDModel->deleteid('fee_concession_detail',array('challan_id'=>$challan_Id));
             
           endif;
           
           
             $refund_where =  array(
                'challan_id'        =>$challan_Id,
                'date'              =>date('Y-m-d'),
                'comments'          =>$challan_comment,
                'concess_type_id'   =>$type_id,
                'timestamp'         =>date('Y-m-d H:i:s'),
                'userId'            => $userInfo->user_id
            );
           $concession_id =  $this->CRUDModel->insert('fee_concession_challan',$refund_where);
            
            $combine = array_combine($challan_concess_id,$update_installment);
           
            $refund_amount = 0;
                foreach($combine as $key=>$row):
                    $fee_challan = $this->CRUDModel->get_where_row('fee_actual_challan_detail',array('challan_detail_id'=>$key));
               
                if($row != ''):
                   $data = array(
                    'challan_id'        => $challan_Id,
                    'concession_id'     => $concession_id,
                    'fh_id'             => $fee_challan->fee_id,
                    'concession_amount' => $row,
                    'timestamp'         => date('Y-m-d H:i:s'),
                    'userId'            => $userInfo->user_id,
                );
                $refund_amount +=$row;
                $this->CRUDModel->insert('fee_concession_detail',$data);
                $paid_where = array(
                    'challan_id'        =>$challan_Id,
                    'challan_id'        =>$challan_Id,
                    'challan_detail_id' =>$key,
                );
                $paid_amount = $this->CRUDModel->get_where_row('fee_actual_challan_detail',$paid_where);
                
//                  echo '<pre>';print_r($paid_amount);
                //Update challan details as challan is refund
                 $update_challan_detail = array(
                    'up_timestamp'          =>date('Y-m-d H:i:s'),
                    'up_userId'             => $userInfo->user_id,
                    'paid_amount'           => $paid_amount->actual_amount-$row,
                    'balance'               => $paid_amount->actual_amount-$row,
                   
                );
                 $this->CRUDModel->update('fee_actual_challan_detail',$update_challan_detail, $paid_where);   
                endif;
                   
                endforeach;
            //Update  challan_balance in Fee Balance table 
//               $fee_balance = $this->CRUDModel->get_where_row('fee_balance',array('student_id'=>$student_id,'pay_cat_id'=>$pc_id));
//               $this->CRUDModel->update('fee_balance',array('r_amount'=>$fee_balance->r_amount-$concession_amount), array('student_id'=>$student_id,'pay_cat_id'=>$pc_id));  
//                
                $fee_balance = $this->CRUDModel->get_where_row('fee_balance',array('student_id'=>$student_id,'pay_cat_id'=>$pc_id));
                                     $this->db->select('
                                            sum(actual_amount)  as actual,
                                            sum(paid_amount)    as paid
                                             ');
               $fee_balance_amount = $this->db->get_where('fee_actual_challan_detail',array('challan_id'=>$challan_Id))->row();
                $this->CRUDModel->update('fee_balance',array('r_amount'=>$fee_balance_amount->paid), array('student_id'=>$student_id,'pay_cat_id'=>$pc_id));  
                
               //Update Yearly Amount 
                $total_balance_yearly = $this->CRUDModel->get_where_row('fee_total_balance',array('student_id'=>$student_id));
                $this->CRUDModel->update('fee_total_balance',array('total_r_amount'=>$total_balance_yearly->total_r_amount-$concession_amount), array('student_id'=>$student_id));  
               
            redirect('feeChallanPrint/'.$challan_Id.'/'.$student_id);
        endif;
        
        
        $this->data['page']         = 'Fee/fee_concession';
        $this->data['page_header']  = 'Fee Concession';
        $this->data['page_title']   = 'Fee Concession | ECMS';
        $this->load->view('common/common',$this->data);
    }
     public function bank_reconciliation_statment(){
        
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['fee_head']     =$this->FeeModel->dropDown_fee_head('fee_class_setups', 'Fee Head', 'fh_Id', 'fh_head');
        $this->data['bank']         = $this->DropdownModel->bank_dropDown('bank','Select Bank', 'bank_id', 'name');
        $this->data['gender']         = $this->CRUDModel->dropDown('gender','Select Gender', 'gender_id', 'title');
        
        $this->data['collegeNo']    = '';
        $this->data['gender_id']    = '';
        $this->data['bank_id']      = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['fee_id']       = '';
        $this->data['sec_id']       = '';
        $this->data['Bank_info']    = '';
        $this->data['sub_pro_id']   = '';
        $this->data['from']         = '';
        $this->data['to']           = date('d-m-Y');
        
        
        
        
        if($this->input->post()):
            
            $collegeNo      = $this->input->post("collegeNo");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $from           = $this->input->post("from");
            $to             = $this->input->post("to");
            $fee_head       = $this->input->post("fee_head_id");
            $bank           = $this->input->post("bank");
            $gender           = $this->input->post("gender");
          
            
            $date = array(
                'from'  => $from,
                'to'    => $to,
            );
            $this->data['from'] = $from;
            $this->data['to']   = $to;
   
            $like       = '';
            $where_head = '';
            $where      = '';
              
           if($gender):
                $where['student_record.gender_id'] = $gender;
                $this->data['gender_id']           = $gender;
            endif;
           if($fee_head):
                $where_head['fee_heads.fh_Id']     = $fee_head;
                $this->data['fee_id']                               = $fee_head;
            endif;
           if($bank):
                $where['fee_challan.fc_bank_id']        = $bank;
                $this->data['bank_id']                  = $bank;
                $bank_info = $this->CRUDModel->get_where_row('bank',array('bank_id'=>$bank));
                $this->data['Bank_info']                      = 'Account No:'.$bank_info->account_no;
             endif;
            
            if($collegeNo):
                $where['student_record.college_no']     = $collegeNo;
                $this->data['collegeNo']                = $collegeNo;
            endif;
         
            
            if(!empty($stdName)):
                $like['student_record.student_name']    = $stdName;
                $this->data['stdName']                  = $stdName;
            endif;
            if(!empty($fatherName)):
                $like['student_record.father_name']     = $fatherName;
                $this->data['fatherName']               = $fatherName;
            endif;
         
            
            if($programe_id):
                $where['programes_info.programe_id']    = $programe_id;
                $this->data['programe_id']              = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
             
       if($this->input->post('student_wise')):
//           fc_challan_credit_amount
            $this->data['result']           = $this->FeeModel->fee_bank_reconcilition($where,$like,$date,$where_head);
//            $this->data['std_result']       = $this->FeeModel->fee_bank_reconcilition_count($where,$like,$date);
            $this->data['report_type']  = 'student_wise';
            $this->data['report_name']  = 'Student Wise';
//               echo '<pre>';print_r( $this->data['result']);die;
        endif;
      
       if($this->input->post('date_wise')):
           
            $this->data['result']           = $this->FeeModel->fee_bank_reconcilition_date_wise($where,$date,$where_head);
            $this->data['report_type']  = 'date_wise';
            $this->data['report_name']  = 'Date Wise';
              
        endif;
         
       if($this->input->post('fee_head')):
            
            $this->data['where2']        = $where;
            $this->data['where']        = $where;
            $this->data['where_head']   = $where_head;
             
            $this->data['result']       = $this->FeeModel->fee_bank_reconcilition_head_wise($where,$where_head,$date);
            $this->data['report_type']  = 'head_wise';
            $this->data['report_name']  = 'Head Wise Group Report';
 
        endif;
        
       if($this->input->post('head_wise_student')):
            
            
             
            $this->data['where']        = $where;
            $this->data['where2']       = $where;
            $this->data['like']         = $like;
            $this->data['result']       = $this->FeeModel->fee_bank_reconcilition_head_wise($where,$where_head,$date);
            $this->data['report_type']  = 'head_wise_student';
            $this->data['report_name']  = 'Head Wise Student Report';
            
            
        endif;
        endif;
        $this->data['page']         = 'Fee/Reports/fee_reconcilition';
        $this->data['page_header']  = 'Bank Reconciliation Report';
        $this->data['page_title']   = 'Bank Reconciliation Report | ECMS';
        $this->load->view('common/common',$this->data);
        
        }
    
      public function fee_concession_report(){
        
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']          = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['challan_status']   = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['challan_type']     = $this->CRUDModel->dropDown('fee_concession_type', 'Challan Type', 'concess_type_id', 'title');
        $this->data['batch_name']       = $this->CRUDModel->dropDown('prospectus_batch', 'Batch Name', 'batch_id', 'batch_name');
        
        $this->data['collegeNo']    = '';
        $this->data['batch_id']    = '';
        $this->data['status_id']    = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['challan_type_id']   = '';
        $this->data['sub_pro_id']   = '';
        $this->data['from']         = '';
        $this->data['to']           = date('d-m-Y');
        
        if($this->input->post()):
             $collegeNo      = $this->input->post("collegeNo");
             $challan_no    = $this->input->post("challan_no");
             $form_no       = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $from           = $this->input->post("from");
            $to             = $this->input->post("to");
            $challan_status = $this->input->post("challan_status");
            $challan_type   = $this->input->post("challan_type");
            $batch_id       = $this->input->post("batch_id");
           
            $date = array(
                'from'=>$from,
                'to'=>$to,
            );
            
            $this->data['from'] = $from;
            $this->data['to']   = $to;
//         $where['fee_challan.fc_ch_status_id'] = 2;
            $where = '';
            $like = '';
           
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['collegeNo'] = $collegeNo;
            endif;
            if($batch_id):
                $where['student_record.batch_id'] = $batch_id;
                $this->data['batch_id'] = $batch_id;
            endif;
            if($challan_no):
                $where['fee_challan.fc_challan_id'] = $challan_no;
                $this->data['challan_no'] = $challan_no;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
           
            if($challan_status):
                $this->data['where'] = array('fee_challan_status.ch_status_id' => $challan_status);
                $where['fee_challan.fc_ch_status_id'] = $challan_status;
                $this->data['status_id'] = $challan_status;
            endif;
         
            
            if(!empty($stdName)):
                $like['student_record.student_name'] = $stdName;
                $this->data['stdName']           = $stdName;
            endif;
            if(!empty($fatherName)):
                $like['student_record.father_name'] = $fatherName;
                $this->data['fatherName']           = $fatherName;
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
            if(!empty($challan_type)):
                $where['fee_concession_type.concess_type_id'] = $challan_type;
                $this->data['challan_type_id']     = $challan_type;
            endif;
            
                if($this->input->post('conce_std_wise')):
                    $this->data['result']       = $this->FeeModel->fee_concession($where,$like,$date);
                    $this->data['report_type']  = 'conce_std_wise';
                    $this->data['report_name']  = 'Fee Concession Student Wise';
//                     echo '<pre>';print_r($this->data['result'] );
                endif;
 
        endif;
        
        $this->data['page']         = 'Fee/Reports/fee_concession_report';
        $this->data['page_header']  = 'Fee Concession Report';
        $this->data['page_title']   = 'Fee Concession Report | ECMS';
        $this->load->view('common/common',$this->data);
    }
    
    // status change on offline mode 
    public function idle(){
        $userInfo = json_decode(json_encode($this->getUser()), FALSE);
              
        $user = $this->CRUDModel->get_where_row('users',array('id'=>$userInfo->user_id));
    
        $this->data['user_status'] = $user->userStatus; 
        $this->data['page']         = 'Fee/Reports/idle';
        $this->data['page_header']  = 'Fee Concession Report';
        $this->data['page_title']   = 'Fee Concession Report | ECMS';
        $this->load->view('common/common',$this->data);
        
    }
 
    
    public function idle_status(){
        $userInfo =  json_decode(json_encode($this->getUser()), FALSE);
        $user_status      = $this->input->post("value");
//        echo '<pre>';print_r($userInfo);die;
        
        $data = array(
            'userStatus' =>2
        );
        $where = array(
            'id' =>$userInfo->user_id 
        );
       $this->CRUDModel->update('users',$data,$where);
//      echo 'offline';   
    }
    public function idle_status_live(){
        $userInfo =  json_decode(json_encode($this->getUser()), FALSE);
        $user_status      = $this->input->post("value");
//        echo '<pre>';print_r($userInfo);die;
        
        $data = array(
            'userStatus' =>1
        );
        $where = array(
            'id' =>$userInfo->user_id 
        );
       $this->CRUDModel->update('users',$data,$where);
       
//       echo 'Live';
         
    }
    public function close_status(){
        $userInfo =  json_decode(json_encode($this->getUser()), FALSE);
        $user_status      = $this->input->post("value");
//        echo '<pre>';print_r($userInfo);die;
        
        $data = array(
            'userStatus' =>0
        );
        $where = array(
            'id' =>$userInfo->user_id 
        );
       $this->CRUDModel->update('users',$data,$where);
       
//       echo 'Live';
         
    }
    
    
    public function fee_concession_form(){
       
        
         $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['pc']           = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', 'Payment Category', 'pc_id', 'title');
        $this->data['challan']      = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        
        $this->data['collegeNo']    = '';
        $this->data['pc_id']    = '';
        $this->data['fatherName']    = '';
        $this->data['stdName']    = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['sub_pro_id']   = '';
        $this->data['challan_id']   = '';
        
        
        
        
        if($this->input->post()):
            
            $collegeNo      = $this->input->post("collegeNo");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $pc_id          = $this->input->post("pc_id");
            $challan_status = $this->input->post("challan_status");
 
        
         $where = '';
         $like = '';
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['collegeNo'] = $collegeNo;
            endif;
            if($challan_status):
                $where['fee_challan_status.ch_status_id'] = $challan_status;
                $this->data['challan_id'] = $challan_status;
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
            
       
            
            $this->data['result'] = $this->FeeModel->fee_concession_form($where,$like);
            
//             echo '<pre>';print_r( $this->data['result']);die;
        endif;
        
        
        
        
        
        $this->data['page']         = 'Fee/fee_concession_form';
        $this->data['page_header']  = 'Fee Concession Form';
        $this->data['page_title']   = 'Fee Concession Form | ECMS';
        $this->load->view('common/common',$this->data);
        
    }
    
    public function print_concession_form(){
        
        $std_id = $this->uri->segment(2);
        
         
        $this->data['student_info'] = $this->FeeModel->get_student_info(array('student_record.student_id'=>$std_id));
//         echo '<pre>';print_r($this->data['student_info']);die;
        $this->data['page']         = 'Fee/fee_concession_form_print';
        $this->data['page_header']  = 'Fee Concession Form';
        $this->data['page_title']   = 'Fee Concession Form | ECMS';
        $this->load->view('common/common',$this->data); 
    }
    
    public function get_payment_date(){
        $pc_id = $this->input->post('pc_id');
        
         $pc_details  = $this->CRUDModel->get_where_row('fee_payment_category',array('pc_id'=>$pc_id));
        
        $where = array(
          'sub_pro_id'=>$pc_details->sub_pro_id,  
          'pc_id'=>$pc_details->pc_id,  
        );
                     
                     $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                     $this->db->join('fee_installment_type','fee_installment_type.id=fee_category_titles.inst_type_id');
        $inst_type = $this->db->get_where('fee_payment_category',array('pc_id'=>$pc_id))->row();
//        
                  $this->db->order_by('fcs_id','desc')->limit('0','1');  
         $dates = $this->db->where($where)->get('fee_class_setups')->row();
 
         $result = array(
             'fee_from'     =>date('d-m-Y', strtotime($dates->fee_from)),
             'fee_to'       =>date('d-m-Y', strtotime($dates->fee_to)),
             'valid_till'   =>date('d-m-Y', strtotime($dates->valid_till)),
             'install_type_name' =>$inst_type->installment_title,
             'install_type_id' =>$inst_type->id
                     );
          
         
        echo json_encode($result);
        
    }
    
    public function updat_fee_record(){
               $pc_id = $this->input->post('pc_id');
         $pc_details  = $this->CRUDModel->get_where_row('fee_payment_category',array('pc_id'=>$pc_id));
        
        $where = array(
          'sub_pro_id'=>$pc_details->sub_pro_id,  
          'pc_id'=>$pc_details->pc_id,  
        );
 
                         $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');   
         $amount_array = $this->db->where($where)->get('fee_class_setups')->result();   
 
         echo '
                                        <div class="table-responsive">
             <table class="table table-hover" id="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fee Head</th>
                            <th>Challan Detail</th>
                        </tr>
                        </thead>
                        <tbody>';
                    $sn = '';
                        $grand_actual_amount = '';
                        $grand_paid_amount = '';

                          foreach($amount_array as $row):


                            $sn++;
                            echo '<tr">
                                <th>'.$sn.'</th>
                                <th>'.$row->fh_head.'</th>
                                
                                <th><input value="'.$row->fcs_amount.'" name="update_amount[]" class="update_installment"></th>
                                <th><input type="hidden" value="'.$row->fcs_id.'" name="update_amount_id[]"></th>
                                 </tr>';
                            $grand_actual_amount  += $row->fcs_amount;
                            $grand_paid_amount    += $row->fcs_amount;
                        endforeach;      

                          echo '<tr ">
                                <th> </th>
                                <th>Total Amount</th>
                            
                                <th><input readonly="readonly" type="text" class="total" value="'.$grand_paid_amount.'"></th>
                            </tr>';       
                            echo ' 
                      </tbody>
              </table></div>';
    }

    public function annual_fee(){
          $this->data['form_no']      = '';
        $this->data['student_name'] = '';
        $this->data['father_name']  = '';
        if($this->input->post('search')):
            
            $form_no        = $this->input->post('form_no');
            $student_name   = $this->input->post('student_name');
            $father_name    = $this->input->post('father_name');
            
            $where['student_status.s_status_id'] = 1;
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
            
           $this->data['result'] = $this->FeeModel->get_apply_student($where,$like);
//          echo '<pre>';print_r( $this->data['result'] );die;
        endif;
        
        
        $this->data['page']         = 'Fee/annual_challan_search';
        $this->data['page_header']  = 'Full Year Fee ';
        $this->data['page_title']   = 'Full Year Fee | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function annual_fee_genearte(){
        
        
        $uri2 = $this->uri->segment(2);
        $this->data['student_info'] = $this->FeeModel->fee_challan_student(array('student_record.s_status_id'=>1,'student_record.student_id'=>$uri2));
        $this->data['bank']         = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name');
        $this->data['install_type'] = $this->CRUDModel->dropDown('fee_installment_type','', 'id', 'installment_title',array('id'=>2));
         
//        echo '<pre>';print_r($this->data['student_info']);die;
        
       
        
        if($this->input->post()):
            ob_start();
            $userInfo           = json_decode(json_encode($this->getUser()), FALSE);
            $update_amount      = $this->input->post('update_amount');
            $install_type       = $this->input->post('install_type');
            $pc_id              = $this->input->post('pc_id');
            $student_id         = $this->input->post('student_id');
            $bank_id            = $this->input->post("bank_id");
            $update_amount_id   = $this->input->post('update_amount_id');
            $fromDate           = $this->input->post("fromDate");
            $dueDate            = $this->input->post("dueDate");
            $issueDate          = $this->input->post("issueDate");
            $uptoDate           = $this->input->post("uptoDate");
            $comment            = $this->input->post("fee_comments");
            
            
            
            
//               $studentRow = $this->CRUDModel->get_where_row('student_record',array('student_id'=>$student_id));
            
            
//            $fee_challan_exist = $this->CRUDModel->key_exists('fee_challan',array('fc_student_id'=>$studentRow->student_id,'fc_pay_cat_id'=>$pc_id));
          
          //******************************************************************************************************            
//********************            FEE CHALLAN CHECKING IF EXIST                       ******************
//******************************************************************************************************
            
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
               
                 $total_balanc_an = $this->CRUDModel->get_where_row('fee_total_anual',array('sub_pro_id'=>$studentRow->sub_pro_id));
//******************************************************************************************************            
//********************            CHECKING ANNUAL AMOUNT AGISNT SUB PROGRAM           ******************
//****************************************************************************************************** 
            
                   if(!empty($total_balanc_an)):
            
                    $check_balance =  $this->CRUDModel->get_where_row('fee_total_balance',array('student_id'=>$studentRow->student_id,'batch_id'=>$studentRow->batch_id,'sub_por_id'=>$studentRow->sub_pro_id));
                   
//******************************************************************************************************            
//********************    CHECKING AMOUNT AGISNT STUDENT (FIST PAYMENT OR 2ND PAYMENT) ******************
//******************************************************************************************************                       
                      if(!empty($check_balance)):
//                   
                        $total_balace_update = array(
                            'total_r_amount' => $total_balanc_an->total_amount+$check_balance->total_r_amount,
                            'timestamp'      => date('Y-m-d H:i:s'), 
                            'userId'         => $userInfo->user_id );
                      $this->CRUDModel->update('fee_total_balance',$total_balace_update,array('student_id'=>$studentRow->student_id));
                            else:
                      
                        $total_balance_inset = array(
                            'student_id'     =>$studentRow->student_id,
                            'batch_id'       =>$studentRow->batch_id,
                            'sub_por_id'     =>$studentRow->sub_pro_id,
                            'total_r_amount' =>$total_balanc_an->total_amount,
                            'timestamp'      => date('Y-m-d H:i:s'), 
                            'userId'         => $userInfo->user_id );
                       $this->CRUDModel->insert('fee_total_balance',$total_balance_inset);
                        endif;
                        
                           
                         else:    
                     $this->session->set_flashdata('error_payment', 'Total Annual Amount Not Enter Challan Not Generate');
                     redirect('admissionChallanGent/'.$student_id);
                
              
 
              
                   endif;
                    $fy_id = $this->db->where('status','1')->get('financial_year')->row();
           $data = array(
                    'fc_student_id'     => $studentRow->student_id,
                   
                    'program_id_paid'   => $studentRow->programe_id,
                    'batch_id_paid'     => $studentRow->batch_id,
                    'sub_pro_id_paid'   => $studentRow->sub_pro_id,
                    'fc_ch_status_id'   => 1, //Challan status not paid
                    'fc_paid_form'      => date_format(date_create($fromDate),"Y-m-d"), 
                    'fc_paid_upto'      => date_format(date_create($uptoDate),"Y-m-d"), 
                    'fc_dueDate'        => date_format(date_create($dueDate),"Y-m-d"), 
                    'fc_issue_date'     => date('Y-m-d', strtotime($issueDate)), 
                    'fc_pay_cat_id'     => $pc_id, 
                    'installment_type'  => $install_type, 
                    'fc_bank_id'        => $bank_id,
                    'financial_id'        => $fy_id->id,
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
                                'actual_amount' => $row,
                                'paid_amount'   => $row,
                                'balance'       => $row,
                                'challan_status'=> 1,
                                'timestamp'     => date('Y-m-d H:i:s'),
                                'useId'         => $userInfo->user_id
                            );
                            $actual_amount   += $row;
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
                        'pay_cat_id'    =>1,
                        'r_amount'      =>$total_balance,
                        );
                        $where_sb_update = array('student_id'=>$studentRow->student_id);
                        $this->CRUDModel->update('fee_balance',$student_balance_update,$where_sb_update);
                  
                    else:
                        $student_balance_insert = array(
                                'student_id'    =>$studentRow->student_id,
                                'pay_cat_id'    =>1,
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
         $where = array(
            'fee_category_titles.inst_type_id'=>2,
            'fee_payment_category.sub_pro_id'=>$this->data['student_info']->sub_pro_id
        );
        $this->data['result'] = $this->FeeModel->admission_challan_gen($where);
//          echo '<pre>';print_r( $this->data['result']);die;
//        echo '<pre>';print_r( $this->data['result']);die;
        $this->data['page']         = 'Fee/annual_challan';
        $this->data['page_header']  = 'Full Year Challan Generate';
        $this->data['page_title']   = 'Full Year Challan Generate| ECMS';
        $this->load->view('common/common',$this->data);
        
    }
    public function balance_challan_generate(){
        
         
        $uri2       = $this->uri->segment(2);
        $challan_id = $this->uri->segment(3);
 
        $this->data['student_info'] = $this->FeeModel->fee_challan_student(
                array(
//                    'student_record.s_status_id'=>1,
                    'student_record.student_id'=>$uri2));
//             echo '<pre>';print_r($this->data['student_info']);die;
        
        $this->data['bank']         = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name');
         
        $this->data['challan_info'] = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challan_id));
        
        
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
            $challan_id_old     = $this->input->post("old_challan_id");
            $this->CRUDModel->update('fee_challan',array('fc_balance_chall_flag'=>2,'challan_id_lock'=>1),array('fc_challan_id'=>$challan_id_old));
            
            $studentRow = $this->CRUDModel->get_where_row('student_record',array('student_id'=>$student_id));
            
            $fee_challan_exist = $this->CRUDModel->key_exists('fee_challan',array('fc_student_id'=>$studentRow->student_id));
                      
//******************************************************************************************************            
//********************            FEE CHALLAN CHECKING IF EXIST                       ******************
//******************************************************************************************************
            
            if(!empty($fee_challan_exist)):
    
                 $fy_id = $this->db->where('status','1')->get('financial_year')->row();
            $section = $this->db->get_where('student_group_allotment',array('student_id'=>$student_id))->row();
           $data = array(
                    'fc_student_id'     => $studentRow->student_id,
                   
                    'program_id_paid'   => $studentRow->programe_id,
                    'batch_id_paid'     => $studentRow->batch_id,
                    'sub_pro_id_paid'   => $studentRow->sub_pro_id,
                    'section_id_paid'   => $section->section_id,
                    'fc_ch_status_id'   => 1, //Challan status not paid
                    'fc_paid_form'      => date_format(date_create($fromDate),"Y-m-d"), 
                    'fc_paid_upto'      => date_format(date_create($uptoDate),"Y-m-d"), 
                    'fc_dueDate'        => date_format(date_create($dueDate),"Y-m-d"), 
                    'fc_issue_date'     => date('Y-m-d', strtotime($issueDate)), 
                    'fc_pay_cat_id'     => $pc_id, 
                    'fc_bank_id'        => $bank_id, 
                    'financial_id'      => $fy_id->id, 
                    'fc_comments'       => $comment, 
                    'fc_edit_challan_id'=> $challan_id_old, 
                    'old_balance_challan_id'=> $challan_id_old, 
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
                                'actual_amount' => $row,
                                'paid_amount'   => $row,
                                'balance'       => $row,
                                'challan_status'=> 1,
                                'old_balance_pc_id' => 1,    
                                'timestamp'     => date('Y-m-d H:i:s'),
                                'useId'         => $userInfo->user_id
                            );
                            $actual_amount   += $fee_setups_details->fcs_amount;
                            $paid_amount     += $row;
                            $student_balance +=$row;
                          $this->CRUDModel->insert('fee_actual_challan_detail',$datafs);
                                    
                         
                          
                          endforeach;
                        // Remove Old Challan Balance
                      $this->CRUDModel->update('fee_actual_challan_detail',array('balance'=>0),array('challan_id'=>$challan_id_old));

                    $id = $this->CRUDModel->key_exists('fee_balance',array('student_id'=>$studentRow->student_id));
 
                    
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
                   
                   
                endif;
               redirect('feeChallanPrint/'.$challan_id.'/'.$studentRow->student_id);
        endif;
        $where = array(
            'cat_title_id'=>1,
            'fee_payment_category.sub_pro_id'=>$this->data['student_info']->sub_pro_id
        );
        
        
        $whereStd = array(
          'fc_student_id'=>$uri2,
          'fee_actual_challan_detail.challan_id'=>$challan_id
        );
                                $this->db->select('fee_class_setups.fcs_id,fh_head,actual_amount,paid_amount,balance');
                                $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                                $this->db->join('fee_class_setups','fee_class_setups.fcs_id=fee_actual_challan_detail.fee_id');
                                $this->db->join('fee_heads','fee_heads.fh_Id=fee_class_setups.fh_Id');
        $this->data['result'] = $this->db->where($whereStd)->get('fee_challan')->result();
//        $this->data['result'] = $this->FeeModel->get_std_balance($whereStd);
//       echo '<pre>';print_r( $this->data['result']);die;
//         echo '<pre>';print_r( $this->data['result']);die;
        $this->data['page']         = 'Fee/fee_balance_challan';
        $this->data['page_header']  = 'Balance Challan';
        $this->data['page_title']   = 'Balance Challan | ECMS';
        $this->load->view('common/common',$this->data);
        
    }
   
    
    public function fee_refund_report(){
      
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']          = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['challan_status']   = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        
        $this->data['collegeNo']    = '';
        $this->data['status_id']    = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['sub_pro_id']   = '';
        $this->data['from']         = '';
        $this->data['to']           = date('d-m-Y');
        
        if($this->input->post()):
             $collegeNo      = $this->input->post("collegeNo");
             $challan_no    = $this->input->post("challan_no");
             $form_no       = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $from           = $this->input->post("from");
            $to             = $this->input->post("to");
            $challan_status = $this->input->post("challan_status");
          
              
            $date = array(
                'from'=>$from,
                'to'=>$to,
            );
            $this->data['from'] = $from;
            $this->data['to']   = $to;
            $where = '';
            $like = '';
           
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['collegeNo'] = $collegeNo;
            endif;
            if($challan_no):
                $where['fee_challan.fc_challan_id'] = $challan_no;
                $this->data['challan_no'] = $challan_no;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
           
            if($challan_status):
                $this->data['where'] = array('fee_challan_status.ch_status_id' => $challan_status);
                $where['fee_challan.fc_ch_status_id'] = $challan_status;
                $this->data['status_id'] = $challan_status;
            endif;
         
            
            if(!empty($stdName)):
                $like['student_record.student_name'] = $stdName;
                $this->data['stdName']           = $stdName;
            endif;
            if(!empty($fatherName)):
                $like['student_record.father_name'] = $fatherName;
                $this->data['fatherName']           = $fatherName;
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
            
                if($this->input->post('refund_std_wise')):
				 
                    $this->data['result']       = $this->FeeModel->fee_refund($where,$like,$date);
                    $this->data['report_type']  = 'conce_std_wise';
                    $this->data['report_name']  = 'Fee Refund Student Wise';
                     
                endif;
 
        endif;
        
        $this->data['page']         = 'Fee/Reports/fee_refund_report';
        $this->data['page_header']  = 'Fee Refund Report';
        $this->data['page_title']   = 'Fee Refund Report | ECMS';
        $this->load->view('common/common',$this->data);
    }
//        public function fee_paid_challan_update(){
//     
//        $this->data['bank']         = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name',array('bank_id'=>8));
////        $this->data['install_type'] = $this->CRUDModel->dropDown('fee_installment_type','', 'id', 'installment_title');
//        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
//        
//        $this->data['pc_array']     = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', ' Payment Type', 'pc_id', 'title');
//        $this->data['sub_pro_name'] = $this->CRUDModel->sub_proDropDown('sub_programes', '', 'sub_pro_id', 'name');
//        $this->data['update_form']  = 1;
//        $this->data['challan_id']   = '';
////        $uri2 = $this->uri->segment(2);
//        
//        
//        if($this->input->post('search')):
//            
//         $challan_id    = $this->input->post('challan_id');
//                          $this->db->select('fee_challan.*,sum(actual_amount) as t_actual_amount,sum(paid_amount) as t_paid_amount,sum(balance) as t_balance');
//                          $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
//         $challan_info  = $this->db->get_where('fee_challan',array('fc_challan_id'=>$challan_id))->row();
//         
//        if($challan_info->fc_challan_id):
//            
//            $this->data['challan_info'] = $challan_info;
//            $this->data['student_info'] = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$challan_info->fc_student_id)); 
//         
//            $where = array(
////                'fee_category_titles.inst_type_id'=>2, 
//            'fc_challan_id'=>$challan_id,
//            'fc_student_id'=>$challan_info->fc_student_id
//        );
//        $this->data['result'] = $this->FeeModel->full_payment_info($where);
// 
//            $this->data['update_form'] = 2;
//            $this->data['challan_id'] =   $challan_id; 
//            else:
//                
//           $this->data['update_form'] = 1;
//         $this->data['challan_id'] =   $challan_id;  
//        endif;
//        endif;
//        
//        if($this->input->post('updateChallan')):
//            
//            ob_start();
//            $userInfo           = json_decode(json_encode($this->getUser()), FALSE);
//            $sub_pro_name       = $this->input->post('sub_pro_name');
//             $install_type      = $this->input->post('install_type');
//            $pc_id              = $this->input->post('pc_array');
//            $student_id         = $this->input->post('student_id');
//            $fromDate           = $this->input->post("fromDate");
//            $dueDate            = $this->input->post("dueDate");
//            $issueDate          = $this->input->post("issueDate");
//            $uptoDate           = $this->input->post("uptoDate");
//            $comment            = $this->input->post("fee_comments");
//            $challan_id         = $this->input->post('challan_id');
//            $credit_amount      = $this->input->post('credit_amount');
//            $old_pc_id          = $this->input->post('old_pc_id');
////            $fc_bank_id         = $this->input->post('bank_id');
////            $fy_id              = $this->input->post('fy_id');
//            
//            
//            $old_challan_details = $this->CRUDModel->get_where_result('fee_actual_challan_detail',array('challan_id'=>$challan_id));
////            echo '<pre>';print_r($old_challan_details);die;
//            $old_payment_total = '';
//            foreach($old_challan_details as $trans_details):
//                $tran_array_data = array(
//                    'challan_id'        => $challan_id,
//                    'fee_id'            => $trans_details->fee_id,
//                    'actual_amount'     => $trans_details->actual_amount,
//                    'paid_amount'       => $trans_details->paid_amount,
//                    'timestamp'         => date('Y-m-d H:i:s'), 
//                    'user_id'           => $userInfo->user_id
//                    
//                    );
//            $old_payment_total+= $trans_details->paid_amount;
//            $this->CRUDModel->insert('fee_transfer_challan_detail',$tran_array_data);
//            endforeach;
//            //delete old challan details
//            $this->CRUDModel->deleteid('fee_actual_challan_detail',array('challan_id'=>$challan_id,'add_new_heads_flag'=>1));
//            
//            //delete current challan balance 
//            $this->CRUDModel->deleteid('fee_balance',array('student_id'=>$student_id,'pay_cat_id'=>$old_pc_id));
//            
//            $update_amount      = $this->input->post('update_amount');
//            $update_amount_id   = $this->input->post('update_amount_id');
//            $studentRow         = $this->CRUDModel->get_where_row('student_record',array('student_id'=>$student_id));
//            
//             $this->CRUDModel->update('student_record',array('sub_pro_id'=>$sub_pro_name),array( 'student_id'=>$student_id));
//            
//             $where_challan = array(
//                 'fc_challan_id'=>$challan_id
//             );
//             
//                $data_challan = array(
//                    'fc_paid_form'              => date('Y-m-d',strtotime($fromDate)), 
//                    'fc_paid_upto'              => date('Y-m-d',strtotime($uptoDate)),
//                    'fc_dueDate'                => date('Y-m-d',strtotime($dueDate)), 
//                    'fc_Issue_date'             => date('Y-m-d',strtotime($issueDate)), 
//                    'fc_comments'               => $comment,
//                    'fc_challan_credit_amount'  => $credit_amount,
//                    'credit_date'               => date('Y-m-d'),
//                    'fc_pay_cat_id'             => $pc_id,
//                    'installment_type'          => $install_type,
//                    'up_timestamp'              => date('Y-m-d H:i:s'), 
//                    'up_userid'                 => $userInfo->user_id
//                    );
//           
//                    $this->CRUDModel->update('fee_challan',$data_challan,$where_challan);
//                            $student_balance    = '';
//                            $actual_amount      = '';
//                            $paid_amount        = '';
//                            $combine            = array_combine($update_amount_id,$update_amount);
//                                foreach($combine as $key=>$row):
//                                        $where_balace = array(
//                                           'pc_id'=>$pc_id,
//                                           'fcs_id'=>$key,
//                                        );
//                            $actual_challan_balance = $this->CRUDModel->get_where_row('fee_class_setups',$where_balace);
//                              
//                            
//                            $datafs = array(
//                                 'fee_id'       => $key,
//                                'challan_id'    => $challan_id,
//                                'actual_amount' => $actual_challan_balance->fcs_amount,
//                                'paid_amount'   => $row,
//                                'balance'       => $actual_challan_balance->fcs_amount-$row,
//                                'challan_status'=> 2,
//                                'timestamp'     => date('Y-m-d H:i:s'),
//                                'useId'         => $userInfo->user_id
//                            );
//                            $actual_amount   += $row;
//                            $paid_amount     += $row;
//                            $student_balance += $row;
//                           $this->CRUDModel->insert('fee_actual_challan_detail',$datafs);
//                        
//                          endforeach;
//                         
//                          
//                          
//                          
//                          
//                                                    $this->db->select('fee_challan.fc_student_id,sum(paid_amount) as total_paid');
//                                                    $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
//                                                    $this->db->where(array('fc_student_id'=>$student_id,'fc_ch_status_id'=>2));
//                                                    $this->db->group_by('fc_student_id');
//                         $current_paid_balance  =   $this->db->get('fee_challan')->row();
//                         
//                         
//                         $session_amount = array(
//                           'batch_id'   => $studentRow->batch_id,  
//                           'program_id' => $studentRow->programe_id,  
//                           'sub_pro_id' => $studentRow->sub_pro_id,  
//                         );
//                         $total_session_amount  = $this->CRUDModel->get_where_row('fee_total_anual',$session_amount);
//                         $total_balance         = ($total_session_amount->total_amount)-($current_paid_balance->total_paid);
//                         
//                         
//                      $fee_balance_data = array(
//                          'sub_por_id'      => $sub_pro_name,
//                          'total_r_amount'  => $total_balance
//                        );
//                              
//                    //Update session amount
//                      $this->CRUDModel->update('fee_total_balance',$fee_balance_data,array( 'student_id'=>$student_id));
//                     $total_cat_wise_amount =  $this->CRUDModel->get_where_row('fee_catetory_wise',array('sub_pro_id'=>$sub_pro_name,'pc_id'=>$pc_id));
//                      
//                      
//                    //insert current challan amount 
//                      $cat_amount = array(
//                        'student_id'    => $student_id,  
//                        'r_amount'      => $total_cat_wise_amount->fcw_amount - $paid_amount,  
//                        'pay_cat_id'    => $pc_id,
//                        'timestamp'     => date('Y-m-d H:i:s'),
//                        'userId'         => $userInfo->user_id  
//                      );
//                      $this->CRUDModel->insert('fee_balance',$cat_amount);
//                    
//         
//                     
//  
//               redirect('feeChallanPrintAdmission/'.$challan_id.'/'.$student_id);
//        endif;
//      
//        $this->data['page']         = 'Fee/fee_challan_update_paid';
//        $this->data['page_header']  = 'Update Paid Challan';
//        $this->data['page_title']   = 'Update Paid Challan | ECMS';
//        $this->load->view('common/common',$this->data);
//    }
             public function fee_paid_challan_update(){
     
        $this->data['bank']         = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name',array('bank_id'=>8));
//        $this->data['install_type'] = $this->CRUDModel->dropDown('fee_installment_type','', 'id', 'installment_title');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['batch']      = $this->CRUDModel->dropDown('prospectus_batch', 'Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
        $this->data['pc_array']     = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', ' Payment Type', 'pc_id', 'title');
        $this->data['sub_pro_name'] = $this->CRUDModel->sub_proDropDown('sub_programes', '', 'sub_pro_id', 'name');
        $this->data['update_form']  = 1;
        $this->data['challan_id']   = '';
//        $uri2 = $this->uri->segment(2);
        
        
        if($this->input->post('search')):
            
         $challan_id    = $this->input->post('challan_id');
                          $this->db->select('fee_challan.*,sum(actual_amount) as t_actual_amount,sum(paid_amount) as t_paid_amount,sum(balance) as t_balance');
                          $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');  
         $challan_info  = $this->db->get_where('fee_challan',array('fc_challan_id'=>$challan_id))->row();
         
        if($challan_info->fc_challan_id):
            
            $this->data['challan_info'] = $challan_info;
            $this->data['student_info'] = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$challan_info->fc_student_id)); 
         
            $where = array(
//                'fee_category_titles.inst_type_id'=>2, 
            'fc_challan_id'=>$challan_id,
            'fc_student_id'=>$challan_info->fc_student_id
        );
        $this->data['result'] = $this->FeeModel->full_payment_info($where);
 
            $this->data['update_form'] = 2;
            $this->data['challan_id'] =   $challan_id; 
            else:
                
           $this->data['update_form'] = 1;
         $this->data['challan_id'] =   $challan_id;  
        endif;
        endif;
        
        if($this->input->post('updateChallan')):
            
            ob_start();
            $userInfo           = json_decode(json_encode($this->getUser()), FALSE);
            $program_id         = $this->input->post('program_id');
            $batch_id           = $this->input->post('batch_id');
            $sub_pro_name       = $this->input->post('sub_pro_name');
             $install_type      = $this->input->post('install_type');
            $pc_id              = $this->input->post('pc_array');
            $student_id         = $this->input->post('student_id');
            $fromDate           = $this->input->post("fromDate");
            $dueDate            = $this->input->post("dueDate");
            $issueDate          = $this->input->post("issueDate");
            $uptoDate           = $this->input->post("uptoDate");
            $comment            = $this->input->post("fee_comments");
            $challan_id         = $this->input->post('challan_id');
            $credit_amount      = $this->input->post('credit_amount');
            $old_pc_id          = $this->input->post('old_pc_id');
//            $fc_bank_id         = $this->input->post('bank_id');
//            $fy_id              = $this->input->post('fy_id');
            
            
            $old_challan_details = $this->CRUDModel->get_where_result('fee_actual_challan_detail',array('challan_id'=>$challan_id));
//            echo '<pre>';print_r($old_challan_details);die;
            $old_payment_total = '';
            foreach($old_challan_details as $trans_details):
                $tran_array_data = array(
                    'challan_id'        => $challan_id,
                    'fee_id'            => $trans_details->fee_id,
                    'actual_amount'     => $trans_details->actual_amount,
                    'paid_amount'       => $trans_details->paid_amount,
                    'timestamp'         => date('Y-m-d H:i:s'), 
                    'user_id'           => $userInfo->user_id
                    
                    );
            $old_payment_total+= $trans_details->paid_amount;
            $this->CRUDModel->insert('fee_transfer_challan_detail',$tran_array_data);
            endforeach;
            //delete old challan details
            $this->CRUDModel->deleteid('fee_actual_challan_detail',array('challan_id'=>$challan_id,'add_new_heads_flag'=>1));
            
            //delete current challan balance 
            $this->CRUDModel->deleteid('fee_balance',array('student_id'=>$student_id,'pay_cat_id'=>$old_pc_id));
            
            $update_amount      = $this->input->post('update_amount');
            $update_amount_id   = $this->input->post('update_amount_id');
            $studentRow         = $this->CRUDModel->get_where_row('student_record',array('student_id'=>$student_id));
            $SET_std_recor = array(
                'sub_pro_id'        => $sub_pro_name,
                'programe_id'       => $program_id,
                'batch_id'          => $batch_id,
                'admission_comment' => $comment,
                    );
            
            $this->CRUDModel->update('student_record',$SET_std_recor,array( 'student_id'=>$student_id));
            
             $where_challan = array(
                 'fc_challan_id'=>$challan_id
             );
             
                $data_challan = array(
                    'fc_paid_form'              => date('Y-m-d',strtotime($fromDate)), 
                    'fc_paid_upto'              => date('Y-m-d',strtotime($uptoDate)),
                    'fc_dueDate'                => date('Y-m-d',strtotime($dueDate)), 
                    'fc_Issue_date'             => date('Y-m-d',strtotime($issueDate)), 
                    'fc_comments'               =>$comment,
                    'fc_challan_credit_amount'  =>$credit_amount,
                    'fc_pay_cat_id'             =>$pc_id,
                    'installment_type'          =>$install_type,
                    'up_timestamp'              => date('Y-m-d H:i:s'), 
                    'up_userid'                 => $userInfo->user_id
                    );
           
                    $this->CRUDModel->update('fee_challan',$data_challan,$where_challan);
                            $student_balance    = '';
                            $actual_amount      = '';
                            $paid_amount        = '';
                            $combine            = array_combine($update_amount_id,$update_amount);
                                foreach($combine as $key=>$row):
                                        $where_balace = array(
                                           'pc_id'=>$pc_id,
                                           'fcs_id'=>$key,
                                        );
                            $actual_challan_balance = $this->CRUDModel->get_where_row('fee_class_setups',$where_balace);
                              
                            
                            $datafs = array(
                                 'fee_id'       => $key,
                                'challan_id'    => $challan_id,
                                'actual_amount' => $actual_challan_balance->fcs_amount,
                                'paid_amount'   => $row,
                                'balance'       => $actual_challan_balance->fcs_amount-$row,
                                'challan_status'=> 2,
                                'timestamp'     => date('Y-m-d H:i:s'),
                                'useId'         => $userInfo->user_id
                            );
                            $actual_amount   += $row;
                            $paid_amount     += $row;
                            $student_balance += $row;
                           $this->CRUDModel->insert('fee_actual_challan_detail',$datafs);
                        
                          endforeach;
                         
                          
                          
                          
                          
                                                    $this->db->select('fee_challan.fc_student_id,sum(paid_amount) as total_paid');
                                                    $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                                                    $this->db->where(array('fc_student_id'=>$student_id,'fc_ch_status_id'=>2));
                                                    $this->db->group_by('fc_student_id');
                         $current_paid_balance  =   $this->db->get('fee_challan')->row();
                         
                         
                         $session_amount = array(
                           'batch_id'   => $studentRow->batch_id,  
                           'program_id' => $studentRow->programe_id,  
                           'sub_pro_id' => $studentRow->sub_pro_id,  
                         );
                         $total_session_amount  = $this->CRUDModel->get_where_row('fee_total_anual',$session_amount);
                         $total_balance         = ($total_session_amount->total_amount)-($current_paid_balance->total_paid);
                         
                         
                      $fee_balance_data = array(
                          'sub_por_id'      => $sub_pro_name,
                          'total_r_amount'  => $total_balance
                        );
                              
                    //Update session amount
                      $this->CRUDModel->update('fee_total_balance',$fee_balance_data,array( 'student_id'=>$student_id));
                     $total_cat_wise_amount =  $this->CRUDModel->get_where_row('fee_catetory_wise',array('sub_pro_id'=>$sub_pro_name,'pc_id'=>$pc_id));
                      
                      
                    //insert current challan amount 
                      $cat_amount = array(
                        'student_id'    => $student_id,  
                        'r_amount'      => $total_cat_wise_amount->fcw_amount - $paid_amount,  
                        'pay_cat_id'    => $pc_id,
                        'timestamp'     => date('Y-m-d H:i:s'),
                        'userId'         => $userInfo->user_id  
                      );
                      $this->CRUDModel->insert('fee_balance',$cat_amount);
                    
         
                     
  
               redirect('feeChallanPrintAdmission/'.$challan_id.'/'.$student_id);
        endif;
      
        $this->data['page']         = 'Fee/fee_challan_update_paid';
        $this->data['page_header']  = 'Update Paid Challan';
        $this->data['page_title']   = 'Update Paid Challan | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function fee_challan_update(){
     
        $this->data['bank']         = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name',array('bank_id'=>8));
//        $this->data['install_type'] = $this->CRUDModel->dropDown('fee_installment_type','', 'id', 'installment_title');
         $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['batch']      = $this->CRUDModel->dropDown('prospectus_batch', 'Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
        
        $this->data['pc_array']     = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', ' Payment Type', 'pc_id', 'title');
        $this->data['sub_pro_name'] = $this->CRUDModel->sub_proDropDown('sub_programes', '', 'sub_pro_id', 'name');
        $this->data['update_form']  = 1;
        $this->data['challan_id']   = '';
//        $uri2 = $this->uri->segment(2);
        
        
        if($this->input->post('search')):
            
         $challan_id    = $this->input->post('challan_id');
         $challan_info  = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challan_id));
         
        if($challan_info->fc_challan_id):
            
            $this->data['challan_info'] = $challan_info;
            $this->data['student_info'] = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$challan_info->fc_student_id)); 
         
            $where = array(
//                'fee_category_titles.inst_type_id'=>2, 
            'fc_challan_id'=>$challan_id,
            'fc_student_id'=>$challan_info->fc_student_id
        );
        $this->data['result'] = $this->FeeModel->full_payment_info($where);
        
             
            $this->data['update_form'] = 2;
            $this->data['challan_id'] =   $challan_id; 
            else:
                
           $this->data['update_form'] = 1;
         $this->data['challan_id'] =   $challan_id;  
        endif;
        endif;
        
        if($this->input->post('updateChallan')):
            
            ob_start();
            $userInfo           = json_decode(json_encode($this->getUser()), FALSE);
            $sub_pro_name       = $this->input->post('sub_pro_name');
            $install_type      = $this->input->post('install_type');
            $program_id         = $this->input->post('program_id');
            $batch_id           = $this->input->post('batch_id');
            $pc_id              = $this->input->post('pc_array');
            $student_id         = $this->input->post('student_id');
            $fromDate           = $this->input->post("fromDate");
            $dueDate            = $this->input->post("dueDate");
            $issueDate          = $this->input->post("issueDate");
            $uptoDate           = $this->input->post("uptoDate");
            $comment            = $this->input->post("fee_comments");
            $challan_id         = $this->input->post('challan_id');
//            $fc_bank_id         = $this->input->post('bank_id');
//            $fy_id              = $this->input->post('fy_id');
            
            
            $update_amount      = $this->input->post('update_amount');
            $update_amount_id   = $this->input->post('update_amount_id');
            
        
            $studentRow = $this->CRUDModel->get_where_row('student_record',array('student_id'=>$student_id));
            
            $data_post = array(
                'student_id'=>$student_id,
                's_status_id'=>$studentRow->s_status_id ,
                'date'=>date('Y-d-m'),
                'comment'=>$comment.'Update from Fee Challan Update Page',
                'timestamp'=>date('Y-d-m H:i:s'),
                'user_id'=>$userInfo->user_id
            );	
	$this->CRUDModel->insert('student_status_detail',$data_post);
             $where_challan = array(
                 'fc_challan_id'=>$challan_id
             );
                
                 $data_challan = array(
                   'fc_paid_form'       => date('Y-m-d',strtotime($fromDate)), 
                    'fc_paid_upto'      => date('Y-m-d',strtotime($uptoDate)),
                    'fc_dueDate'        => date('Y-m-d',strtotime($dueDate)), 
                    'fc_Issue_date'     => date('Y-m-d',strtotime($issueDate)), 
                    'fc_comments'       =>$comment,
                    'fc_pay_cat_id'     =>$pc_id,
                    'installment_type'  =>$install_type,
                    'up_timestamp'      => date('Y-m-d H:i:s'), 
                    'up_userid'         => $userInfo->user_id
                    );
                
                $this->CRUDModel->update('fee_challan',$data_challan,$where_challan);
                
                
                      $fee_balance_data = array(
//                            
                            'sub_por_id'=>  $sub_pro_name,
                            
                        );
                      $fee_balance_where = array(
                          'student_id'=>$student_id
                      );
                       $SET_student = array(
                        'programe_id'=>  $program_id,
                        'sub_pro_id'=>  $sub_pro_name,
                        'batch_id'  =>  $batch_id
                         );
                    $this->CRUDModel->update('student_record',$SET_student,$fee_balance_where);
                      
                    $this->CRUDModel->update('fee_total_balance',$fee_balance_data,$fee_balance_where);
                    
                    $this->CRUDModel->deleteid('fee_actual_challan_detail',array('challan_id'=>$challan_id,'add_new_heads_flag'=>1));
                    
                           $student_balance = '';
                            $actual_amount  = '';
                            $paid_amount    = '';
                            $old_balance = '';
                               $combine = array_combine($update_amount_id,$update_amount);
                                
                                foreach($combine as $key=>$row):
                                        
                                    $exp = explode(',',$key);
                                  
                                if(empty($exp[1])):
                                     $old_balance = 0; 
                                      else:
                                      $old_balance =$exp[1];
                                  endif;
                                $datafs = array(
                                 'fee_id'           => $exp[0],
                                'challan_id'        => $challan_id,
                                'actual_amount'     => $row,
                                'paid_amount'       => $row,
                                'old_balance_pc_id' => $old_balance,
                                'balance'           => $row,
                                'challan_status'    =>1,
                                'timestamp'     => date('Y-m-d H:i:s'),
                                'useId'         => $userInfo->user_id
                            );
                            $actual_amount   += $row;
                            $paid_amount     += $row;
                            $student_balance += $row;
                           $this->CRUDModel->insert('fee_actual_challan_detail',$datafs);
                        
                          endforeach;
  
               redirect('feeChallanPrint/'.$challan_id.'/'.$student_id);
        endif;
      
        $this->data['page']         = 'Fee/fee_challan_update';
        $this->data['page_header']  = 'Fee Challan Update';
        $this->data['page_title']   = 'Fee Challan Update | ECMS';
        $this->load->view('common/common',$this->data);
    }
   
public function fee_challan_update_uri(){
     
        $this->data['bank']         = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name',array('bank_id'=>8));
        $this->data['install_type'] = $this->CRUDModel->dropDown('fee_installment_type','', 'id', 'installment_title');
        
         $challan_id = $this->uri->segment(2);
        
        
        if($challan_id):
            
//         $challan_id =    $this->input->post('challan_id');
         
         $challan_info = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challan_id));
        
        if($challan_info):
            
            
        $this->data['student_info'] = $this->FeeModel->fee_challan_student(array('student_record.s_status_id'=>1,'student_record.student_id'=>$challan_info->fc_student_id)); 
 
            $where = array(
 
            'fc_challan_id'=>$challan_id,
            'fc_student_id'=>$challan_info->fc_student_id
        );
            
            
            
        $this->data['result'] = $this->FeeModel->full_payment_info($where);
        
            $this->data['update_form'] = 2;
            $this->data['challan_id'] =   $challan_id; 
            else:
           $this->data['update_form'] = 1;
         $this->data['challan_id'] =   $challan_id;  
        endif;
         
             
            endif;
          
       
         
        if($this->input->post('updateChallan')):
            ob_start();
            $userInfo           = json_decode(json_encode($this->getUser()), FALSE);
            $update_amount      = $this->input->post('update_amount');
            $install_type       = $this->input->post('install_type');
            $pc_id              = $this->input->post('pc_id');
            $student_id         = $this->input->post('student_id');
            $bank_id            = $this->input->post("bank_id");
            $update_amount_id   = $this->input->post('update_amount_id');
            $fromDate           = $this->input->post("fromDate");
            $dueDate            = $this->input->post("dueDate");
            $issueDate          = $this->input->post("issueDate");
            $uptoDate           = $this->input->post("uptoDate");
            $comment            = $this->input->post("fee_comments");
            $challan_id         = $this->input->post('challan_id');
        
            $studentRow = $this->CRUDModel->get_where_row('student_record',array('student_id'=>$student_id));
            
             $where_challan = array(
                 'fc_challan_id'=>$challan_id
             );
                
                 $data_challan = array(
                    
                    'installment_type'  => $install_type, 
                     'fc_comments'       => $comment, 
                    'fc_timestamp'      => date('Y-m-d H:i:s'), 
                    'fc_userId'         => $userInfo->user_id
                    );
                
                $this->CRUDModel->update('fee_challan',$data_challan,$where_challan);
                        $student_balance = '';
                            $actual_amount  = '';
                            $paid_amount    = '';
                               $combine = array_combine($update_amount_id,$update_amount);
                                foreach($combine as $key=>$row):
                                    
//                                $fee_setups_details = $this->CRUDModel->get_where_row('fee_class_setups',array('fcs_id'=>$key));
//                         
                                $where_chall_def = array(
                                    'fee_id'        => $key,
                                    'challan_id'    => $challan_id,
                                );
                                $datafs = array(
                                
                                
                                'actual_amount' => $row,
                                'paid_amount'   => $row,
                                'balance'       => $row,
                                'challan_status'       =>1,
                                'timestamp'     => date('Y-m-d H:i:s'),
                                'useId'         => $userInfo->user_id
                            );
                            $actual_amount   += $row;
                            $paid_amount     += $row;
                            $student_balance += $row;
                          $this->CRUDModel->update('fee_actual_challan_detail',$datafs,$where_chall_def);
                        
                          endforeach;
                     
                          
                        $fee_balance_where  = array(
                            'student_id'    =>$student_id,
                            'pay_cat_id'    =>$pc_id,
                            
                        );
                        $fee_balance_data = array(
                            
                            'r_amount'=>  $actual_amount,
                            'timestamp'     => date('Y-m-d H:i:s'), 
                            'userId'        => $userInfo->user_id
                        );
                    $this->CRUDModel->update('fee_balance',$fee_balance_data,$fee_balance_where);
//                endif;
               redirect('feeChallanPrintAdmission/'.$challan_id.'/'.$student_id);
        endif;
      
        $this->data['page']         = 'Fee/fee_challan_update_uri';
        $this->data['page_header']  = 'Fee Challan Update';
        $this->data['page_title']   = 'Fee Challan Update | ECMS';
        $this->load->view('common/common',$this->data);
    }
        public function search_other_installment(){
       
        $this->data['form_no']      = '';
        $this->data['student_name'] = '';
        $this->data['father_name']  = '';
        $this->data['college_no']  = '';
        if($this->input->post('search')):
            
            $form_no        = $this->input->post('form_no');
            $college_no        = $this->input->post('college_no');
            $student_name   = $this->input->post('student_name');
            $father_name    = $this->input->post('father_name');
            
            $where = '';
            $like= '';
            if($form_no):
                $this->data['form_no']      = $form_no;
                $where['form_no']           = $form_no;
            endif;
            if($college_no):
                $this->data['college_no']      = $college_no;
                $where['college_no']           = $college_no;
            endif;
            if($father_name):
                $this->data['father_name']  = $father_name;
                $like['father_name']        = $father_name;
            endif;
            if($student_name):
                $this->data['student_name'] = $student_name;
                $like['student_name']       = $student_name;
            endif;
           
           $this->data['result'] = $this->FeeModel->search_other_payment($where,$like);
//          echo '<pre>';print_r( $this->data['result'] );die;
        endif;
        
        
        $this->data['page']         = 'Fee/other_installment';
        $this->data['page_header']  = 'Generate Other Instalments ';
        $this->data['page_title']   = 'Generate Other Instalments | ECMS';
        $this->load->view('common/common',$this->data);
        
    }
//    public function search_other_installment(){
//       
//        $this->data['form_no']      = '';
//        $this->data['student_name'] = '';
//        $this->data['father_name']  = '';
//        if($this->input->post('search')):
//            
//            $form_no        = $this->input->post('form_no');
//            $student_name   = $this->input->post('student_name');
//            $father_name    = $this->input->post('father_name');
//            
//            $where = '';
//            $like= '';
//            if($form_no):
//                $this->data['form_no']      = $form_no;
//                $where['form_no']           = $form_no;
//            endif;
//            if($father_name):
//                $this->data['father_name']  = $father_name;
//                $like['father_name']        = $father_name;
//            endif;
//            if($student_name):
//                $this->data['student_name'] = $student_name;
//                $like['student_name']       = $student_name;
//            endif;
//           
//           $this->data['result'] = $this->FeeModel->search_other_payment($where,$like);
////          echo '<pre>';print_r( $this->data['result'] );die;
//        endif;
//        
//        
//        $this->data['page']         = 'Fee/other_installment';
//        $this->data['page_header']  = 'Search Other Installment ';
//        $this->data['page_title']   = 'Search Other Installment | ECMS';
//        $this->load->view('common/common',$this->data);
//        
//    }
      public function generate_other_installment(){
     
        $uri2 = $this->uri->segment(2);
         $this->data['student_info'] = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$uri2));
        $this->data['bank']         = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name');
        $this->data['install_type'] = $this->CRUDModel->dropDown('fee_installment_type','', 'id', 'installment_title');
         
//         echo '<pre>';print_r($this->data['install_type']);die;
        
        $where = array(
            'fee_category_titles.cat_title_id'=>1,
            'fee_payment_category.sub_pro_id'=>$this->data['student_info']->sub_pro_id
        );
        
        if($this->input->post()):
            ob_start();
            $userInfo           = json_decode(json_encode($this->getUser()), FALSE);
//            $update_amount      = $this->input->post('update_amount');
//            $install_type       = $this->input->post('install_type');
            $install_type       = 1;
            $pc_id              = $this->input->post('pc_id');
            $student_id         = $this->input->post('student_id');
            $bank_id            = $this->input->post("bank_id");
//            $update_amount_id   = $this->input->post('update_amount_id');
            $fromDate           = $this->input->post("fromDate");
            $dueDate            = $this->input->post("dueDate");
            $issueDate          = $this->input->post("issueDate");
            $uptoDate           = $this->input->post("uptoDate");
            $comment            = $this->input->post("fee_comments");
            $sub_pro_id         = $this->input->post("sub_pro_id");
         
          
          //******************************************************************************************************            
//********************            FEE CHALLAN CHECKING IF EXIST                       ******************
//******************************************************************************************************
            
            $studentRow = $this->CRUDModel->get_where_row('student_record',array('student_id'=>$student_id));
            $challan_id = $this->CRUDModel->get_where_row('fee_challan',array('fc_student_id'=>$studentRow->student_id,'fc_pay_cat_id'=>$pc_id));
            $fee_challan_exist = $this->CRUDModel->key_exists('fee_challan',array('fc_student_id'=>$studentRow->student_id,'fc_pay_cat_id'=>$pc_id));
            
          //******************************************************************************************************            
//********************            FEE CHALLAN CHECKING IF EXIST                       ******************
//******************************************************************************************************
            
            if(!empty($fee_challan_exist)):
               
               $this->session->set_flashdata('error_payment', 'Challan Already Exist..<a href="feeChallanPrintAdmission/'.$challan_id->fc_challan_id.'/'.$studentRow->student_id.'"><p class="btn btn-danger btn-xs"> Challan Print</p></a>');
                redirect('generateOthrInstll/'.$student_id);
            
                else:
               
                 $total_balanc_an = $this->CRUDModel->get_where_row('fee_total_anual',array('sub_pro_id'=>$studentRow->sub_pro_id));
//******************************************************************************************************            
//********************            CHECKING ANNUAL AMOUNT AGISNT SUB PROGRAM           ******************
//****************************************************************************************************** 
            
                   if(!empty($total_balanc_an)):
            
                    $check_balance =  $this->CRUDModel->get_where_row('fee_total_balance',array('student_id'=>$studentRow->student_id,'batch_id'=>$studentRow->batch_id,'sub_por_id'=>$studentRow->sub_pro_id));
                   
//******************************************************************************************************            
//********************    CHECKING AMOUNT AGISNT STUDENT (FIST PAYMENT OR 2ND PAYMENT) ******************
//******************************************************************************************************                       
                      if(!empty($check_balance)):
//                   
                        $total_balace_update = array(
                            'total_r_amount' => $total_balanc_an->total_amount+$check_balance->total_r_amount,
                            'timestamp'      => date('Y-m-d H:i:s'), 
                            'userId'         => $userInfo->user_id );
                      $this->CRUDModel->update('fee_total_balance',$total_balace_update,array('student_id'=>$studentRow->student_id));
                            else:
                      
                        $total_balance_inset = array(
                            'student_id'     =>$studentRow->student_id,
                            'batch_id'       =>$studentRow->batch_id,
                            'sub_por_id'     =>$studentRow->sub_pro_id,
                            'total_r_amount' =>$total_balanc_an->total_amount,
                            'timestamp'      => date('Y-m-d H:i:s'), 
                            'userId'         => $userInfo->user_id );
                       $this->CRUDModel->insert('fee_total_balance',$total_balance_inset);
                        endif;
                        
                           
                         else:    
                     $this->session->set_flashdata('error_payment', 'Total Annual Amount Not Enter Challan Not Generate');
                     redirect('admissionChallanGent/'.$student_id);
                 endif;
                    $fy_id = $this->db->where('status','1')->get('financial_year')->row();
                    $section = $this->db->get_where('student_group_allotment',array('student_id'=>$student_id))->row();
                    
//                    echo '<pre>';print_r($section);die;
                    $data = array(
                            'fc_student_id'     => $studentRow->student_id,
                            
                            'program_id_paid'   => $studentRow->programe_id,
                            'batch_id_paid'     => $studentRow->batch_id,
                            'sub_pro_id_paid'   => $studentRow->sub_pro_id,
                            'section_id_paid'   => $section->section_id,
                            'fc_ch_status_id'   => 1, //Challan status not paid
                            'fc_paid_form'      => date_format(date_create($fromDate),"Y-m-d"), 
                            'fc_paid_upto'      => date_format(date_create($uptoDate),"Y-m-d"), 
                            'fc_dueDate'        => date_format(date_create($dueDate),"Y-m-d"), 
                            'fc_issue_date'     => date('Y-m-d', strtotime($issueDate)), 
                            'fc_pay_cat_id'     => $pc_id,
                            'challan_id_lock'   => 0,
                            'installment_type'  => $install_type, 
                            'fc_bank_id'        => $bank_id,
                            'financial_id'      => $fy_id->id,
                            'fc_comments'       => $comment, 
                            'fc_timestamp'      => date('Y-m-d H:i:s'), 
                            'fc_userId'         => $userInfo->user_id
                             );
                        //Insert challan info against the student
                        $challan_id = $this->CRUDModel->insert('fee_challan',$data);
                         //Search info about installement detials and insert to fee_challan_detail table
//                       $fee_setups = $this->CRUDModel->get_where_result('fee_class_setups',array('pc_id'=>$pc_id));
                        $fee_setups =     $this->CRUDModel->get_where_result('fee_class_setups',array('pc_id'=>$pc_id,'sub_pro_id'=>$sub_pro_id));
                        $this->RQ($challan_id,'assets/RQ/challan_rq/');
                        $this->CRUDModel->update('fee_challan',array('fc_challan_rq'=>$challan_id.'.png'),array('fc_challan_id'=>$challan_id));
//                        echo '<pre>';print_r($fee_setups);die;
                            
                        
                        //Add old Balance 
                        $old_balance = array(
//                            'fc_student_id'   =>'7096',  
                                'fc_student_id'   =>$studentRow->student_id,  
                                'balance>'        =>0,  
                        );
//                                            $this->db->select('student_name,fee_challan.fc_challan_id,fee_actual_challan_detail.balance,');
                                             $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                        $old_balane_amount = $this->db->get_where('fee_challan',$old_balance)->result();
                      if(!empty($old_balane_amount)):
                    
                        foreach($old_balane_amount as $OLBA):
                            $datafs = array(
                                'challan_id'        => $challan_id,
                                'fee_id'            => $OLBA->fee_id,
                                'actual_amount'     => $OLBA->balance,
                                'paid_amount'       => $OLBA->balance,
                                'balance'           => $OLBA->balance,
                                'old_balance_pc_id' => $OLBA->fc_pay_cat_id,
                                'challan_status'    => 1,
                                'timestamp'         => date('Y-m-d H:i:s'),
                                'useId'             => $userInfo->user_id
                            );
                            $this->CRUDModel->insert('fee_actual_challan_detail',$datafs);
                          
                            // add old challan id into New challan 
                            $this->CRUDModel->update('fee_challan',array('old_balance_challan_id'=>$OLBA->fc_challan_id),array('fc_challan_id'=>$challan_id));
                           //Lock Old challan 
                            $this->CRUDModel->update('fee_challan',array('challan_id_lock'=>1),array('fc_challan_id'=>$OLBA->fc_challan_id));
                          
                            //Remove balance from old challan table
                            $this->CRUDModel->update('fee_actual_challan_detail',array('balance'=>0),array('challan_detail_id'=>$OLBA->challan_detail_id));
                         endforeach;
                       endif;
                            $student_balance = 0;
                            $actual_amount  = '';
                            $paid_amount    = '';
//                               $combine = array_combine($update_amount_id,$update_amount);
                                foreach($fee_setups as $row):
                                    
                                $fee_setups_details = $this->CRUDModel->get_where_row('fee_class_setups',array('fcs_id'=>$key));
                         
                                
                                $datafs = array(
                                'challan_id'    => $challan_id,
                                'fee_id'        => $row->fcs_id,
                                'actual_amount' => $row->fcs_amount,
                                'paid_amount'   => $row->fcs_amount,
                                'balance'       => $row->fcs_amount,
                                'challan_status'=> 1,
                                'timestamp'     => date('Y-m-d H:i:s'),
                                'useId'         => $userInfo->user_id
                            );
                            $actual_amount   += $row->fcs_amount;
                            $paid_amount     += $row->fcs_amount;
                            $student_balance +=$row->fcs_amount;
                          $this->CRUDModel->insert('fee_actual_challan_detail',$datafs);
                          endforeach;
                          //insert Extra Head againt the challan 
                   $fee_setups_heads = $this->CRUDModel->get_where_result('fee_extra_heads',array('student_id'=>$studentRow->student_id,'apply_status'=>1));
                   if($fee_setups_heads):
                      foreach($fee_setups_heads as $fsRow):
                           
                        $fine_setups = array(
                            'fh_Id'            =>$fsRow->fh_id,
                            'fcs_amount'       =>$fsRow->amount,
                            'fcs_timestamp'    => date('Y-m-d H:i:s'), 
                            'fcs_userId'       => $userInfo->user_id
                        );
             
                    $actual_chal_head = $this->CRUDModel->insert('fee_class_setups',$fine_setups);
                                
                    $datafs = array(
                                'challan_id'    => $challan_id,
                                'fee_id'        => $actual_chal_head,
                                'actual_amount' => $fsRow->amount,
                                'paid_amount'   => $fsRow->amount,
                                'balance'       => $fsRow->amount,
                                'challan_status'=> 1,
                                'timestamp'     => date('Y-m-d H:i:s'),
                                'useId'         => $userInfo->user_id
                            );
                           
                          $this->CRUDModel->insert('fee_actual_challan_detail',$datafs);
                       endforeach;
                       
                      $fee_setups_heads = $this->CRUDModel->update('fee_extra_heads',array('apply_status'=>2),array('student_id'=>$studentRow->student_id)); 
                      endif; 
                     
                      $where_fee_balance = array(
                         'challan_id'=>$challan_id  
                       );
                                                      $this->db->select('sum(balance) as balance');  
                                                      $this->db->group_by('challan_id');
                    $challan_installment_balance =    $this->db->get_where('fee_actual_challan_detail',$where_fee_balance)->row();
                       
                    //Insert All Current balance against the Payment Category 
                    //1st Payment,2nd Payments....
                    $student_current_balance = array(
                                'student_id'    => $studentRow->student_id,
                                'pay_cat_id'    => $pc_id,
                                'r_amount'      => $challan_installment_balance ->balance,
                                'timestamp'     => date('Y-m-d H:i:s'),
                                'userId'        => $userInfo->user_id  
                            );
                    $this->CRUDModel->insert('fee_balance',$student_current_balance);   
                       
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
               redirect('feeChallanPrintOthrInstal/'.$challan_id.'/'.$studentRow->student_id);
        endif;
        
//        $this->data['result'] = $this->FeeModel->admission_challan_gen($where);
        $this->data['result'] = $this->FeeModel->admission_challan_gen($where);
        
        $this->data['page']         = 'Fee/other_challan_generate';
        $this->data['page_header']  = 'Generate Other Installment ';
        $this->data['page_title']   = 'Generate Other Installment | ECMS';
        $this->load->view('common/common',$this->data);
    }
         public function fee_challan_other_installments(){
        
            $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$this->uri->segment(3)));
            $this->data['feeComments']  = $this->FeeModel->get_challan_detail(array('fc_challan_id'=>$this->uri->segment(2)));
             $where = array(
                       'fc_student_id '=> $this->data['feeComments'] ->fc_student_id,
                       'fc_paid_form <='=> $this->data['feeComments'] ->fc_paid_form,
//                       'fc_ch_status_id !=' => 1
                   );
     
        $this->data['result']       = $this->FeeModel->feeDetails_head_print($where);
         
        $this->data['page']         = 'Fee/Reports/fee_challan_print_other_installment';
        $this->data['page_header']  = 'Fee Challan Print';
        $this->data['page_title']   = 'Fee Challan Print | ECMS';
        $this->load->view('common/common',$this->data);
    }
    
    public function student_full_details(){
        
        if($this->uri->segment(2)):
            $this->data['studentInfo']          = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$this->uri->segment(2)));  
            $this->data['fee_information']      = $this->FeeModel->student_fee_details($this->uri->segment(2));
            $this->data['hostel_information']   = $this->FeeModel->student_hostel_details($this->uri->segment(2));
            $this->data['mess_information']     = $this->FeeModel->student_mess_details($this->uri->segment(2));
        endif;
        
        
        $this->data['page']         = 'Fee/Reports/student_full_details';
        $this->data['page_header']  = 'Student Information Report';
        $this->data['page_title']   = 'Student Information Report | ECMS';
        $this->load->view('common/common',$this->data);
        
    }
    public function fee_extra_heads(){
        
         
        $this->data['collegeNo']    = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['form_no']      = '';
       
        
        if($this->input->post()):
            
            $collegeNo      = $this->input->post("collegeNo");
           
            $form_no        = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            
             
            $where      = '';
            $like       = '';
          
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
            
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['collegeNo'] = $collegeNo;
            endif;
             
            
            if(!empty($stdName)):
                $like['student_record.student_name'] = $stdName;
                $this->data['stdName']           = $stdName;
            endif;
            if(!empty($fatherName)):
                $like['student_record.father_name'] = $fatherName;
                $this->data['fatherName']           = $fatherName;
            endif;
            
            
       
           
            $this->data['result'] = $this->FeeModel->student_fine_search($where,$like);
            
//               echo '<pre>';print_r( $this->data['result']);die;
        endif;
        $this->data['page']         = 'Fee/extra_heads/fee_extra_heads';
        $this->data['page_header']  = 'Individual Challan';
        $this->data['page_title']   = 'Individual Challan | ECMS';
        $this->load->view('common/common',$this->data);  
    }
    
    public function add_extra_heads(){
        
        
        $student_id = $this->uri->segment(2);
        
         $this->data['studentInfo'] = $this->FeeModel->get_fined_student_info(array('student_record.student_id'=>$student_id));
        $userInfo =  json_decode(json_encode($this->getUser()), FALSE);
         if($this->input->post('add')):
             
             
                $student_id     = $this->input->post('student_id');
                $fee_head_id    = $this->input->post('fee_head_id');
                $amount         = $this->input->post('amount');
                $fine_date      = $this->input->post('fine_date');
                $comment        = $this->input->post('comment');
             
             
            if(empty($amount) && empty($fee_head_id )):
                
                  redirect('feeExtraheads');
                
                else:
                
                
             $data = array(
                'student_id'     =>$student_id,  
                'fh_id'          =>$fee_head_id,  
                'amount'         =>$amount,  
                'apply_status'    =>1,  
                'fine_date'      =>date('Y-m-d',strtotime($fine_date)),  
                'fine_comments'  =>$comment,  
                'user_id'        => $userInfo->user_id,
                'timestamp'      => date('Y-m-d H:i:s')  
             );
             $this->CRUDModel->insert('fee_extra_heads',$data);
 
         endif;
         endif;
         
         
         if($this->input->post('save')):
             
              $userInfo =  json_decode(json_encode($this->getUser()), FALSE);
                $student_id     = $this->input->post('student_id');
                $fee_head_id    = $this->input->post('fee_head_id');
                $amount         = $this->input->post('amount');
                $fine_date      = $this->input->post('fine_date');
                $comment        = $this->input->post('comment');
             
               if(empty($amount) && empty($fee_head_id )):
                    redirect('feeExtraheads');
                 else:
                
             $data = array(
                'student_id'     =>$student_id,  
                'fh_id'          =>$fee_head_id,  
                'amount'         =>$amount,  
                'apply_status'    =>1,  
                'fine_date'      =>date('Y-m-d',strtotime($fine_date)),  
                'fine_comments'  =>$comment,  
                'user_id'        => $userInfo->user_id,
                'timestamp'      => date('Y-m-d H:i:s')  
             );
             $this->CRUDModel->insert('fee_extra_heads',$data); 
             redirect('feeExtraheads');
             endif;
     endif;
      
     
        if($this->input->post('generateChallan')):
            
            
                $student_id     = $this->input->post('student_id');
                $fee_head_id    = $this->input->post('fee_head_id');
                $amount         = $this->input->post('amount');
                $fine_date      = $this->input->post('fine_date');
                $comment        = $this->input->post('comment');
                
                $fy_id = $this->CRUDModel->get_where_row('financial_year',array('status'=>1));
                $studentRow = $this->CRUDModel->get_where_row('student_record',array('student_id'=>$student_id));
                $section    = $this->db->get_where('student_group_allotment',array('student_id'=>$student_id));
               
                $data = array(
                    'fc_student_id'       => $student_id,
                     
                    'program_id_paid'   => $studentRow->programe_id,
                    'batch_id_paid'     => $studentRow->batch_id,
                    'sub_pro_id_paid'   => $studentRow->sub_pro_id,
                    'section_id_paid'   => $section->section_id,
                    'fc_ch_status_id'     => 1, 
                    'fc_paid_form'        => date('Y-m-d'), 
                    'fc_paid_upto'        => date('Y-m-d'), 
                    'fc_dueDate'          => date('Y-m-d'), 
                    'fc_issue_date'       => date('Y-m-d'), 
                    'fc_paiddate'         => date('Y-m-d'), 
                    'financial_id'        => $fy_id->id, 
                    'fc_bank_id'          => 8, 
                    'fc_challan_type'     => 1, 
                    'installment_type'    => 1, 
                    'fc_extra_head_flag'  => 2,
                    'fc_userId'           => $userInfo->user_id,
                    'fc_timestamp'        => date('Y-m-d H:i:s') 
                );
                 
                 $challan_id = $this->CRUDModel->insert('fee_challan',$data);
                         //Search info about installement detials and insert to fee_challan_detail table
                        
                
                  $fee_setups = $this->CRUDModel->get_where_result('fee_extra_heads',array('student_id'=>$student_id,'apply_status'=>1));
                    
                       
                        $this->RQ($challan_id,'assets/RQ/challan_rq/');
                        $this->CRUDModel->update('fee_challan',array('fc_challan_rq'=>$challan_id.'.png'),array('fc_challan_id'=>$challan_id));
        
                        
                       foreach($fee_setups as $fsRow):
                           
                        $fine_setups = array(
                            'fh_Id'            =>$fsRow->fh_id,
                            'fcs_amount'       =>$fsRow->amount,
                            'fcs_timestamp'    => date('Y-m-d H:i:s'), 
                            'fcs_userId'       => $userInfo->user_id
                        );
             
                    $actual_chal_head = $this->CRUDModel->insert('fee_class_setups',$fine_setups);
                                
                    $datafs = array(
                                'challan_id'    => $challan_id,
                                'fee_id'        => $actual_chal_head,
                                'actual_amount' => $fsRow->amount,
                                'paid_amount'   => $fsRow->amount,
                                'balance'       => $fsRow->amount,
                                'challan_status'=> 1,
                                'timestamp'     => date('Y-m-d H:i:s'),
                                'useId'         => $userInfo->user_id
                            );
                           
                          $this->CRUDModel->insert('fee_actual_challan_detail',$datafs);
                       endforeach;
                
              redirect('feeChallanPrint/'.$challan_id.'/'.$student_id);
            
        endif;
     
         $where = array('fee_extra_heads.student_id'=>$student_id);
          $this->data['result'] = $this->FeeModel->student_fine_info($where); 
 
         $this->data['page']         = 'Fee/extra_heads/add_extra_heads';
        $this->data['page_header']  = 'Add Student Fine';
        $this->data['page_title']   = 'Add Student Fine | ECMS';
        $this->load->view('common/common',$this->data);  
        
    }
    
        public function add_extra_head_insert(){
         
                $student_id     = $this->input->post('student_id');
                $fee_head_id    = $this->input->post('fee_head');
                $amount         = $this->input->post('amount');
                $fine_date      = $this->input->post('fine_date');
                $comment        = $this->input->post('comment');
             
             
          $userInfo =  json_decode(json_encode($this->getUser()), FALSE);  
                
                
             $data = array(
                'student_id'     =>$student_id,  
                'fh_id'          =>$fee_head_id,  
                'amount'         =>$amount,  
                'apply_status'    =>1,  
                'fine_date'      =>date('Y-m-d',strtotime($fine_date)),  
                'fine_comments'  =>$comment,  
                'user_id'        => $userInfo->user_id,
                'timestamp'      => date('Y-m-d H:i:s')  
             );
             $this->CRUDModel->insert('fee_extra_heads',$data);
 
         
    }
   public function view_extra_heads(){
      
        $student_id                 = $this->uri->segment(2);
        $this->data['studentInfo']  = $this->FeeModel->get_fined_student_info(array('student_record.student_id'=>$student_id));  
        
       
        $where = array('fee_extra_heads.student_id'=>$student_id);
        $this->data['result'] = $this->FeeModel->student_fine_info($where); 
 
         $this->data['page']         = 'Fee/extra_heads/View_extra_heads';
        $this->data['page_header']  = 'View Extra Heads';
        $this->data['page_title']   = 'View Extra Heads | ECMS';
        $this->load->view('common/common',$this->data); 
       
       
   } 
   public function update_extra_heads(){
       
       $userInfo        = json_decode(json_encode($this->getUser()), FALSE);
        $student_id     = $this->uri->segment(2);
        $fee_id         = $this->uri->segment(3);
        
        $this->data['studentInfo']  = $this->FeeModel->get_fined_student_info(array('student_record.student_id'=>$student_id));  
      
        $wherePrg = array(
            'id' => 3,
        );
        
        $this->data['fee_extra_heads']= $this->CRUDModel->dropDown('fee_extra_heads_status', 'Select Status', 'id', 'fine_title',$wherePrg);  
         
        $where = array(
            'fee_extra_heads.student_id'=>$student_id,
            'fee_extra_heads.id'=>$fee_id
                );
          
        $this->data['result'] = $this->FeeModel->student_fine_info($where); 
   
        if($this->input->post()):
            
            $fine_id        = $this->input->post('fine_id');
            $student_id     = $this->input->post('student_id');
            $status_id      = $this->input->post('apply_status');
            
            
            $where = array(
              'id'=>  $fine_id,
              'student_id'=>  $student_id,
            );
            
            $data = array(
              'apply_status'  =>$status_id
            );
            
            $this->CRUDModel->update('fee_extra_heads',$data,$where);
            redirect('feeExtraheads');
        endif;
         $this->data['page']         = 'Fee/extra_heads/update_extra_heads';
        $this->data['page_header']  = 'Update Student Fine';
        $this->data['page_title']   = 'Update Student Fine | ECMS';
        $this->load->view('common/common',$this->data); 
       
       
   } 
    public function fee_cancel_challan(){
     
        $this->data['bank']         = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name',array('bank_id'=>8));
//        $this->data['install_type'] = $this->CRUDModel->dropDown('fee_installment_type','', 'id', 'installment_title');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        
       
        $this->data['update_form']  = 1;
        $this->data['challan_id']   = '';
//        $uri2 = $this->uri->segment(2);
        
        
        if($this->input->post('search')):
            
         $challan_id    = $this->input->post('challan_id');
         $challan_info  = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challan_id));
         
        if($challan_info->fc_challan_id):
            
            $this->data['challan_info'] = $challan_info;
            $this->data['student_info'] = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$challan_info->fc_student_id)); 
         
            $where = array(
//                'fee_category_titles.inst_type_id'=>2, 
            'fc_challan_id'=>$challan_id,
            'fc_student_id'=>$challan_info->fc_student_id
        );
        $this->data['result'] = $this->FeeModel->full_payment_info($where);
        
             
            $this->data['update_form'] = 2;
            $this->data['challan_id'] =   $challan_id; 
            else:
                
           $this->data['update_form'] = 1;
         $this->data['challan_id'] =   $challan_id;  
        endif;
        endif;
        
        if($this->input->post('updateChallan')):
            
            ob_start();
            $userInfo           = json_decode(json_encode($this->getUser()), FALSE);
            
            $challan_id         = $this->input->post('challan_id');
            $cancel_date        = $this->input->post("cancel_date");
            $comment            = $this->input->post("fee_comments");
            $student_id            = $this->input->post("student_id");
            // Cancel Challan Data 
            $cancel_data = array(
                'challan_id'    => $challan_id,
                'cancel_date'   => date('Y-m-d', strtotime($cancel_date)),
                'student_id'      => $student_id,
                'comments'      => $comment,
                'timestamp'     => date('Y-m-d H:i:s'),
                'userId'        => $userInfo->user_id
            );
            
           $cancel_id =  $this->CRUDModel->insert('fee_cancel_challan',$cancel_data);
        
             
            $challan_info    = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challan_id));
            $challan_details = $this->CRUDModel->get_where_result('fee_actual_challan_detail',array('challan_id'=>$challan_id));
            
            // Cancel Challan Detail
            $actual_amount = '';
            foreach($challan_details as $row):
                $detail = array(
                    'cancel_id'     => $cancel_id,
                    'fee_id'        => $row->fee_id,
                    'actual_amount' => $row->actual_amount,
                    'paid_amount'   => $row->paid_amount,
                    'balance'       => $row->balance,
                    'comment'      => $row->comment,
                    'timestamp'     => date('Y-m-d H:i:s'),
                    'userId'        => $userInfo->user_id
                    
                );
            $actual_amount +=$row->actual_amount;
              $this->CRUDModel->insert('fee_cancel_challan_details',$detail);
            endforeach;
            
            //Challan history
                $history_data = array(
                'challan_id'    => $challan_id,
                'student_id'    => $challan_info->fc_student_id,
                'ch_status_id'  => 4,
                'date'          => date('Y-m-d', strtotime($cancel_date)),
                'comments'      => $comment,
                'timestamp'     => date('Y-m-d H:i:s'),
                'userId'        => $userInfo->user_id
            );
            
            $this->CRUDModel->insert('fee_challan_history',$history_data);
            
            //Delete from Fee Challan 
            $this->CRUDModel->deleteid('fee_challan',array('fc_challan_id'=>$challan_id));
            //Delete from Fee Challan 
            $this->CRUDModel->deleteid('fee_actual_challan_detail',array('challan_id'=>$challan_id));
            //Delete from Challan Balance 
            $this->CRUDModel->deleteid('fee_balance',array('student_id'=>$challan_info->fc_student_id,'pay_cat_id'=>$challan_info->fc_pay_cat_id));
            
            $payment_cat = $this->CRUDModel->get_where_row('fee_payment_category',array('pc_id'=>$challan_info->fc_pay_cat_id));
            //Check if payment type 1st installment then delete
            if($payment_cat->cat_title_id == 1):
               //Delete from Challan Balance 
            $this->CRUDModel->deleteid('fee_total_balance',array('student_id'=>$challan_info->fc_student_id));
            endif;
         endif;
      
        $this->data['page']         = 'Fee/fee_cancel_challan';
        $this->data['page_header']  = 'Fee Cancel Challan';
        $this->data['page_title']   = 'Fee Cancel Challan | ECMS';
        $this->load->view('common/common',$this->data);
    }
  public function fee_defaulter(){
        
        $this->data['sub_program']      = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']          = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['pc']               = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', 'Payment Category', 'pc_id', 'title');
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
        $this->data['student_status_id']= '5';
        $this->data['form_no']          = '';
        $this->data['challan_no']       = '';
        $this->data['amount']           = 0;
        $this->data['rType_id']         = '';
        
        
        if($this->input->post()):
            
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
            $to             = $this->input->post("to");
            $reprot_type_name    = $this->input->post("reprot_type_name");
 
        
            
            if($reprot_type_name):
                 
                $this->data['rType_id']   = $reprot_type_name;
            endif;
            
//            $where['sections.status']       = 'On';
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
            
            if($amount):
                $this->data['amount'] = $amount;
            endif;
            if($reprot_type_name == 1):
                $this->data['result'] = $this->FeeModel->full_defaulter($where,$amount,$like);
            endif;
            
            if($reprot_type_name == 2):
                if($amount):
                $this->data['amount'] = $amount;
            endif;
                 $this->data['result'] = $this->FeeModel->Feedefaulter($where,$amount,$like);
            endif;
            if($reprot_type_name == 3):
                if($amount):
                $this->data['amount'] = $amount;
                endif;
                $this->data['result'] = $this->FeeModel->hostel_and_mess_defaulter($where,$amount,$like);
            endif;
            if($reprot_type_name == 4):
                
                if($amount):
                $this->data['amount'] = $amount;
                endif;;
                $this->data['result'] = $this->FeeModel->hostel_defaulter($where,$whereAmount,$like);
            endif;
            if($reprot_type_name == 5):
                if($amount):
                $this->data['amount'] = $amount;
                endif;
                $this->data['result'] = $this->FeeModel->mess_defaulter($where,$whereAmount,$like);
            endif;
              
        endif;
        
        $this->data['page']         = 'Fee/Reports/fee_defaulter';
        $this->data['page_header']  = 'Fee Defaulter';
        $this->data['page_title']   = 'Fee Defaulter | ECMS';
        $this->load->view('common/common',$this->data);
    }
public function fee_cancel_challan_uri(){
     
        $this->data['bank']         = $this->DropdownModel->bank_dropDown('bank','', 'bank_id', 'name',array('bank_id'=>8));
//        $this->data['install_type'] = $this->CRUDModel->dropDown('fee_installment_type','', 'id', 'installment_title');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        
       
        $this->data['update_form']  = 1;
        $this->data['challan_id']   = '';
//        $uri2 = $this->uri->segment(2);
        
        
//        if($this->input->post('search')):
             
         $challan_id    = $this->uri->segment(2);
         $challan_info  = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challan_id));
         
        if($challan_info->fc_challan_id):
            
            $this->data['challan_info'] = $challan_info;
            $this->data['student_info'] = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$challan_info->fc_student_id)); 
         
            $where = array(
//                'fee_category_titles.inst_type_id'=>2, 
            'fc_challan_id'=>$challan_id,
            'fc_student_id'=>$challan_info->fc_student_id
        );
        $this->data['result'] = $this->FeeModel->full_payment_info($where);
        
             
            $this->data['update_form'] = 2;
            $this->data['challan_id'] =   $challan_id; 
            else:
                
           $this->data['update_form'] = 1;
         $this->data['challan_id'] =   $challan_id;  
        endif;
      
        
        if($this->input->post('updateChallan')):
            
            ob_start();
            $userInfo           = json_decode(json_encode($this->getUser()), FALSE);
            
            $challan_id         = $this->input->post('challan_id');
            $cancel_date        = $this->input->post("cancel_date");
            $student_id         = $this->input->post('student_id');
            $comment            = $this->input->post("fee_comments");
            

            
        // Cancel Challan Data 
            $cancel_data = array(
                'challan_id'    => $challan_id,
                'student_id'    => $student_id,
                'cancel_date'   => date('Y-m-d', strtotime($cancel_date)),
                'comments'      => $comment,
                'timestamp'     => date('Y-m-d H:i:s'),
                'userId'        => $userInfo->user_id
            );
            
           $cancel_id =  $this->CRUDModel->insert('fee_cancel_challan',$cancel_data);
        
             
            $challan_info    = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challan_id));
            $challan_details = $this->CRUDModel->get_where_result('fee_actual_challan_detail',array('challan_id'=>$challan_id));
            
            // Cancel Challan Detail
            $actual_amount = '';
            foreach($challan_details as $row):
                $detail = array(
                    'cancel_id'     => $cancel_id,
                    'fee_id'        => $row->fee_id,
                    'actual_amount' => $row->actual_amount,
                    'paid_amount'   => $row->paid_amount,
                    'balance'       => $row->balance,
                    'comment'      => $row->comment,
                    'timestamp'     => date('Y-m-d H:i:s'),
                    'userId'        => $userInfo->user_id
                    
                );
            $actual_amount +=$row->actual_amount;
              $this->CRUDModel->insert('fee_cancel_challan_details',$detail);
            endforeach;
            
            //Challan history
                $history_data = array(
                'challan_id'    => $challan_id,
                'student_id'    => $challan_info->fc_student_id,
                'ch_status_id'  => 4,
                'date'          => date('Y-m-d', strtotime($cancel_date)),
                'comments'      => $comment,
                'timestamp'     => date('Y-m-d H:i:s'),
                'userId'        => $userInfo->user_id
            );
            
            $this->CRUDModel->insert('fee_challan_history',$history_data);
            
            //Delete from Fee Challan 
            $this->CRUDModel->deleteid('fee_challan',array('fc_challan_id'=>$challan_id));
            //Delete from Fee Challan 
            $this->CRUDModel->deleteid('fee_actual_challan_detail',array('challan_id'=>$challan_id));
            //Delete from Challan Balance 
            $this->CRUDModel->deleteid('fee_balance',array('student_id'=>$challan_info->fc_student_id,'pay_cat_id'=>$challan_info->fc_pay_cat_id));
            
            $payment_cat = $this->CRUDModel->get_where_row('fee_payment_category',array('pc_id'=>$challan_info->fc_pay_cat_id));
            //Check if payment type 1st installment then delete
            if($payment_cat->cat_title_id == 1):
               //Delete from Challan Balance 
            $this->CRUDModel->deleteid('fee_total_balance',array('student_id'=>$challan_info->fc_student_id));
            endif;
            redirect('feeChallanSearch');
        endif;
      
        $this->data['page']         = 'Fee/fee_cancel_challan';
        $this->data['page_header']  = 'Fee Cancel Challan';
        $this->data['page_title']   = 'Fee Cancel Challan | ECMS';
        $this->load->view('common/common',$this->data);
    }    
 public function change_balance(){
     
            $where['programe_id'] = '1';
//            $where['sub_pro_id'] = '';    
            
     
                $this->db->select(
                        'credit,
                        fc_ch_status_id,
                        fc_ch_status_id,
                        fc_challan_id,
                        fc_student_id,
                        fc_pay_cat_id,
                        fc_challan_type
                        fc_userId,
                        fc_timestamp');    
                  $this->db->join('student_record','student_record.student_id=fee_challan.fc_student_id');  
        $record = $this->db->get_where('fee_challan',$where)->result();
      
//      echo '<pre>';print_r($record);die;
      foreach($record as $row):
          ob_start(); 
           
                           $this->db->select('sum(actual_amount) as all_amount'); 
                           
          $actual_amount = $this->db->get_where('fee_actual_challan_detail',array('challan_id'=>$row->fc_challan_id))->row();
          
        
          $total_amount = $actual_amount->all_amount;
         
          
         //if paid  
          if($row->fc_ch_status_id == 2):
              
                            $this->db->select('sum(paid_amount) as paid_amount'); 
                          
          $paidAmount = $this->db->get_where('fee_actual_challan_detail',array('challan_id'=>$row->fc_challan_id))->row();
             
            $total_amount -=$paidAmount->paid_amount;  
              
          endif;
      
          $where = array(
              'student_id'=>$row->fc_student_id,
              'pay_cat_id'=>$row->fc_pay_cat_id,
          );
         $check =  $this->db->get_where('fee_balance22',$where)->row();
          
         if(empty($check)):
             
             $insert_data = array(
                'student_id'    => $row->fc_student_id,
                'pay_cat_id'    => $row->fc_pay_cat_id,
                'r_amount'      => $total_amount+$row->credit,
                'timestamp'     => $row->fc_timestamp,
                'userId'        => $row->fc_userId,
             );
             
             $this->CRUDModel->insert('fee_balance22',$insert_data);
             
             else:
             
                 $insert_data = array(
                 
                'pay_cat_id'    => $row->fc_pay_cat_id,
                'r_amount'      => $total_amount,
             );
             
             
                 $where_new = array(
                'student_id'    => $row->fc_student_id,
               
             );
             
             $this->CRUDModel->update('fee_balance22',$insert_data,$where_new);
                 
         endif;
         ob_clean();
       endforeach;
       
  }
  
  public function challan_comment_update(){
       
      $comment    = $this->input->post('comment');
      $challan_id = $this->input->post('challan_id');
      $this->CRUDModel->update('fee_challan',array('fc_comments'=>$comment),array('fc_challan_id'=>$challan_id));
  }
  
     public function un_paid_challan(){
      
      if($this->uri->segment(2)):
            
         $challan_id    = $this->uri->segment(2);
         $challan_info  = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challan_id));
         
         $this->data['student_info'] = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$challan_info->fc_student_id)); 
         
         $this->data['program']         = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('programe_id'=>$this->data['student_info']->programe_id));
         $this->data['batch']           = $this->CRUDModel->dropDown('prospectus_batch', '', 'batch_id', 'batch_name',array('status'=>'on','batch_id'=>$this->data['student_info']->batch_id));
         $this->data['sub_pro_name']    = $this->CRUDModel->sub_proDropDown('sub_programes', '', 'sub_pro_id', 'name',array('sub_pro_id'=>$this->data['student_info']->sub_pro_id));
         $this->data['pc_array']        = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', '', 'pc_id', 'title',array('pc_id'=>$challan_info->fc_pay_cat_id));
         $this->data['challan_id']      = $challan_id;
         
        if($challan_info->fc_challan_id):
            
            $this->data['challan_info'] = $challan_info;
            $this->data['student_info'] = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$challan_info->fc_student_id)); 
         
            $where = array(
                'fc_challan_id'=>$challan_id,
                'fc_student_id'=>$challan_info->fc_student_id
            );
        $this->data['result'] = $this->FeeModel->full_payment_info($where);
       
        endif;
        
        endif;
        if($this->input->post('updateChallan')):
            
           
            $sub_pro_name       = $this->input->post('sub_pro_name');
            $install_type       = $this->input->post('install_type');
            $pc_id              = $this->input->post('payment_category_id');
            $program_id         = $this->input->post('program_id');
            $batch_id           = $this->input->post('batch_id');
             
            $student_id         = $this->input->post('student_id');
            $fromDate           = $this->input->post("fromDate");
            $dueDate            = $this->input->post("dueDate");
            $issueDate          = $this->input->post("issueDate");
            $uptoDate           = $this->input->post("uptoDate");
            $comment            = $this->input->post("fee_comments");
            $challan_id         = $this->input->post('challan_id');
 
            
              $challan_info =   $this->db->get_where('fee_actual_challan_detail',array('challan_id'=>$challan_id))->result();
             
            $fee_challan_log = $this->db->get_where('fee_challan',array('fc_challan_id'=>$challan_id))->row();
             
              $insert_olg = array(
                "fc_challan_id"             => $fee_challan_log->fc_challan_id,
                "fc_student_id"             => $fee_challan_log->fc_student_id,
                "fc_ch_status_id"           => $fee_challan_log->fc_ch_status_id,
                "fc_paid_form"              => $fee_challan_log->fc_paid_form,
                "fc_paid_upto"              => $fee_challan_log->fc_paid_upto,
                "fc_dueDate"                => $fee_challan_log->fc_dueDate,
                "fc_issue_date"             => $fee_challan_log->fc_issue_date,
                "fc_paiddate"               => $fee_challan_log->fc_paiddate,
                "fc_pay_cat_id"             => $fee_challan_log->fc_pay_cat_id,
                "fc_challan_credit_amount"  => $fee_challan_log->fc_challan_credit_amount,
                "credit_flag"               => $fee_challan_log->credit_flag,
                "credit_date"               => $fee_challan_log->credit_date,
                "credit"                    => $fee_challan_log->credit_date,
                "financial_id"              => $fee_challan_log->financial_id,
                "fc_bank_id"                => $fee_challan_log->fc_bank_id,
                "fc_challan_rq"             => $fee_challan_log->fc_challan_rq,
                "fc_challan_type"           => $fee_challan_log->fc_challan_type,
                "installment_type"          => $fee_challan_log->installment_type,
                "fc_edit_challan_id"        => $fee_challan_log->fc_edit_challan_id,
                "old_balance_challan_id"    => $fee_challan_log->old_balance_challan_id,
                "challan_id_lock"           => $fee_challan_log->challan_id_lock,
                "fc_balance_chall_flag"     => $fee_challan_log->fc_balance_chall_flag,
                "fc_extra_head_flag"        => $fee_challan_log->fc_extra_head_flag,
                "fc_comments"               => $fee_challan_log->fc_comments,
                "program_id_paid"           => $fee_challan_log->program_id_paid,
                "batch_id_paid"             => $fee_challan_log->batch_id_paid,
                "sub_pro_id_paid"           => $fee_challan_log->sub_pro_id_paid,
                "section_id_paid"           => $fee_challan_log->section_id_paid,
                "fc_timestamp"              => $fee_challan_log->fc_timestamp,
                "fc_userId"                 => $fee_challan_log->fc_userId,
                "up_userid"                 => $fee_challan_log->up_userid,
                "up_timestamp"              => $fee_challan_log->up_timestamp,
                'unpaid_date'               => date('Y-m-d H:i:s'), 
                'unpaid_by'                 => $this->userInfo->user_id
              );
              
              $this->CRUDModel->insert('fee_challan_upaid',$insert_olg);
             
              
              
              
                //update fee challan update
                $where_challan = array(
                     'fc_challan_id'    =>$challan_id
                 );
                
                $data_challan = array(
                        'fc_comments'       => $comment,
                        'fc_ch_status_id'   => 1,
                        'up_timestamp'      => date('Y-m-d H:i:s'), 
                        'up_userid'         => $this->userInfo->user_id
                    );
                
                $this->CRUDModel->update('fee_challan',$data_challan,$where_challan);
                $insert_data = array(
                    'challan_id'    => $challan_id,
                    'student_id'    => $student_id,
                    'ch_status_id'  => 1,
                    'date'          => date('Y-d-m'),
                    'timestamp'     => date('Y-m-d H:i:s'), 
                    'userId'        => $this->userInfo->user_id
                );
                $this->CRUDModel->insert('fee_challan_history',$insert_data);  
                
                //change challan status to unpaid
            
              $row      = '';
              $SET      = '';
              $WHERE    = '';
              $BALANCE  = '';
              
              //UN paid balance 
              foreach($challan_info as $row):
                $SET = array(
                        'challan_status'    => 1,
                        'balance'           => $row->actual_amount,
                    
                  );
                $WHERE = array(
                        'challan_id'            => $challan_id,  
                        'challan_detail_id'     => $row->challan_detail_id  
                  );
                $this->CRUDModel->update('fee_actual_challan_detail',$SET,$WHERE);  
                $BALANCE += $row->paid_amount;
              endforeach;
              
              
            //Update Balance in fee_balance  
            $sum_balance    = '';
            $balance        = $this->db->get_where('fee_balance',array('student_id'=>$student_id,'pay_cat_id'=>$pc_id))->row();
            $sum_balance    = $balance->r_amount + $BALANCE;
              $WHERE_balance = array(
                 'student_id'   => $student_id,
                 'pay_cat_id'   => $pc_id
              );
              $SET_balance = array(
                  'r_amount'=>$sum_balance
              );
             $this->CRUDModel->update('fee_balance',$SET_balance,$WHERE_balance);
                   
//            *******************************************************************
//            // Update unpaid challans 
//            *******************************************************************
              
             $other_ch  = array(
                 'fc_student_id'        => $student_id,
                 'fc_challan_id !='    => $challan_id,
                 'fc_challan_id >'     => $challan_id,
 
             );
                              $this->db->order_by('fc_challan_id','asc');  
           $other_challans =  $this->db->get_where('fee_challan',$other_ch)->result();
 
           foreach($other_challans as $challan_ba):
              
               $pc_id = '';
           if(empty($challan_ba->fc_pay_cat_id)):
               $pcs_id = '25';
               else:
               $pcs_id = $challan_ba->fc_pay_cat_id;
           endif;
               
               if($challan_ba->fc_ch_status_id == 1):
                   $greater_challan_balance = '';
                   foreach($challan_info as $cur_chal):
                    
                   $data_log = array(
                        'challan_id'          => $challan_ba->fc_challan_id,  
                        'fee_id'              => $cur_chal->fee_id,  
                        'actual_amount'       => $cur_chal->actual_amount,  
                        'paid_amount'         => $cur_chal->paid_amount,  
                        'balance'             => $cur_chal->balance,  
                        'challan_status'      => $cur_chal->challan_status,  
                        'add_new_heads_flag'  => $cur_chal->add_new_heads_flag,  
                        'old_balance_pc_id'   => $pcs_id,  
                        'comment'             => $cur_chal->comment,  
                        'useId'               => $cur_chal->useId,  
                        'timestamp'           => $cur_chal->timestamp,  
                        'up_timestamp'        => $cur_chal->up_timestamp,  
                        'up_userId'           => $cur_chal->up_userId,  
                        'up_userId'           => $cur_chal->up_userId,  
                           
                      );
                   $greater_challan_balance += $cur_chal->paid_amount;
                    $this->CRUDModel->insert('fee_actual_challan_detail',$data_log); 
                   
                     
                      
                     endforeach;
                    
                     $balance        =  $this->db->get_where('fee_balance',array('student_id'=>$student_id,'pay_cat_id'=>$challan_ba->fc_pay_cat_id))->row();
                    
                     
                     $sum_balance    = $balance->r_amount + $greater_challan_balance;
                    $WHERE_balance = array(
                       'student_id'   => $student_id,
                       'pay_cat_id'   => $challan_ba->fc_pay_cat_id
                    );
                    $SET_balance = array(
                        'r_amount'=>$sum_balance
                    );
                   $this->CRUDModel->update('fee_balance',$SET_balance,$WHERE_balance);

                     
                     
                   else:
                  break;
                   
                   
               endif;
               
           endforeach;
            
            
             
             
             
             
             
        
             
               redirect('feeChallanSearch');
        endif;
      
        $this->data['page']         = 'Fee/fee_challan_paid_to_unpaid';
        $this->data['page_header']  = 'Fee Challan UnPaid';
        $this->data['page_title']   = 'Fee Challan UnPaid | ECMS';
        $this->load->view('common/common',$this->data);
      
      
  }
  
//   public function un_paid_challan(){
//      
//      if($this->uri->segment(2)):
//            
//         $challan_id    = $this->uri->segment(2);
//         $challan_info  = $this->CRUDModel->get_where_row('fee_challan',array('fc_challan_id'=>$challan_id));
//         
//         $this->data['student_info'] = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$challan_info->fc_student_id)); 
//         
//         $this->data['program']         = $this->CRUDModel->dropDown('programes_info', '', 'programe_id', 'programe_name',array('programe_id'=>$this->data['student_info']->programe_id));
//         $this->data['batch']           = $this->CRUDModel->dropDown('prospectus_batch', '', 'batch_id', 'batch_name',array('status'=>'on','batch_id'=>$this->data['student_info']->batch_id));
//         $this->data['sub_pro_name']    = $this->CRUDModel->sub_proDropDown('sub_programes', '', 'sub_pro_id', 'name',array('sub_pro_id'=>$this->data['student_info']->sub_pro_id));
//         $this->data['pc_array']        = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', '', 'pc_id', 'title',array('pc_id'=>$challan_info->fc_pay_cat_id));
//         $this->data['challan_id']      = $challan_id;
//         
//        if($challan_info->fc_challan_id):
//            
//            $this->data['challan_info'] = $challan_info;
//            $this->data['student_info'] = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$challan_info->fc_student_id)); 
//         
//            $where = array(
//                'fc_challan_id'=>$challan_id,
//                'fc_student_id'=>$challan_info->fc_student_id
//            );
//        $this->data['result'] = $this->FeeModel->full_payment_info($where);
//       
//        endif;
//        
//        endif;
//        if($this->input->post('updateChallan')):
//            
//           
//            $sub_pro_name       = $this->input->post('sub_pro_name');
//            $install_type       = $this->input->post('install_type');
//            $pc_id       = $this->input->post('payment_category_id');
//            $program_id         = $this->input->post('program_id');
//            $batch_id           = $this->input->post('batch_id');
//             
//            $student_id         = $this->input->post('student_id');
//            $fromDate           = $this->input->post("fromDate");
//            $dueDate            = $this->input->post("dueDate");
//            $issueDate          = $this->input->post("issueDate");
//            $uptoDate           = $this->input->post("uptoDate");
//            $comment            = $this->input->post("fee_comments");
//            $challan_id         = $this->input->post('challan_id');
// 
//            
//            
//                //update fee challan update
//                $where_challan = array(
//                     'fc_challan_id'    =>$challan_id
//                 );
//                
//                $data_challan = array(
//                        'fc_comments'       => $comment,
//                        'fc_ch_status_id'   => 1,
//                        'up_timestamp'      => date('Y-m-d H:i:s'), 
//                        'up_userid'         => $this->userInfo->user_id
//                    );
//                
//                $this->CRUDModel->update('fee_challan',$data_challan,$where_challan);
//                $insert_data = array(
//                    'challan_id'    => $challan_id,
//                    'student_id'    => $student_id,
//                    'ch_status_id'  => 1,
//                    'date'          => date('Y-d-m'),
//                    'timestamp'     => date('Y-m-d H:i:s'), 
//                    'userId'        => $this->userInfo->user_id
//                );
//                $this->CRUDModel->insert('fee_challan_history',$insert_data);  
//                
//                //change challan status to unpaid
//              $challan_info =   $this->db->get_where('fee_actual_challan_detail',array('challan_id'=>$challan_id))->result();
//              $row      = '';
//              $SET      = '';
//              $WHERE    = '';
//              $BALANCE  = '';
//              
//              //UN paid balance 
//              foreach($challan_info as $row):
//                $SET = array(
//                        'challan_status'    => 1,
//                        'balance'           => $row->paid_amount,
//                    
//                  );
//                $WHERE = array(
//                        'challan_id'=>$challan_id  
//                  );
//                $this->CRUDModel->update('fee_actual_challan_detail',$SET,$WHERE);  
//                $BALANCE += $row->paid_amount;
//              endforeach;
//              
//              
//            //Update Balance in fee_balance  
//              
//            $sum_balance    = '';
//            $balance        =  $this->db->get_where('fee_balance',array('student_id'=>$student_id,'pay_cat_id'=>$pc_id))->row();
//            
//            $sum_balance    = $balance->r_amount + $BALANCE;
//              $WHERE_balance = array(
//                 'student_id'   => $student_id,
//                 'pay_cat_id'   => $pc_id
//              );
//              $SET_balance = array(
//                  'r_amount'=>$sum_balance
//              );
//             $this->CRUDModel->update('fee_balance',$SET_balance,$WHERE_balance);
//               redirect('feeChallanSearch');
//        endif;
//      
//        $this->data['page']         = 'Fee/fee_challan_paid_to_unpaid';
//        $this->data['page_header']  = 'Fee Challan UnPaid';
//        $this->data['page_title']   = 'Fee Challan UnPaid | ECMS';
//        $this->load->view('common/common',$this->data);
//      
//      
//  }
  
   public function add_heads_view(){
        
        
        if($this->input->post()):
            
            
            $formCode   = $this->input->post('form_code');
            $last_date  = $this->input->post('last_date');
            
            $where_extra_new = array(
               'user_id'        => $this->userInfo->user_id,  
               'form_code'      => $formCode,  
            );
            
             $students_ids = $this->db->get_where('fee_add_new_heads_std_demo',$where_extra_new)->result();
             $fy = $this->db->get_where('fee_financial_year',array('status'=>1))->row();
               
             if($students_ids):
                 foreach($students_ids as $stdRow):
                 
                 
                 $studentRow    = $this->CRUDModel->get_where_row('student_record',array('student_id'=>$stdRow->student_id));
                 $section       = $this->db->get_where('student_group_allotment',array('student_id'=>$stdRow->student_id))->row();
             
                 
                 //Insert challan info against the student
                   $data = array(
                    'fc_student_id'     => $stdRow->student_id,
                    'program_id_paid'   => $studentRow->programe_id,
                    'batch_id_paid'     => $studentRow->batch_id,
                    'sub_pro_id_paid'   => $studentRow->sub_pro_id,
                    'section_id_paid'   => $section->section_id,
                    'fc_ch_status_id'   => 1, //Challan status not paid
                    'fc_paid_form'      => date_format(date_create($last_date),"Y-m-d"), 
                    'fc_paid_upto'      => date_format(date_create($last_date),"Y-m-d"), 
                    'fc_dueDate'        => date_format(date_create($last_date),"Y-m-d"), 
                    'fc_issue_date'     => date_format(date_create($last_date),"Y-m-d"), 
//                    'fc_pay_cat_id'     => 12, 
                    'fc_bank_id'        => 8, 
                    'challan_id_lock'   => 0, 
                    'financial_id'      => $fy->id, 
                    'fc_timestamp'      => date('Y-m-d H:i:s'), 
                    'fc_userId'         => $this->userInfo->user_id
                    );
                       
                    $challan_id = $this->CRUDModel->insert('fee_challan',$data);
                     //Search info about installement detials and insert to fee_challan_detail table
                    $this->RQ($challan_id,'assets/RQ/challan_rq/');
                    $this->CRUDModel->update('fee_challan',array('fc_challan_rq'=>$challan_id.'.png'),array('fc_challan_id'=>$challan_id));
                 // search Old challan balance 
                    $old_balance = array(

                        'fc_student_id'     => $stdRow->student_id,  
                        'balance>'          => 0,  
                          
                        
                        );

                                             $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                        $old_balane_amount = $this->db->get_where('fee_challan',$old_balance)->result();
                       
                      if(!empty($old_balane_amount)):
                     
                         
                        foreach($old_balane_amount as $OLBA):
                          
                           $pc_cat  = '';
                          if(empty($OLBA->fc_pay_cat_id)):
                                $pc_cat = '25';
                                else:
                               $pc_cat = $OLBA->fc_pay_cat_id; 
                            endif;
                          
                            $datafs = array(
                                'challan_id'        => $challan_id,
                                'fee_id'            => $OLBA->fee_id,
                                'actual_amount'     => $OLBA->balance,
                                'paid_amount'       => $OLBA->balance,
                                'balance'           => $OLBA->balance,
                                'comment'           => $OLBA->comment,
                                'old_balance_pc_id' => $pc_cat,
                                'challan_status'    => 1,
                                'timestamp'         => date('Y-m-d H:i:s'),
                                'useId'             => $this->userInfo->user_id
                            );
                            $this->CRUDModel->insert('fee_actual_challan_detail',$datafs);
                          
                            // add old challan id into New challan 
                            $this->CRUDModel->update('fee_challan',array('old_balance_challan_id'=>$OLBA->fc_challan_id),array('fc_challan_id'=>$challan_id));
                           //Lock Old challan 
                            $this->CRUDModel->update('fee_challan',array('challan_id_lock'=>1),array('fc_challan_id'=>$OLBA->fc_challan_id));
                          
                            //Remove balance from old challan table
                            $this->CRUDModel->update('fee_actual_challan_detail',array('balance'=>0),array('challan_detail_id'=>$OLBA->challan_detail_id));
                          
                        endforeach;
                       
                        endif;
                 
                    
                       
                       //add extra new heads 
                        
                        $fee_setups_head = $this->CRUDModel->get_where_result('fee_add_new_heads_demo',$where_extra_new);
                        
//                        if($fee_setups_heads):
                            foreach($fee_setups_head as $fsRow):
                            
                        $fine_setups = array(
                            'fh_Id'            => $fsRow->fh_id,
                            'fcs_amount'       => $fsRow->amount,
                            'fcs_timestamp'    => date('Y-m-d H:i:s'), 
                            'fcs_userId'       => $this->userInfo->user_id
                        );
             
                    $actual_chal_head = $this->CRUDModel->insert('fee_class_setups',$fine_setups);
                     
                    $datafs = array(
                                'challan_id'    => $challan_id,
                                'fee_id'        => $actual_chal_head,
                                'actual_amount' => $fsRow->amount,
                                'paid_amount'   => $fsRow->amount,
                                'balance'       => $fsRow->amount,
                                'comment'       => $fsRow->comment,
                                'challan_status'=> 1,
                                'timestamp'     => date('Y-m-d H:i:s'),
                                'useId'         => $this->userInfo->user_id
                            );
                           
                          $this->CRUDModel->insert('fee_actual_challan_detail',$datafs);
                       endforeach;
                        //End new Heads
                       $where_fee_balance = array(
                         'challan_id'=>$challan_id  
                       );
                                                      $this->db->select('sum(balance) as balance');  
                                                      $this->db->group_by('challan_id');
                    $challan_installment_balance =    $this->db->get_where('fee_actual_challan_detail',$where_fee_balance)->row();
                       
                    //Insert All Current balance against the Payment Category 
                    //1st Payment,2nd Payments....
                    $student_current_balance = array(
                                'student_id'    => $stdRow->student_id,
//                                'pay_cat_id'    => 12,
                                'r_amount'      => $challan_installment_balance ->balance,
                                'timestamp'     => date('Y-m-d H:i:s'),
                                'userId'        => $this->userInfo->user_id  
                            );
                    $this->CRUDModel->insert('fee_balance',$student_current_balance);
                    //Fee Challan Details
                        $student_balance_insert = array(
                                'challan_id'    => $challan_id,
                                'student_id'    => $stdRow->student_id,
                                'ch_status_id'  => 1,
                                'date'          => date_format(date_create($last_date),"Y-m-d"),
                                'timestamp'     => date('Y-m-d H:i:s'),
                                'userId'        => $this->userInfo->user_id

                                );
                        $this->CRUDModel->insert('fee_challan_history',$student_balance_insert);
//                   echo 'challan not Exist';
//                         endif;
                   
               
                 endforeach;
                $this->CRUDModel->deleteid('fee_add_new_heads_std_demo',$where_extra_new); 
                $this->CRUDModel->deleteid('fee_add_new_heads_demo',$where_extra_new); 
                redirect('feeChallanSearch');
             endif;
         
        endif; 
        $this->data['page']         = 'Fee/extra_heads/add_heads';
        $this->data['page_header']  = 'Add Extra Payments';
        $this->data['page_title']   = 'Add Extra Payments | ECMS';
        $this->load->view('common/common',$this->data);  
        
    }
    
     public function ajax_add_heads(){
         
//                $student_id     = $this->input->post('student_id');
                $fee_head_id    = $this->input->post('fee_head');
                $amount         = $this->input->post('amount');
                $fine_date      = $this->input->post('last_date');
                $comment        = $this->input->post('comment');
                $formCode       = $this->input->post('form_code');
             
                 
            $data = array(
                 
                'fh_id'          => $fee_head_id,  
                'amount'         => $amount,  
                'form_code'      => $formCode,  
                'date'           => date('Y-m-d',strtotime($fine_date)),  
                'comment'        => $comment,  
                'user_id'        => $this->userInfo->user_id,
                 
             );
           
             $this->CRUDModel->insert('fee_add_new_heads_demo',$data); 
                    $this->db->join('fee_heads','fee_heads.fh_Id=fee_add_new_heads_demo.fh_id');
          $result =   $this->db->get_where('fee_add_new_heads_demo',array('form_code'=> $formCode ))->result(); 
          
       if(!empty($result)):                      
        
        echo '<div class="row">
                <div class="col-md-8 col-md-offset-2">';
                    echo '<div id="div_print">
                    <div class="table-responsive">
                        <table class="table table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fee Head</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Commment</th>
                                </tr>
                            </thead>
                            <tbody>';
                            $sn= '';
                            foreach($result as $resultRow):
                            $sn++;
                                echo '<tr>
                                        <td>'.$sn.'</td>
                                        <td>'.$resultRow->fh_head.'</td>
                                        <td>'.$resultRow->amount.'</td>
                                        <td>'.date('d-m-Y',strtotime($resultRow->date)).'</td>
                                        <td>'.$resultRow->comment.'</td>
                                     </tr>';
                                endforeach;      
                            echo '</tbody>
                            </table>
                        </div>';
                    echo '</div>
                    </div>
                    </div>';
                endif;
         
    }
     public function ajax_add_new_heads_students(){
         
                $student_id     = $this->input->post('student_id');
                $formCode       = $this->input->post('formCode');
           
             
                 
            $data = array(
                 
                'student_id'          => $student_id,  
                'form_code'          => $formCode,  
                'user_id'           => $this->userInfo->user_id,  
                
                 
             );
           
             $this->CRUDModel->insert('fee_add_new_heads_std_demo',$data); 
                    
                      $this->db->join('fee_add_new_heads_std_demo','fee_add_new_heads_std_demo.student_id=student_record.student_id');
          $result =   $this->db->get_where('student_record',array('form_code'=> $formCode ))->result(); 
          
       if(!empty($result)):                      
        
        echo '<div class="row">
                <div class="col-md-8 col-md-offset-2">';
                    echo '<div id="div_print">
                    <div class="table-responsive">
                        <table class="table table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>College No</th>
                                    <th>Name</th>
                                    <th>Father Name</th>
                                    
                                </tr>
                            </thead>
                            <tbody>';
                            $sn= '';
                            foreach($result as $resultRow):
                            $sn++;
                                echo '<tr>
                                        <td>'.$sn.'</td>
                                        <td>'.$resultRow->college_no.'</td>
                                        <td>'.$resultRow->student_name.'</td>
                                        <td>'.$resultRow->father_name.'</td>
                                         
                                     </tr>';
                                endforeach;      
                            echo '</tbody>
                            </table>
                        </div>';
                    echo '</div>
                    </div>
                    </div>';
                endif;
         
    }
  
     public function fee_ledger_report(){
        
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['pc']           = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', 'Payment Category', 'pc_id', 'title');
        $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', 'Batch ', 'batch_id', 'batch_name',array('status'=>'on'));
        $this->data['challan']      = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Challan Status', 'gender_id', 'title');
        
        $this->data['collegeNo']    = '';
        $this->data['gender_id']    = '';
        $this->data['pc_id']        = '';
        $this->data['batch_id']     = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['sub_pro_id']   = '';
        $this->data['challan_id']   = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['from']         = '';
        $this->data['to']           = date('d-m-Y');
        
        if($this->input->post()):
            
            $collegeNo      = $this->input->post("collegeNo");
            $challan_no     = $this->input->post("challan_no");
            $form_no        = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $batch          = $this->input->post("batch");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $pc_id          = $this->input->post("pc_id");
            $challan_status = $this->input->post("challan_status");
            $gender         = $this->input->post("gender");
            $from           = $this->input->post("from");
            $to             = $this->input->post("to");
  
            if($from == ''):
                $date['from']       = ''; 
                $date['to']         = $to;
                 $this->data['from'] = '';
                $this->data['to']   = $to;
                else:
                
                $date['from']       = $from;
                $date['to']         = $to;
                $this->data['from'] = $from;
                $this->data['to']   = $to;
            endif;
            
      
            
            $where      = '';
            $like       = '';
            if($gender):
                $where['student_record.gender_id'] = $gender;
                $this->data['gender_id'] = $gender;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
            if($batch):
                $where['student_record.batch_id']   = $batch;
                $this->data['batch_id']             = $batch;
            endif;
            if($challan_no):
                $where['fee_challan.fc_challan_id'] = $challan_no;
                $this->data['challan_no'] = $challan_no;
            endif;
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['collegeNo'] = $collegeNo;
            endif;
            if($challan_status):
                $where['fee_challan_status.ch_status_id'] = $challan_status;
                $this->data['challan_id'] = $challan_status;
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
            
       
            
            $this->data['result'] = $this->FeeModel->fee_redger_report($where,$like,$date);
//            $this->data['count'] = $this->FeeModel->fee_challan_filters_count($where,$like,$date);
            
  
        endif;
        
        $this->data['page']         = 'Fee/Reports/fee_ledger_report';
        $this->data['page_header']  = 'Fee Ledger Report';
        $this->data['page_title']   = 'Fee Ledger Report | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function student_clearence(){
        
        if($this->input->post()):
            
            $student_id                 = $this->input->post('student_id');
            $this->data['c_for']        = $this->input->post('c_for');
            $this->data['comments']     = $this->input->post('comments');
            $this->data['student_id']     = $student_id;
            
            
            
            
          $this->data['studentInfo']  = $this->FeeModel->fee_challan_student(array('student_record.student_id'=>$student_id));  
         
        $this->data['fee_information']      = $this->FeeModel->student_fee_details($student_id);
//        echo '<pre>';print_r($this->data['fee_information']);die;
        $this->data['hostel_information']   = $this->FeeModel->student_hostel_details($student_id);
       
        $this->data['mess_information']   = $this->FeeModel->student_mess_details($student_id);
       
//         echo '<pre>';print_r($this->data['mess_information']);die;
        endif;
        
        
        $this->data['page']         = 'Fee/Reports/student_clearence_report';
        $this->data['page_header']  = 'Student Clearence Report';
        $this->data['page_title']   = 'Student Clearence Report | ECMS';
        $this->load->view('common/common',$this->data);
        
    }
    public function transfar_student(){

        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Select ', 'programe_id', 'programe_name');
        $this->data['batch']        = $this->CRUDModel->dropDown('prospectus_batch', 'Select ', 'batch_id', 'batch_name',array('status'=>'on'));
        $this->data['sub_pro_name'] = $this->CRUDModel->sub_proDropDown('sub_programes', 'Select', 'sub_pro_id', 'name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Select', 'sec_id', 'name',array('status'=>'On'));
        
        $this->data['college_no']   = '';
        if($this->input->post('search')):
            
         $college_no                    = $this->input->post('college_no');
         $this->data['student_info']    = $this->FeeModel->fee_student_transfar(array('student_record.college_no'=>$college_no)); 
         $this->data['college_no']      = $college_no;
        endif;
        
        if($this->input->post('transferStudent')):
            
            $student_id     = $this->input->post('student_id');
            $programe_id    = $this->input->post('program_id');
            $batch_id       = $this->input->post('batch_id');
            $sub_pro_id     = $this->input->post('sub_pro_id');
            $section_id     = $this->input->post('section_id');
            $fee_comments   = $this->input->post('fee_comments');
            $stud_info      = $this->db->get_where('student_record',array('student_id'=>$student_id))->row();
             
            
            // Transfer Student
            $SET_std = array(
              'programe_id'         => $programe_id,  
              'batch_id'            => $batch_id,  
              'sub_pro_id'          => $sub_pro_id,  
              'admission_comment'   => $stud_info->admission_comment.', Student Transfer #'.$fee_comments,  
              'updated_by_user'     => $this->userInfo->user_id,
              'updated_datetime'    => date('Y-m-d H:i:s'),  
            );
            $WHERE_std = array(
             'student_id'  => $student_id,   
            );
            $this->CRUDModel->update('student_record',$SET_std,$WHERE_std);
            // Update Student Section
            $SET_Section = array(
              'section_id'=>$section_id  
            );
            $this->CRUDModel->update('student_group_allotment',$SET_Section,$WHERE_std);
            //Section log table
            $section_log_data = array(
                'student_id'    => $student_id,
                'date'          => date('Y-m-d'),
                'section_id'    => $section_id, 
                'timestamp'     => date('Y-m-d H:i:s'),  
                'user_id'       => $this->userInfo->user_id, 
            );
            
            $this->CRUDModel->insert('student_group_allotment_log',$section_log_data);  
            //Update Transfer Log 
            $std_log_data = array(
                'student_id'        => $student_id,
                'transfer_date'     => date('Y-m-d'),
                'comments'          => 'Student Transfer #'.$fee_comments,
                'old_program'       => $this->input->post('old_program_id'),  
                'old_batch'         => $this->input->post('old_batch_id'),  
                'old_sub_program'   => $this->input->post('old_sub_pro_id'),  
                'old_section'       => $this->input->post('old_section_id'),  
                'timestamp'         => date('Y-m-d H:i:s'),  
                'userId'            => $this->userInfo->user_id,  
            );
            $this->CRUDModel->insert('fee_student_transfer_log',$std_log_data);
            
            
            redirect('fullDetails/'.$student_id);
        endif;
      
        $this->data['page']         = 'Fee/fee_student_transfar';
        $this->data['page_header']  = 'Fee Student Transfer';
        $this->data['page_title']   = 'Fee Student Transfer | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function bank_reconciliation_report_lock(){
       
        
        $this->data['from'] = date('d-m-Y');
        $this->data['to'] = date('d-m-Y');
        
         if($this->input->post('Search')):
            $this->data['from']             = $this->input->post('from');
            $this->data['to']               = $this->input->post('to');
            $this->data['search_result']    = $this->FeeModel->get_lock_dates($this->data['from'],$this->data['to']);
             
         endif;
     
        
        if($this->input->post('lock')):
        
            $from = $this->input->post('from');
            $to = $this->input->post('to');
            
            $all_dates =    $this->CRUDModel->getDatesFromRange($from,$to);
            $already_exist_date = '';
            foreach($all_dates as $key=>$value):
                
                $data = array(
                  'lock_date'   => $value,  
                  'status'      => 1,  
                  'create_by'   => $this->userInfo->user_id,  
                  'create_date' => date('Y-m-d H:i:s'),  
                );
            
            $check_date = $this->CRUDModel->get_where_row('fee_brr_lock',array('lock_date'=> $value));
            
            if(!empty($check_date)):
                $already_exist_date[] = array(
                    'date'=>$value
                );
                else:
                $this->CRUDModel->insert('fee_brr_lock',$data);
            endif;
            
            endforeach;
            
             $this->data['already_exist_date'] = json_decode(json_encode($already_exist_date), FALSE);
        endif;
        
        $this->data['page']         = 'Fee/BRR_lock';
        $this->data['page_header']  = 'Bank Reconciliation Report Lock';
        $this->data['page_title']   = 'Bank Reconciliation Report Lock | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function bank_reconciliation_report_lock_edit(){
       
        
        $this->data['from'] = date('d-m-Y');
        $this->data['to'] = date('d-m-Y');
        
        $this->data['update_result']    = $this->CRUDModel->get_where_row('fee_brr_lock',array('fee_brr_lock.id'=>$this->uri->segment(2)));
                                           
                                            $this->db->join('users','users.id=fee_brr_lock_log.create_by');
                                            $this->db->order_by('fee_brr_lock_log.id','desc');
        $this->data['update_results']    =  $this->db->get_where('fee_brr_lock_log',array('fee_brr_lock_log.date_id'=>$this->uri->segment(2)))->result();
        
        if($this->input->post('update')):
            
            $id           = $this->input->post('id');
            $date         = $this->input->post('date');
            $status       = $this->input->post('status');
            $comments     = $this->input->post('comments');
            
            $SETU = array(
                'lock_date'     => date('Y-m-d',strtotime($date)),
                'status'        => $status,
                'comments'      => $comments,
                'update_by'     => $this->userInfo->user_id,  
                'update_date'   => date('Y-m-d H:i:s'),  
            );
            $WHEREU = array(
                'id'=>$id
            );
             $this->CRUDModel->update('fee_brr_lock',$SETU,$WHEREU);
             
             
            $DATA = array(
                'date_id'       => $id,
                'lock_date'     => date('Y-m-d',strtotime($date)),
                'status'        => $status,
                'comments'      => $comments,
                'create_by'     => $this->userInfo->user_id,  
                'create_date'   => date('Y-m-d H:i:s'),  
            );
            
             $this->CRUDModel->insert('fee_brr_lock_log',$DATA);
             
            redirect('BRRLock'); 
         endif;
      
      
         
        $this->data['page']         = 'Fee/BRR_lock_edit';
        $this->data['page_header']  = 'Bank Reconciliation Report Lock';
        $this->data['page_title']   = 'Bank Reconciliation Report Lock | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function fee_paid_amount(){
        
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        
        $this->data['fee_head_from']= $this->FeeModel->dropDown_fee_head_paid('fee_class_setups', 'Fee Head From', 'fh_Id', 'fh_head');
        $this->data['fee_head_to']  = $this->FeeModel->dropDown_fee_head_paid('fee_class_setups', 'Fee Head To', 'fh_Id', 'fh_head');
        
        $this->data['batch_name']   = $this->CRUDModel->DropDown('prospectus_batch', 'Select Batch', 'batch_id', 'batch_name');
       
        $this->data['from']         = '';
        $this->data['to']           = date('d-m-Y');
         
        $this->data['programe_id']  = '';
        $this->data['sub_pro_id']   = '';
        $this->data['sec_id']       = '';
        $this->data['batch_id']     = '';
       
        $this->data['fee_id_from']  = '';
        $this->data['fee_id_to']    = '';
        
        if($this->input->post()):
            
            $from           = $this->input->post("from");
            $to             = $this->input->post("to");
            
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            
            $fee_head_from  = $this->input->post("fee_head_from");
            $fee_head_to    = $this->input->post("fee_head_to");
            $batch_name     = $this->input->post("batch_name");
            
          
          
            $date = array(
                'from'  => $from,
                'to'    => $to,
            );
            $this->data['from'] = $from;
            $this->data['to']   = $to;
   
            $like       = '';
            $where_head = '';
            $where      = '';
           if($batch_name):
                $where['prospectus_batch.batch_id']   = $batch_name;
                $this->data['batch_id']       = $batch_name;
            endif;
           if($fee_head_from):
                $where_head['head_from']   = $fee_head_from;
                $this->data['fee_id_from']       = $fee_head_from;
            endif;
           if($fee_head_to):
//                $where_head['fee_heads.fh_Id']   = $fee_head_to;
                $where_head['head_to']   = $fee_head_to;
                $this->data['fee_id_to']         = $fee_head_to;
            endif;
            
            if($programe_id):
//                $where['programes_info.programe_id']    = $programe_id;
                $this->data['programe_id']              = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
             
       if($this->input->post('paid_amount_report')):
//           fc_challan_credit_amount
            $this->data['result']           = $this->FeeModel->fee_paid_amount_report_programwise($where,$date);
//            $this->data['std_result']       = $this->FeeModel->fee_bank_reconcilition_count($where,$like,$date);
            $this->data['report_type']  = 'paid_amount_report';
            $this->data['report_name']  = 'Paid Amount Result';
//               echo '<pre>';print_r( $this->data['result']);die;
        endif;
       if($this->input->post('paid_amount_report_split')):
//           fc_challan_credit_amount
            $this->data['result']           = $this->FeeModel->fee_paid_amount_report_programwise_split($where,$date);
//            $this->data['std_result']       = $this->FeeModel->fee_bank_reconcilition_count($where,$like,$date);
            $this->data['report_type']  = 'paid_amount_report_split';
            $this->data['report_name']  = 'Paid Amount Split Result';
//               echo '<pre>';print_r( $this->data['result']);die;
        endif;
     
         
       if($this->input->post('paid_fee_head')):
        
       
            $this->data['where2']       = $where;
            $this->data['where']        = $where;
//            $this->data['where_head']   = $where_head;
             
            $this->data['result']       = $this->FeeModel->fee_paid_amount_report_head_wise($where,$where_head,$date);
            $this->data['report_type']  = 'paid_fee_head';
            $this->data['report_name']  = 'Head Wise Report';
 
        endif;
       if($this->input->post('paid_fee_head_college')):
        
       
            $this->data['where2']       = $where;
            $this->data['where']        = $where;
            $this->data['where_head']   = $where_head;
             
            $this->data['result']       = $this->FeeModel->fee_paid_amount_report_head_wise_college($where,$where_head,$date);
            $this->data['report_type']  = 'paid_fee_head_college';
            $this->data['report_name']  = 'Head Wise Report (College)';
 
        endif;
       if($this->input->post('paid_fee_head_hostel')):
        
       
            $this->data['where2']       = $where;
            $this->data['where']        = $where;
            $this->data['where_head']   = $where_head;
             
            $this->data['result']       = $this->FeeModel->fee_paid_amount_report_head_wise_hostel($where,$where_head,$date);
            $this->data['report_type']  = 'paid_fee_head_hostel';
            $this->data['report_name']  = 'Head Wise Report (Hostel & Fee)';
 
        endif;
        
      
        endif;
        $this->data['page']         = 'Fee/Reports/fee_paid_amount_report';
        $this->data['page_header']  = 'Fee Paid Amount Report';
        $this->data['page_title']   = 'Fee Paid Amount Report | ECMS';
        $this->load->view('common/common',$this->data);
        
        }
public function print_challan_wise(){
        
        
        $programe_id    = $this->uri->segment(2);
        
         $where['fee_challan.fc_ch_status_id'] = '1';
         $where['fee_challan.challan_id_lock'] = '0';
          
            if($programe_id):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id'] = $programe_id;
            endif;
         
        $this->data['student_info'] = $this->FeeModel->fee_challan_filters_programWise($where);
        

      
        $this->data['page']         = 'Fee/Reports/class_wise_print';
        $this->data['page_header']  = 'Fee Challan Class Wise';
        $this->data['page_title']   = 'Fee Challan Class Wise | ECMS';
        $this->load->view('common/common',$this->data);
    }
    
        public function class_setups_advance(){
        $userInfo                       =  json_decode(json_encode($this->getUser()), FALSE);
        $this->data['program']          = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['pc_category']      = $this->CRUDModel->DropDown('fee_category_titles', 'Select Payment Cat', 'cat_title_id', 'title');
        $this->data['fee_shift']        = $this->CRUDModel->dropDown('shift', '', 'shift_id', 'name');
        $this->data['programe_id']      = '';
        $this->data['sub_pro_id']       = '';
        $this->data['fee_shift_id']     = 1;
        
        if($this->input->post()):
            
             
            $sub_pro_nameId     = $this->input->post('sub_programes');
            $batch_id_code      = $this->input->post('batch_id_name_code');
            $pc_idx              = $this->input->post('pc_id');
            $fee_from           = date('Y-m-d', strtotime($this->input->post('fee_from')));
            $fee_to             = date('Y-m-d', strtotime($this->input->post('fee_to')));
            $valid_till         = date('Y-m-d', strtotime($this->input->post('valid_till')));
            $comment            = $this->input->post('comment');
            $formCode           = $this->input->post('formCode');
            $shift_name_code    = $this->input->post('shift_name_code');
            
            $message = '';
            foreach($sub_pro_nameId as $key=>$value):
                 
                $data_payment_category_check = array(
                    'fee_payment_category.sub_pro_id'    => $value,  
                    'cat_title_id'  => $pc_idx,  
                    'batch_id'      => $batch_id_code,
                     
                );
                         $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_payment_category.sub_pro_id');   
                $check = $this->db->get_where('fee_payment_category',$data_payment_category_check)->row();
                
//                echo '<pre>';print_r($check);die;
                if(empty($check)):
                $data_payment_category  =  array(
                        'sub_pro_id'    => $value,  
                        'cat_title_id'  => $pc_idx,  
                        'batch_id'      => $batch_id_code,
                        'userId'        => $userInfo->user_id,
                        'timestamp'     => date('Y-m-d H:i:s')  
                );
                
                
                $pc_id = $this->CRUDModel->insert('fee_payment_category',$data_payment_category);
                
                $result = $this->CRUDModel->get_where_result('fee_class_setups_demo',array('formCode'=> $formCode,'fcs_userId'=> $userInfo->user_id));
            
            
            foreach($result as $demoRow):
            $data = array(
                'fh_Id'         => $demoRow->fh_Id,
                'sub_pro_id'    => $value,
                'shift_id'       => $shift_name_code,
                'fcs_amount'    => $demoRow->fcs_amount,
                'batch_id'      => $batch_id_code,
                'pc_id'         => $pc_id,
                'fee_from'      => $fee_from,
                'fee_to'        => $fee_to,
                'valid_till'    => $valid_till,
                'fcs_comments'  => $comment,
                'fcs_userId'    => $userInfo->user_id,
                'fcs_timestamp' => date('Y-m-d H:i:s')
                );
                
                $this->CRUDModel->insert('fee_class_setups',$data); 
              
                  $install_result_query = $this->CRUDModel->get_where_result('fee_catetory_wise',array('sub_pro_id'=>$value,'pc_id'=> $pc_id));
               $install_amount_where = array(
                    'sub_pro_id'    => $value,
                    'batch_id'      => $batch_id_code,
                    'pc_id'         => $pc_id,
               );
               
               $grand_installement = '';
              $install_result_amount = $this->CRUDModel->get_where_result('fee_class_setups',$install_amount_where);
               
               foreach($install_result_amount as $rowAmount):
                   $grand_installement +=$rowAmount->fcs_amount;
               endforeach;
               
               //Session Wise fee
               if(empty($install_result_query)):
                   $data_install = array(
                      'sub_pro_id'      => $value,
                      'pc_id'           => $pc_id,
                      'batch_id'        => $batch_id_code,
                      'shift_id'        => $shift_name_code, 
                      'fcw_amount'      => $grand_installement, 
                      'fcw_userId'      => $userInfo->user_id, 
                      'fcw_timestamp'   => date('Y-m-d H:i:s'), 
                   );
                    $this->CRUDModel->insert('fee_catetory_wise',$data_install);
                   else:
                    
                  $data_install_where = array(
                      'sub_pro_id'      => $value,
                      'pc_id'           => $pc_id,
                      'shift_id'        => $shift_name_code,
                      'batch_id'      => $batch_id_code,
                   );
                   $data_up = array(
                      'fcw_amount'      => $grand_installement, 
                      'fcw_userId'      => $userInfo->user_id, 
                      'fcw_timestamp'   => date('Y-m-d H:i:s'),   
                   );
                $this->CRUDModel->update('fee_catetory_wise',$data_up,$data_install_where);
              
                 endif;
                 
                endforeach;
                
              
              
              
              
              
              
                     
                $check = $this->db->get_where('sub_programes',array('sub_pro_id'=>$value))->row();
              
              $message[] = '<div class="alert alert-success alert-dismissable center">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                    Welcome ! <strong>'.$check->name.'</strong> Payment Fee Category Record Successfully Save </div>';
              
               
                else:
                   
                     $message[] = '<div class="alert alert-danger alert-dismissable center">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                    Sorry! <strong>'.$check->name.'</strong> Payment Fee Category Record Already Exist No Data Save </div>';
                    
//                   $message[] =  $check->name.'Payment Fee Category Record Already Exist No Data Save';
                    
               endif;
             endforeach;
            
             
//             echo '<pre>';print_r($message);die;
             $this->CRUDModel->deleteid('fee_class_setups_demo',array('formCode'=>$formCode));
             $this->session->set_flashdata('payment_cat_msg', $message);  
             redirect('classSetupsAdv');
      
           endif;
       
        $this->data['result']    = $this->FeeModel->get_class_setup();

        $this->data['page']         = 'Fee/setups/class_fee_setup_adv';
        $this->data['page_header']  = 'Installment Heads allotment Advance';
        $this->data['page_title']   = 'Installment Heads allotment Advance | ECMS';
        $this->load->view('common/common',$this->data);
    }
  public function show_Sub_program_add_installment_head(){
        $program_id = $this->input->post('program_id');
        $where = array(
            'sub_programes.programe_id'=>$program_id,
            'sub_programes.status'=>'yes',

            );
        $result         = $this->db->get_where('sub_programes',$where)->result();
        $program_info   = $this->db->get_where('programes_info',array('programe_id'=>$program_id))->row();
        
        echo '<hr/>';
        echo '<div class="row "><div col-md-12"><span style="color:red;font-size: 16px;" class="blink_text"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$program_info->fee_head_comments.'</span></div></div> <div class="row"> ';

        foreach($result as $row):
            echo '<div class="col-md-4 col-sm-5">';
                    echo '<input type="checkbox" id="sub_programes_head_id"    name="sub_programes[]" value="'.$row->sub_pro_id.'"><span>&nbsp;&nbsp;'.$row->name.'</span>';
            echo '</div>';
        
        endforeach;
        
        echo '<div/>'; 
     
    }
    
   
}

?>