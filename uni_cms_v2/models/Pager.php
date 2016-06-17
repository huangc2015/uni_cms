<?php
class Pager extends CI_Model {
	
	
	public $var_global;
	
	private function ready(){
		
		foreach($this->var_global as $key => $val){
			$this->smt->assign($key,$val);
		}
		
	}
	
	/*
	public function sys($pager=NULL,$pointer=NULL,$data=NULL){
		$this->smt->assign("pointer",$pointer);
		$this->smt->assign("data",$data);
		$this->ready();
		return $this->smt->fetch("./sys/".$pager.".html");
	}
	*/
	public function tpl($pager=NULL,$pointer=NULL,$data=NULL){
		$this->smt->assign("pointer",$pointer);
		$this->smt->assign("data",$data);
		$this->ready();
		return $this->smt->fetch("./".$pager.".html");
	}
	
}
