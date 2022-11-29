<script language="javascript">
    function printdiv(printpage)
    {
    var headstr = "<html><head><title></title></head><body><p></p>";
    var footstr = "</body>";
    var newstr = document.all.item(printpage).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = headstr+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;
    return false;
    }
</script>
<style>
    label{
        color:#00ba8b;
    }
</style>
   
            <div class="main">
	
	<div class="main-inner">

	    <div class="container">
                   
                <div class="row">
	      	     <div class="span12">
    <form method="post">
        <?php 

            echo form_dropdown('cat_id', $category, $cat_id,  'class="span2"');

            echo form_dropdown('contract_type_id', $contract, $contract_type_id,  'class="span2"'); 
       
        ?>                     
     <input style="margin-top:-10px;padding:4px 16px;" type="submit" name="search" value="Search" class="btn btn-primary">   
 </form>
                </div>
                   
	      	<div class="span12" style="min-height:380px;">
            <?php
                if(@$result):
            ?> 
        <div class="widget widget-table action-table">
            <div class="widget-header">
               <h3>
                   <i class="icon-long-arrow-right"></i>  Staff List 

                   <i class="icon-list"></i>&nbsp;&nbsp;  
                   <span style="color:red">
                       Total Records: <?php echo count($result);?>
                   </span>
               </h3>
            </div>
            <div id="div_print">
            <div class="widget-content">
              <table class="table table-striped table-bordered table-hovered">
                <thead>
                    <tr style="color:#00ba8b;">
                        <th>S.N</th>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Department</th>
                        <th>Birth</th>
                        <th>Appointment</th>
                        <th>Retirement</th>
                        <th>BPS</th>
                        <th>Academic Details</th>
                    </tr>
                </thead>
                <tbody>
<?php  
$s = 1;
foreach($result as $rec)  
{  
  $picture = $rec->picture; 
        $dob = $rec->dob;
        if($dob === '0000-00-00' || $dob == ''){
            $dob = '';
        } else {
            $dob = date("d-m-Y", strtotime($dob));
        }
    
        $date = $rec->joining_date;
        if($date === '0000-00-00' || $date == ''){
            $date = '';
        } else {
            $date = date("d-m-Y", strtotime($date));
        }
    
    $date1 = $rec->retirement_date;
        if($date1 === '0000-00-00' || $date == ''){
            $date1 = '';
        } else {
            $date1 = date("d-m-Y", strtotime($date1));
        }    
    ?>
                        <tr class="gradeA">
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
                        $res = $this->GuiModel->hr_edu_record($where);    
                        if($res):
                        ?>
                        <table class="table table-boxed">
                    <thead>
                        
                        <tr><th colspan="7"  style="color:red">Academic Details</th></tr>
                        <tr  style="color:#00ba8b;">
                            <td><strong>S.N</strong></td>
                            <td><strong>Degree</strong></td>
                            <td><strong>Institute</strong></td>
                            <td><strong>Year</strong></td>
                            <td><strong>CGPA</strong></td>
                            <td><strong>Div</strong></td>
                            <td><strong>Hec Ver.</strong></td>
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
                            echo '<td>'.$eRow->hec_verified.'</td>';
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

                        <tr><th colspan="4"  style="color:red">Professional Courses</th></tr>
                        <tr style="color:#00ba8b;">
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

                        <tr><th colspan="5" style="color:red">Research Papers</th></tr>
                        <tr style="color:#00ba8b;">
                            <td><strong>S.N</strong></td>
                            <td><strong>Author</strong></td>
                            <td><strong>ISSN#</strong></td>
                            <td><strong>Pub. Year</strong></td>
                            <td><strong>Status</strong></td>
                        </tr>
                    </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        foreach($research as $rRow):
                           echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$rRow->author.'</td>';
                            echo '<td>'.$rRow->issn.'</td>';
                            echo '<td>'.$rRow->year.'</td>';
                            echo '<td>Yes</td>';
                           echo '</tr>';
                        $i++;
                        endforeach;
                        ?>   
                        </tbody></table>
                        <?php endif;
                        $where = array('hr_emp_grant_in_aid.emp_id'=>$rec->emp_id);
                        $grant = $this->GuiModel->hr_grant_in_add($where);    
                        if($grant):
                        ?>
                    <table class="table table-boxed">
                    <thead>

                        <tr><th colspan="8" style="color:red">GRANT-IN-AID</th></tr>
                        <tr style="color:#00ba8b;">
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
                        <?php endif;?></td>  
                        </tr>
<?php
$s++;
}
     endif;                  
    ?>
                         
                    </tbody>
                </table>
                </div>
            </div>
                    </div>
						</div>
					</div> <!-- /widget-content -->
				</div> <!-- /widget -->
		    </div> <!-- /span8 -->
	      </div>