<style>
    label{
        color:#00ba8b;
    }
</style>  
    <div class="main">
	
	   <div class="main-inner">

	    <div class="container">
            <div class="row">
               <h3 align="center">View Research Paper Details<hr></h3>
        <div class="span12" style="min-height:470px;"> 
            <div class="row">   
<div class="span12">
  <label for="usr">Author Name:</label>
  <input type="text" value="<?php echo $result->author;?>" class="span12"> 
</div>
<div class="span12">
  <label for="usr">Paper Title:</label>
  <input type="text" value="<?php echo $result->title;?>" class="span12"> 
</div>                        
<div class="span6">
  <label for="usr">Journal:</label>
  <input type="text" value="<?php echo $result->journal; ?>" class="span6"> 
</div>                        
<div class="span3">
  <label for="usr">Volume:</label>
  <input type="text" value="<?php echo $result->volume; ?>" class="span3"> 
</div>
<div class="span3">
  <label for="usr">Pages:</label>
  <input type="text" value="<?php echo $result->pages; ?>" class="span3"> 
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
  <label for="usr">Year:</label>
  <input type="text" value="<?php echo $result->year; ?>" class="span3"> 
</div>
<div class="span3">
  <label for="usr">Issn:</label>
  <input type="text" value="<?php echo $result->issn; ?>" class="span3"> 
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