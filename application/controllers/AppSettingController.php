<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class AppSettingController extends AdminController {

    public function __construct() {
        parent::__construct();
        $this->load->model('PolicyModel');
    }
      public function navigation(){
        
        if($this->input->post()):

           $name        = $this->input->post('userName');
           $level1Id    = $this->input->post('level_id');
           if($level1Id):
               $where = array('m1_id'=>$level1Id);
               $data = array('m1_name'        =>$name,);
               $this->CRUDModel->update('menul1',$data,$where);
               redirect('menuLevel1');
               else:
               $data = array(
                   'm1_name'    =>$name,
                   'm1_date'    =>date('Y-m-d H:i:s'),
                   'm1_userId'  => $this->UserInfo->user_id
                       );
               $this->CRUDModel->insert('menul1',$data);
               redirect('Navigation');
           endif;

        endif;

        $uri2 = $this->uri->segment(2);
        if($uri2):
            $this->data['level1Menu'] = $this->CRUDModel->get_where_row('menul1',array('m1_id'=>$uri2));
        endif;
        $this->data['menuLeve1']    = $this->CRUDModel->getResults('menul1');
        $this->data['page']         = "App_Setting/Forms/navigation_v";
        $this->data['title']        = 'User Navagations | ECMS';
        $this->load->view('common/common',$this->data); 
    }
    
    public function delete_navigation(){
            $uri2 = $this->uri->segment(2);
            $where = array('m1_id'=>$uri2);
            $this->CRUDModel->deleteid('menul1',$where);
            redirect('Navigation');
        }
     public function menu(){
         
        $this->data['menu1']    = $this->CRUDModel->dropDown('menul1', 'Select Menu 1', 'm1_id', 'm1_name');    
        $this->data['menu1_id'] = '';
        $this->data['menuName'] = '';
        $this->data['level_Id'] = '';
        $this->data['order']    = '';
        $this->data['function'] = '';
        $this->data['btn']      = 'Add Menu';
        
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
                   'm2_usrId'       => $this->UserInfo->user_id
                       );
               $this->CRUDModel->update('menul2',$data,$where);
               redirect('Menu');
               else:
               $data = array(
                   'm2_name'        =>$name,
                   'm2_function'    =>$function,
                   'm2_m1Id'        =>$menu1_id,
                   'm2_order'       =>$order,
                   'm2_date'        =>date('Y-m-d H:i:s'),
                   'm2_usrId'      => $this->UserInfo->user_id
                       );
               $this->CRUDModel->insert('menul2',$data);
               redirect('Menu');
           endif;

        endif;

        $uri2 = $this->uri->segment(2);
        if($uri2):
            $level1Menu2            = $this->CRUDModel->get_where_row('menul2',array('m2_id'=>$uri2));
            $this->data['menu1_id'] = $level1Menu2->m2_m1Id;
            $this->data['function'] = $level1Menu2->m2_function;
            $this->data['menuName'] = $level1Menu2->m2_name;
            $this->data['level_Id'] = $level1Menu2->m2_id;
            $this->data['order']    = $level1Menu2->m2_order;
            $this->data['btn']      = 'Update Menu';
        endif;
        $this->data['menuLeve12']    = $this->PolicyModel->get_menulevel_2();
//        echo '<pre>';print_r($this->data['menuLeve12']);die;
        $this->data['page']         = "App_Setting/Forms/menu_v";
        $this->data['title']        = 'User Menu| ECMS';
        $this->load->view('common/common',$this->data); 

    }
    public function delete_menu_Level2(){
            $uri2 = $this->uri->segment(2);
            $where = array('m2_id'=>$uri2);
            $this->CRUDModel->deleteid('menul2',$where);
            redirect('Menu');
    }
    public function sub_menu(){

        $this->data['menu1']    = $this->CRUDModel->dropDown('menul1', 'Select Menu 1', 'm1_id', 'm1_name');    
        $this->data['menu2']    = $this->CRUDModel->dropDown('menul2', 'Select Menu 2', 'm2_id', 'm2_name');    
        $this->data['menu1_id'] = '';
        $this->data['order'] = '';
        $this->data['menu2_id'] = '';
        $this->data['menuName'] = '';
        $this->data['level2_Id'] = '';
        $this->data['function'] = '';
        $this->data['btn']      = 'Add Menu';
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
                   'm3_usrId'       => $this->UserInfo->user_id
                       );
               $this->CRUDModel->update('menul3',$data,$where);
               redirect('SubMenu');
               else:
               $data = array(
                   'm3_name'        =>$name,
                   'm3_function'    =>$function,
                   'm3_m1Id'        =>$menu1_id,
                   'm3_order'       =>$order,
                   'm3_m2Id'        =>$menu12_id,
                   'm3_date'        =>date('Y-m-d H:i:s'),
                   'm3_usrId'       => $this->UserInfo->user_id
                       );
               $this->CRUDModel->insert('menul3',$data);
               redirect('SubMenu');
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
        $this->data['page']         = "App_Setting/Forms/sub_menu_v";
        $this->data['title']        = 'Sub Menu | ECMS';
        $this->load->view('common/common',$this->data); 

    }
        public function delete_sub_menu(){
            $uri2 = $this->uri->segment(2);
            $where = array('m3_id'=>$uri2);
            $this->CRUDModel->deleteid('menul3',$where);
            redirect('SubMenu');
        }
        
     public function user_role(){
                                          $this->db->order_by('ur_name','asc');  
        $this->data['userRole']         = $this->db->get('users_role')->result();

        $uri                            = $this->uri->segment(2);
        if($uri):
            $where                      = array('ur_id'=>$uri);
            $this->data['userInfo']     = $this->CRUDModel->get_where_row('users_role',$where);
            $this->data['page']         = "App_Setting/Forms/user_role_v";
            $this->data['title']        = 'User Edit Pages| ECMS';
            $this->load->view('common/common',$this->data);
        else:
            $this->data['page']         = "App_Setting/Forms/user_role_v";
            $this->data['title']        = 'User Edit Pages| ECMS';
            $this->load->view('common/common',$this->data);
        endif;


    }
        
    public function user_role_create(){
            $groupName          =  $this->input->post('groupName');
            $ur_id              =  $this->input->post('ur_id');
            
            $data               =  array(
            'ur_name'           => $groupName,
            'ur_userId'         => $this->UserInfo->user_id,
            );

            if($ur_id):
                 $where         = array('ur_id'=>$ur_id);
                $this->CRUDModel->update('users_role',$data,$where);
            else:
                $this->CRUDModel->insert('users_role',$data);
            endif;
            redirect('userRole'); 
    }
        public function menu_setting(){
           
            $groupId                    = $this->uri->segment(2);
            $this->data['UrRecord']     = $this->CRUDModel->get_where_result('user_policyl2',array('upl2_urId'=>$groupId));
            $where                      = array('ur_id'=>$groupId);
            $this->data['layer2']       = $this->CRUDModel->get_where_row('users_role',$where);
             
            $order['column']            = 'm1_name'; 
            $order['order']             = 'asc'; 
            $this->data['menu1']        = $this->CRUDModel->get_where_result_order('menul1',array('m1_status'=>1),$order);  
            $this->data['page']         = "App_Setting/Forms/menu_setting_v";
            $this->data['header']       = 'Group Policy Menu ( '.$this->data['layer2']->ur_name.' )';
            $this->data['title']        = 'Group Policy Menu| ECMS';
            $this->load->view('common/common',$this->data);   
        }
    
    public function menu_setting_save(){
            
            $checBox = $this->input->post('checkBox');
            $userId  = $this->input->post('urIds');
            
            
            //Delete Old Menu1...
            
            $this->CRUDModel->deleteid('user_policyl2',array('upl2_urId'=>$userId));
            //Delete Old Menu2...
            $this->CRUDModel->deleteid('user_policyl1',array('upl1_urId'=>$userId));
            
            foreach($checBox as $key=>$value):
                $val = explode(',',$value);
                
                $m1 = $val[0];
                $m2 = $val[1];
                //level 1 menu insertion
                $dataL1 = array('upl1_m1Id'=>$m1,'upl1_urId'=>$userId,'upl1_usrId'=>$this->UserInfo->user_id);
               $CheckList = $this->CRUDModel->get_where_row('user_policyl1',$dataL1);
               if($CheckList):
                    else:
                   $this->CRUDModel->insert('user_policyl1',$dataL1);
               endif;
               
                //level 2 menu insertion
                $dataL2 = array('up2_m1Id'=>$m1,'up2_m2Id'=>$m2,'upl2_urId'=>$userId,'up2_usrId'=>$this->UserInfo->user_id);
                $this->CRUDModel->insert('user_policyl2',$dataL2);
                
                
            endforeach;
          redirect('userRole');
        }    
      public function sub_menu_setting(){
        $groupId                    = $this->uri->segment(2);
        $whereUR                    = array('upl2_urId'=>$groupId);
        $this->data['UrRecord']     = $this->CRUDModel->get_where_result('user_policyl2',$whereUR);
         $where                     = array('ur_id'=>$groupId);
        $this->data['layer2']       = $this->CRUDModel->get_where_row('users_role',$where);
        $order['column']            = 'm1_name'; 
        $order['order']             = 'asc'; 
                    
        $this->data['menu1']        = $this->CRUDModel->get_where_result_order('menul1',array('m1_status'=>1),$order);  
        $this->data['page']         = "App_Setting/Forms/sub_menu_setting_v";
        $this->data['title']        = 'Group Policy Sub Menu | ECMS';
        $this->data['header']       = 'Group Policy Menu ( '.$this->data['layer2']->ur_name.' )';
        $this->load->view('common/common',$this->data);   
    }
    
     public function sub_menu_setting_save(){
            
            $checBox = $this->input->post('checkBox');
            $userId  = $this->input->post('urIds');
            
            //Delete Old Menu1...
            
            $this->CRUDModel->deleteid('user_policyl3',array('upl3_urId'=>$userId));
            //Delete Old Menu2...
//            $this->CRUDModel->deleteid('user_policyl1',array('upl1_urId'=>$userId));
            
            foreach($checBox as $key=>$value):
                $val = explode(',',$value);
                
                $m1 = $val[0];
                $m2 = $val[1];
                $m3 = $val[2];
 
                $dataL3 = array(
                    'upl3_urId'=>$userId,
                    'upl3_m1Id'=>$m1,
                    'upl3_m2Id'=>$m2,
                    'upl3_m3Id'=>$m3,
                    'up3_usrId'=>$this->UserInfo->user_id
                        );
                
                $this->CRUDModel->insert('user_policyl3',$dataL3);
                
                
            endforeach;
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
}
