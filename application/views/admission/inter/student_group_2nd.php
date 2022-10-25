<style>
    input[type=checkbox]{
    zoom: 1.5;
    }
</style>

<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left">Student Groups Inter Level</h1>
            <div class="breadcrumbs pull-right">
                <ul class="breadcrumbs-list">
                  <li class="breadcrumbs-label">You are here:</li>
                  <li><?php echo anchor('#', 'Home');?> <i class="fa fa-angle-right"></i></li>
                  <li class="current">Student Groups Inter Level</li>
                </ul>
            </div>
            <!--//breadcrumbs-->
        </header> 
        <div class="page-content">
            <div class="row">
                <article class="contact-form col-md-12 col-sm-7"> 
                    <h3>Assign Students to Group</h3>
                    <div class="col-md-12" style="min-height:70px;">
                        <?php echo form_open('admin/student_group_inter_2nd'); ?>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="student_id" id="group_allotment_inter_1st" placeholder="Student Name">
                                    <input type="hidden" name="student_id" id="student_id">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="button" name="submit" id="add_student_rec" value="Add Student" class="btn btn-theme">
                                </div>
                                <input type="hidden" name="form_Code" id="form_Code" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date); ?>">         
                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <select type="text" name="sec_id" class="form-control" required>
                                        <option value="">Select Section</option>
                                        <?php
                                                $this->db->where_in('sections.sub_pro_id',array(24,25,26,27));
                                                $this->db->order_by('name','asc');
                                                $this->db->order_by('name','asc');
                                        $b =    $this->db->get_where("sections",array('program_id'=>1,'status'=>'On'));
            //                            $b = $this->db->query("SELECT * FROM sections WHERE program_id=1 AND status='On'");
                                        foreach($b->result() as $brec){
                                        ?>
                                            <option value="<?php echo $brec->sec_id;?>"><?php echo $brec->name;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                 <div class="form-group">
                                    <button type="submit" name="save_students" value="Assign Section" class="btn btn-theme"><i class="fa fa-save"></i> Assign Section</button>
                                 </div>
                             </div>
                        </div>
                        <?php echo form_close(); ?>  
                    </div>
                    <div id="studentRecord"></div>
                    <hr>
                    <form>
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="row">
                                <?php
                                $q = $this->db->query("SELECT DISTINCT sections.name as section,sections.sec_id as sec_id,sections.status,sections.program_id 
                                    from sections,student_group_allotment 
                                    where student_group_allotment.section_id = sections.sec_id AND sections.program_id='1' AND sections.status='On' AND sections.sub_pro_id IN ('24','25','26','27') 
                                    order by sections.name asc");
                                foreach($q->result() as $row):
                                    $sec_id = $row->sec_id;
                                    $s = $this->db->query("SELECT `student_record`.`student_name`
                                    FROM `student_record`,`student_group_allotment` 
                                    WHERE `student_group_allotment`.student_id = student_record.student_id AND `section_id`='$sec_id' AND student_record.s_status_id='5'");    
                                
                                    echo '<div class="col-md-3">
                                        <div class="form-group">  
                                            <a href="admin/view_student_group/'.$sec_id.'" class="btn btn-lg btn-primary form-control" style="padding:5px;">
                                                '.$row->section.' (Total: '.$s->num_rows().')
                                            </a> 
                                        </div>
                                    </div>';
                                endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </form>  
                
                    </article>
                <!--//contact-form-->
            </div>
            <!--//page-row-->
        </div>
        <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
</div>
<!--//content-->
 
  <script><!-- comment -->
      
      $(document).ready(function(){
        
            $("#group_allotment_inter_1st").autocomplete({  
                minLength: 0,
                source: "DropdownController/group_allotment_inter_2nd/"+$("#group_allotment_inter_1st").val(),
                autoFocus: true,
                scroll: true,
                dataType: 'jsonp',
                select: function(event, ui){
                $("#group_allotment_inter_1st").val(ui.item.contactPerson);
                $("#student_id").val(ui.item.id);
                $("#college_no").val(ui.item.college_no);
                }
                }).focus(function() {  $(this).autocomplete("search", "");  });
        
        
      
      });
      
  </script><!-- comment -->