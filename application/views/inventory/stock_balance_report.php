<script language="javascript">
  function printdiv(printpage)
  {
//    var headstr = "<html><head><title></title></head><body>";
    var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'><br/><h3>Stock Balance Report</h3></p>";
    var footstr = "</body>";
    var newstr = document.all.item(printpage).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = headstr+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;
    return false;
  }
</script>
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?php echo $page_header?>
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
          <li class="current">Stock Balance Report
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">
            <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Search Panel</span>
                        </h1>
                <div class="section-content">
                    
           <form method="post">
               <div class="col-md-12">
                    
                <?php
            $gres = $this->InventoryModel->get_by_ids('invt_items',array('itm_id'=>@$item_id));
            if($gres){
                foreach($gres as $grec)
                { ?> 
        <div class="form-group col-md-3"> 
            <label for="name">Item Name</label>
        <input type="text" name="item_id" class="form-control" value="<?php echo $grec->itm_name;?>" id="items">
        <input type="hidden" name="item_id" id="item_id" value="<?php echo $grec->itm_id; ?>">
                    </div>
                <?php 
                }      
            }else { ?>        
        <div class="form-group col-md-3">
            <label for="name">Item Name</label>
           <input type="text" name="item_id" class="form-control" placeholder="Item Name" id="items">
           <input type="hidden" name="item_id" id="item_id">
        </div>
            <?php } ?> 
                <div class="form-group col-md-2">
                    <label for="name">Issue From</label>
                   <input type="text" name="issuance_from" value="<?php echo $issuance_from?>" class="form-control datepicker ">
                </div>
                <div class="form-group col-md-2">
                    <label for="name">Issue to</label>
                   <input type="text" name="issuance_to" value="<?php echo $issuance_to; ?>" class="form-control datepicker ">
                </div>
                <?php
            $gres = $this->InventoryModel->get_by_ids('hr_emp_record',array('emp_id'=>@$emp_id));
            if($gres){
                foreach($gres as $grec)
                { ?> 
        <div class="form-group col-md-3"> 
            <label for="name">Employee Name</label>
        <input type="text" name="emp_id" class="form-control" value="<?php echo $grec->emp_name;?>" id="emp_record">
        <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $grec->emp_id; ?>">
                    </div>
                <?php 
                }      
            }else { ?>   
                <div class="form-group col-md-2">
                    <label for="name">Employee Name</label>
                   <input type="text" name="emp_id" class="form-control" id="emp_record">
                   <input type="hidden" name="emp_id" id="emp_id">
                </div>
                <?php } ?> 
            
                <div class="form-group col-md-2">    
                    <label for="name">Item Category</label>
                <?php                     
                 echo form_dropdown('catm_id', $main,$catm_id, 'class="form-control"');
                ?>
                </div>    
                <div class="form-group col-md-12"  style="text-align: right;">
                    <input type="submit" name="search" class="btn btn-theme" value="Search">
                    <input type="submit" name="export" class="btn btn-theme" value="Export">
                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
                </div>
               </div>       
            </form>
                    
                </div>
            </section>
             <div id="div_print"> 
            <?php
            
            if(!empty($result)):
                
            ?>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count($result); ?>
            </button>
            </p>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>S#</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Balance</th>
                    <th>Issuance Date</th>
                    <th>Employee</th>
                    <th>Designation</th>
                    <th>Issuance Department</th>
                </tr>
              </thead>
          <tbody>
              <?php
              $i = 1;
              foreach($result as $row):
//              foreach($result['issue'] as $row):
              $date = $row->issuance_date;
            $newDate = date("d-m-Y", strtotime($date));
              $ass_id = $row->ass_id;
              ?>
              <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row->itm_name;?></td>
                    <td><?php echo $row->quantity;?></td>
                    <td><?php echo $row->remaining_quantity;?></td>
                    <td><?php echo $newDate;?></td>
                    <td><?php echo $row->emp_name;?></td>
                    <td><?php echo $row->desg;?></td>
                    <td><?php echo $row->dept_name;?></td>
              </tr>
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
            <?php
            
            if(!empty($result['purchase'])):
                
            ?>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count($result['purchase']); ?>
            </button>
            </p>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>S#</th>
                    <th>Item Name</th>
                    <th colspan="2">Quantity</th>
                    <th  colspan="4">Purchase Date</th>
                    
                </tr>
              </thead>
          <tbody>
              <?php
              $i = 1;
              foreach($result['purchase'] as $POrow):
              ?> 
              <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $POrow->itm_name;?></td>
                    <td colspan="2"><?php echo $POrow->quantity;?></td>
                     
                    <td colspan="4"><?php echo date("d-m-Y", strtotime($POrow->grn_date));?></td>
                    
              </tr>
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
  <!--//content-->
 
  <script>
          $(function() {
            $('.datepicker').datepicker( {
               changeMonth: true,
                changeYear: true,
                 dateFormat: 'dd-mm-yy'
           
            });
        });
      </script>