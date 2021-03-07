<?php
include 'connect.class.php';

class system extends pdo_connection{

	function __construct(){
		$this->db = $this->DB_PDO();
	}
	public function fitter($text){
		$pattern_eng = "/^[a-zA-Z0-9]{1,}$/";
		if (preg_match($pattern_eng,$text)) {
			return 0;
		}else{
			return 1;
		}
	}
	public function db($sql,$data = array(),$fetch = false){
		if($fetch == false){
			$db = $this->db->prepare($sql);
			$db->execute($data);
			return true;
		}else{
			$db = $this->db->prepare($sql);
			$db->execute($data);
			return $result = $db->fetchAll(\PDO::FETCH_ASSOC);
		}
	}
	public function password($pass){
		return md5((md5(base64_encode($pass))));
	}
	public function token($pass){
		return "PNZZA".substr(strtoupper(md5(base64_encode(md5(md5(base64_encode($pass)))))),8);
	}
	public function re($url){
		echo "<script>location.href = '".$url."'</script>";
	}
}