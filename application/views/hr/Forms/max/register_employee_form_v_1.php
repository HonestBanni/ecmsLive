 
        <div class="content container">
            <div class="page-wrapper">
                <header class="page-heading clearfix">
                        <h1 class="heading-title pull-left"><?php echo $breadcrumbs?></h1>
                            <div class="breadcrumbs pull-right">
                                <ul class="breadcrumbs-list">
                                    <li class="breadcrumbs-label">You are here:</li>
                                    <li><a href="admin/admin_home">Home</a> 
                                      <i class="fa fa-angle-right"></i>
                                    </li>
                                    <li class="current"><?php echo $breadcrumbs?></li>
                                </ul>
                            </div>
                  <!--//breadcrumbs-->
                </header>
                <div class="page-content">
                    <div class="row">
                        <form name="student" method="post" id="RegEmployee"  name="RegEmployee">
                            <div class="form-group col-md-3">
                               <label for="usr">Employee Name:</label>
                               <input type="text" name="emp_name" class="form-control">        
                            </div>
                            <div class="form-group col-md-3">
                                <label for="usr">Father Name:</label>
                                <input type="text" name="father_name" class="form-control" required="required">        
                            </div>
                            <div class="form-group col-md-3">
                                <label for="usr">Husband Name:</label>
                                <input type="text" name="emp_husband_name" class="form-control">        
                            </div>
                            <div class="form-group col-md-3">
                                <label for="usr">NIC :</label>
                                <input type="text" name="emp_cnic"  class="form-control nic" required="required">        
                            </div>
                            <div class="form-group col-md-3">
                                <label for="usr">Gender:</label>
                                <?php echo form_dropdown('gender_id',$gender,'',array('class'=>'form-control'))?>
                            </div>
                            
                            <div class="col-md-3">
                                        <label style="text-indent: 3px">Date of Birth <span style="color:red">*</span></label>
                                        <div>
                                            <div style="width: 33%; float: left" class=" form-group">
                                                <select class="form-control" name="dob_day" id="dob_day" autocomplete="off" >
                                                    <option value="">Day</option>
                                                    <?php
                                                    for($d=1; $d<32; $d++):
                                                        if(strlen($d) < 2): $v = '0'.$d; else: $v = $d; endif;
                                                        echo '<option value="'.$v.'">'.$d.'</option>';
                                                    endfor;
                                                    ?>
                                                </select>
                                            </div>
                                            <div style="width: 33%; float: left" class="form-group" autocomplete="off" >
                                                
                                                   <?php
                                                        $month =   $this->CRUDModel->dropDown('month', 'Month', 'mth_num', 'mth_title');
                                                    echo form_dropdown('dob_month',$month,'',array('class'=>'form-control','required'=>"required"));
                                                ?> 
                                            </div>
                                            <div style="width: 33%; float: left" class="form-group">
                                                <select class="form-control" name="dob_year" id="dob_year" autocomplete="off" >
                                                    <option value="">Year</option>
                                                    <?php
                                                    for($y=1950; $y<=date('Y')-15; $y++):
                                                        echo '<option value="'.$y.'">'.$y.'</option>';
                                                    endfor;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                    </div> 
                            
                             
                            <div class="form-group col-md-3">
                                <label for="usr">Postal Address:</label>
                                <input type="text" name="postal_address" class="form-control">        
                            </div>     
                            <div class="form-group col-md-3">
                                <label for="usr">Permanent Address:</label>
                                <input type="text" name="permanent_address" class="form-control">        
                            </div>     
                            <div class="form-group col-md-3">
                                <label for="usr">District:</label>
                                <input type="text" name="district" class="form-control" id="district" required="required">
                                <input type="hidden" name="district_id" id="district_id">
                            </div>  
                            <div class="form-group col-md-3">
                                <label for="usr">Post Office:</label>
                                <input type="text" name="post_office" class="form-control">        
                            </div>
                                <div class="form-group col-md-3">
                                        <label for="usr">Country:</label>
                                       <input type="text" name="country" class="form-control" id="country" required="required">
                                        <input type="hidden" name="country_id" id="country_id">
                                    </div>
                                            
                                <div class="form-group col-md-3">
                                    <label for="usr">PTCL No.:</label>
                                    <input type="text" name="ptcl_number" class="form-control">        
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="usr">Mobile No 1:</label>
                                    <input type="text" name="contact1" class="form-control phone">        
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="usr">Network:</label>
                                     <?php echo form_dropdown('net_id',$network,'',array('class'=>'form-control','required'=>'required'))?>
                                </div>            
                                <div class="form-group col-md-3">
                                    <label for="usr">Religion:</label>
                                        <?php echo form_dropdown('religion_id',$religion,'',array('class'=>'form-control'))?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="usr">Marital Status:</label>
                                     <?php echo form_dropdown('marital_status_id',$m_status,'',array('class'=>'form-control'))?>
                                </div> 
                                <div class="form-group col-md-3">
                                    <label for="usr">Email:</label>
                                    <input type="text" name="email" class="form-control email">        
                                </div>
                              
                               <div class="form-group col-md-3">
                                    <label for="usr">Employee Status:</label>
                                     <?php echo form_dropdown('emp_status_id',$status,'',array('class'=>'form-control'))?>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="usr">Comment.:</label>
                                    <textarea name="comment" cols="40" rows="2" class="form-control" placeholder="comments" ></textarea>
                                       
                                </div>
                           
                                <div class="form-group col-md-2 pull-right">
                                    <label for="usr" style="visibility: hidden;">sdsdasass:</label>
                                    <button type="button" class="btn btn-theme form-control" id="SaveRecord" value="Save Record"><i class="fa fa-plus"></i>Save Record </button>
                                </div>
                               
                            </form> 
                        <input type="hidden" id="new_emp_id" name="new_emp_id">
                    </div>
                </div>
             </div>
        </div><!--//col-md-3-->
        
        
           <div class="modal fade" id="entry_validation" role="dialog" style="z-index:9999">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h1 style="text-align:center; font-size: 80px; color: #c00;" id="resp_icon"></h1>
                            <h4 style="text-align:center; color: #c00; margin: 0px;"><strong id="resp_type"></strong></h4>
                            <p style="margin:0">&nbsp;</p>
                            <h4 style="text-align:center"><strong id="resp_text"></strong></h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="entry_success" role="dialog" style="z-index:9999">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h1 style="text-align:center; font-size: 80px; color: #0e7a44;" id="succ_icon"></h1>
                            <h4 style="text-align:center; color: #0e7a44; margin: 0px;"><strong id="succ_type"></strong></h4>
                            <p style="margin:0">&nbsp;</p>
                            <h4 style="text-align:center"><strong id="succ_text"></strong></h4>
                            
                        </div>
                        <div class="modal-footer">
                             <button type="button"  class="btn btn-theme" id="AddPicture">Add picture</button>
                             <button type="button"  class="btn btn-theme" id="AddContract">Add Record</button>
                             <a href="EmployeeRecords"><button type="button" class="btn btn-theme" >Close</button></a>
                        </div>
                    </div>
                </div>
            </div>
        
        
        <script>
            jQuery(document).ready(function(){
            jQuery('#SaveRecord').on('click',function(){
                    
                   var form = $('#RegEmployee');
                    $.ajax({
                        type     : "POST",
                        url      : 'RegisterEmployee',
//                        url      : form.attr("action"),
                        dataType : 'json',
                        data     : form.serialize(),
                        success  : function(response){
                            
                            if(response['e_status'] == false){
                                $('#resp_icon').html(response['e_icon']);
                                $('#resp_type').html(response['e_type']);
                                $('#resp_text').html(response['e_text']);
                                $('#entry_validation').modal('toggle');
                            }
                            else {
                                
                                $('#succ_icon').html(response['e_icon']);
                                $('#succ_type').html(response['e_type']);
                                $('#succ_text').html(response['e_text']);
                                $('#RegEmployee')[0].reset();
                                $('#new_emp_id').val(response['emp_id']);
                                $('#entry_success').modal('toggle');
                            }
                            console.log(response);  
                        }
                    });
                   
               });
              jQuery('#AddContract').on('click',function(){
                  var URL = 'ContractDetails/'+jQuery('#new_emp_id').val();
                   window.location.href = URL;
              }); 
              jQuery('#AddPicture').on('click',function(){
                  var URL = 'EmployeePicture/'+jQuery('#new_emp_id').val();
                   window.location.href = URL;
              }); 
            $('html').bind('keypress', function(e){
                if(e.keyCode == 13){ return false; }
            });
               
            });
        </script>  