<!-- ******CONTENT****** -->  
<div class="content container">
    <h2 align="left"><?php echo $ReportName?>
        <hr>
    </h2>
    <!-- ******BANNER****** -->
    <div class="row cols-wrapper">
        <div class="col-md-12">
            <section class="course-finder" style="padding-bottom: 2%;">
                <h1 class="section-heading text-highlight">
                    <span class="line">Search Form</span>
                </h1>
                <?php echo form_open('',array('class'=>'course-finder-form','method'=>'post')); ?>
                <div class="section-content" >
                    <div class="row">
                        <div class="col-md-3 col-sm-12 form-group">
                            <label for="name">Process No</label>
                            <?php
                                echo form_input(
                                    array(
                                        'name'  => 'ms_diary_no',
                                        'id'    => 'ms_diary_no',
                                        'type'  => 'text',
                                        'class' => 'form-control',
                                    )
                                );
                            ?>
                        </div>
 
                        <div class="col-md-3 col-sm-12 form-group">
                            <label for="name">Approve ID</label>
                            <?php
                                echo form_input(
                                    array(
                                        'name'  => 'approve_id',
                                        'id'    => 'approve_id',
                                        'type'  => 'text',
                                        'class' => 'form-control',
                                    )
                                );
                            ?>
                        </div>
 
                        <div class="col-md-3 col-sm-12 form-group">
                            <label for="name">Initiator</label>
                            <?php
                                echo form_input(
                                    array(
                                        'name'  => 'msb_name',
                                        'id'    => 'msb_name',
                                        'type'  => 'text',
                                        'class' => 'form-control',
                                    )
                                );
                                echo form_input(
                                    array(
                                        'name'  => 'msb_id',
                                        'id'    => 'msb_id',
                                        'type'  => 'hidden',
                                        'class' => 'form-control',
                                    )
                                );
                            ?>
                        </div>
 
<!--                        <div class="col-md-3 col-sm-12 form-group">
                            <label for="name">Department</label>
                            <?php // echo form_dropdown('dept_id', $department,'',  'class="form-control" id="dept_id"'); ?>
                        </div>
 
                        <div class="col-md-3 col-sm-12 form-group">
                            <label for="name">Initiator</label>
                            <?php // echo form_dropdown('msb_id', $min_sheet_by,'',  'class="form-control" id="msb_id"'); ?>
                        </div>-->
 
                        <div class="col-md-3 col-sm-12 form-group">
                            <label for="name">Chart of Account</label>
                            <div class="input-group" id="adv-search">
                               <?php
                                echo form_input(
                                     array(
                                         'name'          => 'amountName',
                                         'value'         => '',
                                         'id'            => 'amount',
                                         'class'         => 'form-control inputSize',
                                         'placeholder'   => 'Account',
                                         'style'        => 'z-index: 1',
                                     )
                                 );
                                 echo form_input(
                                     array(
                                         'name'          => 'amount',
                                         'value'         => '',
                                         'id'            => 'amountId',
                                         'type'          => 'hidden',
                                         'class'         => 'form-control inputSize',
                                         'placeholder'   => 'Account',
                                     )
                                 );
                                echo form_input(
                                     array(
                                         'name'          => 'code_id',
                                         'id'            => 'code_id',
                                         'type'          => 'hidden',
                                         'class'         => 'form-control inputSize',
                                         'placeholder'   => 'Account',
                                     )
                                 );
                                ?>
                               <div class="input-group-btn">
                                   <div class="btn-group" role="group">
                                       <div class="dropdown dropdown-lg">
                                           <button type="button" class="btn btn-default dropdown-toggle" data-toggle="modal" data-target="#myModal" aria-expanded="false"><span class="caret"></span></button>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Chart Of Account</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive">  
                                                <table  id="table" class="table table-hover">
                                                    <?php 
                                                    $class = array('info', 'success', 'danger', 'warning', 'active');
                                                    if($COAP):
                                                        foreach($COAP as $coapRow):
                                                            echo '<tr class="first ">
                                                                <td>&nbsp;</td>
                                                                <td>'.$coapRow->fn_coa_code.'</td>
                                                                <td>'.$coapRow->fn_coa_title.'</td>
                                                            </tr>';
                                                            $coac = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_status'=>1,'fn_coa_m_pId'=>$coapRow->fn_coaId));
                                                            foreach($coac as $coacRow):
                                                                $k = array_rand($class); 
                                                                echo '<tr class="2nd">
                                                                    <td>&nbsp;</td>
                                                                    <td> '.$coacRow->fn_coa_m_code.'</td>
                                                                    <td> &nbsp;&nbsp; &nbsp; &nbsp;'.$coacRow->fn_coa_m_title.'</td>
                                                                </tr>';
                                                                $coacs = $this->CRUDModel->get_where_result('fn_coa_master_sub_child',array('fn_coa_mc_status'=>1,'fn_coa_mc_trash'=>1,'fn_coa_mc_mId'=>$coacRow->fn_coa_m_cId));
                                                                foreach($coacs as $coacsRow):
                                                                     echo ' <tr class="3rd '.$class[$k].'" id="'.$coacsRow->fn_coa_mc_title.','.$coacsRow->fn_coa_mc_id.','.$coacsRow->fn_coa_mc_code.'">
                                                                        <td>&nbsp;</td>
                                                                        <td>'.$coacsRow->fn_coa_mc_code.'</td>
                                                                        <td>&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;'.$coacsRow->fn_coa_mc_title.'</td>
                                                                    </tr>';
                                                                endforeach;
                                                            endforeach;
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </table>
                                            </div>
                                            <ul class="job-list custom-list-style">
                                            <?php 
                                            if($COAP ==1):
                                                foreach($COAP as $coapRow):
                                                    echo ' <li><i class="fa fa-caret-right"></i><a href="javascript:vodi(0) id='.$coapRow->fn_coa_code.'">'.$coapRow->fn_coa_title.'</a></li>';
                                                    $coac = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_status'=>1,'fn_coa_m_pId'=>$coapRow->fn_coaId));
                                                    echo '<ul class="job-list custom-list-style">';
                                                        foreach($coac as $coacRow):
                                                            echo ' <li><i class="fa fa-caret-right"></i><a href="javascript:vodi(0) id='.$coacRow->fn_coa_m_code.'">'.$coacRow->fn_coa_m_title.'</a></li>';
                                                            $coacs = $this->CRUDModel->get_where_result('fn_coa_master_sub_child',array('fn_coa_mc_status'=>1,'fn_coa_mc_mId'=>$coacRow->fn_coa_m_cId));
                                                            echo '<ul class="job-list custom-list-style">';
                                                                foreach($coacs as $coacsRow):
                                                                    echo ' <li><i class="fa fa-caret-right"></i><a href="javascript:vodi(0) id='.$coacsRow->fn_coa_mc_code.'">'.$coacsRow->fn_coa_mc_title.'</a></li>';
                                                                endforeach;
                                                            echo ' </ul>';
                                                        endforeach;
                                                   echo ' </ul>';
                                                endforeach;
                                            endif;
                                            ?>
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-12 form-group">
                            <label for="name">Description</label>
                            <?php
                                echo form_input(
                                    array(
                                        'name'  => 'detail_search',
                                        'id'    => 'detail_search',
                                        'type'  => 'text',
                                        'class' => 'form-control',
                                    )
                                );
                            ?>
                        </div>
                        
                        <div class="col-md-3 col-sm-12 form-group">
                            <label for="name">Status</label>
                            <?php echo form_dropdown('stts_id', $ms_status,'',  'class="form-control" id="stts_id"'); ?>
                        </div>
                        
                        <div class="col-md-2 col-sm-12 form-group">
                            <label for="name" style="visibility: hidden">Search Button</label>
                            <button type="button" class="btn btn-theme" name="search_ms" id="search_ms"  value="search_ms" > Search</button>
                        </div>
                        
                    </div>
                </div><!--//section-content-->
                         
                <?php echo form_close(); ?>
            </section>    
            <div id="result_grid"></div>
            
            
            <div class="modal fade" id="view_modal" role="dialog" style="z-index:9999">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div id="view_modal_content"></div>
                    </div>
                </div>
            </div>
                    
            <div class="modal fade" id="att_modal" role="dialog" style="z-index:9999">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div id="att_modal_content"></div>
                    </div>
                </div>
            </div>
                    
             
        </div><!--//col-md-12-->  
    </div><!--//cols-wrapper-->
</div><!--//content-->
        
<script>
    
    $(document).ready(function(){
        
        $.ajax({
            type    : 'post',
            url     : 'MinuteSheetController/fno_minute_sheet_grid',
            success :function(result){ 
               $('#result_grid').html(result);    
            }
        });
        
//        setInterval(function(){
//            $.ajax({
//                type    : 'post',
//                url     : 'MinuteSheetController/fno_minute_sheet_grid',
//                data    : data,
//                success :function(result){ 
//                   $('#result_grid').html(result);    
//                }
//            });
//        }, 60000);
//        
//        $('#detail_search').on('keyup', function(){
//            var data = { 'detail': $('#detail_search').val() };
//            $.ajax({
//                type    : 'post',
//                url     : 'MinuteSheetController/fno_minute_sheet_grid',
//                data    : data,
//                success :function(result){ 
//                   $('#result_grid').html(result);    
//                }
//            });
//        });
         
        $('#search_ms').on('click', function(){
            var data = { 
                'ms_diary_no'   : $('#ms_diary_no').val(),
                'dept_id'       : $('#dept_id').val(),
                'ms_by_id'      : $('#msb_id').val(),
                'coa_id'        : $('#code_id').val(),
                'detail'        : $('#detail_search').val(),
                'stts_id'       : $('#stts_id').val(),
                'approve_id'    : $('#approve_id').val()
            };
            $.ajax({
                type    : 'post',
                url     : 'MinuteSheetController/fno_minute_sheet_grid',
                data    : data,
                success :function(result){ 
                   $('#result_grid').html(result);    
                }
            });
        });
        
        $("#msb_name").autocomplete({  
            minLength   : 0,
            source      : "MinuteSheetController/initiator_autocomplete/"+$("#msb_name").val(),
            autoFocus   : true,
            scroll      : true,
            dataType    : 'jsonp',
            select      : function(event, ui){
                $("#msb_name").val(ui.item.contactPerson);
                $("#msb_id").val(ui.item.id);
        }
        }).focus(function() {  $(this).autocomplete("search", "");  }); 
        
    });
 
</script>