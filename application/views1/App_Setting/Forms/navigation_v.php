
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Navigation
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
          <li class="current">Navigation
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">        
             <div class="row">
                <div class="col-md-8 col-md-offset-2">
          <?php echo form_open('',array('class'=>'form-inline')); ?>
            <div class="row">
            <div class="col-md-12">
              
             
                <?php
                     $menuName      = '';
                     $level_Id      = '';
                     $btn           = 'Add Menu';
                    
             
                if(@$level1Menu):
                    $menuName       = $level1Menu->m1_name;
                     $level_Id       = $level1Menu->m1_id;
                  //  @$m1_Id         = $menuLeve1->m1_id;
//                    $btn        = 'Update User';
//                    $Pwdvalue   = $menuLeve1->password;
//                    $stausId    = $menuLeve1->user_status;
//                    else:
                     @$value      = '';
                    @$user_Id    = '';
                     @$m1_Id      = '';
                    $btn        = 'Update Menu';
//                    $Pwdvalue   = '';
//                    $stausId    = '';    
                endif;
                ?>
            <div class="form-group ">   
                <?php
                    $student_id = array(
                    'name'          => 'userName',
                    'value'         =>$menuName,
                    'class'         =>'form-control',
                    'placeholder'   =>'User Name',
                    'required'      =>'required'
                    );
                    echo form_input($student_id);
                    ?>
              </div>
                
                 
              
                
              
              
              <!--//form-group-->
              <input type="hidden" name="level_id" value="<?php   echo $level_Id;?>">
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
            if($menuLeve1):
            ?>
           
                   <h3 class="has-divider text-highlight">Result :<?php echo count(@$menuLeve1)?></h3>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th >S.no</th>
                    <th>Menu Name</th>
                    
                    <th>Manage</th>
                    
                  
                  
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach($menuLeve1 as $urRow):
                       
                      echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$urRow->m1_name.'</td>
                                
                                <td><a href="Navigation/'.$urRow->m1_id.'" class="productstatus" ><button  class="btn btn-primary btn-sm">Edit</button></a>&nbsp;&nbsp;&nbsp;';
                                   ?>
                                <a href="DelNav/<?php echo $urRow->m1_id ?>" onclick="return confirm('Are You Sure to Delete This..?')" class="productstatus" ><button  class="btn btn-danger btn-sm">Delete</button></a>
                            <?php
                               
                                echo '</td>
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
                </div>
            </div>
            
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
 
 