<?php

namespace Models;

class CookieManagerHandle
{
	public static function getDB()
	{
		include "../config/credentials.php";

		return new \PDO("mysql:dbname=".$configs['db_name'].";host=".$configs['host'] ,  $configs['username'] , $configs['password']);
	}

	public static function cookieAdder($username)
	{
		//$_COOKIE['username'] = md5($username);
		$usercookie = md5($username);
		$var = self::checkCookie();
		//var_dump($var);
		
		error_log($var);
		if($var===0)
		{
			
			$db = self::getDB();
			$statement = $db->prepare("INSERT INTO cookies (username , usercookies) VALUES (:username , :usercookie)");
			$statement->bindValue(":username", $username);
			$statement->bindValue(":usercookie", $usercookie);	
			$statement->execute();
		}
	}

	public static function checkCookie()
	{
		if(isset($_COOKIE['username']) && $_COOKIE['username']!=="")
		{
			
			$db = self::getDB();
			$usercookie = $_COOKIE['username'];
			$statement = $db->prepare("SELECT * FROM cookies WHERE usercookies = :usercookie");
			$statement->bindValue(":usercookie", $usercookie);
			$result = $statement->execute();
			

			if($result)
			{
				$row = $statement->fetch(\PDO::FETCH_ASSOC);
				
				error_log($row['username']);
				return $row['username'];
			}
		}
		
		//error_log($_COOKIE['username']);
		return 0;
	}
}
?>