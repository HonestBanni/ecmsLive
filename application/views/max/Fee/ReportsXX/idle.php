 
  
  <script>
  window.onbeforeunload = function (e) {
            jQuery.ajax({
                  type    :'post',
                  url     :'FeeController/close_status',
                  
                  success :function(result){
                     console.log(result);

                 }
              });

      };
      
    
    $(document).ready(function () {
          

        var idleState = false;
        var idleTimer = null;
        $('*').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
            clearTimeout(idleTimer);
            if (idleState == true) {
                
                 jQuery.ajax({
                        type   :'post',
                        url    :'FeeController/idle_status_live',
                        
                       success :function(result){
                           console.log(result);
//                           window.location('login');
                       }
                    });
                
                $("body").css('background-color','#fff');            
            }
            idleState = false;
            idleTimer = setTimeout(function () {
                
                   jQuery.ajax({
                        type   :'post',
                        url    :'FeeController/idle_status',
                       
                       success :function(result){
                           console.log(result);
//                           window.location('login');
                       }
                    });
                
                 $("body").css('background-color','#000');  
                idleState = true; }, 5000);
        });
        $("body").trigger("mousemove");
    }); 
  </script>
  
  <h1>User Status : <?=$user_status?></h1>
  