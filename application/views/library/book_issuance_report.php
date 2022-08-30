        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left"><?php echo $ReportName?>
                <hr>
            </h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $ReportName?> Panel</span>
                        </h1>
                        <div class="section-content" >
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <label for="name">From</label>
                                    <?php
                                        echo  form_input(
                                             array(
                                                'name'          => 'from_date',
                                                'id'            => 'from_date',
                                                'type'          => 'text',
                                                'value'         => date('d-m-Y'),
                                                'class'         => 'form-control datepicker',
                                                'placeholder'   => 'From',
                                            )
                                        );
                                    ?>  
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="name">To</label>
                                    <?php
                                        echo  form_input(
                                             array(
                                                'name'          => 'to_date',
                                                'id'            => 'to_date',
                                                'type'          => 'text',
                                                'value'         => date('d-m-Y'),
                                                'class'         => 'form-control datepicker',
                                                'placeholder'   => 'To',
                                            )
                                        );
                                    ?>  
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="name">Subject</label>
                                    <?php
                                        echo  form_input(
                                             array(
                                                'name'          => 'subject',
                                                'id'            => 'subject',
                                                'type'          => 'text',
                                                'value'         => '',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Subject Name',
                                            )
                                        );
                                    ?>  
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <label for="name" style="visibility: hidden">SubjectSubjectSubjectSubject</label>
                                    <button type="button" class="btn btn-theme search_filter" name="filter" id="search_filter"><i class="fa fa-search"></i> Search</button>  
                                </div>
                            </div>
                        </div><!--//section-content-->  
                    </section>
                    <div id="result_div"></div>
                      
            </div><!--//col-md-3-->
        </div><!--//cols-wrapper-->
    </div><!--//content-->
       
<script>
    $(document).ready(function(){

      $('#search_filter').on('click', function(){
  //        alert('test');
          var data = {
              'from_date' : $('#from_date').val(),
              'to_date'   : $('#to_date').val(),
              'subject'   : $('#subject').val(),
          }
          $.ajax({
              type : 'post',
              url : 'LibraryController/search_book_issuance_report',
              data : data,
              success : function(result){
                  $('#result_div').html(result);
              }
          });
        });
    });
    
    $(function(){
        $('.datepicker').datepicker( {
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
    });
    
</script>