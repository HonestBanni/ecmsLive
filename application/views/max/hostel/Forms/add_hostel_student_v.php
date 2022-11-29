

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
                           <?php echo form_open('',array('class'=>'course-finder-form','id'=>'UpdateHostelStd'));?>
                             <div class="row">
                                 
                                  <div class="col-md-3 col-sm-5">
                                    <label for="name">Student Name</label>
                                            <?php
                                                 echo  form_input(
                                                         array(
                                                            'name'          => 'student_id',
                                                            'type'          => 'text',
                                                            'required'      => 'required',
                                                            'value'         => $result->student_name,
                                                            'class'         => 'form-control',

                                                             )
                                                         );
                                                  ?>
                                             <input type="hidden" name="student_id" id="student_id" value="<?php echo $result->student_id;?>">
                                       
                                            
                                     </div>
                                  <div class="col-md-3 col-sm-5">
                                    <label for="name">Student Hostel SMS No</label>
                                     
                                            <?php
                                                 echo  form_input(
                                                         array(
                                                            'name'          => 'student_mobile_no',
                                                            'id'          => 'student_mobile_no',
                                                            'type'          => 'text',
                                                             'value'        =>$result->student_mobile_no,
                                                            'required'      => 'required',
                                                            'placeholder'   => 'Student No ...',
                                                            'class'         => 'form-control phone',

                                                             )
                                                         );
                                                  ?>
                                            
                                        
                                            
                                     </div>
                                  <div class="col-md-3 col-sm-5">
                                    <label for="name">Hostel Block </label>
                                        
                                            <?php
                                                 echo form_dropdown('Building_block', $Building_block,'',  'class="form-control" required="required" id="BuildingBlock"');
                                                  ?>
                                            
                                         
                                            
                                     </div>
                                  <div class="col-md-3 col-sm-5">
                                    <label for="name">Room name</label>
                                       
                                            <?php
                                                $hostel_rooms = $this->CRUDModel->dropDown('invt_rooms', '', 'rm_id', 'rm_name',array('rm_id'=>$result->room_id));
                                                 echo form_dropdown('room_id', $hostel_rooms,'',  'class="form-control"  id="roomid" required="required"');
                                            ?>
                                         
                                            
                                     </div>
                                 
                                 <div class="col-md-3 col-sm-5">
                                    <label for="name">Allotted Date</label>
                                         
                                            <?php
                                            
                                            if($result->allotted_date == '0000-00-00'):
                                                
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'allotted_date',
                                                            'id'            => 'allotted_date',
                                                            'type'          => 'text',
                                                            'required'      => 'required',
                                                            'value'         => date('d-m-Y'),
                                                            'class'         => 'form-control date_format_d_m_yy',

                                                             )
                                                         );
                                                else:
                                                   echo  form_input(
                                                         array(
                                                            'name'          => 'allotted_date',
                                                            'id'            => 'allotted_date',
                                                            'type'          => 'text',
                                                            'required'      => 'required',
                                                            'value'         => date('d-m-Y',strtotime($result->allotted_date)),
                                                            'class'         => 'form-control date_format_d_m_yy',

                                                             )
                                                         );
                                            endif;
                                                 
                                                  ?>
                                            
                                            
                                     </div>
                                 
                                  <div class="col-md-3 col-sm-5">
                                    <label for="name">Hostel Batch</label>
                                        
                                            <?php
                                                 echo form_dropdown('hostel_batch', $hostel_batch,$result->hostel_batch_id,  'class="form-control" id="hostel_batch"');
                                            ?>
                                       
                                            
                                     </div>
<!--                                  <div class="col-md-3 col-sm-5">
                                    <label for="name">Hostel Status</label>
                                      
                                            <?php
                                                   form_dropdown('hostel_status', $hostel_status,'',  'class="form-control" id="hostel_status"');
                                                  ?>
                                             
                                            
                                     </div>-->
                                 
                             </div>
                             </div>
                        <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                    
                                    <button type="button" class="btn btn-theme" name="addHostel" id="addHostel"  value="Search" ><i class="fa fa-plus"></i> Update Record</button>
                                  
                                    
     
                                </div>
                            </div>
                    </section>
                    <div id="return_message">
                        
                    </div>
                     
                </div>    
            </div>    
        </div>    
    
    
    
    </div>
</div>

<script>
    jQuery(document).ready(function(){
        
        jQuery('#BuildingBlock').on('click',function(){
            jQuery.ajax({
                type:'post',
                url:'getBlockRooms',
                data:{'BbId':jQuery('#BuildingBlock').val()},
//                dataType: 'json',
                success: function(result){
                    jQuery('#roomid').html(result);
                }
                
                
            });
        });
        jQuery('#addHostel').on('click',function(){
            
            jQuery('#return_message').hide();
//             
//            if(jQuery('#student_mobile_no').val() === ''){
//                alert('Please enter mobile no ');
//                jQuery('#student_mobile_no').focus();
//            return false;
//            }
//
//            if(jQuery('#roomid').val() == '0'){
//                alert('Please enter room no.. .');
//                jQuery('#roomid').focus();
//                return false;
//            }
//            if(jQuery('#allotted_date').val() == ''){
//                 alert('Please select alloted date.. .');
//                jQuery('#allotted_date').focus();
//                return false;
//            }
//            if(jQuery('#hostel_batch').val() == ''){
//                 alert('Please select Hostel Batch');
//                jQuery('#hostel_batch').focus();
//                return false;
//            }
            var dataInsert ={
                'RId'               :jQuery('#roomid').val(),
                'student_mobile_no' :jQuery('#student_mobile_no').val(),
                'allotted_date'     :jQuery('#allotted_date').val(),
                'hostel_batch'      :jQuery('#hostel_batch').val(),
                'student_id'        :jQuery('#student_id').val(),
                 
            };
            
            jQuery.ajax({
                type        : 'POST',
                url         : 'adStdHostel',
                dataType    : 'JSON',
                cache       : false,
                data        : dataInsert,
                success     : function(result){
                    console.log(result);
                    jQuery('#return_message').show();
                    if(result['return'] == 1){
                       jQuery('#return_message').html(result['message']);
//                       setTimeout(function(){
//                            window.location.href='HostelRoomAllotement';
//                            
//                          }, 1000);
                    }else{
//                       jQuery('#UpdateHostelStd').trigger('reset'); 
                       jQuery('#return_message').html(result['message']); 
                    }
                    
                }
                
                
            });
        });
        
        
    });
</script> 