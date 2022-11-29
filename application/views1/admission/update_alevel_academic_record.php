<?php
$this->load->helper('form');
foreach($result as $row);
    $id = $row->serial_no;
    $degree_id = $row->degree_id;
    $inst_id = $row->inst_id;
    $bu_id = $row->bu_id;
    $grade_id = $row->grade_id;
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
                
                <form style="margin-left:200px;" class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/update_alevel_academic/<?php echo $id;?>">
                     <div class="control-group">
                        <label class="control-label" for="basicinput">Degree / Certificate</label>
                        <div class="controls">
                            <select style="width:50%;" name="degree_id" class="span8 tip form-control" required>
                            <?php
                        $p = $this->db->query("SELECT * FROM degree WHERE degree_id='$degree_id'");
                        foreach($p->result() as $pr); ?>  
                        <option value="<?php echo $pr->degree_id;?>"><?php echo $pr->title;?></option>
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
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Institute</label>
                        <div class="controls">
                           <input style="width:50%;" type="text" name="inst_id" value="<?php echo $inst_id;?>" class="span8 tip form-control">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Board/University</label>
                        <div class="controls">
                            <select style="width:50%" name="bu_id" class="span8 tip form-control" required>
                           <?php
                        $b = $this->db->query("SELECT * FROM board_university WHERE bu_id='$bu_id'");
                        foreach($b->result() as $pr); ?>     
                            <option value="<?php echo $pr->bu_id;?>"><?php echo $pr->title;?></option>   
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
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Year of Passing</label>
            <div class="controls">
            <input style="width:50%" type="text" name="year_of_passing" value="<?php echo $year_of_passing;?>" data-original-title="" class="span8 tip form-control" required>
            </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Total Marks</label>
            <div class="controls">
            <input style="width:50%" type="text" name="total_marks" value="<?php echo $total_marks;?>" data-original-title="" class="span8 tip form-control">
            </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Obtained Marks</label>
            <div class="controls">
            <input style="width:50%" type="text" name="obtained_marks" value="<?php echo $obtained_marks;?>" data-original-title="" class="span8 tip form-control">
            </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Grade</label>
            <div class="controls">
                <select style="width:50%" name="grade_id" class="span8 tip form-control" required>
                    <option value="">Select Grade</option>
                    <?php
                    $qry = $this->CRUDModel->getResults('grade');
                    foreach($qry as $grec):
                    ?>
                        <option value="<?php echo $grec->grade_id;?>"><?php echo $grec->grade_name;?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
                    </div>
                    </div> 
                    
                    <div class="control-group">
                        <label class="control-label" for="basicinput">CGPA</label>
            <div class="controls">
            <input style="width:50%" type="text" name="cgpa" value="<?php echo $cgpa;?>" data-original-title="" class="span8 tip form-control">
            </div>
                    </div> 
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Exam Type</label>
            <div class="controls">
                <select style="width:50%" name="exam_type" class="span8 tip form-control" required>
                    <option value="<?php echo $exam_type;?>"><?php echo $exam_type;?></option>
                    <option value="">&larr; Exam Type &rarr;</option>
                    <option value="annual">Annual</option>
                    <option value="supply">Supply</option>
                </select>
           </div>
                    </div> 
                    <br>
                    <div class="control-group">
                        <div class="controls">
                            <input type="submit" name="submit" value="Update Record" class="btn btn-primary pull-center">
                        </div>
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