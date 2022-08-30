<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class veevo_api {
public function message($receiver,$textmessage,$mask){
            $APIKey = '46c8dab418f8eb7fbe0def2677ce8339de594c5a';
        $url = "http://api.smilesn.com/sendsms?hash=".$APIKey. "&receivenum=" .$receiver. "&sendernum=" .urlencode($mask)."&textmessage=" .urlencode($textmessage);

        #----CURL Request Start
        $ch = curl_init();
        $timeout = 30;
        curl_setopt ($ch,CURLOPT_URL, $url) ;
        curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
        $response = curl_exec($ch) ;
        curl_close($ch) ; 
        #----CURL Request End, Output Response
//        echo $response ;
        $result = json_decode($response);
        echo '<pre>';print_r($result);
   
        
	}
}