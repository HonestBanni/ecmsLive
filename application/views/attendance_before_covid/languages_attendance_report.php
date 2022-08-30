        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <?php
           
                if($result):
                    
            ?>
        <h2 align="left"> <strong style="color:green">Languages </strong>Attendance Report<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                    </h4>
                    <div class="row box">
                    <?php
                 
                    foreach($result as $row)
                    {     
               ?>               
            <div class="col-md-2 col-xm-4">
                <p class="promo-badge">
                    <a class="RedDamask" href="AttendanceController/language_monthly_attendance_report/<?php echo $row->programe_id;?>/<?php echo $row->batch_id;?>">
                        <span class="desc"><?php echo $row->programe_name;?>
                            <span class="off">(<?php 
    $where = array('batch_id'=>$row->batch_id,'s_status_id'=>'5');                    
    echo count($this->CRUDModel->get_where_result('student_record',$where)); 
                                ?>)
                            </span>
                        </span> 
                        <br>
                        <span class="desc"><?php echo $row->batch_name;?></span>                  
                    </a>
                </p>
             </div>
                        <?php
                        }
                      endif;

               ?>               
                        
                    </div>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   