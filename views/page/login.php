<?php

if(isset($_SESSION['login'])){
    $class->re("/home");
}

?>
<div class="container mt-3">
    <div class="col-sm-6 m-auto">
        <div class="card">
            <div class="card-body">
                <h3><i class="fal fa-key"></i> เข้าสู่ระบบ</h3>
                <form id="login">
                    <div class="md-form">
                        <input type="text" name="username" id="username" class="form-control" required>
                        <label for="username">Username</label>
                    </div>
                    <div class="md-form">
                        <input type="password" name="password" id="password" class="form-control" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="row px-3 mb-4">
                        <div class="custom-control custom-checkbox custom-control-inline"> <input id="chk1" type="checkbox" name="chk" class="custom-control-input"> <label for="chk1" class="custom-control-label text-sm">จำการเข้าสู่ระบบ</label> </div> <a href="/password-reset" class="ml-auto mb-0 text-sm">ลืมรหัส?</a>
                    </div>
                    <center class="mb-3">
                        <div class="g-recaptcha" data-sitekey="6Le1s3MaAAAAAJLLj7FIPxbTstbENLfPT_xurd2P"></div>
                    </center>
                    <button type="submit" id="login" class="btn btn-block btn-dark">
                        <i class="fal fa-key"></i> เข้าสู่ระบบ
                    </button>
                </form>
                <div class="d-none d-md-block mt-3">
                    <div class="row">
                        <div class="col-sm-5">
                            <hr>
                        </div>
                        <div class="col-sm-2"><center>หรือ</center></div>
                        <div class="col-sm-5">
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="d-block d-md-none">
                    <hr>
                </div>
                <center>
                    <div class="col-md-12 mb-4">
                        <a id="fb_login" onclick="fb_login();" type="button" class="btn-floating unique-color"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                        <a type="button" onclick="Toast.fire({icon: 'warning',title: 'ระบบยังไม่เปิดให้บริการ',});" class="btn-floating btn-dark"><i class="fab fa-discord" aria-hidden="true"></i></a>
                        <a type="button" onclick="Toast.fire({icon: 'warning',title: 'ระบบยังไม่เปิดให้บริการ',});" class="btn-floating red darken-3"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
                    </div>
                </center>
                <hr>
                <button class="btn btn-block pn-color text-dark" onclick="re('/register')"><i class="fal fa-user-plus"></i> สมัครสมาชิก</button>



            </div>
        </div>
    </div>
</div>
