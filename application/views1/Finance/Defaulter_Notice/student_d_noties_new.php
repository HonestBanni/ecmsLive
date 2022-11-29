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
                                                 'value'        => $collegeNo,
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
                                                'required'      => 'required',
                                                'type'          => 'text ',
                                                 'class'         => 'form-control',
                                                'placeholder'   => 'Amount ',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                        <div class="col-md-2 col-sm-5">
                                        <label for="name">Print date</label>
                                        <?php
                                           
                                            echo form_input(array(
                                                'name'          => 'pdate',
                                                 'value'        =>  date('d-m-Y'),
                                                'type'          => 'text',
                                                'required'      => 'required',
                                                 'class'         => 'form-control datepicker',
                                                'placeholder'   => 'Print date',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                        <div class="col-md-2 col-sm-5">
                                        <label for="name">Due date</label>
                                        <?php
                                            
                                            echo form_input(array(
                                                'name'           => 'ddate',
                                                 'value'         => date('d-m-Y'),
                                                 'type'          => 'text',
                                                 'required'      => 'required',
                                                 'class'         => 'form-control datepicker',
                                                'placeholder'    => 'Print date',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                        <div class="col-md-2 col-sm-5">
                                        <label for="name">Diary Number</label>
                                        <?php
                                            $dairy = '';
                                            $title          = $this->CRUDModel->get_where_row('student_dairy',array('status'=>1));
                                            $diaryCount     =   $this->CRUDModel->get_max_value('count','student_denotice',array('sd_id'=>$title->sd_id));
                                            if(!empty($diaryCount)):
                                                    $diaryNo  = $diaryCount->count+1;
                                            else:
                                                    $diaryNo = 1;
                                            endif;
                                           
 
                                                
                                            
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
                                <div class="col-md-4 pull-right">
                                    <button type="submit" class="btn btn-theme" name="search" id="search"  value="Search" ><i class="fa fa-search"></i> Search</button>
                                    <?php
                                    if(!empty($result)):
                                        echo '<button type="submit" class="btn btn-theme" name="save" value="save"  ><i class="fa fa-book"></i> Save</button>';
                                    endif;
                                    ?>
<!--                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>-->
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
                       
 
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