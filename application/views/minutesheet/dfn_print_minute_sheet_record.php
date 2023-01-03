<script language="javascript">
    function printdiv(printpage){
        var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
        var footstr = "</body>";
        var newstr = document.all.item(printpage).innerHTML;
        var oldstr = document.body.innerHTML;
        document.body.innerHTML = headstr+newstr+footstr;
//        window.print();
        document.body.innerHTML = oldstr;
        return false;
    }
//    window.onload = printdiv('div_print');
        window.print();
</script>

<style>
    table tr td { padding-left: 4px; }
    table tr th { padding-left: 4px; }
</style>
<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div id="div_print" style="font-family: calibri;"> 
                    <?php
                    if(!empty($result) || !empty($notify)):    
                        echo '<table class="table table-bordered table-boxed display" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <thead>
                                <tr>
                                    <th width="5%">S No.</th>
                                    <th width="5%">Process No</th>
                                    <th width="10%">Initiator</th>
                                    <th width="10%">Department</th>
                                    <th width="35%">Details</th>
                                    <th width="10%">Estimated Cost</th>
                                    <th width="10%">Chart of Account</th>
                                    <th width="10%">Initiate Date</th>
                                    <th width="10%">Aprrove Date</th>
                                    <th width="10%">Aprrove ID</th>
                                    <th width="15%">Status</th>
                                    <th width="5%">Attachment</th>
                                    <th width="5%"></th>
                                </tr>
                            </thead>
                            <tbody>';

                            if($result):   
                                foreach($result as $msrow):
                                    $sno++;
                                    if(!empty($msrow->msr_date)):         $idate = date('d-m-Y', strtotime($msrow->msr_date));          else: $idate = '';  endif;
                                    if(!empty($msrow->msr_approve_date)): $adate = date('d-m-Y', strtotime($msrow->msr_approve_date));  else: $adate = '';  endif;
                                    echo '<tr style="background-color:  #f3fbff  ">
                                        <th>'.$sno.'</th>
                                        <th>'.$msrow->msr_diary_no.'</th>
                                        <th>'.$msrow->emp_name.'</th>
                                        <th>'.$msrow->deptt_name.'</th>
                                        <th>'.$msrow->msr_detail.'</th>
                                        <th>'.$msrow->msr_cost.'</th>
                                        <th>'.$msrow->fn_coa_mc_title.' ('.$msrow->fn_coa_mc_code.')</th>
                                        <th>'.$idate.'</th>
                                        <th>'.$adate.'</th>
                                        <th>'.$msrow->msr_approve_id.'</th>
                                        <th>';
                                            $cs = $this->CRUDModel->get_where_row('min_sheet_status', array('mss_id'=>$msrow->msr_curr_status));
                                            switch ($cs->mss_id):
                                                case 15: echo '<strong style="color: #5cb85c; font-size:14px;">'.$cs->mss_title.'</strong>'; break;
                                                case 16: echo '<strong style="color: #c00; font-size:14px;">'.$cs->mss_title.'</strong>'; break;
                                                case 17: echo '<strong style="color: #ff7400; font-size:14px;">'.$cs->mss_title.'</strong>'; break;
                                                default: echo '<strong style="color: #428bca; font-size:14px;">'.$cs->mss_title.'</strong>';
                                            endswitch; 
                                        echo '</th>
                                        <th>';
                                            $att = $this->CRUDModel->get_where_result('min_sheet_attachments', array('msa_msr_id'=>$msrow->msr_id));
                                            if(empty($att)):
                                                echo '';
                                            else:
                                                echo '<a href="" data-toggle="modal" data-target="#att_modal" class="att_ms_btn" id="'.$msrow->msr_id.'">'.count($att).' File(s)</a>';
                                            endif;
                                        echo '</th>
                                        <th>
                                        <a href="" data-toggle="modal" data-target="#view_modal" class="view_ms_btn" id="'.$msrow->msr_id.'">
                                            <button type="button" class="btn btn-theme form-control" style="margin:1px;">VIEW</button> 
                                        </a> 
                                        <a href="MinureSheetPrint/'.$msrow->msr_id.'" target="_blank" class="view_ms_btn">
                                            <button type="button" class="btn btn-danger form-control" style="margin:1px;">PRINT</button> 
                                        </a> 
                                        </th>
                                    </tr>';
                                endforeach;
                            endif;
                            echo '</tbody>
                        </table>';
                    endif;
                    ?>
                </div>
            </div>
          <!--//page-row-->
        </div>
        <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
</div>
<!--//content-->
 
 