<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class FnGAModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
    }

      public function finance_supplier_auto_grand_and_aid($like){
        if($like):
                $this->db->or_like('company_name',$like);   
        endif;

               $this->db->order_by('company_name','asc');
               
               return $this->db->where(array('status'=>1,'fn_account_type_id'=>3))->get('fn_supplier')->result();
  }
  
  public function income_statement_grand_and_aid($dateFrom=NULL,$dateTo=NULL,$fromCode=NULL,$toCode=NULL,$where_income_statu){

                   $this->db->join('gl_amount_transition','gl_amount_transition.gl_at_id=gl_amount_details.gl_ad_atId');
                   $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');

                    $this->db->group_by('gl_ad_coa_mc_pk');
                    $this->db->order_by('gl_ad_coa_mc_id');
                    $this->db->where($where_income_statu);
         $result =  $this->db->get('gl_amount_details')->result();
 
            $return_array = array();
            foreach($result as $row):
                $where = array(
                    'gl_at_id'              => $row->gl_ad_atId,
                    'vocher_status'         => 2,
                    'fn_account_type_id'    => 3,
                );
                $check = $this->db->where($where)->get('gl_amount_transition')->row();
                
                if(!empty($check)):
//                    if($row->gl_ad_coa_mc_id >400000):
                        
                 
                    $return_array[]             = array(
                        'gl_ad_id'              => $row->gl_ad_id,
                        'gl_ad_atId'            => $row->gl_ad_atId,
                        'payment_date'          => $row->payment_date,
                        'gl_ad_cost_center'     => $row->gl_ad_cost_center,
                        'gl_ad_coa_mc_id'       => $row->gl_ad_coa_mc_id,
                        'gl_ad_coa_mc_name'     => $row->gl_ad_coa_mc_name,
                        'gl_ad_coa_mc_pk'       => $row->gl_ad_coa_mc_pk,
                        'gl_ad_depit'           => $row->gl_ad_depit,
                        'gl_ad_credit'          => $row->gl_ad_credit,
                        'gl_ad_dateTime'        => $row->gl_ad_dateTime,
                        'gl_ad_userId'          => $row->gl_ad_userId,
                        'gl_ad_userId_up'       => $row->gl_ad_userId_up,
                        'gl_ad_dateTime_up'     => $row->gl_ad_dateTime_up,
                        'fn_coa_mc_id'          => $row->fn_coa_mc_id,
                        'fn_coa_pId'            => $row->fn_coa_pId,
                        'fn_coa_mc_mId'         => $row->fn_coa_mc_mId,
                        'fn_coa_mc_code'        => $row->fn_coa_mc_code,
                        'fn_coa_mc_title'       => $row->fn_coa_mc_title,
                        'fn_coa_mc_comments'    => $row->fn_coa_mc_comments,
                        'fn_coa_mc_status'      => $row->fn_coa_mc_status,
                        'fn_coa_mc_trash'       => $row->fn_coa_mc_trash,
                        'fn_coa_mc_timestamp'   => $row->fn_coa_mc_timestamp,
                        'fn_coa_mc_userId'      => $row->fn_coa_mc_userId,
                        'fn_coa_mc_upTimestamp' => $row->fn_coa_mc_upTimestamp,
                        'fn_coa_mc_upUserId'    => $row->fn_coa_mc_upUserId,
                        'fn_coa_mc_upUserId'    => $row->fn_coa_mc_upUserId,
                        'fn_coa_mc_upUserId'    => $row->fn_coa_mc_upUserId,
                    );
                endif;
//                   endif;
                
            endforeach;
//              echo '<pre>';print_r($return_array);die;       
       return     json_decode(json_encode($return_array), FALSE);
   
   }
  public function get_leader_date_wise_grand_and_aid($table,$dateFrom=NULL,$dateTo=NULL,$fromCode=NULL,$toCode=NULL){

                    
                   $this->db->join('gl_amount_transition','gl_amount_transition.gl_at_id=gl_amount_details.gl_ad_atId');
                   $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');
                   $this->db->where('payment_date BETWEEN "'.date('Y-m-d', strtotime($dateFrom)).'" and "'.date('Y-m-d', strtotime($dateTo)).'"');
                    if($fromCode !="" && $toCode !=''):
                       $this->db->where('fn_coa_mc_code BETWEEN "'.$fromCode.'" and "'.$toCode.'"');
//                       $this->db->where('gl_ad_coa_mc_pk BETWEEN "'.$fromCode.'" and "'.$toCode.'"');
                   endif;
                   $this->db->where('gl_amount_transition.fn_account_type_id', 3);
                    $this->db->group_by('gl_ad_coa_mc_pk');
                    $this->db->order_by('gl_ad_coa_mc_id');
         $result =  $this->db->get($table)->result();
 
            $return_array = array();
            foreach($result as $row):
                $where = array(
                    'gl_at_id'=>$row->gl_ad_atId,
                    'vocher_status'=>2,
                     'gl_amount_transition.fn_account_type_id' => 3
                );
                $check = $this->db->where($where)->get('gl_amount_transition')->row();
                
                if(!empty($check)):
                    $return_array[] = array(
                        'gl_ad_id'              => $row->gl_ad_id,
                        'gl_ad_atId'            => $row->gl_ad_atId,
                        'payment_date'          => $row->payment_date,
                        'gl_ad_cost_center'     => $row->gl_ad_cost_center,
                        'gl_ad_coa_mc_id'       => $row->gl_ad_coa_mc_id,
                        'gl_ad_coa_mc_name'     => $row->fn_coa_mc_title,
                        'gl_ad_coa_mc_pk'       => $row->gl_ad_coa_mc_pk,
                        'gl_ad_depit'           => $row->gl_ad_depit,
                        'gl_ad_credit'          => $row->gl_ad_credit,
                        'gl_ad_dateTime'        => $row->gl_ad_dateTime,
                        'gl_ad_userId'          => $row->gl_ad_userId,
                        'gl_ad_userId_up'       => $row->gl_ad_userId_up,
                        'gl_ad_dateTime_up'     => $row->gl_ad_dateTime_up,
                        'fn_coa_mc_id'          => $row->fn_coa_mc_id,
                        'fn_coa_pId'            => $row->fn_coa_pId,
                        'fn_coa_mc_mId'         => $row->fn_coa_mc_mId,
                        'fn_coa_mc_code'        => $row->fn_coa_mc_code,
                        'fn_coa_mc_title'       => $row->fn_coa_mc_title,
                        'fn_coa_mc_comments'    => $row->fn_coa_mc_comments,
                        'fn_coa_mc_status'      => $row->fn_coa_mc_status,
                        'fn_coa_mc_trash'       => $row->fn_coa_mc_trash,
                        'fn_coa_mc_timestamp'   => $row->fn_coa_mc_timestamp,
                        'fn_coa_mc_userId'      => $row->fn_coa_mc_userId,
                        'fn_coa_mc_upTimestamp' => $row->fn_coa_mc_upTimestamp,
                        'fn_coa_mc_upUserId'    => $row->fn_coa_mc_upUserId,
                        'fn_coa_mc_upUserId'    => $row->fn_coa_mc_upUserId,
                        'fn_coa_mc_upUserId'    => $row->fn_coa_mc_upUserId,
                    );
                endif;
                
                
            endforeach;
       return     json_decode(json_encode($return_array), FALSE);
            return $return_array;
   }
   
   public function trail_balance_all_heads_grand_and_aid($table,$dateFrom=NULL,$dateTo=NULL,$fromCode=NULL,$toCode=NULL){

                 $this->db->order_by('fn_coa_mc_code','asc');
//                 $this->db->join('gl_amount_details','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk','left outer');
         return  $this->db->get_where('fn_coa_master_sub_child',array('fn_account_type_id'=>3))->result();
          
   }
      public function trial_balance_export_grand_and_aid($date){
 
         
         
        $where = array(
                    'fn_coa_status'     => 1,
                    'fn_coa_trash'      => 1,
                    'fn_account_type_id'=> 3
                );
         
         
         $trialBalance = $this->CRUDModel->get_where_result('fn_coa_parent',$where);
         
         
           $return_array = '';
           $totalCredit2 ='';
           $totalDebit2  ='';
            
             foreach($trialBalance as $GLRow):
                   

                        $master_child = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_pId'=>$GLRow->fn_coaId,'fn_account_type_id'=> 3));
                        $where_TB = '';
                        
                        $totalCredit1 ='';
                        $totalDebit1  =''; 
                        
                        
                        foreach($master_child as $mcRow):
 
                                        $where_TB['fn_coa_mc_mId']      = $mcRow->fn_coa_m_cId;
                                        $where_TB['fn_coa_mc_status']   = 1;
                                        $where_TB['fn_coa_mc_trash']    = 1;
                                        $where_TB['gl_amount_transition.fn_account_type_id'] = 3;
                                        $master_child_sub = $this->FinanceModel->amount_transitionDetails($where_TB,$date['fromDate'],$date['toDate']);
                                        
                                        $totalCredit = '';
                                        $totalDebit  = '';
                                       
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
                                            
                            
                                                
                                                $return_array[] = array(
                                                   'fn_coa_mc_code'     => $mscRow->fn_coa_mc_code, 
                                                   'fn_coa_mc_title'    => $mscRow->fn_coa_mc_title, 
                                                   'grandDebit'         => $grandDebit, 
                                                   'grandCredit'        => $grandCredit, 
                                                );
                                                
                                                
                                                $totalCredit +=$mscRow->sumCredit;
                                                $totalDebit  +=$mscRow->sumDebit;

                                        endforeach;
                                     
                                        $totalCredit1 +=$totalCredit;
                                        $totalDebit1  +=$totalDebit; 

                        endforeach;
                        $totalCredit2 +=$totalCredit1;
                        $totalDebit2  +=$totalDebit1; 
                endforeach;
                   $return_array[] = array(
                                                   'fn_coa_mc_code'     => '', 
                                                   'fn_coa_mc_title'    => 'Total', 
                                                   'grandDebit'         => $totalDebit2, 
                                                   'grandCredit'        => $totalCredit2, 
                                                );
         
       return  $return_array;
}
   public function search_date_range_limit_grand_and_aid($where=NULL,$date=NULL){
      
                if($where):
                    $this->db->where($where);
                endif;
                if(!empty($date)):
                    $this->db->where('gl_at_date BETWEEN "'.date('Y-m-d', strtotime($date['from_date'])).'" and "'.date('Y-m-d', strtotime($date['to_date'])).'"');
                endif;
                $this->db->where('vocher_status','1');
                $this->db->order_by('gl_at_vocher','desc');
                $this->db->limit('20','0');
       return    $this->db->get('gl_amount_transition')->result();
 }
   public function search_date_range_grand_and_aid($where=NULL,$date=NULL,$like=NULL,$payDate=NULL,$deposit_amount){

                
                if(!empty($date)):
                    $this->db->where('gl_at_date BETWEEN "'.date('Y-m-d', strtotime($date['from_date'])).'" and "'.date('Y-m-d', strtotime($date['to_date'])).'"');
                endif;
                if(!empty($payDate)):
                    $this->db->where('payment_date BETWEEN "'.date('Y-m-d', strtotime($payDate['pfrom_date'])).'" and "'.date('Y-m-d', strtotime($payDate['pto_date'])).'"');
                endif;
                
                
                $this->db->order_by('gl_at_vocher','desc');
                $this->db->group_by('gl_at_id');
                 $this->db->join('gl_amount_details','gl_amount_details.gl_ad_atId=gl_amount_transition.gl_at_id');
                 if($where):
                    $this->db->where($where);
                endif;
                if($like):
                    $this->db->like($like);
                endif;
                if($deposit_amount):
                    $this->db->where('gl_ad_depit',$deposit_amount);
                    $this->db->or_where('gl_ad_credit',$deposit_amount);
                endif;
       return    $this->db->get('gl_amount_transition')->result();
 }
}
