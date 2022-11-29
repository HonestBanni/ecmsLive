 
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
              
               <section class="course-finder" >
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                                  
                                     ?>
                                <div class="row">
                                    
                                    
                                <div class="col-md-3 col-sm-5">
                                        <label for="name">Date</label>
                                         
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'search_date',
                                                                'type'          => 'text',
                                                                'value'         => $search_date,
                                                                'class'         => 'form-control datepicker',
                                                                'id'            => 'ldDate',
                                                                'placeholder'   => 'Date')
                                                             );
                                                      ?>
                                               
                                            
                                     </div>
                                <div class="col-md-3 col-sm-5">
                                        <label for="name">Employee Category</label>
                                         
                                                <?php
                                                
                                                echo form_dropdown('emp_categ',$emp_categ,$emp_categ_id,array('class'=>'form-control', 'id'=>'ldCate'));
                                                
                                                       
                                                      ?>
                                               
                                            
                                     </div>
                              
                           </div><!--//section-content-->
                            
                    
                           
                           
                           <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                    <button type="submit" class="btn btn-theme" name="search" id="search"  value="search" ><i class="fa fa-search"></i> Search</button>
                                    <button type="button" class="btn btn-theme" name="order" id="order_ld"  value="Order" ><i class="fa fa-arrow-down"></i> Order</button>
                                    
                                     
     
                                </div>
                            </div>
                           <br/>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                        </div>  
                        
                        
                    </section>
              
              
              <div class="row">
                                    <div class="col-md-12">
                                        <div id="div_print">
                                            <?php
                                            
                                            if($result):
                                               
                                                
                                             
                                            
                                            ?>
                                        
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table">
                                              <!--<table class="table table-hover" id="table" style="font-size:11px">-->
                                                    <thead>
                                                      <tr>
                                                            <th>S/No</th>
                                                            <th>Picture</th>
                                                            <th>Login User Name</th>
                                                            <th>Name</th>
                                                            <th>Father Name</th>
                                                            <th>Designation</th>
                                                            
                                                            <th>Login IP</th>
                                                            <th>Login Time</th>
                                                                                                                     

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                        foreach($result as $row):
                                                            $sn++;
                                                            echo '<tr>
                                                                <td>'.$sn.'</td>
                                                                <td ><img style="height: 100px;width: 90px;border-radius: 21px;" src="assets/images/employee/'.$row->picture.'"></td>
                                                                <td>'.$row->login_name.'</td>
                                                                <td>'.$row->emp_name.'</td>
                                                                <td>'.$row->father_name.'</td>
                                                                <td>'.$row->current_design.'</td>
                                                                <td style="font-size:25px; font-decoration:bold;">'.$row->ip_address.'</td>
                                                                <td>'.date('d-m-Y H:i A',strtotime($row->login_date_time)).'</td>
                                                                
                                                            </tr>';
                                                          
                                                        endforeach;
                                                        
                                                        ?>
                                                        
                                                                
                                                                 
                                                    </tbody>
                                            </table>
                                        </div>
                                          <?php
                                            
                                                else:
                                               echo '<h3 class="has-divider text-highlight">No Result Found</h3>'; 
                                            endif;
                                            
                                            ?> 
                                    </div>
                                    </div>
                                  
                                </div> 
          </div>
 
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 
     
   <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#order_ld').on('click', function(){
                var ldDate = jQuery('#ldDate').val();
                var ldCate = jQuery('#ldCate').val();
                window.open('PolicyController/login_details_group_by/'+ldDate+'/'+ldCate, '_blank');
            });
        });
    </script>

  
   <script type="text/javascript">
        $(function() {
            $('.datepicker').datepicker( {
               changeMonth: true,
                changeYear: true,
                 dateFormat: 'dd-mm-yy'
           
            });
        });
    </script>
