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
            <h1 class="heading-title pull-left">Spine Lables</h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current">Spine Lables</li>
                    </ul>
                </div>
    </header> 
    <div class="page-content">        
      <div class="row">
          <div class="col-md-12">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Search Spine Lables</span>
                        </h1>
            <div class="section-content" >
                <form class="course-finder-form" method="post">
                    <div class="row">
            <div class="col-md-3 col-sm-5">
                <label for="name">From</label>
        <input type="text" name="accession_from" placeholder="Accession Number From" class="form-control" id="accession_number" required>
        <input type="hidden" name="accession_from" id="accession_from">
            </div>
            <div class="col-md-3 col-sm-5">  
            <label for="name">To</label>
        <input type="text" name="accession_to" placeholder="Accession Number To" class="form-control" id="accessionto_number" required>
        <input type="hidden" name="accession_to" id="accession_to">        
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
                <?php 
                $book_accession1 = array_chunk($book_accession,2);
                foreach($book_accession1 as $row):
                if(!empty($row[0])):
                ?>
                <div style="width:100%;">
                <div style="width:42%; height:107px; border:2px solid #000; margin-right:28px;margin-bottom:33px; float:left;margin-left:20px">
        <div style="width:50%; float:left; height:98px; padding:10px;line-height: 22px;">
            <p>
                <strong style="font-weight: 900;">Class: <u><?php echo $row[0]->dvdecmil;?></u></strong><br>
                <strong style="font-weight: 900;">AUT: <u><?php echo $row[0]->author_mark;?></u></strong><br>
                <strong style="font-weight: 900;">Acc#: <u><?php echo $row[0]->accession_number;?></u></strong><br>
                <strong style="font-weight: 900;">Old Acc#: <u><?php echo $row[0]->old_accession_number;?></u></strong><br>
            </p>
        </div>
        <div style="width:35%; float:right; height:98px; padding:2px;">
            <img src="assets/RQ/library_rq/<?php echo $row[0]->barcode_image;?>" width="100" height="100">
        </div>
                </div>
                <?php  endif; 
                if(!empty($row[1])):
                ?>
                <div style="width:42%; height:107px; border:2px solid #000; margin-right:28px;margin-bottom:33px; float:left;margin-left:20px;">
        <div style="width:50%; float:left; height:98px; padding:10px;line-height: 22px;">
            <p>
                <strong style="font-weight: 900;">Class: <u><?php echo $row[1]->dvdecmil;?></u></strong><br>
                <strong style="font-weight: 900;">AUT: <u><?php echo $row[1]->author_mark;?></u></strong><br>
                <strong style="font-weight: 900;">Acc#: <u><?php echo $row[1]->accession_number;?></u></strong><br>
                <strong style="font-weight: 900;">Old Acc#: <u><?php echo $row[1]->old_accession_number;?></u></strong><br>
            </p>
        </div>
        <div style="width:35%; float:right; height:98px; padding:2px;">
            <img src="assets/RQ/library_rq/<?php echo $row[1]->barcode_image;?>" width="100" height="100">
        </div>
                </div>
            <?php  
                endif;
                endforeach;
                ?>    
            </div>
            </div>
    </div>
            </div>

        </div>
          <?php 
            endif; 
          ?>
          </div>
          
      
      </div>
                 </div>
                
      </div>
 
    
    