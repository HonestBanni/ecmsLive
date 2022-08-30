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
    
        <!-- /span4 -->
         <div class="span12">
          <div class="widget widget-nopad">
              
            <div class="widget-header"> <i class="icon-list-alt"></i>
             
                <h3>Student Gender Report Year wise </h3>
     
            </div>
              
            <!-- /widget-header -->
            <div class="widget-content">
                <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        
                        <th>Program</th>
                        <th>Male</th>
                        <th>Female</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                     <tr>
                        
                        <td>HSSC Part I</td>
                        <?php
                        $total = 0;
                        $gender_total   = 0;
                        $male           = 0;
                        $female         = 0;
                        $male_total     = 0;
                        $female_total   = 0;
                        foreach($gender_1st_year_mor as $gender_row):
                        if($gender_row->gender_id == 1):
                            $male ++;
                            else:
                             $female ++;   
                        endif;    
                        $gender_total =$male+$female;
                        endforeach;
                        echo ' <td>'.$male.'</td>';
                        echo ' <td>'.$female.'</td>';
                        echo ' <td>'.$gender_total.'</td>';
                        $total += $gender_total;
                        $male_total     +=$male;
                        $female_total   +=$female;
                        ?>
                        
                       
                    </tr>

                     <tr>
                        
                        <td>HSSC Part II</td>
                        <?php
                        $gender_total   = 0;
                        $male           = 0;
                        $female         = 0;
                        foreach($gender_2nd_year_mor as $gender_row):
                        if($gender_row->gender_id == 1):
                            $male ++;
                            else:
                             $female ++;   
                        endif;    
                        $gender_total =$male+$female;
                        endforeach;
                        echo ' <td>'.$male.'</td>';
                        echo ' <td>'.$female.'</td>';
                        echo ' <td>'.$gender_total.'</td>';
                        $total          += $gender_total;
                        $male_total     +=$male;
                        $female_total   +=$female;
                        ?>
                        
                       
                    </tr>
                    
                     <tr>
                        
                        <td>B.A/B.Sc 4<sup>th</sup> Year</td>
                        <?php
                        $gender_total   = 0;
                        $male           = 0;
                        $female         = 0;
                        foreach($BSC_4th as $gender_row):
                        if($gender_row->gender_id == 1):
                            $male ++;
                            else:
                             $female ++;   
                        endif;    
                        $gender_total =$male+$female;
                        endforeach;
                        echo ' <td>'.$male.'</td>';
                        echo ' <td>'.$female.'</td>';
                        echo ' <td>'.$gender_total.'</td>';
                        $total          += $gender_total;
                        $male_total     +=$male;
                        $female_total   +=$female;
                        ?>
                        
                       
                    </tr>
                     
                     <tr>
                       
                        <td>BS (CS)</td>
                        <?php
                        $gender_total   = 0;
                        $male           = 0;
                        $female         = 0;
                        foreach($Bscs_gender_m as $gender_row):
                        if($gender_row->gender_id == 1):
                            $male ++;
                            else:
                             $female ++;   
                        endif;    
                        $gender_total =$male+$female;
                        endforeach;
                        echo ' <td>'.$male.'</td>';
                        echo ' <td>'.$female.'</td>';
                        echo ' <td>'.$gender_total.'</td>';
                        $total          += $gender_total;
                        $male_total     +=$male;
                        $female_total   +=$female;
                        ?>
                        
                       
                    </tr>
                       <tr>
                        
                        <td>HND</td>
                        <?php
                        $gender_total   = 0;
                        $male           = 0;
                        $female         = 0;
                        foreach($HND_gender as $gender_row):
                            
                        if($gender_row->gender_id == 1):
                            $male ++;
                            else:
                             $female ++;   
                        endif;    
                        $gender_total =$male+$female;
                        endforeach;
                        echo ' <td>'.$male.'</td>';
                        echo ' <td>'.$female.'</td>';
                        echo ' <td>'.$gender_total.'</td>';
                        $total          += $gender_total;
                        $male_total     +=$male;
                        $female_total   +=$female;
                        ?>
                        
                       
                    </tr>
                      <tr>
                        
                        <td>EDSML</td>
                        <?php
                        $gender_total   = 0;
                        $male           = 0;
                        $female         = 0;
                        foreach($DSMAL_gender as $gender_row):
                        if($gender_row->gender_id == 1):
                            $male ++;
                            else:
                             $female ++;   
                        endif;    
                        $gender_total =$male+$female;
                        endforeach;
                        echo ' <td>'.$male.'</td>';
                        echo ' <td>'.$female.'</td>';
                        echo ' <td>'.$gender_total.'</td>';
                        $total          += $gender_total;
                        $male_total     +=$male;
                        $female_total   +=$female;
                        ?>
                      </tr>
                      <tr>
                        <td>BS-ENGLISH</td>
                        <?php
                        $gender_total   = 0;
                        $male           = 0;
                        $female         = 0;
                        foreach($BSE_gender as $gender_row):
                        if($gender_row->gender_id == 1):
                            $male ++;
                            else:
                             $female ++;   
                        endif;    
                        $gender_total =$male+$female;
                        endforeach;
                        echo ' <td>'.$male.'</td>';
                        echo ' <td>'.$female.'</td>';
                        echo ' <td>'.$gender_total.'</td>';
                        $total          += $gender_total;
                        $male_total     +=$male;
                        $female_total   +=$female;
                        ?>
                      </tr>
                    <tr>
                        <td>BBA</td>
                        <?php
                        $gender_total   = 0;
                        $male           = 0;
                        $female         = 0;
                        foreach($BBA_gender as $gender_row):
                        if($gender_row->gender_id == 1):
                            $male ++;
                            else:
                             $female ++;   
                        endif;    
                        $gender_total =$male+$female;
                        endforeach;
                        echo ' <td>'.$male.'</td>';
                        echo ' <td>'.$female.'</td>';
                        echo ' <td>'.$gender_total.'</td>';
                        $total          += $gender_total;
                        $male_total     +=$male;
                        $female_total   +=$female;
                        ?>
                      </tr>
                    <tr>
                        <td>BS LAW</td>
                        <?php
                        $gender_total   = 0;
                        $male           = 0;
                        $female         = 0;
                        foreach($BSLAW_gender as $gender_row):
                        if($gender_row->gender_id == 1):
                            $male ++;
                            else:
                             $female ++;   
                        endif;    
                        $gender_total =$male+$female;
                        endforeach;
                        echo ' <td>'.$male.'</td>';
                        echo ' <td>'.$female.'</td>';
                        echo ' <td>'.$gender_total.'</td>';
                        $total          += $gender_total;
                        $male_total     +=$male;
                        $female_total   +=$female;
                        ?>
                      </tr>
                    <tr>
                        <td>BS ECONOMICS</td>
                        <?php
                        $gender_total   = 0;
                        $male           = 0;
                        $female         = 0;
                        foreach($BSECO_gender as $gender_row):
                        if($gender_row->gender_id == 1):
                            $male ++;
                            else:
                             $female ++;   
                        endif;    
                        $gender_total =$male+$female;
                        endforeach;
                        echo ' <td>'.$male.'</td>';
                        echo ' <td>'.$female.'</td>';
                        echo ' <td>'.$gender_total.'</td>';
                        $total          += $gender_total;
                        $male_total     +=$male;
                        $female_total   +=$female;
                        ?>
                      </tr>
                    <tr>
                    <tr>
                        <td>BS POLITICAL SCIENCE</td>
                        <?php
                        $gender_total   = 0;
                        $male           = 0;
                        $female         = 0;
                        foreach($BSPOL_gender as $gender_row):
                        if($gender_row->gender_id == 1):
                            $male ++;
                            else:
                             $female ++;   
                        endif;    
                        $gender_total =$male+$female;
                        endforeach;
                        echo ' <td>'.$male.'</td>';
                        echo ' <td>'.$female.'</td>';
                        echo ' <td>'.$gender_total.'</td>';
                        $total          += $gender_total;
                        $male_total     +=$male;
                        $female_total   +=$female;
                        ?>
                      </tr>
                    <tr>
                        
                        <td>A Level</td>
                        <?php
                        $gender_total   = 0;
                        $male           = 0;
                        $female         = 0;
                        foreach($A_Level as $gender_row):
                        if($gender_row->gender_id == 1):
                            $male ++;
                            else:
                             $female ++;   
                        endif;    
                        $gender_total =$male+$female;
                        endforeach;
                        echo ' <td>'.$male.'</td>';
                        echo ' <td>'.$female.'</td>';
                        echo ' <td>'.$gender_total.'</td>';
                        $total          += $gender_total;
                        $male_total     +=$male;
                        $female_total   +=$female;
                        ?>
                      </tr>
                       <tr> 
                        <td>CHINESE</td>
                        <?php
                        $gender_total   = 0;
                        $male           = 0;
                        $female         = 0;
                        foreach($Chinese as $gender_row):
                        if($gender_row->gender_id == 1):
                            $male ++;
                            else:
                             $female ++;   
                        endif;    
                        $gender_total =$male+$female;
                        endforeach;
                        echo ' <td>'.$male.'</td>';
                        echo ' <td>'.$female.'</td>';
                        echo ' <td>'.$gender_total.'</td>';
                        $total          += $gender_total;
                        $male_total     +=$male;
                        $female_total   +=$female;
                        ?>
                      </tr>
                    <tr> 
                        <td>GERMAN</td>
                        <?php
                        $gender_total   = 0;
                        $male           = 0;
                        $female         = 0;
                        foreach($German as $gender_row):
                        if($gender_row->gender_id == 1):
                            $male ++;
                            else:
                             $female ++;   
                        endif;    
                        $gender_total =$male+$female;
                        endforeach;
                        echo ' <td>'.$male.'</td>';
                        echo ' <td>'.$female.'</td>';
                        echo ' <td>'.$gender_total.'</td>';
                        $total          += $gender_total;
                        $male_total     +=$male;
                        $female_total   +=$female;
                        ?>
                      </tr>
                      <tr> 
                        <td>PASHTO</td>
                        <?php
                        $gender_total   = 0;
                        $male           = 0;
                        $female         = 0;
                        foreach($Pashto as $gender_row):
                        if($gender_row->gender_id == 1):
                            $male ++;
                            else:
                             $female ++;   
                        endif;    
                        $gender_total =$male+$female;
                        endforeach;
                        echo ' <td>'.$male.'</td>';
                        echo ' <td>'.$female.'</td>';
                        echo ' <td>'.$gender_total.'</td>';
                        $total          += $gender_total;
                        $male_total     +=$male;
                        $female_total   +=$female;
                        ?>
                      </tr>
                    <tr> 
                        <td>ENGLISH</td>
                        <?php
                        $gender_total   = 0;
                        $male           = 0;
                        $female         = 0;
                        foreach($english as $gender_row):
                        if($gender_row->gender_id == 1):
                            $male ++;
                            else:
                             $female ++;   
                        endif;    
                        $gender_total =$male+$female;
                        endforeach;
                        echo ' <td>'.$male.'</td>';
                        echo ' <td>'.$female.'</td>';
                        echo ' <td>'.$gender_total.'</td>';
                        $total          += $gender_total;
                        $male_total     +=$male;
                        $female_total   +=$female;
                        ?>
                      </tr>   
                      <tr>
                         
                        <td>TOTAL</td>
                        <td><?php echo $male_total?></td>
                        <td><?php echo $female_total?></td>
                        <td><?php echo $total?></td>
                      
                      </tr>
                </tbody>
                </table>
            </div>
          </div>
       
          <!-- /widget --> 
        </div>
         <div class="span12">
          <div class="widget widget-nopad">
              
            <div class="widget-header"> <i class="icon-list-alt"></i>
             
                <h3>Student Different Religions </h3>
     
            </div>
              
            <!-- /widget-header -->
            <div class="widget-content">
                <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                         
                        <th>Program</th>
                        <th>Muslim</th>
                        <th>Christian</th>
                        <th>Hindu</th>
                        <th>Sikh</th>
                        <th>Other</th>
                        <th>Total</th>
                        
                    </tr>
                </thead>
                <tbody>
                     <tr>
                         
                        <td>HSSC Part I</td>
                        <?php
                        $total              = 0;
                        $Muslim             = 0;
                        $Christian          = 0;
                        $Hindu              = 0;
                        $Sikh               = 0;
                        $other              = 0;
                        $Muslim_total       = 0;
                        $Christian_total    = 0;
                        $Hindu_total        = 0;
                        $Sikh_total         = 0;
                        $other_total        = 0;
                        $relg_total         = 0;
                        
                         
                        
                        foreach($gender_1st_year_mor as $gender_row):
                        if($gender_row->religion_id == 1):
                             $Muslim ++;
                        endif;    
                        if($gender_row->religion_id == 2):
                             $Christian ++;
                        endif;    
                        if($gender_row->religion_id == 3):
                             $Hindu ++;
                        endif;    
                        if($gender_row->religion_id == 4):
                             $Sikh ++;
                        endif;    
                        if($gender_row->religion_id == 5 || $gender_row->religion_id == 6 || $gender_row->religion_id == 7 ):
                             $other ++;
                        endif;    
                        $relg_total =$other+$Sikh+$Hindu+$Christian+$Muslim;
                        endforeach;
                        echo ' <td>'.$Muslim.'</td>';
                        echo ' <td>'.$Christian.'</td>';
                        echo ' <td>'.$Hindu.'</td>';
                        echo ' <td>'.$Sikh.'</td>';
                        echo ' <td>'.$other.'</td>';
                        echo ' <td>'.$relg_total.'</td>';
                        
                        
                       
                        $Muslim_total       += $Muslim;
                        $Christian_total    += $Christian;
                        $Hindu_total        += $Hindu;
                        $Sikh_total         += $Sikh;
                        $other_total        += $other;
                        $total +=           $relg_total;
                        ?>
                        
                       
                    </tr>
                      
                     <tr>
                        
                        <td>HSSC Part II</td>
                 
                        <?php
                        $relg_total         = 0;
                        $Muslim             = 0;
                        $Christian          = 0;
                        $Hindu              = 0;
                        $Sikh               = 0;
                        $other              = 0;
                        foreach($gender_2nd_year_mor as $gender_row):
                        if($gender_row->religion_id == 1):
                             $Muslim ++;
                        endif;    
                        if($gender_row->religion_id == 2):
                             $Christian ++;
                        endif;    
                        if($gender_row->religion_id == 3):
                             $Hindu ++;
                        endif;    
                        if($gender_row->religion_id == 4):
                             $Sikh ++;
                        endif;    
                        if($gender_row->religion_id == 5 || $gender_row->religion_id == 6 || $gender_row->religion_id == 7 ):
                             $other ++;
                        endif;    
                        $relg_total =$other+$Sikh+$Hindu+$Christian+$Muslim;
                        endforeach;
                        
                        echo ' <td>'.$Muslim.'</td>';
                        echo ' <td>'.$Christian.'</td>';
                        echo ' <td>'.$Hindu.'</td>';
                        echo ' <td>'.$Sikh.'</td>';
                        echo ' <td>'.$other.'</td>';
                        echo ' <td>'.$relg_total.'</td>';
                        
                        
                       
                        $Muslim_total       += $Muslim;
                        $Christian_total    += $Christian;
                        $Hindu_total        += $Hindu;
                        $Sikh_total         += $Sikh;
                        $other_total        += $other;
                        $total +=           $relg_total;
                        ?>
                       
                    </tr>
                      
                     <tr>
                         
                        <td>B.A/B.Sc 4<sup>th</sup> Years</td>
                        <?php
                        $relg_total         = 0;
                        $Muslim             = 0;
                        $Christian          = 0;
                        $Hindu              = 0;
                        $Sikh               = 0;
                        $other              = 0;
                        foreach($BSC_4th as $gender_row):
                        if($gender_row->religion_id == 1):
                             $Muslim ++;
                        endif;    
                        if($gender_row->religion_id == 2):
                             $Christian ++;
                        endif;    
                        if($gender_row->religion_id == 3):
                             $Hindu ++;
                        endif;    
                        if($gender_row->religion_id == 4):
                             $Sikh ++;
                        endif;    
                        if($gender_row->religion_id == 5 || $gender_row->religion_id == 6 || $gender_row->religion_id == 7 ):
                             $other ++;
                        endif;    
                        $relg_total =$other+$Sikh+$Hindu+$Christian+$Muslim;
                        endforeach;
                        
                        echo ' <td>'.$Muslim.'</td>';
                        echo ' <td>'.$Christian.'</td>';
                        echo ' <td>'.$Hindu.'</td>';
                        echo ' <td>'.$Sikh.'</td>';
                        echo ' <td>'.$other.'</td>';
                        echo ' <td>'.$relg_total.'</td>';
                        
                        
                       
                        $Muslim_total       += $Muslim;
                        $Christian_total    += $Christian;
                        $Hindu_total        += $Hindu;
                        $Sikh_total         += $Sikh;
                        $other_total        += $other;
                        $total +=           $relg_total;
                        ?>
                             
                        
                       
                    </tr>
                     <tr>
                         
                        <td>BS (CS)</td>
                        
                            
                            <?php
                        $relg_total         = 0;
                        $Muslim             = 0;
                        $Christian          = 0;
                        $Hindu              = 0;
                        $Sikh               = 0;
                        $other              = 0;
                        foreach($Bscs_gender_m as $gender_row):
                        if($gender_row->religion_id == 1):
                             $Muslim ++;
                        endif;    
                        if($gender_row->religion_id == 2):
                             $Christian ++;
                        endif;    
                        if($gender_row->religion_id == 3):
                             $Hindu ++;
                        endif;    
                        if($gender_row->religion_id == 4):
                             $Sikh ++;
                        endif;    
                        if(
                                $gender_row->religion_id == 5 || 
                                $gender_row->religion_id == 6 || 
                                $gender_row->religion_id == 7 
                                ):
                             $other ++;
                        endif;    
                        $relg_total =$other+$Sikh+$Hindu+$Christian+$Muslim;
                        endforeach;
                        
                        echo ' <td>'.$Muslim.'</td>';
                        echo ' <td>'.$Christian.'</td>';
                        echo ' <td>'.$Hindu.'</td>';
                        echo ' <td>'.$Sikh.'</td>';
                        echo ' <td>'.$other.'</td>';
                        echo ' <td>'.$relg_total.'</td>';
                        
                        
                       
                        $Muslim_total       += $Muslim;
                        $Christian_total    += $Christian;
                        $Hindu_total        += $Hindu;
                        $Sikh_total         += $Sikh;
                        $other_total        += $other;
                        $total +=           $relg_total;
                        ?>
                            
                            
                        
                       
                    </tr>
                     
                       <tr>
                      
                        <td>HND</td>
                        
                            <?php
                        $relg_total         = 0;
                        $Muslim             = 0;
                        $Christian          = 0;
                        $Hindu              = 0;
                        $Sikh               = 0;
                        $other              = 0;
                        foreach($HND_gender as $gender_row):
                        if($gender_row->religion_id == 1):
                             $Muslim ++;
                        endif;    
                        if($gender_row->religion_id == 2):
                             $Christian ++;
                        endif;    
                        if($gender_row->religion_id == 3):
                             $Hindu ++;
                        endif;    
                        if($gender_row->religion_id == 4):
                             $Sikh ++;
                        endif;    
                        if($gender_row->religion_id == 5 || $gender_row->religion_id == 6 || $gender_row->religion_id == 7 ):
                             $other ++;
                        endif;    
                        $relg_total =$other+$Sikh+$Hindu+$Christian+$Muslim;
                        endforeach;
                        
                        echo ' <td>'.$Muslim.'</td>';
                        echo ' <td>'.$Christian.'</td>';
                        echo ' <td>'.$Hindu.'</td>';
                        echo ' <td>'.$Sikh.'</td>';
                        echo ' <td>'.$other.'</td>';
                        echo ' <td>'.$relg_total.'</td>';
                        
                        
                       
                        $Muslim_total       += $Muslim;
                        $Christian_total    += $Christian;
                        $Hindu_total        += $Hindu;
                        $Sikh_total         += $Sikh;
                        $other_total        += $other;
                        $total +=           $relg_total;
                        ?>
                           
                        
                       
                    </tr>
                      <tr>
                         
                        <td>DSML</td>
                        
                            <?php
                        $relg_total         = 0;
                        $Muslim             = 0;
                        $Christian          = 0;
                        $Hindu              = 0;
                        $Sikh               = 0;
                        $other              = 0;
                        foreach($DSMAL_gender as $gender_row):
                        if($gender_row->religion_id == 1):
                             $Muslim ++;
                        endif;    
                        if($gender_row->religion_id == 2):
                             $Christian ++;
                        endif;    
                        if($gender_row->religion_id == 3):
                             $Hindu ++;
                        endif;    
                        if($gender_row->religion_id == 4):
                             $Sikh ++;
                        endif;    
                        if($gender_row->religion_id == 5 || $gender_row->religion_id == 6 || $gender_row->religion_id == 7 ):
                             $other ++;
                        endif;    
                        $relg_total =$other+$Sikh+$Hindu+$Christian+$Muslim;
                        endforeach;
                        
                        echo ' <td>'.$Muslim.'</td>';
                        echo ' <td>'.$Christian.'</td>';
                        echo ' <td>'.$Hindu.'</td>';
                        echo ' <td>'.$Sikh.'</td>';
                        echo ' <td>'.$other.'</td>';
                        echo ' <td>'.$relg_total.'</td>';
                        
                        
                       
                        $Muslim_total       += $Muslim;
                        $Christian_total    += $Christian;
                        $Hindu_total        += $Hindu;
                        $Sikh_total         += $Sikh;
                        $other_total        += $other;
                        $total +=           $relg_total;
                        ?>
                            
                          
                      </tr>
                      <tr>
                        
                        <td>BS-ENGLISH</td>
                        <?php
                        $relg_total         = 0;
                        $Muslim             = 0;
                        $Christian          = 0;
                        $Hindu              = 0;
                        $Sikh               = 0;
                        $other              = 0;
                        foreach($BSE_gender as $gender_row):
                        if($gender_row->religion_id == 1):
                             $Muslim ++;
                        endif;    
                        if($gender_row->religion_id == 2):
                             $Christian ++;
                        endif;    
                        if($gender_row->religion_id == 3):
                             $Hindu ++;
                        endif;    
                        if($gender_row->religion_id == 4):
                             $Sikh ++;
                        endif;    
                        if($gender_row->religion_id == 5 || $gender_row->religion_id == 6 || $gender_row->religion_id == 7 ):
                             $other ++;
                        endif;    
                        $relg_total =$other+$Sikh+$Hindu+$Christian+$Muslim;
                        endforeach;
                        
                        echo ' <td>'.$Muslim.'</td>';
                        echo ' <td>'.$Christian.'</td>';
                        echo ' <td>'.$Hindu.'</td>';
                        echo ' <td>'.$Sikh.'</td>';
                        echo ' <td>'.$other.'</td>';
                        echo ' <td>'.$relg_total.'</td>';
                        
                        
                       
                        $Muslim_total       += $Muslim;
                        $Christian_total    += $Christian;
                        $Hindu_total        += $Hindu;
                        $Sikh_total         += $Sikh;
                        $other_total        += $other;
                        $total +=           $relg_total;
                        ?>
                           
                      </tr>
                      <tr>
                        <td>A LEVEL </td>
                        <?php
                        $relg_total         = 0;
                        $Muslim             = 0;
                        $Christian          = 0;
                        $Hindu              = 0;
                        $Sikh               = 0;
                        $other              = 0;
                        foreach($A_Level as $gender_row):
                        if($gender_row->religion_id == 1):
                             $Muslim ++;
                        endif;    
                        if($gender_row->religion_id == 2):
                             $Christian ++;
                        endif;    
                        if($gender_row->religion_id == 3):
                             $Hindu ++;
                        endif;    
                        if($gender_row->religion_id == 4):
                             $Sikh ++;
                        endif;    
                        if($gender_row->religion_id == 5 || $gender_row->religion_id == 6 || $gender_row->religion_id == 7 ):
                             $other ++;
                        endif;    
                        $relg_total =$other+$Sikh+$Hindu+$Christian+$Muslim;
                        endforeach;
                        
                        echo ' <td>'.$Muslim.'</td>';
                        echo ' <td>'.$Christian.'</td>';
                        echo ' <td>'.$Hindu.'</td>';
                        echo ' <td>'.$Sikh.'</td>';
                        echo ' <td>'.$other.'</td>';
                        echo ' <td>'.$relg_total.'</td>';
                        
                        
                       
                        $Muslim_total       += $Muslim;
                        $Christian_total    += $Christian;
                        $Hindu_total        += $Hindu;
                        $Sikh_total         += $Sikh;
                        $other_total        += $other;
                        $total +=           $relg_total;
                        ?>
                            
                          
                      </tr>
                      <tr>
                         
                        <td>BBA</td>
                        
                        <?php
                        $relg_total         = 0;
                        $Muslim             = 0;
                        $Christian          = 0;
                        $Hindu              = 0;
                        $Sikh               = 0;
                        $other              = 0;
                        foreach($bba as $gender_row):
                        if($gender_row->religion_id == 1):
                             $Muslim ++;
                        endif;    
                        if($gender_row->religion_id == 2):
                             $Christian ++;
                        endif;    
                        if($gender_row->religion_id == 3):
                             $Hindu ++;
                        endif;    
                        if($gender_row->religion_id == 4):
                             $Sikh ++;
                        endif;    
                        if($gender_row->religion_id == 5 || $gender_row->religion_id == 6 || $gender_row->religion_id == 7 || $gender_row->religion_id == 0 ):
                             $other ++;
                        endif;    
                        $relg_total =$other+$Sikh+$Hindu+$Christian+$Muslim;
                        endforeach;
                        
                        echo ' <td>'.$Muslim.'</td>';
                        echo ' <td>'.$Christian.'</td>';
                        echo ' <td>'.$Hindu.'</td>';
                        echo ' <td>'.$Sikh.'</td>';
                        echo ' <td>'.$other.'</td>';
                        echo ' <td>'.$relg_total.'</td>';
                        
                        
                       
                        $Muslim_total       += $Muslim;
                        $Christian_total    += $Christian;
                        $Hindu_total        += $Hindu;
                        $Sikh_total         += $Sikh;
                        $other_total        += $other;
                        $total +=           $relg_total;
                        ?>    
                            
                        
                      </tr>
                      <tr>
                         
                        <td>BS-LAW</td>
                        
                        <?php
                        $relg_total         = 0;
                        $Muslim             = 0;
                        $Christian          = 0;
                        $Hindu              = 0;
                        $Sikh               = 0;
                        $other              = 0;
                        foreach($law as $gender_row):
                        if($gender_row->religion_id == 1):
                             $Muslim ++;
                        endif;    
                        if($gender_row->religion_id == 2):
                             $Christian ++;
                        endif;    
                        if($gender_row->religion_id == 3):
                             $Hindu ++;
                        endif;    
                        if($gender_row->religion_id == 4):
                             $Sikh ++;
                        endif;    
                        if($gender_row->religion_id == 5 || $gender_row->religion_id == 6 || $gender_row->religion_id == 7 ):
                             $other ++;
                        endif;    
                        $relg_total =$other+$Sikh+$Hindu+$Christian+$Muslim;
                        endforeach;
                        
                        echo ' <td>'.$Muslim.'</td>';
                        echo ' <td>'.$Christian.'</td>';
                        echo ' <td>'.$Hindu.'</td>';
                        echo ' <td>'.$Sikh.'</td>';
                        echo ' <td>'.$other.'</td>';
                        echo ' <td>'.$relg_total.'</td>';
                        
                        
                       
                        $Muslim_total       += $Muslim;
                        $Christian_total    += $Christian;
                        $Hindu_total        += $Hindu;
                        $Sikh_total         += $Sikh;
                        $other_total        += $other;
                        $total +=           $relg_total;
                        ?>    
                            
                        
                      </tr>
                    <tr>
                         
                        <td>BS ECONOMICS</td>
                        
                        <?php
                        $relg_total         = 0;
                        $Muslim             = 0;
                        $Christian          = 0;
                        $Hindu              = 0;
                        $Sikh               = 0;
                        $other              = 0;
                        foreach($economics as $gender_row):
                        if($gender_row->religion_id == 1):
                             $Muslim ++;
                        endif;    
                        if($gender_row->religion_id == 2):
                             $Christian ++;
                        endif;    
                        if($gender_row->religion_id == 3):
                             $Hindu ++;
                        endif;    
                        if($gender_row->religion_id == 4):
                             $Sikh ++;
                        endif;    
                        if($gender_row->religion_id == 5 || $gender_row->religion_id == 6 || $gender_row->religion_id == 7 ):
                             $other ++;
                        endif;    
                        $relg_total =$other+$Sikh+$Hindu+$Christian+$Muslim;
                        endforeach;
                        
                        echo ' <td>'.$Muslim.'</td>';
                        echo ' <td>'.$Christian.'</td>';
                        echo ' <td>'.$Hindu.'</td>';
                        echo ' <td>'.$Sikh.'</td>';
                        echo ' <td>'.$other.'</td>';
                        echo ' <td>'.$relg_total.'</td>';
                        
                        
                       
                        $Muslim_total       += $Muslim;
                        $Christian_total    += $Christian;
                        $Hindu_total        += $Hindu;
                        $Sikh_total         += $Sikh;
                        $other_total        += $other;
                        $total +=           $relg_total;
                        ?>    
                            
                        
                      </tr>
                    <tr>
                         
                        <td>BS POLITICAL SCIENCE</td>
                        
                        <?php
                        $relg_total         = 0;
                        $Muslim             = 0;
                        $Christian          = 0;
                        $Hindu              = 0;
                        $Sikh               = 0;
                        $other              = 0;
                        foreach($pol_science as $gender_row):
                        if($gender_row->religion_id == 1):
                             $Muslim ++;
                        endif;    
                        if($gender_row->religion_id == 2):
                             $Christian ++;
                        endif;    
                        if($gender_row->religion_id == 3):
                             $Hindu ++;
                        endif;    
                        if($gender_row->religion_id == 4):
                             $Sikh ++;
                        endif;    
                        if($gender_row->religion_id == 5 || $gender_row->religion_id == 6 || $gender_row->religion_id == 7 ):
                             $other ++;
                        endif;    
                        $relg_total =$other+$Sikh+$Hindu+$Christian+$Muslim;
                        endforeach;
                        
                        echo ' <td>'.$Muslim.'</td>';
                        echo ' <td>'.$Christian.'</td>';
                        echo ' <td>'.$Hindu.'</td>';
                        echo ' <td>'.$Sikh.'</td>';
                        echo ' <td>'.$other.'</td>';
                        echo ' <td>'.$relg_total.'</td>';
                        
                        
                       
                        $Muslim_total       += $Muslim;
                        $Christian_total    += $Christian;
                        $Hindu_total        += $Hindu;
                        $Sikh_total         += $Sikh;
                        $other_total        += $other;
                        $total +=           $relg_total;
                        ?>    
                            
                        
                      </tr>
                      
                      
                       <tr>
                        <td>CHINESE</td>
                        <?php
                        $relg_total         = 0;
                        $Muslim             = 0;
                        $Christian          = 0;
                        $Hindu              = 0;
                        $Sikh               = 0;
                        $other              = 0;
                        foreach($China as $gender_row):
                        if($gender_row->religion_id == 1):
                             $Muslim ++;
                        endif;    
                        if($gender_row->religion_id == 2):
                             $Christian ++;
                        endif;    
                        if($gender_row->religion_id == 3):
                             $Hindu ++;
                        endif;    
                        if($gender_row->religion_id == 4):
                             $Sikh ++;
                        endif;    
                        if($gender_row->religion_id == 5 || $gender_row->religion_id == 6 || $gender_row->religion_id == 7 ):
                             $other ++;
                        endif;    
                        $relg_total =$other+$Sikh+$Hindu+$Christian+$Muslim;
                        endforeach;
                        
                        echo ' <td>'.$Muslim.'</td>';
                        echo ' <td>'.$Christian.'</td>';
                        echo ' <td>'.$Hindu.'</td>';
                        echo ' <td>'.$Sikh.'</td>';
                        echo ' <td>'.$other.'</td>';
                        echo ' <td>'.$relg_total.'</td>';
                       
                        $Muslim_total       += $Muslim;
                        $Christian_total    += $Christian;
                        $Hindu_total        += $Hindu;
                        $Sikh_total         += $Sikh;
                        $other_total        += $other;
                        $total +=           $relg_total;
                        ?>    
                        
                      </tr>
                    <tr>
                        <td>GERMAN</td>
                        <?php
                        $relg_total         = 0;
                        $Muslim             = 0;
                        $Christian          = 0;
                        $Hindu              = 0;
                        $Sikh               = 0;
                        $other              = 0;
                        foreach($Germn as $gender_row):
                        if($gender_row->religion_id == 1):
                             $Muslim ++;
                        endif;    
                        if($gender_row->religion_id == 2):
                             $Christian ++;
                        endif;    
                        if($gender_row->religion_id == 3):
                             $Hindu ++;
                        endif;    
                        if($gender_row->religion_id == 4):
                             $Sikh ++;
                        endif;    
                        if($gender_row->religion_id == 5 || $gender_row->religion_id == 6 || $gender_row->religion_id == 7 ):
                             $other ++;
                        endif;    
                        $relg_total =$other+$Sikh+$Hindu+$Christian+$Muslim;
                        endforeach;
                        
                        echo ' <td>'.$Muslim.'</td>';
                        echo ' <td>'.$Christian.'</td>';
                        echo ' <td>'.$Hindu.'</td>';
                        echo ' <td>'.$Sikh.'</td>';
                        echo ' <td>'.$other.'</td>';
                        echo ' <td>'.$relg_total.'</td>';
                        
                        
                       
                        $Muslim_total       += $Muslim;
                        $Christian_total    += $Christian;
                        $Hindu_total        += $Hindu;
                        $Sikh_total         += $Sikh;
                        $other_total        += $other;
                        $total +=           $relg_total;
                        ?>    
                            
                        
                      </tr> 
                    <tr>
                        <td>PASHTO</td>
                        <?php
                        $relg_total         = 0;
                        $Muslim             = 0;
                        $Christian          = 0;
                        $Hindu              = 0;
                        $Sikh               = 0;
                        $other              = 0;
                        foreach($Pasht as $gender_row):
                        if($gender_row->religion_id == 1):
                             $Muslim ++;
                        endif;    
                        if($gender_row->religion_id == 2):
                             $Christian ++;
                        endif;    
                        if($gender_row->religion_id == 3):
                             $Hindu ++;
                        endif;    
                        if($gender_row->religion_id == 4):
                             $Sikh ++;
                        endif;    
                        if($gender_row->religion_id == 5 || $gender_row->religion_id == 6 || $gender_row->religion_id == 7 ):
                             $other ++;
                        endif;    
                        $relg_total =$other+$Sikh+$Hindu+$Christian+$Muslim;
                        endforeach;
                        
                        echo ' <td>'.$Muslim.'</td>';
                        echo ' <td>'.$Christian.'</td>';
                        echo ' <td>'.$Hindu.'</td>';
                        echo ' <td>'.$Sikh.'</td>';
                        echo ' <td>'.$other.'</td>';
                        echo ' <td>'.$relg_total.'</td>';
                        
                        
                       
                        $Muslim_total       += $Muslim;
                        $Christian_total    += $Christian;
                        $Hindu_total        += $Hindu;
                        $Sikh_total         += $Sikh;
                        $other_total        += $other;
                        $total +=           $relg_total;
                        ?>    
                            
                        
                    </tr>
                    
                    <tr>
                        <td>ENGLISH</td>
                        <?php
                        $relg_total         = 0;
                        $Muslim             = 0;
                        $Christian          = 0;
                        $Hindu              = 0;
                        $Sikh               = 0;
                        $other              = 0;
                        foreach($english as $gender_row):
                        if($gender_row->religion_id == 1):
                             $Muslim ++;
                        endif;    
                        if($gender_row->religion_id == 2):
                             $Christian ++;
                        endif;    
                        if($gender_row->religion_id == 3):
                             $Hindu ++;
                        endif;    
                        if($gender_row->religion_id == 4):
                             $Sikh ++;
                        endif;    
                        if($gender_row->religion_id == 5 || $gender_row->religion_id == 6 || $gender_row->religion_id == 7 ):
                             $other ++;
                        endif;    
                        $relg_total =$other+$Sikh+$Hindu+$Christian+$Muslim;
                        endforeach;
                        
                        echo ' <td>'.$Muslim.'</td>';
                        echo ' <td>'.$Christian.'</td>';
                        echo ' <td>'.$Hindu.'</td>';
                        echo ' <td>'.$Sikh.'</td>';
                        echo ' <td>'.$other.'</td>';
                        echo ' <td>'.$relg_total.'</td>';
                        
                        
                       
                        $Muslim_total       += $Muslim;
                        $Christian_total    += $Christian;
                        $Hindu_total        += $Hindu;
                        $Sikh_total         += $Sikh;
                        $other_total        += $other;
                        $total +=           $relg_total;
                        ?>    
                            
                        
                    </tr>
                      <tr>
                         
                        <td>TOTAL</td>
                        <td><?php echo $Muslim_total?></td>
                        <td><?php echo $Christian_total?></td>
                        <td><?php echo $Hindu_total?></td>
                        <td><?php echo $Sikh_total?></td>
                        <td><?php echo $other_total?></td>
                        <td><?php echo $total?></td>
                      
                        
                        
                      </tr>
                </tbody>
                </table>
            </div>
          </div>
       
          <!-- /widget --> 
        </div>
        <div class="span4">
          <div class="widget widget-nopad">
              
            <div class="widget-header"> <i class="icon-list-alt"></i>
               
              <h3>General Student Information</h3>
     
            </div>
              
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                <div class="widget-content">
                    <?php
                    foreach(array_chunk($gernal_report,2) as $rbchnk):
                        echo ' <div id="big_stats" class="cf">';
                            foreach($rbchnk as $rb):
                                  echo '<div class="stat"> <i class="icon-maless">'.$rb->name.'</i> <span class="btn btn-primary">'.$rb->Total.'</span> </div>';
                            endforeach;
                        echo '</div>';
                    endforeach;
                ?>
                </div>
                <!-- /widget-content --> 
                
              </div>
            </div>
          </div>
       
          <!-- /widget --> 
        </div>
         <div class="span4">
          <div class="widget widget-nopad">
              
            <div class="widget-header"> <i class="icon-list-alt"></i>
             
                <h3>Students Statistics</h3>
     
            </div>
              
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                <div class="widget-content">
                 <div id="big_stats" class="cf">
                    <div class="stat"> <i class="icon-xs">Total</i> <span class="btn btn-primary"><?php echo $all_students?></span> </div>
                    <!-- .stat -->
                    <div class="stat"> <i class="icon-xs">Total Female</i> <span class="btn btn-primary"><?php echo $all_female_student?></span> </div>
                    <!-- .stat -->
                    <div class="stat"> <i class="icon-xs">Total Male</i> <span class="btn btn-primary"><?php echo $all_male_student?></span> </div>
                 
                    <!-- .stat --> 
                  </div>
                  
                <div id="big_stats" class="cf">
                    <div class="stat"> <i class="icon-maless">Open</i> <span class="btn btn-primary"><?php echo $open ?></span> </div>
                    <!-- .stat -->
                    <div class="stat"> <i class="icon-xs">Minority</i> <span class="btn btn-primary"><?php echo $Minority?></span> </div>
                    <!-- .stat -->
                    <div class="stat"> <i class="icon-xs">O-level</i> <span class="btn btn-primary"><?php echo $O_level?></span> </div>
                    <!-- .stat --> 
                    <div class="stat"> <i class="icon-xs">Hafiz E Quran</i> <span class="btn btn-primary"><?php echo $HEQ?></span> </div>
                    </div>
                    <div id="big_stats" class="cf">   
                    <!-- .stat --> 
                    <div class="stat"> <i class="icon-xs"> Disable </i> <span class="btn btn-primary"><?php echo $disable?></span> </div>
                    <!-- .stat --> 
                    <div class="stat"> <i class="icon-maless">Edw. School</i> <span class="btn btn-primary"><?php echo $es ?></span> </div>
                    <!-- .stat --> 
                    <div class="stat"> <i class="icon-xs">FATA</i> <span class="btn btn-primary"><?php echo $fata?></span> </div>
                    <!-- .stat -->
                    <div class="stat"> <i class="icon-xs">Other Province</i> <span class="btn btn-primary"><?php echo $os?></span> </div>
                 
                    </div>
                    
                  
                <div id="big_stats" class="cf">
                    
                    <!-- .stat -->
                    <!-- .stat --> 
                    <div class="stat"> <i class="icon-xs">Sport</i> <span class="btn btn-primary"><?php echo $sport?></span> </div>
                    <!-- .stat --> 
                    <div class="stat"> <i class="icon-xs">Girls</i> <span class="btn btn-primary"><?php echo $girls?></span> </div>
                    <div class="stat"> <i class="icon-xs">StaffChild</i> <span class="btn btn-primary"><?php echo $SC?></span> </div>
                    <!-- .stat --> 
                    <div class="stat"> <i class="icon-xs">Baloch</i> <span class="btn btn-primary"><?php echo $Blc?></span> </div>
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
              
            <div class="widget-header"> <i class="icon-list-alt"></i>
               
              <h3>Religious Statictics</h3>
     
            </div>
              
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                <div class="widget-content">
                    <?php
                    foreach(array_chunk($religion_base,5) as $rbchnk):
                        echo ' <div id="big_stats" class="cf">';
                            foreach($rbchnk as $rb):
                                  echo '<div class="stat"> <i class="icon-maless">'.$rb->title.'</i> <span class="btn btn-primary">'.$rb->total.'</span> </div>';
                            endforeach;
                        echo '</div>';
                    endforeach;
                ?>
                </div>
                <!-- /widget-content --> 
                
              </div>
            </div>
          </div>
       
          <!-- /widget --> 
        </div>
        <!-- /span4 --> 
         <div class="span4">
          <div class="widget widget-nopad">
              
            <div class="widget-header"> <i class="icon-list-alt"></i>
               
              <h3>Programs Status</h3>
     
            </div>
 
              
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                <div class="widget-content">
                    
                <div id="big_stats" class="cf">
                    <div class="stat"> <i class="icon-maless">FA/FSc</i> <span class="btn btn-primary"><?php echo $fa_fsc?></span> </div>
                    
                    <div class="stat"> <i class="icon-xs">A-Level</i> <span class="btn btn-primary"><?php echo $alevel?></span> </div>
                    
                    <div class="stat"> <i class="icon-maless">Degree</i> <span class="btn btn-primary"><?php echo $degree?></span> </div>
           
                    <div class="stat"> <i class="icon-xs">HND</i> <span class="btn btn-primary"><?php echo $hnd?></span> </div>
                </div>
                <div id="big_stats" class="cf">
                    
                    <div class="stat"> <i class="icon-xs">BSCS</i> <span class="btn btn-primary"><?php echo $bscs?></span> </div>
                     <div class="stat"> <i class="icon-maless">LAW</i> <span class="btn btn-primary"><?php echo $law_llb?></span> </div>
                    
                    <div class="stat"> <i class="icon-maless">BBA</i> <span class="btn btn-primary"><?php echo $bba_hnr?></span> </div>
                    
                    <div class="stat"> <i class="icon-maless">BS-English</i> <span class="btn btn-primary"><?php echo $bs_eng?></span> </div>
                    <!-- .stat -->
                
                    <!-- .stat --> 
                  </div>
                   <div id="big_stats" class="cf">
                    
                    <div class="stat"> <i class="icon-xs">EDSML</i> <span class="btn btn-primary"><?php echo $edcml;?></span> </div>
                     <div class="stat"> <i class="icon-maless">CHINESE</i> <span class="btn btn-primary"><?php echo $HSKN;?></span> </div>
                    
                    <div class="stat"> <i class="icon-maless">GERMAN</i> <span class="btn btn-primary"><?php echo $GRMN;?></span> </div>
                    
                    <div class="stat"> <i class="icon-maless">PASHTO</i> <span class="btn btn-primary"><?php echo $PSTN;?></span> </div>
                    <!-- .stat -->
                
                    <!-- .stat --> 
                  </div> 
                <div id="big_stats" class="cf">
                    
                    <div class="stat"> <i class="icon-xs">ENGLISH</i> <span class="btn btn-primary"><?php echo $ENGL;?></span> </div>
                    <div class="stat"> <i class="icon-maless">BS Economics</i> <span class="btn btn-primary"><?php echo $bs_eco?></span> </div>
                    <div class="stat"> <i class="icon-maless">BS Pol Science</i> <span class="btn btn-primary"><?php echo $bs_pol?></span> </div>
                  </div> 
          
                </div>
                <!-- /widget-content --> 
                
              </div>
            </div>
          </div>
       
          <!-- /widget --> 
        </div>
        <!-- /span4 --> 
      </div>
            <div class="row">
          <div class="span4">
          <div class="widget widget-nopad">
              
            <div class="widget-header"> <i class="icon-list-alt"></i>
               
              <h3>Sections Status <strong class="text-danger">BBA </strong></h3>
     
            </div>
              
            <!-- /widget-header -->
            <div class="widget-content">
          
                
                  <?php
                    foreach(array_chunk($BBA,2) as $rbchnk):
                        echo ' <div id="big_stats" class="cf" >';
                            foreach($rbchnk as $rb):
                                  echo '<div class="stat" style="height: 75px"> <i class="icon-maless">'.$rb->sectionName.'</i> <span class="btn btn-danger">'.$rb->student_count.'</span> </div>';
                            endforeach;
                        echo '</div>';
                    endforeach;
                ?>
           </div>
          </div>
          <!-- /widget -->
 
          <!-- /widget --> 
        </div>
        <div class="span4">
          <div class="widget widget-nopad">
              
            <div class="widget-header"> <i class="icon-list-alt"></i>
               
              <h3>Sections Status <strong class="text-danger">BS Law </strong></h3>
     
            </div>
              
            <!-- /widget-header -->
            <div class="widget-content">
          
                
                  <?php
                    foreach(array_chunk($LAW,3) as $rbchnk):
                        echo ' <div id="big_stats" class="cf" >';
                            foreach($rbchnk as $rb):
//                                echo '<a href="javascript:;" class="shortcut"><i class="shortcut-icon icon">'.$rb->sectionName.'</i><span class="shortcut-label">'.$rb->student_count.'</span> </a>';
                                  echo '<div class="stat" style="height: 75px"> <i class="icon-maless">'.$rb->sectionName.'</i> <span class="btn btn-danger">'.$rb->student_count.'</span> </div>';
                            endforeach;
                        echo '</div>';
                        
                    endforeach;
                
                ?>
           </div>
          </div>
          <!-- /widget -->
 
          <!-- /widget --> 
        </div>
        <div class="span4">
          <div class="widget widget-nopad">
              
            <div class="widget-header"> <i class="icon-list-alt"></i>
               
              <h3>Sections Status <strong class="text-danger">Bs English </strong></h3>
     
            </div>
              
            <!-- /widget-header -->
            <div class="widget-content">
                  <?php
                    foreach(array_chunk($BSEnglish,2) as $rbchnk):
                        echo ' <div id="big_stats" class="cf" >';
                            foreach($rbchnk as $rb):
//                                echo '<a href="javascript:;" class="shortcut"><i class="shortcut-icon icon">'.$rb->sectionName.'</i><span class="shortcut-label">'.$rb->student_count.'</span> </a>';
                                  echo '<div class="stat" style="height: 75px"> <i class="icon-maless">'.$rb->sectionName.'</i> <span class="btn btn-danger">'.$rb->student_count.'</span> </div>';
                            endforeach;
                        echo '</div>';
                    endforeach;
                ?>
           </div>
          </div>
          <!-- /widget -->
 
          <!-- /widget --> 
        </div>
        </div>
                <div class="row">
          <div class="span4">
          <div class="widget widget-nopad">
              
            <div class="widget-header"> <i class="icon-list-alt"></i>
               
              <h3>Sections Status <strong class="text-danger">HND </strong></h3>
     
            </div>
              
            <!-- /widget-header -->
            <div class="widget-content">
          
                
                  <?php
                    foreach(array_chunk($HND,2) as $rbchnk):
                        echo ' <div id="big_stats" class="cf" >';
                            foreach($rbchnk as $rb):
//                                echo '<a href="javascript:;" class="shortcut"><i class="shortcut-icon icon">'.$rb->sectionName.'</i><span class="shortcut-label">'.$rb->student_count.'</span> </a>';
                                  echo '<div class="stat" style="height: 75px"> <i class="icon-maless">'.$rb->sectionName.'</i> <span class="btn btn-danger">'.$rb->student_count.'</span> </div>';
                            endforeach;
                        echo '</div>';
                    endforeach;
                ?>
           </div>
          </div>
          <!-- /widget -->
 
          <!-- /widget --> 
        </div>
        <div class="span4">
          <div class="widget widget-nopad">
              
            <div class="widget-header"> <i class="icon-list-alt"></i>
               
              <h3>Sections Status <strong class="text-danger">BSCS </strong></h3>
     
            </div>
              
            <!-- /widget-header -->
            <div class="widget-content">
          
                
                  <?php
                    foreach(array_chunk($bscs_clases,3) as $rbchnk):
                        echo ' <div id="big_stats" class="cf" >';
                            foreach($rbchnk as $rb):
//                                echo '<a href="javascript:;" class="shortcut"><i class="shortcut-icon icon">'.$rb->sectionName.'</i><span class="shortcut-label">'.$rb->student_count.'</span> </a>';
                                  echo '<div class="stat" style="height: 75px"> <i class="icon-maless">'.$rb->sectionName.'</i> <span class="btn btn-danger">'.$rb->student_count.'</span> </div>';
                            endforeach;
                        echo '</div>';
                        
                    endforeach;
                
                ?>
           </div>
          </div>
          <!-- /widget -->
 
          <!-- /widget --> 
        </div>
        <div class="span4">
          <div class="widget widget-nopad">
              
            <div class="widget-header"> <i class="icon-list-alt"></i>
               
              <h3>Sections Status <strong class="text-danger">A-Level </strong></h3>
     
            </div>
              
            <!-- /widget-header -->
            <div class="widget-content">
          
                
                  <?php
                    foreach(array_chunk($Alevel,2) as $rbchnk):
                        echo ' <div id="big_stats" class="cf" >';
                            foreach($rbchnk as $rb):
//                                echo '<a href="javascript:;" class="shortcut"><i class="shortcut-icon icon">'.$rb->sectionName.'</i><span class="shortcut-label">'.$rb->student_count.'</span> </a>';
                                  echo '<div class="stat" style="height: 75px"> <i class="icon-maless">'.$rb->sectionName.'</i> <span class="btn btn-danger">'.$rb->student_count.'</span> </div>';
                            endforeach;
                        echo '</div>';
                    endforeach;
                ?>
           </div>
          </div>
          <!-- /widget -->
 
          <!-- /widget --> 
        </div>
        </div>
	    <div class="row">
        <div class="span4">
          <div class="widget widget-nopad">
              
            <div class="widget-header"> <i class="icon-list-alt"></i>
               
                <h3>Sections Status <strong class="text-danger">FA/FSC Part-I</strong></h3>
     
            </div>
              
            <!-- /widget-header -->
            <div class="widget-content">
          
                
                  <?php
                    foreach(array_chunk($fa_fsc_part_1,4) as $rbchnk):
                        echo ' <div id="big_stats" class="cf" >';
                            foreach($rbchnk as $rb):
//                                echo '<a href="javascript:;" class="shortcut"><i class="shortcut-icon icon">'.$rb->sectionName.'</i><span class="shortcut-label">'.$rb->student_count.'</span> </a>';
                                  echo '<div class="stat" style="height: 57px"> <i class="icon-maless">'.$rb->sectionName.'</i> <span class="btn btn-danger">'.$rb->student_count.'</span> </div>';
                            endforeach;
                        echo '</div>';
                    endforeach;
                ?>
           </div>
          </div>
          <!-- /widget -->
 
          <!-- /widget --> 
        </div>
        <div class="span4">
          <div class="widget widget-nopad">
              
            <div class="widget-header"> <i class="icon-list-alt"></i>
               
              <h3>Sections Status <strong class="text-danger">FA/FSc Part-II </strong> </h3>
     
            </div>
              
            <!-- /widget-header -->
            <div class="widget-content">
          
                
                  <?php
                    foreach(array_chunk($fa_fsc_part_2,4) as $rbchnk):
                        echo ' <div id="big_stats" class="cf" >';
                            foreach($rbchnk as $rb):
                                echo '<div class="stat" style="height: 57px"> <i class="icon-maless">'.$rb->sectionName.'</i> <span class="btn btn-danger">'.$rb->student_count.'</span> </div>';
                            endforeach;
                        echo '</div>';
                    endforeach;
                ?>
           </div>
          </div>
          <!-- /widget -->
 
          <!-- /widget --> 
        </div>
        
        
                
        <div class="span4">
          <div class="widget widget-nopad">
              
            <div class="widget-header"> <i class="icon-list-alt"></i>
               
              <h3>Sections Status <strong class="text-danger">Degree </strong></h3>
     
            </div>
              
            <!-- /widget-header -->
            <div class="widget-content">
          
                
                  <?php
                    foreach(array_chunk($Degree,4) as $rbchnk):
                        echo ' <div id="big_stats" class="cf" >';
                            foreach($rbchnk as $rb):
//                                echo '<a href="javascript:;" class="shortcut"><i class="shortcut-icon icon">'.$rb->sectionName.'</i><span class="shortcut-label">'.$rb->student_count.'</span> </a>';
                                  echo '<div class="stat" style="height: 57px"> <i class="icon-maless">'.$rb->sectionName.'</i> <span class="btn btn-danger">'.$rb->student_count.'</span> </div>';
                            endforeach;
                        echo '</div>';
                    endforeach;
                ?>
           </div>
          </div>
          <!-- /widget -->
 
          <!-- /widget --> 
        </div>
              
         
            </div>
        <div class="row">
          <div class="span4">
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3>Sections Status <strong class="text-danger">EDSML </strong></h3>
            </div>
            <div class="widget-content">
           <?php
                    foreach(array_chunk($EDSML,2) as $rbchnk):
                        echo ' <div id="big_stats" class="cf" >';
                            foreach($rbchnk as $rb):
                                  echo '<div class="stat" style="height: 75px"> <i class="icon-maless">'.$rb->sectionName.'</i> <span class="btn btn-danger">'.$rb->student_count.'</span> </div>';
                            endforeach;
                        echo '</div>';
                    endforeach;
                ?>
           </div>
          </div>
          <!-- /widget -->
 
          <!-- /widget --> 
        </div>
            
        <div class="span4">
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3>Sections Status <strong class="text-danger">BS Economics </strong></h3>
            </div>
            <div class="widget-content">
           <?php
                    foreach(array_chunk($Economics,2) as $rbchnk):
                        echo ' <div id="big_stats" class="cf" >';
                            foreach($rbchnk as $rb):
                                  echo '<div class="stat" style="height: 75px"> <i class="icon-maless">'.$rb->sectionName.'</i> <span class="btn btn-danger">'.$rb->student_count.'</span> </div>';
                            endforeach;
                        echo '</div>';
                    endforeach;
                ?>
           </div>
          </div>
          <!-- /widget -->
 
          <!-- /widget --> 
        </div>
            
        <div class="span4">
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3>Sections Status <strong class="text-danger">BS Political Science </strong></h3>
            </div>
            <div class="widget-content">
           <?php
                    foreach(array_chunk($PolScience,2) as $rbchnk):
                        echo ' <div id="big_stats" class="cf" >';
                            foreach($rbchnk as $rb):
                                  echo '<div class="stat" style="height: 75px"> <i class="icon-maless">'.$rb->sectionName.'</i> <span class="btn btn-danger">'.$rb->student_count.'</span> </div>';
                            endforeach;
                        echo '</div>';
                    endforeach;
                ?>
           </div>
          </div>
          <!-- /widget -->
 
          <!-- /widget --> 
        </div>
            
        </div>    
    
     
                
 
	      	
	  	  <!-- /row -->
	
	       
	      
	      
               
	      
			
	      
	      
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->
    
  
       
    
    
    <!--section status--> 
    
  
    
    
    
 
  
    
 