<script language="javascript">
function printdiv(printpage)
{
    jQuery('#update_buttonHeading').hide();
    jQuery('#update_buttonResult').hide();
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
            <h1 class="heading-title pull-left">Hostel Student Record</h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current">Hostel Student Report</li>
                    </ul>
                </div>
      <!--//breadcrumbs-->
    </header> 
      
    <div class="page-content">

        <section class="course-finder" style="padding-bottom: 2%;">
            <h1 class="section-heading text-highlight">
                <span class="line">Hostel Student Report Search Panel</span>
            </h1>
            <div class="section-content">
            <form method="post" class="course-finder-form" action="HostelController/print_hostel_student_report">
                <div class="col-md-3">
                    <label for="name">Name or College No.</label>
                    <?php        
                        if(!empty($student_id)){
                            $empres = $this->HostelModel->get_by_id('student_record',array('student_id'=>$student_id));
                            foreach($empres as $emprec)
                            { ?>          
                            <input type="text" name="student_id" value="<?php echo $emprec->student_name; ?>" placeholder="Student Name" class="form-control" id="std_names">
                            <input type="hidden" name="student_id" id="student_id" value="<?php echo $emprec->student_id; ?>">      
                            <?php 
                            }     
                        }else{?>
                            <input type="text" name="student_id" class="form-control" placeholder="Student Name" id="std_names">
                            <input type="hidden" name="student_id" id="student_id">
                            <?php
                            }    
                        ?>                  
                </div>
                <div class="col-md-3">
                    <label for="name">Program</label>
                    <?php
                        echo form_dropdown('programe_id', $program, $programe_id, 'class="form-control" id="feeProgrameId"');
                        ?>
                </div>
                <div class="col-md-3">
                    <label for="name">Sup Program</label>
                        <?php echo form_dropdown('sub_pro_id', $sub_program, $sub_pro_id, 'class="form-control" id="showFeeSubPro"');?>
                </div>
                <div class="col-md-3">
                    <label for="name">Batch</label>
                    <?php echo form_dropdown('batch_id', $batch_name, $batch_id, 'class="form-control" id="batch_id"');?>
                </div>
                <div class="col-md-3">
                    <label for="name">Section</label> 
                    <?php   echo form_dropdown('section', $section,$sectionId,  'class="form-control section" id="showSections"');  ?>

                </div>
                <div class="col-md-3">
                    <label for="name">Admission In</label>
                        <?php echo form_dropdown('admission_in', $admission_in, $admission_in_id, 'class="form-control" ');   ?>
                </div>
                <div class="col-md-3">
                    <label for="name">Student Status</label>
                        <?php  echo form_dropdown('statuss', $statuss, $statuss_id, 'class="form-control" '); ?>
                </div>
                
                <div class="col-md-3">
                    <label for="name" style="visibility:hidden;">Student Statu sdfsd f asdf asdfs</label>
                    <input type="submit" name="search" class="btn btn-theme" value="Search">
                    <input type="submit" name="export" class="btn btn-theme" value="Export">
                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
                </div>


            </form>

            </div>
        </section>
       


      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">   
            
          
            
             <h4 style="color:red; text-align:center;">
            <?php print_r($this->session->flashdata('msg'));?>
                </h4>
            <?php
            if(@$result):
            ?>
            <div class="form-group col-md-12">
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?>
            </button>
            </p>
        </div>
    <div id="div_print">        
    <table class="table table-boxed" style="font-size:10px;">
        <thead>
            <tr>
                <th>S/No</th>
                <th>Picture</th>
                <th width="40">C.No</th>
                <th width="110">Student</th>
                <th width="80">F-Name</th>
                <th width="80">Batch</th>
                <th width="100">S-Program</th>
                <th width="50">Section</th>
                <th>Mobile #</th>
                <th>Shift</th>
                <th width="50">Alt-Date</th>
                <!--<th>Lvd-Date</th>-->
                <th>Block</th>
                <th>Room</th>
                <th>O.Marks</th>
                <th>T.Marks</th>
                <th width="90">Admission In</th>
                <th>Approved By</th>
                <th>Hostel Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
        foreach($result as $row):
            $dt     = $row->allotted_date;
            $dt1    = $row->leaved_date;
            $date   = date('d-m-Y', strtotime($dt));
            $date1  = date('d-m-Y', strtotime($dt1));
            $status = $row->hostel_status_id;
            $room   = $row->rm_name;
            $block   = $row->block_name;
                if($date1 === '0000-00-00' || $date1 === '1970-01-01'){
                    $date1 = '';
                    } else {
                    $date1 = date("d-m-Y", strtotime($date1 ));
                    }
        ?>    
            <tr>
            <td><?php echo $i;?></td>
            <td><img src="assets/images/students/<?php echo $row->applicant_image?>" width="50" height="40"></td>
            <td><?php echo $row->college_no;?></td>
            <td><?php echo $row->student_name;?></td>
            <td><?php echo $row->father_name;?></td>
            <td><?php echo $row->batch;?></td>
            <td><?php echo $row->sub_program;?></td>
            <td><?php echo $row->sessionName;?></td>
            <td><?php echo $row->mobile_no;?></td>
            <td><?php echo $row->shift_name;?></td>
            <td><?php echo $date;?></td>         
            <!--<td>-->
                <?php
//                if($status != 1):
//                echo $date1;
//                else:
//                    echo '';
//                endif;
                ?>
            <!--</td>--> 
            <td><?php if($room): echo $room; else: echo ''; endif; ?></td> 
            <td><?php if($block): echo $block; else: echo ''; endif; ?></td> 
            <td><?php echo $row->obtained_marks;?></td>
            <td><?php echo $row->total_marks;?></td>
            <td><?php echo $row->name;?></td>      
            <td><?php echo $row->approval_by;?></td>      
            <td>
            <?php
           
            if($status == 1):
                ?> 
                <span class="label label-success"><?php echo $row->status_name;?></span>
                <?php else: ?>
                <span class="label label-danger"><?php echo $row->status_name;?></span>
                <?php endif; ?>
                </td>
        </tr>
            <?php 
            $i++;
                endforeach;
            ?>
        </tbody>
        </table></div>
            <?php
            else:
                echo "";
            endif;
                ?>
</article>
         
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
