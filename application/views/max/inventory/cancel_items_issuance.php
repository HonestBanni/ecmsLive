<div class="content container">
  <div class="page-wrapper">
      <div class="page-content">
      <div class="row">
        <div id="div_print">  
            <div class="table-responsive">
         <form name="cancel_order" method="post" action="InventoryController/cancel_issuance">
        <article class="contact-form col-md-12 col-sm-12">
                <?php
                if(@$item_issuance):
                    foreach($item_issuance as $row):
                ?>
            <h2 align="center">Cancel Issuance Items<hr></h2>
    <div style="width:100%; height:50px;">
        <div style="width:32%; height:45px; float:left"><strong>Full Name: </strong> <?php echo $row->emp_name;?>
        <input type="hidden" name="ass_id" value="<?php echo $row->ass_id;?>">    
        </div>
        <div style="width:32%; height:45px;float:left"><strong>Designation: </strong> <?php echo $row->design;?></div>
        <div style="width:32%; height:45px;float:right"><strong>Department: </strong> <?php echo $row->department;?></div>
    </div>
    <div style="width:100%; height:50px;">
        <div style="width:32%; height:45px; float:left"><strong>Dated: </strong> <?php echo $row->issuance_date;?></div>
        <div style="width:32%; height:45px; float:left"><strong>Issuance Department: </strong> <?php echo $row->dept_name;?></div>
        <div style="width:32%; height:45px; float:right"></div>  
            
    </div>    
                <?php
                    endforeach;
                endif;
                ?>
            <p style="font-size:18px; text-align:center"><u>Requirements Details</u></p>
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display">
                <tr>
                    <td>Serial#</td>
                    <td>Item Name</td>
                    <td>Quantity</td>
                </tr>
                <?php
              $i = 1;
               foreach($result as $urRow):             
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $urRow->itm_name; ?>
                    <input type="hidden" name="item_id[]" value="<?php echo $urRow->itm_id; ?>">
                    </td>
            <td><input type="text" name="quantity[]" value="<?php echo $urRow->quantity; ?>" readonly></td>
                </tr>
                <?php
              $i++;
              endforeach;
            ?> 
            </table>       
            </article>
             <div class="form-group col-md-2">
        <input type="submit" name="submit" value="Cancel" class="btn btn-theme">
    </div>
             </form>
            </div>
          </div>
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 