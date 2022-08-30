   <script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>
        <div class="content container">
               <!-- ******BANNER****** -->
            
            <div class="row cols-wrapper">
                 <div class="col-md-12">    
                       <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                              <span class="line">Report  (<?php echo  $program?>)</span>
                        </h1>
                        <div class="section-content">
                           
                                <div class="row">
                                      <form class="form-inline course-finder-form" name="reportForm" method="post" accept-charset="utf-8">
                                    <div class="col-md-12">
                                        <div class="form-group ">   
                                            <?php
                                                echo form_input(array(
                                                    'name'          => 'emp_id_report',
                                                    'id'            => 'emp_id',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Employee name',
                                                    'type'          => 'text'
                                                    ));
                                                echo form_input(array(
                                                    'name'          => 'emp_idCode_report',
                                                    'id'            => 'emp_idCode',
                                                    'class'         => 'form-control',
                                                    'type'          => 'hidden'
                                                ));  
                                            ?>

                                      </div>
                                    
                                       
                                       
 

                                             
                                        <div class="form-group">
                                          <button type="submit" name="search" value="search" id="search" class="btn btn-theme">
                                            <i class="fa fa-search"></i> Search </button>
                                            <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
 
                                      </div>
                                    </div>  
                                       </form>                                </div>
                            
                                  
                                
                             
                             
                         </div><!--//section-content-->
                        
                        
                    </section>
          
                    </div>  
                
                
                <div class="col-md-12">
                    <div class="table-responsive">
                        
        <div id="div_print"> 
                       <table class="table table-hover table-boxed" id="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee Name/Class</th>
                            <th>Test Month</th>
                            <th>Subject Name</th>
                         
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        if(@$result):
//                          echo '<pre>';print_r($result);die;
                            
                    $sn ='';
                    foreach($result as $rec):
                        $sn++;
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $sn;?></td>
                            <td><?php echo $rec->employeename.'('.$rec->sectionname.')';?></td>
                            <td><?php 
                            
                            
                          $result =   $this->CRUDModel->get_where_result('monthly_test',array('class_id'=>$rec->class_id));
                          foreach($result as $testMonth):
                              
                              if($testMonth->test_date):
//                                      $result =  ;
                                echo '<a class="tmsi_cl" style="cursor:pointer" id="TMSR/'.$rec->sectionId.'/'.$rec->subject_id.'/'.$rec->employeeId.'/'.$rec->flag.'/'.$testMonth->test_id.'/'.date_format(date_create($testMonth->test_date),'d-m-Y').'">
                                      <span class="label label-primary">'.date_format(date_create($testMonth->test_date),'M-y').'</span>&nbsp;
                                </a>';
//                              echo '<a href="TMSR/'.$testMonth->test_id.'/'.$rec->flag.'"><span class="label label-default">'.date_format(date_create($testMonth->test_date),'M-y').'</span>&nbsp;</a>';
                              
                              endif;
                          
//                              echo strtotime('M-y',$testMonth->test_date);
                          
                          endforeach;
 
                            ?></td>
                            <td><?php echo $rec->subjectname;?></td>
                          
                            <!--<td><a href="TMSR/<?php echo $rec->sectionId?>/<?php echo $rec->subject_id?>/<?php echo $rec->employeeId?>/<?php echo $rec->flag?>">Details</a></td>-->
                           
                        </tr>
                        <?php
                            endforeach; 
                            endif;
                            ?>
                    </tbody>
                </table> 
            <?php echo $print_log;?>
        </div>    
                    </div>
                   
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
        
        
        <script>
        
        jQuery(document).ready(function(){
            jQuery('.tmsi_cl').on('click', function(){
                window.open(this.id, '_blank');
            });
        });
        
        </script>