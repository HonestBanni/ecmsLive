
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
                <h1 class="section-heading text-highlight">
                    <span class="line"><?php echo $page_header?> Search</span>
                </h1>
                    <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form'));?>
                        <div class="row">
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

                            <!--<input type="hidden" name="formCode" id="formCode" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date);?>">-->
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
                        </div>
                    </div>
                    <div style="padding-top:1%;">
                        <div class="col-md-6 pull-right">

                            <button type="submit" class="btn btn-theme" name="report" ><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                    <?php
                             echo form_close();
                             ?>
            </section> 
        </div><!--//section-content-->
            
            
                <?php

                if(!empty($result)):
                 ?>
            
                    <div class="col-md-12 ">
                        <div id="div_print">
                            <h3 class="has-divider text-highlight">Result :30</h3>
                            <div class="table-responsive">
                                <table class="table table-hover" id="table" style="font-size:11px;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>COA</th>
                                        <th>Amount</th>
                                        <th>Print</th>
                                         
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                  $sn = '';
                                    foreach($result as $row):
//                                        echo '<pre>';print_r($row);die;
                                        $amount = '';
                                        
                                        $sn++;
                                            echo '<tr>';
                                            echo '<td>'.$sn.'</td>';
                                            echo '<td>'.date('M, Y',strtotime($row->for_month)).'</td>';
                                            echo '<td>'.$row->fn_coa_mc_title.'</td>';
                                            echo '<td>';
                                            if(!empty($row->total_amount)):
                                                    echo number_format($row->total_amount, 0, ',', ','); 
                                            
                                                endif;
                                            echo '</td>';
                                            echo '<td><a href="BRSPrint/'.$row->brs_report_id.'" target="_blank"><button class="btn btn-success btn-sm"><i class="fa fa-print"></i>Print</button></a></td>';
                                            
                                            echo '</tr>';
                                    endforeach;
                                
                                    ?>
                                </tbody>
                                </table>
                            </div>
                            <?php echo $print_log;?>
                        </div>
                    </div>
            
            
                 <?php
                endif;
                ?>
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
 
 
    <style>
 
        .ui-datepicker-calendar {
    display: none;
    }
    </style>    
        
     <script>
  $( function() {
      
    $('.datepicker').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
    });
   
  
  
  
  </script>        
  

 