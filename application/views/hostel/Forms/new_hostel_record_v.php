<div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left"><?php echo $page_header;?><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
        <h4 style="color:green; text-align:center;">
            <?php print_r($this->session->flashdata('insert_msg'));?>
        </h4>
        <h4 style="color:red; text-align:center;">
            <?php print_r($this->session->flashdata('msg'));?>
        </h4>
									</div>
<br />


<div class="page-content">
        
        
        
        
        
      <div class="row">
          <div class="col-md-12">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header;?> Panel</span>
                        </h1>
                        <div class="section-content">
                           <form action="" class="course-finder-form" method="post" accept-charset="utf-8">
                                <div class="row">
                                      
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Student Name</label>
                                         <input type="text" class="form-control" value="<?php echo $result->student_name;?>" disabled="disabled">
                                          <input type="hidden" name="student_id" value="<?php echo $result->student_id;?>">
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Father Name</label>
                                         <input type="text" class="form-control" value="<?php echo $result->father_name;?>" disabled="disabled">
                                          
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Obtained Marks / Total Marks</label>
                                         <input type="text" class="form-control" value="<?php echo $result->obtained_marks.' / '.$result->total_marks;?>" disabled="disabled">
                                          
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Domicile</label>
                                         <input type="text" class="form-control" value="<?php echo $result->name;?>" disabled="disabled">
                                          
                                     
                                     </div>
                                     
                                      
                                </div>
                                <div class="row">
                                      
                                    
                                    
                                    <div class="col-md-3 col-sm-5">
                                         <label for="name">City</label>
                                         <input type="text" name="city" class="form-control" value="<?php echo $result->name;?>">
                                          
                                     
                                     </div>
                               
                                      
                                    
                                    
                                    <div class="col-md-3 col-sm-5">
                                         <label for="name">Hostel (SMS) NO.1:</label>
                                         <input type="text"  required="required" class="form-control phone" name="hostel_mobile_no1" placeholder="0300-0000000" value="<?php echo $result->applicant_mob_no1;?>" >
                                          
                                     
                                     </div>
                                    <div class="col-md-3 col-sm-5">
                                         <label for="name">Hostel NO.2:</label>
                                         <input type="text"  class="form-control phone" name="hostel_mobile_no2" placeholder="0300-0000000" value="<?php echo $result->mobile_no;?>" >
                                          
                                     
                                     </div>
                                    <div class="col-md-3 col-sm-5">
                                         <label for="name">Guardian who can visit Hostel:</label>
                                         <input type="text" class="form-control" name="hostelGuardian" value="<?php echo $result->guardian_name;?>" >
                                      </div>
                                    <div class="col-md-3 col-sm-5">
                                         <label for="name">Relation with Student</label>
                                         <?php 
                                         
                                          echo form_dropdown('relation',$relation,$result->relation_with_guardian,  'class="form-control"');
                                         ?>
                                          
                                     
                                     </div>
                                      <div class="col-md-3 col-sm-5">
                                         <label for="name">Gaurdian's CNIC:</label>
                                         <input type="text" name="cnic" class="form-control nic"  placeholder="00000-0000000-0"  maxlength="15" autocomplete="off" >
                                      </div>
                                    
                                     
                                      
                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-2 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="add" id="add" value="add"><i class="fa fa-plus"></i> Save</button>
                                  </div>
                            </div>
                                    </form>                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
                        
                             
 
          </div>
          
      
      </div>
                 </div>




 
							 </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           