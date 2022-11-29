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
        alert("Record Update Successfully...");
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
<!--            <a href="CheckLeaving/<?php echo $this->uri->segment(2);?>"
             onclick="myFunction()" class="btn btn-primary">Click After Print</a>-->
            <br><br>
            <?php
            
//            echo '<pre>';print_r($result);die;
            
            ?>
            <div class="row cols-wrapper">
                <div id="div_print">
                    <div style="width:100%;height:500px;padding-top:98px; ">
                    
                        <div style="width:100%;padding-left:12%;font-size:16px;font-weight:bold;margin-bottom:3px;">
                            <strong style="margin-left:11%"><?php echo $result->student_name;?></strong> <strong style="margin-left:28%"><?php echo $result->father_name;?></strong>
                         </div>
                        <div style="width:60%;padding-left:24%;font-size:16px;font-weight:bold;margin-bottom:3px;">
                            <strong><?php echo $result->college_no;?></strong>    
                        </div>
                        <div style="width:100%;float:left;padding-left:10%;font-size:16px;font-weight:bold;margin-bottom:40px;">
                            <strong style="margin-left:11%"><?php echo $result->admission_date;?></strong> <strong style="margin-left:30%"><?php echo $result->leaving_date;?></strong>
                        </div>
                         <div style="width:60%;padding-left:25%;font-size:16px;font-weight:bold;margin-bottom:9px;">
                            <strong><?php echo $result->board_regno;?></strong>    
                        </div>
                         
                        <div style="width:60%;padding-left:40%;font-size:16px;font-weight:bold;margin-bottom:4px;">
                            <strong><?php echo $result->dob_figure;?></strong>    
                        </div>
                        <div style="width:60%;padding-left:35%;font-size:16px;font-weight:bold;margin-bottom:8px;">
                            <strong><?php echo $result->dob_in_word;?></strong>    
                        </div>
                      <div style="width:60%;padding-left:40%;font-size:16px;font-weight:bold;margin-bottom:8px;">
                            <strong>Dues Clear</strong>    
                        </div>
                      <div style="width:80%;padding-left:53%;font-size:16px;font-weight:bold;margin-bottom:8px;">
                            <strong><?php echo $result->sub_program?></strong>    
                        </div>
                      <div style="width:60%;padding-left:60%;font-size:16px;font-weight:bold;margin-bottom:154px;">
                            <strong>Yes</strong>    
                        </div>
                         <div style="width:60%;padding-left:40%;font-size:16px;font-weight:bold;margin-bottom:141px;">
                            <strong>Good</strong>    
                        </div>
                        <div style="width:60%;padding-left:29%;font-size:16px;font-weight:bold;margin-bottom:9px;">
                            <strong><?php echo date('d-m-Y');?></strong>    
                        </div>
                      
                </div>      
            </div>
                </div>
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 