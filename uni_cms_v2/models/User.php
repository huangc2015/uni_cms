<?php
class User extends CI_Model {
	
	
	public $account;
	public $password;
	public $name;
	public $login_time;
	public $is_login;
	
	public function login_check(){
		
		$data = $this->session->userdata();
		if(isset($data["idently"])){
			
			if($data["idently"] === "admin"){
				return TRUE;
			}else{
				return FALSE;
			}
			
		}else{
			return FALSE;
		}
		
		
	}
	public function login(){
		
		$account=md5($this->account);
		$password=md5($this->password);
		
		$query = $this->db->get_where('uni_user',array('enc_account' => $account ));
		$accont_check=$query->row_array();

		if($accont_check != NULL){
			
			if($accont_check["enc_password"] === $password){
				
				$this->id = $accont_check["id"];
				$this->login_on("admin");
				$this->login_time = date("Y-m-d H:i:s");
				$this->update();
				return TRUE;
				
			}else{
				
				return "密码错误";
			
			}
			
		}else{
			
			return "帐号错误";
		}
		
	return FALSE;
		
	}
	public function login_on($idently=NULL){
		
		if($idently!=NULL){
			
			$data=array(
			"user_id"=>$this->id,
			"idently"=>$idently,		
			);
			$this->session->set_userdata($data);
			
		}else{
			return FALSE;
		}
		
	}
	
	public function login_out(){
		$this->session->sess_destroy();
	}
	
	public function reg(){

		
		$insert  = array(
						"account"=> $this->account,
						"enc_account"=> md5($this->account),
						"enc_password"=> md5($this->password),
						"name"=> $this->name,
					);
					
		$this->db->insert('uni_user', $insert);
		
		return TRUE;
		
	}
	
	public function del(){

		$this->db->delete('uni_user', array('id' => $this->id ));
			
		return TRUE;
		
	}
	
	public function update(){
		
		$data = array(
						"name"=> $this->name,
						"enc_password"=> md5($this->password),
						"login_time"=>$this->login_time,
						"is_login"=>$this->is_login,

					);
		function is_empty($var)
		{
			if($var === NULL){
				return FALSE;
			}else{
				return TRUE;
			}
		}
		
		$data = array_filter($data,"is_empty");

		$this->db->where('id', $this->id);
		$this->db->update('uni_user', $data);

		return TRUE;
	}

}
