
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
        <article class="contact-form col-md-12 col-sm-7  page-row">                            
          <?php echo form_open('',array('class'=>'form-inline')); ?>
            <div class="row">
            <div class="col-md-12 ">
              
<!--              <div class="form-group">
                 
              </div>-->
              <!--//form-group-->
              <div class="form-group ">
                  <input name="college_no" value="<?php if($college_no): echo $college_no;endif; ?>"type="number" class="form-control" placeholder="College No">
              </div>
              
              <!--//form-group-->     
              <div class="form-group">
                  <input name="student_name" type="text" value="<?php if($student_name): echo $student_name;endif; ?>" class="form-control" placeholder="Name">
              </div>
              <!--//form-group-->
              <div class="form-group">
                <input name="father_name" type="text" value="<?php if($father_name): echo $father_name;endif; ?>"  class="form-control" placeholder="Father name">
              </div>
              <!--//form-group-->
              
              <div class="form-group">
                <?php 
                    echo form_dropdown('program', $program, $programId,  'class="form-control feeProgrameId" id="feeProgrameId"');
                ?>
              </div>
              <!--//form-group-->
              <div class="form-group">
                <?php 
                echo form_dropdown('sub_program', $subprogrames, $subprogramId,  'class="form-control" id="showFeeSubPro"');
                ?>
              </div>
              
              <div class="form-group">
                <?php 
                echo form_dropdown('sections_name', $sections, $sectionId,  'class="form-control" id="showSections"');
                ?>
              </div>
             <div class="form-group">
                <button type="submit" name="search" value="search" class="btn btn-theme">
                    <i class="fa fa-search">
                  </i> Search
                </button>
                <button type="button" name="Print" value="Print" id="bs_stdPrint" class="btn btn-theme">
                    <i class="fa fa-print">
                  </i> Print
                </button>
              </div>
            </div>
          </div>
         <?php echo form_close(); ?>     
            <?php
            if(@$result):
            ?>
            <h3 class="has-divider text-highlight">Result :<?php echo $countResult?></h3>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>College #</th>
               
                  <th>Name</th>
                  <th>Father name</th>
                
                  <th>Program</th>
                  <th>Sub program</th>
                  <th>section</th>
               
               
                  
                   
                  <th>Status</th>
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
                                <td>'.$resRow->subprogram.'</td>
                                <td>'.$resRow->sectionName.'</td>
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
 
 