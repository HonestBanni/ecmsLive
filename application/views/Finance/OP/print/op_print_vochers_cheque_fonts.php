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
        font-size: 11px;
        padding-left: 115px;
        padding-top: 11px;
    }
    .tdSpacePayeesOnly span{
        border-top:1px solid #000;
        border-bottom: 1px solid #000;
    }
    
    .ChequeDate{
        font-size: 11px;
        padding-left: 0px;
        padding-top: 7px;
    }
    .ChequeDate .Day{
        letter-spacing:14px;
    }
    .ChequeDate .Month{
        letter-spacing:14px;
    }
    .ChequeDate .Year{
        letter-spacing:14px;
    }
    .PayeeLess35{
        font-size: 11px;
        padding-top:31px;
    }
    .AmountInWordGrater40{
        font-size: 11px;
        padding-top: 13px;
        padding-left:20px;
      }
     
    .AmountInNumberGrater40{
       font-size: 11px;
       padding-left:22px;
       letter-spacing:4px;
       padding-top: 0px;
     }  
      
   
   
    
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
                    
                        echo '<td width="305px" class="PayeeLess35">'.$result->payee.'</td>';
                        $amount =  ucwords($this->CRUDModel->money_convert($result->check_amount,'1'));
                                 
                        //Amount In Words In Two Lines 
                        echo '<tr style="line-height: 10px;">';
                        echo '<td width="360px" class="AmountInWordGrater40">'.$amount.'</td>';
                        //Amount In Number 
                        echo '<td  class="AmountInNumberGrater40">='.number_format($result->check_amount, 0, ',', ',').'/-</td>';
                        echo '</tr>';
 
                                
                      
                     
                    
                    
                    ?>
                    
                    
           
            </table>
 
 </div>