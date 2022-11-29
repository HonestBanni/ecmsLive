<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
       
        <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Amount transition Information 
      </h1>
      <div class="breadcrumbs pull-right">
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-label">You are here:
          </li>
          <li> 
            <a href="<?php echo base_url('admin/admin_home');?>">Home</a> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current">Amount transition Information 
        </li></ul>
      </div>
      <!--//breadcrumbs-->
    </header>
    <div class="page-content">
        
      <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">                            
            
            <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Amount transition Information</span>
                        </h1>
                        <div class="section-content">
                            <?php
                          echo   form_open();
                          
                          if($AMI):
                              $date = date('Y-m');
                              $searchText = $searchText;
                              else:
                              $searchText = '';    
                              $date = date('Y-m');
                          endif;
                            ?>
                                <div class="row">
                                      
                                     <div class="col-md-2 col-sm-5">
                                        <?php 
                                        echo form_dropdown('cb_jv', $cb_jv, $cb_jvId,  'class="form-control" id="my_id"');
                                        ?>
                                         
                                     </div>
                                     <div class="col-md-2 col-sm-5">
                                        <?php 
                                        echo form_dropdown('month', $month, $monthId,  'class="form-control" id="my_id"');
                                        ?>
                                        
                                     </div>
                                     <div class="col-md-2 col-sm-5">
                                        <?php 
                                        echo form_dropdown('year', $year, $yearId,  'class="form-control" id="my_id"');
                                        ?>
                                        
                                     </div>
                                     <div class="col-md-2 col-sm-5">
                                         <input type="text" name="searchText" value="<?php echo $searchText;?>"   placeholder="Search" class="form-control" >
                                     </div>
                                    
                                    <div class="col-md-2">
                                  
                                        <button type="submit" class="btn btn-theme" name="search" id="search" value="search"><i class="fa fa-search"></i> Search</button>
                                    </div>
                                </div>
                           <?php
                         echo    form_close();
                            ?>
                        </div>
                          
                                                                    
                             
                             
                         </div><!--//section-content-->
                        
                        
                    </section>
           
        <h5 class="has-divider text-highlight"><span style="color:#208e4c">Total : <?php echo $total_rows;?></span></h5>
     
 
        
            <table class="table table-boxed table-hover" id="table">
              <thead>
                <tr>
                   
                    <th>Vocher #</th>
                    <th>Date</th>
                    <th>JV/CB</th>
                    <th>Payee</th>
                    <th>Description</th>
                    <th>Details</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                  
                  
                  
                  <?php
                    $class = array(
                            'info',
                            'success',
                            'danger',
                            'warning',
                            'active',
                        );

                                       
                  
                  
                  if($AMI):
                       
                      foreach($AMI as $amiRow):
                         $k = array_rand($class);
                          $cbjv = '';
                      if($amiRow->gl_at_cb_jv == 1):
                          $cbjv = 'CB';
                            else:
                            $cbjv = 'JV';
                        endif;
                        
                      echo ' <tr class="'.$class[$k].'">
                              
                                <td >'.$amiRow->gl_at_vocher.'</td>
                                <td>'.date('d-m-Y',  strtotime($amiRow->gl_at_date)).'</td>
                                <td>'.$cbjv.'</td>
                                <td>'.$amiRow->gl_at_payeeId.'</td>
                                <td>'.$amiRow->gl_at_description.'</td>
                                <td><a href="javascript:valid(0)" id="'.$amiRow->gl_at_id.'" class="amount_tran_details"><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal"> Details</button></a></td>';
                               ?>
                                 <td>  <a href="AmountTransitionEdit/<?php echo $amiRow->gl_at_id;?>"  class="productstatus"><button type="button" class="btn btn-theme btn-xs"> Edit </button></a>
                               </td> <td> 
                                <a href="delteATI/<?php echo $amiRow->gl_at_id;?>"  onclick="return confirm('Are You Sure to Delete This..?')"  class="productstatus"><button type="button" class="btn btn-danger btn-xs"> Delete</button></a>
                                </td>   <?php
                                        echo ' 

                            </tr> ';
                      endforeach;
                  endif;
                  ?>
                                  
              </tbody>
            </table>
        <?php
        echo @$links;
        ?>
        </article>
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
                 </div>
                
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Account Details</h4>
      </div>
      <div class="modal-body">
          <div id="transitionDetails">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>
      
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper-->