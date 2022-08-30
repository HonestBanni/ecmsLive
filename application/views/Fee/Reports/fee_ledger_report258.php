<style>

.report_header{
    display: none !important;
}
 
</style>


<script language="javascript">
  function printdiv(printpage)
  {
   
   var program      = jQuery('#program-id :selected').text(); 
   var batchid      = jQuery('#batch-id :selected').text(); 
   var sub_pro_name = jQuery('#sub-pro-name :selected').text(); 
   var group        = jQuery('#fetch-section :selected').text(); 
    
    var  printValue = '';
    if(program === 'Program '){
     
        }else{
       
            printValue += 'Program = '+ program;      
    };
  
    if(batchid === 'Batch '){
       
       }else{
               
         printValue += '  Batch = '+ batchid;     
    };
    if(sub_pro_name === 'Sub Program '){
        
            }else{
         printValue += '  Sub Program = '+ sub_pro_name;       
    };
    if(group === 'Section'){
        
        }else{
        printValue += '  Group = '+group;          
    };
            
    jQuery('#jq_program').html(printValue);
    
    var headstr = "<html><head><title></title></head><body>";
    var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
    var footstr = "</body>";
    var newstr = document.all.item(printpage).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = headstr+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;
    return false;
  }
</script>


<!--<script language="javascript">
  function printdiv(printpage)
  {
    var headstr = "<html><head><title></title></head><body>";
    //var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
    var footstr = "</body>";
    var newstr = document.all.item(printpage).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = headstr+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;
    return false;
  }
</script> -->
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
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                                  
                                     ?>
                                <div class="row">
                                <div class="col-md-2 col-sm-5">
                                      <label for="name">Form #</label>

                                       <div class="input-group" id="adv-search">
                                            <?php
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'form_no',
                                                            'type'          => 'text',
                                                            'value'         => $form_no,
                                                            'class'         => 'form-control',
                                                            'placeholder'   => 'Form No #',
                                                             )
                                                         );
                                                  ?>
                                          </div>

                                 </div>
                                <div class="col-md-2 col-sm-5">
                                      <label for="name">Challan #</label>

                                       <div class="input-group" id="adv-search">
                                            <?php
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'challan_no',
                                                            'type'          => 'number',
                                                            'value'         => $challan_no,
                                                            'class'         => 'form-control',
                                                            'placeholder'   => 'Challan #',
                                                             )
                                                         );
                                                  ?>
                                          </div>

                                 </div>
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">College #</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'collegeNo',
                                                                'type'          => 'number',
                                                                'value'         => $collegeNo,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'College #',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Name</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'stdName',
                                                                'type'          => 'text',
                                                                'value'         => $stdName,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Student Name',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Father Name</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'fatherName',
                                                                'type'          => 'text',
                                                                'value'         => $fatherName,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Father Name',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                    <div class="col-md-2">
                                    <label for="name">Gender</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('gender', $gender,$gender_id,  'class="form-control" ');
                                        ?>
                                    </div>
                                </div> 
                                        </div>
                            <div class="row">   
                                <div class="col-md-2">
                                    <label for="name">Program</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control" id="program-id"');
                                        ?>
                                    </div>
                                </div>
                         
                                <div class="col-md-2">
                                    <label for="name">Batch </label>
                                    <div class="form-group ">
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('batch', $batch,$batch_id,  'class="form-control" id="batch-id"');
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <label for="name">Sub Program</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control" id="sub-pro-name"');
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <label for="name">Section</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('section', $section,$sec_id,  'class="form-control" id="fetch-section"');
                                        ?>
                                    </div>
                                </div> 
<!--                                <div class="col-md-2">
                                    <label for="name">Payment Category</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                  form_dropdown('pc_id', $pc,$pc_id,  'class="form-control" id="payment-challan"');
                                        ?>
                                    </div>
                                </div> -->
                                <div class="col-md-2">
                                    <label for="name">Challan Status</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('challan_status', $challan,$challan_id,  'class="form-control" ');
                                        ?>
                                    </div>
                                </div> 
                                
                                     </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">From</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                     echo  form_input(
                                                             array(
                                                                'name'          => 'from',
                                                                'type'          => 'text',
                                                                'value'         => $from,
                                                                'class'         => 'form-control datepicker',
                                                                
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">To</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                     echo  form_input(
                                                             array(
                                                                'name'          => 'to',
                                                                'type'          => 'text',
                                                                'value'         => $to,
                                                                'class'         => 'form-control datepicker',
                                                                
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                            </div>
                              
                           </div><!--//section-content-->
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-search"></i> Search</button>
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>
                                   
     
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                        
                        
                        
                    </section>
           
                             <?php
                             
                          
                   if(!empty($result)):                      
        
        echo '<div class="row">
              <div class="col-md-12">';
                                        
                        
                                echo '<div id="div_print">
                                    
                                        <div class="report_header">
                                        
                                        <h3 class="text-highlight" style=" text-align: center">Student Ledger Report</h3>
                                        <h4 class="text-highlight" style=" text-align: center" ><div id="jq_program"></di></h4>
                                        <h4 class="text-highlight" style=" text-align: center" ><div id="jq_batch_id"></di></h4>
                                        <h4 class="text-highlight" style=" text-align: center" ><div id="jq_sub_pro_id"></di></h4>
                                        <h4 class="text-highlight" style=" text-align: center" ><div id="jq_group"></di></h4>
                                    
                                     
                                      
                                        </div>


                                        
                            
                                        <div>
                                              <table class="table table-hover" id="table" style="font-size:11px;">
                                                   <thead> ';
  
                                                      
                                                          foreach($result as $std_info):
                                                             echo ' 
                                                                    <tr  style="border-top: 3px solid #fff;">
                                                                          <th>Student Details</th>
                                                                          <th style="width: 62px;">From</th>
                                                                          <th style="width: 62px;">To </th>
                                                                          <th>Challan no</th>
                                                                          <th>Payable</th>
                                                                          <th>Arrears</th>
                                                                          
                                                                          <th>Net Payable</th>
                                                                          <th>Concession</th>
                                                                          <th>Total Dues</th>
                                                                          <th>Paid</th>
                                                                          <th>Balance</th>
                                                                          <th style="width: 62px;">Pay Date</th>
                                                                          <th>Comments</th>
                                                                      </tr>
                                                                  </thead><tbody>';
                                                           
                                                           echo '<tr class="danger">
                                                                 
                                                                <td colspan="3">'.$std_info->college_no.' - '.$std_info->student_name.'</td>
                                                                 
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                '; 
                                                            echo '</tr>';
                                                            
                                                            $gPayable       = '';
                                                            $gArrears       = '';
                                                            $gConcession    = '';
                                                            $gNetPayable    = '';
                                                            $gPaid          = '';
                                                            $gBalances       = '';
                                                            $totalpaid      = '';
//                                                               
                                                          foreach($std_info->fee_details as $row):
//                                                          echo '<pre>';print_r($row);die;
                                                    
                                                               $where_sec = array(
                                                                        'sections.sec_id'=>$row->section_id_paid,
//                                                                        'sections.sec_id'=>$std_info->section_id_paid
                                                                        );
                                                                $sec_name=  $this->db->get_where('sections',$where_sec)->row();
                                                              
                                                          echo '<tr>
                                                                <td >&nbsp;&nbsp;&nbsp;'.$sec_name->name.' - '.$std_info->student_status.'</td>
                                                                <td>'.date('d-M-y',  strtotime($row->fc_paid_form)).'</td>
                                                                <td>'.date('d-M-y',  strtotime($row->fc_paid_upto)).'</td>
                                                                <td>'.$row->fc_challan_id.'</td>
                                                                ';
                                                                
                                                               
                                                                  if($row->ch_status_id == 2 || $row->ch_status_id == 3):
                                                                      $totalpaid = $row->total_Paid;
                                                                       
                                                                      else:
                                                                        $totalpaid = '';
                                                                  endif;
                                                       
                                                                  
                                                                    $gBalance       =   $row->total_upPaid-$totalpaid-$row->concession;
                                                                    $total_payable  =   $row->current+$row->arrears;
                                                                    $totalPaid1      =   $total_payable - $row->concession ;
                                                                        echo '<td>'.$row->current.'</td>';
                                                                        echo '<td>'.$row->arrears.'</td>';
                                                                        echo '<td>'.$total_payable.'</td>';
                                                                        echo '<td>'.$row->concession.'</td>';
                                                                        echo '<td>'.$totalPaid1.'</td>';
                                                                        echo '<td>'.$totalpaid.'</td>';
                                                                        echo '<td>'.$gBalance.'</td>';
                                                                          $paid_date = '';
                                                                            if($row->fc_paiddate == '0000-00-00'):
                                                                            $paid_date = '';    
                                                                                else:
                                                                              $paid_date = date('d-M-y',strtotime($row->fc_paiddate));   
                                                                            endif;

                                                                            echo '  <td>'.$paid_date.'</td>'; 
                                                                         
                                                                        echo '<td>'.wordwrap($row->fc_comments, 30, "<br />\n").'</td>';
//                                                                        echo '<td>'.$row->fc_comments.'</td>';
                                                                        echo '</tr>';
                                                                        
                                                                        
                                                                        $gPayable       += $row->current;
                                                                        $gArrears       += $row->arrears;
                                                                        $gConcession    += $row->concession;
                                                                        $gNetPayable    += $total_payable;
                                                                        $gPaid          += $totalpaid;
                                                                       
                                                                        
                                                                      
                                                                         
                                                                        
                                                                        
                                                         
                                                          endforeach;      
                                                            $gBalances       = $gPayable -$gConcession -$gPaid;
                                                             echo '<tr>
                                                                 
                                                                <td> </td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>'.$gPayable.'</td>
                                                                <td> </td>
                                                                <td></td>
                                                                <td>'.$gConcession.'</td>
                                                                <td></td>
                                                                <td>'.$gPaid.'</td>
                                                                <td>'.$gBalances.'</td>
                                                                <td></td>
                                                                <td></td>
                                                                '; 
                                                            echo '</tr>';
                                                             
                                                           echo     '<tr  style="border: 3px solid #fff;">
                                                                 
                                                                <td><p></p></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <tr>
                                                                ';
                                                      endforeach;

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
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd-mm-yy'
    });
  } );
  </script>
  <style>
      .datepicker{
          z-index: 1;
      }
  </style>     
  
 
  
  
  