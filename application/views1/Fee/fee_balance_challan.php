 <?php
 error_reporting(0);
 ?>
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
                                    <label for="name">Student Name</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'student_name',
                                                'id'            => 'student_name',
                                                'value'         => $student_info->student_name,
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
                                    <label for="name">Father Name</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'father_name',
                                                'id'            => 'father_name',
                                                'value'         => $student_info->father_name,
                                                
                                                'class'         => 'form-control',
                                                 'disabled'      => 'disabled',
                                                ));
                                           
                                         ?>
                                    </div>
                               
                                                  
                                </div>
                            <div class="row">
                                
                         
                               <div class="col-md-3">
                                     <label for="name">Program</label>
                                        <?php 
                                      
                                            echo form_input(array(
                                                'name'          => 'father_name',
                                                'id'            => 'father_name',
                                                'value'         => $student_info->programe_name,
                                                
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
                                <div class="col-md-3">
                                              <label for="name">Bank</label>
                                            <?php 
                                              echo form_dropdown('bank_id', $bank, 8,  'class="form-control" id="bank_id"');
                                         ?>
                                    </div>
                                <div class="col-md-3">
                                    <label for="name">Installment </label>
                                        <?php 
                                        
                                         
                                      $where = array(
                                        'fc_challan_id'=>$this->uri->segment(3)  
                                      );
                                      
                                        $challan_id = $this->db->where($where)->get('fee_challan')->row();
                                        
                                                 
                                        $wherePC = array(
                                        'fee_payment_category.pc_id'=>$challan_id->fc_pay_cat_id, 
                                      );
                                        $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_payment_category.sub_pro_id');
                                                 $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                                        $pc_id = $this->db->where($wherePC)->get('fee_payment_category')->row();
                                        
                                        
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
                                         echo form_input(array(
                                                'name'          => 'old_challan_id',
                                                'id'            => 'old_challan_id',
                                                'value'         => $this->uri->segment(3),
                                                'type'          => 'hidden',
                                                'class'         => 'form-control',
                                                 
                                                ));
                                           
                                         ?>
                                    </div>
                                
                                     
                          </div>
                        <div class="row">
                                  <div class="col-md-3">
                                    <label for="name">From Date</label>
                                        <?php 
//                                      echo '<pre>';print_R($challan_info);
                                        
                                        
                                            echo form_input(array(
                                                'name'          => 'fromDate',
                                                'id'            => 'fromDate',
                                                'value'         => date('d-m-Y',strtotime($challan_info->fc_paid_form)),
                                                 
                                                'class'         => 'form-control datepicker',
                                                ));
                                         ?>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Up To Date</label>
                                            <?php 
                                   
                                            
                                               echo form_input(array(
                                                'name'          => 'uptoDate',
                                                'id'            => 'uptoDate',
                                                'value'         => date('d-m-Y',strtotime($challan_info->fc_paid_upto)),
                                                 
                                                'class'         => 'form-control datepicker',
                                                
                                                ));
                                         ?>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Valid till</label>
                                            <?php 
                                               echo form_input(array(
                                                'name'          => 'dueDate',
                                                'id'            => 'dueDate',
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
                                    
                             
                            </div>
                        <div class="row">
                                   
                                     
                                         
                            <div class="col-md-6">
                                    <label for="name">Comments</label>
                                        <?php 
                                            echo form_textarea(array(
                                                'name'          => 'fee_comments',
                                                'id'            => 'challan_comment',
                                                'cols'          => '40',
                                                 'rows'          => '2',
                                                'class'         => 'form-control',
                                                  
                                                ));
                                           
                                         ?>
                                    </div>
                            </div>
                             
                          <div style="padding-top:2%;">
                                <div class="col-md-4 col-md-offset-1 pull-right">
                                    
                                    
                                    <?php
                                         
                                    
                                        
                                    if($challan_info->fc_balance_chall_flag == 1):
                                        
                                                           $this->db->select_sum('balance');     
                                        $current_challan = $this->db->get_where('fee_actual_challan_detail',array('challan_id'=>$this->uri->segment(3)))->row();
                               
                                        if($current_challan->balance > 0):
                                            
                                                echo '<button type="submit" class="btn btn-theme" name="generate_challan" id="generate_challan"  value="generate_challan" ><i class="fa fa-google-wallet"></i> Generate Challan</button>';
                                        
                                        endif;
                                        else:
                                            $new_challan_id = $this->CRUDModel->get_where_row('fee_challan',array('fc_edit_challan_id'=>$challan_id->fc_challan_id));
                                            if($new_challan_id):
                                                    echo '<a href="feeChallanPrint/'.$new_challan_id->fc_challan_id.'/'.$new_challan_id->fc_student_id.'" class="btn btn-theme"><i class="fa fa-print"> Print</i></a>';   
                                            endif;

                                    endif;
                                    ?>
                                    
                                    
                     
     
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
                                                          <th>Actual </th>
                                                          <th>Paid</th>
                                                          <th>Balance</th>
                                                          
                                                    

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                        $grand_actual_amount = '';
                                                        $grand_paid_amount = '';
                                                        $grand_balance = '';
                                                      
                                                          foreach($result as $row):
                                                               
                                                          
                                                            $sn++;
                                                          if($row->balance>0):
                                                                echo '<tr">
                                                                <th>'.$sn.'</th>
                                                                <th>'.$row->fh_head.'</th>
                                                                <th>'.$row->actual_amount.'</th>
                                                                <th>'.$row->paid_amount.'</th>
                                                                <th><input readonly="readonly" value="'.$row->balance.'" name="update_amount[]" class="update_installment"></th>
                                                                <th><input type="hidden" value="'.$row->fcs_id.'" name="update_amount_id[]"></th>
                                                                 </tr>';
                                                            $grand_actual_amount  += $row->actual_amount;
                                                            $grand_paid_amount    += $row->paid_amount;
                                                            $grand_balance    += $row->balance;
                                                     
                                                             
                                                          endif;
                                                           
                                                           
                                                           
                                                          endforeach;      
                                               
                                                          echo '<tr ">
                                                                <th> </th>
                                                                <th>Total Amount</th>
                                                                <th>'.$grand_actual_amount.'</th>
                                                                <th>'.$grand_paid_amount.'</th>
                                                                
                                                                <th><input readonly="readonly" type="text" class="total" value="'.$grand_balance.'"></th>
                                                         
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