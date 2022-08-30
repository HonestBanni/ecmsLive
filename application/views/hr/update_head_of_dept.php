<?php
   $emp_id = $result->emp_id;
   $serial_no = $result->serial_no;
    $dept_id = $result->department_id;
?>
<!-- ******CONTENT****** --> 
    <div class="content container">
               <!-- ******BANNER****** -->
        <h2 align="left">Update Head of Department <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
        <h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 
                </div>
            <br />
                <form  method="post" enctype="multipart/form-data" action="HrController/update_head_of_dept/<?php echo $serial_no;?>">
        <div class="form-group col-md-4">
                <label for="usr">Employee Name:</label>
                <select class="form-control" type="text" name="emp_id">
                <?php
            $gres = $this->HrModel->get_by_id('hr_emp_record',array('emp_id'=>$emp_id));
                if($gres){
                    foreach($gres as $grec){ ?>                   
            <option type="text" value="<?php echo $grec->emp_id;?>"><?php echo $grec->emp_name;?></option>
                 <?php 
                    }     
                }else{
            echo '<option type="text" value=""></option>';
                    }    
                ?>
                <option>&larr; Select &rarr;</option>
                 <?php
                    $b = $this->db->query("SELECT * FROM hr_emp_record");
                    foreach($b->result() as $brec)
                    {
                    ?>
                        <option value="<?php echo $brec->emp_id;?>"><?php echo $brec->emp_name;?></option>
                    <?php
                    }
                    ?>
            </select>  
            </div>
            <div class="form-group col-md-4">
                <label for="usr">Department Name:</label>
                <select class="form-control" type="text" name="department_id">
                <?php
            $gres = $this->HrModel->get_by_id('department',array('department_id'=>$dept_id));
                if($gres){
                    foreach($gres as $grec){ ?>                   
            <option type="text" value="<?php echo $grec->department_id;?>"><?php echo $grec->title;?></option>
                 <?php 
                    }     
                }else{
            echo '<option type="text" value=""></option>';
                    }    
                ?>
                <option>&larr; Select &rarr;</option>
                 <?php
                    $b = $this->db->query("SELECT * FROM department");
                    foreach($b->result() as $brec)
                    {
                    ?>
                        <option value="<?php echo $brec->department_id;?>"><?php echo $brec->title;?></option>
                    <?php
                    }
                    ?>
            </select>  
            </div> 
            <div class="form-group col-md-4">
                <label for="usr">Date:</label>
                <input type="text" name="date" value="<?php echo $result->date;?>" class="form-control date">      
            </div>  
            <div class="form-group col-md-4">
                <label for="usr">Comment:</label>
                <input type="text" name="comment" value="<?php echo $result->comment;?>" class="form-control">      
            </div>         
                    <div class="form-group col-md-12">
                    <input type="submit" name="submit" value="Update Record" class="btn btn-theme">
                    </div>    
                </form>
	</div><!--//col-md-3-->          
    </div><!--//cols-wrapper-->
           
         