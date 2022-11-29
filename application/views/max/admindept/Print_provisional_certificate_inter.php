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
        alert("Do You have Issued Student Provisional Certificate..?");
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
            <a href="AdminDeptController/provisional_issued/<?php echo $this->uri->segment(3);?>"
             onclick="myFunction()" class="btn btn-primary">Click if Issued</a>
            <br><br>
            <div class="row cols-wrapper">
                <div id="div_print">
                <div style="width:100%;height:500px;padding-top:326px;">
                    <div style="width:100%;float:left;padding-left:45%;font-size:16px;font-weight:bold;margin-bottom:18px;">
                       <strong><?php echo $result->student_name;?></strong>
                    </div>
                    <div style="width:100%;float:left;padding-left:27%;font-size:16px;font-weight:bold;margin-bottom:17px;">
                        <strong><?php echo $result->father_name;?></strong>    
                    </div>
                    <div style="width:60%;float:left;padding-left:27%;font-size:16px;font-weight:bold;margin-bottom:15px;">
                        <strong><?php echo $result->board_regno;?></strong>
                    </div>
                    <div style="width:40%;float:right;padding-left:7%;font-size:16px;font-weight:bold;margin-bottom:15px;">
                        <strong><?php echo $result->college_no;?></strong>
                    </div>
                    <div style="width:100%;float:left;padding-left:80%;font-size:16px;font-weight:bold;margin-bottom:15px;">
                        <strong><?php echo $academic->year_of_passing;?></strong>    
                    </div>
                    <div style="width:100%;float:left;padding-left:25%;font-size:16px;font-weight:bold;margin-bottom:91px;">
                        <strong><?php echo $academic->rollno;?></strong>    
                    </div>
                    <div style="width:70%;float:left;padding-left:33%;font-size:16px;font-weight:bold;margin-bottom:52px;">
                        <strong><?php echo $academic->obtained_marks;?>/<?php echo $academic->total_marks;?></strong>    
                    </div>
                    <div style="width:30%;float:left;padding-left:9%;font-size:16px;font-weight:bold;margin-bottom:52px;">
                        <strong><?php echo $academic->grade_name;?></strong>    
                    </div>
                    <div style="width:100%;float:left;padding-left:60%;font-size:16px;font-weight:bold;margin-bottom:50px;">
                        <strong>
                            <?php 
                                $sc = $this->CRUDModel->get_where_row('student_character', array('char_id'=>$academic->std_character));
                                
                                if(!empty($sc)):
                                    echo $sc->char_name;
                                endif;
                                
                            ?>
                        </strong>    
                    </div>
                    <div style="width:50%;float:left;padding-left:15%;font-size:16px;font-weight:bold;margin-bottom:50px;">
                        <strong></strong>    
                    </div>
                    <div style="width:100%;float:left;padding-left:20%;font-size:16px;font-weight:bold;margin-bottom:17px;">
                        <strong><?php echo date('d-m-Y')?></strong>    
                    </div>
                    
                </div>   
                 
                    
            </div>
                </div>
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 