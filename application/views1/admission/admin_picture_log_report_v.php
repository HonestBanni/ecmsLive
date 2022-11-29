
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?php echo $HeaderPage?> 
      </h1>
      <div class="breadcrumbs pull-right">
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-label">You are here:
          </li>
          <li> 
            <?php echo anchor('admin/admin_home', 'Home');?> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current"><?php echo $HeaderPage?>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <section class="course-finder" style="padding-bottom: 2%;">
            <h1 class="section-heading text-highlight">
                <span class="line"><?php echo $HeaderPage?> Search</span>
            </h1>
                <div class="section-content" >
                    <div class="row">
                        <?php echo form_open('',array('class'=>'form-inline course-finder-form','name'=>'reportForm'));   ?>
                        
                        <div class="col-md-12">
                            <div class="col-md-2 col-sm-5">
                               <label for="name">College #</label>
                               <div class="input-group">
                                <?php
                                echo form_input(array(
                                        'name'          => 'college_number',
                                        'id'            => 'college_number',
                                        'value'         => $college_number,
                                        'class'         => 'form-control',
                                        'placeholder'   => 'College #',
                                        'type'          => 'text'
                                    )); 
                                ?>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-5">
                                <label for="name">Select Shift</label>
                                <div class="input-group">
                                    <?php 
                                        echo form_dropdown('shift', $Shift,@$ShiftId,  'class="form-control" id="section_dropdown"');
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-5">
                                <label for="name">Quota</label>
                                <div class="input-group">
                                    <?php 
                                        echo form_dropdown('rseats', $Quota,@$QuotaId,  'class="form-control" id="section_dropdown"');
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-5">
                                <label for="name">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <div class="input-group">
                                    <button type="submit" name="search_log" value="search_log"   class="btn btn-theme"><i class="fa fa-search"></i> Search </button>
                                </div>
                            </div>
                        </div>  
                        
                    </div>
                            
                    <?php
                    echo form_close();
                    ?>
                </div><!--//section-content-->
         </section>
         
              
        
            <div class="table-responsive">    
                 <div id="div_print">
                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>S No.</th>
                            <th >Image</th>
                            <th >College No.</th>
                            <th>Shift</th>
                            <th>Admission</th>
                            <th>Quota</th>
                            <th>View Log</th>
                            
                        
                        </tr>
                    </thead>
                 <tbody>
                    
                     <?php
                     
                     if(@$student_record):
//                         echo '<pre>';print_r($subject_record);die;
                         $sn= '';
//                         echo '<pre>'; print_r($student_record); die;
                         foreach($student_record as $srRow):
                             $sn++;
                         ?>
                        <tr>
                            <td><?php echo $sn; ?></td>
                            <td><?php
                                if($srRow->applicant_image == "")
                                { ?>
                                <img src="<?php echo base_url();?>assets/images/students/user.png" width="60" height="60">
                                <?php } else
                                { ?>
                                <img src="<?php echo base_url();?>assets/images/students/<?php echo $srRow->applicant_image;?>" style="border-radius:10px;" width="60" height="60">
                                <?php } ?>
                            </td>
                            <td><?php echo $srRow->college_no; ?></td>
                            <td><?php echo $srRow->shift_name; ?></td>
                            <td><?php echo $srRow->admission_date; ?></td>
                            <td><?php echo $srRow->rseats_id; ?></td>
                            <td><a href="AdmissionController/student_picture_log_record/<?php echo $srRow->student_id;?>" class="btn btn-success btn-sm">View Logs</a></td>
                        </tr>
                       
                    <?php
                         endforeach;
                        
                     endif;
                     ?>
                     
                 </tbody>
                </table><!--//table-->
           </div>
             </div>
          <!--//contact-form-->
        </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
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