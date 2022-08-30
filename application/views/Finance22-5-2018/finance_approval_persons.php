
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?=$page_heading?>
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
          <li class="current"><?=$page_heading?>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">                            
          <?php echo form_open('',array('class'=>'form-inline')); ?>
            <div class="row">
            <div class="col-md-12">
              
             
                <?php
 
             
                if(@$update_row):
                    $Designation    = $update_row->designation;
                    $name           =  $update_row->name;
                    $order          =  $update_row->appr_order;
                     $fy_id         = $update_row->id;
                    $status = $update_row->status; 
                    $SubmName   = 'updateCOA'; 
                    $btn        = 'Update';
                    $icon       = 'refresh';

                    else:
                    $SubmName   = 'AddCOA';   
                    $Designation       = '';
                    $name       = '';
                    $end        = '';
                    $order        = '';
                   $fy_id  = '';
                    $btn        = 'Add';
                    $status      = '';
                    $icon        = 'plus';
   
                endif;
                ?>
            <div class="form-group ">   
                <?php
                    
                echo form_input(array(
                    'name'          => 'designation',
                    'value'         => $Designation,
                    'class'         =>'form-control',
                    'placeholder'   =>'Designation',
                    'required'      =>'required',

                    'type'          =>'text'
                    ));
                    ?>
              </div>
            <div class="form-group ">   
                <?php
                    
                    echo form_input(array(
                    'name'          => 'name',
                    'value'         => $name,
                    'class'         =>'form-control',
                    'placeholder'   =>'Person Name',
                    'required'      =>'required'
                    ));
                    ?>
              </div>
            <div class="form-group ">   
                <?php
                    
                    echo form_input(array(
                    'name'          => 'order',
                    'value'         => $order,
                    'class'         =>'form-control ',
                    'placeholder'   =>'Person Order',
                    'required'   =>'required',
                    
                    ));
                    ?>
              </div>
                <?php 
                if(@$update_row):
                     
                echo '<div class="form-group">';
                $statusArray = array(
                    '0'=>'Deactive',
                    '1'=>'Active'
                    );
                echo form_dropdown('status',$statusArray,$status,  'class="form-control" id="my_id"');
                echo '</div>';
                endif;
            
                ?>
              
              <!--//form-group-->
              <input type="hidden" name="fy_id" value="<?php echo @$fy_id;?>">
              <div class="form-group">
                  <button type="submit" name="<?php echo $SubmName?>" value="<?php echo $SubmName?>"  class="btn btn-theme">
                    <i class="fa fa-<?php echo $icon?>"></i> <?php echo $btn?>
                </button>
              </div>
               
             
              <!--//form-group-->
                
               
            </div>
          </div>

         <?php echo form_close(); ?>     
            <?php
            if(@$fnYear):
            ?>
            <h3 class="has-divider text-highlight">Result :<?php echo count(@$fnYear)?></h3>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th >S.no</th>
                    <th>Designation</th>
                   <th>Name</th>
                   <th>Show Order</th>
                   <th>Status</th>
                    <th>Manage</th>
                  
                  
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach(@$fnYear as $urRow):
                       if($urRow->status){$status="<a><span class='btn btn-info btn-sm'>Active Year</span></a>";}else{$status="<a><span class='btn btn-theme btn-sm'>Deactive</span></a>";}
                      echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$urRow->designation.'</td>
                                <td>'.$urRow->name.'</td>
                                <td>'.$urRow->appr_order.'</td>
                               
                                <td>'.$status.'</td>
                                <td>
                                <a href="voucherApprovals/'.$urRow->id.'" class="productstatus" ><span class="btn btn-success btn-sm">EDIT</span></a> &nbsp;
                                <a href="VochApprDelete/'.$urRow->id.'" class="productstatus" ><span class="btn btn-danger btn-sm">DELETE</span></a>
                                    
                            </td>
                               
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