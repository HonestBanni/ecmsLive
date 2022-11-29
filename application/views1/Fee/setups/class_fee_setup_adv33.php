 
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
                           <?php echo form_open('',array('class'=>'course-finder-form')); ?>
                            

                            
                            
                            <div class="row">
                                    <div class="col-md-3 col-sm-5">
                                            <label for="name">Program</label>
                                            <?php 
                                           echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control" required="required" id="programIdInstallHead"');
                                            ?>
                                    </div>
                                    <div class="col-md-3 col-sm-5">
                                        <label for="name">Batch</label>
                                            <?php 
                                            $batch_id = array( ''=>"Select Batch" );
                                            echo form_dropdown('batch_id_name_code', $batch_id, '','class="form-control" required="required" id="batch_id"');?>
                                    </div>
                                    <div class="col-md-3 col-sm-5">
                                        <label for="name">Payment Category</label>
                                        <input type="hidden" name="formCode" id="formCode" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date);?>">
                                              
                                            <?php 
                                              $pc_id = array(
                                                ''=>"Payment Category"
                                            );
                                             echo form_dropdown('pc_id', $pc_category, '','class="form-control" required="required"');
                                             
                                            ?>
                                    </div>
                                    <div class="col-md-3 col-sm-5">
                                              <label for="name">Shift</label>
                                            <?php 
                                                echo  form_dropdown('shift_name_code', $fee_shift,$fee_shift_id,  'class="form-control"');
                                            ?>
                                    </div>
                            </div>
                            
                            
                            <div class="row">    
 
                                        <div id="showSubProgramInstallmentHead">
                                            
                             
                                
                                    </div>
                       
                                
                               
                                
                                
                                
                            </div>
                            <div class="row">
                                 
                                <div class="col-md-3 col-sm-5">
                                            <label for="name">Payment From</label>
                                            <?php 
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'fee_from',
                                                           'id'            => 'fee_from',
                                                           'class'         => 'form-control datepicker',
                                                           'placeholder'   => 'Payment From',
                                                            'required'   => 'required',
                                                            )
                                                        );
                                       
                                            
  
 
                                            ?>
                                    </div>
                                <div class="col-md-3 col-sm-5">
                                              <label for="name">Payment to</label>
                                             
                                              
                                            <?php 
                                            
                                               echo  form_input(
                                                        array(
                                                            'name'          => 'fee_to',
                                                           'id'            => 'fee_to',
                                                           'class'         => 'form-control datepicker',
                                                           'placeholder'   => 'Payment To',
                                                            'required'   => 'required',
                                                            ));
                                           ?>
                                </div>
                                <div class="col-md-3 col-sm-5">
                                              <label for="name">Valid Till</label>
                                             
                                              
                                            <?php 
                                            
                                               echo  form_input(
                                                        array(
                                                            'name'          => 'valid_till',
                                                           'id'            => 'valid_till',
                                                           'class'         => 'form-control datepicker',
                                                           'placeholder'   => 'Paymetn Valid',
                                                           'required'   => 'required',
                                                            ));
                                           ?>
                                </div>
                                 
                                 
                                
                                
                                
                            </div>
                            
                                <div class="row">
                                      
                                     <div class="col-md-3 col-sm-5">
                                              <label for="name">Fee Head</label>
                                              
                                                  <?php 
                                            
                                               echo  form_input(
                                                        array(
                                                           'name'          => 'fee_head_name',
                                                           'id'            => 'fee_head_name',
                                                           'class'         => 'form-control',
                                                           'placeholder'   => 'Payment Category',
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'fee_head',
                                                           'id'            => 'fee_head',
                                                           'class'         => 'form-control',
                                                           'type'           => 'hidden',
                                                            )
                                                        );
 
                                            ?>
                                              
                                          
                                    </div>
                                     
                                      
                                    <div class="col-md-2 col-sm-5">
                                          <label for="name">Account</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'amount',
                                                                'id'            => 'fee_head_amount',
                                                                'type'          => 'number',
//                                                                'value'       => $recordFrom,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Amount',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                    <div class="col-md-3 col-sm-5">
                                          <label for="name">Comment</label>
                                        <?php
                                            
                                            echo form_textarea(array(
                                                'name'          => 'comment',
                                                'rows'          => '2',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Comment',    
                                                ));
                                         
                                        ?>
                                       
                                        
                                     </div>
                                     
                                    
                                     
                                
                                     
                                     
                                      
                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                    <button type="button" class="btn btn-theme" name="payment_Add" id="payment_Add"  value="payment_Add" ><i class="fa fa-plus"></i> Add</button>
                                    <button type="submit" class="btn btn-theme" name="add"    value="add" ><i class="fa fa-save"></i> Submit</button>
                                    <button type="reset" class="btn btn-theme"  id="save"> Reset</button> 
                                  </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
               <div id="class_setup">
                  
              </div>

              
              
              <div id='class_fee_setup_all'>
                     <div class="row">
                                    <div class="col-md-12">
                                        <?php
                          
                                      if(!empty($result)):
                                          
//                                    echo '<pre>';print_r($result);
                                        ?>
                                     <div id="div_print">
              
                                        <h3 class="has-divider text-highlight">Result :<?php echo count($result)?></h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table" style="font-size:9px;">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Fee Head</th>
                                                          <th>Sub program </th>
                                                          <th>Batch</th>
                                                          <th>Amount</th>
                                                          <th>From</th>
                                                          <th>To</th>
                                                          <th>Till</th>
                                                          <th>Instalment Type</th>
                                                          <th>Comment</th>
                                                          <th>Edit</th>
                                                          <th>Delete</th>

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                          foreach($result as $row):
                                                         
                                                           $sn++;
                                                            echo '<tr">
                                                                <td>'.$sn.'</td>
                                                                <td>'.$row->fh_head.'</td>
                                                                <td>'.$row->name.'</td>
                                                                <td>'.$row->batch_name.'</td>
                                                                <td>'.$row->fcs_amount.'</td>
                                                                     <td>'.date('d-m-Y',strtotime($row->fee_from)).'</td>
                                                                     <td>'.date('d-m-Y',strtotime($row->fee_to)).'</td>
                                                                     <td>'.date('d-m-Y',strtotime($row->valid_till)).'</td>
                                                                <td>'.$row->title.'('.$row->name.')</td>
                                                                <td>'.$row->fcs_comments.'</td>
                                                                 ';
                                                                       ?>
                                                                    <td>  <a href="classSetupsEdit/<?php echo $row->fcs_id;?>"     class="productstatus"><button type="button" class="btn btn-theme btn-xs"> Edit </button></a>
                                                                  </td> 
                                                                  <td> 
                                                                   <a href="csDelete/<?php echo $row->fcs_id;?>"  onclick="return confirm('Are You Sure to Delete This..?')"  class="productstatus"><button type="button" class="btn btn-danger btn-xs"> Delete</button></a>
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
                 </div>
                
    
      
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
   
    <script>
        
       jQuery(document).ready(function(){
                     jQuery('#programIdInstallHead').on('change',function(){
                     var programId=    jQuery('#programIdInstallHead').val();
                     jQuery.ajax({
                               type   :'post',
                               url    :'showSubProgramAddInstallmentHead',
                               data   : {'program_id': programId},
                               success :function(result){
                                jQuery('#showSubProgramInstallmentHead').html(result);
                              },
                              complete:function(){
                                   //Get Batch 
                                jQuery.ajax({
                                    type   :'post',
                                    url    :'feeController/getBatch',
                                    data   :{'programId':programId},
                                   success :function(result){
                                      jQuery('#batch_id').html(result);
                                   }
                                });
                              }
                           });
                         
                     });
            
//            showSubProgramInstallmentHead
            
         jQuery('.payment_cat').on('change',function(){
             
         
            var batch_id        = jQuery('#batch_id').val();
            var showFeeSubPro   = jQuery('#showFeeSubPro').val();
            var pc_id           = jQuery('#pc_id').val();
            
            var data = {
             'batch_id'         : batch_id,
             'showFeeSubPro'   : showFeeSubPro,   
             'pc_id'            : pc_id,   
            }
           
               
                        jQuery.ajax({
                               type   :'post',
                               url    :'installnameCheck',
                               data   : data,
                               success :function(result){
                                   
                                   if(result == 1){
                                        alert('Installment Already Exist');
                                        jQuery('#batch_id').val('');
                                        jQuery('#showFeeSubPro').val('');
                                        jQuery('#pc_id').val('');
                                        jQuery('#feeProgrameId').val('');
                                        jQuery('#feeProgrameId').focus();
                                        return false; 
                                   }
                                  
                              }
                           });
//                 
//                        
                         
                   // }
                 });
                 });
    </script>
   
     
     <script>
     
  
//            installment_name_dublicate_check
 
       
         
         
         
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd-mm-yy'
    });
  } );
  </script>
  <style>
      .datepicker{
          z-index: 1;
      }
      #fee_head_amount{
          
            z-index: 1;

      }
  </style>     
  
 