        <!-- ******CONTENT****** --> 
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
                            <span class="line">Report Result</span>
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
                                               
                                               
                                                $year = array(
                                                        '2016'=>'2016',
                                                        '2017'=>'2017',
                                                        '2018'=>'2018',
                                                        '2019'=>'2019',
                                                        '2020'=>'2020',
                                                       );
                                                    echo form_dropdown('year', $year,$current_year,  'class="form-control" id="programId"');
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
                <div id="div_print">
                    
               
                <div class="col-md-12">
                    <div class="table-responsive">
                        <h3 class="has-divider text-highlight"><?php echo $empyee_name->emp_name?>/<?php echo $group->group_name?>/<?php echo $subject->title?>/<?php echo $month_name?></h3>
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
                                        $where['college_no']                = $row->college_no;
                                        $where['practical_alloted.group_id'] = $this->uri->segment(2);
                                        $where['practical_alloted.subject_id'] = $this->uri->segment(3);
                                        $where['practical_alloted.emp_id'] = $this->uri->segment(4);

                                $p = '';
                                $a = '';
                                    echo '<tr>';
                                        echo '<td>'.$sn.'</td>';    
                                        echo '<td>'.$row->college_no.'</td>';    
                                        echo '<td>'.$row->student_name.'</td>'; 
                                         for($i=1;$i<=31;$i++):
                                    echo '<td>';
            $where['attendance_date']= $current_year.'-'.$current_month.'-'.$i;
             $result = $this->ReportsModel->get_student_pracattendance_row($where);
                $flag = $this->CRUDModel->get_where_row('practical_alloted',array('emp_id'=>$this->uri->segment(4),'practical_alloted.group_id'=> $this->uri->segment(2)));
                                                 
                                                if(!empty($result)):
                                            
                                                
                                                  if($result->status == 1):
                                                               $p++;
                                                            echo 'P';  
                                                  endif;
                                                  if($result->status == 0):
                                                     
                                                             $a++;
                                                         echo 'A';
                                                       
                                                      
                                                   
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
                         <?php echo $print_log;?>
                    </div>
                   
                    
                </div><!--//col-md-3-->
                </div> 
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   