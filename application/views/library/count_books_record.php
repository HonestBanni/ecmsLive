  <script language="javascript">
function printdiv1(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>
<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">                          
              
            <h4 style="color:red; text-align:center;">
                <?php print_r($this->session->flashdata('msg'));?>
            </h4>
<form method="post">
        <div class="col-md-12">
            <div class="form-group col-md-2">
                    <label>From Date</label>
                   <input type="text" name="from_date" value="<?php if(@$from_date): echo date("d-m-Y", strtotime($from_date)); else: echo date('d-m-Y'); endif; ?>" class="form-control date_format_d_m_yy" required>
                </div>
                <div class="form-group col-md-2">
                 <label>To Date</label>
                   <input type="text" name="to_date" value="<?php if(@$to_date): echo date("d-m-Y", strtotime($to_date)); else: echo date('d-m-Y'); endif; ?>" class="form-control date_format_d_m_yy" required>
                </div>
            <div class="form-group col-md-2">
                <label>Subject Name</label>
                <input type="text" name="subject_name" value="<?php if($subject_name): echo $subject_name; endif;?>" placeholder="Subject Name" class="form-control">
            </div>
        <div class="form-group col-md-4">
            <input type="submit" style="margin-top:23px;" name="search" value="Search" class="btn btn-theme">
            <button type="button" style="margin-top:23px;" class="btn btn-theme" name="print" value="print"  onClick="printdiv1('div_print');"  ><i class="fa fa-print"></i> Print</button>
        </div>
        </div>    
    </form>
            <?php
            if(@$result):
            ?>
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count($result); ?>
            </button>
            </p>
            <div id="div_print">
                
                <strong style="margin-right:50px;font-size:18px;margin-left:100px;"><?php if(@$from_date): echo 'From Date: '. date("d-m-Y", strtotime($from_date));endif;?></strong>
                <strong style="margin-right:50px;font-size:18px;"><?php if(@$from_date): echo 'To Date: '. date("d-m-Y", strtotime($from_date));endif;?></strong>
                <strong style="margin-right:50px;font-size:18px;">
                    <?php if($subject_name): echo 'Subject: '. $subject_name; endif;?>
                </strong>
              <table class="table table-boxed table-hover table-bordered">
              <thead>
                <tr>
                    <th>S/N</th>
                    <th width="70">New Acc#</th>
                    <th width="70">Old Acc#</th>
                    <th>Book Title</th>
                    <th>ISBN #</th>
                    <th>Author Name</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $i=1;
                  foreach($result as $row):
                    $sts = $row->book_availablity_status_id;
                  ?>
                <tr>
                    <td><?php echo $i; ?>)</td>
                    <td align="center"><?php echo $row->accession_number;?></td>
                    <td align="center"><?php echo $row->old_accession_number;?></td>
                    <td><?php echo $row->book_title;?></td>
                    <td><?php echo $row->book_isbn;?></td>
                    <td><?php echo $row->author_name;?></td>
                </tr>  
                  <?php
                  $i++;
                  endforeach;
                  ?>
              </tbody>
                </table>
                <?php echo $print_log;?>
            </div>
            
            <?php endif;?>
            </article>
         
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
 