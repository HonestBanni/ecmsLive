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

<script>
setInterval(function() {
                  window.location.reload();
                }, 300000);

</script> 
    

    
<div class="main">
	
	<div class="main-inner">

	    <div class="container">
            <div class="row">
                   
                  
                  
                  <div class="span10 offset1">
                      
	      		
               <div class="widget widget-table action-table">
                   <div class="widget-header"> <i class="icon-bookmark"></i>
                               <h3><a href="StdAttendance">Teacher Performance</a><i class="icon-long-arrow-right"></i>    Teacher Daily Performance Report</h3>
                            <!--<h3>Teacher Performance Month Wise</h3>-->
                          </div>
            
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <tr>
                        <th style="color:#00ba8b; font-size:13px;">#</th>
                        <th style="color:#00ba8b; font-size:13px;">Name</th>
                        <th style="color:#00ba8b; font-size:13px;">Attended Section</th>
                        <th style="color:#00ba8b; font-size:13px;">Section Details</th>
                        <th style="color:#00ba8b; font-size:13px;">Attended Practical</th>
                        <th style="color:#00ba8b; font-size:13px;">Practical Details</th>
                   </tr>
                </thead>
                <tbody>
                    <?php
                
                    if($teacher_perf):
                        $all_result = '';
                        foreach($teacher_perf as $tp):
                         
                     
                              $where = array(
                                   'hr_emp_record.emp_id'=>$tp->emp_id, 
                                 );
                             
                             $result = $this->GuiModel->get_teacherBaseClass($where);  
                             
                             $count = '';
                                foreach($result as $row):
                                    $subject =   $this->CRUDModel->get_where_row('subject',array('subject_id'=>$row->subject_id));
                                        $attent_class = $this->CRUDModel->get_where_row('student_attendance',array('class_id'=>$row->class_id,'attendance_date'=>date('Y-m-d')));
                                    $count +=count($attent_class);
                                        
                                          
                                endforeach;
                                    
                          
                         $all_result[] = array(
                            'emp_id'    => $tp->emp_id,
                            'emp_name'  => $tp->emp_name,
                            'count'     => $count,
                         );   
                        endforeach;
                        
                        
                         foreach ($all_result as $key => $row) {
                            $items[$key]  = $row['count'];
                        }

                        array_multisort($items, SORT_DESC, $all_result);

                          $order_array =  json_decode(json_encode($all_result), FALSE);
                        
                              $sn = '';
                  
                          
                          foreach($order_array as $orderRow):
                            $where = array('emp_id'=>$orderRow->emp_id,'attendance_date'=>date('Y-m-d'));
                            $this->db->select('count(emp_id) as total_pr');
            $this->db->join('practical_attendance','practical_attendance.prac_class_id=practical_alloted.practical_class_id');
                            $res = $this->db->get_where('practical_alloted',$where)->row();
                              $sn++;
                                echo   '<tr>
                                        <td>'.$sn.'</td>
                            <td>'.$orderRow->emp_name.'</td>
                            <td>'.$orderRow->count.'</td>';
                            echo '<td><a href="javascript:valid(0)" id="'.$orderRow->emp_id.'" class="class_details"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"> Section Details </button></a></td>';
                           echo '<td>'.$res->total_pr.'</td>';
                            echo '<td><a href="javascript:valid(0)" id="'.$orderRow->emp_id.'" class="prac_details"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal1"> Practical Details </button></a></td>';
                            echo '</tr>';
                              
                          endforeach;
                          
                        
                        
                    endif;
                    ?>
               
                  
                
                </tbody>
              </table>
            </div>
            <!-- /widget-content --> 
          </div>	
	      		
	      		
		    </div> <!-- /span12 -->
                   
              </div>
	      
			
	      
	      
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->
    
  

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Section Details</h4>
      </div>
      <div class="modal-body">
          <div id="class_details_info">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Practical Details</h4>
      </div>
      <div class="modal-body">
          <div id="prac_details_info">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>

