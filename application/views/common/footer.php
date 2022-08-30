   
  

</div><!--//wrapper-->  
 
    
    <!-- *****CONFIGURE STYLE****** -->  
    <div class="config-wrapper hidden-xs">
        <div class="config-wrapper-inner">
            <a id="config-trigger" class="config-trigger" href="#"><i class="fa fa-cog"></i></a>
            <div id="config-panel" class="config-panel">
                <p>Choose Colour</p>
                <ul id="color-options" class="list-unstyled list-inline">
                    <li class="default active" ><a data-style="assets/css/styles.css" data-logo="assets/images/logo.png" href="#"></a></li>
                    <li class="green"><a data-style="assets/css/styles-green.css" data-logo="assets/images/logo-green.png" href="#"></a></li>
                    <li class="purple"><a data-style="assets/css/styles-purple.css" data-logo="assets/images/logo-purple.png" href="#"></a></li>
                    <li class="red"><a data-style="assets/css/styles-red.css" data-logo="assets/images/logo-red.png" href="#"></a></li>
                </ul><!--//color-options-->
                <a id="config-close" class="close" href="#"><i class="fa fa-times-circle"></i></a>
            </div><!--//configure-panel-->
        </div><!--//config-wrapper-inner-->
    </div><!--//config-wrapper-->
 
    <!-- Javascript -->   

    <script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
    <script type="text/javascript" src="assets/plugins/bootstrap-hover-dropdown.min.js"></script> 
    <script type="text/javascript" src="assets/plugins/back-to-top.js"></script>
    <script type="text/javascript" src="assets/plugins/jquery-placeholder/jquery.placeholder.js"></script>
    <script type="text/javascript" src="assets/plugins/pretty-photo/js/jquery.prettyPhoto.js"></script>
    <script type="text/javascript" src="assets/plugins/flexslider/jquery.flexslider-min.js"></script>
    <script type="text/javascript" src="assets/plugins/jflickrfeed/jflickrfeed.min.js"></script> 
    <script src="assets/js/jquery-ui.js" ></script>
    <!--<script type="text/javascript" src="assets/js/main.js"></script>-->            
    <script type="text/javascript" src="assets/js/common.js"></script>  
    <script type="text/javascript" src="assets/js/admission.js"></script>  
    <script type="text/javascript" src="assets/js/library.js"></script>  
    <script type="text/javascript" src="assets/js/finance.js"></script>
     <script type="text/javascript" src="assets/js/finance_HM.js"></script>  
    <script type="text/javascript" src="assets/js/inventory.js"></script>  
    <script type="text/javascript" src="assets/js/hr.js"></script>  
    <script type="text/javascript" src="assets/js/attendance.js"></script>  
    <script type="text/javascript" src="assets/js/tour.js"></script>  
    <script type="text/javascript" src="assets/js/student.js"></script>  
    <script type="text/javascript" src="assets/js/hostel.js"></script>  
    <script type="text/javascript" src="assets/js/fee.js"></script>  
     <script type="text/javascript" src="assets/js/dropdown_autocomplete.js"></script>  

    <script src="assets/plugins/jquery.mask.min.js"></script>
    
    
  
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery(function() {
                jQuery('.date').mask('99-99-9999');
                jQuery('.date_time').mask('9999-99-99 99:99:99');
                jQuery('.number').mask('99999');
                jQuery('.year').mask('9999');
                jQuery('.phone').mask('9999-9999999');
                jQuery('.nic').mask('99999-9999999-9');
                jQuery('.reg').mask('SSS-999999999');
            });
        });

  
  $( function() {
       var d = new Date();
d.setMonth(1); 
    $( "#datepicker" ).datepicker({
      defaultDate: 1,
      dateFormat: 'yy-mm-dd'
    });
  } );
  
$(document).ajaxStart(function() {
  $("#loading").show();
});

$(document).ajaxStop(function() {
  $("#loading").hide();
  $("#st-tree-container").show();
});
 
    </script><!---->

 <script>
  jQuery(function() {
    jQuery( ".date_format_d_m_yy").datepicker({
        dateFormat: 'dd-mm-yy'
    });
  });
  </script> 

      
          
</body>


</html> 

