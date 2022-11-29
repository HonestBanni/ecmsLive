<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Update College # and Password
      </h1>
      <div class="breadcrumbs pull-right">
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-label">You are here:
          </li>
          <li> 
            <?php echo anchor('admin/admin_home', 'Home');?> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current">Update College # and Password
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
 		<form method="post">
           <div class="form-group col-md-3">
            <label>Student Name</label>
            <input type="text" class="form-control" value="<?php echo $result->student_name;?>" readonly>
            <input type="hidden" name="student_id" value="<?php echo $this->uri->segment(3);?>">
            </div>
            <div class="form-group col-md-3">
            <label>Father Name</label>
            <input type="text" class="form-control" value="<?php echo $result->father_name;?>" readonly>
            </div>
             
            <div class="form-group col-md-3">
            <label>Program</label>
            <input type="text" class="form-control" value="<?php echo $result->program;?>" readonly>
            </div>
            <div class="form-group col-md-3">
            <label>Sub Program</label>
            <input type="text" class="form-control" value="<?php echo $result->sub_program;?>" readonly>
            </div>
            <div class="form-group col-md-3">
            <label>College #</label>
            <input type="text" name="college_no" class="form-control"  value="<?php echo $result->college_no;?>" readonly>
            </div>
            <div class="form-group col-md-3">
            <label>Father Mobile #</label>
            <input type="text" name="mobile_no" class="form-control" required="required"  value="<?php echo $result->mobile_no;?>" pattern="03[0-9]{2}-(?!1234567)(?!1111111)(?!7654321)[0-9]{7}" title="Follow request format 0000-0000000" >
            </div>
            <div class="form-group col-md-3">
            <label>Mobile Network</label>
            
                <?php
                echo form_dropdown('net_id', $mobile_network,$result->net_id,  'class="form-control" id="tran_type"');
                
                ?>
            
<!--                <select name="net_id" class="form-control">
                     <?php
            $gres = $this->get_model->get_by_id('mobile_network',array('net_id'=>$result->net_id));
                if($gres){
                    foreach($gres as $grec){ ?>                   
            <option type="text" value="<?php echo $grec->net_id;?>"><?php echo $grec->network;?></option>
                 <?php 
                    }     
                }   
                ?>
            <option value="">Select Network</option>
            <?php
            $n = $this->CRUDModel->getResults('mobile_network');
            foreach($n as $rows):
            ?>
                <option value="<?php echo $rows->net_id;?>"><?php echo $rows->network;?></option>
            <?php
            endforeach;
            ?>
                </select>-->
            </div>
             <div class="form-group col-md-3">
            <label>Applicant Mobile #</label>
            <input type="text" name="applicant_mob_no1" class="form-control"  value="<?php echo $result->applicant_mob_no1;?>">
            </div>       
            <div class="form-group col-md-3">
            <label>Password</label>
            <input type="text" name="student_password" class="form-control"  value="<?php echo $result->student_password;?>">
            </div>
          <div class="form-group col-md-6">
            <input style="margin-top:23px" type="submit" value="Update" name="submit" class="btn-primary btn">
          </div>        
</form>
   </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
