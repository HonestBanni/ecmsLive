<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left">Add Student Fine</h1>
            <div class="breadcrumbs pull-right">
                <ul class="breadcrumbs-list">
                <li class="breadcrumbs-label">You are here:</li>
                <li> <?php echo anchor('admin/admin_home', 'Home');?> <i class="fa fa-angle-right"></i></li>
                <li class="current">Add Student Fine</li>
                </ul>
            </div>
            <!--//breadcrumbs-->
        </header> 
        
        <div class="page-content">
            <div class="row">
                <form method="post">
                    <div class="form-group col-md-3">
                        <label>College #</label>
                        <input type="text" name="student_name" class="form-control" placeholder="Student Name" id="student_name_disc">
                        <input type="hidden" name="student_id" id="student_id">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Fine Type</label>
                        <select class="form-control" name="proc_type_id">
                            <option value="">Select Fine Type</option>
                            <?php
                                $f = $this->db->query("SELECT * FROM proctorial_fine_type"); 
                            foreach($f->result() as $rec):
                            ?>
                            <option value="<?php echo $rec->proc_type_id;?>"><?php echo $rec->proc_type_title;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Date</label>
                        <input type="text" name="date" value="<?php echo date('d-m-Y');?>" class="form-control date_format_d_m_yy">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Amount</label>
                        <input type="text" name="amount" class="form-control" placeholder="Amount">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Fine By Proctor</label>
                        <input type="text" name="proctor_id" class="form-control" placeholder="Proctor Name" id="proctor_record">
                        <input type="hidden" name="proctor_id" id="proctor_id">
                    </div>
                    <div class="form-group col-md-9">
                        <label>Recovered Assets</label>
                        <input type="text" name="recover_assets" class="form-control" placeholder="Recovered Assets">
                    </div>
                    <div class="form-group col-md-9">
                        <label>Remarks</label>
                        <input type="text" name="remarks" class="form-control" placeholder="Remarks">
                    </div>
                    <div class="form-group col-md-3">
                        <input style="margin-top:23px" type="submit" name="submit" class="btn-primary btn">
                    </div>        
                </form>
            </div>
            <!--//page-row-->
        </div>
        <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
</div>
<!--//content-->
<script>
    jQuery(document).ready(function(){
        jQuery("#student_name_disc").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_student_record_get/"+$("#student_name_disc").val(), 
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            alert('test');
            jQuery("#student_name_disc").val(ui.item.contactPerson);
            jQuery("#student_id").val(ui.item.id);
            jQuery("#college_no").val(ui.item.college_no);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
     });
</script>