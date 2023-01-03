      <?php
// echo print_r($userInfo);
 $q = $this->CRUDModel->get_where_row('teacher_attendance',array('emp_id'=>$userInfo->user_empId,'in_date'=>date('Y-m-d')));

if(empty($q)):

// if((isset($_SERVER['HTTPS']) ? "http" : "http") . "://$_SERVER[HTTP_HOST]" == 'http://172.16.0.111'):

?>
<script type="text/javascript">
   // swal("Congrats!", ", You have been Logged In to the College Software", "success");
   // alert('You have been Logged In to the College Software');
    
//swal({
//  title: 'Welcome!',
//  text: 'You have been Logged In to the College Software',
//  timer: 3000,
//  onOpen: () => {
//    swal.showLoading()
//  }
//}).then((result) => {
//  if (
//    result.dismiss === swal.DismissReason.timer
//  ) {
//    console.log('I was closed by the timer')
//  }
//    
//})
    
  window.location.href='Admin/teacher_attendance';  
</script>
<?php
// endif;
endif;

$where = array('emp_id'=>$userInfo->user_empId);
$this->db->select('*');
$this->db->from('teacher_attendance');
$this->db->where($where);
$this->db->order_by('t_attend_id','desc');
$this->db->limit('1');
$res = $this->db->get()->row();
    if(@$res->in_date == date('Y-m-d') && @$res->out_date == date('Y-m-d')):
   // if((isset($_SERVER['HTTPS']) ? "http" : "http") . "://$_SERVER[HTTP_HOST]" == 'http://172.16.0.111'):
?>
<script type="text/javascript">
   // swal("Congrats!", ", You have been Logged In to the College Software", "success");
   // alert('You have been Logged In to the College Software');
    
//swal({
//  title: 'Welcome!',
//  text: 'You have been Logged In to the College Software Again',
//  timer: 3000,
//  onOpen: () => {
//    swal.showLoading()
//  }
//}).then((result) => {
//  if (
//    result.dismiss === swal.DismissReason.timer
//  ) {
//    console.log('I was closed by the timer')
//  }
//    window.location.href='Admin/teacher_attendance';
//})

window.location.href='Admin/teacher_attendance';    
    
</script>    
<?php
// endif;
endif;
?>
        <div class="content container">
               <!-- ******BANNER****** --> 
            <div class="row cols-wrapper">
                <div class="col-md-12" style="min-height:450px;">
                    <div class="home-pc">
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
                                             $check_emp_cat = $this->db->get_where('hr_emp_record',array('emp_id'=>$this->userInfo->emp_id,'cat_id'=>1))->row();
                                             if($check_emp_cat):
                                                 echo '<div class="alert alert-danger alert-dismissable">
                                                     <strong>'.$message->details.'</strong>
                                                 </div>'; 
                                             endif;

                                             break;
                                         case 2:
                                             $check_emp_cat = $this->db->get_where('hr_emp_record',array('emp_id'=>$this->userInfo->emp_id,'cat_id'=>2))->row();
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
                    </div>
                    <div class="home-mob" style="display: none">
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
                                             $check_emp_cat = $this->db->get_where('hr_emp_record',array('emp_id'=>$this->userInfo->emp_id,'cat_id'=>1))->row();
                                             if($check_emp_cat):
                                                 echo '<div class="alert alert-danger alert-dismissable">
                                                     <strong>'.$message->details.'</strong>
                                                 </div>'; 
                                             endif;

                                             break;
                                         case 2:
                                             $check_emp_cat = $this->db->get_where('hr_emp_record',array('emp_id'=>$this->userInfo->emp_id,'cat_id'=>2))->row();
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
                    </div>
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
   
  