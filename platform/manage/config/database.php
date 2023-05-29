<?php
class Database 
{
	private static $dbName = 'platform' ; 
	private static $dbHost = '10.9.18.4' ;
	private static $dbUsername = 'business_school';
	private static $dbUserPassword = '2KCkYMmm%;f!';
	
	private static $cont  = null;
	
	public function __construct() {
		exit('Init function is not allowed');
	}
	
	public static function connect() {
		// One connection through whole application
		if ( null == self::$cont ) {      
			try {
				self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);  
			} catch(PDOException $e) {
				die($e->getMessage());  
			}
		} 
		return self::$cont;
	}
	
	public static function disconnect() {
		self::$cont = null;
	}
}
?>