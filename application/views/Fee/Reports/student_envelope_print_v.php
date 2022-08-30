 <script>
 window.print();
 </script>
<style>
    
/*    @page { margin: 0 }
        body { margin: 0 }
        .sheet {
          margin: 0;
          overflow: hidden;
          position: relative;
          box-sizing: border-box;
          page-break-after: always;
        }

        * Paper sizes *
        body.A3           .sheet { width: 297mm; height: 419mm }
        body.A3.landscape .sheet { width: 420mm; height: 296mm }
        body.A4           .sheet { width: 210mm; height: 296mm }
        body.A4.landscape .sheet { width: 297mm; height: 209mm }
        body.A5           .sheet { width: 148mm; height: 209mm }
        body.A5.landscape .sheet { width: 210mm; height: 147mm }

        * Padding area *
        .sheet.padding-10mm { padding: 10mm }
        .sheet.padding-15mm { padding: 15mm }
        .sheet.padding-20mm { padding: 20mm }
        .sheet.padding-25mm { padding: 25mm }

        * For screen preview *
        @media screen {
          body { background: #e0e0e0 }
          .sheet {
            background: white;
            box-shadow: 0 .5mm 2mm rgba(0,0,0,.3);
            margin: 5mm;
          }
        }

        * Fix for Chrome issue #273306 *
        @media print {
                   body.A3.landscape { width: 420mm }
          body.A3, body.A4.landscape { width: 297mm }
          body.A4, body.A5.landscape { width: 210mm }
          body.A5                    { width: 148mm }
        }*/
    
/*    @page { size: A5 }*/
/*@page {
  size: 4in 6in landscape;
}
@media print {
  @page {
    size: 50mm 150mm;
  }*/
   
/*}*/
</style>
<style>
div {
    background-color: yellow;
    /* Rotate div */
    
    /*-ms-transform: rotate(90deg);  IE 9 */
    -webkit-transform: rotate(90deg); /* Chrome, Safari, Opera */
    /*transform: rotate(90deg);*/
    /*float: left;*/
    margin-top:50%
}
/*@media print and (width: 14.8cm) and (height: 21cm) {
@page {
margin: 2cm;
}
}*/
</style>
<body  >

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
   
  <div>
      <?php  
           echo ' <h3>To,</h3>';
        echo '<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$studentInfo->student_name.'&nbsp;&nbsp;S/D Of :&nbsp;&nbsp;'.$studentInfo->father_name.'</br>';
        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Address : '.$studentInfo->app_postal_address.'</br>';
        if(empty($studentInfo->applicant_mob_no1)):
            echo ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact No : '.$studentInfo->mobile_no.'</br>';
        else:
          echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact No : '.$studentInfo->mobile_no.' / '.$studentInfo->applicant_mob_no1.'</br>';
        endif;
        
          '<hr/><h3>From :  &nbsp;&nbsp;&nbsp;EDWARDES COLLEGE PESHAWAR<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Mall Peshawar cantt.<br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;091-5275154</h3>';
        ?>
     
      
  </div> 
   
    

   

</body>