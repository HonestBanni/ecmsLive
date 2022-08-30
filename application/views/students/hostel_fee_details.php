 
        <ol class="breadcrumb">
  <li class="breadcrumb-item">
      <a href="StudentController/student_home">Home</a> <i class="fa fa-angle-right"></i> 
      <a href="javascript:void(0)"><?php echo $report_name?></a> 
    </li>
</ol>
    <div class="page-content">
     <div class="row">
          <div class="col-md-12">
              
              <table id="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    
                                   
                                    <th>Installment</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                     <th>H.Status</th>
                                     
                                    
                                    <th>Chln#</th>
                                    <th>Curt</th>
                                    <th>Arrs</th>
                                    <th>Paid</th>
                                    <th>Bale</th>
                                    <th>Date</th>
                                    <th>Print</th>
                                
                                </tr>
                            </thead>
                        <tbody> 
                            <?php
//                               echo '<pre>';print_r($result);die;
                            $sn = "";
                            $grandTotal = '';
                             $actual_amountTotal = '';
                             $all_challans = count($result);
                             if($result):
                                 
                            
                              foreach($result as $row):
                                
                              $sn++;
                                  
                              echo '<tr">
                                      <td>'.$sn.'&nbsp;&nbsp;&nbsp;</td>
                                      
                                     
                                       ';
                                      
                                        
                                        echo '
                                              <td>'.$row->Category_title.'</td>
                                                  
                                                <td>'.date('d-M-y',  strtotime($row->date_from)).'</td> 
                                                <td>'.date('d-M-y',  strtotime($row->date_to)).'</td> 
                                              <td>'.$row->fcs_title.'</td>';
 
                                      
                                           echo  '<td>'.$row->challan_id.'</td><td>'.$row->current.'</td>
                                            <td>'.$row->arrears.'</td>
                                            <td>'.$row->paid.'</td>
                                            <td>'.$row->balance.'</td>
                                             ';
                                      

                                    //Refund Amount
                                    $payment_date;
                                    if($row->payment_date == '0000-00-00'):
                                          $payment_date = ''; 
                                        else:
                                        $payment_date = date('d-m-Y',strtotime($row->payment_date));
                                    endif;
                                       echo '<td>'.$payment_date.'</td>
                                                    ';
                                                if($row->ch_status_id ==1):
                                                    
                                                    if($row->challan_lock == 1):
                                                             '<td style="font-size:11px;"><a href="HostelChallanPrint/'.$row->hostel_id.'/'.$row->challan_id.'" class="btn btn-success btn-xs" target="_new"><i class="fa fa-print"></i>Print<a></td>';
                                                            echo '<td></td>'; 
                                                        else:
                                                            
                                                           if($sn == $all_challans):
                                                                echo '<td style="font-size:11px;"><a href="HostelChallanPrint/'.$row->hostel_id.'/'.$row->challan_id.'" class="btn btn-success btn-xs" target="_new"><i class="fa fa-print"></i>Print<a></td>';
                                                               else:
                                                               echo '<td></td>';
                                                           endif; 
                                                        
                                                        
                                                        endif;
                                                    
                                                   
                                            else:
                                                echo '<td></td>';
                                             
                                              
                                            
                                                
                                                endif;
                                                    
                                            echo '</tr>';
//                                    $actual_amountTotal +=$cons->actual_amount;
//                                    $grandTotal +=$cons->total_paid;


                              endforeach;  
                               endif;
                                ?>
 
                        </tbody>
                    </table>
              
          </div>
          </div>
          </div>
<br/>
               
           
                             
 
 
 
    
  
 
  
  
   