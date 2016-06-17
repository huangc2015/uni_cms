<?php
/*
{
"MenuName":"欢迎使用优理CMS",
"MenuSort":"0",
"Children":"",
"Author"  :"Uni707",
"version" :"1.0",
"icons"   :"fa-smile-o"
}
*/

class Welcome extends CMS_System{
    
    
    public function index(){
        
       $this->board(__CLASS__);
    }


}