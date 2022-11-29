<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class AuditModel extends CI_Model{

    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
    }
    public function search_date_range_limit($where=NULL,$date=NULL){
      
                if($where):
                    $this->db->where($where);
                endif;
                
                     
                
                if(!empty($date)):
                    if($date['from_date'] == ''):
                         $this->db->where('gl_at_date <=',date('Y-m-d', strtotime($date['to_date'])));
                         else:
                         $this->db->where('gl_at_date BETWEEN "'.date('Y-m-d', strtotime($date['from_date'])).'" and "'.date('Y-m-d', strtotime($date['to_date'])).'"');
                     endif;
                 endif;
                $this->db->order_by('gl_at_vocher','desc');
                $this->db->where('gl_at_date',date('Y-m-d'));
                $this->db->join('fn_vocher_status','fn_vocher_status.id=gl_amount_transition.vocher_status');
       return    $this->db->get('gl_amount_transition')->result();
 }
    public function search_date_range($where=NULL,$date=NULL){
//        echo '<pre>';print_r($date);die;
                if($where):
                    $this->db->where($where);
                endif;
                if(!empty($date)):
                     if(empty($date['from_date'])):
                         $this->db->where('gl_at_date <=',date('Y-m-d', strtotime($date['to_date'])));
                         else:
                         $this->db->where('gl_at_date BETWEEN "'.date('Y-m-d', strtotime($date['from_date'])).'" and "'.date('Y-m-d', strtotime($date['to_date'])).'"');
                     endif;
                endif;
                $this->db->order_by('gl_at_vocher','desc');
                 $this->db->join('fn_vocher_status','fn_vocher_status.id=gl_amount_transition.vocher_status');
       return    $this->db->get('gl_amount_transition')->result();
 } 	
}
