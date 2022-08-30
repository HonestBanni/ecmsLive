<style>
    #big_stats  i{
        font-size: 25px;
        line-height: 37px;
    color: #000000;
    }
    #big_stats .stat:hover i {
    color: #000000;
}
</style>
<div class="main">
	
	<div class="main-inner">

	    <div class="container">
 
             <div class="row">
                   
                  <div class="span12 ">
                        <div class="widget">
                          <div class="widget-header"> <i class="icon-bookmark"></i>
                              <h3><a href="StdAttendance">Academic Performance</a><i class="icon-long-arrow-right"></i>     Students per Subject Allotted Report</h3>
                          </div>
                          <!-- /widget-header -->
                          <div class="widget-content">
                              
                    
                              <p><?php // if(@$result_subj): echo count($result_subj);?></p>
                             <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Teacher Name </th>
                    <th>Subject</th>
                    <th>Class</th>
                    <th>Number of students</th>
                  
                    </tr>
                </thead>
                <tbody>
                <?php 
                if(@$result_group):
                    $array_sort = "";
                foreach($result_group as $rowPrc):
                    $this->db->select('count(student_group_allotment.student_id) as count');
                    $this->db->join('student_record','student_record.student_id=student_group_allotment.student_id');  
                    $this->db->where_in('student_record.s_status_id',array(5,12));
                    $this->db->where(array('section_id'=>$rowPrc->sec_id)); 
                    $this->db->order_by('count','asc'); 
                    $count = $this->db->get('student_group_allotment')->row();
                    if($count->count >0):
                    $array_sort[] = array(
                     'emp_name' =>$rowPrc->emp_name,
                     'title'    =>$rowPrc->title,
                     'name'     =>$rowPrc->name,
                     'count'    =>$count->count,
                    ); 
                    endif;
                ?>
               
                <?php
                    endforeach;
                    endif;  
                    if(@$subj_flag):
                    foreach($subj_flag as $rowPrf): 
                    
                  ?>
                <?php
                    $count_res = "";
                    $d = explode(',',$rowPrf->sec_id);
                    foreach($d as $key=>$value):
            $sec_name = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$value));   
            $this->db->select('count(student_subject_alloted.student_id) as count');
            $this->db->join('student_record','student_record.student_id=student_subject_alloted.student_id');
            $this->db->where_in('student_record.s_status_id',array(5,12));
            $this->db->where(array('subject_id'=>$rowPrf->subject_id,'section_id'=>$value));
            $count = $this->db->get('student_subject_alloted')->row();
                    $count_res += $count->count;   
                     
                    endforeach;
                        if($count_res >0):
                        
                          $array_sort[] = array(
                         'emp_name' =>$rowPrf->emp_name,
                         'title'    =>$rowPrf->title,
                         'name'     =>$rowPrf->sec_name,
                         'count'    =>$count_res,
                        );  
                        endif;
                           
                   // echo $count_res;
                   
                     endforeach;
                    foreach ($array_sort as $key => $row):
                    
                        
                    $items[$key]  = $row['count'];
                        
                        
                    endforeach;
                    array_multisort($items, SORT_ASC, $array_sort);
                    
                    
                    
                 $result_array =  json_decode(json_encode($array_sort), FALSE);
                $s = 1;    
                 foreach($result_array as $record):
                  ?>
                <tr>
                    <td><?php echo $s; ?></td>
                    <td><?php echo $record->emp_name; ?></td>
                    <td><?php echo $record->title; ?></td>
                    <td><?php echo $record->name;?></td>
                    <td><?php echo $record->count;?></td>
                </tr>    
                <?php 
                    $s++;
                endforeach;
                  //  echo '<pre>';print_r($array_sort);    
                     endif;
                   ?>
                </tbody>
              </table>
                    <!-- /shortcuts --> 
                  </div>
                  <!-- /widget-content --> 
                </div>
            </div>           
      </div>
        </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->
 
 