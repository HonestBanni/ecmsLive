 
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
                                   <div class="col-md-3 col-sm-5">
                                         <label for="name">Installment No</label>
                                         <?php
                                            echo form_dropdown('installment_type',$installment_type,$instal_type_id,  'class="form-control" required="required"');
                                            ?>
                                     
                                     </div>
                                   <div class="col-md-3 col-sm-5">
                                         <label for="name">Type</label>
                                         <?php
                                            echo form_dropdown('head_type',$head_type,$head_typeId,  'class="form-control" ');
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <input type="hidden" name="formCode" id="formCode" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date);?>">
                                         <label for="name">Batch</label>
                                         <?php
                                                echo form_dropdown('batch',$batch,$batch_id,  'class="form-control" required="required"');
                                            ?>
                                     
                                     </div>
                            </div>
                                <div class="row">
                                      
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Fee Head</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'feehead',
                                                    'id'            => 'feehead',
                                                    'class'         => 'form-control',
                                                     
                                                    'placeholder'   => 'Fee Head',
                                                    'type'          => 'text',
                                                    'value'         => $feehead,
                                                    ));
                                                echo form_input(array(
                                                    'name'          => 'feehead_id',
                                                    'id'            => 'feehead_id',
                                                    'class'         => 'form-control',
                                                    'type'          => 'hidden',
                                                    ));
                                                echo form_input(array(
                                                    'name'          => 'type',
                                                    'id'            => 'type',
                                                    'class'         => 'form-control',
                                                    'type'          => 'hidden',
                                                    ));
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Amount</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'amount',
                                                    'id'            => 'hostel_amount',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Amount',
                                                    'type'          => 'text',
                                                    'value'         => $amount,
                                                     
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                  
                                    
                                    <?php 
                                if(@$id):

                                echo '<div class="col-md-3 col-sm-5">
                                         <label for="name">Status</label>';
                                $statusArray = array(
                                    '1'=>'Active',
                                    '0'=>'Deactive'
                                    );
                                echo form_dropdown('status',$statusArray,$status,  'class="form-control" id="my_id"');
                                echo '</div>';
                                endif;

                                ?>
                                    
                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                  
                                    
                                    <button type="button" class="btn btn-theme" name="add_demo" id="add_demo"  value="add_demo" ><i class="fa fa-plus"></i> Add</button>
                                    <button type="submit" class="btn btn-theme" name="add" id="add"  value="add" ><i class="fa fa-book"></i> Save</button>
                                    <button type="reset" class="btn btn-theme"> Reset</button> 
                                    
                                        
                                    
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
              <div class="col-md-6 col-md-offset-3">
                  <div id="show_result">
                  
              </div>
              </div>
              
                <div class="row">
                    <div class="col-md-12">
                                        <?php
                                        $class = array(
                                                'info',
                                                'success',
                                                'danger',
                                                'warning',
                                                'active',
                                            );
                                
                                      if(!empty($result)):
                                          
                                    
                                        ?>
                               
              
                                        <h3 class="has-divider text-highlight">Result :<?php echo count($result)?></h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Head </th>
                                                          <th>Amount</th>
                                                          <th>Head Type</th>
                                                          <th>Installments</th>
                                                          <th>Batch</th>
                                                          <th>Status</th>
                                                          <th>Edit</th>
                                                          <th>Delete</th>

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                       
                                                          foreach($result as $row):
//                                                              echo '<pre>';print_r($row);die;
                                                           $sn++;
                                                            echo '<tr class="">
                                                                <td>'.$sn.'</th>
                                                                <td>'.$row->hostel_title.'</td>
                                                                <td>'.$row->amount.'</td>
                                                                <td>'.$row->head_title.'</td>
                                                                <td>'.$row->category_title.'</td>
                                                                <td>'.$row->batch_name.'</td>
                                                                     ';
                                                             
                                                            echo '<td>';
                                                            if($row->status == 1):
                                                                  echo '<button class="btn btn-success btn-xs">Active</button>';
                                                                  else:
                                                                  echo '<button class="btn btn-info btn-xs">Deactive</button>';
                                                              endif;
                                                              echo '</td>';
                                                              
                                                              
                                                            echo '
                                                                 ';
                                                                       ?>
                                                                    <td>  <a href="hostelMessHeadsNewEdit/<?php echo $row->id;?>"  class="productstatus"><button type="button" class="btn btn-theme btn-xs"> Edit </button></a>
                                                                  </td> 
                                                                  <td> 
                                                                   <a href="HMDelete/<?php echo $row->id;?>"  onclick="return confirm('Are You Sure to Delete This..?')"  class="productstatus"><button type="button" class="btn btn-danger btn-xs"> Delete</button></a>
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
                
    
      
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
 
    
       
        <!--// Record To Tog--> 
   
     
     <script>
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 3,
        dateFormat: 'd-m-yy'
    });
  } );
  </script>        
 
  
 