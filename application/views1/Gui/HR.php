<style>
    #big_stats  i{
        font-size: 13px;
        line-height: 23px;
    color: #000000;
    }
    #big_stats .stat:hover i {
    color: #000000;
}
#big_stats .stat{
    height: 58px;
}
h3 strong{
    color: #ff7f74;
}
.chart {
  width: 100%; 
  height:auto;
}
</style> 
 
   
<div class="main">
	
	<div class="main-inner">

	    <div class="container">
                
            
                <div class="row">
                    <div class="span4">
                        <div class="widget widget-nopad">


                          <!-- /widget-header -->
                          <div class="widget-content">
                            <div class="widget big-stats-container">
                              <div class="widget-content">
                               <div id="big_stats" class="cf">
                                 
                                 <div id="employeeGenderwise"></div>
                                  <!-- .stat --> 
                                </div>


                              </div>
                              <!-- /widget-content --> 

                            </div>
                          </div>
                        </div>
       
                <!-- /widget --> 
                    </div>
                    <div class="span4">
                        <div class="widget widget-nopad">


                          <!-- /widget-header -->
                          <div class="widget-content">
                            <div class="widget big-stats-container">
                              <div class="widget-content">
                               <div id="big_stats" class="cf">
                                 
                                  <div id="employeeCatWise" class="chart"></div>
                                  <!-- .stat --> 
                                </div>


                              </div>
                              <!-- /widget-content --> 

                            </div>
                          </div>
                        </div>
       
                <!-- /widget --> 
                    </div>
                    <div class="span4">
                        <div class="widget widget-nopad">


                          <!-- /widget-header -->
                          <div class="widget-content">
                            <div class="widget big-stats-container">
                              <div class="widget-content">
                               <div id="big_stats" class="cf">
                                 
                                  <div id="contractWise" class="chart"></div>
                                  <!-- .stat --> 
                                </div>


                              </div>
                              <!-- /widget-content --> 

                            </div>
                          </div>
                        </div>
       
                <!-- /widget --> 
                    </div>
                 </div>
                <div class="row">
                    <div class="span12">
                        <div class="widget widget-nopad">


                          <!-- /widget-header -->
                          <div class="widget-content">
                            <div class="widget big-stats-container">
                              <div class="widget-content">
                               <div id="big_stats" class="cf">
                                 
                                 <div id="DesignationWise" style="width: 1300px; height: 600px;" class="chart"></div>
                                  <!-- .stat --> 
                                </div>
                            </div>
                            </div>
                          </div>
                        </div>
                </div>
                </div>
                <div class="row">
                    <div class="span12">
                        <div class="widget widget-nopad">
                            <div class="widget-content">
                                <div class="widget big-stats-container">
                                    <div class="widget-content">
                                        <div id="big_stats" class="cf">
                                            <div id="scaleWise" style="width: 1200px; height: 600px;" class="chart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->
 
    
    
    <script type="text/javascript">
    function drawChart () {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Name');
    data.addColumn('number', 'Value');

//    data.addRows([
//        ['Contract',     28],
//        ['reg',     42],
//        
//    ]);
    data.addRows([
        ['Male <?php echo $all_male_employee?>',     <?php echo $all_male_employee?>],
        ['Female <?php echo $all_female_employee?>',      <?php echo $all_female_employee?>],
    ]);
    
    var total = google.visualization.data.group(data, [{
        type: 'boolean',
        column: 0,
        modifier: function () {return true;}
    }], [{
        type: 'number',
        column: 1,
        aggregation: google.visualization.data.sum
    }]);
    
   
    
    var chart = new google.visualization.PieChart(document.querySelector('#employeeGenderwise'));
    chart.draw(data, {
        height: 250,
        width: 400,
        pieHole: 0.4,
        pieSliceText: 'value',
        title:'Employee Gender Wise',
        sliceVisibilityThreshold: 0,
        colors: ['#00BBDE', '#fe6672', '#3D4A57', '#eeb058','#208e4c'],
        
    });
    
}
    google.load('visualization', '1', {packages:['corechart'], callback: drawChart});
    
    
    </script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Employee Catetory Wise'],
         
         <?php
         
          foreach($category_wise as $rb):
              ?>
            ['<?php echo $rb->title?> <?php echo $rb->total?>',<?php echo $rb->total?>],
            <?php
                
          endforeach;
         
         
         ?>
      
          
        ]);

        var options = {
            title       : 'Employee Catetory Wise',
            pieHole     : 0.4,
            pieSliceText: 'value',
            height      : 250,
            width       : 400,
            colors: ['#00BBDE', '#fe6672', '#3D4A57', '#eeb058','#208e4c']
//          pieSliceText: 'value-and-percentage'
        };
        
        

        var chart = new google.visualization.PieChart(document.getElementById('employeeCatWise'));
        chart.draw(data, options);
      }
    </script>
   
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
         <?php
         
          foreach($contract_wise as $rb):
              ?>
            ['<?php echo $rb->title?> <?php echo $rb->total?>',<?php echo $rb->total?>],
            <?php
                
          endforeach;
         
         
         ?>
        ]);

        var options = {
            title       : 'Employee Nature wise',
            pieHole     : 0.4,
            pieSliceText: 'value',
            height      : 250,
            width       : 400,
            colors: ['#00BBDE', '#fe6672', '#3D4A57', '#eeb058','#208e4c']
        };
        
        

        var chart = new google.visualization.PieChart(document.getElementById('contractWise'));

        chart.draw(data, options);
      }
    </script>
 
     
     
    
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
         ["", "Number of employee",],
         
         <?php
         
          foreach($designation_wise as $rb):
              ?>
            [" <?php echo $rb->title?>",<?php echo $rb->total?>],
            <?php
                
          endforeach;
         
         
         ?>
    ]);

    var options = {
        hAxis: {title: 'Quota',  titleTextStyle: {color: '#00BBDE'}},
          vAxis: {title: 'Number Of Employee',  titleTextStyle: {color: '#fe6672'}},
        
        
        title       : 'Designation Wise Chart',
      
        seriesType  : 'bars',
 
         legend: 'none',
          colors: ['#eeb058', '#fe6672', '#3D4A57', '#eeb058','#208e4c']
    };

    var chart = new google.visualization.ComboChart(document.getElementById('DesignationWise'));
    chart.draw(data, options);
  }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
         ["", "Number of employee"],
         
         <?php
         
          foreach($scale_wise as $rb):
              ?>
            [" <?php echo $rb->title?> scale",<?php echo $rb->total?>],
            <?php
                
          endforeach;
         
         
         ?>
    ]);

    var options = {
        title       : 'Employee Scale Wise Chart',
      vAxis: {title: 'Number of employee'},
        hAxis       : {title: 'scale'},
        seriesType  : 'bars',
        series      : {0: {type: 'line',color: '#ff7f74'}
         
      }
    };

    var chart = new google.visualization.ComboChart(document.getElementById('scaleWise'));
    chart.draw(data, options);
  }
    </script>