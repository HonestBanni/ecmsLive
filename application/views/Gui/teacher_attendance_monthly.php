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
                   
                  
                  
                  <div class="span8 offset2">
	      		
               <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
                <h3><a href="StdAttendance">Teacher Perferance</a><i class="icon-long-arrow-right"></i>     <a href="montlyWise">Teacher Performance Month Wise</a> <i class="icon-long-arrow-right"></i>     Performance Month(<?php echo date("M-Y",strtotime('1-'.$this->uri->segment(2)));?>)</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Total Attend Week Wise</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                     $sn = '';
                    $a = '';
                    if($teacher_perf):
                         
                        foreach($teacher_perf as $tp):
                        $sn++;
                        echo   '<tr>
                                <td>'.$sn.'</td>
                                
                                <td>'.$tp->emp_name.'</td>';
 
                                echo '<td>'.$tp->countMontly.'</td>';
//                                    echo '<td><a href="javascript:valid(0)" id="'.$tp->emp_id.'" class="class_details"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"> Details </button></a></td>';
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
    
   

