
          
                             <?php
//                               <img style="float: right; padding-right: 79px;"  class="img-responsive" src="assets/images/logo-black.png" > 
                        echo ' <input type="hidden" name="count_record" id="count_record" value="'.count($result).'">';
                   if(!empty($result)):   
                      
        
        echo ' <div class="row">
              <div class="col-md-12 ">';
                                echo '
                                     <h3 class="has-divider text-highlight">Result :'; echo count($result); echo '</h3>
                                               
                                              <table class="table table-hover" id="table" style="font-size:15px">
                                                    <thead>
                                                      <tr>
                                                        <th>#</th>
                                                        <th>Image</th>
                                                          <th>Form#</th>
                                                          <th>College#</th>
                                                          <th>Student Name</th>
                                                          <th>Father Name</th>
                                                          <th>Father Mobile</th>
                                                          <th>Std Status</th>
                                                          <th>Class</th>
                                                          <th>Batch</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>';

                                                        $sn = "";
                                                            $gTotal = ''; 
                                                          foreach($result as $row):
                                                              $sn++;
                                                         $contact_details = $this->CRUDModel->student_contact_details($row->student_id);
                                                          
                                                        
                                                          echo form_hidden('student_id[]',$row->student_id);
                                                          echo form_hidden('batchId[]',$row->batch_id);
                                                          echo form_hidden('programeId[]',$row->programe_id);
                                                          echo form_hidden('SubProId[]',$row->sub_pro_id);
                                                          echo form_hidden('group[]',$row->sec_id);
                                                          
                                                            //if Father mobile number is empty 
                                                          if(!empty($contact_details->Father_Mobile_no)):
                                                            if($contact_details->Father_Mobile_Net == '0'):
                                                                 echo form_hidden('father_mobile[]',$contact_details->Father_Mobile_no); 
                                                              else:
                                                                 echo form_hidden('father_mobile[]',$contact_details->Father_Mobile_no.$contact_details->Father_Mobile_Net); 
                                                            endif;
                                                            endif; 
                                                          echo '<tr>
                                                                <td>'.$sn.'</td>
                                                                
                                                                <td><img src="assets/images/students/'.$row->applicant_image.'" width="85" height="60"> </td>
                                                                <td>'.$row->form_no.'</td>
                                                                <td>'.$row->college_no.'</td>
                                                                <td>
                                                                    <a href="javascript:void(0);" class="applicantProfile" data-toggle="modal" data-target="#StudentProfilePopUp" id="'.$row->student_id.'">
                                                                        <strong>'.$row->student_name.'</strong>
                                                                    </a>
                                                                </td>
                                                                <td>'.$row->father_name.'</td>
                                                                <td>'.$row->mobile_no.'</td>
                                                                <td>'.$row->student_status.'</td>
                                                                <td>'.$row->sub_program.'</td>
                                                                <td>'.$row->prospectus_batch.'</td> 
                                                                ';
                                                            echo '  </tr>';
                                                         
                                                          endforeach;      
                                                    echo'</tbody>
                                            </table>
                                         ';
                                          
                                 echo $print_log;
                                    
                                    echo '</div>
                                    </div>
                                ';
                                    else:
                                      echo '<h3 class="has-divider text-highlight">No result found</h3>';  
                                  endif;
                             
                             ?>
         
                <div class="modal fade" id="StudentProfilePopUp" role="dialog" style="z-index:9999">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                <br>
                            </div>
                            <div class="section-content" id="profileResult" >
                            </div>
                        </div>
                    </div>
                </div>
            
<script>
    jQuery('.applicantProfile').on('click',function(){

      var student_id = jQuery(this).prop('id');

        jQuery.ajax({
             type   :'post',
             url    :'ShowApplicantProfile',
             data   :{'std_id':student_id},
            success :function(result){
//                 $('.Student'+student_id).hide(); 
                  jQuery('#profileResult').html(result);
            }
         });
  });
</script>
    
    
    