 
<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
      <header class="header">  
        <div class="header-main container">
            <h1 class="logo col-md-4 col-sm-4 col-md-offset-4">
               <img id="logo" src="assets/images/logo.png" alt="Logo"> 
            </h1><!--//logo-->           

        </div><!--//header-main-->
    </header>
        <header class="page-heading clearfix">
            <h3 class="heading-title pull-left">General Ledger</h3>
                <div class="breadcrumbs pull-right">
                    
                </div>
      <!--//breadcrumbs-->
    </header>
    <div class="page-content">
        
      <div class="row">
          <div class="col-md-12">
            
                        
                            <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                        if(!empty($GeneralLeader)):
                                             $class = array(
                                                'info',
                                                'success',
                                                'danger',
                                                'warning',
                                                'active',
                                            );
                                           // echo '<pre>';print_r($GeneralLeader);die;
                                            foreach($GeneralLeader as $GLRow):
                                              $k = array_rand($class);
                                            
                                        ?>
                                        <header class="page-heading clearfix">
                                            <h4 class="heading-title pull-left"> <?php echo $GLRow->fn_coa_mc_title?> (<?php echo $GLRow->fn_coa_mc_code?>) :</h4>
                                                    <div class="breadcrumbs pull-right">
                                                        <strong>
                                                            <ul class="breadcrumbs-list">
                                                                <li class="breadcrumbs-label">Date &nbsp;:</li>
                                                                    <li><?php 
                                                                    echo date('d-m-Y', strtotime($dateFrom))
                                                                    
                                                                      ?>
                                                                      <i class="fa fa-angle-right">
                                                                      </i>
                                                                    </li>
                                                                <li class="current"><?php echo date('d-m-Y', strtotime($dateTo))?></li>
                                                            </ul>
                                                        </strong>
                                                    </div>
                                          <!--//breadcrumbs-->
                                        </header>
                                        <div class="table-responsive">                      
                                            
                                            <table class="table table-hover">
                                                 
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Vr#</th>
                                                        <th>COA</th>
                                                        <th>Description</th>
                                                        <th>Payee</th>
                                                        <th>Cheque #</th>
                                                        <th>Debit</th>
                                                        <th>Credit</th>
                                                    </tr>
                                                </thead>
                                                
                                                <?php
                                                
                                                $detail = $this->FinanceModel->get_amountDetails(
                                                        'gl_amount_transition',
                                                        array('gl_ad_coa_mc_pk '=>$GLRow->gl_ad_coa_mc_pk)
                                                        ,$dateFrom,$dateTo);
                                            
                                               $credit_total ='';
                                               $debit_total ='';
                                                foreach($detail as $dRow):
                                                    
                                               
                                                ?>
                                                  <tr class='<?php echo $class[$k]?>'>
                                                        <td><?php echo date('d-m-Y', strtotime($dRow->gl_at_date))?></td>
                                                        <td><?php echo $dRow->gl_at_vocher?></td>
                                                        <td><?php
                                                        
                                                        
                                                        if($dRow->gl_ad_depit):
                                                            
                                                            $vocDet = array(
                                                            'gl_ad_atId'=>$dRow->gl_at_id,
                                                            'gl_ad_depit '=>'');
                                                        $VocDetail = $this->CRUDModel->get_where_result('gl_amount_details',$vocDet);
                                                        
                                                        foreach($VocDetail as $VCName):
                                                            
                                                                if($VCName == $dRow->gl_ad_coa_mc_id):
                                                                    else:
                                                                       $var = $VCName->gl_ad_coa_mc_name.',';
                                                                        echo wordwrap($var,15,"<br>\n");
                                                                endif;
                                                               
                                                        endforeach;
                                                            else:
                                                                
                                                             $vocDet = array(
                                                            'gl_ad_atId'=>$dRow->gl_at_id,
                                                            'gl_ad_credit '=>'');
                                                        $VocDetail = $this->CRUDModel->get_where_result('gl_amount_details',$vocDet);
                                                        
                                                        foreach($VocDetail as $VCName):
                                                            
                                                                if($VCName == $dRow->gl_ad_coa_mc_id):
                                                                    else:
                                                                    
                                                                    $var = $VCName->gl_ad_coa_mc_name.',';
                                                                
                                                                echo wordwrap($var,15,"<br>\n");
                                                                endif;
                                                               
                                                        endforeach;
                                                          endif; ?></td>
                                                        <td><?php 
                                                        
                                                        echo wordwrap($dRow->gl_at_description,30,"<br>\n")
                                                        
                                                        ?></td>
                                                        <td><?php echo $dRow->gl_at_payeeId?></td>
                                                        <td><?php echo $dRow->gl_at_cheque?></td>
                                                        <td><?php echo $dRow->gl_ad_depit?></td>
                                                        <td><?php echo $dRow->gl_ad_credit?></td>
                                                        <?php   $debit_total +=$dRow->gl_ad_depit?>
                                                        <?php   $credit_total +=$dRow->gl_ad_credit?>
                                                    </tr>
           
                                                     <?php
                                        
                                            endforeach;
                                       
                                        ?>
                                                    <tr>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                   
                                                        <td><?php echo $debit_total?></td>
                                                        <td><?php echo $credit_total?></td>
                                                    
                                                    </tr>
                                                    <tr>
                                                       
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td>Grand Total</td>
                                                        <?php 
                                                        $grandDebit     = '';
                                                        $grandCredit    = '';
                                                        $parentId = $this->CRUDModel->get_where_row('fn_coa_parent',array('fn_coaId'=>$GLRow->fn_coa_pId));
                                                           
                                                        if($parentId->fn_coa_code == 200000):
                                                               $grandCredit = $credit_total-$debit_total;
                                                               $grandDebit     = '';
                                                        endif;
                                                        if($parentId->fn_coa_code == 400000):
                                                               $grandCredit = $credit_total-$debit_total;
                                                                $grandDebit     = '';   
                                                        endif;
                                                        
                                                        if($parentId->fn_coa_code == 300000):
                                                               $grandDebit = $debit_total- $credit_total;
                                                                $grandCredit    = '';
                                                        endif;
                                                        if($parentId->fn_coa_code == 500000):
                                                               $grandDebit = $debit_total- $credit_total;
                                                        $grandCredit    = '';
                                                        endif;
                                                        
                                                          ?>
                                                         <td><?php 
                                                        
                                                        
                                                        echo  $grandDebit; ?></td>
                                                        <td><?php 
                                                        echo $grandCredit; ?></td>
                                                     
                                                    
                                                    </tr>
                                            </table><!--//table-->
                                            
                                           
                                        </div><!--//table-responsive-->
                                        
                                        <?php
                                        
                                            endforeach;
                                        endif;
                                        ?>
                                     
                                    </div>
                                     
                                </div>
<!--              <div class="panel panel-theme">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Transitions</h3>
                                        </div>
                                        
                                    </div>-->
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
 
 
 