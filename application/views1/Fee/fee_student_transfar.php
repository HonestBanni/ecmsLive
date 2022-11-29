 <?php
// error_reporting(0);
 ?>
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
    <div class="page-content">
        <div class="row">
            <?php  echo form_open('',array('class'=>'course-finder-form')); ?>
            <div class="col-md-12">
                <section class="course-finder" style="padding-bottom: 2%;">                    
                    <h1 class="section-heading text-highlight">
                        <span class="line"><?php echo $page_header?> Panel</span>
                    </h1>
                    <div class="section-content" >
                        <div class="row">
                            <div class="col-md-3">
                            <label for="name">College No </label>
                                <?php 
                                    echo form_input(array(
                                        'name'          => 'college_no',
                                        'value'         => $college_no,
                                        'placeholder'  => 'Enter College No',
                                        'class'         => 'form-control',

                                        ));

                                 ?>
                            </div>
                        </div>
                        <?php  if(!empty($student_info)):   ?>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="name">Form#</label>
                                <?php 
                                    echo form_input(array(
                                        'name'          => 'form_no',
                                        'id'            => 'form_no',
                                        'value'         => $student_info->form_no,
                                        'class'         => 'form-control',
                                        'disabled'      => 'disabled',
                                        ));

                                 ?>
                            </div>
                            <div class="col-md-3">
                                <label for="name">College No</label>
                                    <?php 
                                        echo form_input(array(
                                            'name'          => 'student_name',
                                            'id'            => 'student_name',
                                            'value'         => $student_info->college_no,
                                            'placeholder'   => 'College No',
                                            'class'         => 'form-control',
                                             'disabled'      => 'disabled',
                                            ));

                                     ?>
                            </div>
                            <div class="col-md-3">
                                <label for="name">Student Name</label>
                                    <?php 
                                        echo form_input(array(
                                            'name'          => 'student_name',
                                            'id'            => 'student_name',
                                            'value'         => $student_info->student_name,
                                             'class'         => 'form-control',
                                             'disabled'      => 'disabled',
                                            ));

                                        echo form_input(array(
                                            'name'          => 'student_id',
                                             'value'         => $student_info->student_id,
                                             'class'         => 'form-control',
                                              'type'        =>'hidden'

                                            ));

                                    ?>
                            </div>
                            <div class="col-md-3">
                                <label for="name">Father Name</label>
                                    <?php 
                                        echo form_input(array(
                                            'name'          => 'father_name',
                                            'id'            => 'father_name',
                                            'value'         => $student_info->father_name,
                                            'class'         => 'form-control',
                                            'disabled'      => 'disabled',
                                            ));

                                     ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Program</label>
                                        <?php 
                                            echo form_input(array(

                                                'value'         => $student_info->programe_name,
                                                'class'         => 'form-control',
                                                 'disabled'      => 'disabled',
                                                ));
                                            echo form_input(array(

                                                'value'         => $student_info->programe_id,
                                                'name'          => 'old_program_id',
                                                'class'         => 'form-control',
                                                 'type'          => 'hidden',
                                                ));

                                         ?>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Batch</label>
                                        <?php 
                                            echo form_input(array(
                                         
                                                'value'         => $student_info->batch_name,
                                                'class'         => 'form-control',
                                                 'disabled'      => 'disabled',
                                                ));
                                              echo form_input(array(

                                                'value'         => $student_info->batch_id,
                                                'name'          => 'old_batch_id',
                                                'class'         => 'form-control',
                                                 'type'          => 'hidden',
                                                ));
                                           
                                         ?>
                                </div>
                               <div class="col-md-3">
                                    <label for="name">Sub Program</label>
                                        <?php 
                                            echo form_input(array(
                                                'value'         => $student_info->sub_proram,
                                                'class'         => 'form-control',
                                                'disabled'      => 'disabled',
                                                ));
                                            
                                            
                                              echo form_input(array(

                                                'value'         => $student_info->sub_pro_id,
                                                'name'          => 'old_sub_pro_id',
                                                'type'          => 'hidden',
                                                'class'         => 'form-control',
                                                 
                                                ));
                                        ?>
                                    </div>
                               <div class="col-md-3">
                                    <label for="name">Group</label>
                                        <?php 
                                            echo form_input(array(
                                                'value'         => $student_info->sectionsName,
                                                'class'         => 'form-control',
                                                'disabled'      => 'disabled',
                                                ));
                                            
                                              echo form_input(array(

                                                'value'         => $student_info->section_id,
                                                'name'          => 'old_section_id',
                                                'class'         => 'form-control',
                                                 'type'          => 'hidden',
                                                ));
                                        ?>
                                    </div>
                            </div>
                             <hr/>
                            <h1 class="section-heading text-highlight">
                                <span class="line">Transfer To</span>
                            </h1>  
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Program</label>
                                        <?php 
                                            echo form_dropdown('program_id', $program,'',  'class="form-control" id="program-id"');
                                        ?>
                                </div>
                               <div class="col-md-3">
                                    <label for="name">Batch</label>
                                        <?php 
                                            echo form_dropdown('batch_id', $batch,'',  'class="form-control" id="batch-id"');
                                        ?>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Sub Program</label>
                                        <?php 
                                            echo form_dropdown('sub_pro_id', $sub_pro_name,'',  'class="form-control" id="sub-pro-name"');
                                        ?>
                                </div>
                               <div class="col-md-3">
                                    <label for="name">Section</label>
                                        <?php 
                                            echo form_dropdown('section_id', $section,'',  'class="form-control" id="fetch-section"');
                                           ?>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Comments</label>
                                        <?php 
                                            echo form_textarea(array(
                                                'name'          => 'fee_comments',
                                                'id'            => 'challan_comment',
                                                'cols'          => '40',
                                                 'rows'          => '2',
                                                'class'         => 'form-control',
                                                'required'      => 'required',  
                                                ));
                                           
                                         ?>
                                </div>
                            </div>
                           <?php endif; ?>
                            <div style="padding-top:2%;">
                                <div class="col-md-4 col-md-offset-1 pull-right">
                                        <button type="submit" class="btn btn-theme" name="search" id="search"  value="search" ><i class="fa fa-search"></i> Search</button>
                                        <?php if(!empty($student_info)):
                                            echo '<button type="submit" class="btn btn-theme" name="transferStudent" id="transferStudent"  value="transferStudent" ><i class="fa fa-book"></i>Transfer Student</button>';
                                            endif; 
                                        ?>  
                                </div>
                            </div>
                        </div><!--//section-content-->
                    </section>
                </div>
                <?php echo form_close();?>  
            </div>
        </div>
    </div>
   
  