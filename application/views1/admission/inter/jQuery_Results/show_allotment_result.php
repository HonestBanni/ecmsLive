<style>
    input[type=checkbox]{
    zoom: 1.5;
    }
</style>
<?php
if($result): 
?>
 
 
                    <h3 class="has-divider text-highlight">Result :<?php echo count($result) ?></h3>
                     <table class="table table-boxed table-hover" style="font-size:11px">
                        <thead>
                          <tr>
                            <th></th>    
                            <!--<th><input type="checkbox" id="checkAll"></th>-->    
                            <th>S.no</th>
                            <th>Picture</th>
                            <th>College No</th>
                            <th>Name</th>
                            <th>Father name</th>
                            <th>Program</th>
                            <th>Sub program</th>
                            <th>Shift</th>
                            <th>Batch no</th>
                            <th>Gender</th>
                            <th>T.Marks</th>
                            <th>O.Marks</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                        $sn = 1;
                   foreach($result as $resRow):
                      echo '<tr>
                                    
                                
                                <td><input type="checkbox" name="checked[]" value="'.$resRow->student_id.'" checked="checked" id="checkItem">
                                <input type="hidden" name="student_id" >
                                </td>
                                <td>'.$sn.'</td>
                                <td><img src="assets/images/students/'.$resRow->applicant_image.'" width="60" height="50"></td>
                                <td>'.$resRow->college_no.'</td>
                                <td>'.$resRow->student_name.'</td>
                                <td>'.$resRow->father_name.'</td>
                                <td>'.$resRow->program.'</td>
                                <td>'.$resRow->sub_program.'</td>
                                <td>'.$resRow->shift_name.'</td>
                                <td>'.$resRow->batch.'</td>
                                <td>'.$resRow->gender.'</td>
                                <td>'.$resRow->total_marks.'</td>
                                <td>'.$resRow->obtained_marks.'</td>
                                
                               
                                
                              </tr>';
                   $sn++;
                  endforeach;
                  endif;
                  ?>
                  </tbody>
            </table>
                    
               