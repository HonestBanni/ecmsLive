
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?php echo $page_header;?> 
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
          <li class="current"><?php echo $page_header;?> 
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
 
             
                if(@$coaResult):
                    $Code       = $coaResult->fn_coa_code;
                    $coaId      = $coaResult->fn_coaId;
                    $title      = $coaResult->fn_coa_title;
                    $comments   = $coaResult->fn_coa_commnet;
                    $status     = $coaResult->fn_coa_status;  
                    $SubmName   = 'updateCOA'; 
                    $btn        = 'Update';
                    $icon       = 'refresh';

                    else:
                    $SubmName   = 'AddCOA';   
                    $Code       = '';
                    $coaId       = '';
                    $title      = '';
                    $comments   = '';
                    $btn        = 'Add';
                    $status      = '';
                    $icon        = 'plus';
   
                endif;
                ?>
            <div class="form-group ">   
                <?php
                    
                echo form_input(array(
                    'name'          => 'code',
                    'value'         =>$Code,
                    'class'         =>'form-control',
                    'placeholder'   =>'Code',
                    'id'            =>'fn_coa_code',
                    'required'      =>'required',
                    'type'          =>'number'
                    ));
                    ?>
              </div>
            <div class="form-group ">   
                <?php
                    
                    echo form_input(array(
                    'name'          => 'title',
                    'value'         => $title,
                    'class'         =>'form-control',
                    'placeholder'   =>'Title',
                    'required'      =>'required'
                    ));
                    ?>
              </div>
            <div class="form-group ">   
                <?php
                    
                    echo form_input(array(
                    'name'          => 'comments',
                    'value'         => $comments,
                    'class'         =>'form-control',
                    'placeholder'   =>'Comments',
                    
                    ));
                    ?>
              </div>
                <?php 
                if(@$coaResult):
                     
                echo '<div class="form-group">';
                $statusArray = array(
                    '0'=>'Lock',
                    '1'=>'UnLock'
                    );
                echo form_dropdown('coa_status',$statusArray,$status,  'class="form-control" id="my_id"');
                echo '</div>';
                endif;
            
                ?>
              
              <!--//form-group-->
              <input type="hidden" name="coa_id" value="<?php echo @$coaId;?>">
              <input type="hidden" name="coa_id_type" value="<?php echo $coa_id_type;?>" id="coa_id_type">
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
            if(@$coa):
            ?>
            <h3 class="has-divider text-highlight">Result :<?php echo count(@$coa)?></h3>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th >S.no</th>
                    <th>Code</th>
                   <th>Title</th>
                   <th>Type</th>
                   <th>Comments</th>
                   <th>Status</th>
                    <th>Manage</th>
                  
                  
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach(@$coa as $urRow):
                       if($urRow->fn_coa_status){$status="<a href='javascript:void(0)' class='groupId' id='".$urRow->fn_coaId.",".$urRow->fn_coa_status."'><span class='fa fa-unlock text-navy'></span></a>";}else{$status="<a href='javascript:void(0)' class='productstatus' id='".$urRow->fn_coaId.",".$urRow->fn_coa_status."'><span class='fa fa-unlock-alt danger'></span></a>";}
                      echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$urRow->fn_coa_code.'</td>
                                <td>'.$urRow->fn_coa_title.'</td>
                                <td>'.$urRow->title.'</td>
                                <td>'.$urRow->fn_coa_commnet.'</td>
                                <td>'.$status.'</td>
                                <td>
                                <a href="ChartOfAccountGA/'.$urRow->fn_coaId.'" class="productstatus" ><span class="fa fa-book text-navy"></span></a> &nbsp;
                                <a href="delteCOAP/'.$urRow->fn_coaId.'" class="productstatus" ><span class="fa fa-trash text-danger"></span></a>
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
 
 