<?php

namespace Controllers;
use Models\Posts;

class PostController
{
	protected $twig;
	
	public function __construct()
	{
		$loader = new \Twig_Loader_Filesystem(__DIR__ . "/../views");
		$this->twig = new \Twig_Environment($loader);
	}

	public function get()
	{
		session_start();
		if(!isset($_SESSION['username']))
			header('Location: /');
		if(isset($_GET['filename']))
		{
			$filename = $_GET['filename'];
			if($filename=="top")
				echo $this->twig->render("postsTop.html");
			elseif($filename=="five")
				echo $this->twig->render("postsfivedays.html");
			elseif($filename=="month")
				echo $this->twig->render("postsmonth.html");
			elseif($filename=="today")
				echo $this->twig->render("postsToday.html");
			error_log("NanananananaThis is nt it");
	    }
	    else
	    {
				echo $this->twig->render("postsTop.html");
				error_log("Yeh!This is nt it");
	    }
		
		//echo $_SESSION['username'];
	}
	public function post()
	{
		//error_log("Hello");
		session_start();
		//echo "Hello!";

		$username = $_SESSION['username'];
		$post = $_POST['post'];
		$filename = $_POST['filename'];
		$postsall = array(); //array(array("id" => 1, "title" => "djfklsdf"), array())

		//error_log($_POST['post']);
		if($_POST['post']!="")
		{
			
			$postsall= Posts::insertPost($post , $filename);
			echo json_encode($postsall);

			// if(!$postsall)
			// {
			// 	error_log("Postall is null it seems");
			// }
			//error_log($postsall);

			//error_log(json_encode($postsall));
		}
		else
		{
			//error_log("OMG Its there!");
			$postsall= Posts::displayPost($filename);
			echo json_encode($postsall);
			//error_log($postsall);
			
		}	
			
	}
}
?>