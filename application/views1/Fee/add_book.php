 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <form method="post" name="searching" action="LibraryController/search_old_accession">
        <div class="col-md-12">
        <div class="form-group col-md-2">
           <input type="text" name="old_accession_number" placeholder="Accession Number" class="form-control">
        </div>
        <div class="form-group col-md-2">
            <input type="submit" name="search" value="Search" class="btn btn-theme">
        </div>
        </div>    
                    </form>
           <?php
            if(@$books):        
            ?>       
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
                </tr>
              </thead>
              <tbody>
                  <?php
                  $i=1;
                  foreach($books as $row):
                  ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row->accession_number;?></td>
                    <td><?php echo $row->old_accession_number;?></td>
                    <td><?php echo $row->book_title;?></td>
                    <td><?php echo $row->sub_book_title;?></td>
                    <td><?php echo $row->book_isbn;?></td>
                    <td><?php echo $row->author_name;?></td>
                </tr>
                  <?php
                  $i++;
                  endforeach;
                  ?>
              </tbody>
            </table>
                    <?php
            endif;
                ?>
                </div></div>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h2 align="left">Add Book<hr></h2>
    <form name="student" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>LibraryController/add_book">       
        <div class="row">
            <div class="col-md-12">
    <div class="form-group col-md-3">
        <label for="usr">Book Title:</label>
        <input type="text" name="book_name" placeholder="Book Title" class="form-control" required>        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Sub Book Title:</label>
        <input type="text" name="sub_book" placeholder="Sub Title" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Book ISBN #:</label>
        <input type="text" name="book_isbn" placeholder="Book ISBN #" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Author Name:</label>
        <input type="text" name="author_name" placeholder="Author Name" class="form-control">
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Author Status:</label>
           <select name="author_status" class="form-control">
                <option value="Author">Author</option>
                <option value="Editor">Editor</option>
                <option value="Translotor">Translator</option>
                <option value="Contributor">Contributor</option>
            </select>
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Author Mark:</label>
        <input type="text" name="author_mark" placeholder="Author Mark" class="form-control">
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Published By:</label>
        <input type="text" name="publish_by" placeholder="Published By" class="form-control">
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Publisher Address:</label>
        <input type="text" name="publisher_address" placeholder="Publisher Address" class="form-control">
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Source:</label>
        <input type="text" name="source" placeholder="Source" class="form-control">
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Subject:</label>
        <input type="text" name="subject_name" placeholder="Subject Name" class="form-control">
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Sub Subject:</label>
        <input type="text" name="sub_subject" placeholder="Sub Subject" class="form-control">
    </div>            
    <div class="form-group col-md-3">
        <label for="usr">Language:</label>
        <select type="text" name="language_id" class="form-control">
            <option value=""> Language </option>     
            <?php
            $b = $this->db->query("SELECT * FROM lib_book_language");
            foreach($b->result() as $brec)
            {
            ?>
                <option value="<?php echo $brec->lang_id;?>"><?php echo $brec->lang_title;?></option>
            <?php 
            }
            ?>
        </select>
    </div>       
    <div class="form-group col-md-3">
        <label for="usr">Book Copies:</label>
        <input type="text" name="book_copies" placeholder="book Copies" class="form-control" required>        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">DDC.No:</label>
        <input type="text" name="dvdecmil" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Year of Publishing:</label>
        <input type="text" name="pub_year" placeholder="Year" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Edition:</label>
        <input type="text" name="edition" placeholder="Edition" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Volume:</label>
        <input type="text" name="volume" placeholder="volume" class="form-control">        
    </div>     
    <div class="form-group col-md-3">
        <label for="usr">Purchase Date:</label>
       <input type="date" name="purchase_date" class="form-control">
    </div>  
    <div class="form-group col-md-3">
        <label for="usr">Price:</label>
        <input type="text" name="price" placeholder="Price" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Series:</label>
        <input type="text" name="series" placeholder="Series" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Type:</label>
        <select type="text" name="location_id" class="form-control">
            <option value=""> Select Type </option>     
            <?php
            $b = $this->db->query("SELECT * FROM lib_books_location");
            foreach($b->result() as $brec)
            {
            ?>
                <option value="<?php echo $brec->location_id;?>"><?php echo $brec->location_name;?></option>
            <?php 
            }
            ?>
    </select>
    </div>            
    <div class="form-group col-md-3">
        <label for="usr">Pages:</label>
        <input type="text" name="pages" class="form-control" placeholder="Pages">        
    </div>
    <div class="form-group col-md-6">
        <label for="usr">Other materials:</label>
        <input type="text" name="material" class="form-control" placeholder="Other materials">        
    </div> 
    <div class="form-group col-md-6">
        <label for="usr">Remarks:</label>
        <input type="text" name="remarks" class="form-control" placeholder="Remarks">        
    </div>
               
         
      <div class="form-group">
            <input style="margin-top:23px;" type="submit" class="btn btn-primary" name="submit" value="Add Book">
      </div>
</div>
      <!--//form-group-->

    </div>                

                           
                        </div>
                    </div>
                </form> 
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->