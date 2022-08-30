<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');
//require_once APPPATH."third_party\PHPExcel.php"; 

class PolicyController extends AdminController {

    public function __construct() {
        parent::__construct();
        $this->load->model('CRUDModel');
        $this->load->model('PolicyModel');
        $this->load->library("pagination");     
    }
//        protected  function setting1(){
//            echo 'test';
//        }
//        public function setting(){
//            $this->settingx();
//        }
//        private function settingx(){
//            echo 'private';
//        }
    public function userRole(){
                                          $this->db->order_by('ur_name','asc');  
        $this->data['userRole']         = $this->db->get('users_role')->result();
//        echo '<pre>';print_r($this->data['userRole']);die;
        $uri                            = $this->uri->segment(2);
        if($uri):
            $where                      = array('ur_id'=>$uri);
            $this->data['userInfo']     = $this->CRUDModel->get_where_row('users_role',$where);
            $this->data['page']         = "userPolicy/user_role";
            $this->data['title']        = 'User Edit Pages| ECMS';
            $this->load->view('common/common',$this->data);
            else:
            $this->data['page']         = "userPolicy/user_role";
            $this->data['title']        = 'User Edit Pages| ECMS';
            $this->load->view('common/common',$this->data);
        endif;

//            
//            $array1 = array("a"=>0, "b"=>2, "c"=>3, "d"=>4, "e"=>5);
//            echo '<pre>'; print_r(array_filter($array1));
    }
        
    public function userRoleCreate(){
            $groupName          =  $this->input->post('groupName');
            $ur_id              =  $this->input->post('ur_id');
            $userInfo           =  $this->getUser();
            $data               =  array(
            'ur_name'           => $groupName,
            'ur_userId'         => $userInfo['user_id'],
            );

            if($ur_id):
                 $where         = array('ur_id'=>$ur_id);
                $this->CRUDModel->update('users_role',$data,$where);
                else:
                $this->CRUDModel->insert('users_role',$data);
            endif;
            redirect('userRole'); 
    }
       public function data_base_users(){
            
            $this->data['user_name']        = '';
            $this->data['employee_name']    = '';
            $this->data['group_name']       = '';
            
            if($this->input->post()):
               
                $where      = '';
                $like       = '';
            
                $user_name      = $this->input->post('user_name');
                $group_name     = $this->input->post('group_name');
                $employee_name  = $this->input->post('employee_name');
                
                 if($user_name):
                    $like['users.email']             = $user_name;
                    $this->data['user_name']    = $user_name;
                endif;
                if($group_name):
                    $where['users.user_roleId']       = $group_name;
                    $this->data['group_name']   = $group_name;
                endif;
                if($employee_name):
                    $like['hr_emp_record.emp_name'] = $employee_name;
                    $this->data['employee_name']    = $employee_name;
                endif;
                
                
                $this->data['dbUser']         = $this->PolicyModel->user_by_group($where,$like);
 
            endif;
            
            
            
            $wherePrg                   = array('ur_status'=>'1');
            $this->data['userGorup']    = $this->CRUDModel->dropDown('users_role', 'Select Group', 'ur_id', 'ur_name',$wherePrg);    
            $this->data['emp']          = $this->CRUDModel->dropDown('hr_emp_record', 'Select EMployee', 'emp_id', 'emp_name'); 
            $this->data['page_header']      = 'Database Users';
            $this->data['page']         = "userPolicy/db_user";
            $this->data['title']        = 'User Edit Pages| ECMS';
            $this->load->view('common/common',$this->data);   
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
    public function dbUser(){
            
            
            
            $dbUserId = $this->uri->segment(2);
            
            if($dbUserId):
                $wherePrg                     = array('ur_status'=>'1');
                $this->data['dbUserInfo']     = $this->PolicyModel->user_by_group_where(array('id'=>$dbUserId));
               // echo '<pre>';print_r($this->data['dbUserInfo']);
                $this->data['dbUser']         = $this->PolicyModel->user_by_group('users');
                
                else:
                   $this->data['dbUser']         = $this->PolicyModel->user_by_group();
                endif;
            
            
            $wherePrg                   = array('ur_status'=>'1');
            $this->data['userGorup']    = $this->CRUDModel->dropDown('users_role', '? Select Group  ?', 'ur_id', 'ur_name',$wherePrg);    
            $this->data['emp']    = $this->CRUDModel->dropDown('hr_emp_record', '? Select EMployee  ?', 'emp_id', 'emp_name'); 
            $this->data['page']         = "userPolicy/db_user";
            $this->data['title']        = 'User Edit Pages| ECMS';
            $this->load->view('common/common',$this->data);   
        }
        
        public function db_user_create_check(){
             $userName      = $this->input->post('name');
             $users         = $this->db->get_where('users',array('email'=>$userName))->row();
             
              if(!empty($users)):
                  echo 1;
                else:
                  echo 2;
              endif;
             
             
             
        }  
            public function dbUserCreate(){
             
                if($this->input->post()):
                    
//                    echo '<pre>';print_r($this->input->post());die;
                    $userName   = $this->input->post('name');
                    $userGroup  = $this->input->post('userGroup');
                    $ur_status  = $this->input->post('ur_status');
                    $userPwd    = $this->input->post('password');
                    $emp_id    = $this->input->post('emp_id');
                    
                    $user_id     = $this->input->post('user_id');
                    if($user_id):
                        $wherePwd = array('id'=>$user_id,'password' =>$userPwd);
                        $PwdCheck = $this->CRUDModel->get_where_row('users',$wherePwd);
                            if($PwdCheck):
                                $data = array(
                                    'email'         =>$userName,
                                    'user_roleId'   =>$userGroup,
                                    'user_status'   =>$ur_status,
                                    'password'      =>$userPwd,
                                    'user_empId'      =>$emp_id,
                                    );
                                $where = array( 'id'=>$user_id);
                                $this->CRUDModel->update('users',$data,$where);
                                redirect('dbUser');
                            else:
                                $data = array(
                                    'email'         =>$userName,
                                    'user_roleId'   =>$userGroup,
                                    'user_status'   =>$ur_status,
                                    'password'      =>md5($userPwd),
                                    'user_empId'      =>$emp_id,
                                    );
                                $where = array( 'id'=>$user_id);
                                $this->CRUDModel->update('users',$data,$where);
                                redirect('dbUser');
                        endif;
                         
                    else:
                        $data = array(
                            'email'         => $userName,
                            'user_roleId'   => $userGroup,
                            'password'      => md5($userPwd),
                            'user_empId'    => $emp_id,
                            
                        );
                        
                        $this->CRUDModel->insert('users',$data);
//                        redirect('dbUser');
                        echo true;
                    endif;    
                
                else:
                    $this->data['dbUser']         = $this->CRUDModel->getResults('users');
                    $this->data['page']         = "userPolicy/db_user";
                    $this->data['title']        = 'User Edit Pages| ECMS';
                    $this->load->view('common/common',$this->data);  
                endif;
          }
        
    public function dbUserCreateError(){
             
                if($this->input->post()):
                    $userName   = $this->input->post('userName');
                    $userGroup  = $this->input->post('userGroup');
                    $ur_status  = $this->input->post('ur_status');
                    $userPwd    = $this->input->post('userPwd');
                    $emp_id    = $this->input->post('emp');
                    
                    $user_id     = $this->input->post('user_id');
                    if($user_id):
                        $wherePwd = array('id'=>$user_id,'password' =>$userPwd);
                        $PwdCheck = $this->CRUDModel->get_where_row('users',$wherePwd);
                            if($PwdCheck):
                                $data = array(
                                    'email'         =>$userName,
                                    'user_roleId'   =>$userGroup,
                                    'user_status'   =>$ur_status,
                                    'password'      =>$userPwd,
                                    'user_empId'      =>$emp_id,
                                    );
                                $where = array( 'id'=>$user_id);
                                $this->CRUDModel->update('users',$data,$where);
                                redirect('dbUser');
                            else:
                                $data = array(
                                    'email'         =>$userName,
                                    'user_roleId'   =>$userGroup,
                                    'user_status'   =>$ur_status,
                                    'password'      =>md5($userPwd),
                                    'user_empId'      =>$emp_id,
                                    );
                                $where = array( 'id'=>$user_id);
                                $this->CRUDModel->update('users',$data,$where);
                                redirect('dbUser');
                        endif;
                         
                    else:
                        $data = array(
                            'email'         =>$userName,
                            'user_roleId'   =>$userGroup,
                            'password'      =>md5($userPwd),
                            'user_empId'      =>$emp_id,
                            
                        );
                        
                        $this->CRUDModel->insert('users',$data);
                        redirect('dbUser');
                    endif;    
                
                else:
                    $this->data['dbUser']         = $this->CRUDModel->getResults('users');
                    $this->data['page']         = "userPolicy/db_user";
                    $this->data['title']        = 'User Edit Pages| ECMS';
                    $this->load->view('common/common',$this->data);  
                endif;
          }
    public function groupPolicy(){
           
 
            $groupId = $this->uri->segment(2);
            
            $this->data['UrRecord']     = $this->CRUDModel->get_where_result('user_policyl2',array('upl2_urId'=>$groupId));
            $where                      = array('ur_id'=>$groupId);
            $this->data['layer2']     = $this->CRUDModel->get_where_row('users_role',$where);
//            echo '<pre>';print_r($this->data['UrRecord']);die;
            $order['column'] = 'm1_name'; 
            $order['order'] = 'asc'; 
                    
            $this->data['menu1']    =   $this->CRUDModel->get_where_result_order('menul1',array('m1_status'=>1),$order);  
//              echo '<pre>';print_r($this->data['menu1']);die;
            $this->data['page']     =   "userPolicy/group_policy";
            $this->data['title']    =   'Group Policy Layer 2| ECMS';
            $this->load->view('common/common',$this->data);   
        }
    public function group_policy_Lthree(){
      
  
        $groupId = $this->uri->segment(2);
 
        $whereUR = array(
            'upl2_urId'=>$groupId
        );
        $this->data['UrRecord']     = $this->CRUDModel->get_where_result('user_policyl2',$whereUR);
         $where                      = array('ur_id'=>$groupId);
        $this->data['layer2']       = $this->CRUDModel->get_where_row('users_role',$where);
        $order['column'] = 'm1_name'; 
            $order['order'] = 'asc'; 
                    
            $this->data['menu1']    =   $this->CRUDModel->get_where_result_order('menul1',array('m1_status'=>1),$order);  
        $this->data['page']         = "userPolicy/group_policy_Lthree";
        $this->data['title']        = 'Group Policy Layer 3| ECMS';
        $this->load->view('common/common',$this->data);   
    }    
    public function policySave(){
            
            $checBox = $this->input->post('checkBox');
            $userId  = $this->input->post('urIds');
            $userInfo = $this->getUser();
            
            //Delete Old Menu1...
            
            $this->CRUDModel->deleteid('user_policyl2',array('upl2_urId'=>$userId));
            //Delete Old Menu2...
            $this->CRUDModel->deleteid('user_policyl1',array('upl1_urId'=>$userId));
            
            foreach($checBox as $key=>$value):
                $val = explode(',',$value);
                
                $m1 = $val[0];
                $m2 = $val[1];
                //level 1 menu insertion
                $dataL1 = array('upl1_m1Id'=>$m1,'upl1_urId'=>$userId,'upl1_usrId'=>$userInfo['user_id']);
               $CheckList = $this->CRUDModel->get_where_row('user_policyl1',$dataL1);
               if($CheckList):
                    else:
                   $this->CRUDModel->insert('user_policyl1',$dataL1);
               endif;
               
                //level 2 menu insertion
                $dataL2 = array('up2_m1Id'=>$m1,'up2_m2Id'=>$m2,'upl2_urId'=>$userId,'up2_usrId'=>$userInfo['user_id']);
                $this->CRUDModel->insert('user_policyl2',$dataL2);
                
                
            endforeach;
          redirect('userRole');
        }
        
    public function policy_third_layer(){
            
            $checBox = $this->input->post('checkBox');
            $userId  = $this->input->post('urIds');
            $userInfo = $this->getUser();
//            echo '<pre>';print_r($checBox);die;
            //Delete Old Menu1...
            
            $this->CRUDModel->deleteid('user_policyl3',array('upl3_urId'=>$userId));
            //Delete Old Menu2...
//            $this->CRUDModel->deleteid('user_policyl1',array('upl1_urId'=>$userId));
            
            foreach($checBox as $key=>$value):
                $val = explode(',',$value);
                
                $m1 = $val[0];
                $m2 = $val[1];
                $m3 = $val[2];
                
                
//                //level 1 menu insertion
//                $dataL1 = array('upl1_m1Id'=>$m1,'upl1_urId'=>$userId,'upl1_usrId'=>$userInfo['user_id']);
//               
//                
//                $CheckList = $this->CRUDModel->get_where_row('user_policyl1',$dataL1);
//               if($CheckList):
//                    else:
//                   $this->CRUDModel->insert('user_policyl1',$dataL1);
//               endif;
               
                //level 2 menu insertion
                $dataL3 = array(
                    'upl3_urId'=>$userId,
                    'upl3_m1Id'=>$m1,
                    'upl3_m2Id'=>$m2,
                    'upl3_m3Id'=>$m3,
                    'up3_usrId'=>$userInfo['user_id']
                        );
                
                $this->CRUDModel->insert('user_policyl3',$dataL3);
                
                
            endforeach;
          redirect('userRole');
        }
        
    public function menu_Level1(){

        if($this->input->post()):

           $name        = $this->input->post('userName');
           $level1Id    = $this->input->post('level_id');
            $userInfo = $this->getUser();
           if($level1Id):
               $where = array('m1_id'=>$level1Id);
               $data = array(
                   'm1_name'        =>$name,
                   
                       );
               $this->CRUDModel->update('menul1',$data,$where);
               redirect('menuLevel1');
               else:
               $data = array(
                   'm1_name'    =>$name,
                   'm1_date'    =>date('Y-m-d H:i:s'),
                   'm1_userId'  => $userInfo['user_id']
                       );
               $this->CRUDModel->insert('menul1',$data);
               redirect('menuLevel1');
           endif;

        endif;

        $uri2 = $this->uri->segment(2);
        if($uri2):
            $this->data['level1Menu'] = $this->CRUDModel->get_where_row('menul1',array('m1_id'=>$uri2));
        endif;
        $this->data['menuLeve1']    = $this->CRUDModel->getResults('menul1');
        $this->data['page']         = "userPolicy/level1";
        $this->data['title']        = 'User Edit Pages| ECMS';
        $this->load->view('common/common',$this->data); 
    }
    public function delete_menu_Level1(){
            $uri2 = $this->uri->segment(2);
            $where = array('m1_id'=>$uri2);
            $this->CRUDModel->deleteid('menul1',$where);
            redirect('menuLevel1');
        }
    public function menu_Level2(){

        $this->data['menu1']    = $this->CRUDModel->dropDown('menul1', 'Select Menu 1', 'm1_id', 'm1_name');    
        $this->data['menu1_id'] = '';
        $this->data['menuName'] = '';
        $this->data['level_Id'] = '';
        $this->data['order']    = '';
        $this->data['function'] = '';
        $this->data['btn']      = 'Add Menu';
        $userInfo               = $this->getUser();
        if($this->input->post()):

           $name        = $this->input->post('userName');
           $level1Id    = $this->input->post('level_id');
           $function    = $this->input->post('function');
           $menu1_id    = $this->input->post('menu1_id');
           $order    = $this->input->post('order');
           
           
           if($level1Id):
               
               $where = array('m2_id'=>$level1Id);
               $data = array(
                   'm2_name'        =>$name,
                   'm2_function'    =>$function,
                   'm2_order'       =>$order,
                   'm2_m1Id'        =>$menu1_id,
                   'm2_date'        =>date('Y-m-d H:i:s'),
                   'm2_usrId'       => $userInfo['user_id']
                       );
               $this->CRUDModel->update('menul2',$data,$where);
               redirect('menuLevel2');
               else:
               $data = array(
                   'm2_name'        =>$name,
                   'm2_function'    =>$function,
                   'm2_m1Id'        =>$menu1_id,
                   'm2_order'       =>$order,
                   'm2_date'        =>date('Y-m-d H:i:s'),
                   'm2_usrId'      => $userInfo['user_id']
                       );
               $this->CRUDModel->insert('menul2',$data);
               redirect('menuLevel2');
           endif;

        endif;

        $uri2 = $this->uri->segment(2);
        if($uri2):
            $level1Menu2    = $this->CRUDModel->get_where_row('menul2',array('m2_id'=>$uri2));
            $this->data['menu1_id'] = $level1Menu2->m2_m1Id;
            $this->data['function'] = $level1Menu2->m2_function;
            $this->data['menuName'] = $level1Menu2->m2_name;
            $this->data['level_Id'] = $level1Menu2->m2_id;
            $this->data['order']    = $level1Menu2->m2_order;
            $this->data['btn']      = 'Update Menu';
        endif;
        $this->data['menuLeve12']    = $this->PolicyModel->get_menulevel_2();
//        echo '<pre>';print_r($this->data['menuLeve12']);die;
        $this->data['page']         = "userPolicy/level2";
        $this->data['title']        = 'Menu Level 2| ECMS';
        $this->load->view('common/common',$this->data); 

    }
    public function delete_menu_Level2(){
            $uri2 = $this->uri->segment(2);
            $where = array('m2_id'=>$uri2);
            $this->CRUDModel->deleteid('menul2',$where);
            redirect('menuLevel2');
        }
    public function menu_Level3(){

        $this->data['menu1']    = $this->CRUDModel->dropDown('menul1', 'Select Menu 1', 'm1_id', 'm1_name');    
        $this->data['menu2']    = $this->CRUDModel->dropDown('menul2', 'Select Menu 2', 'm2_id', 'm2_name');    
        $this->data['menu1_id'] = '';
        $this->data['order'] = '';
        $this->data['menu2_id'] = '';
        $this->data['menuName'] = '';
        $this->data['level2_Id'] = '';
        $this->data['function'] = '';
        $this->data['btn']      = 'Add Menu';
        $userInfo = $this->getUser();
        if($this->input->post()):

            $name        = $this->input->post('name');
            $function    = $this->input->post('function');
            $menu1_id    = $this->input->post('menu1_id');
            $menu12_id   = $this->input->post('menu12_id');
            $order       = $this->input->post('order');
           
            $level1Id    = $this->input->post('level2_id');
          
           
           
           if($level1Id):
               
               $where = array('m3_id'=>$level1Id);
               $data = array(
                   'm3_name'        =>$name,
                   'm3_function'    =>$function,
                   'm3_order'       =>$order,
                   'm3_m1Id'        =>$menu1_id,
                   'm3_m2Id'        =>$menu12_id,
                   'm3_date'        =>date('Y-m-d H:i:s'),
                   'm3_usrId'       => $userInfo['user_id']
                       );
               $this->CRUDModel->update('menul3',$data,$where);
               redirect('menuLevel3');
               else:
               $data = array(
                   'm3_name'        =>$name,
                   'm3_function'    =>$function,
                   'm3_m1Id'        =>$menu1_id,
                   'm3_order'       =>$order,
                   'm3_m2Id'        =>$menu12_id,
                   'm3_date'        =>date('Y-m-d H:i:s'),
                   'm3_usrId'       => $userInfo['user_id']
                       );
               $this->CRUDModel->insert('menul3',$data);
               redirect('menuLevel3');
           endif;

        endif;

        $uri2 = $this->uri->segment(2);
        if($uri2):
            $level1Menu2    = $this->CRUDModel->get_where_row('menul3',array('m3_id'=>$uri2));
                $this->data['menu1_id'] = $level1Menu2->m3_m1Id;
                $this->data['menu2_id'] = $level1Menu2->m3_m2Id;
                $this->data['menuName'] = $level1Menu2->m3_name;
                $this->data['order']    = $level1Menu2->m3_order;
                $this->data['level2_Id']= $level1Menu2->m3_id;
                $this->data['function'] = $level1Menu2->m3_function;
                $this->data['btn']      = 'Update Menu';
        endif;
        $this->data['menuLeve12']    = $this->PolicyModel->get_menulevel_3();
//        echo '<pre>';print_r($this->data['menuLeve12']);die;
        $this->data['page']         = "userPolicy/level3";
        $this->data['title']        = 'Menu Level 3| ECMS';
        $this->load->view('common/common',$this->data); 

    }
    
    public function menu2_section(){
        $menu2ID = $this->input->post('menu1_id');
        
        $result  = $this->CRUDModel->get_where_result('menul2',array('m2_m1Id'=>$menu2ID));
        foreach($result as $row):
            echo '<option value='.$row->m2_id.'>'.$row->m2_name.'</option>';
        endforeach;
        
    }
    public function delete_menu_Level3(){
            $uri2 = $this->uri->segment(2);
            $where = array('m3_id'=>$uri2);
            $this->CRUDModel->deleteid('menul3',$where);
            redirect('menuLevel3');
        }
    public function user_restricted_page(){

         
        $this->data['menuLeve12']    = $this->PolicyModel->get_menulevel_3();
//        echo '<pre>';print_r($this->data['menuLeve12']);die;
        $this->data['page']         = "userPolicy/user_restricted_page";
        $this->data['title']        = 'Restricted Page| ECMS';
        $this->load->view('common/common',$this->data); 

    }    
   public function login_details(){
        
        $this->data['search_date']      = date('d-m-Y');
        $this->data['emp_categ_id']    = '';
        $this->data['emp_categ']       = $this->CRUDModel->dropDown('hr_emp_category', 'Employee Category', 'cat_id', 'title');
        $where = array(
          'date(login_date_time)'       =>date('Y-m-d'),
          'hr_emp_record.cat_id'       =>1
        );
        $this->data['result']           = $this->PolicyModel->login_details($where);
        $where_search = '';
        if($this->input->post('search')):
            $search_date    = $this->input->post('search_date');
            $emp_categ      = $this->input->post('emp_categ');
            
            
            
            
            if($search_date):
              $where_search['date(login_date_time)'] = date('Y-m-d',strtotime($search_date));
              $this->data['search_date']              = $search_date; 
              else:
              $this->data['search_date'] = '';    
            endif;
            
            
        if($emp_categ):
           $where_search['hr_emp_record.cat_id']     = $emp_categ;
            $this->data['emp_categ_id']                    = $emp_categ;  
         endif;
          
        $this->data['result']           = $this->PolicyModel->login_details($where_search);
         endif;
        
        
        $this->data['page']             = "userPolicy/login_details";
        $this->data['page_title']        = 'Employee Login | ECMS';
        $this->data['page_header']        = 'Employee Login Details';
        $this->load->view('common/common',$this->data); 

    }    
    
    public function login_details_group_by(){
        if($this->uri->segment(4)):
            $where['hr_emp_record.cat_id'] = $this->uri->segment(4);
        else:
            $where['hr_emp_record.cat_id'] = 1;
        endif;
        
        $where['date(login_date_time)'] = date('Y-m-d',strtotime($this->uri->segment(3)));
         
        $this->data['result']           = $this->PolicyModel->login_details_group($where);
        
        $this->data['page']             = "userPolicy/login_details_groupby";
        $this->data['page_title']        = 'Employee Login | ECMS';
        $this->data['page_header']        = 'Employee Login Details';
        $this->load->view('common/common',$this->data); 

    }  
    
    public function db_user_update(){
             
        
                $userName   = $this->input->post('upname');
                $userGroup  = $this->input->post('upuserGroup');
                $userPwd    = $this->input->post('uppassword');
                $emp_id     = $this->input->post('upempname');
                $user_id    = $this->input->post('user_id');
                $ur_status  = $this->input->post('status');
                    
                    

                    $this->form_validation->set_rules('upuserGroup', 'User Group', 'required');
                    $this->form_validation->set_rules('uppassword', 'User Password', 'required');
                if ($this->form_validation->run() == FALSE):
                            $this->form_validation->set_error_delimiters('<div class="danger">', '</div>'); 
                    echo    validation_errors();
                else:
                    $wherePwd   = array('id'=>$user_id,'password' =>$userPwd);
                    $where      = array( 'id'=>$user_id);
                    $PwdCheck   = $this->CRUDModel->get_where_row('users',$wherePwd);
                    if($PwdCheck):
                        $data = array(
                            'email'         => $userName,
                            'user_roleId'   => $userGroup,
                            'user_status'   => $ur_status,
                            'password'      => $userPwd,
                            'user_empId'    => $emp_id,
                            );

                        $this->CRUDModel->update('users',$data,$where);

                    else:
                        $data = array(
                            'email'         => $userName,
                            'user_roleId'   => $userGroup,
                            'user_status'   => $ur_status,
                            'password'      => md5($userPwd),
                            'user_empId'    => $emp_id,
                            );
                        $this->CRUDModel->update('users',$data,$where);

                    endif;
                 
                endif;
    }   
    
    public function take_database_backup(){
        $this->load->dbutil();
        $prefs = array(
                'format' => 'zip',
                'filename' => 'ecms.sql'
        );
        $backup  = $this->dbutil->backup($prefs);
        $db_name = 'ECMS_DB_' . date("Y-m-d_H-i-s") . '.zip';
        $save    = '/path/to/' . $db_name;
        $this->load->helper('file');
        write_file($save, $backup);
        $this->load->helper('download');
        force_download($db_name, $backup);
    }
    
}
