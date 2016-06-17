<?php
/*
{
"MenuName":"退出系统",
"MenuSort":"99",
"Children":"",
"Author"  :"Uni707",
"version" :"1.0",
"icons"   :"fa-sign-out"
}
*/

class Exit_do extends CMS_System{
    
    
    public function index(){
        
       $this->session->sess_destroy();
	   redirect(base_url());
	   
    }


}