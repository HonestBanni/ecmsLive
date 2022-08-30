<script language="javascript">
  function printdiv(printpage)
  {
    var headstr = "<html><head><title></title></head><body>";
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
    strong{
        font-size: 16px;
    }
</style>
        <div class="content container">
            <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme">
                <i class="fa fa-print">
                </i> Print 
              </button><br><br>
            <div class="row cols-wrapper">
                <div id="div_print">
                <div style="width:100%;height:500px;padding-top:340px;">
                    <div style="width:100%;float:left;padding-left:45%;font-size:16px;font-weight:bold;margin-bottom:18px;">
                       <strong><?php echo $result->student_name;?></strong>
                    </div>
                    <div style="width:100%;float:left;padding-left:27%;font-size:16px;font-weight:bold;margin-bottom:21px;">
                        <strong><?php echo $result->father_name;?></strong>    
                    </div>
                    <div style="width:56%;float:left;padding-left:27%;font-size:16px;font-weight:bold;margin-bottom:19px;">
                        <strong><?php echo $result->uni_regno;?></strong>
                    </div>
                    <div style="width:44%;float:right;padding-left:12%;font-size:16px;font-weight:bold;margin-bottom:19px;">
                        <strong><?php echo $result->college_no;?></strong>
                    </div>
                    <div style="width:62%;float:left;padding-left:47%;font-size:16px;font-weight:bold;margin-bottom:92px;">
                        <strong><?php echo $academic->year_of_passing;?></strong>
                    </div>
                    <div style="width:38%;float:right;padding-left:13%;font-size:16px;font-weight:bold;margin-bottom:92px;">
                        <strong><?php echo $academic->rollno;?></strong>
                    </div>
                    <div style="width:70%;float:left;padding-left:33%;font-size:16px;font-weight:bold;margin-bottom:73px;">
                        <strong><?php echo $academic->obtained_marks;?>/<?php echo $academic->total_marks;?></strong>    
                    </div>
                    <div style="width:30%;float:left;padding-left:5%;font-size:16px;font-weight:bold;margin-bottom:73px;">
                        <strong><?php echo $academic->div_title;?></strong>    
                    </div>
                    <div style="width:100%;float:left;padding-left:60%;font-size:16px;font-weight:bold;margin-bottom:54px;">
                        <strong>Good</strong>    
                    </div>
                    <div style="width:50%;float:left;padding-left:15%;font-size:16px;font-weight:bold;margin-bottom:54px;">
                        <strong></strong>    
                    </div>
                    <div style="width:100%;float:left;padding-left:17%;font-size:16px;font-weight:bold;margin-bottom:17px;">
                        <strong><?php echo date('d-m-Y')?></strong>    
                    </div>
                    
                </div>      
            </div>
                </div>
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 