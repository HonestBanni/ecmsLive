 <div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Return Items
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
          <li class="current">Return Items
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">
           <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Item Return Search Panel</span>
                        </h1>
                        <div class="section-content" >
                                <div class="row">
                                      <?php echo form_open('',array('class'=>' course-finder-form','name'=>'reportForm'));   ?>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-2">   
                                        <?php
                                            echo form_input(array(
                                                'name'          => 'emp_id',
                                                'id'            => 'emp_id',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Employee name',
                                                'type'          => 'text'
                                                ));
                                            echo form_input(array(
                                                'name'          => 'emp_idCode',
                                                'id'            => 'emp_idCode',
                                                'class'         => 'form-control',

                                                'type'          => 'hidden'
                                                ));?>
                                      </div>
                                        <div class="form-group col-md-2">

                                                <?php
                                                  echo form_input(array(
                                                  'name'          => 'blockName',
                                                  'id'            => 'blockName',
                                                  'value'         => '',
                                                  'class'         => 'form-control',
                                                  'placeholder'   => 'Block name',
                                                  'type'          => 'text',
                                                  ));

                                                  echo form_input(array(
                                                  'name'          => 'blockNameId',
                                                  'id'            => 'blockNameId',
                                                  'value'         => '',
                                                  'class'         => 'form-control',
                                                 'type'          => 'hidden',
                                                  ));
                                              ?>
                                           </div>
                                        <div class="form-group col-md-2">
                                                <?php
                                                  echo form_input(array(
                                                  'name'          => 'itemname',
                                                  'id'            => 'itemname',
                                                  'value'         => '',
                                                  'class'         => 'form-control',
                                                  'placeholder'   => 'Item name',
                                                  'type'          => 'text',
                                                  ));

                                                  echo form_input(array(
                                                  'name'          => 'itemnameCode',
                                                  'id'            => 'itemnameCode',
                                                  'value'         => '',
                                                  'class'         => 'form-control',
                                                 'type'          => 'hidden',
                                                  ));
                                              ?>
                                           </div>
                                        <div class="form-group col-md-2">
                                                <?php
                                                  echo form_input(array(
                                                  'name'          => 'tagname',
                                                  'id'            => 'tagname',
                                                  'value'         => '',
                                                  'class'         => 'form-control',
                                                  'placeholder'   => 'Tag No.',
                                                  'type'          => 'text',
                                                  ));
                                              ?>
                                           </div>
                                            <div class="form-group col-md-2">
                                                  <?php
                                                    echo form_input(array(
                                                    'name'          => 'roomname',
                                                    'id'            => 'roomname',
                                                    'value'         => '',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Room',
                                                    'type'          => 'text',
                                                    ));

                                                    echo form_input(array(
                                                    'name'          => 'roomnameCode',
                                                    'id'            => 'roomnameCode',
                                                    'value'         => '',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Room',
                                                    'type'          => 'hidden',
                                                    ));
                                                ?>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                           <?php
                                            echo form_dropdown('itemStatus', $item_status, $itemStatusId,  'class="form-control" id="itemStatus"');
                                           ?>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                           <?php
                                            echo form_dropdown('issuanceStatus', $item_issued_status, $issuanceStatusId,  'class="form-control" id="iiStatus"');
                                           ?>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                        <input type="submit" name="search" value="Search" class="btn btn-theme">
                                      </div>
                                    </div>  
                                </div>
                                    <?php
                                    echo form_close();
                                    ?>
    </div>
    </section>
            <?php if(@$result):?>
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count($result);?>
            </button>
            </p>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>S No</th>
                    <th>Employee</th>
                    <th>Item name</th>
                    <th>Tag Details</th>
                    <th>Department</th>
                    <th>Room Name</th>
                    <th>Issuance Date</th>
                    <th>Item Status</th>
                    <th>Issuance Status</th>
                    <th>Change Status</th>
                    <th>Print</th>
                </tr>
              </thead>
          <tbody>
              <?php
              $i = 1;
//              echo '<pre>'; print_r($result); die;
              foreach($result as $row):
              $date = $row->fii_date;
            $newDate = date("d-m-Y", strtotime($date));
              ?>
      <tr>
        <td><span class="label label-success label-icon-only"><?php echo $i; ?></span></td>
        <td><?php echo $row->emp_name;?></td>
        <td><?php echo $row->itm_name;?></td>
        <td><?php echo $row->fid_tag_no;?></td>
        <td><?php echo $row->deptt_name;?></td>
        <td><?php echo $row->rm_name;?></td>
        <td><?php echo $newDate;?></td>
        <td><?php echo $row->is_name;?></td>
        <td><?php echo $row->iis_status;?></td>
        <td>
            <?php if($row->iis_status == 'Stock'): ?>
            <a class="btn btn-primary btn-sm disabled" href=""><b>Returned</b></a>
            <?php else: ?>
            <a class="btn btn-primary btn-sm" href="InventoryController/change_status_issuance_item/<?php echo $row->fid_id;?>"><b>Return</b></a>
            <?php endif; ?>
        </td>
        <td><a class="btn btn-success btn-sm" target="_blank" href="InventoryController/print_issued_items/<?php echo $row->fid_id;?>"><b>Print</b></a></td>
      </tr>
              <?php 
              $i++;
                endforeach;
              ?>
          </tbody>
            </table>
            <?php endif;?>
            </article>
         
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 