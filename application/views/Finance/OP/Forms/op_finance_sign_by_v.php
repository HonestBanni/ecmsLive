
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?=$page_heading?>
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
          <li class="current"><?=$page_heading?>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">                            
         <table align="center">
                <tr style="height: 45px">
                    <td>
                        
                        <?php
//                        error_reporting(0);
                        
                        if(!empty($voucher_info->vocher_rq)):
                            ?>
                                <img  class="img-responsive" src="assets/RQ/vocher_rq/<?php echo $voucher_info->vocher_rq; ?>" alt="<?php echo $voucher_info->gl_at_id?>" width="80px;"> </td><td width='10px'>
                                <?php
                            else:
                            
                        endif;
                        ?>
                        
                        </td>
                    
                        <td><h3 align="center">EDWARDES COLLEGE PESHAWAR<br/><?php echo $voucher_info->voch_name?><br/><strong><?php echo $voucher_info->title?></strong></h3></td>
                    
                 <td ><img  class="img-responsive" src="assets/images/logoPrint.png" alt="Edwardes College Peshawar" width="100px;"></td>
                        
                  </tr>
            </table>  
            
            
        <table class="table table-boxed table-hover" align="right">
           <tbody>
                <tr >
                    <td width="100px">Process Date</td>
                    <td width="100px" style="text-decoration: underline;font-weight: bold;"><?php echo date('d-m-Y', strtotime($voucher_info->gl_at_date));?></td>
                    <td width="100px">Process No</td>
                    <td width="100px" style="text-decoration: underline;font-weight: bold;"><?php echo $voucher_info->gl_at_id;?></td>
                    <td width="100px">Voucher No</td>    
                    <td width="100px"><?php echo $voucher_info->gl_at_vocher;?></td>    
                    <td width="100px">Payment Date </td>    
                    <td width="100px"><?php 
                    
                    if($voucher_info->vocher_status == 2):
                      echo date('d-m-Y', strtotime($voucher_info->payment_date));
                    endif;
                    
                      
                    
                    ?></td>    
                  </tr>
                <tr>
                    <td width="10px" colspan="4" style="height: 60px">
                        
                        <?php
                        
                        if($voucher_info->vocher_type == 4 || $voucher_info->vocher_type == 3 ):
                            echo 'Received :';
                            else:
                            echo 'Payee :';
                        endif;
                        ?>
                        
                        
                         <strong><?php echo $voucher_info->gl_at_payeeId;?></strong></td>
                    <td width="10px" colspan="4" style="height: 60px">
                        <?php 
                    
                    
                        
                      if(!empty($voucher_info->supplier_id)):
                        
                       $supplier_name =    $this->CRUDModel->get_where_row("fn_supplier",array('fn_supp_id'=>$voucher_info->supplier_id));
                      echo 'Company : <strong>'.$supplier_name->company_name.'<br/>'.$supplier_name->address.'</strong>';
                      endif;
                    
                    
                    ?>
                   </td> 
                  
                  </tr>
                <tr>
                    
                    <td width="10px" colspan="8" style="height: 60px">
                        
                         <?php
                        
                        if($voucher_info->vocher_type == 4 || $voucher_info->vocher_type == 3 ):
                            echo 'Brief Description :';
                            else:
                            echo 'Brief Description of the payment :';
                        endif;
                        ?>
                        
                         <strong><?php echo $voucher_info->gl_at_description;?></strong></td>
                   
                  
                  </tr>
           <td colspan="2">Attachments :</td>
                    <td colspan="6">
                        
                        <?php 
                        
                        
                        $all_attac = $this->db->where('status',1)->get('fn_attachments')->result();
                        if($all_attac):
                            
                          $all_attac2 =  array_chunk($all_attac, 3);
//                            echo '<pre>';print_r($all_attac2);die;
                            foreach($all_attac2 as $allRow2):
                                 
                                foreach($allRow2 as $allRow):
                                        $key_where = array(
                                        'attach_id'=>$allRow->id,
                                        'amount_tra_id'=>$this->uri->segment(2),
                                    );
                            
                                $key = $this->CRUDModel->get_where_row('fn_voucher_attachment',$key_where);
                            if($key):
                               echo '<i class="fa fa-check-square-o" aria-hidden="true"  style="font-size: 18px;"></i> '.$allRow->attach_name.'&nbsp;&nbsp;&nbsp;';
                                else:
                                 echo '<i class="fa fa-square-o " aria-hidden="true"  style="font-size: 18px;"></i> '.$allRow->attach_name.'&nbsp;&nbsp;&nbsp;';
                            endif;
                                endforeach;
                                
                                echo '<br/>';
                            
                            
                        endforeach;
                        endif;
           ?>
            </td>
                  
                  </tr>
                   <tr>
                       
                       <td colspan="4" style="height: 60px; padding-top: 22px;"  >Prepared &   <?php
                        
                        if($voucher_info->vocher_type == 4 || $voucher_info->vocher_type == 3 ):
                            echo 'Received';
                            else:
                            echo 'Paid';
                        endif;
                        ?> by (Cashier) :
                        <?php
                    
                        $cashier = $this->db->where('status',1)->get('fn_cashier')->row();
                     
                        echo $cashier->name;
                 
                    
                    ?>
                       </td>
                   
                    <td style=" padding-top: 22px;">Signed</td>    
                    <td style=" padding-top: 22px;"></td>    
                    <td style=" padding-top: 22px;">Date</td>    
                    <td style=" padding-top: 22px;"></td>    
                          
          </tbody>
            </table>
          <table class="table table-boxed table-hover">
           <tbody>
                 
                   <tr style=" font-size:12px; font-weight: 600; border-bottom: 1px solid #000000;">
                       <th width="200px">Account Code</th>
                    <th>Chart of Account</th>
                    <th>Debit</th>
                    <th>Credit</th>
                       <?php 
                        $creditGrant = 0;
                          $depitGrant = 0;
                       if($chart_of_acct):
                           
                          
                        
                         
                           foreach($chart_of_acct as $chrRow):
                                  $depit = 0;
                                  $credit = 0;
                               if($chrRow->gl_ad_depit>0):
                                   $depit = number_format($chrRow->gl_ad_depit, 0, ',', ',');
                               endif;
                               if($chrRow->gl_ad_credit>0):
                                   $credit = number_format($chrRow->gl_ad_credit, 0, ',', ',');
                               endif;
                           echo '
                               <tr style=" font-size:12px; font-weight: 400; border-top: 0px solid #000000;">
                                <td style="border-top: 0px solid #000000;">'.$chrRow->fn_coa_mc_code.'</td>
                                    <td style="border-top: 0px solid #000000;">'.$chrRow->fn_coa_mc_title.'</td>
                                    <td style="border-top: 0px solid #000000;">'.$depit.'</td>
                                    <td style="border-top: 0px solid #000000;">'.$credit.'</td>
                                </tr> ';
                           $creditGrant +=$chrRow->gl_ad_credit;
                           $depitGrant  +=$chrRow->gl_ad_depit;
                           endforeach;
                       endif;
                        $word_crdit = '';
                        if($creditGrant> 0):
                            $creditGrant = number_format($creditGrant, 0, ',', ',');
                        endif;
                        if($depitGrant>0):
                            $word_crdit = $depitGrant;
                            $depitGrant = number_format($depitGrant, 0, ',', ',');
                        endif;
                       
                      
                       
                       echo ' </tr>        
                          
                   <tr style=" font-size:12px; font-weight: 400; ">
                       <td></td>
                        <td><strong style="float: right;">Total :</strong></td>
                        <td>'.$depitGrant.'</td>
                        <td>'.$creditGrant.'</td>
                       
                  </tr>
                   <tr style=" font-size:12px; font-weight: 400;">
                       <td colspan="4"><strong> (In Words)  :'.$this->CRUDModel->money_convert($voucher_info->print_cheque_value).'only</strong></td>
                        
                       
                  </tr>
                  ';
                       
                       ?>
                        
          </tbody>
            </table>
            
             <?php
               echo form_open('',array(''));
            if(@$upd_apr_by):
            ?>
            <h3 class="has-divider text-highlight">Employee list</h3>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                   <th>Employee Name</th>
                   <th>Print Name</th>
                   <th>Print Designation</th>
                   <th>Print Order</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                
                   
                   foreach(@$upd_apr_by as $updRow):
                       $chk = $this->CRUDModel->get_where_row('gl_at_aprove_by',array('trns_ab_amount_trans_id'=>$this->uri->segment(2),'trns_ab_emp_id'=>$updRow->fn_va_emp_id));
                       if(empty($chk)):
                            echo '<tr>
                                <td>
                                <input type="checkbox" name="checked[]" value="'.$updRow->id.'" id="checkItem" checked="">
                                    <input type="hidden" name="transactions_id" value="'.$this->uri->segment(2).'" id="transactions_id">
                                </td>
                                <td>'.$updRow->emp_name.'</td>
                                <td>'.$updRow->name.'</td>
                                <td>'.$updRow->designation.'</td>
                                <td>'.$updRow->appr_order.'</td>
                                
                            </td>
                               
                              </tr>';
                           
                           
                       endif;
                  endforeach;
                 
              
                  ?>
              </tbody>
              
            </table>
            <?php  endif; 
             echo '<button type ="submit" name="save_record" value="save_record" class="btn btn-success btn-sm"><span>Save Record</span></button>';
            
              echo form_close();
            ?>
            
            
            <?php
            if(@$fnYear):
            ?>
            <h3 class="has-divider text-highlight">Result :<?php echo count(@$fnYear)?></h3>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th >S.no</th>
                    
                   <th>Employee Name</th>
                   <th>Print Name</th>
                   <th>Print Designation</th>
                   <th>Print Order</th>
                   <th>Manage</th>
                  
                  
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach(@$fnYear as $urRow):
                      echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$urRow->emp_name.'</td>
                                <td>'.$urRow->trns_ab_name.'</td>
                                <td>'.$urRow->trns_ab_designation.'</td>
                                <td>'.$urRow->trns_ab_appr_order.'</td>
                                <td>
                                <a href="VochSingDelete/'.$urRow->trns_ab_id.'/'.$this->uri->segment(2).'" class="productstatus" ><span class="btn btn-danger btn-sm">DELETE</span></a>
                                    
                            </td>
                               
                              </tr>';
                   $sn++;
                  endforeach;
                ?>
                
              </tbody>
            </table>
            <?php
            else:
                echo '<h3 class="has-divider text-highlight">No query found..</h3>';
            endif;
            ?>
            </article>
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
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