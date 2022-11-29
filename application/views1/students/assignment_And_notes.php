<div class="agile-grids">	
    
				<div class="agile-tables">
					<div class="w3l-table-info">
					  <h2>Course Details</h2>
					    <table id="table">
						<thead>
						  <tr>
							<th>S/No</th>
                            <th>Subject</th>
                            <th>Sub Program</th>
                            <th>Program</th>
						  </tr>
						</thead>
						<tbody>
						   <?php
            $i = 1;
        foreach($result as $row):               
                            
        ?>    
            <tr>
            <td><?php echo $i;?>)</td>
            <td><?php echo $row->title;?></td>
            <td><?php echo $row->name;?></td>
            <td><?php echo $row->programe_name;?></td>
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