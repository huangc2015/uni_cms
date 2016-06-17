<?php
/*
{
"MenuName":"用户设置",
"MenuSort":"98",
"Children":[{"url":"password","name":"密码设置"}],
"Author"  :"Uni707",
"version" :"1.0",
"icons"   :"fa-cog"
}
*/

class User_do extends CMS_System{
    
    private $post;
    
	public function __construct(){
		parent::__construct();
        $this->post=array(
                            "post1"=>$this->input->post("post1"),
        //....
        );
        
        
    }
    
    public function index(){
        
       $this->password();
    }
	public function password(){
        
       $this->board($this->sys("user","password",""));
    }
	public function password_change(){
		

		$sess=$this->session->userdata();
		
		$pwd=$this->input->post("new_pwd");
		
		$this->User->id=$sess["user_id"];
		$this->User->password=$pwd;
		

		if($this->User->update()){
			$msg="密码修改成功！";
		}else{
			$msg="密码修改失败。";
		}
	   
       $this->board($this->sys("user","password",$msg));
    }
    

}