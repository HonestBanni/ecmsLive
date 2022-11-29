
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">User Role
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
          <li class="current">User Role
          </li>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">                            
          <?php echo form_open('userRoleCreate',array('class'=>'form-inline')); ?>
            <div class="row">
            <div class="col-md-12">
              
              <div class="form-group ">
                <?php
                $value = '';
                $ur_Id = '';
                if(@$userInfo):
                    $value = $userInfo->ur_name;
                    $ur_Id = $userInfo->ur_id;
                    else:
                    $value = '';
                    $usrId = '';
                        
                endif;
                    $student_id = array(
                    'name'	=> 'groupName',
                    'value'     =>$value,
                    'class'     =>'form-control',
                    'placeholder'=>'Group Name',
                    'required'=>'required'
                    );
                    echo form_input($student_id);
                    ?>
              </div>
              <!--//form-group-->
              <input type="hidden" name="ur_id" value="<?php echo $ur_Id;?>">
              <div class="form-group">
                <button type="submit" name="addGroup" value="addGroup" class="btn btn-theme">
                    <i class="fa fa-plus">
                  </i> Create Group
                </button>
              </div>
               
             
              <!--//form-group-->
               
            </div>
          </div>

         <?php echo form_close(); ?>     
            <?php
            if($userRole):
            ?>
            <h3 class="has-divider text-highlight">Result :<?php echo count($userRole)?></h3>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                  <th >S.no</th>
               
                  <th>Group Name</th>
                  <th>Status</th>
                  <th>Update</th>
                  <th>Menu Setting</th>
                  <th>Sub Menu Setting</th>
                  
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach($userRole as $urRow):
                       if($urRow->ur_status){$status="<a href='javascript:void(0)' class='groupId' id='".$urRow->ur_status.",".$urRow->ur_status."'><span class='fa fa-unlock text-navy'></span></a>";}else{$status="<a href='javascript:void(0)' class='productstatus' id='".$urRow->ur_status.",".$urRow->ur_status."'><span class='fa fa-unlock-alt danger'></span></a>";}
                      echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$urRow->ur_name.'</td>
                                 <td>'.$status.'</td>
                                <td><a href="userRole/'.$urRow->ur_id.'" class="productstatus" ><span class="fa fa-book text-navy"></span></a></td>
                                <td><a href="MenuSetting/'.$urRow->ur_id.'" class="productstatus" ><span class="fa fa-stack-exchange"></span></a></td>
                                <td><a href="SMenuSetting/'.$urRow->ur_id.'" class="productstatus" ><span class="fa fa-stack-exchange"></span></a></td>
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
 
 