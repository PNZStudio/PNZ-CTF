<?php

if(isset($_POST['email']) AND isset($_POST['username']) AND isset($_POST['password']) AND isset($_POST['g-recaptcha-response'])){
    $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
    if($resp->isSuccess()) {
        $check = $class->db(
            "SELECT * FROM `member` WHERE email = ? OR username = ?",
            array($_POST['email'],$_POST['username']),
            true
        );
        if($check){
            print_r(json_encode(array(
                "status" => "error",
                "code" => "WRONG_AUTH",
                "msg" => "ชื่อผู้ใช้ หรือ อีเมลถูกใช้งานแล้ว!"
            )));
        }else{
            $class->db(
                "INSERT INTO `member`(`uid`, `email`, `username`, `password`, `point`, `role`, `token`) VALUES (NULL,?,?,?,?,?,?)",
                array($_POST['email'],$_POST['username'],$class->password($_POST['password']),"0","user",$class->token($_POST['username'].$class->password($_POST['password'])))
            );
            print_r(json_encode(array(
                "status" => "success",
                "code" => "REGISTER_SUCCESS",
                "msg" => "สมัครสมาชิกเรียบร้อย!"
            )));
            $_SESSION['login'] = $class->token($_POST['username'].$class->password($_POST['password']));
        }
    }else{
        print_r(json_encode(array(
            "status" => "error",
            "code" => "NO_RECAPTCHA",
            "msg" => "reCaptcha ไม่ถูกต้องค่ะ!"
        )));
    }

}else{
    print_r(json_encode(array(
        "status" => "error",
        "code" => "NO_PERMISSION",
        "msg" => "เปิดอ่านทำเหี้ยไรค๊าาาา!"
    )));
}
