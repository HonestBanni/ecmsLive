<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
     
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7  page-row">                            
            
            <br/>
<!--            <h3 class="has-divider text-highlight">Result :<?php //echo $countResult?></h3>-->
            <table class="table table-boxed table-hover" border="1">
              <thead>
                <tr>
                  <th>S.no</th>
                  <th>College Number</th>
                  <th>Image</th>
                  <th>Image Name</th>
                  <th>Course</th>
                  <th>Name</th>
                  <th>Father name</th>
                  <th>Obtained marks</th>
                   
                </tr>
              </thead>
              <tbody>
                  <br/>
                  <?php
                  
                  //echo '<pre>';print_r($result);die;
                  if($result):
                  $sn = 1;
                   foreach($result as $resRow):
                      echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$resRow->college_no.'</td>
                                <td><img src="assets/images/students/'.$resRow->applicant_image.'" style="height: 99px;padding-top: 6px;padding-bottom: 7px;padding-left: 11px;"></td>
                                <td>'.$resRow->applicant_image.'</td>
                                <td>'.$resRow->subprogram.'</td>
                                <td>'.$resRow->student_name.'</td>
                                <td>'.$resRow->father_name.'</td>
                                <td>'.$resRow->obtained_marks.'</td>
                                    
                              </tr>
                              ';
                   $sn++;
                  endforeach;
                
                ?>
                
              </tbody>
            </table>
            <?php
            else:
                echo '<h3 class="has-divider text-highlight">NO Query found..</h3>';
            endif;
            ?>
            </article>
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 