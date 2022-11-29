
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Fixed Barcode Report 
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
          <li class="current">Fixed Barcode Report
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Fixed Barcode Report Panel</span>
                        </h1>
                        <div class="section-content" >
                           
                                <div class="row">
                                      <?php echo form_open('',array('class'=>'form-inline course-finder-form','name'=>'reportForm'));   ?>
                                    <div class="col-md-12">
                                        <div class="form-group ">   
                                        <?php
                                            echo form_input(array(
                                                'name'          => 'emp_id',
                                                'id'            => 'emp_id',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Employee name',
                                                'type'          => 'text'
                                                ));
                                            echo form_input(array(
                                                'name'          => 'emp_idCode',
                                                'id'            => 'emp_idCode',
                                                'class'         => 'form-control',

                                                'type'          => 'hidden'
                                                ));?>

                                      </div>
                                        <div class="form-group">

                                                <?php
                                                  echo form_input(array(
                                                  'name'          => 'blockName',
                                                  'id'            => 'blockName',
                                                  'value'         => '',
                                                  'class'         => 'form-control',
                                                  'placeholder'   => 'Block name',
                                                  'type'          => 'text',
                                                  ));

                                                  echo form_input(array(
                                                  'name'          => 'blockNameId',
                                                  'id'            => 'blockNameId',
                                                  'value'         => '',
                                                  'class'         => 'form-control',
                                                 'type'          => 'hidden',
                                                  ));
                                              ?>



                                           </div>

                                        <div class="form-group">

                                                <?php
                                                  echo form_input(array(
                                                  'name'          => 'itemname',
                                                  'id'            => 'itemname',
                                                  'value'         => '',
                                                  'class'         => 'form-control',
                                                  'placeholder'   => 'Item name',
                                                  'type'          => 'text',
                                                  ));

                                                  echo form_input(array(
                                                  'name'          => 'itemnameCode',
                                                  'id'            => 'itemnameCode',
                                                  'value'         => '',
                                                  'class'         => 'form-control',
                                                 'type'          => 'hidden',
                                                  ));
                                              ?>



                                           </div>

                                            <div class="form-group ">

                                                  <?php
                                                    echo form_input(array(
                                                    'name'          => 'roomname',
                                                    'id'            => 'roomname',
                                                    'value'         => '',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Room',
                                                    'type'          => 'text',
                                                    ));

                                                    echo form_input(array(
                                                    'name'          => 'roomnameCode',
                                                    'id'            => 'roomnameCode',
                                                    'value'         => '',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Room',
                                                    'type'          => 'hidden',
                                                    ));
                                                ?>



                                             </div>
                                            <div class="form-group ">

                                                  <?php
                                                    echo form_input(array(
                                                    'name'          => 'fromdate',
                                                    'id'            => 'fromdate',
                                                     'placeholder'   => 'From Date',
                                                     'required'   => 'required',
                                                    'class'         => 'form-control datepicker',
                                                    ));

                                                    
                                                ?>



                                             </div>
                                            <div class="form-group ">

                                                  <?php
                                                    echo form_input(array(
                                                    'name'          => 'todate',
                                                    'id'            => 'todate',
                                                    'placeholder'   => 'To Date',
                                                    'required'      => 'required',
                                                    'class'         => 'form-control datepicker',
                                                    ));

                                                    
                                                ?>



                                             </div>
                                        <div class="form-group">
                                          <button type="button" name="search" value="search" id="searchBarcode" class="btn btn-theme">
                                            <i class="fa fa-search"></i> Search </button>
                                          <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
                                      </div>
                                    </div>  
                                     
                                </div>
                            
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                             
                         </div><!--//section-content-->
                        
                        
                    </section>
          
          
          
          
          
          <article class="contact-form col-md-12 col-sm-7">                            
          <?php echo form_open('',array('class'=>'form-inline')); ?>
            <div class="row">
            
            
              
               
             
              <!--//form-group-->
                
               
            </div>
          </div>

         <?php echo form_close();
         
         ?>  
        
   
        <div id="div_print">
              <div id="reportResultBarcode">
            
            
            
        </div>
        </div>
 
        
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
      $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd-mm-yy'
    });
  } );
  </script>