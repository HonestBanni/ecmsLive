<style>
    input[type=checkbox]{
    zoom: 1.8;
    }
</style>
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Student Return Books<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12"> 
         <?php if(@$result):?>            
        <div class="row">
        <form method="post" action="LibraryController/update_book_issu_status/<?php echo $student_data->student_id;?>">    
            <div class="col-md-12">
                
    <div class="form-group col-md-3">
        <label for="usr">Student Name:</label>
        <input type="text" value="<?php echo $student_data->student_name;?>" class="form-control">        
        <input type="hidden" value="<?php echo $student_data->student_id;?>" name="student_id">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Father Name:</label>
        <input type="text" value="<?php echo $student_data->father_name;?>" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">College Number:</label>
        <input type="text" value="<?php echo $student_data->college_no;?>" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Return Date:</label>
        <input type="text" name="return_date" value="<?php echo date('d-m-Y');?>" class="form-control date_format_d_m_yy ">        
    </div>
                
    <div class="form-group col-md-3">
        <label for="usr">Book Statuss:</label>
        <select class="form-control" name="availability_status_id" required>
            <option value="">Select Status</option>
            <?php 
            $st = $this->db->query("SELECT * FROM lib_book_availability_status order by title");
            foreach($st->result() as $row):
            ?>
    <option value="<?php echo $row->availability_status_id;?>"><?php echo $row->title;?></option>
            <?php 
            endforeach;
            ?>
        </select>
    </div> 
    <div class="form-group col-md-3">
        <input style="margin-top:23px;" type="submit" value="Update" name="submit" class="btn btn-theme">
    </div>            
         </div>
           
            <table class="table table-boxed table-bordered table-striped">
                <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll" checked></th>
                    <th>S#</th>
                    <th>Book Name</th>
                    <th>Acccession #</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
              $i = 1;
               foreach($result as $urRow):             
                ?>
                <tr>
                <td><input type="checkbox" name="checked[]" value="<?php echo $urRow->accession_no; ?>" id="checkItem" checked>
                <input type="hidden" name="accession_no" >    
                    </td>    
                <td><?php echo $i; ?></td>
                <td><?php echo $urRow->book_title; ?></td>
                <td><?php echo $urRow->accession_no; ?></td>
                <td><?php echo $urRow->title; ?></td>
                </tr>
                <?php
              $i++;
              endforeach;
            ?> 
            </tbody>        
            </table> 
            <?php 
            else: echo '<strong style="color:red;font-size:18px;">Sorry ! Result not Found.. </strong>'; endif;?>
            </form>            
      <!--//form-group-->

    </div>                

                           
                        </div>
                    </div>
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->