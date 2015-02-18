<?php
require_once __DIR__ . "/../vendor/autoload.php";
Toro::serve(array(
	"/" => "Controllers\\HomeController",
	"/login" => "Controllers\\LoginController",
	"/signup" =>"Controllers\\SignUpController",
	"/posts" =>"Controllers\\PostController",
	"/increment"=>"Controllers\\IncrementController",
	"/logout"=>"Controllers\\LogoutController",
	));

?>

