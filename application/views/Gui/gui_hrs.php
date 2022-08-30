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
                  <div class="span8 offset2" style="min-height:420px;">
                        <div class="widget">
                          <div class="widget-header"> <i class="icon-bookmark"></i>
                              <h3>HR Employees Record</h3>
                          </div>
                          <!-- /widget-header -->
                          <div class="widget-content">
                            <div class="shortcuts"> 
                                <a href="facultyMembers" class="shortcut">
                                    <i class="shortcut-icon icon-list-alt"></i>
                                    <span class="shortcut-label">Staff Record</span> 
                                </a>
                                <a href="facultyReport" class="shortcut">
                                    <i class="shortcut-icon icon-list-alt"></i>
                                    <span class="shortcut-label">Faculty Members Report</span> 
                                </a>
                                <a href="Teachers_Attendance" class="shortcut">
                                    <i class="shortcut-icon icon-list-alt"></i>
                                    <span class="shortcut-label">Teaching Staff Login Details</span> 
                                </a>
                              </div>
                            <!-- /shortcuts --> 
                          </div>
                          <!-- /widget-content --> 
                        </div>
         
                    </div>
<!--                  <div class="span12 ">
                        <div class="widget">
                          <div class="widget-header"> <i class="icon-bookmark"></i>
                              <h3>Teacher Work Load Report</h3>
                          </div>
                           /widget-header 
                          <div class="widget-content">
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
                    if($subjectPerformance ):
                        $sn = '';
                        foreach($subjectPerformance as $rowPrf):
                            
                           
                            if($rowPrf->count != 0):
                                      $sn++;
                                echo '<tr>
                                        <td>'.$sn.'</td>
                                        <td>'.$rowPrf->emp_name.'</td>
                                        <td>'.$rowPrf->title.'</td>
                                        <td>'.$rowPrf->name.'</td>
                                        <td>'.$rowPrf->count.'</td>
                                     </tr>';
                            endif;
                      
                         
//                        
                        endforeach;
                    endif;
                    
                    ?>
                    
                
                </tbody>
              </table>
                             /shortcuts  
                          </div>
                           /widget-content  
                        </div>
         
                    </div>
                 -->
                   
                   
              </div>
	      
			
	      
	      
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->
 
 