<?php

if(isset($_POST['token']) AND isset($_POST['user_id'])){
    $token = $class->token($_POST['user_id'].$class->password($_POST['user_id']));
    $check = $class->db("SELECT * FROM member WHERE token = ?",array($token),true);
    if($check){
        print_r(json_encode(array(
            "status" => "success",
            "code" => "LOGIN_SUCCESS",
            "msg" => "เข้าสู่ระบบเรียบร้อย!"
        )));
        $_SESSION['login'] = $check[0]['token'];
    }else{
        print_r(json_encode(array(
            "status" => "success",
            "code" => "LOGIN_SUCCESS",
            "msg" => "เข้าสู่ระบบเรียบร้อย!"
        )));
        $class->db(
        "INSERT INTO `member`(`uid`, `email`, `username`, `password`, `point`, `role`, `token`) VALUES (NULL,?,?,?,?,?,?)",
        array("",$_POST['name'],$class->password($_POST['user_id']),"0","user",$class->token($_POST['user_id'].$class->password($_POST['user_id'])))
        ,
        false);
        $_SESSION['login'] = $class->token($_POST['user_id'].$class->password($_POST['user_id']));
    }
}else{
    print_r(json_encode(array(
        "status" => "error",
        "code" => "WRONG_AUTH",
        "msg" => "เข้ามาทำไมค๊าาาา!"
    )));
}

?>