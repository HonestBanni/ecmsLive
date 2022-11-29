 <script>
 window.print();
 </script>
<body>

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
   
  <div>
      <?php  
      
//      echo '<pre>';print_r($studentInfo);die;
            echo ' <h3>To,</h3>';
        echo '<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$studentInfo->student_name.'&nbsp;&nbsp;S/D Of :&nbsp;&nbsp;'.$studentInfo->father_name.'</br>';
        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Address : '.$studentInfo->app_postal_address.'</br>';
        if(empty($studentInfo->applicant_mob_no1)):
            echo ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact No : '.$studentInfo->mobile_no.'</br>';
        else:
          echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact No : '.$studentInfo->mobile_no.' / '.$studentInfo->applicant_mob_no1.'</br>';
        endif;
        
        echo '<hr/><h3>From :  &nbsp;&nbsp;&nbsp;EDWARDES COLLEGE PESHAWAR<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Mall Peshawar cantt.<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;091-5275154</h3>';
// ?>
     
      
  </div> 
 
</body>