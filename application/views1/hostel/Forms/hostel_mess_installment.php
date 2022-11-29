 
<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left"><?php echo $page_header?></h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current"><?php echo $page_header?></li>
                    </ul>
                </div>
      <!--//breadcrumbs-->
        </header> 
        <div class="page-content">
            <div class="row"> 
                <?php echo form_open('',array('class'=>'course-finder-form')); ?>
                <div class="col-md-12">
                  <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight"><span class="line"><?php echo $page_header?> Panel</span></h1>
                        <div class="section-content" >
                             
                                    <div class="row">
                                        <div class="col-md-3 col-sm-5">
                                             <label for="name">Challan no </label>
                                                <?php
                                                    echo form_input(array(
                                                        'name'          => 'challan_no',
                                                        'class'         => 'form-control',
                                                        'placeholder'   => 'Challan No',
                                                        'type'          => 'text',
                                                        'value'         =>$challan_id,
                                                        'required'      => 'required',
                                                        'id'      => 'challan_no',
                                                    )); 
                                                ?>
                                        </div>
                                    </div>
                                <?php if(@$std_info): ?>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-5">
                                            <label for="name">Name</label>
                                                <?php 
                                                    echo form_input(array(
                                                        'class'         => 'form-control',
                                                        'placeholder'   => 'Studetn Name',
                                                        'value'         => $std_info->student_name,
                                                        'type'          => 'text',
                                                        'readonly'      => 'readonly'
    //                                                    'value'         => $amount,
                                                        ));
                                                    echo form_input(array(
                                                        'name'          =>'hostel_std_id',
                                                        'value'         => $std_info->hostel_std_id,
                                                        'type'          => 'hidden',
                                                        ));
                                                ?>

                                        </div>
                                        <div class="col-md-3 col-sm-5">
                                            <label for="name">Father Name</label>
                                                <?php
                                                    echo form_input(array(
                                                        'class'         => 'form-control',
                                                        'placeholder'   => 'Studetn Name',
                                                        'value'         => $std_info->father_name,
                                                        'type'          => 'text',
                                                        'readonly'      => 'readonly'
    //                                                    'value'         => $amount,
                                                        ));
                                                ?>
                                        </div>
                                        <div class="col-md-3 col-sm-5">
                                            <label for="name">Group</label>
                                                <?php
                                                    echo form_input(array(
                                                        'class'         => 'form-control',
                                                        'placeholder'   => 'Studetn Name',
                                                        'value'         => $std_info->name,
                                                        'type'          => 'text',
                                                        'readonly'      => 'readonly'
    //                                                    'value'         => $amount,
                                                        ));
                                                ?>
                                        </div>
                                        <?php endif;?>
                                    </div>
                                    <div style="padding-top:1%;">
                                        <div class="col-md-4 pull-right">
                                            <button type="submit" class="btn btn-theme" name="search" id="search"  value="search" ><i class="fa fa-search"></i> Search Challan</button>
                                                <?php 
                                                if(@$std_info):
                                                    if(empty($error_msg)):
                                                        echo   '<button type="submit" class="btn btn-theme" name="save" id="save"  value="save" ><i class="fa fa-book"></i>  Save Challan</button>';
                                                    endif;    
                                                endif;
                                                    
                                                ?>
                                            
                                        </div>
                                        </div>
                                            
                        </div>
                  </section>
                    <?php if(!empty($error_msg)):
                         foreach($error_msg as $row=>$key):
                              echo    '<div class="alert alert-danger alert-dismissable center">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>'.$key.' </strong> 
                                      </div>';
                         endforeach;

                    endif; 
                    ?>
                    <div class="col-md-8 col-md-offset-2">
                        <?php   if(@$challan_info): ?>
                        <h3 class="has-divider text-highlight">Challan Details </h3>
                        <div class="table-responsive">
                            <table class="table table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fee Head</th>
                                        <th>Amount Status</th>
                                        <th>Actual Amount</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody><?php 
                                    $amount = '';
                                    $balance = '';
                                    $sn = '';
                                    
                                    foreach($challan_info as $row):
                                        $type = '';
                                            if($row->old_challan_id == 0):
                                                $type = '<strong>Current</strong>';
                                                else:
                                                $type = 'Arrears';
                                            endif;
                                        $sn++;
                                        echo ' <tr> 
                                                    <td>'.$sn.'</td> 
                                                    <td>'.$row->title.'</td> 
                                                    <td>'.$type.'</td> 
                                                    <input  type="hidden" name="ChlnDetailId[]"  value="'.$row->ChlnDetailId.'">
                                                    <td><input  name="ActualAmount[]"      type="text"  value="'.$row->amount.'"  readonly="readonly"></td>
                                                    <td><input  name="InstallmentAmount[]" class="InstallmentAmount"  type="text" value="'.$row->balance.'"></td></tr>';
                                        
                                            $amount +=$row->amount;
                                            $balance +=$row->balance;
                                    endforeach;
                                    echo '  <tr>
                                                <td></td>
                                                <td>Total</td>
                                                <td></td>
                                                <td>'.$amount.'</td>
                                                <td><input type="text" readonly="readonly"  class="totalAmount" value="'.$balance.'"></td>
                                            </tr>';

                                    endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
                    echo form_close();
                ?>
            </div>
        </div>
    </div>
      <!--//page-content-->
</div>
    <!--//page-wrapper--> 
 
   
   
     <script>
jQuery(document).ready(function(){
   jQuery('#challan_no').focus();
    var grand_amount = jQuery('.installment_update').val();
    if(grand_amount== 0){
      jQuery('#update_challan').hide();
   }
 jQuery(document).on("change", ".InstallmentAmount", function() {
        
         var concession      = parseInt(jQuery(this).val());
        var install_head    = parseInt(this.id);
        
           if(concession > install_head){
            alert('Installment Is greater then Installment Head');
            jQuery(this).val('');
            jQuery(this).focus();
            return false;
     }
        
        
    var sum = 0;
    jQuery(".InstallmentAmount").each(function(){
        sum += +$(this).val();
    });
    jQuery(".totalAmount").val(sum);
});
    
    });
 
  </script>    
   