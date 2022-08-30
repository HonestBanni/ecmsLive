
<script language="javascript">
  function printdiv(printpage)
  {
    var headstr = "<html><head><title></title></head><div><p style='padding-left: 70%;'><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p></div><body>";
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
        <div class="col-md-12">
            <section class="course-finder" style="padding-bottom: 2%;">
                 
                    
                    <div style="padding-top:1%;">
                        <div class="col-md-6 ">

                           <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>
                        </div>
                    </div>
                
                    
            </section> 
            <div id="div_print" >
                <div class="row">
                    <div class="col-md-12">
                        <h4>EDWARDES COLLEGE PESHAWAR </h4>
                        <h4>BANK RECONCILIATION STATEMENT</h4>
                        <h4>FOR THE MONTH OF <?php echo strtoupper(date('M-Y',strtotime($title_info->for_month)))?></h4>
                        <h4><?php echo strtoupper($title_info->fn_coa_mc_title)?></h4>
                    </div>
                        
                </div>
                    
            <?php
            
              $bank_book = '';
              if($bank_as_per_balance):
             echo '<div class="table-responsive">  
                        <table  id="table" class="table table-hover" style="font-size:12px" border="1">';
           
                 foreach($bank_as_per_balance as $bnks):
                 echo '<tr>';
                    echo '<td colspan="6" style="text-align:  left;width: 31%">'.$bnks->description.'</td>';
                     echo '<td style="text-align:  right; width: 4.5%">';
                    
                    if(!empty($bnks->amount)):
                        echo number_format($bnks->amount, 0, ',', ','); 
                    endif;
                    echo '</td>';
                    echo '</tr>';
                 $bank_book +=$bnks->amount;
                 endforeach;
            
                        
             echo '</table></div">';
              endif;
                 $bank_book_unprested_cheks    = '';
             
              if($unpresented):
             echo '<div class="table-responsive">  
                        <table  id="table" class="table table-hover" style="font-size:12px" border="1">';
                        echo '<tr>';
                        echo '<td style="text-align:  center;width: 3%">V#</td>';
                        echo '<td colspan="3" style="text-align:  center;width: 3%">Date</td>';
                        echo '<td style="text-align:  center; width: 3%">Chq</td>';
                        echo '<td style="text-align:  center; width: 5%">Payee</td>';
                        echo '<td style="text-align:  center; width: 5%">Description</td>';
                        echo '<td style="text-align:  center; width: 5%">Amount[PKR]</td>';
                        

                        echo '</tr>';
                        echo '<tr>';
                        echo '<td style="text-align:  center;width: 3%"></td>';
                        echo '<td style="text-align:  center;width: 1%">DD</td>';
                        echo '<td style="text-align:  center; width: 1%">MM</td>';
                        echo '<td style="text-align:  center; width: 1%">YY</td>';
                        echo '<td style="text-align:  center; width: 3%"></td>';
                        echo '<td style="text-align:  center; width: 5%"></td>';
                        echo '<td style="text-align:  center; width: 5%"></td>';
                        echo '<td style="text-align:  center; width: 5%"></td>';
                        echo '</tr>';
                         
                     $amount            = '';
                   
                 foreach($unpresented as $unpres):
                 echo '<tr>';
                    echo '<td style="text-align:  center;width: 3%">'.$unpres->voucher_no.'</td>';
                    echo '<td style="text-align:  center;width: 1%">'.date('d',strtotime($unpres->date)).'</td>';
                    echo '<td style="text-align:  center;width: 1%">'.date('m',strtotime($unpres->date)).'</td>';
                    echo '<td style="text-align:  center;width: 1%">'.date('Y',strtotime($unpres->date)).'</td>';
                    echo '<td style="text-align:  center; width: 3%">'.$unpres->chq_no.'</td>';
                    echo '<td style="text-align:  left; width: 10%">'.$unpres->payee.'</td>';
                    echo '<td style="text-align:  left; width: 15%">'.$unpres->description.'</td>';
                    echo '<td style="text-align:  right; width: 5%">';
                        if(!empty($unpres->amount)):
                            echo number_format($unpres->amount, 0, ',', ','); 
                        endif;
                    echo '</td>';
                    
                    echo '</tr>';
                 echo '</tr>';
                 $amount += $unpres->amount;
                 endforeach;
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td colspan="7" style="text-align:  right;">Total[PKR]</td>';
                     echo '<td style="text-align:  right; width: 5%">';
                        if(!empty($amount)):
                            echo number_format($amount, 0, ',', ','); 
                        endif;
                    echo '</td>';
                   
                    echo '</tr>';
                    $bank_book_unprested_cheks += $amount +$bank_book;
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td colspan="7" style="text-align:  right;"><strong>Bank Book [+] Unpresented Cheque</strong></td>';
                     echo '<td style="text-align:  right; width: 5%">';
                        if(!empty($bank_book_unprested_cheks)):
                            echo number_format($bank_book_unprested_cheks, 0, ',', ','); 
                        else:
                            echo '0';
                            
                        endif;
                    echo '</td>';
                    
                    echo '</tr>';

                        
             echo '</table></div>';
             
             endif;
   
             $addition_gAmounts = '';
              $gAdd_amount = '';
               echo '<div class="table-responsive">  
                        <table  id="table" class="table table-hover" style="font-size:12px" border="1">';
              if($add_unpres_amount):
                foreach($add_unpres_amount as $add_unp):
                
                 echo '<tr>';
                    echo '<td colspan="2" style="text-align:  left;width: 15%">'.$add_unp->tran_type.'</td>';
                    echo '<td colspan="7" style="text-align:  left;width: 15%">'.$add_unp->description.'</td>';
                     echo '<td style="text-align:  right; width: 4%">';
                    
                    if(!empty($add_unp->amount)):
                        echo number_format($add_unp->amount, 0, ',', ','); 
                    endif;
                    echo '</td>';
                     
                      
                    
                 echo '</tr>';
                 $gAdd_amount +=$add_unp->amount;
                 endforeach;
                
                    echo '<tr>';
                    echo '<td colspan="9" style="text-align:  right;"><strong>Total Addition Amount</strong></td>';
                     echo '<td style="text-align:  right; width: 5%">';
                        if(!empty($gAdd_amount)):
                            echo number_format($gAdd_amount, 0, ',', ','); 
                        endif;
                    echo '</td>';
                  
                  
                    echo '</tr>';
                
                 
                 
           
              endif;
              echo '<tr>';
                    echo '<td colspan="10" style="text-align:right; border-left:1px solid #ffff;border-right:1px solid #ffff"><strong>&nbsp;</strong></td>';
                     
                  
                    echo '</tr>';
        
              $Sub_gAmounts = '';
               $gSub_amount = '';
                
              if($sub_unpres_amount):
                foreach($sub_unpres_amount as $sub_unp):
                 echo '<tr>';
                    echo '<td colspan="2" style="text-align:  left;width: 15%">'.$sub_unp->tran_type.'</td>';
                    echo '<td colspan="7" style="text-align:  left;width: 15%">'.$sub_unp->description.'</td>';
                     echo '<td style="text-align:  right; width: 5%">';
                    
                    if(!empty($sub_unp->amount)):
                        echo number_format($sub_unp->amount, 0, ',', ','); 
                    endif;
                    echo '</td>';
                     
                       
                     
                 echo '</tr>';
                 $gSub_amount +=$sub_unp->amount;
                 endforeach;
                
                    echo '<tr>';
                    echo '<td colspan="9" style="text-align:  right;"><strong>Total Subtraction Amount</strong></td>';
                     echo '<td style="text-align:  right; width: 4.5%">';
                        if(!empty($gSub_amount)):
                            echo number_format($gSub_amount, 0, ',', ','); 
                        endif;
                    echo '</td>';
                    
                    echo '</tr>';
                    
                     
                 
                 endif;
                 
                 $grand_totals = $gAdd_amount+$bank_book_unprested_cheks-$gSub_amount;
                 
                 echo '<tr>';
                    echo '<td colspan="9" style="text-align:  right;"><strong>Balance as per Bank Statement</strong></td>';
                     echo '<td style="text-align:  right; width: 4.5%">';
                        if(!empty($grand_totals)):
                            echo number_format($grand_totals, 0, ',', ','); 
                        endif;
                    echo '</td>';
                  
                    echo '</tr>';
                 
                        
             echo '</table>';
             
             echo '
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <table id="table" class="table table-hover" style="font-size:12px">
                        <tbody>
                            <tr>
                                <td colspan="3" style="text-align:  center;width: 31%;text-decoration: overline;border-top: 0px;font-size: 15px;">Accounts Officer</td>
                                <td colspan="3"style="text-align:  center;width: 31%;text-decoration: overline;border-top: 0px;font-size: 15px;">Finance Officer</td>
                                <td colspan="3"style="text-align:  center;width: 31%;text-decoration: overline;border-top: 0px;font-size: 15px;">Director Finance</td>
                            </tr>
                        </tbody>
                    </table>


             </div>';
              
             
             
             
              
              
            
            
            ?>
              <?php echo $print_log;?>
        </div><!--//section-content-->
        </div><!--//section-content-->
        
            
             
       </div>
    </div>
 
      </div>
  
  
 
 