<!--<script language="javascript">
    window.print();
    window.onfocus=function(){ window.close();}
    function printdiv(printpage){
        var headstr = '<html><head><title></title></head><body>';
        var footstr = "</body>";
        var newstr = document.all.item(printpage).innerHTML;
        var oldstr = document.body.innerHTML;
        document.body.innerHTML = headstr+newstr+footstr;
        window.print();
        window.location.reload();
        document.body.innerHTML = oldstr;
        return false;
    }
</script>-->

<style>
    
    .removeBorder {
        
        border-top : 1px solid #ffffff !important;
        text-decoration: underline;
    }
    .form_field{
        border-bottom: 1px solid #000;
    }
    table.app_table tr td {
        padding: 0;
    }
    
    .acad_table tr td{
        border: 1px solid #000;
    }
    .acad_table tr th{
        border: 1px solid #000 !important;
    }
    
    .next_page {
        page-break-after: always;
    }
    
</style>
   
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<?php  
if($st_data):
    echo '<div class="modal-body">
        <div class="col-md-12">';
            $seat2 = $this->CRUDModel->get_where_row('reserved_seat', array('rseat_id'=>$st_data->rseats_id3));
                        
            if(!empty($st_data->resereved_seat)):
                $reser_st = ', '.$st_data->resereved_seat;
            else:
                $reser_st = '';
            endif;
            if(!empty($st_data->rseats_id3)):
                $reser_st2 = ', '.$seat2->name;
            else:
                $reser_st2 = '';
            endif;

            $std_m_net  = $this->CRUDModel->get_where_row('mobile_network', array('net_id'=>$st_data->std_mobile_network));
                   
            if($st_data->programe_id = 1 || $st_data->programe_id == 5): $dmc = 'SSC'; else: $dmc = 'HSSC'; endif;
            echo '<table style="width:100%" style="font-family: Calib;">
                <tr>
                    <td width="12%"><strong>Form No.</strong></td>
                    <td width="18%" class="form_field" style="text-align:center"><strong>'.$st_data->form_no.'</strong></td>
                    <td width="5%"></td>
                    <td width="12%"><strong>Group No.</strong></td>
                    <td width="18%" class="form_field"></td>
                    <td width="5%"></td>
                    <td width="12%"><strong>College No.</strong></td>
                    <td width="18%" class="form_field" style="text-align:center"><strong>'.@$st_data->college_no.'</strong></td>
                </tr>
            </table>
            <p style="margin:0; padding:0;">&nbsp;</p>
            <table style="width:95%">
                <tr>
                    <td width="14%" style="vertical-align: top; text-align: center; padding: 10px;"><img src="'.base_url('assets/images/misc/logo_local.png').'" style="max-width:90px;"></td>
                    <td width="70%" style="vertical-align: top; text-align: center; padding-top: 0;">
                        <p style="padding:0; margin: 0; font-size: 24px;"><strong>EDWARDES COLLEGE PESHAWAR</strong></p>
                        <p style="padding:0; font-size:16px;"><strong>Online Admission Form</strong></p>
                        <p style="padding:0; font-size:14px;"><strong>Admission in: &nbsp;&nbsp;'.$st_data->sub_progam.'</strong></p>
                    </td>
                    <td width="16%">';
//                        if(file_exists(base_url().'assets/images/students/'.$st_data->applicant_image)):
                            echo '<img src="'.base_url().'assets/images/students/'.$st_data->applicant_image.'" style="max-height:110px; max-width:100px;">';
//                        else:
//                            echo '<img src="'.base_url().'assets/images/students/user.png" style="max-height:110px; max-width:100px;">';
//                        endif;
                    echo '</td>
                </tr>
            </table>
        </div>
        <div class="col-md-12" >
            <table class="table app_table" style="font-size: 13px;" cellspacing="0">
                <tr>
                    <td colspan="4" style="text-align:center; font-size:15px; padding:5px; background-color:#208e4c; color:#fff;">
                        <p style="margin:0; padding:0;"><strong>APPLICANT INFORMATION</strong></p>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Applicant Name: </td>
                    <td width="32%"><strong>'.wordwrap($st_data->student_name, 15, "\n", true).'</strong></td>
                    <td width="20%">Applied for: </td>
                    <td width="28%"><strong>'.$st_data->sub_progam.'</strong></td>
                </tr>
                <tr>
                    <td>Applicant Mobile: </td>
                    <td><strong>'.$st_data->applicant_mob_no1.'</strong> ('.$std_m_net->network.')</td>
                    <td>Quota: </td>
                    <td><strong>Open Merit '.$reser_st.$reser_st2.'</strong></td>
                </tr>
                <tr>
                    <td>Applicant CNIC: </td>
                    <td><strong>'.$st_data->student_cnic.'</strong></td>
                    <td>Gender: </td>
                    <td><strong>'.$st_data->gender_title.'</strong></td>
                </tr>
                <tr>
                    <td>Date of Birth: </td>
                    <td><strong>'.date('d-m-Y', strtotime($st_data->dob)).'</strong></td>
                    <td>Religion: </td>
                    <td><strong>'.$st_data->religion_title.'</strong></td>
                </tr>
                <tr>
                    <td>Nationality: </td>
                    <td><strong>'.$st_data->country_title.'</strong></td>
                    <td>Domicile: </td>
                    <td><strong>'.$st_data->domicile_title.'</strong></td>
                </tr>
                <tr>
                    <td>Blood Group: </td>
                    <td><strong>'.$st_data->bld_group.'</strong></td>
                    <td>Applied for Hostel: </td>
                    <td><strong>'.$st_data->hostel_required.'</strong></td>
                </tr>
                <tr>
                    <td colspan="2">Last attended school located in FATA? &nbsp;&nbsp;&nbsp;<strong>'.$st_data->fata_school.'</strong></td>
                    <td style="color:#c00;"><strong>Disability</strong> (if any): </td>
                    <td><strong></strong></td>
                </tr>
            </table>
        </div>

        <div class="col-md-12 ">
            <table class="table app_table" style="font-size: 13px;" cellspacing="0">
                <tr>
                    <td colspan="4" style="text-align:center; font-size:15px; padding:5px; background-color:#208e4c; color:#fff;">
                        <p style="margin:0; padding:0;"><strong>FATHER / GUARDIAN INFORMATION</strong></p>
                    </td>
                </tr>
                <tr>
                    <td width="18%">Father Name: </td>
                    <td width="34%"><strong>'.wordwrap($st_data->father_name, 15, "\n", true).'</strong></td>
                    <td width="22%">Father CNIC: </td>
                    <td width="26%"><strong>'.$st_data->father_cnic.'</strong></td>
                </tr>
                <tr>
                    <td>Landline No. </td>
                    <td><strong>'.$st_data->land_line_no.'</td>
                    <td>Father Mobile No. </td>
                    <td><strong>'.$st_data->mobile_no.'</strong> ('.$st_data->mob_net.')</td>
                </tr>
                <tr>
                    <td>Occupation: </td>
                    <td><strong>'.$st_data->father_occup.'</strong></td>
                    <td>Annual Income: </td>
                    <td><strong>'.$st_data->annual_income.'</strong></td>
                </tr>
                <tr>
                    <td>Postal Address:<br> &nbsp;</td>
                    <td colspan="3"><strong>'.wordwrap($st_data->app_postal_address, 15, "\n", true).'</strong></td>
                </tr>
                <tr>
                    <td>Permanent Add: <br>&nbsp;</td>
                    <td colspan="3"><strong>'.wordwrap($st_data->parmanent_address, 15, "\n", true).'</strong></td>
                </tr>
                <tr>
                    <td>Guardian Name: </td>
                    <td><strong>'.$st_data->guardian_name.'</strong></td>
                    <td>Guardian CNIC: </td>
                    <td><strong>'.$st_data->guardian_cnic.'</strong></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><strong>'.$st_data->father_email.'</strong></td>
                    <td>Guardian Mob: </td>
                    <td><strong>'.$st_data->g_mobile_no.'</strong></td>
                </tr>
            </table>
        </div>';
        
        if($st_data->sub_pro_id == '5'):
            echo '<div class="col-md-12 ">
                <table class="table app_table" style="font-size: 13px; margin-bottom:0;padding-bottom:0;" cellspacing="0">
                    <tr>
                        <td style="text-align:center; font-size:15px; padding:5px; background-color:#208e4c; color:#fff;">
                            <p style="margin:0; padding:0;"><strong>SUBJECTS TO BE STUDIED</strong> <span style="font-size: 11px;">(Only for Arts Students)<span></p>
                        </td>
                    </tr>

                    <tr>
                        <td style="border: 1px solid #208e4c !important;">';
                        if(!empty($st_subj_data)):
                            foreach($st_subj_data as $row):
                                echo $row->subject_title.', ';
                            endforeach;
                        else:
                            echo '&nbsp;<br>&nbsp;';
                        endif;
                        echo '&nbsp;</td>
                    </tr>
                </table>
                <p style="margin:0; padding:0;"><strong>&nbsp;</strong></p>
            </div>';
        endif;
            
        if(!empty($st_acad_data)):
            $board = $this->CRUDModel->get_where_row('applicant_edu_detail', array('student_id' => $st_data->student_id));
            echo '<div class="col-md-12 next_page">
                <table class="table app_table" cellspacing="0" >
                    <tr>
                        <td colspan="4" style="text-align:center; font-size:15px; padding:5px; background-color:#208e4c; color:#fff;">
                            <p style="margin:0; padding:0;"><strong>ACADEMIC INFORMATION</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Board Registration No. </td>
                        <td><strong>'.$board->board_reg_no.'</strong></td>
                        <td>Board Roll No. </td>
                        <td><strong>'.$board->rollno.'</strong></td>
                    </tr>
                </table>
                <table class="table acad_table" style="font-size: 13px; width:100% !important;">
                    <tr>
                        <th width="10%">Degree</th>
                        <th width="16%">Board / University</th>
                        <th width="16%">Exam Session</th>
                        <th width="16%">Obt/Total (%age)</th>
                        <th width="21%">Institute/School</th>
                        <th width="21%">Remarks</th>
                    </tr>';
                    foreach($st_acad_data as $arow):
                    echo '<tr>
                        <td>'.$arow->degree_title.'</td>
                        <td>'.$arow->bu_title.'</td>
                        <td>'.$arow->year_of_passing.' ('.$arow->exam_type.')</td>';
                        if($arow->aed_degree == 78):
                            if($arow->obtained_marks_9th > 0):
                                echo '<td>'.$arow->obtained_marks_9th.' / '.$arow->total_marks_9th.' ('.$arow->percentage_9th.')</td>';
                            else: 
                                echo '<td></td>';
                            endif;
                        else:
                            if($arow->obtained_marks > 0):
                                echo '<td>'.$arow->obtained_marks.' / '.$arow->total_marks.' ('.$arow->percentage.')</td>';
                            else: 
                                echo '<td></td>';
                            endif;
                        endif;
                        
                        echo '<td>'.wordwrap($arow->inst_id, 15, "\n", true).'</td>
                        <td>'.wordwrap($arow->academic_comments, 15, "\n", true).'</td>
                    </tr>';
                    endforeach;
                echo '</table>';
                if($st_data->s_status_id != '1'):
                if($st_data->s_status_id != '15'):
                echo '<div col-md-12>
                    <table class="table app_table" style="font-size: 13px; margin: 10px 0px;padding-bottom:0;" cellspacing="0">
                        <tr>
                            <td width="25%" style="border-top: none !important; padding:0; margin:0;">Date of Admission:</td>
                            <td width="23%" class="form_field" style="border-top: none !important; padding:0; margin:0;"><strong>'.date('d-m-Y', strtotime($st_data->admission_date)).'</strong></td>
                            <td width="6%" style="border-top: none !important; padding:0; margin:0;"></td>
                            <td width="23%" style="border-top: none !important; padding:0; margin:0;"> </td>
                            <td width="23%" style="border-top: none !important; padding:0; margin:0;"><strong></strong></td>
                        </tr>
                    </table>
                </div>';
                endif;
                endif;
            echo '</div>';
        endif;

        echo '<div class="col-md-12">
            <table class="table app_table" style="font-size: 13px; margin-bottom:0;padding-bottom:0;" cellspacing="0">
                <tr>
                    <td style="text-align:center; font-size:15px; padding:5px; background-color:#208e4c; color:#fff;">
                        <p style="margin:0; padding:0;"><strong>INSTRUCTIONS</strong></p>
                    </td>
                </tr>
                <tr>
                    <td>'; ?>
                        <ol class="custom-list-style">
                            <li>Required information must be filled in by the applicant correctly. The data once saved cannot be edited or modified. 
                                Fields marked with (<span style="color:red">*</span>) are mandatory.  Incomplete Admission Forms will not be considered for admission.</li>
                            <li>If you are applying for more than one discipline, you will have to submit separate application for each discipline.</li>
                            <li>Students from other than Peshawar Board, must submit their Original Migration Certificate to Administration Department Edwardes College.</li>
                            <li>D grade passes are not eligible for admission in Edwardes College. (FA/FSc only)</li>
                            <li>Applicants must have passed their SSC Exam: in 2020. Previous year passes are not eligible for admission.</li>
                            <li>Students applying for admission against Reserved Seats must specify the respective quota (if any), Otherwise the application will not be considered in "Reserved Seats" category</li>
                            <li>Applicants having domicile other than Peshawar can apply for admission in hostel. Hostel admissions are subject to availability of seats.</li>
                            <li>If the information provided by the applicant in the admission form is found false or misleading, the admission will be cancelled.</li>
                            <!--<li>In case of any help/query please contact <strong>(i) 0332-4645345 (ii) 0312-9188955</strong> during office hours <strong>(9.00am to 2.00pm)</strong> in working days.</li>-->
                        </ol>
                        <h5><strong>Eligibility Criteria for BS Programs only:</strong></h5>
                        <ul>
                            <li>Intermediate or equivalent, with at least 45% marks.</li>
                            <li>Students seeking admission in BS Law will have to:
                                <ol type="a">
                                    <li>Pass Law Admission Test as per order dated March 6, 2018 by the Honourable Supreme Court of Pakistan. </li>
                                    <li>Intermediate or equivalent &amp; LAT Result with at least 50% marks.</li>
                                </ol>
                            </li>
                            <li>Students seeking admission in BS Comp. Science must have Mathematics at Inter Level.</li>
                        </ul> 


                    <?php echo '</td>
                </tr>
            </table>
        </div>';
        
//        echo '<div class="col-md-12">
//            <table class="table app_table" style="font-size: 13px; margin-bottom:0;padding-bottom:0;" cellspacing="0">
//                <tr>
//                    <td colspan="6" style="text-align:center; font-size:15px; padding:5px; background-color:#208e4c; color:#fff;">
//                        <p style="margin:0; padding:0;"><strong>UNDERTAKING</strong></p>
//                    </td>
//                </tr>
//                <tr>
//                    <td colspan="6">
//                        <p style="text-align: justify; text-indent: 30px;">I agree that my son/daughter/ward will be struck off the college role if he/she is not up to the required
//                            standard in the Pre-Board/Pre-University examinations, monthly tests or the attendance rules as per college policy.</p>
//                        <p style="text-align: justify; text-indent: 30px;">I understand that my son/daughter/ward will be removed from the college roll if he/she is found in possession
//                            of drugs/weapons or commit any breach of discipline as per college policy.</p>
//                    </td>
//                </tr>
//                <tr><td colspan="6" style="border: none !important; padding:0; margin:0;">&nbsp;</td></tr>
//                <tr>
//                    <td width="5%" style="border-top: none !important; padding:0; margin:0;">Date: </td>
//                    <td width="25%" class="form_field" style="border-top: none !important; padding:0; margin:0;"></td>
//                    <td width="5%" style="border-top: none !important; padding:0; margin:0;"></td>
//                    <td width="30%" class="form_field" style="border-top: none !important; padding:0; margin:0;"></td>
//                    <td width="5%" style="border-top: none !important; padding:0; margin:0;"></td>
//                    <td width="30%" class="form_field" style="border-top: none !important; padding:0; margin:0;"></td>
//                </tr>
//                <tr>
//                    <td colspan="3" style="border: none !important; padding:0; margin:0;"></td>
//                    <td width="30%" style="border: none !important; padding:0; margin:0; text-align: center;">Parents/Guardian Signature</td>
//                    <td width="5%" style="border: none !important; padding:0; margin:0;"></td>
//                    <td width="30%" style="border: none !important; padding:0; margin:0; text-align: center;">Applicant Signature</td>
//                </tr>
//            </table>
//            <p style=" margin-bottom:0;padding-bottom:0;">&nbsp;</p>
//        </div>';
        
        echo '<div class="col-md-12">
            <table class="table app_table" style="font-size: 13px; margin: 20px 0px 10px 0px;padding-bottom:0;" cellspacing="0">
                <tr>
                    <td width="25%" style="border-top: none !important; padding:0; margin:0;">Father/Guardian Signature </td>
                    <td width="23%" class="form_field" style="border-top: none !important; padding:0; margin:0;"><strong></strong></td>
                    <td width="6%" style="border-top: none !important; padding:0; margin:0;"></td>
                    <td width="23%" style="border-top: none !important; padding:0; margin:0;">Applicant Signature </td>
                    <td width="23%" class="form_field" style="border-top: none !important; padding:0; margin:0;"><strong></strong></td>
                </tr>
            </table>
            <table class="table app_table" style="font-size: 13px; margin-bottom:0;padding-bottom:0;" cellspacing="0">
                <tr>
                    <td colspan="5" style="text-align:center; font-size:15px; padding:5px; background-color:#208e4c; color:#fff;">
                        <p style="margin:0; padding:0;"><strong>FOR OFFICIAL USE ONLY</strong></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="border-top: none !important; padding:0; margin:0;">&nbsp;</td>
                </tr>
                <tr>
                    <td width="22%" style="border-top: none !important; padding:0; margin:0;">Fee Deposited (Rs.) </td>
                    <td width="22%" class="form_field" style="border-top: none !important; padding:0; margin:0;"><strong></strong></td>
                    <td width="19%" style="border-top: none !important; padding:0; margin:0;"></td>
                    <td width="15%" style="border-top: none !important; padding:0; margin:0;">Bank Receipt </td>
                    <td width="22%" class="form_field" style="border-top: none !important; padding:0; margin:0;"><strong></strong></td>
                </tr>
            </table>
            <p style=" margin-bottom:0;padding-bottom:0;">&nbsp;</p>
            <p style=" margin-bottom:0;padding-bottom:0;">&nbsp;</p>
        </div>
        
        <div class="col-md-12">
            <table width="100%" style="font-size: 13px; border: 2px solid #000 !important;" cellspacing="0">
                <tr>
                    <td colspan="3" style="text-align:center;" height="140px"></td>
                </tr>
                <tr>
                    <td width="75%" style="text-align:center;padding:0; margin:0;" ></td>
                    <td width="20%" class="form_field" style="text-align:center;padding:0; margin:0;" ></td>
                    <td width="5%" style="text-align:center;padding:0; margin:0;" ></td>
                </tr>
                <tr>
                    <td style="border-top: none !important;text-align:center;padding:0; margin:0;" ></td>
                    <td style="border-top: none !important;text-align:center;padding:0; margin:0;" ><span style="visibility:hidden">Principal Signature</span></td>
                    <td style="border-top: none !important;text-align:center;padding:0; margin:0;" ></td>
                </tr>
            </table>
        </div>
        
    </div>';
 endif; 
 ?>      
           
            
         
 