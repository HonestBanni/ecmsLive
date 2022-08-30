 

<style>

.report_header{
    display: none !important;
}
 
</style>

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
                        <?php echo form_open('',array('class'=>'course-finder-form')); ?>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="name">Program</label>
                                <div class="form-group ">
                                    <?php 
                                        echo form_dropdown('programe_id', $program,$result->programme,  'class="form-control programe_id" id="feeProgrameId" required="required"');
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="name">Sub Program</label>
                                <div class="form-group ">
                                    <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                            echo form_dropdown('sub_pro_id', $sub_program,$result->sub_program,  'class="form-control sub_pro_id" id="showFeeSubPro" required="required"');
                                    ?>
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <label for="name">Date</label>
                                <div class="form-group ">
                                    <?php 
                                        echo  form_input(
                                            array(
                                               'name'          => 'date_pro',
                                               'type'          => 'text',
                                               'value'         => date('d-m-Y',strtotime($result->date)),
                                               'class'         => 'form-control datepicker',

                                                )
                                            );
                                        echo  form_input(
                                            array(
                                               'name'          => 'serial_pro',
                                               'type'          => 'hidden',
                                               'value'         => $result->serial_no,
                                               'class'         => 'form-control',

                                                )
                                            );
                                    ?>
                                </div>
                            </div> 

                            <div class="col-md-9">
                                <label for="name">Comments</label>
                                <div class="form-group ">
                                    <?php 
                                        echo  form_textarea(
                                            array(
                                               'name'          => 'comments',
                                               'rows'          => '2',
                                               'value'          => $result->comments,
                                               'class'         => 'form-control',
                                                )
                                            );
                                    ?>
                                </div>
                            </div> 
                            <div class="col-md-2">
                                <label for="name">&nbsp;</label>
                                <div class="form-group ">
                                    <button type="submit" class="btn btn-theme" name="update_pro" id="update_pro"  value="update_pro" ><i class="fa fa-plus"></i> Update Record</button>
                                </div>
                            </div> 
                        </div><!--//section-content-->
                        <?php echo form_close(); ?>
                   
                </section>
           
               
            </div> 
        </div>
    </div>
</div>
                
                         
    
      
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 
 
   
   
     <script>
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd-mm-yy'
    });
  } );
  </script>
  <style>
      .datepicker{
          z-index: 5;
      }
  </style>     
  
 