<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');
//require_once APPPATH."third_party\PHPExcel.php"; 

class InventoryController extends AdminController {

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
             $this->load->model('InventoryModel');
             $this->load->library("pagination");
             $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
       }
    
    public function supplier()
    {
        $this->data['result'] = $this->db->get_where('invt_supplier', array('sp_status' => 1))->result();
        $this->data['page_title']   = 'suppliers  | ECMS';
        $this->data['page']         = 'inventory/supplier';
        $this->load->view('common/common',$this->data); 
    }
    
    public function college_area()
    {
        $this->data['result'] = $this->CRUDModel->getresults('invt_college_area');
        $this->data['page_title']   = 'College Total Area  | ECMS';
        $this->data['page']         = 'inventory/college_area';
        $this->load->view('common/common',$this->data); 
    }
    
    public function fixed_assets_register()
    {
        $this->data['result'] = $this->CRUDModel->getresults('invt_college_area');
        $this->data['page_title']   = 'Fixed Assets Register | ECMS';
        $this->data['page']         = 'inventory/fixed_assets_register';
        $this->load->view('common/common',$this->data); 
    }
    
    public function add_college_area()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $col_name      = $this->input->post('col_name');
            $col_total_area      = $this->input->post('col_total_area');
            $col_cover_area      = $this->input->post('col_cover_area');
            $col_remaining_area      = $this->input->post('col_remaining_area');
        $data       = array(
                'col_name' =>$col_name,
                'col_total_area' =>$col_total_area,
                'col_cover_area' =>$col_cover_area,
                'col_remaining_area' =>$col_remaining_area,
                'user_id'=>$user_id
            );
            $this->CRUDModel->insert('invt_college_area',$data);
            $this->data['page_title']   = 'Add Area | ECMS';
            $this->data['page']         = 'inventory/college_area';
        $this->load->view('common/common',$this->data); 
            redirect('InventoryController/college_area');
          else:
              redirect('/');
        endif;
    }
     public function update_block_area(){   
        $id = $this->uri->segment(3);
         
        if($this->input->post()):
            $bb_id          = $this->input->post('bb_id');
            $b_name         = $this->input->post('bb_name');
            $plot_id        = $this->input->post('plot_id');
            $bb_shortname   = $this->input->post('bb_shortname');
            $total_area     = $this->input->post('total_area');
            $cover_area     = $this->input->post('cover_area');
            $remaining_area = $this->input->post('remaining_area');
            $comments       = $this->input->post('comments');
            $no_of_rooms    = $this->input->post('no_of_rooms');
            $total_seats    = $this->input->post('total_seats');
            
            $log_b_name         = $this->input->post('log_bb_name');
            $log_plot_id        = $this->input->post('log_plot_id');
            $log_bb_shortname   = $this->input->post('log_bb_shortname');
            $log_total_area     = $this->input->post('log_total_area');
            $log_cover_area     = $this->input->post('log_cover_area');
            $log_remaining_area = $this->input->post('log_remaining_area');
            $log_comments       = $this->input->post('log_comments');
            $log_timestamp      = date('Y-m-d H:i:s', strtotime($this->input->post('log_timestamp')));
            $log_user_id        = $this->input->post('log_user_id');
            $log_up_user_id     = $this->userInfo->user_id;
            $log_up_timestamp   = date('Y-m-d H:i:s');

            if($b_name != $log_b_name): $old_b_name = $log_b_name; else: $old_b_name = $b_name; endif;
            
            if($plot_id != $log_plot_id): $old_plot_id = $log_plot_id; else: $old_plot_id = $plot_id; endif;
            if($bb_shortname != $log_bb_shortname): $old_shortname = $log_bb_shortname; else: $old_shortname = $bb_shortname; endif;
            if($total_area != $log_total_area): $old_tarea = $log_total_area; else: $old_tarea = $total_area; endif;
            if($cover_area != $log_cover_area): $old_carea = $log_cover_area; else: $old_carea = $cover_area; endif;
            if($remaining_area != $log_remaining_area): $old_rarea = $log_remaining_area; else: $old_rarea = $remaining_area; endif;
            if($comments != $log_comments): $old_comments = $log_comments; else: $old_comments = $comments; endif;
            
            if($old_b_name != $b_name || $old_plot_id != $plot_id || $old_shortname || $bb_shortname || $old_tarea != $total_area || 
               $old_carea != $cover_area || $old_rarea != $remaining_area || $old_comments != $comments):
                
                $logData = array(
                    'bb_id'             => $bb_id,
                    'bb_name'           => $old_b_name,
                    'plot_id'           => $old_plot_id,
                    'bb_shortname'      => $old_shortname,
                    'total_area'        => $old_tarea,
                    'cover_area'        => $old_carea,
                    'remaining_area'    => $old_rarea,
                    'bb_comments'       => $old_comments,
                    'bb_timestamp'      => $log_timestamp,
                    'bb_userId'         => $log_user_id,
                    'bb_up_timestamp'   => $log_up_timestamp,
                    'bb_up_userId'      => $log_up_user_id,
                );
//            echo '<pre>'; print_r($logData); die;
            $this->CRUDModel->insert('invt_building_block_log',$logData);
            endif;
        $data = array(
                'bb_name'       => $b_name,
                'plot_id'       => $plot_id,
                'bb_shortname'  => $bb_shortname,
                'total_area'    => $total_area,
                'no_of_rooms'   => $no_of_rooms,
                'total_seats'   => $total_seats,
                'cover_area'    => $cover_area,
                'remaining_area'=> $remaining_area,
                'bb_comments'   => $comments,
                'bb_up_userId'  =>  $this->userInfo->user_id
            );
            $where = array('bb_id'=>$id);
            $this->CRUDModel->update('invt_building_block',$data, $where);
            redirect('bulidingBlock');
        endif;
        if($id):
                $where = array('invt_building_block.bb_id'=>$id);
                $this->data['result'] = $this->InventoryModel->getBuildingBlock_row('invt_building_block',$where);
                $this->data['page_title']        = 'Update Block Area | ECMS';
                $this->data['page']        =  'inventory/setup/update_block_area';
                $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;
    }  
   
    public function update_plot_area($id)
    {   
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $col_name      = $this->input->post('col_name');
            $col_id      = $this->input->post('col_id');
            $col_total_area      = $this->input->post('col_total_area');
            $col_cover_area      = $this->input->post('col_cover_area');
            $col_remaining_area      = $this->input->post('col_remaining_area');
            $comments      = $this->input->post('comments');
            $data    = array(
                'plot_name' =>$col_name,
                'col_id' =>$col_id,
                'plot_total_area' =>$col_total_area,
                'plot_cover_area' =>$col_cover_area,
                'plot_remaining_area' =>$col_remaining_area,
                'comments' =>$comments
            );
            $where = array('plot_id'=>$id);
            $this->CRUDModel->update('invt_plot_area',$data, $where);
            redirect('InventoryController/plots_area');
        endif;
        if($id):
                $where = array('invt_plot_area.plot_id'=>$id);
                $this->data['result'] = $this->InventoryModel->getPlots_row('invt_plot_area',$where);
                $this->data['page_title']        = 'Update Plot Area | ECMS';
                $this->data['page']        =  'inventory/update_plot_area';
                $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;
    }
    
    public function add_plot_area()
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $col_name      = $this->input->post('col_name');
            $col_id      = $this->input->post('col_id');
            $col_total_area      = $this->input->post('col_total_area');
            $col_cover_area      = $this->input->post('col_cover_area');
            $col_remaining_area      = $this->input->post('col_remaining_area');
        $data       = array(
                'plot_name' =>$col_name,
                'col_id' =>$col_id,
                'plot_total_area' =>$col_total_area,
                'plot_cover_area' =>$col_cover_area,
                'plot_remaining_area' =>$col_remaining_area,
                'user_id'=>$user_id
            );
            $this->CRUDModel->insert('invt_plot_area',$data);
            $this->data['page_title']   = 'Add Plot Area | ECMS';
            $this->data['page']         = 'inventory/plots_area';
        $this->load->view('common/common',$this->data); 
            redirect('InventoryController/plots_area');
          else:
              redirect('/');
        endif;
    }
    
    public function delete_college_area()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('col_id'=>$id);
        $this->CRUDModel->deleteid('invt_college_area',$where);
        redirect('InventoryController/college_area');
	}
    
    public function delete_plot_area()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('plot_id'=>$id);
        $this->CRUDModel->deleteid('invt_plot_area',$where);
        redirect('InventoryController/plots_area');
	}
    
    public function update_college_area($id)
    {   
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $col_name      = $this->input->post('col_name');
            $col_total_area      = $this->input->post('col_total_area');
            $col_cover_area      = $this->input->post('col_cover_area');
            $col_remaining_area      = $this->input->post('col_remaining_area');
            $data    = array(
                'col_name' =>$col_name,
                'col_total_area' =>$col_total_area,
                'col_cover_area' =>$col_cover_area,
                'col_remaining_area' =>$col_remaining_area
            );
            $where = array('col_id'=>$id);
            $this->CRUDModel->update('invt_college_area',$data, $where);
            redirect('InventoryController/college_area');
        endif;
        if($id):
                $where = array('invt_college_area.col_id'=>$id);
                $this->data['result'] = $this->CRUDModel->get_where_row('invt_college_area',$where);
                $this->data['page_title']        = 'Update Area | ECMS';
                $this->data['page']        =  'inventory/update_college_area';
                $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;
    }
    
    
    public function plots_area()
    {
        $this->data['result'] = $this->InventoryModel->getPlots('invt_plot_area');
        $this->data['page_title']   = 'Plots Total Area  | ECMS';
        $this->data['page']         = 'inventory/plots_area';
        $this->load->view('common/common',$this->data); 
    }
    
     public function add_block_area(){

        if($this->input->post()):
            $b_name         = $this->input->post('bb_name');
            $plot_id        = $this->input->post('plot_id');
            $no_of_rooms    = $this->input->post('no_of_rooms');
            $total_seats    = $this->input->post('total_seats');
            $bb_shortname   = $this->input->post('bb_shortname');
            $total_area     = $this->input->post('total_area');
            $cover_area     = $this->input->post('cover_area');
            $remaining_area = $this->input->post('remaining_area');
            $comments       = $this->input->post('comments');
        $data = array(
                'bb_name'       => $b_name,
                'plot_id'       => $plot_id,
                'no_of_rooms'   => $no_of_rooms,
                'total_seats'   => $total_seats,
                'bb_shortname'  => $bb_shortname,
                'total_area'    => $total_area,
                'cover_area'    => $cover_area,
                'remaining_area'=> $remaining_area,
                'bb_comments'   => $comments,
                'bb_timestamp'  => date('Y-m-d H:i:'),
                'bb_userId'     => $this->userInfo->user_id
            );
            $this->CRUDModel->insert('invt_building_block',$data);
         redirect('bulidingBlock');
        endif;
            $this->data['page_title']   = 'Add Block Area | ECMS';
            $this->data['page']         = 'inventory/setup/add_block';
        $this->load->view('common/common',$this->data); 
           
    }
    public function add_room(){
        
        if($this->input->post()):
            $rm_name            = $this->input->post('rm_name');
            $rm_shortname       = $this->input->post('rm_shortname');
            $rm_bbId            = $this->input->post('rm_bbId');
            $room_total_area    = $this->input->post('room_total_area');
            $rm_comment         = $this->input->post('rm_comments');     
            $total_seats        = $this->input->post('total_seats');   
            $where = array(
              'rm_name'           => $rm_name,  
              'rm_shortname'      => $rm_shortname,
              'rm_bbId'           => $rm_bbId,
            );
            
            $check_rooms = $this->CRUDModel->get_where_row('invt_rooms',$where);
           if(empty($check_rooms)):
                $data = array( 
                'rm_name'           => $rm_name,  
                'rm_shortname'      => $rm_shortname,
                'rm_total_seats'    => $total_seats,
                'rm_bbId'           => $rm_bbId,
                'room_total_area'   => $room_total_area,  
                'rm_comments'       => $rm_comment,   
                'rm_timestamp'      => date('Y-m-d H:i:'),  
                'rm_userId'         => $this->userInfo->user_id  
                      );
                $this->CRUDModel->insert('invt_rooms',$data);
                redirect('rooms');  
               else:
                $this->session->set_flashdata('error_message', 'This room already exist in in this block ....');
               redirect('InventoryController/add_room');
           endif;
               
           
       // echo '<pre>';print_r($data);die;
         
            endif;
        $this->data['page']              = "inventory/setup/add_room";
        $this->data['page_title']       = 'Add Buliding Room | ECMS';
        $this->load->view('common/common',$this->data);     
    
    }  
    
    public function college_cumulative_area()
    {
        $this->data['result'] = $this->CRUDModel->getresults('invt_college_area');
        $this->data['page_title']   = 'Edwardes College Fixed Assets Register  | ECMS';
        $this->data['page']         = 'inventory/college_cumulative_area';
        $this->load->view('common/common',$this->data); 
    }
    
    public function search_register_cumulative()
    {
        if($this->input->post('search')): 
        $rm_id     = $this->input->post('rm_id');
        $where = "";
        $like = "";
        $this->data['rm_id'] = ""; 
        if($rm_id):
            $where['invt_rooms.rm_id'] = $rm_id; 
            $this->data['rm_id'] = $rm_id;
        endif;
            $this->data['room'] = $this->InventoryModel->get_room_rows('invt_rooms',$where);
         endif;
        $this->data['result'] = $this->CRUDModel->getresults('invt_college_area');
        $this->data['page_title']   = 'Fixed Assets Register Details | ECMS';
        $this->data['page']         = 'inventory/search_register_cumulative';
        $this->load->view('common/common',$this->data); 
    }
    
    public function fixed_assets_reg_cumulative()
    {
        $this->data['result'] = $this->CRUDModel->getresults('invt_college_area');
        $this->data['page_title']   = 'Fixed Assets Register Cumulative | ECMS';
        $this->data['page']         = 'inventory/fixed_assets_reg_cum';
        $this->load->view('common/common',$this->data); 
    }
    
    public function search_assets_reg_cum()
    {
        if($this->input->post('search')): 
        $rm_id     = $this->input->post('rm_id');
        $where = "";
        $like = "";
        $this->data['rm_id'] = ""; 
        if($rm_id):
            $where['invt_rooms.rm_id'] = $rm_id; 
            $this->data['rm_id'] = $rm_id;
        endif;
            $this->data['room'] = $this->InventoryModel->get_room_rows('invt_rooms',$where);
         endif;
        $this->data['result'] = $this->CRUDModel->getresults('invt_college_area');
        $this->data['page_title']   = 'Fixed Assets Register Cumulative | ECMS';
        $this->data['page']         = 'inventory/search_assets_reg_cum';
        $this->load->view('common/common',$this->data); 
    }
    
    public function add_supplier()
    {       
        if($this->input->post()):
            $title      = $this->input->post('title');
            $phone      = $this->input->post('phone');
            $address      = $this->input->post('address');
            $data       = array(
                'sp_name' =>$title,
                'phone' =>$phone,
                'address' =>$address,
            );
            $this->CRUDModel->insert('invt_supplier',$data);
            $this->data['page_title']   = 'Add New supplier | ECMS';
            $this->data['page']         = 'inventory/supplier';
        $this->load->view('common/common',$this->data); 
            redirect('InventoryController/supplier');
          else:
              redirect('/');
        endif;
    }
    
    public function delete_supplier()
    {	    
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $id         = $this->uri->segment(3);
        $where      = array('sp_id'=>$id);
        
        $depttResult = $this->CRUDModel->get_where_row('invt_supplier', $where);
        $logData = array(
                    'sp_id'   => $id,
                    'sp_name'   => $depttResult->sp_name,
                    'phone'   => $depttResult->phone,
                    'address'   => $depttResult->address,
                    'sp_status'   => $depttResult->sp_status,
                    'comments'   => 'Record Deleted',
                    'up_timestamp'   => date('Y-m-d H:i:s'),
                    'up_user_id'   => $user_id,
                    );
//        echo '<pre>'; print_r($logData); die;
        $this->CRUDModel->insert('invt_supplier_log', $logData);
        $data       = array('sp_status' => 0);
        $this->CRUDModel->update('invt_supplier',$data, $where);
        redirect('InventoryController/supplier');
	}
    
     public function update_purchase_order()
    {
        $order_id = $this->uri->segment(3);
        $where = array('invt_purchase_order_details.order_id'=>$order_id);
        $wheredata = array('invt_purchase_order.po_id'=>$order_id);
        $this->data['purchase_order'] = $this->InventoryModel->get_podata('invt_purchase_order', $wheredata);
        $this->data['result'] = $this->InventoryModel->get_po_items('invt_purchase_order_details', $where);
        $this->data['page_title']   = 'Update Purchase Order Items | ECMS';
        $this->data['page']         = 'inventory/update_purchase_order';
        $this->load->view('common/common',$this->data);
	}
    
    public function delete_item_issuance()
    {	    
        $id         = $this->uri->segment(3);
        $where      = array('ass_id'=>$id);
        $this->CRUDModel->deleteid('invt_items_assuance',$where);
        redirect('InventoryController/items_assuance');
	}
    
    public function issuance_department()
    {
        $this->data['result'] = $this->CRUDModel->getResults('invt_item_issuance_department');
        $this->data['page_title']   = 'Issuance Department  | ECMS';
        $this->data['page']         = 'inventory/issuance_department';
        $this->load->view('common/common',$this->data); 
    }
    
    public function add_issuance_department()
    {       
        if($this->input->post()):
            $dept_name     = $this->input->post('dept_name');
            $data       = array(
                'dept_name' =>$dept_name
            );
            $this->CRUDModel->insert('invt_item_issuance_department',$data);
            $this->data['page_title']   = 'Add New Department | ECMS';
            $this->data['page']         = 'inventory/issuance_department';
        $this->load->view('common/common',$this->data); 
            redirect('InventoryController/issuance_department');
          else:
              redirect('/');
        endif;
    }
    
    public function delete_dept()
    {	    
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $id         = $this->uri->segment(3);
        $where      = array('iss_dept_id'=>$id);
        $depttResult = $this->CRUDModel->get_where_row('invt_item_issuance_department', $where);
        $logData = array(
                    'iss_dept_id'   => $id,
                    'dept_name'   => $depttResult->dept_name,
                    'deptt_status'   => $depttResult->deptt_status,
                    'date_time'   => date('Y-m-d H:i:s'),
                    'user_id'   => $user_id,
                    );
//        echo '<pre>'; print_r($logData); die;
        $this->CRUDModel->insert('invt_item_issuance_department_log', $logData);
        $updateData = array( 'deptt_status' => 0 );
        $this->CRUDModel->update('invt_item_issuance_department', $updateData, $where);
        redirect('InventoryController/issuance_department');
	}
    
   public function delete_purchase_order()
    {	    
        $id         = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $where      = array('po_id'=>$id);
        $uData      = array('delete_status' => 0, 'deleted_by' => $user_id);
        $this->CRUDModel->update('invt_purchase_order', $uData, $where);
//        $where1      = array('order_id'=>$id);
//        $this->CRUDModel->deleteid('invt_purchase_order',$where);
//        $this->CRUDModel->deleteid('invt_purchase_order_details',$where1);
        redirect('InventoryController/purchase_order_list');
	}
    
    public function update_supplier($id)
    {   
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $title          = $this->input->post('title');
            $phone          = $this->input->post('phone');
            $address        = $this->input->post('address');
            
            $log_title      = $this->input->post('log_title');
            $log_phone      = $this->input->post('log_phone');
            $log_address    = $this->input->post('log_address');
            $log_status    = $this->input->post('log_status');
            
            if($title != $log_title): $old_title = $log_title; else: $old_title = $title; endif;
            if($phone != $log_phone): $old_phone = $log_phone; else: $old_phone = $phone; endif;
            if($address != $log_address): $old_address = $log_address; else: $old_address = $address; endif;
            
            if($old_title != $title || $old_phone != $phone || $old_address != $address):
                $logData    = array(
                                'sp_id'         => $id,
                                'sp_name'       => $log_title,
                                'phone'         => $log_phone,
                                'address'       => $log_address,
                                'up_timestamp'  => date('Y-m-d H:i:s'),
                                'up_user_id'    => $user_id,
                                'sp_status'     => $log_status,
                                'comments'      => 'Record Updated',
                                );
//                echo '<pre>'; print_r($logData); die;
                $this->CRUDModel->insert('invt_supplier_log', $logData);
            endif;
            $data       = array(
                'sp_name' =>$title,
                'phone' =>$phone,
                'address' =>$address,
            );
            $where = array('sp_id'=>$id);
            $this->CRUDModel->update('invt_supplier',$data, $where);
            $this->data['page_title']   = 'suppliers List | ECMS';
            $this->data['page']         = 'inventory/supplier';
            $this->load->view('common/common',$this->data);
            redirect('InventoryController/supplier');
        endif;
        if($id):
                $where = array('invt_supplier.sp_id'=>$id);
                $this->data['result'] = $this->CRUDModel->get_where_row('invt_supplier',$where);
                $this->data['page_title']        = 'Update supplier | ECMS';
                $this->data['page']        =  'inventory/update_supplier';
                $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;
    }
    
    public function work_order()
    {
        if($this->input->post('search')): 
        $order_date     = $this->input->post('order_date');
        $issued_by         = $this->input->post('issued_by');
        $issued_to     = $this->input->post('issued_to');
        $prepared_by     = $this->input->post('prepared_by');
        $authorized_by     = $this->input->post('authorized_by');
        $status     = $this->input->post('status');
        $ship_to     = $this->input->post('ship_to');
        $work_id     = $this->input->post('work_id');
        
        $like = "";
       
        $this->data['order_date'] = ""; 
        $this->data['issued_by'] = ""; 
        $this->data['issued_to'] = ""; 
        $this->data['prepared_by'] = ""; 
        $this->data['authorized_by'] = ""; 
        $this->data['status'] = "";
        $this->data['ship_to'] = "";
        $this->data['work_id'] = "";
        
        $where['dlt_status'] = 1;
        if(!empty($work_id)):
                $where['invt_work_order.work_id'] = $work_id;
                $this->data['work_id'] =$work_id;
        endif;
        if(!empty($order_date)):
                $where['order_date'] = $order_date;
                $this->data['order_date'] =$order_date;
        endif;
        if(!empty($ship_to)):
                $where['invt_ship_to.ship_id'] = $ship_to;
                $this->data['ship_to'] =$ship_to;
        endif;  
        if($issued_by):
            $where['issued_by'] = $issued_by;
            $this->data['issued_by'] = $issued_by;
        endif;
        if($issued_to):
            $where['issued_to'] = $issued_to;
            $this->data['issued_to'] = $issued_to;
        endif;
        if($prepared_by):
            $where['hr_emp_record.emp_id'] = $prepared_by;
            $this->data['prepared_by'] = $prepared_by;
        endif;
        if($authorized_by):
            $where['hr_emp_record.emp_id'] = $authorized_by;
            $this->data['authorized_by'] = $authorized_by;
        endif;
        if($status):
            $where['invt_work_order.order_status'] = $status;
            $this->data['status'] = $status;
        endif;
            $this->data['result'] = $this->InventoryModel->get_wo_list('invt_work_order',$where);
        else:
//            $where_n = array('invt_work_order.dlt_status' => 1);
            $this->data['result'] = $this->InventoryModel->get_wo_lists('invt_work_order');
        endif;
        $this->data['page_title']   = 'Work Order List | ECMS';
        $this->data['page']         = 'inventory/work_order_list';
        $this->load->view('common/common',$this->data); 
    }
    
    public function add_work_order()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post('submit_order')):  
           $year   = $this->input->post('year');   
              
           $issued_by   = $this->input->post('issued_by');   
           $issued_to   = $this->input->post('issued_to');   
           $ship_to  = $this->input->post('ship_to');   
           $prepared_by  = $this->input->post('prepared_by');   
           $authorized_by  = $this->input->post('authorized_by');
           $form_Code  = $this->input->post('form_Code');
            $order_date   = $this->input->post('order_date'); 
            $date1 = date('Y-m-d', strtotime($order_date));
           $data = array(
                'year' => $year,
                'order_date' => $date1,
                'issued_by' =>$issued_by,
                'issued_to' =>$issued_to,
                'ship_to' =>$ship_to,
                'prepared_by' =>$prepared_by,
                'authorized_by' => $authorized_by
            );
            $id = $this->CRUDModel->insert('invt_work_order',$data);
            $where = array(
            'user_id'=>$user_id,
            'form_Code'=>$form_Code,
            'date' => date('Y-m-d')    
        ); 
       $res =  $this->CRUDModel->get_where_result('invt_work_order_details_demo', $where);
       foreach($res as $isRow):
        $data = array(   
            'item_name'     =>$isRow->item_name,
            'work_id'       =>$id,
            'quantity'      =>$isRow->quantity,
            'days'          =>$isRow->days,
            'price'         =>$isRow->price,
            'total_price'   =>$isRow->total_price,
            'status'        =>$isRow->status,
            'form_Code'     =>$isRow->form_Code,
            'date'          =>$isRow->date,
            'user_id'       =>$isRow->user_id,
          );
            $this->CRUDModel->insert('invt_work_order_details',$data);
        $whereDelete = array('user_id'=>$user_id,'form_Code'=>$form_Code,'date' => date('Y-m-d')); 
           $this->CRUDModel->deleteid('invt_work_order_details_demo',$whereDelete);
        endforeach; 
            redirect('InventoryController/work_order');
            endif;
        $this->data['page_title']   = 'Add Work Order | ECMS';
        $this->data['page']         = 'inventory/add_work_order';
        $this->load->view('common/common',$this->data); 
    }
    
    public function add_work_order_grn()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()): 
        $work_id       = $this->input->post('work_id');
        $sp_id       = $this->input->post('sp_id');
        $goods_rec_del_by     = $this->input->post('goods_rec_del_by');
        $received_by     = $this->input->post('received_by');
        $final_received_by     = $this->input->post('final_received_by');
        $delivery_status     = $this->input->post('delivery_status');
        $comments     = $this->input->post('comments');
        $price     = $this->input->post('price');
        $quantity     = $this->input->post('quantity');
        $item_name    = $this->input->post('item_name');
        $days    = $this->input->post('days');
        $grn_date    = $this->input->post('grn_date');
            $date1 = date('Y-m-d', strtotime($grn_date));
        $data = array(
                'work_id' => $work_id,
                'grn_date' => $date1,
                'sp_id' => $sp_id,
                'goods_rec_del_by' => $goods_rec_del_by,
                'received_by' => $received_by,
                'final_received_by' => $final_received_by,
                'delivery_status' => $delivery_status,
                'comments' => $comments,
                'user_id'=>$user_id
            );
        $grn_id = $this->CRUDModel->insert('invt_work_order_grn',$data);      
        $result =  $this->mergeArray($price, $quantity, $item_name, $days);
             
                foreach($result as $valuerow):                  
                $work_data = array
                (
                    'grn_id'=>$grn_id,
                    'item_name'=>$valuerow['item_name'],
                    'days'=>$valuerow['days'],
                    'price'=>$valuerow['price'],
                    'quantity'=>$valuerow['quantity'],
                   'total_price'=>$valuerow['quantity']*$valuerow['price'],
                );     
        $this->CRUDModel->insert('invt_work_order_grn_details',$work_data);
                endforeach;
        
        $where = array('work_id'=>$work_id);
        $update_data = array('order_status'=>2);
        $this->CRUDModel->update('invt_work_order',$update_data,$where);
        redirect('InventoryController/work_order');
        endif;
    }
    
     function mergeArray($price, $quantity, $item_name, $days) 
        {
            $result = array();
            foreach ($price as $key=>$name) 
            {
                $result[] = array( 
                    'price' => $name,
                    'quantity' => $quantity[$key], 
                    'item_name' => $item_name[ $key ], 
                    'days' => $days[ $key ] 
                );
            }
            return $result;
        }
    
    public function show_work_order()
    {
        $order_id = $this->uri->segment(3);
        $where = array('invt_work_order_details.work_id'=>$order_id);
        $wheredata = array('invt_work_order.work_id'=>$order_id);
        $this->data['work_order'] = $this->InventoryModel->get_work_orderdata('invt_work_order', $wheredata);
        $this->data['result'] = $this->CRUDModel->get_where_result('invt_work_order_details', $where);
        $this->data['page_title']   = 'Work Order Items | ECMS';
        $this->data['page']         = 'inventory/show_work_order';
        $this->load->view('common/common',$this->data); 
    }
    
    public function show_work_order_grn()
    {
        $work_id = $this->uri->segment(3);
        $where = array('invt_work_order_grn.work_id'=>$work_id);
        $this->data['grn_order'] = $this->InventoryModel->get_work_order_grn('invt_work_order_grn', $where);
        $this->data['page_title']   = 'Show Work Order GRN | ECMS';
        $this->data['page']         = 'inventory/show_work_order_grn';
        $this->load->view('common/common',$this->data); 
    }

    
    public function purchase_order()
    {
        $this->data['page_title']   = 'Purchase Order | ECMS';
        $this->data['page']         = 'inventory/purchase_order';
        $this->load->view('common/common',$this->data); 
    }
    
     public function add_work_order_item()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $item_name   = $this->input->post('item_name');
            $price     = $this->input->post('price');
            $quantity  = $this->input->post('quantity');
            $days  = $this->input->post('days');
            $form_Code  = $this->input->post('form_Code');
            $total_price = $price * $quantity;
            $data       = array(
                'item_name' => $item_name,
                'price' =>$price,
                'days' =>$days,
                'quantity' =>$quantity,
                'total_price' =>$total_price,
                'form_Code' =>$form_Code,
                'date' => date('Y-m-d'),
                'user_id' => $user_id
            );
    $this->CRUDModel->insert('invt_work_order_details_demo',$data);
    $result = $this->CRUDModel->getResults('invt_work_order_details_demo');
       echo '<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" width="100%">
                    <thead>
                       <tr>
                            <th>Description</th>
                            <th>Days</th>
                            <th>Quantity</th>
                            <th>Unit Cost</th>
                            <th>Total Cost</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>';                     
                        if($result):
                        foreach($result as $eRow):
                        
                        echo '<tr id="'.$eRow->work_order_id.'Delete">
                                <td>'.$eRow->item_name.'</td>
                                <td>'.$eRow->days.'</td>
                                <td>'.$eRow->quantity.'</td>
                                <td>'.$eRow->price.'</td>
                                <td>'.$eRow->total_price.'</td>                           
                <td><a href="javascript:void(0)" id="'.$eRow->work_order_id.'" class="deleteWork"><i class="fa fa-trash"></i></a></td>                            
                           </tr>';                      
                        endforeach;                        
                        endif;                      
                    echo '</tbody>
                </table> ';
        endif;
        ?>
        <script>
            jQuery(document).ready(function(){
                 jQuery('.deleteWork').on('click',function(){
                 var deletId = this.id;
                 jQuery.ajax({
                     type:'post',
                     url : 'InventoryController/delete_wo_item',
                     data: {'deletId':deletId},
                     success : function(result){
                        var del = deletId+'Delete';
                        jQuery('#'+del).hide(); 
                     }
                 });

             });

            });

            </script>
<?php
}
     
    public function delete_wo_item(){
       $deletId = $this->input->post('deletId');
       $this->CRUDModel->deleteid('invt_work_order_details_demo',array('work_order_id'=>$deletId));
   }
    
     public function work_order_grn()
    {
        $order_id = $this->uri->segment(3);
        $where = array('invt_work_order_details.work_id'=>$order_id);
        $wheredata = array('invt_work_order.work_id'=>$order_id);
        $this->data['work_order'] = $this->InventoryModel->get_work_orderdata('invt_work_order', $wheredata);
        $this->data['result'] = $this->CRUDModel->get_where_result('invt_work_order_details', $where);
        $this->data['page_title']   = 'Add Work Order GRN | ECMS';
        $this->data['page']         = 'inventory/work_order_grn';
        $this->load->view('common/common',$this->data); 
     }
    
    public function delete_work_order()
    {	    
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $id         = $this->uri->segment(3);
        $where      = array('work_id'=>$id);
        $uData      = array('dlt_status' => 0, 'deleted_by' => $user_id);
        $this->CRUDModel->update('invt_work_order', $uData, $where);
//        $where1      = array('work_id'=>$id);
//        $this->CRUDModel->deleteid('invt_work_order',$where);
//        $this->CRUDModel->deleteid('invt_work_order_details',$where1);
        redirect('InventoryController/work_order');
	}
    
    public function add_purchase_order_item()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $item_id   = $this->input->post('item_id');
            $brand_id  = $this->input->post('brand_id');
            $price     = $this->input->post('price');
            $quantity  = $this->input->post('quantity');
            $form_Code  = $this->input->post('form_Code');
            $total_price        = $price * $quantity;
            $data       = array(
                'item_id' => $item_id,
                'brand_id' =>$brand_id,
                'price' =>$price,
                'quantity' =>$quantity,
                'total_price' =>$total_price,
                'form_Code' =>$form_Code,
                'date' => date('Y-m-d'),
                'user_id' => $user_id
            );
    $this->CRUDModel->insert('invt_purchase_order_details_demo',$data);
    $result = $this->InventoryModel->getpurchase_order();
       echo '<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" width="100%">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Brand</th>
                            <th>Price/Quantity</th>
                            <th>Total Quantity</th>
                            <th>Total Price</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>';                     
                        if($result):
                        foreach($result as $eRow):
                        
                        echo '<tr id="'.$eRow->purchase_order_id.'Delete">
                                <td>'.$eRow->itm_name.'</td>
                                <td>'.$eRow->brand_id.'</td>
                                <td>'.$eRow->price.'</td>
                                <td>'.$eRow->quantity.'</td>
                                <td>'.$eRow->total_price.'</td>
                        <td><a href="javascript:void(0)" id="'.$eRow->purchase_order_id.'" class="deletePur"><i class="fa fa-trash"></i></a></td>        
                           </tr>';                      
                        endforeach;                        
                        endif;                      
                    echo '</tbody>
                </table> ';
        endif;
        ?>
        <script>
            jQuery(document).ready(function(){
                 jQuery('.deletePur').on('click',function(){
                 var deletId = this.id;
                 jQuery.ajax({
                     type:'post',
                     url : 'InventoryController/delete_po_item',
                     data: {'deletId':deletId},
                     success : function(result){
                        var del = deletId+'Delete';
                        jQuery('#'+del).hide(); 
                     }
                 });

             });

            });

            </script>
<?php
}
    
    public function delete_po_item(){
       $deletId = $this->input->post('deletId');
       $this->CRUDModel->deleteid('invt_purchase_order_details_demo',array('purchase_order_id'=>$deletId));
    }
    
    public function insertOrder(){
 
        
        if($this->input->post('submit_order')):  
           $year            = $this->input->post('year');      
           $issued_by       = $this->input->post('issued_by');   
           $issued_to       = $this->input->post('issued_to');   
           $ship_to         = $this->input->post('ship_to');   
           $prepared_by     = $this->input->post('prepared_by');   
           $authorized_by   = $this->input->post('authorized_by');
           $form_Code       = $this->input->post('form_Code');
           $order_date      = $this->input->post('order_date'); 
            $date1          = date('Y-m-d', strtotime($order_date));    
            
                                 $this->db->where_in('current_designation',array('72','54'));  
           $vp_admin        =   $this->db->get_where('hr_emp_record',array('emp_status_id'=>1))->row();
         
           $vp_admin_name = '';
           if($vp_admin):
               $vp_admin_name =$vp_admin->emp_id;
               else:
               $vp_admin_name = '';
           endif;
            
            $dir_finance    =   $this->db->get_where('hr_emp_record',array('current_designation'=>4,'emp_status_id'=>1))->row();
            
           $data            = array(
            'year'              => $year,
            'order_date'        => $date1,
            'issued_by'         => $issued_by,
            'issued_to'         => $issued_to,
            'ship_to'           => $ship_to,
            'prepared_by'       => $prepared_by,
            'authorized_by'     => $authorized_by,
            'vp_admin'          => $vp_admin_name,
            'director_finance'  => $dir_finance->emp_id,
            'create_by'         => $this->userInfo->user_id,
            'create_datetime'   => date('Y-m-d H:i:s'),
            );                
             
            $id             = $this->CRUDModel->insert('invt_purchase_order',$data);
            $where          = array(
            'user_id'       => $this->userInfo->user_id,
            'form_Code'     => $form_Code,
            'date'          => date('Y-m-d')    
        ); 
       $res =  $this->CRUDModel->get_where_result('invt_purchase_order_details_demo', $where);
       foreach($res as $isRow):
        $data = array(   
            'item_id'       =>$isRow->item_id,
            'order_id'      =>$id,
            'brand_id'      =>$isRow->brand_id,
            'quantity'      =>$isRow->quantity,
            'price'         =>$isRow->price,
            'total_price'   =>$isRow->total_price,
            'status'        =>$isRow->status,
            'form_Code'     =>$isRow->form_Code,
            'date'          =>$isRow->date,
            'user_id'       =>$isRow->user_id,
          );
            $this->CRUDModel->insert('invt_purchase_order_details',$data);
        $whereDelete = array('user_id'=>$this->userInfo->user_id,'form_Code'=>$form_Code,'date' => date('Y-m-d')); 
           $this->CRUDModel->deleteid('invt_purchase_order_details_demo',$whereDelete);
        endforeach; 
            redirect('InventoryController/purchase_order_list');
            endif;
    }
    
   public function purchase_order_list()
    {
     
    if($this->input->post('search')): 
        $order_date     = $this->input->post('order_date');
        $issued_by         = $this->input->post('issued_by');
        $issued_to     = $this->input->post('issued_to');
        $prepared_by     = $this->input->post('prepared_by');
        $authorized_by     = $this->input->post('authorized_by');
        $status     = $this->input->post('status');
        $ship_to     = $this->input->post('ship_to');
        $po_id     = $this->input->post('po_id');
        
        $like = "";
       
        $this->data['order_date'] = ""; 
        $this->data['issued_by'] = ""; 
        $this->data['issued_to'] = ""; 
        $this->data['prepared_by'] = ""; 
        $this->data['authorized_by'] = ""; 
        $this->data['status'] = "";
        $this->data['ship_to'] = "";
        $this->data['po_id'] = "";
        
        $where['delete_status'] = 1;
        if(!empty($po_id)):
                $where['po_id'] = $po_id;
                $this->data['po_id'] =$po_id;
        endif;
        if(!empty($order_date)):
                $where['order_date'] = $order_date;
                $this->data['order_date'] =$order_date;
        endif;
        if(!empty($ship_to)):
                $where['invt_ship_to.ship_id'] = $ship_to;
                $this->data['ship_to'] =$ship_to;
        endif;  
        if($issued_by):
            $where['issued_by'] = $issued_by;
            $this->data['issued_by'] = $issued_by;
        endif;
        if($issued_to):
            $where['issued_to'] = $issued_to;
            $this->data['issued_to'] = $issued_to;
        endif;
        if($prepared_by):
            $where['hr_emp_record.emp_id'] = $prepared_by;
            $this->data['prepared_by'] = $prepared_by;
        endif;
        if($authorized_by):
            $where['hr_emp_record.emp_id'] = $authorized_by;
            $this->data['authorized_by'] = $authorized_by;
        endif;
        if($status):
            $where['invt_purchase_order.order_status'] = $status;
            $this->data['status'] = $status;
        endif;
            $this->data['result'] = $this->InventoryModel->get_po_list('invt_purchase_order',$where);
    else:
        $where_n = array('delete_status' => 1);
        $this->data['result'] = $this->InventoryModel->get_po_list('invt_purchase_order',$where_n);
    endif;
        $this->data['page_title']   = 'Purchase Order List | ECMS';
        $this->data['page']         = 'inventory/purchase_order_list';
        $this->load->view('common/common',$this->data); 
    }
    
    public function view_items_issuance()
    {
        $ass_id = $this->uri->segment(3);
        $where = array('invt_items_assuance_details.ass_id'=>$ass_id);
        $wheredata = array('invt_items_assuance.ass_id'=>$ass_id);
        $this->data['item_issuance'] = $this->InventoryModel->get_itemsissuance('invt_items_assuance', $wheredata);
        $this->data['result'] = $this->InventoryModel->issuance_items_details('invt_items_assuance_details', $where);
        $this->data['page_title']   = 'Items Issuance | ECMS';
        $this->data['page']         = 'inventory/show_items_issuance';
        $this->load->view('common/common',$this->data); 
    }
    
    public function cancel_items_issuance()
    {
        $ass_id = $this->uri->segment(3);
        $where = array('invt_items_assuance_details.ass_id'=>$ass_id);
        $wheredata = array('invt_items_assuance.ass_id'=>$ass_id);
        $this->data['item_issuance'] = $this->InventoryModel->get_itemsissuance('invt_items_assuance', $wheredata);
        $this->data['result'] = $this->InventoryModel->issuance_items_details('invt_items_assuance_details', $where);
        $this->data['page_title']   = 'Cancel Items Issuance | ECMS';
        $this->data['page']         = 'inventory/cancel_items_issuance';
        $this->load->view('common/common',$this->data); 
    }
    
    public function cancel_issuance()
    { 
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()): 
        $ass_id     = $this->input->post('ass_id');
        $quantity   = $this->input->post('quantity');
        $item_id    = $this->input->post('item_id');
        $combine = array_combine($item_id, $quantity);
        foreach($combine as $key=>$row):
        $items_quantity = $this->CRUDModel->get_where_row('invt_items',array('itm_id'=>$key));
        $total_quantity = '';
        if(!empty($items_quantity)):
            $total_quantity = $items_quantity->item_quantity + $row;
        else:
            $total_quantity = $row;
        endif;
        $where = array('itm_id'=>$key);
        $cancel_data = array('item_quantity'=>$total_quantity);
            $this->CRUDModel->update('invt_items',$cancel_data,$where);
        endforeach;
        
        $where1 = array('ass_id'=>$ass_id);
        $logResult = $this->CRUDModel->get_where_result('invt_items_assuance_details',$where1);
        foreach($logResult as $logRow):
            $logData = array(
                'ass_id'            => $logRow->ass_id,
                'item_id'           => $logRow->item_id,
                'quantity'          => $logRow->quantity,
                'remaining_quantity' => $logRow->remaining_quantity,
                'date_time'         => date('Y-m-d H:i:s'),
                'up_user_id'        => $user_id,
            );
            $this->CRUDModel->insert('invt_items_assuance_details_log', $logData);
        endforeach;
        $itmResult = $this->CRUDModel->get_where_row('invt_items_assuance', $where1);
        $itmData = array(
            'ass_id'        => $itmResult->ass_id,
            'emp_id'        => $itmResult->emp_id,
            'dept_id'       => $itmResult->dept_id,
            'issuance_date' => $itmResult->issuance_date,
            'user_id'       => $itmResult->user_id,
            'timestamp'     => $itmResult->timestamp,
            'up_timestamp'  => date('Y-m-d H:i:s'),
            'up_user_id'    => $user_id,
        );
        $this->CRUDModel->insert('invt_items_assuance_log',$itmData);
        $this->InventoryModel->deleteissuance_id('invt_items_assuance_details',$where1);
        $this->InventoryModel->deleteissuance_id('invt_items_assuance',$where1);
        redirect('InventoryController/items_assuance');
        endif;
    }
    
    public function add_issuance_item()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post()):
            $item_id   = $this->input->post('item_id');
            $quantity  = $this->input->post('quantity');
            $form_Code  = $this->input->post('form_Code');
            $data       = array(
                'item_id' => $item_id,
                'quantity' =>$quantity,
                'form_Code' =>$form_Code,
                'date' => date('Y-m-d'),
                'user_id' => $user_id
            );
    $this->CRUDModel->insert('invt_items_assuance_details_demo',$data);
    $result = $this->InventoryModel->getitems_issuance();
        echo '<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" width="100%">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Total Quantity</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>';                     
                        if($result):
                        foreach($result as $eRow):
                        echo '<tr id="'.$eRow->serial_no.'Delete">
                                <td>'.$eRow->itm_name.'</td>
                                <td>'.$eRow->quantity.'</td>                          
                                <td><a href="javascript:void(0)" id="'.$eRow->serial_no.'" class="deleteIssu"><i class="fa fa-trash"></i></a></td>                          
                           </tr>';                      
                        endforeach;                        
                        endif;                      
                    echo '</tbody>
                </table> ';
        endif;
    ?>
        <script>
            jQuery(document).ready(function(){
                 jQuery('.deleteIssu').on('click',function(){
                 var deletId = this.id;
                 jQuery.ajax({
                     type:'post',
                     url : 'InventoryController/delete_issu_item',
                     data: {'deletId':deletId},
                     success : function(result){
                        var del = deletId+'Delete';
                        jQuery('#'+del).hide(); 
                     }
                 });

             });

            });

            </script>
<?php
}
    
    public function delete_issu_item()
    {
       $deletId = $this->input->post('deletId');
       $this->CRUDModel->deleteid('invt_items_assuance_details_demo',array('serial_no'=>$deletId));
   }
    
    public function insert_items_issuance()
    {
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post('submit_item')):  
           $emp_id   = $this->input->post('prepared_by');    
           $dept_id   = $this->input->post('dept_id');
           $form_Code  = $this->input->post('form_Code');
            $date   = $this->input->post('date');
            $date1 = date('Y-m-d', strtotime($date));
           $data = array(
                'emp_id' => $emp_id,
                'dept_id' => $dept_id,
                'issuance_date' =>$date1,
                'user_id' =>$user_id,
            );
            $id = $this->CRUDModel->insert('invt_items_assuance',$data);
            $where = array(
            'user_id'=>$user_id,
            'form_Code'=>$form_Code,
            'date' => date('Y-m-d')    
        ); 
       $res =  $this->CRUDModel->get_where_result('invt_items_assuance_details_demo', $where);
       foreach($res as $isRow):
        $data = array(   
            'item_id'       =>$isRow->item_id,
            'ass_id'      =>$id,
            'quantity'      =>$isRow->quantity,
            'form_Code'     =>$isRow->form_Code,
            'date'          =>$isRow->date,
            'user_id'       =>$isRow->user_id,
          );
        $this->CRUDModel->insert('invt_items_assuance_details',$data);
        $where = array('itm_id'=>$isRow->item_id);
        $q_items = $this->CRUDModel->get_where_row('invt_items',$where);
        $old_quantity = $q_items->item_quantity;
        $total_quantity = $old_quantity - $isRow->quantity;
        $item_data = array
            (
                'item_quantity'=>$total_quantity
            );
            $this->CRUDModel->update('invt_items',$item_data, $where);
        
            $where1 = array('item_id'=>$isRow->item_id,'ass_id'=>$id);
            $items_data = array
            (
                'remaining_quantity'=>$total_quantity
            );
            $this->CRUDModel->update('invt_items_assuance_details',$items_data, $where1);
            $whereDelete = array('user_id'=>$user_id,'form_Code'=>$form_Code,'date' => date('Y-m-d')); 
           $this->CRUDModel->deleteid('invt_items_assuance_details_demo',$whereDelete);
        endforeach; 
            redirect('InventoryController/items_assuance');
            endif;
    }
    
    public function add_items_issuance()
    {
        $this->data['page_title']   = 'Add Items Issuance | ECMS';
        $this->data['page']         = 'inventory/add_items_issuance';
        $this->load->view('common/common',$this->data); 
    }
    
    public function items_assuance()
    {
        if($this->input->post('search')):
            $emp_name     = $this->input->post('prepared_by');
            $issuance_date     = $this->input->post('issuance_date');
            $where = "";
            $this->data['issuance_date'] = "";
            $this->data['prepared_by'] = "";
            if($emp_name):
                $where['hr_emp_record.emp_id'] = $emp_name;
                $this->data['prepared_by'] = $emp_name;
            endif;
            if($issuance_date):
                $where['issuance_date'] = $issuance_date;
                $this->data['issuance_date'] = $issuance_date;
            endif;
            $this->data['result']   = $this->InventoryModel->search_issuance_items('invt_items_assuance', $where);
            else:
            $this->data['result']   = $this->InventoryModel->get_issuance_items();
        endif;
        $this->data['page_title']   = 'Items Assuance | ECMS';
        $this->data['page']         = 'inventory/items_assuance_list';
        $this->load->view('common/common',$this->data); 
    }
    
    public function stock_balance_report()
    {
         $this->data['main'] = $this->CRUDModel->dropDown('invt_main_category', 'Select Category', 'catm_id', 'catm_name');
         $this->data['item_id'] = "";    
         $this->data['catm_id']         = "";
         $this->data['issuance_date'] = "";   
         $this->data['emp_id'] = ''; 
        if($this->input->post('search')):
            $issuance_date     = $this->input->post('issuance_date');
            $item_id     = $this->input->post('item_id');
            $emp_id     = $this->input->post('emp_id');
            $catm_id = $this->input->post('catm_id');
            $where = "";
            $like = "";    
        
            if(!empty($item_id)):
                $where['invt_items.itm_id'] = $item_id;
                $this->data['item_id'] =$item_id;
            endif;
            if($emp_id):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] = $emp_id;
            endif;
            if($catm_id):
                $where['invt_main_category.catm_id'] = $catm_id;
                $this->data['catm_id'] = $catm_id;
            endif;
            if($issuance_date):
                $where['issuance_date'] = $issuance_date;
                $this->data['issuance_date'] = $issuance_date;
            endif;
            $this->data['result']   = $this->InventoryModel->get_stocks_balance($where);
//            echo '<pre>'; print_r($this->data['result']); die;
            else:
            $this->data['result']   = $this->InventoryModel->get_stock_balance();
        endif;
            if($this->input->post('export')):
            $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle('Stock Balance Report');
                $this->excel->getActiveSheet()->setCellValue('A1', 'Item Name');          
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1','Quantity');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                           
                $this->excel->getActiveSheet()->setCellValue('C1', 'Balance');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('D1','Issuance Date');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('E1','Employee');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('F1','Designation');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('G1','Department');
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(16);
        
                $this->excel->getActiveSheet()->setCellValue('H1','Issuance Department');
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(16);
    
            for($col = ord('A'); $col <= ord('H'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);               
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
        
            $issuance_date     = $this->input->post('issuance_date');
            $item_id     = $this->input->post('item_id');
            $emp_id     = $this->input->post('emp_id');
            $catm_id = $this->input->post('catm_id');
            $where = "";
            $like = "";    
             $this->data['item_id'] = "";    
             $this->data['catm_id']         = "";
             $this->data['issuance_date'] = "";   
             $this->data['emp_id'] = '';       
            
            if(!empty($item_id)):
                $where['invt_items.itm_id'] = $item_id;
                $this->data['item_id'] =$item_id;
            endif;
            if($emp_id):
                $where['hr_emp_record.emp_id'] = $emp_id;
                $this->data['emp_id'] = $emp_id;
            endif;
            if($catm_id):
                $where['invt_main_category.catm_id'] = $catm_id;
                $this->data['catm_id'] = $catm_id;
            endif;
            if($issuance_date):
                $where['issuance_date'] = $issuance_date;
                $this->data['issuance_date'] = $issuance_date;
            endif;
        $result = $this->InventoryModel->get_stocks_balance_excel($where);
                $exceldata="";
                foreach ($result as $row)
                {
                $exceldata[] = $row;
                }      
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
                $filename='Stock_Balance_Report.xls'; 
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0'); 
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                $objWriter->save('php://output');
            endif; 
        
        $this->data['page_title']   = 'Stock Balance Report | ECMS';
        $this->data['page']         = 'inventory/stock_balance_report';
        $this->load->view('common/common',$this->data); 
    }

    public function store()
    {
        if($this->input->post()):
            $item_id       =  $this->input->post('item_id');     
            $like = '';
            $where = '';
            $this->data['item_id'] = '';    
            if(!empty($item_id)):
                $where['invt_items.itm_id'] = $item_id;
                $this->data['item_id'] =$item_id;
            endif;
            $this->data['items'] = $this->InventoryModel->store_items('invt_items',$where);
            else:
            $this->data['items']        = $this->InventoryModel->get_storeitems();
            endif;
        
            if($this->input->post('export')):
                
                 $item_id       =  $this->input->post('item_id');     
            $like = '';
            $where = '';
            $this->data['item_id'] = '';    
            if(!empty($item_id)):
                $where['invt_items.itm_id'] = $item_id;
                $this->data['item_id'] =$item_id;
            endif;
    
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle('Inventory Items Store');
                $this->excel->getActiveSheet()->setCellValue('A1', 'Item Name');          
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('B1','Quantity');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16);
                           
                $this->excel->getActiveSheet()->setCellValue('C1', 'Category Name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(16);
                
                $this->excel->getActiveSheet()->setCellValue('D1','Type');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(16);
    
            for($col = ord('A'); $col <= ord('D'); $col++){
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);               
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
    
        $this->db->select('
        invt_items.itm_name,
        invt_items.item_quantity,
        invt_assets_type.at_name,
        invt_category.cat_name
        '); 
        $this->db->FROM('invt_items');
        $this->db->join('invt_category','invt_category.cat_id=invt_items.itm_catId','left outer');
        $this->db->join('invt_assets_type','invt_assets_type.at_id=invt_items.itm_asstId','left outer');       
        if($where):
            $this->db->where($where);
        endif;
        $this->db->order_by('item_quantity','desc');
        $rs =  $this->db->get();
        $exceldata="";
        foreach ($rs->result_array() as $row)
        {
        $exceldata[] = $row;
        }              
        $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');        
        $filename='InventoryStore.xls'; 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        $objWriter->save('php://output');
            
            endif;
        
        $this->data['page_title']   = 'Stock Items Store | ECMS';
        $this->data['page']         = 'inventory/store';
        $this->load->view('common/common',$this->data); 
    }
    
    public function grn()
    {
        $order_id = $this->uri->segment(3);
        $where = array('invt_purchase_order_details.order_id'=>$order_id);
        $wheredata = array('invt_purchase_order.po_id'=>$order_id);
        $this->data['purchase_order'] = $this->InventoryModel->get_podata('invt_purchase_order', $wheredata);
        $this->data['result'] = $this->InventoryModel->get_po_items('invt_purchase_order_details', $where);
        $this->data['page_title']   = 'Purchase Order Items | ECMS';
        $this->data['page']         = 'inventory/grn';
        $this->load->view('common/common',$this->data); 
    }
    
    public function add_grn(){
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
       
        if($this->input->post()): 
        $po_id              = $this->input->post('po_id');
        $sp_id              = $this->input->post('sp_id');
        $goods_rec_del_by   = $this->input->post('goods_rec_del_by');
        $received_by        = $this->input->post('received_by');
        $final_received_by  = $this->input->post('final_received_by');
        $delivery_status    = $this->input->post('delivery_status');
        $price              = $this->input->post('price');
        $quantity           = $this->input->post('quantity');
        $item_id            = $this->input->post('item_id');
        $grn_date           = $this->input->post('grn_date');
        $date1              = date('Y-m-d', strtotime($grn_date));
        $data = array(
        'po_id'             => $po_id,
        'grn_date'          => $date1,
        'sp_id'             => $sp_id,
        'goods_rec_del_by'  => $goods_rec_del_by,
        'received_by'       => $received_by,
        'final_received_by' => $final_received_by,
        'delivery_status'   => $delivery_status,
        'user_id'           =>$user_id
            );
            $grn_id = $this->CRUDModel->insert('invt_grn',$data);      
      $result =  $this->mergeArrays($price, $quantity, $item_id);
        
//            $combine = array_combine($price, $quantity);
//            $combine1 = array_combine($combine, $item_id);
       
                foreach($result as $valuerow):
                    
                $test_data = array
                (
                    'grn_id'=>$grn_id,
                    'item_id'=>$valuerow['item_id'],
                    'price'=>$valuerow['price'],
                    'quantity'=>$valuerow['quantity'],
                   'total_price'=>$valuerow['quantity']*$valuerow['price'],
                );
        
        $this->CRUDModel->insert('invt_grn_details',$test_data);
        $where = array('itm_id'=>$valuerow['item_id']);
        $q_items = $this->CRUDModel->get_where_row('invt_items',$where);
        $old_quantity = $q_items->item_quantity;
        $total_quantity = $old_quantity + $valuerow['quantity'];
        $item_data = array
            (
                'item_quantity'=>$total_quantity
            );
            $this->CRUDModel->update('invt_items',$item_data, $where);
        
                endforeach;
        
        $where = array('po_id'=>$po_id);
        $update_data = array('order_status'=>2);
        $this->CRUDModel->update('invt_purchase_order',$update_data, $where);
          
        redirect('InventoryController/purchase_order_list');
        endif;
    }
    
     function mergeArrays($price, $quantity, $item_id) 
        {
            $result = array();
            foreach ($price as $key=>$name) 
            {
                $result[] = array( 
                    'price' => $name,
                    'quantity' => $quantity[$key], 
                    'item_id' => $item_id[ $key ] 
                );
            }
            return $result;
        }
    
    public function show_po_items()
    {
        $order_id           = $this->uri->segment(3);
        $where              = array('invt_purchase_order_details.order_id'=>$order_id);
        $wheredata          = array('invt_purchase_order.po_id'=>$order_id);
        
        $this->data['purchase_order']   = $this->InventoryModel->get_podata('invt_purchase_order', $wheredata);
//        echo '<pre>';print_r($this->data['purchase_order']);die;
        $this->data['result']           = $this->InventoryModel->get_po_items('invt_purchase_order_details', $where);
        $this->data['DirectorFinance']  = $this->db->get_where('hr_emp_record',array('emp_id'=>$this->data['purchase_order'][0]->director_finance))->row()->emp_name;
        $this->data['VpAdmin']          = $this->db->get_where('hr_emp_record',array('emp_id'=>$this->data['purchase_order'][0]->vp_admin))->row()->emp_name;
        $this->data['page_title']       = 'Purchase Order Items | ECMS';
        $this->data['page']             = 'inventory/show_po_items';
        $this->load->view('common/common',$this->data); 
    }
    
    public function delete_purchase_order_item()
    {	 
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $id         = $this->uri->segment(3);
        $po_id      = $this->uri->segment(4);
        $where      = array('invt_purchase_order_details.purchase_order_id'=>$id);        
        $po_result  = $this->CRUDModel->get_where_row('invt_purchase_order_details', $where);
        $logData = array(
                        'purchase_order_id' => $po_result->purchase_order_id,
                        'order_id'          => $po_result->order_id,
                        'item_id'           => $po_result->item_id,
                        'brand_id'          => $po_result->brand_id,
                        'quantity'          => $po_result->quantity,
                        'price'             => $po_result->price,
                        'date'              => $po_result->date,
                        'user_id'           => $po_result->user_id,
                        'up_datetime'       => date('Y-m-d H:i:s'),
                        'up_user_id'        => $user_id
                        );
        $this->CRUDModel->insert('invt_purchase_order_details_log',$logData);
//        echo '<pre>'; print_r($logData); die;
        $this->CRUDModel->deleteid('invt_purchase_order_details',$where);
        redirect('InventoryController/update_purchase_order/'.$po_id);
	}
    
    public function update_purchase_order_item()
    {
        $id      = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post('add_value')):
            $item_id   = $this->input->post('item_id');
            $order_id   = $this->input->post('po_id');
            $brand_id  = $this->input->post('brand_id');
            $price     = $this->input->post('price');
            $quantity  = $this->input->post('quantity');
            $form_Code  = $this->input->post('form_Code');
            $total_price        = $price * $quantity;
            $data       = array(
                'item_id' => $item_id,
                'order_id' => $order_id,
                'brand_id' =>$brand_id,
                'price' =>$price,
                'quantity' =>$quantity,
                'total_price' =>$total_price,
                'form_Code' =>$form_Code,
                'date' => date('Y-m-d'),
                'user_id' => $user_id
            );
        $this->CRUDModel->insert('invt_purchase_order_details',$data);
        
                  $this->db->order_by('purchase_order_id', 'desc');
        $oneRow = $this->db->get('invt_purchase_order_details')->row();
        
        $updateData = array(
            'purchase_order_id' => $oneRow->purchase_order_id,
            'order_id'          => $oneRow->order_id,
            'item_id'           => $oneRow->item_id,
            'brand_id'          => $oneRow->brand_id,
            'quantity'          => $oneRow->quantity,
            'price'             => $oneRow->price,
            'date'              => date('Y-m-d'),
            'user_id'           => $user_id,
            'up_datetime'       => date('Y-m-d H:i:s'),
            'up_user_id'        => $user_id
        );
        $this->CRUDModel->insert('invt_purchase_order_details_log',$updateData);
        
        redirect('InventoryController/update_purchase_order/'.$order_id);
        endif;
        if($this->input->post('save')):
         redirect('InventoryController/purchase_order_list');   
        endif;
    }
    
    public function show_grn_items()
    {
        $po_id = $this->uri->segment(3);
        $wheredata = array('invt_grn.po_id'=>$po_id);
        $this->data['grn_order'] = $this->InventoryModel->get_grndata('invt_grn', $wheredata);
        $this->data['page_title']   = 'GRN Order Items | ECMS';
        $this->data['page']         = 'inventory/show_grn_items';
        $this->load->view('common/common',$this->data); 
    }

   public function stock_items()
    {
        if($this->input->post('search')):
            $itm_name       =  $this->input->post('itm_name');   
            $like = '';
            $this->data['itm_name'] = '';    
            if(!empty($itm_name)):
                $like['invt_items.itm_name'] = $itm_name;
                $this->data['itm_name'] =$itm_name;
            endif;
            $this->data['items'] = $this->InventoryModel->search_Stocksitems('invt_items',$like);
            else:
            $this->data['items']        = $this->InventoryModel->get_imtems();
            endif;
        
        $this->data['page_title']   = 'Stock Items | ECMS';
        $this->data['page']         = 'inventory/stock_items';
        $this->load->view('common/common',$this->data); 
    }


    public function update_item($id)
    {       
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $id = $this->uri->segment(3);
        if($this->input->post()):
            $itm_name       = $this->input->post('itm_name');
            $itm_shortname  = $this->input->post('itm_shortname');
            $item_quantity  = $this->input->post('item_quantity');
            $itm_catId      = $this->input->post('itm_catId');
            $itm_asstId     = $this->input->post('itm_asstId');
            $itm_comments   = $this->input->post('itm_comments');
            $itm_status     = $this->input->post('itm_status');
            $itm_details    = $this->input->post('itm_details');
            
            $log_itm_name       = $this->input->post('log_itm_name');
            $log_itm_shortname  = $this->input->post('log_itm_shortname');
            $log_item_quantity  = $this->input->post('log_item_quantity');
            $log_itm_catId      = $this->input->post('log_itm_catId');
            $log_itm_asstId     = $this->input->post('log_itm_asstId');
            $log_itm_comments   = $this->input->post('log_itm_comments');
            $log_itm_details    = $this->input->post('log_itm_details');
            $log_timestamp      = $this->input->post('log_time');
            $log_user_id    = $this->input->post('log_user_id');
            
            if($itm_name != $log_itm_name): $old_name = $log_itm_name; else: $old_name = $itm_name; endif;
            if($itm_shortname != $log_itm_shortname): $old_sname = $log_itm_shortname; else: $old_sname = $itm_shortname; endif;
            if($item_quantity != $log_item_quantity): $old_qty = $log_item_quantity; else: $old_qty = $item_quantity; endif;
            if($itm_catId != $log_itm_catId): $old_cid = $log_itm_catId; else: $old_cid = $itm_catId; endif;
            if($itm_asstId != $log_itm_asstId): $old_aid = $log_itm_asstId; else: $old_aid = $itm_asstId; endif;
            if($itm_comments != $log_itm_comments): $old_cmnt = $log_itm_comments; else: $old_cmnt = $itm_comments; endif;
            if($itm_details != $log_itm_details): $old_details = $log_itm_details; else: $old_details = $itm_details; endif;
            
            if($old_name != $itm_name || $old_sname != $itm_shortname || $old_qty != $item_quantity || $old_cid != $itm_catId || 
               $old_aid != $itm_asstId || $old_cmnt != $itm_comments || $old_details != $itm_details):
                $logData    = array(
                                'itm_id'            => $id,
                                'itm_name'          => $old_name,
                                'itm_shortname'     => $old_sname,
                                'item_quantity'     => $old_qty,
                                'itm_catId'         => $old_cid,
                                'itm_asstId'        => $old_aid,
                                'itm_comments'      => $old_cmnt,
                                'itm_details'       => $old_details,
                                'itm_timestamp'  => $log_timestamp,
                                'itm_userId'     => $log_user_id,
                                'itm_up_timestamp'  => date('Y-m-d H:i:s'),
                                'itm_up_userId'     => $user_id,
                                );
//                echo '<pre>'; print_r($logData); die;
                $this->CRUDModel->insert('invt_items_log', $logData);
            endif;
            
            $data = array(
                'itm_name'      => $itm_name,
                'itm_shortname' => $itm_shortname,
                'item_quantity' => $item_quantity,
                'itm_catId'     => $itm_catId,
                'itm_asstId'    => $itm_asstId,
                'itm_comments'  => $itm_comments,
                'itm_details'   => $itm_details
            );
            $where = array('itm_id'=>$id);
            $this->CRUDModel->update('invt_items',$data, $where);
            redirect('InventoryController/stock_items');
        endif;
        if($id):
                $where = array('invt_items.itm_id'=>$id);
                $this->data['result'] = $this->InventoryModel->getitem_byid('invt_items',$where);
                $this->data['page_title']        = 'Update Item | ECMS';
                $this->data['page']        =  'inventory/update_item';
                $this->load->view('common/common',$this->data);
            else:
                redirect('/');
            endif;
    }
    public function buliding_block(){ 
        if($this->input->post('search')): 
        $bb_id     = $this->input->post('bb_id');
        $where = "";
        $like = "";
       
        $this->data['bb_id'] = ""; 

        if($bb_id):
            $where['bb_id'] = $bb_id;
            $this->data['bb_id'] = $bb_id;
        endif;
        $this->data['buliding_block']       = $this->InventoryModel->get_BuildingBlocks('invt_building_block',$where);
        else:
            $this->data['buliding_block']   = $this->InventoryModel->getBuildingBlocks('invt_building_block');
       endif; 
        $this->data['page']             = "inventory/buliding_block";
        $this->data['page_title']       = 'Buliding Block| ECMS';
        $this->load->view('common/common',$this->data);
    }
    
//    public function buliding_block(){ 
//        if($this->input->post('search')): 
//        $bb_id     = $this->input->post('bb_id');
//        $where = "";
//        $like = "";
//       
//        $this->data['bb_id'] = ""; 
//
//        if($bb_id):
//            $where['bb_id'] = $bb_id;
//            $this->data['bb_id'] = $bb_id;
//        endif;
//        $this->data['buliding_block'] = $this->InventoryModel->get_BuildingBlocks('invt_building_block',$where);
//        else:
//    $this->data['buliding_block'] = $this->InventoryModel->getBuildingBlocks('invt_building_block');
//       endif; 
//        $this->data['page']             = "inventory/buliding_block";
//        $this->data['page_title']       = 'Buliding Block| ECMS';
//        $this->load->view('common/common',$this->data);
//    }
    
    public function delte_bulding_block(){
        $id     = $this->uri->segment(2);
        $where  = array('bb_id'=>$id);
        $this->CRUDModel->deleteid('invt_building_block',$where);
        redirect('bulidingBlock');
    }
   
 public function rooms(){    
       if($this->input->post('search')): 
        $rm_id     = $this->input->post('rm_id');
        $bb_id     = $this->input->post('bb_id');
        $where = "";
        $like = "";
       
        $this->data['rm_id'] = ""; 
        $this->data['bb_id'] = ""; 

        if($bb_id):
            $where['rm_bbId'] = $bb_id;
            $this->data['bb_id'] = $bb_id;
        endif;
        if($rm_id):
            $where['rm_id'] = $rm_id;
            $this->data['rm_id'] = $rm_id;
        endif;
            $this->data['invt_room'] = $this->InventoryModel->get_Searchrooms('invt_rooms',$where);
        else:
        $this->data['invt_room']        = $this->InventoryModel->get_rooms('invt_rooms');
        endif;
        $this->data['page']              = "inventory/setup/rooms_search_v";
        $this->data['page_title']       = 'Buliding Rooms | ECMS';
        $this->load->view('common/common',$this->data); 
    }
    public function update_room(){   
        $id = $this->uri->segment(3);
         
        if($this->input->post()):
            $rm_id          = $this->input->post('rm_id');
            $rm_name        = $this->input->post('rm_name');
            $rm_shortname   = $this->input->post('rm_shortname');
            $rm_bbId        = $this->input->post('rm_bbId');
            $room_total_area = $this->input->post('room_total_area');
            $rm_comment     = $this->input->post('rm_comments');     
            $rm_total_seats = $this->input->post('rm_total_seats');     
            
            $log_room_name      = $this->input->post('log_rm_name');
            $log_shortname      = $this->input->post('log_rm_shortname');
            $log_room_bbid      = $this->input->post('log_rm_bbId');
            $log_room_tarea     = $this->input->post('log_room_total_area');
            $log_comments       = $this->input->post('log_rm_comments');
            $log_timestamp      = date('Y-m-d H:i:s', strtotime($this->input->post('log_timestamp')));
            $log_user_id        = $this->input->post('log_user_id');

            if($rm_name != $log_room_name): $old_rm_name = $log_room_name; else: $old_rm_name = $rm_name; endif;
            if($rm_shortname != $log_shortname): $old_shortname = $log_shortname; else: $old_shortname = $rm_shortname; endif;
            if($rm_bbId != $log_room_bbid): $old_bbid = $log_room_bbid; else: $old_bbid = $rm_bbId; endif;
            if($room_total_area != $log_room_tarea): $old_tarea = $log_room_tarea; else: $old_tarea = $room_total_area; endif;
            if($rm_comment != $log_comments): $old_comments = $log_comments; else: $old_comments = $rm_comment; endif;
            
            if($old_rm_name != $rm_name || $old_shortname != $rm_shortname || $old_bbid != $rm_bbId || $old_tarea != $room_total_area || $old_comments != $rm_comment):
                
                $logData = array(
                            'rm_id'             => $rm_id,
                            'rm_bbId'           => $log_room_bbid,
                            'rm_name'           => $log_room_name,  
                            'rm_shortname'      => $log_shortname,
                            
                            'room_total_area'   => $log_room_tarea,  
                            'rm_comments'       => $log_comments,   
                            'rm_timestamp'      => $log_timestamp,  
                            'rm_userId'         => $log_user_id,
                            'rm_up_timestamp'   => date('Y-m-d H:i:s'),  
                            'rm_up_userId'      => $this->userInfo->user_id
                            );
//            echo '<pre>'; print_r($logData); die;
            $this->CRUDModel->insert('invt_rooms_log',$logData);
            endif;
            
            $data = array( 
                    'rm_name'           =>$rm_name,  
                    'rm_shortname'      =>$rm_shortname,
                    'rm_bbId'           =>$rm_bbId,
                    'room_total_area'   =>$room_total_area,  
                    'rm_comments'       =>$rm_comment,
                    'rm_total_seats'    => $rm_total_seats,
                    'rm_timestamp'      =>date('Y-m-d H:i:'),  
                    'rm_userId'         =>$this->userInfo->user_id  
                    );
            $where = array('rm_id'=>$id);
            $this->CRUDModel->update('invt_rooms',$data, $where);
            redirect('rooms');
        endif;
        if($id):
            $where = array('invt_rooms.rm_id'=>$id);
            $this->data['result'] = $this->InventoryModel->get_room_row('invt_rooms',$where);
            $this->data['page_title']        = 'Update Room | ECMS';
            $this->data['page']        =  'inventory/setup/update_room';
            $this->load->view('common/common',$this->data);
            else:
            redirect('/');
            endif;
    } 
    public function delterooms(){
        $id     = $this->uri->segment(2);
        $where  = array('rm_id'=>$id);
        $this->CRUDModel->deleteid('invt_rooms',$where);
        redirect('rooms'); 
    }
    public function check_asset_name(){
        
       $bb_id       = $this->input->post('bb_id');
       $asst_name   = $this->input->post('asst_name');
       
       $query = $this->CRUDModel->get_where_row('invt_rooms',array('rm_bbId'=>$bb_id,'rm_name'=>$asst_name));
       if($query):
            echo True;
        else:
            echo false;
       endif;
    }
    
    public function items(){
           
        $this->data['itemName']         = '';
        $this->data['shortName']        = '';
        $this->data['categoryId']       = '';
        $this->data['mainCategoryId']   = '';
        $this->data['itemType']         = '';
        $this->data['itemStatus']       = '';
           
        if($this->input->post('Search')):

             $cat_id         = $this->input->post('cat_id');
             $catm_id        = $this->input->post('catm_id');
             $asst_type_id   = $this->input->post('asst_type_id');
             $name           = $this->input->post('name');
             $srtname        = $this->input->post('srtname');
             $status         = $this->input->post('status');
             
             $where  = '';
             $like   = '';

             if(!empty($name)):
                 $like['invt_items.itm_name'] = $name;
                 $this->data['itemName'] = $name;
             endif;
             if(!empty($srtname)):
                 $like['invt_items.itm_shortname'] = $srtname;
                 $this->data['shortName'] = $srtname;
             endif;
             if(!empty($cat_id)):
                 $where['invt_items.itm_catId'] = $cat_id;
                 $this->data['categoryId'] = $cat_id;
             endif;
             if(!empty($catm_id)):
                 $where['invt_items.catm_id'] = $catm_id;
                 $this->data['mainCategoryId'] = $catm_id;
             endif;
             if(!empty($asst_type_id)):
                 $where['invt_items.itm_asstId'] = $asst_type_id;
                 $this->data['itemType'] = $asst_type_id;
             endif;
             if(!empty($status)):
                 $where['invt_items.itm_status'] = $status;
                 $this->data['itemStatus'] = $status;
             endif;
//            echo '<pre>'; print_r($like); die;
            $this->data['items'] = $this->InventoryModel->get_itemsData($where,$like);
             
         else:   
            $where = array('itm_status' => 1);
            $config['base_url']   = base_url('items');
            $config['total_rows'] = count($this->CRUDModel->getResults('invt_items'));  
            $config['per_page']         = 50;
            $config["num_links"]        = 2;
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
            $config['first_link']       = "<i class='fa fa-angle-left'></i>";
            $config['last_link']        = "<i class='fa fa-angle-right'></i>";

            $this->pagination->initialize($config);
            $page = is_numeric($this->uri->segment(2)) ? $this->uri->segment(2) :  0;
            $this->data['pages'] = $this->pagination->create_links();          
            $this->data['items'] = $this->InventoryModel->items_pagination($config['per_page'], $page, $where);
            $this->data['count'] =$config['total_rows']; 
         endif;

         
         //Category DropDown
        $this->data['invt_category']        = $this->CRUDModel->dropDown('invt_category', 'Select Category', 'cat_id', 'cat_name', array('cat_status' =>1)); 
        $this->data['invt_main_category']   = $this->CRUDModel->dropDown('invt_main_category', 'Select Main Category', 'catm_id', 'catm_name', array( 'catm_status' =>1)); 
        $this->data['asst_type']            = $this->CRUDModel->dropDown('invt_assets_type', 'Select Assets Type', 'at_id', 'at_name', array( 'at_status' =>1)); 
        
//        $this->data['items']        = $this->InventoryModel->get_imtems();
        $this->data['page']              = "inventory/items";
        $this->data['page_title']       = 'Items | ECMS';
        $this->load->view('common/common',$this->data);  
       
    }
    
    public function insert_inventory_item(){
             
        if($this->input->post()):
//            echo '<pre>';print_r($this->input->post());die;
            $itemName       = $this->input->post('item_name');
            $shortName      = $this->input->post('short_name');
            $mainCategory   = $this->input->post('main_category');
            $itemCategory   = $this->input->post('item_category');
            $assetType      = $this->input->post('item_asset_type');
            
                    $this->db->where(array('itm_name' => $itemName));
                    $this->db->or_where(array('itm_shortname' => $shortName));
            $check = $this->db->get('invt_items')->result();
            if(empty($check)):
                $data = array(
                    'itm_name'      => $itemName,
                    'itm_shortname' => $shortName,
                    'catm_id'       => $mainCategory,
                    'itm_catId'     => $itemCategory,
                    'itm_asstId'    => $assetType
                );
                $this->CRUDModel->insert('invt_items',$data);
                echo true;
            else:
                echo '<div class="alert alert-danger alert-dismissable center">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Sorry! Item Already Exist</strong> 
                    </div>';
            endif;    
//
//        else:
//            $this->data['dbUser']         = $this->CRUDModel->getResults('users');
//            $this->data['page']         = "userPolicy/db_user";
//            $this->data['title']        = 'User Edit Pages| ECMS';
//            $this->load->view('common/common',$this->data);  
        endif;
    }
    
    public function get_item_update_info(){
             
            $itemId       = $this->input->post('item_id');
            $invt_category      = $this->CRUDModel->dropDown('invt_category', 'Select Category', 'cat_id', 'cat_name', array('cat_status' =>1)); 
            $invt_main_category = $this->CRUDModel->dropDown('invt_main_category', 'Select Main Category', 'catm_id', 'catm_name', array( 'catm_status' =>1)); 
            $asst_type          = $this->CRUDModel->dropDown('invt_assets_type', 'Select Assets Type', 'at_id', 'at_name', array( 'at_status' =>1));
        
            $itemInfo = $this->db->get_where('invt_items',array('itm_id'=>$itemId))->row();
           
                echo '<div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12 col-sm-5 form-group">
                                <label for="name">Item Name</label>
                                <input type="text" name="upName" value="'.$itemInfo->itm_name.'" id="upname" class="form-control">
                                <input type="hidden" name="upId" value="'.$itemId.'" id="upId" class="form-control">
                            </div>

                            <div class="col-md-12 col-sm-5 form-group">
                                <label for="name">Short Name</label>
                                <input type="text" name="upShortName" value="'.$itemInfo->itm_shortname.'" id="upname" class="form-control">
                            </div>


                            <div class="col-md-12 col-sm-5 form-group">
                                <label for="name">Main Category</label>';
                                echo form_dropdown('upMainCategory', $invt_main_category, $itemInfo->catm_id,  array('class'=>'form-control'));
                            echo '</div>
                           
                            <div class="col-md-12 col-sm-5 form-group">
                                <label for="name">Main Category</label>';
                                echo form_dropdown('upCategory', $invt_category, $itemInfo->itm_catId,  array('class'=>'form-control'));
                            echo '</div>
                           
                            <div class="col-md-12 col-sm-5 form-group">
                                <label for="name">Main Category</label>';
                                echo form_dropdown('upAssetType', $asst_type, $itemInfo->itm_asstId,  array('class'=>'form-control'));
                            echo '</div>';
                           
                        echo '</div>
                        <div class="col-md-8" style="margin-left: 21px;">
                            <div id="up_error_message" >

                            </div>
                        </div>
                    </div>';
                 
        }
    
    
    public function invt_item_update(){
             
        $upItemId     = $this->input->post('upId');
        $upItemName     = $this->input->post('upName');
        $upShortName    = $this->input->post('upShortName');
        $upMainCategory = $this->input->post('upMainCategory');
        $upCategory     = $this->input->post('upCategory');
        $upAssetType    = $this->input->post('upAssetType');



            $this->form_validation->set_rules('upName', 'Item Name', 'required');
        if ($this->form_validation->run() == FALSE):
                    $this->form_validation->set_error_delimiters('<div class="danger">', '</div>'); 
            echo    validation_errors();
        else:
                $data = array(
                    'itm_name'      => $upItemName,
                    'itm_shortname' => $upShortName,
                    'catm_id'       => $upMainCategory,
                    'itm_catId'     => $upCategory,
                    'itm_asstId'    => $upAssetType,
                    );
                $wherec = array('itm_id' => $upItemId);
                $this->CRUDModel->update('invt_items',$data,$wherec);
        endif;
    }   

    
    public function check_item_name(){
        
       $cat_id      = $this->input->post('cat_id');
       $asst_type_id   = $this->input->post('asst_type_id');
       $item_name     = $this->input->post('item_name');
       
       $query = $this->CRUDModel->get_where_row('invt_items',array('itm_name'=>$item_name));
       if($query):
            echo True;
        else:
            echo false;
       endif;
    }
    public function check_item_shortcode(){
        
       $item_name     = $this->input->post('item_name');
       
       $query = $this->CRUDModel->get_where_row('invt_items',array('itm_shortname'=>$item_name));
       if($query):
            echo True;
        else:
            echo false;
       endif;
    }
    public function check_item_code(){
        
       $srtname      = $this->input->post('srtname');
        $query       = $this->CRUDModel->get_where_row('invt_rooms',array('rm_shortname'=>$srtname));
      
       if($query):
            echo True;
        else:
            echo false;
       endif;
    }
    public function deleteItems(){
        $id     = $this->uri->segment(2);
        $where  = array('itm_id'=>$id);
        $this->CRUDModel->deleteid('invt_items',$where);
        redirect('items'); 
    }
    public function fixed_items(){

        $this->data['page']             = "inventory/items_issuance";
        $this->data['fixedItems']       = $this->InventoryModel->get_items_lists();
         $this->data['page_header']      = 'Fixed Item Allotment';
        $this->data['page_title']       = 'Items Issuance | ECMS';
        $this->load->view('common/common',$this->data);   
        
        if($this->input->post('remove_trash')):
            
            $this->db->truncate('invt_fixed_item_details_demo');
            redirect('fixedItems');
        endif;
    }
    public function autocomplete_fix_emp(){
        
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
              
                $result_set     = $this->InventoryModel->get_emp_record();
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            'label'     =>$row_set->emp_name.' ('.$row_set->title.')', 
                            'code'     =>$row_set->emp_id, 
                            'value'     =>$row_set->emp_name.' ('.$row_set->title.')', 
                             
                    );
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['value']     = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                    
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                
                $result_set             = $this->InventoryModel->get_emp_record(array('emp_name'=>$like));
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                            'label'     =>$row_set->emp_name.' ('.$row_set->title.')', 
                            'code'      =>$row_set->emp_id, 
                            'value'     =>$row_set->emp_name.' ('.$row_set->title.')', 
                            
                    );
             }
            $matches                = array();
            foreach($labels as $label){
                     $label['value']    = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                     
                    $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    public function autocomplete_fix_block(){
        
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
              
                $result_set     = $this->InventoryModel->get_block_like_where(array('bb_status'=>1));
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            'label'     =>$row_set->bb_name, 
                            'code'     =>$row_set->bb_id, 
                            'value'     =>$row_set->bb_name, 
                             
                    );
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['value']     = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                    
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                
                $result_set             = $this->InventoryModel->get_block_like_where(array('bb_status'=>1),array('bb_name'=>$like));
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                             'label'     =>$row_set->bb_name, 
                            'code'     =>$row_set->bb_id, 
                            'value'     =>$row_set->bb_name, 
                            
                    );
             }
            $matches                = array();
            foreach($labels as $label){
                     $label['value']    = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                     
                    $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    public function autocomplete_items(){
        
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
              
                $result_set     = $this->InventoryModel->get_autoComplete_record('invt_items',array('itm_status'=>1));
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            'label'     =>$row_set->itm_name.' ('.$row_set->itm_shortname.')', 
                            'code'     =>$row_set->itm_id, 
                            'value'     =>$row_set->itm_name.' ('.$row_set->itm_shortname.')', 
                    );
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['value']     = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                    
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                
                $result_set             = $this->InventoryModel->get_autoComplete_record('invt_items',array('itm_status'=>1),array('itm_name'=>$like));
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                            'label'     =>$row_set->itm_name.' ('.$row_set->itm_shortname.')', 
                            'code'      =>$row_set->itm_id, 
                            'value'     =>$row_set->itm_name.' ('.$row_set->itm_shortname.')', 
                            
                    );
             }
            $matches                = array();
            foreach($labels as $label){
                     $label['value']    = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                     
                    $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    public function autocomplete_rooms(){
        
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
              
                $result_set     = $this->InventoryModel->get_autoComplete_record('invt_rooms',array('rm_status'=>1));
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            'label'     =>$row_set->rm_name.' ('.$row_set->rm_shortname.')', 
                            'code'     =>$row_set->rm_id, 
                            'value'     =>$row_set->rm_name.' ('.$row_set->rm_shortname.')', 
                    );
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['value']     = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                    
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                
                $result_set             = $this->InventoryModel->get_autoComplete_record('invt_rooms',array('rm_status'=>1),array('rm_name'=>$like));
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                            'label'     =>$row_set->rm_name.' ('.$row_set->rm_shortname.')', 
                            'code'      =>$row_set->rm_id, 
                            'value'     =>$row_set->rm_name.' ('.$row_set->rm_shortname.')', 
                            
                    );
             }
            $matches                = array();
            foreach($labels as $label){
                     $label['value']    = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                     
                    $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
        public function save_quantity_demo1(){
        
        $purchasePrice   = $this->input->post('purchasePrice');
     
        $roomnameCode   = $this->input->post('roomnameCode');
        $itemnameCode   = $this->input->post('itemnameCode');
        $quantity       = $this->input->post('quantity');
        $purchaseDate   = date('Y-m-d', strtotime($this->input->post('purchaseDate')));
        $issuedate      = date('Y-m-d', strtotime($this->input->post('issuedate')));
        $formCode       = $this->input->post('formCode');
        $userInfo       = $this->getUser();
        //get Room tableRecord
        $roomInfo       = $this->CRUDModel->get_where_row('invt_rooms',array('rm_id'=>$roomnameCode));
        $RoomShortName  = $roomInfo->rm_shortname;
 
        //get Room tableRecord
        $invt_items = $this->CRUDModel->get_where_row('invt_items',array('itm_id'=>$itemnameCode));
        $Itm_shortname = $invt_items->itm_shortname;
        
        $where = array(
            'fid_roomId'=>$roomnameCode,
            'fid_itemId'=>$itemnameCode,
        );
        $maxNumber      = $this->CRUDModel->get_max_value('fid_code','invt_fixed_item_details',$where);
        $maxNumberDemo  = $this->CRUDModel->get_max_value('fid_code','invt_fixed_item_details_demo',$where);
//        $maxNumberDemo  = $this->CRUDModel->get_max_value('cid_code','invt_consumable_item_details_demo',$where);
        $maxNum = '';
        $maxCode = ''; 
       
        if(!empty($maxNumber)):
              $maxNumber->fid_code;
                if(!empty($maxNumberDemo)):
                    $maxNumberDemo->fid_code; 
                    $maxNum  = max($maxNumber->fid_code,$maxNumberDemo->fid_code)+1;
                    $maxCode = $Itm_shortname.'-'.$RoomShortName.'-'.$maxNum;
                else:
                    $maxNum = $maxNumber->fid_code+1; 
                    $maxCode = $Itm_shortname.'-'.$RoomShortName.'-'.$maxNum;
                endif;
        else:
                if($maxNumberDemo):
                        if(!empty($maxNumber->fid_code)):
                        $maxNum  = max($maxNumber->fid_code,$maxNumberDemo->fid_code)+1;
                        else:
                        $maxNum  = max(0,$maxNumberDemo->fid_code)+1;
                        endif;
                        $maxCode = $Itm_shortname.'-'.$RoomShortName.'-'.$maxNum;
                 else:
                     $maxNum = 1; 
                     $maxCode = $Itm_shortname.'-'.$RoomShortName.'-'.'1';  
                endif;
               
        endif;
  
        if($quantity>1):
            
            
            for($i=0; $i<$quantity; $i++):
              $data = array(   
                    'fid_code'          =>$maxNum+$i,
                    'fid_roomId'        =>$roomnameCode,
                    'fid_purchasePrice' =>$purchasePrice,
                    'fid_purchaseDate'  =>$purchaseDate,
                    'fid_date'          =>$issuedate,
                    'fid_itemId'        =>$itemnameCode,
                    'fid_userId'        =>$userInfo['user_id'],
                    'fid_timestamp'     =>date('Y-m-d H:i:'),
                    'fid_formRenderCode' =>$formCode,
                  );
               $id =       $this->CRUDModel->insert('invt_fixed_item_details_demo',$data);
            
            endfor;
       
            
            else:
            $data = array(   
                    'fid_code'          =>$maxNum,
                    'fid_roomId'        =>$roomnameCode,
                    'fid_date'          =>$issuedate,
                    'fid_purchasePrice' =>$purchasePrice,
                    'fid_purchaseDate'  =>$purchaseDate,
                    'fid_itemId'        =>$itemnameCode,
                    'fid_userId'        =>$userInfo['user_id'],
                    'fid_timestamp'     =>date('Y-m-d H:i:'),
                    'fid_formRenderCode'=>$formCode,
                  );
                $id=    $this->CRUDModel->insert('invt_fixed_item_details_demo',$data);
        endif;
        
       
        
        
        $getWhere = array(
            'invt_fixed_item_details_demo.fid_date'              =>$issuedate,
            'invt_fixed_item_details_demo.fid_userId'            =>$userInfo['user_id'],
            'invt_fixed_item_details_demo.fid_formRenderCode'    =>$this->input->post('formCode'),
        );
                     
         
        $query = $this->InventoryModel->get_items_details($getWhere);
      
        echo '<div class="table-responsive">                      
                <table class="table table-hover">

                    <thead>
                        <tr>

                            <th>#</th>
                            <th>Code</th>
                            <th>Item</th>
                            <th>Room  name</th>
                            <th>Issue Date</th>
                            <th>Purchase Price</th>
                            <th>Purchase Date</th>


                        </tr>
                    </thead>

                        <tbody>';
                    $sn = '';  
                foreach($query as $qRow):
                    $sn++;
                        echo '<tr>
                           <th>'.$sn.'</th>
                            <th>'.$qRow->bb_shortname.'-'.$qRow->rm_shortname.'-'.$qRow->itm_shortname.'-'.$qRow->fid_code.'</th>
                            <th>'.$qRow->itm_name.' ('.$qRow->itm_shortname.')</th>
                            <th>'.$qRow->rm_name.' ('.$qRow->rm_shortname.')</th>
                            <th>'.date('d-m-Y', strtotime($qRow->fid_date)).'</th>    
                            <th>'.$qRow->fid_purchasePrice.'</th>
                            <th>'.date('d-m-Y', strtotime($qRow->fid_purchaseDate)).'</th>
                            
                            

                        </tr>'; 
                endforeach;


                echo '</tbody></table><!--//table-->
             </div>';
    }
           public function save_quantity_demo(){
        
     
        $purchasePrice   = $this->input->post('purchasePrice');
        $roomnameCode   = $this->input->post('roomnameCode');
        $item_grn       = $this->input->post('grn_items');
        $itemnameCode   = $this->input->post('itemnameCode');
        $quantity       = $this->input->post('quantity');
        $purchaseDate   = date('Y-m-d', strtotime($this->input->post('purchaseDate')));
        $issuedate      = date('Y-m-d', strtotime($this->input->post('issuedate')));
        $formCode       = $this->input->post('formCode');
        $userInfo       = $this->getUser();
        //get Room tableRecord
        $roomInfo       = $this->CRUDModel->get_where_row('invt_rooms',array('rm_id'=>$roomnameCode));
        $RoomShortName  = $roomInfo->rm_shortname;
 
        //get Room tableRecord
        $invt_items = $this->CRUDModel->get_where_row('invt_items',array('itm_id'=>$itemnameCode));
        $Itm_shortname = $invt_items->itm_shortname;
        
        $where = array(
            'fid_roomId'=>$roomnameCode,
            'fid_itemId'=>$itemnameCode,
        );
        $maxNumber      = $this->CRUDModel->get_max_value('fid_code','invt_fixed_item_details',$where);
        $maxNumberDemo  = $this->CRUDModel->get_max_value('fid_code','invt_fixed_item_details_demo',$where);
//        $maxNumberDemo  = $this->CRUDModel->get_max_value('cid_code','invt_consumable_item_details_demo',$where);
        $maxNum = '';
        $maxCode = ''; 
       
        if(!empty($maxNumber)):
              $maxNumber->fid_code;
                if(!empty($maxNumberDemo)):
                    $maxNumberDemo->fid_code; 
                    $maxNum  = max($maxNumber->fid_code,$maxNumberDemo->fid_code)+1;
                    $maxCode = $Itm_shortname.'-'.$RoomShortName.'-'.$maxNum;
                else:
                    $maxNum = $maxNumber->fid_code+1; 
                    $maxCode = $Itm_shortname.'-'.$RoomShortName.'-'.$maxNum;
                endif;
        else:
                if($maxNumberDemo):
                        if(!empty($maxNumber->fid_code)):
                        $maxNum  = max($maxNumber->fid_code,$maxNumberDemo->fid_code)+1;
                        else:
                        $maxNum  = max(0,$maxNumberDemo->fid_code)+1;
                        endif;
                        $maxCode = $Itm_shortname.'-'.$RoomShortName.'-'.$maxNum;
                 else:
                     $maxNum = 1; 
                     $maxCode = $Itm_shortname.'-'.$RoomShortName.'-'.'1';  
                endif;
               
        endif;
  
        if($quantity>1):
            
            
            for($i=0; $i<$quantity; $i++):
              $data = array(   
                    'fid_code'          =>$maxNum+$i,
                    'fid_roomId'        =>$roomnameCode,
                    'fid_purchasePrice' =>$purchasePrice,
                    'fid_grn'           =>$item_grn,
                    'fid_purchaseDate'  =>$purchaseDate,
                    'fid_date'          =>$issuedate,
                    'fid_itemId'        =>$itemnameCode,
                    'fid_userId'        =>$userInfo['user_id'],
                    'fid_timestamp'     =>date('Y-m-d H:i:'),
                    'fid_formRenderCode' =>$formCode,
                  );
               $id =       $this->CRUDModel->insert('invt_fixed_item_details_demo',$data);
            
            endfor;
       
            
            else:
            $data = array(   
                    'fid_code'          =>$maxNum,
                    'fid_roomId'        =>$roomnameCode,
                    'fid_date'          =>$issuedate,
                    'fid_grn'           =>$item_grn,
                    'fid_purchasePrice' =>$purchasePrice,
                    'fid_purchaseDate'  =>$purchaseDate,
                    'fid_itemId'        =>$itemnameCode,
                    'fid_userId'        =>$userInfo['user_id'],
                    'fid_timestamp'     =>date('Y-m-d H:i:'),
                    'fid_formRenderCode'=>$formCode,
                  );
                $id=    $this->CRUDModel->insert('invt_fixed_item_details_demo',$data);
        endif;
        
       
        
        
        $getWhere = array(
            'invt_fixed_item_details_demo.fid_date'              =>$issuedate,
            'invt_fixed_item_details_demo.fid_userId'            =>$userInfo['user_id'],
            'invt_fixed_item_details_demo.fid_formRenderCode'    =>$this->input->post('formCode'),
        );
                     
         
        $query = $this->InventoryModel->get_items_details($getWhere);
      
        echo '<div class="table-responsive">                      
                <table class="table table-hover">

                    <thead>
                        <tr>

                            <th>#</th>
                            <th>Code</th>
                            <th>GRN</th>
                            <th>Item</th>
                            <th>Room  name</th>
                            <th>Issue Date</th>
                            <th>Purchase Price</th>
                            <th>Purchase Date</th>


                        </tr>
                    </thead>

                        <tbody>';
                    $sn = '';  
                foreach($query as $qRow):
                    $sn++;
                        echo '<tr>
                           <th>'.$sn.'</th>
                            <th>'.$qRow->bb_shortname.'-'.$qRow->rm_shortname.'-'.$qRow->itm_shortname.'-'.$qRow->fid_code.'</th>
                            <th>'.$qRow->fid_grn.'</th>
                            <th>'.$qRow->itm_name.' ('.$qRow->itm_shortname.')</th>
                            <th>'.$qRow->rm_name.' ('.$qRow->rm_shortname.')</th>
                            <th>'.date('d-m-Y', strtotime($qRow->fid_date)).'</th>    
                            <th>'.$qRow->fid_purchasePrice.'</th>
                            <th>'.date('d-m-Y', strtotime($qRow->fid_purchaseDate)).'</th>
                            
                            

                        </tr>'; 
                endforeach;


                echo '</tbody></table><!--//table-->
             </div>';
    }
        public function save_quantity(){
        $emp_idCode     = $this->input->post('emp_idCode');
        $issuedate      = date('Y-m-d', strtotime($this->input->post('issuedate')));
        $formCode       = $this->input->post('formCode');
        $userInfo       = $this->getUser();
        
        
        //Insert Issue table record
        $inDate = array(
        'fii_empId'     => $emp_idCode, 
        'fii_date'      => $issuedate,
        'fii_userId'    =>$userInfo['user_id'],
        'fii_timestamp' =>date('Y-m-d H:i:'),
           
        );
        $issuanceTabel = $this->CRUDModel->insert('invt_fixed_item_issuance',$inDate); 
       
        //Get Result form Demo Table
         $data_where = array(   
            'fid_userId'            => $userInfo['user_id'],
            'fid_date'              => $issuedate,
            'fid_formRenderCode'    => $formCode,
            'fid_userId'            => $userInfo['user_id'],
        );
        $demoDetails =  $this->CRUDModel->get_where_result('invt_fixed_item_details_demo',$data_where);
  
        foreach($demoDetails as $isRow):
            
               
              //insert user Table
        $data = array(   
            'fid_code'              =>$isRow->fid_code,
            'fid_roomId'            =>$isRow->fid_roomId,
            'fid_date'              =>$isRow->fid_date,
            'fid_pur_price'         =>$isRow->fid_purchasePrice,
            'fid_grn'               =>$isRow->fid_grn,
            'fid_pur_date'          =>$isRow->fid_purchaseDate,
            'fid_itemId'            =>$isRow->fid_itemId,
            'fid_userId'            =>$userInfo['user_id'],
            'fid_timestamp'         =>date('Y-m-d H:i:'),
            'fid_fiiId'             =>$issuanceTabel,

          );
        
        
           $ifid =  $this->CRUDModel->insert('invt_fixed_item_details',$data);
                 
           $query=    $this->InventoryModel->get_items_detailsRow('invt_fixed_item_details',array('fid_id'=>$ifid));
    
             $barcode =  $query->bb_shortname.'-'.$query->rm_shortname.'-'.$query->itm_shortname.'-'.$query->fid_code;
            
             $this->CRUDModel->update('invt_fixed_item_details',array('fid_barCode_img'=>$this->barcode($barcode),'fid_barCode'=>$barcode),array('fid_id'=>$ifid));
             
            $whereDelete    = array('fid_id'=>$isRow->fid_id,'fid_formRenderCode'=>$isRow->fid_formRenderCode);
            $this->CRUDModel->deleteid('invt_fixed_item_details_demo',$whereDelete);
        endforeach;
        
        
       
    }
    public function save_quantity1(){
        $emp_idCode     = $this->input->post('emp_idCode');
        $issuedate      = date('Y-m-d', strtotime($this->input->post('issuedate')));
        $formCode       = $this->input->post('formCode');
        $userInfo       = $this->getUser();
        
        
        //Insert Issue table record
        $inDate = array(
        'fii_empId'     => $emp_idCode, 
        'fii_date'      => $issuedate,
        'fii_userId'    =>$userInfo['user_id'],
        'fii_timestamp' =>date('Y-m-d H:i:'),
           
        );
        $issuanceTabel = $this->CRUDModel->insert('invt_fixed_item_issuance',$inDate); 
       
        //Get Result form Demo Table
         $data_where = array(   
            'fid_userId'            => $userInfo['user_id'],
            'fid_date'              => $issuedate,
            'fid_formRenderCode'    => $formCode,
            'fid_userId'            => $userInfo['user_id'],
        );
        $demoDetails =  $this->CRUDModel->get_where_result('invt_fixed_item_details_demo',$data_where);
  
        foreach($demoDetails as $isRow):
            
               
              //insert user Table
        $data = array(   
            'fid_code'              =>$isRow->fid_code,
            'fid_roomId'            =>$isRow->fid_roomId,
            'fid_date'              =>$isRow->fid_date,
            'fid_pur_price'         =>$isRow->fid_purchasePrice,
            'fid_pur_date'          =>$isRow->fid_purchaseDate,
            'fid_itemId'            =>$isRow->fid_itemId,
            'fid_userId'            =>$userInfo['user_id'],
            'fid_timestamp'         =>date('Y-m-d H:i:'),
            'fid_fiiId'             =>$issuanceTabel,

          );
        
        
           $ifid =  $this->CRUDModel->insert('invt_fixed_item_details',$data);
                 
           $query=    $this->InventoryModel->get_items_detailsRow('invt_fixed_item_details',array('fid_id'=>$ifid));
    
             $barcode =  $query->bb_shortname.'-'.$query->rm_shortname.'-'.$query->itm_shortname.'-'.$query->fid_code;
            
             $this->CRUDModel->update('invt_fixed_item_details',array('fid_barCode_img'=>$this->barcode($barcode),'fid_barCode'=>$barcode),array('fid_id'=>$ifid));
             
            $whereDelete    = array('fid_id'=>$isRow->fid_id,'fid_formRenderCode'=>$isRow->fid_formRenderCode);
            $this->CRUDModel->deleteid('invt_fixed_item_details_demo',$whereDelete);
        endforeach;
        
        
       
    }
    
    public function inventory_dept_value(){
        
       
        if($this->input->post()):
           
            $emp_id         = $this->input->post('emp_idCode');
            $itemnameCode   = $this->input->post('itemnameCode');
            $roomnameCode   = $this->input->post('roomnameCode');
            $blockNameId    = $this->input->post('blockNameId');
        
            if($emp_id):
                $where['fii_empId'] = $emp_id;
            endif;
            if($blockNameId):
                $where['bb_id'] = $blockNameId;
            endif;
            if($itemnameCode):
                $where['fid_itemId'] = $itemnameCode;
            endif;
            if($roomnameCode):
                $where['fid_roomId'] = $roomnameCode;
            endif;
            
            $where['fid_trash'] = 1;
            
            if($this->input->post('search')):
                $this->data['faxItems']         = $this->InventoryModel->get_fix_itemsList($where);
              
            endif;
         
            
                
                
        
         
        endif;
        
        $this->data['page']             = "inventory/fixedItem_dept_value";
        $this->data['page_title']       = 'FixedItem Dept Value| ECMS';
        $this->load->view('common/common',$this->data);
    }
    
    public function inventory_report(){
        
       
        if($this->input->post()):
           
            $emp_id         = $this->input->post('emp_idCode');
            $itemnameCode   = $this->input->post('itemnameCode');
            $roomnameCode   = $this->input->post('roomnameCode');
            $blockNameId    = $this->input->post('blockNameId');
        
            if($emp_id):
                $where['fii_empId'] = $emp_id;
            endif;
            if($blockNameId):
                $where['bb_id'] = $blockNameId;
            endif;
            if($itemnameCode):
                $where['fid_itemId'] = $itemnameCode;
            endif;
            if($roomnameCode):
                $where['fid_roomId'] = $roomnameCode;
            endif;
            
            $where['fid_trash'] = 1;
            
            if($this->input->post('search')):
                $this->data['faxItems']         = $this->InventoryModel->get_fix_itemsList($where);
              
            endif;
         
            if($this->input->post('export')):
            
                
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Inventory List');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Employee name');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'Code');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Block name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
                
               
                $this->excel->getActiveSheet()->setCellValue('D1', 'Room');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);

               
                $this->excel->getActiveSheet()->setCellValue('E1', 'Code');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('F1', 'Date');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(12);

               
                
       for($col = ord('A'); $col <= ord('F'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
                $result        = $this->InventoryModel->get_fix_itemsListExecl($where);
                foreach ($result as $row){
                    $exceldata[] = $row;
                }
              $name = 'Inventory List '.date('Y-m-d H:i:s');
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                  
                $filename= $name.'.xls'; //save our workbook as this file name
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
        
        $this->data['page']             = "inventory/fixedItem_report";
        $this->data['page_title']       = 'Fix Items List | ECMS';
        $this->load->view('common/common',$this->data);
    }
       public function subject_report_inter(){
        
            if($this->input->post()):
                
                $college_number = $this->input->post('college_number');
                $section        = $this->input->post('section');
                $std_name       = $this->input->post('std_name');
                $std_fname      = $this->input->post('std_fname');
                
                $where['student_record.programe_id'] = 1;
               $this->data['sectionId'] = '';  
                $like = '';
                if($college_number):
                   $where['student_record.college_no'] = $college_number;  
                   $this->data['college_number'] = $college_number; 
                    
                endif;
               
                if($section):
                   $where['sections.sec_id'] = $section;  
                   $this->data['sectionId'] = $section;  
                   
                endif;
               
                if($std_name):
                   $like['student_record.student_name'] = $std_name;  
                   $this->data['std_name'] = $std_name;  
                endif;
               
                if($std_fname):
                   $like['student_record.father_name'] = $std_fname;  
                   $this->data['std_fname'] = $std_fname;  
                endif;
               
                
                $this->data['subject_record'] = $this->AttendanceModel->subject_inter_record($where,$like);
                //echo '<pre>';print_r($this->data);die;
            endif;
              $wherePrg                       = array('status'=>'on','program_id'=>1);
            $this->data['section']          = $this->CRUDModel->dropDown('sections', ' Program', 'sec_id', 'name',$wherePrg);
           
            $this->data['HeaderPage']       = 'Student Subject Report (Inter)';
            $this->data['page_title']       = 'Student Attendance Report | ECMS';
            $this->data['page']             = 'attendance/student_wise_report';
            $this->load->view('common/common',$this->data);
    }
    
      public function inventory_report_search(){
        
            $emp_id         = $this->input->post('emp_idCode');
            $itemnameCode   = $this->input->post('itemnameCode');
            $roomnameCode   = $this->input->post('roomnameCode');
            $blockNameId    = $this->input->post('blockNameId');
        
            if($emp_id):
                $where['fii_empId'] = $emp_id;
            endif;
            if($blockNameId):
                $where['bb_id'] = $blockNameId;
            endif;
            if($itemnameCode):
                $where['fid_itemId'] = $itemnameCode;
            endif;
            if($roomnameCode):
                $where['fid_roomId'] = $roomnameCode;
            endif;
            
            $where['fid_trash'] = 1;
            
      
                $faxItems        = $this->InventoryModel->get_fix_itemsList($where);
     
                
                
                echo '   <h3 class="has-divider text-highlight">Result :'.count($faxItems).'</h3>
            <div class="table-responsive">
                   <table class="table table-hover" id="table">
              <thead>
                <tr>
              
                      <th>Employee Name</th>
                     
                      <th>Code</th>
                        <th>Block</th>
                        <th>Room Name</th>
                        <th>Item</th>
                        <th>Purchase Price</th>
                        <th>Purchase Date</th>
                        <th>Issue Date</th>
                        <th>Edit</th>
                        <th>Delete</th>
                </tr>
              </thead>
              <tbody>';
              
                 if($faxItems):
                     foreach($faxItems as $fiRow):
                     echo '<tr id="'.$fiRow->fid_id.'ItemRow">
                        
                         <th>'.$fiRow->emp_name.'</th>
                              
                            <th>'.$fiRow->bb_shortname.'-'.$fiRow->rm_shortname.'-'.$fiRow->itm_shortname.'-'.$fiRow->fid_code.'</th>
                           <th>'.$fiRow->bb_name.'</th>
                           
                            <th>'.$fiRow->rm_name.' ('.$fiRow->rm_shortname.')</th>
                            <th>'.$fiRow->itm_name.' ('.$fiRow->itm_shortname.')</th>
                            <th>'.$fiRow->fid_pur_price.'</th>
                           
                            <th>'.date('d-m-Y', strtotime($fiRow->fid_pur_date)).'</th>
                                 <th>'.date('d-m-Y', strtotime($fiRow->fid_date)).'</th>
                            
                        ';
                 ?>
              
                   
              <td ><a href="IssueItemEdit/<?php echo $fiRow->fid_id; ?>"   class="deleteFixedItems"><span class="btn btn-success btn-sm">Edit</span></a></td>
              <td ><a href="javscript:void(0)" id="<?php echo $fiRow->fid_id; ?>"  class="deleteFixedItems"><span class="btn btn-danger btn-sm">Delete</span></a></td>
          <?php         
         echo  '</tr>';
                     endforeach;
                 endif;
              
                                                      
              echo '</tbody>
            </table>
            </div>
         
            ';
              ?>
                    <script>
               
    jQuery(document).ready(function(){          
    jQuery('.deleteFixedItems').on('click',function(){
       if (confirm("Are you sure?")) {
            var id = this.id;
           jQuery.ajax({
               type   : 'post',
               url    : 'udpateFixedItems/'+id ,

               success: function(result){
                   var del = id+'ItemRow';
                   jQuery('#'+del).hide(); 
                   
                   

               }
           });
       } 
       
       
    });
    });
               </script>          
        <?php
    }
    
    public function issue_item_edit(){
        
            $this->data['employee_details']    = $this->CRUDModel->employee_dropdown('hr_emp_record', 'Employee name', 'emp_id', 'emp_name',array('emp_status_id'=>1));
            
//            echo '<pre>';print_r($this->data['employee_details']);die;
        if($this->input->post()):
            $purchase_date      = date('Y-m-d', strtotime($this->input->post('purchase_date')));
            $pur_price          = $this->input->post('pur_price');
            $fid_comments       = $this->input->post('fid_comments');
            $purc_item_id       = $this->input->post('purc_item_id');
            $fii_id             = $this->input->post('fii_id');
            $emp_id             = $this->input->post('emp_id');
            
            $where = array(
                'fid_id'=>$purc_item_id
            );
            
            $data = array(
                'fid_pur_date'  =>$purchase_date,
                'fid_pur_price  '=>$pur_price,
                'fid_comments'  =>$fid_comments,
              
            );
           $this->CRUDModel->update('invt_fixed_item_details',$data,$where); 
           
           $data_empy = array(
                 
                'fii_empId'  =>$emp_id,
            );
           $this->CRUDModel->update('invt_fixed_item_issuance',$data_empy,array('fii_id'=>$fii_id)); 
           redirect('inventoryReport');
        endif;
        $itemid = $this->uri->segment(2);
        $where = array(
            'fid_id'=>$itemid
        );
           $this->data['faxItems']        = $this->InventoryModel->get_fix_itemsList_edit($where);
        
            
         $this->data['page']             = "inventory/fixedItem_add_purchas_price";
        $this->data['page_title']       = 'Edit Purchase Price | ECMS';
        $this->load->view('common/common',$this->data);
        
    }
  
    public function inventory_dept_value_search(){
        
            $emp_id         = $this->input->post('emp_idCode');
            $itemnameCode   = $this->input->post('itemnameCode');
            $roomnameCode   = $this->input->post('roomnameCode');
            $blockNameId    = $this->input->post('blockNameId');
        
            if($emp_id):
                $where['fii_empId'] = $emp_id;
            endif;
            if($blockNameId):
                $where['bb_id'] = $blockNameId;
            endif;
            if($itemnameCode):
                $where['fid_itemId'] = $itemnameCode;
            endif;
            if($roomnameCode):
                $where['fid_roomId'] = $roomnameCode;
            endif;
            
            $where['fid_trash'] = 1;
            
      
                $faxItems        = $this->InventoryModel->get_fix_itemsList($where);
                echo '   <h3 class="has-divider text-highlight">Result :'.count($faxItems).'</h3>
            <div class="table-responsive">
                   <table class="table table-hover" id="table">
              <thead>
                <tr>
              
                      <th>Employee Name</th>
                     
                      <th>Code</th>
                        <th>Block</th>
                        <th>Room Name</th>
                        <th>Item</th>
                        <th>Add Value</th>
                </tr>
              </thead>
              <tbody>';
              
                 if($faxItems):
                     foreach($faxItems as $fiRow):
                     echo '<tr id="'.$fiRow->fid_id.'ItemRow">
                        
                         <th>'.$fiRow->emp_name.'</th>
                              
                            <th>'.$fiRow->bb_shortname.'-'.$fiRow->rm_shortname.'-'.$fiRow->itm_shortname.'-'.$fiRow->fid_code.'</th>
                           <th>'.$fiRow->bb_name.'</th>
                            <th>'.$fiRow->rm_name.' ('.$fiRow->rm_shortname.')</th>
                            <th>'.$fiRow->itm_name.' ('.$fiRow->itm_shortname.')</th>';
                   $encode =  $this->encrypt->decode('deptItemsValues/'. $fiRow->fid_id);
                   
                 ?>
              
                   
              <td ><a href="deptItemsValues/<?php echo $fiRow->fid_id; ?>" class="AddDeptValue">
                      
                  <p><span class="label label-danger"><i class="fa fa-paper-plane"></i>Add Value</span></p>
                  </a></td>
          <?php         
         echo  '</tr>';
                     endforeach;
                 endif;
              
                                                      
              echo '</tbody>
            </table>
            </div>
         
            ';
         
    }
    
    public function inventory_dept_value_update(){
        
         $itemId = $this->uri->segment('2');
         $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
         
                    $where = array('fid_id'=>$itemId);
                    $this->db->FROM('invt_fixed_item_issuance');
                    $this->db->join('hr_emp_record','invt_fixed_item_issuance.fii_empId=hr_emp_record.emp_id','left outer');
                    $this->db->join('invt_fixed_item_details','invt_fixed_item_details.fid_fiiId=invt_fixed_item_issuance.fii_id','left outer');
                    $this->db->join('invt_rooms','invt_rooms.rm_id=invt_fixed_item_details.fid_roomId','left outer');
                    $this->db->join('invt_building_block','invt_rooms.rm_bbId=invt_building_block.bb_id','left outer');
                    $this->db->join('invt_items','invt_items.itm_id=invt_fixed_item_details.Fid_itemId','left outer');
                    $this->db->where($where);
        $this->data['result'] =  $this->db->get()->row();
        
        
        $this->data['supplier']    = $this->CRUDModel->dropDown('invt_supplier', 'Select Supplier', 'sp_id', 'sp_name',array('sp_status'=>1));
         
        if($this->input->post()):
            $purchasePrice  = $this->input->post('purchasePrice');
            $PurchaseDate   = $this->input->post('PurchaseDate');
            $supplier       = $this->input->post('supplier');
            $supplierId     = $this->input->post('supplierId');
            $dept_rate      = $this->input->post('dept_rate');
            $dept_amount    = $this->input->post('dept_amount');
            $accum_depr     = $this->input->post('accum_depr');
            $wdv            = $this->input->post('wdv');
            $fid_id         = $this->input->post('fid_id');
            
            $log_purchasePrice  = $this->input->post('log_purchasePrice');
            $log_PurchaseDate   = $this->input->post('log_PurchaseDate');
            $log_supplierId     = $this->input->post('log_supplierId');
            $log_dept_rate      = $this->input->post('log_dept_rate');
            
            if($purchasePrice != $log_purchasePrice): $old_purchasePrice = $log_purchasePrice; else: $old_purchasePrice = $purchasePrice; endif;
            if($PurchaseDate != $log_PurchaseDate): $old_purchaseDate = $log_PurchaseDate; else: $old_purchaseDate = $PurchaseDate; endif;
            if($supplierId != $log_supplierId): $old_supplierId = $log_supplierId; else: $old_supplierId = $supplierId; endif;
            if($dept_rate != $log_dept_rate): $old_dept_rate = $log_dept_rate; else: $old_dept_rate = $dept_rate; endif;
            
            if($purchasePrice != $log_purchasePrice || $PurchaseDate != $log_PurchaseDate || $supplierId != $log_supplierId || $dept_rate != $log_dept_rate):
                $log_data = array(
                                'fid_id'            => $fid_id,
                                'fid_pur_price'     => $old_purchasePrice,
                                'fid_pur_date'      => $old_purchaseDate,
                                'fid_supplierId'    => $old_supplierId,
                                'fid_dept_rate'     => $old_dept_rate,
                                'fid_up_timestamp'  => date('Y-m-d H:i:s'),
                                'fid_up_userId'     => $user_id,
                                );
                $this->CRUDModel->insert('invt_fixed_item_details_log',$log_data);
            endif;
            
            
            $where = array('fid_id'=>$fid_id);
            $data = array(
                'fid_pur_price'=>$purchasePrice,
                'fid_pur_date'=>$PurchaseDate,
                'fid_supplierId'=>$supplierId,
                'fid_dept_rate'=>$dept_rate,
                'fid_dept_amount'=>$dept_amount,
                'fid_accum_depr'=>$accum_depr,
                'fid_wdv'=>$wdv,
                    );
            $this->CRUDModel->update('invt_fixed_item_details',$data,$where);
            redirect('inventoryDeptValue');
        endif;
        
        $this->data['page']             = "inventory/fixedItem_dept_update_value";
        $this->data['page_title']       = 'Item Dept Value | ECMS';
        $this->load->view('common/common',$this->data);
    }
    public function udpate_fixed_items(){
        $id = $this->uri->segment(2);
     
        $this->CRUDModel->deleteid('invt_fixed_item_details',array('fid_id'=>$id));
 
    }
    
          public function inventory_report_barcode(){
        
       
        if($this->input->post()):
          
           
            $emp_id         = $this->input->post('emp_idCode');
            $itemnameCode   = $this->input->post('itemnameCode');
            $roomnameCode   = $this->input->post('roomnameCode');
            $blockNameId    = $this->input->post('blockNameId');
            $issue_date     = $this->input->post('blockNameId');
        
            if($emp_id):
                $where['fii_empId'] = $emp_id;
            endif;
            if($blockNameId):
                $where['bb_id'] = $blockNameId;
            endif;
            if($itemnameCode):
                $where['fid_itemId'] = $itemnameCode;
            endif;
            if($roomnameCode):
                $where['fid_roomId'] = $roomnameCode;
            endif;
            if($issue_date):
                $where['invt_fixed_item_details.fid_date'] = $issue_date;
            endif;
            
            $where['fid_trash'] = 1;
            
            if($this->input->post('search')):
                $this->data['faxItems']         = $this->InventoryModel->get_fix_itemsList($where);
           
                
            endif;
      
        endif;
        
        $this->data['page']             = "inventory/fixedItem_barcode";
        $this->data['page_title']       = 'Fix Items List | ECMS';
        $this->load->view('common/common',$this->data);
    }
        public function inventory_barcode(){
        
            $emp_id         = $this->input->post('emp_idCode');
            $itemnameCode   = $this->input->post('itemnameCode');
            $roomnameCode   = $this->input->post('roomnameCode');
            $blockNameId    = $this->input->post('blockNameId');
            $todate         = $this->input->post('todate');
            $fromdate       = $this->input->post('fromdate');
        
            $date = array(
              'from' =>$fromdate,  
              'to' =>$todate,  
            );
            if($emp_id):
                $where['fii_empId'] = $emp_id;
            endif;
            if($blockNameId):
                $where['bb_id'] = $blockNameId;
            endif;
            if($itemnameCode):
                $where['fid_itemId'] = $itemnameCode;
            endif;
            if($roomnameCode):
                $where['fid_roomId'] = $roomnameCode;
            endif;
            
            $where['fid_trash'] = 1;
            
      
                $faxItems        = $this->InventoryModel->get_fix_itemsList($where,$date);
                $chunk   = 5;
                
//                echo '<pre>';print_r($faxItems);die;
                echo '<table border="1">';
                foreach (array_chunk($faxItems, $chunk) as $row):
                    echo '<tr>';
                            foreach ($row as $val):
                                echo '<th style="padding:15px;"><img src="assets/barcode/'.$val->fid_barCode_img.'"></th>';
                            endforeach;
                    echo '</tr>';
                endforeach;
                echo '</table>';
                
                
                 
    }
    
        //Update barcode images and cdoe..
    public function updaetBarcode (){
         $this->db->select('*');
        $this->db->from('invt_fixed_item_details');
        $this->db->join('invt_rooms','invt_rooms.rm_id=invt_fixed_item_details.fid_roomId');
        $this->db->join('invt_building_block','invt_building_block.bb_id=invt_rooms.rm_bbId');
         $this->db->join('invt_items','invt_items.itm_id=invt_fixed_item_details.Fid_itemId');
        $this->db->where('fid_barCode_img =','');
        $get = $this->db->get()->result();
        
        
//         echo '<pre>';print_r($get);die;
        foreach($get as $query):
            
              $barcode =  $query->bb_shortname.'-'.$query->rm_shortname.'-'.$query->itm_shortname.'-'.$query->fid_code;
        
       $this->CRUDModel->update('invt_fixed_item_details',array('fid_barCode_img'=>$this->barcode($barcode),'fid_barCode'=>$barcode),array('fid_id'=>$query->fid_id));
             
        endforeach;
    }

      public function autocomplete_supplier(){
        
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
              
                $result_set     = $this->InventoryModel->get_emp_record();
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            'label'     =>$row_set->emp_name.' ('.$row_set->title.')', 
                            'code'     =>$row_set->emp_id, 
                            'value'     =>$row_set->emp_name.' ('.$row_set->title.')', 
                             
                    );
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['value']     = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                    
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                
                $result_set             = $this->InventoryModel->get_emp_record(array('emp_name'=>$like));
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                            'label'     =>$row_set->emp_name.' ('.$row_set->title.')', 
                            'code'      =>$row_set->emp_id, 
                            'value'     =>$row_set->emp_name.' ('.$row_set->title.')', 
                            
                    );
             }
            $matches                = array();
            foreach($labels as $label){
                     $label['value']    = $label['value'];
                    $label['code']      = $label['code'];
                    $label['label']     = $label['label']; 
                     
                    $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
        public function inventory_report_details(){
        
       
        if($this->input->post()):
           
            $emp_id         = $this->input->post('emp_idCode');
            $itemnameCode   = $this->input->post('itemnameCode');
            $roomnameCode   = $this->input->post('roomnameCode');
            $blockNameId    = $this->input->post('blockNameId');
        
            if($emp_id):
                $where['fii_empId'] = $emp_id;
            endif;
            if($blockNameId):
                $where['bb_id'] = $blockNameId;
            endif;
            if($itemnameCode):
                $where['fid_itemId'] = $itemnameCode;
            endif;
            if($roomnameCode):
                $where['fid_roomId'] = $roomnameCode;
            endif;
            
            $where['fid_trash'] = 1;
            
            if($this->input->post('search')):
                $this->data['faxItems']         = $this->InventoryModel->get_fix_itemsList($where);
              
            endif;
         
//            if($this->input->post('export')):
//            
//                
//                $this->load->library('excel');
//                $this->excel->setActiveSheetIndex(0);
//                //name the worksheet
//                $this->excel->getActiveSheet()->setTitle('Inventory List');
//                //set cell A1 content with some text
//                $this->excel->getActiveSheet()->setCellValue('A1', 'Employee name');
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
//                
//                $this->excel->getActiveSheet()->setCellValue('B1', 'Code');
//                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
//                
//                $this->excel->getActiveSheet()->setCellValue('C1','Block name');
//                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
//                
//               
//                $this->excel->getActiveSheet()->setCellValue('D1', 'Room');
//                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);
//
//               
//                $this->excel->getActiveSheet()->setCellValue('E1', 'Code');
//                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(12);
//                
//                $this->excel->getActiveSheet()->setCellValue('F1', 'Date');
//                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
//                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(12);
//
//               
//                
//       for($col = ord('A'); $col <= ord('F'); $col++){
//                //set column dimension
//                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
//                 //change the font size
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
//                 
//                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
//        }
//                $result        = $this->InventoryModel->get_fix_itemsListExecl($where);
//                foreach ($result as $row){
//                    $exceldata[] = $row;
//                }
//              $name = 'Inventory List '.date('Y-m-d H:i:s');
//                //Fill data 
//                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
//                  
//                $filename= $name.'.xls'; //save our workbook as this file name
//                header('Content-Type: application/vnd.ms-excel'); //mime type
//                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
//                header('Cache-Control: max-age=0'); //no cache
// 
//                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//                //if you want to save it as .XLSX Excel 2007 format
//                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//                //force user to download the Excel file without writing it to server's HD
//                $objWriter->save('php://output');
//                
//                
//               
//              
//            endif;
         
        endif;
        
        $this->data['page']             = "inventory/fixedItem_report_details";
        $this->data['page_title']       = 'Fix Items Cumulative Report | ECMS';
        $this->data['page_headers']     = 'Fix Items Cumulative Report';
        $this->load->view('common/common',$this->data);
    }
  public function inventory_report_search_details(){
        
            $emp_id         = $this->input->post('emp_idCode');
            $itemnameCode   = $this->input->post('itemnameCode');
            $roomnameCode   = $this->input->post('roomnameCode');
            $blockNameId    = $this->input->post('blockNameId');
        
            $details = '';
            if($emp_id):
                $where['fii_empId'] = $emp_id;
                $where2['fii_empId'] = $emp_id;
                $empName = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
                $details .= '<strong>'.$empName->emp_name.'</strong>/ ';
            endif;
            if($blockNameId):
              
                $where['bb_id'] = $blockNameId;
                $where2['bb_id'] = $blockNameId;
                $bbName = $this->CRUDModel->get_where_row('invt_building_block',array('bb_id'=>$blockNameId));
                $details .= '<strong>'.$bbName->bb_name.'</strong>/ ';
                  
            endif;
             if($itemnameCode):
                $where['fid_itemId'] = $itemnameCode;
                $where2['fid_itemId'] = $itemnameCode;
                $itemnameCode = $this->CRUDModel->get_where_row('invt_items',array('itm_id'=>$itemnameCode));
               
            endif;
    
                $where['fid_trash'] = 1;
                $faxItems        = $this->InventoryModel->get_fix_items_List_detail($where);
                
                
                $sn = '';
                  ?>
                <script language="javascript">
                function printdiv(printpage)
                {
                var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
                var footstr = "</body>";
                var newstr = document.all.item(printpage).innerHTML;
                var oldstr = document.body.innerHTML;
                document.body.innerHTML = headstr+newstr+footstr;
                window.print();
                document.body.innerHTML = oldstr;
                return false;
                }
                </script>   
                    <?php 
                if($faxItems):
                    $itemnameCode  = $this->input->post('itemnameCode');
                    $itemnameCode = $this->CRUDModel->get_where_row('invt_items',array('itm_id'=>$itemnameCode));
                 echo '<div id="div_print">';?>
                   <h3 class="has-divider text-highlight">Inventory Items List 
                         <?php if($itemnameCode): ?>(<?php echo $itemnameCode->itm_name;?>)<?php endif;?></h3>
                       <?php echo '<table class="table table-boxed table-hover">
                                <thead>
                                    <tr>
                                    
                                        <th>#</th>
                                        <th>Room name </th>
                                        <th>Quantity </th>
                                         
                                     </tr>
                                  </thead>
                                  <tbody>';
                                    $gcount = "";
                                   foreach($faxItems as $fiRow):
                                        $where2['fid_roomId'] = $fiRow->rm_id;
                                        $this->db->select('count(itm_name) as totaItems, itm_name');
                                        $this->db->from('invt_fixed_item_details');
                                        $this->db->join('invt_items','invt_items.itm_id=invt_fixed_item_details.fid_itemId');
                                        $this->db->join('invt_fixed_item_issuance','invt_fixed_item_issuance.fii_id=invt_fixed_item_details.fid_fiiId');
                                        $this->db->join('invt_rooms','invt_rooms.rm_id=invt_fixed_item_details.fid_roomId');
                                        $this->db->join('invt_building_block','invt_building_block.bb_id=invt_rooms.rm_bbId');
                                        $this->db->group_by('itm_id');
                                        $this->db->where($where2);
                                        $itemsDetails  =   $this->db->get()->result();
                                      
                                        echo '<tr>
                                            <td></td>  
                                           <td><string style="font-weight: 900;">'.$fiRow->rm_name.'( '.$fiRow->emp_name.')</strong></td>
                                          
                                            <td></td>  
                                            </tr>';
                                          $s_no = '';
                                        foreach($itemsDetails as $itemRow):
                                                            $s_no++;
                                                            echo '<tr>';
                                                            
                                                            echo '<td>'.$s_no.'</td>';
                                                            echo '<td>'.$itemRow->itm_name.'</td>';
                                                            echo '<td>'.$itemRow->totaItems.'</td>';
                                                        $gcount += $itemRow->totaItems;            
                                                            echo '</tr>';
                                                        endforeach;
                                   endforeach;
                                echo '<tr>';                        
                                        echo '<td></td>';
                                        echo '<td></td>';
                                        echo '<td>'.$gcount.'</td>';
                                        echo '</tr>';          
                                 echo '</tbody></table>
                        '.$this->data['print_log'].'</div>
                        </div>
                        ';
                
                  endif;
    }
    
    public function auto_issued_to()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('invt_supplier');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->sp_name,
                    'label'=>$row_set->sp_name,
                    'id'=>$row_set->sp_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('sp_name'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('invt_supplier',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->sp_name,
                    'label'=>$row_set->sp_name,
                    'id'=>$row_set->sp_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function auto_items()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('invt_items');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->itm_name,
                    'label'=>$row_set->itm_name,
                    'id'=>$row_set->itm_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('itm_name'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('invt_items',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->itm_name,
                  'label'=>$row_set->itm_name,
                  'id'=>$row_set->itm_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function auto_items_category()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('invt_items');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->itm_name.'(Qty = '.$row_set->item_quantity.')',
                    'label'=>$row_set->itm_name.'(Qty = '.$row_set->item_quantity.')',
                    'id'=>$row_set->itm_id,
                    'item_quantity'=>$row_set->item_quantity
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('itm_name'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('invt_items',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->itm_name.'(Qty = '.$row_set->item_quantity.')',
                  'label'=>$row_set->itm_name.'(Qty = '.$row_set->item_quantity.')',
                  'id'=>$row_set->itm_id,
                'item_quantity'=>$row_set->item_quantity
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function auto_brand()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('invt_brand');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->brand_name,
                    'label'=>$row_set->brand_name,
                    'id'=>$row_set->brand_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('brand_name'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('invt_brand',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->brand_name,
                  'label'=>$row_set->brand_name,
                  'id'=>$row_set->brand_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function auto_emp_names()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){   
            $result_set             = $this->InventoryModel->getemp_names('hr_emp_record');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->emp_name.'('.$row_set->designation.')',
                    'label'=>$row_set->emp_name.'('.$row_set->designation.')',
                    'id'=>$row_set->emp_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['prepared_by']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('emp_name'=>$term);
            
            $result_set             = $this->InventoryModel->getemp_names('hr_emp_record',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->emp_name.'('.$row_set->designation.')',
                    'label'=>$row_set->emp_name.'('.$row_set->designation.')',
                    'id'=>$row_set->emp_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['prepared_by']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
       public function inventory_total_report(){
        
       
        if($this->input->post()):
           
            $emp_id         = $this->input->post('emp_idCode');
            $itemnameCode   = $this->input->post('itemnameCode');
            $roomnameCode   = $this->input->post('roomnameCode');
            $blockNameId    = $this->input->post('blockNameId');
        
            if($emp_id):
                $where['fii_empId'] = $emp_id;
            endif;
            if($blockNameId):
                $where['bb_id'] = $blockNameId;
            endif;
            if($itemnameCode):
                $where['fid_itemId'] = $itemnameCode;
            endif;
            if($roomnameCode):
                $where['fid_roomId'] = $roomnameCode;
            endif;
            
            $where['fid_trash'] = 1;
            
            if($this->input->post('search')):
                $this->data['faxItems']         = $this->InventoryModel->get_fix_itemsList($where);
              
            endif;
          
        endif;
        
        $this->data['page']             = "inventory/fixedItem_total_report";
        $this->data['page_title']       = 'Items Base Cumulative Report  | ECMS';
        $this->data['page_header']       = 'Items Base Cumulative Report ';
        $this->load->view('common/common',$this->data);
    }
    
    public function inventory_report_search_all(){
        
            $emp_id         = $this->input->post('emp_idCode');
            $itemnameCode   = $this->input->post('itemnameCode');
            $roomnameCode   = $this->input->post('roomnameCode');
            $blockNameId    = $this->input->post('blockNameId');
            $where = '';
            if($emp_id):
                $where['fii_empId'] = $emp_id;
            endif;
            if($blockNameId):
                $where['bb_id']     = $blockNameId;
            endif;
            if($itemnameCode):
                $where['invt_items.itm_id'] = $itemnameCode;
            endif;
            if($roomnameCode):
                $where['fid_roomId'] = $roomnameCode;
            endif;
            
//             $where['invt_items.fid_trash'] = 1;
            
      
           
            
                
                
                $faxItems        = $this->InventoryModel->get_fix_itemsList_all($where);
     
              
                
                echo '
               <div id="div_print">
              
            <h3 class="has-divider text-highlight">All Inventory Report:  </h3>
            <div class="table-responsive">
                   <table class="table table-hover" id="table">
              <thead>
                <tr>
                    
                    <th>#</th>
                    <th>Item</th>
                    <th>Working</th>
                    <th>Damage</th>
                    <th>Total</th>
                    
                </tr>
              </thead>
              <tbody>';
              $sn= '';
                 if($faxItems):
                     
                     foreach($faxItems as $fiRow):
                     $sn++;
                     $working = $this->CRUDModel->get_where_result('invt_fixed_item_details',array('fid_itemId'=>$fiRow->itm_id,'fid_isId'=>1));
                     $damage = $this->CRUDModel->get_where_result('invt_fixed_item_details',array('fid_itemId'=>$fiRow->itm_id,'fid_isId'=>2));
                     echo '<tr">
                           <th>'.$sn.'</th>
                            <th>'.$fiRow->itm_name.' ('.$fiRow->itm_shortname.')</th>
                            <th>'.count($working).'</th>
                            <th>'.count($damage).'</th>
                            <th>'.$fiRow->total.'</th>';
                      
         echo  '</tr>';
         
                     endforeach;
                 endif;
              
                                                      
              echo '</tbody>
            </table>'.$this->data['print_log'].'
            </div>
             </div>
         
            ';
              ?>
                    <script>
 function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
               </script>          
        <?php
    }
    
    public function bb_shortname(){  
       $bb_shortname      = $this->input->post('bb_shortname');
       $where = array('bb_shortname'=>$bb_shortname);
       $query = $this->CRUDModel->get_where_row('invt_building_block',$where);
       if($query):
           echo TRUE;
           else:
           echo FALSE;
       endif; 
    }
    
    public function rm_shortname(){   
       $rm_shortname = $this->input->post('rm_shortname');
       $where = array('rm_shortname'=>$rm_shortname);
       $query = $this->CRUDModel->get_where_row('invt_rooms',$where);
       if($query):
           echo TRUE;
           else:
           echo FALSE;
       endif; 
    }
    
    public function auto_rooms()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('invt_rooms');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->rm_name,
                    'label'=>$row_set->rm_name,
                    'id'=>$row_set->rm_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('rm_name'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('invt_rooms',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->rm_name,
                    'label'=>$row_set->rm_name,
                    'id'=>$row_set->rm_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function auto_blocks()
     { 
        $term = trim(strip_tags($_GET['term']));
        
            if( $term == ''){
                
            $result_set             = $this->CRUDModel->getResults('invt_building_block');
            $makkah_hotels          = array();
            foreach ($result_set as $row_set) {
                $makkah_hotels[]   = array( 
                    'value'=>$row_set->bb_name,
                    'label'=>$row_set->bb_name,
                    'id'=>$row_set->bb_id
                );  
                
            }
            $matches = array();
            foreach($makkah_hotels as $makkah_hotel) { 
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel; }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }else if($term != ''){
            $like   = array('bb_name'=>$term);
            
            $result_set             = $this->CRUDModel->get_where_result_like('invt_building_block',$like);
            $labels          = array();
            foreach ($result_set as $row_set) {
            $labels[]        = array( 
                  'value'=>$row_set->bb_name,
                    'label'=>$row_set->bb_name,
                    'id'=>$row_set->bb_id
                    );
            }
            $matches                = array();
            foreach($labels as $makkah_hotel){
            $makkah_hotel['value']  = $makkah_hotel['value'];
            $makkah_hotel['id']  = $makkah_hotel['id'];
            $makkah_hotel['label']  = "{$makkah_hotel['label']}"; 
            $matches[]              = $makkah_hotel;
            }
            $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
    }
    
    public function issued_items_change_status()
    {
        $where = "";
        $this->data['emp_idCode'] = "";
        $this->data['blockNameId'] = "";
        $this->data['itemnameCode'] = "";
        $this->data['roomnameCode'] = "";
        if($this->input->post('search')):
            $emp_id         = $this->input->post('emp_idCode');
            $itemnameCode   = $this->input->post('itemnameCode');
            $roomnameCode   = $this->input->post('roomnameCode');
            $blockNameId    = $this->input->post('blockNameId');
            
            if($emp_id):
                $where['fii_empId'] = $emp_id;
                $this->date['emp_idCode'] = $emp_id;
            endif;
            if($blockNameId):
                $where['bb_id'] = $blockNameId;
                $this->data['blockNameId'] = $blockNameId;
            endif;
            if($itemnameCode):
                $where['fid_itemId'] = $itemnameCode;
                $this->data['itemnameCode'] = $itemnameCode;
            endif;
            if($roomnameCode):
                $where['fid_roomId'] = $roomnameCode;
                $this->data['roomnameCode'] = $roomnameCode;
            endif;
        $this->data['result'] = $this->InventoryModel->search_fixed_issuance_items($where);
        endif;
        $this->data['page_title']   = 'Issued Items Change Status | ECMS';
        $this->data['page']         = 'inventory/issued_items_change_status';
        $this->load->view('common/common',$this->data); 
    }
    
    public function change_status_issuance_item()
    {
        $fid_id  = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        if($this->input->post('update')):
            
            $fid_id = $this->input->post('fid_id');
            $itm_id = $this->input->post('itm_id');
            $receiving_date     = $this->input->post('receiving_date');
            $is_id     = $this->input->post('is_id');
            $iis_id     = $this->input->post('iis_id');
            $comments     = $this->input->post('comments');
            $date1 = date('Y-m-d', strtotime($receiving_date));
            $test_data = array
            (
                'fid_id'=>$fid_id,
                'item_id'=>$itm_id,
                'is_id'=>$is_id,
                'iis_id'=>$iis_id,
                'receiving_date'=>$date1,
                'comments'=>$comments,
                'user_id'=>$user_id
            );           
            $this->CRUDModel->insert('invt_issued_item_change_status',$test_data);
        $where = array('invt_fixed_item_details.fid_id'=>$fid_id);
            $data = array
                (
                    'fid_isId'=>$is_id,
                    'iis_id'=>$iis_id
                );
            $this->CRUDModel->update('invt_fixed_item_details',$data,$where);
        $this->session->set_flashdata('msg', 'Item Status Changed Successfully.');
        redirect('InventoryController/issued_items_change_status');    
        endif;
        if($fid_id):
        $where = array('invt_fixed_item_details.fid_id'=>$fid_id);
        $this->data['result'] = $this->InventoryModel->status_change_issued_item($where);
        endif;
        $this->data['page_title']   = 'Change Status Issued Items | ECMS';
        $this->data['page']         = 'inventory/change_status_issuance_item';
        $this->load->view('common/common',$this->data);
    }
    
     public function search_register_cumulative_admin()
    {
       $this->data['result'] = $this->CRUDModel->getresults('invt_college_area');
        $this->data['page_title']   = 'Edwardes College Fixed Assets Register Admin  | ECMS';
        $this->data['page']         = 'inventory/search_register_cumulative_admin';
        $this->load->view('common/common',$this->data); 
    }
     public function delte_inventory_items(){
        $fid_id = $this->uri->segment(3);
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
      
        $data   = array('itm_status' => 0, 'deleted_by' => $user_id);
        $where  = array('fid_id' => $fid_id);
        $this->CRUDModel->update('invt_fixed_item_details', $data, $where);
        redirect('InventoryController/search_register_cumulative_admin');
//    $this->CRUDModel->deleteid('invt_fixed_item_details',array('fid_id'=>$this->uri->segment(3)));
//    redirect('InventoryController/college_cumulative_area');
    }    
    public function fixed_item_edit(){
        
       
        if($this->input->post()):
           
            $emp_id         = $this->input->post('emp_idCode');
            $itemnameCode   = $this->input->post('itemnameCode');
            $roomnameCode   = $this->input->post('roomnameCode');
            $blockNameId    = $this->input->post('blockNameId');
        
            if($emp_id):
                $where['fii_empId'] = $emp_id;
            endif;
            if($blockNameId):
                $where['bb_id'] = $blockNameId;
            endif;
            if($itemnameCode):
                $where['fid_itemId'] = $itemnameCode;
            endif;
            if($roomnameCode):
                $where['fid_roomId'] = $roomnameCode;
            endif;
            
            $where['fid_trash'] = 1;
            
            if($this->input->post('search')):
                $this->data['faxItems']         = $this->InventoryModel->get_fix_itemsList($where);
              
            endif;
         
            if($this->input->post('export')):
            
                 echo '<pre>';print_r($this->input->post());die;
                 $emp_id         = $this->input->post('emp_idCode');
            $itemnameCode   = $this->input->post('itemnameCode');
            $roomnameCode   = $this->input->post('roomnameCode');
            $blockNameId    = $this->input->post('blockNameId');
        
            if($emp_id):
                $where['fii_empId'] = $emp_id;
            endif;
            if($blockNameId):
                $where['bb_id'] = $blockNameId;
            endif;
            if($itemnameCode):
                $where['fid_itemId'] = $itemnameCode;
            endif;
            if($roomnameCode):
                $where['fid_roomId'] = $roomnameCode;
            endif;
            $where['fid_trash'] = 1;
            
            
                
                
                
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Inventory List');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Employee name');
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('B1', 'Code');
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('C1','Block name');
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
                
               
                $this->excel->getActiveSheet()->setCellValue('D1', 'Room');
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);

               
                $this->excel->getActiveSheet()->setCellValue('E1', 'Code');
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(12);
                
                $this->excel->getActiveSheet()->setCellValue('F1', 'Date');
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(12);

               
                
       for($col = ord('A'); $col <= ord('F'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
                $result        = $this->InventoryModel->get_fix_itemsListExecl($where);
                foreach ($result as $row){
                    $exceldata[] = $row;
                }
              $name = 'Inventory List '.date('Y-m-d H:i:s');
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A2');
                  
                $filename= $name.'.xls'; //save our workbook as this file name
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
        
        $this->data['page']             = "inventory/fixeditem_edit";
        $this->data['page_title']       = 'Fix Items Edit Search| ECMS';
        $this->data['page_headers']     = 'Fix Items Edit Search';
        $this->load->view('common/common',$this->data);
    }
    
    
      public function fixed_item_edit_search_result(){
        
            $emp_id         = $this->input->post('emp_idCode');
            $itemnameCode   = $this->input->post('itemnameCode');
            $roomnameCode   = $this->input->post('roomnameCode');
            $blockNameId    = $this->input->post('blockNameId');
        
            $details = '';
            if($emp_id):
                $where['fii_empId'] = $emp_id;
                $where2['fii_empId'] = $emp_id;
                $empName = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$emp_id));
                $details .= '<strong>'.$empName->emp_name.'</strong>/ ';
            endif;
            if($blockNameId):
              
                $where['bb_id'] = $blockNameId;
                $where2['bb_id'] = $blockNameId;
                $bbName = $this->CRUDModel->get_where_row('invt_building_block',array('bb_id'=>$blockNameId));
                $details .= '<strong>'.$bbName->bb_name.'</strong>/ ';
                  
            endif;
            if($roomnameCode):
              
                $where['rm_id'] = $roomnameCode;
                $where2['rm_id'] = $roomnameCode;
                $invt_rooms = $this->CRUDModel->get_where_row('invt_rooms',array('rm_id'=>$roomnameCode));
                $details .= '<strong>'.$invt_rooms->rm_name.'</strong>/ ';
                  
            endif;
             if($itemnameCode):
                $where['fid_itemId'] = $itemnameCode;
                $where2['fid_itemId'] = $itemnameCode;
                $itemnameCode = $this->CRUDModel->get_where_row('invt_items',array('itm_id'=>$itemnameCode));
               
            endif;
    
                $where['fid_trash'] = 1;
                $faxItems        = $this->InventoryModel->get_fix_items_List_detail_edit($where);
                
                
                $sn = '';
               
                if($faxItems): 
                echo '<div id="div_print">
                   <h3 class="has-divider text-highlight">  Inventory Items List</h3>
                        <table class="table table-boxed table-hover">
                                <thead>
                                    <tr>
                                    
                                        <th>#</th>
                                        <th>Employee Name</th>
                                        <th>Room name </th>
                                        <th>Item Name (Item Code)</th>
                                        <th>Price</th>
                                        <th>Purchase Date</th>
                                        <th>Edit</th>
                                         
                                     </tr>
                                  </thead>
                                  <tbody>';
                                
                                   foreach($faxItems as $fiRow):
                                
                                      $purchase_date = '';
                                   
                                      if($fiRow->fid_pur_date == '0000-00-00'):
                                          $purchase_date = '';
                                          else:
                                          $purchase_date =date('d-m-Y',strtotime($fiRow->fid_pur_date));
                                      endif;
                                        echo '<tr>
                                            <td></td>  
                                           <td>'.$fiRow->emp_name.'</td>
                                           <td>'.$fiRow->rm_name.'('.$fiRow->rm_shortname.')</td>
                                           <td>'.$fiRow->itm_name.'('.$fiRow->fid_barCode.')</td>
                                           <td>'.$fiRow->fid_pur_price.'</td>
                                           <td>'.$purchase_date.'</td>
                                          
                                            <td><a href="fixedItemEditPage/'.$fiRow->fid_id.'" targt="_new"><button class="btn btn-success btn-sm">Edit</button></a></td>  
                                            </tr>';
                                      
                                   endforeach;
   
                              echo '</tbody>
                        </div>
                        </div>
                        ';
                 
                  endif;
    }
  public function fixed_item_edit_page(){
        
        $session = $this->session->all_userdata();
        $user_id =$session['userData']['user_id'];
        $item_id = $this->uri->segment(2);
                                $this->db->join('invt_items','invt_items.itm_id=invt_fixed_item_details.Fid_itemId','left outer');
        $this->data['result'] = $this->db->get_where('invt_fixed_item_details',array('fid_id'=>$item_id))->row();
        
        if($this->input->post('submit')):
            $fid_id     = $this->input->post('fid_id');
            $price      = $this->input->post('item_purchase_price');
            $date       = $this->input->post('item_purchase_date');
            
            $log_price      = $this->input->post('log_price');
            $log_date       = $this->input->post('log_date');
            
            if($price != $log_price): $old_price = $log_price; else: $old_price = $price; endif;
            if($date != $log_date): $old_date = $log_date; else: $old_date = $date; endif;
            
            if($price != $old_price || $date != $old_date):
                $logData = array(
                    'fid_id'            => $fid_id,
                    'fid_pur_price'     => $old_price,
                    'fid_pur_date'      => $old_date,
                    'fid_up_timestamp'  => date('Y-m-d H:i:s'),
                    'fid_up_userId'     => $user_id,
                );
                $this->CRUDModel->insert('invt_fixed_item_details_log', $logData);
            endif;
            
            $SET = array(
              'fid_pur_price'   =>$price,
              'fid_pur_date'    =>date('Y-m-d',strtotime($date)),
            );
            $DATA = array(
              'fid_id'  =>$fid_id
            );
            $this->CRUDModel->update('invt_fixed_item_details',$SET,$DATA);
            redirect('fixedItemEdit','referesh');
        endif;
        
        
        $this->data['page']             = "inventory/fixeditem_edit_page";
        $this->data['page_title']       = $this->data['result']->fid_barCode.'| ECMS';
        $this->data['page_headers']     = $this->data['result']->itm_name.'('.$this->data['result']->fid_barCode.')';
        $this->load->view('common/common',$this->data);    
    }
    
     public function fixed_assets_item_wise(){
        
        $this->data['page']             = "inventory/fixed_assets_item_wise";
        $this->data['page_title']       =  'Fixed Assets Register Details (Audit) | ECMS ';
        $this->data['page_headers']     = 'Fixed Assets Register Details (Audit)';
        $this->load->view('common/common',$this->data);  
    }
    
        public function item_grn_date(){
        $item_list = $this->input->post('item_list');
        
                    $this->db->join('invt_grn_details','invt_grn_details.grn_id=invt_grn.grn_id');
                    $this->db->order_by('invt_grn.grn_id','desc');
                    $this->db->group_by('invt_grn.grn_id');
                    
        $grn_op =   $this->db->get_where('invt_grn',array('invt_grn_details.item_id'=>$item_list))->result();
//         echo '<pre>';print_r($grn_op);die;
         
         if(!empty($grn_op)>0):
              echo '<option value="" >Select GRN</option>';
             foreach($grn_op as $secRow):
               echo '<option value="'.$secRow->grn_id.'">GRN N0:'.$secRow->grn_id.'</option>';
            endforeach;
                
             else:
             echo '<option value="0">GRN NULL</option>';
         endif;
        
        
        
    }
    public function item_grn_info(){
        $grn_id         = $this->input->post('grn_id');
        $itemnameCode   = $this->input->post('itemnameCode');
        $where = array(
          'invt_grn.grn_id'  => $grn_id, 
          'item_id' => $itemnameCode, 
        );
                    $this->db->join('invt_grn_details','invt_grn_details.grn_id=invt_grn.grn_id');
//                    $this->db->order_by('invt_grn.grn_id','desc');
                    
        $grn_op =   $this->db->get_where('invt_grn',$where)->row();
        if($grn_op):
        $return['purchase_price'] = $grn_op->price;
        $return['purchase_date'] = date('d-m-Y',strtotime($grn_op->grn_date));
         else:
             $return['purchase_price'] = '0';
             $return['purchase_date'] = '0';
        endif;
        
        
         echo json_encode($return);
        
    }
    
}   
