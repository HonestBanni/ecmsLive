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
                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
                </div>
                  
                <div id="div_print">
                    
               
                <div class="col-md-12">
                    <div class="table-responsive">
                        <h3 class="has-divider text-highlight"><?php echo $empyee_name->emp_name?>/<?php echo $sections->name?>/<?php echo $subject->title?>/<?php echo $month_name?></h3>
                       <table class="table table-hover table-boxed">
                        <thead>
                        <tr>
                          <th>#</th>
                            <th>College #</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                          
                            <th>Marks</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                   
                            if($result):
                                $sn = '';
                             foreach($result as $roResult):
                                 $sn++;
                                echo '<tr><td>'.$sn.'</td>';
                                echo '<td>'.$roResult->college_no.'</td>';
                                echo '<td>'.$roResult->student_name.'</td>';
                                echo '<td>'.$roResult->father_name.'</td>';
                             
                                echo '<td>'.$roResult->obmarks.'/'.$roResult->totlmarks.'</td>';
                              
                                echo '<td>'.$roResult->pre.' %</td>';
                               
                                
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
   