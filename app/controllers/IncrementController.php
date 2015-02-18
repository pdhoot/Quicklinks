<?php

namespace Controllers;
use Models\IncrementHandler;

class IncrementController
{
	protected $twig;

	public function __construct()
	{
		$loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
		$this->twig = new \Twig_Environment($loader);
	}

	public function get()
	{
		if(isset($_GET))
		{
			$post = $_GET['link'];
			$id = $_GET['id_no'];
			IncrementHandler::increase($post , $id);
			//echo $res;
			header('Location: http://'.$post);

		}
		else
		{
			header('Location: /posts');
		}
	}
}