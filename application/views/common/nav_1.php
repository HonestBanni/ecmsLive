    <script type="text/javascript">
    function date_time(id)
{
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        result = ''+days[day]+' '+months[month]+' '+d+' / '+year+' , '+h+':'+m+':'+s;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("'+id+'");','1000');
        return true;
}
</script>
<style>
    
.blinking{
animation:blinkingText 1.2s infinite;
}
@keyframes blinkingText{
    0%{     color: #fff;   background-color: #d9534f; }
    60%{    color: #d9534f; background-color: #fff;}
    100%{   color: #fff;   background-color: #d9534f; }
}
    
</style>
    <header class="header">  
        <div class="header-main container">
            <h1 class="logo col-md-5 col-sm-6">
                <a href="Dashboard"><img id="logo" class="img-responsive" src="assets/images/logo.png" alt="Edwardes College Peshawar"></a>
            </h1><!--//logo-->  
            <?php
                $whereUsers = array('id'=>$this->UserInfo->user_id);

                $userInfo = $this->CRUDModel->get_where_row('users',$whereUsers);

                $whereUR    = array('ur_id'=>$userInfo->user_roleId);
                $userInfo   = $this->CRUDModel->get_where_row('users_role',$whereUR);
                $whereUPl1  = array('upl1_urId'=>$userInfo->ur_id);
                $UPL1       = $this->CRUDModel->UPL1($whereUPl1);
                
                $this->db->SELECT('
                    users.*,
                    hr_emp_record.*,
                    hr_emp_designation.title as designation,
                    hr_emp_scale.title as scale,
                    department.title as department, 
                    hr_emp_contract_type.title as contract 
                '); 
                $this->db->FROM('users');
                $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId', 'left outer');
                $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
                $this->db->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_emp_record.c_emp_scale_id', 'left outer');
                $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id', 'left outer');
                $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer');
                $this->db->where($whereUsers);
                $employeeinfo  = $this->db->get();  
                
                foreach($employeeinfo->result() as $row){
                    $picture = $row->picture;
                                ?>
            <div class="info col-md-5 col-sm-4"> 
              <strong style="font-size:14px;color:#208e4c">Designation: <?php echo $row->designation;?> 
 <?php
 
 if($row->contract):
     echo '('.$row->contract.')';
 endif;
  ?><br>
                Bps: <?php echo $row->scale;?><br>
                Contact # <span style="color:red">(Used for Official SMS)</span>: <?php echo $row->contact1;?></strong><br><br>               
               <span id="date_time"></span>
                  <?php
                $where = array('emp_id'=>$row->emp_id);
                $this->db->select('*');
                $this->db->from('teacher_attendance');
                $this->db->where($where);
                $this->db->where('in_date',date('Y-m-d'));
                $this->db->order_by('t_attend_id','desc');
                $this->db->limit('1');
                $res = $this->db->get()->row();
                if(!empty($res)):
                ?>
                    <span>Logged In Time: <?php echo $res->in_time;?> 
                        <strong style="margin-left:30px;font-size:16px;">
                            <a href="DashboardController/employee_logout/<?php echo $res->t_attend_id;?>">
                                <button type="button" class="btn btn-danger"><i class="fa fa-check-circle"></i>Logout</button>
                            </a> 
                            <input type="hidden" value="<?php echo $this->UserInfo->user_id; ?>" id="userId">
                            <input type="hidden" value="<?php echo $this->UserInfo->user_roleId; ?>" id="groupId">
                            <input type="hidden" value="<?php echo $row->emp_id; ?>" id="empId">
                           
<!--                            <a href="">
                                <button type="button" class="btn btn-danger"><i class="fa fa-check-circle"></i><?php// echo $userEmail['user_roleId'];?></button>
                            </a>-->
                        </strong>
                    </span>
                <?php
                endif;
                ?>
 
                   
           
<!--                <script type="text/javascript">window.onload = date_time('date_time');</script>-->
            </div>
            <div class="col-md-2 col-sm-2">
                <?php
                if($picture == ''){
                ?>
                <img src="assets/images/students/user.png" width="100" height="80" style="border-radius:10%">
                <br><a href="AttendanceController/employee_timetable/<?php echo $row->emp_id?>"><?php echo $row->emp_name;?></a>
                <?php
                }else{
                ?>
                <img src="assets/images/employee/<?php echo $picture;?>" width="80" height="80" style="border-radius:10%">
                <br><a href="AttendanceController/employee_timetable/<?php echo $row->emp_id?>"><?php echo $row->emp_name;?></a>
            </div>
            <?php } 
                }
            ?>
        </div><!--//header-main-->
    </header><!--//header-->
 
    <!-- ******NAV****** -->
    <nav class="main-nav" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button><!--//nav-toggle-->
                </div><!--//navbar-header-->            
                <div class="navbar-collapse collapse" id="navbar-collapse">
                    <ul class=" nav navbar-nav">
                        
         <?php
                        if($UPL1):
                             
                            foreach($UPL1 as $l1Row):
                                echo '<li class="nav-item">';
                                echo '<a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">'.$l1Row->m1_name.'<i class="fa fa-angle-down"></i></a>';
                                    
                                    $whereUPl2 = array('upl2_urId'=>$userInfo->ur_id,'up2_m1Id'=>$l1Row->m1_id,'m2_status'=>1);
                                    $UPL2 = $this->CRUDModel->UPL2($whereUPl2);
                         
                                           
                                        echo '<ul class="dropdown-menu">';
                                      if($UPL2):
                                         foreach($UPL2 as $l2Row):
                                              $whereUPl3 = array(
                                                        'upl3_urId' =>$userInfo->ur_id,
                                                        'upl3_m1Id' =>$l1Row->m1_id,
                                                        'upl3_m2Id' =>$l2Row->m2_id,
                                                         );
                                                     $UPL3 = $this->CRUDModel->UPL3($whereUPl3);
                                                    //echo '<pre>';print_r($UPL3);
                                                     if($UPL3):
                                                        echo '<li class="dropdown-submenu">
                                                              <a tabindex="-1" href="'.$l2Row->m2_function.'">'.$l2Row->m2_name.'<i class="fa fa-angle-right"></i></a>
                                                              <ul class="dropdown-menu" style="display: none;"> ';
                                                     foreach($UPL3 as $l3Row):
                                                         echo '<li class="dropdown-submenu"><a href="'.$l3Row->m3_function.'">'.$l3Row->m3_name.'</a></li>';
                                                        
                                                    endforeach; 
                                                        echo '</ul></li>';
                                                    else:
                                                             echo '<li><a href="'.$l2Row->m2_function.'">'.$l2Row->m2_name.'</a></li>';
                                                         
                                                    endif;
                                             endforeach;
                                         endif;    
                                        echo ' </ul>';
                                
                                echo '</li>';
                          
                            endforeach;
                        endif;
                        
                        ?>
                      
                        
                        
                        
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </div><!--//container-->
        </nav><!--//main-nav-->
        
  