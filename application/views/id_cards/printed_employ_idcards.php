<!-- ******CONTENT****** --> 
<div class="content container">
    <!-- ******BANNER****** -->
    <h2 align="left"><?php echo $ReportName?><hr></h2>
    <div class="row cols-wrapper">
        <div class="col-md-12">
            <section class="course-finder">
                <h1 class="section-heading text-highlight"><span class="line">Search Panel</span></h1>
                <form action="IDCardController/print_employ_idcards_list" method="post" class="course-finder-form" id="std_id_form" target="_blank">
                    <div class="section-content" >
                        <div class="row">
                            <div class="col-md-2 form-group">
                                <label for="name">RFID</label>
                                <?php echo  form_input(array(
                                    'name'          => 'rfid',
                                    'id'            => 'rfid',
                                    'type'          => 'number',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'RFID',
                                )); ?>
                            </div>

                            <div class="col-md-2 form-group">
                                <label for="name">Name</label>
                                <?php echo  form_input(array(
                                    'name'          => 'employ_name',
                                    'id'            => 'employ_name',
                                    'type'          => 'text',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Student Name',
                                )); ?>
                            </div>

                            <div class="col-md-2 form-group">
                                <label for="name">Father Name</label>
                                <?php echo  form_input(array(
                                    'name'          => 'father_name',
                                    'id'            => 'father_name',
                                    'type'          => 'text',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Father Name',
                                 )); ?>
                            </div>
                            
                            <div class="col-md-2 form-group">
                                <label for="name">Gender</label>
                                <div class="form-group ">
                                    <?php  echo form_dropdown('gender', $gender, '', 'class="form-control" id="gender"'); ?>
                                </div>
                            </div> 

                            <div class="col-md-2 form-group">
                                <label for="name">Department</label>
                                <div class="form-group ">
                                    <?php echo form_dropdown('deptt', $department, '', 'class="form-control" id="deptt"'); ?>
                                </div>
                            </div>

                            <div class="col-md-2 form-group">
                                <label for="name">Designation</label>
                                <div class="form-group ">
                                    <?php echo form_dropdown('design', $designation, '', 'class="form-control" id="design"'); ?>
                                </div>
                            </div> 

                            <div class="col-md-2 form-group">
                                <label for="name">Contract Type</label>
                                <div class="form-group ">
                                    <?php echo form_dropdown('contract', $contract, '', 'class="form-control" id="contract"'); ?>
                                </div>
                            </div>
                            
                            <div class="col-md-2 form-group">
                                <label for="name">Category</label>
                                <div class="form-group ">
                                    <?php echo form_dropdown('category', $category, '', 'class="form-control" id="category"'); ?>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-2 form-group">
                                <label for="name">Status</label>
                                <div class="form-group ">
                                    <?php echo form_dropdown('status', $status, '', 'class="form-control" id="status"'); ?>
                                </div>
                            </div>
                            
                            <div class="col-md-2 form-group">
                                <label for="name">From</label>
                                <?php echo  form_input(array(
                                    'name'          => 'from_date',
                                    'id'            => 'from_date',
                                    'type'          => 'text',
                                    'class'         => 'form-control datepicker',
                                    'placeholder'   => 'From',
                                    'autocomplete'  => 'off',
                                 )); ?>
                            </div>
                            
                            <div class="col-md-2 form-group">
                                <label for="name">To</label>
                                <?php echo  form_input(array(
                                    'name'          => 'to_date',
                                    'id'            => 'to_date',
                                    'type'          => 'text',
                                    'class'         => 'form-control datepicker',
                                    'placeholder'   => 'To',
                                    'value'         => date('d-m-Y'),
                                    'autocomplete'  => 'off',
                                 )); ?>
                            </div>
                            
                            <div class="col-md-2 form-group">
                                <label for="name" style="visibility: hidden;">Search Button</label>
                                <div class="form-group ">
                                    <button type="button" class="btn btn-theme" name="search_std" id="search_std"  value="filter" >Search</button>
                                    <button type="submit" class="btn btn-danger" name="print_records" id="print_records">Print</button>
                                </div>
                            </div>

                        </div>
                    </div><!--//section-content-->
                              
                </form>
            </section>
                    
            <!--<div class="col-md-12">-->
                <div id="div_print">
                    <div id="idcard_records"></div>
                </div>
            <!--</div>-->
            
            
        </div><!--//col-md-3-->
        
    </div><!--//cols-wrapper-->
           
</div><!--//content-->
        
<script>
jQuery(document).ready(function(){
    
    $('#search_std').on('click', function(){
        $.ajax({
            type   : 'post',
            url    : 'IDCardController/employ_idcard_grid',
            data   : $('#std_id_form').serialize(),
            success :function(result){
               console.log(result);
               $('#idcard_records').html(result);
            }
        });
    });
    
    jQuery(function() {
        jQuery('.datepicker').datepicker( {
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'

        });
    });
    
    $('html').bind('keypress', function(e){
        if(e.keyCode == 13){
           return false;
        }
    });

});
 
</script> 