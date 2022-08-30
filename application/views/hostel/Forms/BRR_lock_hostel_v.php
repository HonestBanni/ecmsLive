 
<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left"><?php echo $page_header?></h1>
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
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <section class="course-finder" style="padding-bottom: 2%;">
                    <h1 class="section-heading text-highlight">
                        <span class="line"><?php echo $page_header?> Panel</span>
                    </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                                  
                                     ?>
                            <div class="row">
                                <div class="col-md-2 col-sm-5">
                                    <label for="name">From</label>
                                        <div class="input-group" id="adv-search">
                                            <?php
                                                 echo  form_input(
                                                         array(
                                                            'name'          => 'from',
                                                            'type'          => 'text',
                                                            'required'      => 'required',
                                                            'value'         => $from,
                                                            'class'         => 'form-control datepicker',

                                                             )
                                                         );
                                                  ?>
                                          </div>
                                            
                                     </div>
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">To</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                     echo  form_input(
                                                             array(
                                                                'name'          => 'to',
                                                                'type'          => 'text',
                                                                'required'      => 'required',
                                                                'value'         => $to,
                                                                'class'         => 'form-control datepicker',
                                                                
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                            </div>
                              
                           </div><!--//section-content-->
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="Search" id="Search"  value="Search" ><i class="fa fa-search"></i> Search</button>
                                    <button type="submit" class="btn btn-theme" name="lock" id="lock"    value="lock" ><i class="fa fa-lock"></i>Date Lock</button>
                                    
     
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                     </section>
                        <?php
                        if(!empty($already_exist_date)):
                            
                            foreach($already_exist_date as $exist_dates):
                            echo '<div class="alert alert-danger alert-dismissable center">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <strong>'.date('d-m-Y',strtotime($exist_dates->date)).' !</strong> Already Locked
                                </div>';
                            endforeach;
                            
                        endif;
                        
                        ?>
                            
                                
                                <?php
                                
                                   if(!empty($search_result)):
                                    
                                
                                
                                ?>
                                <div class="col-md-8 col-md-offset-2">
                                    
                                       
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table" style="font-size:14px;">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Date</th>
                                                           <th>Lock Status</th>
                                                           <th>Edit</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                         <?php
                                                         
                                                           $sn      = '';
                                                           $status  = '';
                                                            foreach($search_result as $search_row):
                                                                
                                                                if($search_row->status == 1):
                                                                   $status ='Lock';
                                                                    else:
                                                                   $status ='Un-lock'; 
                                                                endif;
                                                                
                                                            $sn++;
                                                            echo '
                                                                <tr>
                                                                    <td>'.$sn.'</td>
                                                                    <td>'.date('d-m-Y',strtotime($search_row->lock_date)).'</td>
                                                                     <td><a><span class="btn btn-info btn-xs">'.$status.'</span></a></td>
                                                                    <td><a href="editRecLockHostel/'.$search_row->id.'" target="_new"><strong><button type="button" class="btn btn-theme btn-xs"> Edit </button></strong></a></td>
                                                                </tr>
                                                            ';
                                                            endforeach;   
                                                         ?>
                                                        
                                                    </tbody>
                                            </table>
                                        </div>
                                </div>
                                         
               
           <?php
                                
                                    
                                endif;
                                
                                ?>
                            
                                  
                    </div>
 
        </div>
          
      
    </div>
    </div>
                
    
      
        <!--//page-row-->
</div>
 
    <!--//page-wrapper--> 
 


     <script>
  $( function() {
      
      
    $( ".datepicker" ).datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd-mm-yy'
 
    });
  } );
  </script>
  <style>
      .datepicker{
          z-index: 1;
      }
  </style>     
  
 
  
  
   