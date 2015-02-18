<?php

namespace Models;

class SignUp
{
	public function __construct()
	{

	}

	public static function getDB()
	{
		include "../config/credentials.php";

		return new \PDO("mysql:dbname=".$configs['db_name'].";host=".$configs['host'] ,  $configs['username'] , $configs['password']);
	}

	public static function addUser($username , $passhash , $name , $email)
	{
		$db = self::getDB();

		$stat = $db->prepare("SELECT * FROM users WHERE username = :username");

		$stat->bindValue(":username" , $username);

		$stat->execute();

		$row = $stat->fetch(\PDO::FETCH_ASSOC);

		if($row)
		{
			return 2;
		}

		$statement = $db->prepare("INSERT INTO users (username , passhash  , name , email) VALUES (:username , :passhash  , :name , :email)");

		$result = $statement->execute(array(
			"username"=>$username,
			"passhash"=>$passhash,
			"name"=>$name,
			"email"=>$email));
		if($result)
		{
			session_start();
			$_SESSION['username'] = $username;
			return 1;											//to redirect to home page of posts
		}
		else
		{
			return 0;
		}
	}
}
