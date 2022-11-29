<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
                <h1 class="heading-title pull-left"><?php echo $breadcrumbs; ?></h1>
                    <div class="breadcrumbs pull-right">
                        <ul class="breadcrumbs-list">
                            <li class="breadcrumbs-label">You are here:</li>
                            <li><a href="Dashboard">Home</a> 
                              <i class="fa fa-angle-right"></i>
                            </li>
                            <li class="current"><?php echo $breadcrumbs; ?></li>
                        </ul>
                    </div>
          <!--//breadcrumbs-->
        </header>
        <div class="page-content">
                    <div class="row">
                               <?php $this->load->view('hr/hr_wedgets/employee_details_v');?>
                    <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight"><span class="line"><?php echo $breadcrumbs; ?> Form</span></h1>
                        <div class="section-content">
                            <div class="row">
                                <?php echo form_open_multipart() ?>
                                    <div class="col-md-3">
                                        <label class="control-label" for="basicinput">Letter No</label>
                                        <input type="text" name="c_renwal_letter_no" placeholder="Letter No"  value="" class="form-control">
                                    </div>

                                        <input type="hidden" name="emp_id" required="required"  value="<?php echo $emp_info->emp_id?>">
                                        <input type="hidden" name="emp_status_id" required="required"  value="<?php echo $emp_info->emp_status_id?>">
                                    <!--</div>-->
                                    <div class="col-md-3">
                                        <label style="text-indent: 3px">Letter Date <span style="color:red">*</span></label>
                                        <div>
                                            <div style="width: 33%; float: left" class=" form-group">
                                                <?php 
                                                 
                                                $dob_day = array();
                                                for($d=1; $d<32; $d++):
                                                    if(strlen($d) < 2): $v = '0'.$d; else: $v = $d; endif;
                                                    $dob_day[$v]= $d; 
                                                endfor;
//                                                $dob_d =date('d',strtotime($result->dob)); 
                                                $dob_d =date('d'); 
                                                echo form_dropdown('letter_day',$dob_day,$dob_d,array('class'=>'form-control','required'=>"required"));
                                                ?> 
                                            </div>
                                            <div style="width: 33%; float: left" class="form-group" autocomplete="off" >
                                                
                                                <?php
                                                 $month =   $this->CRUDModel->dropDown('month', 'Month', 'mth_num', 'mth_title');
                                                 $dob_m =date('m'); 
//                                                 $dob_m =date('m',strtotime($result->dob)); 
                                                echo form_dropdown('letter_month',$month,$dob_m,array('class'=>'form-control','required'=>"required"));
                                                ?>
                                                 
                                            </div>
                                            <div style="width: 33%; float: left" class="form-group">
                                                  <?php
                                                     $dob_year = array();
                                                    for($y=date('Y')-50; $y<=date('Y')+2; $y++):
                                                     $dob_year[$y] = $y;
                                                    endfor;
                                                    
//                                                      $dob_y =date('Y',strtotime($result->dob)); 
                                                      $dob_y =date('Y'); 
                                                    echo form_dropdown('letter_year',$dob_year,$dob_y,array('class'=>'form-control','required'=>"required"));
                                                    
                                                    ?>
                                                
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="col-md-3">
                                        <label style="text-indent: 3px">Contract From Date</label>
                                        <div>
                                            <div style="width: 33%; float: left" class=" form-group">
                                                <?php 
                                                 
                                                $dob_day = array();
                                                $dob_day['']    = 'Day';
                                                for($d=1; $d<32; $d++):
                                                    if(strlen($d) < 2): $v = '0'.$d; else: $v = $d; endif;
                                                    $dob_day[$v]= $d; 
                                                endfor;  
                                                echo form_dropdown('c_f_day',$dob_day,'',array('class'=>'form-control'));
                                                ?> 
                                            </div>
                                            <div style="width: 33%; float: left" class="form-group" autocomplete="off" >
                                                
                                                <?php
                                                 $month =   $this->CRUDModel->dropDown('month', 'Month', 'mth_num', 'mth_title');
                                                echo form_dropdown('c_f_month',$month,'',array('class'=>'form-control'));
                                                ?>
                                                 
                                            </div>
                                            <div style="width: 33%; float: left" class="form-group">
                                                  <?php
                                                     $dob_year = array();
                                                      $dob_year['']    = 'Year';
                                                      for($y=date('Y')-50; $y<=date('Y')+2; $y++):
                                                     $dob_year[$y] = $y;
                                                    endfor;
                                                    echo form_dropdown('c_f_year',$dob_year,'',array('class'=>'form-control'));
                                                    
                                                    ?>
                                                
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="col-md-3">
                                        <label style="text-indent: 3px">Contract To Date</label>
                                        <div>
                                            <div style="width: 33%; float: left" class=" form-group">
                                                <?php 
                                                 
                                                $dob_day = array();
                                                $dob_day['']    = 'Day';
                                                for($d=1; $d<32; $d++):
                                                    if(strlen($d) < 2): $v = '0'.$d; else: $v = $d; endif;
                                                    $dob_day[$v]= $d; 
                                                endfor;  
                                                echo form_dropdown('c_t_day',$dob_day,'',array('class'=>'form-control'));
                                                ?> 
                                            </div>
                                            <div style="width: 33%; float: left" class="form-group" autocomplete="off" >
                                                
                                                <?php
                                                 $month =   $this->CRUDModel->dropDown('month', 'Month', 'mth_num', 'mth_title');
                                                echo form_dropdown('c_t_month',$month,'',array('class'=>'form-control'));
                                                ?>
                                                 
                                            </div>
                                            <div style="width: 33%; float: left" class="form-group">
                                                  <?php
                                                     $dob_year = array();
                                                      $dob_year['']    = 'Year';
                                                      for($y=date('Y')-50; $y<=date('Y')+2; $y++):
                                                     $dob_year[$y] = $y;
                                                    endfor;
                                                    echo form_dropdown('c_t_year',$dob_year,'',array('class'=>'form-control'));
                                                    
                                                    ?>
                                                
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                
                                
<!--                                    <div class="col-md-3">
                                        <label class="control-label" for="basicinput">Contract From Date</label>
                                        <input type="text" name="contract_from_date" placeholder="Contract From Date" readonly="readonly"  class="form-control datepicker">
                                    </div>-->

<!--                                    <div class="col-md-3">
                                        <label class="control-label" for="basicinput">Contract To Date</label>
                                        <input type="text" name="contract_to_date" placeholder="Contract To Date"readonly="readonly"  class="form-control datepicker">
                                    </div>-->
                                    <div class="form-group col-md-3">
                                        <label for="usr">Designation:</label>
                                         <?php echo form_dropdown('designation',$designation,$emp_info->current_designation,array('class'=>'form-control'))?>
                                    </div>
                                      <div class="form-group col-md-3">
                                        <label for="usr">Scale:</label>
                                        <?php echo form_dropdown('scale_id',$scale,$emp_info->c_emp_scale_id,array('class'=>'form-control'))?>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="usr">Employee Category:</label>
                                        <?php echo form_dropdown('cat_id',$category,'',array('class'=>'form-control','id'=>'hr_category'))?>
                                    </div>
                                     <div class="form-group col-md-3">
                                        <label for="usr">Employee Job Type :</label>
                                        <?php echo form_dropdown('contract_type_id',$contract_tp,$emp_info->contract_type_id,array('class'=>'form-control'))?> 
                                    </div>
                                     <div class="form-group col-md-3">
                                        <label for="usr">Contract Status</label>
                                        <?php echo form_dropdown('contract_status',$contract_status,'',array('class'=>'form-control'))?> 
                                    </div>
                                    <div class="col-md-12">
                                          <label for="name">Renewal Details</label>
                                         <textarea name="renewal_details" cols="40" rows="2" class="form-control" placeholder="Renewal Details" ></textarea>
                                     </div>     
                                
                                    <div class="col-md-12">
                                          <label for="name">Renewal Remarks</label>
                                         <textarea name="renewal_remarks" cols="40" rows="2" class="form-control" placeholder="Renewal Remarks" ></textarea>
                                     </div>     
                                    <div class="col-md-4 ">
                                        <label class="control-label" for="basicinput">Contract Picture</label>
                                        <input type="file" name="file"  class="form-control">
                                    </div>
                                 <div class="col-md-3 form-group">
                                    <label class="control-label" for="basicinput" style="visibility: hidden" >Upload Picture sdfsdf</label>
                                    <button type="submit" name="UploadPicture" value="UploadPicture"  class="btn btn-theme" ><i class="fa fa-plus"></i> Record Save</button>
                                    <a href="EmployeeRecords"><button type="button"   class="btn btn-theme" ><i class="fa fa-refresh"></i> Close</button></a>
                               </div>
                                <?php echo form_close();?>
                            </div>
                        </div>
                    </section>
                    
                    
                    </div>
            
        </div>
        
    </div>


<?php

$this->db->select('hr_contract_status.contract_status_title,hr_contract_reneval.*,hr_emp_contract_type.title as c_title,hr_emp_status.title as emp_status,hr_emp_scale.title as current_scale,hr_emp_designation.title as des_title');    
                        $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_contract_reneval.c_renwal_current_contract_type');    
                        $this->db->join('hr_emp_status','hr_emp_status.emp_status_id=hr_contract_reneval.c_renwal_current_emp_status');    
                        $this->db->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_contract_reneval.c_renwal_current_scale');    
                        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_contract_reneval.c_renewal_designation');
                        $this->db->join('hr_contract_status','hr_contract_status.contract_status_id=hr_contract_reneval.c_renewal_contract_status_id');
                        $this->db->order_by('c_renwal_contract_date','asc');
                        $this->db->order_by('contract_id','asc');
    $contract_details = $this->db->get_where('hr_contract_reneval',array('c_renwal_emp_id'=>$this->uri->segment(2)))->result();
    if($contract_details):
                                            $sn = '';
                                            echo '
                                                <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-striped" style="font-size:11px">
                                                <thead>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Letter No</th>
                                                        <th>Letter date</th>
                                                        <th>Contract From</th>
                                                        <th>Expiry Date</th>
                                                        <th>Designation</th>
                                                        <th>BPS</th>
                                                        <th>Cont-Type</th>
                                                        <th>Emp-Status</th>
                                                        <th>Contrat Status</th>
                                                      
                                                    </tr>
                                                </thead><tbody>';
                                            foreach($contract_details as $row):
                                             $sn++;
                                              echo '<tr>
                                                    <td>'.$sn.'</td>
                                                    <td>'.$row->c_renwal_letter_no.'</td>
                                                    <td>'.$this->CRUDModel->date_convert($row->c_renwal_contract_date).'</td>
                                                    <td>'.$this->CRUDModel->date_convert($row->c_renwal_from_date).'</td>
                                                    <td>'.$this->CRUDModel->date_convert($row->c_renwal_to_date).'</td>
                                                     <td>'.$row->des_title.'</td>
                                                    <td>'.$row->current_scale.'</td>
                                                    <td>'.$row->c_title.'</td>
                                                    <td>'.$row->emp_status.'</td>
                                                    <td>'.$row->contract_status_title.'</td>
                                                    
                                                </tr>';
                                            endforeach;
                                        endif;
                                        echo '</tbody></table>';
?>



</div>
 