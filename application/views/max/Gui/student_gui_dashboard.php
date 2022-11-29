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
                                 
                                 <div id="chart_div" style="width: 100%; height: 300px;"></div>
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
                                 
                                 <div id="studetn_religious_wise" style="width: 400px; height: 300px;"></div>
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
                                 
                                 <!--<div id="program_wise"></div>-->
                                 <div id="program_wise" style="width: 400px; height: 300px;"  class="chart"></div>
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
                    <div class="span6">
                        <div class="widget">
                         
                            <div class="widget-content">
                                <div class="wrapper">
                                    	<div id="fsc_part_1" style="width: 600px; height: 310px"></div>
                                </div>
                            </div>


                              </div>
                        
                        </div>
                    <div class="span6">
                        <div class="widget">
                         
                            <div class="widget-content">
                                <div class="wrapper">
                                    <div id="fsc_part_2" style="width: 600px; height: 310px"></div>
                                    	 
                                </div>
                            </div>


                              </div>
                        
                        </div>
                    <div class="span6">
                        <div class="widget">
                         
                            <div class="widget-content">
                                <div class="wrapper">
                                    <div id="bscs" style="width: 600px; height: 310px"></div>
                                    	 
                                </div>
                            </div>


                              </div>
                        
                        </div>
                    <div class="span6">
                        <div class="widget">
                         
                            <div class="widget-content">
                                <div class="wrapper">
                                    <div id="hnd" style="width: 600px; height: 310px"></div>
                                    	 
                                </div>
                            </div>


                              </div>
                        
                        </div>
                    <div class="span6">
                        <div class="widget">
                         
                            <div class="widget-content">
                                <div class="wrapper">
                                    <div id="Degree" style="width: 600px; height: 310px"></div>
                                    	 
                                </div>
                            </div>


                              </div>
                        
                        </div>
                    <div class="span6">
                        <div class="widget">
                         
                            <div class="widget-content">
                                <div class="wrapper">
                                    <div id="Alevel" style="width: 600px; height: 310px"></div>
                                    	 
                                </div>
                            </div>


                              </div>
                        
                        </div>
         
                    </div>
                  
                  
          
<!--                <div class="row">
                  <div class="span12">
                        <div class="widget">
                          <div class="widget-header"> <i class="icon-bookmark"></i>
                              <h3>District wise Student GEO Map </h3>
                          </div>
                           /widget-header 
                         <div class="widget-content">
                               <div id="big_stats" class="cf">
                                 
                                 <div id="geo_div" style="width: 100%; height: 500px;"></div>
                                   .stat  
                                </div>


                              </div>
                           /widget-content  
                        </div>
         
                    </div>
                  
                  
                   
                   
              </div>-->
            </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Quota', ''],
          <?php 
          
          if($studetn_quta_wise):
              foreach($studetn_quta_wise as $std_quta_row):
              ?>
                 ["<?php echo $std_quta_row->name?>",  <?php echo $std_quta_row->count?>],  
                  <?php
              endforeach;
          endif;
          ?>
         
       
        ]);

        var options = {
            title   : 'Student Quota Wise Chart',
            hAxis   : {title: 'Quota',  titleTextStyle: {color: '#31c76e'}},
            vAxis   : {title: 'Number Of Students',  titleTextStyle: {color: '#31c76e'}},
            colors  : ['#00BBDE', '#fe6672', '#3D4A57', '#eeb058','#208e4c'],
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
         ["", "",],
         
         <?php
         
          foreach($studetn_religious_wise as $rb):
              ?>
            [" <?php echo $rb->title?>",<?php echo $rb->total?>],
            <?php
                
          endforeach;
         
         
         ?>
    ]);

    var options = {
        title       : 'Religious Wise Student Chart',
        hAxis       : {title: 'Religious Wise',  titleTextStyle: {color: '#31c76e'}},
        vAxis       : {title: 'Number Of Students',  titleTextStyle: {color: '#31c76e'}},
        seriesType  : 'bars',
        series      : {
            0       : {
            type    : 'line',
            color   : '#eeb058'
            },
         
         
      }
    };

    var chart = new google.visualization.ComboChart(document.getElementById('studetn_religious_wise'));
    chart.draw(data, options);
  }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
         ["", "",],
         
         <?php
         
          foreach($program_wise as $rb):
              ?>
            [" <?php echo $rb->programe_name?>",<?php echo $rb->count?>],
            <?php
                
          endforeach;
         
         
         ?>
    ]);

    var options = {
        title       : 'Program Wise Student Chart',
        hAxis       : {title: 'Program Name',  titleTextStyle: {color: '#31c76e'}},
        vAxis       : {title: 'Number Of Students',  titleTextStyle: {color: '#31c76e'}},
      
        seriesType  : 'bars',
        series      : {
            0       : {
            type    : 'line',
            color   : '#31c76e'
            },
         
         
      }
    };

    var chart = new google.visualization.ComboChart(document.getElementById('program_wise'));
    chart.draw(data, options);
  }
    </script>
<!--    <script type='text/javascript'>
     google.charts.load('current', {'packages': ['geochart']});
     google.charts.setOnLoadCallback(drawMarkersMap);

      function drawMarkersMap() {
      var data = google.visualization.arrayToDataTable([
        ['Distract',        'Total Student'],
        
            
        <?php
        
        if($Distract_wise):
            foreach($Distract_wise as  $ds_row):
            ?>
                ["<?php echo $ds_row->name?>",  <?php echo $ds_row->Total?>],           
              <?php
            endforeach;
        endif;
        ?>    
      
       
        
        
      ]);

      var options = {
        region      : 'PK',
        displayMode : 'markers',
        colorAxis   : {
        colors      : ['#eeb058', '#fe6672', '#3D4A57', '#eeb058','#208e4c']}
      };

      var chart = new google.visualization.GeoChart(document.getElementById('geo_div'));
      chart.draw(data, options);
    };
    </script>-->
    <script type="text/javascript">
         google.charts.load('current', {'packages':['corechart']});
         google.charts.setOnLoadCallback(drawChart);

         function drawChart() {
           var data = google.visualization.arrayToDataTable([
             ['Class', 'Students'],
              <?php
              if($fa_fsc_part_1):
                 foreach($fa_fsc_part_1 as $row_1):
                  ?>
                      ["<?php echo $row_1->sectionName?>",  <?php echo $row_1->student_count?>],

                      <?php
                 endforeach;
                  else:
                  echo "['0',  0],";
              endif;

              ?>
           ]);

           var options = {
           title       : 'Fa/FSc Part I Student Chart',
           curveType   : 'function',
           legend      : { position: 'bottom' },
           colors      : ['#FF7793', 'red', 'black'],
           hAxis       : { minValue: 0, maxValue: 9 },
           pointSize   : 5  

           };

           var chart = new google.visualization.LineChart(document.getElementById('fsc_part_1'));

           chart.draw(data, options);
         }
       </script>
    <script type="text/javascript">
         google.charts.load('current', {'packages':['corechart']});
         google.charts.setOnLoadCallback(drawChart);

         function drawChart() {
           var data = google.visualization.arrayToDataTable([
             ['Class', 'Students'],
              <?php
              if($fa_fsc_part_2):
                 foreach($fa_fsc_part_2 as $row_1):
                  ?>
                      ["<?php echo $row_1->sectionName?>",  <?php echo $row_1->student_count?>],

                      <?php
                 endforeach;
                  else:
                  echo "['0',  0],";
              endif;

              ?>
           ]);

           var options = {
           hAxis       : { minValue: 0, maxValue: 9 },
           pointSize   : 5,   
           title       : 'Fa/FSc Part II Student Chart',
           curveType   : 'function',
           legend      : { position: 'bottom' },
           colors      : ['#FF7793', 'red', 'black']

           };

           var chart = new google.visualization.LineChart(document.getElementById('fsc_part_2'));

           chart.draw(data, options);
         }
       </script>
    <script type="text/javascript">
         google.charts.load('current', {'packages':['corechart']});
         google.charts.setOnLoadCallback(drawChart);

         function drawChart() {
           var data = google.visualization.arrayToDataTable([
             ['Class', 'Students'],
              <?php
              if($bscs_clases):
                 foreach($bscs_clases as $row_1):
                  ?>
                      ["<?php echo $row_1->sectionName?>",  <?php echo $row_1->student_count?>],

                      <?php
                 endforeach;
                  else:
                  echo "['0',  0],";
              endif;

              ?>
           ]);

           var options = {

           hAxis       : { minValue: 0, maxValue: 9 },
           pointSize   : 5,   
           title       : 'BS (CS) Semester Wise Student Chart',
           curveType   : 'function',
           legend      : { position: 'bottom' },
           colors      : ['#4BC0C0', 'red', 'black']

           };

           var chart = new google.visualization.LineChart(document.getElementById('bscs'));

           chart.draw(data, options);
         }
       </script>
    <script type="text/javascript">
         google.charts.load('current', {'packages':['corechart']});
         google.charts.setOnLoadCallback(drawChart);

         function drawChart() {
           var data = google.visualization.arrayToDataTable([
             ['Class', 'Students'],
              <?php
              if($HND):
                 foreach($HND as $row_1):
                  ?>
                      ["<?php echo $row_1->sectionName?>",  <?php echo $row_1->student_count?>],

                      <?php
                 endforeach;
                  else:
                  echo "['0',  0],";
              endif;

              ?>
           ]);

           var options = {

               hAxis       : { minValue: 0, maxValue: 9 },
               pointSize   : 5,   
               title       : 'HND Semester Student Chart',
               curveType   : 'function',
               legend      : { position: 'bottom' },
               colors      : ['#CCB2FF', 'red', 'black']

           };

           var chart = new google.visualization.LineChart(document.getElementById('hnd'));

           chart.draw(data, options);
         }
       </script>
    <script type="text/javascript">
         google.charts.load('current', {'packages':['corechart']});
         google.charts.setOnLoadCallback(drawChart);

         function drawChart() {
           var data = google.visualization.arrayToDataTable([
             ['Class', 'Students'],
              <?php
              if($Degree):
                 foreach($Degree as $row_1):
                  ?>
                      ["<?php echo $row_1->sectionName?>",  <?php echo $row_1->student_count?>],

                      <?php
                 endforeach;
                  else:
                  echo "['0',  0],";
              endif;

              ?>
           ]);

           var options = {

             hAxis     : { minValue: 0, maxValue: 9 },
             pointSize : 5,   
              title    : 'DEGREE Student Wise Chart',
             curveType : 'function',
             legend    : { position: 'bottom' },
              colors   : ['#FFE6AA']

           };

           var chart = new google.visualization.LineChart(document.getElementById('Degree'));

           chart.draw(data, options);
         }
       </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Class', 'Students'],
           <?php
           if($Alevel):
              foreach($Alevel as $row_1):
               ?>
                   ["<?php echo $row_1->sectionName?>",  <?php echo $row_1->student_count?>],
                   
                   <?php
              endforeach;
               else:
               echo "['0',  0],";
           endif;
           
           ?>
        ]);

        var options = {
            hAxis       : { minValue: 0, maxValue: 9 },
            pointSize   : 5,   
            title       : 'A LEVEL Semester Wise Student Chart',
            curveType   : 'function',
            legend      : { position: 'bottom' },
            colors      : ['#FFB1C1']
           
        };

        var chart = new google.visualization.LineChart(document.getElementById('Alevel'));

        chart.draw(data, options);
      }
    </script>