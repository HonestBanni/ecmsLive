        <!-- ******CONTENT****** --> 
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
           <div class="row">
                <div class="col-md-12">
                    <section class="course-finder" style="padding-bottom: 2%;">
                            <h1 class="section-heading text-highlight">
                                <span class="line"><?php echo $page_header?> Panel</span>
                            </h1>
                                 <div class="section-content" >
                                <?php echo form_open('',array('class'=>'course-finder-form'));?>
                                    <div class="form-group col-md-2">
                                        <input type="text" name="college_no"  placeholder="College No." value="<?php if($college_no): echo $college_no;endif; ?>" class="form-control">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="text" name="form_no" value="<?php if($form_no): echo $form_no;endif; ?>"  placeholder="Form No." class="form-control">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="text" name="student_name" value="<?php if($student_name): echo $student_name;endif; ?>"  placeholder="Student Name" class="form-control">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="text" name="father_name" value="<?php if($father_name): echo $father_name;endif; ?>" placeholder="Father Name" class="form-control">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <?php  echo form_dropdown('gender_id', $gender, $gender_id,  'class="form-control" id="my_id"');  ?>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <?php  echo form_dropdown('sub_pro_id', $sub_program, $sub_pro_id,  'class="form-control" id="my_id"'); ?>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <?php     echo form_dropdown('batch', $batch, $batchId,  'class="form-control" id="my_id"');    ?>
                                    </div>      
                                    <div class="form-group col-md-2">
                                     <?php     echo form_dropdown('rseats_id', $reserved_seat, $rseats_id,  'class="form-control" id="my_id"');       ?>
                                    </div>
                                    <div class="form-group col-md-2">
                                          <?php   echo form_dropdown('s_status_id', $status, $s_status_id,  'class="form-control" id="my_id"');     ?>
                                    </div>       
                                     <div style="padding-top:1%;">
                                           <div class="col-md-4 pull-right">
                                        
                                                <input type="submit" name="search" class="btn btn-theme" value="Search">
                                                <input type="submit" name="export" class="btn btn-theme" value="export">

                                           </div>
                                        </div>
         
                                        <?php  echo form_close();  ?>
            
                        </section> 
           
                
            
                 <h4>
                        <span style="margin-right:30px;color:#208e4c"><?php if(@$pages): echo $pages;endif;?></span> 
                    </h4>
                   <button type="button" class="btn btn-success">
                        <i class="fa fa-check-circle"></i>Total Records: 
                        <?php if(@$count): echo $count; else: echo count($result);endif;?>
                    </button>
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>PK</th>
                            <th>Picture</th>
                            <th>Student</th>
                            <th>F-Name</th>
                            <th>Form #</th>
                            <th>College #</th>
                            <th>Sub Program</th>
                            <th>Batch</th>
                            <th>Section</th>
                            <th>Status</th>
                           
                        </tr>
                    </thead>
                    <tbody>
<?php
foreach($result as $rec)  
    {
        $student_id = $rec->student_id;
        $student_name = $rec->student_name;
        $father_name = $rec->father_name;
        $applicant_image = $rec->applicant_image;         
        $section = $rec->section;                            
        ?>
                        <tr class="gradeA">
                            <td><?php 
                $query = $this->CRUDModel->get_where_row('applicant_edu_detail',array('student_id'=>$student_id));
                    if($query){
                        echo '<i>'.$student_id.'</i>';
                    }else{
                        echo '<i style="color:red;">'.$student_id.'</i>';
                    }            
                                
                    ?></td>
                    <td><?php
                    if($applicant_image == "")
                    {?>
        <img src="assets/images/students/user.png" width="50" height="40">
                    <?php
                    }else
                    {?>
    <img src="assets/images/students/<?php echo $applicant_image;?>" style="border-radius:3px;" width="50" height="40">
                <?php 
                    }
                    ?></td>
 <td><a href="admin/student_profile/<?php echo $student_id;?>">
     <span style="font-size:15px;"><?php echo $student_name;?></span></a>    
                    </td>
                    <td><?php echo $father_name;?></td>
                    <td><?php echo $rec->form_no;?></td>
                    <td><?php echo $rec->college_no;?></td>
                    <td><?php echo $rec->sub_program;?></td>
                    <td><?php echo $rec->batch;?></td>
                    <td><?php echo $section;?></td>
                    <td><span class="btn btn-success btn-sm"><?php echo $rec->status;?></span></td>
     
                            
                        </tr>
<?php
}
 ?>

                    </tbody>
                </table>
                </div><!--//col-md-3-->
                </div> 
            </div><!--//cols-wrapper-->
           