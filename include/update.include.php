<?php
include __DIR__ . "/../classes/UpdateUserData.php";
include  "validation.php";
require_once __DIR__ . "/../classes/UserValidation.php";

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request method.");
}

$id = $_POST['id'] ?? null; // Get ID safely
if (!$id) {
    die("User ID is missing.");
}

// Initialize form validation error message
$error_msg = "";

// Use null coalescing operator to handle unset variables
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$email_address = $_POST['email_address'] ?? '';
$home_address = $_POST['home_address'] ?? '';
$age = $_POST['age'] ?? '';
$gender = $_POST['gender'] ?? '';

// Collect validation errors
$errors = [];
$errors = array_merge($errors, firstNameValidation($first_name));
$errors = array_merge($errors, lastNameValidation($last_name));
$errors = array_merge($errors, emailAddressValidation($email_address));
$errors = array_merge($errors, ageValidation($age));
$errors = array_merge($errors, addressValidation($home_address));
$errors = array_merge($errors, genderValidation($gender));

// Check for errors and handle accordingly
if (!empty($errors)) {
    foreach ($errors as $error) {
        $error_msg .= "$error <br>";
    }
    echo $error_msg; // Output errors for user feedback
} else {
    // Proceed with updating user data
    $update_user = new UpdateUserData($first_name, $last_name, $email_address, $home_address, $age, $gender, $id);
    if ($update_user->updateUserData() === true) {
        echo "User updated successfully."; // Success message
    } else {
        echo $update_user->updateUserData(); // Output the error message from updateUserData
    }
}
