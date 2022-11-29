 
        <ol class="breadcrumb">
  <li class="breadcrumb-item">
      <a href="StudentController/student_home">Home</a> <i class="fa fa-angle-right"></i> 
      <a href="StudentController/fine">College Fee Details</a> 
    </li>
</ol>
    <div class="page-content">
     <div class="row">
          <div class="col-md-12">
               
           
                             <?php
                          $count_rows = '';
                          $count_all = count($result);
                       
                   if(!empty($result)):                      
               
                        echo ' <div class="agile-grids">	    
				<div class="agile-tables">
					<div class="w3l-table-info">
					  <h2>Fee Details</h2>
                                              <table id="table">
						<thead>
                                                    <tr>
                                                         
                                                        
 
                                                         
                                                        <th>Challan#</th>
                                                        <th>Installment</th>
                                                        <th>Actual</th>
                                                        <th>Adj-Amount</th>
                                                        <th>Arrears</th>
                                                        <th>Concession</th>
                                                       
                                                        <th>Paid</th>
                                                        <th>Balance</th>
                                                        <th>Credit</th>
                                                        <th>Status</th>
                                                       <th>Print</th>
                                                        
                                                        <th>Paid Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
  
                                                          foreach($result as $row):
                                                    $count_rows ++;
                                                                 
                                                               
                                                          echo '<tr>
                                                                  ';
                                                               
//                                                                    echo '<td><a href="#">'.substr($row->student_name, 0, 30).'</strong></a><br/>'.$row->college_no.'<br/>'.$row->batch_name.'<br/>'.$row->sessionName.'<br/>'.$row->student_status.'</td>';
                                                              
                                                                
                                                                echo ' 
                                                                    <td>'.$row->fc_challan_id.'</td>
                                                                    <td>'.$row->fee_installment.'</td>';
                                                                
                                                                $totalpaid = '';
                                                                  if($row->ch_status_id == 2 || $row->ch_status_id == 3):
                                                                      $totalpaid = $row->total_Paid;
                                                                      else:
                                                                      $totalpaid = '';
                                                                  endif;
                                                                  
                                                                  
                                                                  
                                                                  $gBalance = $row->total_upPaid-$totalpaid-$row->concession ;
                                                                  if($row->old_credit > 0):
                                                                      $gBalance = $gBalance-$row->old_credit;
                                                                  endif;
                                                                       
                                                                        echo '<td>'.$row->current.'</td>';
                                                                        echo '<td>'.$row->old_credit.'</td>';
                                                                        echo '<td>'.$row->arrears.'</td>';
                                                                        echo '<td>'.$row->concession.'</td>';
                                                                      
                                                                        echo '<td>'.$totalpaid.'</td>';
                                                                        echo ' <td>'.$gBalance.'</td>';
                                                                          echo '<td>'.$row->credit_amount.'</td>';
                                                                          if($row->ch_status_id == 1 && $row->challan_id_lock ==1):
                                                                            
                                                                             
                                                                          
                                                                              echo '<td></td>';      
                                                                          else:
                                                                              echo '<td><button  class="btn btn-warning btn-xs">'. $row->fcs_title.'</button></td>'; 
                                                                            
                                                                          endif; 
                                                                           
                                                                              
                                                                     if($row->ch_status_id == 1):
                                                                         
                                                                         if($count_all == $count_rows):
                                                                             echo '<td><a href="feeStudentChallanPrint/'.$row->fc_challan_id.'/'.$row->student_id.'" class="btn btn-success btn-xs"><span class="fa fa-print"> Print</span></a></td>';
                                                                         else:
                                                                             echo '<td></td>';     
                                                                         endif;
                                                                         
                                                                         
                                                                        
                                                                       else:
                                                                       echo '<td></td>';     
                                                                      
                                                                    endif; 
                                                                    
                                                                      
                                                               $paid_date = '';
                                                               if($row->fc_paiddate == '0000-00-00'):
                                                               $paid_date = '';    
                                                                   else:
                                                                 $paid_date = date('d-m-Y',strtotime($row->fc_paiddate));   
                                                               endif;
                                                               
                                                               echo '  <td>'.$paid_date.'</td>'; 
                                                                 
                                                              echo '  </tr>';
                                                         
                                                          endforeach;      
                                               

                                                      

                                                    echo'</tbody>
                                            </table>				</div>
    </div>
</div>
                                      ';
                                  endif;
                             
                             ?>
 
 
 
    
  
 
  
  
   