<?php
$this->load->helper('form');
foreach($result as $row);
    $id = $row->serial_no;
    $degree_id = $row->degree_id;
    $student_id = $row->student_id;
    $inst_id = $row->inst_id;
    $bu_id = $row->bu_id;
    $year_of_passing = $row->year_of_passing;
    $total_marks = $row->total_marks;
    $obtained_marks = $row->obtained_marks;
    $exam_type = $row->exam_type;
    $cgpa = $row->cgpa;
    $percentage = $row->percentage;
?>
<div class="span9">
    <div class="content">

        <div class="module">
            <div class="module-head">
                <h3>Update Student Academic Record</h3>
            </div>
            <div class="module-body">
                
                <br />
                
                <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/update_degree_academic_record/<?php echo $id;?>">
            <input type="hidden" name="old_obtained_marks" value="<?php echo $obtained_marks;?>">
            <input type="hidden" name="old_total_marks" value="<?php echo $total_marks;?>">
            <input type="hidden" name="old_percentage" value="<?php echo $percentage;?>">
            <input type="hidden" name="old_student_id" value="<?php echo $student_id;?>">
                    <div class="form-group col-md-4">
                        <label for="usr">Degree / Certificate</label>
                        <select name="degree_id" class="form-control" required>
                            <?php
                        $pro = $this->get_model->get_by_id('degree',array('degree_id'=>$degree_id));
                            if($pro){
                                foreach($pro as $grec){ ?>
                                <option value="<?php echo $grec->degree_id;?>"><?php echo $grec->title;?></option>
                                       <?php
                                    }     
                                        }else{
                                 echo '<input type="text" class="form-control">';
                                            }    
                                        ?>      
                            <option>&larr; Degree / Certificate &rarr;</option>
                        <?php
                        $p = $this->db->query("SELECT * FROM degree");
                        foreach($p->result() as $pr)
                        {        
                        ?>        
                                <option value="<?php echo $pr->degree_id;?>"><?php echo $pr->title;?></option>
                        <?php
                            }
                            ?>    
                            </select>
                   </div>
                    <div class="form-group col-md-4"> 
                        <label class="control-label" for="basicinput">Institute</label>
                        <input type="text" name="inst_id" value="<?php echo $inst_id;?>" class="form-control">
                   </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="basicinput">Board/University</label>
                        <select name="bu_id" class="form-control" required>
                           <?php
                        $pro = $this->get_model->get_by_id('board_university',array('bu_id'=>$bu_id));
                            if($pro){
                                foreach($pro as $prec){ ?>
                                <option value="<?php echo $prec->bu_id;?>"><?php echo $prec->title;?></option>
                                       <?php
                                    }     
                                        }else{
                                 echo '<option value=""></option>';
                                            }    
                                        ?>  
                                <option>&larr; Board / University &rarr;</option>
                        <?php
                        $p = $this->db->query("SELECT * FROM board_university");
                        foreach($p->result() as $pr)
                                {        
                                ?>        
                                <option value="<?php echo $pr->bu_id;?>"><?php echo $pr->title;?></option>
                        <?php
                            }
                            ?>    
                            </select>
                   </div>
                   <div class="form-group col-md-4"> 
                        <label class="control-label" for="basicinput">Year of Passing</label>
                        <select name="year_of_passing" class="form-control">
            <option value="<?php echo $year_of_passing;?>"><?php echo $year_of_passing;?></option>
                            <option value=""> Select Year </option>
                            <option value="2017">2017</option>
                            <option value="2016">2016</option>
                            <option value="2015">2015</option>
                       </select>
                       
                   </div>
                    <div class="form-group col-md-4"> 
                        <label class="control-label" for="basicinput">Total Marks</label>
                       <input type="text" name="total_marks" value="<?php echo $total_marks;?>" class="form-control">
                   </div>
                    <div class="form-group col-md-4"> 
                        <label class="control-label" for="basicinput">Obtained Marks</label>
                       <input type="text" name="obtained_marks" value="<?php echo $obtained_marks;?>" class="form-control">
                   </div>
                    <div class="form-group col-md-4"> 
                        <label class="control-label" for="basicinput">CGPA</label>
                       <input type="text" name="cgpa" value="<?php echo $cgpa;?>" class="form-control">
                   </div>
                    <div class="form-group col-md-4"> 
                        <label class="control-label" for="basicinput">Exam Type</label>
                       <select name="exam_type" class="form-control">
                        <option value="<?php echo $exam_type;?>"><?php echo $exam_type;?></option>
                        <option value="">&larr; Exam Type &rarr;</option>
                        <option value="annual">Annual</option>
                        <option value="supply">Supply</option>
                        </select>
                   </div>
                    <div class="form-group col-md-12"> 
                       <input type="submit" name="submit" value="Update Record" class="btn btn-theme">
                   </div>
                    
                </form>
                <br>

                
            </div>
        </div>



    </div><!--/.content-->
</div><!--/.span9-->
</div>
</div><!--/.container-->
</div><!--/.wrapper-->