<style>

.report_header{
    display: none !important;
}
 
</style>
 
 
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
                                <div class="col-md-2">
                                    <label for="name">Program</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control programe_id" id="feeProgrameId"');
                                        ?>
                                    </div>
                                </div>

                                        </div>
                            <div class="row">   
                                
                                
                         
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
                                <div class="col-md-3 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-search"></i> Search</button>
                                    <a href="NewDeNoties"  class="btn btn-theme"><i class="fa fa-plus"></i> New D-Notice</a>    
                                    
     
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                    </section>
              
          
                             <?php
                    if(!empty($result)):                      
                    echo ' <div class="row">
                            <div class="col-md-12 ">';
                                echo '<div id="div_print">
                                    <div class="report_header">
                                        <h3 class="text-highlight" style=" text-align: center">D-Notice Defaulter List</h3>
                                    </div>
                                    <h3 class="has-divider text-highlight">Result :'; echo count($result); echo '</h3>
                                         
                                              <table class="table table-hover" id="table" style="font-size:11px">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>College</th>
                                                          <th>Student Name</th>
                                                          <th>Father Name</th>
                                                          <th>Class</th>
                                                          <th>Batch</th>
                                                          <th>Due-Amt</th>
                                                          <th>Issue-Date</th>
                                                          <th>Due-Date</th>
                                                           
                                                         <th>Print</th>
                                                         <th>Edit</th>
                                                         
                                                          

                                                      </tr>
                                                    </thead>
                                                    <tbody>';

                                                        $sn = "";
                                                        $gTotalDue = ''; 
                                                        $gTotalPaid = ''; 
                                                        $gTotalBalanace = ''; 
                                                          foreach($result as $row):
                                                              
                                                              $sn++;
                                                        
                                                           echo '<tr>
                                                                <td>'.$sn.'</td>
                                                                <td>'.$row->college_no.'</td>
                                                                <td>'.substr($row->student_name, 0, 15).'</td>
                                                                <td>'.$row->father_name.'</td>';
                                                               $group = ''; 
                                                           
                                                                          $this->db->join('sections','sections.sec_id=student_promotion_alumni_details.sec_id');  
                                                               $section = $this->db->get_where('student_promotion_alumni_details',array('student_promotion_alumni_details.sub_pro_id'=>$row->sub_pro_id,'student_id'=>$row->student_id))->row();
                                                                   
//                                                                                    $this->db->order_by('fc_challan_id','desc');
                                                                                   
                                                               
                                                               
                                                           if($row->Group):
                                                               $group = $row->Group;
                                                               else:
                                                                  if($section):
                                                                      $group = $section->name;
                                                                  endif; 
                                                               
//                                                                   $group = ''; 
                                                           endif;
                                                           $amountpaid = '';
                                                            if(empty($last_paid_challan)):
                                                                $amountpaid = '';
                                                                else:
                                                                $amountpaid = $last_paid_challan->paidAmount;
                                                            endif;
                                                            echo '<td>'.$row->sub_program.' ('.$group.')</td>
                                                                <td>'.$row->prospectus_batch.'</td> 
                                                                <td>'.$row->noticeAmount.'</td>
                                                                ';
                                                                echo '<td>'.Date('d-m-Y',strtotime($row->print_date)).'</td>';                   
                                                                echo '<td>'.Date('d-m-Y',strtotime($row->due_date)).'</td>';                   
                                                                echo '   
                                                                <td><a href="PrintDeNoties/'.$row->dn_id.'" target="_blank" ><i class="fa fa-print"></i></a></td>    
                                                                <td>   
                                                                <a href="EditDeNoties/'.$row->dn_id.'" target="_blank" ><i class="fa fa-book"></i></a></td>    
                                                                        ';
                                                              echo '</tr>';
                                                                    
                                                          endforeach;      
                                                          
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
            </div>
 
<script>

    $( function() {
    $( ".datepicker" ).datepicker({
         changeMonth: true,
        changeYear: true,
         dateFormat: 'dd-mm-yy'
    });
  } );
</script>
   
   
 
     
  
 
    
    
    