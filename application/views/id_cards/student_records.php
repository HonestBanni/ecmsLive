<!-- ******CONTENT****** --> 
<div class="content container">
    <!-- ******BANNER****** -->
    <h2 align="left"><?php echo $ReportName?><hr></h2>
    <div class="row cols-wrapper">
        <div class="col-md-12">
            <section class="course-finder">
                <h1 class="section-heading text-highlight"><span class="line">Search Panel</span></h1>
                <?php echo form_open('',array('class'=>'course-finder-form','id'=>'print_wise_form')); ?>
                    <div class="section-content" >
                        <div class="row">
                            <div class="col-md-2 form-group">
                                <label for="name">Form #</label>
                                <?php echo  form_input(array(
                                    'name'          => 'Form',
                                    'id'            => 'Form',
                                    'type'          => 'number',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'Form #',
                                )); ?>
                            </div>

                            <div class="col-md-2 form-group">
                                <label for="name">College #</label>
                                <?php echo  form_input(array(
                                    'name'          => 'college_no',
                                    'id'            => 'college_no1',
                                    'type'          => 'number',
                                    'class'         => 'form-control',
                                    'placeholder'   => 'College #',
                                )); ?>
                            </div>

                            <div class="col-md-2 form-group">
                                <label for="name">Name</label>
                                <?php echo  form_input(array(
                                    'name'          => 'student_name',
                                    'id'            => 'student_name',
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
                                <label for="name">Program</label>
                                <div class="form-group ">
                                    <?php echo form_dropdown('programe_id', $program, '', 'class="form-control" id="programe_id"'); ?>
                                </div>
                            </div>

                            <div class="col-md-2 form-group">
                                <label for="name">Sub Program</label>
                                <div class="form-group ">
                                    <?php echo form_dropdown('sub_pro_id', $sub_program, '', 'class="form-control" id="sub_pro_id"'); ?>
                                </div>
                            </div> 

                            <div class="col-md-2 form-group">
                                <label for="name">Batch</label>
                                <div class="form-group ">
                                    <?php echo form_dropdown('batch', $batch, '', 'class="form-control" id="batch"'); ?>
                                </div>
                            </div>

                            <div class="col-md-2 form-group">
                                <label for="name" style="visibility: hidden;">Search Button</label>
                                <div class="form-group ">
                                    <button type="button" class="btn btn-theme" name="filter" id="search_std"  value="filter" ><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>

                        </div>
                    </div><!--//section-content-->
                              
                <?php echo form_close(); ?>
            </section>
                    
            <!--<div class="col-md-12">-->
                <div id="div_print">
                    <div id="total_records"></div>
                    <div class="">
                        <table class="table table-hover table-bordered" id="student_table">
                            <thead>
                                <tr>
                                    <th>S No.</th>
                                    <th>Picture</th>
                                    <th>Student Name</th>
                                    <th>Father Name</th>
                                    <th>Form No.</th>
                                    <th>College No.</th>
                                    <th>Gender</th>
                                    <th>Program</th>
                                    <th>Sub Program</th>
                                    <th>Status</th>
                                    <th colspan="3">Add / Update / Print</th>
                                </tr>
                                <input type="hidden" id="page_no">
                            </thead>
                            <tbody></tbody>
                        </table>
                        <!-- Paginate -->
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <span><ul class="pagination" id="pagination"></ul></span>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="ShowStudentProfile" role="dialog" style="z-index:9999">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                    <br>
                                </div>
                                <div class="section-content" id="profileResult" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="ManageImage" role="dialog" style="z-index:9999">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="UpdateStudentPicture" id="DisplayImageForm" method="POST" role="form" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Add / Update Student Picture</h4>
                                    </div>
                                    <div class="section-content" id="ChangePictureResult"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            <!--</div>-->
            
            
        </div><!--//col-md-3-->
        
    </div><!--//cols-wrapper-->
           
</div><!--//content-->
        
<script>
jQuery(document).ready(function(){
    
    $('#search_std').on('click', function(){
        loadGridPagination(0);
    });

    // Detect pagination click
    $('#pagination').on('click','a',function(e){
        e.preventDefault(); 
        var pageno = $(this).attr('data-ci-pagination-page');
        loadGridPagination(pageno);
        $('#page_no').val(pageno);
    });
    loadGridPagination(0);

    // Load pagination
    function loadGridPagination(pagno){
        var form_data = {
            'form_no'       : $('#Form').val(),
            'college_no'    : $('#college_no1').val(),
            'student_name'  : $('#student_name').val(),
            'father_name'   : $('#father_name').val(),
            'gender'        : $('#gender').val(),
            'programe_id'   : $('#programe_id').val(),
            'sub_pro_id'    : $('#sub_pro_id').val(),
            'batch'         : $('#batch').val()
        };
        $.ajax({
            url      : 'IDCardController/student_records_grid/'+pagno,
            type     : 'post',
            dataType : 'json',
            data     : form_data,
            success  : function(response){
                console.log(response.total)
                $('#pagination').html(response.pagination);
                createStdGrid(response.result,response.row,response.total);
            }
        });
    }

    // Create table list
    function createStdGrid(result,sno,ttl_rec){
        sno = Number(sno);
        var p_start = sno+1;
        $('#student_table tbody').empty();
        for(index in result){
            sno+=1;
            var tr = '<tr>';
            tr += '<td>'+ sno +"</td>";
                if(result[index].applicant_image != ''){
                    tr += '<td><img class="grid-image" src="assets/images/students/'+result[index].applicant_image+'" style="max-height: 60px; max-width: 75px;"></td>';
                } else{
                    tr += '<td><img class="grid-image" src="assets/images/students/user.png" style="max-height: 60px; max-width: 75px;"></td>';
                }
            tr += '<td>\n\
                <a href="javascript:void(0)" class="applicantProfile" data-toggle="modal" data-target="#ShowStudentProfile" id="'+result[index].student_id+'">\n\
                    <strong>'+ result[index].student_name +'</strong>\n\
                </a>\n\
            </td>';
            tr += '<td>'+ result[index].father_name +'</td>';
            tr += '<td>'+ result[index].form_no +'</td>';
            tr += '<td>'+ result[index].college_no +'</td>';
            tr += '<td>'+ result[index].gender_title +'</td>';
            tr += '<td>'+ result[index].programe_name +'</td>';
            tr += '<td>'+ result[index].sub_pro_name +'</td>';
            if(result[index].s_status_id == 5){
                var status_label = 'label-success';
            } else{
                var status_label = 'label-danger';
            }
            tr += '<td><span class="label '+status_label+'">'+ result[index].status_title +'</span></td>';
            tr += '<td>\n\
                <a href="UploadPicture/'+result[index].student_id+'"><button class="btn btn-primary btn-sm">Picture</button></a>\n\
            </td>';
            tr += '<td>\n\
                <a href="IDCardsCredentials/'+result[index].student_id+'"><button class="btn btn-theme btn-sm">ID Card</button></a>\n\
            </td>';
            tr += '<td>\n\
                <a href="RFIDForm/'+result[index].student_id+'"><button class="btn btn-danger btn-sm">RFID</button></a>\n\
            </td>';
            $('#student_table tbody').append(tr);
        }
        if(ttl_rec > 0){
            $('#total_records').html('<div class="alert alert-success"><strong>Showing: ('+p_start+' to '+sno+') - Total: '+ttl_rec+' Record(s) Found.</strong></div>');
        } else {
            $('#total_records').html('<div class="alert alert-danger"><strong>No Record Found.</strong></div>');
        }

        $('.applicantProfile').on('click',function(){
            var student_id = $(this).prop('id');
            $.ajax({
                type   : 'post',
                url    : 'ShowApplicantProfile',
                data   : {'std_id' : student_id},
                success :function(result){
                    $('#profileResult').html(result);
                }
            });
        });

    }
    
    jQuery('#programe_id').on('click',function(){
        var programId = jQuery('#programe_id').val();
        //get sub program
        jQuery.ajax({
            type   :'post',
            url    :'DDSubPrograms',
            data   :{'programId':programId},
            success :function(result){
               jQuery('#sub_pro_id').html(result);
            },
            complete:function(){
                //Get Batch 
                jQuery.ajax({
                    type   :'post',
                    url    :'DDBatch',
                    data   :{'programId':programId},
                    success :function(result){
                        console.log(result);
                        jQuery('#batch').html(result);
                    }
                }); 
            }
        });
    }); 
    
});
 
</script> 