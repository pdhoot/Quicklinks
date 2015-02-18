<?php
//This page is to response to the ajax query that matches passwords

namespace Controllers;

class PasswordMatchingController
{
	protected $twig;

	public static function __construct()
	{
		$loader = new \Twig_Loader_Filesystem(__DIR__ . "/../views");
		$this->twig = new \Twig_Environment($loader);
	}

	public static function post()
	{
		$password = $_POST['password'];
		$cnfpassword = $_POST['cnfpassword'];


		if($password!=$cnfpassword)
		{
			echo $this->twig->render("Signup.html" , array(
				"errorMessage"=>"Passwords don't match!"));
		}
		else
		{
			echo $this->twig->render("Signup.html" , array(
				"errorMessage"=>""));
		}
	}
}
