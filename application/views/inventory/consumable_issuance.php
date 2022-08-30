
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Consumable Items Panel
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
          <li class="current">Consumable Items Panel
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
           <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Consumable Items Panel</span>
                        </h1>
                        <div class="section-content" >
                           
                                <div class="row">
                                      <?php echo form_open('',array('class'=>'course-finder-form'));
                                
                                     ?>
                                     <div class="col-md-4 col-sm-5">
                                         <label for="name">Employee name</label>
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
                                                    ));
                                            ?>
                                     
                                     </div>
                                    <div class="col-md-3 col-sm-5 col-md-offset-4">
                                          <label for="name">Date</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'date',
                                                'id'            => 'issuedate',
                                                'type'          => 'date',
                                                'value'         => date('Y-m-d'),
                                                'class'         =>'form-control',

                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                </div>
                            <br>
                            <div class="row">
                                    <div class="col-md-3 col-sm-5">
                                          <label for="name">Item name</label>
                                          <?php
                                            echo form_input(array(
                                            'name'          => 'itemname',
                                            'id'            => 'itemname',
                                            'value'         => '',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Item name',
                                            'type'          => 'text',
                                            ));
                                           
                                            echo form_input(array(
                                            'name'          => 'itemnameCode',
                                            'id'            => 'itemnameCode',
                                            'value'         => '',
                                            'class'         => 'form-control',
                                           'type'          => 'hidden',
                                            ));
                                        ?>
                                        
                                         
                                        
                                     </div>
                                    <div class="col-md-3 col-sm-5">
                                          <label for="name">Room</label>
                                          <?php
                                            echo form_input(array(
                                            'name'          => 'roomname',
                                            'id'            => 'roomname',
                                            'value'         => '',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Room',
                                            'type'          => 'text',
                                            ));
                                            
                                            echo form_input(array(
                                            'name'          => 'roomnameCode',
                                            'id'            => 'roomnameCode',
                                            'value'         => '',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Room',
                                            'type'          => 'hidden',
                                            ));
                                        ?>
                                        
                                         
                                        
                                     </div>
                                    <div class="col-md-3 col-sm-5">
                                          <label for="name">Quantity</label>
                                          <?php
                                            echo form_input(array(
                                            'name'          => 'quantity',
                                            'id'            => 'quantity',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Quantity',
                                            'type'          => 'text',
                                            ));
                                        ?>
                                     </div>
                                  </div>
                            <input type="hidden" name="formCode" id="formCode" value="<?php $rand = rand(1,10000000); $date = date('YmdHis');
                            echo md5($rand.$date);
                            
                            ?>">
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            <div style="padding-top: 2%;padding-left: 2%;">
                                <div class="col-md-4 pull-right">
                                  
                                        <button type="button" class="btn btn-theme" name="updateInvt" id="updateInvt"  value="updateInvt" ><i class="fa fa-plus"></i> Update</button>
                                   
                                        
                                        <button type="button" class="btn btn-theme"  id="saveIssues"><i class="fa fa-book"></i> Save</button>
                                    
                                        <button type="button" class="btn btn-theme"><i class="fa fa-crop"></i> Cancel</button>
                                    
                                </div>
                            </div>
                         </div><!--//section-content-->
                        
                        
                    </section>
              <div class="panel panel-theme">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Transitions</h3>
                                        </div>
                                        <div class="panel-body">
                                               <div id="showFixItemRecord">
                                                   
                    
                                            </div> 
                                    
                                        </div>
                                    </div>
          <article class="contact-form col-md-12 col-sm-7">
                
                
                
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
 
 