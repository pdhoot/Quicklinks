<?php

namespace Models;

class Login
{
	public  function __construct()
	{

	}

	public static function getDB()
	{
		include "../config/credentials.php";

		return new \PDO("mysql:dbname=".$configs['db_name'].";host=".$configs['host'] ,  $configs['username'] , $configs['password']);
	}

	public static function authenticate($username , $passhash)
	{
		$db = self::getDB();

		$statement = $db->prepare("SELECT * FROM users WHERE username = :username AND passhash = :passhash");
		//var_dump($statment);
		$statement->bindValue(":username" , $username);
		$statement->bindValue(":passhash" , $passhash);

		$statement->execute();

		$row = $statement->fetch(\PDO::FETCH_ASSOC);
		if($row)
		{
			return true;
		}	
		else
		{
			return false;
		}	
	}
}