<?php 
    $language_id = $books->language_id;
    $location_id = $books->location_id;
?>
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">View Book<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">    
        <div class="row">
            <div class="col-md-12">
    <form method="post" action="LibraryController/view_book/<?php echo $books->book_id;?>/<?php echo $book_code->serial_no;?>">           
    <div class="form-group col-md-4">
        <label for="usr">Book Title:</label>
        <input type="text" name="book_name" value="<?php echo $books->book_title;?>" class="form-control" >    
        <input type="hidden" name="book_id" value="<?php echo $books->book_id;?>">        
        <input type="hidden" name="book_id" value="<?php echo $book_code->serial_no;?>">        
    </div>
    <div class="form-group col-md-4">
        <label for="usr">Sub Book Title:</label>
        <input type="text" name="sub_book" value="<?php echo $books->sub_book_title;?>" class="form-control">
    </div>
    <div class="form-group col-md-4">
        <label for="usr">Book ISBN #:</label>
        <input type="text" name="book_isbn" value="<?php echo $books->book_isbn;?>" class="form-control">
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Main Author:</label>
        <input type="text" name="author_name" value="<?php echo $books->author_name;?>" class="form-control">
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Author Status:</label>
        <select name="author_status" class="form-control">
             <option value="<?php echo $books->author_status;?>"><?php echo $books->author_status;?></option>
                <option value="">Select Status</option>
                <option value="Author">Author</option>
                <option value="Editor">Editor</option>
                <option value="Translotor">Translotor</option>
            </select>
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Joint Author:</label>
        <input type="text" name="joint_author" value="<?php echo $books->joint_author_name;?>" class="form-control">
    </div>
         <div class="form-group col-md-3">
        <label for="usr">Book Category:</label>
        <select name="book_category" class="form-control" required="required">
                    <option value=""> Book Category </option>
                    <?php
                    $libCategory = $this->db->query("SELECT * FROM lib_book_category");
                    foreach($libCategory->result() as $LibRow)
                    {
                        if($books->lib_book_cagegory == $LibRow->subject_id):
                            echo '<option selected="selected" value="'.$LibRow->subject_id.'">'.$LibRow->subject_name.'</option>';
                        else:
                            echo '<option value="'.$LibRow->subject_id.'">'.$LibRow->subject_name.'</option>';
                        endif;
                    ?>
                         
                    <?php 
                    }
                    ?>
            </select>
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Author Mark:</label>
        <input type="text" name="author_mark" value="<?php echo $books->author_mark;?>" class="form-control">
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Published By:</label>
    <input type="text" name="publish_by" value="<?php echo $books->publish_by;?>" class="form-control">
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Publisher Address:</label>
    <input type="text" name="publisher_address" value="<?php echo $books->publisher_address;?>" class="form-control">
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Source :</label>
    <input type="text" name="source" value="<?php echo $books->source;?>" class="form-control">
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Subject:</label>
    <input type="text" name="subject_name" value="<?php echo $books->subject_name;?>" class="form-control">
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Sub Subject:</label>
    <input type="text" name="sub_subject_name" value="<?php echo $books->sub_subject_name;?>" class="form-control">
    </div>
    
    <div class="form-group col-md-3">
        <label for="usr">Language:</label>
        <select type="text" name="language_id" class="form-control">
            <?php
            $lang = $this->LibraryModel->get_by_id('lib_book_language',array('lang_id'=>$language_id)); 
            foreach($lang as $grec):
                ?>
            <option value="<?php echo $grec->lang_id;?>"><?php echo $grec->lang_title;?></option>
            <?php
            endforeach;
            ?>
            <option value="">Select Language</option>
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
        <input type="text" name="book_copies" value="<?php echo $books->book_copies;?>" class="form-control">  
    </div>
    <div class="form-group col-md-3">
        <label for="usr">DDC.No:</label>
        <input type="text" name="dvdecmil" value="<?php echo $books->dvdecmil;?>" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Publish Year:</label>
        <input type="number" name="pub_year" value="<?php echo $books->pub_year;?>" class="form-control">      
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Edition:</label>
        <input type="text" name="edition" value="<?php echo $books->edition;?>" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Volume:</label>
        <input type="text" name="volume" value="<?php echo $books->volume;?>" class="form-control">        
    </div>     
    <div class="form-group col-md-3">
        <label for="usr">Purchase Date:</label>
       <input type="date" name="purchase_date" value="<?php echo $books->purchase_date;?>" class="form-control">
    </div>  
    <div class="form-group col-md-3">
        <label for="usr">Price:</label>
        <input type="text" name="price" value="<?php echo $books->price;?>" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Series:</label>
        <input type="text" name="series" value="<?php echo $books->series;?>" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Type:</label>
        <select type="text" name="location_id" class="form-control">
            <?php
            $lang = $this->LibraryModel->get_by_id('lib_books_location',array('location_id'=>$location_id)); 
            foreach($lang as $grec):
                ?>
            <option value="<?php echo $grec->location_id;?>"><?php echo $grec->location_name;?></option>
            <?php
            endforeach;
            ?>
            <option value="">Select Type </option>  
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
        <input type="text" name="pages" value="<?php echo $books->pages;?>" class="form-control">        
    </div>
    <div class="form-group col-md-6">
        <label for="usr">Other materials:</label>
        <input type="text" name="material" value="<?php echo $books->material;?>" class="form-control">        
    </div>    
    <div class="form-group col-md-6">
        <label for="usr">Remarks:</label>
        <input type="text" name="remarks" value="<?php echo $books->remarks;?>" class="form-control">        
    </div>
        </div>
<div class="col-md-12">
    <div class="form-group col-md-3">
        <label for="usr">New Accession Number:</label>
        <input type="text" value="<?php echo $book_code->accession_number;?>" class="form-control">
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Old Accession Number:</label>
    <input type="text" name="old_accession_number" value="<?php echo $book_code->old_accession_number;?>" class="form-control">
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Book Status:</label>
    <input type="text" name="" value="<?php echo $book_code->title;?>" class="form-control">
    </div>
    <div class="form-group col-md-3">
    <input style="margin-top:23px;" type="submit" class="btn btn-primary" name="submit" value="Update">
      </div>
</div>            
    
</div>  
        </form>     

      <!--//form-group-->

    </div>                

                           
                        </div>
                    </div>
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->