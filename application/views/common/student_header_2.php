    <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Parent Portal (Edwardes College Peshawar)</a>
            </ol>
<hr>

                <?php
        $session = $this->session->all_userdata();
        $student_id =  $session['studentData']['student_id'];
        $student_name      = $session['studentData']['student_name'];
        $where = array('student_id'=>$student_id);
        $studentinfo = $this->StudentModel->profileDataStudent('student_record',$where);       
        $section = $this->StudentModel->get_where_sec('student_group_allotment',$where);       
            $section_name = '';
        if($section):
            $section_name = $section->name;
            else:
        $section_name = '';
        endif;
          $picture = $studentinfo->applicant_image;
                                ?>

     
<div class="tab-pane text-style active" id="tab2">
	<div class="inbox-right">
         	
            <div class="mailbox-content">
               
                <table class="table">
                    <tbody>
                    
                       <tr class="table-row">
                             
                            <td class="table-text">
                            	<h6>Father Name: <?php echo $studentinfo->father_name;?> </h6>
                                <p>SMS # <?php echo $studentinfo->mobile_no ?>
                            </td>
                            <td class="table-text">
                            	<h6>College Number: <?php echo $studentinfo->college_no;?></h6>
                                
                            </td>
                            <td class="table-text">
                            	<h6>Section Name: <?php echo $section_name;?></h6>
                                
                            </td>
                            <td class="table-text">
                            	<h6> Sub Program: <?php echo $studentinfo->sub_program;?> </h6>
                                
                            </td>
                            
                          
<!--                             <td>
                               <i class="fa fa-star-half-o icon-state-warning"></i>
                            </td>-->
                        </tr>
                         
                         
                         
                         
                         
                      
                    </tbody>
                </table>
               </div>
            </div>
</div>


<!--    <div class="profile_details w3l" style="margin-left:5px;">	
        
        <h2 style="color:#fff;margin-top:10px;margin-bottom:10px;font-size:18px;font-weight:bold">Student Profile</h2>
    <nav class="nav-sidebar">
		<ul class="nav tabs">
          <li class="active">
              <a href="#">
                Father Name: <?php echo $studentinfo->father_name;?> 
                <div class="clearfix"></div>
              </a>
          </li>
         <li class="active">
              <a href="#">
                College Number: <?php echo $studentinfo->college_no;?> 
                <div class="clearfix"></div>
              </a>
          </li>
         <li class="active">
              <a href="#">
                Section Name: <?php echo $section->name;?> 
                <div class="clearfix"></div>
              </a>
          </li><li class="active">
              <a href="#">
                Sub Program: <?php echo $studentinfo->sub_program;?> 
                <div class="clearfix"></div>
              </a>
          </li>                           
		</ul>
	</nav>
            </div>-->
       		
        <div class="clearfix"> </div>	
    </div> 
