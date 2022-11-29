 
<?php
$Personal = '';
$academic = '';
if($this->input->post('tab') == ''):
      $Personal = 'active'; 
endif;
if($this->input->post('tab') == 'academic'):
      $academic = 'active'; 
endif;


//if($this->input->post('active' == '')):
//    $active = '';
//    else:
//    
//endif;
?>

<ul class="nav nav-tabs">
    <li class="nav-item <?php echo  $Personal?>"><a class="nav-link " href="#PersonalInfoTab" data-toggle="tab" ><h4>Personal Info</h4></a></li>
    
    <?php
     $return_html = '';
  
       
        $chkAT = $this->CRUDModel->get_where_row('hr_emp_education',array('edu_emp_id'=>$this->input->post('employee_id')));
        if(empty($chkAT)):
                $return_html .=   '<li class="nav-item '.$academic.'"><a class="nav-link" href="#AcademicTab" data-toggle="tab" style="color:#FF0000;"><h4>Academic</h4></a></li>';
            else:
                $return_html .= '<li class="nav-item '.$academic.'"><a class="nav-link" href="#AcademicTab" data-toggle="tab"><h4>Academic</h4></a></li>';
        endif;   
        
       echo  $return_html .= '<li class="nav-item"><a class="nav-link" href="#ExperienceTab" data-toggle="tab" ><h4>Experience</h4></a></li>
    <li class="nav-item"><a class="nav-link" href="#DepartmentTab" data-toggle="tab"><h4>Department</h4></a></li>
    <li class="nav-item"><a class="nav-link" href="#FundTaB" data-toggle="tab"><h4>Fund</h4></a></li>
    <li class="nav-item"><a class="nav-link" href="#ShiftTaB" data-toggle="tab"><h4>Shift</h4></a></li>
    <li class="nav-item"><a class="nav-link" href="#BankTaB" data-toggle="tab"><h4>Bank</h4></a></li>
    <li class="nav-item"><a class="nav-link" href="#AllowanceTaB" data-toggle="tab"><h4>Allowance</h4></a></li>
    <li class="nav-item"><a class="nav-link" href="#ResponsibilityTaB" data-toggle="tab"><h4>Responsibility</h4></a></li>
    <li class="nav-item"><a class="nav-link" href="#LetterTaB "data-toggle="tab"><h4>Add Record</h4></a></li>';
//    endif;
        
    ?>

   

</ul>