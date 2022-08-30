
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
                <div class="form-group">
            <?php        

                if(!empty($emp_id)){
                    $rooms = $this->AttendanceModel->get_by_id('hr_emp_record',array('emp_id'=>$emp_id));
                    foreach($rooms as $roomrec)
                    { ?>          
                    <input type="text" name="emp_id" value="<?php echo $roomrec->emp_name; ?>" placeholder="Employee Name" class="form-control" id="emp">
                    <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $roomrec->emp_id; ?>">      
                    <?php 
                    }     
                }else{?>
                    <input type="text" name="emp_id" class="form-control" placeholder="Employee Name" id="emp">
                    <input type="hidden" name="emp_id" id="emp_id">
                    <?php
                    }    
                ?>                  
            </div>
            <div class="form-group">
            <?php        

                if(!empty($sec_id)){
                    $sect = $this->AttendanceModel->get_by_id('sections',array('sec_id'=>$sec_id));
                    foreach($sect as $sectrec)
                    { ?>          
                    <input type="text" name="sec_id" value="<?php echo $sectrec->name; ?>" placeholder="Section Name" class="form-control" id="sec">
                    <input type="hidden" name="sec_id" id="sec_id" value="<?php echo $sectrec->sec_id; ?>">      
                    <?php 
                    }     
                }else{?>
                <input type="text" name="sec_id" class="form-control" placeholder="Section Name" id="sec">
                <input type="hidden" name="sec_id" id="sec_id">        
        
                    <?php
                    }    
                ?>                  
            </div>
            <div class="form-group">
            <?php        

                if(!empty($subject_id)){
                    $subj = $this->AttendanceModel->get_by_id('subject',array('subject_id'=>$subject_id));
                    foreach($subj as $subjrec)
                    { ?>          
                    <input type="text" name="subject_id" value="<?php echo $subjrec->title; ?>" placeholder="Subject Name" class="form-control" id="sub">
                    <input type="hidden" name="subject_id" id="subject_id" value="<?php echo $subjrec->subject_id; ?>">      
                    <?php 
                    }     
                }else{?>
                    <input type="text" name="subject_id" class="form-control" placeholder="Subject Name" id="sub">
                    <input type="hidden" name="subject_id" id="subject_id">        
        
                    <?php
                    }    
                ?>                  
            </div>   
            <div class="form-group">
            <input type="submit" name="search_class" value="Search" class="btn btn-theme">
            <!--<input type="submit" name="export" value="Export" class="btn btn-theme">-->
          </div>
                                    </div>  
                                       <?php
                                    echo form_close();
                                    ?>
                                </div>
                    
                    
                    
                </div><!--//section-content-->
         </section>
            <div class="table-responsive">    
                 <div id="div_print">
                    
                     <?php
                     if(@$class_result):  
                        
                        $sn = '';
                        foreach($class_result as $c_row):
                            $sn++;
                        
                            echo '<table class="table table-hover">
                                <tr style="font-size: 14px; background: #208e4c;">
                                    <th colspan="10"><p style="text-align: center; margin:0; padding:0; color:#fff;">'.$c_row->tab_title.'</p></th>
                                </tr>
                                <tr style="font-size: 14px; background: #eee; border-top: 2px #000 solid;">
                                    <th>S No.</th>
                                    <th>Class ID</th>
                                    <th colspan="3">Teacher Name</th>
                                    <th>Class</th>
                                    <th>Subject</th>
                                    <th>Date Time</th>
                                    <th>Username</th>
                                    <th>Log Description</th>
                                </tr>
                                <tr style="border-top: 2px #000 solid;">
                                    <th>'.$c_row->serial_no.'</th>
                                    <th>'.$c_row->class_id.'</th>
                                    <th colspan="3">'.$c_row->emp_name.'</th>
                                    <th>'.$c_row->section_name.'</th>
                                    <th>'.$c_row->subject_name.'</th>
                                    <th>'.date('d-m-Y H:i:s',strtotime($c_row->DateTime)).'</th>
                                    <th>'.$c_row->emp_name_log.'</th>
                                    <th>'.$c_row->comments.'</th>
                                </tr>';
                        
                            if($c_row->timetable_record):
                                $snn = '';
                            
                                echo '<tr style="font-size: 14px; background: #eee;">
                                        <th></th>
                                        <th>S No.</th>
                                        <th>Day</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Building</th>
                                        <th>Room</th>
                                        <th>Date Time</th>
                                        <th>Username</th>
                                        <th>Log Description</th>
                                    </tr>';
                            
                                foreach($c_row->timetable_record as $t_row):
                                    $snn++;   
                                    echo '<tr>
                                        <th></th>
                                        <th>'.$snn.'</th>
                                        <th>'.$t_row->day_name.'</th>
                                        <th>'.$t_row->class_stime.'</th>
                                        <th>'.$t_row->class_etime.'</th>
                                        <th>'.$t_row->bb_name.'</th>
                                        <th>'.$t_row->rm_name.'</th>
                                        <th>'.date('d-m-Y H:i:s',strtotime($t_row->log_datetime)).'</th>
                                        <th>'.$t_row->emp_name.'</th>
                                        <th>'.$t_row->comments.'</th>
                                    </tr>';
                                endforeach;
                                echo '</table>';
                            endif;
                        endforeach;
                     endif;
                     ?>
                     
                <!--//table-->
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