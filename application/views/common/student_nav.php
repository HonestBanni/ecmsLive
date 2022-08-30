<script type="text/javascript">
    function date_time(id)
{
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
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
    <header class="header">  
        <div class="header-main container">
            <h1 class="logo col-md-5 col-sm-4">
                <a href="StudentController/student_home"><img id="logo" class="img-responsive" src="assets/images/logo.png" alt="Edwardes College Peshawar"></a>
            </h1><!--//logo-->  
            <?php
        $session = $this->session->all_userdata();
        $student_id =  $session['studentData']['student_id'];
        $student_name      = $session['studentData']['student_name'];
        $where = array('student_id'=>$student_id);
        $studentinfo = $this->CRUDModel->get_where_row('student_record',$where);       
        $section = $this->CRUDModel->get_where_row('student_group_allotment',$where);       
          $picture = $studentinfo->applicant_image;
                                ?>
            <div class="info col-md-5 col-sm-4">                
               <span id="date_time"></span>
                <script type="text/javascript">window.onload = date_time('date_time');</script>
                <h3>Parent Portal</h3>
            </div>
            <div class="col-md-2 col-sm-4">
                <?php
                if($picture == ''){
                ?>
                <img src="assets/images/students/user.png" width="100" height="80" style="border-radius:10%">
                <br><a href="#"><?php echo $studentinfo->student_name;?></a>
                <?php
                }else{
                ?>
                <img src="assets/images/students/<?php echo $picture;?>" width="100" height="80" style="border-radius:10%">
                <br><a href="#"><?php echo $studentinfo->student_name;?></a>
            </div>
            <?php } 
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
                    <ul class="nav navbar-nav" style="float:right;"> 
    <li class="nav-item dropdown">
         <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Users <i class="fa fa-angle-down"></i></a>
         <ul class="dropdown-menu">
<!--            <li><a href="StudentController/update_password">Change Password </a></li>       -->
            <li><a href="student_logout">Logout</a></li>       
         </ul>
    </li>                    
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </div><!--//container-->
        </nav><!--//main-nav-->
        