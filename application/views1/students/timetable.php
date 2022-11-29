<style>
table.two-axis tr td:first-of-type {
    background: #dff1f7;
}

@media only screen and (max-width: 568px) {
    table.two-axis tr td:first-of-type,
    table.two-axis tr:nth-of-type(2n+2) td:first-of-type,
    table.two-axis tr td:first-of-type:before {
        background: #dff1f7;
        color: #ffffff;
    }

    table.two-axis tr td:first-of-type {
        border-bottom: 1px solid #e4ebeb;
    }
}
</style>
<ol class="breadcrumb">
  <li class="breadcrumb-item">
      <a href="StudentController/student_home">Home</a> <i class="fa fa-angle-right"></i> 
      <a href="#">Student Time Table</a> 
    </li>
</ol>
<div class="agile-grids">	
    <div class="agile-tables">
        <div class="w3l-table-info">
          <h2 align="center">Student Time Table</h2>
            <table id="table" border="1">
            <tbody> 
            <tr style="font-size:12px">
                <td width="80"  align="center"><strong>Monday</strong></td>
                <?php foreach($resultm as $daym):?>
                <td><?php echo $daym->class_stime;?> - <?php echo $daym->class_etime;?><br>
                    <?php echo $daym->title;?> (<?php echo $daym->emp_name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
            <tr  style="font-size:12px">
                <td width="80"  align="center"><strong>Tuesday</strong></td>
                <?php foreach($resulttu as $daytu):?>
                <td><?php echo $daytu->class_stime;?> - <?php echo $daytu->class_etime;?><br>
                    <?php echo $daytu->title;?> (<?php echo $daytu->emp_name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
            <tr  style="font-size:12px">
                <td width="80"  align="center"><strong>Wednesday</strong></td>
                <?php foreach($resultw as $dayw):?>
                <td><?php echo $dayw->class_stime;?> - <?php echo $dayw->class_etime;?><br>
                    <?php echo $dayw->title;?> (<?php echo $dayw->emp_name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
            <tr  style="font-size:12px">
                <td width="80"  align="center"><strong>Thursday</strong></td>
                <?php foreach($resultth as $dayth):?>
                <td><?php echo $dayth->class_stime;?> - <?php echo $dayth->class_etime;?><br>
                    <?php echo $dayth->title;?> (<?php echo $dayth->emp_name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
            <tr  style="font-size:12px">
                <td width="80"  align="center"><strong>Friday</strong></td>
                <?php foreach($resultf as $dayf):?>
                <td><?php echo $dayf->class_stime;?> - <?php echo $dayf->class_etime;?><br>
                    <?php echo $dayf->title;?> (<?php echo $dayf->emp_name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
                
            </tbody>
          </table>
        <h2 align="center">Practical Time Table</h2>
        <?php 
    $std_id = $this->uri->segment(3);
    $st = $this->CRUDModel->get_where_row('student_record',array('student_id'=>$std_id));
    $pg = $this->CRUDModel->get_where_row('student_prac_group_allottment',array('college_no'=>$st->college_no));
    $where = array('practical_alloted.group_id'=>$pg->group_id);
    $groupm= $this->StudentModel->getgroupDaym('practical_alloted',$where);
    $grouptu = $this->StudentModel->getgroupDaytu('practical_alloted',$where);
    $groupw = $this->StudentModel->getgroupDayw('practical_alloted',$where);
    $groupth = $this->StudentModel->getgroupDayth('practical_alloted',$where);
    $groupf = $this->StudentModel->getgroupDayf('practical_alloted',$where);
        ?>
            <table id="table" border="1">
            <tbody> 
            <tr style="font-size:12px">
                <td width="80"  align="center"><strong>Monday</strong></td>
                <?php foreach($groupm as $daym):?>
                <td><?php echo $daym->class_stime;?> - <?php echo $daym->class_etime;?><br>
                    <?php echo $daym->title;?> (<?php echo $daym->emp_name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
            <tr  style="font-size:12px">
                <td width="80"  align="center"><strong>Tuesday</strong></td>
                <?php foreach($grouptu as $daytu):?>
                <td><?php echo $daytu->class_stime;?> - <?php echo $daytu->class_etime;?><br>
                    <?php echo $daytu->title;?> (<?php echo $daytu->emp_name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
            <tr  style="font-size:12px">
                <td width="80"  align="center"><strong>Wednesday</strong></td>
                <?php foreach($groupw as $dayw):?>
                <td><?php echo $dayw->class_stime;?> - <?php echo $dayw->class_etime;?><br>
                    <?php echo $dayw->title;?> (<?php echo $dayw->emp_name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
            <tr  style="font-size:12px">
                <td width="80"  align="center"><strong>Thursday</strong></td>
                <?php foreach($groupth as $dayth):?>
                <td><?php echo $dayth->class_stime;?> - <?php echo $dayth->class_etime;?><br>
                    <?php echo $dayth->title;?> (<?php echo $dayth->emp_name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
            <tr  style="font-size:12px">
                <td width="80"  align="center"><strong>Friday</strong></td>
                <?php foreach($groupf as $dayf):?>
                <td><?php echo $dayf->class_stime;?> - <?php echo $dayf->class_etime;?><br>
                    <?php echo $dayf->title;?> (<?php echo $dayf->emp_name;?>)
                    </td>
                <?php endforeach;?>
            </tr>
                
            </tbody>
          </table>    
        </div>
    </div>
</div>
