<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/cms/inc/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/cms/inc/sessions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/cms/inc/functions.php';

//redirect
function redirect_to($new_location)
{
    header('Location:' . $new_location);
    exit();
}

//security.
function sanitize($dirty)
{
    $dirty = trim($dirty);
    // $dirty = stripslashes($dirty);
    // $dirty = htmlspecialchars($dirty);
    return htmlentities($dirty, ENT_QUOTES, "UTF-8");
}

// displaying errors
function display_errors($errors)
{
    $count = 1;
    $display = '<ul class="alert alert-danger">';
    foreach ($errors as $error) {
        $display .= '<li class="">' . $error . '</li>';
    }
    $display .= '</ul>';
    return $display;
}

function desanitize($clean)
{
    return html_entity_decode($clean);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function test_output($data)
{
    $data = htmlspecialchars_decode($data);
}

//login function
function login_attempt($usernameEmail, $password)
{
    global $conn;
    $query = "SELECT * FROM media_centre_admin_registration WHERE email='$usernameEmail'";
    $queryExecute = $conn->query($query);
    if ($admin = mysqli_fetch_assoc($queryExecute)) {
        $pwdCheck = password_verify($password, $admin['password']);
        if ($pwdCheck == true) {
            return $admin;
        } else {
            return null;
        }
    }
}

function login()
{
    if (isset($_SESSION['user_id'])) {
        return true;
    }
}

function confirm_login()
{
    if (!login()) {
        echo "<script>
    alert('You are not logged in. please log in');
</script>";
        echo "<script>
    window.open('login.php', '_SELF');
</script>";
    }
}
