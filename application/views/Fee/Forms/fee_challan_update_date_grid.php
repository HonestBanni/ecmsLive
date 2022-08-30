
          
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

                                                          <th><input type="checkbox" id="checkAll"></th>
                                                          <th>Challan#</th>
                                                          <th>Form#</th>
                                                          <th>College#</th>
                                                          <th>Due Date</th>
                                                          <th>Student Name</th>
                                                          <th>Father Name</th>
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
                                                          echo '<tr>
                                                                <td><input type="checkbox" name="challanIds[]" value="'.$row->challan_id.'" id="checkItem" checked=""></td>
                                                                <td>'.$row->challan_id.'</td>
                                                                <td>'.$row->form_no.'</td>
                                                                <td>'.$row->college_no.'</td>
                                                                <td>'.date('d-m-Y',strtotime($row->due_date)).'</td>
                                                                <td>'.substr($row->student_name, 0, 15).'</td>
                                                                <td>'.$row->father_name.'</td>
                                                                
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
                                    echo '</div></div> ';
                                    else:
                                      echo '<h3 class="has-divider text-highlight">No result found</h3>';  
                                  endif;
                             
                             ?>
         
 
 
<script>
    
        jQuery('#checkAll').click(function () {    
            jQuery('input:checkbox').prop('checked', this.checked);    
        });
        jQuery('#checkItem').click(function () {    
            jQuery('#checkAll').prop('checked', '');    
        });

    
</script>
    
    