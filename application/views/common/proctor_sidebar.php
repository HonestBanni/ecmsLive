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
    ?>
                    <ul id="menu">
        <li><a href="StudentController/proctor_home"> <span>Dashboard</span><div class="clearfix"></div></a></li>
        <li><a href="StudentController/proctor_profile"> <span>View Profile</span><div class="clearfix"></div></a></li>
        <li><a href="ProctorController/proctor"> <span>Proctor</span><div class="clearfix"></div></a></li>
        <li><a href="StudentController/update_ppassword"> <span>Change Password</span><div class="clearfix"></div></a></li>
        <li><a href="StudentController/proctor_logout"> <span>Logout</span><div class="clearfix"></div></a></li>
                                
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