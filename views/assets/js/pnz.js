//SWEET ALERT
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

function re(url) {
    location.href = url;
}
function num_format(num) {
    var num_parts = num.toString().split(".");
    num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return num_parts.join(".");
}

$('#login').on('submit', function (e) {
    e.preventDefault();
    if (grecaptcha.getResponse() == "") {
        e.preventDefault();
        Toast.fire({
            icon: 'error',
            title: 'กด reCaptcha ก่อนสิคะ'
        });
    } else {
        $.post('/api/v1/login', $("#login").serialize(), function (res) {
            if (res.status == 'success') {
                Toast.fire({
                    icon: res.status,
                    title: res.msg,
                });
                setTimeout(() => {
                    re('/home');
                }, 3000);
            } else {
                Toast.fire({
                    icon: res.status,
                    title: res.msg,
                });
                grecaptcha.reset();
            }
        }, 'json');

    }
});

$('#register').on('submit', function (e) {
    e.preventDefault();
    if (grecaptcha.getResponse() == "") {
        e.preventDefault();
        Toast.fire({
            icon: 'error',
            title: 'กด reCaptcha ก่อนสิคะ'
        });
    } else {
        $.post('/api/v1/register', $("#register").serialize(), function (res) {
            if (res.status == 'success') {
                Toast.fire({
                    icon: res.status,
                    title: res.msg,
                });
                setTimeout(() => {
                    re('/home');
                }, 3000);
            } else {
                Toast.fire({
                    icon: res.status,
                    title: res.msg,
                });
                grecaptcha.reset();
            }
        }, 'json');

    }
});

if (login !== '') {
    $.post('/api/v1/me', { token: login }, function (res) {
        if (res.status == 'success') {
            $("#point").html(num_format(res.data.point));
        }
    }, 'json');
}
setInterval(function () {
    if (login !== '') {
        $.post('/api/v1/me', { token: login }, function (res) {
            if (res.status == 'success') {
                $("#point").html(num_format(res.data.point));
            }
        }, 'json');
    }
}, 3000);

window.fbAsyncInit = function () {
    FB.init({
        appId: '458788965240270',
        cookie: true,
        xfbml: true,
        version: 'v10.0'
    });

    FB.AppEvents.logPageView();

};

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) { return; }
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function fb_login(){
    FB.login(function(response) {

        if (response.authResponse) {
            access_token = response.authResponse.accessToken;
            user_id = response.authResponse.userID;

            FB.api('/me', function(response) {
                var name = response.name;
                $.post('/api/v1/fb_login', { token: access_token,user_id: user_id,name:name }, function (res) {
                    if (res.status == 'success') {
                        Toast.fire({
                            icon: 'success',
                            title: 'เข้าสู่ระบบเรียบร้อย'
                        });
                        setTimeout(() => {
                            re('/home');
                        }, 3000);
                    }else{
                        Toast.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ'
                        });
                    }
                }, 'json');
            });

        } else {
            Toast.fire({
                icon: 'error',
                title: 'ยกเลิกการเข้าสู่ระบบ'
            });
        }
    }, {
        scope: 'public_profile,email'
    });
}
(function() {
    var e = document.createElement('script');
    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
}());

setInterval(function () {
    
}, 3000);