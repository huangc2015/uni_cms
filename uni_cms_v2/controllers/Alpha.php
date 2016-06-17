<?php
class Alpha extends Front_Show{
    
	private $url2;
	private $url3;

	public function __construct()
    {
		parent::__construct();
		
		$this->url2=$this->uri->segment(2, "0");
		$this->url3=$this->uri->segment(3, "1");
		
		$this->var_global= array(
											"root"=> base_url(),
											"url2"=> $this->url2,
											"url3"=> $this->url3,
											"nav"=> $this->Mix->nav(),
											"my_img"=> base_url()."images/logo.jpg",
											"this_id"=>$this->url2
											);

    }
	
	public function _remap($method){
		
		switch($method){
			
			case "index":
			$this->index();
			break;
			
			case "site_dir":
			$this->site_dir();
			break;
			
			case "site_page":
			$this->site_page();
			break;
			
			default:
			$this->nf();
			break;
		}
		
	}


	public function index(){
	

		$head=$this->tpl("mainboard","head");
		$body=$this->tpl("mainboard","index");
		$foot=$this->tpl("mainboard","foot");
		
		echo $head.$body.$foot;

	}
	
	public function site_dir(){
		
		if( ! is_numeric($this->url2) ){
			$this->nf();
			}
			
		if( ! is_numeric($this->url3) ){
			$this->nf();
			}

		if($this->url2 === "0"){
			$this->nf();
			}
		
		$check = 0;
		
		$this->Direct->id = $this->url2;
		
		$dir = $this->Direct->read_one();
		
		if($dir === NULL){
			$check=1;
			}
		
		if($dir["status"]==="1"){
			$check=1;
			}
		
		$this->Article->dirs = $dir["id"];
		$main_data = $this->Article->read_by_dir();
		
		if($main_data === NULL){
			$check=1;
			}
		
		if($check != 0){
			$this->nf();
			}
		
		$pointer="site_list";
		
		if($dir["type"]==="2"){
			$pointer="site_single";
			$main_data=$main_data[0];
			
			$insert=array(
						"content"=>$main_data
			);
			
			//var_dump($insert);
			
		}else{
			
			$page=$this->Mix->my_page($main_data,2,$this->url3);
		
			if($page === FALSE){
				$this->nf();
			}
			
			$insert=array(	
							"title"=>"",
							"list"=>$page["data"],
							"page"=>$page["page"]
							
			);
			//var_dump($insert);
		}
		

		$head=$this->tpl("mainboard","head");
		$body=$this->tpl("mainboard",$pointer,$insert);
		$foot=$this->tpl("mainboard","foot");
		
		echo $head.$body.$foot;

	}
	public function site_page(){
		
		if( ! is_numeric($this->url2) ){$this->nf();}
		
		if($this->url2 === "0"){$this->nf();}
		
		$check = 0;
		
		$this->Article->id = $this->url2;
		
		$Article = $this->Article->read();
	
		if($Article === NULL){$check=1;}
		
		if($Article["status"]==="1"){$check=1;}
		
		if($check != 0){$this->nf();}
		
		
		$head=$this->tpl("mainboard","head");
		$body=$this->tpl("mainboard","site_page",$Article);
		$foot=$this->tpl("mainboard","foot");
		
		echo $head.$body.$foot;

	}
	
	public function nf(){
	
		//Not Found page

		$head=$this->tpl("mainboard","head");
		$body=$this->tpl("mainboard","nf");
		$foot=$this->tpl("mainboard","foot");
		
		echo $head.$body.$foot;
		exit;

	}
	
	

}

?>