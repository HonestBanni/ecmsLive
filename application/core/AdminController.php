<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
        
        public function __construct() {
             parent::__construct();
              ini_set('max_execution_time', 0); 
              ini_set('memory_limit','2048M');
              
              ini_set('query_cache_type','1');
              ini_set('query_cache_size','10M');
              ini_set('query_cache_limit','256K');
              
              
              
//              ini_set('query_cache_limit','256K');
              
// query_cache_type=1
//
//query_cache_size = 10M
//
//query_cache_limit=256k
              
              $this->db->query('RESET QUERY CACHE');
              $this->db->query('FLUSH QUERY CACHE');
//              $this->db->query('SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,"ONLY_FULL_GROUP_BY",""))');
              
             $session = $this->session->all_userdata();
     
                if(empty($session['userData']['loginStatus'])){
                   redirect('login');
                }
 
                date_default_timezone_set('Asia/Karachi');
       
            $this->load->model('CRUDModel');
            $this->load->model('DropdownModel');
            $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
            $this->data['print_log']    = $this->current_log_info();
            $this->url_security();
        }
        
        public function getUser(){
                    $session        = $this->session->all_userdata();
                    return $session['userData'];
            }
        public function default_fee_bank(){
                    return  $this->db->get_where('bank',array('default_account'=>1))->row();
                    
            }
        public function current_log_info(){
                $session        = $this->session->all_userdata();
                $user_id        = $session['userData']['user_id'];
                $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');
                $user_details   =$this->db->get_where('users',array('id'=>$user_id))->row()->emp_name;
                if($user_id == 1):
                    return '';
                    else:
                    return '<span style="font-size:10px;">Print By : '.$user_details.'  Date : '.date('d-m-Y H:i:s').'</span>';
                endif;
            
        }    
        public function student_record_log_check($student_id){
            
//          echo '<pre>';print_r($this->db->get_where('student_record',array('student_id'=>$student_id))->row());
//          echo '<pre>';print_r($this->input->post());die;
            
//                
//            
//                $session        = $this->session->all_userdata();
//                $user_id        = $session['userData']['user_id'];
//                $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');
//                return $this->db->get_where('users',array('id'=>$user_id))->row()->emp_name;
        }    
        public function url_security(){
               $segs    = $this->uri->segment_array();
               $url     = '';
               $sn      = '';
               $count_url = count($segs);
               foreach ($segs as $element) {
                   $sn ++;
                   if($count_url == $sn):
                        if(is_numeric($element)):
                           $url .= ':num';
                        else:
                            $url .= $element;
                       endif;
                    else:
                       if(is_numeric($element)):
                            $url .= ':num/';   
                        else:
                           $url .= $element.'/';
                       endif;
                    endif;
                    
                }
               
                if($url === 'admin/admin_home' || $url === 'Admin/admin_home'):
                    
               else:
                
                
                //URL Insert Section
                $user_menu      = '';
                $message        = '';
//                $check          = $this->db->get_where('menu_extra_url',array('url'=>$url));
                $url_2_info     =  $this->db->get_where('menul2',array('m2_function'=>$url))->row();
                $url_3_info     =  $this->db->get_where('menul3',array('m3_function'=>$url))->row(); 
                                
                if($url_2_info):
                     
                    //  echo '<pre>';print_r($url_2_info);
                        $m2_id     = $url_2_info->m2_id;
                            $where = array(
                                'upl2_urId'    => $this->userInfo->user_roleId,  
                                'up2_m2Id'     => $m2_id 
                           );
                           
                        $url_menu_2 =   $this->db->get_where('user_policyl2',$where);
                        if($url_menu_2->num_rows()>0):
                           
                           $message     = 'User register in this menu';
                        else:
                           
                           $message     = 'User NOT register in this menu'; 
                            redirect('restricted');
                        endif;
                endif;
                
                if($url_3_info):
                    $m3_id     = $url_3_info->m3_id;
                        $where = array(
                            'upl3_urId'    => $this->userInfo->user_roleId,  
                            'upl3_m3Id'     => $m3_id 
                       );
                           
                        $url_menu_3 =   $this->db->get_where('user_policyl3',$where);
                        if($url_menu_3->num_rows()>0):
                            $message     = 'User register in this menu';
                        else:
                            $message     = 'User NOT register in this menu';
                            redirect('restricted');
                        endif;
                endif; 
                endif; 
               
             
       }  
        public function barcode($code){
       
//            echo 'test';die;
            //I'm just using rand() function for data example
        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');
      
        //generate barcode
//        Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
        
        $barcodeOptions = array(
            'text'      => $code,
            'barHeight' =>60,
            'barThickWidth' =>5,
            'font'=>'10'
            );
//        $barcodeOptions = array('text' => 'ZEND-FRAMEWORK','barHeight'=> 13,'factor'=>3.98,'barWidth'=>0.254);
        $rendererOptions = array('imageType'          =>'png', 
                                 'horizontalPosition' => 'center', 
                                 'verticalPosition'   => 'middle',
                                 
            );
        $file= Zend_Barcode::draw('code128', 'image', $barcodeOptions, $rendererOptions);
//         $code = time().$code;
            $store_image = imagepng($file,"assets/barcode/{$code}.png");
//            $store_image = imagepng($file,"assets/images/students/{$code}.png");
            return $code.'.png';
        
        

        } //End of Barcode generation function  
        
        public function RQ($fileName,$dir){
      
        
        $this->load->library('ciqrcode');
        $params['data'] = $fileName;
        $params['level'] = 'M';
        $params['size'] = 10;
        $params['savename'] = $dir.$fileName.'.png';
        $this->ciqrcode->generate($params);
        return $fileName.'.png';
     }
        public function get_mac(){
//        $string = exec('getmac');
//        return substr($string, 0, 17); 
        
        
         // Turn on output buffering
            ob_start();
            //Get the ipconfig details using system commond
            system('ipconfig /all');

            // Capture the output into a variable
            $mycom=ob_get_contents();
            // Clean (erase) the output buffer
            ob_clean();

            $findme = "Physical";
            //Search the "Physical" | Find the position of Physical text
            $pmac = strpos($mycom, $findme);

            // Get Physical Address
            $mac=substr($mycom,($pmac+36),17);
            //Display Mac Address
            echo $mac;
    }
    
        public function send_message($receiver,$message,$network=NULL){
            
           $mask       = 'edwardesecp';//Default     
//           $mask       = 'EDWARDESCP';//Default     
//           $mask       = '8583';//Default     
        $APIKey = '105968496094187285c2e025e027075de5ab1b40'; //One ID HASH
//        $APIKey = '105968496094187285c2e025e027075de5ab1b40asdf'; //Veevo Tech HASH
 
        
        if(!empty($network)):
             
            $url = "http://api.smilesn.com/sendsms?hash=".
                $APIKey."&receivenum=" .
                $receiver."&sendernum=" .
                urlencode($mask)."&textmessage=".
                urlencode($message)."&receivernetwork=".
                urlencode($network);
            else:
            $url = "http://api.smilesn.com/sendsms?hash=".
                $APIKey."&receivenum=" .
                $receiver."&sendernum=" .
                urlencode($mask)."&textmessage=".
                urlencode($message);
        endif;
        

        #----CURL Request Start
        $ch         = curl_init();
        $timeout    = 30;
        curl_setopt ($ch,CURLOPT_URL, $url) ;
        curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
        $response = curl_exec($ch) ;
        curl_close($ch) ; 
        #----CURL Request End, Output Response
        return  $response ;
//        echo '<pre>';print_r($response)
        
        }
    
        public function send_message_bulk($receiver,$message,$network=NULL){
           $mask       = 'edwardesecp';//Default     
//           $mask       = 'EDWARDESCP';//Default     
//           $mask       = '8583';//Default     
//        $APIKey = '105968496094187285c2e025e027075de5ab1b40asdf'; //VeevoTech ID HASH
        $APIKey = '105968496094187285c2e025e027075de5ab1b40'; //One ID HASH

        
        if($network):
             
            $url = "http://api.smilesn.com/sendsms?hash=".
                $APIKey."&receivenum=" .
                $receiver."&sendernum=" .
                urlencode($mask)."&textmessage=".
                urlencode($message)."&receivernetwork=".
                urlencode($network);
            else:
            $url = "http://api.smilesn.com/sendsms?hash=".
                $APIKey."&receivenum=" .
                $receiver."&sendernum=" .
                urlencode($mask)."&textmessage=".
                urlencode($message);
        endif;
        

        #----CURL Request Start
        $ch         = curl_init();
        $timeout    = 30;
        curl_setopt ($ch,CURLOPT_URL, $url) ;
        curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
        $response = curl_exec($ch) ;
        curl_close($ch) ; 
        #----CURL Request End, Output Response
        return  $response ;
        
        }
     public function send_message_ci($receiver,$message,$network=NULL){
         $this->load->library('curl');
          $mask       = 'edwardescp';//Default   
//          $mask       = '8583';//Default   
         
        $APIKey = '105968496094187285c2e025e027075de5ab1b40asdf';
//        $APIKey = '46c8dab418f8eb7fbe0def2677ce8339de594c5a';
        if($network):
             
            $url = "http://api.smilesn.com/sendsms?hash=".
                $APIKey."&receivenum=" .
                $receiver."&sendernum=" .
                urlencode($mask)."&textmessage=".
                urlencode($message)."&receivernetwork=".
                urlencode($network);
            else:
            $url = "http://api.smilesn.com/sendsms?hash=".
                $APIKey."&receivenum=" .
                $receiver."&sendernum=" .
                urlencode($mask)."&textmessage=".
                urlencode($message);
        endif;
        
        $this->curl->create($url);
        $this->curl->option('buffersize', 10); 
        $this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');      
        $this->curl->option('returntransfer', 1);
        $this->curl->option('followlocation', 1);
        $this->curl->option('HEADER', true);
        $this->curl->option('connecttimeout', 600);
        $this->curl->option('SSL_VERIFYPEER', false); // for ssl
        $this->curl->option('SSL_VERIFYHOST', false);
        $this->curl->option('SSLVERSION', 3);        // end ssl
        $data = $this->curl->execute();
  
        return  $data; 
        
        }      
}
 