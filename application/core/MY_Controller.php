<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
 
    
        public function __construct() {
             parent::__construct();
            }
            
        /*  Load the layout and set the ouput
        */
        public function render($layout)
        {
            
            $this->load->view('common/header');
            $this->load->view('common/nav');
            $this->load->view($layout);
            $this->load->view('common/footer');
            
//            $this->load->view('layouts/'.$layout, $this->data);
        }
}

