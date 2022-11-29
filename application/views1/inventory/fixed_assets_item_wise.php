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
          <h2 align="left"><?php echo $page_headers?><span style="float:right">
          <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>    
              </span></h2><hr>
        <article class="contact-form col-md-12 col-sm-7">
                 
            <div id="div_print"> 
                <div class="report_header">
                      <img style="float: right; padding-right: 79px;"  class='img-responsive' src='assets/images/logo-black.png' alt='Edwardes College Peshawar'>
                      <h3 class="text-highlight" style=" text-align: center"></h3><hr>
                    </div>
            <div class="col-md-12">
               <?php
                
                
                 $this->db->select('*'); 
            $this->db->FROM('invt_fixed_item_details');
            $this->db->join('invt_fixed_item_issuance','invt_fixed_item_issuance.fii_id=invt_fixed_item_details.fid_fiiId','left outer');
            $this->db->join('hr_emp_record','hr_emp_record.emp_id=invt_fixed_item_issuance.fii_empId','left outer');
            $this->db->join('invt_items','invt_items.itm_id=invt_fixed_item_details.fid_itemId','left outer');
//            $this->db->where($where);    
            $this->db->order_by('invt_items.itm_id','asc');
            $this->db->group_by('itm_name');
            $product =  $this->db->get()->result();
            
               if($product):
                   $gTotal = '';
                   foreach($product as $row):
                   echo '<ul class="custom-list-style"><li style="margin-left:210px;"><h3><strong><i class="fa fa-check"></i>'.$row->itm_name.'</strong></h3></li></ul>';
                   
                     $this->db->select('*'); 
            $this->db->FROM('invt_fixed_item_details');
            $this->db->join('invt_fixed_item_issuance','invt_fixed_item_issuance.fii_id=invt_fixed_item_details.fid_fiiId','left outer');
            $this->db->join('hr_emp_record','hr_emp_record.emp_id=invt_fixed_item_issuance.fii_empId','left outer');
            $this->db->join('invt_items','invt_items.itm_id=invt_fixed_item_details.fid_itemId','left outer');
             $this->db->where('invt_items.itm_id',$row->itm_id);    
//            $this->db->order_by('invt_items.itm_id','asc');
//            $this->db->group_by('itm_name');
            $ddquery =  $this->db->get()->result();
//                    echo '<pre>';print_r($ddquery);die;
           
            
            if(!empty($ddquery)):
                
                  echo '<table width="90%" border="1" style="margin-left:25px;">';
                  
                    echo '<tr align="center">
                            <td><strong>S/No</strong></td>      
                            <td><strong>Item Name</strong></td>      
                            <td><strong>Price</strong></td>      
                            <td><strong>Purchase Date</strong></td>      
                            <td><strong>Received Date</strong></td>      
                            <td><strong>Employee Name</strong></td>      
                             
                        </tr>';
               
                  $i = ''; 
                  $Total = ''; 
                 foreach($ddquery as $ddrow):
                     $i++;
                 
                $purchase_date = '';
                
//                if($ddrow->fid_pur_date === '01-01-1970'):
                if($ddrow->fid_pur_date == '0000-00-00' || $ddrow->fid_pur_date == '01-01-1970'):
                    $purchase_date = '';
                    else:
                        if($ddrow->fid_pur_price ==1):
                            $purchase_date = '';
                            else:
                            $purchase_date = date('d-m-Y',strtotime($ddrow->fid_pur_date));
                        endif;
                    
                endif; 
                 echo '<tr align="center">';
                 echo  '<td>'. $i.'</td>';
                 echo  '<td>'.$ddrow->itm_name.'</td>';
                 echo  '<td>'.$ddrow->fid_pur_price.'</td>';
                 echo  '<td>'.$purchase_date.'</td>';
                 echo  '<td>'.date('d-m-Y',strtotime($ddrow->fii_date)).'</td>';
                 echo  '<td>'.$ddrow->emp_name.'</td>';
                 echo '</tr>';
                 $Total +=$ddrow->fid_pur_price;
                endforeach;
                    echo '<tr align="center">';
                    echo  '<td colspan="2" style="text-align: right; font-weight: 600;">Total : </td>';
                    echo  '<td>'.$Total.'</td>';
                    echo  '<td></td>';
                    echo  '<td></td>';
                    echo  '<td></td>';
                    echo '</tr>';
            echo ' </table>';
                
                    
            endif;
                   
                   $gTotal +=$Total;
                   endforeach;
                   
                   echo '<br/><table width="90%" border="1" style="margin-left:25px;">';
                        echo '<tr align="center">';
                        echo  '<td style="text-align: right; font-weight: 600; width:33%; ">Grand Total : </td>';
                        echo  '<td style="text-align: left; font-weight: 600; "> '.$gTotal.'</td>';
                         
                        echo '</tr>';
                    echo ' </table>';
                    echo $print_log;
               endif; 
                
           
           
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
 