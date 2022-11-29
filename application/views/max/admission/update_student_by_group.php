<?php
   $section_id = $result->section_id;
   $student_id = $result->student_id;
   $sub_pro_id = $result->sub_pro_id;
   $serial_no = $result->serial_no;
?>
<!-- ******CONTENT****** --> 
<div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Update Student by Group<hr></h2>
    <h4 style="color:red; text-align:center;"><?php print_r($this->session->flashdata('msg'));?></h4>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/update_student_by_group/<?php echo $serial_no;?>">
<input type="hidden" value="<?php echo $serial_no;?>" name="serial_no"> 
                <input type="hidden" value="<?php echo $student_id;?>" name="student_id"> 
                <input type="hidden" value="<?php echo $sub_pro_id;?>" name="sub_pro_id"> 
                <input type="hidden" value="<?php echo $section_id;?>" name="old_section_id">
            <div class="row">
            <div class="col-md-12">
              <!--//form-group-->
              <div class="form-group col-md-4">
                  <label for="usr">Student:</label>
                  <?php
                  $gres = $this->get_model->get_by_id('student_record',array('student_id'=>$student_id));
                            if($gres){
                                foreach($gres as $grec){ ?>
                    <input type="text" name="student_id" value="<?php echo $grec->student_name;?>" class="form-control"> 
                         <?php 
                                }     
                            }else{
                        echo '<input type="text" value="" class="form-control">';
                                }    
                            ?> 
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Section:</label>
                 
                <select type="text" name="section_id" class="form-control">
                         <?php
                        $gres = $this->get_model->get_by_id('sections',array('sec_id'=>$section_id));
                            if($gres){
                                foreach($gres as $grec){ ?>                   
                        <option type="text" value="<?php echo $grec->sec_id;?>"><?php echo $grec->name;?></option>
                             <?php 
                                }     
                            }else{
                        echo '<option type="text" value="" class="form-control"></option>';
                                }    
                            ?>
                        <option value="">&larr; Assign Section &rarr;</option>
                            <?php
                            $b = $this->db->query("SELECT * FROM sections where status='On' order by name ASC");
                            foreach($b->result() as $brec)
                            {
                            ?>
                                <option value="<?php echo $brec->sec_id;?>"><?php echo $brec->name;?></option>
                            <?php 
                           }
                            ?>
                    </select>  
              </div>
         <div class="form-group col-md-8">
                    <input type="submit" class="btn btn-theme" name="submit" value="Update Record">
              </div> 
        </div>            
           
                      
                        </div>
                     </form>
                    </div>
               </div><!--//col-md-3-->
               
               <?php
               
               $studentId = $this->uri->segment(3);
                           $this->db->join('users','users.id=student_group_allotment_log.user_id'); 
                           $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');
                           $this->db->order_by('student_group_allotment_log.id','desc');
               $QueryLog = $this->db->get_where('student_group_allotment_log',array('student_id'=>$studentId))->result();
               
               if($QueryLog):
                ?>
               
                <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Employee name</th>
                            <th>Section</th>
                            <th>Date & Time</th>
                            <th>Comments</th>
                             
                        </tr>
                    </thead>
                 <?php    
                 $sn = '';
                 foreach($QueryLog as $row):
                     $sn++;
                   ?>
                    <tbody>
                        <tr class="gradeA">
                            <td><?php echo $sn?></td>
                            <td><?php echo $row->emp_name?></td>
                            <td><?php 
                            if($row->section_id != 'NULL'):
                               $sections =  $this->db->get_where('sections',array('sec_id'=>$row->section_id))->row();
                            if($sections):
                                echo $sections->name;
                            endif;
                            endif;
                            
                            ?></td>
                            <td><?php echo date('d-M-Y H:i:s',strtotime($row->timestamp))?></td>
                            <td><?php echo $row->comments?></td>

                                    </tr>

                                </tbody>
                                <?php
                
                   endforeach;
                
               ?>
                            </table>
               
               <?php
                
               endif;
               ?>
               
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->