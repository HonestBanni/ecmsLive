
<script language="javascript">
  function printdiv(printpage)
  {
    var headstr = "<html><head><title></title></head><body>";
    //var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
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
                        <h1 class="heading-title pull-left"><?php echo $breadcrumbs?></h1>
                            <div class="breadcrumbs pull-right">
                                <ul class="breadcrumbs-list">
                                    <li class="breadcrumbs-label">You are here:</li>
                                    <li><a href="admin/admin_home">Home</a><i class="fa fa-angle-right"></i></li>
                                    <li class="current"><?php echo $breadcrumbs?></li>
                                </ul>
                            </div>
                  <!--//breadcrumbs-->
                </header>
                <div class="page-content">
                    <div class="row">
                        <div class="col-md-12">
                             <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme">
                                        <i class="fa fa-print">
                                        </i> Print 
                                      </button>
                                 <div id="div_print">
                                 <h4 class="modal-title" style="text-align: center; text-transform: uppercase " id="myModalLabel">Revised pay scale <?php echo $result['titles']->fy_year ?> w.e.f  [ <?php echo $this->CRUDModel->date_convert($result['titles']->ps_date)?> ] </h4>
                                 <table class="datatable-1 table table-boxed table-bordered table-striped" style="font-size:9px">
                                   <thead>
                                       <tr>
                                           <th>&nbsp;&nbsp;BPS&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                           <th>Min</th>
                                           <th>Inc</th>
                                           <th>Max</th>
                                           <?php
                                           for($i=1; $i<=30; $i++):
                                               echo '<th>'.$i.'</th>';
                                           endfor;
                                           ?>
                                        </tr>
                                   </thead>
                                   <tbody>
                                   <?php
                                   $sn = '1';
                                   foreach($result['PayScaleDetails'] as $rec):

                                   ?>
                                   <tr class="gradeA">
                                       <td><?php echo $rec->scale_name;?></td>
                                       <td><?php echo number_format($rec->psd_min, 0, ',', ',');?></td>
                                       <td><?php echo number_format($rec->psd_roi, 0, ',', ',');?></td>
                                       <td><?php echo number_format($rec->psd_max, 0, ',', ',');?></td>
                                       <?php
                                       
                                       for($i=1; $i<=$rec->psd_max_steps; $i++):
                                                $value = $rec->psd_min + ($rec->psd_roi * $i);
                                               echo '<th>'.number_format($value, 0, ',', ',').'</th>';
                                           endfor;
                                       
                                       ?>
                                      </tr>

                                   <?php

                                   endforeach;

                               ?>


                               </tbody>
                                </table>
                                <table class="datatable-1 table table-boxed table-bordered table-striped" style="font-size:9px">
                               
                                    <?php
                                        if(!empty($result['Allowances'])):
                                    ?>
                               <thead>
                                       <tr>
                                           <th>ALLOWANCE DETAILS</th>
                                           <?php
                                           $bps  = $this->CRUDModel->get_where_result_order('hr_emp_scale',array('scale_flag'=>1),array('column'=>'scale_order','order'=>'asc'));
                                           foreach($bps as $rowtitle):
                                                    echo '<th>'.$rowtitle->scale_order.'</th>';
                                           endforeach;
                                           ?>
                                        </tr>
                                   </thead>
                                    <tbody>
                                        
                                        <?php
                                        
                                        foreach($result['Allowances'] as $allowRow):
                                            echo '<tr>';
                                            echo '<td>'.$allowRow->allow_type_name.'</td>';
                                                foreach($bps as $rowdata):
                                                    $where = array(
                                                      'psa_pay_scale'           => $rowdata->emp_scale_id,  
                                                      'psa_allowance_type_id'   => $allowRow->allow_type_id,  
                                                      'psa_ps_id'               => $this->uri->segment(2),  
                                                    );
                                                     $reslt =    $this->CRUDModel->get_where_row('pr_pay_scale_allowance',$where);
                                                        if(empty($reslt)):
                                                            echo '<td></td>';
                                                        else:
                                                            echo '<td>'.$reslt->psa_amount.'</td>';
                                                        endif;
                                                        
                                                endforeach;
                                                 
                                            echo '</tr>';
                                        endforeach;
//                                                echo '<pre>';print_r($result['Allowances']);die;
                                        
                                        ?>
                                         
                                    </tbody>
                                    
                                    <?php
                                        endif;
                                    ?>
                              
                               </table>
                             
                                </div>
                             
                        </div>
                    </div>
                </div>
            </div>
        </div>


    
 
 





<!-- ******CONTENT****** --> 
        