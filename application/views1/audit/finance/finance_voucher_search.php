 
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
                                                    'name'          => 'from_date',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'From Date',
                                                     'value'        => $from_date
                                                     
                                                    ));
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-2 col-sm-5">
                                         <label for="name">To</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'to_date',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'To Date',
                                                     'value'        => $to_date
                                                     
                                                    ));
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Process Number</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'voucher_id',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Enter Process Number',
                                                     'value'        => $voucehr_no
                                                     
                                                    ));
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Voucher Type</label>
                                         <?php

                                                echo form_dropdown('voucher_status',$voucher_status,$statusid,  'class="form-control"');
                                            ?>
                                     
                                     </div>
                                
                                     
                                      
                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-2 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="search" id="search"  value="Search" ><i class="fa fa-search"></i> Search</button>
                                      
                                    
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
              
                                        <h3 class="has-divider text-highlight">Result :<?php echo count($result)?></h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table" style="font-size:11px">
                                                    <thead>
                                                      <tr>

                                                          
                                                         
                                                            <th>Process Date</th>
                                                            <th>Process No</th>
                                                            <th>Voucher</th>
                                                            <th>Payee</th> 
                                                            <th>Description</th> 
                                                            <th>Payment Date</th>
                                                            <th>Amount</th>
                                                            <th>Detail</th>
                                                             
                                                            <th>Print</th>
                                                            <th>Status</th>
                                                                                                                       

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                          foreach($result as $row):
                                                              
                                                              $k = array_rand($class);
                                                           $sn++;
                                                            echo '<tr class="'.$class[$k].'">
                                                                 
                                                                
                                                                <th>'.date('d-m-Y', strtotime($row->gl_at_date)).'</th>
                                                                <th>'.$row->gl_at_id.'</th>
                                                                <th>'.$row->gl_at_vocher.'</th>
                                                                <th>'.substr($row->gl_at_payeeId, 0, 30).'</th>
                                                                <th>'.substr($row->gl_at_description, 0, 50).'</th>
                                                                
                                                                <th>';
                                                                if($row->vocher_status == 2):
                                                                    if($row->payment_date == '0000-00-00' || $row->payment_date =='1970-01-01'):
                                                                        
                                                                        else:
                                                                        echo date('d-m-Y', strtotime($row->payment_date));
                                                                    endif;
                                                                     
                                                                endif;
                                                            echo '</th>
                                                                <th>'.number_format($row->print_cheque_value, 0, ',', ',').'</th>
                                                               
                                                              
                                                                  <td><a href="javascript:valid(0)" id="'.$row->gl_at_id.'" class="amount_tran_details"><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal"> Details</button></a></td>';
                                                                        ?>
                                                                      
                                                                    <td>  
                                                                        <a href="VoucherPrint/<?php echo $row->gl_at_id;?>" target="_new"  class="productstatus"><button type="button" class="btn btn-theme btn-xs"> Print</button></a>
                                                                  </td> 
                                                                <td>  
                                                                         <button type="button" class="btn btn-theme btn-xs"><?php echo $row->status_title?></button> 
                                                                </td> 
                                                                    
                                                                  
                                                                   
                                                                 
                                                                   
                                                                <?php
                                                                    
                                                            echo '</tr>';
                                                         
                                                          endforeach;      
                                               

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