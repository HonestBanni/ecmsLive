<style>
    .chequeBody{
        width: 650px;
        height: 180px;
        background-color: yellow;
        transform: rotate(90deg);
        margin-top: 185px;
        padding-top: 130px;
        
    }
    .tdSpacePayeesOnly{
        /*width: 300px;*/
        font-size: 18px;
        padding-left: 95px;
    }
    .tdSpacePayeesOnly span{
        border-top:1px solid #000;
        border-bottom: 1px solid #000;
    }
    .ChequeDateTdFirst{
        
    }
    .ChequeDate{
        font-size: 18px;
        padding-left: 17px;
        padding-top: 1px;
    }
    .ChequeDate .Day{
        letter-spacing:10px;
    }
    .ChequeDate .Month{
        letter-spacing:10px;
    }
    .ChequeDate .Year{
        letter-spacing:10px;
    }
    .ChequePayee{
      /*width: 250px;*/
      font-size: 16px;
      padding-top:1.1em;
    }
    /* Payee count less then 35 Start */
            .PayeeLess35{
              /*width: 250px;*/
              font-size: 16px;
              padding-top:1.5em;
            }
            .AmountInWordGrater40{
                font-size: 18px;
                padding-bottom: 10px;
                padding-left:20px;
              }
            .AmountInNumberGrater40NewLine{
                    font-size: 18px;
                    position: absolute;
                    top: 256px;
                    left: 3px;
              }
            .AmountInWordLess40{
                font-size: 18px;
                padding-bottom: 20px;
                padding-left:20px;
                padding-top:0.4em;
              }
            .AmountInWordLess40PayeeFontLess{
                font-size: 18px;
                padding-bottom: 20px;
                padding-left:20px;
                padding-top: 0.6em;
              }
             .AmountInNumberGrater40{
                font-size: 18px;
                padding-left:45px;
                letter-spacing:2px;
                padding-bottom: 1.2em;
              }  
    
             .AmountInNumberLess40{
                font-size: 18px;
                letter-spacing: 2px;
                position: absolute;
                top: 229px;
                left: 448px;
              }  
    
    /* Payee count less then 35 End */
    
    /* Payee count Grater then 35 Start */
     .ChequePayeeGraterThn36{
        /*width: 250px;*/
        font-size: 14px;
        padding-top:1.8em;
      }
      .PayeeG35AmountInWordGrater40{
            font-size: 18px;
            position: absolute;
            left: 23px;
            top: 233px;
          }
        .PayeeG35AmountInNumberGrater40NewLine{
                font-size: 18px;
                position: absolute;
                top: 256px;
                left: 3px;
          }
        .PayeeG35AmountInNumberGrater40{
              font-size: 18px;
            /* padding-left: 43px; */
            letter-spacing: 2px;
            position: absolute;
            top: 229px;
            left: 444px;
           } 
    /* Payee count Grater then 35 End */
   
   
    
</style>
<div class="chequeBody">
    

            <table>
                <tr>
                    <td width="305px" class="tdSpacePayeesOnly"><span><?php
                    if($result->check_type == 2):
                        echo "Payee's A/c Only"; 
                    else:
                        echo '<br/>';
                    endif;?> 
                        </span></td>
                    <td></td>
                  </tr>
                <tr>
                    <td width="305px"></td>
                    <td class="ChequeDate">
                        <?php 
                    echo '<span class="Day">'.date('d',strtotime($result->check_date)).'</span>';
                    echo '<span class="Month">'.date('m',strtotime($result->check_date)).'</span>';
                    echo '<span class="Year">'.date('Y',strtotime($result->check_date)).'</span>';
                    ?></td>
                    
                  
                  </tr>
                <tr>
                    
                    <?php 
                     
                     if(strlen($result->payee) <=35):
                        echo '<td width="305px" class="PayeeLess35">'.$result->payee.'</td>';
                        $amount =  ucwords($this->CRUDModel->money_convert($result->check_amount,'1'));
                                if(strlen($amount) >40):
                                    //Amount In Words In Two Lines 
                                    echo '<tr style="line-height: 10px;">';
                                    echo '<td width="360px" class="AmountInWordGrater40">'.substr($amount,0,40).'</td>';
                                    //Amount In Number 
                                    echo '<td  class="AmountInNumberGrater40">='.number_format($result->check_amount, 0, ',', ',').'/-</td>';
                                    echo '</tr>';
                                    
                                    echo '<tr>';
                                    echo '<td colspan="2" class="AmountInNumberGrater40NewLine">'.substr($amount,40,100).'</td>';
                                    echo '</tr>';
                                else:
                                    //Amount In Words In One Lines
                                    echo '<tr style="line-height: 10px;">';
                                    echo '<td width="360px" class="AmountInWordLess40">'.substr($amount,0,40).'</td>';
                                    echo '<td  class="AmountInNumberLess40">='.number_format($result->check_amount, 0, ',', ',').'/-</td>';
                                    echo '</tr>';
                                endif;
                                
                                
                                
                       endif;         
                     if(strlen($result->payee) >=36):
                        echo '<td width="305px" class="ChequePayeeGraterThn36">'.$result->payee.'</td>';
                     $amount =  ucwords($this->CRUDModel->money_convert($result->check_amount,'1'));
                         if(strlen($amount) >40):
                                    //Amount In Words In Two Lines 
                                    echo '<tr style="line-height: 10px;">';
                                    echo '<td width="360px" class="PayeeG35AmountInWordGrater40">'.substr($amount,0,40).'</td>';
                                    //Amount In Number 
                                    echo '<td  class="PayeeG35AmountInNumberGrater40">='.number_format($result->check_amount, 0, ',', ',').'/-</td>';
                                    echo '</tr>';
                                    
                                    echo '<tr>';
                                    echo '<td colspan="2" class="AmountInNumberGrater40NewLine">'.substr($amount,40,100).'</td>';
                                    echo '</tr>';
                                    
                                    
                                else:
                                    //Amount In Words In One Lines
                                    echo '<tr style="line-height: 10px;">';
                                    echo '<td width="360px" class="AmountInWordLess40PayeeFontLess">'.substr($amount,0,40).'</td>';
                                    echo '<td  class="AmountInNumberLess40">='.number_format($result->check_amount, 0, ',', ',').'/-</td>';
                                    echo '</tr>';
                                endif;
                     
                     ?>
<!--                        <td></td>
                        </tr>
                        <tr>
                          <td width="305px" class="AmountInWords36"><?php echo ucwords($this->CRUDModel->money_convert($result->check_amount,'1'));?></td>
                          <td  class="AmountInNumber"> = <?php echo number_format($result->check_amount, 0, ',', ',') ?>/-</td>
                        </tr>-->
                         
                         <?php
                     endif;
                     
                    
                    
                    ?>
                    
                    
           
            </table>
 
 </div>