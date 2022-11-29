<script language="javascript">
function printdiv(printpage)
{

var headstr = "<html><head><title></title></head><body><p><img src='assets/images/monogram.png' class='img-responsive' alt='Edwardes College Peshawar'></p>";
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
      <div class="page-content">
      <div class="row">
     <h2 align="left"><span  style="float:right">
          <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>    
              </span></h2>
        <div id="div_print"> 
            <div class="table-responsive">
                <?php if(@$cs_data): ?>
                <img src="assets/images/logo122.png" style="position: absolute; left: 20px">
                <h3 align="center" style="margin:20px 0px 0px;">EDWARDES COLLEGE PESHAWAR</h3>
                <p align="center" style="text-align: center; font-size: 14px;">Comparative Statement</p>
                <article class="contact-form col-md-12 col-sm-12">
                    <table width="100%" border="0" align="center" style="margin-bottom:10px; margin-top: 20px;">
                        <tr>
                            <th width="50%" rowspan="2">Prepared for: <?php echo $cs_data->quot_title ?></th>
                            <th width="25%">Minute Sheet # <?php echo $cs_data->cs_minute_sheet_no ?></th>
                            <th width="25%">Date: <?php echo date('d-m-Y', strtotime($cs_data->cs_date)) ?></th>
                        </tr>
                        <tr>
                            <th>Requisition # <?php echo $cs_data->cs_requisistion_no ?></th>
                            <th>Comp St # <?php echo $cs_data->year.'/'.$cs_data->cs_id ?></th>
                        </tr>
                    </table>
            <table width="100%" border="2" align="center" style="margin-bottom:10px; ">
                <thead>
                    <tr>
                        <th rowspan="2" width="5%">S #</th>
                        <th rowspan="2" width="12%">Item / Description</th>
                        <th rowspan="2" width="12%">Specifications</th>
                        <th rowspan="2" width="5%">Qty</th>
                        <?php 
                        if(@$qd_data):
                            $sup_sno = '';
                            foreach($qd_data as $srow):
                                $sup_sno++;
                                echo '<td colspan="2" style="text-align: center;">
                                    <strong><u>Supplier # 0'.$sup_sno.'</u><br>
                                    '.$srow->sp_name.'</strong><br>
                                    <i>'.$srow->address.'</i><br>
                                    '.$srow->phone.'<br>
                                </td>';
                            endforeach;
                        endif; ?>
                    </tr>
                    <tr>
                    <?php if(@$qd_data):
                        foreach($qd_data as $srow):
                            echo '<td style="text-align: center;">Cost</td>
                            <td style="text-align: center;">Total</td>';
                        endforeach;
                    endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(@$itm_data):
                        $isn = '';
                        foreach($itm_data as $itmrow):
                            $isn++;
                            echo '<tr>
                            <td>'.$isn.'</td>
                            <td>'.$itmrow->itm_name.'</td>
                            <td>'.$itmrow->qd_specs.'</td>
                            <td>'.$itmrow->qd_product_qty.'</td>';
                            
                            
                            $amt_data = $this->InventoryModel->get_cs_amount_data(array('qd_quot_id'=>$cs_data->cs_quote_id, 'qd_product_id' => $itmrow->qd_product_id));
                            if(@$qd_data):
                                foreach($amt_data as $amrow):
                                    echo '<td style="text-align: center;">'.$amrow->qd_product_price.'</td>
                                    <td style="text-align: center;">'.$amrow->qd_total_price.'</td>';
                                endforeach;
                            endif;
                            echo '</tr>';
                        endforeach;
                        
                        echo '<tr>
                        <th colspan="4" style="text-align:right">TOTAL QUOTED PRICE [PKR]</th>';
                        if(@$qd_data):
                            $sup_sno = '';
                            foreach($qd_data as $srow):
                                $sup_sno++;
                                echo '<th colspan="2" style="text-align: center;">'.$srow->total_amount.'</th>';
                            endforeach;
                        endif;
                        echo '</tr>';
                        
                    endif;
                    ?>
                         
                </tbody>
            </table>
    <div style="width:100%; height:80px;">
        <div style="width:25%; height:80px; float:left">
            <strong><u>Prepared By:</u></strong><br> 
                <strong>Name:</strong> <?php echo $u_data->emp_name;?><br>
                <strong>Position:</strong><?php echo $u_data->title;?><br><br>
                <strong>Signature: ..........................</strong>
        </div>
        
        <?php $account_off = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$cs_data->cs_acct_off_id)); ?> 
        <div style="width:25%; height:80px; float:left">
            <strong><u>Checked By:</u></strong><br> 
                <strong>Name:</strong> <?php echo $account_off->emp_name;?><br>
                <strong>Position: </strong>Finance Officer<br><br>
                <strong>Signature: ..........................</strong>
        </div>
    </div>
    <hr style="border: solid black 1px">
    
    <?php
    
    $supp_name  = $this->InventoryModel->get_cs_low_supp(array('qd_quot_id'=>$cs_data->cs_quote_id));
    
    ?>
    
    
    <div style="width:100%; height:40px;"><strong>REMARKS OF PURCHASE COMMITTEE:</strong> On the basis of lowest price <strong>M/S <?php echo $supp_name->sp_name?></strong> is selected and forwarded to the Principal for the final approval.</div>
    
    <div style="width:100%; height:80px;">
        <?php 
        $sign       = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$cs_data->cs_est_mngr_id));
        
        if(!empty($sign)):
            $sign_des   = $this->CRUDModel->get_where_row('hr_emp_designation',array('emp_desg_id'=>$sign->current_designation));
        ?> 
        <div style="width:25%; height:80px; float:left; text-align: center">
            <p>&nbsp;</p>
            <p>&nbsp;</p>
               <strong><?php echo $sign->emp_name;?></strong><br>
               <?php echo '('.$sign_des->title.')'; ?>
        </div>
        <?php endif; ?>
        <?php $admin_officer = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$cs_data->cs_admin_off_id)); ?> 
        <div style="width:25%; height:80px; float:left; text-align: center">
            <p>&nbsp;</p>
            <p>&nbsp;</p>
               <strong><?php echo $admin_officer->emp_name;?></strong><br>
               (Administrative Officer)
        </div>
        
        <?php $director_finance = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$cs_data->cs_dir_finance_id)); ?> 
        <div style="width:25%; height:80px; float:left; text-align: center">
            <p>&nbsp;</p>
            <p>&nbsp;</p>
               <strong><?php echo $director_finance->emp_name;?></strong><br>
               (Director Finance)
        </div>
        
        <?php $vp_admin = $this->CRUDModel->get_where_row('hr_emp_record',array('emp_id'=>$cs_data->cs_vp_admin_id)); ?> 
        <div style="width:25%; height:80px; float:left; text-align: center">
            <p>&nbsp;</p>
            <p>&nbsp;</p>
               <strong><?php echo $vp_admin->emp_name;?></strong><br>
               (Convener Purchase Committee)
        </div>
    </div> 
    <hr style="border: solid black 1px;">
    
    <div style="width:100%; height:80px;">
        <div style="width:50%; height:80px; float:left">
            <strong><u>APPROVED BY:</u></strong><br><br>
                <strong>Principal: _________________________</strong>
        </div>
    </div>
    
     <?php echo $print_log;?>   
                </article> 
                <?php endif; ?>                   
            </div>
          </div>
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 