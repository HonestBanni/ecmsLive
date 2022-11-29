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
            <h2 align="left">Students Comulative Monthly Marks <hr></h2>
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
         <input type="submit" name="search_sub" class="btn btn-theme" value="Submit">
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
                            <th>Total Test</th>
                            <th>Obtained Marks</th>
                            <th>Total Marks</th>
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
            $s = 1;
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
            $this->db->join('monthly_test','monthly_test.class_id=class_alloted.class_id');
            $this->db->join('monthly_test_details','monthly_test_details.test_id=monthly_test.test_id');
            $q = $this->db->where($where)->get()->result();              
            $count_tm = "";
            $count_om  = ""; 
            ?>
            <td><?php echo count($q);?></td>
            <td>        
            <?php        
            foreach($q as $qrow):
                $count_tm += $qrow->tmarks;        
                $count_om += $qrow->omarks;        
            endforeach;  
              $insert[] = array(
              'emp_id'=>$rec->emp_id,  
              'sec_id'=>$sec_id,  
              'subject_id'=>$subject_id,  
              'sub_pro_id'=>$sub_pro_id,  
              'student_id'=>$row->student_id,        
              'total_test'=>count($q),        
              'omarks'=>$count_om,        
              'tmarks'=>$count_tm
                  );
                echo $count_om;        
                  ?></td>
            <td><?php echo $count_tm;?></td>        
                 </tr>                
            <?php
            $i++;
            endforeach;
        }
            ?>
                    </tbody>
                </table>
                 </div>
                  <?php endif;
                
                    
                    ?>  
                    </form>  
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   