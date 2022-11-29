    <div class="content container">
            <h2 align="left"><?php echo $page_header;?><span  style="float:right"><a href="RegChineseLangStudent" class="btn btn-large btn-primary">Add New Student</a></span><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <section class="course-finder" style="padding-bottom: 2%;">
                         <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                            <?php echo form_open('',array('class'=>'course-finder-form'));?>
                             <div class="form-group col-md-2">
                                <input type="text" name="form_no" value="<?php if($form_no): echo $form_no; endif;?>" placeholder="Form No." class="form-control"> 
                            </div>
                             <div class="form-group col-md-2">
                                     <input type="text" name="student_name" value="<?php if($student_name): echo $student_name; endif;?>"  placeholder="Student Name" class="form-control"> 
                            </div>
                             <div class="form-group col-md-2">
                                     <input type="text" name="father_name" value="<?php if($father_name): echo $father_name; endif;?>" placeholder="Father Name" class="form-control"> 
                            </div>
                             <div class="form-group col-md-2">
                                 <?php  echo form_dropdown('gender_id',$gender,$gender_id,array('class'=>'form-control'));?>
                             </div>
                             <div class="form-group col-md-2">
                                 <?php  echo form_dropdown('programe_id',$program,$program_id,array('class'=>'form-control'));?>
                             </div>
                             <div class="form-group col-md-2">
                                 <?php  echo form_dropdown('sub_pro_id',$sub_program,$sub_pro_id,array('class'=>'form-control'));?>
                             </div>
                             <div class="form-group col-md-2">
                                 <?php  echo form_dropdown('batch_id',$batch,$batch_id,array('class'=>'form-control'));?>
                             </div>
                             <div class="form-group col-md-2">
                                 <?php  echo form_dropdown('s_status_id',$status,$s_status_id,array('class'=>'form-control'));?>
                             </div>
                             <div class="form-group col-md-4">
                                 <button type="submit" name="search" value="Search" class="btn btn-theme"><i class="fa fa-search"> &nbsp;&nbsp;</i>Search</button>
                                 <button type="submit" name="export" value="Export" class="btn btn-theme"><i class="fa fa-book"> &nbsp;&nbsp;</i>Export</button>
                               
                             </div>
                            
                            
                            <?php echo form_close();?>
                        </div>
                    </section>
                     
                </div>
            <p>
            <?php  
                if(@$count):    
            ?>    
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo $count;?>
            </button>
            <?php
                else:  
            ?>    
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count($result);?>
            </button>
            <?php
                endif;
            ?>    
            </p>
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>PK</th>
                            <th>Student</th>
                            <th>F-Name</th>
                            <th>Form #</th>
                            <th>Sub Program</th>
                            <th>Batch</th>
                            <th>Remarks</th>
                            <th>Status</th>
                            <th><i class="icon-edit" style="color:#fff"></i><b> Update</b></th>
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
 <td><a href="admin/student_profile/<?php echo $student_id;?>">
     <span style="font-size:15px;"><?php echo $student_name;?></span></a>    
                    </td>
                    <td><?php echo $father_name;?></td>
                    <td><?php echo $rec->form_no;?></td>
                    <td><?php echo $rec->sub_program;?></td>
                    <td><?php echo $rec->batch;?></td>
                    <td><?php echo $rec->comment;?></td>
                    <td><span class="btn btn-success btn-sm"><?php echo $rec->status;?></span></td>
    <td><a class="btn btn-primary btn-sm" href="UpChineseLangStudent/<?php echo $rec->student_id;?>"><b>Update</b></a></td>
    
                            
                        </tr>
<?php
}
 ?>

                    </tbody>
                </table>
            <?php echo @$pages?>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           