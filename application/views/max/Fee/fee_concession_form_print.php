
<style>

.report_header{
    display: none !important;
}
 
</style>

<script language="javascript">
  function printdiv(printpage)
  {
    var headstr = "<html><head><title></title></head><body>";
//    var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
    var footstr = "</body>";
    var newstr = document.all.item(printpage).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = headstr+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;
    return false;
  }
</script>


<div class="container">
    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>


    <div id="div_print">
    <div class="row">
        <div class="col-xs-12">
                
            <div class="report_header1">
                      <img style="float: right; padding-right: 79px;"  class='img-responsive' src='assets/images/logo-black.png' alt='Edwardes College Peshawar'>
                      <h3 class="text-highlight" style=" text-align: center">EDWARDES COLLEGE PESHAWAR</h3>
                      <h4 class="text-highlight" style=" text-align: center">NEED BASE FINANCIAL ASSISTANCE FORM</h4>
             
            </div>
            
<!--        	<div class="invoice-title">
    			<h2>EDWARDES COLLEGE PESHAWAR</h2> 
    			<h3>NEED BASE FINANCIAL ASSISTANCE FORM</h3> 
    		</div>-->
    		
    		<div class="row">
                    <br/>
                          <hr>
    			<div class="col-xs-6">
    				<address>
    				<strong>Majority Students:</strong><br>
    					 
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
                                    <strong>Form #: 2016-17/..... &nbsp;&nbsp;&nbsp;&nbsp;</strong><br>
    					 
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-12">
    				<address>
    					<strong>Please read carefully the below mantioned instructions before filling.</strong><br>
    					The form must be filled by Parents/Guardians of the student. Father's Occupation and income certificate musb be supported with documentary evidence. Details of children who are study must be supported with relevant documents i.e proof of admission and fee deposit slip form the school/college concerned. Grant of fee concession is subject to availability of college fund and the students are liable to maintain good academic record through out the session, otherwise College reserve the right to cancel it at any time.
    				</address>
    			</div>
    			 
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>PART-1 PERSONAL INFORMATION</strong></h3>
    			</div>
    			<div class="panel-body" style='padding:2px 15px !important;'>
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<tbody>
                                                        <tr>
                                                            <td colspan="2"><strong>Name : <?php echo $student_info->student_name?> </strong></td>
                                                            <td colspan="2"><strong>Father Name : <?php echo $student_info->father_name?> </strong></td>

                                                        </tr>
    						 
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							 
                                                    <tr>
                                                            <td>Class : <?php echo $student_info->programe_name?> </td>
                                                            <td class="text-left">College/Form#: <?php echo $student_info->college_no.' / '.$student_info->form_no?></td>
                                                            <td class="text-left">Group : <?php echo $student_info->name?></td>
                                                            <td class="text-left">Session:  <?php echo $student_info->batch_name?></td>
                                                    </tr>
                                                     
                                                    <tr>
                                                        <td colspan="4">Father's/Guardian's CNIC no (Please attach copy): <?php echo $student_info->father_cnic?> / <?php echo $student_info->guardian_cnic?> </td>
                                                             
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">Permanent Address : <?php echo $student_info->app_postal_address?></td>
                                                             
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">Present Address : <?php echo $student_info->parmanent_address?></td>
                                                             
                                                    </tr>
                                                    <tr>
                                                            <td colspan="2">Contact No (Landline) :  <?php echo $student_info->g_land_no?></td>
                                                            <td colspan="2">Mobile:<?php echo $student_info->g_mobile_no?></td>
                                                   
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">Father's / Guardian Occupation/Designation(if employed, with Organization details: <?php echo $student_info->title?></td>
                                                            
                                                   
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4"><br/></td>
                                                    </tr>
                                                     
                                                    <tr>
                                                        <td colspan="4">Total family income per year form all sources (Copy of income Certificate/Affidavit must be provided) </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="1">Ruppee : <?php echo $student_info->annual_income?></td>
                                                        <td colspan="3">in words : <?php echo $this->CRUDModel->money_convert($student_info->annual_income)?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">Source(s) of family income : </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">Detail of your children who are studying. (Attach proof i.e. Form B , Admisson Letter, fee deposit slips etc)</td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td class="no-line text-center">Sn</td>
                                                        <td class="no-line" >Name of Child</td>
                                                        <td class="no-line">Institution </td>
                                                        <td class="no-line">Expenditure/Year</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="no-line text-center ">1</td>
                                                        <td class="no-line text-center" ></td>
                                                        <td class="no-line text-center" ></td>
                                                        <td class="no-line text-center" ></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="no-line text-center">2</td>
                                                        <td class="no-line text-center"></td>
                                                        <td class="no-line text-center" ></td>
                                                        <td class="no-line text-center" ></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="no-line text-center">3</td>
                                                        <td class="no-line text-center"></td>
                                                        <td class="no-line text-center" ></td>
                                                        <td class="no-line text-center" ></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="no-line text-center">4</td>
                                                        <td class="no-line text-center"></td>
                                                        <td class="no-line text-center" ></td>
                                                        <td class="no-line text-center" ></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="no-line text-center">5</td>
                                                        <td class="no-line text-center"></td>
                                                        <td class="no-line text-center" ></td>
                                                        <td class="no-line text-center" ></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4"> If any Grant/Concession/Scholarship Etc h as been applied for or received in respect of the saem Programme/Academic Session(Please provide Details)</td>
                                                    </tr>
                                                   <tr>
                                                        <td colspan="4"><br/></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4"><br/></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">17:- Detail Of Academic Record/Last Examination Held:</td>
                                                            
                                                    </tr>
                                                    <tr>
                                                       
                                                            <?php
                                                            $this->db->order_by('year_of_passing','desc');
                                                            $this->db->limit('1','0');
                                                            $this->db->join('degree','degree.degree_id=applicant_edu_detail.degree_id');
                                                           $result =  $this->db->where('student_id',$student_info->student_id)->get('applicant_edu_detail')->row();
                                                           
                                                           
                                                          
//                                                           echo '<pre>';print_r($result);die; 
                                                            ?>
                                                            <td>Class :  <?php echo $result->title ?></td>
                                                            <td>Exam :   <?php echo $result->year_of_passing ?></td>
                                                            <td>Total Marks:  <?php echo $result->total_marks ?></td>
                                                            <td>Obtained Marks:  <?php echo $result->obtained_marks ?>   /  <?php echo $result->percentage ?>%age</td>
                                                    </tr>
                                                    <br/>
<tr>                
                                                        <td colspan="4">
                                                            <p><strong>Terms & Conditions:</strong><br/></p>
                                                            a) If at any stae, information provided by the applicant, found false or misleading, the amount of concession granted shall be cancelled.<br/>
                                                            b) The awardee shall maintain at least 75% attendance.<br/>
                                                            c) The student shall score not less than 60% marks in the subsequent annual examinations.<br/>
                                                            d) Good academic record shall also be maintained by the awardee. if preformance is not satisfactory, the concession shall be cancelled.
                                                    </tr>
                                                     
                                                    <tr>
                                                        <td colspan="4"><strong>19:- Undertaking:</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">I hereby solemnly declare that the above facts are correct to the best of my knowledge. in case of false information OR not fulfilling of terms & conditioins as stipulated above, the student shall be liable ofr punishment/refund of money.</td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>Date: ........... / ..........   / ............</td>
                                                        <td colspan="2">Parents/Guardians Signature</td>
                                                        <td >Signature of Student</td>
                                                    </tr>
    						</tbody>
    					</table>
    				 
                                 </div>
    			</div>
    		</div>
    	 
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>PART-II  ATTACHMENT / CHECK LIST</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						 
    						<thead>
                                                    <tr>
                                                        <th colspan="4">
                                                            <i class='fa fa-check'></i>  Income Cerfificate of father / guardian.<br/>
                                                            <i class='fa fa-check'></i>  A copy of CNIC of ather / guardian.<br/>
                                                            <i class='fa fa-check'></i>  Educational expenses details of the students and his / her siblings(s)<br/>
                                                            <i class='fa fa-check'></i>  Family's assets, size of familly, source of inceome.<br/>
                                                            <i class='fa fa-check'></i>  A copy of Electricity Bill of family [Most recent]<br/>
                                                        </th>
                                                    </tr>
                                                  
                                                        
                                                  <thead/>
     
    					 
    					</table>
    				 
                                 </div>
    			</div>
    		</div>
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>PART-III  FINANCIAL AID COMMITTEE</strong></h3>
    			</div>
    			<div class="panel-body" style='padding:2px 15px !important;'>
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                                      <tr>
                                                          <td colspan="4">Remarks</td> 
                                                      </tr>
                                                      <tr>
                                                          <td colspan="4"><br/></td> 
                                                      
                                                      </tr>
                                                      <tr>
                                                          <td colspan="4"><br/></td> 
                                                      
                                                      </tr>
                                                      <tr>
                                                      <td colspan="4">
                                                          <strong>FINANCIAL AID COMMITTEE</strong></td> 
                                                      
                                                      </tr>
                                                      <tr>
                                                        <td class="no-line text-center">Sn</td>
                                                        <td class="no-line" >Name</td>
                                                        <td class="no-line">Signature</td>
                                                        <td class="no-line">Date</td>
                                                    </tr>
                                                     <tr>
                                                        <td class="no-line text-center">1</td>
                                                        <td class="no-line text-center"></td>
                                                        <td class="no-line text-center" ></td>
                                                        <td class="no-line text-center" ></td>
                                                    </tr>
                                                     <tr>
                                                        <td class="no-line text-center">2</td>
                                                        <td class="no-line text-center"></td>
                                                        <td class="no-line text-center" ></td>
                                                        <td class="no-line text-center" ></td>
                                                    </tr>
                                                     <tr>
                                                        <td class="no-line text-center">3</td>
                                                        <td class="no-line text-center"></td>
                                                        <td class="no-line text-center" ></td>
                                                        <td class="no-line text-center" ></td>
                                                    </tr>
                                                     <tr>
                                                        <td class="no-line text-center">4</td>
                                                        <td class="no-line text-center"></td>
                                                        <td class="no-line text-center" ></td>
                                                        <td class="no-line text-center" ></td>
                                                    </tr>
                                                 
                                                     
                                                  </thead> 
 
    						 
    					</table>
    				 
                                 </div>
    			</div>
    		</div>
    		<div class="panel panel-default" style='margin-bottom: 10px !important;'>
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>PART-IV  APPROVAL OF THE PRINCIPAL</strong></h3>
    			</div>
    			<div class="panel-body" style='padding:2px 15px !important;'>
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                                  
                                                      <tr>
                                                          <td colspan="4"><br/></td> 
                                                      
                                                      </tr>
                                                      <tr>
                                                          <td colspan="4"><br/></td> 
                                                      
                                                      </tr>
                                                      <tr>
                                                          <td colspan="3">Signature</td> 
                                                          <td >Date</td> 
                                                      
                                                      </tr>
                                                     
                                                       
                                                     
                                                  </thead> 
 
    						 
    					</table>
    				 
                                 </div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
</div>