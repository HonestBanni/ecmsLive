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
                    
                    
                    
                       <?php
                            
                             if($dep_wise_issue):
                                 foreach($dep_wise_issue as $row):
                                 
                                 ?>   
                    
                    
                   <div class="span4">
                        <div class="widget">
                            
                          <!-- /widget-header -->
                          <div class="widget-content">
                            <div class="shortcuts"> 
                                 <div id="<?php echo $row->iss_dept_id;?>" style="width: 100%; height: 250px;"></div>
                                 
                             </div>
                     <a href="deprtIssueDetails/<?php $row->iss_dept_id;?>"  class="shortcut" onclick="window.open('deprtIssueDetails/<?php echo $row->iss_dept_id;?>', 'newwindow', 'width=1000, height=650'); return false;">
                                             
                                             <?php echo $row->dept_name;?> More Details
                                        </a>
                          </div>
                  
                        </div>
         
                    </div>
                    
                    
                           <?php
                                 endforeach;
                             endif;
                               ?>   
 
                    
                 </div>
            
 
                <div class="row">
                     
                    <div class="span12   ">
                        <div class="widget widget-nopad">


                          <!-- /widget-header -->
                          <div class="widget-content">
                            <div class="widget big-stats-container">
                              <div class="widget-content">
                               <div id="big_stats" class="cf">
                                 
                                 <div id="inventory_nature" style="width: 100%; height: 600px;"></div>
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
                     
                    <div class="span12   ">
                        <div class="widget widget-nopad">


                          <!-- /widget-header -->
                          <div class="widget-content">
                            <div class="widget big-stats-container">
                              <div class="widget-content">
                               <div id="big_stats" class="cf">
                                 
                                 <div id="invt_stock" style="width: 100%; height: 600px;"></div>
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
                        <div class="widget">
                          <div class="widget-header"> <i class="icon-bookmark"></i>
                              <h3>Block fixed assets chart</h3>
                          </div>
                          <!-- /widget-header -->
                          <div class="widget-content">
                            <div class="shortcuts"> 
                                <?php
                                if($invt_stock_deprt):
                                foreach($invt_stock_deprt as $det_row):
                                    echo ' <a href="inventoryDetails/'.$det_row->bb_id.'" class="shortcut">
                                                <i class="shortcut-icon icon-list-alt"></i>
                                                <span class="shortcut-label">'.$det_row->bb_name.'</span> 
                                            </a>';
                                endforeach;
                                endif;
                                
                                ?>
                           </div>
                            <!-- /shortcuts --> 
                          </div>
                          <!-- /widget-content --> 
                        </div>
         
                    </div>
                    
                 </div>
             
                
            </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->
 
  <script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawStacked);

function drawStacked() {
        var data = google.visualization.arrayToDataTable([
        ['Department Name', 'Quantity', { role: 'style' } ],
    
          
              
            <?php 
             $class = array(
                      '#00BBDE; stroke-width: 4; fill-color: #00BBDE',
                        '#fe6672; stroke-opacity: 0.6; stroke-width: 8; fill-color: #fe6672; fill-opacity: 0.2',
                        
                        '#3D4A57; stroke-width: 4; fill-color: #3D4A57',
                        '#eeb058; stroke-opacity: 0.6; stroke-width: 8; fill-color: #eeb058; fill-opacity: 0.2',
                        
                        '#208e4c; stroke-width: 4; fill-color: #208e4c',
                        
                    );
            
        if($invt_block_wise):
            foreach($invt_block_wise as $maCat):
              $k = array_rand($class);
            ?>
            
                ['<?php echo $maCat->bb_name?>', <?php echo $maCat->quantity?>, 'color:<?php echo $class[$k]?>'],
            
            <?php
            endforeach;
        endif;
        
        
        ?>   
    ]);

     var options = {
        title       : 'Bloack Wise Fixed Asset Chart',
      
        seriesType  : 'bars',
        bar: {groupWidth: "50%"},
        series      : {5: {type: 'line'}
            
         
      }
    }
      var chart = new google.visualization.ComboChart(document.getElementById('inventory_nature'));
      chart.draw(data, options);
    }
  </script>
  
  <script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawStacked);

function drawStacked() {
        var data = google.visualization.arrayToDataTable([
        ['Item Name', 'Quantity', { role: 'style' } ],
    
          
              
            <?php 
             $class = array(
                      '#00BBDE; stroke-width: 4; fill-color: #00BBDE',
                        '#fe6672; stroke-opacity: 0.6; stroke-width: 8; fill-color: #fe6672; fill-opacity: 0.2',
                        
                        '#3D4A57; stroke-width: 4; fill-color: #3D4A57',
                        '#eeb058; stroke-opacity: 0.6; stroke-width: 8; fill-color: #eeb058; fill-opacity: 0.2',
                        
                        '#208e4c; stroke-width: 4; fill-color: #208e4c',
                        
                    );
            
        if($invt_stock):
            foreach($invt_stock as $maCat):
              $k = array_rand($class);
            ?>
            
                ['<?php echo $maCat->itm_name?>', <?php echo $maCat->item_quantity?>, 'color:<?php echo $class[$k]?>'],
            
            <?php
            endforeach;
        endif;
        
        
        ?>   
   
        ]);

     var options = {
        title       : 'Inventory Stock Chart(Store)',
     
        seriesType  : 'bars',
        bar: {groupWidth: "90%"},
        series      : {5: {type: 'line'}
            
         
      }
    }
      var chart = new google.visualization.ComboChart(document.getElementById('invt_stock'));
      chart.draw(data, options);
    }
  </script>
 
<?php

   
    foreach($dep_wise_issue as $row):
        
        
              $financial_year = $this->CRUDModel->get_where_row('financial_year',array('status'=>1));
        $where      = array( 
            'dept_id'           =>$row->iss_dept_id,
            'itm_chart_flag'    =>1    
                );
        //Current year
        $current_year = array(
            'from_date'         =>$financial_year->year_start,
            'to_date'           =>$financial_year->year_end,
            
        );
         $current_stat = $this->GuiModel->current_datewise_issue($where,$current_year);
         
        
           $class = array('#00BBDE',
                        '#fe6672',
                        '#3D4A57',
                        '#eeb058',
                        '#208e4c',
                        
                    );
        
        
       $k = array_rand($class);
    ?>  
   
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
          
          if($current_stat):
              foreach($current_stat as $cRow):
           echo '["'.$cRow->itm_name.'('.$cRow->quantity.')",'.$cRow->quantity.'],';
              endforeach;
              else:
                  echo "['nill'    ,0]";
          endif;
          
          ?>
       
        ]);
       
     
        var options = {
          title: "<?php echo $row->dept_name?>  Year Stationery Chart",
          hAxis: {title: 'Current Year',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0},
           colors: ['<?php echo $class[$k]?>']
        };

        var chart = new google.visualization.AreaChart(document.getElementById('<?php echo $row->iss_dept_id?>'));
        chart.draw(data, options);
      }
    </script>
  
  <?php

 
    endforeach;

    ?>  

?>