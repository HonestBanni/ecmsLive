   <?php
 
                          
                   if(!empty($result)):                      
        
        echo '<div class="row">
              <div class="col-md-12">';
                                        
                        
                                echo '<div id="div_print">
                                            <table class="table table-hover" id="table" style="font-size:10px;">
                                                    <thead>
                                                      <tr style="border: 1px solid #000000;">

                                                          <th style="border: 1px solid #000000;">#</th>
                                                          <th style="border: 1px solid #000000;">Form no#</th>
                                                          <th style="border: 1px solid #000000;">College#</th>
                                                          <th style="border: 1px solid #000000;">Student Name</th>
                                                          <th style="border: 1px solid #000000;">Program</th>
                                                          <th style="border: 1px solid #000000;">Batch</th>
                                                          <th style="border: 1px solid #000000;">Stage</th>
                                                          <th style="border: 1px solid #000000;">Label</th>
                                                          <th style="border: 1px solid #000000;">Message</th>
                                                          <th style="border: 1px solid #000000;">Fee Due Date</th>
                                                          <th style="border: 1px solid #000000;">Send Date</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>';
  
                                                        $sn = "1";
                                                          foreach($result as $row):

                                                                  
                                                          echo '<tr>
                                                                <td style="border: 1px solid #000000;">'.$sn++.'</td>
                                                                <td style="border: 1px solid #000000;">'.$row->form_no.'</td>
                                                                <td style="border: 1px solid #000000;">'.$row->college_no.'</td>
                                                                <td style="border: 1px solid #000000;">'.$row->student_name.'</td>
                                                                <td style="border: 1px solid #000000;">'.$row->programe_name.'</td>
                                                                <td style="border: 1px solid #000000;">'.$row->batch_name.'</td>
                                                                <td style="border: 1px solid #000000;">'.$row->fee_stage_name.'</td>
                                                                <td style="border: 1px solid #000000;">'.$row->fee_stage_label.'</td>
                                                                <td style="border: 1px solid #000000;">'.$row->fee_msg_text.'</td>
                                                                <td style="border: 1px solid #000000;">'.$this->CRUDModel->date_convert($row->fee_msg_date).'</td>
                                                                <td style="border: 1px solid #000000;">'.$this->CRUDModel->date_convert($row->fee_msg_date_time,'d-m-Y').'</td>
                                                                     </tr>';
                                                         
                                                          endforeach;      
                                               

                                                      

                                                    echo'</tbody>
                                            </table>
                                        ';
                                          
                                 
                                    
                                    echo '</div>
                                    </div>
                                  
                                </div>';
                                  endif;
                             
                             ?>