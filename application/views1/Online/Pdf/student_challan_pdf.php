<style>
    .removeBorder {
        
        border-top : 1px solid #ffffff !important;
        text-decoration: underline;
    }
</style>
  <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">   
    <?php
    if($std_data):
        
            $due_date = date('d-m-Y',strtotime($std_data->due_date));
    
//           $due_date =  date('d-m-Y', strtotime($day . " +1 days"));
        ?>
             <div style="margin: 2px 4px 2px; width:32%;height:auto;border-right:2px dotted #000; float: left; position: relative">
                <div style="text-align: center">
                    <img  src="assets/images/logoPrint.png" alt="Edwardes College Peshawar" width="25%;">
                </div>
                         
                  <p style="font-size: 14px; text-align: center; font-weight: bold;">EDWARDES COLLEGE PESHAWAR</p>
                  <p style="font-size: 12px; text-align: center;"><strong><?php echo $this->DefaultFeeBank->name?></strong> <br><strong style="font-size: 15px;">Acc No :(<?php echo $this->DefaultFeeBank->account_no?>)</strong></p>
                  
                  
                  <div>
                      
                  </div>
                  
                  
                <table class="table ">
                        <tr  style="font-size: 20px;">
                            <td class="removeBorder"><strong>Challan# :</strong></td>
                            <td class="removeBorder"><strong><?php echo  $std_data->form_no    ?></strong></td>
                             
                        </tr>
                        <tr  style="font-size: 13px;">
                           <td class="removeBorder">Name : </td>
                           <td class="removeBorder"><?php 
 
                            $newtext = wordwrap($std_data->student_name, 8, "\n", true);
                            echo     substr("$newtext\n", 0, 37);
                                   ?></td>
                        </tr>
                        <tr style="font-size: 13px;">
                           <td class="removeBorder"> Father Name : </td>
                           <td class="removeBorder"><?php
                           
                            $newtext = wordwrap($std_data->father_name, 8, "\n", true);
                            echo      substr("$newtext\n", 0, 37);
                            
                               ?> </td>
                        </tr>
                        <tr>
                           <td style="font-size: 13px;" class="removeBorder"> Program : </td>
                           <td style="font-size: 13px;"class="removeBorder"><?php echo  $std_data->sub_progam    ?> </td>
                        </tr>
                        <?php
                            if($std_data->programe_id == 1):
                            ?>
                        <tr>
                            <td style="font-size: 13px;" class="removeBorder"> <strong>SSC Marks : </strong></td>
                           <td style="font-size: 13px;" class="removeBorder"><strong><?php 
                           
                           
//                           if($std_data->app_verify_flag == 1):
//                                echo  $std_data->obtained_marks_9th.'/'.$std_data->total_marks_9th;
//                           else:
                               echo  $std_data->obtained_marks.'/'.$std_data->total_marks;
                           
//                           endif;
                           
                           ?> </strong></td>
                           
                        </tr>
                         <?php
                            endif;
                        ?>
                        <tr>
                            <td style="font-size: 13px;" class="removeBorder"><strong>Valid Till :</strong></td>
                           <td style="font-size: 13px;" class="removeBorder"><strong><?php echo  $due_date;?></strong></td>
                        </tr>
                    </table>
                 
                  <table class="table">    
                    <tr style="background-color:black; color: white;">
                            <td style="font-size: 13px;" >Description</td>
                            <td style="font-size: 13px; text-align: center;" style="text-align: center;">Amount</td>
                        </tr>
                        <tr>
                            <td style="font-size: 13px;" class="removeBorder"><?php echo  $std_data->title    ?></td> 
                            <td style="font-size: 13px; text-align: center;" class="removeBorder" ><?php echo  $std_data->amount    ?>/-</td>  
                        </tr> 
                        <tr>
                            <td style="padding-top:10px;  font-size: 13px;" class="removeBorder"><strong>Total</strong></td> 
                            <td style="padding-top:10px; text-align: center; font-size: 13px;" class="removeBorder" ><strong><?php echo  $std_data->amount?>/-</strong></td> 
                        </tr> 
                        <tr>
                            <td colspan="2" style="font-size: 10px;" class="removeBorder">Comments:</td>
                        
                    </tr>
                </table>
                   
               
                                          
                  <h6 align="center"><strong>For Bank</strong></h6>
               <h6 align="center" style="border-top: 1px solid; font-size: 12px;"><strong>[<?php echo  $std_data->batch_name ?> ]</strong> Banker's stamp &amp; signature</h6>
               <h5 align="left" style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif !important;"><strong>Instructions For Bank</strong></h5> 
               <ol class="custom-list-style">
                    <li> <strong>Fee can be paid at any HBL-Branch</strong></li>
                    <li> <strong>Please mention Challan# as "Mandatory" while depositing the fee, so that it can easily be traced in bank statement.</strong></li>
                    <li><strong>No Fee shall be deposited after <?php echo  $due_date;?>.</strong></li>

                </ol>
               
              </div>
  
             <div style="margin: 2px 4px 2px; width:32%;height:auto;border-right:2px dotted #000; float: left; position: relative">
                <div style="text-align: center">
                    <img  src="assets/images/logoPrint.png" alt="Edwardes College Peshawar" width="25%;">
                </div>
                         
                  <p style="font-size: 14px; text-align: center; font-weight: bold;">EDWARDES COLLEGE PESHAWAR</p>
                  <p style="font-size: 12px; text-align: center;"><strong><?php echo $this->DefaultFeeBank->name?></strong> <br><strong style="font-size: 15px;">Acc No :(<?php echo $this->DefaultFeeBank->account_no?>)</strong></p>
                  
                  
                  <div>
                      
                  </div>
                  
                  
              <table class="table ">
                        <tr  style="font-size: 20px;">
                            <td class="removeBorder"><strong>Challan# :</strong></td>
                            <td class="removeBorder"><strong><?php echo  $std_data->form_no    ?></strong></td>
                             
                        </tr>
                        <tr  style="font-size: 13px;">
                           <td class="removeBorder">Name : </td>
                           <td class="removeBorder"><?php 
 
                            $newtext = wordwrap($std_data->student_name, 8, "\n", true);
                            echo     substr("$newtext\n", 0, 37);
                                   ?></td>
                        </tr>
                        <tr style="font-size: 13px;">
                           <td class="removeBorder"> Father Name : </td>
                           <td class="removeBorder"><?php
                           
                            $newtext = wordwrap($std_data->father_name, 8, "\n", true);
                            echo      substr("$newtext\n", 0, 37);
                            
                               ?> </td>
                        </tr>
                        <tr>
                           <td style="font-size: 13px;" class="removeBorder"> Program : </td>
                           <td style="font-size: 13px;"class="removeBorder"><?php echo  $std_data->sub_progam    ?> </td>
                        </tr>
                          <?php
                            if($std_data->programe_id == 1):
                            ?>
                        <tr>
                            <td style="font-size: 13px;" class="removeBorder"> <strong>SSC Marks : </strong></td>
                           <td style="font-size: 13px;" class="removeBorder"><strong><?php 
                           
                           
//                           if($std_data->app_verify_flag == 1):
//                                echo  $std_data->obtained_marks_9th.'/'.$std_data->total_marks_9th;
//                           else:
                               echo  $std_data->obtained_marks.'/'.$std_data->total_marks;
                           
//                           endif;
                           
                           ?> </strong></td>
                           
                        </tr>
                         <?php
                            endif;
                        ?>
                        <tr>
                            <td style="font-size: 13px;" class="removeBorder"><strong>Valid Till :</strong></td>
                           <td style="font-size: 13px;" class="removeBorder"><strong><?php echo  $due_date;?></strong></td>
                          
                        </tr>
                    </table>
                   <table class="table">    
                    <tr style="background-color:black; color: white;">
                            <td style="font-size: 13px;" >Description</td>
                            <td style="font-size: 13px; text-align: center;" style="text-align: center;">Amount</td>
                        </tr>
                        <tr>
                            <td style="font-size: 13px;" class="removeBorder"><?php echo  $std_data->title; ?></td> 
                            <td style="font-size: 13px; text-align: center;" class="removeBorder" ><?php echo  $std_data->amount    ?>/-</td>  
                        </tr> 
                        <tr>
                            <td style="padding-top:10px;  font-size: 13px;" class="removeBorder"><strong>Total</strong></td> 
                            <td style="padding-top:10px; text-align: center; font-size: 13px;" class="removeBorder" ><strong><?php echo  $std_data->amount?>/-</strong></td> 
                        </tr> 
                        <tr>
                            <td colspan="2" style="font-size: 10px;" class="removeBorder">Comments:</td>
                        
                    </tr>
                </table>
                     
                
                                              
               <h6 align="center"><strong>For College</strong></h6>
               <h6 align="center" style="border-top: 1px solid; font-size: 12px;"><strong>[<?php echo  $std_data->batch_name    ?> ]</strong> Banker's stamp &amp; signature</h6>
               <h5 align="left" style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif !important;"><strong>Instructions For Bank</strong></h5> 
                <ol class="custom-list-style">
                    <li> <strong>Fee can be paid at any HBL-Branch</strong></li>
                    <li> <strong>Please mention Challan# as "Mandatory" while depositing the fee, so that it can easily be traced in bank statement.</strong></li>
                    <li><strong>No Fee shall be deposited after <?php echo  $due_date;?>.</strong></li>

                </ol>
             </div>
             <div style="margin: 2px 4px 2px; width:32%;height:auto; float: left; position: relative">
                <div style="text-align: center">
                    <img  src="assets/images/logoPrint.png" alt="Edwardes College Peshawar" width="25%;">
                </div>
                         
                  <p style="font-size: 14px; text-align: center; font-weight: bold;">EDWARDES COLLEGE PESHAWAR</p>
                  <p style="font-size: 12px; text-align: center;"><strong><?php echo $this->DefaultFeeBank->name?></strong> <br><strong style="font-size: 15px;">Acc No :(<?php echo $this->DefaultFeeBank->account_no?>)</strong></p>
                  
                  
                  <div>
                      
                  </div>
                 <table class="table ">
                        <tr  style="font-size: 20px;">
                            <td class="removeBorder"><strong>Challan# :</strong></td>
                            <td class="removeBorder"><strong><?php echo  $std_data->form_no    ?></strong></td>
                             
                        </tr>
                        <tr  style="font-size: 13px;">
                           <td class="removeBorder">Name : </td>
                           <td class="removeBorder"><?php 
 
                            $newtext = wordwrap($std_data->student_name, 8, "\n", true);
                            echo     substr("$newtext\n", 0, 37);
                                   ?></td>
                        </tr>
                        <tr style="font-size: 13px;">
                           <td class="removeBorder"> Father Name : </td>
                           <td class="removeBorder"><?php
                           
                            $newtext = wordwrap($std_data->father_name, 8, "\n", true);
                            echo      substr("$newtext\n", 0, 37);
                            
                               ?> </td>
                        </tr>
                        <tr>
                           <td style="font-size: 13px;" class="removeBorder"> Program : </td>
                           <td style="font-size: 13px;"class="removeBorder"><?php echo  $std_data->sub_progam    ?> </td>
                        </tr>
                          <?php
                            if($std_data->programe_id == 1):
                            ?>
                        <tr>
                            <td style="font-size: 13px;" class="removeBorder"> <strong>SSC Marks : </strong></td>
                           <td style="font-size: 13px;" class="removeBorder"><strong><?php 
                           
                           
//                           if($std_data->app_verify_flag == 1):
//                                echo  $std_data->obtained_marks_9th.'/'.$std_data->total_marks_9th;
//                           else:
                               echo  $std_data->obtained_marks.'/'.$std_data->total_marks;
                           
//                           endif;
                           
                           ?> </strong></td>
                           
                        </tr>
                         <?php
                            endif;
                        ?>
                        <tr>
                            <td style="font-size: 13px;" class="removeBorder"><strong>Valid Till :</strong></td>
                           <td style="font-size: 13px;" class="removeBorder"><strong><?php echo  $due_date;?></strong></td>
                        </tr>
                    </table>
                 
                <table class="table">    
                    <tr style="background-color:black; color: white;">
                            <td style="font-size: 13px;" >Description</td>
                            <td style="font-size: 13px; text-align: center;" style="text-align: center;">Amount</td>
                        </tr>
                        <tr>
                            <td style="font-size: 13px;" class="removeBorder"><?php echo  $std_data->title    ?></td> 
                            <td style="font-size: 13px; text-align: center;" class="removeBorder" ><?php echo  $std_data->amount    ?>/-</td>  
                        </tr> 
                        <tr>
                            <td style="padding-top:10px;  font-size: 13px;" class="removeBorder"><strong>Total</strong></td> 
                            <td style="padding-top:10px; text-align: center; font-size: 13px;" class="removeBorder" ><strong><?php echo  $std_data->amount?>/-</strong></td> 
                        </tr> 
                        <tr>
                            <td colspan="2" style="font-size: 10px;" class="removeBorder">Comments:</td>
                        
                    </tr>
                   
                </table>
                 
               
               
                                               
               <h6 align="center"><strong>Student Copy</strong></h6>
               <h6 align="center" style="border-top: 1px solid; font-size: 12px;"><strong>[<?php echo  $std_data->batch_name    ?> ]</strong> Banker's stamp &amp; signature</h6>
               <h5 align="left" style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif !important;"><strong>Instructions For Bank</strong></h5> 
                <ol class="custom-list-style">
                    <li> <strong>Fee can be paid at any HBL-Branch</strong></li>
                    <li> <strong>Please mention Challan# as "Mandatory" while depositing the fee, so that it can easily be traced in bank statement.</strong></li>
                    <li><strong>No Fee shall be deposited after <?php echo  $due_date;?>.</strong></li>

                </ol>
              </div>
             
           
            
         <?php endif; ?>      
           
            
         
 