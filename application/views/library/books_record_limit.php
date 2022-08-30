<script language="javascript">
function printdiv1(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>
<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left">Accession # List</h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current">Accession # List</li>
                    </ul>
                </div>
    </header> 
    <div class="page-content">        
      <div class="row">
          <div class="col-md-12">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Search Books Accession #</span>
                        </h1>
            <div class="section-content" >
                <form class="course-finder-form" method="post">
                    <div class="row">
            <div class="col-md-3 col-sm-5">
                <label for="name">New Accession # From</label>
        <input type="text" name="accession_from" placeholder="New Accession Number From" class="form-control" id="accession_number">
        <input type="hidden" name="accession_from" id="accession_from">
            </div>
            <div class="col-md-3 col-sm-5">  
            <label for="name">New Accession # To</label>
        <input type="text" name="accession_to" placeholder="New Accession Number To" class="form-control" id="accessionto_number">
        <input type="hidden" name="accession_to" id="accession_to">        
            </div>
            <div class="col-md-3 col-sm-5">
                <label for="name">Old Accession # From</label>
        <input type="text" name="old_accession" placeholder="Old Accession Number From" class="form-control" id="old_accession_no">
        <input type="hidden" name="old_accession" id="old_accession">
            </div>
            <div class="col-md-3 col-sm-5">  
            <label for="name">Old Accession # To</label>
        <input type="text" name="old_accessionto" placeholder="Old Accession Number To" class="form-control" id="old_accessionto_no">
        <input type="hidden" name="old_accessionto" id="old_accessionto">        
            </div>            
            <div class="col-md-3 col-sm-5" style="margin-top:23px;">
                <button type="submit" class="btn btn-theme" name="search" id="search"  value="Search" ><i class="fa fa-search"></i> Search</button>
              <button type="button" class="btn btn-theme" name="print" value="print"  onClick="printdiv1('div_print');"  ><i class="fa fa-print"></i> Print</button>
            </div>
                    </div>        
                </form>
                             
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
                  <?php 
              if(@$book_accession):
              ?>      
<div class="row">
        <div class="col-md-12">
            <div id="div_print">
                <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>Acc#</th>
                    <th>Author</th>
                    <th>Book Title</th>
                    <th>Publish &amp; Place</th>
                    <th>Year</th>
                    <th>Pages</th>
                    <th>Cost</th>
                    <th>Class #</th>
                    <th>Mark</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                foreach($book_accession as $row):
                ?>
              <tr>
                    <td><?php echo $row->accession_number;?><br>(<?php echo $row->old_accession_number;?>)</td>
                    <td><?php echo $row->author_name;?></td>
                    <td width="350"><?php echo $row->book_title;?></td>
                    <td><?php echo $row->publish_by;?><br><?php echo $row->publisher_address;?></td>
                    <td><?php echo $row->pub_year;?></td>
                    <td><?php echo $row->pages;?></td>        
                    <td><?php echo $row->price;?></td>        
                    <td><?php echo $row->dvdecmil;?></td>        
                    <td><?php echo $row->author_mark;?></td>        
                </tr>
                
            <?php  
                endforeach;
                  ?>
                   </tbody>
            </table>
                
                  <?php
                echo $print_log;
                  endif;
                ?>   
            </div>
    </div>
            </div>

        </div>
          </div>
          
      
      </div>
                 </div>
                
      </div>
 
    
    