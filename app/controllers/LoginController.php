<?php

//include in ajax the cookie checker for remember me feature
namespace Controllers;
use Models\Login;
use Models\CookieManagerHandle;

class LoginController
{
	protected $twig;

	public function __construct()
	{
		$loader = new \Twig_Loader_Filesystem(__DIR__ . "/../views");
		$this->twig = new \Twig_Environment($loader);
	}

	public function get()
	{
	
			header('Location: /');
	}

	//validates a user with his username or password . If a user is authenticated then he is redirected to the posts page. In case the user has 
	//earlier used the remember me feature then he is straightly redirected to the posts/page
	//When the remember me is clicked r
	// As the user is validated a cookie of his usersname is created. This cookie is then looked for in the DB. if found then the user is straightly
	public function post()
	{
		session_start();

		$username = $_POST['username'];
		$password = $_POST['password'];
		$passhash = md5($password);
		$validity = Login::authenticate($username , $passhash);
		if($validity)
		{

			//echo $this->twig->render("login.html", array("tp"=>"Success"));
			$userhash = md5($username);
			
				
			$_SESSION['username'] = $username;

			

			if(isset($_POST['remember']))
			{
				error_log("Baawla hai kya!!");
				setcookie("username" , $userhash , time() + 2592000,'/');
				error_log("This is login controller");
				error_log($_COOKIE['username']);
				CookieManagerHandle::cookieAdder($username);
			}
			header('Location: /posts');
			// header('Location : /posts');
		}
		else
		{
			echo $this->twig->render("login.html" , array(
				"errorMsg" =>"Invalid username or password!"));
		}
	}
	
}
?>