<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core\PublicController.php');
require_once(APPPATH.'core\MY_Controller.php');
 

class Controller404 extends PublicController {

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
	public function index()
	{
            
            $this->data['title']        = 'Error 404';
            $this->load->view('common/header', $this->data);
            $this->load->view('common/nav');
            $this->load->view('errors/404', $this->data);
            $this->load->view('common/footer');
	}
        
        
        
}
