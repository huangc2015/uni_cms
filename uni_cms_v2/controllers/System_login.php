<?php

class System_login extends Boot{

	public function __construct(){
		parent::__construct();

	}
	public function index(){
	
		echo $this->sys("login","login",array("check_code"=>$this->check_code()));
		
	}
	
	public function login(){
		
		$account=$this->input->post("account");
		$password=$this->input->post("password");
		$check_code=$this->input->post("check_code");
		
		$this->User->account=$account;
		$this->User->password=$password;
		$login=$this->User->login();
		
		$sess=$this->session->userdata();
		if($check_code === strtolower($sess["check_code"])){
			
			if($login === TRUE){
				echo json_encode(array("msg"=>"1","url"=>base_url()."cms/welcome"));
			}else{
				echo json_encode(array("msg"=>$login,"url"=>"1","img"=>$this->check_code()));
			}
			
		}else{
			echo json_encode(array("msg"=>"验证码错误！","url"=>"1","img"=>$this->check_code()));
		}
		

	}
	
	public function check_code($show=NULL){
		
		$this->load->helper('captcha');
		$vals = array(
						
						'img_path'  => './images/cache/',
						'img_url'   => base_url().'/images/cache/',
						'font_path' => './STXINWEI.TTF',
						'img_width' => '100',
						'img_height'    => 35,
						'expiration'    => 0,
						'word_length'   => 4,
						'font_size' => 16,
						'img_id'    => 'check_code',
						'pool'      => '23456789defghijkLmnpqwxyzABCDEFGHJPQRVWXYZ',

						// White background and border, black text and red grid
						'colors'    => array(
							'background' => array(255, 255, 255),
							'border' => array(255, 255, 255),
							'text' => array(96, 114, 255),
							'grid' => array(82, 230, 255)
						)
					);

					$cap = create_captcha($vals);
					$this->session->set_userdata(array("check_code"=>strtolower($cap["word"])));
			if($show!=NULL){

				echo json_encode(array("img"=>$cap['image']));
				
			}else{
				return $cap['image'];
			}
					
	
	}

}	
?>