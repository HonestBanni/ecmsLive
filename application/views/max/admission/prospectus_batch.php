<style>
    
.blink_text { 

        -webkit-animation-name: blinker;
 -webkit-animation-duration: 1s;
 -webkit-animation-timing-function: linear;
 -webkit-animation-iteration-count: infinite;

 -moz-animation-name: blinker;
 -moz-animation-duration: 1s;
 -moz-animation-timing-function: linear;
 -moz-animation-iteration-count: infinite;
 animation-name: blinker;
 animation-duration: 2s;
 animation-timing-function: linear; 
    animation-iteration-count: infinite; color: red; 
} 

@-moz-keyframes blinker {
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; } 
}

@-webkit-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; } 
} 

@keyframes blinker {  
    0% { opacity: 1.0; } 
    50% { opacity: 0.0; }      
    100% { opacity: 1.0; } 
} 
</style>
        <div class="content container" style="margin-bottom:250px;">
               <!-- ******BANNER****** -->
            <h2 align="left">All Batches <span  style="float:right"><a href="" data-toggle="modal" data-target="#adding" class="btn btn-large btn-primary">Add New Batch</a></span><hr></h2>
            <div class="row cols-wrapper">
                
                <div class="col-md-12">    
                       <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">All Subjects List Search</span>
                        </h1>
                        <div class="section-content" >
                           
                               <div class="row">
                            <?php echo form_open('',array('class'=>'form-inline course-finder-form','name'=>'reportForm'));   ?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php
                                        echo form_input(array(
                                        'name'          => 'ProsBatch',
                                        'id'            => 'ProsBatch',
                                        'value'         => '',
                                        'class'         => 'form-control',
                                        'placeholder'   => 'Batch',
                                        'type'          => 'text',
                                        ));

                                        echo form_input(array(
                                        'name'          => 'batch_id',
                                        'id'            => 'batch_id',
                                        'value'         => '',
                                        'class'         => 'form-control',
                                       'type'          => 'hidden',
                                        ));
                                    ?>
                                </div>
                                <div class="form-group ">
                                    <select class="span8 tip form-control" id="alumiProgrameIdSearch" name="program_id">
                                        <option value="">Select Program</option>
                                        <?php
                                        $q = $this->db->query("SELECT * FROM programes_info");
                                        foreach($q->result() as $rec){
                                        ?>
                                        <option value="<?php echo $rec->programe_id;?>"><?php echo $rec->programe_name;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
<!--                                <div class="form-group">
                                    <select class="span8 tip form-control" id="showAlumiSubProSearch" name="sub_proId">
                                        <option value="">Select Sub Program</option>
                                    </select>
                                </div>-->
                                <div class="form-group">
                                    <button type="submit" name="search" value="search" id="search" class="btn btn-theme">
                                    <i class="fa fa-search"></i> Search </button>
                                </div>
                            </div>  
                            <?php echo form_close(); ?>
                        </div>
                             
                             
                         </div><!--//section-content-->
                        
                        
                    </section>
          
                    </div>
                
                <div class="col-md-12">
                    
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Program</th>
                            <th>Batch Name</th>
                            <th>Amount</th>
                            <th>Date Issuance</th>
                            <th>sub_program</th>
                            <th>Status</th>
                            <th><i class="icon-edit" style="color:#fff;"></i> Update</th>
                            <th><i class="icon-trash" style="color:#fff"></i><b> Delete</b></th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
foreach($result as $rec)  
{
        ?>
        <tr class="gradeA">
            <td><?php echo $rec->programe_name;?></td>
            <td><?php echo $rec->batch_name;?></td>
            <td><?php echo $rec->prospectus_amount;?></td>
            <td><?php echo $rec->date_of_issuance;?></td>
            <td><?php echo $rec->name;?></td>
            <td><?php echo $rec->status;?></td>
            <td><a href="admin/update_p_batch/<?php echo $rec->batch_id;?>"><i class="icon-edit"></i><b> Update</b></a></td>
            <td><a href="admin/delete_p_batch/<?php echo $rec->batch_id;?>" 
                   onclick="return confirm('Are You Sure to Delete This..?')"><i class="icon-trash" style="color:#87a938"></i><b> Delete</b></a></td>
        </tr>

        <?php
}
         ?>
                        </tbody>
                </table>
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   
  <div class="modal fade" id="adding" role="dialog" style="z-index:9999">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Batch</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/add_prospectus_batch">
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Batch Name</label>
                        <div class="controls">
                            <input type="text"  name="batch_name" placeholder="Batch Name Required" data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>  
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Prospectus Amount</label>
                        <div class="controls">
                            <input type="text"  name="prospectus_amount" placeholder="Amount Required" data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>    
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Status</label>
                        <div class="controls">
    <select name="status" class=" form-control span8 tip">
                                <option>&larr; Status &rarr;</option>
                                <option value="on">On</option>
                                <option value="off">Off</option>
                            </select>              
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Issuance Date </label>
                        <div class="controls">
    <input id="name" type="text" placeholder="Issuance Date Required" name="date_of_issuance" class="span8 tip form-control">                
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Program Name</label>
                        <div class="controls">
     <select name="programe_id" class="form-control span8 tip" required>
                                <option>&larr; Programe &rarr;</option>
                        <?php
                $p = $this->db->query("SELECT * FROM programes_info");
                foreach($p->result() as $pr)
                        {        
                        ?>        
                                <option value="<?php echo $pr->programe_id;?>"><?php echo $pr->programe_name;?></option>
                        <?php
                            }
                            ?>    
                            </select>      
                        </div>
                    </div><br>
                    <strong style="color:red">
                        <i class="fa fa-arrow-down fa-2x blink_text" aria-hidden="true"></i>  "Sub Program" Only for Languages Batch.</strong>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Sub Program</label>
                        <div class="controls">
     <select name="lang_spro_id" class="form-control span8 tip">
                                <option>&larr; Sub Programe &rarr;</option>
                        <?php
                $p = $this->CRUDModel->getResults("sub_programes");
                foreach($p as $pr)
                    {        
                    ?>        
            <option value="<?php echo $pr->sub_pro_id;?>"><?php echo $pr->name;?></option>
                    <?php
                        }
                        ?>    
                            </select>      
                        </div>
                    </div>
                    <br>
                    <div class="control-group">
                        <div class="controls">
                            <input type="submit" name="submit" value="Add Record" class="btn btn-primary pull-center">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>

jQuery(document).ready(function(){
    jQuery("#ProsBatch").autocomplete({  
        minLength: 0,
        source: "admin/auto_batches/"+$("#ProsBatch").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#ProsBatch").val(ui.item.batch_name);
            jQuery("#batch_id").val(ui.item.batch_id);
//            jQuery("#subject_flag").val(ui.item.flag);
        }
    }).focus(function() {  
        jQuery(this).autocomplete("search", "");  
    });
});
        
</script>