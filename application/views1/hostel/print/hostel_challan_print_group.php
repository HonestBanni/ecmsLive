<style>
  .form-control{
    /*height: 26px;*/
    font-size: 12px;
  }
  
  
  
</style> 
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
      <h1 class="heading-title pull-left">
        <?php echo $page_header?>
      </h1>
      <div class="breadcrumbs pull-right">
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-label">You are here:
          </li>
          <li>
            <?php
            
           
            echo anchor('admin/admin_home', 'Home');?> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current">
            <?php echo $page_header?>
          </li>
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
      <br/>
      <div class="row">
        <div id="div_print">
        <?php
        if($hostel_info):
            
            foreach($hostel_info as $info_row):
            
           
       
        
        ?>
          <div style="width:100%;">
            <div style="margin-top: 2px;width:32%;height:710px;border-right:2px dotted #000;margin-right:8px;margin-bottom:9px;float:left;margin-bottom: 2px;">
              <div style="width:100%; float:left; height:138px; padding:20px;">
                <table class="table table-hover" id="table" style="margin-bottom: 1px;">
                    <tr>
                    <td style="border-top: 0px solid #000000;"> <img class="img-responsive" src="assets/images/logoPrint.png" alt="Edwardes College Peshawar" width="100px;"></td>
                    <td style="border-top: 0px solid #000000;"><img class="img-responsive pull-right" src="assets/RQ/hostel_rq/<?php echo $info_row->challan_id?>.png" alt="Studetn RQ" width="80px;"  ></td> 
                 
                    </tr>
                  </table> 
                     <?php
                       
                      if($info_row->head_type == 2):
                          echo '<h2 style="font-size: 22px; text-align: center; ">Mess Bill</h2>';
                      else:
                          echo '<h2 style="font-size: 22px; text-align: center; ">Hostel Bill</h2>';
                      endif;
                      ?>
                  
                  <p style="font-size: 11px; text-align: center; ">
                   <strong>EDWARDES COLLEGE PESHAWAR</strong><br/><?php echo $info_row->bank_name?>-<?php echo $info_row->address?>
                  <br/>ACCOUNT NUMBER : <?php echo $info_row->account_no?>
                </p>
                 <table class="table table-hover" id="table" style="margin: 1px; border: 1px solid; font-size: 11px;">    
                    <tr>
                      
                        <th colspan="4"  style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Particulars Of Student</th>
                     </tr>
                     <tr>
                      
                         <td  colspan="4" style="border: 1px solid #000000;font-size: 18px;"><strong>Challan # &nbsp;&nbsp;<?php echo $info_row->challan_id?></td>
<!--                        <td  colspan="2" style="border: 1px solid #000000;font-size: 18px;"></strong></td>-->
                        
                     </tr>
                    <tr>
                      <td style="border: 1px solid #000000;"><strong>Issue</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($info_row->issue_date))?></strong></td>
                       
                      <td style="border: 1px solid #000000;"><strong>Valid</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($info_row->valid_date))?></strong></td>
                      
                    </tr>
                    <tr>
                      <td style="border: 1px solid #000000;"><strong>From</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($info_row->date_from))?></strong></td>
                       
                      <td style="border: 1px solid #000000;"><strong>To</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($info_row->date_to))?></strong></td>
                      
                    </tr>
                    
                    <tr>
                      
                        <td colspan="4" style="border: 1px solid #000000;">Student Name &nbsp;&nbsp;<strong><?php echo $info_row->student_name?></strong></td>
                      <!--<td colspan="2" style="border: 1px solid #000000;"></td>-->
                     </tr>
                    <tr>
                      
                      <td colspan="4" style="border: 1px solid #000000;">Father Name &nbsp;&nbsp;<strong><?php echo $info_row->father_name?></strong></td>
                      <!--<td colspan="2" style="border: 1px solid #000000;"><strong><?php // echo $studentInfo->father_name?></strong></td>-->
                     </tr>
                    <tr>
                        <td colspan="2" style="border: 1px solid #000000;">College # &nbsp;&nbsp;<strong><?php echo $info_row->college_no?></strong></td>
                         
                       <td  colspan="2" style="border: 1px solid #000000;">Group &nbsp;&nbsp; <strong><?php echo $info_row->Group?></strong></td> 
                      <!--<td  style="border: 1px solid #000000;"></td>-->
                    
                    
                     </tr>
                    
                      
                  </table>  
                
                
                
                <br/>
                <table class="table table-hover" id="table" style="margin: 1px; border: 1px solid; font-size: 11px;">    
                    <tr>
                      
                        <th colspan="3" style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Detail Of Hostel Fee</th>
                        <th colspan="1" style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Arrears</th>
                        <th colspan="1" style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Current</th>
                     </tr>
                          
                     <?php
                     $total = '';
                        
                     if($info_row->head_type == 2):
                         
                         
//                                                $this->db->select('hostel_head_title.title,sum(hostel_student_bill_info.amount) as amount');    
//                                                $this->db->select('if(old_challan_id== 0,sum(hostel_student_bill_info.amount) as current,sum(hostel_student_bill_info.amount) as arrears),hostel_head_title.title,sum(hostel_student_bill_info.amount) as amount');    
                                    $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                    $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                    $this->db->group_by('hostel_head_title.title');
                                    $this->db->order_by('hostel_head_title.title','asc');
                             $challan_details = $this->db->get_where('hostel_student_bill_info',array('hostel_bill_id'=>$info_row->challan_id))->result();
                             
                            foreach($challan_details as $ch_Row):
                         echo '<tr><td colspan="2" style="border: 1px solid #000000;">'.$ch_Row->title.'</td>';
                          
                              
                                   $this->db->select('hostel_head_title.title,sum(hostel_student_bill_info.amount) as old_amount'); 
                                   $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                   $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                   $this->db->group_by('hostel_head_title.title');
                                   $this->db->order_by('hostel_head_title.title','asc');
                            $where_arrears = array(
                                    'head_title_id'     => $ch_Row->head_title_id,
                                    'hostel_bill_id'    => $info_row->challan_id,
                                    'old_challan_id !='   => 0
                                   );

                                   $challan_details_arreas =  $this->db->get_where('hostel_student_bill_info',$where_arrears)->row();
                                  
                                   if(empty($challan_details_arreas)):
                                       
                                       echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;"></td>';
                                       else:
                                       echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$challan_details_arreas->old_amount.'</td>';
                          
                                   endif;
                                  
                                   $this->db->select('hostel_head_title.title,sum(hostel_student_bill_info.amount) as current_amount'); 
                                   $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                   $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                   $this->db->group_by('hostel_head_title.title');
                                   $this->db->order_by('hostel_head_title.title','asc');
                            $where_balance = array(
                                    'head_title_id'     => $ch_Row->head_title_id,
                                    'hostel_bill_id'    => $info_row->challan_id,
                                    'old_challan_id '   => 0
                                   );

                                   $challan_details_current =  $this->db->get_where('hostel_student_bill_info',$where_balance)->row();
                           
                        
                                 if(empty($challan_details_current)):
                                     
                                       echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;"></td>';
                                       else:
                                        echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$challan_details_current->current_amount.'</td>';
                          
                                   endif; 
                       
//                         echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$ch_Row->amount.'</td>';
                      
                        $total += @$challan_details_arreas->old_amount;
                        $total += @$challan_details_current->current_amount;
                        echo ' </tr>';
                         endforeach;
                         else:
                             
                             
                             
                                   $this->db->select('head_title_id,hostel_head_title.title,sum(hostel_student_bill_info.amount) as amount');
                                                $this->db->select('hostel_head_title.title,hostel_student_bill_info.amount');    
                                                $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                                $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                                 $this->db->group_by('title');
//                                                $this->db->order_by('title','asc');
                             $challan_details = $this->db->get_where('hostel_student_bill_info',array('hostel_bill_id'=>$info_row->challan_id))->result();
                       
                             foreach($challan_details as $ch_Row):
                          echo '<tr><td colspan="2" style="border: 1px solid #000000;">'.$ch_Row->title.'</td>';
                        
                        
                                   $this->db->select('old_challan_id,hostel_bill_id,hostel_head_title.title,sum(hostel_student_bill_info.amount) as arrears_amount');
                                                $this->db->select('hostel_head_title.title,hostel_student_bill_info.amount');    
                                                $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                                $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                                 $this->db->group_by('title');
//                                                $this->db->order_by('title','asc');
                                                 $arrears_where = array(
                                                     'head_title_id'     => $ch_Row->head_title_id,
                                                     'hostel_bill_id'    => $info_row->challan_id,
                                                      'old_challan_id !='   => 0
                                                     );
                    $challan_details_arrears = $this->db->get_where('hostel_student_bill_info',$arrears_where)->row();
                  
                  $arrears_total = '';
                    if(!empty($challan_details_arrears)):
                        $arrears_total = $challan_details_arrears->arrears_amount;
                            echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$arrears_total.'</td> ';
                        
                          else:
                           echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">0</td> ';
                        
                      endif;
                         
                          
                      
                      
                                   $this->db->select('old_challan_id,hostel_bill_id,hostel_head_title.title,sum(hostel_student_bill_info.amount) as current_amount');
                                                $this->db->select('hostel_head_title.title,hostel_student_bill_info.amount');    
                                                $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                                $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                                 $this->db->group_by('title');
//                                                $this->db->order_by('title','asc');
                                                 $current_where = array(
                                                       'head_title_id'     => $ch_Row->head_title_id,
                                                     'hostel_bill_id'    => $info_row->challan_id,
                                                      'old_challan_id'   => 0
                                                     );
                    $challan_details_current = $this->db->get_where('hostel_student_bill_info',$current_where)->row();
                     $current_total = '';
                    if(!empty($challan_details_current)):
                        $current_total =  $challan_details_current->current_amount;
                           echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$current_total.'</td> ';
                           
                          else:
                           echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">0</td> ';
                        
                      endif;
                          
                              echo '   </tr>';
                     $total += $arrears_total; 
                     $total += $current_total; 
                    
                         endforeach;
                     endif;
                     
                   
                     
                     ?>
                </table>
                <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 11px;">
                    <tr>
                     
                      <td style="border-top: 0px solid #000000; text-align: left;"><strong>TOTAL AMOUNT FEE[PKR]</strong></td>
                      <td style="border-top: 0px solid #000000;     border-bottom: 2px solid #000000; text-align: right;"><strong><?php echo $total?></strong></td>
                    </tr>
                  </table>  
                 <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tbody>
                    <tr>
                      <td style="border-top: 0px solid #000000;">Comments:</td>
                        
                    </tr>
                    <tr>
                      <td style="border-top: 0px solid #000000;"><?php echo $info_row->comments?></td>
                        
                    </tr>
                      </table>
                
                <div class="table-responsive">
                         
                        
                  
               <br/>
                    
                
               <br/>
             
              
               
               
               <h6 align="center">For Bank</h6>
               <h6 align="center" style="border-top: 1px solid; font-size: 12px;">F#(<strong><?php echo $info_row->form_no.','.$info_row->batch_name?></strong>)Banker's stamp & signature</h6>
      
                </div>
              </div>
            </div>
          </div>
          <div style="width:100%;">
            <div style="margin-top: 2px;width:32%;height:710px;border-right:2px dotted #000;margin-right:8px;margin-bottom:9px;float:left;margin-bottom: 2px;">
              <div style="width:100%; float:left; height:138px; padding:20px;">
                <table class="table table-hover" id="table" style="margin-bottom: 1px;">
                    <tr>
                    <td style="border-top: 0px solid #000000;"> <img class="img-responsive" src="assets/images/logoPrint.png" alt="Edwardes College Peshawar" width="100px;"></td>
                    <td style="border-top: 0px solid #000000;"><img class="img-responsive pull-right" src="assets/RQ/hostel_rq/<?php echo $info_row->challan_id?>.png" alt="Studetn RQ" width="80px;"  ></td> 
                 
                    </tr>
                  </table> 
                    <?php
                       
                      if($info_row->head_type == 2):
                          echo '<h2 style="font-size: 22px; text-align: center; ">Mess Bill</h2>';
                      else:
                          echo '<h2 style="font-size: 22px; text-align: center; ">Hostel Bill</h2>';
                      endif;
                      ?>
                  
                  <p style="font-size: 11px; text-align: center; ">
                   <strong>EDWARDES COLLEGE PESHAWAR</strong><br/><?php echo $info_row->bank_name?>-<?php echo $info_row->address?>
                  <br/>ACCOUNT NUMBER : <?php echo $info_row->account_no?>
                </p>
                 
                <table class="table table-hover" id="table" style="margin: 1px; border: 1px solid; font-size: 11px;">    
                    <tr>
                      
                        <th colspan="4"  style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Particulars Of Student</th>
                     </tr>
                     <tr>
                      
                         <td  colspan="4" style="border: 1px solid #000000;font-size: 18px;"><strong>Challan # &nbsp;&nbsp;<?php echo $info_row->challan_id?></td>
<!--                        <td  colspan="2" style="border: 1px solid #000000;font-size: 18px;"></strong></td>-->
                        
                     </tr>
                    <tr>
                      <td style="border: 1px solid #000000;"><strong>Issue</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($info_row->issue_date))?></strong></td>
                       
                      <td style="border: 1px solid #000000;"><strong>Valid</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($info_row->valid_date))?></strong></td>
                      
                    </tr>
                    <tr>
                      <td style="border: 1px solid #000000;"><strong>From</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($info_row->date_from))?></strong></td>
                       
                      <td style="border: 1px solid #000000;"><strong>To</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($info_row->date_to))?></strong></td>
                      
                    </tr>
                    
                    <tr>
                      
                        <td colspan="4" style="border: 1px solid #000000;">Student Name &nbsp;&nbsp;<strong><?php echo $info_row->student_name?></strong></td>
                      <!--<td colspan="2" style="border: 1px solid #000000;"></td>-->
                     </tr>
                    <tr>
                      
                      <td colspan="4" style="border: 1px solid #000000;">Father Name &nbsp;&nbsp;<strong><?php echo $info_row->father_name?></strong></td>
                      <!--<td colspan="2" style="border: 1px solid #000000;"><strong><?php // echo $studentInfo->father_name?></strong></td>-->
                     </tr>
                    <tr>
                        <td colspan="2" style="border: 1px solid #000000;">College # &nbsp;&nbsp;<strong><?php echo $info_row->college_no?></strong></td>
                         
                       <td  colspan="2" style="border: 1px solid #000000;">Group &nbsp;&nbsp; <strong><?php echo $info_row->Group?></strong></td> 
                      <!--<td  style="border: 1px solid #000000;"></td>-->
                    
                    
                     </tr>
                    
                      
                  </table>
                <br/>
                <table class="table table-hover" id="table" style="margin: 1px; border: 1px solid; font-size: 11px;">    
                      <tr>
                      
                        <th colspan="3" style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Detail Of Hostel Fee</th>
                        <th colspan="1" style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Arrears</th>
                        <th colspan="1" style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Current</th>
                     </tr>
                          
                      <?php
                     $total = '';
                     if($info_row->head_type == 2):
                         
                         
                      
//                                                $this->db->select('hostel_head_title.title,sum(hostel_student_bill_info.amount) as amount');    
//                                                $this->db->select('if(old_challan_id== 0,sum(hostel_student_bill_info.amount) as current,sum(hostel_student_bill_info.amount) as arrears),hostel_head_title.title,sum(hostel_student_bill_info.amount) as amount');    
                                    $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                    $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                    $this->db->group_by('hostel_head_title.title');
                                    $this->db->order_by('hostel_head_title.title','asc');
                             $challan_details = $this->db->get_where('hostel_student_bill_info',array('hostel_bill_id'=>$info_row->challan_id))->result();
                             
                            foreach($challan_details as $ch_Row):
                         echo '<tr><td colspan="2" style="border: 1px solid #000000;">'.$ch_Row->title.'</td>';
                          
                              
                                   $this->db->select('hostel_head_title.title,sum(hostel_student_bill_info.amount) as old_amount'); 
                                   $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                   $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                   $this->db->group_by('hostel_head_title.title');
                                   $this->db->order_by('hostel_head_title.title','asc');
                            $where_arrears = array(
                                    'head_title_id'     => $ch_Row->head_title_id,
                                    'hostel_bill_id'    => $info_row->challan_id,
                                    'old_challan_id !='   => 0
                                   );

                                   $challan_details_arreas =  $this->db->get_where('hostel_student_bill_info',$where_arrears)->row();
                                  
                                   if(empty($challan_details_arreas)):
                                       
                                       echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;"></td>';
                                       else:
                                       echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$challan_details_arreas->old_amount.'</td>';
                          
                                   endif;
                                  
                                   $this->db->select('hostel_head_title.title,sum(hostel_student_bill_info.amount) as current_amount'); 
                                   $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                   $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                   $this->db->group_by('hostel_head_title.title');
                                   $this->db->order_by('hostel_head_title.title','asc');
                            $where_balance = array(
                                    'head_title_id'     => $ch_Row->head_title_id,
                                    'hostel_bill_id'    => $info_row->challan_id,
                                    'old_challan_id '   => 0
                                   );

                                   $challan_details_current =  $this->db->get_where('hostel_student_bill_info',$where_balance)->row();
                           
                        
                                 if(empty($challan_details_current)):
                                       echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;"></td>';
                                       else:
                                        echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$challan_details_current->current_amount.'</td>';
                          
                                   endif; 
                       
//                         echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$ch_Row->amount.'</td>';
                      
                        $total += @$challan_details_arreas->old_amount;
                        $total += @$challan_details_current->current_amount;
                        echo ' </tr>';
                         endforeach;
                         else:
                                
                                 
                             
                                   $this->db->select('head_title_id,hostel_head_title.title,sum(hostel_student_bill_info.amount) as amount');
                                                $this->db->select('hostel_head_title.title,hostel_student_bill_info.amount');    
                                                $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                                $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                                 $this->db->group_by('title');
//                                                $this->db->order_by('title','asc');
                             $challan_details = $this->db->get_where('hostel_student_bill_info',array('hostel_bill_id'=>$info_row->challan_id))->result();
                       
                             foreach($challan_details as $ch_Row):
                          echo '<tr><td colspan="2" style="border: 1px solid #000000;">'.$ch_Row->title.'</td>';
                        
                        
                                   $this->db->select('old_challan_id,hostel_bill_id,hostel_head_title.title,sum(hostel_student_bill_info.amount) as arrears_amount');
                                                $this->db->select('hostel_head_title.title,hostel_student_bill_info.amount');    
                                                $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                                $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                                 $this->db->group_by('title');
//                                                $this->db->order_by('title','asc');
                                                 $arrears_where = array(
                                                     'head_title_id'     => $ch_Row->head_title_id,
                                                     'hostel_bill_id'    => $info_row->challan_id,
                                                      'old_challan_id !='   => 0
                                                     );
                    $challan_details_arrears = $this->db->get_where('hostel_student_bill_info',$arrears_where)->row();
                  
                  $arrears_total = '';
                    if(!empty($challan_details_arrears)):
                        $arrears_total = $challan_details_arrears->arrears_amount;
                            echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$arrears_total.'</td> ';
                        
                          else:
                           echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">0</td> ';
                        
                      endif;
                         
                          
                      
                      
                                   $this->db->select('old_challan_id,hostel_bill_id,hostel_head_title.title,sum(hostel_student_bill_info.amount) as current_amount');
                                                $this->db->select('hostel_head_title.title,hostel_student_bill_info.amount');    
                                                $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                                $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                                 $this->db->group_by('title');
//                                                $this->db->order_by('title','asc');
                                                 $current_where = array(
                                                       'head_title_id'     => $ch_Row->head_title_id,
                                                     'hostel_bill_id'    => $info_row->challan_id,
                                                      'old_challan_id'   => 0
                                                     );
                    $challan_details_current = $this->db->get_where('hostel_student_bill_info',$current_where)->row();
                     $current_total = '';
                    if(!empty($challan_details_current)):
                        $current_total =  $challan_details_current->current_amount;
                           echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$current_total.'</td> ';
                           
                          else:
                           echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">0</td> ';
                        
                      endif;
                          
                              echo '   </tr>';
                     $total += $arrears_total; 
                     $total += $current_total; 
                    
                         endforeach;
                     endif;
                     
                   
                     
                     ?>
                </table>
                <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">
                    <tr>
                     
                      <td style="border-top: 0px solid #000000; text-align: left;"><strong>TOTAL AMOUNT FEE[PKR]</strong></td>
                      <td style="border-top: 0px solid #000000;     border-bottom: 2px solid #000000; text-align: right;"><strong><?php echo $total?></strong></td>
                    </tr>
                  </table>  
                <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tbody>
                    <tr>
                      <td style="border-top: 0px solid #000000;">Comments:</td>
                        
                    </tr>
                    <tr>
                      <td style="border-top: 0px solid #000000;"><?php echo $info_row->comments?></td>
                        
                    </tr>
                      </table>
                
                <div class="table-responsive">
                         
                        
                  
               <br/>
                    
                
               <br/>
             
               <h6 align="center">For College</h6>
               <h6 align="center" style="border-top: 1px solid; font-size: 12px;">F#(<strong><?php echo $info_row->form_no.','.$info_row->batch_name?></strong>)Banker's stamp & signature</h6>
      
                </div>
              </div>
            </div>
          </div>
          <div style="width:100%;">
            <div style="margin-top: 2px;width:32%;height:710px;border-right:0px dotted #000;margin-right:8px;margin-bottom:9px;float:left;margin-bottom: 2px;">
              <div style="width:100%; float:left; height:138px; padding:20px;">
                <table class="table table-hover" id="table" style="margin-bottom: 1px;">
                    <tr>
                    <td style="border-top: 0px solid #000000;"> <img class="img-responsive" src="assets/images/logoPrint.png" alt="Edwardes College Peshawar" width="100px;"></td>
                    <td style="border-top: 0px solid #000000;"><img class="img-responsive pull-right" src="assets/RQ/hostel_rq/<?php echo $info_row->challan_id?>.png" alt="Studetn RQ" width="80px;"  ></td> 
                 
                    </tr>
                  </table> 
                     <?php
                       
                      if($info_row->head_type == 2):
                          echo '<h2 style="font-size: 22px; text-align: center; ">Mess Bill</h2>';
                      else:
                          echo '<h2 style="font-size: 22px; text-align: center; ">Hostel Bill</h2>';
                      endif;
                      ?>
                  
                  <p style="font-size: 11px; text-align: center; ">
                   <strong>EDWARDES COLLEGE PESHAWAR</strong><br/><?php echo $info_row->bank_name?>-<?php echo $info_row->address?>
                  <br/>ACCOUNT NUMBER : <?php echo $info_row->account_no?>
                </p>
                 
                <table class="table table-hover" id="table" style="margin: 1px; border: 1px solid; font-size: 11px;">    
                    <tr>
                      
                        <th colspan="4"  style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Particulars Of Student</th>
                     </tr>
                     <tr>
                      
                         <td  colspan="4" style="border: 1px solid #000000;font-size: 18px;"><strong>Challan # &nbsp;&nbsp;<?php echo $info_row->challan_id?></td>
<!--                        <td  colspan="2" style="border: 1px solid #000000;font-size: 18px;"></strong></td>-->
                        
                     </tr>
                    <tr>
                      <td style="border: 1px solid #000000;"><strong>Issue</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($info_row->issue_date))?></strong></td>
                       
                      <td style="border: 1px solid #000000;"><strong>Valid</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($info_row->valid_date))?></strong></td>
                      
                    </tr>
                    <tr>
                      <td style="border: 1px solid #000000;"><strong>From</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($info_row->date_from))?></strong></td>
                       
                      <td style="border: 1px solid #000000;"><strong>To</strong></td>
                      <td style="border: 1px solid #000000;"><strong><?php echo date('d-M-Y',strtotime($info_row->date_to))?></strong></td>
                      
                    </tr>
                    
                    <tr>
                      
                        <td colspan="4" style="border: 1px solid #000000;">Student Name &nbsp;&nbsp;<strong><?php echo $info_row->student_name?></strong></td>
                      <!--<td colspan="2" style="border: 1px solid #000000;"></td>-->
                     </tr>
                    <tr>
                      
                      <td colspan="4" style="border: 1px solid #000000;">Father Name &nbsp;&nbsp;<strong><?php echo $info_row->father_name?></strong></td>
                      <!--<td colspan="2" style="border: 1px solid #000000;"><strong><?php // echo $studentInfo->father_name?></strong></td>-->
                     </tr>
                    <tr>
                        <td colspan="2" style="border: 1px solid #000000;">College # &nbsp;&nbsp;<strong><?php echo $info_row->college_no?></strong></td>
                         
                       <td  colspan="2" style="border: 1px solid #000000;">Group &nbsp;&nbsp; <strong><?php echo $info_row->Group?></strong></td> 
                      <!--<td  style="border: 1px solid #000000;"></td>-->
                    
                    
                     </tr>
                    
                      
                  </table>
                <br/>
                <table class="table table-hover" id="table" style="margin: 1px; border: 1px solid; font-size: 11px;">    
                       <tr>
                      
                        <th colspan="3" style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Detail Of Hostel Fee</th>
                        <th colspan="1" style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Arrears</th>
                        <th colspan="1" style="border: 1px solid #000000;background: #000;color: #fff;text-align: center;">Current</th>
                     </tr>
                          
                      <?php
                     $total = '';
                     if($info_row->head_type == 2):
                      
                      
//                                                $this->db->select('hostel_head_title.title,sum(hostel_student_bill_info.amount) as amount');    
//                                                $this->db->select('if(old_challan_id== 0,sum(hostel_student_bill_info.amount) as current,sum(hostel_student_bill_info.amount) as arrears),hostel_head_title.title,sum(hostel_student_bill_info.amount) as amount');    
                                    $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                    $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                    $this->db->group_by('hostel_head_title.title');
                                    $this->db->order_by('hostel_head_title.title','asc');
                             $challan_details = $this->db->get_where('hostel_student_bill_info',array('hostel_bill_id'=>$info_row->challan_id))->result();
                             
                            foreach($challan_details as $ch_Row):
                         echo '<tr><td colspan="2" style="border: 1px solid #000000;">'.$ch_Row->title.'</td>';
                          
                              
                                   $this->db->select('hostel_head_title.title,sum(hostel_student_bill_info.amount) as old_amount'); 
                                   $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                   $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                   $this->db->group_by('hostel_head_title.title');
                                   $this->db->order_by('hostel_head_title.title','asc');
                            $where_arrears = array(
                                    'head_title_id'     => $ch_Row->head_title_id,
                                    'hostel_bill_id'    => $info_row->challan_id,
                                    'old_challan_id !='   => 0
                                   );

                                   $challan_details_arreas =  $this->db->get_where('hostel_student_bill_info',$where_arrears)->row();
                                  
                                   if(empty($challan_details_arreas)):
                                       
                                       echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;"></td>';
                                       else:
                                       echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$challan_details_arreas->old_amount.'</td>';
                          
                                   endif;
                                  
                                   $this->db->select('hostel_head_title.title,sum(hostel_student_bill_info.amount) as current_amount'); 
                                   $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                   $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                   $this->db->group_by('hostel_head_title.title');
                                   $this->db->order_by('hostel_head_title.title','asc');
                            $where_balance = array(
                                    'head_title_id'     => $ch_Row->head_title_id,
                                    'hostel_bill_id'    => $info_row->challan_id,
                                    'old_challan_id '   => 0
                                   );

                                   $challan_details_current =  $this->db->get_where('hostel_student_bill_info',$where_balance)->row();
                           
                        
                                 if(empty($challan_details_current)):
                                       echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;"></td>';
                                       else:
                                        echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$challan_details_current->current_amount.'</td>';
                          
                                   endif; 
                       
//                         echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$ch_Row->amount.'</td>';
                      
                        $total += @$challan_details_arreas->old_amount;
                        $total += @$challan_details_current->current_amount;
                        echo ' </tr>';
                         endforeach;
                         
                         else:
                             
                                  
                             
                                   $this->db->select('head_title_id,hostel_head_title.title,sum(hostel_student_bill_info.amount) as amount');
                                                $this->db->select('hostel_head_title.title,hostel_student_bill_info.amount');    
                                                $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                                $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                                 $this->db->group_by('title');
//                                                $this->db->order_by('title','asc');
                             $challan_details = $this->db->get_where('hostel_student_bill_info',array('hostel_bill_id'=>$info_row->challan_id))->result();
                       
                             foreach($challan_details as $ch_Row):
                          echo '<tr><td colspan="2" style="border: 1px solid #000000;">'.$ch_Row->title.'</td>';
                        
                        
                                   $this->db->select('old_challan_id,hostel_bill_id,hostel_head_title.title,sum(hostel_student_bill_info.amount) as arrears_amount');
                                                $this->db->select('hostel_head_title.title,hostel_student_bill_info.amount');    
                                                $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                                $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                                 $this->db->group_by('title');
//                                                $this->db->order_by('title','asc');
                                                 $arrears_where = array(
                                                     'head_title_id'     => $ch_Row->head_title_id,
                                                     'hostel_bill_id'    => $info_row->challan_id,
                                                      'old_challan_id !='   => 0
                                                     );
                    $challan_details_arrears = $this->db->get_where('hostel_student_bill_info',$arrears_where)->row();
                  
                  $arrears_total = '';
                    if(!empty($challan_details_arrears)):
                        $arrears_total = $challan_details_arrears->arrears_amount;
                            echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$arrears_total.'</td> ';
                        
                          else:
                           echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">0</td> ';
                        
                      endif;
                         
                          
                      
                      
                                   $this->db->select('old_challan_id,hostel_bill_id,hostel_head_title.title,sum(hostel_student_bill_info.amount) as current_amount');
                                                $this->db->select('hostel_head_title.title,hostel_student_bill_info.amount');    
                                                $this->db->join('hostel_heads','hostel_heads.id=hostel_student_bill_info.hostel_head_id');
                                                $this->db->join('hostel_head_title','hostel_head_title.id=hostel_heads.head_title_id');
                                                 $this->db->group_by('title');
//                                                $this->db->order_by('title','asc');
                                                 $current_where = array(
                                                       'head_title_id'     => $ch_Row->head_title_id,
                                                     'hostel_bill_id'    => $info_row->challan_id,
                                                      'old_challan_id'   => 0
                                                     );
                    $challan_details_current = $this->db->get_where('hostel_student_bill_info',$current_where)->row();
                     $current_total = '';
                    if(!empty($challan_details_current)):
                        $current_total =  $challan_details_current->current_amount;
                           echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">'.$current_total.'</td> ';
                           
                          else:
                           echo '<td colspan="2" style="border: 1px solid #000000; text-align: right;">0</td> ';
                        
                      endif;
                          
                              echo '   </tr>';
                     $total += $arrears_total; 
                     $total += $current_total; 
                    
                         endforeach;
                     endif;
                     
                   
                     
                     ?>
                </table>
                <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">
                    <tr>
                     
                      <td style="border-top: 0px solid #000000; text-align: left;"><strong>TOTAL AMOUNT FEE[PKR]</strong></td>
                      <td style="border-top: 0px solid #000000;     border-bottom: 2px solid #000000; text-align: right;"><strong><?php echo $total?></strong></td>
                    </tr>
                  </table>  
                <table class="table table-hover" id="table" style="margin-bottom: 1px; font-size: 12px;">    
                    <tbody>
                    <tr>
                      <td style="border-top: 0px solid #000000;">Comments:</td>
                        
                    </tr>
                    <tr>
                      <td style="border-top: 0px solid #000000;"><?php echo $info_row->comments?></td>
                        
                    </tr>
                      </table>
                
                <div class="table-responsive">
              
               <br/>
               <br/>
              <h6 align="center">For Student</h6>
               <h6 align="center" style="border-top: 1px solid; font-size: 12px;">F#(<strong><?php echo $info_row->form_no.','.$info_row->batch_name?></strong>)Banker's stamp & signature</h6>
      
                </div>
              </div>
            </div>
          </div>
          
          
          
    <?php
        
         endforeach;    
        endif;
        
        ?>
        
 
        </div>
      </div>
    </div>
  </div>
</div>
<!--//page-row-->
</div>
