<?php
class Model_users extends CI_Model{
      public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
    }
	public function can_log_in()
	{
		$this->db->select("*");
        $this->db->where('email', $this->input->post('email'));
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get('users');
		
		if($query->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/******new-aa****/
	public function userData($uEmail, $pass){
		$this->db->where('email', $uEmail);
		$this->db->where('password', md5($pass));
		$query = $this->db->get('users');	
        return $query->row();
	} 
	/*********/
}

?>