 
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
          <div class="col-md-12">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form','id'=>'print_wise_form'));
                                  
                                     ?>
                                <div class="row">
                                <div class="col-md-4 col-sm-5">
                                      <label for="name">Category Name</label>

                                       
                                            <?php
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'category_name',
                                                            'type'          => 'text',
                                                            'value'         => $category_name,
                                                            'class'         => 'form-control',
                                                            'required'         => 'required',
                                                            'placeholder'   => 'Category Name',
                                                             )
                                                         );
                                                  ?>
                                       

                                 </div>
                                 
                            </div>
                              
                           </div><!--//section-content-->
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-5 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="search" id="search"  value="search" ><i class="fa fa-search"></i> Search</button>
                                    <button type="button" class="btn btn-theme"   id="NewCategory"  value="NewCategory"  data-toggle="modal" data-target="#myModal" ><i class="fa fa-book"></i> New Cagegory</button>
                                   
                                    
     
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                        
                        
                        
                    </section>
           <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="NewCategory">
            <<div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Book Category</h4>
                </div>
                <div class="modal-body">
                    <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form','id'=>'print_wise_form'));
                                  
                                     ?>
                                <div class="row">
                                <div class="col-md-6 col-sm-5">
                                      <label for="name">Category Name</label>

                                       
                                            <?php
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'category_name',
                                                            'type'          => 'text',
                                                            'class'         => 'form-control',
                                                            'required'      => 'required',
                                                            'placeholder'   => 'Category Name',
                                                             )
                                                         );
                                                  ?>
                                       

                                 </div>
                                 
                            </div>
                              
                           </div><!--//section-content-->
                </div>
                <div class="modal-footer">
                    <button type="submit" name="save" value="save" class="btn btn-theme" >Save </button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                </div>
              </div>
            </div>
          </div>
           
                <div class="col-md-12">
                    <?php

                  if(!empty($results)):

//                                    echo '<pre>';print_r($result);
                    ?>
                 <div id="div_print">

                    <h3 class="has-divider text-highlight">Result :<?php echo count($results)?></h3>
                    <div class="table-responsive">
                          <table class="table table-hover" id="table" >
                                <thead>
                                  <tr>

                                      <th>#</th>
                                      <th>Category Name</th>
                                      <th>Edit</th>


                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sn = '';
                                      foreach($results as $row):

                                       $sn++;
                                        echo '<tr">
                                            <td>'.$sn.'</td>
                                            <td>'.$row->subject_name.'</td>

                                             ';
                                                   ?>

                                              <td> 
                                                  <button id="<?php echo $row->subject_id;?>"  data-toggle="modal" data-target="#UpdateModal"   type="button" class="btn btn-success btn-xs UpdateModal"> Update</button>
                                               </td>  
                                            <?php

                                        echo '</tr>';

                                      endforeach;      


                                    ?>

                                </tbody>
                        </table>
                    </div>
                      <?php
                  endif;
                ?> 
                </div>
                </div>
 
                                  
                                </div>
 
          </div>
          
      
      </div>
                 </div>
                
    <div class="modal fade" id="UpdateModal" tabindex="-1" role="dialog" aria-labelledby="NewCategory">
            <<div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Book Category</h4>
                </div>
                  <div id="categoryShow">
                                          
                    </div>
                   
                          
                
                
                     
              </div>
            </div>
          </div>
      
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 
 
    

<!-- <script>
 
</script>-->
  <script type="text/javascript">
      
       jQuery(document).ready(function(){
     
     jQuery('.UpdateModal').on('click',function(){
            jQuery.ajax({
                type    :'post',
                url     :'LibraryController/book_category_get_record', 
                data    :{'getRecord':'getRecord','subjId':jQuery(this).attr('id')},
                success :function(result){
                jQuery('#categoryShow').html(result);
             }
         });
//         
     });
     jQuery('.UpdateCategory').on('click',function(){
         
         alert(jQuery('#category_nameup').val());
         
//            jQuery.ajax({
//                type    :'post',
//                url     :'LibraryController/book_category_get_record', 
//                data    :{'getRecord':'getRecord','subjId':jQuery(this).attr('id')},
//                success :function(result){
//                jQuery('#categoryShow').html(result);
//             }
//         });
//         
     });
     
 });
 
    </script>
 
  <style>
      .datepicker{
          z-index: 1;
      }
  </style>     
  
 
  
  
   