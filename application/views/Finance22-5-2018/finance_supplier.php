
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Finance Supplier 
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
          <li class="current">Finance Supplier
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
 
             
                if(@$supp_row):
                    
                    $company_name       =$supp_row->company_name;
                    $propertier_name    =$supp_row->propertier_name;
                    $business_details   =$supp_row->business_details;
                    $address            =$supp_row->address;
                    $phone_no           =$supp_row->phone_no;
                    $ntn                =$supp_row->ntn;
                    $sale_tax_no        =$supp_row->sale_tax_no;
                    $fn_supp_id         =$supp_row->fn_supp_id;
                     
                    $submit_name          = 'update'; 
                    $btn                = 'Update';
                    $icon               = 'refresh';

                    else:
                    $submit_name          = 'add';   
                    $company_name       ='';
                    $propertier_name    ='';
                    $business_details   ='';
                    $address            ='';
                    $phone_no           ='';
                    $ntn                ='';
                    $sale_tax_no        ='';
                    $btn                = 'Add';
                    $status             = '';
                    $icon               = 'plus';
                    $fn_supp_id         = '';
   
                endif;
                ?>
            <div class="form-group ">   
                <?php
                    
                echo form_input(array(
                    'name'          => 'company_name',
                    'value'         =>$company_name,
                    'class'         =>'form-control',
                    'placeholder'   =>'Company Name',
                    
                    'required'      =>'required',
                    'type'          =>'text'
                    ));
                    ?>
              </div>
            <div class="form-group ">   
                <?php
                    
                    echo form_input(array(
                    'name'          => 'proper_name',
                    'value'         => $propertier_name,
                    'class'         =>'form-control',
                    'placeholder'   =>'Propertier Name',
                    'required'      =>'required'
                    ));
                    ?>
              </div>
            <div class="form-group ">   
                <?php
                    
                    echo form_input(array(
                    'name'          => 'businerss_name',
                    'value'         => $business_details,
                    'class'         =>'form-control',
                    'placeholder'   =>'Bussiness Details',
                    
                    ));
                    ?>
              </div>
            <div class="form-group ">   
                <?php
                    
                    echo form_input(array(
                    'name'          => 'address',
                    'value'         => $address,
                    'class'         =>'form-control',
                    'placeholder'   =>'Address',
                    
                    ));
                    ?>
              </div>
            <div class="form-group ">   
                <?php
                    
                    echo form_input(array(
                    'name'          => 'phone_no',
                    'value'         => $phone_no,
                    'class'         =>'form-control',
                    'placeholder'   =>'Phone No',
                    
                    ));
                    ?>
              </div>
            <div class="form-group ">   
                <?php
                    
                    echo form_input(array(
                    'name'          => 'ntn',
                    'value'         => $ntn,
                    'class'         =>'form-control',
                    'placeholder'   =>'NTN',
                    
                    ));
                    ?>
              </div>
             
            <div class="form-group ">   
                <?php
                    
                    echo form_input(array(
                    'name'          => 'sale_tax',
                    'value'         => $sale_tax_no,
                    'class'         =>'form-control',
                    'placeholder'   =>'Sale Tax No',
                    
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
                echo form_dropdown('coa_status',$statusArray,$status,  'class="form-control"');
                echo '</div>';
                endif;
            
                ?>
              
              <!--//form-group-->
              <input type="hidden" name="supp_id" value="<?php echo @$fn_supp_id;?>">
              <div class="form-group">
                  <button type="submit" name="<?php echo $submit_name?>" value="<?php echo $submit_name?>"  class="btn btn-theme">
                    <i class="fa fa-<?php echo $icon?>"></i> <?php echo $btn?>
                </button>
              </div>
               
             
              <!--//form-group-->
                
               
            </div>
          </div>

         <?php echo form_close(); ?>     
            <?php
            if(@$FnSupplier):
            ?>
            <h3 class="has-divider text-highlight">Result :<?php echo count(@$FnSupplier)?></h3>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th >S.no</th>
                    <th>Company Name</th>
                   <th>Proprietor Name</th>
                   <th>Business Name</th>
                   <th>address</th>
                   <th>Phone No</th>
                   <th>NTN</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  
                  
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   
                   foreach($FnSupplier as $urRow):
                      
                      echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$urRow->company_name.'</td>
                                <td>'.$urRow->propertier_name.'</td>
                                <td>'.$urRow->business_details.'</td>
                                <td>'.$urRow->address.'</td>
                                <td>'.$urRow->phone_no.'</td>
                                <td>'.$urRow->ntn.'</td>
                                 
                                <td>
                                <a href="FnSupplier/'.$urRow->fn_supp_id.'" class="productstatus" ><span class="btn btn-success btn-sm">EDIT</span></a> &nbsp;
                                </td>
                                 
                                <td>
                                <a href="FnSuppDelete/'.$urRow->fn_supp_id.'" class="productstatus" ><span class="btn btn-danger btn-sm">DELETE</span></a>
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
 
 