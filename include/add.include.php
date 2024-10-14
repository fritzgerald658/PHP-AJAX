<?php
include __DIR__ . "/../classes/GetUserData.php";
include __DIR__ . "/../classes/UserData.php";
include __DIR__ . "/../classes/UserValidation.php";

//validation error message variable
$error_msg = "";

function addAndRetrieveUserInformation($first_name, $last_name, $email_address, $home_address, $age, $gender)
{
    $add_user = new UserData($first_name, $last_name, $email_address, $home_address, $age, $gender);
    $add_user->addUser();
    $users = new GetUserData();
    $users->getUser();
}

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email_address = $_POST['email_address'];
    $home_address = $_POST['home_address'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    // form validation
    $form_validation = new UserValidation();
    $errors = $form_validation->userValidation($first_name, $last_name, $email_address, $age, $home_address, $gender);

    if (!empty($errors)) {
        foreach ($errors as $error) {
            $error_msg .= "$error <br>";
        }
    } else {
        $users = new GetUserData();
        $users->getUser();
    }
    //     addAndRetrieveUserInformation($first_name, $last_name, $email_address, $home_address, $age, $gender);
    // }
}
