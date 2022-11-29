<script language="javascript">
function printdiv(printpage)
{
//var headstr = "<html><head><title></title></head><body><p></p>";
var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' alt='Edwardes College Peshawar'></p>";
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
              <h2 align="left">Staff Books Issuance List<hr></h2>
            <h4 style="color:red; text-align:center;">
                <?php print_r($this->session->flashdata('msg'));?>
            </h4>
            <form method="post">
            <div class="col-md-12">    
                <div class="form-group col-md-3">
        <input type="text" name="emp_id" placeholder="Employee" class="form-control" id="em_name">
        <input type="hidden" name="emp_id" id="emp_id">
                </div>
                <div class="form-group col-md-3">
                    <input type="text" name="department_id" placeholder="Department" class="form-control" id="dept">
                    <input type="hidden" name="department_id" id="department_id">         
                </div>
                <div class="form-group col-md-2">
                   <input type="date" name="issuance_date" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <select class="form-control" name="contract_type_id">
                        <option value="">Select Type</option>
                        <?php 
                        $q = $this->CRUDModel->getResults('hr_emp_contract_type');
                        foreach($q as $rec):
                        ?>
                        <option value="<?php echo $rec->contract_type_id;?>"><?php echo $rec->title;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
               <div class="form-group col-md-4">
                    <input type="submit" name="search" class="btn btn-theme" value="Search">
                   <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button> 
               </div>
            </div>
            </form>
            <?php
            if(@$books):
            ?>
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$books);?>
            </button>
            </p>
            <div id="div_print">
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>S#</th>
                    <th>Picture</th>
                    <th>Employee Name</th>
                    <th>Designation</th>
                    <th>Department</th>
                    <th>Job Type</th>
                    <th>Status</th>
                    <th colspan="5">View Books</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $i=1;
                  foreach($books as $row):
                  $iss_id = $row->iss_id;
                  ?>
                <tr>
                    <td><?php echo $i;?></td>
        <td><img src="assets/images/employee/<?php echo $row->picture;?>" width="50" height="40"></td>
                    <td><?php echo $row->emp_name;?></td>
                    <td><?php echo $row->designation;?></td>
                    <td><?php echo $row->department;?></td>
                    <td><?php echo $row->contract;?></td>
                    <td><?php echo $row->employ_status;?></td>
                <?php 
                $where = array('lib_staff_book_issuance.emp_id'=>$row->emp_id);    
                $query = $this->LibraryModel->return_staffBooks_details('lib_staff_book_issuance',$where);
                    if($query):
                        $ttl_fine = 0;
                 ?>
            <td colspan="5">        
            <table class="table table-boxed table-bordered table-hover">
              <thead>
                <tr>    
                <th width="400">Book Title</th>    
                <th>Acc #</th>    
                <th>Issued Date</th>
                <th>Due Date</th>
                <th>Fine</th>
                </tr>
                <?php 
                  foreach($query as $bk):
                    $issued_date = $bk->issued_date; 
                    $issuedDate = date("d-m-Y", strtotime($issued_date));
                  ?> 
                  <tr>
                    <td><?php echo $bk->book_title;?></td>
                    <td><?php echo $bk->accession_no;?></td>
                    <td><?php echo $issuedDate;?></td>
                    <td><?php echo date('d-m-Y', strtotime($bk->due_date));?></td>
                    <td><?php 
                       $earlier = new DateTime($bk->due_date);
                       $later = new DateTime(date("Y-m-d"));
                       $abs_diff = $later->diff($earlier)->format("%a"); //3die;
                       $fine = $abs_diff*5;
                       $ttl_fine += $fine;
                       echo '<strong style="color:red">'.$abs_diff.' days (Rs.'.$fine. ')</strong>';
                    ?></td>
                  </tr>
                <?php
                  endforeach;
                  ?>
                  <tr>
                    <td colspan="3" align="center"><strong style="color:red">Total Issued: <?php echo count($query);?></strong></td>
                    <td><strong style="color:red">Total Fine</strong></td>
                    <td align="center"><strong style="color:red"><?php echo $ttl_fine;?></strong></td>
                  </tr>
                  <?php
                  endif;            
                 ?> 
                </thead>
                    </table>
                </td>
                  <?php
                  $i++;
                  endforeach;
                  ?>
              </tbody>
            </table>
            <?php
            echo $print_log;
            endif;
                ?>
            </div>
            </article>
         
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" align="center" style="color:Green">View Employee Books Details</h4>
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