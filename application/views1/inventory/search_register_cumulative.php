    <style>

.report_header{
    display: none !important;
}
 
</style>
<script language="javascript">
  function printdiv(printpage)
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
          <h2 align="left">Fixed Assets Register Details<span  style="float:right">
          <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>    
              </span></h2><hr>
        <article class="contact-form col-md-12 col-sm-7">
            <form method="post" action="InventoryController/search_register_cumulative">
                <div class="form-group col-md-2">
                    <input type="text" name="rm_id" placeholder="Room Name" class="form-control" id="room" required="required">
                   <input type="hidden" name="rm_id" id="rm_id" value="">
                </div>
                  <div class="form-group col-md-2">
                    <input type="submit" name="search" class="btn btn-theme" value="Search">
               </div>
            </form>
            <div id="div_print"> 
                <div class="report_header">
                      <img style="float: right; padding-right: 79px;"  class='img-responsive' src='assets/images/logo-black.png' alt='Edwardes College Peshawar'>
                      <h3 class="text-highlight" style=" text-align: center">Fixed Assets Register Details</h3><hr>
                    </div>
            <div class="col-md-12">
                <?php
               foreach($result as $urRow):  
                $col_id = $urRow->col_id;
                ?>
                <ul class="custom-list-style">
                    <li><h5><strong><i class="fa fa-hand-o-right"></i> <?php echo $urRow->col_name; ?> (<?php echo $urRow->col_total_area; ?>)</strong></h5></li>
                </ul>
             <ul class="custom-list-style">
                 <li style="margin-left:70px;"><h5><strong><i class="fa fa-arrow-right"></i> <?php echo $room->plot_name; ?> (<?php echo $room->plot_total_area; ?>)</strong></h5></li>
            </ul>
                <ul class="custom-list-style">
                    <li style="margin-left:140px;"><h5><strong><i class="fa fa-chevron-right"></i> <?php echo $room->bb_name; ?>[<?php echo $room->bb_shortname;?>] (<?php echo $room->total_area; ?>)</strong></h5></li>
            </ul>
              <ul class="custom-list-style">
            <li style="margin-left:210px;"><h5><strong><i class="fa fa-check"></i> <?php echo $room->rm_name; ?>[<?php echo $room->rm_shortname;?>] (<?php echo $room->room_total_area;?>)</strong></h5><li>
             
            <table width="90%" border="1" style="margin-left:25px;">
                <tr align="center">
                    <td><strong>S/No</strong></td>      
                    <td><strong>Item Code</strong></td>      
                           
                    <td><strong>Item Name</strong></td>      
                    <td><strong>Price</strong></td> 
                    <td><strong>Purchase Date</strong></td>  
                    <td><strong>Received Date</strong></td>      
                    <td><strong>Received By</strong></td>
                </tr>     
            <?php
            $where = array('invt_fixed_item_details.fid_roomId'=>$room->rm_id);              
            $this->db->select('*'); 
            $this->db->FROM('invt_fixed_item_details');
            $this->db->join('invt_fixed_item_issuance','invt_fixed_item_issuance.fii_id=invt_fixed_item_details.fid_fiiId','left outer');
            $this->db->join('hr_emp_record','hr_emp_record.emp_id=invt_fixed_item_issuance.fii_empId','left outer');
            $this->db->join('invt_items','invt_items.itm_id=invt_fixed_item_details.fid_itemId','left outer');
            $this->db->where($where);              
            $ddquery =  $this->db->get();
                $i = 1;
               
            foreach($ddquery->result() as $ddrow):
                $date = $ddrow->fii_date;
                $newDate = date("d-m-Y", strtotime($date)); 
                
                $purchase_date = '';
                
                  $purchase_date = '';
                
//                if($ddrow->fid_pur_date === '01-01-1970'):
                if($ddrow->fid_pur_date == '0000-00-00' || $ddrow->fid_pur_date == '01-01-1970'):
                    $purchase_date = '';
                    else:
                    $purchase_date = date('d-m-Y',strtotime($ddrow->fid_pur_date));
                endif; 
                ?>
                <tr align="center">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $ddrow->fid_barCode; ?></td>
                    
                    <td><?php echo $ddrow->itm_name; ?></td>
                    
                    <td><?php echo $ddrow->fid_pur_price; ?></td>
                    <td><?php echo $purchase_date;?></td>
                    <td><?php echo $newDate; ?></td>
                    <td><?php echo $ddrow->emp_name; ?></td>
                    <!--<td><a href='InventoryController/delte_inventory_items/<?php echo $ddrow->fid_id?>' target="_blank">Delete</a></td>-->
                  
                </tr>
                <?php 
                $i++;
                 
                    endforeach;
                    
                    
                    
                ?>
                
                  </table>
            </ul>  
                <?php    
            endforeach;
            echo $print_log;
                ?>

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
  <!--//content-->
 