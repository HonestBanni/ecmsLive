        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">All Employee Contract Type <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Employee Contract </th>
<!--                            <th><i class="icon-edit" style="color:#fff;"></i> Update</th>-->
                            <th><i class="icon-trash" style="color:#fff"></i><b> Delete</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    foreach($result as $rec)  
                    {
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $rec->title;?></td>
<!--                            <td><a href="<?php// echo base_url();?>HrController/update_status/<?php// echo $rec->emp_status_id;?>"><i class="icon-edit"></i><b> Update</b></a></td>-->
                            <td><a href="<?php echo base_url();?>HrController/delete_contract/<?php echo $rec->contract_type_id;?>" 
                                   onclick="return confirm('Are You Sure to Delete This..?')"><i class="icon-trash" style="color:#87a938"></i><b> Delete</b></a></td>
                        </tr>

                        <?php
}
                        ?>


                    </tbody>
                </table>
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   
