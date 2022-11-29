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
    
    function myFunction() 
    {
        alert("Do You have Issued Student Character Certificate..?");
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
              </button>
            <a href="AdminDeptController/character_issued/<?php echo $this->uri->segment(3);?>"
             onclick="myFunction()" class="btn btn-primary">Click if Issued</a>
            <br><br>
            <div class="row cols-wrapper">
                <div id="div_print">
                <div style="width:100%;height:500px;padding-top:235px;">
                    <div style="width:100%;float:left;padding-left:34%;font-size:16px;font-weight:bold;margin-bottom:12px;">
                       <strong><?php echo $result->student_name;?></strong>
                    </div>
                    <div style="width:60%;float:left;padding-left:20%;font-size:16px;font-weight:bold;margin-bottom:12px;">
                        <strong><?php echo $result->father_name;?></strong>    
                    </div>
                    <div style="width:40%;float:right;padding-left:20%;font-size:16px;font-weight:bold;margin-bottom:12px;">
                        <strong><?php echo $result->college_no;?></strong>
                    </div>
                    <div style="width:70%;float:left;padding-left:40%;font-size:16px;font-weight:bold;margin-bottom:135px;">
                        <strong><?php  $adate = $result->admission_date;
            $aDate = date("d-m-Y", strtotime($adate));echo $aDate;?></strong>    
                    </div>
                    <div style="width:30%;float:right;padding-left:10%;font-size:16px;font-weight:bold;margin-bottom:120px;">
                        <strong><?php 
                     $ldate = $result->leaving_date;
             $lDate = date("d-m-Y", strtotime($ldate));echo $lDate;
                    ?></strong>
                    </div>
                    
                    <div style="width:100%;float:left;padding-left:20%;font-size:20px;font-weight:bold;">
                        <strong><?php echo date('d-m-Y')?></strong>
                    </div>
                </div>      
            </div>
                </div>
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 