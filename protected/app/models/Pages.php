<?php
class Pages extends BaseModel  {
	
	protected $table = 'tb_pages';
	protected $primaryKey = 'pageID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_pages.* FROM tb_pages  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE tb_pages.pageID IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
