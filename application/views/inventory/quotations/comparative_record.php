
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?php echo $page_header?>
      </h1>
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
                            <div class="col-md-4 col-sm-5">
                                <label for="name">Title</label>
                                <?php
                                    echo form_input(array(
                                       'name'          => 'cs_title',
                                       'id'            => 'cs_title',
                                       'class'         => 'form-control',
                                       'placeholder'   => 'Title',
                                       'type'          => 'text'
                                    ));
                                ?>
                            </div>
                            <div class="col-md-2 col-sm-5">
                                <label for="name">Minute Sheet No.</label>
                                <?php
                                    echo form_input(array(
                                       'name'          => 'minute_sheet',
                                       'id'            => 'minute_sheet',
                                       'class'         => 'form-control',
                                       'type'          => 'text'
                                    ));
                                ?>
                            </div>
                            <div class="col-md-2 col-sm-5">
                                <label for="name">Requisition No.</label>
                                <?php
                                    echo form_input(array(
                                       'name'          => 'requisition',
                                       'id'            => 'requisition',
                                       'class'         => 'form-control',
                                       'type'          => 'text'
                                    ));
                                ?>
                            </div>
                            <div class="col-md-2 col-sm-5">
                            <label for="name">Start Date (dd-mm-yyyy)</label>
                                <?php
                                    echo form_input(array(
                                        'name'          => 'start_date',
                                        'id'            => 'start_date',
                                        'type'          => 'text',
                                        'value'         => date('d-m-Y'),
                                        'class'         =>'form-control datepicker',
                                        ));
                                ?>
                             </div>
                            <div class="col-md-2 col-sm-5">
                            <label for="name">End Date (dd-mm-yyyy)</label>
                                <?php
                                    echo form_input(array(
                                        'name'          => 'end_date',
                                        'id'            => 'end_date',
                                        'type'          => 'text',
                                        'value'         => date('d-m-Y'),
                                        'class'         =>'form-control datepicker',
                                        ));
                                ?>
                             </div>
                        <div class="col-md-2 ">
                            <p style="margin:0; margin-top: 5px;">&nbsp;</p>
                            <button type="button" class="btn btn-theme" name="searchCS" id="searchCS"  value="searchCS" ><i class="fa fa-search"></i> Search</button>
                        </div>

                          </div>

                    <?php echo form_close(); ?>
                 </div><!--//section-content-->
                    </section>
               
                    <div id="ComparativeGrid"></div>  
          

          
       
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
    
    $( function() {
    $( ".datepicker" ).datepicker({
        dateFormat: 'd-m-yy'
    });
  } );
    
    jQuery(document).ready(function(){
        jQuery('#searchCS').on('click',function(){
            var data = { 
                'cs_title'      : jQuery('#cs_title').val(), 
                'minute_sheet'  : jQuery('#minute_sheet').val(), 
                'requisition'   : jQuery('#requisition').val(), 
                'q_start_date'  : jQuery('#start_date').val(), 
                'q_end_date'    : jQuery('#end_date').val() 
            };
            jQuery.ajax({
                type    : 'post',
                url     : 'SearchComparative',
                data    : data,
                success: function(result){
                    jQuery('#ComparativeGrid').html(result);
                }
            });  
        });
    });
</script>