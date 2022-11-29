 

<script language="javascript">
  function printdiv(printpage)
  {
//    var headstr = "<html><head><title></title></head><body>";
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
                                      <label for="name">Form #</label>

                                       <div class="input-group" id="adv-search">
                                            <?php
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'form_no',
                                                            'type'          => 'text',
                                                            'value'         => $form_no,
                                                            'class'         => 'form-control',
                                                            'placeholder'   => 'Form No #',
                                                             )
                                                         );
                                                  ?>
                                          </div>

                                 </div>

                                <div class="col-md-2 col-sm-5">
                                          <label for="name">College #</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'collegeNo',
                                                                'type'          => 'number',
                                                                'value'         => $collegeNo,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'College #',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Name</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'stdName',
                                                                'type'          => 'text',
                                                                'value'         => $stdName,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Student Name',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Father Name</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'fatherName',
                                                                'type'          => 'text',
                                                                'value'         => $fatherName,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Father Name',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                    <div class="col-md-2">
                                    <label for="name">Gender</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('gender', $gender,$gender_id,  'class="form-control" ');
                                        ?>
                                    </div>
                                </div> 
<!--                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Report Type</label>
                                        
                                            <?php
                                           
                                               form_dropdown('reprot_type_name', $report_type,$rType_id,  'class="form-control" ');
                                            
                                            ?>
                                            
                                     </div>-->
                                        </div>
                            <div class="row">   
                                <div class="col-md-2">
                                    <label for="name">Program</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control programe_id" id="feeProgrameId"');
                                        ?>
                                    </div>
                                </div>
                                
                         
                                <div class="col-md-2">
                                    <label for="name">Sub Program</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control sub_pro_id" id="showFeeSubPro"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="name">Batch</label>
                                    <div class="form-group ">
                                        <?php
                                            
                                            echo form_dropdown('batch_id', $batch_name,$batch_id,'class="form-control  " id="batch_id"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="name">Section</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('section', $section,$sec_id,  'class="form-control section" id="showSections"');
                                        ?>
                                    </div>
                                </div> 

                                <div class="col-md-2">
                                    <label for="name">Student Status</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('std_status', $student_status,$student_status_id,  'class="form-control" ');
                                        ?>
                                    </div>
                                </div> 
                               
                                 
                                
                                 
                            </div>
                              
                           </div><!--//section-content-->
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-12 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="netReceivableAll" id="netReceivableAll"  value="netReceivableAll" ><i class="fa fa-search"></i> Std Search All</button>
                                    <button type="submit" class="btn btn-theme" name="netReceivableAllNew" id="netReceivableAllNew"  value="netReceivableAllNew" >Std All Excel</button>
                                    <button type="submit" class="btn btn-theme" name="netReceivableCollegeHostel" id="netReceivableCollegeHostel"  value="netReceivableCollegeHostel" ><i class="fa fa-search"></i> Std College & Hostel</button>
                                    <button type="submit" class="btn btn-theme" name="netReceivableMess" id="netReceivableMess"  value="netReceivableMess" ><i class="fa fa-search"></i> Std Mess</button>
                                    <button type="submit" class="btn btn-theme" name="programwise" id="programwise"  value="programwise" ><i class="fa fa-search"></i>  Head Wise All</button>
                                    <button type="submit" class="btn btn-theme" name="programwiseCollege" id="programwiseCollege"  value="programwiseCollege" ><i class="fa fa-search"></i> Head College</button>
                                    <button type="submit" class="btn btn-theme" name="programwiseHostel" id="programwiseHostel"  value="programwiseHostel" ><i class="fa fa-search"></i> Head Hostel</button>
                                    <button type="submit" class="btn btn-theme" name="programwiseMess" id="programwiseMess"  value="programwiseMess" ><i class="fa fa-search"></i> Head Mess</button>
                                    <!--<button type="submit" class="btn btn-theme" name="student_head_wise" id="student_head_wise"  value="student_head_wise" ><i class="fa fa-search"></i> Student Head Wise</button>-->
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>    
                                    <!--<button type="button" class="btn btn-theme"   id="printChallan"  value="printChallan" ><i class="fa fa-print"></i> Print</button>-->
                                     
     
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                     </section>
              
          <div id="div_print">
                             <?php
                             
                        
                   if(!empty($result)): ?>                      
        
                        <div class="row">
                             
                            <div class="col-md-12 ">
                                
                                    <h3 class="has-divider text-highlight">Result :;<?php echo count($result); ?></h3>
                                        
                                              <table class="table table-hover" id="table" style="font-size:11px">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Form#</th>
                                                         
                                                          <th>College#</th>
                                                          
                                                          <th>Student Name</th>
                                                          <th>Father Name</th>
                                                          <th>Std Status</th>
                                                          <th>Class</th>
                                                       </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = "";
                                                            $gTotal = ''; 
                                                           
                                                          foreach($result as $row):
                                                              $sn++;
                                                        
                                                           echo '<tr>
                                                                <td style="border-bottom:1px solid #000000;">'.$sn.'</td>
                                                                
                                                                <td style="border-bottom:1px solid #000000;">'.$row->form_no.'</td>
                                                                <td style="border-bottom:1px solid #000000;">'.$row->college_no.'</td>
                                                                <td style="border-bottom:1px solid #000000;"> '.substr($row->student_name, 0, 15).'</td>
                                                                 
                                                                <td style="border-bottom:1px solid #000000;">'.$row->father_name.'</td>
                                                                <td style="border-bottom:1px solid #000000;">'.$row->student_status.'</td>
                                                                <td style="border-bottom:1px solid #000000;">'.$row->sub_program.'('.$row->Group.')</td>
                                                                </tr>';
                                                              
                                                          
                                                             $total = '';    
                                                            foreach($row->Head_details as $feeDetails):
                                                                 
                                                                   echo '<tr>';
                                                                    echo '<td style="border-top:1px solid #fffefe;"></td>';
                                                                    echo '<td style="border-top:1px solid #fffefe;"></td>';
                                                                    echo '<td>'.$feeDetails->Head_title.'</td>
                                                                        <td>'.$feeDetails->balance.'</td>';
                                                                    echo '<td style="border-top:1px solid #fffefe;"></td>';
                                                                    echo '<td style="border-top:1px solid #fffefe;"></td>';
                                                                    echo '<td style="border-top:1px solid #fffefe;"></td>';
                                                                echo '  </tr>'; 
                                                                $total +=$feeDetails->balance; 
                                                             
                                                                
                                                            endforeach;
                                                            
                                                               echo '<tr>';
                                                                    echo '<td style="border-top:0px solid #fffefe;"></td>';
                                                                    echo '<td style="border-top:0px solid #fffefe;"></td>';
                                                                    echo '<td>Total</td>
                                                                        <td>'.$total.'</td>';
                                                                    echo '<td style="border-top:0px solid #fffefe;"></td>';
                                                                    echo '<td style="border-top:0px solid #fffefe;"></td>';
                                                                    echo '<td style="border-top:0px solid #fffefe;"></td>';
                                                                echo '  </tr>';
                                                         $gTotal += $total;
                                                          endforeach;  ?>    
                                                           <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td>Grand Total</td>
                                                                <td><?php echo  $gTotal; ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                   
                                                             </tr> 

                                                      

                                                     </tbody>
                                            </table>
                            </div>
                            
                                  
                              
                             <?php     endif;
                             
                             ?>
                             <?php
                             
                        
                   if(!empty($result_program_wise)):                      
        
        echo ' <div class="row">
              <div class="col-md-8 col-md-offset-2 ">';
                                        
                        
                                echo ' 
                                     
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table" style="font-size:11px">
                                                    <thead>
                                                      <tr>

                                                            <th>#</th>
                                                            <th>Program</th>
                                                            <th>Fee Head</th>
                                                            <th>Amount</th>
                                                            <th> </th>
                                                            <th> </th>
                                                            <th></th>
                                                       </tr>
                                                    </thead>
                                                    <tbody>';

                                                        $sn = "";
                                                            $gTotal = ''; 
                                                           
                                                          foreach($result_program_wise as $row):
                                                              $sn++;
                                                        
                                                           echo '<tr>
                                                                <td style="border-bottom:1px solid #000000;">'.$sn.'</td>
                                                                
                                                                <td style="border-bottom:1px solid #000000;">'.$row->program_name.'</td>
                                                                <td style="border-bottom:1px solid #000000;"></td>
                                                                <td style="border-bottom:1px solid #000000;"> </td>
                                                                 
                                                                <td style="border-bottom:1px solid #000000;"></td>
                                                                <td style="border-bottom:1px solid #000000;"></td>
                                                                <td style="border-bottom:1px solid #000000;"></td>
                                                                </tr>';
                                                              
                                                          
                                                             $total = '';    
                                                            foreach($row->Fee_details as $feeDetails):
                                                                 
                                                                   echo '<tr>';
                                                                    echo '<td style="border-top:1px solid #fffefe;"></td>';
                                                                    echo '<td style="border-top:1px solid #fffefe;"></td>';
                                                                    echo '<td>'.$feeDetails->Fee_head.'</td>
                                                                        <td>'.$feeDetails->balance.'</td>';
                                                                    echo '<td style="border-top:1px solid #fffefe;"></td>';
                                                                    echo '<td style="border-top:1px solid #fffefe;"></td>';
                                                                    echo '<td style="border-top:1px solid #fffefe;"></td>';
                                                                echo '  </tr>'; 
                                                                $total +=$feeDetails->balance; 
                                                             
                                                                
                                                            endforeach;
                                                            
                                                               echo '<tr>';
                                                                    echo '<td style="border-top:0px solid #fffefe;"></td>';
                                                                    echo '<td style="border-top:0px solid #fffefe;"></td>';
                                                                    echo '<td><strong>Total</strong></td>
                                                                        <td><strong>'.$total.'</strong></td>';
                                                                    echo '<td style="border-top:0px solid #fffefe;"></td>';
                                                                    echo '<td style="border-top:0px solid #fffefe;"></td>';
                                                                    echo '<td style="border-top:0px solid #fffefe;"></td>';
                                                                echo '  </tr>';
                                                         $gTotal += $total;
                                                          endforeach;      
                                                          echo '<tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td><strong>Grand Total</strong></td>
                                                                <td><strong>'.$gTotal.'</strong></td>
                                                                <td></td>
                                                                <td></td>
                                                                  ';
                                                                 
                                                                 
                                                              echo '  </tr>';

                                                      

                                                    echo'</tbody>
                                            </table>
                                        </div>';
                                          
                                 
                                    
                                    echo ' 
                                    </div>
                                  
                                </div>';
                                  endif;
                             
                             ?>
                            <?php echo $print_log;?>       
                            </div>
                            </div>
         
          </div>
          
        </div> 
        </div>
      </div>
                   </div>
                
  
      
        <!--//page-row-->
<!--       
      </div>-->
 
    <!--//page-wrapper--> 
 
   
   
 
     
  
 