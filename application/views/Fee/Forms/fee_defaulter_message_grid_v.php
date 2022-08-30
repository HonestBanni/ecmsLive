
          
                             <?php
//                               <img style="float: right; padding-right: 79px;"  class="img-responsive" src="assets/images/logo-black.png" > 
                        
                   if(!empty($result)):                      
        
        echo ' <div class="row">
              <div class="col-md-12 ">';
                                        
                        
                                echo '
                                    
                                    <h3 class="has-divider text-highlight">Result :'; echo count($result); echo '</h3>
                                         
                                              <table class="table table-hover" id="table" style="font-size:11px">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Form#</th>
                                                          <th>College#</th>
                                                          <th>Student Name</th>
                                                          <th>Father Name</th>
                                                          <th>Student Mobile</th>
                                                          <th>Father Mobile</th>
                                                          <th>Std Status</th>
                                                          <th>Class</th>
                                                          <th>Batch</th>
                                                          <th>Amount</th>
                                                         
                                                         
                                                          

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
                                                          //if student mobile number is empty 
                                                          if(!empty($contact_details->Student_Mobile_no)):
                                                              if($contact_details->Student_Mobile_Net == '0'):
                                                               echo form_hidden('student_mobile[]',$contact_details->Student_Mobile_no); 
                                                            else:
                                                               echo form_hidden('student_mobile[]',$contact_details->Student_Mobile_no.$contact_details->Student_Mobile_Net); 
                                                            endif;
                                                          endif;
                                                          
                                                          
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
                                                                
                                                                <td>'.$row->form_no.'</td>
                                                                <td>'.$row->college_no.'</td>
                                                                <td>'.substr($row->student_name, 0, 15).'</td>
                                                                <td>'.$row->father_name.'</td>
                                                                <td>'.$row->StudentMobile.'</td>
                                                                <td>'.$row->FatherMobile.'</td>
                                                                <td>'.$row->student_status.'</td>
                                                                <td>'.$row->sub_program.'</td>
                                                                <td>'.$row->prospectus_batch.'</td> 
                                                                <td>'.$row->balance.'</td>
                                                                    
                                                                        ';
                                                                 
                                                                 
                                                              echo '  </tr>';
                                                         $gTotal += $row->balance;
                                                          endforeach;      
                                                          echo '<tr>
                                                                <td> </td>
                                                                
                                                                <td> </td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>Total</td>
                                                                 <td></td>
                                                                <td>'.$gTotal.'</td>';
                                                                 
                                                                 
                                                              echo '  </tr>';

                                                      

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
         
 
 
    
    
    