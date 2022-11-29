
<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left">Amount Transition</h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current">Amount Transition</li>
                    </ul>
                </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
        
        
        
        
        
      <div class="row">
          <div class="col-md-12">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Amount Transition</span>
                        </h1>
                        <div class="section-content" >
                           
                                <div class="row">
                                      <?php 
                                      
                                              $class = array(
                                                'info',
                                                'success',
                                                'danger',
                                                'warning',
                                                'active',
                                            );

                             
                                      
                                      echo form_open('',array('class'=>'course-finder-form'));
                                      if(@$coaResult):
                                            $Code       = $coaResult->fn_coa_m_code;
                                            $coa_mId    = $coaResult->fn_coa_m_cId;
                                            $coaId      = $coaResult->fn_coa_m_pId;
                                            $title      = $coaResult->fn_coa_m_title;
                                            $comments   = $coaResult->fn_coa_m_comments;
                                            $status     = $coaResult->fn_coa_m_status;  
                                            $SubmName   = 'updateCOA'; 
                                            $btn        = 'Update';
                                            $icon       = 'refresh';
                                            $date       = '';   

                                            else:
                                          
                                            $SubmName   = 'AddCOA';   
                                            $Code       = '';
                                            $coaId      = '';
                                            $title      = '';
                                            $comments   = '';
                                            $btn        = 'Add';
                                            $status     = '';
                                            $icon       = 'plus';

                                        endif;
                                     ?>
                                    <input type="hidden" name="formCode" id="formCode" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date);?>">
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Cheque</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'cheque',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Cheque *',
                                                    'id'            => 'cheque',
                                                
                                                    'type'          => 'text'
                                                    ));
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">Date</label>
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'date',
                                                'id'            => 'amountdate',
                                            
                                                'type'          => 'text',
                                                'value'         =>  date('d-m-Y'),
                                                'class'         =>'form-control datepicker',

                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                          <label for="name">Voucher</label>
                                          <?php
                                            echo form_input(array(
                                            'name'          => 'Voucher',
                                            'id'            => 'voucher',
                                            'value'         => $vocherId,
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Voucher',
                                            'type'          => 'number',
                                            ));
                                        ?>
                                        
                                         
                                        
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">JB/JV #</label>
                                           <?php 
                                                
//                                                $statusArray = array(
//                                                    '1'=>'CB',
//                                                    '2'=>'JV'
//                                                    );
                                                echo form_dropdown('jbJv',$stt,1,  'class="form-control" id="jbJv"');
                                                
                                        ?>
                                        
                                     </div>
                                     
                                    <div class="col-md-3 col-sm-5">
                                         <label for="name">Payee :</label>
                                            <?php
                                                form_input(array(
                                                  'name'          => 'payee',
                                                  'id'            => 'payee',
                                                  'value'         => '',
                                                  'class'         =>'form-control',
                                                  'placeholder'   =>'Payee ',
                                                  ));
                                          ?>
                                          <?php
                                              echo form_input(array(
                                                  'name'          => 'empId',
                                                  'id'            => 'empId',
                                                  'type'          => 'text',
                                                  'value'         => '',
                                                  'class'         =>'form-control',
                                                  'placeholder'   =>'Payee ',
                                                  ));
                                          ?>
                                         
                                     </div>
                                    
                                    <div class="col-md-9 col-sm-5">
                                          <label for="name">Description #</label>
                                          <textarea class="form-control" rows="3" name="description" id="description" ></textarea>
                                            
                                       
                                     </div>
                                    <div class="col-md-3 col-sm-5">
                                   
                                    
                        
                                </div>
                                     
                                </div>
                          
                                    <?php
                                    echo form_close();
                                    ?>
                                
                            <div class="row">
                                <div class="col-md-2 col-sm-5">
                                      <label for="name">Cost Center :</label>
                                  <?php
                                        echo form_input(array(
                                        'name'          => 'costCenter',
                                        'id'            => 'costCenter',
                                        'value'         => 'Admin',
                                        'class'         =>'form-control inputSize',
                                        'placeholder'   =>'Cost Center',
                                        'readonly'   =>'readonly',
                                        ));
                                    ?>
                                </div>
                                
                                <div class="col-md-2 col-sm-5">
                                    <label for="name">Supplier :</label>
                              
                                  <?php
                                        echo form_input(array(
                                        'name'          => 'Supplier',
                                        'id'            => 'supplier',
                                        'value'         => '',
                                        'class'         =>'form-control inputSize',
                                        'placeholder'   =>'Supplier',
                                        'readonly'   =>'readonly',
                                        ));
                                    ?>
                                    
                                   
                        
                                </div>
                                <div class="col-md-4 col-sm-5">
                                         <label for="name">Account :</label>
                                         
                                             <div class="input-group" id="adv-search">
                                                <?php
                                                    echo    form_input(
                                                             array(
                                                                     'name'          => 'amountName',
                                                                     'value'         => $comments,
                                                                     'id'            => 'amount',
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
                                                                  'value'         => $comments,
                                                                  'id'            => 'amountId',
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
                                                                  'id'            => 'code_id',
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

                                                  <!-- Modal content-->
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
                                                                                            $coac = $this->CRUDModel->get_where_result('fn_coa_master_child',array('fn_coa_m_status'=>1,'fn_coa_m_pId'=>$coapRow->fn_coaId));
                                                                                            foreach($coac as $coacRow):
                                                                                              $k = array_rand($class); 
                                                                                                 echo '<tr class="2nd">
                                                                                                      <td>&nbsp;</td>
                                                                                                        <td> '.$coacRow->fn_coa_m_code.'</td>
                                                                                                            
                                                                                                        <td> &nbsp;&nbsp; &nbsp; &nbsp;'.$coacRow->fn_coa_m_title.'</td>
                                                                                                             
                                                                                                        
                                                                                                    </tr>';
                                                                                            $coacs = $this->CRUDModel->get_where_result('fn_coa_master_sub_child',array('fn_coa_mc_status'=>1,'fn_coa_mc_mId'=>$coacRow->fn_coa_m_cId));
                                                                                                 
                                                                                                    foreach($coacs as $coacsRow):
                                                                                                           
                                                                                                         echo ' <tr class="3rd '.$class[$k].'" id="'.$coacsRow->fn_coa_mc_title.','.$coacsRow->fn_coa_mc_id.','.$coacsRow->fn_coa_mc_code.'">
                                                                                                                    <td>&nbsp;</td>
                                                                                                                    <td>'.$coacsRow->fn_coa_mc_code.'</td>
                                                                                                                  
                                                                                                                    <td>&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;'.$coacsRow->fn_coa_mc_title.'</td>
                                                                                                                               
                                                                                                                   
                                                                                                                </tr>';
                                                                                                         
                                                                                                    endforeach;
                                                                                            endforeach;
                                                                                        endforeach;
                                                                            endif;
                                                                            ?>
                                                                       
                                                                    </table><!--//table-->
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
                                         <label for="name">Debit :</label>
                                  <?php
                                echo form_input(array(
                                'name'          => 'Debit',
                                'id'            => 'debit',
                                'type'          => 'number',
                                'value'         => '',
                                'class'         =>'form-control inputSize',
                                'placeholder'   =>'Debit',
                                ));
                            ?>
                           
                        
                                </div>
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Credit :</label>
                                
                                    <?php
                                echo form_input(array(
                                'name'          => 'Credit',
                                'id'            => 'credit',
                                'type'          => 'number',
                                'value'         => '',
                                'class'         =>'form-control inputSize',
                                'placeholder'   =>'Credit',
                                ));
                            ?>
                              </div>
                                 
                                
                                
                                
                          </div>
                            <div style="padding-top: 2%;padding-left: 2%;">
                                <div class="col-md-4 pull-right">
                                  
                                        <button type="button" class="btn btn-theme" name="update" id="update"  value="update" ><i class="fa fa-plus"></i> Update</button>
                                   
                                        <button type="button" class="btn btn-theme"  id="saveTranst"><i class="fa fa-refresh"></i> Save</button>
                                    
                                        <button type="button" class="btn btn-theme"><i class="fa fa-crop"></i> Cancel</button>
                                    
                                </div>
                            </div>
                         </div><!--//section-content-->
                        
                        
                    </section>
             <?php
             $messge = $this->session->flashdata('account_message');
                if(!empty($messge)):
                    '<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong>Login ERROR !</strong> <br/>'.$this->session->flashdata('message').'
                                </div>'; 
                endif;
             ?> 
           
              <div class="panel panel-theme">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Transitions</h3>
                                        </div>
                                        <div class="panel-body">
                                               <div id="showTransitionRecord">
                    
                    
                                            </div> 
                                    
                                        </div>
                                    </div>
                   
              
              
              <table class="table table-boxed table-hover">
              <thead>
                <tr>
                   
                    <th>Vocher #</th>
                    <th>Date</th>
                   
                   <th>JV/CB</th>
                    <th>Payee</th>
                   <th>Description</th>
                  
                </tr>
              </thead>
              <tbody>
                  
                  <?php
                  if($AMI):
                      
//                        echo '<pre>';print_r($AMI);die;
                      foreach($AMI as $amiRow):
                      $k = array_rand($class); 
                        $cbjv = '';
                      if($amiRow->gl_at_cb_jv == 1):
                          $cbjv = 'CB';
                            else:
                            $cbjv = 'JV';
                        endif;
                      echo ' <tr class="'.$class[$k].'">
                              
                                <td>'.$amiRow->gl_at_vocher.'</td>
                               
                                <td>'.date('d-m-Y',  strtotime($amiRow->gl_at_date)).'</td>
                                <td>'.$cbjv.'</td>
                                <td>'.$amiRow->gl_at_payeeId.'</td>
                                <td>'.$amiRow->gl_at_description.'</td>
                               

                            </tr> ';
                      endforeach;
                  endif;
                  ?>
                                  
              </tbody>
            </table>
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
 
 
 
     <script>
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 3,
        dateFormat: 'd-m-yy'
    });
  } );
  </script>
  <style>
      .datepicker{
          z-index: 1;
      }
  </style>