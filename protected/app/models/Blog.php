<?php
class Blog extends BaseModel  {
	
	protected $table = 'tb_blogs';
	protected $primaryKey = 'blogID';

	public function __construct() {
		parent::__construct();
		
	}
	
	public static function getRows( $args )
	{

        extract( array_merge( array(
			'page' 		=> '0' ,
			'limit'  	=> '0' ,
			'sort' 		=> '' ,
			'order' 	=> '' ,
			'params' 	=> '' ,
			'global'	=> '1'	  
        ), $args ));
		
		$offset = ($page-1) * $limit ;	
		$limitConditional = ($page !=0 && $limit !=0) ? "LIMIT  $offset , $limit" : '';	
		$orderConditional = ($sort !='' && $order !='') ?  " ORDER BY {$sort} {$order} " : '';

		// Update permission global / own access new ver 1.1
		$table = with(new static)->table;
		
        
		$rows = array();
	    $result = DB::select( self::querySelect() . self::queryWhere(). "
				{$params} ". self::queryGroup() ." {$orderConditional}  {$limitConditional} ");
				
		$total = DB::select( self::querySelect() . self::queryWhere()." {$params} ". self::queryGroup());			 


		return $results = array('rows'=> $result , 'total' => count($total));	

	
	}	

	public static function querySelect(  ){
		
		return "  SELECT tb_blogs.* ,tb_blogcategories.*, CONCAT(first_name,' ',last_name) as username ,count(tb_blogcomments.commentID) as comments
		FROM tb_blogs 
		LEFT JOIN tb_blogcategories ON tb_blogcategories.catID = tb_blogs.catID 
		LEFT JOIN tb_blogcomments ON tb_blogcomments.blogID = tb_blogs.blogID 
		LEFT JOIN tb_users ON tb_blogs.entryby = tb_users.id 
		
		"; 
	}
	public static function queryWhere(  ){
		
		return " WHERE tb_blogs.blogID IS NOT NULL AND status = 'publish' AND enable ='1' ";
	}
	
	public static function queryGroup(){
		return " GROUP BY tb_blogs.blogID ";
	}
	
	public static function getRowBlog( $slug )
	{
       $table = with(new static)->table;
	   $key = with(new static)->primaryKey;

		$result = DB::select( 
				self::querySelect() . 
				self::queryWhere().
				" AND slug = '{$slug}' ". 
				self::queryGroup()
			);	
		if(count($result) <= 0){
			$result = array();		
		} else {

			$result = $result[0];
		}
		return $result;		
	}		
	
	public static function summaryCategory()
	{
		$result = DB::select("
		 SELECT 
			tb_blogcategories.* ,COUNT(tb_blogs.blogID) AS total
		 FROM tb_blogcategories 
		 LEFT JOIN tb_blogs ON tb_blogs.catID = tb_blogcategories.catID
		 GROUP BY tb_blogcategories.catID
		");
		return $result;	 
	}	
	
	public static function clouds()
	{
		$result = DB::select(" SELECT tags FROM tb_blogs	");
		$tags = array();
		foreach($result as $row)
		{
			foreach(explode(",",$row->tags) as $tg)
			{
				$item = trim(strtolower($tg));
				if(!in_array($item,$tags))
				{
					$tags[ $item]	= str_replace(" ","+",$item);
				}	
			}
		}
		
		return $tags;	 	
	}
	
	public static function recentPosts()
	{
		$result = DB::select(" SELECT * FROM tb_blogs ORDER BY created DESC LIMIT 5");
		return $result;
	}	
	
	public static function getComments( $blogID )
	{
		$result = DB::select(
			" SELECT tb_blogcomments.* , CONCAT(first_name,' ',last_name) as name  FROM tb_blogcomments LEFT JOIN tb_users ON  tb_blogcomments.user_id = tb_users.id  WHERE blogID ='{$blogID}'"
		);
		$comments = array();
		foreach($result as $row)
		{
			//$comments[] = (array) $row;
			
			$nested = DB::select(" SELECT tb_blogcomments.* FROM tb_blogcomments WHERE parentID ='{$row->commentID}'" );
			$childs = array();
			foreach($nested as $row2)
			{
					$childs[] = (array) $row2;
			}
			$comments[] =  array_merge((array) $row ,array('nested' => $childs)) ; 
		}
		//echo '<pre>';print_r($comments);echo '</pre>';exit;
		return $comments;	
	}	
}
