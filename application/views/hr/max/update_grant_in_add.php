<?php 
$date1 = date("d-m-Y", strtotime($employee_grant->start_date));
$date2 = date("d-m-Y", strtotime($employee_grant->end_date));
$date3 = date("d-m-Y", strtotime($employee_grant->amount_coll_date));
?>
<div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Employee Update Grant in Add<hr></h2>
    <h4 style="color:red; text-align:center;"><?php print_r($this->session->flashdata('msg'));?></h4>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form method="post">
                <input type="hidden" value="<?php echo $grant_id;?>" name="grant_id"> 
                <input type="hidden" value="<?php echo $emp_id;?>" name="emp_id"> 
            <div class="row">
            <div class="col-md-12">
              <!--//form-group-->
              <div class="form-group col-md-4">
                  <label for="usr">File #:</label>
                  <input type="text" name="file_no" class="form-control" value="<?php echo $employee_grant->file_no;?>"> 
              </div>
            <div class="form-group col-md-4">
                  <label for="usr">Allowance for Degree:</label>
                  <?php
                $gres = $this->HrModel->get_by_id('degree',array('degree_id'=>$employee_grant->degree_id));
                    if($gres){
                        foreach($gres as $grec){ ?>  
                    <input type="text" name="degree_id" class="form-control" value="<?php echo $grec->title;?>" id="degree" required>
                    <input type="hidden" name="degree_id" value="<?php echo $grec->degree_id;?>" id="degree_id">
                     <?php 
                        }     
                    }else{  
                    ?>
                    <input type="text" name="degree_id" class="form-control" placeholder="Allowance for Degree" id="degree" required>
                             <input type="hidden" name="degree_id" id="degree_id">
                    <?php 
                    }
                    ?> 
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Start Date:</label>
                  <input type="text" name="start_date" value="<?php echo $date1;?>" class="form-control date_format_d_m_yy"> 
              </div>
              <div class="form-group col-md-4">
                  <label for="usr">Completion Date:</label>
                  <input type="text" name="end_date" value="<?php echo $date2;?>" class="form-control date_format_d_m_yy"> 
              </div>
            <div class="form-group col-md-4">
                  <label for="usr">Amount Received:</label>
                  <input type="text" name="amount_received" value="<?php echo $employee_grant->amount_received;?>" class="form-control"> 
              </div>
            <div class="form-group col-md-4">
                  <label for="usr">Amount Collection Date:</label>
                  <input type="text" name="amount_coll_date" value="<?php echo $date3;?>" class="form-control date_format_d_m_yy"> 
            </div>
            <div class="form-group col-md-4">
                  <label for="usr">Status/Bond:</label>
                  <select name="status_bond_id" class="form-control">
                      <option value="<?php echo $employee_grant->status_bond_id;?>"><?php echo $employee_grant->status_title;?></option>
                      <option value="">Select New Status/Bond</option>
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
                  <input type="text" name="remarks" value="<?php echo $employee_grant->remarks;?>" class="form-control"> 
            </div>    
                
          </div>
         <div class="form-group">
                    <input style="margin-left:30px;" type="submit" class="btn btn-theme" name="submit" value="Add Record">
              </div> 
        </div>            
                </form>
               
                        </div>
                    </div>
               </div><!--//col-md-3-->
		