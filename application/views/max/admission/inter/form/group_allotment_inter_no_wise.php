<style>
    input[type=checkbox]{
    zoom: 1.5;
    }
</style>

<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
          <h1 class="heading-title pull-left"><?php echo $page_header?></h1>
          <div class="breadcrumbs pull-right">
            <ul class="breadcrumbs-list">
              <li class="breadcrumbs-label">You are here:
              </li>
              <li> 
                <?php echo anchor('admin/add_group_student', 'Home');?> 
                <i class="fa fa-angle-right">
                </i>
              </li>
              <li class="current"><?php echo $page_header?>
            </ul>
          </div>
          <!--//breadcrumbs-->
        </header> 
        <div class="page-content">
            <div class="row">
                <article class="contact-form col-md-12 col-sm-7"> 
                    <div class="col-md-12">
                         <?php echo form_open('',array('class'=>'course-finder-form','id'=>'search_form'));?>
                        <section class="course-finder" style="padding-bottom: 2%;">
                            <h1 class="section-heading text-highlight">
                                <span class="line"><?php echo $page_header?> Panel</span>
                            </h1>
                            <div class="section-content">
                               
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="name">Student Name</label>
                                       <input type="text" class="form-control" name="student_name" placeholder="Student Name">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Father Name</label>
                                       <input type="text" class="form-control" name="father_name" placeholder="Father Name" >
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">College No</label>
                                       <input type="text" class="form-control" name="college_no" placeholder="College No.">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Program</label>
                                       <?php   echo form_dropdown('programe_id', $program,'',  'class="form-control"');   ?>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Batch</label>
                                       <?php    echo form_dropdown('batch_id', $batch,'',  'class="form-control" ');   ?>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Sub Program</label>
                                       <?php    echo form_dropdown('sub_pro_id', $sub_program,'',  'class="form-control" ');  ?>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="name">Shift</label>
                                       <?php    echo form_dropdown('shift', $shift,'',  'class="form-control" ');  ?>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Gender</label>
                                       <?php   echo form_dropdown('gender_id', $gender,'',  'class="form-control" ');  ?>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Student Number From</label>
                                       <input type="text" class="form-control" name="number_from" placeholder="Student Number From" >
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Student Number To</label>
                                       <input type="text" class="form-control" name="number_to" placeholder="Student Number To">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="name" style=" visibility: hidden;">Gender sdfsd</label>
                                        <input type="button" name="Search" id="Search"  value="Search" class="btn btn-theme"> 
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="name">Section</label>
                                       <?php    echo form_dropdown('sec_id', $section,'',  'class="form-control" id="section" ');  ?>
                                    </div>
                                     <div class="col-md-2">
                                        <label for="name" style=" visibility: hidden;">Gender sfsdsds</label>
                                       <button type="button" name="Save" value="Save" id="Save" class="btn btn-theme">  <i class="fa fa-save">   </i> Save  </button>
                                    </div>
                                </div>  

                              

                            </div>
                        </section>
                        
                        <div id="search_result">
                            
                        </div>
                          <?php echo form_close();?>
                    </div>
            </div>
        </div> 
    </div>
</div>
 
 
  
  <script>
  jQuery(document).ready(function(){
     jQuery('#Search').on('click',function(){
        jQuery.ajax({
         type   :'post',
         url    :'AdmissionController/search_group_allotment_inter',
         data   :$("#search_form").serialize()+"&Search=Search",
         success:function(result){
           jQuery('#search_result').html(result);
         }
         
     });
         
         
     });
     jQuery('#Save').on('click',function(){
         
         if(jQuery('#section').val() == ''){
             alert('Please Select Section');
             jQuery('#section').focus();
             return false;
         }
        jQuery.ajax({
         type   :'post',
         url    :'AdmissionController/search_group_allotment_inter',
         data   :$("#search_form").serialize()+"&Save=Save",
         success:function(result){
            alert('Record Update Successfully')
           window.location.reload();
         }
         
     });
         
         
     });
  });
  </script>
  
  
 