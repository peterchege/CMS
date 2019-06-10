<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/unitedpicturesblog/inc/sessions.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/unitedpicturesblog/inc/functions.php';

$_SESSION['user_id']=null;
session_destroy();
redirect_to('login.php');