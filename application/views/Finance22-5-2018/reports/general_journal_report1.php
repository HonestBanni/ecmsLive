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

<style>

.report_header{
    display: none !important;
}
 
</style>
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
                                     <div class="col-md-2 col-sm-5">
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
<!--                                    <div class="col-md-2 col-sm-5">
                                          <label for="name">Account</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                        echo  form_input(
                                                             array(
                                                                'name'          => 'recordFrom',
                                                                'id'            => 'recordFrom',
                                                                'value'         => $recordFrom,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Account',
                                                                 )
                                                             );
                                                      ?>
                                                
                                                 <?php
                                                    echo   form_input(
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
                                     <div class="col-md-2 col-sm-5">
                                          <label for="name">Payee Id</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'payeeId',
                                                'id'            => 'payeeId',
                                                'type'          => 'text ',
                                                'value'          => $payeeId,
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Payee ',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                     <div class="col-md-2 col-sm-5">
                                          <label for="name">Supplier</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'Supplier',
//                                                'id'            => 'Supplier',
                                                'type'          => 'text ',
                                                  'disabled'          => 'disabled',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Supplier Name ',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                     <div class="col-md-2 col-sm-5">
                                          <label for="name">Amount</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'amount',
                                                'value'         => $amount,
                                                'type'          => 'text ',
                                               
                                                 
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Amount',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>-->
                                     
                                      
                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-5 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="date_wise" id="date_wise"  value="date_wise" ><i class="fa fa-search"></i> Date Wise</button>
                                    <button type="submit" class="btn btn-theme" name="date_vocher" id="date_vocher"  value="date_vocher" ><i class="fa fa-search"></i> Vocher Wise</button>
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
                                    <a href="generalJournal"><button type="button" class="btn btn-theme"  id="save"> Reset</button></a>
                                    
                                        
                                    
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
                        
                            <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                        $class = array(
                                                'info',
                                                'success',
                                                'danger',
                                                'warning',
                                                'active',
                                            );
                                
                                      if(!empty($result)):
                                          
                                    
                                        ?>
                                     <div id="div_print">
                                         <div class="report_header">
                                            <img style="float: right; padding-right: 79px;" class="img-responsive" src="assets/images/logo-black.png" alt="Edwardes College Peshawar">
                                            <h3 class="text-highlight" style=" text-align: center">General Journal Report</h3>

                                          </div>
                                       
                                         <h5 style=" text-align: center">From : <?php echo $dateFrom?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To: <?php echo $dateTo?></h5>
                                         
                                        <h3 class="has-divider text-highlight">Result :<?php echo count($result)?></h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table">
                                                    <thead>
                                                      <tr>

                                                          <th colspan="2">Date</th>
                                                          <th>Vocher </th>
                                                          <th>JV/CB</th>
                                                          <th>Payee</th>
                                                          <th>Ch#</th>
                                                          <th>COA</th>
                                                          <th>Debit</th>
                                                          <th>Credit</th>
                                                           
                                                      

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                        $GTotalDebit = '';
                                                        $GTotalCredit = '';
                                                          foreach($result as $row):
//                                                              echo '<pre>';print_r($result);die;
                                                              $k = array_rand($class);
//                                                           $sn++;
                                                            echo '<tr class="'.$class[$k].'">
                                                                <td colspan="2">'.date('d-m-Y', strtotime($row->gl_at_date)).'</td>
                                                                <td>'.$row->gl_at_vocher.'</td>
                                                                <td>'.$row->ftt_title.'</td>
                                                                <td>'.$row->gl_at_payeeId.'</td>
                                                                <td>'.$row->gl_at_cheque.'</td>
                                                                
                                                                <td> </td>
                                                                <td> </td>
                                                                <td> </td>
                                                                
                                                              
                                                                
                                                                 </tr>';
                                                            
                                                             $where     = array('gl_ad_atId'=>$row->gl_at_id);
                                                            $details    = $this->CRUDModel->get_where_result('gl_amount_details',$where);
                                                            $sn = '';
                                                                $TotalDebit = '';
                                                                $TotalCredit = '';
                                                                foreach($details as $dRow):
                                                                    echo '  <tr class="'.$class[$k].'">
                                                                         
                                                                        <td colspan="2"> </td>
                                                                        <td> </td>
                                                                        <td> </td>
                                                                        <td> </td>
                                                                        <td> </td>
                                                                        <td>'.$dRow->gl_ad_coa_mc_name.'</td>
                                                                        <td>'.number_format($dRow->gl_ad_depit, 0, ',', ',').'</td>
                                                                        <td>'.number_format($dRow->gl_ad_credit, 0, ',', ',').'</td>
                                                                    </tr>';
                                                                 $TotalDebit  +=  $dRow->gl_ad_depit;  
                                                                 $TotalCredit +=  $dRow->gl_ad_credit;  
                                                                endforeach;
                                                          $x = array_rand($class);
                                                                echo '  <tr class="'.$class[$x].'">
                                                                         
                                                                        <td colspan="2"> </td>
                                                                        <td> </td>
                                                                        <td> </td>
                                                                        <td> </td>
                                                                        <td> </td>
                                                                        <td>Total</td>
                                                                        <td>'.number_format($TotalDebit, 0, ',', ',').'</td>
                                                                        <td>'.number_format($TotalCredit, 0, ',', ',').'</td>
                                                                    </tr>';
                                                                
                                                                echo '  <tr class="'.$class[$x].'">
                                                                        <td  colspan="9">( Description :
                                                                         '.$row->gl_at_description.' )</td>
                                                                       </tr>';
                                                                echo '  <tr >
                                                                         
                                                                        <td colspan="9">&nbsp;</td>
                                                                       </tr>';
                                                        $GTotalDebit += $TotalDebit;
                                                        $GTotalCredit += $TotalCredit;
                                                          endforeach;      
                                                
                                                           echo '  <tr class="'.$class[$x].'">
                                                                         
                                                                        <td colspan="2"> </td>
                                                                        <td> </td>
                                                                        <td> </td>
                                                                        <td> </td>
                                                                        <td> </td>
                                                                        <td>Grand Total</td>
                                                                        <td>'.number_format($GTotalDebit, 0, ',', ',').'</td>
                                                                        <td>'.number_format($GTotalCredit, 0, ',', ',').'</td>
                                                                    </tr>';
                                                        ?>

                                                    </tbody>
                                            </table>
                                        </div>
                                          <?php
                                      endif;
                                    ?> 
                                    </div>
                                    </div>
                                  
                                </div>
 
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
   
     
     <script>
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 3,
        dateFormat: 'd-m-yy'
    });
  } );
  </script>        
  
  
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Account Details</h4>
      </div>
      <div class="modal-body">
          <div id="transitionDetails">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>