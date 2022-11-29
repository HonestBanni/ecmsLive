 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Add Book<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form name="student" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>LibraryController/add_book_copy">       
        <div class="row">
            <div class="col-md-12">
    <div class="form-group col-md-3">
        <label for="usr">Book Title:</label>
        <input type="text" name="book_id" placeholder="Book Name" class="form-control" id="book" required>      
        <input type="hidden" name="book_id" id="book_id">        
    </div>
   
    <div class="form-group col-md-3">
        <label for="usr">Book Copies:</label>
        <input type="text" name="book_copy" placeholder="book Copy" class="form-control">        
    </div>
      <div class="form-group">
            <input style="margin-top:23px;" type="submit" class="btn btn-primary" name="submit" value="Add Book Copy">
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