

<script language="javascript">
  function printdiv(printpage)
  {
//    var headstr = "<html><head><title></title></head><body>";
    var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
    var footstr = "</body>";
    var newstr = document.all.item(printpage).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = headstr+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;
    return false;
  }
</script>


<style>
    
.blink_text { 

        -webkit-animation-name: blinker;
 -webkit-animation-duration: 1s;
 -webkit-animation-timing-function: linear;
 -webkit-animation-iteration-count: infinite;

 -moz-animation-name: blinker;
 -moz-animation-duration: 1s;
 -moz-animation-timing-function: linear;
 -moz-animation-iteration-count: infinite;
 animation-name: blinker;
 animation-duration: 2s;
 animation-timing-function: linear; 
    animation-iteration-count: infinite; color: red; 
} 

@-moz-keyframes blinker {
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; } 
}

@-webkit-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; } 
} 

@keyframes blinker {  
    0% { opacity: 1.0; } 
    50% { opacity: 0.0; }      
    100% { opacity: 1.0; } 
} 
</style> 
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
                                    <div id="showSubProgramInstallmentHead">
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
                                     
                                      
                                    <div class="col-md-3 col-sm-5">
                                          <label for="name">Account</label>
                                        
                                            
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
                                    <div class="col-md-6 col-sm-5">
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
                <div id='class_setup'></div>
             <div id='class_fee_setup_all'>
                     <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                        
                                       $msg =  $this->session->flashdata('payment_cat_msg');
                                        if($msg):
                                             foreach($msg as $key=>$value):
                                            echo $value;
                                             endforeach;
                                        endif;
                                        
                                  
                                        ?>
                                      
                                    </div>
                                  
                                </div>
              </div>
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Payment Category Search</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form')); ?>
                            

                            
                            
                            <div class="row">
                                     <div class="col-md-3 col-sm-5">
                                            <label for="name">Program</label>
                                            <?php 
                                           echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control feeProgrameId" required="required" id="feeProgrameIdSearch"');
                                            
  
 
                                            ?>
                                    </div>
                                <div class="col-md-3 col-sm-5">
                                            <label for="name">Batch </label>
                                            <?php 
                                           
                                                $batch = array(''=>"Select");
//                                                echo form_dropdown('batch_id',$batch,$batch_id,'class="form-control"  id="batch_id"');
                                         echo form_dropdown('batch_id_name_code', $batch_id, '','class="form-control" id="batch_id_search"');
 
                                            ?>
                                    </div>
                                    <div class="col-md-3 col-sm-5">
                                            <label for="name">Sub Program</label>
                                            <?php 
                                           
                                                $sub_programX = array('Sub Program'=>"Select");
                                                echo form_dropdown('sub_pro_nameId',$sub_programX,$sub_pro_id,'class="form-control" required="required" id="showFeeSubProSearch"');
                                        
 
                                            ?>
                                    </div>
                                
                                <div class="col-md-3 col-sm-5">
                                        <label for="name">Payment Category</label>
                                        <?php 
                                               
                                             echo form_dropdown('pc_id', $pc_category, '','class="form-control" id="payment_category_search"');
                                             
                                            ?>
                                    </div>
                                    
                            
                             </div>
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                    <button type="button" class="btn btn-theme" id="payments_info_search"  ><i class="fa fa-search"></i> Search</button>
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>
                                    </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
                
                  
                <?php
                
                  $payment_delete =  $this->session->flashdata('payment_category_delete');
                if($payment_delete):
                  echo '<div class="alert alert-danger alert-dismissable center">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Sorry! '.$payment_delete.'</strong> </div>';  
                endif;
                ?>
                
               <div id="class_fee_setup_search">
                  
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
                                    type    : 'post',
                                    url     : 'feeController/getBatch',
                                    data    : {'programId':programId},
                                    success : function(result){
                                      jQuery('#batch_id').html(result);
                                   }
                                });
                                
                              }
                           });
                         
                     });
                   
        jQuery('#feeProgrameIdSearch').on('change',function(){
                     var programId=    jQuery('#feeProgrameIdSearch').val();
                  
                       jQuery.ajax({
                            type    : 'post',
                            url     : 'feeController/getBatch',
                            data    : {'programId':programId},
                            success : function(result){
                              jQuery('#batch_id_search').html(result);
                           }
                                });
                  
                       jQuery.ajax({
                            type    : 'post',
                            url     : 'AdminDeptController/getSubProgram',
                            data    : {'programId':programId},
                            success : function(result){
                              jQuery('#showFeeSubProSearch').html(result);
                           }
                                });
                           });
                           
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

                 });
                 
           jQuery('#payments_info_search').on('click',function(){
              
//                    jQuery('#class_fee_setup_all').hide();
//                  jQuery('#class_fee_setup_search').hide();


                  var program_id                = jQuery('#feeProgrameIdSearch').val();
                  var sub_program_id            = jQuery('#showFeeSubProSearch').val();
                  var batch_id                  = jQuery('#batch_id_search').val();
                  var payment_category_search   = jQuery('#payment_category_search').val();

                  var data = {
                          'program_id'      : program_id,
                          'sub_program_id'  : sub_program_id,
                          'pc_id'           : payment_category_search,
                          'batch_id'        : batch_id
                       };
                jQuery.ajax({
                       type   :'post',
                       url    :'feeCategoryWiseSearch',
                       data   :data,
                       success :function(result){
                          jQuery('#class_fee_setup_search').show();

                          jQuery('#class_fee_setup_search').html(result);
                      }
                   });
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
  
 