<div class="clearfix"></div>		
    </div>

    <script>
  
                  
    var toggle = true;

    $(".sidebar-icon").click(function() {                
      if (toggle)
      {
        $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
        $("#menu span").css({"position":"absolute"});
      }
      else
      {
        $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
        setTimeout(function() {
          $("#menu span").css({"position":"relative"});
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
</body>
</html>