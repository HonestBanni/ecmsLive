 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
           
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <h3 align="left">Add Comments (<strong><?php echo $result->emp_name;?></strong>)<hr></h3>
                    
    <form  method="post">       
        <div class="row">
            <div class="col-md-12">
    <div class="form-group col-md-12">
        <label for="usr">Add Remarks:</label>
        <input type="hidden" name="emp_id" value="<?php echo $result->emp_id;?>">
        <input type="text" name="comments" placeholder="Add Remarks Here..." class="form-control" required>
    </div>         
      <div class="form-group">
            <input style="margin-top:23px;" type="submit" class="btn btn-primary" name="submit" value="Add Remarks">
            <input style="margin-top:23px;" type="button" value="Go Back"  class="btn btn-Theme" onclick="window.history.back()" /> 
      </div>
</div>
      <!--//form-group-->
    </div>                
                </form> 
                           
                        </div>
                    </div>
    <table class="table table-bordered table-hovered table-boxed">
            <thead>
                <tr>
                    <th>Comments</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(@$commts):
                foreach($commts as $row):
                ?>
                <tr>
                    <td><?php echo $row->comments;?></td> 
                    <td><?php echo $row->date;?></td> 
                </tr>
                <?php    
                endforeach;
                endif;
                ?>    
            </tbody>
    </table>        
               </div><!--//col-md-3-->