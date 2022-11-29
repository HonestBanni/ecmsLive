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
                  
             
                
            </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->
  
  
  <script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawStacked);

function drawStacked() {
        var data = google.visualization.arrayToDataTable([
        ['Item Name', 'Total', { role: 'style' } ],
    
          
              
            <?php 
             $class = array(
                        '#00BBDE; stroke-width: 4; fill-color: #00BBDE',
                        '#fe6672; stroke-opacity: 0.6; stroke-width: 8; fill-color: #fe6672; fill-opacity: 0.2',
                        
                        '#3D4A57; stroke-width: 4; fill-color: #3D4A57',
                        '#eeb058; stroke-opacity: 0.6; stroke-width: 8; fill-color: #eeb058; fill-opacity: 0.2',
                        
                        '#208e4c; stroke-width: 4; fill-color: #208e4c',
                        
                    );
            
        if($invt_block_details):
            foreach($invt_block_details as $maCat):
              $k = array_rand($class);
            ?>
            
                ["<?php echo $maCat->itm_name?>", <?php echo $maCat->Total?>, 'color:<?php echo $class[$k]?>'],
            
            <?php
            endforeach;
        endif;
        
        
        ?>   
   
        ]);

     var options = {
        title       : '<?php echo $bb_items->bb_name?> Block Details',
     
        seriesType  : 'bars',
        bar: {groupWidth: "30%"},
        series      : {5: {type: 'line'}
            
         
      }
    }
      var chart = new google.visualization.ComboChart(document.getElementById('invt_stock'));
      chart.draw(data, options);
    }
  </script>
  
