<?php

if(isset($_POST['token'])){
    $user = $class->db(
        "SELECT * FROM member WHERE token = ?",
        array($_POST['token']),
        true
    );
    if($user){
        print_r(json_encode(array(
            "status" => "success",
            "code" => "ME_SUCCESS",
            "msg" => "เรียกข้อมูลเรียบร้อย!",
            "data" => $user[0]
        )));
    }else{
        print_r(json_encode(array(
            "status" => "error",
            "code" => "WRONG_TOKEN",
            "msg" => "Token ผิดค่าาาา!"
        )));

    }

}else{
    print_r(json_encode(array(
        "status" => "error",
        "code" => "NO_PERMISSION",
        "msg" => "เปิดอ่านทำเหี้ยไรค๊าาาา!"
    )));
}

?>