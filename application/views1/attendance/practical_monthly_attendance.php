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
<div class="content container">
    <h2 align="left">Student Practical Monthly Attendance<hr></h2>
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
            <article class="contact-form col-md-12 col-sm-7">   
         <form method="post">
           
            <div class="form-group col-md-2">
            <?php        
                if(!empty($group_id)){
                    $sect = $this->AttendanceModel->get_by_id('practical_group',array('prac_group_id'=>$group_id));
                    foreach($sect as $sectrec)
                    { ?>          
        <input type="text" name="group_id" value="<?php echo $sectrec->group_name; ?>" placeholder="Group Name" class="form-control" id="groupName">
                    <input type="hidden" name="group_id" id="group_id" value="<?php echo $sectrec->prac_group_id; ?>">      
                    <?php 
                    }     
                }else{?>
        <input type="text" name="group_id" class="form-control" placeholder="Group Name" id="groupName">
        <input type="hidden" name="group_id" id="group_id">       
                    <?php
                    }    
                ?>                  
            </div> 
            <div class="form-group col-md-6"> 
            <input type="submit" name="search" class="btn btn-theme" value="Search">
            <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>   
            </div>    
        </form>
            <?php if(@$result):?> 
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count($result);?>
            </button>
            </p>
        <div id="div_print">        
        <div class="col-md-12">
            <?php
            if(!empty($group_id)){
                $sect = $this->AttendanceModel->get_by_id('practical_group',array('prac_group_id'=>$group_id));
                foreach($sect as $sectrec){ ?> 
            <h3 style="text-align:center;font-weight:bold">Monthly Attendance of Practical Group - <?php echo $sectrec->group_name; ?></h3> 
            <?php }
            }
            ?>
        </div>               
        <table class="table table-boxed table-bordered table-striped">
        <thead>
            <tr style="font-size:15px;font-weight:bold" align="center">
                <td rowspan="2">S.N</td>
                <td rowspan="2">C.No</td>
                <td rowspan="2">Name</td>
                <?php foreach($group as $gRow):?>
                <td colspan="5" align="center"><?php echo $gRow->title;?></td>
                <?php endforeach;?>
                <td rowspan="2">Attended<br>Lectures</td>
                <td rowspan="2">Total<br>Lectures</td>
                <td rowspan="2">% Age</td>
            </tr>
<tr style="font-size:15px;font-weight:bold" align="center">
                <?php 
                if(!empty($group)):
                foreach($group as $gRow):?>
                    <td>Sep</td>
                    <td>Oct</td>
                    <td>Nov</td>
                    <td>Dec</td>
                    <td>Jan</td>
                <?php 
                endforeach;
                endif;
                ?>
            </tr>
            </thead>
            <tbody>
        <?php 
            $s =1;
            $Attend_class = "";
            $Absent_class = "";
            foreach($result as $pRow):    
        ?>    
        <tr>
            <td><strong><?php echo $s;?></strong></td>
            <td><strong><?php echo $pRow->college_no;?></strong></td>
            <td><strong><?php echo $pRow->student_name;?></strong></td>
            <?php 
            if(!empty($group)):
                foreach($group as $gRow):
                  
                  $month  = array(
                  '0'=>9,
                  '1'=>10,
                  '2'=>11,
                  '3'=>12,
                  '4'=>1,
                  );
                foreach($month as $key):
                echo '<td align="center">';
                    $where = array(
                        'subject_id'            => $gRow->prac_subject_id,
                        'group_id'              => $gRow->group_id,
                        'college_no'            =>$pRow->college_no,
                        'month(attendance_date)'=>$key,
                        );
          //  ECHO '<pre>';print_r($where);
            $q = $this->AttendanceModel->get_studentPractical_att($where);
                            $p=0;
                            $a=0;
                            foreach($q as $r):
                                if($r->status == 1):
                                    $p++;
                                    else:
                                    $a++;
                                endif;
                              endforeach;
                            echo $p;
                            $Attend_class += $p;
                            $Absent_class += $a;
                echo '</td>'; 
                endforeach;
                endforeach;
                endif;
            ?>
        <td align="center"><?php echo $Attend_class; ?></td>    
        <td align="center"><?php echo $t = $Absent_class + $Attend_class; ?></td>    
        <td align="center"><?php 
        
        
            if($t != 0):
                echo round($Attend_class*100/$t,2);
            endif;
        
         ?></td>    
        </tr>     
        <?php 
            $s++;
            $Attend_class = "";
            $Absent_class = "";
            endforeach;
        ?>    
        </tbody>
    </table>
            <?php echo $print_log;?>
        </div>    
                <?php endif; ?>
            </article>
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 