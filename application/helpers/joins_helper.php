<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function joins($field=NULL,$table=NULL,$return_type=NULL,$joinsArray=NULL,$where=NULL,$group=NULL,$like=NULL,$limit=NULL){
    
                $CI = get_instance();
                
                //Select Fields $field
                $CI->db->SELECT($field);
                //$CI->db->distinct();
                //Select BaseTable $table
                $CI->db->FROM($table);
                
                // Joins Array $joinArray
                if(!empty($joinsArray)){
                    
                    foreach($joinsArray as $joinRow):
                        if(!empty($joinRow['joinType'])){
                            $CI->db->join($joinRow['table'],$joinRow['tableJoin'],$joinRow['joinType']);}
                        else{ 
                            $CI->db->join($joinRow['table'],$joinRow['tableJoin']);                     
                            }  
                    endforeach;
                                    }
                //Where Array $where
                if(!empty($where)){     $CI->db->where($where);}
                // Like Array $like
                if(!empty($like)){      $CI->db->like($like);}
                //Group $group
                if(!empty($group)){     $CI->db->GROUP_BY($group);}
                //Limit $limit
                if(!empty($limit)){     $CI->db->limit($limit['limit'],$limit['start']);}
                
                $result =               $CI->db->get();
                
                if($return_type == "result")   {  return $result->result(); }
    
                if($return_type == 'row')      {   return $result->row();   }
    
 
 
}
