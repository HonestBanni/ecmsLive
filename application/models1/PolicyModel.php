<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class PolicyModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
    }
       public function user_by_group($where=NULL,$like=NULL){
        
        $this->db->select('
                users.id,
                users.email,
                users.password,
                users.user_status,
                users.user_date,
                users_role.ur_name,
                hr_emp_record.emp_name
                ');
                $this->db->from('users');
                $this->db->join('users_role','users_role.ur_id=users.user_roleId','left outer');
                $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');
                $this->db->order_by('users.id','desc');
                if($where):
                   $this->db->where($where);  
                endif;
                if($like):
                   $this->db->like($like);  
                endif;
               
                return $this->db->get()->result();

        
         
    }
        public function get_user_update_info(){
             
         
            
            $dbUserId       = $this->input->post('user_id');
            $wherePrg      = array('ur_status'=>'1');
            $userGorup      = $this->CRUDModel->dropDown('users_role', 'Select Group', 'ur_id', 'ur_name',$wherePrg);    
            $emp            = $this->CRUDModel->dropDown('hr_emp_record', 'Select Employee', 'emp_id', 'emp_name'); 
            
            $userInfo = $this->db->get_where('users',array('id'=>$dbUserId))->row();
           
                echo '<div class="row">
                                <div class="col-md-12">
                                        <div class="col-md-12 col-sm-5">
                                            <label for="name">User Name</label>
                                            <input type="text" name="upname" readonly="readonly" value="'.$userInfo->email.'" id="upname" class="form-control" placeholder="User Name">

                                        </div>

                                         <div class="col-md-12 col-sm-5">
                                            <label for="name">Password</label>
                                            <input type="password" name="uppassword" value="'.$userInfo->password.'"  id="uppassword" class="form-control" placeholder="Password ">

                                        </div>


                                        <div class="col-md-12 col-sm-5">
                                            <label for="name">Group</label>';
                                           
                                           
                                            echo form_dropdown('upuserGroup', $userGorup,$userInfo->user_roleId,  array('class'=>'form-control'));
                                        
                                            echo '</div>';
                                        echo '<div class="col-md-12 col-sm-5">
                                            <label for="name">Employee Name</label>';
//                                            <input type="text" name="empname" class="form-control" id="empname">
                                             echo '<input type="hidden" name="user_id"  value="'.$userInfo->id.'" >';
                                        echo form_dropdown('upempname', $emp,$userInfo->user_empId,  array('class'=>'form-control'));
                                        
                                        echo '</div>';
                                        echo '<div class="col-md-12 col-sm-5">
                                            <label for="name">Current Status</label>';
                                          $status = array(
                                              '0'=>'Lock',
                                              '1'=>'Un lock',
                                          );
                                        echo form_dropdown('status', $status,$userInfo->user_status,  array('class'=>'form-control'));
                                        echo '</div>
 


                                </div>
                                <div class="col-md-8" style="margin-left: 21px;">
                                    <div id="up_error_message" >

                                    </div>
                                </div>
                            </div>';
                 
        }
//    public function user_by_group(){
//         $query = $this->db->select('
//                users.id,
//                users.email,
//                users.password,
//                users.user_status,
//                users.user_date,
//                users_role.ur_name,
//                hr_emp_record.emp_name
//        ')
//                ->from('users')
//                ->join('users_role','users_role.ur_id=users.user_roleId','left outer')
//                ->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId')
//                ->get();
//        return $query->result();
//    }
    public function user_by_group_where($where){
        $query = $this->db->select('*')
                ->from('users')
                ->where($where)
                ->join('users_role','users_role.ur_id=users.user_roleId','left outer')
                ->get();
        return $query->row();
    }
    public function UPL1($table,$where){
        
        $query = $this->db->select('*')
                ->from($table)
                ->where($where)
                 ->join('menu','user_policyl1.upl1_mnId=menu.mn_mtId')
                ->get();
        return $query->result();
    }
    public function UPL2($table,$where){
        
        $query = $this->db->select('*')
                ->from($table)
                ->where($where)
                 ->join('menul2','user_policyl2.upl2_mnI2Id=menul2.m2_id')
                ->get();
        return $query->result();
    }
    public function get_policty_check($table,$where){
        
        $query = $this->db->select('*')
                ->from($table)
                ->where($where)
                 ->join('menul2','user_policyl2.upl2_mnI2Id=menul2.m2_id')
                ->get();
        return $query->result();
    }
    public function get_menulevel_2(){
        
        return  $this->db->join('menul1','menul1.m1_id=menul2.m2_m1Id')->order_by('m2_id','desc')
                ->get('menul2')->result();
    }
    public function get_menulevel_3(){
        
        return  $this->db
                 ->join('menul2','menul2.m2_id=menul3.m3_m2Id','left outer')
                 ->join('menul1','menul1.m1_id=menul3.m3_m1Id','left outer')
 
                ->order_by('m3_id','desc')
                ->get('menul3')->result();
    }
        public function login_details($where){
        
              $this->db->select(
                      '
                      users.email as login_name,
                      employee_login_details.id,
                      employee_login_details.ip_address,
                      employee_login_details.login_date_time,
                      hr_emp_record.emp_name,
                      hr_emp_record.father_name,
                      hr_emp_record.picture,
                      hr_emp_category.title as cat_title,
                      hr_emp_designation.title as current_design,
                      ');
              $this->db->join('users','users.id=employee_login_details.login_user_id');  
              $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');  
              $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation');
              $this->db->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id');
              $this->db->order_by('employee_login_details.id','desc');
//              $this->db->limit('50','0');
              if($where):
                  $this->db->where($where);
              endif;
       return $this->db->get_where('employee_login_details')->result();
    }
    
    public function login_details_group($where){
        
              $this->db->select(
                      '
                      users.email as login_name,
                      employee_login_details.id,
                      employee_login_details.ip_address,
                      employee_login_details.login_date_time,
                      hr_emp_record.emp_name,
                      hr_emp_record.father_name,
                      hr_emp_record.picture,
                      hr_emp_category.title as cat_title,
                      hr_emp_designation.title as current_design,
                      ');
              $this->db->join('users','users.id=employee_login_details.login_user_id');  
              $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');  
              $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation');
              $this->db->join('hr_emp_category','hr_emp_category.cat_id=hr_emp_record.cat_id');
              $this->db->order_by('users.email','asc');
              $this->db->order_by('employee_login_details.id','desc');
//              $this->db->limit('50','0');
              if($where):
                  $this->db->where($where);
              endif;
       return $this->db->get_where('employee_login_details')->result();
    }
    
}
