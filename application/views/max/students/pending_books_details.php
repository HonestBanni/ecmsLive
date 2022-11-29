<ol class="breadcrumb">
  <li class="breadcrumb-item">
      <a href="StudentController/student_home">Home</a> <i class="fa fa-angle-right"></i> 
      <a href="#">Pending Books Detail</a> 
    </li>
</ol>
<div class="agile-grids">	
    
				<div class="agile-tables">
					<div class="w3l-table-info">
					  <h2>Pending Books Detail</h2>
					    <table id="table">
						<thead>
						  <tr>
							<th>S/No</th>
                            <th>Book Name</th>
                            <th>Issued Date</th>
                            <th>Due Date</th>
                            <th>Out Days</th>
                            <th>FIne</th>
						  </tr>
						</thead>
						<tbody>
						   <?php
            $i = 1;
        foreach($result as $row):               
             $date = $row->issued_date;
             $ddate = $row->due_date;
            $iDate = date("d-m-Y", strtotime($date));               
            $dDate = date("d-m-Y", strtotime($ddate));
            $date1 = new DateTime($ddate);
            $date2 = new DateTime(date('Y-m-d'));                
        ?>    
            <tr>
            <td><?php echo $i;?>)</td>
            <td><?php echo $row->book_title;?></td>
            <td><?php echo $iDate;?></td>
            <td><?php echo $dDate;?></td>
            <td style="color:red"><?php 
                if($date2 > $date1):
                    $interval = $date2->diff($date1);
                    echo '<span class="badge badge-danger">'.$interval->d.' Days'.'</span>';
                endif;    
                ?>
            </td>
            <td style="color:red">
                <?php
                if($date2 > $date1):
                    $interval = $date2->diff($date1);
                    $days_fine = $interval->d * 5;
                    echo '<span class="badge badge-danger">'.'Rs. '.$days_fine.'</span>';
                endif; ?>
            </td>    
        </tr>
            <?php 
            $i++;
                endforeach;
            ?>
						</tbody>
					  </table>
					</div>
    </div>
</div>