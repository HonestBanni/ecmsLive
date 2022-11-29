<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class CRUDModel extends CI_Model{

    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
         $this->load->model('ReportsModel');

    }
    // insert Record Requ: table Name ,field Array
    public function insert($table,$field){
        if($this->db->insert($table,$field)){
            $id = $this->db->insert_id();
            return $id;
            
        }else{
            return false;
        }
    }
    //Get all record By ID 
    public function getResults($table){
        $query = $this->db->select('*')
                ->FROM($table)
                ->get();
        return $query->result();
    }
    //get results requ: tableName,where
    public function get_where_result($table,$where,$column=Null,$array=NULL){
                 
        if($column):
            $this->db->where_in($column,$array);
        endif;
       return $this->db->get_where($table,$where)->result();

   }
    //get results requ: tableName,where
    
    //get results requ: tableName,where
    public function get_where_result_limit_order($table,$custom){
        $query =$this->db->SELECT('*')
                        ->FROM($table)
                        ->limit($custom['limit'],$custom['start'])
                        ->order_by($custom['column'],$custom['order'])
                        //->where($where)
                        ->get();
            return $query->result();
   }
 
    //get results requ: tableName,where
    public function get_where_result_order($table,$where=NULL,$custom){
            $this->db->SELECT('*'); 
            $this->db->FROM($table);
            $this->db->order_by($custom['column'],$custom['order']);
            if($where):
                $this->db->where($where);
            endif;
            
            $query =$this->db->get();
            return $query->result();
   }
   
    //get results requ: tableName,where
    public function get_wherein_row($table,$where=NULL, $where_in, $wi_arr){
            $this->db->SELECT('*'); 
            $this->db->FROM($table);
            if($where_in):
                $this->db->where_in($where_in,$wi_arr);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            
            $query =$this->db->get();
            return $query->row();
   }
   
    //get results requ: tableName,where
    public function get_wherein_row_order($table,$where=NULL, $where_in, $wi_arr, $column, $order){
            $this->db->SELECT('*'); 
            $this->db->FROM($table);
            if($where_in):
                $this->db->where_in($where_in,$wi_arr);
            endif;
            if($where):
                $this->db->where($where);
            endif;
            $this->db->order_by($column,$order);
            
            $query =$this->db->get();
            return $query->row();
   }
   
    //get results requ: tableName,where
    public function get_where_row($table,$where){
        $query =$this->db->SELECT('*')
                         ->FROM($table)
                         ->where($where)
                         ->get();
            return $query->row();
   }
    //get results requ: select,tableName,where
    public function get_where_row_select($field,$table,$where){
       return $this->db->SELECT($field)
            ->FROM($table)
            ->where($where)
            ->get()->row();

   }
   public function count_all($table){
        return $this->db->count_all($table);
   } 
  public function pagination($table,$SPP,$page,$where=NULL,$order=NULL){
       $this->db->select('*');
                $this->db->FROM($table);
                $this->db->limit($SPP,$page);
                if($order):
                $this->db->order_by($order['column'],$order['order']);    
                endif;
                if($where):
                    $this->db->where($where);
                endif;
           $query =      $this->db->get();
        return $query->result();
   }
   //---------------------------------------------------------------------------------------------------------->
    //----------------------------------Update By ID------------------------------------------------------------>
    //---------------------------------------------------------------------------------------------------------->
    public function update($table,$data,$where)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }
    
     //---------------------------------------------------------------------------------------------------------->
    //----------------------------------Trashe By ID------------------------------------------------------------>
    //---------------------------------------------------------------------------------------------------------->
    public function Trashe($where,$data)
    {
        $this->db->where($where);
        $this->db->update('scheme',$data);
    }
    //---------------------------------------------------------------------------------------------------------->
    //----------------------------------Delete By ID------------------------------------------------------------>
    //---------------------------------------------------------------------------------------------------------->
    public function deleteid($table,$where)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    //---------------------------------------------------------------------------------------------------------->
    //----------------------------Dynamic Drop Down Function --------------------------------------------------->
    //---------------------------------------------------------------------------------------------------------->

 

    function dropDownName($table, $option=NULL,$value,$show,$where=NULL){
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
				$data[$row->$value] = $row->$show;
			}
			return $data;
		}
	}   
    
        
    function sub_proDropDown($table, $option=NULL,$value,$show,$where=NULL,$column=NULL,$where_in=NULL){
		$this->db->select('*');
               // $this->db->distinct();
                if($where):
                    $this->db->where($where);
                endif;
                
                if($where_in):
                    $this->db->where_in($column,$where_in);
                endif;
                    
                    $this->db->join('programes_info','programes_info.programe_id=sub_programes.programe_id');
                    $this->db->order_by($show,'asc');
                
                
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show.' ('.$row->programe_name.')';
			}
			return $data;
		}
	} 
    
    
	function dropDown($table, $option=NULL, $value,$show,$where=NULL,$order=NULL){
		
                if($where):
                    $this->db->where($where);
                endif;
                  if($order):
                    $this->db->order_by($order['column'],$order['order']);
                endif;
//                 $this->db->order_by($show,'asc');
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show;
			}
			return $data;
		}
	}  
	function DropDown_Code($table,$option=NULL,$value,$show,$code,$where=NULL,$order=NULL){
		
                if($where):
                    $this->db->where($where);
                endif;
                 
                    $this->db->order_by($code,'asc');
           
//                 $this->db->order_by($show,'asc');
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = '['.$row->$code.'] '.$row->$show;
			}
			return $data;
		}
	}  
  
	function dropDownEmpScale($table, $option=NULL, $value,$show,$where=NULL,$order=NULL){
		
                if($where):
                    $this->db->where($where);
                endif;
//                  if($order):
                    $this->db->order_by('hr_emp_record.emp_name', 'asc');
//                endif;
//                 $this->db->order_by($show,'asc');
                    $this->db->select('
                            hr_emp_record.emp_id,
                            hr_emp_record.emp_name,
                            hr_emp_designation.title,
                            ');
                $this->db->join('hr_emp_scale', 'hr_emp_scale.emp_scale_id=hr_emp_record.c_emp_scale_id');
                $this->db->join('hr_emp_designation', 'hr_emp_designation.emp_desg_id=hr_emp_record.current_designation');
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show.' ( '.$row->title.' )';
			}
			return $data;
		}
	}  
  
	function dropDownMG($table, $option=NULL, $value,$show,$where=NULL,$order=NULL){
		
                if($where):
                    $this->db->where($where);
                endif;
                 $this->db->order_by($value,'asc');
                    $this->db->select('
                            class_alloted_merge_groups.camg_id,
                            class_alloted_merge_groups.camg_name,
                            hr_emp_record.emp_name,
                            subject.title as subject_name,
                            ');
                    $this->db->join('class_alloted','class_alloted.ca_merge_id=class_alloted_merge_groups.camg_id', 'left outer');
                    $this->db->join('hr_emp_record','hr_emp_record.emp_id=class_alloted.emp_id', 'left outer');
                    $this->db->join('subject','subject.subject_id=class_alloted.subject_id', 'left outer');
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) {
                            if(!empty($row->emp_name)):
                                $data[$row->$value] = $row->$show.' ['.$row->subject_name.'] ('.$row->emp_name.')';
                            else:
                                $data[$row->$value] = $row->$show;
                            endif;
                            
			}
			return $data;
		}
	}  
  
	function dropDownSupplier($table, $option=NULL, $value,$show,$where=NULL,$order=NULL){
		
                if($where):
                    $this->db->where($where);
                endif;
//                  if($order):
                    $this->db->order_by('invt_quotations_detail.comparative_order', 'asc');
//                endif;
//                 $this->db->order_by($show,'asc');
                    $this->db->select('
                            invt_quotations_detail.qd_supplier_id,
                            invt_supplier.sp_name,
                            ');
                $this->db->join('invt_supplier', 'invt_supplier.sp_id=invt_quotations_detail.qd_supplier_id');
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show;
			}
			return $data;
		}
	}  
  
	function batch_dropdown($table, $option=NULL, $value,$show,$where=NULL){
		
                if($where):
                    $this->db->where($where);
                endif;
              
                    $this->db->order_by('batch_name','asc');
                    $this->db->order_by('batch_order','asc');
               
//                 $this->db->order_by($show,'asc');
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show;
			}
			return $data;
		}
	}  
	function payment_cat_dropdown($table, $option=NULL, $value,$show,$where=NULL){
		
                if($where):
                    $this->db->where($where);
                endif;
              
//                    $this->db->order_by('batch_name','asc');
                    $this->db->order_by('cat_order','asc');
               
//                 $this->db->order_by($show,'asc');
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show;
			}
			return $data;
		}
	}  
        function dropDown_where_in($table, $option=NULL, $value,$show,$column=NULL,$array=NULL,$where=NULL)
	{
            
                $this->db->where_in($column,$array);
                if($where):
                   $this->db->where($where); 
                endif;
                
                $this->db->order_by($value,'asc');
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show;
			}
			return $data;
		}
	} 
        function dropDown_where_not_in($table, $option=NULL, $value,$show,$column=NULL,$array=NULL,$where=NULL)
	{
            
                $this->db->where_not_in($column,$array);
                if($where):
                   $this->db->where($where); 
                endif;
                
                $this->db->order_by($value,'asc');
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show;
			}
			return $data;
		}
	} 
        function dropDownKey($table, $option=NULL,$value,$show,$where=NULL){
		$this->db->select('*');
               // $this->db->distinct();
                if($where):
                    $this->db->where($where);
                endif;
            
                    $this->db->order_by($value,'asc');
                
                
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show;
			}
			return $data;
		}
	}  
        function dropDown_asc_title($table, $option=NULL,$value,$show,$where=NULL){
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
				$data[$row->$value] = $row->$show;
			}
			return $data;
		}
	}  
        function dropDownKeyDESC($table, $option=NULL,$value,$show,$where=NULL){
	 
                if($where):
                    $this->db->where($where);
                endif;
            
                    $this->db->order_by($value,'desc');
                
                
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show;
			}
			return $data;
		}
	}  
        
    //---------------------------------------------------------------------------------------------------------->
    //----------------------------------Upload Images ---------------------------------------------------------->
    //---------------------------------------------------------------------------------------------------------->
    public function uploadDirectory($file_name,$dir)
    {
        $config = array(
            'upload_path'=> $dir.'/',
            'allowed_types'=>'jpg|jpeg|png|gif|mp4|3gp|flv|mp3|doc|docx|rar|jfif',
            'max_size'=>'900000000000',
            'encrypt_name'=> TRUE,
        );

        $this->load->library('upload', $config);
        $this->upload->do_upload($file_name);
        $data=$this->upload->data();
        return $data;
    }
    //---------------------------------------------------------------------------------------------------------->
    //----------------------------------Upload Images ---------------------------------------------------------->
    //---------------------------------------------------------------------------------------------------------->   
    public function do_resize_only($path){
    
    $config['image_library'] = 'gd2';
    $config['source_image'] = $path;
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['width']     = 300;
    $config['height']   = 250;

    
    $this->image_lib->initialize($config);
    $this->image_lib->resize();
    $this->image_lib->resize();
        
    }
public function do_resize($file_name,$dir){
    
        $this->load->library( array('image_lib') );
        $configUp['upload_path']    = $dir.'/';
        $configUp['allowed_types']  = 'jpg|jpeg|png|gif|jfif';
        $configUp['max_size']       = '900000000000';
        $configUp['encrypt_name'] = TRUE;
        $this->load->library('upload', $configUp);
        $this->upload->do_upload($file_name);
        $data                       = $this->upload->data();
        $imageName                  = $data['file_name'];
        $path                       = $dir.'/'.$imageName;
         
        
        $config['image_library']    = 'gd2';
        $config['source_image']     = $path;
        $config['create_thumb']     = TRUE;
        $config['thumb_marker']     = '_'.date('dmY_His').'_thumb';
        $config['maintain_ratio']   = TRUE; 
        $config['width']            = 250;
        $config['height']           = 300;
        
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->resize();
        
        //Unlink Orignal Picture and Save just Thumnail picture
        unlink($path);

        $result = array(
                'file_name'=>$data['raw_name'].$config['thumb_marker'].$data['file_ext']
        );
     return  $result;
        
    }
    
public function do_resize_test($file_name,$dir){
    
        $this->load->library( array('image_lib') );
        $configUp['upload_path']    = $dir.'/';
        $configUp['allowed_types']  = 'jpg|jpeg|png|gif|jfif';
//        $configUp['allowed_types']  = 'jpg|jpeg|png|gif|mp4|3gp|flv|mp3|doc|docx|rar';
        $configUp['max_size']       = '900000000000';
        $configUp['encrypt_name'] = TRUE;
        $this->load->library('upload', $configUp);
        $this->upload->do_upload($file_name);
        $data                       = $this->upload->data();
         
        $imageName                  = $data['file_name'];
        $path                       = $dir.'/'.$imageName;
         
        
        $config['image_library']    = 'gd2';
        $config['source_image']     = $path;
        $config['create_thumb']     = TRUE;
        $config['thumb_marker']     = '_'.date('dmY_His').'_thumb';
//        $config['thumb_marker']     = '_thumb';
        $config['maintain_ratio']   = TRUE; 
        $config['width']            = 250;
        $config['height']           = 300;
        
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->resize();
//        unlink($path);

        $result = array(
//            'file_name'=>$data['file_name']
            'file_name'=>$data['raw_name'].$config['thumb_marker'].$data['file_ext']
//            'file_name'=>date('YmdHis').$data['raw_name'].$config['thumb_marker'].$data['file_ext']
        );
     
//         echo '<pre>'; print_r($result); die;
        return  $result;
        
    }
    
    public function hr_do_resize($file_name=NULL,$dir=NULL){
    
        if(empty($dir)):
            $dir = 'assets/images/';
        endif;
        $this->load->library( array('image_lib') );
        $configUp['upload_path']    = $dir.'/';
//        $configUp['allowed_types']  = 'jpg|jpeg|png|gif';
        $configUp['allowed_types']  = 'jpg|jpeg|png|gif|mp4|3gp|flv|mp3|doc|docx|rar|jfif';
        $configUp['max_size']       = '900000000000';
            
        if(!empty($file_name)):
         $this->load->library('upload', $configUp);
        $this->upload->do_upload($file_name);
        $data                       = $this->upload->data();
        $imageName                  = $data['file_name'];
        $path                       = $dir.'/'.$imageName;
        $config['image_library']    = 'gd2';
        $config['source_image']     = $path;
        $config['create_thumb']     = TRUE;
        $config['thumb_marker']     = '_thumb';
        $config['maintain_ratio']   = TRUE;
        $config['width']            = 250;
        $config['height']           = 300;

        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->resize();

        unlink($path);

        $result = array(
            'file_name'=>$data['raw_name'].$config['thumb_marker'].$data['file_ext']
        );
         
        return  $result;
        endif;
       
        
    }
 
    public function get_where_result_like($table,$where){
        $query =$this->db->SELECT('*')
                         ->FROM($table)
                         ->like($where)
                         ->get();
            return $query->result();
   }
   
    public function get_where_like($table,$where,$like){
        $query =$this->db->SELECT('*')
                         ->FROM($table)
                         ->where($where)
                         ->like($like)
                         ->get();
            return $query->result();
   }
   
public function getHrRcords(){
       $query = $this->db->select(
               '  
                  student_record.form_no,
                  student_record.student_name,  
                  student_record.father_name, 
                  applicant_edu_detail.obtained_marks,
                  applicant_edu_detail.total_marks,
                  
                  applicant_edu_detail.percentage,
                  sub_programes.name as sub_Programe_name,
                  reserved_seat.name as reserved_seat_name,
                  domicile.name as domicileName,
    
                  student_record.fata_school as School_Status,
                  
                  '
                )
 
                ->from('student_record')
                ->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer')
                ->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer')
                ->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer')
                ->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer')
                ->where('student_record.rseats_id','7')
                //->where('student_record.sub_pro_id','5')
                //->where('student_record.fata_school','yes')
                ->order_by('applicant_edu_detail.percentage','desc')
                ->get();
   
       return $query->result();
   } 

   
       public function UPL1($where){
        
        $query = $this->db->select('*')
                ->from('user_policyl1')
                ->where($where)
                 ->order_by('m1_order','asc')
                 ->order_by('m1_name','asc')
                 ->join('menul1','menul1.m1_id=user_policyl1.upl1_m1Id')
                ->get();
        return $query->result();
    }
    public function UPL2($where){
        
        $query = $this->db->select('*')
                ->from('user_policyl2')
                ->where($where)
                ->order_by('m2_order','asc')
                ->order_by('m2_name','asc')
                 ->join('menul2','menul2.m2_id=user_policyl2.up2_m2Id')
                ->get();
        return $query->result();
    }
    public function UPL3($where){
        
        $query = $this->db->select('*')
                ->from('user_policyl3')
                ->where($where)
                ->order_by('m3_order','asc')
                ->order_by('m3_name','asc')
                ->join('menul3','menul3.m3_id=user_policyl3.upl3_m3Id')
                ->get();
        return $query->result();
    }
    
    public function get_max_where($id,$table){
        
        $this->db->select_max($id);
        $query = $this->db->get($table);
        return $query->row();
    }
    
    public function get_max_value($id,$table,$where=NULL){
                $this->db->select('*');
                $this->db->from($table);
                if($where):
                    $this->db->where($where);
                endif;
                $this->db->limit('1');
                $this->db->order_by($id,'desc');
        return  $this->db->get()->row();
    }
    
    public function get_max_valueCode($id,$table){
                $this->db->select('*');
                $this->db->from($table);
                $this->db->limit('1');
                $this->db->order_by($id,'desc');
        return  $this->db->get()->row();
    }
       public function key_exists($table,$where){
    $this->db->where($where);
    $query = $this->db->get($table);
    if ($query->num_rows() > 0){
        return true;
    }
    else{
        return false;
    }
    }
    
public function check_student($table,$where){
    $this->db->where($where);
    return $this->db->get($table)->row();
    
    }
    public function money_convert($number,$RupplyFlag = NULL){
        
            $no = round($number);
            $point = round($number - $no, 2) * 100;
            $hundred = null;
            $digits_1 = strlen($no);
            $i = 0;
            $str = array();
            $words = array('0' => '', '1' => 'one', '2' => 'two',
             '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
             '7' => 'seven', '8' => 'eight', '9' => 'nine',
             '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
             '13' => 'thirteen', '14' => 'fourteen',
             '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
             '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
             '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
             '60' => 'sixty', '70' => 'seventy',
             '80' => 'eighty', '90' => 'ninety');
            $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
            while ($i < $digits_1) {
              $divider = ($i == 2) ? 10 : 100;
              $number = floor($no % $divider);
              $no = floor($no / $divider);
              $i += ($divider == 10) ? 1 : 2;
              if ($number) {
                 $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                 $hundred = ($counter == 1 && $str[0]) ? ' & ' : null;
                 $str [] = ($number < 21) ? $words[$number] .
                     " " . $digits[$counter] . $plural . " " . $hundred
                     :
                     $words[floor($number / 10) * 10]
                     . " " . $words[$number % 10] . " "
                     . $digits[$counter] . $plural . " " . $hundred;
              } else $str[] = null;
           }
           $str = array_reverse($str);
           $result = implode('', $str);
           $points = ($point) ?
             "." . $words[$point / 10] . " " . 
                   $words[$point = $point % 10] : '';
           if($points):
               return  "Rupees  " .$result . $points . " Paise";
           else:
               
               if($result):
                   if($RupplyFlag== 1):
                       return  $result.' Only';
                       else:
                       return  "Rupees  " .$result ;
                   endif;
                    
                   else:
                    return '';
               endif;
             
           
           endif;

     }
    public function getDatesFromRange($start, $end, $format = 'Y-m-d') {
    $array = array();
    $interval = new DateInterval('P1D');

    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

    foreach($period as $date) { 
        $array[] = $date->format($format); 
    }

    return $array;
}


 // status change on offline mode 
    public function idle(){
        $userInfo = json_decode(json_encode($this->getUser()), FALSE);
              
        $user = $this->CRUDModel->get_where_row('users',array('id'=>$userInfo->user_id));
    
        $this->data['user_status'] = $user->userStatus; 
        $this->data['page']         = 'Fee/Reports/idle';
        $this->data['page_header']  = 'Fee Concession Report';
        $this->data['page_title']   = 'Fee Concession Report | ECMS';
        $this->load->view('common/common',$this->data);
        
    }
 
    
    public function idle_status(){
        $userInfo =  json_decode(json_encode($this->getUser()), FALSE);
        $user_status      = $this->input->post("value");
//        echo '<pre>';print_r($userInfo);die;
        
        $data = array(
            'userStatus' =>2
        );
        $where = array(
            'id' =>$userInfo->user_id 
        );
       $this->CRUDModel->update('users',$data,$where);
//      echo 'offline';   
    }
    public function idle_status_live(){
        $userInfo =  json_decode(json_encode($this->getUser()), FALSE);
        $user_status      = $this->input->post("value");
//        echo '<pre>';print_r($userInfo);die;
        
        $data = array(
            'userStatus' =>1
        );
        $where = array(
            'id' =>$userInfo->user_id 
        );
       $this->CRUDModel->update('users',$data,$where);
       
//       echo 'Live';
         
    }
    public function close_status(){
        $userInfo =  json_decode(json_encode($this->getUser()), FALSE);
        $user_status      = $this->input->post("value");
//        echo '<pre>';print_r($userInfo);die;
        
        $data = array(
            'userStatus' =>0
        );
        $where = array(
            'id' =>$userInfo->user_id 
        );
       $this->CRUDModel->update('users',$data,$where);
       
//       echo 'Live';
         
    }
    public function student_all_details($where=NULL){
         $this->db->select(
                         '
                             student_record.college_no,
                             student_record.form_no,
                             student_record.batch_id,
                             student_record.student_id,
                             student_record.mobile_no,
                             student_record.rseats_id3,
                             student_record.applicant_mob_no1,
                             student_record.sub_pro_id,
                             student_record.programe_id,
                             student_record.student_name,
                             student_record.father_name,
                             sections.name as sectionsName,
                             sections.sec_id as section_id,
                             prospectus_batch.batch_name as current_batch,
                             student_status.name as current_status,
                             mobile_network.send_format as mobile_network,
                             student_record.std_mobile_network,
                             mobile_network.net_id
                             
                         ');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
//                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer');
//                $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
//                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
//                $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id','left outer') ;    
//                $this->db->join('religion','student_record.religion_id=religion.religion_id','left outer') ; 
                $this->db->join('mobile_network','student_record.net_id=mobile_network.net_id','left outer') ;

                if($where):
                    $this->db->where($where);
                endif;
               
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('student_record.student_id','asc');
                $this->db->order_by('sec_id','asc');
        return  $this->db->get('student_record')->row();
    }
public function student_all_detailsdd($where=NULL){
         $this->db->select(
                         '
                             student_record.college_no,
                             student_record.form_no,
                             student_record.batch_id,
                             student_record.student_id,
                             student_record.mobile_no,
                             student_record.applicant_mob_no1,
                             student_record.sub_pro_id,
                             student_record.programe_id,
                             student_record.student_name,
                             student_record.father_name,
                             sections.name as sectionsName,
                             sections.sec_id as section_id,
                             prospectus_batch.batch_name as current_batch,
                             student_status.name as current_status,
                             mobile_network.send_format as mobile_network,
                             mobile_network.net_id
                             
                         ');
                $this->db->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer');
                $this->db->join('student_group_allotment','student_group_allotment.student_id=student_record.student_id','left outer');
                $this->db->join('sections','sections.sec_id=student_group_allotment.section_id','left outer');
                $this->db->join('programes_info','programes_info.programe_id=student_record.programe_id','left outer');
                $this->db->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer');
//                $this->db->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer');
//                $this->db->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer');
//                $this->db->join('gender','gender.gender_id=student_record.gender_id','left outer');
                $this->db->join('prospectus_batch','prospectus_batch.batch_id=student_record.batch_id','left outer');
                $this->db->join('student_status','student_status.s_status_id=student_record.s_status_id','left outer');
//                $this->db->join('board_university','applicant_edu_detail.bu_id=board_university.bu_id','left outer') ;    
//                $this->db->join('religion','student_record.religion_id=religion.religion_id','left outer') ; 
                $this->db->join('mobile_network','student_record.net_id=mobile_network.net_id','left outer') ;

                if($where):
                    $this->db->where($where);
                endif;
               
                $this->db->group_by('student_record.student_id');
                $this->db->order_by('student_record.student_id','asc');
                $this->db->order_by('sec_id','asc');
        return  $this->db->get('student_record')->row();
    }
    function employee_dropdown($table, $option=NULL, $value,$show,$where=NULL,$order=NULL)	{
		$this->db->select('*');
               // $this->db->distinct();
                $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer');
                if($where):
                    $this->db->where($where);
                endif;
                if($order):
                    $this->db->order_by($order['column'],$order['order']);
                endif;
                 
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show.' ('.$row->title.')';
			}
			return $data;
		}
	}  
    function employee_dropdown_where_in($table, $option=NULL, $value,$show,$column, $array, $where=NULL)	{
		$this->db->select('*');
               // $this->db->distinct();
                $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation','left outer');
                $this->db->where_in($column,$array);
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
				$data[$row->$value] = $row->$show.' ('.$row->title.')';
			}
			return $data;
		}
	}  
   public function clean_number($sender_number){
       
        $sender_number = preg_replace( '/[^0-9]/', '', $sender_number);
       
        $first_check = substr($sender_number, 0, 2); 
        $return_number = '';
        if($first_check == 92):
            $return_number = '+'.$sender_number;
            else:
                
             $check_two = substr($sender_number, 0, 1);    
                  if($check_two == 0):
                      
                      $sender_number = substr($sender_number, 1, 999); 
                      
                  endif;  
            
            $return_number = '+92'.$sender_number;
        endif;
       return $return_number;
 
        
    }
    
   public function attendance_details($studentId,$sectionId,$student_name){
//            $studentId = '12078';
//            $sectionId = '187';
//            $studentId = $this->uri->segment(2);
//            $sectionId = $this->uri->segment(3);
                        $this->db->join("sections",'sections.sec_id=class_alloted.sec_id');
            $CheckStd = $this->db->get_where('class_alloted',array('sections.sec_id'=>$sectionId,'sections.status'=>'On'))->row();
               
            if(!empty($CheckStd)):
              
            $class_id   =  $CheckStd->class_id;
            $flag       =  $CheckStd->flag;
         
            //flag == 1 group_allot
            //flag == 2 subject allot
            if($CheckStd->flag==1):
               $result           = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$studentId,'student_group_allotment.section_id'=>$sectionId)); 
                 
                else:
                    
                $result           = $this->ReportsModel->get_whiteCard_section(
                        array(
                            'student_subject_alloted.student_id'=>$studentId,
                            'student_subject_alloted.section_id'=>$sectionId
                        )); 
            endif;
         
            
                if($flag ==1):
                    $classSubjects = $this->ReportsModel->get_classSubjects(array('sec_id'=>$sectionId));
                endif;
                 if($flag == 2):
                     $classSubjects = $this->ReportsModel->get_subject_list('student_subject_alloted',array('student_id'=>$result->student_id));
                endif;
            
                
                $fy_id = $this->db->get_where('whitecard_financial_year',array('status'=>1))->row();
                $time = strtotime($fy_id->year_start);
                    if($classSubjects):
                                        $netPresent = '';
                                        $netTotal   = '';
                                        foreach($classSubjects as $rowCS):
                                         $GrandTotal = 0;
                                         $granPresent = 0;
                                        
                                        for($i=1;$i<=12;$i++):

                                                $monthi     = '+'.$i.'month';
                                                $month      = date("m", strtotime($monthi, $time));
                                                $year       = date("Y", strtotime($monthi, $time));
                                                      
                                            
                                                    $where = array(
                                                        'subject_id'                => $rowCS->subject_id,
                                                        'sec_id'                    => $sectionId,
                                                        'student_id'                =>$result->student_id,
                                                        'month(attendance_date)'    =>$month,
                                                        'year(attendance_date)'     =>$year,
                                                    );
                                            $stdAtts = $this->ReportsModel->get_student_att($where);
                                          
                                               $p=0;
                                                $a=0;
                                            foreach($stdAtts as $stdAtt):
                                              
                                            if($stdAtt->status == 1):
                                                if($stdAtt->ca_classcount ==2):
                                                        $p++;
                                                        $p++;
                                                    else:
                                                        $p++;
                                                endif;
                                                else:
                                                   if($stdAtt->ca_classcount ==2):
                                                        $a++;
                                                        $a++;
                                                    else:
                                                        $a++;
                                                endif;
                                            
                                            endif;
                                          endforeach;
                                          
                                           $total = $a+$p;
                                          
                                        $granPresent += $p; 
                                         $GrandTotal += $total;
                                        $per =0; 
                                         if($GrandTotal):
                                          $per = ($granPresent/$GrandTotal)*100;
                                             
                                         endif;
                                          
                                             
                                            endfor;
                                            $netPresent += $granPresent;
                                            $netTotal += $GrandTotal;
                                     
                                        endforeach;
                                         
                                        $montylyPresentGrand    = '';
                                        $montylyApsentGrand     = '';
                                        for($i=1;$i<=12;$i++):
                                                $monthi     = '+'.$i.'month';
                                                $month      = date("m", strtotime($monthi, $time));
                                                $year       = date("Y", strtotime($monthi, $time));
                                                $wheret = array(
//                                                        'subject_id'                => $rowCS->subject_id,
                                                        'sec_id'                    => $sectionId,
                                                        'student_id'                =>$result->student_id,
                                                        'month(attendance_date)'    =>$month,
                                                        'year(attendance_date)'     =>$year,
                                                    );
                                            $stdAttst = $this->ReportsModel->get_student_att($wheret);
                                            
                                                    $tp='';
                                                    $ta='';
                                                    $pert='';
                                                    $montylyPresent = '';
                                                
                                            $MontlyGrandTotal = '';
                                             foreach($stdAttst as $stdAtt):
                                              
                                            if($stdAtt->status == 1):
                                                if($stdAtt->ca_classcount ==2):
                                                        $tp++;
                                                        $tp++;
                                                    else:
                                                        $tp++;
                                                endif;
                                                else:
                                                   if($stdAtt->ca_classcount ==2):
                                                        $ta++;
                                                        $ta++;
                                                    else:
                                                        $ta++;
                                                endif;
                                            
                                            endif;
                                          endforeach;
                                          
                                            $total = $ta+$tp;
                                          
                                          if($total):
                                              
                                          $tp.'/'.$total;
                                         endif;
                                    
                                       $montylyPresentGrand =   $montylyPresent += $tp; 
                                      $montylyApsentGrand =  $MontlyGrandTotal += $total;
                                       $per =0; 
                                    if($MontlyGrandTotal):
                                         $pert = ($montylyPresent/$MontlyGrandTotal)*100;

                                        endif;
                                     
                                    endfor;
                                        $gPresent   = '';
                                        $gAbsent    = '';
                                        $message    = '';
                                        
                                       if($netPresent):
                                                     
                                           
                                                    $gPresent       = $netPresent;
//                                                    $gPresent       = ($netPresent/$netTotal)*100;
                                                    $total_absent   =   $netTotal-$netPresent;
//                                                    echo $total_absent;die;
//                                                    $gAbsent = ($total_absent/$netTotal)*100;
//                                                    $gAbsent = ($total_absent/$netTotal)*100;
                                                     
                                                    $message = 'Honorable Parents, Your Child';
                                                    $message .= ' '.$student_name.' ';
                                                    $message .= 'has remained present in total ';
                                                    $message .= $gPresent;
//                                                    $message .= round($gPresent,2).'%';
                                                    $message .= ' classes of the college and absent in total  ';
                                                    $message .= $total_absent.' classes.';
//                                                    $message .= round($gAbsent,2).'% classes.';
                                                    
                                                  
                                                    
                                                    return $message;
                                                    
                                                   else:
                                                       
                                                       
                                                      return 'null';
                                       endif;
                                   endif;
                    else:
                        return 'null';
                
                   endif;
            
            
 }
    public function get_student_attendance($studentId,$sectionId){
        error_reporting(0);
//            $studentId = '12078';
//            $sectionId = '187';
//            $studentId = $this->uri->segment(2);
//            $sectionId = $this->uri->segment(3);
                        $this->db->join("sections",'sections.sec_id=class_alloted.sec_id');
            $CheckStd = $this->db->get_where('class_alloted',array('sections.sec_id'=>$sectionId,'sections.status'=>'On'))->row();
             
            if(!empty($CheckStd)):
              
            $class_id   =  $CheckStd->class_id;
            $flag       =  $CheckStd->flag;
         
            //flag == 1 group_allot
            //flag == 2 subject allot
            if($CheckStd->flag==1):
               $result           = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$studentId,'student_group_allotment.section_id'=>$sectionId)); 
                 
                else:
                    
                $result           = $this->ReportsModel->get_whiteCard_section(
                        array(
                            'student_subject_alloted.student_id'=>$studentId,
                            'student_subject_alloted.section_id'=>$sectionId
                        )); 
            endif;
         
            
                if($flag ==1):
                    $classSubjects = $this->ReportsModel->get_classSubjects(array('sec_id'=>$sectionId));
                endif;
                 if($flag == 2):
                     $classSubjects = $this->ReportsModel->get_subject_list('student_subject_alloted',array('student_id'=>$result->student_id));
                endif;
            
                
                $fy_id = $this->db->get_where('whitecard_financial_year',array('status'=>1))->row();
                $time = strtotime($fy_id->year_start);
                    
                if($classSubjects):
                                        $netPresent = '';
                                        $netTotal   = '';
                                        foreach($classSubjects as $rowCS):
                                         $GrandTotal = 0;
                                         $granPresent = 0;
                                        
                                        for($i=1;$i<=12;$i++):

                                                $monthi     = '+'.$i.'month';
                                                $month      = date("m", strtotime($monthi, $time));
                                                $year       = date("Y", strtotime($monthi, $time));
                                                    $where = array(
                                                        'subject_id'                => $rowCS->subject_id,
                                                        'sec_id'                    => $sectionId,
                                                        'student_id'                =>$result->student_id,
                                                        'month(attendance_date)'    =>$month,
                                                        'year(attendance_date)'     =>$year,
                                                    );
                                            $stdAtts = $this->ReportsModel->get_student_att($where);
                                          
                                               $p=0;
                                                $a=0;
                                            foreach($stdAtts as $stdAtt):
                                              
                                            if($stdAtt->status == 1):
                                                if($stdAtt->ca_classcount ==2):
                                                        $p++;
                                                        $p++;
                                                    else:
                                                        $p++;
                                                endif;
                                                else:
                                                   if($stdAtt->ca_classcount ==2):
                                                        $a++;
                                                        $a++;
                                                    else:
                                                        $a++;
                                                endif;
                                            
                                            endif;
                                          endforeach;
                                          
                                           $total = $a+$p;
                                          
                                        $granPresent += $p; 
                                         $GrandTotal += $total;
                                        $per =0; 
                                         if($GrandTotal):
                                          $per = ($granPresent/$GrandTotal)*100;
                                             
                                         endif;
                                          
                                             
                                            endfor;
                                            $netPresent += $granPresent;
                                            $netTotal += $GrandTotal;
                                     
                                        endforeach;
                                         
                                        $montylyPresentGrand    = '';
                                        $montylyApsentGrand     = '';
                                        for($i=1;$i<=12;$i++):
                                                $monthi     = '+'.$i.'month';
                                                $month      = date("m", strtotime($monthi, $time));
                                                $year       = date("Y", strtotime($monthi, $time));
                                                $wheret = array(
//                                                        'subject_id'                => $rowCS->subject_id,
                                                        'sec_id'                    => $sectionId,
                                                        'student_id'                =>$result->student_id,
                                                        'month(attendance_date)'    =>$month,
                                                        'year(attendance_date)'     =>$year,
                                                    );
                                            $stdAttst = $this->ReportsModel->get_student_att($wheret);
                                            
                                                    $tp='';
                                                    $ta='';
                                                    $pert='';
                                                    $montylyPresent = '';
                                                
                                            $MontlyGrandTotal = '';
                                             foreach($stdAttst as $stdAtt):
                                              
                                            if($stdAtt->status == 1):
                                                if($stdAtt->ca_classcount ==2):
                                                        $tp++;
                                                        $tp++;
                                                    else:
                                                        $tp++;
                                                endif;
                                                else:
                                                   if($stdAtt->ca_classcount ==2):
                                                        $ta++;
                                                        $ta++;
                                                    else:
                                                        $ta++;
                                                endif;
                                            
                                            endif;
                                          endforeach;
                                          
                                            $total = $ta+$tp;
                                          
                                          if($total):
                                              
                                          $tp.'/'.$total;
                                         endif;
                                    
                                       $montylyPresentGrand =   $montylyPresent += $tp; 
                                      $montylyApsentGrand =  $MontlyGrandTotal += $total;
                                       $per =0; 
                                    if($MontlyGrandTotal):
                                         $pert = ($montylyPresent/$MontlyGrandTotal)*100;

                                        endif;
                                     
                                    endfor;
                                        $gPresent   = '';
                                        $gAbsent    = '';
                                        $message    = '';
                                        
                                       if($netPresent):
                                                     
                                           
//                                                    $gPresent       = $netPresent;
                                                     $gPresent       = ($netPresent/$netTotal)*100;
//                                                    $total_absent   =   $netTotal-$netPresent;
                                                    return round($gPresent,2);
//                                                    $gAbsent = ($total_absent/$netTotal)*100;

                                                 


                                                    
//                                                    $message .= $total_absent;
//                                                    $message .= round($gAbsent,2).'% classes.';
                                                    
                                                  
                                                    
//                                                    return $message;
                                                    
                                                   else:
                                                       
                                                       
                                                      return '0';
                                       endif;
                                   endif;
                    else:
                        return '0';
                
                   endif;
 }
 
  public function get_student_montly_marks($student_id,$section_id){
     
     
                        $this->db->join("sections",'sections.sec_id=class_alloted.sec_id');
            $CheckStd = $this->db->get_where('class_alloted',array('sections.sec_id'=>$section_id,'sections.status'=>'On'))->row();
             
            if(!empty($CheckStd)):
            $class_id   =  $CheckStd->class_id;
            $flag       =  $CheckStd->flag;
         
            //flag == 1 group_allot
            //flag == 2 subject allot
            if($CheckStd->flag==1):
               $result           = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$student_id,'student_group_allotment.section_id'=>$section_id)); 
                 
                else:
                    
                $result           = $this->ReportsModel->get_whiteCard_section(
                        array(
                            'student_subject_alloted.student_id'=>$student_id,
                            'student_subject_alloted.section_id'=>$section_id
                        )); 
            endif;
         
            
                if($flag ==1):
                    $classSubjects = $this->ReportsModel->get_classSubjects(array('sec_id'=>$section_id));
                endif;
                 if($flag == 2):
                     $classSubjects = $this->ReportsModel->get_subject_list('student_subject_alloted',array('student_id'=>$result->student_id));
                endif;
            
                
                $fy_id = $this->db->get_where('whitecard_financial_year',array('status'=>1))->row();
                $time = strtotime($fy_id->year_start);
                    
                if($classSubjects):
            $month      = date("m", strtotime($monthi, $time));
            $year       = date("Y", strtotime($monthi, $time));

            foreach($classSubjects as $rowCS):
                $totalOb = '';
                $totaltm = '';
             
             for($i=1;$i<=12;$i++):
                    $monthi     = '+'.$i.'month';
                    $month      = date("m", strtotime($monthi,$time));
                    $year       = date("Y", strtotime($monthi,$time));
                     $where     = array(
                        'class_alloted.subject_id'=>$rowCS->subject_id,
                        'monthly_test_details.student_id'=>$result->student_id,
                        'month(test_date)'=>$month,
                        'year(test_date)'=>$year,

                     );
                        $testRes1 = $this->ReportsModel->get_test_marks($where);

                        if(!empty($testRes1->omarks)):

                        
                            $totalOb += $testRes1->omarks;
                            $totaltm += $testRes1->tmarks;
                         



                      endif;


             endfor;
 
            endforeach;
 
                $TMOMG = '';
                $TMTMG = '';
            for($i=1;$i<=12;$i++):
                    $monthi     = '+'.$i.'month';
                    $month      = date("m", strtotime($monthi, $time));
                    $year       = date("Y", strtotime($monthi, $time));
                    $where     = array(
//                                                    'class_alloted.subject_id'=>$rowCS->subject_id,
                        'monthly_test_details.student_id'=>$result->student_id,
                        'month(test_date)'=>$month,
                        'year(test_date)'=>$year,

                     );
                        $TMQ = $this->ReportsModel->get_test_marks_result($where);
                   $TMOM = '';
                   $TMTM = '';
                     foreach($TMQ as $TMQRow):
                          $TMOM +=$TMQRow->omarks;
                          $TMTM += $TMQRow->tmarks;
                     endforeach;
              
                         $TMOMG +=   $TMOM ;
                         $TMTMG +=   $TMTM ;

           endfor;

           if($TMTMG):
                   $TMG_PER = ($TMOMG/$TMTMG)*100;       
//                    echo '<td><strong>'.$TMOMG.'/'.$TMTMG.'='.round($TMG_PER,1).'</strong></td>';
                return round($TMG_PER,2);
               else:
               return 0;
           endif;

       echo '</tr>';


        endif;
                    else:
                        return '0';
                
                   endif;
 }
      public function get_student_attendance_details($studentId,$sectionId){
//            error_reporting(0);
            
                        $this->db->join("sections",'sections.sec_id=class_alloted.sec_id');
            $CheckStd = $this->db->get_where('class_alloted',array('sections.sec_id'=>$sectionId,'sections.status'=>'On'))->row();
            $return_array = array();
        if(!empty($CheckStd)):
              
            $class_id   =  $CheckStd->class_id;
            $flag       =  $CheckStd->flag;
         
            //flag == 1 group_allot
            //flag == 2 subject allot
            if($CheckStd->flag==1):
                $result = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$studentId,'student_group_allotment.section_id'=>$sectionId)); 
            else:
                $result = $this->ReportsModel->get_whiteCard_section(array('student_subject_alloted.student_id'=>$studentId,'student_subject_alloted.section_id'=>$sectionId)); 
            endif;
            if($flag ==1):
                $classSubjects = $this->ReportsModel->get_classSubjects(array('sec_id'=>$sectionId));
            endif;
            if($flag == 2):
                $classSubjects = $this->ReportsModel->get_subject_list('student_subject_alloted',array('student_id'=>$result->student_id));
            endif;
                $fy_id = $this->db->get_where('whitecard_financial_year',array('status'=>1))->row();
                $time = strtotime($fy_id->year_start);
            if($classSubjects):
                $netPresent = '';
                $netTotal   = '';
                foreach($classSubjects as $rowCS):
                    $GrandTotal = 0;
                    $granPresent = 0;
                    for($i=1;$i<=12;$i++):
                        $monthi     = '+'.$i.'month';
                        $month      = date("m", strtotime($monthi, $time));
                        $year       = date("Y", strtotime($monthi, $time));
                            $where = array(
                                'subject_id'                => $rowCS->subject_id,
                                'sec_id'                    => $sectionId,
                                'student_id'                =>$result->student_id,
                                'month(attendance_date)'    =>$month,
                                'year(attendance_date)'     =>$year,
                            );
                        $stdAtts = $this->ReportsModel->get_student_att($where);

                        $p=0;
                        $a=0;
                        foreach($stdAtts as $stdAtt):
                            if($stdAtt->status == 1):
                                if($stdAtt->ca_classcount ==2):
                                    $p++;
                                    $p++;
                                else:
                                    $p++;
                                endif;
                            else:
                                if($stdAtt->ca_classcount ==2):
                                    $a++;
                                    $a++;
                                else:
                                    $a++;
                                endif;
                            endif;
                        endforeach;
                        $total = $a+$p;

                        $granPresent    += $p; 
                        $GrandTotal     += $total;
                        $per            =0; 
                        if($GrandTotal):
                          $per = ($granPresent/$GrandTotal)*100;
                        endif;
                    endfor;
                    $netPresent += $granPresent;
                    $netTotal += $GrandTotal;

                endforeach;
                    $montylyPresentGrand    = '';
                    $montylyApsentGrand     = '';
                    for($i=1;$i<=12;$i++):
                            $monthi     = '+'.$i.'month';
                            $month      = date("m", strtotime($monthi, $time));
                            $year       = date("Y", strtotime($monthi, $time));
                            $wheret = array(
//                                                        'subject_id'                => $rowCS->subject_id,
                                    'sec_id'                    => $sectionId,
                                    'student_id'                =>$result->student_id,
                                    'month(attendance_date)'    =>$month,
                                    'year(attendance_date)'     =>$year,
                                );
                        $stdAttst = $this->ReportsModel->get_student_att($wheret);

                                $tp='';
                                $ta='';
                                $pert='';
                                $montylyPresent = '';

                        $MontlyGrandTotal = '';
                         foreach($stdAttst as $stdAtt):

                        if($stdAtt->status == 1):
                            if($stdAtt->ca_classcount ==2):
                                    $tp++;
                                    $tp++;
                                else:
                                    $tp++;
                            endif;
                            else:
                               if($stdAtt->ca_classcount ==2):
                                    $ta++;
                                    $ta++;
                                else:
                                    $ta++;
                            endif;

                        endif;
                      endforeach;

                        $total = $ta+$tp;

                      if($total):

                      $tp.'/'.$total;
                     endif;

                   $montylyPresentGrand =   $montylyPresent += $tp; 
                  $montylyApsentGrand =  $MontlyGrandTotal += $total;
                   $per =0; 
                if($MontlyGrandTotal):
                     $pert = ($montylyPresent/$MontlyGrandTotal)*100;

                    endif;

                    endfor;
                    $gPresent   = '';
                    $gAbsent    = '';
                    $message    = '';
                    
                    if($netPresent):
                        $gPresent                   = ($netPresent/$netTotal)*100;
//                        $return_array = $netPresent.','.$netTotal-$netPresent.','.$netTotal.','.round($gPresent,2);
                      
                        $return_array['Present']    = $netPresent;
                        $return_array['Absent']     = $netTotal-$netPresent;
                        $return_array['Total']      = $netTotal;
                        $return_array['Persantage'] = round($gPresent,2);
                    else:
                         
                        $return_array['Present']    = '0';
                        $return_array['Absent']     = '0';
                        $return_array['Total']      = '0';
                        $return_array['Persantage'] = '0';
                   endif;
            endif;
        else:
                           
                        $return_array['Present']    = '0';
                        $return_array['Absent']     = '0';
                        $return_array['Total']      = '0';
                        $return_array['Persantage'] = '0';
        endif;
       
        return json_decode(json_encode($return_array), FALSE);
 }
  public function get_student_montly_marks_details($student_id,$section_id){
     
     
                        $this->db->join("sections",'sections.sec_id=class_alloted.sec_id');
            $CheckStd = $this->db->get_where('class_alloted',array('sections.sec_id'=>$section_id,'sections.status'=>'On'))->row();
             $return_array = array();
            if(!empty($CheckStd)):
            $class_id   =  $CheckStd->class_id;
            $flag       =  $CheckStd->flag;
         
            //flag == 1 group_allot
            //flag == 2 subject allot
            if($CheckStd->flag==1):
               $result           = $this->ReportsModel->get_whiteCard_subject(array('student_group_allotment.student_id'=>$student_id,'student_group_allotment.section_id'=>$section_id)); 
                 
            else:
                    
                $result           = $this->ReportsModel->get_whiteCard_section(
                        array(
                            'student_subject_alloted.student_id'=>$student_id,
                            'student_subject_alloted.section_id'=>$section_id
                        )); 
            endif;
         
            
                if($flag ==1):
                    $classSubjects = $this->ReportsModel->get_classSubjects(array('sec_id'=>$section_id));
                endif;
                 if($flag == 2):
                     $classSubjects = $this->ReportsModel->get_subject_list('student_subject_alloted',array('student_id'=>$result->student_id));
                endif;
            
                
                $fy_id = $this->db->get_where('whitecard_financial_year',array('status'=>1))->row();
                $time = strtotime($fy_id->year_start);
                    
                if($classSubjects):
//            $month      = date("m", strtotime($monthi, $time));
//            $year       = date("Y", strtotime($monthi, $time));

            foreach($classSubjects as $rowCS):
                $totalOb = '';
                $totaltm = '';
             
            for($i=1;$i<=12;$i++):
                    $monthi     = '+'.$i.'month';
                    $month      = date("m", strtotime($monthi,$time));
                    $year       = date("Y", strtotime($monthi,$time));
                     $where     = array(
                        'class_alloted.subject_id'=>$rowCS->subject_id,
                        'monthly_test_details.student_id'=>$result->student_id,
                        'month(test_date)'=>$month,
                        'year(test_date)'=>$year,

                     );
                        $testRes1 = $this->ReportsModel->get_test_marks($where);

                        if(!empty($testRes1->omarks)):

                        
                            $totalOb += $testRes1->omarks;
                            $totaltm += $testRes1->tmarks;
                        endif;
            endfor;
 
            endforeach;
 
                $TMOMG = '';
                $TMTMG = '';
            for($i=1;$i<=12;$i++):
                    $monthi     = '+'.$i.'month';
                    $month      = date("m", strtotime($monthi, $time));
                    $year       = date("Y", strtotime($monthi, $time));
                    $where     = array(
//                                                    'class_alloted.subject_id'=>$rowCS->subject_id,
                        'monthly_test_details.student_id'=>$result->student_id,
                        'month(test_date)'=>$month,
                        'year(test_date)'=>$year,

                     );
                        $TMQ = $this->ReportsModel->get_test_marks_result($where);
                   $TMOM = '';
                   $TMTM = '';
                     foreach($TMQ as $TMQRow):
                          $TMOM +=$TMQRow->omarks;
                          $TMTM += $TMQRow->tmarks;
                     endforeach;
              
                         $TMOMG +=   $TMOM ;
                         $TMTMG +=   $TMTM ;

           endfor;

           if($TMTMG):
                   $TMG_PER = ($TMOMG/$TMTMG)*100;  
                    $return_array['TotalObtainedMarks'] = $TMOMG; 
                    $return_array['TotalMarks']          = $TMTMG; 
                    $return_array['Percentage']         = round($TMG_PER,2); 
//                    echo '<td><strong>'.$TMOMG.'/'.$TMTMG.'='.round($TMG_PER,1).'</strong></td>';
//                return round($TMG_PER,2);
               else:
                    $return_array['TotalObtainedMarks']     = '0'; 
                    $return_array['TotalMarks']             = '0'; 
                    $return_array['Percentage']            = '0';
           endif;

       echo '</tr>';
                endif;
                else:
            $return_array['TotalObtainedMarks']     = '0'; 
            $return_array['TotalMarks']             = '0'; 
            $return_array['Percentage']            = '0';       

               endif;
    
    return json_decode(json_encode($return_array), FALSE);
                   
 }
     //get results requ: tableName,wherein
    public function get_wherein_result($table,$column,$where){
        $query =$this->db->SELECT('*')
                         ->FROM($table)
                         ->where_in($column, $where)
                         ->get();
            return $query->result();
   }
     function dropDown_where_in_asc_title($table, $option=NULL, $value,$show,$column=NULL,$array=NULL,$where=NULL)
	{
            
                $this->db->where_in($column,$array);
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
				$data[$row->$value] = $row->$show;
			}
			return $data;
		}
	} 
        
        function dropDownLimit($table, $option=NULL, $value,$show,$where=NULL,$order=NULL, $limit=NULL){
		
                if($where):
                    $this->db->where($where);
                endif;
                  if($order):
                    $this->db->order_by($order['column'],$order['order']);
                endif;
//                 $this->db->order_by($show,'asc');
                if($limit):
                    $this->db->limit($limit);
                endif;
                
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show;
			}
			return $data;
		}
	} 
        function dropDown_where_in_desc_id($table, $option=NULL, $value,$show,$column=NULL,$array=NULL,$where=NULL)
	{
            
                $this->db->where_in($column,$array);
                if($where):
                   $this->db->where($where); 
                endif;
                
                $this->db->order_by($value,'desc');
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show;
			}
			return $data;
		}
	} 
            public function get_where_not_in_result_order($table,$where, $array,$custom){
        $query =$this->db->SELECT('*')
                        ->FROM($table)
                        ->order_by($custom['column'],$custom['order'])
                        ->where_not_in($where, $array)
                        ->get();
            return $query->result();
   }
       
    //get results requ: tableName,where
    public function get_where_row_order($table,$where=NULL,$custom){
            $this->db->SELECT('*'); 
            $this->db->FROM($table);
            $this->db->order_by($custom['column'],$custom['order']);
            if($where):
                $this->db->where($where);
            endif;
            
            $query =$this->db->get();
            return $query->row();
   }
   function dropDown_where_in_asc_id($table, $option=NULL, $value,$show,$column=NULL,$array=NULL,$where=NULL)
	{
            
                $this->db->where_in($column,$array);
                if($where):
                   $this->db->where($where); 
                endif;
                
                $this->db->order_by($value,'asc');
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show;
			}
			return $data;
		}
	} 
        
    public function get_ms_info($where=NULL){
        
        $this->db->SELECT('
            min_sheet.msr_id,
            min_sheet.msr_diary_no,
            min_sheet.msr_detail,
            min_sheet.msr_cost,
            min_sheet.msr_curr_status,
            min_sheet.msr_date,
            hr_emp_record.emp_name,
            department.title as deptt_name
        ');
        $this->db->FROM('min_sheet');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=min_sheet.msr_emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $this->db->order_by('msr_id', 'desc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_ms_info_where_in($where=NULL, $column, $array){
        
        $this->db->SELECT('
            min_sheet.msr_id,
            min_sheet.msr_diary_no,
            min_sheet.msr_detail,
            min_sheet.msr_cost,
            min_sheet.msr_curr_status,
            min_sheet.msr_date,
            hr_emp_record.emp_name,
            department.title as deptt_name
        ');
        $this->db->FROM('min_sheet');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=min_sheet.msr_emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $this->db->where_in($column, $array);
        $this->db->order_by('msr_id', 'desc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    public function get_ms_detail_where_in($where=NULL, $column, $array){
        
        $this->db->SELECT('
            min_sheet.msr_id,
            min_sheet.msr_diary_no,
            min_sheet.msr_detail,
            min_sheet.msr_cost,
            min_sheet.msr_curr_status,
            min_sheet.msr_date,
            hr_emp_record.emp_name,
            department.title as deptt_name
        ');
        $this->db->FROM('min_sheet');
        $this->db->join('min_sheet_details','min_sheet_details.msd_msr_id=min_sheet.msr_id', 'left outer');
        $this->db->join('hr_emp_record','hr_emp_record.emp_id=min_sheet.msr_emp_id', 'left outer');
        $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
        if($where):
            $this->db->where($where);
        endif;
        $this->db->where_in($column, $array);
        $this->db->order_by('msr_id', 'desc');
        $query =  $this->db->get();
        if($query):
            return $query->result();
        endif;
    }
    
    function merge_DropDown($table, $option=NULL,$value,$show,$where=NULL,$column=NULL,$where_in=NULL){
        $this->db->select('*');
       // $this->db->distinct();
        if($where):
            $this->db->where($where);
        endif;

        if($where_in):
            $this->db->where_in($column,$where_in);
        endif;

        $query = $this->db->get($table);
//         echo '<pre>'; print_r($query->result()); die;
        if($query->num_rows() > 0) 
        {
            if($option):
                $data[''] = $option;
            endif;
            
                foreach($query->result() as $row){
                    $check =$this->db->get_where('class_alloted', array('ca_merge_id' => $row->camg_id))->row();
//                    echo '<pre>'; print_r($check); die;
                    if(empty($check)):
                    $data[$row->$value] = $row->$show;
                    endif;
                }
                return $data;
        }
    } 
 function subwords( $str, $max = 24, $char = ' ', $end = '...' ) {
    $str = trim( $str ) ;
    $str = $str . $char ;
    $len = strlen( $str ) ;
    $words = '' ;
    $w = '' ;
    $c = 0 ;
    for ( $i = 0; $i < $len; $i++ )
        if ( $str[$i] != $char )
            $w = $w . $str[$i] ;
        else
            if ( ( $w != $char ) and ( $w != '' ) ) {
                $words .= $w . $char ;
                $c++ ;
                if ( $c >= $max ) {
                    break ;
                }
                $w = '' ;
            }
    if ( $i+1 >= $len ) {
        $end = '' ;
    }
    return trim( $words ) . $end ;
}   

    function numtowords($num){ 
        
        $decones = array( 
            '01' => "One", 
            '02' => "Two", 
            '03' => "Three", 
            '04' => "Four", 
            '05' => "Five", 
            '06' => "Six", 
            '07' => "Seven", 
            '08' => "Eight", 
            '09' => "Nine", 
            10 => "Ten", 
            11 => "Eleven", 
            12 => "Twelve", 
            13 => "Thirteen", 
            14 => "Fourteen", 
            15 => "Fifteen", 
            16 => "Sixteen", 
            17 => "Seventeen", 
            18 => "Eighteen", 
            19 => "Nineteen" 
        );
        $ones = array( 
            0 => "Zero",
            1 => "One",     
            2 => "Two", 
            3 => "Three", 
            4 => "Four", 
            5 => "Five", 
            6 => "Six", 
            7 => "Seven", 
            8 => "Eight", 
            9 => "Nine", 
            10 => "Ten", 
            11 => "Eleven", 
            12 => "Twelve", 
            13 => "Thirteen", 
            14 => "Fourteen", 
            15 => "Fifteen", 
            16 => "Sixteen", 
            17 => "Seventeen", 
            18 => "Eighteen", 
            19 => "Nineteen" 
        ); 
        $tens = array( 
            0 => "",
            2 => "Twenty", 
            3 => "Thirty", 
            4 => "Forty", 
            5 => "Fifty", 
            6 => "Sixty", 
            7 => "Seventy", 
            8 => "Eighty", 
            9 => "Ninety" 
        ); 
        $hundreds = array( 
            "Hundred", 
            "Thousand", 
            "Million", 
            "Billion", 
            "Trillion", 
            "Quadrillion" 
        ); //limit t quadrillion 
        
        $num = number_format($num,2,".",","); 
        $num_arr = explode(".",$num); 
        $wholenum = $num_arr[0]; 
        $decnum = $num_arr[1]; 
        $whole_arr = array_reverse(explode(",",$wholenum)); 
        krsort($whole_arr); 
        $rettxt = ""; 
        
        foreach($whole_arr as $key => $i){ 
            if($i < 20){ 
                $rettxt .= $ones[$i]; 
            }
            elseif($i < 100){ 
                $rettxt .= $tens[substr($i,0,1)]; 
                $rettxt .= " ".$ones[substr($i,1,1)]; 
            }
            else{ 
                $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
                $rettxt .= " ".$tens[substr($i,1,1)]; 
                $rettxt .= " ".$ones[substr($i,2,1)]; 
            } 
            if($key > 0){ 
                $rettxt .= " ".$hundreds[$key]." "; 
            } 
        } 

        if($decnum > 0){ 
            $rettxt .= " Point "; 
            if($decnum < 20){ 
                $rettxt .= $decones[$decnum]; 
            }
            elseif($decnum < 100){ 
                $rettxt .= $tens[substr($decnum,0,1)]; 
                $rettxt .= " ".$ones[substr($decnum,1,1)]; 
            }
        } 
        return $rettxt;
        
    }
    public function date_convert($date,$format=NULL){
        
        //if date null,0000 or 1970 then return empty
        if($date === '0000-00-00' || $date == '1970-01-01' || $date == ''|| $date == '--'):
             return '';
        else:
            $cvrtdate =  new DateTime($date);
                if($format):
                    return $cvrtdate->format($format);     
                else:
                    return  $cvrtdate->format('d-m-Y');     
            endif;      
        endif;      
         
        
        
                                              
        
    }
    
     
}
