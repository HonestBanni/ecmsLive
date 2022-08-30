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
            <div class="page-wrapper">
            <header class="page-heading clearfix">
                  <h1 class="heading-title pull-left">View Test Marks List</h1>
                </header>
            </div>
            <div class="row cols-wrapper">
                <div class="col-md-12">  
                     <?php $id = $this->uri->segment(3)?>   
<!--
                <form method="post" action="AttendanceController/view_test_marks_list/<?php echo $id;?>">  
            <input type="submit" name="export" value="export In Excel" class="btn btn-theme">
            <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>            
                </form>        
-->
    <?php 
        $ex_id      = $this->uri->segment(3);
        $emp_id     = $this->uri->segment(4);
        $subject_id = $this->uri->segment(5);
        $sec_id     = $this->uri->segment(6);
        
         $total = $this->db->query("SELECT * FROM exams_bs_details WHERE exbd_test_id = '$ex_id'");?>
                    <div id="div_print">
                        <h4><strong>Teacher: <?php echo $empRecord->emp_name;?>,&nbsp; Section: <?php echo $section->name;?>,&nbsp; Subject: <?php echo $subject->title;?>  ,&nbsp; Exam Type: <?php echo $test->xt_title;?>   
                    </strong>, [<strong>Total Student: <?php  echo $total->num_rows(); ?></strong>]</h4>    
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Student Picture</th>
                            <th>College No</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>Obt-Marks</th>
                            <th>T-Marks</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $inc = 0;
                        foreach($result as $rec):
                            $inc++;
                            echo '<tr class="gradeA">
                            <td>'.$inc.'</td>
                            <td><img src="assets/images/students/'.$rec->applicant_image.'" width="60" height="50"></td>
                            <td>'.$rec->college_no.'</td>
                            <td>'.$rec->student_name.'</td>
                            <td>'.$rec->father_name.'</td>';
                            
                                         $this->db->join('exams_bs', 'exams_bs.exb_test_id=exams_bs_details.exbd_test_id', 'left outer');
                            $marks_dtl = $this->db->get_where('exams_bs_details', array('exbd_test_id' => $ex_id, 'exbd_student_id' => $rec->student_id))->row();
                            
                            if(!empty($marks_dtl)):
                                echo '<td>'.$marks_dtl->exbd_omarks.'</td>
                                <td>'.$marks_dtl->exb_test_marks.'</td>   
                                <td><a href="AttendanceController/update_exam_marks/'.$marks_dtl->exbd_serial_no.'/'.$ex_id.'/'.$emp_id.'/'.$subject_id.'/'.$sec_id.'" class="btn btn-theme btn-sm">Update</a></td> ';
                            else:
                                echo '<td></td>
                                <td></td>
                                <td><a href="AttendanceController/add_new_enrolled_exam_marks/'.$ex_id.'/'.$emp_id.'/'.$subject_id.'/'.$sec_id.'/'.$rec->student_id.'" class="btn btn-primary btn-sm">Add Marks</a></td>';
                            endif;  
                        endforeach;
                        ?>
                    </tbody>
                </table>
                    </div>  
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   