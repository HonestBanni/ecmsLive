<script language="javascript">
  function printdiv(printpage)
  {
//    var headstr = "<html><head><title></title></head><body>";
    var headstr = "<html><head><title></title></head><body><div><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
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
               <!-- ******BANNER****** -->
            <h2 align="left"><?php echo $ReportName?><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $ReportName?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form','id'=>'print_wise_form'));
                                  
                                     ?>
                                <div class="row">
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">Challan No</label>
                                         
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'Form',
                                                                'type'          => 'number',
                                                                'value'         => $Form,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Form #',
                                                                 )
                                                             );
                                                      ?>
                                         
                                            
                                     </div>
 
                                
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">Name</label>
                                        
                                           
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'student_name',
                                                                'type'          => 'text',
                                                                'value'         => $stdName,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Student Name',
                                                                 )
                                                             );
                                                      ?>
                                           
                                            
                                     </div>
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">Father Name</label>
                                         
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'father_name',
                                                                'type'          => 'text',
                                                                'value'         => $fatherName,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Father Name',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                 <div class="col-md-3">
                                    <label for="name">Program</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control" id="Programe"');
                                        ?>
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <label for="name">Batch</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('batch', $batch,$batch_id,  'class="form-control" id="batch_id"');
                                        ?>
                                    </div>
                                </div>   
                                <div class="col-md-3">
                                    <label for="name">Sub Program</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control" id="SubProgram"');
                                        ?>
                                    </div>
                                </div> 
                                
                                    <div class="col-md-3">
                                    <label for="name">Status</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('status_id', $student_status,$status_id,  'class="form-control"');
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <label for="name">Paid By</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('paid_by', $paid_by,$paid_by_id,  'class="form-control"');
                                        ?>
                                    </div>
                                </div> 
                                 
                               </div>
                               <div class="row">
                                   <div class="col-md-3 col-sm-5">
                                          <label for="name">Paid From </label>
                                            <?php
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'paid_from',
                                                            'type'          => 'text',
                                                            'value'         => $PaidFrom,
                                                            'class'         => 'form-control datepicker',
                                                            'placeholder'   => 'Paid From',
                                                             )
                                                         );
                                                  ?>
                                     </div>
                                   <div class="col-md-3 col-sm-5">
                                          <label for="name">Paid To </label>
                                            <?php
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'paid_to',
                                                            'type'          => 'text',
                                                            'value'         => $PaidTo,
                                                            'class'         => 'form-control datepicker',
                                                            'placeholder'   => 'Paid To',
                                                             )
                                                         );
                                                  ?>
                                     </div>
                               </div>
                             
                              
                           </div><!--//section-content-->
                                     
                                 
                            <div style="padding-top:1%;">
                                <div class="col-md-2 pull-left">
                                    <button type="button" class="btn btn-success" >Total Records:<?php if(!empty($count)): echo $count; endif;?></button>
                                  </div>
                             
                                <div class="col-md-4 pull-right">
                                    <button type="submit" class="btn btn-theme" name="studentWise" id="studentWise"  value="studentWise" ><i class="fa fa-search"></i> Student Wise</button>
                                    <button type="submit" class="btn btn-theme" name="dateWise" id="dateWise"  value="dateWise" ><i class="fa fa-search"></i> Date Wise</button>
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
                                    
                                  </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                       </section>
                   
                    <div id="div_print">
                        
                       <?php
                       if(!empty($result)):
                           if($report == 'StudentWise'):
                               
                          
                       ?> 
                        <h3 style="text-align: center;">Prospectus Fee Verification Report<br/>Student Wise<br/> From : <?php echo date('d-m-Y',strtotime($PaidFrom))?>  To :<?php echo date('d-m-Y',strtotime($PaidTo))?></h3>
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped" style="font-size:11px" width="100%">
                    <thead>
                        <tr>
                            <th width="5" style="vertical-align: text-bottom;">SN</th>
                            <th width="50" style="vertical-align: text-bottom;">Challan No</th>
                            <th width="100" style="vertical-align: text-bottom;">Student Name</th>
                            <th width="100" style="vertical-align: text-bottom;">F-Name</th>
                            <th width="110" style="vertical-align: text-bottom;">Sub Program</th>
                            <th width="50" style="vertical-align: text-bottom;">Amount</th>
                            <th width="50" style="vertical-align: text-bottom;">Status</th>
                            <th width="60" style="vertical-align: text-bottom;">Bank Paid Date</th>
                            <th width="10" style="vertical-align: text-bottom;">Paid By</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sn= ''; 
                        $total= ''; 
                        foreach($result as $rec):
//                            echo '<pre>';print_r($rec);die;
//                            $education_details = $this->CRUDModel->get_where_row('applicant_edu_detail',array('student_id'=>$rec->student_id));
                            $sn++;
                            $amount = $rec->pros_amount;
                                echo '<tr class="gradeA Student'.$rec->student_id.'" >';
                                echo '<td><i>'.$sn.'</i></td>';
                                echo '<td>'.$rec->form_no.'</td>';
                                echo '<td>'.wordwrap($rec->student_name, 20, "\n", true).'</td>';
                                echo '<td>'.wordwrap($rec->father_name, 20, "\n", true).'</td>';
                                echo '<td>'.$rec->sub_program.'</td>';
                                
                                if($rec->staffChild_flag == 2):
                                echo '<td>'.$amount.'</td>';    
                                   $total += $amount; 
                                    else:
                                     
                                 echo '<td><strong>Staff Child</strong></td>';       
                                endif;
                                echo '<td>'.$rec->status.'</td>';
                                echo '<td>'.date('d-m-Y',strtotime($rec->paid_date)).'</td>';
                                echo '<td>'.$rec->emp_name.'</td>'; 
                                echo '</tr>';   
                                   
                        endforeach;
                        echo '<tr class="gradeA">
                            <td colspan="4"></td>
                            <td>Total Amount</td>
                            <td>'.$total.'</td>
                            <td colspan="2"></td>
                            </tr>';
                            endif;
                         
                            if($report == 'DateWise'):
                               
                          
                       ?> 
                        <h3 style="text-align: center;">Prospectus Fee Verification Report<br/>Date Wise<br/> From : <?php echo date('d-m-Y',strtotime($PaidFrom))?>  To :<?php echo date('d-m-Y',strtotime($PaidTo))?></h3>
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped" style="font-size:11px" width="100%">
                    <thead>
                        <tr>
                            <th width="5" style="vertical-align: text-bottom;">SN</th>
                            <th width="50" style="vertical-align: text-bottom;">Date</th>
                            <th width="50" style="vertical-align: text-bottom;">Total Students</th>
                            <th width="50" style="vertical-align: text-bottom;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sn= ''; 
                        $total= ''; 
                        foreach($result as $rec):

                            $sn++;
                             
                                echo '<tr class="gradeA" >';
                                echo '<td><i>'.$sn.'</i></td>';
                                echo '<td>'.date('d-m-Y',strtotime($rec->paid_date)).'</td>';
                                echo '<td>'.$rec->TotalStudents.'</td>';
                                echo '<td>'.$rec->Amount.'</td>';
                                echo '</tr>';   
                                $total +=$rec->Amount;
                                
                                   
                        endforeach;
                        echo '<tr class="gradeA">
                            <td></td>
                            <td>Total Amount</td>
                            <td></td>
                            <td>'.$total.'</td>
                          
                            </tr>';
                            endif;
                        endif;
                     ?>
                        </tbody>
                </table>    
                        </div> 
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
        
        <script>
  jQuery(document).ready(function(){
      
      
        jQuery('#Programe').on('click',function(){
    var programId = jQuery('#Programe').val();
    
       //get sub program
       jQuery.ajax({
        type   :'post',
        url    :'DDSubPrograms',
        data   :{'programId':programId},
        success :function(result){
           jQuery('#SubProgram').html(result);
       },
       complete:function(){
           //Get Batch 
           jQuery.ajax({
               type   :'post',
               url    :'DDBatch',
               data   :{'programId':programId},
              success :function(result){
                  console.log(result);
                 jQuery('#batch_id').html(result);
              }
           });
           
             
       }
       
    });
    
}); 
    jQuery('#SubProgram').on('change',function(){
   
   var sub_program_id   = jQuery('#SubProgram').val();
    var programId       = jQuery('#Programe').val();
    jQuery.ajax({
        type   :'post',
        url    :'DDSections',
        data   :{'sub_program_id':sub_program_id,'programId':programId},
       success :function(result){
           console.log(result);
          jQuery('#Sections').html(result);
       }
    });
}); 
      
      
      
      
        $(function() {
            $('.datepicker').datepicker( {
               changeMonth: true,
                changeYear: true,
                 dateFormat: 'dd-mm-yy'
           
            });
        });
 
 
  });
 
  </script>