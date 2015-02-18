<?php

namespace Controllers;

class LogoutController
{
	public function get()
	{
		session_unset();
		session_destroy();
		error_log("This is high tym!");
		error_log($_SESSION['username']);
		//if(isset($_COOKIE['usesrname']) && $_COOKIE['username']!=="")
			setcookie("username" , "" , time()-3600);
		setcookie("PHPSESSID" , "" , time()-3600);
		header('Location: /');
	}
}
?>