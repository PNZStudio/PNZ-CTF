<?php
class PNZ {
// By PNZ Studio
// https://facebook.com/PNZstudio
  private function curl($type,$url,$data = false){
    if($type == "GET"){
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }elseif($type == "POST"){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    
    }
  }
  public function auth($type,$email,$pass){
    $apl = "http://api.PNZ/v1/auth/?type=$type&email=$email&password=$pass";
    $re = $this->curl("GET",$apl);
    return $re;
  }
  public function line($msg){
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://notify-api.line.me/api/notify",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "message=".$msg,
      CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer dYzKOFh5EaOZpcKwAn10vyYM7Ntn66vbPJXlr1eP6hv",
      "Cache-Control: no-cache",
      "Content-Type: application/x-www-form-urlencoded"
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    return $response;
  }
  public function db($conection,$sql,$data = array(),$fetch = false){
    $db = $conection->prepare($sql);
    $db->execute($data);
    if($fetch == true){
        $data = $db->fetch();
        return $data;
    }
  }
  public function gentoken($email,$username,$phone){
    $tok1 = base64_encode(md5(md5($email)));
    $tok2 = md5(md5(base64_encode($username)));
    $tok3 = base64_encode(base64_encode(md5(base64_encode($phone))));
    return strtoupper("PN-TOKEN-".substr(md5(base64_encode($tok1.'-'.$tok2.'-'.$tok3)),15)."-".substr(md5(base64_encode($tok1.'-'.$tok2.'-'.$tok3)),-15));

  }
}

?>
