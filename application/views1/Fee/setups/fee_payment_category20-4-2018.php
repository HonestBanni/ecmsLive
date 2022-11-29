 
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
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                                  
                                     ?>
                                <div class="row">
                                      
                                     
                                    <div class="col-md-2">
                                    <label for="name">Program</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control feeProgrameId" id="feeProgrameId"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="name">Sub Program</label>
                                    <div class="form-group ">
                                        <?php 
                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('sub_pro_nameId', $sub_program,$sub_pro_id,  'class="form-control" id="showFeeSubPro"');
                                        ?>
                                    </div>
                                </div>
                                     <div class="col-md-2">
                                    <label for="name">Batch</label>
                                        <?php
                                            $batch_id = array(
                                                ''=>"Select Batch"
                                            );
                                            echo form_dropdown('batch_id_name_code', $batch_id, '','class="form-control  " id="batch_id"');
                                        ?>
                                </div>
                               
                                 <div class="col-md-3 col-sm-5">
                                         <label for="name">Payment Category</label>
                                         <?php

                                                 echo form_dropdown('payCategory', $fee_category_titles,'',  'class="form-control" id="pc_id"');
                                            
                                            ?>
                                     
                                     </div>    
                                      
                                </div>
                            <div class="row">
                                     
     
                                      
                                      
                                     
                                
                                     <div class="col-md-4 col-sm-5">
                                          <label for="name">Comment</label>
                                        <?php
                                            
                                            echo form_textarea(array(
                                                'name'          => 'comment',
                                              
                                                'rows'          => '2',
                                                'cols'          => '2',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Comment',    
                                                ));
                                         
                                        ?>
                                       
                                        
                                     </div>
                            </div>
                        <div style="padding-top:1%;">
                                <div class="col-md-2 pull-right">
                                    <button type="submit" class="btn btn-theme" name="add" id="add"  value="add" ><i class="fa fa-plus"></i> Save</button>
                                    <button type="reset" class="btn btn-theme"  id="save"> Reset</button> 
                                 </div>
                        </div>
                          <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                </section>
              
              
              
<!--                <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Search Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                                  
                                     ?>
  
                        <div class="row">
                                   
                                <div class="col-md-2 col-sm-5">
                                         <label for="name">Program</label>
                                         <div class="form-group ">
                                            <?php 
                                                echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control programe_id" id="feeProgrameId"');
                                            ?>
                                        </div>
                          
                                     
                                     </div>
                                      <div class="col-md-2">
                                    <label for="name">Sub Program</label>
                                    <div class="form-group ">
                                        <?php 
                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control sub_pro_id" id="showFeeSubPro"');
                                        ?>
                                    </div>
                                </div> 
                        
                                  <div style="padding-top:2%;">
                                <div class="col-md-2 pull-right">
                                    <button type="button" class="btn btn-theme" name="search_installment" id="search_installment"  value="search_installment" ><i class="fa fa-search"></i> Search  </button>
                                    
                                 </div>
                                </div>
                                
                          
                            </div>
                        
                 
                            
                            
                            
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div>//section-content
                        
                        
                </section>-->
               
                            <div id="search_record">
                                
                            </div>
                            <div class="row" id="all_record">
                                    <div class="col-md-12">
                                        <?php
                                            if(!empty($result)):
                                        ?>
                               
              
                                        <h3 class="has-divider text-highlight">Result :<?php echo count($result)?></h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table" style="font-size:11px;">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Category Title</th>
                                                          <th>Program</th>
                                                          <th>Sub Program</th>
                                                          <th>Batch</th>
                                                          <th>Comment</th>
                                                          <th>Edit</th>
                                                          <th>Delete</th>

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                          foreach($result as $row):
//                                                            
                                                           $sn++;
                                                            echo '<tr ">
                                                                <th>'.$sn.'</th>
                                                                <th>'.$row->title.'</th>
                                                                <th>'.$row->programe_name.'</th>
                                                                <th>'.$row->name.'</th>
                                                                <th>'.$row->batch_name.'</th>
                                                                <th>'.$row->comments.'</th>';
                                                                ?>
                                                            <td><a href="paymentCategoryUpdate/<?php echo $row->pc_id;?>"  class="productstatus"><button type="button" class="btn btn-theme btn-xs"> Edit </button></a></td> 
                                                            <td><a href="pcDelete/<?php echo $row->pc_id;?>"  onclick="return confirm('Are You Sure to Delete This..?')"  class="productstatus"><button type="button" class="btn btn-danger btn-xs"> Delete</button></a></td>  
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
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
 
    
    
    <!--// Record From Tog--> 
     
        <!--// Record To Tog--> 
 