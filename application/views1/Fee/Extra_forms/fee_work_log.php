 <?php
// error_reporting(0);
 ?>
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
                        <?php echo form_open('',array('class'=>'course-finder-form'));?>
                            <div class="row">
                               <div class="col-md-3">
                                    <label for="name">College No</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'college_no',
                                                 
                                                'value'         => $college_no,
                                                'placeholder'   => 'Enter Challan Number',
                                                'class'         => 'form-control ',
                                                ));
                                           
                                         ?>
                                    </div>
                               <div class="col-md-3">
                                    <label for="name">Date</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'date',
                                                
                                                'value'         => $date,
                                                'placeholder'   => 'Date',
                                                'class'         => 'form-control datepicker',
                                                ));
                                           
                                         ?>
                                    </div>

                               
                                 
                                     
                                </div>
                            <div class="row">
                           <div class="col-md-9">
                                    <label for="name">Comments</label>
                                        <?php 
                                            echo form_textarea(array(
                                                'name'          => 'comments',
                                                'col'           =>'10',
                                                'rows'           =>'3',
                                                 
                                                'placeholder'   => 'Comments',
                                                'class'         => 'form-control',
                                                ));
                                           
                                         ?>
                                    </div>
                               </div> 
                           </div> 
                      
                            
                            
                          <div style="padding-top:1%;">
                                <div class="col-md-4 col-md-offset-1 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="add_manual_log" id="add_manual_log"  value="add_manual_log" ><i class="fa fa-plus"></i> Save Log</button>
                                     
                                   
                                </div>
                                 
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                       </section>       
                         </div><!--//section-content-->
                        
                        
                  <?php
                  
                  if($Query_result):
                      
                
                  
                  ?>
                        <div class="col-md-12">
                                        
                                     <div id="challan_bill_amount_info">
              
                                        <h3 class="has-divider text-highlight">Results</h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Challan #</th>
                                                            <th>Date</th>
                                                             
                                                            <th>Comments</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                         
                                                  
                                                          foreach($Query_result as $row):
                                                              $sn++;
                                                            echo '<tr">
                                                                <td>'.$sn.'</td>
                                                                <td>'.$row->college_no.'</td>
                                                                <td>'.date('d-m-Y',strtotime($row->date)).'</td>
                                                                
                                                                <td>'.$row->comments.'</td>';
                                                                 
                                                                
                                                                 echo '</tr>';
                                                            
                                                            
                                                           
                                                          endforeach;      
                                                         
                                                           
                                                        ?>

                                                    </tbody>
                                            </table>
                                        </div>
                                      
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
jQuery(document).ready(function(){
$(function() {
    $('.datepicker').datepicker( {
      changeMonth: true,
       changeYear: true,
        dateFormat: 'dd-mm-yy'

   });
        });

  
  
 });
  </script>
   
  
 