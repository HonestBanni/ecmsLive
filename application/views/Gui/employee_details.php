<style>
    label{
        color:#00ba8b;
    }
</style>
 <?php

    if($result):
    foreach($result as $empRow):  
         $cscale = $empRow->c_emp_scale_id;   
         $applicant_image = $empRow->picture;   
         $cdesg = $empRow->current_designation; 
        $date = $empRow->dob;
        $newDate = date("d-m-Y", strtotime($date));  
        $jdate = $empRow->joining_date;   
        $jnewDate = date("d-m-Y", strtotime($jdate));     
        ?>    
            <div class="main">
	
	<div class="main-inner">

	    <div class="container">
            <div class="row">
               <div class="span12">
             <?php
                    if($applicant_image == "")
                    {?>
<img style="float:right;margin-right:10px; border-radius:5px;" src="assets/images/employee/user.png" width="70" height="70">
                    <?php
                    }else
                    {?>
<img style="float:right;margin-right:10px; border-radius:5px;" src="assets/images/employee/<?php echo $applicant_image;?>" width="70" height="70">
                <?php 
                    }
                    ?>
            <h2 align="center" style="padding-top:30px;color:#00ba8b">Employee Profile: <?php echo $empRow->emp_name; ?></h2><br>
               <hr> </div>
        <div class="span12"> 
            <div class="row">   
<div class="span2">
  <label for="usr">Employee Name:</label>
  <input type="text" value="<?php echo $empRow->emp_name; ?>" class="span2"> 
</div>
<div class="span2">
  <label for="usr">Father Name:</label>
  <input type="text" value="<?php echo $empRow->father_name; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">Employee Husband:</label>
  <input type="text" value="<?php echo $empRow->emp_husband_name; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">Gender:</label>
  <input type="text" value="<?php echo $empRow->genderTitle; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">CNIC:</label>
  <input type="text" value="<?php echo $empRow->nic; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">Date of Birth <small>(D-M-Y)</small>:</label>
  <input type="text" value="<?php echo $newDate ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">Post Address:</label>
  <input type="text" value="<?php echo $empRow->postal_address; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">Permanent Address:</label>
  <input type="text" value="<?php echo $empRow->permanent_address; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">District:</label>
  <input type="text" value="<?php echo $empRow->district; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">Post Office:</label>
  <input type="text" value="<?php echo $empRow->post_office; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">Country:</label>
  <input type="text" value="<?php echo $empRow->country; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">Blood Group:</label>
  <input type="text" value="<?php echo $empRow->blood; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">PTCL No.:</label>
  <input type="text" value="<?php echo $empRow->ptcl_number; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">Contact 1:</label>
  <input type="text" value="<?php echo $empRow->contact1; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">Contact 2:</label>
  <input type="text" value="<?php echo $empRow->contact2; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">Religion:</label>
  <input type="text" value="<?php echo $empRow->religion; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">Marital Status:</label>
  <input type="text" value="<?php echo $empRow->marital; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">Employee Personal No.:</label>
  <input type="text" value="<?php echo $empRow->emp_personal_no; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">GP Fund No.:</label>
  <input type="text" value="<?php echo $empRow->gp_fund_no; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">Email:</label>
  <input type="text" value="<?php echo $empRow->email; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">Contract:</label>
  <input type="text" value="<?php echo $empRow->contract; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">Joining Scale:</label>
  <input type="text" value="<?php echo $empRow->joiningscale; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">Joining Designation:</label>
  <input type="text" value="<?php echo $empRow->jdesignation; ?>" class="span2"> 
</div>                        
<div class="span2">
  <label for="usr">Joining Date <small>(D-M-Y)</small>:</label>
  <input type="text" value="<?php echo $jnewDate; ?>" class="span2"> 
</div>
<div class="span2">
  <label for="usr">Current Designation:</label>
<?php
$result = $this->GuiModel->get_by_id('hr_emp_designation',array('emp_desg_id'=>$cdesg));
    if($result)
    {
        foreach($result as $drec)
        {
            echo '<input class="span2" type="text" value="'.$drec->title.'">';
       }     
    }else{
            echo '<input class="span2" type="text" value="">';
         }    
     ?>    
</div>                        
<div class="span2">
  <label for="usr">Current Scale:</label>
 <?php
$result = $this->GuiModel->get_by_id('hr_emp_scale',array('emp_scale_id'=>$cscale));
    if($result)
    {
        foreach($result as $srec)
        {
            echo '<input class="span2" type="text" value="'.$srec->title.'">';
        }     
    }else{
            echo '<input class="span2" type="text" value="">';
         }    
     ?> 
</div>                        
<div class="span2">
  <label for="usr">Department:</label>
  <input type="text" value="<?php echo $empRow->department; ?>" class="span2"> 
</div>
<div class="span2">
  <label for="usr">Subject:</label>
  <input type="text" value="<?php echo $empRow->subjectTitle; ?>" class="span2"> 
</div>
<div class="span2">
  <label for="usr">Shift:</label>
  <input type="text" value="<?php echo $empRow->shiftname; ?>" class="span2"> 
</div>
<div class="span2">
  <label for="usr">Account No.:</label>
  <input type="text" value="<?php echo $empRow->account_no; ?>" class="span2"> 
</div>
<div class="span4">
  <label for="usr">Bank Name:</label>
  <input type="text" value="<?php echo $empRow->bankname; ?>" class="span4"> 
</div>
<div class="span2">
  <label for="usr">Job Status:</label>
  <input type="text" value="<?php echo $empRow->statustitle; ?>" class="span2"> 
</div>
<div class="span2">
  <label for="usr">Comment:</label>
  <input type="text" value="<?php echo $empRow->comment; ?>" class="span2"> 
</div>        
<div class="span2">
  <label for="usr">Category:</label>
  <input type="text" value="<?php echo $empRow->categorytitle; ?>" class="span2"> 
</div>
<div class="span4">
  <label for="usr">Additional Responsibilty:</label>
  <input type="text" value="<?php echo $empRow->additional_responsibilty; ?>" class="span4"> 
</div>                                                
                 
        <?php
          endforeach;
           endif;
                        ?>            
                           
                        </div>
                    </div>
        <br>
                   
                <div class="row">
	      	
	      	<div class="span12">      		
	      		
	      		<div class="widget ">
	      			
	      			<div class="widget-header">
	      				<i class="icon-user"></i>
	      				<h3>Employee Details</h3>
	  				</div> <!-- /widget-header -->
					
					<div class="widget-content">
						<div class="tabbable">
						<ul class="nav nav-tabs">
						  <li class="active">
						    <a href="#formcontrols" data-toggle="tab">
                                <span style="font-size:18px">Academic Details</span></a>
						  </li>
						  <li class=""><a href="#jscontrols" data-toggle="tab">
                              <span style="font-size:18px">Professional Education</span></a></li>
                        <li class=""><a href="#research" data-toggle="tab">
                            <span style="font-size:18px">Research Papers Details</span></a></li>
						</ul>
						
						<br>
						
                    <div class="tab-content">
                        <div class="tab-pane active" id="formcontrols">
                            <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Degree</th>
                            <th>Board/University</th>
                             <th>Passing Year</th>
                             <th>%age</th>
                            <th>Division</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if($employee_records):
                        foreach($employee_records as $eRow):
                        
                           echo '<tr>';
                                echo '<td>'.$i.'</td>';
                                echo '<td>'.$eRow->Degreetitle.'</td>';
                                echo '<td>'.$eRow->bordTitle.'</td>';
                                echo '<td>'.$eRow->passing_year.'</td>';
                                echo '<td>'.$eRow->percentage.'%</td>';
                                echo '<td>'.$eRow->divisiontitle.'</td>';
                           echo '</tr>';
                        $i++;
                        endforeach;
                        
                        endif;
     
                        ?>


                    </tbody>
                </table>
                        </div>

                        <div class="tab-pane" id="jscontrols">
                            <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Author Name</th>
                            <th>Title</th>
                            <th>Journal</th>
                            <th>Date</th>
                            <th>Year</th>
                            <th>View Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($research):
                      //  echo '<pre>';print_r($research);die;
                        foreach($research as $empRow):
                            $date = $empRow->date;
                            $newDate = date("d-m-Y", strtotime($date));
                           echo '<tr>';
                                echo '<td>'.$empRow->author.'</td>';
                                echo '<td>'.$empRow->title.'</td>';
                                echo '<td>'.$empRow->journal.'</td>';
                                echo '<td>'.$newDate.'</td>';
                                echo '<td>'.$empRow->year.'</td>';
                                echo '<td><a href="GuiController/view_research_paper/'.$empRow->rp_id.'" class="btn btn-primary">View Detail</a></td>';
                           echo '</tr>';
                        endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>
                        </div>
                        
                        <div class="tab-pane" id="research">
                             <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Affiliated Institute</th>
                            <th>Date</th>
                            <th>Year</th>
                            <th>View Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($professional):
                      //  echo '<pre>';print_r($research);die;
                        foreach($professional as $prof):
                            $date = $prof->date;
                            $newDate = date("d-m-Y", strtotime($date));
                           echo '<tr>';
                                echo '<td>'.$prof->title.'</td>';
                                echo '<td>'.$prof->aff_institute.'</td>';
                                echo '<td>'.$newDate.'</td>';
                                echo '<td>'.$prof->duration.'</td>';
                                echo '<td><a href="GuiController/view_professional_edu/'.$prof->fe_id.'" class="btn btn-primary">View Detail</a></td>';
                           echo '</tr>';
                        
                        endforeach;
                        
                        endif;
     
                        ?>
                    </tbody>
                </table>   
                        </div>

                    </div>
						  
						  
						</div>
						
						
						
						
						
					</div> <!-- /widget-content -->
						
				</div> <!-- /widget -->
	      		
		    </div> <!-- /span8 -->
	      	
	      	
	      	
	      	
	      </div>
        
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->