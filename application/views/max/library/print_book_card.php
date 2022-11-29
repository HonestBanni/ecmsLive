<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body><p></p>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>
<style>
.rotateimg90 {
  -webkit-transform:rotate(90deg);
  -moz-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  transform: rotate(90deg);
}
#div2 {
    transform: rotate(90deg);
	transform-origin: left top 0;
}    
</style>
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
      <div class="page-content">
      <div class="row">
     <h2 align="left"><span  style="float:right">
          <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>    
              </span></h2>
        <div id="div_print"> 
            <style>
.rotateimg90 {
  -webkit-transform:rotate(90deg);
  -moz-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  transform: rotate(90deg);
}
#div2 {
    
    transform: rotate(90deg);
	transform-origin: left top 0;
}                
</style>
    <div style="width:80%;border:1px solid #000;min-height:440px;margin:0px auto">
<!--
        <div style="width:45%;float:left;border:1px solid #000">
            <img style="margin-top:40px;margin-left:300px;margin-bottom:60px;border-radius:5px" width="100" height="100" class='img-responsive rotateimg90' src='assets/RQ/library_rq/<?php // echo $std_rq->rq_image;?>'>
        </div>
        <div style="width:45%;float:right;border:1px solid #000">
            <img style="margin-top:40px;margin-left:200px;margin-bottom:60px;border-radius:5px" width="100" height="100" class='img-responsive rotateimg90' src='assets/images/logog.png' alt='Edwardes College Peshawar'>
        </div>
-->
        
        <div style="width:60%;float:left;">
            <img style="margin-top:40px;margin-left:200px;margin-bottom:60px;border-radius:5px" width="100" height="100" class='img-responsive rotateimg90' src='assets/RQ/library_rq/<?php echo $std_rq->rq_image;?>'>
            <div style="margin-top:40px;margin-left:290px;min-height:100px;width:300px">
                <h5 id="div2">
                Name:  <?php echo $student_data->student_name;?>
                <br>F-Name:  <?php echo $student_data->father_name;?>
                <br>College#:  <?php echo $student_data->college_no;?></h5>
            </div>
        </div>
        <div style="width:30%;float:right;margin-right:20px;">
            <img style="margin-top:40px;margin-left:40px;margin-bottom:60px;border-radius:5px" width="100" height="100" class='img-responsive rotateimg90' src='assets/images/logog.png' alt='Edwardes College Peshawar'>
            <img style="margin-top:40px;margin-left:40px;border-radius:5px" width="80" height="100" class='img-responsive rotateimg90' src='assets/images/students/<?php echo $student_data->applicant_image;?>' alt='Edwardes College Peshawar'>
        </div>
<!--
            <div style="width:60%;float:left;margin:0px auto">
                <img style="margin-top:20px;margin-left:10px;border-radius:5px" class='img-responsive rotateimg90' src='assets/images/logog.png' alt='Edwardes College Peshawar'>
            </div>
-->
<!--
            <div style="width:30%;;float:right">
                <img style="margin-top:20px;margin-right:10px;border-radius:5px" src="assets/images/students/<?php //  echo $student_data->applicant_image;?>" width="80" height="100" class="rotateimg90">
                <h5 style="margin-top:20px;margin-left:20px;">Name:  <?php // echo $student_data->student_name;?></h5>
                <h5 style="margin-left:20px;">F-Name:  <?php // echo $student_data->father_name;?></h5>
                <h5 style="margin-left:20px;">College#:  <?php // echo $student_data->college_no;?></h5>
            </div>
-->
    </div>
          </div>
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 