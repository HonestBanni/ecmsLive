
<style>
    body {
    /*background-image: linear-gradient(to bottom, rgba(0,0,0,0.6) 0%,rgba(0,0,0,0.6) 100%), url(assets/images/login.jpg);*/
     background-color: #10331e;
    
  
}
 
    
</style>

<div class="content container">
    <div class="page-wrapper" style=" padding-top: 9%;">
        
        
        
       
           <div class="col-md-12">
                <h1 class="heading-title" style="color:#fff; text-align: center">
                    <?php echo $page_header?>
                </h1>
            <hr/>
      
         
      </div>
     
    <div class="page-content">
         
          <div class="col-md-5 col-md-offset-3">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Staff Login Area</span>
                        </h1>
                        <strong style="color:red;margin-left:50px;"><?php print_r($this->session->flashdata('message'));?></strong>
                        <div class="section-content" >
                           <?php echo form_open('userAuth',array('class'=>'course-finder-form')); ?>
                            
                            <?php 
                                $messge = $this->session->flashdata('login_error'); 
                                if(!empty($messge)):
                                             echo '<div class="alert alert-danger alert-dismissable center">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <strong>'.$messge.'</div>';
                                endif; ?>
                            
                                <div class="row">
                                      
                                     <div class="col-md-12 col-sm-5">
                                         <label for="name">User Name</label>
                                             <?php

                                            echo form_input(array(
                                                'name'          => 'useremail',
                                                'id'            => 'useremail',
                                                'type'          => 'text',
                                              
                                                'class'         => 'form-control',
                                                'placeholder'   => 'User Name',    
                                                ));
                                        ?>
                                         
                                         
                                           <!--<input type="text" placeholder="Username" name="useremail" class="form-control" id="username" />-->
                                     
                                     </div>
                                     </div>
                                     <div class="row">
                                     <div class="col-md-12 col-sm-5">
                                          <label for="name">Password</label>
                                            <!--<input type="password" placeholder="Password" name="password" id="password" />-->
                                        <?php

                                            echo form_input(array(
                                                'name'          => 'password',
                                                'id'            => 'password',
                                                'type'          => 'password',
                                                
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Password',    
                                                ));
                                        ?>
                                       
                                        
                                     </div>
                                    
                                </div>
                            <br/>
                          <div style="padding-top:1%;">
                                    <div class="col-md-12">
                                        <input type="submit" value="Login" class="btn btn-theme form-control">
                                    <!--<button type="submit" class="btn btn-theme" name="Login" id="Login"  value="Login" ><i class="fa fa-search"></i> Login</button>-->
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
              
                    
          </div>
          
      
      </div>
                 </div>
 
      </div>
  
    </div>