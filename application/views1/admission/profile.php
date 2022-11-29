        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Profile<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">               
                   <div class="page-content">                 
                    <div class="row page-row">                     
                        <div class="team-wrapper col-md-8 col-sm-7">        
                            <div class="row page-row">
                                <?php foreach($result as $row){
                                ?>
                                <figure class="thumb col-md-3 col-sm-4 col-xs-6">
    <img class="img-responsive" src="assets/images/employee/<?php echo $row->picture;?>" alt="" width="160" height="100" style="border-radius:10%">
                                </figure>
                                <div class="details col-md-9 col-sm-8 col-xs-6">
                                    <h3 class="title"><strong><?php echo $row->emp_name;?></strong></h3>
                                    <h5><strong>Designation: <?php echo $row->designation;?></strong></h5>
                                    <h5><strong>Department: <?php echo $row->department;?></strong></h5>
                                    <p></p>                                 
                                </div> 
                                <?php } ?>
                            </div>
                        </div><!--//team-wrapper-->
                    </div><!--//page-row-->
                </div> 
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   
