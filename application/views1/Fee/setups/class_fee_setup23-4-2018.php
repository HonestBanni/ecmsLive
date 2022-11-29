 
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
                                            <label for="name">Program</label>
                                            <?php 
                                           echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control feeProgrameId" id="feeProgrameId"');
                                            
  
 
                                            ?>
                                    </div>
                                <div class="col-md-3 col-sm-5">
                                            <label for="name">Sub Program</label>
                                            <?php 
                                           
                                                $sub_programX = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('sub_pro_nameId',$sub_programX,$sub_pro_id,'class="form-control" id="showFeeSubPro"');
                                        
 
                                            ?>
                                    </div>
<!--                                <div class="col-md-3 col-sm-5">
                                            <label for="name">Sub Program</label>
                                            <?php 
                                               form_input(
                                                        array(
                                                           'name'          => 'sub_pro_name',
                                                           'id'            => 'sub_pro_program',
                                                           'class'         => 'form-control',
                                                           'placeholder'   => 'Sub Program',
                                                            )
                                                        );
                                               form_input(
                                                        array(
                                                           'name'          => 'sub_pro_nameId',
                                                           'id'            => 'sub_programId',
                                                           'class'         => 'form-control',
                                                           'type'           => 'hidden',
                                                            )
                                                        );
                                            
  
 
                                            ?>
                                    </div>-->
                                <div class="col-md-3 col-sm-5">
                                              <label for="name">Payment Category</label>
                                              <input type="hidden" name="formCode" id="formCode" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date);?>">
                                              
                                            <?php 
                                            
                                             $pc_id = array(
                                                ''=>"Payment Category"
                                            );
                                             echo form_dropdown('pc_id', $pc_id, '','class="form-control payment_cat" id="pc_id"');
                                            
                                            
//                                                  form_input(
//                                                        array(
//                                                           'name'          => 'pc_id_name',
//                                                           'id'            => 'pc_id_name',
//                                                           'class'         => 'form-control',
//                                                           'placeholder'   => 'Payment Category',
//                                                            )
//                                                        );
//                                               form_input(
//                                                        array(
//                                                           'name'          => 'pc_id',
//                                                           'id'            => 'pc_id_code',
//                                                           'class'         => 'form-control',
//                                                           'type'           => 'hidden',
//                                                            )
//                                                        );
//                                              form_dropdown('pc_id', $pc_array, '',  'class="form-control" id="paymentCategory_id"');
                                            ?>
                                </div>
                                <div class="col-md-3 col-sm-5">
                                              <label for="name">Batch</label>
                                             
                                              
                                            <?php 
                                            
                                                  $batch_id = array(
                                                ''=>"Select Batch"
                                            );
                                            echo form_dropdown('batch_id_name_code', $batch_id, '','class="form-control  " id="batch_id"');
                                       
                                            
                                            
                                            
//                                                  form_input(
//                                                        array(
//                                                           'name'          => 'batch_id_name',
//                                                           'id'            => 'batch_id_name',
//                                                           'class'         => 'form-control',
//                                                           'placeholder'   => 'Batch Name',
//                                                            )
//                                                        );
//                                               form_input(
//                                                        array(
//                                                           'name'          => 'batch_id_name_code',
//                                                           'id'            => 'batch_id_name_code',
//                                                           'class'         => 'form-control',
//                                                           'type'           => 'hidden',
//                                                            )
//                                                        );
//                                              form_dropdown('pc_id', $pc_array, '',  'class="form-control" id="paymentCategory_id"');
                                            ?>
                                </div>
                               
                                
                                
                                
                            </div>
                            <div class="row">
                                 <div class="col-md-3 col-sm-5">
                                              <label for="name">Shift</label>
                                            <?php 
                                         
                                            
                                           echo  form_dropdown('shift_name_code', $fee_shift,$fee_shift_id,  'class="form-control"');
                                                  form_input(
                                                        array(
                                                           'name'          => 'shift_name',
                                                           'id'            => 'shift_name',
                                                           'class'         => 'form-control',
                                                           'placeholder'   => 'Shift Name',
                                                            )
                                                        );
                                           
//                                              form_dropdown('pc_id', $pc_array, '',  'class="form-control" id="paymentCategory_id"');
                                            ?>
                                </div>
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
//                                              form_dropdown('pc_id', $pc_array, '',  'class="form-control" id="paymentCategory_id"');
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
<!--              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Search Panel</span>
                        </h1>
                        <div class="section-content" >
                           
  
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
                                    <button type="button" class="btn btn-theme" name="search_fee_setup" id="search_fee_setup"  value="search_fee_setup" ><i class="fa fa-search"></i> Search  </button>
                                    
                                 </div>
                                </div>
                                
                          
                            </div>
                         
                                
                             
                            
                         </div>//section-content
                        
                        
                </section>-->
             
              <div id='class_fee_setup_search'>
                
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
    <!--//page-wrapper--> 
 
   
   
     
     <script>
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
  
 