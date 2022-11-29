
<script language="javascript">
  function printdiv(printpage)
  {
    var headstr = "<html><head><title></title></head><div><p style='padding-left: 70%;'><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p><p style='text-align: center;'>EDWARDES COLLEGE PESHAWAR <br/> BANK RECONCILIATION STATEMENT</p></div><body>";
//    var headstr = "<html><head><title></title></head><body><p ><img  style='text-align: right;' class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
    var footstr = "</body>";
    var newstr = document.all.item(printpage).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = headstr+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;
    location.reload();
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
                            <span class="line"><?php echo $page_header?> Search</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('FinanceController/brs_report_update',array('class'=>'course-finder-form'));
                                      
                                     ?>
                                <div class="row">
                                      
                                      
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">To</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'dateto',
                                                'id'            => 'dateto',
                                                'type'          => 'text ',
                                                'readonly'      => 'readonly',
                                                'value'         => date('d-m-Y',strtotime($report_info->date_to)),
                                                'class'         => 'form-control datepicker',
                                                'placeholder'   => 'Date to',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                    
                                    <input type="hidden" name="formCode" id="formCode" value="<?php echo $formCode?>">
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">Record Form</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo    form_input(
                                                             array(
                                                                'name'          => 'recordFrom',
                                                                'id'            => 'recordFrom',
                                                                'value'         => $report_info->fn_coa_mc_title,
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
                                                                  'value'         => $report_info->COA_id,
                                                                  'type'          => 'hidden',
                                                                  'class'         => 'form-control',
                                                                  'placeholder'   => 'Account',
                                                                  )
                                                          );
                                                    echo form_input(
                                                          array(
                                                                  'name'          => 'tran_id',
                                                                  'id'            => 'tran_id',
                                                                  'value'         => $report_info->id,
                                                                  'type'          => 'hidden',
                                                                  'class'         => 'form-control',
                                                                  
                                                                  )
                                                          );
                                                  ?>
                                                 
                                                <div class="input-group-btn">
                                                    <div class="btn-group" role="group">
                                                        <div class="dropdown dropdown-lg">
                                                           
                                                            <!--<button type="button" class="btn btn-default dropdown-toggle" data-toggle="modal" data-target="#RecordFromTog" aria-expanded="false"><span class="caret"></span></button>-->
                                                            
                                                        </div>

                                                    </div>
                                                </div>
                                                  
                                          
                                            </div>
                                       
                                            
                                     </div>
                                    
                                     <div class="col-md-3 col-sm-5">
                                         <div style="padding-top:9.5%;">
                                             <!--<button type="button" class="btn btn-theme" name="search_brs" id="search_brs"  value="search_brs" ><i class="fa fa-search"></i> Search COA</button>-->
                                         </div>
                                         
                                       
                                        
                                     </div>
                                      
                                </div>
                            <div id="unpresented_checks">
                            <hr/>
                                <div class="row">
                                      
                                      
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">Voucher#</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'voch_no',
                                                'id'            => 'voch_no',
                                                'type'          => 'text',
                                                
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Voucher#',    
                                                ));
                                        ?>
                                      </div>
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">Date</label>
                                          <?php

                                            echo form_input(array(
                                                'name'          => 'date',
                                                'id'            => 'unrep_date',
                                                'type'          => 'text ',
                                                 
                                                'class'         => 'form-control datepicker',
                                                'placeholder'   => 'Date',    
                                                ));
                                        ?>
                                        
                                     </div>
                                    <div class="col-md-3 col-sm-5">
                                          <label for="name">Chq#</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'chq_no',
                                                'id'            => 'chq_no',
                                                'type'          => 'text ',
                                                
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Cheque #',    
                                                ));
                                        ?>
                                      </div>
                                    <div class="col-md-3 col-sm-5">
                                          <label for="name">Amount</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'unpres_amount',
                                                'id'            => 'unpres_amount',
                                                'type'          => 'number',
                                                
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Amount',    
                                                ));
                                        ?>
                                      </div>
                                    
                                    
                                      
                                    
                                      
                                      
                                </div>
                                <div class="row">
                                      
                                      
                                     <div class="col-md-6 col-sm-5 ">
                                          <label for="name">Payee #</label>
                                          <textarea class="form-control" rows="2" name="payee_name" id="payee_name" ></textarea>
                                            
                                       
                                     </div>
                                      
                                     <div class="col-md-6 col-sm-5 ">
                                          <label for="name">Description #</label>
                                          <textarea class="form-control" rows="2"  name="description" id="un_rep_desc" ></textarea>
                                            
                                       
                                     </div>
                                  </div>
                            <div style="padding-top:1%;">
                                <div class="col-md-6 pull-right">
                                    <button type="button" class="btn btn-theme" name="up_checks" id="up_checks"  value="up_checks" ><i class="fa fa-plus"></i> Add Vouchers</button>
                                  </div>
                            </div>
                            <hr/>
                            
                            <div class="row">
                                      
                                      
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">Type</label>
                                          <?php 
                                        echo form_dropdown('tran_type', $tran_type, '',  'class="form-control" id="tran_type"');
                                        ?>
                                      </div>
                                     <div class="col-md-6 col-sm-5">
                                          <label for="name">Descriptions</label>
                                          <?php

                                            echo form_input(array(
                                                'name'          => 'add_unpr_amount_desc',
                                                'id'            => 'add_unpr_amount_desc',
                                                'type'          => 'text ',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Descriptions',    
                                                ));
                                        ?>
                                        
                                     </div>
                                    
                                    <div class="col-md-3 col-sm-5">
                                          <label for="name">Amount</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'add_unpres_amount',
                                                'id'            => 'add_unpres_amount',
                                                'type'          => 'number',
                                                
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Amount',    
                                                ));
                                        ?>
                                      </div>
                                 </div>
                            
                            
                                
                            </div>
                            <div style="padding-top:1%;">
                                <div class="col-md-6 pull-right">
                                    
                                    <!--<button type="button" class="btn btn-theme" name="search_brs" id="search_brs"  value="search_brs" ><i class="fa fa-search"></i> Search COA</button>-->
                                    <button type="button" class="btn btn-theme" name="add_unpresent_amount" id="add_unpresent_amount"  value="add_unpresent_amount" ><i class="fa fa-plus"></i> Update Amount</button>
                                    <button type="submit" class="btn btn-theme" name="update_checks" id="update_checks"  value="update_checks" ><i class="fa fa-book"></i> Save</button>
                                    <button type="button" name="print" value="print" id="unpresent_print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>
                               </div>
                            </div>
                            
                            
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
              
              <div id="div_print">
                    <div id="result_show_brs" style="margin-left:80px">
                    </div> 
 </div>
              
<!--             Query time: {elapsed_time}-->
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
          <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
</div>  
 
 
        
        
     <script>
         
    var formCode = jQuery('#formCode').val();
    jQuery('#search_brs').show();
     jQuery.ajax({
                type    : 'post',
                url     : 'FinanceController/show_result_bank_reconciliation_statument',
                data    : {'formCode':formCode},
                success  : function(result){
                   
                    jQuery('#unpresented_checks').show('slow');
                    jQuery('#up_checks').show();
                    jQuery('#result_show_brs').show();
                    jQuery('#add_unpresent_amount').show();
                    
                    jQuery('#result_show_brs').html(result); 
                }
                
            });    
         
         
         
  $( function() {
    $( ".datepicker" ).datepicker({
         changeMonth: true,
    changeYear: true,
    dateFormat: 'dd-mm-yy'
    });
  } );
  
  
  
  </script>        
  

 