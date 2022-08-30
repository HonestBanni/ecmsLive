
<style>
h1, h2,h3,h4,h5,h6 { margin: 0; padding: 0; font-family: "Calibri" !important;}
.idcard_size {font-family: "Calibri"; width: 88.6mm; height:56.4mm; background: url(assets/images/idcard_data/edwardes_college_image.jpg) no-repeat center; background-size: cover; }
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
                    <td class="card_title"><h4 style="color:#fff"><strong>EDWARDES COLLEGE PESHAWAR</strong></h4><h5 style="color:#fff">EMPLOYEE ID CARD</h5></td>
                </tr>
            </table>
        </div>
        <div>
            <table style="width:99%; margin: 0px auto;">
                <tr>
                    <td width="20%">
                        <div class="idc_student_image" style="background: url(assets/images/employee/'.$picture.') center no-repeat; background-size: contain;"></div>
                    </td>
                    <td class="card_detail">
                        <h3><strong>'.$emp_name.'</strong></h3>
                        <h5><strong>CNIC: '.$cnic.'</strong></h5>
                        <h5 style="margin-bottom: 5px;"><strong>Designation: '.$designation.'</strong></h5>
                        <h5><strong>Issue Date: '.$issue_date.'</strong></h5>
                        <h5><strong>Expiry Date: <span style="color:#c00;">'.$expiry_date.'</span></strong></h5>
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
                    <h5><strong>Father Name: '.$father_name.'</strong></h5>
                    <h5><strong>Address: '.$address.'</strong></h5><br>
                    <h5><strong>Res Phone: '.$contact.'</strong></h5>
                    <h5><strong>Blood Group: '.$blood_group.'</strong></h5>
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