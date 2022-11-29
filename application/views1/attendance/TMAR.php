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
                                                        '01'=>'January',
                                                        '02'=>'February',
                                                        '03'=>'March',
                                                        '04'=>'April',
                                                        '05'=>'May',
                                                        '06'=>'June',
                                                        '07'=>'July',
                                                        '08'=>'August',
                                                        '09'=>'September',
                                                        '10'=>'October',
                                                        '11'=>'November',
                                                        '12'=>'December',
                                                        
                                                    );
                                                    echo form_dropdown('month', $month, $current_month,  'class="form-control" id="programId"');
                                                ?>
                                              </div>
                                          <div class="form-group">
                                              
                                              <select class="form-control" name="year" id="programId">
                                                    <!--<option value="">Year</option>-->
                                                    <?php
                                                    for($y=date('Y'); $y>=date('Y')-5; $y--):
                                                        echo '<option value="'.$y.'">'.$y.'</option>';
                                                    endfor;
                                                    ?>
                                                </select>
                                              
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
                        <h3 class="has-divider text-highlight"><?php echo $empyee_name->emp_name?>/<?php echo $sections->name?>/<?php echo $subject->title?>/<?php echo $month_name?></h3>
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
                           <th>%</th>
                           <th>Total</th>
                           
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                             
                            if($result):
                               
                               $sn = '0';
                                foreach($result as $row):
                                    $sn++;
                                        $where['student_id']                = $row->student_id;
                                        $where['class_alloted.sec_id']      = $this->uri->segment(2);
                                        $where['class_alloted.subject_id']  = $this->uri->segment(3);
                                        $where['class_alloted.emp_id']      = $this->uri->segment(4);

                                $p = '';
                                $a = '';
                                    echo '<tr>';
                                        echo '<td>'.$sn.'</td>';    
                                        echo '<td>'.$row->college_no.'</td>';    
                                        echo '<td>'.$row->student_name.'</td>'; 
                                         for($i=1;$i<=31;$i++):
                                    echo '<td>';
                                            $where['attendance_date']= $current_year.'-'.$current_month.'-'.$i;
                                             $result = $this->AttendanceModel->get_student_attendance_row($where);
                                                $flag = $this->CRUDModel->get_where_row('class_alloted',array('emp_id'=>$this->uri->segment(4),'class_alloted.sec_id'=> $this->uri->segment(2)));
                                                 
                                                if(!empty($result)):
                                            
                                                
                                                  if($result->status == 1):
                                                      
                                                      if($flag->ca_classcount == 2):
                                                           $p++;
                                                           $p++;
                                                            echo '2P'; 
                                                          else:
                                                               $p++;
                                                            echo 'P'; 
                                                      endif;
                                                              
                                                         
                                                      
                                                          
                                                  endif;
                                                  if($result->status == 0):
                                                    if($flag->ca_classcount == 2):
                                                             $a++;
                                                             $a++;
                                                      echo '2A';
                                                          else:
                                                             $a++;
                                                      echo 'A';
                                                      endif;
                                                      
                                                   
                                                  endif;

                                                endif;
                                            
                                        echo '</td>';    
                                    endfor;
                                      $total = $p+$a;
                                      if(!empty($total)):
                                           $per = ($p/$total)*100;  
                                         echo '<td>'.round(@$per,2).'</td>';
                                         else:
                                             echo '<td></td>';
                                      endif;
                                   
                                     
                                        
                                      
                                        if($p ==0):
                                            $p= 0;
                                        endif;
                                        if($a ==0):
                                            $a= 0;
                                        endif;
                                        echo '<td>'.$p.'/'.$a.'='.$total.'</td>';    
                                            
                                        
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
   