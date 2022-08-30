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
    <h2 align="left">Student Pre Board Test Marks<hr></h2>
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
            <article class="contact-form col-md-12 col-sm-7">   
         <form method="post">

            <div class="form-group col-md-3">
                <?php 
            echo form_dropdown('sections_name', $sections, $sectionId,  'class="form-control"');
                ?>
              </div>
            <div class="form-group col-md-6"> 
            <input type="submit" name="search" class="btn btn-theme" value="Search">
            <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>   
            </div>    
        </form>
            <?php if(@$result):?> 
           
        <div id="div_print">        
        <div class="col-md-12">
            <?php
            if(!empty($sectionId)){
                $sect = $this->AttendanceModel->get_by_id('sections',array('sec_id'=>$sectionId));
                foreach($sect as $sectrec){ ?> 
            <h3 style="text-align:center;font-weight:bold">Pre Board Result (Section - <?php echo $sectrec->name; ?>)</h3> 
            <?php }
            }
            ?>
        </div>               
        <table class="table table-boxed table-bordered table-striped">
        <thead>
            <tr>
                <th>S.N</th>
                <th>C.No</th>
                <th>Name</th>
                <?php 
                foreach($group as $gRow):
                ?>
                <th><?php echo $gRow->subject;?></th>
                <?php endforeach;?>
                <th>O-M / T-M</th>
                <th>% Age</th>
            </tr>
            </thead>
            <tbody>
        <?php 
            $s =1;
            $total_om = "";    
            $total_tm = "";    
            foreach($result as $pRow): 
        ?>    
        <tr>
            <td><strong><?php echo $s;?></strong></td>
            <td><strong><?php echo $pRow->college_no;?></strong></td>
            <td><strong><?php echo $pRow->student_name;?></strong></td>
            <?php 
            if(!empty($group)):
                foreach($group as $gRow):
                  
                echo '<td>';
                    $where = array(
                        'subject.subject_id'=> $gRow->subject_id,
                        'sections.sec_id'   => $gRow->sec_id,
                        'student_id' =>$pRow->student_id
                        );
            $q = $this->AttendanceModel->get_student_pre_board_test($where);
                    $om = 0;
                    $tm = 0;
                        foreach($q as $r): 
                            $om = $r->omarks;    
                            $tm = $r->tmarks;
                            echo $om.'/'.$tm;
                          endforeach; 
                echo '</td>'; 
                $total_om += $om;
                $total_tm += $tm;
                endforeach;
                endif;
            ?>
            <td><?php echo $total_om;?>/<?php echo $total_tm;?></td>
            <td><?php if($total_tm == 0): echo "0"; else: echo round($total_om*100/$total_tm,2); endif;?> %</td>
        </tr>     
        <?php 
            $s++;
             $total_om = "";   
             $total_tm = "";   
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
 
 