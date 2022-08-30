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
           <?php echo form_open('',array('class'=>'course-finder-form')); ?>
          <div class="col-md-12">
              
                                    
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           
                                <div class="row">
                               <div class="col-md-3">
                                    <label for="name">Form#</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'form_no',
                                                'id'            => 'form_no',
                                                'value'         => $form_no,
                                                'placeholder'   => 'Enter Form No',
                                                'class'         => 'form-control',
                                                ));
                                         
                                         ?>
                                    </div>
                               <div class="col-md-3">
                                    <label for="name">Student Name</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'student_name',
                                                'id'            => 'student_name',
                                                'value'         => $student_name,
                                                'placeholder'   => 'Enter Student Name',
                                                'class'         => 'form-control',
                                                ));
                                           
                                         ?>
                                    </div>
                               <div class="col-md-3">
                                    <label for="name">Father Name</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'father_name',
                                                'id'            => 'father_name',
                                                'value'         => $father_name,
                                                'placeholder'   => 'Father Name',
                                                'class'         => 'form-control',
                                                ));
                                           
                                         ?>
                                    </div>
                                     
                                     
                                </div>
<!--                            <div class="row">
                         
                               </div> -->
                             
                          <div style="padding-top:1%;">
                                <div class="col-md-4 col-md-offset-1 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="search" id="search"  value="search" ><i class="fa fa-search"></i> Search</button>
                                    <?php
//                                    echo '<pre>';print_r($studentInfo);die;
                                    if(!empty($studentInfo)):
                                        echo '<button type="submit" class="btn btn-theme" name="generate_fee" id="generate_fee"  value="generate_fee" ><i class="fa fa-upload"></i> Update Challan</button>';
                                    endif;
                                    ?>
                     
     
                                </div>
                            </div>
                                
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
           <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                     
                                        
                                        if(!empty($result)): ?>
                                     <div id="div_print">
              
                                        <h3 class="has-divider text-highlight">Result: <?php echo  count($result)?> </h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table">
                                                    <thead>
                                                      <tr>

                                                           
                                                          <th>Form No</th>
                                                          <th>Name</th>
                                                          <th>Father Name</th>
                                                          <th>Sub Program</th>
                                                          <th>Reserved Seat</th>
                                                          <th>Status</th>
                                                          <th>Challan</th>
                                                         
                                                    

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
//                                                      echo '<pre>';print_r($result); 
                                                        $sn='';
                                                          foreach($result as $row):
                                                              $challan_checking = $this->CRUDModel->get_where_row('fee_challan',array('fc_student_id'=>$row->student_id));
                                                              $chkFee = $this->db->get_where('prospectus_challan',array('student_id'=>$row->student_id))->row();
                                                                                
                                                                if(empty($challan_checking)):
                                                                       $sn++;
                                                                    echo '<tr>
                                                                            <td>'.$row->form_no.'</td>
                                                                            <td>'.$row->student_name.'</td>
                                                                            <td>'.$row->father_name.'</td>
                                                                            <td>'.$row->name.'</td>
                                                                            <td>'.$row->Seat_name.'</td>
                                                                            <td><button type="button" class="btn btn-success btn-xs">'.$row->student_status.'</button></td>';
                                                                    
                                                                        if(@$chkFee->print_challan_flag == 0):
                                                                            if($row->StudentStatusId != '15'):
                                                                                echo '<td><a href="admissionChallanGent/'.$row->student_id.'"  class="productstatus"><button type="button" class="btn btn-info btn-xs"> Generate Challan </button></a> &nbsp;&nbsp;&nbsp;';
                                                                            else:
                                                                              
                                                                               echo  '<td><button type="button" class="btn btn-info btn-xs disabled"> Generate Challan </button> &nbsp;&nbsp;&nbsp;';
                                                                               echo '<a href="ChallanPDFu/'.$row->student_id.'"  "><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-print"></i> P-Print </button></a></th>';

                                                                            endif;
                                                                        else: 
                                                                            if($row->StudentStatusId != '15'):
                                                                                echo '<td><a href="admissionChallanGent/'.$row->student_id.'"  class="productstatus"><button type="button" class="btn btn-info btn-xs"> Generate Challan </button></a> &nbsp;&nbsp;&nbsp;';
                                                                            else:
                                                                                echo '<td><a href="admissionChallanGent/'.$row->student_id.'"  class="productstatus"><button type="button" class="btn btn-info btn-xs"> Generate Challan </button></a> &nbsp;&nbsp;&nbsp;';
                                                                                echo '<a href="ChallanPDFu/'.$row->student_id.'"  ><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-print"></i> P-Print </button></a></th>';
                                                                            endif;
                                                                        endif;
                                                                    echo '</tr>';
                                                                else:
                                                                    echo '<tr>
                                                                            <td>'.$row->form_no.'</td>
                                                                            <td>'.$row->student_name.'</td>
                                                                            <td>'.$row->father_name.'</td>
                                                                            <td>'.$row->name.'</td>
                                                                            <td>'.$row->Seat_name.'</td>
                                                                            <td><button type="button" class="btn btn-success btn-xs">'.$row->student_status.'</button></td>';
                                                                    echo    '<td><a href="feeChallanPrintAdmission/'.$challan_checking->fc_challan_id.'/'.$row->student_id.'"  class="productstatus"><button type="button" class="btn btn-theme btn-xs"><i class="fa fa-print"></i> Print </button></a></td>';
                                                                echo '</tr>';
                                                                endif;
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
                             
                    <?php
                                    echo form_close();
                                    ?>                 
                </div>
 
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 
 
 
   
  
 