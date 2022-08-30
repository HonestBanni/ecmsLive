<script language="javascript">
  function printdiv(printpage)
  {
    var headstr = "<html><head><title></title></head><body>";
//    var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
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
            <h1 class="heading-title pull-left">Trial Balance</h1>
            <div class="breadcrumbs pull-right">
                <ul class="breadcrumbs-list">
                    <li class="breadcrumbs-label">You are here:</li>
                    <li><?php echo anchor('admin/admin_home', 'Home');?> 
                      <i class="fa fa-angle-right">
                      </i>
                    </li>
                    <li class="current">Trial Balance</li>
                </ul>
            </div>
      <!--//breadcrumbs-->
        </header> 
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <section class="course-finder" style="padding-bottom: 2%;">
                    <h1 class="section-heading text-highlight">
                        <span class="line">Trial Balance</span>
                    </h1>
                    <div class="section-content" >
                        <?php echo form_open('',array('class'=>'course-finder-form'));
                            if(@$trialBalancea):
                               else:
                                            $dateFrom   = date('d-m-Y');
                                            $dateTo     = date('d-m-Y');
                                            $SubmName   = 'AddCOA';   
                                            $Code       = '';
                                            $coaId      = '';
                                            $title      = '';
                                            $comments   = '';
                                            $btn        = 'Add';
                                            $status     = '';
                                            $icon       = 'plus';

                                        endif;
                                     ?>
                                <div class="row">
                                      
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">From</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'dateFrom',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'Date from',
                                                    'id'            => 'dateFrom',
                                                    'type'          => 'text',
                                                    'value'         => $dateFrom,
                                                    ));
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">To</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'todate',
                                                'id'            => 'todate',
                                                'type'          => 'text',
                                                'value'         => $dateTo,
                                                'class'         => 'form-control datepicker',

                                                ));
                                        ?>
                                       
                                        
                                     </div>
<!--                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">Record Form</label>
                                         <div class="input-group" id="adv-search">
                                                <?php
                                                         form_input(
                                                             array(
                                                                'name'          => 'recordFrom',
                                                                'id'            => 'recordFrom',
                                                                 
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Record From',
                                                                 )
                                                             );
                                                      ?>
                                                
                                                 <?php
                                                      form_input(
                                                          array(
                                                                  'name'          => 'recordFromCode',
                                                                  'id'            => 'recordFromCode',
                                                                 
                                                                  'type'          => 'hidden',
                                                                  'class'         => 'form-control',
                                                                  'placeholder'   => 'Account',
                                                                  )
                                                          );
                                                  ?>
                                                 
                                                <div class="input-group-btn">
                                                    <div class="btn-group" role="group">
                                                        <div class="dropdown dropdown-lg">
                                                           
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="modal" data-target="#RecordFromTog" aria-expanded="false"><span class="caret"></span></button>
                                                            
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        
                                         
                                        
                                     </div>-->
<!--                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">Record to</label>
                                    
                                          
                                          
                                          
                                          <div class="input-group" id="adv-search">
                                                 <?php
                                              form_input(array(
                                            'name'          => 'recordTo',
                                            'id'            => 'recordTo',
                                        
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Record To',
                                            'type'          => 'text',
                                            ));
                                        ?>
                                          <?php
                                              form_input(array(
                                            'name'          => 'recordToCode',
                                            'id'            => 'recordToCode',
                                          
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Record To',
                                            'type'          => 'hidden',
                                            ));
                                        ?>
                                                 
                                                <div class="input-group-btn">
                                                    <div class="btn-group" role="group">
                                                        <div class="dropdown dropdown-lg">
                                                           
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="modal" data-target="#RecordToTog" aria-expanded="false"><span class="caret"></span></button>
                                                            
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                   </div>-->
                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-4 pull-right">
                                  
                                    <button type="button" class="btn btn-theme" name="search" id="searchTBOld"  value="Search" ><i class="fa fa-search"></i> Search</button>
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
                                    <button type="submit" class="btn btn-theme" name="export"  value="export" ><i class="fa fa-download"></i> Excel</button>
                                   
<!--                                    <button type="submit" class="btn btn-theme"  id="export" name="export"><i class="fa fa-refresh"></i> Export</button>-->
                                    
                                        
                                    
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
              
              <div id="trailBalance"></div>
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