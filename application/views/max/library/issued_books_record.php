<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">                          
              <h2 align="left">Issued Books  List<span  style="float:right"><a href="LibraryController/add_book" class="btn btn-large btn-primary">Add Books</a></span><hr></h2>
            <h4 style="color:red; text-align:center;">
                <?php print_r($this->session->flashdata('msg'));?>
            </h4>
<form method="post">
        <div class="col-md-12">
            <div class="form-group col-md-2">   
       <input type="text" name="accession_from" placeholder="New Acc. Number" class="form-control" id="accession_number">
       <input type="hidden" name="accession_from" id="accession_from">               
            </div>
            <div class="form-group col-md-2">        
       <input type="text" name="old_accession" placeholder="Old Acc. Number" class="form-control" id="old_accession_no">
        <input type="hidden" name="old_accession" id="old_accession">              
            </div>
        <div class="form-group col-md-4">
            <input type="submit" name="search" value="Search" class="btn btn-theme">
        </div>
        </div>    
    </form>
           
            <?php
            if(@$books):
            ?>
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count($books); ?>
            </button>
            </p>
           
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
                </tr>
              </thead>
              <tbody>
                <?php
                  $i=1;
                  foreach($books as $row):
                    $sts = $row->book_availablity_status_id;
                ?>
                <tr>
                    <td><p><span class="badge badge-success"><?php echo $i; ?></span></p></td>
                    <td><?php echo $row->accession_number;?></td>
                    <td><?php echo $row->old_accession_number;?></td>
                    <td><?php echo $row->book_title;?></td>
                    <td><?php echo substr($row->sub_book_title,0,15);?>....</td>
                    <td><?php echo $row->book_isbn;?></td>
                    <td><?php echo $row->author_name;?></td>
                    <td style="color:red;font-weight:bold"><?php echo $row->title;?></td>       
                </tr>  
                <tr style="font-weight:bold;color:red">
                    <?php
                    $where = array('book_id'=>$row->book_id);
                    $check = $this->LibraryModel->get_IssuanceInfo($where);
                    ?>
                    <td colspan="8">
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
                  $i++;
                  endforeach;
                  ?>
              </tbody>
            </table>
            <?php endif;?>
            </article>
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
 