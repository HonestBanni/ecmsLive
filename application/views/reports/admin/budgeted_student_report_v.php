
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
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?php echo $ReportName?>
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
          <li class="current"><?php echo $ReportName?>
          </li>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7  page-row">                            
           
            <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme">Print</button> <br/><br/><br/>
         
            <div id="div_print">
                <div class="col-md-12 col-sm-12">
                <div class="col-md-12 col-sm-12">
                    
                
            <table class="table table-boxed table-hover" style="text-align: center;">
                <thead>
                    <tr>
                        <th colspan="10" style="text-align: center;">INTERMEDIATE [ FA / FSc ]</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="2" style="text-align: center;vertical-align: inherit;" ><strong>Class</strong></td>
                        <td colspan="3" class="info" style="text-align: center;"><strong>1st Year</strong></td>
                       <td colspan="3" class="danger" style="text-align: center;" ><strong>2nd Year</strong></td>
                       <td colspan="3" class="warning" style="text-align: center;"><strong>Grand Total</strong></td>
                    </tr>
                    <tr>
                        <td colspan="1" class="info"><strong>Morning</strong></td>
                       <td colspan="1" class="info"><strong>After Noon</strong></td>
                       <td colspan="1" class="info"><strong>TOTAL</strong></td>
                       <td colspan="1" class="danger"><strong>Morning</strong></td>
                       <td colspan="1" class="danger"><strong>After Noon</strong></td>
                       <td colspan="1" class="danger"><strong>TOTAL</strong></td>
                       <td colspan="1" class="warning"><strong>Morning</strong></td>
                       <td colspan="1" class="warning"><strong>After Noon</strong></td>
                       <td colspan="1" class="warning"><strong>TOTAL</strong></td>
                    </tr>
                   <tr>
                   <?php
                        $all_student_list = array();
                        if($Inter):
                           $first_m = $first_e = $first_total = '';
                           $secound_m = $secound_e = $secound_total = '';
                           $G_m = $G_e = $Inter_G_total = '';
                           foreach($Inter as $IntRow):
                               if($IntRow->Grand_Total > 0):
                                echo '<tr>';
                                echo '<td style="text-align: left;">'.$IntRow->Title.'</td>';
                                echo '<td class="info">'.$IntRow->first_Year_Morning.'</td>';
                                echo '<td class="info">'.$IntRow->first_Year_Evening.'</td>';
                                echo '<td class="info">'.$IntRow->first_Year_Total.'</td>';
                                
                                echo '<td class="danger">'.$IntRow->secound_Year_Morning.'</td>';
                                echo '<td class="danger">'.$IntRow->secound_Year_Evening.'</td>';
                                echo '<td class="danger">'.$IntRow->secound_Year_Total.'</td>';
                                
                                echo '<td class="warning">'.$IntRow->Total_Moring.'</td>';
                                echo '<td class="warning">'.$IntRow->Total_Evening.'</td>';
                                echo '<td class="warning">'.$IntRow->Grand_Total.'</td>';
                                echo '</tr>';
                                
                                $first_m        += $IntRow->first_Year_Morning ;
                                $first_e        += $IntRow->first_Year_Evening;
                                $first_total    += $IntRow->first_Year_Total;
                                
                                $secound_m      += $IntRow->secound_Year_Morning ;
                                $secound_e      += $IntRow->secound_Year_Evening;
                                $secound_total  += $IntRow->secound_Year_Total;
                                
                                $G_m            += $IntRow->Total_Moring ;
                                $G_e            += $IntRow->Total_Evening;
                                $Inter_G_total  += $IntRow->Grand_Total;
                               endif;   
                           endforeach;
                                echo '<tr>';
                                echo '<td style="text-align: left;"><strong>TOTAL</strong></td>';
                                echo '<td class="info"><strong>'.$first_m.'</strong></td>';
                                echo '<td class="info"><strong>'.$first_e.'</strong></td>';
                                echo '<td class="info"><strong>'.$first_total.'</strong></td>';
                                echo '<td class="danger"><strong>'.$secound_m.'</strong></td>';
                                echo '<td class="danger"><strong>'.$secound_e.'</strong></td>';
                                echo '<td class="danger"><strong>'.$secound_total.'</strong></td>';
                                echo '<td class="warning"><strong>'.$G_m.'</strong></td>';
                                echo '<td class="warning"><strong>'.$G_e.'</strong></td>';
                                echo '<td class="warning"><strong>'.$Inter_G_total.'</strong></td>';
                                echo '</tr>';
                                
                              $all_student_list[] = array(
                                  'title'           =>'Intermediate - [ FA / FSc]',
                                  'amount'          =>$Inter_G_total,
                              );   
                       endif;
                       ?>
                    </tr>
              </tbody>
            </table>
            </div>   
            </div>   
                  <div class="col-md-12 col-sm-12">
                  <div class="col-md-6 col-sm-6">
                    <table class="table table-boxed table-hover" style="text-align: center;">
                        <thead>
                            <tr>
                                <th colspan="3" style="text-align: center;">PROFESSIONAL STUDIES [ HND / EDSML]</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Class</td>
                                <td>Semester</td>
                                <td>Total</td>
                            </tr>
                            <tr>
                                <td colspan="3"><strong>HND</strong></td>
                            </tr>
                            <?php
                            if($HND):
                                $TotalHND = '';
                                foreach($HND as $hndrow):
                                    echo '<tr>';
                                    echo '<td width="300px" style="text-align: left;" >'.$hndrow->batch_name.'</td>';
                                    echo '<td width="200px">'.$hndrow->name.'</td>';
                                    echo '<td width="100px">'.$hndrow->Total.'</td>';
                                    echo '</tr>';
                                    $TotalHND +=$hndrow->Total;
                                endforeach;
                                    echo '<tr>';
                                    echo '<td style="text-align: left;" colspan="2"><strong>Total<strong></td>';
                                    echo '<td><strong>'.$TotalHND.'</td></strong>';
                                    echo '</tr>';
                                    
                            endif;
                            ?>
                            
                            <tr>
                                <td colspan="3"><strong>EDSML</strong></td>
                            </tr>
                            <?php
                            if($EDSML):
                                $TotalEDSML = '';
                                foreach($EDSML as $edsmlrow):
                                    echo '<tr>';
                                    echo '<td width="300px" style="text-align: left;" >'.$edsmlrow->batch_name.'</td>';
                                    echo '<td width="200px">'.$hndrow->name.'</td>';
                                    echo '<td width="100px">'.$edsmlrow->Total.'</td>';
                                    echo '</tr>';
                                    $TotalEDSML +=$edsmlrow->Total;
                                endforeach;
                               $GrandTotal = '0'; 
                               $GrandTotal =  $TotalEDSML+$TotalHND;
                                    echo '<tr>';
                                    echo '<td style="text-align: left;" colspan="2"><strong>Total<strong></td>';
                                    echo '<td><strong>'.$TotalEDSML.'</td></strong>';
                                    echo '</tr>';
                                    echo '<tr>';
                                    echo '<td style="text-align: left;" colspan="2"><strong>Grand Total<strong></td>';
                                    echo '<td><strong>'.$GrandTotal.'</td></strong>';
                                    echo '</tr>';
                            $all_student_list[] = array(
                                  'title'           =>'Professional Studies',
                                  'amount'          =>$GrandTotal,
                              );
                            endif;
                            ?>
                            
                        </tbody>
                    </table>
                </div> 
                <div class="col-md-6 col-sm-6">
                    <table class="table table-boxed table-hover" style="text-align: center;">
                        <thead>
                            <tr>
                                <th colspan="3" style="text-align: center;">BS-COMPUTER SCIENCE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Class</td>
                                <td>Semester</td>
                                <td>Total</td>
                            </tr>
                            <?php
                            if($CS):
                                $Total = '';
                                foreach($CS as $csrow):
                                    echo '<tr>';
                                    echo '<td width="300px" style="text-align: left;" >'.$csrow->batch_name.'</td>';
                                    echo '<td width="200px">'.$csrow->name.'</td>';
                                    echo '<td width="100px">'.$csrow->Total.'</td>';
                                    echo '</tr>';
                                    $Total +=$csrow->Total;
                                endforeach;
                                    echo '<tr>';
                                    echo '<td style="text-align: left;" colspan="2"><strong>Total<strong></td>';
                                    echo '<td><strong>'.$Total.'</td></strong>';
                                    echo '</tr>';
                                    $all_student_list[] = array(
                                  'title'           =>'BS - Computer Science',
                                  'amount'          =>$Total,
                              );
                                    
                            endif;
                            ?>
                            
                        </tbody>
                    </table>
                </div>
                </div>
                
                 <div class="col-md-12 col-sm-12">
                 <div class="col-md-6 col-sm-6">
                    <table class="table table-boxed table-hover" style="text-align: center;">
                        <thead>
                            <tr>
                                <th colspan="3" style="text-align: center;">BS-ECONOMICS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Class</td>
                                <td>Semester</td>
                                <td>Total</td>
                            </tr>
                            <?php
                            if($Bs_Economics):
                                $Total = '';
                                foreach($Bs_Economics as $economics):
                                    echo '<tr>';
                                    echo '<td width="300px" style="text-align: left;" >'.$economics->batch_name.'</td>';
                                    echo '<td width="200px">'.$economics->name.'</td>';
                                    echo '<td width="100px">'.$economics->Total.'</td>';
                                    echo '</tr>';
                                    $Total +=$economics->Total;
                                endforeach;
                                    echo '<tr>';
                                    echo '<td  style="text-align: left;" colspan="2"><strong>Total<strong></td>';
                                    echo '<td><strong>'.$Total.'</td></strong>';
                                    echo '</tr>';
                                $all_student_list[] = array(
                                  'title'           =>'BS - Econimics',
                                  'amount'          =>$Total,
                              );
                            endif;
                            ?>
                            
                        </tbody>
                    </table>
                </div>
                    <div class="col-md-6 col-sm-6">
                    <table class="table table-boxed table-hover" style="text-align: center;">
                        <thead>
                            <tr>
                                <th colspan="3" style="text-align: center;">BBA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Class</td>
                                <td>Semester</td>
                                <td>Total</td>
                            </tr>
                            <?php
                            if($BBA):
                                $Total = '';
                                foreach($BBA as $bbarow):
                                    echo '<tr>';
                                    echo '<td width="300px" style="text-align: left;" >'.$bbarow->batch_name.'</td>';
                                    echo '<td width="200px">'.$bbarow->name.'</td>';
                                    echo '<td width="100px">'.$bbarow->Total.'</td>';
                                    echo '</tr>';
                                    $Total +=$bbarow->Total;
                                endforeach;
                                    echo '<tr>';
                                    echo '<td style="text-align: left;" colspan="2"><strong>Total<strong></td>';
                                    echo '<td><strong>'.$Total.'</td></strong>';
                                    echo '</tr>';
                                       $all_student_list[] = array(
                                  'title'           =>'BBA',
                                  'amount'          =>$Total,
                              );
                            endif;
                            ?>
                            
                        </tbody>
                    </table>
                </div>    
                </div>
                <div class="col-md-12 col-sm-12">
                <div class="col-md-6 col-sm-6">
                    <table class="table table-boxed table-hover" style="text-align: center;">
                        <thead>
                            <tr>
                                <th colspan="3" style="text-align: center;">BS-LAW</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Class</td>
                                <td>Semester</td>
                                <td>Total</td>
                            </tr>
                            <?php
                            if($BSLaw):
                                $Total = '';
                                foreach($BSLaw as $Lawrow):
                                    echo '<tr>';
                                    echo '<td width="300px" style="text-align: left;" >'.$Lawrow->batch_name.'</td>';
                                    echo '<td width="200px">'.$Lawrow->name.'</td>';
                                    echo '<td width="100px">'.$Lawrow->Total.'</td>';
                                    echo '</tr>';
                                    $Total +=$Lawrow->Total;
                                endforeach;
                                    echo '<tr>';
                                    echo '<td style="text-align: left;" colspan="2"><strong>Total<strong></td>';
                                    echo '<td><strong>'.$Total.'</td></strong>';
                                    echo '</tr>';
                                       $all_student_list[] = array(
                                  'title'           =>'BS - Law',
                                  'amount'          =>$Total,
                              );
                                    
                            endif;
                            ?>
                            
                        </tbody>
                    </table>
                </div>
               
                
                <div class="col-md-6 col-sm-6">
                    <table class="table table-boxed table-hover" style="text-align: center;">
                        <thead>
                            <tr>
                                <th colspan="3" style="text-align: center;">BS-ENGLISH</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Class</td>
                                <td>Semester</td>
                                <td>Total</td>
                            </tr>
                            <?php
                            if($BSEnglish):
                                $Total = '';
                                foreach($BSEnglish as $engrow):
                                    echo '<tr>';
                                    echo '<td width="300px" style="text-align: left;" >'.$engrow->batch_name.'</td>';
                                    echo '<td width="200px">'.$engrow->name.'</td>';
                                    echo '<td width="100px">'.$engrow->Total.'</td>';
                                    echo '</tr>';
                                    $Total +=$engrow->Total;
                                endforeach;
                                    echo '<tr>';
                                    echo '<td style="text-align: left;" colspan="2"><strong>Total<strong></td>';
                                    echo '<td><strong>'.$Total.'</td></strong>';
                                    echo '</tr>';
                                       $all_student_list[] = array(
                                  'title'           =>'BS - English',
                                  'amount'          =>$Total,
                              );
                            endif;
                            ?>
                            
                        </tbody>
                    </table>
                </div> 
                </div> 
                <div class="col-md-12 col-sm-12">
                  <div class="col-md-6 col-sm-6">
                    <table class="table table-boxed table-hover" style="text-align: center;">
                        <thead>
                            <tr>
                                <th colspan="4" style="text-align: center;">A LEVEL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Class</td>
                                <td>1st Year</td>
                                <td>2nd Year</td>
                                <td>Total</td>
                            </tr>
                            
                            <?php
                            if($ALEVEL):
                                $firstYear = '';
                                $secoundYear = '';
                                $TotalAlevel = '';
                                foreach($ALEVEL as $alevelrow):
                                    echo '<tr>';
                                    echo '<td width="300px" style="text-align: left;" >'.$alevelrow->Title.'</td>';
                                    echo '<td width="200px">'.$alevelrow->first_Year.'</td>';
                                    echo '<td width="100px">'.$alevelrow->secound_Year.'</td>';
                                    echo '<td width="100px">'.$alevelrow->Total.'</td>';
                                    echo '</tr>';
                                    $firstYear +=$alevelrow->first_Year;
                                    $secoundYear +=$alevelrow->secound_Year;
                                    $TotalAlevel +=$alevelrow->Total;
                                endforeach;
                                    echo '<tr>';
                                    echo '<td style="text-align: left;" colspan="1"><strong>Total<strong></td>';
                                    echo '<td><strong>'.$firstYear.'</td></strong>';
                                    echo '<td><strong>'.$secoundYear.'</td></strong>';
                                    echo '<td><strong>'.$TotalAlevel.'</td></strong>';
                                    echo '</tr>';
                                       $all_student_list[] = array(
                                  'title'           =>'A level',
                                  'amount'          =>$TotalAlevel,
                              );
                            endif;
                            ?>
                            
                            
                        </tbody>
                    </table>
                </div> 
                <div class="col-md-6 col-sm-6">
                    <table class="table table-boxed table-hover" style="text-align: left; font-weight: bold;">
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: center; ">TOTAL NUMBER OF STUDENTS [ENROLLED]</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            <?php 
                            $allStudentGrand = 0;
                            if(!empty($all_student_list)):
                                foreach(json_decode(json_encode($all_student_list)) as $row):
                                    echo '<tr>';
                                    echo '<td>'.$row->title.'</td>';
                                    echo '<td>'.$row->amount.'</td>';
                                    echo '</tr>';
                                    $allStudentGrand += $row->amount;
                                endforeach;
                                
                                 echo '<tr>';
                                    echo '<td>Total : </td>';
                                    echo '<td>'.$allStudentGrand.'</td>';
                                    echo '</tr>';
                               
                            endif;
                           
                           
                           ?>
                            
                        </tbody>
                    </table>
                </div>
                </div>
                 
                 
                    
            </div>
            </article>
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
 