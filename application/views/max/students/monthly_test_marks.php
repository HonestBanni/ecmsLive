<ol class="breadcrumb">
  <li class="breadcrumb-item">
      <a href="StudentController/student_home">Home</a> <i class="fa fa-angle-right"></i> 
      <a href="#">Monthly Test Marks</a> 
    </li>
</ol>
<div class="agile-grids">	
    
				<div class="agile-tables">
					<div class="w3l-table-info">
					  <h2>Monthly Tests Marks</h2>
					    <table id="table">
						<thead>
						  <tr>
							<th>S/No</th>
                            <th>Teacher</th>
                            <th>Section</th>
                            <th>Subject</th>
                            <th>Test Date</th>
                            <th>T-Marks</th>
                            <th>O-Marks</th>
						  </tr>
						</thead>
						<tbody>
						   <?php
            $i = 1;
        foreach($result as $row): 
            $date = $row->test_date;
            $newDate = date("d-m-Y", strtotime($date));                
                            
        ?>    
            <tr>
            <td><?php echo $i;?>)</td>
            <td><?php echo $row->emp_name;?></td>
            <td><?php echo $row->name;?></td>
            <td><?php echo $row->title;?></td>
            <td><?php echo $newDate;?></td>
            <td><?php echo $row->tmarks;?></td>
            <td><?php echo $row->omarks;?></td>
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