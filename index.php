<?php
/*
/=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\
| @Type | ปั้มSPIN     	      |
| @version | 1.0a		      |
| @Author | BossNzXD          |
| @Facebook | Teerawat Luesat |
\=-=-=-=-=-=-=-=-=-=-=-=-=-=-=/

*/

//================Don't Touch It================

session_start();
include 'controller/system/router.class.php';
$class = new router;
$class->start_router();

//================Don't Touch It================
