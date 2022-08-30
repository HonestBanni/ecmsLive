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
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">                          
              <h2 align="left">Print Spine Labels and Books Identity<hr></h2>
            <h4 style="color:red; text-align:center;">
                <?php print_r($this->session->flashdata('msg'));?>
            </h4>
<form method="post">
        <div class="col-md-12">
            <div class="form-group col-md-4">
                <input type="text" name="old_accession_number" value="<?php if($old_accession_number): echo $old_accession_number; endif;?>" class="form-control" placeholder="Old Accession # with Comma">    
            </div>
            <div class="form-group col-md-4">
                <input type="text" name="accession_number" value="<?php if($accession_number): echo $accession_number; endif;?>" class="form-control" placeholder="New Accession # with Comma">    
            </div>
            <div class="form-group col-md-4">
            <?php       
                if(!empty($book_id)){
                    $rooms = $this->LibraryModel->get_by_id('lib_books_record',array('book_id'=>$book_id));
                    foreach($rooms as $roomrec)
                    { ?>          
        <input type="text" name="book_id" value="<?php echo $roomrec->book_title; ?>" placeholder="Book title" class="form-control" id="book">
                    <input type="hidden" name="book_id" id="book_id" value="<?php echo $roomrec->book_id; ?>">      
                    <?php 
                    }     
                }else{?>
       <input type="text" name="book_id" placeholder="Book title" class="form-control" id="book"> <input type="hidden" name="book_id" id="book_id">
                    <?php
                    }    
                ?>                  
            </div>
        <div class="form-group col-md-2">
            <input type="text" name="author_name" value="<?php if($author_name): echo $author_name; endif;?>" placeholder="Author Name" class="form-control">
        </div>
        <div class="form-group col-md-2">
            <input type="text" name="subject_name" value="<?php if($subject_name): echo $subject_name; endif;?>" placeholder="Subject Name" class="form-control">
        </div>
        <div class="form-group col-md-2">
            <input type="submit" name="search" value="Search" class="btn btn-theme">
            <button type="button" class="btn btn-theme" name="print" value="print"  onClick="printdiv1('div_print');"  ><i class="fa fa-print"></i> Print</button>
        </div>
        </div>    
            </form>
            </article>
          <article class="contact-form col-md-12 col-sm-7">
        <div id="div_print">
              <?php 
              if(@$print_books):
              foreach($print_books as $row):
              ?>
    <div style="width:100%;height:180px;margin-bottom:24px;">
        <div style="width:53%;float:left;border:2px solid #000;">
            <div style="width:100%; float:left;height:160px;padding:5px 5px;line-height:24px;">
            <p>
                <strong><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar' width="160px;" style="margin-bottom:12px;"></strong><img style="float:right" src="assets/RQ/library_rq/<?php echo $row->barcode_image;?>" width="90" height="90">
                <strong style="font-weight:900">Classification: <u><?php echo $row->dvdecmil;?></u></strong><br>
                <strong style="font-weight:900">Author Mark: <u><?php echo $row->author_mark;?></u></strong><br>
                <strong style="font-weight:900">Accession#: <u><?php echo $row->accession_number;?></u></strong><br>
                <strong style="font-weight:900">Old Accession#: <u><?php echo $row->old_accession_number;?></u></strong><br>
            </p>
            </div>
        </div>
        <div style="width:43%;float:right;border:2px solid #000;margin-top:40px;">
            <div style="width:50%;float:left;height:90px;line-height:22px;margin-top:2px 2px;margin-left:10px;">
            <p>
    <strong style="font-weight:900">Class: <u><?php echo $row->dvdecmil;?></u></strong><br>
    <strong style="font-weight:900">AUT: <u><?php echo $row->author_mark;?></u></strong><br>
    <strong style="font-weight:900">Acc#: <u><?php echo $row->accession_number;?></u></strong><br>
    <strong style="font-weight:900">Old Acc#: <u><?php echo $row->old_accession_number;?></u></strong><br>
            </p>
        </div>
        <div style="width:35%;float:right;height:90px;margin-top:2px;">
            <img src="assets/RQ/library_rq/<?php echo $row->barcode_image;?>" width="85" height="85">
        </div>
        </div>
    </div>
              <?php 
              endforeach;
              endif;?>
     </div>    
            </article>
       
      </div>
    <!--//page-row-->
    </div>
  <!--//page-content-->
  </div>
<!--//page-wrapper--> 
</div>
 