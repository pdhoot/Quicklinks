<?php

namespace Controllers;
use Models\CookieManagerHandle;

class HomeController
{
	protected $twig;

	
	public function __construct()
	{
		$loader =  new \Twig_Loader_Filesystem(__DIR__ . '/../views');
		$this->twig = new \Twig_Environment($loader);
	}
	public function get()
	{
		session_start();
		$stat = CookieManagerHandle::checkCookie();
		
		//error_log($stat);
		//$str = var_dump($stat);
		//error_log($str);
		//var_dump($stat===0);
		
		//var_dump($stat);
		//echo "hello this is comig here!";
			if($stat===0) 																					//stat==0
			{
				if(isset($_SESSION['username']) && $_SESSION['username']!="")
				{
					
					header('Location: /posts');
				}
				else
				{
					
					echo $this->twig->render("index.html" , array(
						"title" => "MVC Blog"));
				}
			}
			else
			{
				
				$_SESSION['username'] = $stat;
				//error_log($_SESSION['username']);
				header('Location: /posts');
			}
			
		
	
		
	}
}
?>