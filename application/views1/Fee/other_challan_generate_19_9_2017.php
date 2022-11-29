 <?php
// error_reporting(0);
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
                                                'name'          => 'student_name',
                                                'id'            => 'student_name',
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
//                                           
                                            echo form_input(array(
                                                'name'          => 'sub_pro_id',
                                                'id'            => 'sub_pro_id',
                                                'value'         => $student_info->sub_pro_id,
                                                'type'          => 'hidden'
                                                ));
//                                           
//                                           echo '<pre>';print_r($student_info);die
                                         ?>
                                    </div>
                                
                                <div class="col-md-3">
                                              <label for="name">Bank</label>
                                            <?php 
                                              echo form_dropdown('bank_id', $bank, 8,  'class="form-control" id="bank_id"');
                                         ?>
                                    </div>
                                
                                 <div class="col-md-3">
                                    <label for="name">Payment No</label>
                                    <select name="pc_id" class="form-control payment_cat" id="pc_id" required="required">
                                        <option value="">Select Payment</option> 
                                        <?php 
                                        
                                             $where =array(
                                          'sub_programes.sub_pro_id'=>$student_info->sub_pro_id,
                                          'batch_id'=>$student_info->batch_id,
                                          'fee_category_titles.cat_title_id !='=>1,
                                          'fee_category_titles.inst_type_id !='=>2,
                                      );
                                                 $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_payment_category.sub_pro_id');
                                                 $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                                        $installments = $this->db->where($where)->get('fee_payment_category')->result();
                                       
                                        
                                        if($installments):
                                            foreach($installments as $pc_id):
                                            echo ' <option value="'.$pc_id->pc_id.'">'.$pc_id->title.'</option>';
                                            endforeach;
                                        endif;
                                        
                                        ?>
                                        
                                        
                                           
                                    </select>
                                    </div>
<!--                                <div class="col-md-3">
                                              <label for="name">Installment Type</label>
                                            <?php 
                                              echo form_dropdown('install_type', $install_type, 2,  'class="form-control" id="install_type"');
                                         ?>
                                    </div>-->
                                
                                     
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
                                    
                                    <button type="submit" class="btn btn-theme" name="generate_challan" id="generate_challan"  value="generate_challan" ><i class="fa fa-google-wallet"></i> Generate Challan</button>
                                    
                     
     
                                </div>
                            </div>
                                
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
              
                
                             
                   
                  
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
  
  
 