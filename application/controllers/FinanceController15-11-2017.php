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
     public function __construct() {
             parent::__construct();
             $this->load->model('CRUDModel');
             $this->load->model('FinanceModel');
             $this->load->library("pagination");
            }

    public function chart_of_account(){

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
             $this->CRUDModel->update('fn_coa_parent',$data,$where);
             redirect('COA_prents');
             else:
                 $data = array(
                    'fn_coa_code'      =>$code,
                    'fn_coa_title'     =>strtoupper($title),
                    'fn_coa_commnet'   =>$comments,
                    'fn_coa_timestamp' =>$currnetDate,
                    'fn_coa_userId'    =>$userInfo['user_id'],
                    );
                $this->CRUDModel->insert('fn_coa_parent',$data);
                 redirect('COA_prents');
             endif;

        endif;

        $COA_id = $this->uri->segment(2);
        if($COA_id):
            $this->data['coaResult']    = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$COA_id));
        endif;

        $this->data['coa']              = $this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_trash'=>1));
        $this->data['page']             = "Finance/coa_parents";
        $this->data['page_title']       = 'Chart of Accounts| ECMS';
        $this->load->view('common/common',$this->data);

    }
    public function coa_perent_delte(){
        $id     = $this->uri->segment(2);
        $data   = array('fn_coa_trash'=>0);
        $where  = array('fn_coaId'=>$id);
        $this->CRUDModel->update('fn_coa_parent',$data,$where);
        redirect('COA_prents');
    }
    public function check_coa_parent(){
            $fn_coa_code        = $this->input->post('fn_coa_code');
             $result            = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coa_code'=>$fn_coa_code));
             if($result):
                    echo 1;
                 else:
                     echo 0;
             endif;
        }
    public function coa_master_child(){
           if($this->input->post()):
             //Insert Code 
             $code          = $this->input->post('code');
             $title         = $this->input->post('title');
             $comments      = $this->input->post('comments');
             $COAPId        = $this->input->post('COAP');
             $coa_id        = $this->input->post('coa_id');
             $status        = $this->input->post('coa_status');
             $currnetDate   =  date('Y-m-d H:i:s');
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
                $this->data['coaResult']    = $this->CRUDModel->get_where_row('fn_coa_master_child',array('fn_coa_m_cId'=>$COA_id));
            endif;
            
            $wherePrg                       = array(
                                                'fn_coa_status' =>'1',
                                                'fn_coa_trash'  =>1);
            $this->data['COAP']             = $this->CRUDModel->dropDown('fn_coa_parent', 'Select Account Head', 'fn_coaId', 'fn_coa_title',$wherePrg);  
            $where                          = array(
                                                'fn_coa_trash'  =>1,
                                                'fn_coa_status' =>1,
                                                'fn_coa_m_trash'=>1);
            $this->data['coa_master']       = $this->FinanceModel->coa_master('fn_coa_master_child',$where);
           
            $this->data['page']             = "Finance/coa_master_child";
            $this->data['page_title']       = 'Chart of Accounts| ECMS';
            $this->load->view('common/common',$this->data);
     
        }
    public function coa_child_delte(){
            $id         = $this->uri->segment(2);
            $data       = array('fn_coa_m_trash'=>0);
            $where      = array('fn_coa_m_cId'=>$id);
            $this->CRUDModel->update('fn_coa_master_child',$data,$where);
            redirect('coa_master_child');
        }
    public function check_coa_master(){
            $fn_coa_master_code = $this->input->post('fn_coa_master_code');
            $coa_id             = $this->input->post('coa_id');
            
            
             $result  = $this->CRUDModel->get_where_row('fn_coa_master_child',array('fn_coa_m_code'=>$fn_coa_master_code,'fn_coa_m_pId'=>$coa_id));
             if($result):
                    echo 1;
                 else:
                     echo 0;
             endif;
        }
    public function coa_master_sub_child(){
            
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
                    $this->CRUDModel->update('fn_coa_master_sub_child',$data,$where);
                    redirect('master_sub_child');
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
                'fn_coa_status'=>'1'
                
                );
            $this->data['COAP']         = $this->CRUDModel->dropDown('fn_coa_parent', 'Select Account Head', 'fn_coaId', 'fn_coa_title',$wherePrg);  
           $where = array(
              'fn_coa_mc_trash'     =>1, 
              'fn_coa_m_trash'      =>1, 
              'fn_coa_trash'        =>1, 
              'fn_coa_status'       =>1, 
              'fn_coa_m_status'     =>1, 
               
           );
            $this->data['master_sub']   = $this->FinanceModel->coa_master_subChild('fn_coa_master_sub_child',$where); 
            //echo '<pre>';print_r($this->data['master_sub']);die;
            $this->data['page']         = "Finance/coa_master_sub_child";
            $this->data['title']        = 'Master Sub Child| ECMS';
            $this->load->view('common/common',$this->data);
        }
    public function coa_master_sub_delte(){
            $id     = $this->uri->segment(2);
           
            $data   = array('fn_coa_mc_trash'=>0);
            $where  = array('fn_coa_mc_id'=>$id);
            $this->CRUDModel->update('fn_coa_master_sub_child',$data,$where);
            redirect('master_sub_child');
        }
    public function get_master_record(){
            $coa_parent_id      = $this->input->post('coa_parent_id');
            $result             = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_pId'=>$coa_parent_id,'fn_coa_m_status'=>1));
                foreach($result as $row):
                    echo '<option value="'.$row->fn_coa_m_cId.'">'.$row->fn_coa_m_title.'('.$row->fn_coa_m_code.')</option>';
                endforeach;
           
        }
    public function check_master_subChild(){
            
             $coa_parent_id         = $this->input->post('coa_parent_id');
             $master_child          = $this->input->post('master_child');
             $master_subChild_code  = $this->input->post('master_subChild_code');
             $where  = array(
                 'fn_coa_pId'       =>$coa_parent_id,
                 'fn_coa_mc_mId'    =>$master_child,
                 'fn_coa_mc_code'   =>$master_subChild_code
                     );
              
             $result  = $this->CRUDModel->get_where_row('fn_coa_master_sub_child',$where);
            
             if($result):
                    echo 1;
                 else:
                     echo 0;
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
            $this->data['title']        = 'Fee Heads| ECMS';
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
            $this->data['title']        = 'Fee Heads| ECMS';
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
            $this->data['title']        = 'Fee Heads| ECMS';
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

                        </script><?php
        
    }
    public function autocomplete_amount(){
        
//        $term = trim(strip_tags($_GET['term']));
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
                $like           = $term;
                $result_set     = $this->FinanceModel->autocomplete_amount('fn_coa_master_sub_child',$like);
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
                $result_set             = $this->FinanceModel->autocomplete_amount('fn_coa_master_sub_child',$like);
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
            
             
        
             
             foreach($voucher_att as $row=>$key):
                 
               
                 $data = array(
                   'amount_tra_id'  => $account_id, 
                   'attach_id'      => $key, 
                   'timestamp'      => date('Y-m-d H:i:s'),
                    'user_id'       => $userInfo['user_id']  
                 );
                 $this->CRUDModel->insert('fn_voucher_attachment',$data);
                 
             endforeach;
         
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
          
            redirect('VoucherPrint/'.$account_id);
            
            
//         echo    json_encode($msg);
            
       endif;
    } 
    public function general_ledger(){
        
            $this->data['COAP'] =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1));
            
            if($this->input->post('search')):
               
                $this->data['dateFrom']       = $this->input->post('dateFrom');
                $this->data['toDate']         = $this->input->post('dateto');
                
                $this->data['recordTo']       = $this->input->post('recordTo');
                $this->data['recordFrom']     = $this->input->post('recordFrom');
                
                $this->data['recordToCode']       = $this->input->post('recordToCode');
                $this->data['recordFromCode']     = $this->input->post('recordFromCode');
                
//               $this->data['GeneralLeader']   =  $this->FinanceModel->get_leader_dw(
               $this->data['GeneralLeader']   =  $this->FinanceModel->get_leader_dw('gl_amount_details',
                       $this->data['dateFrom'], 
                       $this->data['toDate'],
                       $this->data['recordFromCode'],
                       $this->data['recordToCode']
                       );
//              echo $this->db->last_query();die;  
//              echo '<pre>';print_r($this->data['GeneralLeader']);die; 
                
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
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'Date');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1', 'Vocher');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('D1','COA');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
                
               
                $this->excel->getActiveSheet()->setCellValue('E1', 'Description');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('F1', 'Payee');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('G1', 'Cheque');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('H1', 'Debit');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
                 
               
                $this->excel->getActiveSheet()->setCellValue('I1', 'Credit');
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(16);
                 
               
                
               
                
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
                            $date=date_create($dRow->gl_at_date);
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
        
            $this->data['page']         = "Finance/general_leader_dw";
            $this->data['title']        = 'Trial Balance | ECMS';
            $this->load->view('common/common',$this->data);
    }
    public function print_general_ledger(){
                $dateFrom       = $this->uri->segment(3);
                $dateto         = $this->uri->segment(4);
                
                $recordFromCode = $this->uri->segment(5);
                $recordToCode   = $this->uri->segment(6);
        
                $this->data['dateFrom']        = $dateFrom;
                $this->data['dateTo']        = $dateto;
                
                
              $this->data['GeneralLeader']   =  $this->FinanceModel->get_leader_dw('gl_amount_details',$dateFrom,$dateto,$recordFromCode,$recordToCode);
             $this->data['title']        = 'Print Leaders | ECMS';
          
            
            $this->load->view('common/header');
            //$this->load->view('common/nav');
            $this->load->view('Finance/printLedger',$this->data);
            $this->load->view('common/footer');
             
    }
    public function trial_balance(){
        
        if($this->input->post('export')):
             
            
                $date['fromDate']       = $this->input->post('dateFrom');
                $date['toDate']         = $this->input->post('todate');
            
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Merit list');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Cost Center');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'Date');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('C1', 'COA Code');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('D1','COA Description');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
                
               
                $this->excel->getActiveSheet()->setCellValue('E1', 'Debit');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('F1', 'Credit');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
                 
               
                
               
                
       for($col = ord('A'); $col <= ord('D'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
                $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle('E')->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        
                $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle('F')->getFont()->setSize(10);
                $this->excel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
               
        
        

           $result = $this->FinanceModel->trial_balance_export($date);
//           echo '<pre>';print_r($result);die;
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
        
        
        $this->data['page']         = 'Finance/trial_balance';
        $this->data['page_title']   = 'Trial Balance | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function trial_balance_detail(){
     
        
                $fromDate       = $this->input->post('dateFrom');
                $toDate         = $this->input->post('todate');
               
                $where = array(
                   'fn_coa_status'  =>1,
                   'fn_coa_trash'   =>1 
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
                                                             
                                                                $master_child = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_pId'=>$GLRow->fn_coaId));
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
                                                                                $master_child_sub = $this->FinanceModel->amount_transitionDetails($where_TB,$fromDate,$toDate);
//                                                                                  echo '<pre>';print_r($master_child_sub); 
                                                                                foreach($master_child_sub as $mscRow):
                                                                                    
                                                                                    $grandDebit     = '';
                                                                                    $grandCredit    = '';    
                                                                                    
                                                                                    if($GLRow->fn_coa_code == 200000):
                                                                                            $grandCredit = $mscRow->sumCredit-$mscRow->sumDebit;
                                                                                            $grandDebit     = '';
                                                                                     endif;
                                                                                     if($GLRow->fn_coa_code == 400000):
                                                                                            $grandCredit = $mscRow->sumCredit-$mscRow->sumDebit;
                                                                                             $grandDebit     = '';   
                                                                                     endif;

                                                                                     if($GLRow->fn_coa_code == 300000):
                                                                                            $grandCredit    = '';
                                                                                            $grandDebit = $mscRow->sumDebit- $mscRow->sumCredit;
                                                                                            
                                                                                     endif;
                                                                                     if($GLRow->fn_coa_code == 500000):
                                                                                            $grandCredit    = '';
                                                                                            $grandDebit = $mscRow->sumDebit- $mscRow->sumCredit;
                                                                                           
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
    public function trial_balance_detail_new(){
     
        $this->data['toDate']  = date('d-m-Y');
        $this->data['fromDate'] = date('d-m-Y');
        if($this->input->post()):
           
                $this->data['fromDate']       = $this->input->post('dateFrom');
                $this->data['toDate']         = $this->input->post('todate');
               
                
                 
                 $where = array(
                   'fn_coa_status'  =>1,
                   'fn_coa_trash'   =>1 
                );
                
                 $this->data['trialBalance_heading'] = $this->CRUDModel->get_where_result('fn_coa_parent',$where); 
                 
                 
                 $this->data['result'] = $this->db->get('fn_coa_master_sub_child')->result();
              
        endif;
        
        $this->data['page']         = 'Finance/trial_balance_new';
        $this->data['page_title']   = 'Trial Balance | ECMS';
        $this->load->view('common/common',$this->data);
        
        
        
    }
    public function gl_autocomplete(){
            //$term                       = trim(strip_tags($_GET['term']));
            $term                       = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
                $like                   = $term;
                $result_set             = $this->FinanceModel->autocomplete_amount('fn_coa_master_sub_child',$like);
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
                $result_set             = $this->FinanceModel->autocomplete_amount('fn_coa_master_sub_child',$like);
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
    public function student_defaulter_noties(){
        
//       
        
        $userInfo =  json_decode(json_encode($this->getUser()), FALSE);   
        $this->data['dateFrom']        = date('d-m-Y');
        $this->data['collegeNo']    = '';
          
        if($this->input->post('search')):
        
            
            $collegeno                  = $this->input->post('collegeNo');
            $this->data['collegeNo']    = $collegeno;
            $where= array(
                'college_no'            =>$collegeno,
                's_status_id'           =>5
                );
          $this->data['result'] =   $this->FinanceModel->student_dnoties('student_record',$where);
 
        endif;
    
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
                'userId'        => $userInfo->user_id,
                );
            
            $whereUpdate = array( 'student_id'=>$stdId);
            $this->CRUDModel->update('student_denotice',$dataUp,$whereUpdate);
            
                
            else:
                
                    $dairyNo = '';
                        $diaryCount  =   $this->CRUDModel->get_max_value('count','student_denotice');
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
                'userId'        => $userInfo->user_id,
                );
                
           $this->CRUDModel->insert('student_denotice',$dataInsert);
            endif;
          
           $this->data['collegeNo']    = $collegeno;
            
            $where= array(
                'college_no'=>$collegeno,
                's_status_id'=>5
                );
          $this->data['result'] =   $this->FinanceModel->student_dnoties('student_record',$where);
//           echo '<pre>';print_r($this->data['result']);die;
        endif;
       
        $this->data['page']         = 'Finance/student_d_noties';
        $this->data['page_header']  = 'Student Defaulter Noties';
        $this->data['page_title']   = 'Student Defaulter Noties | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function general_journal(){
         
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
    public function get_date(){
        $this->db->join('gl_amount_transition','gl_amount_transition.gl_at_id=gl_amount_details.gl_ad_atId')->where('gl_ad_dates BETWEEN "'.date('Y-m-d', strtotime('2016-11-01')).'" and "'.date('Y-m-d', strtotime('2016-11-30')).'"')->get('gl_amount_details')->result();
    }
    public function bank_voucher(){
      
             $query1 = $this->db->where('status','1')->get('financial_year')->row();
            $vocherNum                      = $this->CRUDModel->get_max_value('gl_at_vocher','gl_amount_transition',array('gl_fy_id'=>$query1->id));
           
//        $vocherNum                      = $this->CRUDModel->get_max_where('gl_at_vocher','gl_amount_transition');
            $this->data['stt']              = $this->CRUDModel->dropDown('fn_trm_type','', 'ftt_id', 'ftt_title');  
            $this->data['financialYear']    = $this->CRUDModel->dropDown('financial_year','', 'id', 'year',array('status'=>1));  
            $this->data['voucherType']      = $this->CRUDModel->dropDown('fn_voucher_type','Select Vocher Type', 'id', 'voch_name',array('status'=>1));  
            $this->data['voucher_attach']    = $this->CRUDModel->get_where_result('fn_attachments',array('status'=>1));
            $this->data['voucher_status']    = $this->CRUDModel->dropDown('fn_vocher_status','', 'id', 'status_title',array('status'=>1)); 
            
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
             
        $this->data['page']         = 'Finance/bank_vochers';
        $this->data['page_header']   = 'Bank Vochers';
        $this->data['page_title']   = 'Bank Vochers | ECMS';
        $this->load->view('common/common',$this->data);  
    }
    
     public function bank_voucher_edit(){
        
//                $query1         = $this->db->where('status','1')->get('financial_year')->row();
//                $vocherNum      = $this->CRUDModel->get_max_value('gl_at_vocher','gl_amount_transition',array('gl_fy_id'=>$query1->id));
//           
            $vocherNum                      = $this->CRUDModel->get_max_where('gl_at_vocher','gl_amount_transition');
           
            $this->data['stt']              = $this->CRUDModel->dropDown('fn_trm_type','', 'ftt_id', 'ftt_title');  
            

            $this->data['employee_drop']      = $this->FinanceModel->dropDownEmployee('hr_emp_record','Select Employee', 'emp_id', 'emp_name');  
            $this->data['supplier_drop']      = $this->CRUDModel->dropDown('fn_supplier','Select Supplier', 'fn_supp_id', 'company_name');  
            $this->data['financialYear']    = $this->CRUDModel->dropDown('financial_year','', 'id', 'year');  
            $where = array('gl_at_id'       =>$this->uri->segment(2));
            $this->data['update_records']   =$this->FinanceModel->get_update_record('gl_amount_transition',$where);
            
            
            $this->data['voucherType']      = $this->CRUDModel->dropDown('fn_voucher_type','Select Vocher Type', 'id', 'voch_name',array('status'=>1));  
            $this->data['voucher_attach']    = $this->CRUDModel->get_where_result('fn_attachments',array('status'=>1));
            $this->data['voucher_status']    = $this->CRUDModel->dropDown('fn_vocher_status','', 'id', 'status_title',array('status'=>1)); 
            
            
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
            $this->data['page']         = "Finance/bank_voucher_edit";
            $this->data['title']        = 'Update Bank Voucher| ECMS';
            $this->data['page_header']  = 'Update Bank Voucher';
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
                'supplier_id'            => $supplier_id,
                'employee_id'            => $employee_id,
                'gl_at_vocher'          => $voucher_no,
                'gl_at_payeeId'         => $payee,
                'vocher_type'           => $voucherType,
                'gl_at_cb_jv'           => $voucherType,
                'gl_fy_id'              => $financial,
                'gl_at_description'     => $description,
                'gl_at_cost_cente'      => $costCenter,
                'vocher_status'         => $voucher_status,
                'print_cheque_value'    => $print_on_check,
                'payment_date'          => date('Y-m-d', strtotime($payment_date)),
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
                  'user_id'    =>$userInfo['user_id'], 
                );
                $this->CRUDModel->insert('fn_voucher_attachment',$data);
            endforeach;
           endif; 
           
            
            
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
                    'gl_ad_date'            => $invoice_date,
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
           
            
            redirect('VoucherPrint/'.$atInsert);
            
//         echo    json_encode($msg);
            
       endif;
    }
    public function print_vouchers(){
        
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
        $this->data['approval']            = $this->CRUDModel->get_where_result_order('fn_vocher_approvalby',array('status'=>1),$order); 
        
        $this->data['chart_of_acct']   = $this->FinanceModel->chart_of_acct($where_chart_of_acct);
//        echo '<pre>';print_r($this->data['principals']);die;
        
       
  
        
        
        $this->data['page']         = "Finance/print/print_vochers";
        $this->data['title']        = 'Vocher| ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function finance_supplier(){
        
        
        
        if($this->input->post()):
            $userInfo      = $this->getUser();
             
         //Insert Code 
         $company_name      = $this->input->post('company_name');
         $proper_name       = $this->input->post('proper_name');
         $businerss_name    = $this->input->post('businerss_name');
         $address           = $this->input->post('address');
         $phone_no          = $this->input->post('phone_no');
         $ntn               = $this->input->post('ntn');
         $sale_tax          = $this->input->post('sale_tax');
         $supp_id          = $this->input->post('supp_id');
         
         $time_stamp   =  date('Y-m-d H:i:s');
         
        

         if($supp_id):

             $data = array(
             'company_name'         =>$company_name,
             'propertier_name'      =>$proper_name,
             'business_details'     =>$businerss_name,
             'address'              =>$address,
             'phone_no'             =>$phone_no,
             'ntn'                  =>$ntn,
             'sale_tax_no'          =>$sale_tax,
             'up_user_id'           =>$userInfo['user_id'],
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
                    'sale_tax_no'          =>$sale_tax,
                    'user_id'              =>$userInfo['user_id'],
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

        $this->data['FnSupplier']       = $this->CRUDModel->getResults('fn_supplier');
        $this->data['page']             = "Finance/finance_supplier";
        $this->data['page_title']       = 'Finance Supplier| ECMS';
        $this->load->view('common/common',$this->data);
    }
     public function finance_supplier_delete(){
       $deletId = $this->uri->segment(2);
       $this->CRUDModel->deleteid('fn_supplier',array('fn_supp_id'=>$deletId));
        redirect('FnSupplier');
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
             'year'         =>$year,
             'status'       =>$coa_status,
             'year_start'   =>date('Y-m-d', strtotime($start)),
             'year_end'     =>date('Y-m-d', strtotime($end)),
             'up_user_id'   =>$userInfo['user_id'],
             'up_timestamp' =>$time_stamp,
             );
         
             $whereAc = array(
                 'status'=>1, 
                 'id !='=>$fy_id 
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
                    'user_id'       =>$userInfo['user_id'],
                    'timestamp'     =>$time_stamp,
                    );
                $this->CRUDModel->insert('financial_year',$data);
                 redirect('FnYear');
             endif;

        endif;

        $id = $this->uri->segment(2);
        if($id):
            $this->data['update_row']    = $this->CRUDModel->get_where_row('financial_year',array('id'=>$id));
        endif;

        $this->data['fnYear']       = $this->CRUDModel->getResults('financial_year');
        $this->data['page']             = "Finance/financial_year";
        $this->data['page_heading']     = "Finincial Year";
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
         $this->data['COAP'] =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1));
         $this->data['financialYear']    = $this->CRUDModel->dropDown('financial_year','', 'id', 'year',array('status'=>1));  
       
        $this->data['fnYearBduget']     = $this->FinanceModel->get_financial_budget('fn_year_budget',array('financial_year.status'=>1));
        
        if($this->input->post()):
            $formCode = $this->input->post('formCode');
            $where = array(
                'formCode'=>$formCode
                
            );
            $save_resut = $this->CRUDModel->get_where_result('fn_year_budget_demo',$where);
            $userInfo      = $this->getUser();
            foreach($save_resut as $row):
            $data = array(
              'fy_id'=>$row->fy_id,
              'coa_id'=>$row->coa_id,
              'budget'=>$row->budget,
              'comments'=>$row->comments,
              'user_id'=>$userInfo['user_id'],
              'timestamp'=>date('Y-m-d H:i:s'),
          );
        
        $this->CRUDModel->insert('fn_year_budget',$data);
            
        
        endforeach;
          $this->CRUDModel->deleteid('fn_year_budget_demo',array('formCode'=>$formCode));
          redirect('FyBudget');
        endif;
        
        $this->data['page']             = "Finance/financial_year_budget";
        $this->data['page_heading']     = "Finincial Year Budget";
        $this->data['page_title']       = 'Finincial Year Budget | ECMS';
        $this->load->view('common/common',$this->data);
    }
      public function finance_budget_add(){
       
          $fy_year      = $this->input->post('fy_year');
          $code_id      = $this->input->post('code_id');
          $budget       = $this->input->post('budget');
          $comments     = $this->input->post('comments');
          $formCode     = $this->input->post('formCode');
        $userInfo      = $this->getUser();
          
        $data = array(
              'fy_id'=>$fy_year,
              'coa_id'=>$code_id,
              'budget'=>$budget,
              'comments'=>$comments,
              'formCode'=>$formCode,
              'user_id'=>$userInfo['user_id'],
              'timestamp'=>date('Y-m-d H:i:s'),
          );
        
        
        $budget_check = $this->CRUDModel->get_where_row('fn_year_budget',array('fy_id'=>$fy_year,'coa_id'=>$code_id));
        $budget_check_demo = $this->CRUDModel->get_where_row('fn_year_budget_demo',array('fy_id'=>$fy_year,'coa_id'=>$code_id,'formCode'=>$formCode));
        $msg = '';
        if(empty($budget_check) && empty($budget_check_demo)):
                $msg = '';
                $this->CRUDModel->insert('fn_year_budget_demo',$data);
            else:
                $msg = 'Account Head Already Exist';
        endif;
        
       
        $where = array(
           'formCode'   =>$formCode,
           'fn_year_budget_demo.user_id'    =>$userInfo['user_id'],
        );
        
        
        $result = $this->FinanceModel->get_financial_budget('fn_year_budget_demo',$where);
        
        
        
        
            
            echo '<table id="testing123" cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>';
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
                             
                            <th><i class="icon-trash" style="color:#fff"></i><b> Delete</b></th>
                        </tr>
                    </thead>
                    <tbody>';
            
            
                       $class = array(
                                    'info',
                                    'success',
                                    'danger',
                                    'warning',
                                    'active',
                                );
  
                        foreach($result as $row):
                            $k = array_rand($class);
                            echo '<tr id="'.$row->id.'Delete" class="'.$class[$k].'">
                            
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
   
   public function finance_voucher_search(){
        $this->data['voucher_status']   = $this->CRUDModel->dropDown('fn_vocher_status','', 'id', 'status_title',array('status'=>1)); 
        $this->data['from_date']        = date('d-m-Y');
        $this->data['to_date']          = date('d-m-Y');
        $this->data['voucehr_no'] = '';
        $this->data['statusid'] = 1;
        
        $where = array(
          'vocher_status'=>1  
        );
        $this->data['result'] =$this->FinanceModel->search_date_range_limit($where);
        
        if($this->input->post()):
            $from_date                 = $this->input->post('from_date');
            $to_date                 = $this->input->post('to_date');
            $voucher_id                 = $this->input->post('voucher_id');
            $vocher_status              = $this->input->post('voucher_status');
            $this->data['statusid']     = $vocher_status;
            $where                      =  '';
            $date                      =  '';
           
            if($from_date):
                $date['from_date']         = $from_date;
                $this->data['from_date']    = $from_date;  
            endif;
            if($to_date):
                $date['to_date']         = $to_date;
                $this->data['to_date']      = $to_date;  
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
 
        
        $this->data['page']         = 'Finance/finance_voucher_search';
        $this->data['page_header']   = 'Finance Voucher Search';
        $this->data['page_title']   = 'Finance Voucher Search | ECMS';
        $this->load->view('common/common',$this->data);
    }
    
    
     public function voucher_approval(){
          
            $this->data['voucher_status']    = $this->CRUDModel->dropDown('fn_vocher_status','', 'id', 'status_title',array('status'=>1)); 
            $where = array('gl_at_id'   =>$this->uri->segment(2));
            $this->data['update_records']       =$this->FinanceModel->get_update_record('gl_amount_transition',$where);

            if($this->input->post()):
                
              
                
                $cheque         = $this->input->post('cheque');
                $trans_id       = $this->input->post('trans_id');
                $payment_date   = $this->input->post('payment_date');
                $voucher_no     = $this->input->post('voucher_no');
                $voucher_status = $this->input->post('voucher_status');
                 
                $voucher_exist = $this->CRUDModel->get_where_row('gl_amount_transition',array('gl_at_id'=>$trans_id));
                  
                  
                 if($voucher_exist->gl_at_vocher == 0):
                     //auto define
                        $query1 = $this->db->where('status','1')->get('financial_year')->row();
                        $check_voch_whrer = array(
                           'gl_fy_id'=>$query1->id, 
                           'gl_at_vocher'=>$voucher_no,
                             
                        );
                        $voucher_check = $this->CRUDModel->get_where_row('gl_amount_transition',$check_voch_whrer);
                      
                     if(empty($voucher_check)):
                          $data = array(
                                        'gl_at_cheque' =>$cheque,  
                                        'payment_date' =>date('Y-m-d', strtotime($payment_date)),  
                                        'gl_at_vocher' =>$voucher_no,  
                                        'vocher_status' =>$voucher_status,  
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
                      $query1 = $this->db->where('status','1')->get('financial_year')->row();
                        $check_voch_whrer = array(
                           'gl_fy_id'=>$query1->id, 
                           'gl_at_vocher'=>$voucher_no,
                            'gl_at_id !='=>$trans_id 
                        );
                        $voucher_check = $this->CRUDModel->get_where_row('gl_amount_transition',$check_voch_whrer);
                      
                        if(!empty($voucher_check)):
                             $this->session->set_flashdata('voucher_exist', 'Voucher Number Already Exist 2');
                             redirect('voucherApproval/'.$trans_id);
                            else:
                                     $data = array(
                                        'gl_at_cheque' =>$cheque,  
                                        'payment_date' =>date('Y-m-d', strtotime($payment_date)),  
                                        'gl_at_vocher' =>$voucher_no,  
                                        'vocher_status' =>$voucher_status,  
                                      );
                                  $where = array(
                                      'gl_at_id'=>$trans_id
                                  );
                                       $this->CRUDModel->update('gl_amount_transition',$data,$where);
                                       redirect('searchVoucher');
                        endif;
                 
                 endif;
               
            endif;
            
            $this->data['page']         = "Finance/finance_voucher_approval";
            $this->data['title']        = 'Voucher Approval| ECMS';
            $this->data['page_header']  = 'Voucher Approval';
            $this->load->view('common/common',$this->data);
    }
     public function voucher_approval_persons(){
        
        
        
        if($this->input->post()):
        $userInfo      = $this->getUser();
             
         //Insert Code 
        $designation    = $this->input->post('designation');
        $name           = $this->input->post('name');
        $order        = $this->input->post('order');
        $status        = $this->input->post('status');
       
        $fy_id      = $this->input->post('fy_id');
        $time_stamp = date('Y-m-d H:i:s');
         
        

         if($fy_id):

             $data = array(
             'designation'  =>$designation,
             'name'         =>$name,
             'appr_order'   =>$order,
             'status'       =>$status,
              
             'up_user_id'   =>$userInfo['user_id'],
             'up_timestamp' =>$time_stamp,
             );
         
             $where = array('id'=>$fy_id);
             $this->CRUDModel->update('fn_vocher_approvalby',$data,$where);
             redirect('ApprovalPersons');
             else:
                 $data = array(
                    'designation'  =>$designation,
                    'name'         =>$name,
                    'appr_order'   =>$order,
                    'user_id'       =>$userInfo['user_id'],
                    'timestamp'     =>$time_stamp,
                    );
                $this->CRUDModel->insert('fn_vocher_approvalby',$data);
                 redirect('ApprovalPersons');
             endif;

        endif;

        $id = $this->uri->segment(2);
        if($id):
            $this->data['update_row']    = $this->CRUDModel->get_where_row('fn_vocher_approvalby',array('id'=>$id));
        endif;

        $this->data['fnYear']       = $this->CRUDModel->getResults('fn_vocher_approvalby');
        $this->data['page']             = "Finance/finance_approval_persons";
        $this->data['page_heading']     = "Voucher Print Setting";
        $this->data['page_title']       = 'Voucher Print Setting | ECMS';
        $this->load->view('common/common',$this->data);
    }

      public function voucher_approval_delete(){
       $deletId = $this->uri->segment(2);
       $this->CRUDModel->deleteid('fn_vocher_approvalby',array('id'=>$deletId));
       redirect('ApprovalPersons');
   }
   public function check_date_range(){
       $processdate = date('d-m-Y', strtotime($this->input->post('invoice_date')));
       
        $date = $this->CRUDModel->get_where_row('financial_year',array('status'=>1));
        
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
}
