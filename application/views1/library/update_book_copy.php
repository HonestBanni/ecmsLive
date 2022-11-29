
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Update Book Copy<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">    
        <div class="row">
        <form method="post" action="LibraryController/update_book_copy/<?php echo $books->serial_no;?>/<?php echo $books->book_id;?>">    
            <div class="col-md-12">
    <div class="form-group col-md-3">
        <label for="usr">Book Name:</label>
        <input type="text" value="<?php echo $books->book_title;?>" class="form-control">        
        <input type="hidden" value="<?php echo $books->serial_no;?>" name="serial_no">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">New Accession Number:</label>
        <input type="text" value="<?php echo $books->accession_number;?>" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Old Accession Number:</label>
        <input type="text" value="<?php echo $books->old_accession_number;?>" class="form-control">        
    </div>
                
    <div class="form-group col-md-3">
        <label for="usr">Book Status:</label>
        <select class="form-control" name="availability_status_id">
            <option value="<?php echo $books->availability_status_id;?>"><?php echo $books->title;?></option>
                <option value="">Select Book Status</option>
            <?php 
            $st = $this->db->query("SELECT * FROM lib_book_availability_status");
            foreach($st->result() as $row):
            ?>
            <option value="<?php echo $row->availability_status_id;?>"><?php echo $row->title;?></option>
            <?php 
            endforeach;
            ?>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="usr">Remarks:</label>
        <input type="text" name="status_remarks" value="<?php echo $books->status_remarks;?>" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <input style="margin-top:23px;" type="submit" value="Update" name="submit" class="btn btn-theme">        
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