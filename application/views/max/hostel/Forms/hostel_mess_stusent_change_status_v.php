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
            <h1 class="heading-title pull-left"> <?php echo $page_header?></h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current"> <?php echo $page_header?></li>
                    </ul>
                </div>
      <!--//breadcrumbs-->
        </header>
         <div class="page-content">
            <div class="row">
                 <div class="col-md-12">
                     <section class="course-finder" style="padding-bottom: 2%;">
                         <h1 class="section-heading text-highlight">
                             <span class="line"><strong>All Hostel Students List</strong> <strong style="color:red">(Please Select Hostel Status and Student Status Both at the Same Time for Proper Searching)</strong> </span>
                        </h1>
                         <form method="post" action="HostelController/hostel_student_change_status">
                <div class="form-group col-md-2">
            <?php        
                if(!empty($student_id)){
                    $empres = $this->HostelModel->get_by_id('student_record',array('student_id'=>$student_id));
                    foreach($empres as $emprec)
                    { ?>          
        <input type="text" name="student_id" value="<?php echo $emprec->student_name; ?>" placeholder="Student Name" class="form-control" id="std_namess">
                    <input type="hidden" name="student_id" id="student_id" value="<?php echo $emprec->student_id; ?>">      
                    <?php 
                    }     
                }else{?>
        <input type="text" name="student_id" class="form-control" placeholder="Student Name" id="std_namess">
        <input type="hidden" name="student_id" id="student_id">
                    <?php
                    }    
                ?>                  
            </div>
            
            <div class="form-group col-md-2">
               <?php
                  echo form_dropdown('programe_id', $program, $programe_id, 'class="form-control" id="feeProgrameId"');
                   ?>
            </div>
            
            <div class="form-group  col-md-2">
<!--                    <select name="sub_pro_id" class="form-control" id="showFeeSubPro">
                    <option value="">Sub Program</option>
                    </select>-->
                    <?php
                            echo form_dropdown('sub_pro_id', $sub_program, $sub_pro_id, 'class="form-control" id="showFeeSubPro"');
                   ?>
                
            </div>
           <div class="form-group col-md-2">
<!--                <select name="batch_id" class="form-control" id="batch_id">
                <option value="">Select Batch</option>
                </select>-->
               <?php
                  echo form_dropdown('batch_id', $batch_name, $batch_id, 'class="form-control" id="batch_id"');
                   ?>
               
            </div> 
                <div class="form-group col-md-2">
               <?php
                  echo form_dropdown('hostel_status_id', $status, $hostel_status_id, 'class="form-control"');
                   ?>
           </div>
             <div class="form-group col-md-2">
               <?php
                  echo form_dropdown('s_status_id', $statuss, $s_status_id, 'class="form-control"');
                   ?>
           </div> 
        <div class="form-group col-md-2">
               <?php
                  echo form_dropdown('shift_id', $shift, $shift_id, 'class="form-control"');
                   ?>
           </div>     
                <div class="form-group col-md-4">        
                    <input type="submit" name="search" class="btn btn-theme" value="Search">
                    <input type="submit" name="export" class="btn btn-theme" value="Export">
                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
                </div>        
                </form>
            </section>
               <?php print_r($this->session->flashdata('msg'));?>      
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
        <table class="table table-boxed" style="font-size:11px;">
        <thead>
            <tr>
                <th>S/No</th>
                <th>Picture</th>
                <th width="50">C.No</th>
                <th width="110">Student</th>
                <th width="80">F-Name</th>
                <th width="110">Batch</th>
                <th width="110">S-Program</th>
                <th>Mobile #</th>
                <th>Shift</th>
                <th>Alt-Date</th>
                <th>Lvd-Date</th>
                
                <th width="100">Reason</th>
                <th>Status</th>
                <th id="update_buttonHeading">Update</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
        foreach($result as $row):
            $allotedDate = $row->allotted_date;
            $leaved_date = $row->leaved_date;
            if($allotedDate == '0000-00-00'):
                $allotedDateShow = '';
            else:
                $allotedDateShow = date('d-m-Y', strtotime($allotedDate));
            endif;
//            
            if($leaved_date == '0000-00-00'):
                $leaved_dateShow = '';
            else:
                $leaved_dateShow = date('d-m-Y', strtotime($leaved_date));
            endif;
             
            $status = $row->hostel_status_id;
              
        ?>    
            <tr>
            <td><?php echo $i;?></td>
            <td><img src="assets/images/students/<?php echo $row->applicant_image?>" width="50" height="40"></td>
            <td><?php echo $row->college_no;?></td>
            <td><?php echo $row->student_name;?></td>
            <td><?php echo $row->father_name;?></td>
            <td><?php echo $row->batch;?></td>
            <td><?php echo $row->sub_program;?></td>
            <td><?php echo $row->mobile_no;?></td>
            <td><?php echo $row->name;?></td>
            <td><?php echo $allotedDateShow;?></td>         
            <td><?php
            if($status != 1):
                echo $leaved_dateShow;
                else:
                    echo '';
                endif;
                ?></td> 
            <!--<td><?php echo $row->h_batch_name;?></td>-->     
            <td><?php echo $row->reason;?></td>     
            <td>
            <?php
           
            if($status == 1):
                ?> 
                <span class="label label-success"><?php echo $row->status_name;?></span>
                <?php else: ?>
                <span class="label label-danger"><?php echo $row->status_name;?></span>
                <?php endif; ?>
                </td>
                <td id="update_buttonResult"><a class="btn btn-theme btn-sm" href="HostelController/update_hostel_student/<?php echo $row->hostel_id;?>">Update</a>
                
                <?php
//                echo '<br/>';
//                
//                $check = $this->db->get_where('hostel_student_bill',array('hostel_std_id'=>$row->hostel_id))->row();
//                if(empty($check)):
//                    echo '<a href="DeleteHostel/'.$row->hostel_id.'" class="btn btn-danger btn-xs">Delete Hostel</a>';
//                endif;
                    
                ?>
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
                     
                     
                </div>    
            </div>    
        </div>    
    </div>    
</div>
