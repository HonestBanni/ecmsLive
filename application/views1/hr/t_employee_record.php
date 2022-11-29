<script language="javascript">
function printdiv(printpage)
{
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
        <div class="content container">
               <!-- ******BANNER****** -->
            <div class="row cols-wrapper">
                <div class="col-md-12" style="min-height:450px;">
                    
                    <form method="post"> 
        <div class="form-group col-md-2">
            <?php 
                echo form_dropdown('contract_type_id', $contract, $contract_type_id,  'class="form-control"');
            ?>
        </div>
        <div class="form-group col-md-2">
            <?php 
                echo form_dropdown('cat_id', $category, $cat_id,  'class="form-control"');
            ?>
        </div>                
        
        <input type="submit" name="search" value="Search" class="btn btn-theme">                
        <input type="submit" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme">                
                    </form>
            <div id="div_print">
                <hr>
              <?php if(@$result):?>  
            <h3 align="center">(<?php if(@$cat): echo $cat->title; endif;?> - <?php if(@$cont): echo $cont->title; endif;?>)</h3>
                    <table class="table table-boxed table-striped table-bordered">
                    <thead>
                        <tr style="font-size:11px;">
                            <th>S.N</th>
                            <th>Picture</th>
                            <th width="120">Name</th>
                            <th width="100">Designation</th>
                            <th width="100">Department</th>
                            <th width="70">Birth</th>
                            <th width="70">Appointment</th>
                            <th width="70">Retirement</th>
                            <th>BPS</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$s = 1;                        
foreach($result as $rec)  
{  
  $picture = $rec->picture;
        $dob = $rec->dob;
        if($dob === '0000-00-00' || $dob == '' || $dob == '1970-01-01'){
            $dob = '';
        } else {
            $dob = date("d-m-Y", strtotime($dob));
        }
    
        $date = $rec->joining_date;
        if($date === '0000-00-00' || $date == '' || $date == '1970-01-01'){
            $date = '';
        } else {
            $date = date("d-m-Y", strtotime($date));
        }
    
    $date1 = $rec->retirement_date;
        if($date1 === '0000-00-00' || $date1 == '' || $date1 == '1970-01-01'){
            $date1 = '';
        } else {
            $date1 = date("d-m-Y", strtotime($date1));
        }
    ?>
                <tr class="gradeA"  style="font-size:11px;">
                    <td><?php echo $s;?></td>
                            <td><?php
                    if($picture == "")
                    {?>
        <img src="assets/images/students/user.png" width="60" height="50">
                    <?php
                    }else
                    {?>
    <img src="assets/images/employee/<?php echo $rec->picture;?>" style="border-radius:10px;" width="60" height="50">
                <?php 
                    }
                    ?></td>
                    <td><?php echo $rec->emp_name;?></td>
                    <td><?php echo $rec->cdesignation;?></td>
                    <td><?php echo $rec->department;?></td>
                    <td><?php echo $dob;?></td>
                    <td><?php echo $date;?></td>
                    <td><?php echo $date1;?></td>
                    <td><?php echo $rec->cscale;?></td>
                    <td><?php
                        $where = array('hr_emp_education.emp_id'=>$rec->emp_id);
                        $res = $this->HrModel->hr_edu_record($where);    
                        if($res):
                        ?>
                        <table class="table table-boxed">
                    <thead>
                        
                        <tr><th colspan="6">Academic Details</th></tr>
                        <tr>
                            <td><strong>S.N</strong></td>
                            <td><strong>Degree</strong></td>
                            <td><strong>Institute</strong></td>
                            <td><strong>Year</strong></td>
                            <td><strong>CGPA</strong></td>
                            <td><strong>Div</strong></td>
                        </tr>
                    </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        foreach($res as $eRow):
                           echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$eRow->Degreetitle.'</td>';
                            echo '<td>'.$eRow->bordTitle.'</td>';
                            echo '<td>'.$eRow->passing_year.'</td>';
                            echo '<td>'.$eRow->cgpa.'</td>';
                            echo '<td>'.$eRow->divisiontitle.'</td>';
                           echo '</tr>';
                        $i++;
                        endforeach;
                        ?>   
                        </tbody></table>
                        <?php  
                        endif;
                        $where = array('hr_professional_edu.emp_id'=>$rec->emp_id);
                        $prof = $this->CRUDModel->get_where_result('hr_professional_edu',$where);    
                        if($prof):
                        ?>
                    <table class="table table-boxed">
                    <thead>

                        <tr><th colspan="4">Professional Courses</th></tr>
                        <tr>
                            <td><strong>S.N</strong></td>
                            <td><strong>Course Name</strong></td>
                            <td><strong>Institute</strong></td>
                            <td><strong>Qualified</strong></td>
                        </tr>
                    </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        foreach($prof as $fRow):
                           echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$fRow->title.'</td>';
                            echo '<td>'.$fRow->aff_institute.'</td>';
                            echo '<td>Yes</td>';
                           echo '</tr>';
                        $i++;
                        endforeach;
                        ?>   
                        </tbody></table>
                        <?php  
                        endif;
                        $where = array('hr_research_paper.emp_id'=>$rec->emp_id);
                        $research = $this->CRUDModel->get_where_result('hr_research_paper',$where);    
                        if($research):
                        ?>
                    <table class="table table-boxed">
                    <thead>

                        <tr><th colspan="4">Research Papers</th></tr>
                        <tr>
                            <td><strong>S.N</strong></td>
                            <td><strong>Title</strong></td>
                            <td width="70"><strong>ISSN/DOI</strong></td>
                        </tr>
                    </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        foreach($research as $rRow):
                           echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$rRow->title.'</td>';
                            echo '<td>'.$rRow->issn.'</td>';
                           echo '</tr>';
                        $i++;
                        endforeach;
                        ?>   
                        </tbody></table>
                        <?php endif;
                        $where = array('hr_emp_grant_in_aid.emp_id'=>$rec->emp_id);
                        $grant = $this->HrModel->hr_grant_in_add($where);    
                        if($grant):
                        ?>
                    <table class="table table-boxed">
                    <thead>

                        <tr><th colspan="8">GRANT-IN-AID</th></tr>
                        <tr>
                            <td>File #</td>
                            <td>Allowance for</td>
                            <td>Amount</td>
                             <td>Start Date</td>
                             <td>Completion Date</td>
                            <td>Present Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($grant as $empRow):
                            $sdate = $empRow->start_date;
                            if($sdate === '0000-00-00' || $sdate == '' ):
                                echo $formattedValue = '';
                            else:
                                $formattedValue = date("F, Y", strtotime($sdate));
                            endif;
        
                            $edate = $empRow->end_date;
                            if($edate === '0000-00-00' || $edate == '' ):
                                echo $formattedend = '';
                            else:
                                $formattedend = date("F, Y", strtotime($edate));
                            endif;
                            
//                            if($empRow->start_date === '0000-00-00' || $empRow->start_date == '1970-01-01' || $empRow->start_date == ''):
//                            echo $date1 = '';
//                        else:
//                            $date1 = date("d-m-Y", strtotime($empRow->start_date));
//                         endif;
                        if($empRow->end_date === '0000-00-00' || $empRow->end_date == '1970-01-01' || $empRow->end_date == ''):
                            echo $date2 = '';
                        else:
                            $date2 = date("d-m-Y", strtotime($empRow->end_date));
                         endif;
                        if($empRow->amount_coll_date === '0000-00-00' || $empRow->amount_coll_date == '1970-01-01' || $empRow->amount_coll_date == ''):
                            echo $date3 = '';
                        else:
                            $date3 = date("d-m-Y", strtotime($empRow->amount_coll_date));
                         endif;
                           echo '<tr>';
                                echo '<td>'.$empRow->file_no.'</td>';
                                echo '<td>'.$empRow->degree.'</td>';
                                echo '<td>'.$empRow->amount_received.'</td>';
                                echo '<td>'.$formattedValue.'</td>';
                                echo '<td>'.$formattedend.'</td>';
                                echo '<td>'.$empRow->status_title.'</td>';
                           echo '</tr>';
                        $i++;
                        endforeach;
                        ?>   
                        </tbody></table>
                        <?php endif;?>
                        
                    </td>
                            
                        </tr>
<?php
    $s++;
}
 ?>

                    </tbody>
                </table>
                <?php 
                
                echo $print_log;
                endif;?>
                </div><!--//col-md-3-->
                
            
                </div>
                </div><!--//cols-wrapper-->
           
        </div><!--//content-->