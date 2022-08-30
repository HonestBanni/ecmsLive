<div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Employee Grant in Add<hr></h2>
    <h4 style="color:red; text-align:center;"><?php print_r($this->session->flashdata('msg'));?></h4>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form method="post" action="HrController/grant_in_aid/<?php echo $emp_id;?>">
                <input type="hidden" value="<?php echo $emp_id;?>" name="emp_id"> 
            <div class="row">
            <div class="col-md-12">
              <!--//form-group-->
              <div class="form-group col-md-4">
                  <label for="usr">File #:</label>
                  <input type="text" name="file_no" class="form-control" placeholder="File #" required> 
              </div>
            <div class="form-group col-md-4">
                  <label for="usr">Allowance for Degree:</label>
                  <input type="text" name="degree_id" class="form-control" placeholder="Type Degree" id="degree" required>
           	 <input type="hidden" name="degree_id" id="degree_id">  
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Start Date:</label>
                  <input type="date" name="start_date" class="form-control"> 
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Completion Date:</label>
                  <input type="date" name="end_date" class="form-control"> 
              </div>
            <div class="form-group col-md-4">
                  <label for="usr">Amount Received:</label>
                  <input type="text" name="amount_received" placeholder="Total Amount Received" class="form-control"> 
              </div>
            <div class="form-group col-md-4">
                  <label for="usr">Amount Collection Date:</label>
                  <input type="date" name="amount_coll_date" class="form-control"> 
            </div>
            <div class="form-group col-md-4">
                  <label for="usr">Status/Bond:</label>
                  <select name="status_bond_id" class="form-control">
                      <option value="">Select</option>
                      <?php 
                      $sb = $this->CRUDModel->getResults('hr_emp_status_bond');
                      foreach($sb as $rec):
                      ?>
            <option value="<?php echo $rec->status_bond_id;?>"><?php echo $rec->status_title;?></option>
                      <?php endforeach;?>
                  </select>  
            </div>
            <div class="form-group col-md-8">
                  <label for="usr">Remarks:</label>
                  <input type="text" name="remarks" class="form-control"> 
            </div>    
                
          </div>
         <div class="form-group">
                    <input style="margin-left:30px;" type="submit" class="btn btn-theme" name="submit" value="Add Record">
              </div> 
        </div>            
                </form>
                <br><p>If Data Completed Then Click on Done Button, Thanks... <a style="float:right; margin-right:550px;" href="HrController/employee_reocrd" onclick="myFunction()" class="btn btn-theme">Done</a></p><br>    
            <br>
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>File #</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Degree</th>
                             <th>Start Date</th>
                             <th>Completion Date</th>
                            <th>Amount Received</th>
                            <th>Amount Coll Date</th>
                            <th>Status</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        //echo '<pre>';print_r($employee_records);die;
                        if($employee_grant):
                        foreach($employee_grant as $empRow):
                            if($empRow->start_date === '0000-00-00' || $empRow->start_date == '1970-01-01' || $empRow->start_date == ''):
                            echo $date1 = '';
                        else:
                            $date1 = date("d-m-Y", strtotime($empRow->start_date));
                         endif;
                        if($empRow->end_date === '0000-00-00' || $empRow->end_date == '1970-01-01' || $empRow->end_date == ''):
                            echo $date2 = '';
                        else:
                            $date2 = date("d-m-Y", strtotime($empRow->end_date));
                         endif;
                        if($empRow->amount_coll_date === '0000-00-00' || $empRow->amount_coll_date == '1970-01-01' || $empRow->amount_coll_date == ''):
                            echo $date3 = '';
                        else:
                            $date3 = date("d-m-Y", strtotime($empRow->amount_coll_date));
                         endif;
                           echo '<tr>';
                                echo '<td>'.$empRow->file_no.'</td>';
                                echo '<td>'.$empRow->emp_name.'</td>';
                                echo '<td>'.$empRow->dept.'</td>';
                                echo '<td>'.$empRow->degree.'</td>';
                                echo '<td>'.$date1.'</td>';
                                echo '<td>'.$date2.'</td>';
                                echo '<td>'.$empRow->amount_received.'</td>';
                                echo '<td>'.$date3.'</td>';
                                echo '<td>'.$empRow->status_title.'</td>';
                                echo '<td>'.$empRow->remarks.'</td>';
                           echo '</tr>';
                        
                        endforeach;
                        
                        endif;
     
                        ?>


                    </tbody>
                </table>
							      
                        </div>
                    </div>
               </div><!--//col-md-3-->
		