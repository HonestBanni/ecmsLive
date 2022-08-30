<script language="javascript">
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
<style>
    .table
    {
        border: 2px solid #000;        
    }
    
    .row {
    margin-right: 0px !important;
    margin-left: 0px !important;
}
</style>
<?php
    if($result):
    foreach($result as $alumniRow):  
        ?> 
<!-- ******CONTENT****** --> 

        <div class="content container">
         <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button> 
            <h3>Student Green File<hr></h3>
            <div class="table-responsive">    
                 <div id="div_print">
            <div class="row cols-wrapper">
                 <div class="col-md-6">
                        <img style="margin-left:50px;" src="<?php echo base_url();?>assets/images/logo.png">
                </div>      
                <div class="col-md-5">
                    <table style="margin-left:50px; width:90%" class="table table-bordered">
                        <tr>
                            <td>College No</td>
                            <td><?php echo $alumniRow->college_no; ?></td>
                        </tr>
                        <tr>
                            <td>Board Reg No</td>
                            <td><?php echo $alumniRow->board_regno; ?></td>
                        </tr>
                        <tr>
                            <td>Uni Reg No</td>
                            <td><?php echo $alumniRow->uni_regno; ?></td>
                        </tr>
                    </table>
                </div>
                
            </div> 
    <div class="row cols-wrapper">
        <div class="col-md-12">        
    <form name="student" method="post"> 
        <table style="margin-left:50px; width:90%" class="table table-bordered">
            <tr>
                <td>Student Name</td>
                <td colspan="3"><?php echo $alumniRow->student_name; ?></td>
            </tr>
            <tr>
                <td>Father Name</td>
                <td colspan="3"><?php echo $alumniRow->father_name; ?></td>
            </tr>
            <tr>
                <td>Father Occupation</td>
                <td colspan="3"><?php echo $alumniRow->occupation; ?></td>
            </tr>
            <tr>
                <td>Religion</td>
                <td><?php echo $alumniRow->religion; ?></td>
                <td>Domicile</td>
                <td><?php echo $alumniRow->domicile; ?></td>
            </tr>
            <tr>
                <td>Date of  Birth</td>
                <td><?php 
                    if(date('d-M-Y',strtotime($alumniRow->dob)) != '01-Jan-1970'):
                        echo date('d-M-Y',strtotime($alumniRow->dob));
                    endif;
                 
              
                ?></td>
                <td>Sports</td>
                <td><?php echo $alumniRow->sports; ?></td>
            </tr>
            <tr>
                <td>Postal Address</td>
                <td colspan="3"><?php echo $alumniRow->app_postal_address; ?></td>
            </tr>
            <tr>
                <td>Phone Number 1:</td>
                <td><?php echo $alumniRow->mobile_no; ?></td>
                <td>Phone Number 2:</td>
                <td><?php echo $alumniRow->mobile_no2; ?></td>
            </tr>
            <tr>
                <td>Hostel Scholar:</td>
                <td><?php echo $alumniRow->hostel_required; ?></td>
                 <?php
                    if($limit_records):
                    foreach($limit_records as $slimitRow):  
                ?>
                <td>Previous Institute:</td>
                <td><?php echo $slimitRow->inst_id; ?></td>
            </tr>
            <tr>
                <td>Examination Passed:</td>
                <td><?php echo $slimitRow->Degreetitle; ?></td>
                <td>Board/University</td>
                <td><?php echo $slimitRow->boardTitle; ?></td>
            </tr>
            <tr>
                <td>Year:</td>
                <td><?php echo $slimitRow->year_of_passing; ?></td>
                <td>Roll No:</td>
                <td><?php echo $slimitRow->rollno; ?></td>
            </tr>
            <tr>
                <td>Admitted to the:</td>
                <td><?php echo $alumniRow->sub_program; ?></td>
                <td>Admission Date:</td>
                <td><?php 
                 
//                echo date_format($date,"d-M-Y");
                 if(date('d-M-Y',strtotime($alumniRow->admission_date)) != '01-Jan-1970'):
                   echo date('d-M-Y',strtotime($alumniRow->admission_date));
                endif;
                
                  ?></td>
            </tr>
            <tr>
                <td>Marks:</td>
                <td><?php echo $slimitRow->total_marks; ?>/<?php echo $slimitRow->obtained_marks; ?></td>
                <td>Grade:</td>
                <td><?php echo $slimitRow->grade_name; ?></td>
            </tr>
            <tr>
                <td>Remarks 1:</td>
                <td colspan="3"><?php echo $alumniRow->remarks; ?></td>
            </tr>
            <tr>
                <td>Remarks 2:</td>
                <td colspan="3"><?php echo $alumniRow->remarks2; ?></td>
            </tr>
        </table>
        <table style="margin-left:50px; width:90%" class="table table-bordered">
            <?php
                if($student_records):
                foreach($student_records as $eRow):
                ?>
        <tr>
            <td><?php echo $eRow->sub_program; ?></td>
            <td>Annual Examination: <?php echo $eRow->year_of_passing; ?>, Roll No: <?php echo $eRow->rollno;?></td>
            <td>Marks: <?php echo $eRow->obtained_marks;?>/<?php echo $eRow->total_marks; ?></td>
                <td>Grade: <?php echo $eRow->grade; ?></td>
        </tr>
            <?php
                endforeach;                    
                endif;
                ?>
        </table>
        <table style="margin-left:50px; width:90%" class="table table-bordered">
        <tr>
            <td>Original Certificate Issue On:  <?php 
            
            
              if(date('d-M-Y',strtotime($alumniRow->certificate_issue_date)) != '01-Jan-1970'):
                   echo date('d-M-Y',strtotime($alumniRow->certificate_issue_date));
                endif;
            
            
//            
//            $issue_date = $alumniRow->certificate_issue_date;
//            if($issue_date == "0000-00-00")
//            {
//            echo "";
//            }  else {
//                
//                  $date=date_create($issue_date);
//                echo date_format($date,"d-M-Y");
//                
//            
//            }
            ?></td>
            <td>CNIC No: <?php echo $alumniRow->student_cnic; ?></td>
        </tr>
        </table>
        
</div>
<?php
  endforeach;
   endif;
        ?>                         
<br><br>
   <?php
          endforeach;
          echo $print_log;
           endif;
                        ?>
         
                        </div>  
         </div>
             </div>
       </div><!--//col-md-3-->
      </div>  
    </div><!--//cols-wrapper-->

</div><!--//content-->