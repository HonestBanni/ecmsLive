<?php
if(!empty($result)):
    $serial = 0;
    echo '<h3>Total Records: '.count($result).'</h3>
    <table class="table table-hover table-bordered">
        <tr>
            <th>S No.</th>';
//            echo '<th>Picture</th>';
            echo '<th>RFID</th>
            <th>Student Name</th>
            <th>Father Name</th>
            <th>College No.</th>
            <th>Gender</th>
            <th>Program</th>
            <th>Sub Program</th>
            <th>Print Date</th>
            <th>Status</th>
        </tr>';
    foreach($result as $row):
//        if(!empty($row->applicant_image)): $image =  $row->applicant_image; else: $image = 'user.png'; endif;
        echo '<tr>
            <td>'.++$serial.'</td>';
//            echo '<td><img class="grid-image" src="assets/images/students/'.$image.'" style="max-height: 60px; max-width: 75px;"></td>';
            echo '<td>'.$row->idc_rfid.'</td>
            <td>'.$row->idc_student_name.'</td>
            <td>'.$row->idc_father_name.'</td>
            <td>'.$row->idc_college_no.'</td>
            <td>'.$row->gender_title.'</td>
            <td>'.$row->programe_name.'</td>
            <td>'.$row->sub_pro_name.'</td>
            <td>'.date('d-m-Y', strtotime($row->idc_print_date)).'</td>
            <td>'.$row->status_title.'</td>
        </tr>';
    endforeach;
    echo '</table>';
else:
    echo '<h3>No Records Found</h3>';
endif;
?>