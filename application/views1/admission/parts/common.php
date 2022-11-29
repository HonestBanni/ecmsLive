<?php
echo 'echo ';die;
$this->load->view('common/header');
$this->load->view('nav');
$this->load->view($page);
$this->load->view('footer');

?>