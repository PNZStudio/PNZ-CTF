<?php
session_start();

include 'controller/system/router.class.php';
$class = new router;
$class->start_router();
