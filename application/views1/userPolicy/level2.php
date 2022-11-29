
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Menu Level II
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
          <li class="current">Menu Level First
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">        
             <div class="row">
                <div class="col-md-10 col-md-offset-1">
          <?php echo form_open('',array('class'=>'form-inline')); ?>
            <div class="row">
            <div class="col-md-12">
              
              
            <div class="form-group ">   
                <?php
                    echo form_input(array(
                    'name'          => 'userName',
                    'value'         =>$menuName,
                    'class'         =>'form-control',
                    'placeholder'   =>'Menu Name',
                    'required'      =>'required'
                    ));
                    ?>
              </div>
            <div class="form-group ">   
                <?php
                    echo form_input(array(
                    'name'          => 'function',
                    'value'         => $function,
                    'class'         => 'form-control',
                    'placeholder'   => 'Function Name',
                    'required'      => 'required'
                    ));
                    ?>
              </div>
            <div class="form-group ">   
                <?php
                    echo form_input(array(
                    'name'          => 'order',
                    'value'         => $order,
                    'class'         => 'form-control',
                    'placeholder'   => 'Function Order',
                    'required'      => 'required'
                    ));
                    ?>
              </div>
            
                <div class="form-group ">   
                <?php
                  
                    echo form_dropdown('menu1_id', $menu1, $menu1_id,  'class="form-control" required="required"');
                       
                  
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
            if($menuLeve12):
            ?>
           
                   <h3 class="has-divider text-highlight">Result :<?php echo count(@$menuLeve12)?></h3>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th >S.no</th>
                    <th>Level 2 Menu</th>
                    <th>Order</th>
                    <th>Function</th>
                     <th>Level 1 Menu</th>
                    <th>Manage</th>
                    
                  
                  
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach($menuLeve12 as $urRow):
                       
                      echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$urRow->m2_name.'</td>
                                <td>'.$urRow->m2_order.'</td>
                                <td>'.$urRow->m2_function.'</td>
                                <td>'.$urRow->m1_name.'</td>
                                
                                <td><a href="menuLevel2/'.$urRow->m2_id.'" class="productstatus" ><button  class="btn btn-primary btn-sm">Edit</button></a>&nbsp;&nbsp;&nbsp;'
                                 ?>
                                <a href="deleteM2/<?php echo $urRow->m2_id ?>" onclick="return confirm('Are You Sure to Delete This..?')" class="productstatus" ><button  class="btn btn-danger btn-sm">Delete</button></a>
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
 
 