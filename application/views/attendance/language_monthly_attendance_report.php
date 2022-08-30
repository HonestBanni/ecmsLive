<style>
    
.blink_text { 

        -webkit-animation-name: blinker;
 -webkit-animation-duration: 1s;
 -webkit-animation-timing-function: linear;
 -webkit-animation-iteration-count: infinite;

 -moz-animation-name: blinker;
 -moz-animation-duration: 1s;
 -moz-animation-timing-function: linear;
 -moz-animation-iteration-count: infinite;
 animation-name: blinker;
 animation-duration: 2s;
 animation-timing-function: linear; 
    animation-iteration-count: infinite; color: red; 
} 

@-moz-keyframes blinker {
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; } 
}

@-webkit-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; } 
} 

@keyframes blinker {  
    0% { opacity: 1.0; } 
    50% { opacity: 0.0; }      
    100% { opacity: 1.0; } 
} 
</style>
        <div class="content container">
               <!-- ******BANNER****** -->
             <script language="javascript">
                function printdiv(printpage)
                {
                var headstr = "<html><head><title></title></head><body>";
                var footstr = "</body>";
                var newstr = document.all.item(printpage).innerHTML;
                var oldstr = document.body.innerHTML;
                document.body.innerHTML = headstr+newstr+footstr;
                window.print();
                document.body.innerHTML = oldstr;
                return false;
                }
                </script>   
               
            <div class="row cols-wrapper">
                  <div class="col-md-12">    
                       <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Monthly Attendance Report</span>
                        </h1>
                        <div class="section-content">
                                <div class="row">
                                    <form class="form-inline" method="post">
                                    <div class="col-md-12">
                                          <div class="form-group">
                                                <?php 
                                                $month = array(
                                                        '1'=>'January',
                                                        '2'=>'February',
                                                        '3'=>'March',
                                                        '4'=>'April',
                                                        '5'=>'May',
                                                        '6'=>'June',
                                                        '7'=>'July',
                                                        '8'=>'August',
                                                        '9'=>'September',
                                                        '10'=>'October',
                                                        '11'=>'November',
                                                        '12'=>'December',
                                                        
                                                    );
                                                    echo form_dropdown('month', $month, $current_month,  'class="form-control" id="programId"');
                                                ?>
                                              </div>
                                          <div class="form-group">
                                              
                                               
                                              
                                                <?php 
                                                 $year = array();
                                                    for($y=date('Y')-10; $y<=date('Y')+5; $y++):
                                                     $year[$y] = $y;
                                                    endfor;
                                                    
                                                      $d_y =date('Y');
                                                    echo form_dropdown('year', $year,$d_y,  'class="form-control" id="programId"');
                                                ?>
                                              </div>
                                    <div class="form-group">
                                          <button type="submitt" name="search" value="search" class="btn btn-theme"><i class="fa fa-search"></i> Search</button>
                                          <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
                                    </div>
                                    </div>  
                                        </form>
                                </div>
                         </div><!--//section-content-->
                    </section>
                    </div>
                <div class="col-md-12" style="margin:20px 0px;">
            <i class="fa fa-arrow-up fa-2x blink_text" aria-hidden="true"></i> 
        <strong style="font-size:16px;color:red; margin:20px 15px;">
            Please Select Previous Month for History
        </strong>
    </div>
                <div id="div_print">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <h4 class="has-divider text-highlight">Language: <?php echo $program->programe_name?>, Batch: <?php echo $batch->batch_name?>, Month Report: <?php echo $month_name?></h4>
                       <table class="table table-hover table-boxed">
                        <thead>
                        <tr>
                          <th>#</th>
                           <th>Clg#</th>
                           
                            <th>Name</th>
                            <?php
                            for($i=1;$i<=31;$i++):
                                echo '  <th>'.$i.'</th>';
                            endfor;
                            ?>
                           <th>Total</th>
                           <th>%</th>
                           
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                             
                            if($result):
                             //  echo '<pre>';print_r($result);die;
                               $sn = '0';
                            
                        foreach($result as $row):
                            
                                    $sn++;
                                $where['student_id'] = $row->student_id;
                                $where['student_attendance_languages.programe_id'] = $this->uri->segment(3);
                                $where['student_attendance_languages.batch_id'] = $this->uri->segment(4);

                                $p = '';
                                $a = '';
                                    echo '<tr>';
                                        echo '<td>'.$sn.'</td>';    
                                        echo '<td>'.$row->form_no.'</td>';    
                                        echo '<td>'.$row->student_name.'</td>'; 
                                         for($i=1;$i<=31;$i++):
                                    echo '<td>';
                                            $where['attendance_date']= $current_year.'-'.$current_month.'-'.$i;
                                $res = $this->AttendanceModel->get_lang_attendance_row($where);
                               // echo '<pre>';print_r($res);                 
                                                if(!empty($res)):
                                            
                                                  if($res->status == 1):
                                                               $p++;
                                                            echo 'P'; 
                                                      endif;
                                                  if($res->status == 0):
                                                             $a++;
                                                      echo 'A';
                                                      endif;
                                                endif;
                                            
                                        echo '</td>';    
                                    endfor;
                                    if($p ==0):
                                            $p= 0;
                                        endif;
                                        if($a ==0):
                                            $a= 0;
                                        endif;
                                        $total = $p+$a;
                                        echo '<td>'.$p.'/'.$a.'='.$total.'</td>';    
                                            
                                      if(!empty($total)):
                                           $per = ($p/$total)*100;     
                                         echo '<td>'.round(@$per,2).'%'.'</td>';
                                         else:
                                             echo '<td></td>';
                                      endif;
                                    echo '</tr>';
                                
                                
                                  endforeach;
                                
                                
                            endif;
                       
                         
                        
  
                        
                        
                        
                        
                        ?> 
                    </tbody>
                </table> 
                    </div>
                   
                    
                </div><!--//col-md-3-->
                </div> 
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   