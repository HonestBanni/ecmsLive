<style>

.report_header{
    display: none !important;
}
 
</style>

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
<!--                                <div class="col-md-2 col-sm-5">
                                      <label for="name">Challan #</label>

                                       <div class="input-group" id="adv-search">
                                            <?php
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'challan_no',
                                                            'type'          => 'number',
                                                            'value'         => $challan_no,
                                                            'class'         => 'form-control',
                                                            'placeholder'   => 'Challan #',
                                                             )
                                                         );
                                                  ?>
                                          </div>

                                 </div>-->
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
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Report Type</label>
                                        
                                            <?php
                                           
                                             echo form_dropdown('reprot_type_name', $report_type,$rType_id,  'class="form-control" ');
                                            
                                            ?>
                                            
                                     </div>
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
<!--                                <div class="col-md-2">
                                    <label for="name">Payment Category</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('pc_id', $pc,$pc_id,  'class="form-control payment_cat" id="pc_id"');
                                        ?>
                                    </div>
                                </div> -->
                                <div class="col-md-2">
                                    <label for="name">Student Status</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('std_status', $student_status,$student_status_id,  'class="form-control" ');
                                        ?>
                                    </div>
                                </div> 
                               
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Amount</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                     echo  form_input(
                                                             array(
                                                                'name'          => 'amount',
                                                                'type'          => 'number',
                                                                'value'         => $amount,
                                                                'class'         => 'form-control ',
                                                                
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                
                                 
                            </div>
                              
                           </div><!--//section-content-->
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-search"></i> Search</button>
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>    
<!--<button type="button" class="btn btn-theme"   id="printChallan"  value="printChallan" ><i class="fa fa-print"></i> Print</button>-->
                                    <button type="reset" class="btn btn-theme"  id="save"> Reset</button> 
     
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                        
                        
                        
                    </section>
              
          
                             <?php
//                               <img style="float: right; padding-right: 79px;"  class="img-responsive" src="assets/images/logo-black.png" > 
                        
                   if(!empty($result)):                      
        
        echo ' <div class="row">
              <div class="col-md-12 ">';
                                        
                        
                                echo '<div id="div_print">
                                        
                                    <div class="report_header">
                                 
                                    <h3 class="text-highlight" style=" text-align: center">Student Defaulter List</h3>

                                  </div>
                                    <h3 class="has-divider text-highlight">Result :'; echo count($result); echo '</h3>
                                         
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
                                                          <th>Batch</th>
                                                          <th>Amount</th>
                                                         <th>Attent %</th>
                                                         <th>Marks %</th>
                                                         
                                                          

                                                      </tr>
                                                    </thead>
                                                    <tbody>';

                                                        $sn = "";
                                                            $gTotal = ''; 
                                                          foreach($result as $row):
                                                              $sn++;
                                                        
                                                           echo '<tr>
                                                                <td>'.$sn.'</td>
                                                                
                                                                <td>'.$row->form_no.'</td>
                                                                <td>'.$row->college_no.'</td>
                                                                <td>'.substr($row->student_name, 0, 15).'</td>
                                                                 
                                                                <td>'.$row->father_name.'</td>
                                                                <td>'.$row->student_status.'</td>';
                                                               $group = ''; 
                                                           
                                                                          $this->db->join('sections','sections.sec_id=student_promotion_alumni_details.sec_id');  
                                                               $section = $this->db->get_where('student_promotion_alumni_details',array('student_promotion_alumni_details.sub_pro_id'=>$row->sub_pro_id,'student_id'=>$row->student_id))->row();
//                                                                   echo '<pre>';print_r($section);die;
//                                                                   echo '<pre>';print_r($row);die;
                                                           if($row->Group):
                                                               $group = $row->Group;
                                                               else:
                                                                  if($section):
                                                                      $group = $section->name;
                                                                  endif; 
                                                               
//                                                                   $group = ''; 
                                                           endif;
                                                           
                                                                echo '<td>'.$row->sub_program.' ('.$group.')</td>
                                                                <td>'.$row->prospectus_batch.'</td> 
                                                                <td>'.$row->balance.'</td>
                                                                <td>'.$row->attendance.' %</td>
                                                                <td>'.$row->marks.' %</td>    
                                                                        ';
                                                                 
                                                                 
                                                              echo '  </tr>';
                                                         $gTotal += $row->balance;
                                                          endforeach;      
                                                          echo '<tr>
                                                                <td> </td>
                                                                
                                                                <td> </td>
                                                                <td></td>
                                                                <td></td>
                                                                 
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>Total</td>
                                                                 <td></td>
                                                                <td>'.$gTotal.'</td><td></td><td></td>';
                                                                 
                                                                 
                                                              echo '  </tr>';

                                                      

                                                    echo'</tbody>
                                            </table>
                                         ';
                                          
                                 echo $print_log;
                                    
                                    echo '</div>
                                    </div>
                                  
                                </div>';
                                  endif;
                             
                             ?>
                                  
                                </div>
 
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 
 
   
   
 
     
  
 
    
    
    