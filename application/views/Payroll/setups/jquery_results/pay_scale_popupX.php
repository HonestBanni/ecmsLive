
<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" style="text-align: center; text-transform: uppercase " id="myModalLabel">Revised pay scale <?php echo $result['titles']->fy_year ?> w.e.f  [ <?php echo $this->CRUDModel->date_convert($result['titles']->ps_date)?> ] </h4>
      </div>
      <div class="modal-body">
         <table class="datatable-1 table table-boxed table-bordered table-striped">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th> Financial Year</th>
                    <th>Date</th>
                    <th>Pay Scale Details</th>
                    <th>Status</th>
                    <th>Manage</th>


                </tr>
            </thead>
            <tbody>
            <?php
            $sn = '1';
            foreach($result['PayScaleDetails'] as $rec):

            ?>
            <tr class="gradeA">
                <td><?php echo $sn++?></td>
                <td><?php echo $rec->scale_name;?></td>
  
               </tr>

            <?php

            endforeach;

        ?>


        </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
