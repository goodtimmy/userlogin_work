<?php

require "../classes/user_class.php";

// init a new instance of user
$loginAttempt = new user_class($_POST['login'], $_POST['password']);

// trying to login
if (!$user_data = $loginAttempt->checkCredentials()) {

    $loginAttempt->closeConnection();
    return false;

}
else {

    $loginAttempt->closeConnection();

    $options=$user_data;

    echo json_encode($options);
}



