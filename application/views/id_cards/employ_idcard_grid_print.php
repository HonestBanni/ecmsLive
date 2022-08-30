<script> window.print(); </script>
<style>
    * { font-family: 'Calibri';}
    td { padding: 2px; }
</style>
<?php
if(!empty($result)):
    $serial = 0;
    echo '<h3>Total Records: '.count($result).'</h3>
    <table border="1" style="border-collapse: collapse; ">
        <tr>
            <th>S#</th>';
//            echo '<th>Picture</th>';
            echo '<th>RFID</th>
            <th>Employ Name</th>
            <th>Father Name</th>
            <th>Gender</th>
            <th>Department</th>
            <th>Designation</th>
            <th>Print Date</th>
            <th>Status</th>
        </tr>';
    foreach($result as $row):
//        if(!empty($row->applicant_image)): $image =  $row->applicant_image; else: $image = 'user.png'; endif;
        echo '<tr>
            <td>'.++$serial.'</td>';
//            echo '<td><img class="grid-image" src="assets/images/students/'.$image.'" style="max-height: 60px; max-width: 75px;"></td>';
            echo '<td>'.$row->idce_rfid.'</td>
            <td>'.$row->idce_emp_name.'</td>
            <td>'.$row->idce_father_name.'</td>
            <td>'.$row->gender_title.'</td>
            <td>'.$row->department.'</td>
            <td>'.$row->designation.'</td>
            <td>'.date('d-m-Y', strtotime($row->idce_print_date)).'</td>
            <td>'.$row->status_title.'</td>
        </tr>';
    endforeach;
    echo '</table>';
else:
    echo '<h3>No Records Found</h3>';
endif;
?>