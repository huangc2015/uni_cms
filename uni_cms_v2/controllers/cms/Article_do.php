<?php
/*
{
"MenuName":"新建文档",
"MenuSort":"2",
"Children":[{"url":"add_normal","name":"普通文档"},{"url":"add_photo","name":"相册文档"},{"url":"add_banner","name":"Banner文档"}],
"Author"  :"Uni707",
"version" :"1.0",
"icons"   :"fa-file-o"
}
*/

class Article_do extends CMS_System{
    
    private $post;
    
	public function __construct(){
		parent::__construct();
    }
    
    public function index(){
        
        redirect(base_url()."cms/Article_do/add_normal");
    }
    
    public function add_normal(){

        $this->board($this->sys("article","add_normal",array("action"=>"add","id"=>"")));
        
    }
	
	public function edit_normal($id=NULL){
		$this->Article->id= $id;
		$data = $this->Article->read();
        $this->board($this->sys("article","add_normal",array("action"=>"edit","id"=>$id ,"content" =>$data['content'])));
        
    }
	
	public function read_normal($id=NULL){
		
		$this->Article->id= $id;
		echo json_encode(array("msg"=>$this->Article->read()));
        
    }
	
	public function add_photo(){

        $this->board($this->sys("article","add_photo","data"));
        
    }
	
	public function add_banner(){
       
        $this->board($this->sys("article","add_banner","data"));
        
    }
	
    public function normal_updata(){
		
		$article =array(
		"id"=>			$_POST["id"],
		"title"=>		$_POST["title"],
		"edit_time"=>	$_POST["edit_time"],
		"description"=>	$_POST["description"],
		"content"=>		$_POST["content"],
		"status"=>		$_POST["status"],
		"dir"=>			$_POST["dir"]
		);
		
	$this->Article->id=			$article["id"];
	$this->Article->dirs=		$article["dir"];
	$this->Article->type=		"";
	$this->Article->title=		$article["title"];
	$this->Article->author=		"";
	
	$this->Article->edit_time=	$article["edit_time"];
	$this->Article->description=$article["description"];
	$this->Article->content=	$article["content"];
	$this->Article->status=		$article["status"];
	
	if($this->Article->update()){
		echo json_encode(array("msg"=>"1"));
	}else{
		echo json_encode(array("msg"=>"0"));
	};
	
	}

    public function save(){
		
		$article =array(
		"title"=>		$_POST["title"],
		"edit_time"=>	$_POST["edit_time"],
		"public_time"=>	$_POST["public_time"],
		"description"=>	$_POST["description"],
		"content"=>		$_POST["content"],
		"status"=>		$_POST["status"],
		"dir"=>			$_POST["dir"]
		);
		

	$this->Article->dirs=		$article["dir"];
	$this->Article->type=		"";
	$this->Article->title=		$article["title"];
	$this->Article->author=		"";
	$this->Article->hits=		0;
	$this->Article->add_time=	$article["public_time"];
	$this->Article->edit_time=	$article["edit_time"];
	$this->Article->description=$article["description"];
	$this->Article->content=	$article["content"];
	$this->Article->status=		$article["status"];
	
	if($this->Article->add()){
		echo json_encode(array("msg"=>"1"));
	}else{
		echo json_encode(array("msg"=>"0"));
	};
	
	}
    
    public function upload_CK(){
		
		
		$config['upload_path']      = './images/upload/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']     = 2046;
        $config['max_width']        = 0;
        $config['max_height']       = 0;
		$config['file_name']       = date("Ymd").uniqid();
		

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('upload'))
        {
            $msg = array('error' => $this->upload->display_errors());
        }
        else
        {
            $msg = "上传成功！";
			$data=$this->upload->data();
        }
		
		$link=base_url()."images/upload/".$data['raw_name'].$data['file_ext'];

		echo '<html><body><script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("1", "'.$link.'","'.$msg.'");</script></body></html>';
		
	}
    

}