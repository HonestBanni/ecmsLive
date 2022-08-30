  <script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
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
            <h2 align="left">All Students (BS Programs)<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                   
                    <form method="post">
                        <div class="form-group col-md-2">
                            <input type="text" name="college_no"  placeholder="College No." class="form-control">
                      </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="form_no"  placeholder="Form No." class="form-control">
                      </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="student_name"  placeholder="Student Name" class="form-control">
                      </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="father_name"  placeholder="Father Name" class="form-control">
                      </div>
                      <div class="form-group col-md-2">
                            <select class="form-control" name="gender_id">
                            <?php
            $gres = $this->get_model->get_by_id('gender',array('gender_id'=>$gender_id));
                if($gres){
                    foreach($gres as $grec){ ?>                   
            <option type="text" value="<?php echo $grec->gender_id;?>"><?php echo $grec->title;?></option>
                 <?php 
                    }     
                }   
                ?>       
                            <option value="">Select Gender</option>
                            <?php 
                            $sb = $this->db->query("SELECT * FROM gender");
                            foreach($sb->result() as $sbrec)
                            {
                            ?>
                                <option value="<?php echo $sbrec->gender_id;?>"><?php echo $sbrec->title;?></option>
                            <?php
                            }
                            ?>
                        </select>
                      </div>    
                        <div class="form-group col-md-2">
                            <select class="form-control" name="programe_id" id="feeProgrameId">
                             <?php
            $pres = $this->get_model->get_by_id('programes_info',array('programe_id'=>$programe_id));
                if($pres){
                    foreach($pres as $prec){ ?>                   
            <option type="text" value="<?php echo $prec->programe_id;?>"><?php echo $prec->programe_name;?></option>
                 <?php 
                    }     
                }   
                ?>   
                            <option value="">Select Program</option>
                            <?php 
                            $sb = $this->db->query("SELECT * FROM programes_info WHERE programe_id in(2,6,8,9,14,17)");
                            foreach($sb->result() as $sbrec)
                            {
                            ?>
                                <option value="<?php echo $sbrec->programe_id;?>"><?php echo $sbrec->programe_name;?></option>
                            <?php
                            }
                            ?>
                        </select>
                      </div>
                        
                        <div class="form-group col-md-2">
                            <select class="form-control" name="sub_pro_id" id="showFeeSubPro">
                                <?php
            $spres = $this->get_model->get_by_id('sub_programes',array('sub_pro_id'=>$sub_pro_id));
                if($spres){
                    foreach($spres as $sprec){ ?>                   
            <option type="text" value="<?php echo $sprec->sub_pro_id;?>"><?php echo $sprec->name;?></option>
                 <?php 
                    }     
                }   
                ?>   
                            <option value="">Sub Program</option>
                            <?php 
                            $sb = $this->db->query("SELECT * FROM sub_programes where programe_id in(2,6,8,9,14,17)");
                            foreach($sb->result() as $sbrec)
                            {
                            ?>
                                <option value="<?php echo $sbrec->sub_pro_id;?>"><?php echo $sbrec->name;?></option>
                            <?php
                            }
                            ?>
                        </select>
                      </div>
                        
                        
                        <div class="form-group col-md-2">
                             <?php 
//                                        $Section = array('Section'=>"Section");
                                                
                                                echo form_dropdown('batch_id', $batch, $batchId,  'class="form-control" id="batch_id"');
                                        ?>
                        </div>
                        
                        <div class="form-group col-md-2">
        <select class="form-control" name="s_status_id">
                             <?php
            $gres = $this->get_model->get_by_id('student_status',array('s_status_id'=>$s_status_id));
                if($gres){
                    foreach($gres as $grec){ ?>                   
            <option type="text" value="<?php echo $grec->s_status_id;?>"><?php echo $grec->name;?></option>
                 <?php 
                    }     
                }   
                ?>       
                <option value="">Select Status</option>
                <?php 
                $rs = $this->db->query("SELECT * FROM student_status");
                foreach($rs->result() as $rsrec)
                {
                ?>
                    <option value="<?php echo $rsrec->s_status_id;?>"><?php echo $rsrec->name;?></option>
                <?php
                }
                ?>
            </select>
                      </div>
                        <input type="submit" name="search" class="btn btn-theme" value="Search"> 
                        <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>  
                        <button type="submit" name="export_excel" value="export_excel" class="btn btn-theme"><i class="fa fa-download"></i> Export </button>  
                    </form>
                    </div>
                <?php if(@$result):?>
                    <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count($result);?>
            </button>
            </p>
        <div id="div_print">        
        <div class="col-md-12">
            <?php
            $pres = $this->get_model->get_by_id('programes_info',array('programe_id'=>$programe_id));
                if(!empty($pres)){
                    foreach($pres as $prec){ ?> 
        <h4 style="text-align:center;font-weight:bold">Students Record (<?php echo $prec->programe_name; ?>)    
                 <?php 
                    }     
                }   
            
            $spres = $this->get_model->get_by_id('sub_programes',array('sub_pro_id'=>$sub_pro_id));
                if(!empty($spres)){
                    foreach($spres as $sprec){ ?>                   
            - <?php echo $sprec->name;?>
                 <?php 
                    }     
                }   
                ?>   
        </h4>    
        </div>  
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S#</th>
                            <th>Picture</th>
                            <th>Form #</th>
                            <th>College #</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>Sub Program</th>
                            <th>Batch</th>
                            <th>Section</th>
                            <th>Obt/Total (%age)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$i = 1;
    foreach($result as $rec)  
    {
    $student_id = $rec->student_id;
    $student_name = $rec->student_name;
    $father_name = $rec->father_name;
    $applicant_image = $rec->applicant_image;           
    $section = $rec->section;                          
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $i;?></td>
                            <td><?php
                    if($applicant_image == "")
                    {?>
        <img src="assets/images/students/user.png" width="50" height="40">
                    <?php
                    }else
                    {?>
    <img src="assets/images/students/<?php echo $applicant_image;?>" style="border-radius:10px;" width="50" height="40">
                <?php 
                    }
                    ?></td>
                    <td><?php echo $rec->form_no;?></td>
                    <td><?php echo $rec->college_no;?></td>
 <td><a href="admin/student_profile/<?php echo $student_id;?>" title="View Profile">
     <span style="font-size:15px;"><?php echo $student_name;?></span></a>    
                    </td>
                    <td><?php echo $rec->father_name;?></td>
                    <td><?php echo $rec->sub_program;?></td>
                    <td><?php echo $rec->batch;?></td>
                    <td><?php 
                    if($section == '')
                    {
                        echo '';
                    }else
                    {?>
                    <?php echo $section;?>   
                <?php 
                    }
                    ?></td>
                    <td><?php echo $rec->obtained_marks.'/'.$rec->total_marks.' ('.$rec->percentage.')';?></td>
                    <td><span class="label label-theme"><?php echo $rec->student_status;?></span></td>
    </tr>
<?php
        $i++;
}
 ?>

                    </tbody>
            </table></div>
<h4><span style="margin-right:30px;color:#208e4c"><?php endif;?></span></h4>                
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           