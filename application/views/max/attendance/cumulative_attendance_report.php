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
    <h2 align="left">Cumulative Attendance Section Wise<hr></h2>
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
            <article class="contact-form col-md-12 col-sm-7">   
         <form method="post">

            <div class="col-md-2 col-sm-5">
                <label for="name">Teacher Name</label>
                <div class="input-group" id="adv-search">
                    <?php echo form_input(array('name'=>'employee_name', 'type'=>'text', 'value'=>$teacher_name, 'class'=>'form-control', 'id'=>'EmployeeNameWithSubjectAuto')); ?>
                    <?php echo form_input(array('name'=>'employee_id', 'type'=>'hidden', 'value'=>$teacher_id, 'class'=>'form-control', 'id' => 'EmployeeNameAutoId')); ?>
                </div>
            </div>
             
            <div class="col-md-2 col-sm-5">
                <label for="name">Subject Name</label>
                <div class="input-group" id="adv-search">
                    <?php echo form_input(array('name'=>'subject_name', 'type'=>'text', 'value'=>$subj_name, 'class'=>'form-control', 'id'=>'sub')); ?>
                    <?php echo form_input(array('name'=>'subjectId', 'type'=>'hidden', 'value'=>$subj_id, 'class'=>'form-control', 'id' => 'subject_id')); ?>
                </div>
            </div>
             
            <div class="col-md-2 col-sm-5">
                <label for="name">Program</label>
                <div class="input-group" id="adv-search">
                    <?php echo form_dropdown('program', $program, $programId,  'class="form-control programe_id" id="cumProgrameId"'); ?>
                </div>
            </div>

            <div class="col-md-2 col-sm-5">
                <label for="name">Sub Program</label>
                <div class="input-group" id="adv-search">
                    <?php echo form_dropdown('sub_program', $subprogrames, $subprogramId,  'class="form-control sub_pro_id" id="cumSubPro"'); ?>
                </div>
            </div>
             
            <div class="col-md-2 col-sm-5">
                <label for="name">Batch</label>
                <div class="input-group" id="adv-search">
                    <?php echo form_dropdown('batch', $batch, $batchId,  'class="form-control" id="cumBatchId"'); ?>
                </div>
            </div>
             
            <div class="col-md-2 col-sm-5">
                <label for="name">Section</label><br>
                <div class="input-group" id="adv-search">
                    <?php echo form_dropdown('section', $sections, $sectionId, 'class="form-control section" id="cumSections" required="required"'); ?>
                </div>
            </div>
             
             
            <div class="col-md-2 pull-right">
                <label for="name"> &nbsp;</label><br>
                <div class="form-group">
                    <input type="submit" name="search" class="btn btn-theme" value="Search">
                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
                </div>
            </div> 
               
        </form>
               
            <?php if(@$cum_result):?> 
           
        <div id="div_print">        
        <div class="col-md-12">
            <?php
            if(!empty($sectionId)){
                $sect = $this->AttendanceModel->get_title_cumulative(array('sec_id'=>$sectionId));
                 ?> 
            <h2 style="text-align:center;font-weight:bold">Cumulative Attendance Report</h2> 
            <div class="col-sm-4"><h5><strong>Sub Program: </strong><?php echo $sect->sub_progamme; ?></h5></div>
            <div class="col-sm-4"><h5><strong>Section: </strong><?php echo $sect->section_name; ?></h5></div>
            <div class="col-sm-4"><h5><strong>Batch: </strong><?php echo $sect->batch_name; ?></h5></div>
            <?php }
            ?>
            <hr>
        </div> 
            
        <table class="table table-boxed table-bordered table-striped">
        <thead>
            <tr>
                <th>S No.</th>
                <th>College No.</th>
                <th>Name</th>
                <th>Father Name</th>
                <th>Total Classes</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Percentage</th>
            </tr>
            </thead>
            <tbody>
        <?php 
            $s =1;
            foreach($cum_result as $pRow):
                $ta = $pRow->total_attend;
                $pa = $pRow->p_attend;
                $percent = $pa/$ta*100;
        ?>    
        <tr>
            <td><strong><?php echo $s;?></strong></td>
            <td><strong><?php echo $pRow->college_no;?></strong></td>
            <td><strong><?php echo $pRow->student_name;?></strong></td>
            <td><strong><?php echo $pRow->father_name;?></strong></td>
            <td><strong><?php echo $pRow->total_attend;?></strong></td>
            <td><strong><?php echo $pRow->p_attend;?></strong></td>
            <td><strong><?php echo $pRow->a_attend;?></strong></td>
            <td><strong><?php echo number_format($percent, 2);?></strong></td>
        </tr>     
        <?php 
            $s++; 
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
 
<script>
  
    jQuery(document).ready(function(){

        jQuery('#cumProgrameId').on('click',function(){
            var programId = jQuery('#cumProgrameId').val();
            //get sub program
            jQuery.ajax({
                type   :'post',
                url    :'DropdownController/getCumSubProgram',
                data   :{'programId':programId},
                success :function(result){
                jQuery('#cumSubPro').html(result);
                },
                complete:function(){
                    var sub_program_id = jQuery('#cumSubPro').val();
                    var programId = jQuery('#cumProgrameId').val();
                    // get Section 
                    jQuery.ajax({
                        type   :'post',
                        url    :'DropdownController/getCumSections',
                        data   :{'sub_program_id':sub_program_id,'programId':programId},
                        success :function(result){
                            console.log(result);
                            jQuery('#cumSections').html(result);
                        }
                    });
                    //Get Batch 
                    jQuery.ajax({
                        type   :'post',
                        url    :'DropdownController/getCumBatch',
                        data   :{'programId':programId},
                        success :function(result){
                            console.log(result);
                            jQuery('#cumBatchId').html(result);
                        }
                    });
                }
            });
        });
     
        jQuery('#cumSubPro').on('change',function(){
            var programId = jQuery('#cumProgrameId').val();
            jQuery.ajax({
                type   :'post',
                url    :'DropdownController/getCumBatch',
                data   :{'programId':programId},
                success :function(result){
                    console.log(result);
                    jQuery('#cumBatchId').html(result);
                }
            }); 
        });
    
        jQuery('#cumSubPro').on('change',function(){
            var sub_program_id= jQuery('#cumSubPro').val();
            var programId = jQuery('#cumProgrameId').val();
            jQuery.ajax({
                type   :'post',
                url    :'DropdownController/getCumSections',
                data   :{'sub_program_id':sub_program_id,'programId':programId},
                success :function(result){
                    console.log(result);
                    jQuery('#cumSections').html(result);
                }
            });
        });
    });
  
</script>