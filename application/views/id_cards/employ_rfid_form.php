
<style>
    a.btn-cta, .btn-cta{
    background: #f12b24;
    color: #fff;
    padding: 10px 20px;
    font-size: 18px;
    line-height: 1.33;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    -ms-border-radius: 0;
    -o-border-radius: 0;
    border-radius: 0;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #f12b24;
    
    }
</style>

<!-- ******CONTENT****** --> 
        <div class="content container">
              
            <div class="row cols-wrapper">
               <?php if(!empty($idcard_active)): ?>
                <div class="col-md-4">
                    
                    <section class="course-finder" style="background-color: #fcfcfc; border: none;">
                    <h1 class="section-heading text-highlight"><strong><span class="line">ID Card Credentials</span></strong></h1>
                        
                        <div class="section-content">
                            <form class="course-finder-form" action="IDCardController/update_employ_rfid" id="saveForm" name="saveForm" method="post">
                                <div class="row">
                                    
                                    <div class="col-md-12 subject form-group">
                                        <label style="text-indent: 3px">RF ID:</label>
                                        <input type="text" class="form-control" name="rfid" id="rfid" autocomplete="off" value="<?php echo $idcard_active->idce_rfid?>">
                                        <input type="hidden" readonly="readonly" name="idceid" id="idceid" value="<?php echo $idcard_active->idce_id?>">
                                    </div>
                                    
                                </div>
                                
                            </form>
                        </div>
                    </section>
                    
                </div>
                
                <div class="col-md-8">
                        
                    <style>
                        h1, h2,h3,h4,h5,h6 { margin: 0; padding: 0; font-family: "Calibri" !important;}
                        .idcard_size {font-family: "Calibri"; width: 88.6mm; height:56.4mm; background: url(assets/images/idcard_data/edwardes_college_image.jpg) no-repeat center; 
                                     background-size: cover; float: left; margin-right: 20px; }
                        .card_header {background-color: #208e4c; text-align: center; }
                        .card_header img { height: 12mm; width: auto; margin: 3px; }
                        .idc_student_image{ height: 33mm; width: 25mm; }
                        .card_title { text-align: center; vertical-align: middle }
                        .card_detail { vertical-align: top; padding: 5px 5px 0px; position: relative; }
                        .card_detail_back { vertical-align: middle; padding: 5px; position: relative; height: 35mm; }
                        .issuing_auth { height: 14mm; width: 18mm; position: absolute; bottom: 0; right: 0; text-align: center; }
                        .ecp_back_logo{ height: 33mm; width: 25mm; background: url(assets/images/students/ECP1.png) no-repeat; background-size: contain; }
                    </style>
                    <?php 
                        echo '<div class="idcard_size">
                            <div class="card_header">
                                <table style="width:95%; margin: 0px auto;">
                                    <tr>
                                        <td class="card_title"><img src="assets/images/idcard_data/ECP1.png" ></td>
                                        <td class="card_title"><h4 style="color:#fff"><strong>EDWARDES COLLEGE PESHAWAR</strong></h4><h5 style="color:#fff">STUDENT ID CARD</h5></td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                                <table style="width:99%; margin: 0px auto;">
                                    <tr>
                                        <td width="20%">
                                            <div class="idc_student_image" style="background: url(assets/images/employee/'.$emp_rec->picture.') center no-repeat; background-size: contain;"></div>
                                        </td>
                                        <td class="card_detail">
                                            <h3><strong>'.$idcard_active->idce_emp_name.'</strong></h3>
                                            <h4><strong>College No. '.$idcard_active->idce_cnic.'</strong></h4>
                                            <h5 style="margin-bottom: 5px;"><strong>'.$idcard_active->idce_designation.'</strong></h5>
                                            <h5><strong>Issue Date: '.$idcard_active->idce_issue_date.'</strong></h5>
                                            <h5><strong>Expiry Date: <span style="color:#c00;">'.$idcard_active->idce_expiry_date.'</span></strong></h5>
                                            <div class="issuing_auth">
                                                <img src="assets/images/idcard_data/principal_signature.png" style="width:15mm; height: auto;">
                                                <p style="font-size: 9px; text-decoration:underline;margin:0px;"><strong>PRINCIPAL</strong></p>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <div style="background: #208e4c; width: 100%; height: 10mm;"></div>
                            </div>
                        </div>
                        <div class="idcard_size">
                            <table style="width:99%; margin: 0px auto;">
                                <tr>
                                    <td class="card_detail_back">
                                        <h5>&nbsp;</h5>
                                        <h5><strong>Father Name: '.$idcard_active->idce_father_name.'</strong></h5>
                                        <h5><strong>Address: '.$idcard_active->idce_address.'</strong></h5><br>
                                        <h5><strong>Res Phone: '.$idcard_active->idce_contact.'</strong></h5>
                                        <h5><strong>Blood Group: '.$idcard_active->title.'</strong></h5>
                                    </td>
                                    <td width="23%" style="vertical-align:top; padding-top: 15px;">
                                        <img src="assets/images/idcard_data/ECP1.png" style="height: 18mm; width: auto">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-top: 2px solid #208e4c;">
                                        <p style="font-size: 9px;">STUDENT MUST DISPLAY THIS CARD WHILE IN COLLEGE<br>
                                        THIS CARD IS NON-TRANSFERABLE<br>
                                        IF THE CARD IS LOST, REPORT TO THE YEAR HEAD OFFICE IMMEDIATELY<br>
                                        IF FOUND PLEASE RETURN TO BELOW ADDRESS</p>
                                        <p style="font-size: 10px; font-weight:bold">EDWARDES COLLEGE PESHAWAR &nbsp;
                                        PH: 091-5275154, &nbsp; 091-5275211</p>

                                    </td>
                                </tr>
                            </table>
                        </div>';
                    ?>
                        
                </div>
                <div class="clearfix"></div>
                <h1>&nbsp;</h1>
                <div class="col-md-12">
                    <?php
                    if($idcard_all):
                        $serial = 0;
                        echo '<h1 class="section-heading text-highlight"><strong>PRINTED ID CARDS</strong></h1>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>S No.</th>
                                    <th>College No</th>
                                    <th>Student Name</th>
                                    <th>Father Name</th>
                                    <th>Program</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    <th>Blood Group</th>
                                    <th>Print Date</th>
                                    <th>Print By</th>
                                </tr>
                            </thead>
                            <tbody>';
                                foreach($idcard_all as $row):
                                echo '<tr>
                                    <td>'.++$serial.'</td>
                                    <td>'.$row->idce_cnic.'</td>
                                    <td>'.$row->idce_emp_name.'</td>
                                    <td>'.$row->idce_father_name.'</td>
                                    <td>'.$row->idce_designation.'</td>
                                    <td>'.$row->idce_contact.'</td>
                                    <td>'.$row->idce_address.'</td>
                                    <td>'.$row->title.'</td>
                                    <td>'.$row->idce_print_date.'</td>
                                    <td>'.$row->emp_name.'</td>
                                </tr>';
                                endforeach;
                            echo '</tbody>
                            <tbody></tbody>
                        </table>';
                    endif;
                    ?>
                </div>
                
            <?php else: echo '<h1 class="section-heading text-highlight"><strong>No Card Printed Yet.</strong></h1>'; endif; ?>
            </div><!--//cols-wrapper-->

        </div><!--//content-->
    <!--<script type="text/javascript" src="assets/plugins/jquery-1.12.3.min.js"></script>-->
    <!--<script type="text/javascript" src="assets/plugins/jquery.mask.min.js"></script>-->
<script>
jQuery(document).ready(function(){
    
    $('#rfid').focus();
    $('#rfid').select();
    
//    $('#rfid').on('keydown', function(){
//        alert('test');
//    });
    
    $(document).scannerDetection({
    
  //https://github.com/kabachello/jQuery-Scanner-Detection

    timeBeforeScanTest: 200, // wait for the next character for upto 200ms
    avgTimeByChar: 40, // it's not a barcode if a character takes longer than 100ms
    endChar: [13],
    //preventDefault: true, //this would prevent text appearing in the current input field as typed 
    onComplete: function(barcode, qty){
      alert(barcode);
      } // main callback function 
    });

    
    $('html').bind('keypress', function(e){
        if(e.keyCode == 13){
           return false;
        }
     });

 });
 
 
</script>