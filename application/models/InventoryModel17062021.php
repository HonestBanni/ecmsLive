<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class InventoryModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
    }
    
     public function get_by_id($table,$id){
        $query = $this->db->select('*')
            ->from($table)
        ->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer')
            ->where($id)
            ->get();
      return $query->result();
    }
    
    public function get_by_ids($table,$id){
        $query = $this->db->select('*')
            ->from($table)
            ->where($id)
            ->get();
      return $query->result();
    }
    
    public function getPlots()
    {
        $this->db->select('*'); 
        $this->db->FROM('invt_plot_area');
        $this->db->join('invt_college_area','invt_college_area.col_id=invt_plot_area.col_id','left outer');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getPlots_row($table,$where)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('invt_college_area','invt_college_area.col_id=invt_plot_area.col_id','left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function getBuildingBlock_row($table,$where){    
        $this->db->select('*'); 
        $this->db->FROM($table);
      $this->db->join('invt_plot_area','invt_plot_area.plot_id=invt_building_block.plot_id','left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function get_BuildingBlocks($table,$where){    
        
        
      $this->db->join('invt_plot_area','invt_plot_area.plot_id=invt_building_block.plot_id','left outer');
        if($where):
        $this->db->where($where);
        endif;
        $query =  $this->db->get($table);
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_Searchrooms($table,$where){
        
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->JOIN('invt_building_block','invt_building_block.bb_id=invt_rooms.rm_bbId');
        if($where):
        $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_room_rows($table,$where){
        
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->JOIN('invt_building_block','invt_building_block.bb_id=invt_rooms.rm_bbId','left outer');
        $this->db->join('invt_plot_area','invt_plot_area.plot_id=invt_building_block.plot_id','left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    public function get_room_row($table,$where){
        
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->JOIN('invt_building_block','invt_building_block.bb_id=invt_rooms.rm_bbId');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
    
    public function getBuildingBlocks(){    
    return $this->db->FROM('invt_building_block')
      ->JOIN('invt_plot_area','invt_plot_area.plot_id=invt_building_block.plot_id','left outer')
      ->ORDER_BY('bb_id','desc')->GET()->RESULT();
    }
    
    public function get_by_idcollege($table,$id)
    {
        $query = $this->db->select('*')
            ->from($table)
            ->where($id)
            ->get();
      return $query->result();
    }
    
    public function deleteissuance_id($table,$where1)
    {
        $this->db->where($where1);
        $this->db->delete($table);
    }
    
    public function get_wo_list($table,$where=NULL)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=invt_work_order.prepared_by','left outer');
        $this->db->join('financial_year','financial_year.id=invt_work_order.year','left outer');
    $this->db->join('invt_work_order_grn','invt_work_order_grn.work_id=invt_work_order.work_id','left outer');
        $this->db->join('invt_ship_to','invt_ship_to.ship_id=invt_work_order.ship_to','left outer');
        $this->db->join('invt_issued_by','invt_issued_by.id=invt_work_order.issued_by','left outer');
        $this->db->join('invt_supplier','invt_supplier.sp_id=invt_work_order.issued_to','left outer');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_wo_lists($table)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=invt_work_order.prepared_by');
        $this->db->join('financial_year','financial_year.id=invt_work_order.year');
        $this->db->join('invt_ship_to','invt_ship_to.ship_id=invt_work_order.ship_to');
        $this->db->join('invt_issued_by','invt_issued_by.id=invt_work_order.issued_by');
        $this->db->join('invt_supplier','invt_supplier.sp_id=invt_work_order.issued_to');
        $this->db->where('invt_work_order.dlt_status', 1);
        $this->db->order_by('order_date','desc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_work_orderdata($table,$wheredata)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=invt_work_order.prepared_by','left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer');
        $this->db->join('financial_year','financial_year.id=invt_work_order.year','left outer');
        $this->db->join('invt_ship_to','invt_ship_to.ship_id=invt_work_order.ship_to','left outer');
        $this->db->join('invt_issued_by','invt_issued_by.id=invt_work_order.issued_by','left outer');
        $this->db->join('invt_supplier','invt_supplier.sp_id=invt_work_order.issued_to','left outer');
        $this->db->where($wheredata);
        
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_work_order_grn($table,$wheredata)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=invt_work_order_grn.goods_rec_del_by','left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer');
        $this->db->join('invt_delivery_status','invt_delivery_status.id=invt_work_order_grn.delivery_status','left outer');
        $this->db->join('invt_work_order','invt_work_order.work_id=invt_work_order_grn.work_id','left outer');
        $this->db->join('invt_issued_by','invt_issued_by.id=invt_work_order.issued_by','left outer');
        $this->db->join('financial_year','financial_year.id=invt_work_order.year','left outer');
        $this->db->join('invt_supplier','invt_supplier.sp_id=invt_work_order_grn.sp_id','left outer');
        $this->db->where($wheredata);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
     
    public function get_rooms(){
        
        return $this->db->SELECT()
                          ->FROM('invt_rooms')
                          ->JOIN('invt_building_block','invt_building_block.bb_id=invt_rooms.rm_bbId')
                          ->ORDER_BY('rm_id','desc')->GET()->RESULT();
    }
    
     public function getpurchase_order()
    {
        $this->db->select('*'); 
        $this->db->FROM('invt_purchase_order_details_demo');
    $this->db->join('invt_items','invt_items.itm_id=invt_purchase_order_details_demo.item_id','left outer');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_storeitems(){
    return $this->db->SELECT('*')
      ->FROM('invt_items')
      ->JOIN('invt_category','invt_category.cat_id=invt_items.itm_catId')
      ->JOIN('invt_assets_type','invt_assets_type.at_id=invt_items.itm_asstId')
      ->ORDER_BY('item_quantity','desc')
    ->GET()->RESULT();
    }
    
    public function store_items($table,$where=NULL)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('invt_category','invt_category.cat_id=invt_items.itm_catId','left outer');
        $this->db->join('invt_assets_type','invt_assets_type.at_id=invt_items.itm_asstId','left outer');
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_issuance_items()
    {
        $this->db->select('
        invt_items_assuance.*,
        hr_emp_record.*,
        invt_item_issuance_department.*,
        department.title as department,
        hr_emp_designation.title as desg
        '); 
        $this->db->FROM('invt_items_assuance');
        $this->db->join('invt_item_issuance_department','invt_item_issuance_department.iss_dept_id=invt_items_assuance.dept_id','left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=invt_items_assuance.emp_id','left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id','left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer');
         $this->db->order_by('issuance_date','desc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_stock_balance()
    {
        $this->db->select('
        invt_items_assuance_details.*,
        invt_items_assuance.*,
        invt_main_category.*,
        invt_items.*,
        hr_emp_record.*,
        invt_item_issuance_department.*,
        department.title as department,
        hr_emp_designation.title as desg
        '); 
        $this->db->FROM('invt_items_assuance_details');
        $this->db->join('invt_items','invt_items.itm_id=invt_items_assuance_details.item_id','left outer');
        $this->db->join('invt_main_category','invt_main_category.catm_id=invt_items.catm_id','left outer');
        $this->db->join('invt_items_assuance','invt_items_assuance.ass_id=invt_items_assuance_details.ass_id','left outer');
        $this->db->join('invt_item_issuance_department','invt_item_issuance_department.iss_dept_id=invt_items_assuance.dept_id','left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=invt_items_assuance.emp_id','left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id','left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer');
       //  $this->db->order_by('issuance_date','desc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_stocks_balance($where=NULL,$date=NULL){
        
        
        $this->db->select('
        invt_items_assuance_details.*,
        invt_items_assuance.*,
        invt_items.*,
        invt_main_category.*,
        hr_emp_record.*,
        invt_item_issuance_department.*,
        department.title as department,
        hr_emp_designation.title as desg
        '); 
        $this->db->FROM('invt_items_assuance_details');
        $this->db->join('invt_items','invt_items.itm_id=invt_items_assuance_details.item_id','left outer');
        $this->db->join('invt_main_category','invt_main_category.catm_id=invt_items.catm_id','left outer');
        $this->db->join('invt_items_assuance','invt_items_assuance.ass_id=invt_items_assuance_details.ass_id','left outer');
        $this->db->join('invt_item_issuance_department','invt_item_issuance_department.iss_dept_id=invt_items_assuance.dept_id','left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=invt_items_assuance.emp_id','left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id','left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer');
          if($date['issuance_from'] == ''):
                   $this->db->where('issuance_date <=',date('Y-m-d', strtotime($date['issuance_to'])));
                    else:
                     $this->db->where('issuance_date BETWEEN "'.date('Y-m-d', strtotime($date['issuance_from'])).'" AND "'.date('Y-m-d', strtotime($date['issuance_to'])).'"');   
                endif;
        if($where):
            $this->db->where($where);
        endif;
        $query['issue'] =  $this->db->get()->result();
        
                if($date['issuance_from'] == ''):
                    $this->db->where('grn_date <=',date('Y-m-d', strtotime($date['issuance_to'])));
                else:
                     $this->db->where('grn_date BETWEEN "'.date('Y-m-d', strtotime($date['issuance_from'])).'" AND "'.date('Y-m-d', strtotime($date['issuance_to'])).'"');   
                endif;
                $this->db->join('invt_grn_details','invt_grn_details.grn_id=invt_grn.grn_id');
                $this->db->join('invt_items','invt_items.itm_id=invt_grn_details.item_id','left outer');
    $query['purchase'] = $this->db->get_where('invt_grn',array('item_id' =>$this->input->post('item_id')))->result();
        
        
       return $query; 
        
        
        
        
        $return_array = array();
        if($return_array):
             
            foreach($query as $row):
              $return_array[] = array(
                  'issuance_date'       => $row->issuance_date,
                  'ass_id'              => $row->ass_id,
                  'itm_id'              => $row->itm_id,
                  'itm_name'            => $row->itm_name,
                  'quantity'            => $row->quantity,
                  'remaining_quantity'  => $row->remaining_quantity,
                  'emp_name'            => $row->emp_name,
                  'desg'                => $row->desg,
                  'dept_name'           => $row->dept_name,
                  'Type'                => 'Issue',
              );
        
            endforeach;
            
          
              if($PurchaseOrder):
            foreach($PurchaseOrder as $PoRow):
               
//               $this->db->join('invt_grn_details','invt_grn_details.grn_id=invt_grn.grn_id');
//            $PurchaseOrder  = $this->db->get_where('invt_grn',array('item_id' =>$row->itm_id,,'grn_date'=> date("Y-m-d", strtotime($row->issuance_date))))->row();
               
              
                   $return_array[] = array(
                  'issuance_date'       => $PoRow->grn_date,
                  'ass_id'              => '',
                  'itm_id'              => '',
                  'itm_name'            => $PoRow->itm_name,
                  'quantity'            => $PoRow->quantity,
                  'remaining_quantity'  => '',
                  'emp_name'            => '',
                  'desg'                => '',
                  'dept_name'                => '',
                  'Type'                => 'Purchase',
              );
            
              
        
            endforeach;
              endif;
//              if(!empty($return_array)):
//                       $keys   = array_column($return_array, 'issuance_date');
//                array_multisort($keys, SORT_ASC, $return_array);
//             return      json_decode(json_encode($return_array), FALSE);
//             endif;
            
                 return     json_decode(json_encode($return_array), FALSE);
        endif;
    }
    
    public function get_stocks_balance_excel($where=NULL,$date=NULL)
    {
        $this->db->select('
        invt_items.itm_name,
        invt_items_assuance_details.quantity,
        invt_items_assuance_details.remaining_quantity,
        invt_items_assuance.issuance_date,
        hr_emp_record.emp_name,
        hr_emp_designation.title,
        department.title as department,
        invt_item_issuance_department.dept_name
        '); 
        $this->db->join('invt_items','invt_items.itm_id=invt_items_assuance_details.item_id','left outer');
        $this->db->join('invt_main_category','invt_main_category.catm_id=invt_items.catm_id','left outer');
        $this->db->join('invt_items_assuance','invt_items_assuance.ass_id=invt_items_assuance_details.ass_id','left outer');
        $this->db->join('invt_item_issuance_department','invt_item_issuance_department.iss_dept_id=invt_items_assuance.dept_id','left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=invt_items_assuance.emp_id','left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id','left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer');
        if($date['issuance_from'] == ''):
            $this->db->where('issuance_date <=',date('Y-m-d', strtotime($date['issuance_to'])));
             else:
              $this->db->where('issuance_date BETWEEN "'.date('Y-m-d', strtotime($date['issuance_from'])).'" AND "'.date('Y-m-d', strtotime($date['issuance_to'])).'"');   
         endif;
        if($where):
            $this->db->where($where);
        endif;
        $query =  $this->db->get('invt_items_assuance_details');
        return $query->result_array();
    }
    
    public function search_issuance_items($table,$where=NULL)
    {
        $this->db->select('
        invt_items_assuance.*,
        hr_emp_record.*,
        invt_item_issuance_department.*,
        department.title as department,
        hr_emp_designation.title as desg,
        '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=invt_items_assuance.emp_id','left outer');
        $this->db->join('invt_item_issuance_department','invt_item_issuance_department.iss_dept_id=invt_items_assuance.dept_id','left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id','left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer');
      if($where):
          $this->db->where($where);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getitems_issuance()
    {
        $this->db->select('*'); 
        $this->db->FROM('invt_items_assuance_details_demo');
        $this->db->join('invt_items','invt_items.itm_id=invt_items_assuance_details_demo.item_id','left outer');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_itemsissuance($table,$wheredata)
    {
        $this->db->select('
        invt_items_assuance.*,
        hr_emp_record.*,
        invt_item_issuance_department.*,
        department.title as department,
        hr_emp_designation.title as design
        '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=invt_items_assuance.emp_id','left outer');
        $this->db->join('invt_item_issuance_department','invt_item_issuance_department.iss_dept_id=invt_items_assuance.dept_id','left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id','left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer');
        $this->db->where($wheredata);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function issuance_items_details($table,$where)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
    $this->db->join('invt_items','invt_items.itm_id=invt_items_assuance_details.item_id','left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_po_items($table,$where)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
    $this->db->join('invt_items','invt_items.itm_id=invt_purchase_order_details.item_id','left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_grndata($table,$wheredata)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=invt_grn.goods_rec_del_by','left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer');
        $this->db->join('invt_delivery_status','invt_delivery_status.id=invt_grn.delivery_status','left outer');
        $this->db->join('invt_purchase_order','invt_purchase_order.po_id=invt_grn.po_id','left outer');
        $this->db->join('invt_issued_by','invt_issued_by.id=invt_purchase_order.issued_by','left outer');
        $this->db->join('financial_year','financial_year.id=invt_purchase_order.year','left outer');
        $this->db->join('invt_supplier','invt_supplier.sp_id=invt_grn.sp_id','left outer');
        $this->db->where($wheredata);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_podata($table,$wheredata)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=invt_purchase_order.prepared_by','left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer');
        $this->db->join('financial_year','financial_year.id=invt_purchase_order.year','left outer');
        $this->db->join('invt_ship_to','invt_ship_to.ship_id=invt_purchase_order.ship_to','left outer');
        $this->db->join('invt_issued_by','invt_issued_by.id=invt_purchase_order.issued_by','left outer');
        $this->db->join('invt_supplier','invt_supplier.sp_id=invt_purchase_order.issued_to','left outer');
        $this->db->where($wheredata);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_po_lists($table)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=invt_purchase_order.prepared_by');
        $this->db->join('financial_year','financial_year.id=invt_purchase_order.year');
        $this->db->join('invt_ship_to','invt_ship_to.ship_id=invt_purchase_order.ship_to');
        $this->db->join('invt_issued_by','invt_issued_by.id=invt_purchase_order.issued_by');
        $this->db->join('invt_supplier','invt_supplier.sp_id=invt_purchase_order.issued_to');
        $this->db->order_by('invt_purchase_order.order_date','desc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_po_list($table,$where=NULL)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=invt_purchase_order.prepared_by');
        $this->db->join('financial_year','financial_year.id=invt_purchase_order.year');
        $this->db->join('invt_ship_to','invt_ship_to.ship_id=invt_purchase_order.ship_to');
        $this->db->join('invt_issued_by','invt_issued_by.id=invt_purchase_order.issued_by');
        $this->db->join('invt_supplier','invt_supplier.sp_id=invt_purchase_order.issued_to');
        if($where):
            $this->db->where($where);
        endif;
        $this->db->order_by('invt_purchase_order.po_id','desc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function getitem_byid($table,$where)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('invt_category','invt_category.cat_id=invt_items.itm_catId','left outer');
        $this->db->join('invt_assets_type','invt_assets_type.at_id=invt_items.itm_asstId','left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function search_items($table,$where=NULL,$like=NULL)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('invt_category','invt_category.cat_id=invt_items.itm_catId','left outer');
        $this->db->join('invt_assets_type','invt_assets_type.at_id=invt_items.itm_asstId','left outer');
        if($where):
            $this->db->where($where);
        endif;
        if($like):
            $this->db->like($like);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function search_Stocksitems($table,$like=NULL)
    {
        $this->db->select('*'); 
        $this->db->FROM($table);
        $this->db->join('invt_category','invt_category.cat_id=invt_items.itm_catId','left outer');
        $this->db->join('invt_assets_type','invt_assets_type.at_id=invt_items.itm_asstId','left outer');
        if($like):
            $this->db->like($like);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_imtems(){
        
         return $this->db->SELECT()
                          ->FROM('invt_items')
                          ->JOIN('invt_category','invt_category.cat_id=invt_items.itm_catId')
                          ->JOIN('invt_main_category','invt_main_category.catm_id=invt_items.catm_id','left outer')
                          ->JOIN('invt_assets_type','invt_assets_type.at_id=invt_items.itm_asstId')
                          ->ORDER_BY('itm_id','desc')
                ->GET()->RESULT();
    }
    public function get_emp_record($where=NULL){
        
        $this->db->SELECT();
                          $this->db->FROM('hr_emp_record');
                          $this->db->JOIN('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation');
                          if($where):
                              $this->db->LIKE($where);
                          endif;
//                          $this->db->where('cat_id','1');
                          $this->db->LIMIT('5','0');
                
             $query =     $this->db->GET();
        return  $query->RESULT();
    }
    
    public function get_autoComplete_record($table,$where,$like=NULL){
        $this->db->SELECT();
                          $this->db->FROM($table);
                            if($like):
                                $this->db->LIKE($like);
                            endif;
                          $this->db->WHERE($where);
//                          $this->db->LIMIT('5','0');
                
             $query =     $this->db->GET();
        return  $query->RESULT();
    }
   
    public function get_autoComplete_deptt($table,$like=NULL){
        
            $this->db->FROM($table);
            $this->db->where('deptt_status','0');    
                if($like):
                    $this->db->LIKE($like);
                endif;
            $this->db->order_by('dept_name','asc');    
            
        return $this->db->GET()->RESULT();
        
    }
    public function autoComplete_deptt_inventory($table,$like=NULL){
        
            $this->db->FROM($table);
                if($like):
                    $this->db->LIKE($like);
                endif;
        return $this->db->GET()->RESULT();
        
    }
   
    public function get_items_details($where){

                 $this->db->join('invt_rooms','invt_rooms.rm_id=invt_fixed_item_details_demo.fid_roomId');
                 $this->db->join('invt_building_block','invt_building_block.bb_id=invt_rooms.rm_bbId');
                 $this->db->join('invt_items','invt_items.itm_id=invt_fixed_item_details_demo.Fid_itemId');
                 $this->db->WHERE($where);
                 $this->db->order_by('invt_fixed_item_details_demo.fid_id','desc');
    return      $this->db->get('invt_fixed_item_details_demo')->result();

    }
    
//    public function get_items_details($table,$where){
//                 $this->db->SELECT();
//                    $this->db->FROM($table);
//                    $this->db->join('invt_rooms','invt_rooms.rm_id=invt_fixed_item_details_demo.fid_roomId');
//                    $this->db->join('invt_building_block','invt_building_block.bb_id=invt_rooms.rm_bbId');
//                    $this->db->join('invt_items','invt_items.itm_id=invt_fixed_item_details_demo.Fid_itemId');
//                    $this->db->WHERE($where);
//                    $this->db->order_by('fid_id','desc');
////                    $this->db->order_by('cid_itemId','desc');
//        return      $this->db->GET()->RESULT();
//        
//    }
public function get_items_lists(){
         $this->db->SELECT();
                    $this->db->FROM('invt_fixed_item_issuance');
                    $this->db->join('hr_emp_record','hr_emp_record.emp_id=invt_fixed_item_issuance.fii_empId');
                    $this->db->join('invt_fixed_item_details','invt_fixed_item_details.fid_fiiId=invt_fixed_item_issuance.fii_id');
                    $this->db->join('invt_rooms','invt_rooms.rm_id=invt_fixed_item_details.fid_roomId');
                    $this->db->join('invt_building_block','invt_building_block.bb_id=invt_rooms.rm_bbId');
                    $this->db->join('invt_items','invt_items.itm_id=invt_fixed_item_details.Fid_itemId');
                    $this->db->order_by('fid_id','desc');
                    $this->db->LIMIT('50','0');
                    $this->db->where('fid_trash',1);

        return      $this->db->GET()->RESULT();
}    

public function get_fix_itemsList($where=NULL,$date=NULL){
         $this->db->SELECT();
//                    $this->db->FROM('invt_fixed_item_issuance');
                    $this->db->join('hr_emp_record','invt_fixed_item_issuance.fii_empId=hr_emp_record.emp_id','left outer');
                    $this->db->join('invt_fixed_item_details','invt_fixed_item_details.fid_fiiId=invt_fixed_item_issuance.fii_id','left outer');
                    $this->db->join('invt_rooms','invt_rooms.rm_id=invt_fixed_item_details.fid_roomId','left outer');
                    $this->db->join('invt_building_block','invt_rooms.rm_bbId=invt_building_block.bb_id','left outer');
                    $this->db->join('invt_items','invt_items.itm_id=invt_fixed_item_details.Fid_itemId','left outer');
                    $this->db->order_by('rm_id','desc');
                  
                    $this->db->where($where);
                     
                     if($date):
                        $this->db->where('invt_fixed_item_details.fid_date BETWEEN "'.date('Y-m-d', strtotime($date['from'])).'" AND "'.date('Y-m-d', strtotime($date['to'])).'"');   
                     endif;
        return      $this->db->GET('invt_fixed_item_issuance')->RESULT();
} 

public function get_fix_itemsList_edit($where=NULL){
         $this->db->SELECT();
                   
                    $this->db->join('hr_emp_record','invt_fixed_item_issuance.fii_empId=hr_emp_record.emp_id','left outer');
                    $this->db->join('invt_fixed_item_details','invt_fixed_item_details.fid_fiiId=invt_fixed_item_issuance.fii_id','left outer');
                    $this->db->join('invt_rooms','invt_rooms.rm_id=invt_fixed_item_details.fid_roomId','left outer');
                    $this->db->join('invt_building_block','invt_rooms.rm_bbId=invt_building_block.bb_id','left outer');
                    $this->db->join('invt_items','invt_items.itm_id=invt_fixed_item_details.Fid_itemId','left outer');
        return      $this->db->where($where)->get('invt_fixed_item_issuance')->row();
} 
public function get_fix_items_List_detail($where=NULL,$like=NULL){
              $this->db->SELECT('rm_id,rm_name,hr_emp_record.emp_name');
                    $this->db->join('invt_fixed_item_details','invt_fixed_item_details.fid_fiiId=invt_fixed_item_issuance.fii_id');
                    $this->db->join('hr_emp_record','invt_fixed_item_issuance.fii_empId=hr_emp_record.emp_id','left outer');
                    $this->db->join('invt_rooms','invt_rooms.rm_id=invt_fixed_item_details.fid_roomId');
                    $this->db->join('invt_building_block','invt_building_block.bb_id=invt_rooms.rm_bbId');
                    $this->db->order_by('rm_name','asc');
                    $this->db->group_by('rm_id');
                    $this->db->where($where);
                    if($like):
                        $this->db->like($like);
                    endif;
        return      $this->db->get('invt_fixed_item_issuance')->result();
} 
public function get_fix_itemsListExecl($where=NULL,$like=NULL){
         $this->db->SELECT(
                 'emp_name,
                 CONCAT(bb_shortname,"-", rm_shortname,"-",itm_shortname,"-",fid_code) as Code,
                  bb_name,
                  rm_name,
                  itm_name,
                  fii_date
                
                 
                 ');
                    $this->db->FROM('invt_fixed_item_issuance');
                    $this->db->join('hr_emp_record','invt_fixed_item_issuance.fii_empId=hr_emp_record.emp_id');
                    $this->db->join('invt_fixed_item_details','invt_fixed_item_details.fid_fiiId=invt_fixed_item_issuance.fii_id');
                    $this->db->join('invt_rooms','invt_rooms.rm_id=invt_fixed_item_details.fid_roomId');
                    $this->db->join('invt_building_block','invt_rooms.rm_bbId=invt_building_block.bb_id');
                    $this->db->join('invt_items','invt_items.itm_id=invt_fixed_item_details.Fid_itemId');
                    $this->db->order_by('fid_id','desc');
                   
                    $this->db->where($where);
                    if($like):
                        $this->db->like($like);
                    endif;
                    

        return      $this->db->GET()->RESULT_ARRAY();
} 


public function get_block_like_where($where,$like=NULL){
        
            
            $this->db->where($where);
            if($like):
                $this->db->like($like);
            endif;
            
    return $this->db->get('invt_building_block')->result();
}
    public function get_items_detailsRow($table,$where){
                    $this->db->SELECT('*');
                    $this->db->FROM($table);
                     $this->db->join('invt_rooms','invt_rooms.rm_id=invt_fixed_item_details.fid_roomId');
                     $this->db->join('invt_building_block','invt_building_block.bb_id=invt_rooms.rm_bbId');
                      $this->db->join('invt_items','invt_items.itm_id=invt_fixed_item_details.Fid_itemId');
                    $this->db->WHERE($where);
        return      $this->db->GET()->row();
    }
    
      public function getemp_names($table,$like=NULL)
    {
       $this->db->select('
        hr_emp_record.emp_id as emp_id,
        hr_emp_record.emp_name as emp_name,
        hr_emp_designation.title as designation,
       '); 
        $this->db->FROM($table);
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        if($like):
        $this->db->like($like);
        endif;
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_fix_itemsList_all($where=NULL){
         $this->db->SELECT('itm_id,itm_name,count(fid_id) as total,itm_shortname');
                    $this->db->FROM('invt_items');
 
                     $this->db->join('invt_fixed_item_details','invt_items.itm_id=invt_fixed_item_details.fid_itemId');
                     $this->db->order_by('itm_id','desc');
                     $this->db->group_by('itm_id');
                  if($where):
                      $this->db->where($where);
                  endif;
        return      $this->db->GET()->RESULT();
    }
    
    public function search_fixed_issuance_items($where=NULL)
    {
        $this->db->SELECT('
                invt_fixed_item_issuance.fii_date,
                hr_emp_record.emp_name,
                invt_items.itm_name,
                invt_rooms.rm_name,
                invt_fixed_item_details.fid_id,
                invt_fixed_item_details.fid_tag_no,
                department.title as deptt_name,
                invt_items_status.*,
                invt_issuance_status.*
                ');
        $this->db->FROM('invt_fixed_item_issuance');
        $this->db->join('hr_emp_record','invt_fixed_item_issuance.fii_empId=hr_emp_record.emp_id','left outer');
        $this->db->join('invt_fixed_item_details','invt_fixed_item_details.fid_fiiId=invt_fixed_item_issuance.fii_id');
        $this->db->join('invt_rooms','invt_rooms.rm_id=invt_fixed_item_details.fid_roomId','left outer');
        $this->db->join('invt_building_block','invt_rooms.rm_bbId=invt_building_block.bb_id','left outer');
        $this->db->join('invt_items','invt_items.itm_id=invt_fixed_item_details.Fid_itemId','left outer');
        $this->db->join('invt_items_status','invt_items_status.is_id=invt_fixed_item_details.Fid_isId','left outer');
        $this->db->join('invt_issuance_status','invt_issuance_status.iis_id=invt_fixed_item_details.iis_id','left outer');
        $this->db->join('department','department.department_id=invt_fixed_item_details.fid_deptt','left outer');
        $this->db->order_by('invt_items_status.is_id','asc');
        $this->db->order_by('invt_fixed_item_details.iis_id','asc');
//        $this->db->order_by('rm_id','desc');
        
//        $this->db->where('invt_fixed_item_details.iis_id','1');
        if($where):
            $this->db->where($where);
        endif;
        return  $this->db->GET()->RESULT();
    }
    
    public function status_change_issued_item($where)
    {
        $this->db->SELECT('
                invt_items.itm_name,
                invt_items.itm_id,
                invt_rooms.rm_name,
                invt_building_block.bb_name,
                department.title as deptt_name,
                invt_fixed_item_details.*,
                invt_items_status.*,
                invt_issuance_status.*
                ');
        $this->db->FROM('invt_fixed_item_details');
        $this->db->join('invt_rooms','invt_rooms.rm_id=invt_fixed_item_details.fid_roomId','left outer');
        $this->db->join('invt_building_block','invt_rooms.rm_bbId=invt_building_block.bb_id','left outer');
        $this->db->join('invt_items','invt_items.itm_id=invt_fixed_item_details.Fid_itemId','left outer');
        $this->db->join('invt_items_status','invt_items_status.is_id=invt_fixed_item_details.Fid_isId','left outer');
        $this->db->join('invt_issuance_status','invt_issuance_status.iis_id=invt_fixed_item_details.iis_id','left outer');
        $this->db->join('department','department.department_id=invt_fixed_item_details.fid_deptt','left outer');
        $this->db->where($where);
        $query =  $this->db->get();
        if($query):
            return $query->row();
        endif;
    }
    
  public function get_fix_items_List_detail_edit($where=NULL,$like=NULL){
//         $this->db->SELECT('rm_id,rm_name,emp_name');
                    $this->db->FROM('invt_fixed_item_issuance');
                     $this->db->join('hr_emp_record','invt_fixed_item_issuance.fii_empId=hr_emp_record.emp_id','left outer');
                     $this->db->join('invt_fixed_item_details','invt_fixed_item_details.fid_fiiId=invt_fixed_item_issuance.fii_id');
                     $this->db->join('invt_rooms','invt_rooms.rm_id=invt_fixed_item_details.fid_roomId');
                     $this->db->join('invt_building_block','invt_building_block.bb_id=invt_rooms.rm_bbId');
                    $this->db->join('invt_items','invt_items.itm_id=invt_fixed_item_details.Fid_itemId','left outer');
                     $this->db->order_by('emp_name','asc');
                     $this->db->order_by('rm_name','asc');
                     $this->db->order_by('itm_name','asc');
                     $this->db->order_by('fid_barCode','asc');
                    
                  
                    $this->db->where($where);
                    if($like):
                        $this->db->like($like);
                    endif;
                    

        return      $this->db->GET()->RESULT();
}  
    public function get_itemsData($where=NULL,$like=NULL){
        $this->db->SELECT('
                invt_items.itm_id,
                invt_items.itm_name,
                invt_items.itm_shortname,
                invt_items.itm_status,
                invt_items.itm_comments,
                invt_main_category.catm_name as main_cat_name,
                invt_category.cat_name as category_name,
                invt_assets_type.at_name as asset_type,
                ');
        $this->db->FROM('invt_items');
        $this->db->join('invt_main_category','invt_main_category.catm_id=invt_items.catm_id', 'left outer');
        $this->db->join('invt_category','invt_category.cat_id=invt_items.itm_catId', 'left outer');
        $this->db->join('invt_assets_type','invt_assets_type.at_id=invt_items.itm_asstId', 'left outer');
        
        if($like):
            $this->db->like($like);
        endif;
        if($where):
            $this->db->where($where);
        endif;
        $this->db->order_by('invt_items.itm_id','desc'); 
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function items_pagination($SPP,$page,$where){
         $this->db->SELECT('
                invt_items.itm_id,
                invt_items.itm_name,
                invt_items.itm_shortname,
                invt_items.itm_status,
                invt_items.itm_comments,
                invt_main_category.catm_name as main_cat_name,
                invt_category.cat_name as category_name,
                invt_assets_type.at_name as asset_type,
                ');
        $this->db->FROM('invt_items');
        $this->db->join('invt_main_category','invt_main_category.catm_id=invt_items.catm_id', 'left outer');
        $this->db->join('invt_category','invt_category.cat_id=invt_items.itm_catId', 'left outer');
        $this->db->join('invt_assets_type','invt_assets_type.at_id=invt_items.itm_asstId', 'left outer');
        $this->db->limit($SPP,$page);
        $this->db->where($where);
        $this->db->order_by('invt_items.itm_id','desc');       
        $query =      $this->db->get();
        return $query->result();
    }
    
public function get_issued_item_data($table,$wheredata)
    {
        $this->db->select('
                invt_fixed_item_details.fid_id,
                invt_fixed_item_details.fid_grn,
                invt_fixed_item_details.fid_tag_no,
                invt_fixed_item_details.fid_manual_grn,
                invt_fixed_item_issuance.fii_date,
                invt_rooms.rm_name as room_name,
                invt_building_block.bb_name as block_name,
                department.title as deptt_name,
                invt_items.itm_name as item_name,
                hr_emp_record.emp_name as employee_name,
                hr_emp_designation.title as emp_design,
                invt_items_status.is_name as item_iss_status,
                invt_grn.goods_rec_del_by as item_iss_by,
                invt_issuance_status.iis_id as item_status
                '); 
        $this->db->FROM($table);
        $this->db->join('invt_fixed_item_issuance','invt_fixed_item_issuance.fii_id=invt_fixed_item_details.fid_fiiId','left outer');
        $this->db->join('invt_grn','invt_grn.grn_id=invt_fixed_item_details.fid_grn','left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=invt_fixed_item_issuance.fii_empId','left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer');
        $this->db->join('invt_rooms','invt_rooms.rm_id=invt_fixed_item_details.fid_roomId','left outer');
        $this->db->join('invt_building_block','invt_rooms.rm_bbId=invt_building_block.bb_id','left outer');
        $this->db->join('invt_items','invt_items.itm_id=invt_fixed_item_details.Fid_itemId','left outer');
        $this->db->join('invt_items_status','invt_items_status.is_id=invt_fixed_item_details.Fid_isId','left outer');
        $this->db->join('invt_issuance_status','invt_issuance_status.iis_id=invt_fixed_item_details.iis_id','left outer');
        $this->db->join('department','department.department_id=invt_fixed_item_details.fid_deptt','left outer');
        $this->db->where($wheredata);
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_demo_items($table,$qid){
        $query = $this->db->select('*')
            ->from($table)
        ->join('invt_items','invt_items.itm_id=invt_quotation_items.item_id','left outer')
            ->where($qid)
            ->get();
      return $query->result();
    }
    
    public function get_qd_items($table,$qid){
        $query = $this->db->select('*')
            ->from($table)
        ->join('invt_items','invt_items.itm_id=invt_quotation_items.item_id','left outer')
            ->where($qid)
            ->get();
      return $query->result();
    }
    
    public function get_qd_details($table,$where){
        $this->db->SELECT('
                invt_supplier.sp_name as supplier_name,
                invt_items.itm_name as item_name,
                invt_items.itm_id,
                invt_quotations_detail.qd_id,
                invt_quotations_detail.qd_product_qty,
                invt_quotations_detail.qd_product_price,
                invt_quotations_detail.qd_total_price
                ');
        $this->db->FROM($table);
        $this->db->join('invt_quotations','invt_quotations.quot_id=invt_quotations_detail.qd_quot_id', 'left outer');
        $this->db->join('invt_items','invt_items.itm_id=invt_quotations_detail.qd_product_id', 'left outer');
        $this->db->join('invt_supplier','invt_supplier.sp_id=invt_quotations_detail.qd_supplier_id', 'left outer');
        $this->db->where($where);
//        $this->db->order_by('invt_quotations_detail.qd_total_price','asc'); 
        $query =      $this->db->get();
        return $query->result();
    }
    
    public function get_quote_record($table, $date1, $date2, $like=NULL){
        $this->db->select('
            invt_quotations.quot_id,
            invt_quotations.quot_title,
            invt_quotations.quot_date,
        '); 
        
        if($like):
            $this->db->like($like);
        endif;
        
        $this->db->where('invt_quotations.quot_date BETWEEN "'.date('Y-m-d', strtotime($date1)).'" AND "'.date('Y-m-d', strtotime($date2)).'"');
        return $this->db->get_where($table)->result();
    }
    
    public function get_quote($table,$where){
        $this->db->SELECT('
                invt_supplier.sp_name as supplier_name,
                invt_items.itm_name as item_name,
                invt_quotations.quot_id,
                invt_quotations.quot_title,
                invt_quotations_detail.qd_supplier_id
                ');
        $this->db->FROM($table);
        $this->db->join('invt_quotations','invt_quotations.quot_id=invt_quotations_detail.qd_quot_id', 'left outer');
        $this->db->join('invt_items','invt_items.itm_id=invt_quotations_detail.qd_product_id', 'left outer');
        $this->db->join('invt_supplier','invt_supplier.sp_id=invt_quotations_detail.qd_supplier_id', 'left outer');
        $this->db->where($where);
        $this->db->group_by('invt_quotations_detail.qd_supplier_id'); 
        $query =      $this->db->get();
        return $query->result();
    }
    
    public function get_quote_row($table,$where){
        $this->db->SELECT('
                invt_supplier.sp_name as supplier_name,
                invt_items.itm_name as item_name,
                invt_quotations.quot_id,
                invt_quotations.quot_title,
                invt_quotations_detail.qd_supplier_id
                ');
        $this->db->FROM($table);
        $this->db->join('invt_quotations','invt_quotations.quot_id=invt_quotations_detail.qd_quot_id', 'left outer');
        $this->db->join('invt_items','invt_items.itm_id=invt_quotations_detail.qd_product_id', 'left outer');
        $this->db->join('invt_supplier','invt_supplier.sp_id=invt_quotations_detail.qd_supplier_id', 'left outer');
        $this->db->where($where);
        $this->db->group_by('invt_quotations_detail.qd_supplier_id'); 
        $query =      $this->db->get();
        return $query->row();
    }
    
    public function get_quote_supplier($table,$where){
        $this->db->SELECT('
                invt_quotations_detail.qd_supplier_id as supplier_fid,
                invt_supplier.sp_name as supplier_fname,
                ');
        $this->db->FROM($table);
        $this->db->join('invt_quotations','invt_quotations.quot_id=invt_quotations_detail.qd_quot_id', 'left outer');
        $this->db->join('invt_supplier','invt_supplier.sp_id=invt_quotations_detail.qd_supplier_id', 'left outer');
        $this->db->where($where);
        $this->db->group_by('invt_quotations_detail.qd_supplier_id'); 
        $query =      $this->db->get();
        return $query->result();
    }
    
    public function get_comparative_data($table,$where){
        $this->db->SELECT('
                invt_comparative_statement.cs_id,
                invt_comparative_statement.cs_quote_id,
                invt_comparative_statement.cs_minute_sheet_no,
                invt_comparative_statement.cs_requisistion_no,
                invt_comparative_statement.cs_acct_off_id,
                invt_comparative_statement.cs_est_mngr_id,
                invt_comparative_statement.cs_admin_off_id,
                invt_comparative_statement.cs_dir_finance_id,
                invt_comparative_statement.cs_vp_admin_id,
                invt_comparative_statement.cs_date,
                invt_quotations.quot_title,
                financial_year.year,
                ');
        $this->db->FROM($table);
        $this->db->join('invt_quotations','invt_quotations.quot_id=invt_comparative_statement.cs_quote_id', 'left outer');
        $this->db->join('financial_year','financial_year.id=invt_comparative_statement.cs_financial_year', 'left outer');
        $this->db->where($where);
        $query =      $this->db->get();
        return $query->row();
    }
    
    public function get_cs_quote_data($where){
        $this->db->SELECT('
                sum(invt_quotations_detail.qd_total_price) as total_amount,
                invt_quotations_detail.qd_supplier_id,
                invt_quotations_detail.qd_quot_id,
                ');
        $this->db->join('invt_quotations_detail','invt_quotations_detail.qd_quot_id=invt_quotations.quot_id', 'left outer');
        $this->db->join('invt_supplier','invt_supplier.sp_id=invt_quotations_detail.qd_supplier_id', 'left outer');
        $this->db->where($where);
        $this->db->group_by('invt_quotations_detail.qd_supplier_id');
        $query =      $this->db->get('invt_quotations')->result();
        $return_array = '';
        foreach($query as $row):
            $return_array[] = array(
                'total_amount' => $row->total_amount,
                'qd_supplier_id' => $row->qd_supplier_id,
                'qd_quot_id' => $row->qd_quot_id,
            );
        endforeach;
//        echo '<pre>'; print_r($q_data); die;
        $keys   = array_column($return_array, 'total_amount');
                array_multisort($keys, SORT_ASC, $return_array);
        return      json_decode(json_encode($return_array), FALSE);
    }
    
    public function get_cs_quotations_record($where){
        $this->db->SELECT('
                invt_quotations_detail.qd_supplier_id,
                invt_quotations_detail.qd_quot_id,
                invt_supplier.sp_name,
                invt_supplier.phone,
                invt_supplier.address,
                sum(invt_quotations_detail.qd_total_price) as total_amount
                ');
        $this->db->join('invt_quotations_detail','invt_quotations_detail.qd_quot_id=invt_quotations.quot_id', 'left outer');
        $this->db->join('invt_supplier','invt_supplier.sp_id=invt_quotations_detail.qd_supplier_id', 'left outer');
        $this->db->where($where);
        $this->db->group_by('invt_quotations_detail.qd_supplier_id');
        $this->db->order_by('invt_quotations_detail.comparative_order', 'asc');
        $query =      $this->db->get('invt_quotations');
        return $query->result();
        
    }
    
    public function get_cs_item_data($where){
        $this->db->SELECT('
                invt_items.itm_name,
                invt_quotations_detail.qd_product_id,
                invt_quotations_detail.qd_product_qty,
                ');
        $this->db->join('invt_items','invt_items.itm_id=invt_quotations_detail.qd_product_id', 'left outer');
        $this->db->where($where);
        $this->db->group_by('invt_quotations_detail.qd_product_id');
        $query =      $this->db->get('invt_quotations_detail');
        return $query->result();
    }
    
    public function get_cs_amount_data($where){
        $this->db->SELECT('
                invt_quotations_detail.qd_product_price,
                invt_quotations_detail.qd_total_price,
                invt_quotations_detail.qd_supplier_id,
                ');
        $this->db->join('invt_items','invt_items.itm_id=invt_quotations_detail.qd_product_id', 'left outer');
        $this->db->where($where);
//        $this->db->group_by('invt_quotations_detail.qd_product_id');
        $this->db->order_by('invt_quotations_detail.comparative_order', 'asc');
        $query = $this->db->get('invt_quotations_detail');
        return $query->result();
    }
    
    public function get_u_data($where){
        $this->db->SELECT('
                hr_emp_record.emp_name,
                hr_emp_designation.title,
                ');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId', 'left outer');
        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
        $this->db->where($where);
//        $this->db->group_by('invt_quotations_detail.qd_product_id');
//        $this->db->order_by('invt_quotations_detail.comparative_order', 'asc');
        $query = $this->db->get('users');
        return $query->row();
    }
    
    public function get_cs_low_supp($where){
        $this->db->SELECT('
                invt_supplier.sp_name,
                ');
        $this->db->join('invt_quotations_detail','invt_quotations_detail.qd_quot_id=invt_quotations.quot_id', 'left outer');
        $this->db->join('invt_supplier','invt_supplier.sp_id=invt_quotations_detail.qd_supplier_id', 'left outer');
        $this->db->where($where);
        $this->db->group_by('invt_quotations_detail.qd_supplier_id');
        $this->db->order_by('invt_quotations_detail.comparative_order', 'asc');
        $query =      $this->db->get('invt_quotations');
        return $query->row();
        
    }
    
    public function get_by_id_row($table,$id){
        $query = $this->db->select('*')
            ->from($table)
        ->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer')
            ->where($id)
            ->order_by('hr_emp_record.emp_id', 'desc')
            ->get();
      return $query->row();
    }
    
    public function get_comparative_record($table, $date1, $date2, $like=NULL, $where=NULL){
        $this->db->select('
            invt_comparative_statement.cs_id,
            invt_comparative_statement.cs_quote_id,
            invt_comparative_statement.cs_minute_sheet_no,
            invt_comparative_statement.cs_requisistion_no,
            invt_comparative_statement.cs_date,
            invt_quotations.quot_id,
            invt_quotations.quot_title
        '); 
        
        $this->db->join('invt_quotations', 'invt_quotations.quot_id=invt_comparative_statement.cs_quote_id');
        
        if($like):
            $this->db->like($like);
        endif;
        
        if($where):
            $this->db->where($where);
        endif;
        
        $this->db->where('invt_comparative_statement.cs_date BETWEEN "'.date('Y-m-d', strtotime($date1)).'" AND "'.date('Y-m-d', strtotime($date2)).'"');
        $this->db->order_by('invt_comparative_statement.cs_id', 'desc');
        return $this->db->get_where($table)->result();
    }
    
    public function get_cs_supplier($table,$where){
        $this->db->SELECT('
                invt_quotations_detail.qd_supplier_id as supplier_fid,
                invt_supplier.sp_name as supplier_fname,
                ');
        $this->db->FROM($table);
        $this->db->join('invt_quotations','invt_quotations.quot_id=invt_quotations_detail.qd_quot_id', 'left outer');
        $this->db->join('invt_supplier','invt_supplier.sp_id=invt_quotations_detail.qd_supplier_id', 'left outer');
        $this->db->where($where);
        $this->db->group_by('invt_quotations_detail.qd_supplier_id'); 
        $this->db->order_by('invt_quotations_detail.comparative_order', 'asc'); 
        $query =      $this->db->get();
        return $query->result();
    }
    
}

