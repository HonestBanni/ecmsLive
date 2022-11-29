<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">   
              <h2 align="left">View Details of Student Fine 
               <img style="float:right" src="assets/images/students/<?php echo $result->applicant_image;?>" width="60" height="40">   
                  <hr></h2>
           <div class="row">
        <div class="col-md-12">
            <div class="form-group col-md-3">
                <lable>Student Name: </lable>
                <input type="text" value="<?php echo $result->student_name;?>" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <lable>Father Name: </lable>
                <input type="text" value="<?php echo $result->father_name;?>" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <lable>College #: </lable>
                <input type="text" value="<?php echo $result->college_no;?>" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <lable>Program: </lable>
                <input type="text" value="<?php echo $result->program;?>" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <lable>Sub Program: </lable>
                <input type="text" value="<?php echo $result->sub_program;?>" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <lable>Date of Fine: </lable>
                <?php $dt = $result->date;
            $date = date('d-m-Y', strtotime($dt));
                ?>
                <input type="text" value="<?php echo $date;?>" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <lable>Fine Type: </lable>
                <input type="text" value="<?php echo $result->proc_type_title;?>" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <lable>Fine Amount: </lable>
                <input type="text" value="<?php echo $result->amount;?>" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <lable>Recovered Assets: </lable>
                <input type="text" value="<?php echo $result->recover_assets;?>" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <lable>Remarks: </lable>
                <input type="text" value="<?php echo $result->remarks;?>" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <lable>Fine Status: </lable>
                <input type="text" value="<?php echo $result->status_name;?>" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <lable>Proctor Name: </lable>
                <?php $proctor_id = $result->proctor_id;
                $gres = $this->SecurityModel->get_by_proc_id('proctors',array('proctor_id'=>$proctor_id));
                if($gres):
                foreach($gres as $grec); ?> 
               <input type="text" value="<?php echo $grec->student_name;?>" class="form-control">
                 <?php 
                endif;
                ?>
            </div>
        </div>
           </div>  
            
</article>
         
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
