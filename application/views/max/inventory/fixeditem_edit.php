 
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?php echo $page_headers?>
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
          <li class="current"><?php echo $page_headers?>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_headers?></span>
                        </h1>
                        <div class="section-content" >
                           
                                <div class="row">
                                      <?php echo form_open('',array('class'=>'form-inline course-finder-form','name'=>'reportForm'));   ?>
                                    <div class="col-md-12">
                                             <div class="form-group ">   
                                        <?php
                                            echo form_input(array(
                                                'name'          => 'emp_id',
                                                'id'            => 'emp_id',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Employee name',
                                                'type'          => 'text'
                                                ));
                                            echo form_input(array(
                                                'name'          => 'emp_idCode',
                                                'id'            => 'emp_idCode',
                                                'class'         => 'form-control',

                                                'type'          => 'hidden'
                                                ));?>

                                      </div>
                                        <div class="form-group">

                                                <?php
                                                   echo form_input(array(
                                                  'name'          => 'blockName',
                                                  'id'            => 'blockName',
                                                  'value'         => '',
                                                  'class'         => 'form-control',
                                                  'placeholder'   => 'Block name',
                                                  'type'          => 'text',
                                                  ));

                                                   echo form_input(array(
                                                  'name'          => 'blockNameId',
                                                  'id'            => 'blockNameId',
                                                  'value'         => '',
                                                  'class'         => 'form-control',
                                                 'type'          => 'hidden',
                                                  ));
                                              ?>



                                           </div>
                                        <div class="form-group">

                                                <?php
                                                   echo form_input(array(
                                                  'name'          => 'roomname',
                                                  'id'            => 'roomname',
                                                
                                                  'class'         => 'form-control',
                                                  'placeholder'   => 'Room name',
                                                  'type'          => 'text',
                                                  ));

                                                   echo form_input(array(
                                                  'name'          => 'roomnameCode',
                                                  'id'            => 'roomnameCode',
                                                   
                                                  'class'         => 'form-control',
                                                 'type'          => 'hidden',
                                                  ));
                                              ?>



                                           </div>

                                        <div class="form-group">

                                                <?php
                                                 echo   form_input(array(
                                                  'name'          => 'itemname',
                                                  'id'            => 'itemname',
                                                  'value'         => '',
                                                  'class'         => 'form-control',
                                                  'placeholder'   => 'Item name',
                                                  'type'          => 'text',
                                                  ));

                                                echo   form_input(array(
                                                  'name'          => 'itemnameCode',
                                                  'id'            => 'itemnameCode',
                                                  'value'         => '',
                                                  'class'         => 'form-control',
                                                 'type'          => 'hidden',
                                                  ));
                                              ?>



                                           </div>

                                            <div class="form-group ">

                                                  <?php
                                                     form_input(array(
                                                    'name'          => 'roomname',
                                                    'id'            => 'roomname',
                                                    'value'         => '',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Room',
                                                    'type'          => 'text',
                                                    ));

                                                     form_input(array(
                                                    'name'          => 'roomnameCode',
                                                    'id'            => 'roomnameCode',
                                                    'value'         => '',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Room',
                                                    'type'          => 'hidden',
                                                    ));
                                                ?>



                                             </div>
                                        <div class="form-group">
                                          <button type="button" name="search" value="search" id="searchEdit" class="btn btn-theme"><i class="fa fa-search"></i> Search </button>
                                          
                                         
                                      </div>
                                    </div>  
                                     
                                </div>
                            
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                             
                         </div><!--//section-content-->
                        
                        
                    </section>
          
       
             
          </div>
 
        <div id="reportResult">
            
            
            
        </div>
        
          
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 