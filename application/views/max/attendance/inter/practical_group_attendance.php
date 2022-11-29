<style>
    input[type=checkbox]{
    zoom: 1.5;
    }
</style>

<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Student Groups</h1>
      <div class="breadcrumbs pull-right">
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-label">You are here:
          </li>
          <li> 
            <?php echo anchor('admin/add_group_student', 'Home');?> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current">Student Practical Groups Attendance 
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
            <article class="contact-form col-md-12 col-sm-7"> 
        <form>
            <div class="row">
             <div class="col-md-12">
                 <div class="row">
                        <?php
                        
                        
                             foreach($result as $row){ ?>
                        <div class="col-md-3">
                            <div class="form-group">  
                        <a href="PracticalGroupChartView/<?php echo $row->prac_group_id;?>">
                        <input style="background-color:#337ab7; color:#fff; height:40px; border:1px solid #337ab7; text-align:center" value="<?php echo $row->group_name;?> (Total: <?php echo $row->counts;?>)" class="form-control" readonly></a> 
                                </div>
                </div>
                         <?php } ?>
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
 
 