<style type="text/css" rel="stylesheet" >
    @font-face {
        font-family: 'Noto Nastaliq Urdu Draft';
        font-style: normal;
        /*font-weight: 300;*/  
        src: url(assets/css/fonts/NotoNastaliqUrduDraft.eot);
        src: url(assets/css/fonts/NotoNastaliqUrduDraft.eot?#iefix) format('embedded-opentype'),
             url(assets/css/fonts/NotoNastaliqUrduDraft.woff2) format('woff2'),
             url(assets/css/fonts/NotoNastaliqUrduDraft.woff) format('woff'),
             url(assets/css/fonts/NotoNastaliqUrduDraft.ttf) format('truetype');
      }
</style>
<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left"><?php echo $page_header?></h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current"><?php echo $page_header?></li>
                    </ul>
                </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
        
        
        
        
        
      <div class="row">
          <div class="col-md-12">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                                     
                                     ?>
                                <div class="row">
                                     <div class="col-md-2 col-sm-5">
                                          <label for="name">College No</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'collegeNo',
                                                 'value'        => $result->college_no,
                                                'type'          => 'text ',
                                                 'class'        => 'form-control',
                                                'placeholder'   => 'College No',    
                                                ));
                                        ?>
                                    </div>
                                    
                                    <div class="row">
                                        <?php 
                                      
                                    if(!empty($result)):
                                        ?>
                                        <div class="col-md-3 col-sm-5">
                                        <label for="name">Change Address</label>
                                        
                                        <textarea name="stdAddress" rows="5" cols="35" ><?php  echo $result->app_postal_address;?></textarea>
                                        <?php

                                             echo  form_input(array(
                                                'name'          => 'stdId',
                                                 'value'            => $result->student_id,
                                                'type'          => 'hidden',
                                                 'class'         => 'form-control',
                                                'placeholder'   => 'Student Address',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                        <div class="col-md-2 col-sm-5">
                                        <label for="name">Phone Number 1</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'mobiel1',
                                                 'value'            => $result->mobile_no,
                                                'type'          => 'text ',
                                                 'class'         => 'form-control',
                                                'placeholder'   => 'Mobile 1',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                        <div class="col-md-2 col-sm-5">
                                        <label for="name">Phone Number 2</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'mobiel2',
                                                 'value'            => $result->mobile_no2,
                                                'type'          => 'text ',
                                                 'class'         => 'form-control',
                                                'placeholder'   => 'Mobile 2',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                        <div class="col-md-2 col-sm-5">
                                        <label for="name">Amount</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'amount',
                                                 'value'        => $result->amount,
                                                'type'          => 'text ',
                                                 'class'         => 'form-control',
                                                'placeholder'   => 'Amount ',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                        <div class="col-md-2 col-sm-5">
                                        <label for="name">Print date</label>
                                        <?php
                                            $pdate = '';
                                            if($result->print_date == ''):
                                                     $pdate = date('d-m-Y');
                                            else:
                                                $pdate =$result->print_date;
                                            endif;
                                            echo form_input(array(
                                                'name'          => 'pdate',
                                                 'value'        =>  date('d-m-Y', strtotime($pdate)),
                                                'type'          => 'text',
                                                 'class'         => 'form-control datepicker',
                                                'placeholder'   => 'Print date',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                        <div class="col-md-2 col-sm-5">
                                        <label for="name">Due date</label>
                                        <?php
                                            
                                         $ddate = '';
                                       
                                            if($result->due_date == ''):
                                                    $ddate = date('d-m-Y');
                                            else:
                                                $ddate =$result->due_date;
                                            endif;
                                            echo form_input(array(
                                                'name'           => 'ddate',
                                                 'value'         => date('d-m-Y', strtotime($ddate)),
                                                 'type'          => 'text',
                                                 'class'         => 'form-control datepicker',
                                                'placeholder'    => 'Print date',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                        <div class="col-md-2 col-sm-5">
                                        <label for="name">Diary Number</label>
                                        <?php
                                            
                                            $title = $this->CRUDModel->get_where_row('student_dairy',array('status'=>1));
                                            $diaryNo =$result->count;
                                             
 
                                                
                                            
                                            echo form_input(array(
                                                'name'          => 'title_count',
                                                 'value'        => $title->title.'/'.$diaryNo,
                                                 'type'          => 'text',
                                                 'class'         => 'form-control',
                                                 'disabled'     => 'disabled',
                                                'placeholder'   => 'Diary Number',    
                                                ));
                                            echo form_input(array(
                                                'name'          => 'dairyId',
                                                 'value'        => $title->sd_id,
                                                'type'          => 'hidden',
                                                 'class'         => 'form-control',
                                                'placeholder'   => 'Diary Number',    
                                                ));
                                            echo form_input(array(
                                                'name'          => 'dairyCount',
                                                 'value'        => $diaryNo,
                                                'type'          => 'hidden',
                                                 'class'        => 'form-control',
                                                'placeholder'   => 'Diary Number',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                      <?php
                                    endif;
                                    
                                    ?>
                                    </div>
                                     
                                     
                                      
                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-2 pull-right">
                                     <button type="submit" class="btn btn-theme" name="update" value="update"  ><i class="fa fa-recycle"></i> Updates</button>
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
                        
                            <div class="row">
                                <?php
                                if(!empty($result)): ?>
                                    <div id="div_print">
                                        
                                        <div class="col-md-12" style="margin-left: 80px;">
                                            <!--<h5  align="left" >Ph: 091-5275154 - 5273021<br/>&nbsp; &nbsp;www.edwardes.edu.pk</h5>-->
                                            <br/>    
                                            <br/>    
                                            <br/>    
                                            <br/>    
                                            <br/>    
                                            <br/>    
                                            <br/>    
                                        <h5  align="left" > Ref: <?php echo $result->title.'/'.$result->count;?></h5>
                                        <h5  align="left"> <?php  echo date('F j,Y', strtotime($pdate));?> </h5>
                                        
                                        <!--<h4 align="Right" style=" position: relative; bottom: 31px;"> Ref: DN/ 2016-17</h4>-->
                                        <h2 align="center" style="text-decoration: underline;">"D-NOTICE"</h2>
                                        <table width="90%" border="0">
                                                <tr>
                                                    <td colspan="6"><strong>Mr/Ms&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $result->father_name;?> </strong> </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6"><strong>Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo wordwrap($result->app_postal_address, 35, "</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", true); ;?> </strong> </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6"><strong>Phone&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $result->mobile_no; if(!empty($result->mobile_no2)): echo '/'.$result->mobile_no2; endif;?></strong> </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" style="width: 50%"><br/><br/>You are hereby notified that student:&nbsp;&nbsp;<strong style="text-decoration: underline;"><?php echo $result->student_name;?></strong> </td>
                                                    
                                                    
                                                </tr>
                                                <tr>
                                                     
                                                    <td colspan="6" style="width: 100%"><br/>Batch :<strong style="text-decoration: underline;"><?php echo $result->batch_name;?></strong> </td>
                                                    
                                                </tr>
                                                <tr>
                                                        
                                                        <td colspan="2" style="width: 16%; text-align: left;"><br/>College No :<strong style="text-decoration: underline;"> <?php echo $result->college_no;?> </strong> </td>
                                                        <td colspan="2" style="width: 16%; text-align: left;"><br/>Group :<strong style="text-decoration: underline;"> <?php echo $result->name;?> </strong> </td>
                                                        <td colspan="2" style="width: 16%; text-align: left;"><br/>Class :<strong style="text-decoration: underline;"> <?php echo $result->sub_program;?> </strong> </td>
                                                    
                                                 </tr>
                                              
                                               
                                                    <tr>
                                                
                                                      <td colspan="6" style=" text-align: justify;"><br/>has outstanding fee of Rs:<strong><?php echo $result->amount;?> /-</strong> (Fee bill is enclosed) Please pay College dues on or before <strong><?php  echo date('F j, Y', strtotime($ddate));?></strong> otherwise his/her name will be struckoff the College rolls. Once struckoff a student and wishing to re-join the College will be required to apply for re-admission and thereby incur all administrative charges.<br/><br/></td>
                                                    </tr>
                                                <tr>
                                                    <td colspan="6" style="text-align: center;"><img src="assets/images/d-notice-urdu3.png"  style="width: 100%;"></td>
                                                </tr>
                                           
<!--                                                <tr>
                                                    <td colspan="6"><br/><br/>Thanking you.<br/><br/><br/><br/></td>
                                                </tr>-->
                                           
                                                
                                        </table>
                                             <div>
                                                 <br/>
                                                 <br/>
                                                 <br/>
                                                 <!--<h5 align="left">Sarfaraz Khan<br/>Director Finance</h5>-->
                                                 <!--<h5 align="left"></h5>-->
<!--                                                 <h5 align="right" style=" position: relative; bottom: 53px; right: 123px;">Prof.Dr.Nayer Fardows</h5>
                                                 <h5 align="right" style=" position: relative; bottom: 53px; right: 206.3px; ">Principal </h5>-->
                                              </div>
                                          </div>
                                         </div>
                                <?php
                                endif;
                                ?>
                         
                                 </div>
 
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
 
   
     
     <script>
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 3,
        dateFormat: 'd-m-yy'
    });
  } );
  </script> 
  
  
   <script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
//var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>