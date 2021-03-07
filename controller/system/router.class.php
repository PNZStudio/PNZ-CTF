<?php
include 'controller/system/altorouter.class.php';
include 'system.class.php';
include 'autoload.php';

class router
{

	function __construct()
	{
		$this->router = new AltoRouter();
	}

	public function start_router()
	{
		$this->load_router();
		$this->end_router();
	}

	private function load_router()
	{
		$this->router->map("GET", "/", function () {
			$this->loadpage("home");
		});
		$this->router->map("GET", "/home", function () {
			$this->loadpage("home");
		});
		$this->router->map("GET", "/me", function () {
			$this->loadpage("me");
		});
		$this->router->map("GET", "/scoreboard", function () {
			$this->loadpage("scoreboard");
		});
		$this->router->map("GET", "/challenges", function () {
			$this->loadpage("challenges");
		});
		$this->router->map("GET", "/contact", function () {
			$this->loadpage("contact");
		});
		$this->router->map("GET", "/login", function () {
			$this->loadpage("login");
		});
		$this->router->map("GET", "/register", function () {
			$this->loadpage("register");
		});
		$this->router->map("GET", "/logout", function () {
			$this->loadpage("logout");
		});

		// API //
		$this->router->map("POST", "/api/v1/login", function () {
			$this->loadapi("login");
		});
		$this->router->map("POST", "/api/v1/register", function () {
			$this->loadapi("register");
		});
		$this->router->map("POST", "/api/v1/fb_login", function () {
			$this->loadapi("fb_login");
		});
		$this->router->map("POST", "/api/v1/me", function () {
			$this->loadapi("me");
		});

	}

	private function end_router()
	{
		$match = $this->router->match();
		if (is_array($match) && is_callable($match['target'])) {
			call_user_func_array($match['target'], $match['params']);
		} else {
			$this->loadpageerror();
		}
	}
	private static function htmlheader()
	{
		require_once 'views/body/style.php';
		require_once 'views/body/header.php';
		require_once 'views/body/navbar.php';
	}
	private static function htmlfooter()
	{
		require_once 'views/body/footer.php';
	}
	private function loadpage($page)
	{
		$page_now = $page;
		$class = new system();
		if(isset($_COOKIE['token'])){
			if($_COOKIE['token'] !== ""){
				$check = $class->db(
					"SELECT * FROM `member` WHERE token = ?",
					array($_COOKIE['token']),
					true
				);
				$_SESSION['login'] = $check[0]['token'];
			}
		}
		Self::htmlheader();
		require_once "views/page/" . $page . ".php";
		Self::htmlfooter();
	}

	private function loadpageerror()
	{
		Self::htmlheader();
		require_once "views/page/404.php";
		Self::htmlfooter();
	}

	private function loadapi($nameapi)
	{
		$class = new system();
		$recaptcha = new \ReCaptcha\ReCaptcha("6Le1s3MaAAAAAEPbLgONpTlL7ClF8XGiP4CrUN3X");
		require_once "controller/api/" . $nameapi . ".php";
	}
}
