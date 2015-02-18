<?php

namespace Controllers;
use Models\SignUp;
use Models\CookieManagerHandle;

class SignUpController
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
		$stat = CookieManagerHandle::checkCookie();
		error_log("I am just above the signup vala function");
		error_log($stat);
		//var_dump($stat);
		//echo "hello this is comig here!";
			if($stat==0 || isset($stat))
			{
				//error_log($_SESSION['username']);
				if(isset($_SESSION['username']))
				{
					//error_log("GANDU");
					header('Location: /posts');
				}
				else
				{
					echo $this->twig->render("signup.html");
				}
			}
			else
			{
				//error_log("GANDUBHAI");
				$_SESSION['username'] = $stat;
				error_log($_SESSION['username']);
				header('Location: /posts');
			}
		
	}
	public function post()
	{
		

		if(!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['name']) || !isset($_POST['email']))
		{
			echo $this->twig->render('signup.html' , array(
				"errorsignUp" => "You Think You could do this?"));
		}
		else
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			$cnfpass = $_POST['cnfpassword'];
			$name = $_POST['name'];
			$email = $_POST['email'];
			$passhash = md5($password);
			if($password!==$cnfpass)
			{
				echo $this->twig->render("signup.html" , array(
					"error"=>"Passwords dont match!"));
			}
			else
			{
				$res = SignUp::addUser($username , $passhash , $name , $email );
				
				if($res==1)
				{
					header('Location : /posts');						//add appropriate location in the end
				}
				elseif($res==0)
				{
					echo $this->twig->render("signup.html" , array(
						"error"=>"Sorry! Signup falied!"));
				}
				else
				{
					echo $this->twig->render("signup.html" , array(
						"error"=>"Sorry! username already exists"));
				}
			}
		}
	}
}