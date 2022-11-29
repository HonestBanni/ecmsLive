
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?php echo $ReportName?>
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
          <li class="current"><?php echo $ReportName?>
          </li>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
          <div class="col-md-12 ">
              <section class="course-finder" style="padding-bottom: 2%;">
                    <h1 class="section-heading text-highlight">
                        <span class="line"><?php echo $ReportName?> Panel</span>
                    </h1>
                    <div class="section-content" >
                        <?php echo form_open('',array('class'=>'course-finder-form')); ?>
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                    <label for="name">From#</label>
                                        <?php 
                                            echo  form_input(array(
                                                       'name'          => 'from_no',
                                                       'type'          => 'text',
                                                       'value'         => $from,
                                                       'class'         => 'form-control',
                                                       'placeholder'    => 'Form #'
                                                    ));?>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                    <label for="name">College No</label>
                                        <?php 
                                            echo  form_input(array(
                                                       'name'          => 'college_no',
                                                       'type'          => 'text',
                                                       'value'         => $college_no,
                                                       'class'         => 'form-control',
                                                       'placeholder'   => 'College No'
                                                    ));?>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                    <label for="name">Student Name</label>
                                        <?php 
                                            echo  form_input(array(
                                                       'name'          => 'student_name',
                                                       'type'          => 'text',
                                                       'value'         => $student_name,
                                                       'class'         => 'form-control',
                                                       'placeholder'   => 'Student Name'
                                                    ));?>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                    <label for="name">Father Name</label>
                                        <?php 
                                            echo  form_input(array(
                                                       'name'          => 'father_name',
                                                       'type'          => 'text',
                                                       'value'         => $father_name,
                                                       'class'         => 'form-control',
                                                       'placeholder'   => 'Father Name'
                                                    ));?>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                    <label for="name">Program</label>
                                        <?php echo form_dropdown('program', $program, $programId,  'class="form-control feeProgrameId" id="feeProgrameId"');?>
                            </div>
                            
                            <div class="col-md-3 col-sm-12">
                                    <label for="name">Sub Program</label>
                                        <?php echo form_dropdown('sub_program', $subprogram, $subprogramId,  'class="form-control" id="showFeeSubPro"');?>
                            </div> 
                            <div class="col-md-3 col-sm-12">
                                    <label for="name">Section</label>
                                        <?php echo form_dropdown('sections_name',$section, $sectionId,  'class="form-control" id="showSections"');?>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                    <label for="name">Student Status</label>
                                        <?php echo form_dropdown('student_status',$status, $statusId,  'class="form-control"');?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-12 pull-right">
                                <label for="name" style="visibility: hidden">Sectionasdasda</label>
                                       <button type="submit" name="search" value="search" class="btn btn-theme"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?> 
                    </div>
                </section>
          </div>
          
          
        <article class="contact-form col-md-12 col-sm-7  page-row">                            
              
            <?php
            if(@$result):
            ?>
            <h3 class="has-divider text-highlight">Result :<?php echo count($result)?></h3>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>College #</th>
                  <th>Name</th>
                  <th>Father name</th>
                 <th>Program</th>
                 <th>Batch</th>
                  <th>Sub program</th>
                  <th>Section</th>
                  <th>Status</th>
                  <th>Print White Card</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach($result as $resRow):
                          
                      echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$resRow->college_no.'</td>
                                <td>'.$resRow->student_name.'</td>
                                <td>'.$resRow->father_name.'</td>
                                <td>'.$resRow->programe_name.'</td>
                                <td>'.$resRow->batch_name.'</td>
                                <td>'.$resRow->subprogram.'</td>
                                <td>'.$resRow->sectionName.'</td>
                                <td>'.$resRow->studentstatus.'</td>
                               <td><a href="whiteCardPrint/'.$resRow->student_id.'/'.$resRow->sec_id.'">View WhiteCard</a></span>
                                </td>
                              </tr>';
                   $sn++;
                  endforeach;
                ?>
                
              </tbody>
            </table>
            <?php
            else:
                echo '<h3 class="has-divider text-highlight">No query found..</h3>';
            endif;
            ?>
            </article>
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 