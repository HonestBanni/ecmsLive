<style>
    input[type=checkbox]{
    zoom: 1.5;
    }
</style>

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
            <div class="col-md-12">
 
              
              <!--//form-group-->
                <p><strong style="font-size:16px;">Current Info</strong></p>
                <div class="form-group">
                <?php 
                echo form_dropdown('prospectus_batch_old', $old_batch, '',  'class="form-control" required="required"');
                ?>

                </div>
                <div class="form-group">
                <?php 
                echo form_dropdown('sections_name', $sections, $sectionId,  'class="form-control" id="showingSections" required="required"');
                ?>

                </div>
                
                <div class="form-group">
              <?php 
              $status = array(
                'Off' =>'Off'  
              );
                echo form_dropdown('sections_status', $status, '',  'class="form-control" required="required"');
                ?>

                </div>
                  
            </div>
            <div class="col-md-12">
 
              <!--//form-group-->
                <p><strong style="font-size:16px;">New Section</strong></p>
                <div class="form-group">
                    <input type="text" name="new_sections" value="<?php echo $SectionName->name?>"   required="required" class="form-control" placeholder="Sections ">
                    

                </div>
                
                <div class="form-group">
                  <p><strong style="font-size:16px;">New Batch</strong></p>
              <?php 
               
                echo form_dropdown('batch_id', $batch, '',  'class="form-control" required="required"');
                ?>

                </div>
                
             
                 
        <div class="form-group">
            <button type="submit" name="search" value="search" class="btn btn-theme">
                <i class="fa fa-search">
              </i> Update
            </button>
          </div>
               
            </div>
          </div>
            
           
            
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
 
 