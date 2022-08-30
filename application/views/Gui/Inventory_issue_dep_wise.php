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
                     
                    <div class="row">
                    
                  
                    <div class="span12">
                        <div class="widget widget-nopad">


                            
                          <div class="widget-content">
                            <div class="widget big-stats-container">
                              <div class="widget-content">
                               <div id="big_stats" class="cf">
                                 
                                <div id="stationery_current_year" style="width: 100%; height: 500px;"></div>
                                </div>


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
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data1 = google.visualization.arrayToDataTable([
          ['Year', 'A4', 'uniPin','letter','paper'],
          ['Science'    ,1000   ,23     ,1000   ,3],
          ['IT'         ,1170   ,460    ,110    ,460],
          ['Finance'    ,660    ,1120   ,120    ,23],
          ['Principal'  ,1030   ,540    ,1170   ,460]
        ]);

  var data = google.visualization.arrayToDataTable([
          ['Item name', 'Quantity '],
          <?php 
          
          if($current_year):
              foreach($current_year as $cRow):
           echo '["'.$cRow->itm_name.'('.$cRow->quantity.')",'.$cRow->quantity.'],';
              endforeach;
          endif;
          
          ?>
       
        ]);
        var options = {
          title: "<?php echo $dep_name->dept_name?> (<?php echo $financial_year->year?>) Year Stationery Chart",
          hAxis: {title: 'Current Year',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('stationery_current_year'));
        chart.draw(data, options);
      }
    </script>
  
