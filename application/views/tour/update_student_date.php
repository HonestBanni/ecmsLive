<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
      <div class="page-content">
      <div class="row">
     
            <div class="table-responsive">
                <h2 align="center">Tour/Event Update Students List<hr></h2>
        <article class="contact-form col-md-12 col-sm-12">
          <?php
            $datef = $result->datefrom;
            $datet = $result->dateto;
            $stDate = date("d-m-Y", strtotime($datef));
            $bkDate = date("d-m-Y", strtotime($datet));
            ?>
            <form method="post">
          <div class="col-md-12">
              <div class="form-group col-md-3">
                 <label>Student Name</label>
                <input type="text" class="form-control" value="<?php echo $result->student_name;?>">   
                <input type="hidden" name="serial_no" value="<?php echo $result->serial_no;?>">   
              </div>
              <div class="form-group col-md-3">
                 <label>Father Name</label>
                <input type="text"  class="form-control" value="<?php echo $result->father_name;?>">   
              </div>
              <div class="form-group col-md-3">
                 <label>Program</label>
                <input type="text"  class="form-control" value="<?php echo $result->programe_name;?>">   
              </div>
              <div class="form-group col-md-3">
                 <label>Sub Program</label>
                <input type="text"  class="form-control" value="<?php echo $result->name;?>">   
              </div>
              <div class="form-group col-md-3">
                <lable>T/E Date From: <small>(MM-DD-YY)</small></lable>
                <input type="text" name="datefrom" value="<?php echo $stDate;?>" class="form-control date_format_d_m_yy">
            </div>
            <div class="form-group col-md-3">
                <lable>T/E Date To: <small>(MM-DD-YY)</small></lable>
                <input type="text" name="dateto" value="<?php echo $bkDate;?>" class="form-control date_format_d_m_yy">
            </div> 
              <div class="form-group col-md-2" style="margin-top:18px;">
            <input type="submit" name="submit" value="Update Student" class="btn btn-theme">
                </div>
          </div>
        </form>   
              
            </article>
            </div>
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 