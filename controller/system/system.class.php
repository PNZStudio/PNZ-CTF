<?php
include 'connect.class.php';
class system extends pdo_connection
{
	function __construct()
	{
		$this->db = $this->DB_PDO();
	}
	public function fitter($text)
	{
		$pattern_eng = "/^[a-zA-Z0-9]{1,}$/";
		if (preg_match($pattern_eng, $text)) {
			return 0;
		} else {
			return 1;
		}
	}
	public function webconfig($hurkao)
	{
		$configquery = $this->db->prepare("SELECT * FROM setting WHERE `name` = ?");
		$configquery->execute(array($hurkao));
		$config = $configquery->fetch(PDO::FETCH_ASSOC);
		return $config['content'];
	}
}
