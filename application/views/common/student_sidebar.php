	<script>
		jQuery(document).ready(function() {
			 var navoffeset=jQuery(".header-main").offset().top;
			 jQuery(window).scroll(function(){
				var scrollpos=jQuery(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					jQuery(".header-main").addClass("fixed");
				}else{
					jQuery(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	 <p>IT Department Edwardes College Peshawar </p>
</div>	
<!--COPY rights end here-->
</div>
</div> 
<div class="sidebar-menu">
            <header class="logo1">
                <a href="javascript:void(0)" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> 
            </header>
            <div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
           <div class="menu">
                <?php
        $session = $this->session->all_userdata();
        $student_id =  $session['studentData']['student_id'];
        $student_name      = $session['studentData']['student_name'];
        $where = array('student_id'=>$student_id);
        $studentinfo = $this->StudentModel->profileDataStudent('student_record',$where);       
        $section = $this->CRUDModel->get_where_row('student_group_allotment',$where);
        $section_id = '';
        if($section):
            $section_id = $section->section_id;
            else:
        $section_id = '';
        endif;
        
        $college_no =  $studentinfo->college_no;  
        $pgroup = $this->CRUDModel->get_where_row('student_prac_group_allottment',array('college_no'=>$college_no));              
    ?>
                    <ul id="menu">
        <li><a href="StudentController/student_home"><i class="fa fa-tachometer"></i> <span>Dashboard</span><div class="clearfix"></div></a></li>
        <li id="menu-academico" ><a href="#"><i class="fa fa-graduation-cap"></i>  <span>Academic Details</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
             <ul id="menu-academico-sub" >
                <li id="menu-academico-boletim" ><a href="whiteCardShow/<?php echo $student_id;?>/<?php echo $section_id;?>" target="_blank">Student Progress Report</a></li>
                 <?php if(!empty($pgroup)):?>
                <li id="menu-academico-boletim" ><a href="PracticalwhiteCardShow/<?php echo $college_no;?>/<?php echo $pgroup->group_id;?>" target="_blank">Practical Attendance</a></li>
                 <?php else:?>
                 <li id="menu-academico-boletim" ><a href="StudentController/student_home" target="_blank">Practical White Card</a></li>
                 <?php endif;?>
                <li id="menu-academico-avaliacoes" ><a href="StudentController/student_home">Time Table</a></li>
                
              </ul>
        </li>                
                      
        <li id="menu-academico" ><a href="#"><i class="fa fa-book"></i>  <span>Books Details</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
             <ul id="menu-academico-sub" >
                <li id="menu-academico-boletim" ><a href="StudentController/books_issued_details">Library Details</a></li>
              </ul>
        </li>
         <li><a href="StudentController/fine"><i class="fa fa-list"></i><span>Disciplinary Actions</span><div class="clearfix"></div></a></li>     
         
           <li id="menu-academico" ><a href="#"><i class="fa fa-book"></i>  <span>Fee Details</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
             <ul id="menu-academico-sub" >
                <li id="menu-academico-boletim" ><a href="StudentController/student_fee">College Fee Details</a></li>
                <li id="menu-academico-boletim" ><a href="StudentController/student_hostel_details">Hostel Fee Details</a></li>
                <li id="menu-academico-boletim" ><a href="StudentController/student_mess_details">Mess Fee Details</a></li>
              </ul>
        </li>
                       
         <li><a href="StudentController/student_home"><i class="fa fa-list"></i><span>Examination</span><div class="clearfix"></div></a></li>                
               </ul>
                </div>
</div>
<div class="clearfix"></div>		
    </div>
    <script>
    var toggle = true;

    jQuery(".sidebar-icon").click(function() {                
      if (toggle)
      {
        jQuery(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
        jQuery("#menu span").css({"position":"absolute"});
      }
      else
      {
        jQuery(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
        setTimeout(function() {
          jQuery("#menu span").css({"position":"relative"});
        }, 400);
      }

                    toggle = !toggle;
                });
    </script>
<!--js -->
<script src="student_portal/js/jquery.nicescroll.js"></script>
<script src="student_portal/js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="student_portal/js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   
<!-- morris JavaScript -->	
<script src="student_portal/js/raphael-min.js"></script>
<script src="student_portal/js/morris.js"></script>
<script src="student_portal/js/jquery-ui.js"></script>
<script src="student_portal/js/student.js"></script>
<script src="student_portal/js/dropdown_autocomplete.js"></script>
</body>
</html>