    <div class="content container">
            <h2 align="left">Languages Students Record<span  style="float:right"><a href="admin/add_language_student" class="btn btn-large btn-primary">Add New Student</a></span><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h4>
            <span style="margin-right:30px;color:#208e4c"><?php if(@$pages): echo $pages; endif;?></span> 
                    </h4>
                    <form method="post">
                        <div class="form-group col-md-2">
                    <input type="text" name="form_no" value="<?php if($form_no): echo $form_no; endif;?>" placeholder="Form No." class="form-control"> 
           </div>
            <div class="form-group col-md-2">
                    <input type="text" name="student_name" value="<?php if($student_name): echo $student_name; endif;?>"  placeholder="Student Name" class="form-control"> 
           </div>
            <div class="form-group col-md-2">
                    <input type="text" name="father_name" value="<?php if($father_name): echo $father_name; endif;?>" placeholder="Father Name" class="form-control"> 
           </div>
                       <div class="form-group col-md-2">
                       <select name="gender_id" class="form-control">
                            <option value="">Select Gender</option>
                            <?php 
                            $g = $this->db->query("SELECT * FROM gender");
                            foreach($g->result() as $grec)
                            {
                            ?>
                                <option value="<?php echo $grec->gender_id?>"><?php echo $grec->title;?></option>
                            <?php
                            }
                            ?>
                        </select>
                       </div>
        <div class="form-group col-md-2">
            <select type="text" name="programe_id" class="form-control">
                <?php
        $b = $this->db->query("SELECT * FROM programes_info WHERE programe_name LIKE 'chinese%'");
                foreach($b->result() as $brec)
                {
                ?>
    <option value="<?php echo $brec->programe_id;?>"><?php echo $brec->programe_name;?></option>
                <?php 
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-2">
       <select class="form-control" name="sub_pro_id"> 
        <?php
            $gres = $this->get_model->get_by_id('sub_programes',array('sub_pro_id'=>$sub_pro_id));
            if($gres){
                foreach($gres as $grec)
                { ?>          
        <option value="<?php echo $grec->sub_pro_id;?>"><?php echo $grec->name;?></option>
                <?php 
                }     
            }?>
            <option value="">Sub Program</option>
       <?php
    $c = $this->db->query("SELECT * FROM sub_programes WHERE programe_id='10'");
            foreach($c->result() as $crec)
            {
            ?>
        <option value="<?php echo $crec->sub_pro_id;?>"><?php echo $crec->name;?></option>
            <?php 
            }
            ?> 
            </select>
            </div>
            <div class="form-group col-md-2">
                <select name="batch_id" class="form-control">
                    <?php
                $bres = $this->get_model->get_by_id('prospectus_batch',array('batch_id'=>$batch_id));
                if($bres){
                    foreach($bres as $brec)
                    { ?>          
            <option value="<?php echo $brec->batch_id;?>"><?php echo $brec->batch_name;?></option>
                    <?php 
                    }     
                }?>
                <option value="">Select Batch</option>
                <?php 
                $b = $this->db->query("SELECT * FROM prospectus_batch WHERE  `batch_name` LIKE  '%Chinese%'");
                foreach($b->result() as $brec)
                {
                ?>
                    <option value="<?php echo $brec->batch_id;?>"><?php echo $brec->batch_name;?></option>
                <?php 
                }
                ?>    
                </select>
            </div> 
            <div class="form-group col-md-2">
                <select name="s_status_id" class="form-control">
                    <?php
            $sres = $this->get_model->get_by_id('student_status',array('s_status_id'=>$s_status_id));
            if($sres){
                foreach($sres as $srec)
                { ?>          
        <option value="<?php echo $srec->s_status_id;?>"><?php echo $srec->name;?></option>
                <?php 
                }     
            }?>
                     <option value="">Select Admission Status</option>
                <?php 
                $ss = $this->db->query("SELECT * FROM student_status");
                foreach($ss->result() as $ssrec)
                {
                ?>
            <option value="<?php echo $ssrec->s_status_id;?>"><?php echo $ssrec->name;?></option>
                <?php   
            }
                ?>
                </select>
           </div>
                <input type="submit" name="search" value="Search" class="btn btn-theme">
                <input type="submit" name="export" value="Export" class="btn btn-theme">
                    </form>
                </div>
            <p>
            <?php  
                if(@$count):    
            ?>    
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo $count;?>
            </button>
            <?php
                else:  
            ?>    
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count($result);?>
            </button>
            <?php
                endif;
            ?>    
            </p>
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>PK</th>
                            <th>Student</th>
                            <th>F-Name</th>
                            <th>Form #</th>
                            <th>Sub Program</th>
                            <th>Batch</th>
                            <th>Remarks</th>
                            <th>Status</th>
                            <th><i class="icon-edit" style="color:#fff"></i><b> Update</b></th>
                        </tr>
                    </thead>
                    <tbody>
<?php
foreach($result as $rec)  
    {
        $student_id = $rec->student_id;
        $student_name = $rec->student_name;
        $father_name = $rec->father_name;
        $applicant_image = $rec->applicant_image;            
        ?>
                        <tr class="gradeA">
                            <td><?php 
                $query = $this->CRUDModel->get_where_row('applicant_edu_detail',array('student_id'=>$student_id));
                    if($query){
                        echo '<i>'.$student_id.'</i>';
                    }else{
                        echo '<i style="color:red;">'.$student_id.'</i>';
                    }            
                                
                    ?></td>
 <td><a href="admin/student_profile/<?php echo $student_id;?>">
     <span style="font-size:15px;"><?php echo $student_name;?></span></a>    
                    </td>
                    <td><?php echo $father_name;?></td>
                    <td><?php echo $rec->form_no;?></td>
                    <td><?php echo $rec->sub_program;?></td>
                    <td><?php echo $rec->batch;?></td>
                    <td><?php echo $rec->comment;?></td>
                    <td><span class="btn btn-success btn-sm"><?php echo $rec->status;?></span></td>
    <td><a class="btn btn-primary btn-sm" href="admin/update_language_student/<?php echo $rec->student_id;?>"><b>Update</b></a></td>
    
                            
                        </tr>
<?php
}
 ?>

                    </tbody>
                </table>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           