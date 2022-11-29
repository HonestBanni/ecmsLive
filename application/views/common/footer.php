   
  

</div><!--//wrapper-->  
 
     <div class="modal fade" id="entry_pr_loader" role="dialog" style="z-index:9999; margin-top: 400px;">
        <div class="modal-dialog">

                <div class="alert alert-info"><i class="fa fa-spin fa-spinner"></i> Please wait...!</div>

        </div>
    </div>
 
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
        
//         jQuery("#entry_pr_loader").hide();
//        jQuery(document).ajaxStart(function() {
//            
//            jQuery("#entry_pr_loader").show();
//            $('#entry_pr_loader').modal('toggle');
//            
//          });
//
//          jQuery(document).ajaxStop(function() {
//              $('#entry_pr_loader').modal('toggle');
//                jQuery("#entry_pr_loader").hide();
//             
//          });
      
        
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
    $( ".datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
         dateFormat: 'dd-mm-yy'
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

