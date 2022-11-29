
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?php echo $page_header?>
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
          <li class="current"><?php echo $page_header?>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    
   <?php $csTitle = $this->InventoryModel->get_quote_row('invt_quotations_detail', array('quot_id' => $quotid)); ?>
      
    <div class="page-content">
      <div class="row">
           <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('SaveComparative',array('class'=>'course-finder-form')); ?>
                                <div class="row"> 
                                     <div class="col-md-6 col-sm-12">
                                         <label for="name">Prepared for</label>
                                         <?php
                                            echo form_input(array(
                                                'name'          => 'cs_title',
                                                'id'            => 'cs_title',
                                                'class'         => 'form-control',
                                                'value'         => $csTitle->quot_title,
                                                'type'          => 'text',
                                                'readonly'      => 'readonly'
                                            ));
                                            echo form_input(array(
                                                'name'          => 'quotation_id',
                                                'id'            => 'quotation_id',
                                                'class'         => 'form-control',
                                                'value'         => $quotid,
                                                'type'          => 'hidden'
                                            ));
                                                    
                                            $fyId = $this->db->order_by('id', 'desc')->get('financial_year')->row();
                                            echo form_input(array(
                                                'name'          => 'financial_year',
                                                'id'            => 'financial_year',
                                                'class'         => 'form-control',
                                                'value'         => $fyId->id,
                                                'type'          => 'hidden'
                                            ));
                                        ?>
                                     </div>
                                </div>
                                <p>&nbsp;</p>
                                <div class="row">
                                    <div class="col-md-2 col-sm-5">
                                    <label for="name">Comparative For</label>
                                        <select name="quote_for" class="form-control">
                                            <option value="1">Purchase Order</option> 
                                            <option value="2">Work Order</option> 
                                        </select>
                                     </div>
                                    <div class="col-md-2 col-sm-5">
                                    <label for="name">Minute Sheet No.</label>
                                        <?php
                                            echo form_input(array(
                                                'name'          => 'min_sheet',
                                                'id'            => 'min_sheet',
                                                'type'          => 'text',
                                                'class'         =>'form-control',
                                                'required'         =>'required',
                                                ));
                                        ?>
                                     </div>
                                    <div class="col-md-2 col-sm-5">
                                    <label for="name">Requisition No.</label>
                                        <?php
                                            echo form_input(array(
                                                'name'          => 'req_no',
                                                'id'            => 'req_no',
                                                'type'          => 'text',
                                                'class'         =>'form-control',
                                                'required'      =>'required',
                                            ));
                                        ?>
                                     </div>
                                    <div class="col-md-2 col-sm-5">
                                    <label for="name">Date (dd-mm-yyyy)</label>
                                        <?php
                                            echo form_input(array(
                                                'name'          => 'cs_date',
                                                'id'            => 'cs_date',
                                                'type'          => 'text',
                                                'value'         => date('d-m-Y'),
                                                'class'         =>'form-control datepicker',
                                            ));
                                        ?>
                                     </div>
                                    <div class="col-md-2 col-sm-5">
                                    <label for="name">HOD / Estate Manager</label>
                                        <?php echo form_dropdown('signature', $employees, $employee_id,  'class="form-control"'); ?>
                                     </div>
                                    <div class="col-md-2 ">
                                    <?php 
                                        $check_cs_id = $this->CRUDModel->get_where_row('invt_comparative_statement', array('cs_quote_id' => $quotid));
                                        if($check_cs_id):
                                    ?>
                                    <p style="margin:0; margin-top: 5px;">&nbsp;</p>
                                    <a class="btn btn-primary btn-sm" href="GenerateComparative/<?php echo $quotid; ?>"><i class="fa fa-print"></i>Print</a>
                                    <?php else: ?>
                                    <p style="margin:0; margin-top: 5px;">&nbsp;</p>
                                    <button type="submit" name="submit" value="submit" class="btn btn-theme"  id="generateCS"><i class="fa fa-send"></i>Generate</button>
                                    <?php endif; ?>
                                </div>
                                </div>
                          
                                  </div>
                                
                            <?php echo form_close(); ?>
                         </div><!--//section-content-->
                    </section>
                
          
                <div class="panel panel-theme">
                    <div class="panel-body">
                        
                        <?php
                        
                        if($query):
                            $numb = '';
                            echo '<div class="table-responsive">';
                                foreach($query as $wrow):
                                $numb++;
                                echo '<table class="table table-hover" id="table">
                                    <thead>
                                        <tr>
                                            <th colspan="1" align="center">Q # '.$numb.'</th>
                                            <th colspan="2" align="center">Title: '.$wrow->quot_title.'</th>
                                            <th colspan="3">Supplier: '.$wrow->supplier_name.'</th>
                                            <th>
                                                
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th width="5%"></th>
                                            <th width="10%">S No.</th>
                                            <th width="25%">Item Name</th>
                                            <th width="25%">Specifications</th>
                                            <th width="10%">Qunatity</th>
                                            <th width="10%">Unit Price</th>
                                            <th width="15%">Total Price</th>
                                        </tr>';
                                    $serial = '';
                                    $gt     = '';

                                    $query = $this->InventoryModel->get_qd_details('invt_quotations_detail', array('qd_quot_id' => $quotid, 'qd_supplier_id' => $wrow->qd_supplier_id));
                                    foreach($query as $crow):
                                        $serial++;
                                        echo '<tr>
                                            <td></td>
                                            <td>'.$serial.'</td>
                                            <td>'.$crow->item_name.'</td>
                                            <td>'.$crow->qd_specs.'</td>
                                            <td>'.$crow->qd_product_qty.'</td>
                                            <td>'.$crow->qd_product_price.'</td>
                                            <td>'.$crow->qd_total_price.'</td>
                                        </tr>';
                                        $gt += $crow->qd_total_price;
                                    endforeach;
                                        echo '<tr>
                                            <th colspan="5"></th>
                                            <th>Grand Total</th>
                                            <th>'.$gt.'</th>
                                        </tr>
                                    </tbody>
                                </table>';
                                endforeach;
                            echo '</div>';
                        endif;
                        
                        
                        ?>
                        
                        
                        
                        
                    </div>
                </div>
          

          
       
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
     <script>
  $( function() {
    $( ".datepicker" ).datepicker({
        dateFormat: 'd-m-yy'
    });
  } );
  
  </script>