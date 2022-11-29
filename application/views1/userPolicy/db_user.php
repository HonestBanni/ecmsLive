
<style>
    .ui-autocomplete {
  z-index: 215000000 !important;
}
    
</style>

<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?php echo $page_header?></h1>
      <div class="breadcrumbs pull-right">
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-label">You are here:
          </li>
          <li> 
            <?php echo anchor('admin/admin_home', 'Home');?> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current"><?php echo $page_header?></li>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">  
                <section class="course-finder" style="padding-bottom: 2%;">
                    <h1 class="section-heading text-highlight">
                        <span class="line"><?php echo $page_header?> Search</span>
                    </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form'));?>
                            <div class="row">
                                <div class="col-md-2 col-sm-5">
                                    <label for="name">User name </label>
                                        <div class="input-group" id="adv-search">
                                            <?php
                                                 echo  form_input(
                                                         array(
                                                            'name'          => 'user_name',
                                                            'type'          => 'text',
                                                            'placeholder'   => 'User Name',
                                                            'value'         => $user_name,
                                                            'class'         => 'form-control',

                                                             )
                                                         );
                                            ?>
                                        </div>
                                </div>
                                 
                                <div class="col-md-2 col-sm-5">
                                    <label for="name">Group</label>
                                        <div class="input-group" id="adv-search">
                                            <?php
                                            
                                            echo form_dropdown('group_name', $userGorup,$group_name,  array('class'=>'form-control'));
                                            
                                                 
                                            ?>
                                        </div>
                                            
                                </div>
                                <div class="col-md-5 col-sm-5">
                                    <label for="name">Employee Name</label>
                                         
                                                <?php
//                                                  echo form_dropdown('group_name', $userGorup,'',  array('class'=>'form-control'));
                                                     echo  form_input(
                                                             array(
                                                                'name'          => 'employee_name', 
                                                                'id'            => 'EmployeeNameAtuo',
                                                                'type'          => 'text',
                                                                'value'         => $employee_name,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Employee Name',
                                                                
                                                                 )
                                                             );
                                                     
                                                      ?>
                                        
                                </div>
                                 
                            </div>
                        </div><!--//section-content-->
                        <div style="padding-top:1%;">
                            <div class="col-md-3 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="Search"   id="Search"  value="Search" ><i class="fa fa-search"></i> Search</button>
                                    <button type="button" class="btn btn-theme" name="add"      id="Add"     value="Add" data-toggle="modal" data-target="#dbUsers" ><i class="fa fa-plus"></i> Add User</button>
                                      
                            </div>
                        </div>
                            <?php echo form_close(); ?>
                    </section>
            
            
               
            <?php
            if(@$dbUser):
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
                  if($dbUser):
                      
                  
                   foreach($dbUser as $urRow):
                       if($urRow->user_status){$status="<a href='javascript:void(0)' class='groupId' id='".$urRow->id.",".$urRow->user_status."'><span class='fa fa-unlock text-navy'></span></a>";}else{$status="<a href='javascript:void(0)' class='productstatus' id='".$urRow->id.",".$urRow->user_status."'><span class='fa fa-unlock-alt danger'></span></a>";}
                      echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$urRow->email.'</td>
                                <td>'.$urRow->ur_name.'</td>
                                <td>'.$urRow->emp_name.'</td>
                                <td>'.$urRow->user_date.'</td>
                                <td>'.$status.'</td>';
                                
                                echo '<td><a id="'.$urRow->id.'" class="btn btn-theme updateUsers" data-toggle="modal" data-target="#updateUsers"  ><span class="fa fa-book text-navy">&nbsp; EDIT</span></a></td>';
                                
                               
                              echo '</tr>';
                   $sn++;
                  endforeach;
                  endif;
                ?>
                
              </tbody>
            </table>
            <?php
//            else:
//                echo '<h3 class="has-divider text-highlight">No query found..</h3>';
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

 <!--Insert Database Users updateUsers -->

 
             
              <div class="modal fade" id="dbUsers" tabindex="-1" role="dialog" aria-labelledby="Database Users">
                    <div class="modal-dialog" role="document">
                          <?php echo form_open('',array('class'=>'course-finder-form','id'=>'add_users_form'));?>    
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Database Users</h4>
                        </div>
                          
                        <div class="modal-body">
                            
                          
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="col-md-12 col-sm-5">
                                            <label for="name">User Name</label>
                                            <input type="text" name="name" value="" id="name" class="form-control" placeholder="User Name">

                                        </div>

                                         <div class="col-md-12 col-sm-5">
                                            <label for="name">Password</label>
                                            <input type="text" name="password"  id="password" class="form-control" placeholder="Password ">

                                        </div>


                                        <div class="col-md-12 col-sm-5">
                                            <label for="name">Group</label>
                                           <?php
                                           
                                            echo form_dropdown('userGroup', $userGorup,'',  array('class'=>'form-control'));
                                           ?>

                                        </div>
                                        <div class="col-md-12 col-sm-5">
                                            <label for="name">Employee Name</label>
                                            <input type="text" name="empname" class="form-control" id="empname" placeholder="Enter Employee Name">
                                            <input type="hidden" name="emp_id" id="emp_id">

                                        </div>

                                  <!--//form-group-->


                                </div>
                                <div class="col-md-8" style="margin-left: 21px;">
                                    <div id="error_message" >

                                    </div>
                                </div>
                            </div>

                           
                            </div>
                            <div class="modal-footer">
                            <button type="button" name="insert_user"    value="insert_user" id="insert_user" class="btn btn-theme" >Save User</button>
                            <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
                            </div>
                          
                      </div>
                         <?php echo form_close(); ?>
                    </div>
                  </div>
 
 
 <!--Update user database-->
                <div class="modal fade" id="updateUsers" tabindex="-1" role="dialog" aria-labelledby="Database Users">
                    <div class="modal-dialog" role="document">
                          <?php echo form_open('UserUpdate',array('class'=>'course-finder-form','id'=>'update_users_form'));?>    
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Update Database Users</h4>
                        </div>
                          
                        <div class="modal-body">
                            <div id="userUpdateShow">
                                
                            </div>
                                    
                              
                            </div>
                            <div class="modal-footer">
                            <button type="button" name="update_user"    value="update_user" id="update_user" class="btn btn-theme" >Update User</button>
                            <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
                            </div>
                          
                      </div>
                         <?php echo form_close(); ?>
                    </div>
                  </div>

           
  
  
<script type="text/javascript">

  
  
  jQuery(document).ready(function(){

      jQuery('#insert_user').on('click',function(){
            jQuery.ajax({
                type:'post',
                url : 'UserCreateChk',
                data: jQuery('#add_users_form').serialize(),
                success:function(result){
            
                        if(result === '1'){
                            alert('Username already exists');
                            jQuery('#name').val('');
                        }
                        if(result === '2'){
                            jQuery.ajax({
                                type:'post',
                                url : 'UserCreate',
                                data: jQuery('#add_users_form').serialize(),
                                success:function(result){
                                  jQuery('#error_message').show();
                                  jQuery('#error_message').html(result);
                                  if(result == true){
                                      window.location.reload();
                                  }}
                                });
                        }

                }

                   }); 

            
      });
      
      jQuery('#update_user').on('click',function(){
          
           jQuery.ajax({
                    type:'post',
                    url : 'UserUpdate',
                    data: jQuery('#update_users_form').serialize(),
                    success:function(result){
                       
                      jQuery('#up_error_message').html(result);
                       window.location.reload();
                      
                    }

                   });
            
      });
      
      
      jQuery('.updateUsers').on('click',function(){
          var user_id = this.id;
           
           jQuery.ajax({
                    type:'post',
                    url : 'UserInfo',
                    data: {'user_id':user_id},
                    success:function(result){
//                      jQuery('#error_message').show();
                      jQuery('#userUpdateShow').html(result);
                       
                      
                    }

                   });
            
      });
      
      
  });
  
  </script>
      