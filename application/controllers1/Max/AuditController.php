<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class AuditController extends AdminController {

    public function __construct() {
             parent::__construct();
                $this->load->model('CRUDModel');
                $this->load->model('FinanceModel');
                $this->load->model('AuditModel');
                $this->load->model('FeeModel');
                $this->load->model('InventoryModel');
            }
            
  public function audit_finance_voucher_search(){
        $this->data['voucher_status']   = $this->CRUDModel->dropDown('fn_vocher_status','Vocher Status', 'id', 'status_title',array('status'=>1)); 
        $this->data['from_date']        = '';
        $this->data['to_date']          = date('d-m-Y');
        $this->data['voucehr_no'] = '';
        $this->data['statusid'] = '';
        
        $where = array(
          'fn_vocher_status.status'=>1  
        );
        $this->data['result'] =$this->AuditModel->search_date_range_limit($where);
//        echo '<pre>';print_r( $this->data['result']);die;
        if($this->input->post()):
            $from_date                 = $this->input->post('from_date');
            $to_date                 = $this->input->post('to_date');
            $voucher_id                 = $this->input->post('voucher_id');
            $vocher_status              = $this->input->post('voucher_status');
            $this->data['statusid']     = $vocher_status;
            $where                      =  '';
            $date                      =  '';
           
            if($from_date):
                $date['from_date']          = $from_date;
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
            
             
            $this->data['result'] =$this->AuditModel->search_date_range($where,$date);
 
        endif;
 
        
        $this->data['page']             = 'audit/finance/finance_voucher_search';
        $this->data['page_header']      = 'Audit Finance Voucher Search';
        $this->data['page_title']       = 'Audit Finance Voucher Search | ECMS';
        $this->load->view('common/common',$this->data);
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
        $where = "";
        $like = "";
       
        $this->data['order_date'] = ""; 
        $this->data['issued_by'] = ""; 
        $this->data['issued_to'] = ""; 
        $this->data['prepared_by'] = ""; 
        $this->data['authorized_by'] = ""; 
        $this->data['status'] = "";
        $this->data['ship_to'] = "";
        $this->data['po_id'] = "";
   
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
            $this->data['result'] = $this->InventoryModel->get_po_lists('invt_purchase_order');
        endif;
        $this->data['page_title']   = 'Purchase Order List | ECMS';
        $this->data['page']         = 'audit/inventory/purchase_order_list';
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
        $this->data['page']         = 'audit/inventory/items_assuance_list';
        $this->load->view('common/common',$this->data); 
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
        $where = "";
        $like = "";
       
        $this->data['order_date'] = ""; 
        $this->data['issued_by'] = ""; 
        $this->data['issued_to'] = ""; 
        $this->data['prepared_by'] = ""; 
        $this->data['authorized_by'] = ""; 
        $this->data['status'] = "";
        $this->data['ship_to'] = "";
        $this->data['work_id'] = "";
   
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
        $this->data['result'] = $this->InventoryModel->get_wo_lists('invt_work_order');
        endif;
        $this->data['page_title']   = 'Work Order List | ECMS';
        $this->data['page']         = 'audit/inventory/work_order_list';
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
        $this->data['page']         = 'audit/inventory/stock_balance_report';
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
        
        $this->data['page_title']   = 'Inventory Items Report | ECMS';
        $this->data['page']         = 'audit/inventory/store';
        $this->load->view('common/common',$this->data); 
    }
  public function audit_fee_search_filter(){
        
        $this->data['sub_program']  = $this->CRUDModel->dropDown('sub_programes', 'Sub Program ', 'sub_pro_id', 'name');
        $this->data['program']      = $this->CRUDModel->dropDown('programes_info', 'Program ', 'programe_id', 'programe_name');
        $this->data['section']      = $this->CRUDModel->dropDown('sections', 'Section', 'sec_id', 'name',array('status'=>'On'));
        $this->data['pc']           = $this->FeeModel->payment_Cat_DropDown('fee_payment_category', 'Payment Category', 'pc_id', 'title');
        $this->data['challan']      = $this->CRUDModel->dropDown('fee_challan_status', 'Challan Status', 'ch_status_id', 'fcs_title');
        $this->data['gender']       = $this->CRUDModel->dropDown('gender', 'Select Gender', 'gender_id', 'title');
        
        $this->data['collegeNo']    = '';
        $this->data['gender_id']    = '';
        $this->data['pc_id']        = '';
        $this->data['fatherName']   = '';
        $this->data['stdName']      = '';
        $this->data['programe_id']  = '';
        $this->data['sec_id']       = '';
        $this->data['sub_pro_id']   = '';
        $this->data['challan_id']   = '';
        $this->data['form_no']      = '';
        $this->data['challan_no']   = '';
        $this->data['from']         = '';
        $this->data['to']           = '';
        
        if($this->input->post()):
            
            $collegeNo      = $this->input->post("collegeNo");
            $challan_no      = $this->input->post("challan_no");
            $form_no        = $this->input->post("form_no");
            $stdName        = $this->input->post("stdName");
            $fatherName     = $this->input->post("fatherName");
            $programe_id    = $this->input->post("programe_id");
            $sub_pro_id     = $this->input->post("sub_pro_id");
            $section        = $this->input->post("section");
            $pc_id          = $this->input->post("pc_id");
            $challan_status = $this->input->post("challan_status");
            $gender         = $this->input->post("gender");
            $from         = $this->input->post("from");
            $to         = $this->input->post("to");
  
            if($from == ''):
                $date['from']       = ''; 
                $date['to']         = $to;
                 $this->data['from'] = '';
                $this->data['to']   = $to;
                else:
                
                $date['from']       = $from;
                $date['to']         = $to;
                $this->data['from'] = $from;
                $this->data['to']   = $to;
            endif;
            
      
            
            $where      = '';
            $like       = '';
            if($gender):
                $where['student_record.gender_id'] = $gender;
                $this->data['gender_id'] = $gender;
            endif;
            if($form_no):
                $where['student_record.form_no'] = $form_no;
                $this->data['form_no'] = $form_no;
            endif;
            if($challan_no):
                $where['fee_challan.fc_challan_id'] = $challan_no;
                $this->data['challan_no'] = $challan_no;
            endif;
            if($collegeNo):
                $where['student_record.college_no'] = $collegeNo;
                $this->data['collegeNo'] = $collegeNo;
            endif;
            if($challan_status):
                $where['fee_challan_status.ch_status_id'] = $challan_status;
                $this->data['challan_id'] = $challan_status;
            endif;
            
            if(!empty($stdName)):
                $like['student_record.student_name'] = $stdName;
                $this->data['stdName']           = $stdName;
            endif;
            if(!empty($fatherName)):
                $like['student_record.father_name'] = $fatherName;
                $this->data['fatherName']           = $fatherName;
            endif;
            
            if(!empty($pc_id)):
                $like['fee_challan.fc_pay_cat_id'] = $pc_id;
                $this->data['pc_id']           = $pc_id;
            endif;
            
            if($programe_id):
                $where['programes_info.programe_id'] = $programe_id;
                $this->data['programe_id'] = $programe_id;
            endif;
            if(!empty($sub_pro_id)):
                 $where['sub_programes.sub_pro_id'] = $sub_pro_id;
                $this->data['sub_pro_id']           = $sub_pro_id;
            endif;
            if(!empty($section)):
                $where['sections.sec_id'] = $section;
                $this->data['sec_id']     = $section;
            endif;
            
       
            
            $this->data['result'] = $this->FeeModel->fee_challan_filters($where,$like,$date);
            $this->data['count'] = $this->FeeModel->fee_challan_filters_count($where,$like,$date);
            
//              echo '<pre>';print_r( $this->data['result']);die;
        endif;
        
        $this->data['page']         = 'audit/fee/audit_fee_challan_filters';
        $this->data['page_header']  = 'Audit Fee Challan Search';
        $this->data['page_title']   = 'Audit Fee Challan Search | ECMS';
        $this->load->view('common/common',$this->data);
    }          
}