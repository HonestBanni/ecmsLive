 
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
              <section class="course-finder" >
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                                  
                                     ?>
                                <div class="row">
                                    
                                    
                                <div class="col-md-3 col-sm-5">
                                        <label for="name">College #</label>
                                         
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'collegeNo',
                                                                'type'          => 'number',
                                                                'value'         => $studentInfo->college_no,
                                                                'class'         => 'form-control',
                                                                 'readonly'      => 'readonly',
                                                                'placeholder'   => 'College #')
                                                             );
                                                      ?>
                                               
                                            
                                     </div>
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">Name</label>
                                        
                                           
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'stdName',
                                                                'type'          => 'text',
                                                                'value'         => $studentInfo->student_name,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Student Name',
                                                                'readonly'      => 'readonly',
                                                                 )
                                                             );
                                                      ?>
                                             
                                            
                                     </div>
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">Class</label>
                                        
                                          
                                                    
                                                <?php
                                                    echo  form_input(
                                                             array(
//                                                                'name'          => 'fatherName',
                                                                'type'          => 'text',
                                                                'value'         => $studentInfo->sub_proram.'('.$studentInfo->sectionsName.')',
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Father Name',
                                                                 )
                                                             );
                                                      ?>
                                           
                                            
                                     </div>
                                <div class="col-md-3 col-sm-5">
                                            <label for="name">Batch</label>
                                           
                                                    
                                                <?php
                                                    echo  form_input(
                                                             array(
//                                                                'name'          => 'fatherName',
                                                                'type'          => 'text',
                                                                'value'         => $studentInfo->batch_name,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Father Name',
                                                                 )
                                                             );
                                                      ?>
                                              
                                            
                                     </div>
                                
                           
                           
                              
                           </div><!--//section-content-->
                            
                           <div class="row">
                               <div class="col-md-3 col-sm-5">
                                            <label for="name">Credit</label>
                                           
                                                    
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'id'            => 'credit_amount',
                                                                'type'          => 'text',
                                                                'value'         => $feeComments->fc_challan_credit_amount,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Credit Amount',
                                                                 )
                                                             );
                                                      ?>
                                              
                                            
                                     </div>
                              <div class="col-md-6 col-sm-5">
                                          <label for="name">Challan Comment</label>
                                        <?php
                                            
                                            echo form_textarea(array(
                                                'name'          => 'challan_comnt',
                                                'id'            => 'challan_comnt',
                                                'rows'          => '2',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Comment',
                                                
                                                'value'         => $feeComments->fc_comments
                                                ));
                                         
                                        ?>
                                       
                                        
                                     </div> 
                              <div class="col-md-3 col-sm-5">
                                  <p><br/><br/>
                                        <button type="button" class="btn btn-theme" name="update_comment" id="update_comment"  value="update_comment" ><i class="fa fa-book"></i> Update comment</button>
                                   </p>
                                        
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
                                                           'required'       => 'required',
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
                                            echo  form_input(
                                                        array(
                                                           'name'           => 'challan_id',
                                                           'value'          => $this->uri->segment(2),
                                                           'id'             => 'challan_id',
                                                           'class'          => 'form-control',
                                                           'type'           => 'hidden',
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'student_id',
                                                            'value'          => $this->uri->segment(3),
                                                           'class'         => 'form-control',
                                                           'type'           => 'hidden',
                                                            )
                                                        );
//                                             
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
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">Balance Type</label>
                                        
                                           
                                                <?php
                                                    echo form_dropdown('balance_type', $balance_type, 0,  'class="form-control"');
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
                                                'required'      => 'required',
                                                ));
                                         
                                        ?>
                                       
                                        
                                     </div>
                                     
                                    
                                     
                                
                                     
                                     
                                      
                                </div> 
                           
                           
                           <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                     <button type="submit" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-plus"></i> Add</button>
                                     <a href="feeChallanPrint/<?php echo $this->uri->segment(2) ?>/<?php echo $this->uri->segment(3) ?>" class="btn btn-theme"><span class="fa fa-print"> Print</span></a>
                                     <!--<button type="submit" class="btn btn-theme" name="fee_print" id="fee_print"  value="fee_print" ><i class="fa fa-plus"></i> Print</button>-->
                                    <button type="reset" class="btn btn-theme"  id="save"> Reset</button> 
     
                                </div>
                            </div>
                           <br/>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                        </div>  
                        
                        
                    </section>
           
                             <?php
                             
//                             echo '<pre>';print_r($result);die;
                   if(!empty($result)):                      
        
        echo '<div class="row">
              <div class="col-md-12">';
                                        
                           
                                 echo '<div id="div_print">
              
                                        
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Fee Head</th>
                                                          <th>Current</th>
                                                          <th>Arrears</th>
                                                          <th>Paid</th>
                                                          <th>Balance</th>
                                                          <th>Remarks</th>
                                                          <th>Manage</th>
                                                     
                                                          

                                                      </tr>
                                                    </thead>
                                                    <tbody>';

                                                        $sn = "";
                                                         $total_actual      = '';
                                                         $total_paid      = '';
                                                         $total_paid_calculated      = '';
                                                         $paid_amount_total = '';
                                                         $total_balance = '';
                                                        
                                                          foreach($result as $row):
                                                             
                                                              
                                                                $total_actual               += $row->actual_amount;
                                                                $total_paid                 += $row->paid_amount;
                                                                $total_paid_calculated      += $row->paid_amount;
                                                                $total_balance              += $row->balance;
                                                                 $paid_amount                = '';
                                                                if($row->challan_status == 1):
                                                                    $paid_amount = '';
                                                                    $total_paid  = '';
                                                                endif;
                                                                
                                                                if($row->challan_status == 2):
                                                                    $paid_amount = $row->paid_amount;
                                                                endif;
                                                             
                                                                
                                                                    
//                                                          $k = array_rand($class);
                                                           $sn++;
                                                        echo '<tr ">
                                                                <td>'.$sn.'</td>
                                                                <td>'.$row->fh_head.'</td>';
                                                                if($row->old_balance_pc_id == 0):
                                                                    echo '<td>'.$row->paid_amount.'</td>';
                                                                    echo '<td></td>';
                                                                    else:
                                                                        echo '<td></td>';
                                                                    echo '<td>'.$row->paid_amount.'</td>';
                                                                    
                                                                endif;
                                                                
                                                        
                                                                echo '<td>'.$paid_amount.'</td>
                                                                 
                                                                <td>'.$row->balance.'</td><td>'.$row->comment.'</td>';
                                                         
                                                                $if_paid = array(
                                                                  'fc_student_id'   => $feeComments->fc_student_id,  
                                                                  'fc_challan_id >' => $feeComments->fc_challan_id,  
                                                                  'fc_ch_status_id' => 2,  
                                                                  'fee_id'          => $row->fee_id,  
                                                                );
                                                                                        $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');
                                                                                        $this->db->order_by('fc_challan_id','asc');
                                                                    $check_if_paid =    $this->db->get_where('fee_challan',$if_paid)->row();
                                                                    
                                                                if(!empty($check_if_paid)):
                                                                        echo '<td colspan="2">This Head is paid in $challan no '.$check_if_paid->fc_challan_id.'</td>';
                                                                        else:
                                                                        
                                                                                 
                                                                                    echo '<td>
                                                                                        <a href="updateNewHead/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$row->challan_detail_id.'" class="btn btn-success btn-xs">Edit</a>
                                                                                        <a href="deleteNewHead/'.$row->challan_detail_id.'/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'" class="btn btn-danger btn-xs">Delete</a>    
                                                                                        </td>';

 
                                                                    endif;
                       
                                                      
                                                        
                                                          endforeach;      
                                               
                                                           
                                                         echo '<tr>
                                                                <td> </td>
                                                                <td> </td>
                                                                <td> </td>
                                                                <td><strong> </strong></td>
                                                                
                                                                <td><strong>'.$total_paid.'</strong></td>
                                                               
                                                                <td><strong>'.$total_balance.'</strong></td>
                                                                   
                                                               </tr>';

                                                    echo'</tbody>
                                            </table>
                                        </div>';
                                          
                                 
                                    
                                    echo '</div>
                                    </div>
                                  
                                </div>';
                                  endif;
                             
                             ?>
                                  
                                </div>
 
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 
 
   
   
    <script>
    jQuery(document).ready(function(){
        
        jQuery('#update_comment').on('click',function(){
            
            var update_comment = jQuery('#challan_comnt').val();
            var challan_id      = jQuery('#challan_id').val();
            var credit_amount      = jQuery('#credit_amount').val();
            jQuery.ajax({
                    type    :'post',
                    url     :'ChallanCommentUpdate',
                    data    :{'comment':update_comment,'challan_id':challan_id,'credit_amount':credit_amount},
                    success : function(result){
                        location.reload();
                    }
                    
            });
        });
    });
    </script>    
  
 