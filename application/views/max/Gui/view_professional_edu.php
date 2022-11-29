<style>
    label{
        color:#00ba8b;
    }
</style>  
    <div class="main">
	
	   <div class="main-inner">

	    <div class="container">
            <div class="row">
               <h3 align="center">View Professional Education Details<hr></h3>
        <div class="span12" style="min-height:470px;"> 
            <div class="row">   
<div class="span6">
  <label for="usr">Title:</label>
  <input type="text" value="<?php echo $result->title;?>" class="span6"> 
</div>                        
<div class="span6">
  <label for="usr">Affiliated Institute:</label>
  <input type="text" value="<?php echo $result->aff_institute; ?>" class="span6"> 
</div>                        
<div class="span3">
  <label for="usr">Country:</label>
    <?php if($result->country_id):
          $c = $this->GuiModel->get_by_id('country',array('country_id'=>$result->country_id));
          foreach($c as $crec):
          ?>         
    <input type="text" value="<?php echo $crec->name; ?>" class="span3"> 
            <?php 
                endforeach;
               endif;
            ?>
</div>
<div class="span3">
  <label for="usr">Date:</label>
    <?php
        $date = $result->date;
        $newDate = date("d-m-Y", strtotime($date));
      ?>
  <input type="text" value="<?php echo $newDate; ?>" class="span3"> 
</div>
<div class="span3">
  <label for="usr">Duration:</label>
  <input type="text" value="<?php echo $result->duration; ?>" class="span3"> 
</div>
<div class="span3">
  <label for="usr">Remarks:</label>
  <input type="text" value="<?php echo $result->remarks; ?>" class="span3"> 
</div>                
                                                                                            
                 
        
                        </div>
                    </div>
        <br>
                   
    
        
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->