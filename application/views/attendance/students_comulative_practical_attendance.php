        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Students Comulative Practical Attendance <hr></h2>
            <div class="row cols-wrapper">
            <div class="col-md-12">    
                <form method="post">                
            <div class="form-group col-md-2">
                <?php
                    
                    if(!empty($group_id)){
                        $secres = $this->AttendanceModel->get_by_id('practical_group',array('prac_group_id'=>$group_id));
                        foreach($secres as $secrec)
                        { ?>          
            <input type="text" name="group_id" value="<?php echo $secrec->group_name; ?>" placeholder="Group Name" class="form-control" id="groupName">
                        <input type="hidden" name="group_id" id="group_id" value="<?php echo $secrec->prac_group_id; ?>">      
                        <?php 
                        }     
                    }else{?>
                    <input type="text" name="group_id" placeholder="Group" class="form-control" id="groupName">
                            <input type="hidden" name="group_id" id="group_id">    
                        <?php
                        }    
                    ?>                  
            </div>          
        <input type="submit" name="search" class="btn btn-theme" value="Search">
        <input type="submit" name="search_submit" class="btn btn-theme" value="Submit">
                </form>
            </div>
        </div>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                     <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                     </h4>
                    <?php
                    if(@$result):
                    ?>
             <form method="post">        
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Student</th>
                            <th>Total Attendance</th>
                            <th>Present Attendance</th>
                            <th>Absent </th>
                       </tr> 
                    </thead>
                    <tbody>
            <?php               
        $insert = array();                 
        foreach($result as $rec)  
        {
            $sec_id = $rec->sec_id;  
            $subject_id = $rec->subject_id; 
            $start_date = date('Y-m-d', strtotime($rec->timestamp));
            $where = array('group_id'=>$sec_id);
            $this->db->select('*');
            $this->db->from('student_prac_group_allottment');
            $this->db->join('student_record','student_record.college_no=student_prac_group_allottment.college_no', 'left outer');
            $this->db->where($where);
            $this->db->where('student_record.s_status_id','5');
            $qry = $this->db->get();
            ?>
        <tr style="color:red">               
            <td colspan="6">
                <strong style="margin-right:100px;margin-left:80px;">Employee Name: <?php echo $rec->employee;?></strong>
                <strong style="margin-right:100px;">Section Name: <?php echo $rec->section;?></strong>
                <strong>Subject Name: <?php echo $rec->subject;?></strong>
            </td>         
        </tr>      
            <?php            
            $i = 1;
            foreach($qry->result() as $row):
            ?>
                <tr>
                    <td><?php echo $i;?></td>   
                    <td><?php echo $row->student_name;?></td>
                    <?php  
                        $where = array(
                            'college_no'=>$row->college_no,
                            'practical_alloted.practical_class_id'=>$rec->class_id,
                            
                        );
            $this->db->select('*');
            $this->db->from('practical_alloted');
            $this->db->join('practical_attendance','practical_attendance.prac_class_id=practical_alloted.practical_class_id');
    $this->db->join('practical_attendance_details','practical_attendance_details.attend_id=practical_attendance.attend_id');
            $q = $this->db->where($where)->get()->result(); 
            $a = '';            
            $p = '';     
            ?>
            
        <td><?php echo count($q);?></td> 
        <td>            
            <?php            
            foreach($q as $qrow):           
                if($qrow->status == 1):
                    $p++;
                endif;  
            if($qrow->status == 0):
                    $a++;
                endif;         
            endforeach;  
              $insert[] = array(
              'emp_id'=>$rec->emp_id,  
              'sec_id'=>$sec_id,  
              'subject_id'=>$subject_id,  
              'student_id'=>$row->student_id,        
              'college_no'=>$row->college_no,        
              'total_attend'=>count($q),        
              'p_attend'=>$p,        
              'a_attend'=>$a,
              'start_date'=>$start_date
                  );        
                   echo $p;     
                        ?></td>
                 
            <td><?php echo $a;?></td>        
                 </tr>                
            <?php
            $i++;
            endforeach;
        }
            ?>
                    </tbody>
                </table>
         
                  <?php endif;
                
                    
                    ?>  
                    </form>  
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   