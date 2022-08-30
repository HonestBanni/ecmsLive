 
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
         
           <?php echo form_open('',array('class'=>'course-finder-form')); ?>
          <div class="col-md-12">
               <?php
          
               
                if($this->session->flashdata('error_payment')):
                    
                      echo '<div class="alert alert-danger alert-dismissable center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Sorry! '.$this->session->flashdata('error_payment').'</strong> </div>';
              
                endif; 
          
          ?>
              
                  <section class="course-finder" style="padding-bottom: 2%;">                    
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           
                                <div class="row">
                               <div class="col-md-3">
                                    <label for="name">Form#</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'form_no',
                                                'id'            => 'form_no',
                                                'value'         => $student_info->form_no,
                                                 
                                                'class'         => 'form-control',
                                                'disabled'      => 'disabled',
                                                ));
                                         
                                         ?>
                                    </div>
                               <div class="col-md-3">
                                    <label for="name">College No</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'student_name',
                                                'id'            => 'student_name',
                                                'value'         => $student_info->college_no,
                                                'placeholder'   => 'College No',
                                                'class'         => 'form-control',
                                                 'disabled'      => 'disabled',
                                                ));
                                           
                                         ?>
                                    </div>
                               <div class="col-md-3">
                                    <label for="name">Name(Father name)</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'student_name',
                                                'id'            => 'student_name',
                                                'value'         => $student_info->student_name.' ('.$student_info->father_name.')',
                                                 'class'         => 'form-control',
                                                 'disabled'      => 'disabled',
                                                ));
                                           
                                            echo form_input(array(
                                                'name'          => 'student_id',
                                                 'value'         => $student_info->student_id,
                                                 'class'         => 'form-control',
                                                  'type'        =>'hidden'
                                                 
                                                ));
                                           
                                         ?>
                                    </div>
                               <div class="col-md-3">
                                    <label for="name">Batch Name</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'father_name',
                                                'id'            => 'father_name',
                                                'value'         => $student_info->batch_name,
                                                
                                                'class'         => 'form-control',
                                                 'disabled'      => 'disabled',
                                                ));
                                           
                                         ?>
                                    </div>
                               
                               <div class="col-md-3">
                                    <label for="name">Sub Program</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'father_name',
                                                'id'            => 'father_name',
                                                'value'         => $student_info->sub_proram,
                                                 'class'         => 'form-control',
                                                 'disabled'      => 'disabled',
                                                ));
                                       
                                       
                                         ?>
                                    </div>
                                <div class="col-md-6">
                                              <label for="name">Bank</label>
                                            <?php 
                                              echo form_dropdown('bank_id', $bank,$default_bank,  'class="form-control" id="bank_id"');
                                         ?>
                                    </div>
                                <div class="col-md-3">
                                    <label for="name">Installment </label>
                                        <?php 
//                                        echo '<pre>';print_r($student_info);die;
                                        
//                                      if($student_info->batch_id == 1):
//                                      if($student_info->migration_status == 1):
//                                            $where =array(
//                                                'sub_programes.sub_pro_id'          =>$student_info->sub_pro_id,
//                                                'batch_id'                          =>$student_info->batch_id,
//                                                'fee_category_titles.cat_title_id'  =>6,
//                                      );
//                                      else:
//                                            $where =array(
//                                          'sub_programes.sub_pro_id'                =>$student_info->sub_pro_id,
//                                          'batch_id'                                =>$student_info->batch_id,
//                                          'fee_category_titles.cat_title_id'        =>1,
//                                      );
//                                      endif;  
                                       
                                       $where =array(
                                          'sub_programes.sub_pro_id'                =>$student_info->sub_pro_id,
                                          'batch_id'                                =>$student_info->batch_id,
//                                          'fee_category_titles.cat_title_id'        =>1,
                                       );
                                      
                                       
                                                 $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_payment_category.sub_pro_id');
                                                 $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                                        $pc_id = $this->db->where($where)->get('fee_payment_category')->row();
                                       
                                        if($pc_id):
                                            
                                             echo form_input(array(
                                                
                                                'id'            => 'father_name',
                                                'value'         => $pc_id->title.'('.$pc_id->name.')',
                                                 'class'         => 'form-control',
                                                 'disabled'      => 'disabled',
                                                ));
                                         echo form_input(array(
                                                'name'          => 'pc_id',
                                                'id'            => 'pc_id',
                                                'value'         => $pc_id->pc_id,
                                                'type'          => 'hidden',
                                                'class'         => 'form-control',
                                                 
                                                ));
                                            
                                            else:
                                             echo form_input(array(
                                                
                                                'id'            => 'father_name',
                                                 'required'      => 'required',
                                                 'class'         => 'form-control',
                                               
                                                ));
                                         echo form_input(array(
                                                'name'          => 'pc_id',
                                                'id'            => 'pc_id',
                                                'required'      => 'required',
                                                'type'          => 'hidden',
                                                'class'         => 'form-control',
                                                 
                                                ));
                                        endif;
                                    ?>
                                    </div>
                                
                                     
                          </div>
                        <div class="row">
                                  <div class="col-md-3">
                                    <label for="name">From Date</label>
                                        <?php 
                                        $from_date = '';
                                        if(@$result[0]->fee_from):
                                            $from_date = date('d-m-Y',strtotime($result[0]->fee_from));
                                            else:
                                            $from_date = date('d-m-Y');
                                        endif;
                                        
                                            echo form_input(array(
                                                'name'          => 'fromDate',
                                                'id'            => 'fromDate',
                                                'value'         => $from_date,
                                                 
                                                'class'         => 'form-control datepicker',
                                                ));
                                         ?>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Up To Date</label>
                                            <?php 
                                            $from_to = '';
                                        if(@$result[0]->fee_to):
                                            $from_to = date('d-m-Y',strtotime($result[0]->fee_to));
                                            else:
                                            $from_to = date('d-m-Y');
                                        endif;
                                            
                                            
                                               echo form_input(array(
                                                'name'          => 'uptoDate',
                                                'id'            => 'uptoDate',
                                                'value'         => $from_to,
                                                 
                                                'class'         => 'form-control datepicker',
                                                
                                                ));
                                         ?>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Valid till</label>
                                            <?php 
                                         
                                            $valid_till = '';
//                                        if(@$result[0]->valid_till):
//                                            $valid_till = date('d-m-Y',strtotime($result[0]->valid_till));
//                                            else:
//                                            $valid_till = date('d-m-Y');
//                                        endif;
                                               echo form_input(array(
                                                'name'          => 'dueDate',
//                                                'id'            => 'dueDate',
                                                'value'         => date('d-m-Y'),
                                                 
                                                'class'         => 'form-control datepicker',
                                                
                                                ));
                                         ?>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Issue Date</label>
                                            <?php 
                                               echo form_input(array(
                                                'name'          => 'issueDate',
                                                'id'            => 'v',
                                                'value'         => date('d-m-Y'),
                                                 
                                                'class'         => 'form-control datepicker',
                                                
                                                ));
                                         ?>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Shift</label>
                                            <?php 
                                             echo form_dropdown('shift', $shift,'',  'class="form-control" disabled="disabled"');
                                              
                                         ?>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">SSC Marks</label>
                                            <?php 
                                              echo form_input(array(
                                                  'disabled'      => 'disabled',
                                                'value'         => $student_info->obtained_marks.'/'.$student_info->total_marks.' = '.$student_info->percentage ,
                                                 'class'         => 'form-control',
                                                
                                                ));
                                              
                                         ?>
                                    </div>
                                    
                             
                            </div>
                        <div class="row">
                                   
                                     
                                         
                            <div class="col-md-12">
                                    <label for="name">Comments</label>
                                        <?php 
                                            echo form_textarea(array(
                                                'name'          => 'fee_comments',
                                                'id'            => 'challan_comment',
                                                'cols'          => '40',
                                                'rows'         => '2',
                                                'class'         => 'form-control',
                                                'value'        => 'Marks = '.$student_info->obtained_marks.' Shift = '.$shift[1]
                                                ));
                                           
                                         ?>
                                    </div>
                            </div>
                      
                            <?php
                            if(empty($pc_id)):
                                
                                echo '<h4><h4 class="" style="font-size: 24px; color: red;">Please Check Fee Setup First or Check Data Entry(Check Qanoon Zia Jan)</h4></h4> ';
                                
                            endif;
                            
                            ?>
                            
                          <div style="padding-top:2%;">
                                <div class="col-md-4 col-md-offset-1 pull-right">
                                   <button type="submit" class="btn btn-theme" name="generate_challan" id="generate_challan"  value="generate_challan" ><i class="fa fa-google-wallet"></i> Generate Challan</button>
                                </div>
                            </div>
                                
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
              
                  <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                  
                                
                                      if(!empty($result)):
                                        
                                        ?>
                                     <div id="div_print">
              
                                        <h3 class="has-divider text-highlight">Challan Details </h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Fee Head</th>
                                                          <th>Challan Detail</th>
                                                          <th>Update Amount</th>
                                                    

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                        $grand_actual_amount = '';
                                                        $grand_paid_amount = '';
                                                      
                                                          foreach($result as $row):
                                                               
                                                          
                                                            $sn++;
                                                            echo '<tr">
                                                                <th>'.$sn.'</th>
                                                                <th>'.$row->fh_head.'</th>
                                                                <th>'.$row->fcs_amount.'</th>
                                                                <th><input readonly="readonly" value="'.$row->fcs_amount.'" name="update_amount[]" class="update_installment"></th>
                                                                <th><input type="hidden" value="'.$row->fcs_id.'" name="update_amount_id[]"></th>
                                                                 </tr>';
                                                            $grand_actual_amount  += $row->fcs_amount;
                                                            $grand_paid_amount    += $row->fcs_amount;
                                                     
                                                              
                                                           
                                                           
                                                          endforeach;      
                                               
                                                          echo '<tr ">
                                                                <th> </th>
                                                                <th>Total Amount</th>
                                                                <th>'.$grand_actual_amount.'</th>
                                                                <th><input readonly="readonly" type="text" class="total" value="'.$grand_paid_amount.'"></th>
                                                         
                                                                 </tr>'; 
                                                        ?>

                                                    </tbody>
                                            </table>
                                        </div>
                                          <?php
//                                                 else:
//                                                                         
//                                                                echo '<div class="alert alert-danger alert-dismissable">
//                                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
//                                                                    <strong>Challan Paid  !</strong> Contact to Head Of department</div>';
                                                           endif;
                                  
                                    ?> 
                                    </div>
                                        
                                    </div>
                                  
                                </div>
                             
                   
                  
                </div>
           <?php
                                    echo form_close();
                                    ?>  
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 
 
 
   
  
      <script>
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 3,
        dateFormat: 'dd-mm-yy'
    });
    
     
    jQuery(document).on("change", ".update_installment", function() {
    var sum = 0;
    jQuery(".update_installment").each(function(){
        sum += +$(this).val();
    });
    jQuery(".total").val(sum);
  } );
  } );
  </script>
  <style>
      .datepicker{
          z-index: 1;
      }
  </style>   