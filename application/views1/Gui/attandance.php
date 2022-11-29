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
                  <div class="span6">
	      		
               <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Teacher Attendance Performance Report</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>Designation</th>
                    <th>Date </th>
                    <th>Section</th>
                    
                  </tr>
                </thead>
                <tbody>
                    <?php
//                    echo '<pre>';print_r($teacher_perf);die;
                    if($teacher_perf):
                        foreach($teacher_perf as $tp):
                        echo   '<tr>
                                <td>'.$tp->emp_name.'</td>
                                <td>'.$tp->father_name.'</td>
                                <td>'.$tp->emp_design.'</td>
                                <td>'.$tp->attendance_date.'</td>
                                <td>'.$tp->section_name.'</td>
                            </tr>';
                        endforeach;
                    endif;
                    ?>
               
                  
                
                </tbody>
              </table>
            </div>
            <!-- /widget-content --> 
          </div>	
	      		
	      		
		    </div> <!-- /span6 -->
                  <div class="span6">
	      		
               <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Non-Teacher Attendance Performance Report</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>Designation</th>
                    <th>Date </th>
                    <th>Section</th>
                    
                  </tr>
                </thead>
                <tbody>
                    <?php
//                    echo '<pre>';print_r($teacher_perf);die;
                    if($teacher_perf):
                        foreach($teacher_perf as $tp):
                        echo   '<tr>
                                <td>'.$tp->emp_name.'</td>
                                <td>'.$tp->father_name.'</td>
                                <td>'.$tp->emp_design.'</td>
                                <td>'.$tp->attendance_date.'</td>
                                <td>'.$tp->section_name.'</td>
                            </tr>';
                        endforeach;
                    endif;
                    ?>
               
                  
                
                </tbody>
              </table>
            </div>
            <!-- /widget-content --> 
          </div>	
	      		
	      		
		    </div> <!-- /span6 -->
              </div>
	      
			
	      
	      
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->
    
 
 

<script>
 

    var barChartData = {
        labels: [
            <?php
            foreach($reserved_seat as $stRow=>$key):
               echo '"('.$stRow.') '.$key->name.'",';
            endforeach; ?>],
        datasets: [
                     {
                        fillColor: "rgba(151,187,205,0.5)",
			strokeColor: "rgba(151,187,205,1)",
			data: [
                                        <?=$open?>, 
                                        <?=$Minority?>, 
                                        <?=$O_level?>, 
                                        <?=$HEQ?>, 
                                        <?=$disable?>, 
                                        <?=$es?>,
                                        <?=$fata?>,
                                        <?=$os?>,
                                        <?=$sport?>,
                                        <?=$girls?>,
                                        <?=$SC?>,
                                        <?=$Blc?>,
                                        
                                        ],
                               }]}
 

        var myLine = new Chart(document.getElementById("bar-chart").getContext("2d")).Bar(barChartData);
	 
	 
	</script>
       
           
          <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
             ['Task', "Religion Base Report"],
            <?php
                foreach($religion_base as $rb):
              ?>
                ['<?=$rb->title?>', <?=$rb->total?>],
            
                  <?php
            endforeach;
            
            ?>
      
        ]);

        var options = {
           title: 'Religion Base Report',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>