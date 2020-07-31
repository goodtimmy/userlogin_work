<?php

//requireing
require "../classes/user_class.php";

// init a new user instance
$userRegister = new user_class($_POST['login'], $_POST['password']);

//Set user data to be updated
$userRegister->setEmail($_POST['email']);
$userRegister->setFirstName($_POST['first_name']);
$userRegister->setSecondName($_POST['second_name']);
$userRegister->setLastName($_POST['last_name']);

// Checking if user not exist
if ($userRegister->checkUserExists()) {

    $userRegister->closeConnection();

    // Error message
    echo "0";

} else {

    // User data validation ( does not work yet)
    if(!$userRegister->dataValidation()) {

        // to do - deal with validation error

    }

    //Store new user data to DB
    $userRegister->newUserRegistration();

    $userRegister->closeConnection();

    // Success message
    echo "1";

}

