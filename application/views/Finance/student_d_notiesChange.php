 
<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left"><?php echo $page_header?></h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current"><?php echo $page_header?></li>
                    </ul>
                </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
        
        
        
        
        
      <div class="row">
          <div class="col-md-12">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                                     
                                     ?>
                                <div class="row">
                                      
 
                                     <div class="col-md-2 col-sm-5">
                                          <label for="name">College No</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'collegeNo',
                                                 'value'        => $collegeNo,
                                                'type'          => 'text ',
                                                 'class'        => 'form-control',
                                                'placeholder'   => 'College No',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                    
                                    <div class="row">
                                        <?php 
                                      
                                    if(!empty($result)):
                                        ?>
                                        <div class="col-md-3 col-sm-5">
                                        <label for="name">Change Address</label>
                                        
                                        <textarea name="stdAddress" rows="5" cols="35" ><?php  echo $result->app_postal_address;?></textarea>
                                        <?php

                                             echo  form_input(array(
                                                'name'          => 'stdId',
                                                 'value'            => $result->student_id,
                                                'type'          => 'hidden',
                                                 'class'         => 'form-control',
                                                'placeholder'   => 'Student Address',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                        <div class="col-md-2 col-sm-5">
                                        <label for="name">Phone Number 1</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'mobiel1',
                                                 'value'            => $result->mobile_no,
                                                'type'          => 'text ',
                                                 'class'         => 'form-control',
                                                'placeholder'   => 'Mobile 1',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                        <div class="col-md-2 col-sm-5">
                                        <label for="name">Phone Number 2</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'mobiel2',
                                                 'value'            => $result->mobile_no2,
                                                'type'          => 'text ',
                                                 'class'         => 'form-control',
                                                'placeholder'   => 'Mobile 2',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                        <div class="col-md-2 col-sm-5">
                                        <label for="name">Amount</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'amount',
                                                 'value'        => $result->amount,
                                                'type'          => 'text ',
                                                 'class'         => 'form-control',
                                                'placeholder'   => 'Amount ',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                        <div class="col-md-2 col-sm-5">
                                        <label for="name">Print date</label>
                                        <?php
                                            $pdate = '';
                                            if($result->print_date == ''):
                                                     $pdate = date('d-m-Y');
                                            else:
                                                $pdate =$result->print_date;
                                            endif;
                                            echo form_input(array(
                                                'name'          => 'pdate',
                                                 'value'        =>  date('d-m-Y', strtotime($pdate)),
                                                'type'          => 'text',
                                                 'class'         => 'form-control datepicker',
                                                'placeholder'   => 'Print date',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                        <div class="col-md-2 col-sm-5">
                                        <label for="name">Due date</label>
                                        <?php
                                            
                                         $ddate = '';
                                       
                                            if($result->due_date == ''):
                                                    $ddate = date('d-m-Y');
                                            else:
                                                $ddate =$result->due_date;
                                            endif;
                                            echo form_input(array(
                                                'name'           => 'ddate',
                                                 'value'         => date('d-m-Y', strtotime($ddate)),
                                                 'type'          => 'text',
                                                 'class'         => 'form-control datepicker',
                                                'placeholder'    => 'Print date',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                        <div class="col-md-2 col-sm-5">
                                        <label for="name">Diary Number</label>
                                        <?php
                                            $dairy = '';
                                            $title = $this->CRUDModel->get_where_row('student_dairy',array('status'=>1));
                                            if(empty($result->count)):
                                               
                                                $diaryCount  =   $this->CRUDModel->get_max_value('count','student_denotice',array('sd_id'=>$title->sd_id));
                                            
                                                if(!empty($diaryCount)):
                                                    $diaryNo  = $diaryCount->count+1;
                                                else:
                                                    $diaryNo = 1;
                                                endif;
                                                
                                                else:
                                                       
                                            $diaryNo =$result->count;
                                            endif;
 
                                                
                                            
                                            echo form_input(array(
                                                'name'          => 'title_count',
                                                 'value'        => $title->title.'/'.$diaryNo,
                                                 'type'          => 'text',
                                                 'class'         => 'form-control',
                                                 'disabled'     => 'disabled',
                                                'placeholder'   => 'Diary Number',    
                                                ));
                                            echo form_input(array(
                                                'name'          => 'dairyId',
                                                 'value'        => $title->sd_id,
                                                'type'          => 'hidden',
                                                 'class'         => 'form-control',
                                                'placeholder'   => 'Diary Number',    
                                                ));
                                            echo form_input(array(
                                                'name'          => 'dairyCount',
                                                 'value'        => $diaryNo,
                                                'type'          => 'hidden',
                                                 'class'        => 'form-control',
                                                'placeholder'   => 'Diary Number',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                      <?php
                                    endif;
                                    
                                    ?>
                                    </div>
                                     
                                     
                                      
                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-4 pull-right">
                                    <button type="submit" class="btn btn-theme" name="search" id="search"  value="Search" ><i class="fa fa-search"></i> Search</button>
                                    <?php
                                    if(!empty($result)):
                                        echo '<button type="submit" class="btn btn-theme" name="update" value="update"  ><i class="fa fa-recycle"></i> Updates</button>';
                                    endif;
                                    ?>
                                    
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
                        
                            <div class="row">
                                <?php
                                if(!empty($result)):
//                                    echo '<pre>';print_r($result);die;
                                    ?>
                                    <div id="div_print">
                                        
                                        <div class="col-md-12">
                                            <h5  align="left" >Ph: 091-5275154 - 5273021<br/>&nbsp; &nbsp;www.edwardes.edu.pk</h5>
                                            <br/>    
                                            <br/>    
                                            <br/>    
                                            <br/>    
                                        <h5  align="left" > Ref: <?php echo $result->title.'/'.$result->count;?></h5>
                                        <h5  align="left"> <?php  echo date('F j, Y', strtotime($pdate));?> </h5>
                                        
                                        <!--<h4 align="Right" style=" position: relative; bottom: 31px;"> Ref: DN/ 2016-17</h4>-->
                                        <h2 align="center" style="text-decoration: underline;">"D-Notice"</h2>
                                        <table width="100%" border="0">
                                            
                                               
                                                <tr>
                                              
                                                <td><strong>Mr/Ms&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $result->father_name;?> </strong> </td>
                                                </tr>
                                                <tr>
                                                 
                                                <td ><strong>Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo wordwrap($result->app_postal_address, 35, "</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", true); ;?> </strong> </td>
                                                </tr>
                                                <tr>
                                                
                                                <td ><strong>Phone&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $result->mobile_no.'/'.$result->mobile_no2;?></strong> </td>
                                                </tr>
                                            
                                                <tr>
                                                
                                                <td><br/>You are hereby notified through this notice that :<br/><br/></td>
                                                </tr>
                                                 <tr>
                                                
                                                <td><strong>Std Name&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $result->student_name;?> </strong> </td>
                                                </tr>
                                                <tr>
                                                
                                                <td ><strong>College # &nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $result->college_no;?> </strong> </td>
                                                 </tr>
                                                 <tr>
                                                
                                                <td><strong>Class&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $result->programe_name;?> </strong> </td>
                                                </tr>
                                                 <tr>
                                                <td><strong>Group&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $result->name.' ('.$result->batch_name.')' ;?> </strong> </td>
                                                
                                                 </tr>
                                               
                                                  <tr>
                                                
                                                      <td style=" text-align: justify;"><br/>has outstanding fee of Rs:- <strong><?php echo $result->amount;?> /-</strong> (Fee bill is enclosed)<br/><br/></td>
                                                </tr>
                                                  <tr>
                                                
                                                      <td>Please pay College dues on or before <strong><?php  echo date('F j, Y', strtotime($ddate));?></strong> otherwise his/her name will be struckoff the College rolls. Please note that in case of struckoff, a student wishing to re-join the College will be required to apply for re-admission and there by incur all administrative charges.<br/><br/></td>
                                                </tr>
                                                <tr>
                                                
                                                      <td><br/><br/>Thanking you.<br/><br/><br/><br/></td>
                                                </tr>
                                           
                                                
                                        </table>
                                             <div>
                                                 <h5 align="left">Sarfaraz Khan</h5>
                                                 <h5 align="left">Director Finance</h5>
<!--                                                 <h5 align="right" style=" position: relative; bottom: 53px; right: 123px;">Prof.Dr.Nayer Fardows</h5>
                                                 <h5 align="right" style=" position: relative; bottom: 53px; right: 206.3px; ">Principal </h5>-->
                                              </div>
                                          </div>
                                         </div>
                                <?php
                                endif;
                                ?>
                         
                                 </div>
 
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
 
    
    
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
                                                    $k = array_rand($class);
                                                     echo '<tr class="2nd">
                                                          <td>&nbsp;</td>
                                                            <td> '.$coacRow->fn_coa_m_code.'</td>

                                                            <td> &nbsp;&nbsp; &nbsp; &nbsp;'.$coacRow->fn_coa_m_title.'</td>


                                                        </tr>';
                                                $coacs = $this->CRUDModel->get_where_result('fn_coa_master_sub_child',array('fn_coa_mc_status'=>1,'fn_coa_mc_mId'=>$coacRow->fn_coa_m_cId));

                                                        foreach($coacs as $coacsRow):
                                                            
                                                             echo ' <tr class="recordFrom3rd '.$class[$k].'" id="'.$coacsRow->fn_coa_mc_title.','.$coacsRow->fn_coa_mc_id.','.$coacsRow->fn_coa_mc_code.'">
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
        <!--// Record To Tog--> 
   
     
     <script>
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 3,
        dateFormat: 'd-m-yy'
    });
  } );
  </script> 
  
  
   <script language="javascript">
function printdiv(printpage)
{
//var headstr = "<html><head><title></title></head><body>";
var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>