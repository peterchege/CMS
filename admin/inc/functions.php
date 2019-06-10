<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/unitedpicturesblog/inc/db.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/unitedpicturesblog/inc/sessions.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/unitedpicturesblog/inc/functions.php';

//redirect
function redirect_to($new_location){
	header('Location:'.$new_location);
//	exit();
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//login function
function login_attempt($usernameEmail,$password){
    global $conn;
    $query="SELECT * FROM admin_registration WHERE username='$usernameEmail' AND password='$password' OR email='$usernameEmail' ";
    $queryExecute=$conn->query($query);
    if($admin=mysqli_fetch_assoc($queryExecute)){
        return $admin;
    }else{
        return null;
    }
}

function login(){
    if(isset($_SESSION['user_id'])){
        return true;
    }
}

function confirm_login(){
    if(!login()){
        echo "<script>
    alert('You are not logged in. please log in');
</script>";        
        echo "<script>
    window.open('login.php', '_SELF');
</script>";
    }
}
