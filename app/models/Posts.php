<?php

namespace Models;

class Posts
{

	public static function getDB()
	{
		include "../config/credentials.php";

		return new \PDO("mysql:dbname=".$configs['db_name'].";host=".$configs['host'] ,  $configs['username'] , $configs['password']);
	}

	public static function insertPost($post , $filename)
	{
		//session_start();


		$db = self::getDB();

		$username = $_SESSION['username'];

		$statement = $db->prepare("INSERT INTO posts(username , post) VALUES (:username , :post)");
		$result = $statement->execute(array(
			"username"=>$username,
			"post"=>$post));
		if($result)
		{
			return self::displayPost($filename);
			error_log("OMG Its here!");
			
		}
		else
		{
			//echo $this->twig->render("postsTop.html" , render(array(
				//"errorMsg"=>"Unable to post at the present moment :( Please try again later.."));	
		}
		//error_log("OMG Its here!");
	} 
	public static function displayPost($filename)
	{
		
		// The queries given below are incomplete and have scope of more feature addition
		$db = self::getDB();
		if($filename=="top")
		{
			$statement = $db->prepare("SELECT * FROM  posts");
			// ADD Limit to the sql query to display Limited no of posts
		}
		elseif($filename=="today")
		{
			$statement = $db->prepare("SELECT * FROM posts WHERE time>=CURDATE()  AND time < CURDATE() + INTERVAL 1 DAY ORDER BY time DESC");
		}
		elseif($filename=="fivedays")
		{
			$statement = $db->prepare("SELECT * FROM posts WHERE time>=CURDATE() - INTERVAL 5 DAY AND time < CURDATE() + INTERVAL 1 DAY ORDER BY time DESC");
		}
		elseif($filename = "month")
		{
			$statement = $db->prepare("SELECT * FROM posts WHERE time>=CURDATE() - INTERVAL 30 DAY AND time < CURDATE() + INTERVAL 1 DAY ORDER BY time DESC");
		}
		else
		{  
			// Display an error message showing the thing sought for is not found
		}

			
		$posts = array();
		//error_log("WTF");
		if($statement)
		{
			$statement->execute();
			while($row=$statement->fetch(\PDO::FETCH_ASSOC))
			{
				$posts[] = $row;
			}


			//error_log($posts);
			if(!$posts)
			{
				error_log("How come posts returned a null object");
			}
			return $posts;

		}
		error_log("OMG Its here!");

	}
}
?>