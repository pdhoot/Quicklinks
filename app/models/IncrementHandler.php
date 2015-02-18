<?php

namespace Models;

class IncrementHandler
{
	public static function getDB()
	{
		include "../config/credentials.php";

		return new \PDO("mysql:dbname=".$configs['db_name'].";host=".$configs['host'] ,  $configs['username'] , $configs['password']);
	}
	public static function increase($post , $id)
	{
		$db = self::getDB();

		$statement = $db->prepare("SELECT * FROM posts WHERE id = :id");

		//$statement->bindValue(":post" , $post);
		$statement->bindValue(":id" , $id);

		$result = $statement->execute();

		$row = $statement->fetch(\PDO::FETCH_ASSOC);
		$count = intval($row['count']);



		// error_log("THis is the log just to check the count in the increment Handler BEFORE");
		// error_log($count);
		$count = $count + 1;

		// error_log("THis is the log just to check the count in the increment Handler");
		// error_log($count);

		$stat = $db->prepare("UPDATE posts SET count = :count WHERE id = :id");
		$stat->bindValue("count" , $count);
		$stat->bindValue("id" , $id);
		$stat->execute();

		//return var_dump($count+1);
		 
	}
}
?>