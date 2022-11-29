<ol class="breadcrumb">
  <li class="breadcrumb-item">
      <a href="StudentController/student_home">Home</a> <i class="fa fa-angle-right"></i> 
      <a href="StudentController/fine">Fine</a> 
    </li>
</ol>
<div class="agile-grids">	    
				<div class="agile-tables">
					<div class="w3l-table-info">
					  <h2>Fine Details</h2>
					    <table id="table">
						<thead>
						  <tr>
							<th>S/No</th>
                            <th>Amount</th>
                            <th>Fine Date</th>
                            <th>Fine Type</th>
                            <th>Proctor</th>
                            <th>Rec. Assets</th>
                            <th>Remarks</th>
                            <th>Status</th>
						  </tr>
						</thead>
						<tbody>
						   <?php
            $i = 1;
        foreach($result as $row): 
            $dt = $row->date;
            $date = date('d-m-Y', strtotime($dt)); 
            $proctor_id = $row->proctor_id;      
            $proc_status_id = $row->proc_status_id;                  
        ?>    
            <tr>
            <td><?php echo $i;?>)</td>
            <td><?php echo $row->amount;?></td>
            <td><?php echo $date;?></td>
            <td><?php echo $row->proc_type_title;?></td>
            <td><?php
            $where = array('proctor_id'=>$proctor_id);    
            $q = $this->StudentModel->getprocData('proctors',$where);    
            echo $q->student_name;;
                  ?></td>
            <td><?php echo $row->recover_assets;?></td>
            <td><?php echo $row->remarks;?></td>
            <td><?php if($proc_status_id == 3):?>
                <span class="badge badge-success"><?php echo $row->status_name;?></span>
              <?php  
                else:
            ?>
                <span class="badge badge-danger"><?php echo $row->status_name;?></span> <?php endif;?></td>    
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