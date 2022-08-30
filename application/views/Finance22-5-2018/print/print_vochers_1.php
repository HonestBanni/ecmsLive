<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>

<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">
        Fee Challan Print      </h1>
      <div class="breadcrumbs pull-right">
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-label">You are here:
          </li>
          <li>
            <a href="http://localhost/ECMS/admin/admin_home">Home</a> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current">
            Voucher Challan Print         </li>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <div class="col-md-1">
          <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme">
            <i class="fa fa-print">
            </i> Print 
          </button>
        </div>
      </div>
      <br>
      <div class="row">
        <div id="div_print">
         <div style="width:100%;">
             <h3 align="center">EDWARDES COLLEGE PESHAWAR <br/><?php echo $voucher_info->voch_name?><hr/></h3>
          </div>
 
        
 
        </div>
      </div>
    </div>
  </div>
</div>
 ******CONTENT******  
<div class="content container">
   
    <div class="page-content">
      
           
          <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>    
             
        <div id="div_print">  
            
            <h3 align="center">EDWARDES COLLEGE PESHAWAR <br/><?php echo $voucher_info->voch_name?><hr/></h3>
                
        <article class="contact-form col-md-12 col-sm-12">
              
    <div class="table-responsive">
        <table class="table table-boxed table-hover">
           <tbody>
                <tr>
                    <td>Process Date</td>
                    <td><?php echo date('d-m-Y', strtotime($voucher_info->gl_at_date));?></td>
                    <td>Process NO</td>
                    <td><?php echo $voucher_info->gl_at_id;?></td>
                    <td>Voucher No</td>    
                    <td><?php echo $voucher_info->gl_at_vocher;?></td>    
                    <td>Payment date</td>    
                    <td><?php 
                    
                    if($voucher_info->status == 1):
                        else:
                        echo date('d-m-Y', strtotime($voucher_info->payment_date));
                    endif;
                    
                    
                    
                    ?></td>    
                  </tr>
                <tr>
                    <td>Payee </td>
                    <td colspan="7"></td>
                  
                  </tr>
                <tr>
                    <td>Brief Description of the Payment</td>
                    <td colspan="7"></td>
                  
                  </tr>
                    <td>Attachments</td>
                    <td colspan="7"></td>
                  
                  </tr>
                   <tr>
                    <td>Prepared & Paid by (Cashier)</td>
                    <td></td>
                    <td>Name</td>
                    <td> jan wali</td>
                    <td>Signed</td>    
                    <td></td>    
                    <td>Date</td>    
                    <td></td>    
                  </tr>    
                 
                   <tr style="color:green; font-size:16px">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Grand Total </td>
                    <td>30000</td>    
                  </tr>        
          </tbody>
            </table>
        <table class="table table-boxed table-hover">
           <tbody>
                 
                   <tr style=" font-size:16px; font-weight: 700;">
                       <td>Account<br/>Code</td>
                    <td>Chart Of Account</td>
                    <td>Debit</td>
                    <td>Credit</td>
                       
                  </tr>        
                   <tr style=" font-size:16px; font-weight: 700;">
                       <td>1001</td>
                    <td>Salary</td>
                    <td>1000</td>
                    <td></td>
                       
                  </tr>        
                   <tr style=" font-size:16px; font-weight: 700;">
                       <td>2021</td>
                    <td>HBL-1625</td>
                    <td></td>
                    <td>1000</td>
                       
                  </tr>        
                   <tr style=" font-size:16px; font-weight: 700;">
                       <td>(In Words)</td>
                        <td>one Thousant</td>
                        <td>100</td>
                        <td>1000</td>
                       
                  </tr>        
          </tbody>
            </table>
       <table class="table table-boxed table-hover">
           <tbody>
                <tr>
                    <td>Checked by (Account Officer)</td>
                    <td></td>
                    <td>Name</td>
                    <td></td>
                    <td>Signd</td>    
                    <td></td>    
                    <td>Date</td>    
                    <td>12-Feb-2017</td>    
                  </tr>
                <tr>
                    <td>Checked by (Finance Officer)</td>
                    <td></td>
                    <td>Name</td>
                    <td></td>
                    <td>Signd</td>    
                    <td></td>    
                    <td>Date</td>    
                    <td>12-Feb-2017</td>    
                  </tr>
                <tr>
                    <td>Checked by (Internal Auditor)</td>
                    <td></td>
                    <td>Name</td>
                    <td></td>
                    <td>Signd</td>    
                    <td></td>    
                    <td>Date</td>    
                    <td>12-Feb-2017</td>    
                  </tr>
                <tr>
                    <td>Approved by (Principal)</td>
                    <td></td>
                    <td>Name</td>
                    <td></td>
                    <td>Signd</td>    
                    <td></td>    
                    <td>Date</td>    
                    <td>12-Feb-2017</td>    
                  </tr>
                <tr>
                    <td>Approved by (Vice Principal-1)</td>
                    <td></td>
                    <td>Name</td>
                    <td></td>
                    <td>Signd</td>    
                    <td></td>    
                    <td>Date</td>    
                    <td>12-Feb-2017</td>    
                  </tr>
                <tr>
                    <td>Approved by (Vice Principal-2)</td>
                    <td></td>
                    <td>Name</td>
                    <td></td>
                    <td>Signd</td>    
                    <td></td>    
                    <td>Date</td>    
                    <td>12-Feb-2017</td>    
                  </tr>
        
          </tbody>
            </table>    
       <table class="table table-boxed table-hover">
           <tbody>
                <tr>
                    <td>Paid vide Cheque#</td>
                      <td></td>   
                      <td></td>   
                      <td></td>   
                      <td></td>   
                      <td></td>   
                      <td></td>   
                      <td></td>   
                  </tr>
                <tr>
                    <td>Paid vide Cheque#</td>
                    <td></td>
                    <td>Date</td>
                    <td></td>
                    <td>Rs:</td>    
                    <td></td>    
                    <td>Payee Signature</td>    
                    <td></td>    
                  </tr>
 
        
          </tbody>
            </table>    
         </div>
            </article>
           </div>
              
         
          </div>
     
      </div>
 
 