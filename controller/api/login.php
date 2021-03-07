<?php

if(isset($_POST['username']) AND isset($_POST['password']) AND isset($_POST['g-recaptcha-response'])){
    $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
    if($resp->isSuccess()) {
        $token = $class->token($_POST['username'].$class->password($_POST['password']));
        $check = $class->db(
            "SELECT * FROM `member` WHERE token = ?",
            array($token),
            true
        );
        if($check){
            print_r(json_encode(array(
                "status" => "success",
                "code" => "LOGIN_SUCCESS",
                "msg" => "เข้าสู่ระบบเรียบร้อย!"
            )));
            $_SESSION['login'] = $check[0]['token'];
        }else{
            print_r(json_encode(array(
                "status" => "error",
                "code" => "WRONG_AUTH",
                "msg" => "ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง!"
            )));
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
