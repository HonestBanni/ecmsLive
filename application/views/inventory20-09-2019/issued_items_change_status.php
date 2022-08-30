 <div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Issued Items Change Status
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
          <li class="current">Issued Items Change Status
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">
           <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Fixed Barcode Report Panel</span>
                        </h1>
                        <div class="section-content" >
                                <div class="row">
                                      <?php echo form_open('',array('class'=>'form-inline course-finder-form','name'=>'reportForm'));   ?>
                                    <div class="col-md-12">
                                        <div class="form-group ">   
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
                                        <div class="form-group">

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
                                        <div class="form-group">
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
                                            <div class="form-group ">
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
                 
                                        <div class="form-group">
                        <input type="submit" name="search" value="search" class="btn btn-theme">
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
                    <th>Serial No</th>
                    <th>Employee</th>
                    <th>Item name</th>
                    <th>Room Name</th>
                    <th>Issuance Date</th>
                    <th>Item Status</th>
                    <th>Issuance Status</th>
                    <th>Change Status</th>
                </tr>
              </thead>
          <tbody>
              <?php
              $i = 1;
              foreach($result as $row):
              $date = $row->fii_date;
            $newDate = date("d-m-Y", strtotime($date));
              ?>
      <tr>
        <td><span class="label label-success label-icon-only"><?php echo $i; ?></span></td>
        <td><?php echo $row->emp_name;?></td>
        <td><?php echo $row->itm_name;?></td>
        <td><?php echo $row->rm_name;?></td>
        <td><?php echo $newDate;?></td>
        <td><?php echo $row->is_name;?></td>
        <td><?php echo $row->iis_status;?></td>
        <td><a class="btn btn-primary btn-sm" href="InventoryController/change_status_issuance_item/<?php echo $row->fid_id;?>"><b>Change Status</b></a></td>
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
 
 