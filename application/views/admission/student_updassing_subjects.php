<style>
    input[type=checkbox]{
    zoom: 1.8;
    }
</style> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Update Assigned Subjects <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
        <h4 style="color:green; text-align:center;">
            <?php print_r($this->session->flashdata('insert_msg'));?>
        </h4>
        <h4 style="color:red; text-align:center;">
            <?php print_r($this->session->flashdata('msg'));?>
        </h4>
                </div>

        <?php
        if(empty($section)):
            echo '<h1 style="text-align:center;color:#c00;"><strong>Section Allotement is required to allot Subject to Arts student.<br>Please first allot section then allot subjects</strong></h1>';
        else:
            $on_sec = $this->CRUDModel->get_where_row('sections', array('sec_id' => $section->section_id));
            if(!empty($on_sec)):
                if($on_sec->sub_pro_id == 27 || $on_sec->sub_pro_id == 5):
        ?>
<form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/updateassigning_subject">
    <div class="form-group col-md-3">
            <label for="usr">Student Name</label>
       <input type="text" value="<?php echo $result->student_name;?>" class="form-control"> 
       <input type="hidden" name="student_id" value="<?php echo $result->student_id;?>" class="form-control"> 
       <input type="hidden" name="log_student_id" value="<?php echo $result->student_id;?>" class="form-control"> 
   </div>
    <div class="form-group col-md-3">
            <label for="usr">Father Name:</label>
            <input type="text" name="father_name" value="<?php echo $result->father_name;?>" class="form-control"> 
            <input type="hidden" name="log_father_name" value="<?php echo $result->father_name;?>" class="form-control"> 
   </div>
    <div class="form-group col-md-3">
            <label for="usr">College No</label>
        <input type="text" name="college_no" value="<?php echo $result->college_no;?>" class="form-control">
        <input type="hidden" name="log_college_no" value="<?php echo $result->college_no;?>" class="form-control">
        </div>
<!--    <div class="form-group col-md-2">
        <label>Section</label>
        <?php
//            $gres = $this->get_model->get_by_id('sections',array('sec_id'=>@$section->section_id));
           
//            if($gres){
//                foreach($gres as $grec)
//                { ?>          
                <input type="text" required="required" name="sec_Name" value="<?php // echo $grec->name; ?>" placeholder="Section" class="form-control" id="section_art_id">
                <input type="hidden" name="sec_id" id="sec_id" value="<?php // echo $grec->sec_id; ?>">      
                <input type="hidden" name="log_sec_id" value="<?php // echo $grec->sec_id; ?>">      
                <?php 
//                }     
//            }else{?>
            <input type="text" name="sec_Name" placeholder="Section" class="form-control" id="section_art_id" required="required">
            <input type="text" name="sec_Name" placeholder="Section" class="form-control" id="section_art_id" >
            <input type="hidden" name="log_sec_Name" placeholder="Section" class="form-control" id="section_art_id" >     
                <?php
//                }    
            ?>                  
    </div>-->
   <div class="form-group col-md-6"> 

    <table class="table table-boxed table-hover">
              <thead>
                <tr>
                  <th><input type="checkbox" id="checkAll"></th>    
                  <th>Arts Subjects</th>
                </tr>
              </thead>
              <tbody>
           <?php
                $ssArray = array();
                foreach($selectsubjects as $sRow):
                
                  
                    $ssArray[] = $sRow->subject_id;
                  
                  endforeach;
                  
                  $ssArray1[0] =0;
                  $grandArray = array_merge($ssArray1,$ssArray);
      
                foreach($subjects as $resRow):
                  
                  
                  if(array_search($resRow->subject_id,$grandArray)){
                       echo '<tr>   
            <td><input type="checkbox" name="checked[]" checked value="'.$resRow->subject_id.'" id="checkItem">
            <input type="hidden" name="check_log[]" value="'.$resRow->subject_id.'">
            
            </td>
            <td>'.$resRow->title.'</td>
          </tr>';
                  }else{
                               echo '<tr>   
            <td><input type="checkbox" name="checked[]" value="'.$resRow->subject_id.'" id="checkItem">
            </td>
            <td>'.$resRow->title.'</td>
          </tr>';
                  
                  }
                  
            
//                  
//                  if(array_search($resRow->subject_id,$ssArray)):
//                  echo '<tr>   
//<td><input type="checkbox" name="selectsubjects[]" value="'.$resRow->subject_id.'" id="checkItem" checked="checked">
//            <input type="hidden" name="subject_id">
//            </td>
//            <td>'.$resRow->title.'</td>
//          </tr>';
//                  else:
//                  endif;
//                   echo '<tr>   
//            <td><input type="checkbox" name="checked[]" value="'.$resRow->subject_id.'" id="checkItem">
//            <input type="hidden" name="subject_id">
//            </td>
//            <td>'.$resRow->title.'</td>
//          </tr>';
                  
                   
    endforeach;
                
            ?></tbody>
            </table>
    </div>
    <div class="form-group col-md-12">
        <input type="submit" class="btn btn-theme" name="submit" value="Update Record">
    </div>
    </form>
           
        <?php 
        else:
            echo '<h1 style="text-align:center;color:#c00;"><strong>Section Allotement is required to allot Subject to Arts student.<br>Please first allot section then allot subjects</strong></h1>';
        endif; 
        endif; 
        endif; 
        ?> 
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->