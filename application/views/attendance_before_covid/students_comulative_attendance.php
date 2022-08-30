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
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Students Comulative Attendance <hr></h2>
            <h3 style="color: red;"><strong>Note:</strong></h3><p style="color: red;"><strong>1. Please update Finance Department before starting Cumulative Attendance.<br>
                2. Also update students Promotion Date History page. </strong></p><hr>
            <div class="row cols-wrapper">
            <div class="col-md-12">    
                <form method="post">
                    
            <div class="form-group col-md-2">
                <?php
                    
                    if(!empty($sec_id)){
                        $secres = $this->AttendanceModel->get_by_id('sections',array('sec_id'=>$sec_id));
                        foreach($secres as $secrec)
                        { ?>          
            <input type="text" name="sec_id" value="<?php echo $secrec->name; ?>" placeholder="Section" class="form-control" id="sec">
                        <input type="hidden" name="sec_id" id="sec_id" value="<?php echo $secrec->sec_id; ?>">      
                        <?php 
                        }     
                    }else{?>
                    <input type="text" name="sec_id" placeholder="Section" class="form-control" id="sec">
                            <input type="hidden" name="sec_id" id="sec_id">    
                        <?php
                        }    
                    ?>                  
            </div>
                    
            <div class="form-group col-md-2">
                   <input type="text" name="end_date" value="<?php echo date('d-m-Y');?>" class="form-control date_format_d_m_yy">           
            </div>
         <input type="submit" name="search" class="btn btn-theme" value="Search">
         <input type="submit" name="search_submit" class="btn btn-theme" value="Submit">
        <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>            
                </form>
            </div>
        </div>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                     <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                     </h4>
                    <?php
                    if(@$result):
                    ?>
             <form method="post"> 
        <div id="div_print">
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Student</th>
                            <th>Total Attendance</th>
                            <th>Present</th>
                            <th>Absent</th>
                            <th>Leave</th>
                       </tr> 
                    </thead>
                    <tbody>
            <?php
        $insert = array();      
       // echo '<pre>';print_r($result); die;                
        foreach($result as $rec)  
        {
            $sec_id = $rec->sec_id;  
            $subject_id = $rec->subject_id;
            $sub_pro_id = $rec->sub_pro_id;
            $flag = $rec->flag;
            $start_date = date('Y-m-d', strtotime($rec->timestamp));
            if($flag == 1):
                $where = array('section_id'=>$sec_id);
                $this->db->select('*');
                $this->db->from('student_group_allotment');
                $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id', 'left outer');
                $this->db->where($where);
                $this->db->where('student_record.s_status_id','5');
                $qry = $this->db->get();
            else:
            $where = array('section_id'=>$sec_id,'subject_id'=>$subject_id);
            $this->db->select('*');
            $this->db->from('student_subject_alloted');
            $this->db->join('student_record','student_record.student_id=student_subject_alloted.student_id', 'left outer');
            $this->db->where($where);
            $this->db->where('student_record.s_status_id','5');
            $qry = $this->db->get();
            endif;
            $s=1;
        ?>                        
        <tr style="color:red">               
            <td colspan="6">
                <strong style="margin-right:100px;margin-left:80px;">Employee Name: <?php echo $rec->employee;?></strong>
                <strong style="margin-right:100px;">Section Name: <?php echo $rec->section;?></strong>
                <strong>Subject Name: <?php echo $rec->subject;?></strong>
            </td>         
        </tr>                
        <?php  
            $i = 1;
            foreach($qry->result() as $row):
            ?>
                <tr>
                    <td><?php echo $i;?></td>   
                    <td><?php echo $row->student_name;?></td>
                    <?php  
                        $where = array(
                            'student_id'=>$row->student_id,
                            'class_alloted.class_id'=>$rec->class_id,
                        );
            $this->db->select('*');
            $this->db->from('class_alloted');
            $this->db->join('student_attendance','student_attendance.class_id=class_alloted.class_id');
    $this->db->join('student_attendance_details','student_attendance_details.attend_id=student_attendance.attend_id');
            $q = $this->db->where($where)->get()->result(); 
            $a = '';            
            $p = '';            
            $l = '';  
                ?>
            
        <td><?php echo count($q);?></td>        
           <td>             
            <?php                      
            foreach($q as $qrow):
                       
                if($qrow->status == 1):
                    $p++;
                endif;  
            if($qrow->status == 0):
                    $a++;
                endif;
            if($qrow->status == 2):
                    $l++;
                endif; 
            endforeach;  
              $insert[] = array(
              'emp_id'=>$rec->emp_id,  
              'sec_id'=>$sec_id,  
              'subject_id'=>$subject_id,  
              'sub_pro_id'=>$sub_pro_id,  
              'student_id'=>$row->student_id,        
              'total_attend'=>count($q),        
              'p_attend'=>$p,        
              'a_attend'=>$a,
              'l_attend'=>$l,
              'start_date'=>$start_date
                  );        
                   echo $p;     
                        ?></td>
                 
            <td><?php echo $a;?></td>        
            <td><?php echo $l;?></td>        
                 </tr>                
            <?php
        
            $i++;
            endforeach;
        }
            ?>
                    </tbody>
                </table>
             <?php
            endif;
?>                
      
                 </div>
                  </form>  
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   