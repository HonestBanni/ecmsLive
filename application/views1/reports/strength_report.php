
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?php echo $page_header?>
      </h1>
      <div class="breadcrumbs pull-right">
      </div>
      <!--//breadcrumbs-->
    </header> 
      
    <div class="page-content">
        
      <div class="row">
           <section class="course-finder" style="padding-bottom: 2%;">
                <h1 class="section-heading text-highlight">
                    <span class="line">Search Panel</span>
                </h1>
                <div class="section-content" >
                   <?php echo form_open('',array('class'=>'course-finder-form')); ?>
                        <div class="row"> 
                             <div class="col-md-3 col-sm-5">
                                <label for="name">Program</label>
                                <div class="form-group ">
                                    <?php echo form_dropdown('programe_id', $program, $programe_id,  'class="form-control" id="feeProgrameId"'); ?>
                                </div>
                             </div>
                           
                             <div class="col-md-3 col-sm-5">
                                <label for="name">Sub Program</label>
                                <div class="form-group ">
                                    <?php echo form_dropdown('sub_pro_id', $sub_program, $sub_pro_id,  'class="form-control sub_pro_id" id="showFeeSubPro"'); ?>
                                </div>
                             </div>
                           
                             <div class="col-md-3 col-sm-5">
                                <label for="name">Batch</label>
                                <div class="form-group ">
                                    <?php echo form_dropdown('batch', $batch, $batchId,  'class="form-control" id="batch_id"'); ?>
                                </div>
                             </div>
                           
                        <div class="col-md-1 ">
                            <p style="margin:0; margin-top: 5px;">&nbsp;</p>
                            <div class="form-group ">
                            <button type="button" class="btn btn-theme " name="searchData" id="searchData"  value="searchData" ><i class="fa fa-search"></i> Search</button> 
                            </div>
                        </div>
                        <div class="col-md-1 ">
                            <p style="margin:0; margin-top: 5px;">&nbsp;</p>
                            <div class="form-group ">
                            <button type="submit" class="btn btn-theme" name="ExportData" id="ExportData"  value="ExportData" ><i class="fa fa-save"></i> Export</button>
                            </div>
                        </div>

                          </div>

                    <?php echo form_close(); ?>
                 </div><!--//section-content-->
                    </section>
               
                    <div id="SearchGrid"></div>  
          

          
       
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
<script>
    
    jQuery(document).ready(function(){
        jQuery('#searchData').on('click',function(){
            var data = { 
                'program'       : jQuery('#feeProgrameId').val(), 
                'sub_program'   : jQuery('#showFeeSubPro').val(), 
                'batch'         : jQuery('#batch_id').val() 
            };
            jQuery.ajax({
                type    : 'post',
                url     : 'SearchStrength',
                data    : data,
                success: function(result){
                    jQuery('#SearchGrid').html(result);
                }
            });  
        });
    });
</script>