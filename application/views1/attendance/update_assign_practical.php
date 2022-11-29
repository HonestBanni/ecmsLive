<style>
    input[type=checkbox]{
    zoom: 1.8;
    }
    
    .form-group{
        margin-bottom: 0px;
    }
</style>
        <div class="content container">
            <h2 align="left">Assign Practical Group <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h4 style="color:green; text-align:center;">
                        <?php print_r($this->session->flashdata('insert_msg'));?>
                    </h4>
                    <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                    </h4>
                </div>

<form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>AttendanceController/update_assign_practical_groups">
    <div class="form-group col-md-3">
            <label for="usr">Student Name</label>
       <input type="text" value="<?php echo $result->student_name;?>" class="form-control"> 
       <input type="hidden" name="student_id" value="<?php echo $result->student_id;?>" class="form-control"> 
   </div>
    <div class="form-group col-md-3">
            <label for="usr">Father Name:</label>
            <input type="text" value="<?php echo $result->father_name;?>" class="form-control"> 
   </div>
    <div class="form-group col-md-3">
            <label for="usr">College No</label>
        <input type="text" value="<?php echo $result->college_no;?>" class="form-control">
        </div>
    <div class="form-group col-md-3">
            <label for="usr">Program</label>
        <?php
            $sub_pro_id = $result->sub_pro_id;
            $sub = $this->db->query("SELECT * FROM sub_programes WHERE sub_pro_id = '$sub_pro_id'");
            foreach($sub->result() as $record);
        ?>
        <input type="text" value="<?php echo $record->name;?>" class="form-control" readonly>
    </div>
    <?php
        $this->db->SELECT('*');
        $this->db->FROM('practical_group');
        $this->db->join('practical_subject','practical_subject.prac_subject_id=practical_group.subject_id');
        $this->db->join('labs','labs.lab_id=practical_group.lab_id');
        $this->db->group_by('practical_subject.prac_subject_id');
        $q = $this->db->get()->result();
    ?>
   <div class="form-group col-md-12"> 
             <?php
                   foreach($q as $resRow):
                        $sub_id = $resRow->subject_id;
                    ?>       
       <br><br>
                  <div class="form-group col-md-12">
                    <h4><strong><?php echo $resRow->title; ?>:</strong></h4>
                  </div> 
      
    <?php
    $ssArray = array();
    foreach($selectsubjects as $sRow):
        $ssArray[] = $sRow->group_id;
      endforeach;                 
      $ssArray1[0] = 0;
      $grandArray = array_merge($ssArray1,$ssArray);
      $qry = $this->db->query("SELECT * FROM practical_group WHERE subject_id = '$sub_id'");              
    foreach($qry->result() as $resRow):
      if(array_search($resRow->prac_group_id,$grandArray)){
          ?>
      <div class="form-group col-md-2">
            <input type="checkbox" name="checked[]" checked value="<?php echo $resRow->prac_group_id; ?>">
            <strong><?php echo $resRow->group_name; ?></strong>       
      </div>
    <?php
         }else
      {
    ?>
             <div class="form-group col-md-2">
            <input type="checkbox" name="checked[]" value="<?php echo $resRow->prac_group_id; ?>">
            <strong><?php echo $resRow->group_name; ?></strong>
             </div>
    <?php
         }  
        ?>     
      
                  <?php
                  endforeach;
                  endforeach;
                ?>
    </div>
    <div class="form-group col-md-12">
        <input type="submit" class="btn btn-theme" name="submit" value="Add Record">
    </div>
    </form>
            
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->