<?php

session_destroy();
setcookie('token', null, time()-1,'/');
$class->re('/login');
?>