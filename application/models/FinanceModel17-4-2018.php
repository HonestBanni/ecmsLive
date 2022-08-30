<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class FinanceModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
    }
     
    public function coa_master($table,$where){
        
          $query =      $this->db->select('*')
                        ->join('fn_coa_parent','fn_coa_parent.fn_coaId=fn_coa_master_child.fn_coa_m_pId')
                        ->order_by('fn_coa_m_code','asc')
                        ->where($where)
                        ->get($table);
        return $query->result();
    }
    public function coa_master_subChild($table,$where){
        
          $query =      $this->db->select('*')
                        ->join('fn_coa_master_child','fn_coa_master_child.fn_coa_m_cId=fn_coa_master_sub_child.fn_coa_mc_mId')
                        ->join('fn_coa_parent','fn_coa_parent.fn_coaId=fn_coa_master_child.fn_coa_m_pId')
                        ->where($where)
                        ->order_by('fn_coa_mc_code','asc')
                        
                        ->get($table);
        return $query->result();
    }
    public function coa_master_subChildRow($table,$where){
        
          $query =      $this->db->select('*')
                        ->join('fn_coa_master_child','fn_coa_master_child.fn_coa_m_cId=fn_coa_master_sub_child.fn_coa_mc_mId')
                        ->join('fn_coa_parent','fn_coa_parent.fn_coaId=fn_coa_master_child.fn_coa_m_pId')
                        ->order_by('fn_coa_mc_code','asc')
                        ->where($where)
                        ->get($table);
        return $query->row();
    }
    
    public function autocomplete_amount($table,$like=NULL){
               $this->db->SELECT('*');
                   $this->db->FROM($table);
                   $this->db->where('fn_coa_mc_status',1);
                   $this->db->where('fn_coa_mc_trash',1);
               if($like):
                   $this->db->like('fn_coa_mc_title',$like);
                   $this->db->or_like('fn_coa_mc_code',$like);   
               endif;

               $this->db->order_by('fn_coa_mc_code','asc');
               $this->db->limit(7,0);
                $query =$this->db->get();
               return $query->result();
      }   
    public function autocomplete_emp($table,$like=NULL){
               $this->db->SELECT('*');
                   $this->db->FROM($table);
                   $this->db->where('emp_status_id',1);
               if($like):
                   $this->db->like('emp_name',$like);
                   $this->db->or_like('emp_id',$like);

               endif;

               $this->db->order_by('emp_name','asc');
               $this->db->limit(7,0);
                $query =$this->db->get();
               return $query->result();
      }

      public function Genderl_ledger_report($dateFrom=NULL,$dateTo=NULL,$fromCode=NULL,$toCode=NULL){
                    $this->db->select('
                                fn_coa_master_sub_child.fn_coa_mc_code,
                                fn_coa_master_sub_child.fn_coa_mc_title,
                                gl_amount_transition.payment_date,
                                gl_amount_transition.gl_at_vocher,
                                gl_amount_details.gl_ad_coa_mc_pk,
                                fn_coa_master_sub_child.fn_coa_mc_id,
                                fn_coa_master_sub_child.fn_coa_pId,
                                fn_coa_parent.fn_coa_title,
                            ');
                    $this->db->join('gl_amount_details','gl_amount_details.gl_ad_atId=gl_amount_transition.gl_at_id');
                    $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');
                    $this->db->join('fn_coa_parent','fn_coa_parent.fn_coaId=fn_coa_master_sub_child.fn_coa_pId');
                    $this->db->where('gl_amount_transition.payment_date BETWEEN "'.date('Y-m-d', strtotime($dateFrom)).'" and "'.date('Y-m-d', strtotime($dateTo)).'"');
                    if($fromCode !="" && $toCode !=''):
                        
                        $this->db->where('fn_coa_master_sub_child.fn_coa_mc_id BETWEEN "'.$fromCode.'" and "'.$toCode.'"');
                   endif;
                    $this->db->group_by('fn_coa_mc_id');
                    $this->db->order_by('fn_coa_master_sub_child.fn_coa_mc_code','asc');
                    $this->db->where('vocher_status','2');
         
            $result =  $this->db->get('gl_amount_transition')->result();
             
            $return_array = array();
            $Ledger_report = '';
            foreach($result as $row):
                
                $details =  $this->Ledger_Head_Title_Details(array('gl_ad_coa_mc_pk'=>$row->gl_ad_coa_mc_pk),$dateFrom,$dateTo);
                $details_array = '';
                
               if(!empty($details)):
                    $COA_titles = '';
                    $grandCredit = '';
                    $grandDebit     = '';
                    
                    $gDebit = '';
                    $gCredit = '';
                    foreach($details as $rowDetl):
                        $gDebit     += $rowDetl->gl_ad_depit;
                        $gCredit    += $rowDetl->gl_ad_credit;
//*****************************
//Opening Balance
//*****************************
                     $where = array(
                        'gl_ad_coa_mc_pk'   => $rowDetl->gl_ad_coa_mc_pk,
                        'payment_date <'      => date('Y-m-d', strtotime($dateFrom)),
                        );
                    $open_balance       = $this->open_balance($where);   
                    
                    $Credit_open    = '';
                    $Debit_open     = '';
                    $gCredit_open   = '';
                    $gDebit_open    = '';
                    foreach($open_balance as $rowOb):
                        
                        $current_fy  = $this->db->where('status',1)->get('financial_year')->row();
                        
                        if($row->fn_coa_pId == 1):
                            $Debit_open         += $rowOb->gl_ad_depit ;
                            $Credit_open        += $rowOb->gl_ad_credit; 
                            $gCredit_open       = $Credit_open-$Debit_open;
                            $gDebit_open        = '';
                        endif;
                        if($row->fn_coa_pId == 2):
                            $Debit_open         += $rowOb->gl_ad_depit ;
                            $Credit_open        += $rowOb->gl_ad_credit; 
                            $gCredit_open       = '';
                            $gDebit_open        = $Debit_open-$Credit_open;
                        endif;
                        if($row->fn_coa_pId == 4):
                            
                            $dateDiff   = date_diff(date_create(date('Y-m-d', strtotime($current_fy->year_start))),date_create($rowOb->gl_ad_date));
                            $timeStart  = $dateDiff->format("%R%a");
                             if($timeStart > 0):
                                $Debit_open         += $rowOb->gl_ad_depit ;
                                $Credit_open        += $rowOb->gl_ad_credit; 
                                $gCredit_open       = $Credit_open-$Debit_open;
                                $gDebit_open        = '';
                                 
                             endif;
                            
                        endif;
                        if($row->fn_coa_pId == 5):
                            
                            $dateDiff   = date_diff(date_create(date('Y-m-d', strtotime($current_fy->year_start))),date_create($rowOb->gl_ad_date));
                            $timeStart  = $dateDiff->format("%R%a");
                             if($timeStart > 0):
                                $Debit_open         += $rowOb->gl_ad_depit ;
                                $Credit_open        += $rowOb->gl_ad_credit; 
                                $gCredit_open       = '';
                                $gDebit_open        = $Debit_open-$Credit_open;
                                 
                             endif;
                            
                        endif;
                        
                    endforeach;
                    
                    
                    
                        
                    if($row->fn_coa_pId == 1 || $row->fn_coa_pId == 4):
                            $grandCredit = $gCredit-$gDebit;
                            $grandDebit  = '';
                    endif;
                    if($row->fn_coa_pId == 2 || $row->fn_coa_pId == 5):

                        $grandCredit = '';
                        $grandDebit  = $gDebit-$gCredit;
                    endif;
                    $coa_title_where = array(
                      'gl_ad_atId'          => $rowDetl->gl_at_id,  
                      'gl_ad_coa_mc_pk !='  => $row->fn_coa_mc_id,  
                    );
                    
                                    $this->db->select('fn_coa_mc_title');
                                    $this->db->join('gl_amount_details','gl_amount_details.gl_ad_coa_mc_pk=fn_coa_master_sub_child.fn_coa_mc_id');
                    $coa_titles =   $this->db->get_where('fn_coa_master_sub_child',$coa_title_where)->result();
                    $coaTitle   =   '';
                    $cout       =   count($coa_titles);
                    $sn         =   '';
                    
                    foreach($coa_titles as $coaRow):
                        $sn++;
                        if($cout ==$sn):
                            $coaTitle .= $coaRow->fn_coa_mc_title;
                            else:
                            $coaTitle .= $coaRow->fn_coa_mc_title.', ';
                        endif;
                    endforeach;
                     $details_array[] = array(
                        
                       'Transuction_PK' => $rowDetl->gl_at_id,
                       'Payment_date'   => $rowDetl->payment_date,
                       'Vocher_no'      => $rowDetl->gl_at_vocher,
                       'COA'            => $coaTitle,
                       'Description'    => $rowDetl->gl_at_description,
                       'Payee'          => $rowDetl->gl_at_payeeId,
                       'Cheque'         => $rowDetl->gl_at_cheque,
                       'Debit'          => $rowDetl->gl_ad_depit,
                       'Credit'         => $rowDetl->gl_ad_credit,
                       
                   );
                   
               endforeach;
                  
                //Head Title Details
                $Ledger_report[] = array(
                    'Parent_PK'         => $row->fn_coa_pId,
                    'Parent_Title'      => $row->fn_coa_title,
                    'Head_PK'           => $row->fn_coa_mc_id,
                    'Sub_Child_Title'   => $row->fn_coa_mc_title,
                    'Sub_Csshild_Code'  => $row->fn_coa_mc_code,
                    'From_date'         => $dateFrom,
                    'To_date'           => $dateTo,
                    'Opening_Balance'   => $gCredit_open.$gDebit_open,
                    'Closing_balance'   => $gCredit_open+$grandCredit.$gDebit_open+$grandDebit,
                    'Details'           => $details_array,
                    'tDebit'            => $gDebit,
                    'tCredit'           => $gCredit,
                    'gDebit'            => $grandDebit,
                    'gCredit'           => $grandCredit,
                ); 
               endif;
            endforeach;
          
       return     json_decode(json_encode($Ledger_report), FALSE);
            
   }
 
   public function Ledger_Head_Title_Details($where=NULL,$dateFrom,$dateTo){
            
                    $this->db->join('gl_amount_details','gl_amount_transition.gl_at_id=gl_amount_details.gl_ad_atId');
                    $this->db->where('payment_date BETWEEN "'.date('Y-m-d', strtotime($dateFrom)).'" and "'.date('Y-m-d', strtotime($dateTo)).'"');
//                    $this->db->group_by('gl_at_id');
                    $this->db->where('vocher_status',2);
                   $this->db->order_by('payment_date','asc');
                   $this->db->order_by('gl_at_vocher','asc');
                  
       return $this->db->where($where)->get('gl_amount_transition')->result();
      
    }
public function get_leader_dw($table,$dateFrom=NULL,$dateTo=NULL,$fromCode=NULL,$toCode=NULL){

                   $this->db->select('*');
                   $this->db->from($table);
                   $this->db->join('gl_amount_transition','gl_amount_transition.gl_at_id=gl_amount_details.gl_ad_atId');
                   $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');
                   $this->db->where('payment_date BETWEEN "'.date('Y-m-d', strtotime($dateFrom)).'" and "'.date('Y-m-d', strtotime($dateTo)).'"');
                    if($fromCode !="" && $toCode !=''):
                       $this->db->where('gl_ad_coa_mc_pk BETWEEN "'.$fromCode.'" and "'.$toCode.'"');
                   endif;
                   
                    $this->db->group_by('gl_ad_coa_mc_pk');
                    $this->db->order_by('gl_ad_coa_mc_id');
         $result =  $this->db->get()->result();
 
            $return_array = array();
            foreach($result as $row):
                $where = array(
                    'gl_at_id'=>$row->gl_ad_atId,
                    'vocher_status'=>2,
                );
                $check = $this->db->where($where)->get('gl_amount_transition')->row();
                
                if(!empty($check)):
                    $return_array[] = array(
                        'gl_ad_id' => $row->gl_ad_id,
                        'gl_ad_atId' => $row->gl_ad_atId,
                        'payment_date' => $row->payment_date,
                        'gl_ad_cost_center' => $row->gl_ad_cost_center,
                        'gl_ad_coa_mc_id' => $row->gl_ad_coa_mc_id,
                        'gl_ad_coa_mc_name' => $row->gl_ad_coa_mc_name,
                        'gl_ad_coa_mc_pk' => $row->gl_ad_coa_mc_pk,
                        'gl_ad_depit' => $row->gl_ad_depit,
                        'gl_ad_credit' => $row->gl_ad_credit,
                        'gl_ad_dateTime' => $row->gl_ad_dateTime,
                        'gl_ad_userId' => $row->gl_ad_userId,
                        'gl_ad_userId_up' => $row->gl_ad_userId_up,
                        'gl_ad_dateTime_up' => $row->gl_ad_dateTime_up,
                        'fn_coa_mc_id' => $row->fn_coa_mc_id,
                        'fn_coa_pId' => $row->fn_coa_pId,
                        'fn_coa_mc_mId' => $row->fn_coa_mc_mId,
                        'fn_coa_mc_code' => $row->fn_coa_mc_code,
                        'fn_coa_mc_title' => $row->fn_coa_mc_title,
                        'fn_coa_mc_comments' => $row->fn_coa_mc_comments,
                        'fn_coa_mc_status' => $row->fn_coa_mc_status,
                        'fn_coa_mc_trash' => $row->fn_coa_mc_trash,
                        'fn_coa_mc_timestamp' => $row->fn_coa_mc_timestamp,
                        'fn_coa_mc_userId' => $row->fn_coa_mc_userId,
                        'fn_coa_mc_upTimestamp' => $row->fn_coa_mc_upTimestamp,
                        'fn_coa_mc_upUserId' => $row->fn_coa_mc_upUserId,
                        'fn_coa_mc_upUserId' => $row->fn_coa_mc_upUserId,
                        'fn_coa_mc_upUserId' => $row->fn_coa_mc_upUserId,
                    );
                endif;
                
                
            endforeach;
       return     json_decode(json_encode($return_array), FALSE);
            return $return_array;
   }
   public function get_leader_dw_old($table,$dateFrom=NULL,$dateTo=NULL,$fromCode=NULL,$toCode=NULL){

                   $this->db->select('*');
                   $this->db->from($table);
                   $this->db->join('gl_amount_transition','gl_amount_transition.gl_at_id=gl_amount_details.gl_ad_atId');
                   $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');
                   $this->db->where('gl_ad_date BETWEEN "'.date('Y-m-d', strtotime($dateFrom)).'" and "'.date('Y-m-d', strtotime($dateTo)).'"');
                    if($fromCode !="" && $toCode !=''):
                       $this->db->where('gl_ad_coa_mc_pk BETWEEN "'.$fromCode.'" and "'.$toCode.'"');
                   endif;
                   
                    $this->db->group_by('gl_ad_coa_mc_pk');
                    $this->db->order_by('gl_ad_coa_mc_id');
         $result =  $this->db->get()->result();
 
            $return_array = array();
            foreach($result as $row):
                $where = array(
                    'gl_at_id'=>$row->gl_ad_atId,
                    'vocher_status'=>2,
                );
                $check = $this->db->where($where)->get('gl_amount_transition')->row();
                
                if(!empty($check)):
                    $return_array[] = array(
                        'gl_ad_id' => $row->gl_ad_id,
                        'gl_ad_atId' => $row->gl_ad_atId,
                        'payment_date' => $row->gl_ad_date,
                        'gl_ad_cost_center' => $row->gl_ad_cost_center,
                        'gl_ad_coa_mc_id' => $row->gl_ad_coa_mc_id,
                        'gl_ad_coa_mc_name' => $row->gl_ad_coa_mc_name,
                        'gl_ad_coa_mc_pk' => $row->gl_ad_coa_mc_pk,
                        'gl_ad_depit' => $row->gl_ad_depit,
                        'gl_ad_credit' => $row->gl_ad_credit,
                        'gl_ad_dateTime' => $row->gl_ad_dateTime,
                        'gl_ad_userId' => $row->gl_ad_userId,
                        'gl_ad_userId_up' => $row->gl_ad_userId_up,
                        'gl_ad_dateTime_up' => $row->gl_ad_dateTime_up,
                        'fn_coa_mc_id' => $row->fn_coa_mc_id,
                        'fn_coa_pId' => $row->fn_coa_pId,
                        'fn_coa_mc_mId' => $row->fn_coa_mc_mId,
                        'fn_coa_mc_code' => $row->fn_coa_mc_code,
                        'fn_coa_mc_title' => $row->fn_coa_mc_title,
                        'fn_coa_mc_comments' => $row->fn_coa_mc_comments,
                        'fn_coa_mc_status' => $row->fn_coa_mc_status,
                        'fn_coa_mc_trash' => $row->fn_coa_mc_trash,
                        'fn_coa_mc_timestamp' => $row->fn_coa_mc_timestamp,
                        'fn_coa_mc_userId' => $row->fn_coa_mc_userId,
                        'fn_coa_mc_upTimestamp' => $row->fn_coa_mc_upTimestamp,
                        'fn_coa_mc_upUserId' => $row->fn_coa_mc_upUserId,
                        'fn_coa_mc_upUserId' => $row->fn_coa_mc_upUserId,
                        'fn_coa_mc_upUserId' => $row->fn_coa_mc_upUserId,
                    );
                endif;
                
                
            endforeach;
       return     json_decode(json_encode($return_array), FALSE);
            return $return_array;
   }
   
      public function get_amountDetails($table,$where=NULL,$dateFrom,$dateTo){
            
                   $this->db->join('gl_amount_details','gl_amount_transition.gl_at_id=gl_amount_details.gl_ad_atId');
                    $this->db->where('payment_date BETWEEN "'.date('Y-m-d', strtotime($dateFrom)).'" and "'.date('Y-m-d', strtotime($dateTo)).'"');

                    $this->db->where('vocher_status',2);
                    $this->db->order_by('payment_date','asc');
                    $this->db->order_by('gl_at_vocher','asc');
      return $this->db->where($where)->get('gl_amount_transition')->result();
      
    }
      public function get_amountDetails_old($table,$where=NULL,$dateFrom,$dateTo){
            
                   $this->db->join('gl_amount_details','gl_amount_transition.gl_at_id=gl_amount_details.gl_ad_atId');
                    $this->db->where('gl_at_date BETWEEN "'.date('Y-m-d', strtotime($dateFrom)).'" and "'.date('Y-m-d', strtotime($dateTo)).'"');

                    $this->db->where('vocher_status',2);
                    $this->db->order_by('gl_at_date','asc');
                    $this->db->order_by('gl_at_vocher','asc');
      return $this->db->where($where)->get('gl_amount_transition')->result();
      
    }
//     public function get_leader_dw($table,$dateFrom=NULL,$dateTo=NULL,$fromCode=NULL,$toCode=NULL){
//
//                   $this->db->select('*');
//                   $this->db->from($table);
//                   $this->db->join('gl_amount_transition','gl_amount_transition.gl_at_id=gl_amount_details.gl_ad_atId');
//                   $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');
//                   $this->db->where('payment_date BETWEEN "'.date('Y-m-d', strtotime($dateFrom)).'" and "'.date('Y-m-d', strtotime($dateTo)).'"');
//                    if($fromCode !="" && $toCode !=''):
//                       $this->db->where('gl_ad_coa_mc_pk BETWEEN "'.$fromCode.'" and "'.$toCode.'"');
//                   endif;
//                   
//                    $this->db->group_by('gl_ad_coa_mc_pk');
//                    $this->db->order_by('gl_ad_coa_mc_id');
//         $result =  $this->db->get()->result();
//         
// 
////         $result =  $this->db->get()->result();
//            $return_array = array();
//            foreach($result as $row):
//                $where = array(
//                    'gl_at_id'=>$row->gl_ad_atId,
//                    'vocher_status'=>2,
//                );
//                $check = $this->db->where($where)->get('gl_amount_transition')->row();
//                
//                if(!empty($check)):
//                    $return_array[] = array(
//                        'gl_ad_id' => $row->gl_ad_id,
//                        'gl_ad_atId' => $row->gl_ad_atId,
//                        'gl_ad_date' => $row->gl_ad_date,
//                        'gl_ad_cost_center' => $row->gl_ad_cost_center,
//                        'gl_ad_coa_mc_id' => $row->gl_ad_coa_mc_id,
//                        'gl_ad_coa_mc_name' => $row->gl_ad_coa_mc_name,
//                        'gl_ad_coa_mc_pk' => $row->gl_ad_coa_mc_pk,
//                        'gl_ad_depit' => $row->gl_ad_depit,
//                        'gl_ad_credit' => $row->gl_ad_credit,
//                        'gl_ad_dateTime' => $row->gl_ad_dateTime,
//                        'gl_ad_userId' => $row->gl_ad_userId,
//                        'gl_ad_userId_up' => $row->gl_ad_userId_up,
//                        'gl_ad_dateTime_up' => $row->gl_ad_dateTime_up,
//                        'fn_coa_mc_id' => $row->fn_coa_mc_id,
//                        'fn_coa_pId' => $row->fn_coa_pId,
//                        'fn_coa_mc_mId' => $row->fn_coa_mc_mId,
//                        'fn_coa_mc_code' => $row->fn_coa_mc_code,
//                        'fn_coa_mc_title' => $row->fn_coa_mc_title,
//                        'fn_coa_mc_comments' => $row->fn_coa_mc_comments,
//                        'fn_coa_mc_status' => $row->fn_coa_mc_status,
//                        'fn_coa_mc_trash' => $row->fn_coa_mc_trash,
//                        'fn_coa_mc_timestamp' => $row->fn_coa_mc_timestamp,
//                        'fn_coa_mc_userId' => $row->fn_coa_mc_userId,
//                        'fn_coa_mc_upTimestamp' => $row->fn_coa_mc_upTimestamp,
//                        'fn_coa_mc_upUserId' => $row->fn_coa_mc_upUserId,
//                        'fn_coa_mc_upUserId' => $row->fn_coa_mc_upUserId,
//                        'fn_coa_mc_upUserId' => $row->fn_coa_mc_upUserId,
//                    );
//                endif;
//                
//                
//            endforeach;
//       return     json_decode(json_encode($return_array), FALSE);
//            return $return_array;
//   }
//      public function get_amountDetails($table,$where=NULL,$dateFrom,$dateTo){
//            
//                    $this->db->join('gl_amount_details','gl_amount_transition.gl_at_id=gl_amount_details.gl_ad_atId');
//                    $this->db->where('payment_date BETWEEN "'.date('Y-m-d', strtotime($dateFrom)).'" and "'.date('Y-m-d', strtotime($dateTo)).'"');
////                    $this->db->group_by('gl_ad_atId');
////                    $this->db->group_by('gl_at_id');
//                    $this->db->where('vocher_status',2);
//                   $this->db->order_by('payment_date','asc');
//                   $this->db->order_by('gl_at_vocher','asc');
//                  
//       return $this->db->where($where)->get('gl_amount_transition')->result();
//      
//    }
    public function open_balance($where=NULL){
                
                      
                   $this->db->join('gl_amount_details','gl_amount_transition.gl_at_id=gl_amount_details.gl_ad_atId');
                    $this->db->where('vocher_status',2);
                   $this->db->order_by('payment_date','asc');
                  
       return $this->db->where($where)->get('gl_amount_transition')->result();
      
    }
    public function open_balance_old($where=NULL){
                
                      
                   $this->db->join('gl_amount_details','gl_amount_transition.gl_at_id=gl_amount_details.gl_ad_atId');
                    $this->db->where('vocher_status',2);
                   $this->db->order_by('gl_at_date','asc');
                  
       return $this->db->where($where)->get('gl_amount_transition')->result();
      
    }
 
    public function amount_transitionDetails($where,$fromDate,$toDate){
                $this->db->select('fn_coa_master_sub_child.*, sum(gl_ad_credit) as sumCredit,sum(gl_ad_depit) as sumDebit');
                $this->db->from('gl_amount_transition');
                $this->db->join('gl_amount_details','gl_amount_details.gl_ad_atId=gl_amount_transition.gl_at_id');
                $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');
//                $this->db->group_by('gl_ad_coa_mc_id');
                $this->db->group_by('fn_coa_mc_code');
                $this->db->order_by('fn_coa_mc_code','asc');
                 $this->db->where('vocher_status',2);
                $this->db->where('payment_date BETWEEN "'.date('Y-m-d', strtotime($fromDate)).'" and "'.date('Y-m-d', strtotime($toDate)).'"');
                $this->db->where($where);
         return  $this->db->get()->result();
        
              
    }
     public function amount_transitionDetailsold($where,$fromDate,$toDate){
                $this->db->select('fn_coa_master_sub_child.*, sum(gl_ad_credit) as sumCredit,sum(gl_ad_depit) as sumDebit');
                $this->db->from('gl_amount_transition');
                $this->db->join('gl_amount_details','gl_amount_details.gl_ad_atId=gl_amount_transition.gl_at_id');
                $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');
//                $this->db->group_by('gl_ad_coa_mc_id');
                $this->db->group_by('fn_coa_mc_code');
                $this->db->order_by('fn_coa_mc_code','asc');
                 $this->db->where('vocher_status',2);
                $this->db->where('gl_at_date BETWEEN "'.date('Y-m-d', strtotime($fromDate)).'" and "'.date('Y-m-d', strtotime($toDate)).'"');
                $this->db->where($where);
         return  $this->db->get()->result();
        
              
    }
    
    public function opening_trail_balance($where,$from){
        
                  $this->db->select('fn_coa_master_sub_child.*, sum(gl_ad_credit) as sumCredit,sum(gl_ad_depit) as sumDebit');
          
                $this->db->join('gl_amount_details','gl_amount_details.gl_ad_atId=gl_amount_transition.gl_at_id');
                $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');
//                $this->db->group_by('gl_ad_coa_mc_id');
                $this->db->group_by('fn_coa_mc_code');
                $this->db->order_by('fn_coa_mc_code','asc');
                 $this->db->where('vocher_status',2);
//                $this->db->where('gl_ad_date BETWEEN "'.date('Y-m-d', strtotime($fromDate)).'" and "'.date('Y-m-d', strtotime($toDate)).'"');
                $this->db->where('gl_ad_date <',date('Y-m-d', strtotime($from)));
                $this->db->where($where);
         return  $this->db->get('gl_amount_transition')->row();
    }
    public function closing_trail_balance($where,$to){
        
                  $this->db->select('fn_coa_master_sub_child.*, sum(gl_ad_credit) as sumCredit,sum(gl_ad_depit) as sumDebit');
          
                $this->db->join('gl_amount_details','gl_amount_details.gl_ad_atId=gl_amount_transition.gl_at_id');
                $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');
//                $this->db->group_by('gl_ad_coa_mc_id');
                $this->db->group_by('fn_coa_mc_code');
                $this->db->order_by('fn_coa_mc_code','asc');
                 $this->db->where('vocher_status',2);
//                $this->db->where('gl_ad_date BETWEEN "'.date('Y-m-d', strtotime($fromDate)).'" and "'.date('Y-m-d', strtotime($toDate)).'"');
                $this->db->where('gl_ad_date >',date('Y-m-d', strtotime($to)));
                $this->db->where($where);
         return  $this->db->get('gl_amount_transition')->row();
    }
    public function current_trail_balance($where,$from,$to){
        
                  $this->db->select('fn_coa_master_sub_child.*, sum(gl_ad_credit) as sumCredit,sum(gl_ad_depit) as sumDebit');
          
                $this->db->join('gl_amount_details','gl_amount_details.gl_ad_atId=gl_amount_transition.gl_at_id');
                $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');
//                $this->db->group_by('gl_ad_coa_mc_id');
                $this->db->group_by('fn_coa_mc_code');
                $this->db->order_by('fn_coa_mc_code','asc');
                 $this->db->where('vocher_status',2);
                $this->db->where('gl_ad_date BETWEEN "'.date('Y-m-d', strtotime($from)).'" and "'.date('Y-m-d', strtotime($to)).'"');
//                $this->db->where('gl_ad_date <',date('Y-m-d', strtotime($from)));
                $this->db->where($where);
         return  $this->db->get('gl_amount_transition')->row();
    }
   public function trial_balance_export($date){
 
         
         
        $where = array(
                   'fn_coa_status'  =>1,
                   'fn_coa_trash'   =>1 
                );
         
         
         $trialBalance = $this->CRUDModel->get_where_result('fn_coa_parent',$where);
         
         
           $return_array = '';
           $totalCredit2 ='';
           $totalDebit2  ='';
             foreach($trialBalance as $GLRow):
                   

                        $master_child = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_pId'=>$GLRow->fn_coaId));
                        $where_TB = '';
                        
                        $totalCredit1 ='';
                        $totalDebit1  =''; 
                        
                        
                        foreach($master_child as $mcRow):
 
                                        $where_TB['fn_coa_mc_mId']      =$mcRow->fn_coa_m_cId;
                                        $where_TB['fn_coa_mc_status']   =1;
                                        $where_TB['fn_coa_mc_trash']    =1;
                                        $master_child_sub = $this->FinanceModel->amount_transitionDetails($where_TB,$date['fromDate'],$date['toDate']);
                                        
                                        $totalCredit = '';
                                        $totalDebit  = '';
                                       
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
                                             
//                                             if(empty($grandDebit)):
//                                                 $grandDebit = 0;
//                                             else:
//                                                 $grandDebit = number_format($grandDebit, 0, ',', ',');
//                                             endif;
 
//                                                  if(empty($grandCredit)):
//                                                        $grandCredit = 0;
//                                                  else:
//                                                       $grandCredit = number_format($grandCredit, 0, ',', ',');
//                                                    endif; 
 
                                                
                                                
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
    public function trial_balance($filed,$table,$where=NULL){
          $this->db->select($filed);
                    $this->db->from($table);
//                    if($date):
//                     $this->db->where('sle_saledates BETWEEN'.$date['fromDate'].'and'.$date['toDate']);   
//                    endif;
                    $this->db->where($where);
        $query =    $this->db->get('');
        return $query->row();
    }
 
    
    public function amount_transition_search($where,$like){
             $this->db->select('*');
                    $this->db->from('gl_amount_transition');
                    if(!empty($where)):
                  $this->db->where($where);
                    endif;
//                    if($where):
//                        $this->db->where('month(gl_at_date)',$where['month']);
//                        $this->db->where('gl_at_cb_jv',$where['cb_jv']);
//                        $this->db->where('year(gl_at_date)',$where['year']);
//                    endif;
                    
                    if($like):
                        $this->db->like('gl_at_payeeId',$like);
                        //  $this->db->or_like('gl_at_date',$like);
                        $this->db->or_like('gl_at_vocher',$like);
                        $this->db->or_like('gl_at_description',$like);
                       
                    endif;
                    $this->db->order_by('gl_at_id','desc');
                    
        $query =    $this->db->get('');
        return $query->result();
    }
    
    public function get_update_record($table,$where){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        return $this->db->get()->row();
    }
    
 public function student_dnoties($table,$where){
        $this->db->select('
                student_record.student_id,
                student_record.app_postal_address,
                student_record.mobile_no,
                student_record.student_name,
                programes_info.programe_name,
                student_record.college_no,
                student_record.father_name,
                student_record.mobile_no2,
                student_denotice.amount,
                student_denotice.print_date,
                student_denotice.due_date,
                student_denotice.count,
                student_dairy.title,
                sections.name,
                prospectus_batch.batch_name,
                ');
        $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
        $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
         $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id');
        $this->db->join('prospectus_batch','sections.batch_id=prospectus_batch.batch_id','left outer');
        $this->db->join('student_denotice','student_denotice.student_id=student_record.student_id','left outer');
        $this->db->join('student_dairy','student_denotice.sd_id=student_dairy.sd_id','left outer');
        $this->db->from($table);
        $this->db->where($where);
        return $this->db->get()->row();
    }
    
      public function get_detail_search($where=NULL,$date=NULL,$like=NULL,$amount){
//     
       
        $this->db->select('*');
        $this->db->join('fn_trm_type','fn_trm_type.ftt_id=gl_amount_transition.gl_at_cb_jv');
        $this->db->join('gl_amount_details','gl_amount_details.gl_ad_atId=gl_amount_transition.gl_at_id');
        
        $this->db->where('gl_at_date BETWEEN "'.date('Y-m-d', strtotime($date['dateform'])).'" and "'.date('Y-m-d', strtotime($date['dateto'])).'"');
       if(!empty($where)):
           $this->db->where($where);
       endif;
       if(!empty($like)):
          $this->db->like($like);
       endif;
       if(!empty($amount)):
           
          $this->db->where('gl_ad_depit',$amount );
          $this->db->or_where('gl_ad_credit',$amount);
       endif;
         $this->db->group_by('gl_at_vocher');
        return $this->db->get('gl_amount_transition')->result();
    }
  public function get_detail_search_general_journal($where=NULL,$date=NULL,$like=NULL,$amount,$order){
//     
       
        $this->db->select('*');
        $this->db->join('fn_trm_type','fn_trm_type.ftt_id=gl_amount_transition.gl_at_cb_jv');
        $this->db->join('gl_amount_details','gl_amount_details.gl_ad_atId=gl_amount_transition.gl_at_id');
        
        $this->db->where('gl_at_date BETWEEN "'.date('Y-m-d', strtotime($date['dateform'])).'" and "'.date('Y-m-d', strtotime($date['dateto'])).'"');
       if(!empty($where)):
           $this->db->where($where);
       endif;
       if(!empty($like)):
          $this->db->like($like);
       endif;
       if(!empty($amount)):
           
          $this->db->where('gl_ad_depit',$amount );
          $this->db->or_where('gl_ad_credit',$amount);
       endif;
         $this->db->group_by('gl_at_vocher');
          $this->db->order_by($order,'asc');
        return $this->db->get('gl_amount_transition')->result();
    }
    
  public function voucher_info($where){
      
                $this->db->join('fn_voucher_type','fn_voucher_type.id=gl_amount_transition.vocher_type');
      return    $this->db->where($where)->get('gl_amount_transition')->row();
  }
  public function attach_details($where){
      
                $this->db->join('fn_attachments','fn_attachments.id=fn_voucher_attachment.attach_id');
      return    $this->db->where($where)->get('fn_voucher_attachment')->result();
  }
  public function chart_of_acct($where){
      
                $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');
      return    $this->db->where($where)->get('gl_amount_details')->result();
  }
  
  public function finance_employee($like){
      
            if($like):

                $this->db->or_like('emp_name',$like);   
            endif;

               $this->db->order_by('emp_name','asc');
               $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer');
               return $this->db->where('emp_status_id',1)->get('hr_emp_record')->result();
               
      
  }
  public function finance_supplier_auto($like){
        if($like):
                $this->db->or_like('company_name',$like);   
        endif;

               $this->db->order_by('company_name','asc');
               
               return $this->db->where('status',1)->get('fn_supplier')->result();
               
      
  }
  public function get_financial_budget($table,$where=NULL){
      
                $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id='.$table.'.coa_id');
                $this->db->join('financial_year','financial_year.id='.$table.'.fy_id');
                if($where):
                    $this->db->where($where);
                endif;
      return    $this->db->get($table)->result();
  }
  public function search_date_range_limit($where=NULL,$date=NULL){
      
                if($where):
                    $this->db->where($where);
                endif;
                if(!empty($date)):
                    $this->db->where('gl_at_date BETWEEN "'.date('Y-m-d', strtotime($date['from_date'])).'" and "'.date('Y-m-d', strtotime($date['to_date'])).'"');
                endif;
                $this->db->order_by('gl_at_vocher','desc');
                $this->db->limit('20','0');
       return    $this->db->get('gl_amount_transition')->result();
 }
  public function search_date_range($where=NULL,$date=NULL){
      
                if($where):
                    $this->db->where($where);
                endif;
                if(!empty($date)):
                    $this->db->where('gl_at_date BETWEEN "'.date('Y-m-d', strtotime($date['from_date'])).'" and "'.date('Y-m-d', strtotime($date['to_date'])).'"');
                endif;
                $this->db->order_by('gl_at_vocher','desc');
                 
       return    $this->db->get('gl_amount_transition')->result();
 }
  public  function dropDownEmployee($table, $option=NULL,$value,$show,$where=NULL){
		$this->db->select('*');
               // $this->db->distinct();
                if($where):
                    $this->db->where($where);
                endif;
            
                    $this->db->order_by($show,'asc');
                
                         
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
                           
//                            $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id='.$table.'.current_designation','left outer');
                               $c_title =  $this->db->where('emp_desg_id',$row->current_designation)->get('hr_emp_designation')->row();
                            if($c_title):
                                $data[$row->$value] = $row->$show.'('.$c_title->title.')';
                                else:
                                $data[$row->$value] = $row->$show;
                            endif;
				
			}
			return $data;
		}
	} 
        public function trail_balance_new($table,$dateFrom=NULL,$dateTo=NULL,$fromCode=NULL,$toCode=NULL){

                   $this->db->select('*');
                   $this->db->from($table);
                   $this->db->join('gl_amount_transition','gl_amount_transition.gl_at_id=gl_amount_details.gl_ad_atId');
                   $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');
//                   $this->db->where('payment_date BETWEEN "'.date('Y-m-d', strtotime($dateFrom)).'" and "'.date('Y-m-d', strtotime($dateTo)).'"');
                    if($fromCode !="" && $toCode !=''):
                       $this->db->where('gl_ad_coa_mc_pk BETWEEN "'.$fromCode.'" and "'.$toCode.'"');
                   endif;
                   
                    $this->db->group_by('gl_ad_coa_mc_pk');
                    $this->db->order_by('gl_ad_coa_mc_id');
         $result =  $this->db->get()->result();
 
            $return_array = array();
            foreach($result as $row):
                $where = array(
                    'gl_at_id'=>$row->gl_ad_atId,
                    'vocher_status'=>2,
                );
                $check = $this->db->where($where)->get('gl_amount_transition')->row();
                
                if(!empty($check)):
                    $return_array[] = array(
                        'gl_ad_id' => $row->gl_ad_id,
                        'gl_ad_atId' => $row->gl_ad_atId,
                        'payment_date' => $row->payment_date,
                        'gl_ad_cost_center' => $row->gl_ad_cost_center,
                        'gl_ad_coa_mc_id' => $row->gl_ad_coa_mc_id,
                        'gl_ad_coa_mc_name' => $row->gl_ad_coa_mc_name,
                        'gl_ad_coa_mc_pk' => $row->gl_ad_coa_mc_pk,
                        'gl_ad_depit' => $row->gl_ad_depit,
                        'gl_ad_credit' => $row->gl_ad_credit,
                        'gl_ad_dateTime' => $row->gl_ad_dateTime,
                        'gl_ad_userId' => $row->gl_ad_userId,
                        'gl_ad_userId_up' => $row->gl_ad_userId_up,
                        'gl_ad_dateTime_up' => $row->gl_ad_dateTime_up,
                        'fn_coa_mc_id' => $row->fn_coa_mc_id,
                        'fn_coa_pId' => $row->fn_coa_pId,
                        'fn_coa_mc_mId' => $row->fn_coa_mc_mId,
                        'fn_coa_mc_code' => $row->fn_coa_mc_code,
                        'fn_coa_mc_title' => $row->fn_coa_mc_title,
                        'fn_coa_mc_comments' => $row->fn_coa_mc_comments,
                        'fn_coa_mc_status' => $row->fn_coa_mc_status,
                        'fn_coa_mc_trash' => $row->fn_coa_mc_trash,
                        'fn_coa_mc_timestamp' => $row->fn_coa_mc_timestamp,
                        'fn_coa_mc_userId' => $row->fn_coa_mc_userId,
                        'fn_coa_mc_upTimestamp' => $row->fn_coa_mc_upTimestamp,
                        'fn_coa_mc_upUserId' => $row->fn_coa_mc_upUserId,
                        'fn_coa_mc_upUserId' => $row->fn_coa_mc_upUserId,
                        'fn_coa_mc_upUserId' => $row->fn_coa_mc_upUserId,
                    );
                endif;
                
                
            endforeach;
       return     json_decode(json_encode($return_array), FALSE);
          
   }
   public function income_statement($dateFrom=NULL,$dateTo=NULL,$fromCode=NULL,$toCode=NULL){

                   $this->db->join('gl_amount_transition','gl_amount_transition.gl_at_id=gl_amount_details.gl_ad_atId');
                   $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');

                    $this->db->group_by('gl_ad_coa_mc_pk');
                    $this->db->order_by('gl_ad_coa_mc_id');
         $result =  $this->db->get('gl_amount_details')->result();
 
            $return_array = array();
            foreach($result as $row):
                $where = array(
                    'gl_at_id'      => $row->gl_ad_atId,
                    'vocher_status' => 2,
                );
                $check = $this->db->where($where)->get('gl_amount_transition')->row();
                
                if(!empty($check)):
//                    if($row->gl_ad_coa_mc_id >400000):
                        
                 
                    $return_array[] = array(
                        'gl_ad_id' => $row->gl_ad_id,
                        'gl_ad_atId' => $row->gl_ad_atId,
                        'payment_date' => $row->payment_date,
                        'gl_ad_cost_center' => $row->gl_ad_cost_center,
                        'gl_ad_coa_mc_id' => $row->gl_ad_coa_mc_id,
                        'gl_ad_coa_mc_name' => $row->gl_ad_coa_mc_name,
                        'gl_ad_coa_mc_pk' => $row->gl_ad_coa_mc_pk,
                        'gl_ad_depit' => $row->gl_ad_depit,
                        'gl_ad_credit' => $row->gl_ad_credit,
                        'gl_ad_dateTime' => $row->gl_ad_dateTime,
                        'gl_ad_userId' => $row->gl_ad_userId,
                        'gl_ad_userId_up' => $row->gl_ad_userId_up,
                        'gl_ad_dateTime_up' => $row->gl_ad_dateTime_up,
                        'fn_coa_mc_id' => $row->fn_coa_mc_id,
                        'fn_coa_pId' => $row->fn_coa_pId,
                        'fn_coa_mc_mId' => $row->fn_coa_mc_mId,
                        'fn_coa_mc_code' => $row->fn_coa_mc_code,
                        'fn_coa_mc_title' => $row->fn_coa_mc_title,
                        'fn_coa_mc_comments' => $row->fn_coa_mc_comments,
                        'fn_coa_mc_status' => $row->fn_coa_mc_status,
                        'fn_coa_mc_trash' => $row->fn_coa_mc_trash,
                        'fn_coa_mc_timestamp' => $row->fn_coa_mc_timestamp,
                        'fn_coa_mc_userId' => $row->fn_coa_mc_userId,
                        'fn_coa_mc_upTimestamp' => $row->fn_coa_mc_upTimestamp,
                        'fn_coa_mc_upUserId' => $row->fn_coa_mc_upUserId,
                        'fn_coa_mc_upUserId' => $row->fn_coa_mc_upUserId,
                        'fn_coa_mc_upUserId' => $row->fn_coa_mc_upUserId,
                    );
                endif;
//                   endif;
                
            endforeach;
//              echo '<pre>';print_r($return_array);die;       
       return     json_decode(json_encode($return_array), FALSE);
   
   }
   
public function get_income_statment($table,$where=NULL,$dateFrom,$dateTo){

               $this->db->join('gl_amount_details','gl_amount_transition.gl_at_id=gl_amount_details.gl_ad_atId');
                $this->db->where('payment_date BETWEEN "'.date('Y-m-d', strtotime($dateFrom)).'" and "'.date('Y-m-d', strtotime($dateTo)).'"');
                $this->db->where('gl_ad_coa_mc_pk BETWEEN 400000 and 700000');
                $this->db->where('vocher_status',2);
                $this->db->order_by('payment_date','asc');
                $this->db->order_by('gl_at_vocher','asc');
  return $this->db->where($where)->get('gl_amount_transition')->result();

}
public function search_result_brs($table,$dateFrom=NULL,$dateTo=NULL,$fromCode=NULL){

                   $this->db->select('*');
                   $this->db->from($table);
                   $this->db->join('gl_amount_transition','gl_amount_transition.gl_at_id=gl_amount_details.gl_ad_atId');
                   $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');
                   $this->db->where('payment_date BETWEEN "'.date('Y-m-d', strtotime($dateFrom)).'" and "'.date('Y-m-d', strtotime($dateTo)).'"');
                   
//                    if($fromCode !="" && $toCode !=''):
//                       $this->db->where('gl_ad_coa_mc_pk BETWEEN "'.$fromCode.'" and "'.$toCode.'"');
//                   endif;
                   $this->db->where('gl_ad_coa_mc_pk',$fromCode);
                    $this->db->group_by('gl_ad_coa_mc_pk');
                    $this->db->order_by('gl_ad_coa_mc_id');
         $result =  $this->db->get()->result();
 
            $return_array = array();
            foreach($result as $row):
                $where = array(
                    'gl_at_id'=>$row->gl_ad_atId,
                    'vocher_status'=>2,
                );
                $check = $this->db->where($where)->get('gl_amount_transition')->row();
                
                if(!empty($check)):
                    $return_array[] = array(
                        'gl_ad_id' => $row->gl_ad_id,
                        'gl_ad_atId' => $row->gl_ad_atId,
                        'payment_date' => $row->payment_date,
                        'gl_ad_cost_center' => $row->gl_ad_cost_center,
                        'gl_ad_coa_mc_id' => $row->gl_ad_coa_mc_id,
                        'gl_ad_coa_mc_name' => $row->gl_ad_coa_mc_name,
                        'gl_ad_coa_mc_pk' => $row->gl_ad_coa_mc_pk,
                        'gl_ad_depit' => $row->gl_ad_depit,
                        'gl_ad_credit' => $row->gl_ad_credit,
                        'gl_ad_dateTime' => $row->gl_ad_dateTime,
                        'gl_ad_userId' => $row->gl_ad_userId,
                        'gl_ad_userId_up' => $row->gl_ad_userId_up,
                        'gl_ad_dateTime_up' => $row->gl_ad_dateTime_up,
                        'fn_coa_mc_id' => $row->fn_coa_mc_id,
                        'fn_coa_pId' => $row->fn_coa_pId,
                        'fn_coa_mc_mId' => $row->fn_coa_mc_mId,
                        'fn_coa_mc_code' => $row->fn_coa_mc_code,
                        'fn_coa_mc_title' => $row->fn_coa_mc_title,
                        'fn_coa_mc_comments' => $row->fn_coa_mc_comments,
                        'fn_coa_mc_status' => $row->fn_coa_mc_status,
                        'fn_coa_mc_trash' => $row->fn_coa_mc_trash,
                        'fn_coa_mc_timestamp' => $row->fn_coa_mc_timestamp,
                        'fn_coa_mc_userId' => $row->fn_coa_mc_userId,
                        'fn_coa_mc_upTimestamp' => $row->fn_coa_mc_upTimestamp,
                        'fn_coa_mc_upUserId' => $row->fn_coa_mc_upUserId,
                        'fn_coa_mc_upUserId' => $row->fn_coa_mc_upUserId,
                        'fn_coa_mc_upUserId' => $row->fn_coa_mc_upUserId,
                    );
                endif;
                
                
            endforeach;
       return     json_decode(json_encode($return_array), FALSE);
            return $return_array;
   }
     public function get_BRS_report($where){
                $this->db->select(
                        'for_month,fn_coa_mc_title,
                        fn_brs_report.for_month,
                        fn_coa_mc_code,
                        sum(amount) as total_amount,
                        fn_brs_report.id as brs_report_id,
                        ');
                $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=fn_brs_report.COA_id');
                $this->db->join('fn_brs_report_details','fn_brs_report_details.brs_id=fn_brs_report.id');
                $this->db->group_by('fn_brs_report.id');
                if($where):
                    $this->db->where($where);
                endif;
       return   $this->db->get('fn_brs_report')->result();
   }
}
