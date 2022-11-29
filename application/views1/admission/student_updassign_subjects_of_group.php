<style>
    input[type=checkbox]{
    zoom: 1.8;
    }
    
.blink_text { 

        -webkit-animation-name: blinker;
 -webkit-animation-duration: 1s;
 -webkit-animation-timing-function: linear;
 -webkit-animation-iteration-count: infinite;

 -moz-animation-name: blinker;
 -moz-animation-duration: 1s;
 -moz-animation-timing-function: linear;
 -moz-animation-iteration-count: infinite;
 animation-name: blinker;
 animation-duration: 2s;
 animation-timing-function: linear; 
    animation-iteration-count: infinite; color: red; 
} 

@-moz-keyframes blinker {
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; } 
}

@-webkit-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; } 
} 

@keyframes blinker {  
    0% { opacity: 1.0; } 
    50% { opacity: 0.0; }      
    100% { opacity: 1.0; } 
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

<form method="post" action="admin/updateassigning_subject">
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
    <div class="form-group col-md-2">
        <label>Section</label>
        <?php
            $gres = $this->get_model->get_by_id('sections',array('sec_id'=>@$section->section_id));
           
            if($gres){
                foreach($gres as $grec)
                { ?>          
                <input type="text" required="required" name="sec_Name" value="<?php echo $grec->name; ?>" placeholder="Section" class="form-control">
                <input type="hidden" name="sec_id" id="sec_id" value="<?php echo $grec->sec_id; ?>">      
                <?php 
                }     
            }else{?>
            <input type="text" name="sec_Name" placeholder="Section" class="form-control"  required="required">
                    <input type="clas" name="sec_id" id="sec_id">    
                <?php
                }    
            ?>                  
    </div>
    <div class="col-md-12" style="margin:20px 0px;">
        <strong style="font-size:16px;color:red; margin:20px 0px;" class="blink_text">
            Please Select Relevant Subjects because you have Changed Group
        </strong>
    </div>
   <div class="form-group col-md-6"> 
    <table class="table table-boxed table-hover">
              <thead>
                <tr>
                  <th><input type="checkbox" id="checkAll"></th>    
                  <th>All Subjects</th>
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
            <input type="hidden" name="subject_id">
            </td>
            <td>'.$resRow->title.'</td>
          </tr>';
                  }else{
                               echo '<tr>   
            <td><input type="checkbox" name="checked[]" value="'.$resRow->subject_id.'" id="checkItem">
            <input type="hidden" name="subject_id">
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
            
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->