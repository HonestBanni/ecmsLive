<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">                          
            <h2 align="left">Books  List<span  style="float:right"><a href="LibraryController/add_book" class="btn btn-large btn-primary">Add Books</a></span><hr></h2>
            <h4 style="color:red; text-align:center;"><?php print_r($this->session->flashdata('msg'));?></h4>
            <form method="post">
                <div class="form-group col-md-2">
                <?php       
                if(!empty($book_id)){
                    $rooms = $this->LibraryModel->get_by_id('lib_books_record',array('book_id'=>$book_id));
                    foreach($rooms as $roomrec)
                    { ?>          
                    <input type="text" name="book_id" value="<?php echo $roomrec->book_title; ?>" placeholder="Book Name" class="form-control" id="book">
                    <input type="hidden" name="book_id" id="book_id" value="<?php echo $roomrec->book_id; ?>">      
                    <?php 
                    }     
                }else{?>
                    <input type="text" name="book_id" placeholder="Book Name" class="form-control" id="book"> <input type="hidden" name="book_id" id="book_id">
                    <?php
                    }    
                ?>                  
                </div>
                <div class="form-group col-md-2">
                <?php        
                if(!empty($accession_from)){
                    $acces = $this->LibraryModel->get_by_id('lib_book_code',array('accession_number'=>$accession_from));
                    foreach($acces as $accesrec)
                    { ?>          
                    <input type="text" name="accession_from" value="<?php echo $accesrec->accession_number; ?>" placeholder="New Acc. Number" class="form-control" id="accession_number">
                    <input type="hidden" name="accession_from" id="accession_from" value="<?php echo $accesrec->accession_number; ?>">      
                <?php 
                }     
                }else{?>
                    <input type="text" name="accession_from" placeholder="New Acc. Number" class="form-control" id="accession_number">
                    <input type="hidden" name="accession_from" id="accession_from">
                <?php
                }    
                ?>                  
            </div>
            <div class="form-group col-md-2">
            <?php        
                if(!empty($old_accession)){
                    $oldacces = $this->LibraryModel->get_by_id('lib_book_code',array('old_accession_number'=>$old_accession));
                    foreach($oldacces as $old_accesrec)
                    { ?>          
                    <input type="text" name="old_accession" value="<?php echo $old_accesrec->old_accession_number; ?>" placeholder="New Acc. Number" class="form-control" id="old_accession_no">
                    <input type="hidden" name="old_accession" id="old_accession" value="<?php echo $old_accesrec->old_accession_number; ?>">      
                    <?php 
                    }     
                }else{?>
                    <input type="text" name="old_accession" placeholder="Old Acc. Number" class="form-control" id="old_accession_no">
                    <input type="hidden" name="old_accession" id="old_accession">
                <?php
                }    
                ?>                  
            </div>
            <div class="form-group col-md-2">
            <?php        
                if(!empty($book_category)){
                    
                    $resultBook = $this->db->get_where('lib_book_category',array('subject_id'=>$book_category))->row();
                     if($resultBook)
                    { ?>          
                    <input type="text" name="book_category" value="<?php echo $resultBook->subject_name; ?>" placeholder="Book Category" class="form-control" id="book_category">
                    <input type="hidden" name="book_category_id" id="book_category_id" value="<?php echo $resultBook->subject_id; ?>">      
                    <?php 
                    }     
                }else{?>
                    <input type="text" name="book_category" placeholder="Book Category" class="form-control" id="book_category">
                    <input type="hidden" name="book_category_id" id="book_category_id">
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
                <select name="verified_status" class="form-control">
                    <option value="">All</option>
                    <option value="0">Unverified</option>
                    <option value="1">Verified</option>
                </select>
            </div>
                
            <div class="form-group col-md-2">
                 <?php echo form_dropdown('book_status', $book_status, '',  'class="form-control" id="book_status"'); ?>
            </div>
                
            <div class="form-group col-md-4">
                <input type="submit" name="search" value="Search" class="btn btn-theme">
                <input type="submit" name="export" value="Export" class="btn btn-theme">
            </div>    
        </form>
            <div class="col-md-12">
        <span style="margin-right:30px;color:#208e4c">
            <?php 
            if(@$pages):
                echo $pages;
            else: 
                echo "";
            endif;
            ?>
        </span>
            <?php
            if(@$books):
            if(@$count):
            ?>
        <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo $count; ?>
            </button>
        </p>
            <?php else:?>
        <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count($books); ?>
            </button>
        </p>
            <?php endif;?>
        </div>
        <div class="col-md-12">
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>Serial No</th>
                    <th>New Accession#</th>
                    <th>Old Accession#</th>
                    <th>Book Title</th>
                    <th>Sub Book Title</th>
                    <th>ISBN #</th>
                    <th>Author Name</th>
                    <th>Book Status</th>
                    <th>View Book</th>
                    <th>Status</th>
                    <th>Stock Verification</th>
                    <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $i=1;
                  foreach($books as $row):
                    $sts = $row->book_availablity_status_id;
                    if($sts == 1):
                ?>
                <tr style="color:red">
                    <td><p><span class="badge badge-success"><?php echo $i; ?></span></p></td>
                    <td><?php echo $row->accession_number;?></td>
                    <td><?php echo $row->old_accession_number;?></td>
                    <td><?php echo $row->book_title;?></td>
                    <td><?php echo substr($row->sub_book_title,0,15);?>....</td>
                    <td><?php echo $row->book_isbn;?></td>
                    <td><?php echo $row->author_name;?></td>
                    <td><?php echo $row->title;?></td>
                    <td><a class="btn btn-success btn-sm" href="LibraryController/view_book/<?php echo $row->book_id;?>/<?php echo $row->serial_no;?>">View Book</a></td>
                    <td><a class="btn btn-warning btn-sm" href="LibraryController/update_book_copy/<?php echo $row->serial_no;?>/<?php echo $row->book_id;?>">Edit Status</a></td>
                    <td>
                        <?php
                        if($row->book_verified == 1):
                            echo '<a class="btn btn-success btn-sm change_status" data-toggle="modal" data-target="#ChangeStatusModal" id="'.$row->book_id.'">
                                <input type="hidden" value="'.$row->book_verified.'" id="status_value">
                                <i class="fa fa-check"></i> Verified
                            </a>';
                        else:
                            echo '<a class="btn btn-danger btn-sm change_status" data-toggle="modal" data-target="#ChangeStatusModal" id="'.$row->book_id.'">
                                <input type="hidden" value="'.$row->book_verified.'" id="status_value">
                                <i class="fa fa-close"></i> Verify
                            </a>';
                        endif;
                        ?>
                    </td>
                    <td>
            
             <?php
                    $where = array('book_id'=>$row->book_id);
                    $check = $this->LibraryModel->get_IssuanceInfo($where);
                   
             
            if(empty($check)):
                ?>
                 <a class="btn btn-danger btn-sm" href="LibraryController/delete_book_copy/<?php echo $row->serial_no;?>/<?php echo $row->book_id;?>" onclick="return confirm('Are you Want to Delete this Copy..?')">Delete</a>
                    <?php
                else:
                ?>
                 <p>Book Issued</p>
                    <?php
                    
            endif;
            
            ?>
            
           </td>        
                </tr>
                  <tr style="font-weight:bold;color:red">
                   
                    <td colspan="12">
                        <blink>
                        <?php 
                        if(!empty($check->student_name)): 
                            echo 'Student Name: ' .$check->student_name;
                        endif;
                        if(!empty($check->college_no)): 
                            echo ', College #:' .$check->college_no;
                        endif;
                        if(!empty($check->name)): 
                            echo ', Class Name: ' .$check->name;
                        endif;
                        if(!empty($check->emp_name)): 
                            echo 'Employee Name: ' .$check->emp_name;
                        endif;
                        if(!empty($check->title)): 
                            echo ', Department: ' .$check->title;
                        endif;    
                        if(!empty($check->hod)): 
                            echo 'HOD Name: ' .$check->hod;
                        endif;
                        if(!empty($check->dept)): 
                            echo ', Department Name: ' .$check->dept;
                        endif;
                        
                        ?>
                        </blink>    
                    </td>        
                </tr>
                  <?php
                  else:
                  ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row->accession_number;?></td>
                    <td><?php echo $row->old_accession_number;?></td>
                    <td><?php echo $row->book_title;?></td>
                    <td><?php echo $row->sub_book_title;?></td>
                    <td><?php echo $row->book_isbn;?></td>
                    <td><?php echo $row->author_name;?></td>                    
                    <td><?php echo $row->title;?></td>
    <td><a class="btn btn-success btn-sm" href="LibraryController/view_book/<?php echo $row->book_id;?>/<?php echo $row->serial_no;?>">View Book</a></td>
            <td><a class="btn btn-warning btn-sm" href="LibraryController/update_book_copy/<?php echo $row->serial_no;?>/<?php echo $row->book_id;?>">Edit Status</a></td>
                    <td>
                        <?php
                        if($row->book_verified == 1):
                            echo '<a class="btn btn-success btn-sm change_status" data-toggle="modal" data-target="#ChangeStatusModal" id="'.$row->book_id.'">
                                <input type="hidden" value="'.$row->book_verified.'" id="status_value">
                                <i class="fa fa-check"></i> Verified
                            </a>';
                        else:
                            echo '<a class="btn btn-danger btn-sm change_status" data-toggle="modal" data-target="#ChangeStatusModal" id="'.$row->book_id.'">
                                <input type="hidden" value="'.$row->book_verified.'" id="status_value">
                                <i class="fa fa-close"></i> Verify
                            </a>';
                        endif;
                        ?>
                    </td>
            <td>
                <?php
            
                    $where = array('book_id'=>$row->book_id);
                    $check = $this->LibraryModel->get_IssuanceInfo($where);
             
            if(empty($check)):
                ?>
                 <a class="btn btn-danger btn-sm" href="LibraryController/delete_book_copy/<?php echo $row->serial_no;?>/<?php echo $row->book_id;?>" onclick="return confirm('Are you Want to Delete this Copy..?')">Delete</a>
                    <?php
                else:
                ?>
                 <p>Book Issued</p>
                    <?php
                    
            endif;
            
            ?> 
                
                
               
            </td>
                </tr>
                  <?php
                  endif;
                  $i++;
                  endforeach;
                  ?>
              </tbody>
            </table>
            </div>
            <?php
            else:
                echo "Records Not Found..";
            endif;
                ?>
            </article>
         
          
                <div class="modal fade" id="ChangeStatusModal" role="dialog" style="z-index:9999">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="section-content" id="ChangeStatusResult" >
                                
                            </div>
                        </div>
                    </div>
                </div>
          
          
          
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
<script>

jQuery(document).ready(function(){
    
        jQuery("#book_category").autocomplete({  
        minLength: 0,
        source: "LibraryController/book_category/"+$("#book_category").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#book_category").val(ui.item.contactPerson);
        jQuery("#book_category_id").val(ui.item.id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  
        });

         
    jQuery('.change_status').on('click',function(){
        
        var book_id = jQuery(this).prop('id');
        
          jQuery.ajax({
               type : 'post',
               url  : 'LibraryController/verify_books',
               data : {
                   'book_id' : book_id,
                   'status'  : $('#status_value').val()
               },
              success :function(result){
//                 $('.Student'+student_id).hide(); 
                    jQuery('#ChangeStatusResult').html(result);
              }
           });
    });
    
    
});


</script>