 
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
//                                            echo '<pre>';print_r($update_result->lock_date);die;
//                                            echo '<pre>';print_r($update_result->lock_date);die;
                                            
                                                 echo  form_input(
                                                         array(
                                                            'name'          => 'date',
                                                            'type'          => 'text',
                                                            'required'      => 'required',
                                                            'value'         => date('d-m-Y',strtotime($update_result->lock_date)),
//                                                            'value'         => date('d-m-Y',$update_result->lock_date),
                                                            'class'         => 'form-control datepicker',

                                                             )
                                                         );
                                                 echo  form_input(
                                                         array(
                                                            'name'          => 'id',
                                                            'type'          => 'hidden',
                                                            'value'         => $update_result->id,
                                                            'class'         => 'form-control',

                                                             )
                                                         );
                                                  ?>
                                          </div>
                                            
                                     </div>
                                <div class="col-md-2 col-sm-5">
                                     <label for="name">Status</label>
                          
                                <?php 
                                if(@$update_result):

                                echo '<div class="form-group">';
                                $statusArray = array(
                                    '2'=>'Un-lock',
                                    '1'=>'Lock'
                                    );
                                echo form_dropdown('status',$statusArray,$update_result->status,  'class="form-control" id="my_id"');
                                echo '</div>';
                                endif;

                                ?>
                                          </div>
                                <div class="col-md-6">
                                    <label for="name">Comments</label>
                                        <?php 
                                            echo form_textarea(array(
                                                'name'          => 'comments',
                                                'cols'          => '40',
                                                 'rows'         => '2',
                                              
                                                'class'         => 'form-control',
                                                'required'      => 'required',  
                                                ));
                                           
                                         ?>
                                    </div>
                            </div>
                              
                           </div><!--//section-content-->
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                    <button type="submit" class="btn btn-theme" name="update" id="update"    value="update" ><i class="fa fa-book"></i>Update Lock</button>
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                     </section>
                        
                            
                                
                                <?php
                                
                                   if(!empty($update_results)):
                                    
                                
                                
                                ?>
                                <div class="col-md-8 col-md-offset-2">
                                    
                                       
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table" style="font-size:14px;">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Update By</th>
                                                          <th>Date</th>
                                                           <th>Lock Status</th>
                                                           <th>Comments</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                         <?php
                                                         
                                                           $sn      = '';
                                                           $status  = '';
                                                            foreach($update_results as $search_row):
                                                                
                                                                if($search_row->status == 1):
                                                                   $status ='Lock';
                                                                    else:
                                                                   $status ='Un-lock'; 
                                                                endif;
                                                                
                                                            $sn++;
                                                            echo '
                                                                <tr>
                                                                    <td>'.$sn.'</td>
                                                                    <td>'.$search_row->email.'</td>
                                                                    <td>'.date('d-m-Y',strtotime($search_row->lock_date)).'</td>
                                                                     <td>'.$status.'</td>
                                                                     <td>'.$search_row->comments.'</td>
                                                                    
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
  
 
  
  
   