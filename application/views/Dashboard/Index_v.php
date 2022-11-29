<?php
                
$q = $this->CRUDModel->get_where_row('teacher_attendance',array('emp_id'=>$this->UserInfo->emp_id,'in_date'=>date('Y-m-d')));
if(empty($q)):
    echo "<script type='text/javascript'>window.location.href='DashboardController/employee_login'</script>";
endif;
    
?>



        <div class="content container">
               <!-- ******BANNER****** --> 
            <div class="row cols-wrapper">
                <div class="col-md-12" style="min-height:450px;">
                   <div class="contact pull-center">
                       <?php
                
    if($Showmessage):
        foreach($Showmessage as $message):
                
//            echo '<pre>';print_r($this->userInfo);
           
            switch ($message->message_category):
                case 0:
                    echo '<div class="alert alert-danger alert-dismissable">
                            <strong>'.$message->details.'</strong>
                        </div>';
                    break;
                case 1:
                    $check_emp_cat = $this->db->get_where('hr_emp_record',array('emp_id'=>$this->UserInfo->emp_id,'cat_id'=>1))->row();
                    if($check_emp_cat):
                        echo '<div class="alert alert-danger alert-dismissable">
                            <strong>'.$message->details.'</strong>
                        </div>'; 
                    endif;
                   
                    break;
                case 2:
                    $check_emp_cat = $this->db->get_where('hr_emp_record',array('emp_id'=>$this->UserInfo->emp_id,'cat_id'=>2))->row();
                    if($check_emp_cat):
                        echo '<div class="alert alert-danger alert-dismissable">
                            <strong>'.$message->details.'</strong>
                        </div>'; 
                    endif;
                   
                    break;
            endswitch;

    ?>                   
        
    <?php  
        endforeach;    
    else:
            echo "";           
    endif;
        ?>  
                        <p style="font-size:27px; margin-top:150px; text-align:center"><strong>Welcome to <br>Edwardes College Management System (ECMS)</strong></p> <br>
                  
                    </div><!--//contact-->
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           <nav class="main-nav" role="navigation">
            <div class="container">
                           
                <div class="navbar-collapse collapse" id="navbar-collapse" >
                    <ul class=" nav navbar-nav" style="z-index: 10">
                        
                 
                        <li class="nav-item">
                            <!--<a href="http://www.edwardes.edu.pk" target="_new">IT Department Edwardes College Peshawar </a>-->
                            
                            
                            
                           
                        </li>
                      
                        
                        
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </div><!--//container-->
        </nav>
        </div><!--//content-->
   
  