<?php
    $subject_id = $result->subject_id; 
    $programe_id = $result->programe_id; 
    
    ?>
<!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h4 align="left">Update Alumni Record<hr></h4>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form name="student" method="post" enctype="multipart/form-data" action="AttendanceController/update_subject/<?php echo $subject_id;?>">
            <div class="row">
            <div class="col-md-12">
              <!--//form-group-->

                <div class="form-group col-md-3">
                    <label for="usr">Subject Name:</label>
             <input type="text" name="title" value="<?php echo $result->title;?>" class="form-control">
                </div>
              <div class="form-group col-md-3">
                  <label for="usr">Program</label>
               <select class="form-control" type="text" name="programe_id" id="alumiProgrameId">
                   <?php
            $gres = $this->AttendanceModel->get_by_id('programes_info',array('programe_id'=>$programe_id));
                if($gres){
                    foreach($gres as $grec){ ?>                   
            <option type="text" value="<?php echo $grec->programe_id;?>"><?php echo $grec->programe_name;?></option>
                 <?php 
                    }     
                }else{
            echo '<option type="text" value=""></option>';
                    }    
                ?>
                    <option value="">&larr; Select Program &rarr;</option>
                   <?php
                    $b = $this->db->query("SELECT * FROM programes_info");
                    foreach($b->result() as $brec)
                    {
                    ?>
                        <option value="<?php echo $brec->programe_id;?>"><?php echo $brec->programe_name;?></option>
                    <?php 
                    }
                    ?>
                </select>
              </div>
            <div class="form-group col-md-3">
                  <label for="usr">Sub Program</label>
               <select class="form-control" id="showAlumiSubPro" type="text" name="sub_pro_id">
                   <?php
            $gres = $this->AttendanceModel->get_by_id('sub_programes',array('sub_pro_id'=>$sub_pro_id));
                if($gres){
                    foreach($gres as $grec){ ?>                   
            <option type="text" value="<?php echo $grec->sub_pro_id;?>"><?php echo $grec->name;?></option>
                 <?php 
                    }     
                }else{
            echo '<option type="text" value=""></option>';
                    }    
                ?>
                    <option value="">&larr; Select Program &rarr;</option>
                   <?php
                    $b = $this->db->query("SELECT * FROM sub_programes");
                    foreach($b->result() as $brec)
                    {
                    ?>
                        <option value="<?php echo $brec->sub_pro_id;?>"><?php echo $brec->name;?></option>
                    <?php 
                    }
                    ?>
                </select>
              </div>  
               <div class="form-group col-md-12">
             <input type="submit" name="submit"  class="btn btn-theme" value="Update">
                </div> 
                        </div>
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->