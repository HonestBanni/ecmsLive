 
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
                 <?php echo form_open('',array('class'=>'course-finder-form'));
                             
                                     ?>
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                        
                                <div class="row">
                                      
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Challan no </label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'challan_no',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Challan No',
                                                    'type'          => 'text',
                                                    'value'         =>$challan_id,
                                                    'required'      => 'required',
                                                ));
          
                                             
                                            ?>
                                     
                                     </div>
                                   <?php
                                   if(@$std_info):
                                       ?>
                                    <div class="col-md-3 col-sm-5">
                                         <label for="name">Refund Date</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'refund_date',
                                                    'id'            => 'total_amount',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'Payment Date',
                                                    'type'          => 'text',
                                                    'value'         => date('d-m-Y'),
                                                    'required'      => 'required',
                                                    
                                                            
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     </div>
                                    
                                        
                                    <div class="row">
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Name</label>
                                         <?php

                                                echo form_input(array(
                                                     
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Studetn Name',
                                                    'value'         => $std_info->student_name,
                                                    'type'          => 'text',
                                                    'readonly'      => 'readonly'
//                                                    'value'         => $amount,
                                                    ));
                                                echo form_input(array(
                                                    'name'          =>'hostel_id',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Studetn Name',
                                                    'value'         => $std_info->hostel_id,
                                                    'type'          => 'hidden',
                                                    'readonly'      => 'readonly'
//                                                    'value'         => $amount,
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Father Name</label>
                                         <?php

                                                echo form_input(array(
                                                     
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Studetn Name',
                                                    'value'         => $std_info->father_name,
                                                    'type'          => 'text',
                                                    'readonly'      => 'readonly'
//                                                    'value'         => $amount,
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Group</label>
                                         <?php

                                                echo form_input(array(
                                                     
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Studetn Name',
                                                    'value'         => $std_info->name,
                                                    'type'          => 'text',
                                                    'readonly'      => 'readonly'
//                                                    'value'         => $amount,
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                    <?php
                                   endif;
                                   
                                   ?>
                                      
                                     
                                      
                                   
                                      
                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-4 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="search" id="search"  value="search" ><i class="fa fa-search"></i> Search Bill</button>
                                   
                                    <?php
                                    if(@$std_info->challan_status == 2):
                                            
                                                              //Check for hostel Last Challan
                                                                $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                                                                $this->db->order_by('hostel_student_bill.id','desc');
                                                                $this->db->limit(1,0);
                                        $check_last_challan_hostel =   $this->db->get_where('hostel_student_record',array('student_id'=>$std_info->student_id,'head_type'=>1))->row();
                                       
                                                              //Check for hostel Last Challan
                                                                $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                                                                $this->db->order_by('hostel_student_bill.id','desc');
                                                                $this->db->limit(1,0);
                                        $check_last_challan_mess =   $this->db->get_where('hostel_student_record',array('student_id'=>$std_info->student_id,'head_type'=>2))->row();
                                       
                                        if($check_last_challan_hostel->id == $challan_id || $check_last_challan_mess->id ==$challan_id):
//                                        if($check_last_challan_hostel == $challan_id || $check_last_challan_mess ==$challan_id):
                                             echo '<button type="submit" class="btn btn-theme" name="save" id="save"  value="save" ><i class="fa fa-plus"></i>  Refund</button>';
                                            else:
                                            
                                        endif;
                                        
                                        
                                   
                                    endif;    
                                     
                                    ?>
                                    
                                    
                                    <button type="reset" class="btn btn-theme"  id="save"> Reset</button> 
                                    
                                        
                                    
                                </div>
                            </div>
                                   
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
              <div class="col-md-8 col-md-offset-2">
                                                                            
                                        <?php
                                         if(@$std_info):
                                        ?>
                                        <h3 class="has-divider text-highlight">Challan Details </h3>
                                        <div class="table-responsive">
                                             <table class="table table-hover" id="table">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Fee Head</th>
                                                            <th>Amount</th>
                                                            <th>Refund</th>
                                                           
                                                    

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                       
                                                        <?php
//                                                       echo '<pre>';print_r($challan_info);die;
                                                            $amount = '';
                                                            $sn = '';
                                                            foreach($challan_info as $row):
                                                                $sn++;
                                                                echo ' <tr>
                                                                <td>'.$sn.'</td> 
                                                                <td>'.$row->title.'</td> 
                                                                    <td>'.$row->amount.' 
                                                                 <input type="hidden" class="" value="'.$row->id.'" name="refund_id[]"></td> 
                                                                <td><input type="text" class="update_installment" value="'.$row->amount.'" name="refund_amount[]"></td> 
                                                                </tr> ';
                                                                
                                                                $amount +=$row->amount;
                                                            endforeach;
                                                            echo '
                                                                <tr>
                                                            <td></td>
                                                            <td>Total</td>
                                                            <td>'.$amount.'</td>
                                                            <td><input type="text" class="total" value="'.$amount.'" ></td>
                                                        </tr>';
                                                            else:
                                                               
                                                                
                                                                  '<div class="alert alert-danger alert-dismissable center">
                                                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        <strong>Sorry! Challan Not Found</strong> </div>';
                                                         
//                                                           
                                                        endif;
                                         
                                                        ?>
                                                    
                                                        
                                                    </tbody>
                                            </table>
                                        </div>
                                           
                                
                                    </div>
                        
                <?php
                                    echo form_close();
                                    ?>
                                              
 
          </div>
          
      
      </div>
                 </div>
    
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
 
     
   
     
     <script>
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 3,
        dateFormat: 'dd-mm-yy'
    });
  } );
 
  </script>        
   
  
  
      <script>
  $( function() {
    
     
    jQuery(document).on("change", ".update_installment", function() {
    var sum = 0;
    jQuery(".update_installment").each(function(){
        sum += +$(this).val();
    });
    jQuery(".total").val(sum);
  } );
  
   
  
  
  } );
  </script>