<meta http-equiv="refresh" content="600" url="Teachers_Attendance">
<style>
    #big_stats  i{
        font-size: 25px;
        line-height: 37px;
    color: #000000;
    }
    #big_stats .stat:hover i {
    color: #000000;
    }
</style>
     
<div class="main">
	
	<div class="main-inner">
        <div class="container">
            <div class="row">
                  <div class="span12">
                          <form method="post">
    <input type="date" name="in_date" value="<?php if($in_date): echo $in_date; endif;?>" class="span2" required>
    <input style="margin-top:-10px;padding:4px 16px;" type="submit" name="search" value="Search" class="btn btn-primary">                      
 </form>
                  </div>
            </div>
        </div>
	    <div class="container">
            <div class="row">
                  <div class="span12">
               <div class="widget widget-table action-table">
                   <div class="widget-header"> <i class="icon-bookmark"></i>
                       <h3><a href="#">Staff List</a> 
                           
                           <i class="icon-list"></i>&nbsp;&nbsp;  
                           <span style="color:red">
                               Attendance Date: <?php if($in_date): 
                            $date = date("d-m-Y", strtotime($in_date)); echo $date; else: echo date('d-m-Y'); endif;?>
                           </span>
                       </h3>
                   </div></div></div> <br> 
                      <?php
                if($teachers_attend):
            ?>
            <div class="span6">
               <div class="widget widget-table action-table">
                   <div class="widget-header"> <i class="icon-list"></i>
                       
                       <h3><a href="javascript:void(0)"><span style="color:blue">Today Login Staff: <?php echo count($teachers_attend);?></span></a> 
                            
                           
                       </h3>
                    </div>
                  
            
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered table-hovered">
                <thead>
                  <tr style="font-size:14px;">
                      <th><strong>#</strong></th>
                      <th><strong>Picture</strong></th>
                      <th><strong>Name</strong></th>
                      <th><strong>Designation</strong></th>
                      <th><strong>IN TIME</strong></th>
                      <th><strong>OUT TIME</strong></th>
                  </tr>  
                </thead>
                <tbody>
            <?php
                $sn = 1;
                foreach($teachers_attend as $tp):

                $date = $tp->in_date;
                $date1 = $tp->out_date;

                if($in_date):

                $this->db->order_by('t_attend_id','asc');
                $in_times = $this->db->get_where('teacher_attendance',array('emp_id'=>$tp->emp_id,'in_date'=>$in_date))->row();

                if($in_times->in_time === '00:00:00'){
                $in_time = '';
                } else {
                $in_time = date("h:i:s", strtotime($in_times->in_time));
                }

                $this->db->order_by('t_attend_id','desc');
                $out_times = $this->db->get_where('teacher_attendance',array('emp_id'=>$tp->emp_id,'in_date'=>$in_date))->row();

                if($out_times->out_time === '00:00:00'){
                $out_time = '';
                } else {
                $out_time = date("h:i:s", strtotime($out_times->out_time));
                }

                else:


                $this->db->order_by('t_attend_id','asc');
                $in_times = $this->db->get_where('teacher_attendance',array('emp_id'=>$tp->emp_id,'in_date'=>date('Y-m-d')))->row();

                if($in_times->in_time === '00:00:00'){
                $in_time = '';
                } else {
                $in_time = date("h:i:s", strtotime($in_times->in_time));
                }

                $this->db->order_by('t_attend_id','desc');
                $out_times = $this->db->get_where('teacher_attendance',array('emp_id'=>$tp->emp_id,'in_date'=>date('Y-m-d')))->row();

                if($out_times->out_time === '00:00:00'){
                $out_time = '';
                } else {
                $out_time = date("h:i:s", strtotime($out_times->out_time));
                }

                endif;

                ?>
                            <tr style="font-size:14px;">
                            <td><strong><?php echo $sn; ?></strong></td>
                            <td><img src="assets/images/employee/<?php echo $tp->picture; ?>" width="50" height="30"></td>
                                <td><strong><?php echo $tp->emp_name; ?></strong></td>
                                <td><strong><?php echo $tp->designation; ?></strong></td>
                            <td style="color:#00ba8b;"><strong><?php echo $in_time; ?></strong></td>
                            <td style="color:red"><strong><?php echo $out_time; ?></strong></td>
                            </tr>
                    <?php
                             $sn++; 
                          endforeach;
                    ?>
                </tbody>
              </table>
            </div>
            <!-- /widget-content --> 
          </div>	
	      		<?php else:
                    echo '<h3 style="color:red;margin:200px;">Sorry! Record Not Found ..</h3>';
                endif; ?>
	      		
		    </div> 
                <?php
                if(@$difference):
            ?>
            <div class="span6">
               <div class="widget widget-table action-table">
                   <div class="widget-header"> <i class="icon-list"></i>
                       
                       <h3>
                           <a href="javascript:void(0)"><span style="color:red">Today Not Login Staff: <?php echo count($difference);?></span></a> 
                       </h3>
                    </div>
                  
            
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered table-hovered">
                <thead>
                  <tr style="font-size:14px;">
                    <th><strong>#</strong></th>
                      <th><strong>Picture</strong></th>
                      <th><strong>Name</strong></th>
                      <th><strong>Designation</strong></th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        $sn = 1;
                      //  echo '<pre>';print_r($teachers_absent);die;
                        foreach($difference as $ap):
                           $where = array('emp_id'=>$ap);
                        $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
                        $qry = $this->db->get_where('hr_emp_record',$where)->row();
                        ?>
                    <tr style="font-size:14px;">
                            <td><strong><?php echo $sn; ?></strong></td>
                            <td><img src="assets/images/employee/<?php echo $qry->picture;?>" width="50" height="30"></td>
                            <td><strong><?php echo $qry->emp_name; ?></strong></td>
                            <td><strong><?php echo $qry->title; ?></strong></td>
                     </tr>
                    <?php
                    $sn++;
                    endforeach;
                    ?>
                </tbody>
              </table>
            </div>
            <!-- /widget-content --> 
          </div>	
	      		<?php 
                      else:
                        echo '<h3 style="color:red">Sorry Record Not Found..</h3>';
                      endif; ?>
	      		
		    </div> <!-- /span12 -->          
		    </div> <!-- /span12 -->
                   
              </div>
	      
			
	      
	      
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
    
  

