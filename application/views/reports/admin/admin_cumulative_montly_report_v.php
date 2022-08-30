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
    <!-- ******BANNER****** -->
    <h2 align="left"><?php echo $HeaderPage; ?><hr></h2>
    <div class="row cols-wrapper">
        <div class="col-md-12">    
            <form method="post">
                <div class="form-group col-md-2">
                <?php    
                    if(!empty($student_id)){
                    $empres = $this->AttendanceModel->get_by_id('student_record',array('student_id'=>$student_id));
                    foreach($empres as $emprec) { ?>          

                    <input type="text" name="student_id" value="<?php echo $emprec->student_name; ?>" placeholder="Student" class="form-control" id="students_admin">
                    <input type="hidden" name="student_id" id="student_id" value="<?php echo $emprec->student_id; ?>">      
                    <?php } } else { ?>
                    <input type="text" name="student_id" placeholder="Student" class="form-control" id="students_admin">
                    <input type="hidden" name="student_id" id="student_id">    
                    <?php } ?>                  
                </div>

                <input type="submit" name="search" class="btn btn-theme" value="Search">
                <button type="button" name="print" class="btn btn-theme" onClick="printdiv('div_print');">Print</button>
            </form>
        </div>
    </div>
    <div class="col-md-12">
        <div class="table-responsive">
            <div id="div_print"> 
                <h3 align="center">Student Previous Attendance and Marks History</h3>
     
                <?php if($Result):
                    
                    ?>
                        <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td >  
                                            <div class="profilepicture">
                                                <img src="assets/images/monogram.png" style=" height: 117px;  margin-left: 24px;">
                                            </div>
                                        
                                        </td>
                                        <td  >
                                            <strong> 
                                             <br/>
                                            <?php  
                                          echo  strtoupper($Result[0]->student_name);
                                            
                                               ?>
                                            <br/>  <br/>
                                             <?php  if($Result[0]->gender_id ==1):
                                            echo 'S/O';
                                            else:
                                            echo 'D/O';
                                        endif; ?>
                                            <br/>  <br/>
                                            <?php  echo strtoupper($Result[0]->father_name); ?>
                                          </strong>  
                                        </td>
                                     
                                   
                                        <td  >
                                            <br/>
                                                <strong>College # <?php  echo $Result[0]->college_no; ?></strong>
                                            <br/><br/>
                                                <strong>Date of Adm: <?php  echo date('d-m-Y',strtotime($Result[0]->admission_date)); ?></strong>
                                            <br/><br/>
                                        </td>
                                        <td  >
                                           <div class="profilepicture">
                                                <img src="assets/images/students/<?php 
                                                $image = '';
                                                if($Result[0]->applicant_image):
                                                    $image= $Result[0]->applicant_image;
                                                else:
                                                    $image = 'user.png';
                                                endif;
                                                echo $image?>" style=" height: 117px;  margin-left: 24px; border-radius:10px">
                                            </div>
                                        </td>
                                     
                                    </tr>
                                     
                                     
                                </tbody>
                            </table>
                <hr>
                        
                        <?php
                    
                    
                    
                    foreach($Result as $row):
                    ?>
                        
                        <table class="table table-hover table-boxed">
                            <thead>
                                    <tr>
                                      
                                        <th><strong>Program</strong></th>
                                        <th><strong><?php echo  $row->program; ?></strong></th>
                                        <th><strong>Sub Program </strong></th>
                                        <th><strong><?php echo  $row->sub_program; ?></strong></th>
                                        <th><strong>Section</strong></th>
                                        <th><strong><?php echo  $row->section_name; ?></strong></th>
                                        
                                          
                                    </tr>
                                <thead>
                            </table>
                        
                        
                        
                        
                        
                        
                        <?php
                    
                         $where_details = array(
                                'student_id'  =>$row->student_id,
                                'program_id'  =>$row->programe_id,
                                'sub_pro_id'  =>$row->sub_pro_id,

                              );
                                    $this->db->select("DATE_FORMAT(att_month_year, '%b-%y') as att_month_year");
                                    $this->db->group_by('MONTH(att_month_year)');
                                    $this->db->order_by('MONTH(att_month_year)','asc');
                  $month_deails =   $this->db->get_where('students_cumulative_montly',$where_details)->result();
                        echo '<table class="table table-hover table-boxed table-bordered">
                                <thead>';
                                 
                                if($month_deails):
                                    echo '<tr>';
                                    echo '<th width="150px"> Subjects</th>';
                                    $months = 1;
                                    foreach($month_deails as $mRow):
                                        echo '<th>'.$mRow->att_month_year.'</th>';
                                        $months ++;
                                    endforeach;
                                         echo '<th>Total</th>';
                                  echo '</tr>  
                                      </thead>
                                    <tbody>';
                                endif;
                                $where_subject = array(
                                    'student_id'  =>$row->student_id,
                                    'program_id'  =>$row->programe_id,
                                    'students_cumulative_montly.sub_pro_id'  =>$row->sub_pro_id,
                                );
                                                $this->db->group_by('subject.subject_id');
                                                $this->db->order_by('subject.title','asc');
                                                $this->db->join('subject','subject.subject_id=students_cumulative_montly.subject_id');
                            $subject_deails =   $this->db->get_where('students_cumulative_montly',$where_subject)->result();  
                                $gtotal_t = '';
                                $gtotal_p = '';
                                
                                foreach($subject_deails as $sdRow):
//                                    echo '<pre>';print_r($subject_deails);die;
                                    echo '<tr>';
                                    echo '<td>'.$sdRow->title.'</td>';
                                    
                                        $where_details = array(
                                        'student_id'  =>$row->student_id,
                                        'program_id'  =>$row->programe_id,
                                        'sub_pro_id'  =>$row->sub_pro_id,


                                      );
                                            $this->db->select("DATE_FORMAT(att_month_year, '%b-%y') as att_month_year,total_classes,present,absent");
                                            $this->db->group_by('MONTH(att_month_year)');
                                            $this->db->order_by('MONTH(att_month_year)','asc');
                          $month_deails_s =   $this->db->get_where('students_cumulative_montly',$where_details)->result();
                                    $total_t = '';
                                    $total_p = '';
                                   
                                     foreach($month_deails_s as $monthDet):
                                         
                                         $attDetails = array(
                                                'student_id'            => $row->student_id,
                                                'program_id'            => $row->programe_id,
//                                                'sub_pro_id'            => $row->sub_pro_id, 
                                                'subject_id'            => $sdRow->subject_id, 
                                                'att_month_year'        => date('Y-m-d',strtotime('1-'.$monthDet->att_month_year)), 
                                         );
                                         $att = $this->db->get_where('students_cumulative_montly',$attDetails)->row();
                                         if(!empty($att)):
                                             $total_t += $att->total_classes;
                                             $total_p += $att->present;
                                            echo '<td>'.$att->present.' / '.$att->total_classes.'</td>';
                                             else:
                                           echo '<td>0 / 0</td>';  
                                         endif;
                                         
                                     endforeach;
                                          
                                     if($total_t == 0):
                                         $per = 0;
                                         else:
                                         $per = $total_p/$total_t*100;
                                     endif;
                                     
                                     echo '<td>'.$total_p.' / '.$total_t.' = '.round($per,2).' %</td>'; 
                                    echo '</tr>';
                                    $gtotal_t += $total_t;
                                    $gtotal_p += $total_p;
                                endforeach;
                               $gper = '';
                                if($gtotal_t == 0):
                                         $gper = 0;
                                         else:
                                         $gper = $gtotal_p/$gtotal_t*100;
                                     endif;
                                echo '<tr>';
                                
                                echo '<td colspan="'.$months.'">Total</td>';
                                echo '<td >'.$gtotal_p.' / '.$gtotal_t.' = '.round($gper,2).' %</td>'; 
                                echo '</tr>';
                                
                            echo '</tbody>
                             </table> <hr>';
                    endforeach;
                 endif;  
//                   echo '<pre>';print_r($Result);die;
                    ?>
                        
        </div>
    </div><!--//col-md-3-->
</div><!--//cols-wrapper-->
</div><!--//cols-wrapper-->
           
<script>
    jQuery(document).ready(function(){
        jQuery("#students_admin").autocomplete({  
        minLength: 0,
        source: "ReportsController/auto_students_admin/"+$("#students_admin").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#students_admin").val(ui.item.contactPerson);
        jQuery("#student_id").val(ui.item.id);
        jQuery("#college_no").val(ui.item.college_no);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
     });
</script>