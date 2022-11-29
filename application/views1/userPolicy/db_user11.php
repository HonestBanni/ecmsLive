
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Database users
      </h1>
      <div class="breadcrumbs pull-right">
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-label">You are here:
          </li>
          <li> 
            <?php echo anchor('admin/admin_home', 'Home');?> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current">Database users
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">                            
          <?php echo form_open('dbUserCreate',array('class'=>'form-inline')); ?>
            <div class="row">
            <div class="col-md-12">
              
             
                <?php
             
                if(@$dbUserInfo):
                    $value      = $dbUserInfo->email;
                    $user_Id    = $dbUserInfo->id;
                    $emp_Id    = $dbUserInfo->user_empId;
                    $ur_Id      = $dbUserInfo->ur_id;
                    $btn        = 'Update User';
                    $Pwdvalue   = $dbUserInfo->password;
                    $stausId    = $dbUserInfo->user_status;
                    else:
                    $value      = '';
                    $user_Id    = '';
                    $ur_Id      = '';
                    $btn        = 'Add User';
                    $Pwdvalue   = '';
                    $stausId    = '';    
                    $emp_Id    = '';    
                endif;
                ?>
            <div class="form-group ">   
                <?php
                    $student_id = array(
                    'name'          => 'userName',
                    'value'         =>$value,
                    'class'         =>'form-control',
                    'placeholder'   =>'User Name',
                    'required'      =>'required'
                    );
                    echo form_input($student_id);
                    ?>
              </div>
                
                <div class="form-group">
                <?php
              
                    $Pwd = array(
                    'name'	=> 'userPwd',
                    'type'	=> 'password',
                    'value'     => $Pwdvalue,
                    'class'     =>'form-control',
                    'placeholder'=>'User Password',
                    'required'=>'required'
                    );
                    echo form_input($Pwd);
                    ?>
              </div>
              
                <div class="form-group">
                <?php 
                echo form_dropdown('userGroup', $userGorup,$ur_Id,  'class="form-control" id="my_id"');
                ?>
              </div>
                <div class="form-group">
                   <input type="text" name="emp" class="form-control" id="empname">
                    <input type="hidden" name="emp" id="emp_id">
                </div>
                
                <?php 
                if(@$dbUserInfo):
                     
                echo '<div class="form-group">';
                $status = array(
                    '0'=>'Lock',
                    '1'=>'UnLock'
                    );
                echo form_dropdown('ur_status',$status,$stausId,  'class="form-control" id="my_id"');
                echo '</div>';
                endif;
            
                ?>
              
              <!--//form-group-->
              <input type="hidden" name="user_id" value="<?php echo $user_Id;?>">
              <div class="form-group">
                <button type="submit" name="addGroup" value="addGroup" class="btn btn-theme">
                    <i class="fa fa-plus"></i> <?php echo $btn?>
                </button>
              </div>
               
             
              <!--//form-group-->
                
               
            </div>
          </div>

         <?php echo form_close(); ?>     
            <?php
            if($dbUser):
            ?>
            <h3 class="has-divider text-highlight">Result :<?php echo count($dbUser)?></h3>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                  <th >S.no</th>
                  <th >Database User</th>
                    <th>Group Name</th>
                    <th>Employee Name</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Manage</th>
                  
                  
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach($dbUser as $urRow):
                       if($urRow->user_status){$status="<a href='javascript:void(0)' class='groupId' id='".$urRow->id.",".$urRow->user_status."'><span class='fa fa-unlock text-navy'></span></a>";}else{$status="<a href='javascript:void(0)' class='productstatus' id='".$urRow->id.",".$urRow->user_status."'><span class='fa fa-unlock-alt danger'></span></a>";}
                      echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$urRow->email.'</td>
                                <td>'.$urRow->ur_name.'</td>
                                <td>'.$urRow->emp_name.'</td>
                                <td>'.$urRow->user_date.'</td>
                                <td>'.$status.'</td>
                                <td><a href="dbUser/'.$urRow->id.'" class="productstatus" ><span class="fa fa-book text-navy"></span></a></td>
                               
                              </tr>';
                   $sn++;
                  endforeach;
                ?>
                
              </tbody>
            </table>
            <?php
            else:
                echo '<h3 class="has-divider text-highlight">No query found..</h3>';
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
 
 