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
                <p><strong style="font-size:16px;">Sections Info</strong></p>
                <div class="form-group">
                <?php 
                 
                if(isset($all_sections) && !empty($all_sections)):
                    
                
                    foreach($all_sections as $key=>$value):

                        $sections_info          = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$value));
                        $sections_old           = $this->CRUDModel->dropDown('sections', '', 'sec_id', 'name',array('sec_id'=>$sections_info->sec_id));

                     echo form_dropdown('off_sections_ids[]', $sections_old, $sections_info->sec_id,  'class="form-control"');
                    endforeach;
                  endif;
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
                    
                     <?php 
                 
                    if(isset($all_sections) && !empty($all_sections)):
                        foreach($all_sections as $key=>$value):

                            $sections_info          = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$value));
                             
                            echo '<input type="text" name="new_sections[]" value="'.$sections_info->name.'"   required="required" class="form-control" placeholder="Sections ">';
                         
                        endforeach;
                    endif;
                        ?>
                  
                </div>
                
                <div class="form-group">
              <?php 
               
                echo form_dropdown('batch_new_id', $batch, '',  'class="form-control" required="required"');
                
                
                    echo '<input type="hidden" name="program_name" value="'.$program.'"   class="form-control" placeholder="program">';
                    echo '<input type="hidden" name="sub_program" value="'.$sub_program.'"  class="form-control" placeholder="Sub Program ">';
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
 
 