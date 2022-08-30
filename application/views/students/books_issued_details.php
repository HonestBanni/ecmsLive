<ol class="breadcrumb">
  <li class="breadcrumb-item">
      <a href="StudentController/student_home">Home</a> <i class="fa fa-angle-right"></i> 
      <a href="#">Books Issued Details</a> 
    </li>
</ol>
<div class="agile-grids">	
    
				<div class="agile-tables">
					<div class="w3l-table-info">
					  <h2>Books Issued Details</h2>
					    <table id="table">
						<thead>
						  <tr>
							<th>S/No</th>
                            <th>Book Name</th>
                            <th>Acc #</th>
                            <th>Issued Date</th>
                            <th>Due Date</th>
                            <th>View Details</th>
						  </tr>
						</thead>
						<tbody>
						   <?php
            $i = 1;
        foreach($result as $row):               
             $date = $row->issued_date;
             $availablity_status_id = $row->availablity_status_id;
             $ddate = $row->due_date;
            $iDate = date("d-m-Y", strtotime($date));               
            $dDate = date("d-m-Y", strtotime($ddate));  
                            
            $date1 = new DateTime($ddate);
            $date2 = new DateTime(date('Y-m-d'));
            $interval = $date2->diff($date1); 
            $days_fine = $interval->d;                
        ?>    
            <tr>
            <td><?php echo $i;?>)</td>
            <td><?php if($days_fine >= 1 && $availablity_status_id==1): echo '<span style="color:red">'.$row->book_title.'</span>'; 
                else: echo $row->book_title; endif;?>
                </td>
            <td><?php if($days_fine >= 1 && $availablity_status_id==1): echo '<span style="color:red">'.$row->accession_no.'</span>'; 
                else: echo $row->accession_no; endif;?>
                </td> 
            <td><?php if($days_fine >= 1 && $availablity_status_id==1): echo '<span style="color:red">'.$iDate.'</span>'; 
                else: echo $iDate; endif;?>
            </td>
            <td><?php if($days_fine >= 1 && $availablity_status_id==1): echo '<span style="color:red">'.$dDate.'</span>'; 
                else: echo $dDate; endif;?>
            </td>
            <td>
                <?php if($days_fine >= 1 && $availablity_status_id==1):?>
                <a href="javascript:valid(0)" id="<?php echo $row->issuance_id;?>" class="book_details"><button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal"> View Books Details </button></a>
                <?php else:?>
                <a href="javascript:valid(0)" id="<?php echo $row->issuance_id;?>" class="book_details"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"> View Books Details </button></a>
                <?php endif;?>
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" align="center" style="color:Green">View Books Details</h4>
      </div>
      <div class="modal-body">
          <div id="book_details_info">  
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>