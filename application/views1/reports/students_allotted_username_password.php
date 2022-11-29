<style>
    input[type=checkbox]{
    zoom: 1.5;
    }
</style>
<script language="javascript">
function printdiv1(printpage)
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
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?php echo $ReportName?>
      </h1>
      <div class="breadcrumbs pull-right">
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-label">You are here:
          </li>
          <li> 
            <?php echo anchor('admin/admin_home', 'Home');?> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current"><?php echo $ReportName?>
          </li>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7  page-row">                            
          <?php echo form_open('',array('class'=>'form-inline')); ?>
            <div class="row">
            <div class="col-md-12">
              
<!--              <div class="form-group">
                <?php
                    $student_id = array(
                    'name'	=> 'college_no',
                    'value'	=> $college_no,
                    'class'     =>'form-control',
                    'placeholder'=>'College No'
                    );
                    echo form_input($college_no);
                    ?>
              </div>-->
              <!--//form-group-->
              <div class="form-group">
                  <input name="college_no" value="<?php if($college_no): echo $college_no;endif; ?>" type="number" class="form-control" placeholder="College No">
              </div>
              <!--//form-group-->     
              <div class="form-group">
                  <input name="student_name" type="text" value="<?php if($student_name): echo $student_name;endif; ?>" class="form-control" placeholder="Name">
              </div>
              <!--//form-group-->
              <div class="form-group">
                <input name="father_name" type="text" value="<?php if($father_name): echo $father_name;endif; ?>"  class="form-control" placeholder="Father name">
              </div>
              <!--//form-group-->
          <div class="form-group">
            <?php 
                echo form_dropdown('program', $program, $programId,  'class="form-control" id="SProgrameId"');
            ?>
          </div>
              <!--//form-group-->
          <div class="form-group">
           <select class="form-control" name="sub_program" id="showingSubPro">
            <option value="">Sub Program</option>  
            </select>
          </div>
          <div class="form-group">
              <select class="form-control" name="sections_name" id="showingSections">
            <option value="">Section</option>  
            </select>
          </div>
        <div class="form-group">
            <select class="form-control" name="batch" id="showingbatch_id">
            <option value="">Batch Name</option>  
            </select>
          </div>        
        <div class="form-group">
            <button type="submit" name="search" value="search" class="btn btn-theme">
                <i class="fa fa-search">
              </i> Search
            </button>
            <button type="button" class="btn btn-theme" name="print" value="print"  onClick="printdiv1('div_print');"  ><i class="fa fa-print"></i> Print</button>
          </div>
               
            </div>
          </div>    
            <?php
            if(@$result):
            ?>
            <p><button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count($result)?>
            </button></p>
            
            <div id="div_print">
            <div style="width:100%;">
            <?php
                foreach($result as $resRow):
            ?>
            
        <div style="width:32%; height:100px; border:2px solid #000; margin-right:8px;margin-bottom:20px; float:left">
            <div style="width:100%; float:left; height:98px; padding:10px;line-height: 28px;">
            <p>
                <strong>Path:  www.minotech.systems/ecms/student_login</strong><br>
                <strong>College Number: <?php echo $resRow->college_no;?></strong><br>
                <strong>Password: <?php echo $resRow->student_password;?></strong><br>
            </p>
            </div>
                </div>
                <?php endforeach;?>
            </div>
            </div>
             <?php 
            else:
                echo '<h3 class="has-divider text-highlight">No query found..</h3>';
            endif;
            ?>
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
 
 