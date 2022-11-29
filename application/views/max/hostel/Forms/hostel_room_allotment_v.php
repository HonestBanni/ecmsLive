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
            <h1 class="heading-title pull-left"><?php echo $page_header?></h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current"><?php echo $page_header?></li>
                    </ul>
                </div>
      <!--//breadcrumbs-->
    </header> 
        
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <?php echo form_open('')?>
                 <section class="course-finder" style="padding-bottom: 2%;">
                    <h1 class="section-heading text-highlight">
                        <span class="line"><?php echo $page_header?> Panel</span>
                    </h1>
                     <div class="col-md-12">
                        <div class="row">
                            
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">College no :</label>
                                        
                                            <?php 
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'college_no',
                                                            'type'          => 'text',
                                                            'value'         => $college_no,
                                                            'class'         => 'form-control',

                                                             )
                                                         );?>
                                    
                                </div>
<!--                                <div class="col-md-2 col-sm-5">
                                    <label for="name">Form no :</label>
                                        <div class="input-group" id="adv-search">
                                            <?php 
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'form_no',
                                                            'type'          => 'text',
                                                            'value'         => $form_no,
                                                            'class'         => 'form-control',

                                                             )
                                                         );?>
                                        </div>
                                </div>-->
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">Student name :</label>
                                        
                                            <?php 
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'student_name',
                                                            'type'          => 'text',
                                                            'value'         => $student_name,
                                                            'class'         => 'form-control',

                                                             )
                                                         );?>
                                        
                                </div>
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">Father name :</label>
                                        
                                            <?php 
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'father_name',
                                                            'type'          => 'text',
                                                            'value'         => $father_name,
                                                            'class'         => 'form-control',

                                                             )
                                                         );?>
                                      
                                </div>
                                 
                       
                                 <div style="padding-top:2%;">
                                <div class="col-md-3 pull-right">
                                    <button type="submit" class="btn btn-theme" name="addRoomSearch" id="addRoomSearch"  value="addRoomSearch" ><i class="fa fa-plus"></i> Add Room</button>
                                </div>
                                </div>
                            </div>
                    </div>
                 <?php echo form_close();?>
                     
                       
                 </section>
            
                     <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                    </h4>
                               <?php if(@$student):?>
                            <table class="table table-boxed table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Picture</th>
                                        <th>Student</th>
                                        <th>F-Name</th>
                                        <th>Form #</th>
                                        <th>College #</th>
                                        <th>Program</th>
                                        <th>Sub Program</th>
                                        <th>Batch</th>
                                        <th>Hostel Assign</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($student as $sRow):
                                          $check_flag = $this->db->get_where('hostel_student_record',array('student_id'=>$sRow->student_id))->row();
                                       
                                       echo '<tr><td>'; 
                                       if($sRow->applicant_image == ""):
                                                echo ' <img src="assets/images/students/user.png" width="60" height="60">';
                                           else:
                                            echo ' <img src="assets/images/students/'.$sRow->applicant_image.'" width="60" height="60">';
                                       endif;
                                       echo '</td>'; 
                                    ?>
                                        <td><?php echo $sRow->student_name;?></td>
                                        <td><?php echo $sRow->father_name;?></td>
                                        <td><?php echo $sRow->form_no;?></td>
                                        <td><?php echo $sRow->college_no;?></td>
                                        <td><?php echo $sRow->program;?></td>
                                        <td><?php echo $sRow->sub_program;?></td>
                                        <td><?php echo $sRow->batch;?></td>
                                        <td>
                                        <?php
                                        
                                        if(@$check_flag->new_admission_flag ==1):
                                if(@$check_flag->room_alloted ==1):
//                                    echo '<a class="btn btn-danger btn-sm" href="HostelController/add_hostel_student/'.$check_flag->hostel_id.'"><b>Hostel Room Update</b></a>';
                                    echo '<a class="btn btn-danger btn-sm" href="HostelController/add_hostel_student/'.$sRow->student_id.'"><b>Hostel Room Update</b></a>';
                                    else:
                                    echo '<a class="btn btn-success btn-sm" href="HostelController/add_hostel_student/'.$sRow->student_id.'"><b>Add Hostel Room</b></a>';
                                endif;
                                
                                
                                else:
                                echo '<p>You have no entry in hostel merit list, Concern to IT manager</p>';
                            endif;
                                        
                                        ?>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                            <?php endif;?>
                  
                

            </div>
            <div class="col-md-12">
                <?php echo form_open('')?>
                 <section class="course-finder" style="padding-bottom: 2%;">
                    <h1 class="section-heading text-highlight">
                        <span class="line">Register Student Search Panel</span>
                    </h1>
                     <div class="col-md-12">
                        <div class="row">
                            
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">College no :</label>
                                       
                                           <?php 
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'college_noSearch',
                                                            'type'          => 'text',
                                                            'value'         => $college_noSearch,
                                                            'class'         => 'form-control',

                                                             )
                                                         );?>
                                </div>
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">Student name </label>
                                       
                                           <?php 
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'student_name_search',
                                                            'type'          => 'text',
                                                            'value'         => $student_name_search,
                                                            'class'         => 'form-control',

                                                             )
                                                         );?>
                                </div>
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">Father name</label>
                                       
                                           <?php 
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'father_name_search',
                                                            'type'          => 'text',
                                                            'value'         => $father_name_search,
                                                            'class'         => 'form-control',

                                                             )
                                                         );?>
                                </div>
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">Program :</label>
                                        
                                             <?php
                                                echo form_dropdown('programe_id', $program, $programe_id, 'class="form-control" id="feeProgrameId"');
                                                 ?>
                                        
                                </div>
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">Sub program :</label>
                                         
                                            <?php
                                                        echo form_dropdown('sub_pro_id', $sub_program, $sub_pro_id, 'class="form-control" id="showFeeSubPro"');
                                               ?>
                                        
                                </div>
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">Batch</label>
                                         
                                            <?php
                                                echo form_dropdown('batch_id', $batch_name, $batch_id, 'class="form-control" id="batch_id"');
                                                 ?>
                                </div>
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">Hostel Status</label>
                                        
                                            <?php
                                                echo form_dropdown('hostel_status_id', $status, $hostel_status_id, 'class="form-control"');
                                                 ?>
                                        
                                </div>
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">Student Status</label>
                                         
                                             <?php
                                                echo form_dropdown('s_status_id', $statuss, $s_status_id, 'class="form-control"');
                                                 ?>
                                        
                                </div>
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">Shift</label>
                                       
                                              <?php
                                                echo form_dropdown('shift_id', $shift, $shift_id, 'class="form-control"');
                                                 ?>
                                         
                              </div>  
                            
                                 
                                     
                                </div>
                         <div class="row">
                                     
                                <div style="padding-top:2.4%;">
                                <div class="col-md-3 pull-right">
                                    <button type="submit" class="btn btn-theme" name="SearchResult" id="SearchResult"  value="SearchResult" ><i class="fa fa-search"></i> Search</button>
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>
                                </div>
                                </div>
                            </div>
                         
                            
                    </div>
                 <?php echo form_close();?>
                     
                       
                 </section>
            
                     
                  
                

            </div>
        </div>
    </div>
 
    </div>
</div>

<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">   
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
    <table class="table table-boxed">
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
                
            </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
        foreach($result as $row):
            $dt = $row->allotted_date;
            $dt1 = $row->leaved_date;
            $date = date('d-m-Y', strtotime($dt));
            $date1 = date('d-m-Y', strtotime($dt1));
            $status = $row->hostel_status_id;
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
            <td><?php echo $row->mobile_no;?></td>
            <td><?php echo $row->name;?></td>
            <td><?php echo $date;?></td>         
            <td><?php
                if($status != 1):
                echo $date1;
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
