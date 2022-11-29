
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"> <?php echo $header?> 
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
          <li> 
            
            <?php echo anchor('userRole', 'User Role');?> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current"><?php echo $header?>
          </li>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <div class="faq-wrapper col-md-11 col-sm-7 col-md-offset-0">                         
                            <div class="panel-group" id="accordion">
                                   <?php echo  form_open('SMenuSettingSave');?>
                                    
                                <div class="panel panel-default">
                                 
                                    <?php
 
                                    
                                    if($menu1):
                               foreach($menu1 as $row1):
                                    
                                    ?>
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $row1->m1_id?>" aria-expanded="false" class="collapsed">
                                            <?php echo $row1->m1_name; ?>
                                            </a>
                                        </h4>
                                    </div><!--//pane-heading-->
                                    <div id="collapse-<?php echo $row1->m1_id?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <input value="<?php echo $this->uri->segment(2)?>" name="urIds" type="hidden" >
                                        <div class="panel-body">
                                            <div class="form-group">
                                                 
                                                <?php
                                                        
                                                    $this->db->join('menul2','menul2.m2_id=menul3.m3_m2Id');  
                                                    $this->db->group_by('menul2.m2_id');
                                                    $this->db->where(array('m3_m1Id'=>$row1->m1_id));
                                                    $level_2_menu = $this->db->get('menul3')->result();
                                                    foreach($level_2_menu as $level2Row):
                                                   
                                                    echo '<h4 class="has-divider text-highlight">'.$level2Row->m2_name.'</h4>';
                                          
                                                ?>
                                                
                                                
                                               
                                                 
                                                 
                                                 <div class="row">
                                                   <?php
                                                                      $this->db->order_by('m3_name','asc');
                                                   $menu2           =   $this->CRUDModel->get_where_result('menul3',array('m3_status'=>1,'m3_m2Id'=>$level2Row->m2_id,'m3_m1Id'=>$row1->m1_id));   
//                                                 echo '<pre>';print_r($menu2);
                                                   if($menu2):
                                                       foreach($menu2 as $row2):
                                                       
                                                       $where =array(
                                                           'upl3_urId'=>$this->uri->segment(2),
                                                           'upl3_m1Id'=>$row1->m1_id,
                                                           'upl3_m2Id'=>$level2Row->m2_id,
                                                           'upl3_m3Id'=>$row2->m3_id,
//                                                            'up2_m2Id'=>$row2->m2_id,
                                                            
                                                           );
                                                   
                                                   
                                                       echo '<div class="col-md-4">
                                                                    <div class="checkbox">
                                                                <label>'; 
                                                                $query = $this->CRUDModel->get_where_row('user_policyl3',$where);
                                                                if($query):
                                                                    echo '<input type="checkbox" name="checkBox[]" checked="checked" value="'.$row1->m1_id.','.$level2Row->m2_id.','.$row2->m3_id.'">'.$row2->m3_name;
                                                                    else:
                                                                    echo '<input type="checkbox" name="checkBox[]" value="'.$row1->m1_id.','.$level2Row->m2_id.','.$row2->m3_id.'">'.$row2->m3_name;
                                                                endif;
                                                                
                                                                
                                                                    echo '</label>
                                                                    </div>
                                                                </div>';
                                                     
                                                       endforeach;
                                                   endif;
                                                   ?>
                                                   
                                                
                                            </div> 
                                                <?php
                                                      endforeach;
                                                ?>
                                            </div>
                                            
                                         
                                        </div><!--//panel-body-->
                                    </div><!--//panel-colapse-->
                                 
                               <?php
                               endforeach;   
                                endif;
                                ?>
                                </div><!--//panel-->
                                <div class="form-group">
                                    <button type="submit" name="export" value="save" class="btn btn-theme">
                                        <i class="fa fa-save">
                                      </i> Update
                                    </button>
                                  </div>
                                
                                
                               <?php
                                echo form_close();
                                ?>  
                            
                                
                            </div><!--//panel-group-->                                                
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
 
 