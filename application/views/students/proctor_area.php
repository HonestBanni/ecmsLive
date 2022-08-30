<div class="agile-grids">	
    <?php
        $session = $this->session->all_userdata();
        $student_id =  $session['studentData']['student_id'];
        $student_name      = $session['studentData']['student_name'];
        $where = array('student_id'=>$student_id);
        $studentinfo = $this->StudentModel->profileDataStudent('student_record',$where);       
        $section = $this->CRUDModel->get_where_row('student_group_allotment',$where);  
    ?>
				<div class="agile-tables">
                   <a href="ProctorController/add_student_fine">   
                <div style="width:200px; float:right" class="bg-system dark pv20 text-white fw600 text-center">
                   Add Student Fine
                </div>
                    </a>
					<div class="w3l-table-info">
					  <h2>Proctor Fine Students List</h2>
					    <table id="table">
						<thead>
						  <tr>
							<th>S/No</th>
                            <th>Picture</th>
                            <th>Student Name</th>
                            <th>College#</th>
                            <th>Fine Type</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Rec-Assets</th>
                            <th>Status</th>
						  </tr>
						</thead>
						<tbody>
						   <?php
      //  echo '<pre>';print_r($result);die;                    
            $i = 1;
        foreach($result as $row): 
            $date = date('d-m-Y', strtotime($row->date));
            $status = $row->proc_status_id;                
            $statusname = $row->status_name;                
        ?>    
            <tr>
            <td><?php echo $i;?></td>
            <td><img src="assets/images/students/<?php echo $row->applicant_image;?>" width="60" height="40"></td>
            <td><?php echo $row->student_name;?></td>
            <td><?php echo $row->college_no;?></td>
            <td><?php echo $row->proc_type_title;?></td>
            <td><?php echo $date;?></td>
            <td><?php echo $row->amount;?></td>
            <td><?php echo $row->recover_assets;?></td>
            <td><?php if($status == 3): echo "<span class='badge badge-success'>".$statusname."<span>"; else: echo "<span class='badge badge-danger'>".$statusname."<span>"; endif;?></td>
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