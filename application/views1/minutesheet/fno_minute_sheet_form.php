<!-- ******CONTENT****** --> 
<div class="content container">
    <? if($ms_detail): ?>
    <!-- ******BANNER****** -->
    <div class="row cols-wrapper">
        <div class="col-md-12">
            <section class="course-finder" style="background-color: #fff; border: 1px solid #eee; padding-top: 15px;">
                <div class="section-content" >
                    <div class="row">
                        <?php
                        $cm = $this->CRUDModel->money_convert($ms_detail->msr_cost);
                        echo '<div class="col-md-12">
                            <table class="table" style="font-size: 15px;">
                                <tr>
                                    <th width="15%">Diary No.</th>
                                    <td width="35%">'.$ms_detail->msr_diary_no.'</td>
                                    <th width="15%">Date</th>
                                    <td width="35%">'.date('d-m-Y', strtotime($ms_detail->msr_date)).'</td>
                                </tr>
                                <tr>
                                    <th>From</th>
                                    <td>'.$ms_detail->emp_name.'</td>
                                    <th>Department</th>
                                    <td>'.$ms_detail->deptt_name.'</td>
                                </tr>
                                <tr>
                                    <th>Detail:</th>
                                    <td colspan="3">'.$ms_detail->msr_detail.'</td>
                                </tr>
                                <tr>
                                    <th>Estimated Cost Rs.</th>
                                    <td>'.$ms_detail->msr_cost.'</td>
                                    <th>(In Words)</th>
                                    <td>'. strtoupper($cm).'</td>
                                </tr>
                            </table>
                        </div>';
                        
                        ?>
                    </div>
                </div>
            </section>
            
            <section class="course-finder" style="padding-bottom: 2%;">
                <h1 class="section-heading text-highlight">
                    <span class="line"><?php echo $ReportName?> Form</span>
                </h1>
                <div class="section-content" >
                    <div class="row">
                        
                        <div class="col-md-4 col-sm-12 form-group">
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
                        </div>
                        
                        <div class="row">
                        <div class="col-md-4 col-sm-12 form-group">
                            <label for="name">Budget Allocation</label>
                            <?php
                                echo form_input(
                                    array(
                                        'name'      => 'budget',
                                        'id'        => 'budget',
                                        'type'      => 'text',
                                        'value'     => '',
                                        'class'     => 'form-control',
                                    )
                                );
                                echo form_input(
                                    array(
                                        'name'      => 'min_sht_id',
                                        'id'        => 'min_sht_id',
                                        'type'      => 'hidden',
                                        'value'     => $ms_detail->msr_id,
                                        'class'     => 'form-control',
                                        'readonly'  => 'readonly',
                                    )
                                );
                            ?>
                        </div>
                        
                        <div class="col-md-4 col-sm-12 form-group">
                            <label for="name">Asset Type</label>
                            <?php echo form_dropdown('asset_type', $itemType,'', 'class="form-control" id="asset_type"'); ?>
                        </div>
                        
                        <div class="col-md-4 col-sm-12 form-group">
                            <label for="name">Item Type</label>
                            <?php echo form_dropdown('item_type', $itemCategory,'', 'class="form-control" id="item_type"'); ?>
                        </div>
                        
                        <div class="col-md-12 form-group">
                            <label for="name">Details / Description:</label>
                            <textarea type="text" class="form-control notes" maxlength="250" rows="2" name="details" id="details" style="resize: none;" required="required"></textarea>
                        </div> 
                        
                    </div>
                </div><!--//section-content-->
                           
                    <div class="col-md-12 right">
                        <button type="button" class="btn btn-theme pull-right mt-2" name="update_fno_ms" id="update_fno_ms"  value="update_fno_ms" >Submit Minute Sheet</button>
                    </div>
                
            </section>    
            
            <?php
            if($att_result):    
                echo '<div class="section">
                    <div class="col-md-12">
                        <div class="row">';
                        foreach($att_result as $rec):
                            $f_ext = pathinfo($rec->msa_file); 
                            echo '<div class="col-md-3 col-sm-6" style="border: 1px solid #ccc; padding: 10px;">
                                <div style="text-align: center">';

                                switch ($f_ext['extension']):
                                    case 'doc':
                                        echo '<div style="height: 200px;text-align:center">
                                            <img src="assets/images/file_icons/doc.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                            <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                        </div>';
                                        break;
                                    case 'docx':
                                        echo '<div style="height: 200px;text-align:center">
                                            <img src="assets/images/file_icons/doc.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                            <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                        </div>';
                                        break;
                                    case 'xls':
                                        echo '<div style="height: 200px;text-align:center">
                                            <img src="assets/images/file_icons/xls.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                            <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                        </div>';
                                        break;
                                    case 'xlsx':
                                        echo '<div style="height: 200px;text-align:center">
                                            <img src="assets/images/file_icons/xls.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                            <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                        </div>';
                                        break;
                                    case 'ppt':
                                        echo '<div style="height: 200px;text-align:center">
                                            <img src="assets/images/file_icons/ppt.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                            <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                        </div>';
                                        break;
                                    case 'pptx':
                                        echo '<div style="height: 200px;text-align:center">
                                            <img src="assets/images/file_icons/pptx.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                            <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                        </div>';
                                        break;
                                    case 'pdf':
                                        echo '<div style="height: 200px;text-align:center">
                                            <img src="assets/images/file_icons/pdf.png" style="max-width: 200px; max-height:150px; margin-bottom: 10px;" class="center">
                                            <p style=" text-align:center"><strong>'.$rec->msa_file.'</strong></p>
                                        </div>';
                                        break;
                                    default:
                                        echo '<img src="assets/images/min_sheet_attach/'.$rec->msa_file.'" style="max-width: 200px; max-height:200px;">';
                                endswitch;

                                    echo '<div class="col-12" style="padding: 10px;">
                                        <a href="assets/images/min_sheet_attach/'.$rec->msa_file.'" target="_blank"><button type="button" class="btn btn-danger">Download</button></a>
                                    </div>
                                </div>
                            </div>';
                        endforeach;
                        echo '</div>
                    </div>
                </div>';
            endif;
            ?>
            
        </div><!--//col-md-12-->       
    </div><!--//cols-wrapper-->
    <? endif; ?>
</div><!--//content-->
        
<script>
    
    $(document).ready(function(){
        
        
        $('#update_fno_ms').on('click', function(){
            if($('#code_id').val() === ''){
                $('#code_id').focus();
                return false;
            }
            if($('#budget').val() === ''){
                $('#budget').focus();
                return false;
            }
            if($('#asset_type').val() === ''){
                $('#asset_type').focus();
                return false;
            }
            if($('#item_type').val() === ''){
                $('#item_type').focus();
                return false;
            }
            if($('#details').val() === ''){
                $('#details').focus();
                return false;
            }
            var data = {
                'min_sht_id': $('#min_sht_id').val(),
                'coa_id'    : $('#code_id').val(),
                'budget'    : $('#budget').val(),
                'asset_type': $('#asset_type').val(),
                'item_type' : $('#item_type').val(),
                'details'   : $('#details').val()
            };
            $.ajax({
                type    : 'post',
                url     : 'MinuteSheetController/fno_update_minute_sheet',
                data    : data,
                success :function(result){ 
                    window.location.href = 'MinuteSheetRecordFNO';
                }
            });
        });
        
//        $("#image_file").on("change", function() {
//            $("#submit_image").click();
//        });
//        
//        $("#submit_image").on('click', function(e){
//            e.preventDefault();
//            var formData = new FormData($("#image_form")[0]);
//            $.ajax({
//                url         : $("#image_form").attr('action'),
//                type        : 'POST',
//                dataType    : 'json',
//                data        : formData,
//                contentType : false,
//                processData : false,
//                success: function(result) {
//                    if(result['insert'] == true){
//                        $.ajax({
//                            type   : 'post',
//                            url    : 'MinuteSheetController/minute_sheet_attch_edit_grid',
//                            data   : { 'min_id' : $('#min_id').val() },
//                            success: function(result){
//                                 $('#result_grid').html(result);
//                            }
//                        });
//                    }
//                    else {
//                        alert('Test');
//                    }
//                }
//            });
//        });
        
    });
 
</script>