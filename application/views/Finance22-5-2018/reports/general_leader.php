
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
            <h1 class="heading-title pull-left">General Ledger</h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current">General Ledger</li>
                    </ul>
                </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
        
        
        
        
        
      <div class="row">
          <div class="col-md-12">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Amount Transition</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                                      if(@$GeneralLeader):
                                            $dateFrom           = $dateFrom;  
                                            $dateTo             = $toDate;
                                             $recordTo          = $recordTo;
                                            $recordFrom         = $recordFrom;
                                            
//                                            $recordFromCode   = $recordFromCode;
//                                            $recordToCode     = $recordToCode;

                                            else:
                                            $dateFrom           = date('d-m-Y');
                                            $dateTo             = date('d-m-Y');
                                            $SubmName           = 'AddCOA';   
                                            $recordFrom         = '';
                                            $recordFromCode     = '';
                                             
                                            $recordTo           = '';
                                            $recordToCode       = '';
                                            $btn                = 'Add';
                                            $status             = '';
                                            $icon               = 'plus';

                                        endif;
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
                                                'value'         => $dateTo,
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
                                    <div class="col-md-12" style="margin-left:40px">
                                        <?php
                                        
                                
                                        if(!empty($GeneralLeader)):

                                            foreach($GeneralLeader as $GLRow):
                                          ?>
                                        <header>
                                            
                                            
                                            <h5 class="heading-title" style="font-size: 14px;"> 
                                                <?php echo $GLRow->Sub_Child_Title?> (<?php echo $GLRow->Sub_Csshild_Code?>) :
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; From&nbsp;: <?=date('d-m-Y', strtotime($GLRow->From_date))?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To : <?=date('d-m-Y', strtotime($GLRow->To_date))?>
                                            </h5>

                                        </header>
                                         <div class="table-responsive">                      
                                            
                                            <table class="table table-hover" style="font-size:10px">
                                                 <tr>
                                                      <td style="border-top: 0px solid #000000 !important;" ><strong></strong></td>
                                                        
                                                        <td style="border-top: 0px solid #000000 !important;"><strong></strong></td>
                                                        <td style="border-top: 0px solid #000000 !important;"><strong></strong></td>
                                                        <td style="border-top: 0px solid #000000 !important;"><strong></strong></td>
                                                        <td style="border-top: 0px solid #000000 !important;"><strong></strong></td>
                                                        <td style="border-top: 0px solid #000000 !important;" ><strong>Open Balance</strong></td>
                                                        <td style="border-top: 0px solid #000000 !important; text-align: right;" colspan="1">
                                                            <strong>
                                                        <?php 
                                                        
                                                        if(!empty($GLRow->Opening_Balance)):
                                                            echo number_format($GLRow->Opening_Balance, 0, ',', ','); 
                                                        endif;
                                                        
                                                        ?>
                                                           </strong>
                                                        </td>
                                                       
                                                    </tr>
                                                    <thead>
                                                  <tr>
                                                        <th style="border-top: 0px solid #000000 !important;"><strong>Date</strong></th>
                                                        <th style="border-top: 0px solid #000000 !important;"><strong>Vr#</strong></th>
                                                        <th style="border-top: 0px solid #000000 !important;"><strong>COA</strong></th>
                                                        <th style="border-top: 0px solid #000000 !important;"><strong>Description</strong></th>
                                                        <th style="border-top: 0px solid #000000 !important;"><strong>Payee</strong></th>
                                                        <th style="border-top: 0px solid #000000 !important;"><strong>Cheque#</strong></th>
                                                        <th style="border-top: 0px solid #000000 !important;"><strong>Debit</strong></th>
                                                        <th style="border-top: 0px solid #000000 !important;"><strong>Credit</strong></th>
                                                       
                                                    </tr>
                                                    </thead>
                                                  <?php foreach($GLRow->Details as $dRow):?>
                                                  <tr>
                                                      <td><?php echo date('d/m/Y',  strtotime($dRow->Payment_date)); ?></td>
                                                        <td><?php echo $dRow->Vocher_no?></td>
                                                        <td><?php echo wordwrap($dRow->COA,25,"<br>\n")?></td>
                                                        <td><?php echo wordwrap($dRow->Description,60,"<br>\n")?></td>
                                                        <td><?php echo wordwrap( $dRow->Payee,30,"<br>\n")?></td>
                                                        <td><?php echo $dRow->Cheque?></td>
                                                        <td><?php echo  number_format($dRow->Debit, 0, ',', ',')?></td>
                                                        <td><?php echo  number_format($dRow->Credit, 0, ',', ',')?></td>
                                                    </tr>
                                                <?php  endforeach;?>
                                                    <tr>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                         
                                                        <td><?php echo number_format($GLRow->tDebit, 0, ',', ',');?></td>
                                                        <td><?php echo  number_format($GLRow->tCredit, 0, ',', ',');?></td>
                                                   
                                                    
                                                    </tr>
                                                    <tr>
                                                       
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td>Grand Total</td>
                                                         <td><?php 
                                                         
                                                         if(!empty($GLRow->gDebit)):
                                                            echo number_format($GLRow->gDebit, 0, ',', ',');
                                                         
                                                             
                                                         endif;
                                                         ?></td>
                                                        <td><?php
                                                         if(!empty($GLRow->gCredit)):
                                                            echo number_format($GLRow->gCredit, 0, ',', ','); 
                                                         endif;
                                                        ?></td>
                                                   
                                                     
                                                    
                                                    </tr>
                                                    <tr>
                                                       
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td>Closing Balance</td>
                                                        <td> <?php echo number_format($GLRow->Closing_balance, 0, ',', ','); ?></td>
                                                       
                                                     <td> </td>
                                                    
                                                    </tr>
                                            </table><!--//table-->
                                            
                                           
                                        </div><!--//table-responsive-->
                                        
                                        
                                            <?php
                                        
                                            endforeach;
                                        endif;
                                        ?>
                                     
                                    </div>
                                     
                                </div>
 </div>
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
                                                            
                                                             echo ' <tr class="recordFrom3rd " id="'.$coacsRow->fn_coa_mc_title.','.$coacsRow->fn_coa_mc_id.','.$coacsRow->fn_coa_mc_code.'">
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
                                                            
                                                             echo ' <tr class="recordTo3rd " id="'.$coacsRow->fn_coa_mc_title.','.$coacsRow->fn_coa_mc_id.','.$coacsRow->fn_coa_mc_code.'">
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
          <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
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