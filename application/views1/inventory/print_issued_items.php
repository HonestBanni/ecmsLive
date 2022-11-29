<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
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
      <div class="page-content">
      <div class="row">
     <h2 align="left"><span  style="float:right">
          <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>    
              </span>
    </h2>
        <div id="div_print"> 
            <div class="table-responsive">
                <h2 align="center">Items Received/Returned Form<hr></h2>
                <article class="contact-form col-md-12 col-sm-12">
                     <?php
               if($fid_result):
                    foreach($fid_result as $row):
                    $date = $row->fii_date;
                    $newDate = date("d-m-Y", strtotime($date));
                        ?>
        <div style="width:100%; height:45px;">
            <div style="width:5%;height:45px;float:left;">
            </div>
            <div style="width:65%;height:45px;float:left;">
                <strong>GRN ID:</strong><?php echo $row->fid_grn;?>
            </div>
            <div style="width:30%; height:45px;float:right">
                <strong>Date:</strong> <?php echo date('d-m-Y');?>
            </div>
        </div>    
        
            <table width="95%" border="1" align="center" style="margin-bottom:10px;">
              <thead>
                <tr align="center">
                    <td><strong>Item Name</strong></td>
                    <td><strong>Tag No.</strong></td>
                    <td><strong>Room</strong></td>
                    <td><strong>Department</strong></td>
                    <td><strong>Item Status</strong></td>
                    <td><strong>Issued Date</strong></td>
                </tr>
              </thead>
          <tbody>
            
                  <tr align="center">
                    <td><?php echo $row->item_name; ?></td>
                    <td><?php echo $row->fid_tag_no; ?></td>
                    <td><?php echo $row->room_name; ?></td>
                    <td><?php echo $row->deptt_name; ?></td>
                    <td><?php echo $row->item_iss_status; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row->fii_date)); ?></td>    
                  </tr>
              
          </tbody>
            </table><br>
            <?php
            endforeach;
        endif;
        ?>
        <div style="width:100%; height:80px;">
            <?php
            $offc = $this->InventoryModel->get_by_id('hr_emp_record',array('emp_id'=>$row->item_iss_by));
            if($offc){
                    foreach($offc as $grew){
            ?>
            <div style="width:33%; height:100px; float:left;padding-left:30px;">
                    <strong><u>Received and Delivered By</u></strong><br>
                    <strong>(Name):</strong> <?php echo $grew->emp_name;?><br>
                    <strong>(Title):</strong> <?php echo $grew->title;?><br><br>
                    <strong>Signature: .......................................</strong>
            </div>
            <?php        
                        }
                    }
            ?>
            <div style="width:33%; height:100px; float:left;padding-left:30px;">
                <?php
                if($row->item_status == '1'):
                    $admin = 'Delivered by';
                    $user = 'Recieved by';
                else:
                    $admin = 'Returned to';
                    $user = 'Returned by';
                endif;
                $gres = $this->InventoryModel->get_by_id('hr_emp_record',array('emp_id'=>'66'));
                    if($gres){
                    foreach($gres as $grec){ 
                        $received =  $grec->emp_name;  
                        $desg =  $grec->title;
                        ?>
                            <strong><u><?php echo $admin; ?></u></strong><br>
                            <strong>(Name:) </strong> <?php echo $received;?><br>
                            <strong>(Title) :</strong> <?php echo $desg;?><br><br>
                            <strong>Signature: .......................................</strong>
                    <?php        
                        }
                    }
                   ?>    
            </div>
           
            <div style="width:33%; height:100px; float:left;padding-left:30px;">
                    <strong><u><?php echo $user; ?></u></strong><br>
                    <strong>(Name):</strong> <?php echo $row->employee_name;?><br>
                    <strong>(Title):</strong> <?php echo $row->emp_design;?><br><br>
                    <strong>Signature: .......................................</strong>
            </div>
            
        </div><br><br>
         <br/><?php echo $print_log;?>          
                </article>                    
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
 
 