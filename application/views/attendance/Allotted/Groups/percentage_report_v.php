
<script language="javascript">
  function printdiv(printpage)
  {
//    var headstr = "<html><head><title></title></head><body>";
    var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
    var footstr = "</body>";
    var newstr = document.all.item(printpage).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = headstr+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;
    return false;
  }
</script>
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?php echo $ReportName?>
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
          <li class="current"><?php echo $ReportName?>
          </li>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7  page-row">                            
             <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>
            
            <?php
            if(@$result):
            ?>
            <div id="div_print">
                 
                     <h3 align="left">Sub Program <strong> <?php echo $sp_title;?></strong>, Section  <strong> <?php echo $section_name;?></strong></h3> 
               
              <table class="table table-boxed table-hover" style="font-size:13px;">
              <thead>
                 
                <tr>
                  
                  <th width="20px">#</th>
                  <th width="80px">College #</th>
                  <th width="300px">Student Name</th>
                  <th width="250px">Father Name</th>
                  <th width="100px">Father Contact</th>
                  <th width="80px">Absent</th>
                  <th width="80px">Present</th>
                  <th width="80px">Total</th>
                  <th width="80px">Percentage</th>
                   
                  
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                   foreach($result as $resRow):
   
                    ?>
                      <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $resRow->college_no; ?></td>
                                <td><?php echo $resRow->student_name; ?></td>
                                <td><?php echo $resRow->father_name; ?></td>
                                <td><?php echo $resRow->mobile_no; ?></td>
                                <td><?php echo $resRow->Absent; ?></td>
                                <td><?php echo $resRow->Present; ?></td>
                                <td><?php echo $resRow->Total; ?></td>
                                <td><?php echo $resRow->Percentage; ?> %</td> 
                                
                                
                              </tr>
                  <?php
                   $sn++;
                  endforeach;
                ?>
              </tbody>
            </table>
            
            <?php
            echo $print_log;
            else:
                echo '<h3 class="has-divider text-highlight">No query found..</h3>';
            endif;
            ?>
            </div>
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
 
        <script>
        $(function() {
            $('.datepicker').datepicker( {
               changeMonth: true,
                changeYear: true,
                 dateFormat: 'dd-mm-yy'
           
            });
        });
    </script>
   <style>
      .datepicker{
          z-index: 1;
      }
  </style>  