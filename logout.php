<?php
    require_once('inc/sessions.php');
    require_once('inc/functions.php');

$_SESSION['user_id']=null;
session_destroy();
redirect_to('login.php');