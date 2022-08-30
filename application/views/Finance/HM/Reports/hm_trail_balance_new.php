
<script language="javascript">
  function printdiv(printpage)
  {
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
 
<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">
        <?php echo $page_header?>
      </h1>
      <div class="breadcrumbs pull-right">
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-label">You are here:
          </li>
          <li>
            <?php echo anchor('admin/admin_home', 'Home');?> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current">
            <?php echo $page_header?>
          </li>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header>
    <div class="page-content">
        
        
        
        
        
      <div class="row">
          <div class="col-md-12">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?></span>
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
                                                    'value'         => $dateFrom,
                                                    ));
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">To</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'dateto',
                                                'id'            => 'dateto',
                                                'type'          => 'text ',
                                                'value'         => $toDate,
                                                'class'         => 'form-control datepicker',
                                                'placeholder'   => 'Date to',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>

                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-4 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="search" id="search"  value="Search" ><i class="fa fa-search"></i> Search</button>
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>
                                    <!--<button type="button" class="btn btn-theme" name="print" id="printLeader"  value="Search" ><i class="fa fa-print"></i> Print</button>-->
                                    <button type="submit" class="btn btn-theme" name="excel"   value="excel" ><i class="fa fa-download"></i> Excel</button>
                                   
                                    <!--<a href="general_ledger"><button type="button" class="btn btn-theme"  id="save"> Reset</button></a>-->
                                    
                                        
                                    
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
              
              <div id="div_print">
                        
                            <div class="row">
                                    <div class="col-md-12" style="margin-left:40px">
                                        <div class="table-responsive"> 
                                            <?php
                                         
                                
                                        if(!empty($TrailBalanceFullHeads)):
                                            
                                            
                                            ?>
                                            
                                            <h5 class="heading-title" style=" text-align: center"> 
                                                TRIAL BALANCE
                                                </h5>
                                            <h5 class="heading-title" style=" text-align: center"> 
                                                DATE FROM &nbsp;: <?=date('d-m-Y', strtotime($dateFrom))?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DATE TO : <?=date('d-m-Y', strtotime($toDate))?>
                                                </h5>
                                            
                                            <table class="table table-hover" style="font-size:10px" border="1">
                                                <thead> <tr>
                                                        <th colspan="1" style="width: 5%"></th>
                                                <th colspan="1" style="width: 20%"></th>
                                                <th colspan="2" style="text-align:  center; width: 20% ">OPENING BALANCE</th>
                                                <th colspan="2" style="text-align:  center; width: 20% ">FOR THE PERIOED </th>
                                                <th colspan="2" style="text-align:  center; width: 20% ">CLOSING BALANCE</th>
                                                      
                                            </tr>
                                            <tr>
                                                <th style="text-align:  center;width: 5%">Code</th>
                                                <th style="text-align:  center;width: 20%">COA Description</th>
                                                <th style="text-align:  center;width:10%; ">Debit</th>
                                                <th style="text-align:  center;width:10%; ">Credit</th>  
                                                <th style="text-align:  center;width:10%; ">Debit</th>
                                                <th style="text-align:  center;width:10%; ">Credit</th>  
                                                <th style="text-align:  center;width:10%; ">Debit</th>
                                                <th style="text-align:  center;width:10%; ">Credit</th>  
                                            </tr>
                                          </thead>
                                        <?php
                                      
                                            
                                           $final_total_op_debit = '';
                                           $final_total_op_credit = '';
                                            
                                           $final_total_current_debit = '';
                                           $final_total_current_credit = '';
                                            
                                           $final_total_close_debit = '';
                                           $final_total_close_credit = '';

                                            foreach($TrailBalanceFullHeads as $GLRow):
                                                
                                            $where = array(
                                                    'gl_ad_coa_mc_pk'=>$GLRow->gl_ad_coa_mc_pk,
                                                     'gl_amount_transition.fn_account_type_id' => 2,
                                                    'payment_date <'=>date('Y-m-d', strtotime($dateFrom)),
                                                    );
                                                $open_balance       = $this->FinanceModel->open_balance($where);
      
                                                    $grandCredit_open   = 0;
                                                    $grandDebit_open    = 0;
                                                    $debit_total_open   = 0;
                                                    $credit_total_open  = 0;
                                                    
                                                    foreach($open_balance as $obRow):
                                                        $query          =  $this->db->where(array('status'=>1,'fn_account_type_id'=>2))->get('financial_year')->row();;
                                         
                                                        $grandDebit     = '';
                                                        $grandCredit    = '';
                                                        $parentId       = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>2));
                                                         $count = '';
                                                        if(!empty($parentId)):
                                                          if($parentId->fn_coa_code == 200000):
                                                            $debit_total_open       +=$obRow->gl_ad_depit ;
                                                            $credit_total_open      +=$obRow->gl_ad_credit;         
                                                            $grandCredit_open       = $credit_total_open-$debit_total_open;
                                                            $grandDebit_open        = '';
                                                        endif;
                                                      endif; 
                                                       if(!empty($parentId)):
                                                         
                                                        if($parentId->fn_coa_code == 400000):
                                                            $dateDiff   = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
                                                            $timeStart  = $dateDiff->format("%R%a"); 
                                                            if($timeStart > 0):
                                                                $debit_total_open       += $obRow->gl_ad_depit ;
                                                                $credit_total_open      += $obRow->gl_ad_credit; 
                                                                $grandCredit_open       = $credit_total_open-$debit_total_open;
                                                                $grandDebit_open     = '';
                                                                else:
                                                            endif; 
                                                        endif;
                                                           
                                                      endif;
                                                        if(!empty($parentId)):
                                                          if($parentId->fn_coa_code == 300000):
                                                            
                                                                   $debit_total_open       +=$obRow->gl_ad_depit ;
                                                                    $credit_total_open      +=$obRow->gl_ad_credit;
                                                               $grandDebit_open = $debit_total_open- $credit_total_open;
                                                                $grandCredit_open    = '';
                                                        endif; 
                                                      endif;
                                                         if(!empty($parentId)):
                                                            if($parentId->fn_coa_code == 500000):
                                                            $dateDiff = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
                                                            $timeStart = $dateDiff->format("%R%a"); 

                                                            if($timeStart > 0):
                                                                $debit_total_open       += $obRow->gl_ad_depit ;
                                                                $credit_total_open      += $obRow->gl_ad_credit;
                                                                $grandDebit_open        = $debit_total_open- $credit_total_open;
                                                                $grandCredit_open       = '';
                                                                else:
                                                                endif;
                                                        endif;
                                                      endif;
                                                    
                                                   

                                                       
                                                      
                                                    endforeach; 
                                                    
                                                    echo '<tr>';
                                                    echo '<td style="width: 5%">'.$GLRow->gl_ad_coa_mc_id.'</td>';
                                                    echo '<td style="width: 20%">'.$GLRow->gl_ad_coa_mc_name.'</td>';
                                                    echo '<td style="text-align:  right; width: 10%;">';
                                                        if(!empty($grandDebit_open)):
                                                            echo   number_format($grandDebit_open, 0, ',', ','); 
                                                            $final_total_op_debit  += $grandDebit_open;
                                                        endif;
                                                    echo '</td>';
                                                    echo '<td style="text-align:  right ; width: 10%;">';
                                                        if(!empty($grandCredit_open)):
                                                            echo    number_format($grandCredit_open, 0, ',', ','); 
                                                            $final_total_op_credit  += $grandCredit_open;
                                                        endif;
                                                    echo '</td>';
                                                 
                                                    
                                                $detail = $this->FinanceModel->get_amountDetails(
                                                        'gl_amount_transition',
                                                        array(
                                                            'gl_ad_coa_mc_pk'=>$GLRow->gl_ad_coa_mc_pk,
                                                             'gl_amount_transition.fn_account_type_id' =>2
                                                            ),$dateFrom,$toDate);

                                               $credit_total    = '';
                                               $debit_total     = '';
                                                foreach($detail as $dRow):
                                                        $debit_total    +=$dRow->gl_ad_depit;
                                                        $credit_total   +=$dRow->gl_ad_credit;
                                                endforeach;
                                                 $final_total_current_debit += $debit_total;
                                                $final_total_current_credit += $credit_total;  
                                                
                                                echo '<td style="text-align:  right;width:10%;"> ';
                                                        if(!empty($debit_total)):
                                                             echo number_format($debit_total, 0, ',', ',');
                                                        else:
                                                      echo 0;
                                                        endif;
                                                echo '</td>';
                                                
                                                echo '<td style="text-align:  right;width:10%;">';
                                                       if(!empty($credit_total)):
                                                            echo  number_format($credit_total, 0, ',', ',');
                                                             else:
                                                      echo 0;
                                                        endif;
                                                echo '</td>';
                                        
                                                        $grandDebit     = '';
                                                        $grandCredit    = '';
                                                        $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>2));
                                                       if(!empty($parentId)):
                                                           if($parentId->fn_coa_code == 200000):
                                                               $grandCredit = $credit_total-$debit_total;
                                                               $grandDebit     = '';
                                                        endif; 
                                                       endif;    
                                                       if(!empty($parentId)):
                                                           if($parentId->fn_coa_code == 400000):
                                                               $grandCredit = $credit_total-$debit_total;
                                                                $grandDebit     = '';   
                                                        endif;
                                                       endif;    
                                                       if(!empty($parentId)):
                                                           if($parentId->fn_coa_code == 300000):
                                                               $grandDebit = $debit_total- $credit_total;
                                                                $grandCredit    = '';
                                                        endif; 
                                                       endif;    
                                                       if(!empty($parentId)):
                                                           if($parentId->fn_coa_code == 500000):
                                                               $grandDebit = $debit_total- $credit_total;
                                                        $grandCredit    = '';
                                                        endif;
                                                       endif;    
                                                       
                                                        
                                                        
                                                       
                                                        

                                                        echo '<td style="text-align:  right;width:10%;">';
                                                            $grand_open_Dept = $grandDebit+$grandDebit_open;
                                                            if(!empty($grand_open_Dept)):
                                                                echo number_format($grandDebit+$grandDebit_open, 0, ',', ',');
                                                            $final_total_close_debit += $grandDebit+$grandDebit_open;
                                                                endif;
                                                        echo '</td style="text-align:  right;width:10%;">';
                                                        
                                                        echo '<td style="text-align:  right;width:10%;">';
                                                               $grand_open_Credit = $grandCredit+$grandCredit_open;
                                                           if(!empty($grand_open_Credit)):
                                                              echo  number_format($grandCredit+$grandCredit_open, 0, ',', ',');
                                                           $final_total_close_credit +=$grandCredit+$grandCredit_open;
                                                               endif;
                                                        echo '</td>';
                                                        echo ' </tr> ';
                                               
                                        
                                            endforeach;
                                           

                                            
                                            echo '<tr>';
                                            echo '<td colspan="2" style="text-align=;text-align: right; width: 5%"><strong>TOTAL [PKR]</strong></td>';
                                            echo '<td style="text-align:  right;width: 10% "><strong>';
                                            if($final_total_op_debit): 
                                                echo number_format($final_total_op_debit, 0, ',', ',');
                                            endif;
                                            echo '</td></strong>';
                                           echo '<td style="text-align:  right; width: 10%;"><strong>';
                                            if($final_total_op_credit):
                                               
                                                echo number_format($final_total_op_credit, 0, ',', ',');
                                            endif;
                                            echo '</td></strong>';

                                           
                                            echo '<td style="text-align:  right;width:10%;"><strong>';
                                            if($final_total_current_debit): 
                                                echo number_format($final_total_current_debit, 0, ',', ',');
                                            endif;
                                            echo '</td></strong>';
                                           echo '<td style="text-align:  right;width:10%;"><strong>';
                                            if($final_total_current_credit): 
                                                echo number_format($final_total_current_credit, 0, ',', ',');
                                            endif;
                                            echo '</td></strong>';

                                           
                                            echo '<td style="text-align:  right;width:10%;"><strong>';
                                            if($final_total_close_debit): 
                                                echo number_format($final_total_close_debit, 0, ',', ',');
                                            endif;
                                            echo '</td></strong>';
                                           echo '<td style="text-align:  right;width:10%;"><strong>';
                                            if($final_total_close_credit): 
                                                echo number_format($final_total_close_credit, 0, ',', ',');
                                            endif;
                                            echo '</td></strong>';
                                            echo '</tr>';
                                            
                                            $NET_INCOME_NET_YEAR       = '';
                                            $GRAND_NET_TOTAL    = '';
                                            
                                             $NET_INCOME_NET_YEAR = $final_total_op_debit -$final_total_op_credit;
                                             $GRAND_NET_TOTAL = $NET_INCOME_NET_YEAR +$final_total_op_credit;
                                             
                                              
                                            
                                            echo '<tr>';
                                                echo '<td colspan="2" style="text-align:  right;width:10%;"><strong>NET INCOME [PKR]</strong></td>';
                                                echo '<td colspan="1" style="text-align:  right;width:10%;"><strong></strong></td>';
                                                
                                                 if($NET_INCOME_NET_YEAR):
                                                     echo '<td colspan="1" style="text-align:  right;width:10%;"><strong>'.number_format($NET_INCOME_NET_YEAR, 0, ',', ',').'</strong></td>';
                                                    else:
                                                     echo '<td colspan="1" style="text-align:  right;width:10%;"><strong>0</strong></td>';
                                                endif;
                                         
                                                echo '<td colspan="4" style="text-align:  right;width:10%;"><strong></strong></td>';
                                                
                                            echo '</tr>';
                                            echo '<tr>';
                                                echo '<td colspan="2" style="text-align:  right;width:10%;"><strong>GRAND TOTAL [PKR]</strong></td>';
                                                
                                                if($final_total_op_debit):
                                                     echo '<td colspan="1" style="text-align:  right;width:10%;"><strong>'.number_format($final_total_op_debit, 0, ',', ',').'</strong></td>';
                                                    else:
                                                     echo '<td colspan="1" style="text-align:  right;width:10%;"><strong>0</strong></td>';
                                                endif;
                                                
                                                if($GRAND_NET_TOTAL):
                                                     echo '<td colspan="1" style="text-align:  right;width:10%;"><strong>'.number_format($GRAND_NET_TOTAL, 0, ',', ',').'</strong></td>';
                                                    else:
                                                     echo '<td colspan="1" style="text-align:  right;width:10%;"><strong>0</strong></td>';
                                                endif;
                                                
                                               
                                                
                                                echo '<td colspan="4" style="text-align:  right;width:10%;"><strong></strong></td>';
                                                
                                            echo '</tr>';
                                        endif;
                                        ?>
                                             </table><!--//table-->
                                       </div><!--//table-responsive-->
                                    </div>
                                     
                                </div>
                </div>
              
             
          </div>
          
      
      </div>
                 </div>
 
      </div>
  
    </div>
 
 
  
     
     <script>
  $( function() {
    $( ".datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy'
    });
  } );
  </script>        