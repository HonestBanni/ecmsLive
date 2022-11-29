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
           <?php echo form_open('',array('class'=>'course-finder-form')); ?>
          <div class="col-md-12">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                            <span class="line" style="color:red; font-size: 21px;">Note: Before synchronization of data,  first disable the "Apply for admission" program link on college website that needs to be sync.</span>
                        </h1>
                        <div class="section-content" >
                           
                               
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Program</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('Program', $program,$program_id,  'class="form-control" required="required" id="Programe"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Sub Program</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control" id="SubProgram"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Student Status</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('studentStatus', $studentStatus,$studentStatus_id,  'class="form-control"');
                                        ?>
                                    </div>
                                </div>
                                
                                <div class="col-md-3 col-sm-6">
                                    <label for="name">Data Link</label>
                                        
                                            <?php
                                            echo  form_input(
                                                         array(
                                                            'name'          => 'AuthCode',
                                                            'type'          => 'text',
                                                            'class'         => 'form-control',
                                                             'value'        =>$AuthCode
                                                        ));
                                            echo  form_input(
                                                         array(
                                                            'name'          => 'UserID',
                                                            'type'          => 'hidden',
                                                            'class'         => 'form-control',
                                                             'value'        =>$UserID
                                                        ));
                                                 ?>
                                          
                                            
                                     </div>
                               </div> 
                             
                          <div style="padding-top:1%;">
                                <div class="col-md-5 col-md-offset-1 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="CreateAuth" id="CreateAuth"  value="CreateAuth" ><i class="fa fa-user"></i> Create Auth Code</button>
                                    <button type="submit" class="btn btn-theme" name="SearchRecord" id="SearchRecord"  value="SearchRecord" ><i class="fa fa-search"></i> Search</button>
                                    <button type="submit" class="btn btn-theme" name="synchronize" id="synchronize"  value="synchronize" ><i class="fa fa-plus"></i> Synchronize Data</button>
                                     
                                </div>
                            </div>
                                
                                
                             
                            
                         </div><!--//section-content-->
                                <?php
                                    echo form_close();
                                    ?>  
                        
                    </section>
           <div class="row">
                                    <div class="col-md-12">
                                        <?php
//                                      echo '<pre>';print_r($result_search);die;
                                      if(!empty($result_search)):
                                         
                                    ?>
                                    
              
                                        <h3 class="has-divider text-highlight">Student Search Result : <?php echo count($result_search)?></h3>
                                        <div class="table-responsive">
                                              <table class="table  " id="table">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Name</th>
                                                          <th>Father Name</th>
                                                          <th>Father CNIC</th>
                                                          <th>Program</th>
                                                          <th>Sub Program</th>
                                                    

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                        foreach($result_search as $row1):
                                                            $row =  json_decode(json_encode($row1), FALSE);
                                                            $sn++;
                                                            echo '<tr>';
                                                            echo '<td>'.$sn.'</td>';
                                                            echo '<td>'.$row->student_name.'</td>';
                                                            echo '<td>'.$row->father_name.'</td>';
                                                            echo '<td>'.$row->father_cnic.'</td>';
                                                            echo '<td>'.$row->programe_name.'</td>';
                                                            echo '<td>'.$row->name.'</td>';
                                                            
                                                            echo '</tr>';
                                                        endforeach;
                                                        
                                                        ?>
                                                    </tbody>
                                            </table>
                                        </div>
                                      <?php
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
 
   
   
     <script>
  jQuery(document).ready(function(){

    jQuery('#Programe').on('click',function(){
    var programId = jQuery('#Programe').val();
    
       //get sub program
       jQuery.ajax({
        type   :'post',
        url    :'DDSubPrograms',
        data   :{'programId':programId},
        success :function(result){
           jQuery('#SubProgram').html(result);
       },
       complete:function(){
           //Get Batch 
           jQuery.ajax({
               type   :'post',
               url    :'DDBatch',
               data   :{'programId':programId},
              success :function(result){
                  console.log(result);
                 jQuery('#batch_id').html(result);
              }
           });
           
             
       }
       
    });
    
}); 
}); 
</script>
   
  
 