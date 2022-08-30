<div class="subnavbar">

	<div class="subnavbar-inner">
             <div class="container">
                     <ul class="mainnav">
			
                                <?php
                                $segment = $this->uri->segment(1);
                               
                                ?>
				

                                <li  class="<?php if($segment=='GuiDashobard' || $segment=='StudentGUI'): echo 'active';endif;?>">
					<a href="GuiDashobard">
						<i class="icon-dashboard"></i>
						<span>Dashboard</span>
					</a>	    				
				</li>
                                <li  class="<?php if($segment=='StudentGUI'): echo 'active';endif;?>">
					<a href="StudentGUI">
						<i class="icon-dashboard"></i>
						<span>Dashboard Chart</span>
					</a>	    				
				</li>
				<li  class="<?php if(
                                        $segment=='StdAttendance' || 
                                        $segment=='teacherClassWise' ||
                                        $segment=='montlyWise' ||
                                        $segment=='perSubject' ||
                                        $segment=='teacherCurriculum' ||
                                        $segment=='studentAttendanceDetail' ||
                                        $segment == 'teacherClassWiseMonthly'): echo 'active';endif;?>">
					<a href="StdAttendance">
						<i class="icon-asterisk"></i>
						<span>Academic  Performance</span>
					</a>	    				
				</li>
				<li  class="<?php if($segment=='GuiHR'): echo 'active';endif;?>">
					<a href="GuiHR">
						<i class="icon-user"></i>
						<span>HR</span>
					</a>	    				
				</li>
				<li  class="<?php if(
                                        $segment=='GuiInvenotry' ||
                                        $segment == 'inventoryDetails'): echo 'active';endif;?>">
					<a href="GuiInvenotry">
						<i class="icon-sitemap"></i>
						<span>Inventory</span>
					</a>	    				
				</li>
				 
					<li>					
					<a href="javascript:void(0)">
						<i class="icon-bar-chart"></i>
						<span>Finance</span>
					</a>  									
				</li>
				
				
<!--				<li  class="<?php if($segment=='GuiReports'): echo 'active';endif;?>">
					<a href="GuiReports">
						<i class="icon-list-alt"></i>
						<span>Reports</span>
					</a>    				
				</li>-->
				
			 
<!--                                <li  class="<?php if($segment=='GuiAttandance'): echo 'active';endif;?>">				
					<a href="GuiAttandance">
						<i class="icon-list"></i>
						<span>Attendance </span>
					</a>  									
				</li>-->
                                <!--
                
                
                <li>					
					<a href="shortcodes.html">
						<i class="icon-code"></i>
						<span>Shortcodes</span>
					</a>  									
				</li>
				
				<li class="dropdown">					
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-long-arrow-down"></i>
						<span>Drops</span>
						<b class="caret"></b>
					</a>	
				
					<ul class="dropdown-menu">
                    	<li><a href="icons.html">Icons</a></li>
						<li><a href="faq.html">FAQ</a></li>
                        <li><a href="pricing.html">Pricing Plans</a></li>
                        <li><a href="login.html">Login</a></li>
						<li><a href="signup.html">Signup</a></li>
						<li><a href="error.html">404</a></li>
                    </ul>    				
				</li>-->
			
			</ul>

		</div> <!-- /container -->
	
	</div> <!-- /subnavbar-inner -->

</div> <!-- /subnavbar -->
    
