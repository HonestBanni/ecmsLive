<script language="javascript">
//function printdiv(printpage)
//{
//var headstr = "<html><head><title></title></head><body><p></p>";
//var footstr = "</body>";
//var newstr = document.all.item(printpage).innerHTML;
//var oldstr = document.body.innerHTML;
//document.body.innerHTML = headstr+newstr+footstr;
window.print();
//window.onafterprint = window.close();
//document.body.innerHTML = oldstr;
//return false;
//}
//$(document).ready(function(){
//    window.print();
//});
</script>

<style>
    body {
  margin: 0;
  padding: 0;
  /*background-color: #FAFAFA;*/
  font: 12pt "Calibri";
}

* {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}

h1, h2,h3,h4,h5,h6 { margin: 0; padding: 0}

.page {
  width: 85.6mm;
  min-height: 54mm;
  padding: 0mm;
  margin: 0px;
/*  border: 1px #D3D3D3 solid;
  border-radius: 5px;*/
  background: white;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.subpage {
  padding: 0cm;
  /*border: 5px red solid;*/
  height: auto;
  /*outline: 2cm #FFEAEA solid;*/
}

.idcard_size {
    width: 88.6mm; 
    height:56.4mm; 
    background: url(assets/images/idcard_data/edwardes_college_image.jpg) no-repeat center; 
    background-size: cover;
}

.card_header {
    /*position: relative;*/
    background-color: #208e4c;
    text-align: center;
    /*padding: 10px 5px;*/
}

.card_header img {
    height: 12mm;
    width: auto;
    margin: 10px auto 2px;
}

.idc_student_image{
    height: 33mm;
    width: 25mm;
    /*background-size: cover;*/
}

.card_title { text-align: center; vertical-align: bottom }
.card_detail { vertical-align: top; padding: 4px 5px 0px; position: relative; }

.card_detail_back { 
    vertical-align: middle; 
    padding: 7px 5px 4px 10px; 
    position: relative; 
    /*height: 35mm;*/
}

.issuing_auth {
    height: 14mm;
    width: 18mm;
    /*background: #000;*/
    position: absolute;
    bottom: 0;
    right: 0;
    text-align: center;
}

.ecp_back_logo{
    height: 33mm;
    width: 25mm;
    background: url(assets/images/students/ECP1.png) no-repeat; 
    background-size: contain;
}

/*@page {
  size: A4 landscape;
  margin: 1cm 0cm;
}*/

@media print {
  .page {
    /*margin: 0;*/
    border: initial;
    border-radius: initial;
    width: initial;
    min-height: initial;
    box-shadow: initial;
    background: initial;
    /*page-break-after: always;*/
  }
  
  
}
</style>


<?php 
    echo '<div class="book" id="div_print">
        <div class="page">
            <div class="subpage">
                <div class="idcard_size">
                    <div class="card_header">
                        <table style="width:95%; margin: 0px auto;">
                            <tr>
                                <td class="card_title"><img src="assets/images/idcard_data/ECP1.png" ></td>
                                <td class="card_title"><h3 style="color:#fff"><strong>EDWARDES COLLEGE PESHAWAR</strong></h3><h5 style="color:#fff">EMPLOYEE ID CARD</h5></td>
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
                                    <h2>'.$employ_name.'</h2>
                                    <h5>CNIC: '.$emp_cnic.'</h5>
                                    <h5 style="margin-bottom: 5px;">Designation: '.$emp_design.'</h5>
                                    <h5>Issue Date: '.$issue_date.'</h5>
                                    <h5>Expiry Date: <span style="color:#c00;">'.$expiry_date.'</span></h5>
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
                                <h5>Father Name: '.$father_name.'</h5>
                                <h5>Address: '.$address.'</h5><br>
                                <h5>Res Phone: '.$contact.'</h5>
                                <h5>Blood Group: '.$blood_group.'</h5>
                            </td>
                            <td width="23%" style="vertical-align:top; padding-top: 15px;">
                                <img src="assets/images/idcard_data/ECP1.png" style="height: 18mm; width: auto">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border-top: 2px solid #208e4c; vertical-align: bottom; padding-left: 10px;">
                                <p style="font-size: 9px;">STUDENT MUST DISPLAY THIS CARD WHILE IN COLLEGE<br>
                                THIS CARD IS NON-TRANSFERABLE<br>
                                IF THE CARD IS LOST, REPORT TO THE YEAR HEAD OFFICE IMMEDIATELY<br>
                                IF FOUND PLEASE RETURN TO BELOW ADDRESS</p>
                                <p style="font-size: 10px; font-weight:bold;">EDWARDES COLLEGE PESHAWAR &nbsp;
                                PH: 091-5275154, &nbsp; 091-5275211</p>

                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>';
?>