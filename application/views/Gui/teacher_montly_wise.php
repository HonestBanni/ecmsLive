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
                  
                  <div class="span12">
                        <div class="widget">
                          <div class="widget-header"> <i class="icon-bookmark"></i>
                               <h3><a href="StdAttendance">Teacher Performance</a><i class="icon-long-arrow-right"></i>     Teacher Performance Month Wise</h3>
                            <!--<h3>Teacher Performance Month Wise</h3>-->
                          </div>
                          <!-- /widget-header -->
                           <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    
                    <?php
                    
//$array = [
//    '1' => [
//        'title' => 'Flower',
//        'order' => 3
//    ],
//    '2' => [
//        'title' => 'Rock',
//        'order' => 43
//    ],
//    '3' => [
//        'title' => 'Rock',
//        'order' => 34
//    ],
//    '4' => [
//        'title' => 'Rock',
//        'order' => 3
//    ],
//    '5' => [
//        'title' => 'Rock',
//        'order' => 11
//    ],
//    '6' => [
//        'title' => 'Rock',
//        'order' => 12
//    ],
//    '7' => [
//        'title' => 'Grass',
//        'order' => 2
//    ]
//];
//
//foreach ($array as $key => $row) {
//    $items[$key]  = $row['order'];
//}
//
//array_multisort($items, SORT_DESC, $array);
//
//echo '<pre>';print_r($array);die;

                    
           
                    
                    $last_year = date("Y-m",strtotime("- 12 month"));
                    $last_jun =  strtotime($last_year.'-06-01');
                    
                    
                  
                       for($i=1;$i<=12;$i++):

                                $monthi = '+'.$i.'month';
                                $month  = date("M-y", strtotime($monthi, $last_jun));
                                             
                              echo '<th>'.$month.'</th>';
                        endfor;
                     
                ?>
                    <th>Total Attend Classes</th>
                  
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sn = '';
                
                    if($teacher_perf):
                        $order_array = '';
                        foreach($teacher_perf as $tp):
                        $sn++;
                       
                        $g_total = '';
                        $attandance = array();
                        for($i=1;$i<=12;$i++):

                               $monthi = '+'.$i.'month';
                                  $month  = date("m", strtotime($monthi, $last_jun));
                                  $year  = date("Y", strtotime($monthi, $last_jun));
                                    $where = array(
                                      'month(attendance_date)' =>$month,  
                                      'year(attendance_date)' =>$year,  
                                      'emp_id'                  =>$tp->emp_id,  
                                    );
                                        $this->db->select(' student_attendance.class_id as count');
                                        $this->db->join('student_attendance','student_attendance.class_id=class_alloted.class_id');
                                        $this->db->where($where);
                                       
                                        $this->db->order_by('attendance_date','asc');
                               $all_count =  $this->db->get('class_alloted')->result();

                                $total = '';
                               if(count($all_count)):
                                     $total = count($all_count);
                               else:
                                     $total = '';
                               endif;
                                $g_total +=$total ;
                           
                              
                              $attandance[] = $total;
                        endfor;
                           
                            
                            $order_array[] = array(
                                    
                                    'emp_name'      =>$tp->emp_name,
                                    'attandance'    => $attandance,
                                    'total'         => $g_total
                                    );
                            
                            
                        endforeach;
                      
                        
                        foreach ($order_array as $key => $row) {
                            $items[$key]  = $row['total'];
                        }

                        array_multisort($items, SORT_DESC, $order_array);

                          $userInfo =  json_decode(json_encode($order_array), FALSE);
                        
                        
//                         echo '<pre>';print_r($userInfo);die;

                        $sn = '';
                        foreach($userInfo as $row):
                            echo '<tr>';
                                    $sn++;
                                echo '<td>'.$sn.'</td>';
                                echo '<td>'.$row->emp_name.'</td>';
                                 foreach($row->attandance as $row1=>$key):
                                     echo '<td>'.$key.'</td>';
                                 endforeach;  
                                 echo '<td>'.$row->total.'</td>';  
                            echo '</tr>';
                        endforeach;
                       
    
//                    array_multisort($dates, SORT_DESC, $mdarray);
                        
                        
                    endif;
                    ?>
                   
                
                </tbody>
              </table>
            </div>
                          <!-- /widget-content --> 
                        </div>
         
                    </div>
                  
                  
                   
                   
              </div>
	      
	 
	      
	      
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->
    
 