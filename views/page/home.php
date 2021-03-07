<?php

if (!isset($_SESSION['login'])) {
    $class->re("/login");
}

?>
<div class="container mt-3">
    <div class="row">
        <div class="col-sm-4 mt-3">
            <div class="card">
                <div class="card-body">
                    <center>
                        <img src="/views/assets/img/icon.png" height="120"><br>
                        <h3 id="name">loading...</h3>
                        <h5>ID : #<span id="uid">loading...</span></h5>
                        <hr>
                        <button onclick="re('/logout')" class="btn btn-block btn-dark">
                            <i class="fas fa-sign-out"></i> Logout
                        </button>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-sm-8 mt-3">
            <div class="card">
                <div class="card-body">
                    <center>
                        <h3>Coming Soon...</h3>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $.post('/api/v1/me', {
        token: login
    }, function(res) {
        if (res.status == 'success') {
            $("#name").html(res.data.username);
            $("#uid").html(res.data.uid);
        }
    }, 'json');
    setInterval(function() {
        $.post('/api/v1/me', {
            token: login
        }, function(res) {
            if (res.status == 'success') {
                $("#name").html(res.data.username);
                $("#uid").html(res.data.uid);
            }
        }, 'json');
    }, 3000);
</script>