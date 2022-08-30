<script language="javascript">
  function printdiv(printpage)
  {
    var headstr = "<html><head><title></title></head><body>";
//    var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
    var footstr = "</body>";
    var newstr = document.all.item(printpage).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = headstr+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;
    return false;
  }
</script>  
<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left">Trial Balance</h1>
            <div class="breadcrumbs pull-right">
                <ul class="breadcrumbs-list">
                    <li class="breadcrumbs-label">You are here:</li>
                    <li><?php echo anchor('admin/admin_home', 'Home');?> 
                      <i class="fa fa-angle-right">
                      </i>
                    </li>
                    <li class="current">Trial Balance</li>
                </ul>
            </div>
      <!--//breadcrumbs-->
        </header> 
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <section class="course-finder" style="padding-bottom: 2%;">
                    <h1 class="section-heading text-highlight">
                        <span class="line">Trial Balance</span>
                    </h1>
                    <div class="section-content" >
                        <?php echo form_open('',array('class'=>'course-finder-form'));
                       
                                     ?>
                                <div class="row">
                                      
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">From</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'dateFrom',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'Date from',
                                                    'id'            => 'dateFrom',
                                                    'type'          => 'text',
                                                    'value'         => $fromDate,
                                                    ));
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">To</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'todate',
                                                'id'            => 'todate',
                                                'type'          => 'text',
                                                'value'         => $toDate,
                                                'class'         => 'form-control datepicker',

                                                ));
                                        ?>
                                       
                                        
                                     </div>
 
 
                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-4 pull-right">
                                  
                                    <button type="submit" class="btn btn-theme" name="search" id="searchTB"  value="Search" ><i class="fa fa-search"></i> Search</button>
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
                                    <!--<button type="submit" class="btn btn-theme" name="export"  value="export" ><i class="fa fa-download"></i> Excel</button>-->
                                   
<!--                                    <button type="submit" class="btn btn-theme"  id="export" name="export"><i class="fa fa-refresh"></i> Export</button>-->
                                    
                                        
                                    
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
              
              <?php
              
               if(!empty($trialBalance)):
              
             
                $class = array(
                    'info',
                    'success',
                    'danger',
                    'warning',
                    'active',
                    );
                  ?>
                
                
                <div id="div_print">
                
                <table class="table table-hover">
                                            
                                                <tr>
                                                    <td rowspan="2">Account Code</td>
                                                    <td rowspan="2">COA Description</td>
                                                    <td colspan="2">OPEN BALANCE</td>
                                                    <td colspan="2">FOR THE PERIOD</td>
                                                    <td colspan="2">CLOSING BALANCE</td>
                                                </tr>
                                                  <tr>
                                                    
                                                    <td>Debit</td>
                                                    <td>Credit</td>
                                                    <td>Debit</td>
                                                    <td>Credit</td>
                                                    <td>Debit</td>
                                                    <td>Credit</td>
                                                </tr> 
                                          
                                                <tbody>
                                                    <?php
                                                    
                                                    if($result):
                                                        
                                                    $open_balance_credit    = '';
                                                    $open_balance_debit     = '';
                                                    
                                                    $current_balance_credit    = '';
                                                    $current_balance_debit     = '';
                                                    
                                                    $closing_balance_credit    = '';
                                                    $closing_balance_debit     = '';
                                                    foreach($result as $coaRow):
                                                        
                                                   
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $coaRow->fn_coa_mc_code ?></td>
                                                        <td><?php echo $coaRow->fn_coa_mc_title ?></td>
                                                        <?php 
                                                            $where              = array( 'gl_ad_coa_mc_pk'=>  $coaRow->fn_coa_mc_id );
                                                            $opening_balance    = $this->FinanceModel->opening_trail_balance($where,$fromDate);
                                                                if(!empty($opening_balance)):
                                                                    $open_balance_credit +=$opening_balance->sumCredit;
                                                                    $open_balance_debit  +=$opening_balance->sumDebit;
                                                                
                                                                endif;
                                                              echo '<td>'.@$opening_balance->sumCredit.'</td>';  
                                                              echo '<td>'.@$opening_balance->sumDebit.'</td>';  
                                                             
                                                              
                                                            $current_balance    = $this->FinanceModel->current_trail_balance($where,$fromDate,$toDate);
//                                                            echo '<pre>';print_r($current_balance);die;   
                                                            if(!empty($current_balance)):
                                                                    $current_balance_credit +=$current_balance->sumCredit;
                                                                    $current_balance_debit  +=$current_balance->sumDebit;
                                                                
                                                                endif;
                                                              echo '<td>'.@$current_balance->sumCredit.'</td>';  
                                                              echo '<td>'.@$current_balance->sumDebit.'</td>';  
                                                             
                                                            $closing_balance    = $this->FinanceModel->closing_trail_balance($where,$toDate);
//                                                            echo '<pre>';print_r($current_balance);die;   
                                                            if(!empty($closing_balance)):
                                                                    $closing_balance_credit +=$closing_balance->sumCredit;
                                                                    $closing_balance_debit  +=$closing_balance->sumDebit;
                                                                
                                                                endif;
                                                              echo '<td>'.@$closing_balance->sumCredit.'</td>';  
                                                              echo '<td>'.@$closing_balance->sumDebit.'</td>';  
                                                             
                                                              
                                                              ?>
                                                   
                                                </tr> 
                                                 <?php
                                                    
                                                   endforeach; 
                                                        
                                                    endif;
                                                    
                                                    ?>
                                                <tr>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td><?php echo $open_balance_credit;?></td>
                                                    <td><?php echo $open_balance_debit;?></td>
                                                    
                                                    <td><?php echo $current_balance_credit;?></td>
                                                    <td><?php echo $current_balance_debit;?></td>
                                                    <td><?php echo $closing_balance_credit;?></td>
                                                    <td><?php echo $closing_balance_debit;?></td>
                                                       
                                                </tr>
                                                
                                                </tbody>
                </table>
                
                
           </div>        
                
                   <?php
//                        echo '<div id="div_print"><div class="row">
//                                <div class="col-md-12">
//                                    <div class="table-responsive"> 
//                                    <h3 class="has-divider text-highlight">Trial Balance From : '.date('d-m-Y', strtotime($fromDate)).' To : '.date('d-m-Y', strtotime($toDate)).'  </h3>
//                                        <table class="table table-hover">
//                                            
//                                                <tr>
//                                                    <td>Account Code</td>
//                                                    <td>COA Description</td>
//                                                    <td>Debit</td>
//                                                    <td>Credit</td>
//                                                </tr>
//                                          
//                                            <tbody>';
//                                               
//                                                    $totalCredit = '';
//                                                    $totalDebit = '';
//                                               
//                                                    foreach($trialBalance as $GLRow):
//                                                         $k = array_rand($class); 
//                                                        echo '<tr>
//                                                                <th>'.$GLRow->fn_coa_code.'</th>
//                                                                <th>'.$GLRow->fn_coa_title.'</th>
//                                                                <th> </th>
//                                                                <th> </th>
//                                                            </tr>';
//                                                             
//                                                                $master_child = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_pId'=>$GLRow->fn_coaId));
//                                                                $where_TB = '';
//                                                            
//                                                                foreach($master_child as $mcRow):
//                                                                   
//                                                                       
//                                                                        echo '<tr>
//                                                                                <td>'.$mcRow->fn_coa_m_code.'</td>
//                                                                                <td> &nbsp; &nbsp; &nbsp; &nbsp;'.$mcRow->fn_coa_m_title.'</td>
//                                                                                <td> </td>
//                                                                                <td> </td>
//                                                                            </tr>';
//                                                                                $where_TB['fn_coa_mc_mId']      =$mcRow->fn_coa_m_cId;
//                                                                                $where_TB['fn_coa_mc_status']   =1;
//                                                                                $where_TB['fn_coa_mc_trash']    =1;
//                                                                                $master_child_sub = $this->FinanceModel->amount_transitionDetails($where_TB,$fromDate,$toDate);
////                                                                                  echo '<pre>';print_r($master_child_sub); 
//                                                                                foreach($master_child_sub as $mscRow):
//                                                                                    
//                                                                                    $grandDebit     = '';
//                                                                                    $grandCredit    = '';    
//                                                                                    
//                                                                                    if($GLRow->fn_coa_code == 200000):
//                                                                                            $grandCredit = $mscRow->sumCredit-$mscRow->sumDebit;
//                                                                                            $grandDebit     = '';
//                                                                                     endif;
//                                                                                     if($GLRow->fn_coa_code == 400000):
//                                                                                            $grandCredit = $mscRow->sumCredit-$mscRow->sumDebit;
//                                                                                             $grandDebit     = '';   
//                                                                                     endif;
//
//                                                                                     if($GLRow->fn_coa_code == 300000):
//                                                                                            $grandCredit    = '';
//                                                                                            $grandDebit = $mscRow->sumDebit- $mscRow->sumCredit;
//                                                                                            
//                                                                                     endif;
//                                                                                     if($GLRow->fn_coa_code == 500000):
//                                                                                            $grandCredit    = '';
//                                                                                            $grandDebit = $mscRow->sumDebit- $mscRow->sumCredit;
//                                                                                           
//                                                                                     endif;
//                                                                                     echo '<tr class="'.$class[$k].'">
//                                                                                                <td>'.$mscRow->fn_coa_mc_code.'</td>
//                                                                                                <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;'.$mscRow->fn_coa_mc_title.'</td>
//                                                                                                <td>';
//                                                                                            
//                                                                                     if(empty($grandDebit)):
//                                                                                         $grandDebit = 0;
//                                                                                     else:
//                                                                                        echo number_format($grandDebit, 0, ',', ',');
//                                                                                     endif;
//                                                                                 
//                                                                                        echo '</td>
//                                                                                                <td>';
//                                                                                          if(empty($grandCredit)):
//                                                                                                $grandCredit = 0;
//                                                                                          else:
//                                                                                               echo number_format($grandCredit, 0, ',', ',');
//                                                                                            endif; 
//                                                                                       
//                                                                                        echo '</td> </tr>';
//                                                                                        $totalCredit +=$mscRow->sumCredit;
//                                                                                        $totalDebit  +=$mscRow->sumDebit;
//
//                                                                                endforeach;
//                                                                
//                                                                endforeach;
//                                                                            
//                                                        endforeach;
//                                                        if($totalDebit):
//                                                            echo '<tr>
//                                                                <td></td>
//                                                                <td>Total</td>
//                                                                <td>'.number_format($totalDebit, 0, ',', ',').'</td>
//                                                                <td>'.number_format($totalCredit, 0, ',', ',').'</td>
//                                                                 
//                                                            </tr>';
//                                                        endif;
//                                                         
//                                              
//                                                    
//                                                echo '</tbody></table>
//                                        </div>
//                                    </div>
//                                    </div>
//                                </div>'; 
                                                      endif;
              
              ?>
            </div>
           
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
 
 
     
    
    <!--// Record From Tog--> 
  <div id="RecordFromTog" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Chart Of Account</h4>
        </div>

        <div class="modal-body">
                <div class="table-responsive">  

                        <table  id="table" class="table table-hover">


                                <?php
                      
                                
                                
                                 $COAP =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1));
                                if($COAP):
                                    foreach($COAP as $coapRow):
                              
                                        echo '<tr class="first ">
                                             <td>&nbsp;</td>
                                                <td>'.$coapRow->fn_coa_code.'</td>
                                                <td>'.$coapRow->fn_coa_title.'</td>

                                            </tr>';
                                                $coac = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_status'=>1,'fn_coa_m_pId'=>$coapRow->fn_coaId));
                                                foreach($coac as $coacRow):

                                                     echo '<tr class="2nd">
                                                          <td>&nbsp;</td>
                                                            <td> '.$coacRow->fn_coa_m_code.'</td>

                                                            <td> &nbsp;&nbsp; &nbsp; &nbsp;'.$coacRow->fn_coa_m_title.'</td>


                                                        </tr>';
                                                $coacs = $this->CRUDModel->get_where_result('fn_coa_master_sub_child',array('fn_coa_mc_status'=>1,'fn_coa_mc_mId'=>$coacRow->fn_coa_m_cId));

                                                        foreach($coacs as $coacsRow):
                                                            
                                                             echo ' <tr class="recordFrom3rd" id="'.$coacsRow->fn_coa_mc_title.','.$coacsRow->fn_coa_mc_id.','.$coacsRow->fn_coa_mc_code.'">
                                                                        <td>&nbsp;</td>
                                                                        <td>'.$coacsRow->fn_coa_mc_code.'</td>

                                                                        <td>&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;'.$coacsRow->fn_coa_mc_title.'</td>


                                                                    </tr>';

                                                        endforeach;
                                                endforeach;
                                            endforeach;
                                endif;
                                ?>

                        </table><!--//table-->
                    </div>
            <ul class="job-list custom-list-style">
          <?php 
            if($COAP ==1):
                foreach($COAP as $coapRow):
                    echo ' <li><i class="fa fa-caret-right"></i><a href="javascript:vodi(0) id='.$coapRow->fn_coa_code.'">'.$coapRow->fn_coa_title.'</a></li>';
                        $coac = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_status'=>1,'fn_coa_m_pId'=>$coapRow->fn_coaId));
                        echo '<ul class="job-list custom-list-style">';
                            foreach($coac as $coacRow):
                                 echo ' <li><i class="fa fa-caret-right"></i><a href="javascript:vodi(0) id='.$coacRow->fn_coa_m_code.'">'.$coacRow->fn_coa_m_title.'</a></li>';
                                    $coacs = $this->CRUDModel->get_where_result('fn_coa_master_sub_child',array('fn_coa_mc_status'=>1,'fn_coa_mc_mId'=>$coacRow->fn_coa_m_cId));
                                    echo '<ul class="job-list custom-list-style">';
                                        foreach($coacs as $coacsRow):
                                             echo ' <li><i class="fa fa-caret-right"></i><a href="javascript:vodi(0) id='.$coacsRow->fn_coa_mc_code.'">'.$coacsRow->fn_coa_mc_title.'</a></li>';
                                        endforeach;
                                echo ' </ul>';
                            endforeach;
                        echo ' </ul>';
                endforeach;
            endif;

          ?>
                </ul>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
</div>  
        <!--// Record To Tog--> 
  <div id="RecordToTog" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Chart Of Account</h4>
        </div>

        <div class="modal-body">
                <div class="table-responsive">  

                        <table  id="table" class="table table-hover">


                                <?php
                                 $COAP =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1));
                                if($COAP):
                                    foreach($COAP as $coapRow):

                                        echo '<tr class="first">
                                             <td>&nbsp;</td>
                                                <td>'.$coapRow->fn_coa_code.'</td>
                                                <td>'.$coapRow->fn_coa_title.'</td>

                                            </tr>';
                                                $coac = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_status'=>1,'fn_coa_m_pId'=>$coapRow->fn_coaId));
                                                foreach($coac as $coacRow):

                                                     echo '<tr class="2nd">
                                                          <td>&nbsp;</td>
                                                            <td> '.$coacRow->fn_coa_m_code.'</td>

                                                            <td> &nbsp;&nbsp; &nbsp; &nbsp;'.$coacRow->fn_coa_m_title.'</td>


                                                        </tr>';
                                                $coacs = $this->CRUDModel->get_where_result('fn_coa_master_sub_child',array('fn_coa_mc_status'=>1,'fn_coa_mc_mId'=>$coacRow->fn_coa_m_cId));

                                                        foreach($coacs as $coacsRow):
                                                             echo ' <tr class="recordTo3rd" id="'.$coacsRow->fn_coa_mc_title.','.$coacsRow->fn_coa_mc_id.','.$coacsRow->fn_coa_mc_code.'">
                                                                        <td>&nbsp;</td>
                                                                        <td>'.$coacsRow->fn_coa_mc_code.'</td>

                                                                        <td>&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;'.$coacsRow->fn_coa_mc_title.'</td>


                                                                    </tr>';

                                                        endforeach;
                                                endforeach;
                                            endforeach;
                                endif;
                                ?>

                        </table><!--//table-->
                    </div>
            <ul class="job-list custom-list-style">
          <?php 
            if($COAP ==1):
                foreach($COAP as $coapRow):
                    echo ' <li><i class="fa fa-caret-right"></i><a href="javascript:vodi(0) id='.$coapRow->fn_coa_code.'">'.$coapRow->fn_coa_title.'</a></li>';
                        $coac = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_status'=>1,'fn_coa_m_pId'=>$coapRow->fn_coaId));
                        echo '<ul class="job-list custom-list-style">';
                            foreach($coac as $coacRow):
                                 echo ' <li><i class="fa fa-caret-right"></i><a href="javascript:vodi(0) id='.$coacRow->fn_coa_m_code.'">'.$coacRow->fn_coa_m_title.'</a></li>';
                                    $coacs = $this->CRUDModel->get_where_result('fn_coa_master_sub_child',array('fn_coa_mc_status'=>1,'fn_coa_mc_mId'=>$coacRow->fn_coa_m_cId));
                                    echo '<ul class="job-list custom-list-style">';
                                        foreach($coacs as $coacsRow):
                                             echo ' <li><i class="fa fa-caret-right"></i><a href="javascript:vodi(0) id='.$coacsRow->fn_coa_mc_code.'">'.$coacsRow->fn_coa_mc_title.'</a></li>';
                                        endforeach;
                                echo ' </ul>';
                            endforeach;
                        echo ' </ul>';
                endforeach;
            endif;

          ?>
                </ul>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
</div>  
        
        
        
             <script>
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 3,
        dateFormat: 'd-m-yy'
    });
  } );
  </script>
  <style>
      .datepicker{
          z-index: 1;
      }
  </style>