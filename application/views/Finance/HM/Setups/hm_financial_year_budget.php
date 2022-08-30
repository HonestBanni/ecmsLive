
<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left"><?php echo $page_header?> </h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current"><?php echo $page_header?></li>
                    </ul>
                </div>
     
    </header> 
    
        
        
        
        <div class="page-content">
            <div class="col-md-12">
                <section class="course-finder" style="padding-bottom: 2%;">
                    <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?>  Form</span>
                    </h1>
                    <div class="section-content" >
                        <div class="row">
                               <?=form_open('',array('class'=>'course-finder-form'))?>
                                 <input type="hidden" name="formCode" id="formCode" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date);?>">
                                   
                                   
                                    <div class="col-md-2 col-sm-5">
                                            <label for="name">Financial Year</label>
                                              <?php 
                                                 $class = array(
                                                'info',
                                                'success',
                                                'danger',
                                                'warning',
                                                'active',
                                            );
                                                   echo form_dropdown('financial',$financialYear,'',  'class="form-control" required="required" id="fy_year" ');

                                           ?>

                                    </div>
                               
                                 <div class="row">
                                     <div class="col-md-12">
                                          <div class="col-md-9 col-sm-5 ">
                                          <label for="name">Comments #</label>
                                          <textarea class="form-control" rows="3" name="comments" id="comments" ></textarea>
                                            
                                       
                                     </div>  
                                     </div>
                                   
                                 </div>
                                 <br/> 
                                  
                                 <div class="row">
                                     <div class="col-md-12">
                                   
                                        <div class="col-md-4 col-sm-5">
                                                 <label for="name">Account :</label>

                                                     <div class="input-group" id="adv-search">
                                                        <?php
                                                            echo    form_input(
                                                                     array(
                                                                             'name'          => 'amountName',
                                                                             'value'         => '',
                                                                             'id'            => 'hmamount',
                                                                             'class'         => 'form-control inputSize',
                                                                             'placeholder'   => 'Account',
                                                                             'style'        => 'z-index: 1',
                                                                         )
                                                                     );
                                                              ?>
                                                         <?php
                                                            echo form_input(
                                                                  array(
                                                                          'name'          => 'amount',
                                                                          'value'         => '',
                                                                          'id'            => 'hmamountId',
                                                                          'type'          => 'hidden',
                                                                          'class'         => 'form-control inputSize',
                                                                          'placeholder'   => 'Account',
                                                                          )
                                                                  );
                                                          ?>
                                                         <?php
                                                            echo form_input(
                                                                  array(
                                                                          'name'          => 'code_id',
                                                                          'id'            => 'hmcode_id',
                                                                          'type'          => 'hidden',
                                                                          'class'         => 'form-control inputSize',
                                                                          'placeholder'   => 'Account',
                                                                          )
                                                                  );
                                                          ?>

                                                        <div class="input-group-btn">
                                                            <div class="btn-group" role="group">
                                                                <div class="dropdown dropdown-lg">

                                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="modal" data-target="#myModal" aria-expanded="false"><span class="caret"></span></button>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="myModal" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">

                                                         
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                              <h4 class="modal-title">Chart Of Account</h4>
                                                            </div>

                                                            <div class="modal-body">
                                                                    <div class="table-responsive">  

                                                                            <table  id="table" class="table table-hover">


                                                                                    <?php

                                                                                    if($COAP):
                                                                                        foreach($COAP as $coapRow):

                                                                                            echo '<tr class="first ">
                                                                                                 <td>&nbsp;</td>
                                                                                                    <td>'.$coapRow->fn_coa_code.'</td>
                                                                                                    <td>'.$coapRow->fn_coa_title.'</td>

                                                                                                </tr>';
                                                                                                    $coac = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_status'=>1,'fn_coa_m_pId'=>$coapRow->fn_coaId,'fn_account_type_id'=>2));
                                                                                                    foreach($coac as $coacRow):
                                                                                                      $k = array_rand($class); 
                                                                                                         echo '<tr class="2nd">
                                                                                                              <td>&nbsp;</td>
                                                                                                                <td> '.$coacRow->fn_coa_m_code.'</td>

                                                                                                                <td> &nbsp;&nbsp; &nbsp; &nbsp;'.$coacRow->fn_coa_m_title.'</td>


                                                                                                            </tr>';
                                                                                                    $coacs = $this->CRUDModel->get_where_result('fn_coa_master_sub_child',array('fn_coa_mc_status'=>1,'fn_coa_mc_mId'=>$coacRow->fn_coa_m_cId));

                                                                                                            foreach($coacs as $coacsRow):

                                                                                                                 echo ' <tr class="3rdhm '.$class[$k].'" id="'.$coacsRow->fn_coa_mc_title.','.$coacsRow->fn_coa_mc_id.','.$coacsRow->fn_coa_mc_code.'">
                                                                                                                            <td>&nbsp;</td>
                                                                                                                            <td>'.$coacsRow->fn_coa_mc_code.'</td>

                                                                                                                            <td>&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;'.$coacsRow->fn_coa_mc_title.'</td>


                                                                                                                        </tr>';

                                                                                                            endforeach;
                                                                                                    endforeach;
                                                                                                endforeach;
                                                                                    endif;
                                                                                    ?>

                                                                            </table>
                                                                        </div>
                                                                <ul class="job-list custom-list-style">
                                                              <?php 
                                                                if($COAP ==1):
                                                                    foreach($COAP as $coapRow):
                                                                        echo ' <li><i class="fa fa-caret-right"></i><a href="javascript:vodi(0) id='.$coapRow->fn_coa_code.'">'.$coapRow->fn_coa_title.'</a></li>';
                                                                            $coac = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_status'=>1,'fn_coa_m_pId'=>$coapRow->fn_coaId));
                                                                            echo '<ul class="job-list custom-list-style">';
                                                                                foreach($coac as $coacRow):
                                                                                     echo ' <li><i class="fa fa-caret-right"></i><a href="javascript:vodi(0) id='.$coacRow->fn_coa_m_code.'">'.$coacRow->fn_coa_m_title.'</a></li>';
                                                                                        $coacs = $this->CRUDModel->get_where_result('fn_coa_master_sub_child',array('fn_coa_mc_status'=>1,'fn_coa_mc_mId'=>$coacRow->fn_coa_m_cId));
                                                                                        echo '<ul class="job-list custom-list-style">';
                                                                                            foreach($coacs as $coacsRow):
                                                                                                 echo ' <li><i class="fa fa-caret-right"></i><a href="javascript:vodi(0) id='.$coacsRow->fn_coa_mc_code.'">'.$coacsRow->fn_coa_mc_title.'</a></li>';
                                                                                            endforeach;
                                                                                    echo ' </ul>';
                                                                                endforeach;
                                                                            echo ' </ul>';
                                                                    endforeach;
                                                                endif;

                                                              ?>
                                                                    </ul>



                                                            </div>
                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                          </div>

                                                        </div>
                                                    </div>






                                    </div>

                                        <div class="col-md-2 col-sm-5">
                                                 <label for="name">Budget :</label>
                                          <?php
                                        echo form_input(array(
                                        'name'          => 'budget',
                                        'id'            => 'budget',
                                        'type'          => 'number',
                                        'value'         => '',
                                        'class'         =>'form-control inputSize',
                                        'placeholder'   =>'Budget',
                                        ));
                                    ?>


                                        </div>
                                         

                                    </div> 
                                   <div class="row">
                                       <div class="col-md-12">
                                           
                                       
                                        <div style="padding-top: 2%;padding-left: 2%;">
                                        <div class="col-md-4 pull-right">

                                                <button type="button" class="btn btn-theme" name="add_fy_bgt" id="hmadd_fy_bgt"  value="update" ><i class="fa fa-plus"></i> Add</button>

                                                <button type="submit" class="btn btn-theme"  id="save_fy_bgt"><i class="fa fa-download"></i> Save</button>

                                                <button type="button" class="btn btn-theme"><i class="fa fa-refresh"></i> Cancel</button>

                                        </div>
                                    </div>
                                           </div>
                                       </div>
                                     
                                    <div class="col-md-2 col-sm-5">
                                                  

                                            <?php
                                        echo form_input(array(
                                        'name'          => 'print_value2',
                                        'id'            => 'print_value2',
                                        'type'          => 'hidden',
                                        'value'         => '',
                                        'class'         =>'form-control inputSize',
                                  
                                        ));
                                    ?>
                                      </div> 
                                     
                          </div>
                                <?=form_close()?>
                        </div>
                    </div>
                </section>
                <div class="panel panel-theme">
                    <div class="panel-heading">
                        <h3 class="panel-title">Transitions</h3>
                    </div>
                    <div class="panel-body">
                           <div id="showFyBudget">


                        </div> 

                    </div>
                </div>
                
                
                  <table class="table table-boxed table-hover">
              <thead>
                <tr>
                   
                    <th>COA Code</th>
                    <th>Account</th>
                    <th>Year</th>
                   
                   <th>budget</th>
                  
                  
                </tr>
              </thead>
              <tbody>
                  
                  <?php
                  if($fnYearBduget):
                      
 
                      foreach($fnYearBduget as $amiRow):
                      $k = array_rand($class); 
                      
                      echo ' <tr class="'.$class[$k].'">
                                <td>'.$amiRow->fn_coa_mc_code.'</td>
                                <td>'.$amiRow->fn_coa_mc_title.'</td>
                                <td>'.$amiRow->year.'</td>
                                <td>'.$amiRow->budget.'</td>
                               </tr> ';
                      endforeach;
                  endif;
                  ?>
                                  
              </tbody>
            </table>
            </div>
        </div>
        
         
          </div>
          
      
      </div>
  
  <script>
  
     jQuery('#table .3rdhm').dblclick(function () {
       
       var  mcId = this.id;
       var  mcClass = jQuery(this).prop("classList");
      
       var  array = mcId.split(',');
       
        jQuery('#myModal').modal('toggle');
        jQuery('#hmamount').val(array[0]);
        jQuery('#hmamountId').val(array[2]);
        jQuery('#hmcode_id').val(array[1]);
 
});
  
  
  </script>