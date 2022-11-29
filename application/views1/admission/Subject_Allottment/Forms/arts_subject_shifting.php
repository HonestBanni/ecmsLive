        <!-- ******CONTENT****** --> 
        <div class="content container">
            <!-- ******BANNER****** -->
            <h2 align="left"><?php echo $page_header?>
                <span  style="float:right"><button class="btn btn-large btn-primary" id="allot_new_subjects"><i class="fa fa-check-square-o"></i> Allot Arts Subjects to New Students</button></span>
                <hr>
            </h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h3 style="color:#f00;"><strong>Note:</strong> Subjects must be allotted after Group / Section Allotment. </h3>
                <?php
                    if($get_std):
                     echo '<table class="table table-boxed table-bordered" >
                        <tr>
                            <th width="5%">S #</th>
                            <th width="7%">Student ID</th>
                            <th width="7%">College #</th>
                            <th width="18%">Student Name</th>
                            <th width="5%">Section</th>
                            <th width="29%">Subjects in Admission Form</th>
                            <th width="29%">Subject Alloted</th>
                        </tr>';
                        $serial = '';
                        foreach($get_std as $srow):
//                            $check_subj = $this->CRUDModel->get_where_row('student_subject_alloted', array('student_id'=> $srow->student_id ));
//                            if(empty($check_subj)):
                                $serial++;
                                echo '<tr>
                                     <td>'.$serial.'</td>
                                     <td>'.$srow->student_id.'</td>
                                     <td>'.$srow->college_no.'</td>
                                     <td>'.$srow->student_name.'</td>
                                     <td>'.$srow->section_name.'</td>
                                     <td>';
                                     $get_new = $this->SubjectAllottmentModel->get_arts_subjects_in_admission(array('student_id' => $srow->student_id));
                                     foreach($get_new as $row):  
                                         echo $row->title.', ';
                                     endforeach;
                                     echo '</td>
                                     <td>';
                                     $get_alloted = $this->SubjectAllottmentModel->get_arts_subjects_alloted(array('student_id' => $srow->student_id));
                                     foreach($get_alloted as $glrow):  
                                         echo $glrow->title.', ';
                                     endforeach;
                                     echo '</td>
                                </tr>';
//                            endif;
                        endforeach;
                    echo '</table>';
                    endif;
                ?>
                </div><!--//col-md-3-->
            </div><!--//cols-wrapper-->
        </div><!--//content-->
        
        <script>
            $(document).ready(function(){
                $('#allot_new_subjects').on('click', function(){
                    $(this).prop('disabled', true);
                    $.ajax({
                        type   :'post',
                        url    :'ArtSubjectShiftToAllotted',
                        success :function(result){
                            window.location.reload();
                        }
                    });
                });
            });
            
        </script>