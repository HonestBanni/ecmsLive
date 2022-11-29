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
          <h2 align="left">Fixed Assets Register Cumulative<span style="float:right">
          <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>    
              </span></h2><hr>
        <article class="contact-form col-md-12 col-sm-7">
            <form method="post" action="InventoryController/search_assets_reg_cum">
                <div class="form-group col-md-2">
                    <input type="text" name="rm_id" placeholder="Room Name" class="form-control" id="room">
                   <input type="hidden" name="rm_id" id="rm_id" value="">
                </div>
                <div class="form-group col-md-2">
                    <input type="submit" name="search" class="btn btn-theme" value="Search">
                </div>
            </form>
            <div id="div_print"> 
                <div class="report_header">
                  <img style="float: right; padding-right: 79px;"  class='img-responsive' src='assets/images/logo-black.png' alt='Edwardes College Peshawar'>
                  <h3 class="text-highlight" style=" text-align: center"></h3><hr>
                </div>
            <div class="col-md-12">
                <?php
               foreach($result as $urRow):  
                $col_id = $urRow->col_id;
                ?>
                <ul class="custom-list-style">
                    <li><h5><strong><i class="fa fa-hand-o-right"></i> <?php echo $urRow->col_name; ?> (<?php echo $urRow->col_total_area; ?>)</strong></h5></li>
                </ul>
                    <?php
            $where = array('invt_plot_area.col_id'=>$col_id);              
            $this->db->select('*'); 
            $this->db->FROM('invt_plot_area');
            $this->db->join('invt_college_area','invt_college_area.col_id=invt_plot_area.col_id','left outer');
            $this->db->where($where);              
            $query =  $this->db->get();
            foreach($query->result() as $row):
                  $plot_id = $row->plot_id;
                ?>
             <ul class="custom-list-style">
                 <li style="margin-left:70px;"><h5><strong><i class="fa fa-arrow-right"></i> <?php echo $row->plot_name; ?> (<?php echo $row->plot_total_area; ?>)</strong></h5></li>
            </ul> 
                <?php
            $where = array('invt_building_block.plot_id'=>$plot_id);              
            $this->db->select('*'); 
            $this->db->FROM('invt_building_block');
            $this->db->join('invt_plot_area','invt_plot_area.plot_id=invt_building_block.plot_id','left outer');
            $this->db->where($where);              
            $bquery =  $this->db->get();
            foreach($bquery->result() as $brow):
                  $bb_id = $brow->bb_id;
                ?>
                <ul class="custom-list-style">
                    <li style="margin-left:140px;"><h5><strong><i class="fa fa-chevron-right"></i> <?php echo $brow->bb_name; ?>[<?php echo $brow->bb_shortname;?>] (<?php echo $brow->total_area; ?>)</strong></h5></li>
            </ul>
            <?php
            $where = array('invt_rooms.rm_bbId'=>$bb_id);              
            $this->db->select('*'); 
            $this->db->FROM('invt_rooms');
            $this->db->join('invt_building_block','invt_building_block.bb_id=invt_rooms.rm_bbId','left outer');
            $this->db->where($where);              
            $rquery =  $this->db->get();
            foreach($rquery->result() as $rrow):
                $rm_id = $rrow->rm_id;    
                ?>
              <ul class="custom-list-style">
            <li style="margin-left:210px;"><h5><strong><i class="fa fa-check"></i> <?php echo $rrow->rm_name; ?>[<?php echo $rrow->rm_shortname;?>] (<?php echo $rrow->room_total_area;?>)</strong></h5><li>
            <table width="90%" border="1" style="margin-left:25px;">
                <tr align="center">
                   <td><strong>S/No</strong></td>           
                    <td><strong>Item Name</strong></td>
                    <td><strong>Item Code</strong></td>
                    <td><strong>Total</strong></td>
                </tr>
                <?php
            $where = array('invt_fixed_item_details.fid_roomId'=>$rm_id);              
            $this->db->select('*'); 
            $this->db->select('count(invt_items.itm_name) as countItems'); 
            $this->db->FROM('invt_fixed_item_details');
            $this->db->join('invt_fixed_item_issuance','invt_fixed_item_issuance.fii_id=invt_fixed_item_details.fid_fiiId','left outer');
            $this->db->join('hr_emp_record','hr_emp_record.emp_id=invt_fixed_item_issuance.fii_empId','left outer');
            $this->db->join('invt_items','invt_items.itm_id=invt_fixed_item_details.fid_itemId','left outer');
            $this->db->group_by('invt_items.itm_name');
            $this->db->where($where);   
            $ddquery =  $this->db->get();
             $i = 1;     
            foreach($ddquery->result() as $ddrow): 
                ?>
                <tr align="center">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $ddrow->itm_name; ?></td>
                    <td><?php echo $ddrow->itm_shortname; ?></td>
                    <td><?php echo $ddrow->countItems; ?></td>
                </tr>
                <?php 
                 $i++;
                    endforeach;
                ?>
                  </table>
            </ul>  
                <?php           
            endforeach;
            endforeach;
            endforeach;
            endforeach;
                echo $print_log;?>
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
 