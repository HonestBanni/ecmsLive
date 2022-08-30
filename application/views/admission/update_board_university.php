 			 <!-- ******CONTENT****** --> 
    <div class="content container">
               <!-- ******BANNER****** -->
        <h2 align="left">UPdate Boards / Universities <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12" style="min-height:400px;">
                    <h4 style="color:green; text-align:center;"><?php print_r($this->session->flashdata('insert_msg'));?></h4> 
                </div>
            <br />
                <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="">
                    <div class="form-group name">
                        <label for="name">Board/University Name</label>
                            <input style="width:50%;" id="name" type="text" class="form-control" name="title" value="<?php echo $result->title?>">
                            <input type="hidden" value="<?php echo $result->bu_id?>" name="bu_id">
                    </div>
                    <input type="submit" name="submit" value="Update Record" class="btn btn-theme">
                </form>
	</div><!--//col-md-3-->
                
    </div><!--//cols-wrapper-->
           
         