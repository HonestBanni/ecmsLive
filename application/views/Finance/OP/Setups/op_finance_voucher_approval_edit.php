
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?=$page_heading?>
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
          <li class="current"><?=$page_heading?>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">                            
          
            <div class="row">
            <div class="col-md-12">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?=$page_heading?> Panel</span>
                        </h1>
                        <div class="section-content">
                           <?php echo form_open('',array('class'=>'course-finder')); ?>
                                <div class="row">
                               
                               <div class="col-md-3 form-group">
                                    <label for="name">Employee Name</label>
                                     <?php
                                            echo form_input(array(
                                                'id'            => 'select_employee',
                                                'class'         =>'form-control',
                                                'placeholder'   =>'Employee Name',
                                                 'value'         => $result_query->emp_name,
                                                'required'      =>'required'
                                                ));
                                            echo form_input(array(
                                                'name'          => 'employeer_id',
                                                'id'            => 'employeer_id',
                                                'value'         => $result_query->emp_id,
                                                'class'         =>'form-control',
                                                'type'          =>'hidden',
                                                'required'      =>'required'
                                                ));
                                           ?>   
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="name">Set name for print</label>
                                     <?php
                    
                                         echo  form_input(array(
                                            'name'          => 'set_name',
                                            'id'            => 'set_name',
                                            'class'         =>'form-control',
                                            'placeholder'   =>'Designation',
                                            'required'      =>'required',
                                            'value'         => $result_query->name,
                                            'type'          =>'text'
                                            ));
                                            ?>   
                                </div>    
                                <div class="col-md-3 form-group">
                                    <label for="name">Set designation for print</label>
                                     <?php
                    
                                        echo  form_input(array(
                                            'name'          => 'set_designation',
                                            'id'            => 'set_designation',
                                            'class'         =>'form-control',
                                            'placeholder'   =>'Designation',
                                            'required'      =>'required',
                                            'value'         => $result_query->designation,
                                            'type'          =>'text'
                                            ));
                                            ?>   
                                </div>    
                               <div class="col-md-3 form-group">
                                    <label for="name">Print Order</label>
                                     <?php
                                              echo form_input(array(
                                                   'name'           => 'order',
                                                   'class'         =>'form-control ',
                                                   'placeholder'   =>'Person Order',
                                                   'required'      =>'required',
                                                  'value'         => $result_query->appr_order
                                                ));
                                            
                                            ?>   
                                </div>
                               <div class="col-md-3 form-group">
                                    <label for="name">Financial Year</label>
                                     <?php
                                               echo form_dropdown('fy_id',$financialYear,$result_query->designation,'class="form-control"');
                                            
                                            ?>   
                                </div>
                               <div class="col-md-3 form-group">
                                    <label for="name">Status</label>
                                     <?php
                                     $status = array(
                                         '0'    => 'In-Acitve',
                                         '1'    => 'Active',
                                     );
                                     
                                               echo form_dropdown('status_id',$status,$result_query->status,'class="form-control"');
                                            
                                            ?>   
                                </div>
                               <div class="col-md-3 form-group pull-right">
                                   <label for="name" style=" visibility: hidden;">Print Order sdfdsfdsf</label>
                                   <button type="submit" name="btn-update" value="btn-update" class="btn btn-theme form-control"><i class="fa fa-book"></i> Update</button>
                                      
                                </div>
                             <?php echo form_close(); ?>
                         </div>
                </section>
           
            </div>
          </div>

         <?php echo form_close(); ?>     
          
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
 <script>
 
 jQuery(document).ready(function(){
     jQuery("#select_employee").autocomplete({  
        minLength: 0,
        source: "DropdownController/employee_name_with_designation_auto/"+$("#select_employee").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#employeer_id").val(ui.item.id);
        jQuery("#set_name").val(ui.item.value);
        jQuery("#set_designation").val(ui.item.designation);
              }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
     
 });
 
 
 </script>
      