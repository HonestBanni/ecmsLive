
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
                                                'required'      =>'required'
                                                ));
                                            echo form_input(array(
                                                'name'          => 'employeer_id',
                                                'id'            => 'employeer_id',
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
                                                ));
                                            
                                            ?>   
                                </div>
                               <div class="col-md-3 form-group">
                                    <label for="name">Financial Year</label>
                                     <?php
                                               echo form_dropdown('fy_id',$financialYear,'','class="form-control"');
                                            
                                            ?>   
                                </div>
                               <div class="col-md-3 form-group pull-right">
                                   <label for="name" style=" visibility: hidden;">Print Order sdfdsfdsf</label>
                                   <button type="submit" name="btn-save" value="btn-save" class="btn btn-theme form-control"><i class="fa fa-plus"></i> Save</button>
                                      
                                </div>
                             <?php echo form_close(); ?>
                         </div>
                </section>
           
            </div>
          </div>

         <?php echo form_close(); ?>     
            
             
             <?php
            if(@$fnYear):
            ?>
            <h3 class="has-divider text-highlight">Result :<?php echo count(@$fnYear)?></h3>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th >S.no</th>
                   <th>Employee Name</th>
                   <th>Print Name</th>
                   <th>Print Designation</th>
                   <th>Account Type</th>
                   <th>Show Order</th>
                   <th>Status</th>
                   <th>Manage</th>
                  
                  
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach(@$fnYear as $urRow):
                       if($urRow->status){$status="<a><span class='btn btn-info btn-sm'>Active Year</span></a>";}else{$status="<a><span class='btn btn-theme btn-sm'>Deactive</span></a>";}
                      echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$urRow->emp_name.'</td>
                                <td>'.$urRow->name.'</td>
                                <td>'.$urRow->designation.'</td>
                                <td>'.$urRow->title.'</td>
                                <td>'.$urRow->appr_order.'</td>
                               
                                <td>'.$status.'</td>
                                <td>
                                <a href="HmVoucherEdit/'.$urRow->id.'" class="productstatus" ><span class="btn btn-success btn-sm">EDIT</span></a> &nbsp;';
//                                echo '<a href="VochApprDelete/'.$urRow->id.'" class="productstatus" ><span class="btn btn-danger btn-sm">DELETE</span></a>';
                                    
                                echo '</td>
                               
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
 