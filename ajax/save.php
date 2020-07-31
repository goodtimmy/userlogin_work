<?php

require "../classes/user_class.php";

//  New instance of user
$dataChange = new user_class($_POST['login'], $_POST['password']);

//Set user data to be updated
$dataChange->setFirstName($_POST['first_name']);
$dataChange->setSecondName($_POST['second_name']);
$dataChange->setLastName($_POST['last_name']);

// User data validation ( does not work yet)
if(!$dataChange->dataValidation()) {

    // to do - deal with validation error

}

// Making update
$dataChange->changeUserData();

$dataChange->closeConnection();
