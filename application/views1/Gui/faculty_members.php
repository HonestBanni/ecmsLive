<style>
    #big_stats  i{
        font-size: 25px;
        line-height: 37px;
    color: #000000;
    }
    #big_stats .stat:hover i {
    color: #000000;
}

 
</style>

<script>
setInterval(function() {
                  window.location.reload();
                }, 300000);

</script> 
    

    
<div class="main">
	
	<div class="main-inner">

	    <div class="container">
            <div class="row">
               <div class="span12">
    <form method="post">
            <input type="text" name="emp_name"  placeholder="Employee Name" class="span2">      
            <input type="text" name="father_name" placeholder="Father Name" class="span2">
        <?php 
            echo form_dropdown('gender_id', $gender, $gender_id,  'class="span2"');


            echo form_dropdown('current_designation', $designation, $current_designation,  'class="span2"');

            echo form_dropdown('c_emp_scale_id', $scale, $c_emp_scale_id,  'class="span2"');

            echo form_dropdown('cat_id', $category, $cat_id,  'class="span2"');

            echo form_dropdown('contract_type_id', $contract, $contract_type_id,  'class="span2"'); 

            echo form_dropdown('emp_status_id', $status, $emp_status_id,  'class="span2"');        
        ?>                     
     <input type="submit" name="search" value="Search" style="padding: 4px 20px;" class="btn btn-primary">
 </form>
                </div>      
                  <div class="span12">
               <div class="widget widget-table action-table">
                   <div class="widget-header"> <i class="icon-bookmark"></i>
                       <h3><a href="#">Faculty Members List</a>
                            <?php
                if($faculty_members):
            ?>
                           <i class="icon-list"></i>&nbsp;&nbsp;  
                           <span style="color:red">
                               Total Records: <?php echo count($faculty_members);?>
                           </span>
                       </h3>
                    </div>
                  
            
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered table-hovered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Picture</th>
                    <th>Employee Name</th>
                    <th>Father Name</th>
                    <th>Designation</th>
                    <th>Scale</th>
                    <th>Contract Type</th>
                    <th>Status</th>
                    <th>Academic</th> 
                  </tr>
                </thead>
                <tbody>
                    <?php
                        $sn = 1;
                        foreach($faculty_members as $tp):
                        ?>
                            <tr>
                            <td><?php echo $sn; ?></td>
    <td>
        <?php
        $pic = $tp->picture;
        if($pic == ""):
        ?>
        <img src="assets/images/students/user.png" width="50" height="40">
        <?php
        else:
        ?>  
        <img src="assets/images/employee/<?php echo $pic; ?>" width="50" height="40">
        <?php endif;?>
            </td>
                            <td><?php echo $tp->emp_name; ?></td>
                            <td><?php echo $tp->father_name; ?></td>
                            <td><?php echo $tp->designation; ?></td>
                            <td><?php echo $tp->scale; ?></td>
                            <td><?php echo $tp->contract; ?></td>
                            <td><?php echo $tp->status; ?></td>
                        <td><a href="employeeDetails/<?php echo $tp->emp_id; ?>" class="btn btn-primary"> View Details </a></td>
                            </tr>
                    <?php
                             $sn++; 
                          endforeach;
                    ?>
                </tbody>
              </table>
            </div>
            <!-- /widget-content --> 
          </div>	
	      		<?php endif; ?>
	      		
		    </div> <!-- /span12 -->
                   
              </div>
	      
			
	      
	      
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->
    
  

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Employee Academic Details</h4>
      </div>
      <div class="modal-body">
          <div id="edu_details_info">
              
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Professional Experiance Details</h4>
      </div>
      <div class="modal-body">
          <div id="professional_details_info">
              <h3 style="color:red">Sorry ! Professional Experiance Not Found..</h3>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Research Papers Details</h4>
      </div>
      <div class="modal-body">
          <div id="research_paper_details_info">
              <h3 style="color:red">Sorry ! Research Papers Not Found..</h3>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

