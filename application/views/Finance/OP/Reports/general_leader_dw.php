
<script language="javascript">
  function printdiv(printpage)
  {
    var headstr = "<html><head><title></title></head><div><p style='padding-left: 70%;'><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p><p style='text-align: center;'>EDWARDES COLLEGE PESHAWAR <br/> GENERAL LEDGER</p></div><body>";
//    var headstr = "<html><head><title></title></head><body><p ><img  style='text-align: right;' class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
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
            <h1 class="heading-title pull-left"> <?php echo $page_header?></h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current"> <?php echo $page_header?></li>
                    </ul>
                </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
        
        
        
        
        
      <div class="row">
          <div class="col-md-12">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"> <?php echo $page_header?> Search</span>
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
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">Record Form</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo    form_input(
                                                             array(
                                                                'name'          => 'recordFrom',
                                                                'id'            => 'recordFrom',
                                                                'value'         => $recordFrom,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Record From',
                                                                 )
                                                             );
                                                      ?>
                                                
                                                 <?php
                                                    echo form_input(
                                                          array(
                                                                  'name'          => 'recordFromCode',
                                                                  'id'            => 'recordFromCode',
                                                                  'value'         => $recordFromCode,
                                                                  'type'          => 'hidden',
                                                                  'class'         => 'form-control',
                                                                  'placeholder'   => 'Account',
                                                                  )
                                                          );
                                                  ?>
                                                 
                                                <div class="input-group-btn">
                                                    <div class="btn-group" role="group">
                                                        <div class="dropdown dropdown-lg">
                                                           
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="modal" data-target="#RecordFromTog" aria-expanded="false"><span class="caret"></span></button>
                                                            
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">Record to</label>
                                         
                                          
                                          
                                          <div class="input-group" id="adv-search">
                                                 <?php
                                            echo form_input(array(
                                            'name'          => 'recordTo',
                                            'id'            => 'recordTo',
                                            'value'         => $recordTo,
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Record To',
                                            'type'          => 'text',
                                            ));
                                        ?>
                                          <?php
                                            echo form_input(array(
                                            'name'          => 'recordToCode',
                                            'id'            => 'recordToCode',
                                            'value'         => $recordToCode,
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Record To',
                                            'type'          => 'hidden',
                                            ));
                                        ?>
                                                 
                                                <div class="input-group-btn">
                                                    <div class="btn-group" role="group">
                                                        <div class="dropdown dropdown-lg">
                                                           
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="modal" data-target="#RecordToTog" aria-expanded="false"><span class="caret"></span></button>
                                                            
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                   </div>
                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-4 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="search" id="search"  value="Search" ><i class="fa fa-search"></i> Search</button>
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>
                                    <!--<button type="button" class="btn btn-theme" name="print" id="printLeader"  value="Search" ><i class="fa fa-print"></i> Print</button>-->
                                    <button type="submit" class="btn btn-theme" name="excel"   value="excel" ><i class="fa fa-download"></i> Excel</button>
                                   
                                    <a href="general_ledger"><button type="button" class="btn btn-theme"  id="save"> Reset</button></a>
                                    
                                        
                                    
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
              
              <div id="div_print">
                        
                            <div class="row">
                                 
                                    <div class="col-md-12" style="margin-left:80px">
                                        <?php
                                        $class = array(
                                                'info',
                                                'success',
                                                'danger',
                                                'warning',
                                                'active',
                                            );
                                
                                        if(!empty($GeneralLeader)):
//                                            echo '<pre>';print_r($GeneralLeader);die;
//                                            $this->db->where('vocher_type',2);
                                            foreach($GeneralLeader as $GLRow):
                                           $k = array_rand($class);
                                    
                                        ?>
                                        
                                        
                                        
                                        
                                       
                                             <table class="table table-hover" style="font-size:10px; margin-bottom:8px;">
                                                 <tr>
                                                     <td colspan="2" style="border-top: 1px solid #ffff;font-weight: bold;text-decoration:  underline; font-size:10px"><?php echo $GLRow->gl_ad_coa_mc_name?> (<?php echo $GLRow->gl_ad_coa_mc_id?>)</td>
                                                     <td colspan="2" style="border-top: 1px solid #ffff;"></td>
                                                     <td colspan="4" style="border-top: 1px solid #ffff;font-weight: bold;text-align: right;font-size:10px;">From&nbsp;: <?=date('d-m-Y', strtotime($dateFrom))?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To : <?=date('d-m-Y', strtotime($toDate))?></td>
                                                 </tr>
                                             </table>
                                        
                                        
                                        <div class="table-responsive">                      
                                            
                                            <table class="table table-hover" style="font-size:8px">
                                                <?php
                                           
                                                        $where = array(
                                                            'gl_ad_coa_mc_pk'                           =>$GLRow->gl_ad_coa_mc_pk,
                                                             'gl_amount_transition.fn_account_type_id'  =>1,
                                                            'payment_date <'                            =>date('Y-m-d', strtotime($dateFrom)),
                                                        );
                                                        $open_balance       = $this->FinanceModel->open_balance($where);
                                                        
//                                                        echo '<pre>';print_r($open_balance);die;
                                                        $grandCredit_open   = 0;
                                                        $grandDebit_open    = 0;
                                                        $debit_total_open   = 0;
                                                        $credit_total_open  = 0;
                                                        foreach($open_balance as $obRow):


                                                                $query  =  $this->db->where(array('status'=>1,'fn_account_type_id'=>1))->get('financial_year')->row();

                                                               $grandDebit             = '';
                                                               $grandCredit            = '';
                                                               $parentId               = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));
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
                                                                              $dateDiff = date_diff(date_create(date('Y-m-d', strtotime($query->year_start))),date_create($obRow->payment_date));
               ////                                                            $dateDiff = date_diff(date_create($obRow->gl_ad_date), date_create(date('Y-m-d', strtotime($query->year_start))));
                                                                           $timeStart = $dateDiff->format("%R%a"); 
               //                                                          
                                                                           if($timeStart > 0):
               //                                                                echo $timeStart;
                                                                                       $debit_total_open       +=$obRow->gl_ad_depit ;
                                                                                       $credit_total_open      +=$obRow->gl_ad_credit; 

                                                                                       $grandCredit_open = $credit_total_open-$debit_total_open;
                                                                           $grandDebit_open     = '';
                                                                               else:

               //                                                               
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
               ////                                                            $dateDiff = date_diff(date_create($obRow->gl_ad_date), date_create(date('Y-m-d', strtotime($query->year_start))));
                                                                           $timeStart = $dateDiff->format("%R%a"); 
               //                                                          
                                                                           if($timeStart > 0):
                                                                               $debit_total_open       +=$obRow->gl_ad_depit ;
                                                                               $credit_total_open      +=$obRow->gl_ad_credit;

                                                                               $grandDebit_open = $debit_total_open- $credit_total_open;
                                                                               $grandCredit_open    = '';

                                                                               else:

                                                                           endif;




                                                                       endif;
                                                               endif;
                                                       endforeach;  
                                         ?>
                                                   <thead>
                                                    <tr>
                                                      <td style="border-top: 0px solid #000000 !important;" ><strong></strong></td>
                                                        
                                                         
                                                      <td colspan="4"  style="border-top: 0px solid #000000 !important; text-align: right;" ><strong>Open Balance</strong></td>
                                                      <td colspan="1"  style="border-top: 0px solid #000000 !important;" ></td>
                                                        <td style="border-top: 0px solid #000000 !important; text-align: right;" colspan="2"><strong>
                                                            
                                                            
                                                            
                                                            <?php    
                                                             
                                                            if(!empty($grandDebit_open)):
                                                            echo   number_format($grandDebit_open, 0, ',', ','); 
                                                            endif;
                                                            if(!empty($grandCredit_open)):
                                                            echo    number_format($grandCredit_open, 0, ',', ','); 
                                                            endif;
                                                            ?>
                                                                
                                                                
                                                                
                                                                
                                                                </strong></td>
                                                       
                                                    </tr>
                                             
                                                  <tr>
                                                        <th style="border-top: 0px solid #000000 !important; width: 5%;"><strong>Date</strong></th>
                                                        <th style="border-top: 0px solid #000000 !important; width: 3%;"><strong>Vr#</strong></th>
                                                        <th  style="border-top: 0px solid #000000 !important; width: 17%;"><strong>COA</strong></th>
                                                        <th  style="border-top: 0px solid #000000 !important; width: 27%;"><strong>Description</strong></th>
                                                        <th style="border-top: 0px solid #000000 !important;"><strong>Payee</strong></th>
                                                        <th style="border-top: 0px solid #000000 !important;"><strong>Cheque#</strong></th>
                                                        <th style="border-top: 0px solid #000000 !important;"><strong>Debit</strong></th>
                                                        <th style="border-top: 0px solid #000000 !important;"><strong>Credit</strong></td>
                                                       
                                                    </tr>
                                                 </thead>  
                                               
                                                      
                                                
                                                <?php
                                                
                                                $detail = $this->FinanceModel->get_amountDetails(
                                                        'gl_amount_transition',
                                                        array(
                                                            'gl_ad_coa_mc_pk'=>$GLRow->gl_ad_coa_mc_pk,
                                                             'gl_amount_transition.fn_account_type_id' =>1
                                                        ),$dateFrom,$toDate);

                                               $credit_total    = '';
                                               $debit_total     = '';
                                                foreach($detail as $dRow):
                                                    $date=date_create($dRow->payment_date);
                                                 
                                               
                                                ?>
                                                  <tr>
                                                      <td><?php echo date_format($date,"d/m/Y"); ?></td>
                                                        <td><?php echo $dRow->gl_at_vocher?></td>
                                                        <td><?php
                                                        
                                                        
                                                        if($dRow->gl_ad_depit):
                                                            
                                                            $vocDet = array(
                                                            'gl_ad_atId'=>$dRow->gl_at_id,
                                                            'gl_ad_depit '=>'');
                                                                     $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');   
                                                        $VocDetail = $this->db->get_where('gl_amount_details',$vocDet)->result();
                                                        
                                                        foreach($VocDetail as $VCName):
                                                            
                                                                if($VCName == $dRow->gl_ad_coa_mc_id):
                                                                    else:
                                                                       $var = $VCName->fn_coa_mc_title.',';
                                                                        echo wordwrap($var,30,"<br>\n");
                                                                endif;
                                                               
                                                        endforeach;
                                                            else:
                                                                
                                                             $vocDet = array(
                                                            'gl_ad_atId'=>$dRow->gl_at_id,
                                                            'gl_ad_credit '=>'');
                                                            
                                                                        $this->db->join('fn_coa_master_sub_child','fn_coa_master_sub_child.fn_coa_mc_id=gl_amount_details.gl_ad_coa_mc_pk');   
                                                        $VocDetail =    $this->db->get_where('gl_amount_details',$vocDet)->result();
                                                       
                                                        
                                                        foreach($VocDetail as $VCName):
                                                            
                                                                if($VCName == $dRow->gl_ad_coa_mc_id):
                                                                    else:
                                                                    
                                                                    $var = $VCName->fn_coa_mc_title.',';
                                                                    
                                                                echo wordwrap($var,30,"<br>\n");
                                                                endif;
                                                               
                                                        endforeach;
                                                          endif; ?></td>
                                                        <td><?php 
                                                        
//                                                        echo wordwrap($dRow->gl_at_description,80,"<br>\n")
                                                        echo $dRow->gl_at_description
                                                        
                                                        ?></td>
                                                        <td><?php echo $dRow->gl_at_payeeId?></td>
                                                        <td><?php echo $dRow->gl_at_cheque?></td>
                                                        <td><?php echo  number_format($dRow->gl_ad_depit, 0, ',', ',')?></td>
                                                        <td><?php echo  number_format($dRow->gl_ad_credit, 0, ',', ',')?></td>
                                                      
                                                     
                                                        <?php   $debit_total +=$dRow->gl_ad_depit?>
                                                        <?php   $credit_total +=$dRow->gl_ad_credit?>
                                                       
                                                    </tr>
           
                                                     <?php
                                        
                                            endforeach;
                                       
                                        ?>
                                                    <tr>
                                                      
                                                        <td colspan="5"  style="border: 1px solid #ffff;"></td>
                                                        <td colspan="1"  style="border-top: 2px solid #000000;border-bottom:  2px solid #000000;">Total</td>
                                                        <td style="border-top: 2px solid #000000;border-bottom:  2px solid #000000;"><?php 
                                                        if(!empty($debit_total)):
                                                             echo number_format($debit_total, 0, ',', ',');
                                                        else:
                                                      echo 0;
                                                        endif;
                                                           ?></td>
                                                        <td style="border-top: 2px solid #000000;border-bottom:  2px solid #000000;"><?php 
                                                          if(!empty($credit_total)):
                                                            echo  number_format($credit_total, 0, ',', ',');
                                                             else:
                                                      echo 0;
                                                        endif
                                                        
                                                        ?></td>
                                                   
                                                    
                                                    </tr>
                                                    <tr>
                                                       
                                                        <td colspan="5"  style="border: 1px solid #fff;"></td>
                                                        <td style="border-top: 2px solid #000000;border-bottom:  2px solid #000000;">Grand Total</td>
                                                        <?php 
                                                        $grandDebit     = '';
                                                        $grandCredit    = '';
                                                        $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));
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
                                                        
                                                       
                                                        
                                                        
                                                        
                                                          ?>
                                                         <td style="border-top: 2px solid #000000;border-bottom:  2px solid #000000;"><?php 
                                                        
                                                         if(!empty($grandDebit)):
                                                               echo number_format($grandDebit, 0, ',', ',');
                                                               endif; 
                                                         
                                                        
                                                        ?></td>
                                                           <td style="border-top: 2px solid #000000;border-bottom:  2px solid #000000;"><?php 
                                                          if(!empty( $grandCredit)):
                                                               echo number_format( $grandCredit, 0, ',', ',');
                                                               endif; 
                                                          ?></td>
                                                     
                                                    
                                                    </tr>
                                                    <tr>
                                                       
                                                         
                                                        <td colspan="5" style="text-align: right; border-bottom: 2px dotted #000000"><strong>Closing Balance</strong></td>
                                                        <td colspan="2" style="text-align: right; border-bottom: 2px dotted #000000"></td>
                                                        <?php 
                                                        $grandDebit     = '';
                                                        $grandCredit    = '';
                                                        $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId,'fn_account_type_id'=>1));
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
                                                         
                                                        
                                                        
                                                          ?>
                                                        <td style="text-align:right; border-bottom: 2px dotted #000000"><strong><?php 
                                                        
                                                         
                                                         $grand_open_Dept = $grandDebit+$grandDebit_open;
                                                           if(!empty($grand_open_Dept)):
                                                               echo number_format($grandDebit+$grandDebit_open, 0, ',', ',');
                                                               endif; 
                                                            $grand_open_Credit = $grandCredit+$grandCredit_open;
                                                           if(!empty($grand_open_Credit)):
                                                              echo  number_format($grandCredit+$grandCredit_open, 0, ',', ',');
                                                               endif; 
                                                           
                                                        ?></strong></td>
                                                     
                                                    
                                                    </tr>
                                            </table><!--//table-->
                                            
                                           
                                        </div><!--//table-responsive-->
                                        
                                        
                                            <?php
                                        
                                            endforeach;
                                        endif;
                                        ?>
                                     
                                    </div>
                                     
                                </div>
                    <?php echo $print_log;?>
                </div>
              
             Query time: {elapsed_time}
          </div>
          
      
      </div>
                 </div>
 
      </div>
  
    </div>
 
 
    
    
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
                                 
                                if($COAP):
                                    foreach($COAP as $coapRow):
                                    
                                        echo '<tr class="first">
                                             <td>&nbsp;</td>
                                                <td>'.$coapRow->fn_coa_code.'</td>
                                                <td>'.$coapRow->fn_coa_title.'</td>

                                            </tr>';
                                                $coac = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_status'=>1,'fn_coa_m_pId'=>$coapRow->fn_coaId));
                                                foreach($coac as $coacRow):
                                                    $k = array_rand($class);
                                                     echo '<tr class="2nd">
                                                          <td>&nbsp;</td>
                                                            <td> '.$coacRow->fn_coa_m_code.'</td>

                                                            <td> &nbsp;&nbsp; &nbsp; &nbsp;'.$coacRow->fn_coa_m_title.'</td>


                                                        </tr>';
                                                $coacs = $this->CRUDModel->get_where_result('fn_coa_master_sub_child',array('fn_coa_mc_status'=>1,'fn_coa_mc_mId'=>$coacRow->fn_coa_m_cId));

                                                        foreach($coacs as $coacsRow):
                                                            
                                                             echo ' <tr class="recordFrom3rd '.$class[$k].'" id="'.$coacsRow->fn_coa_mc_title.','.$coacsRow->fn_coa_mc_id.','.$coacsRow->fn_coa_mc_code.'">
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
             



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
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
//                                 $COAP =$this->CRUDModel->get_where_result('fn_coa_parent',array('fn_coa_status'=>1));
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
                                                         $k = array_rand($class);
                                                        foreach($coacs as $coacsRow):
                                                            
                                                             echo ' <tr class="recordTo3rd '.$class[$k].'" id="'.$coacsRow->fn_coa_mc_title.','.$coacsRow->fn_coa_mc_id.','.$coacsRow->fn_coa_mc_code.'">
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
         



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
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