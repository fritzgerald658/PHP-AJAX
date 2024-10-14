<?php
// Include necessary classes
include __DIR__ . "/../classes/UserData.php";
include __DIR__ . "/../classes/UserValidation.php";

// Initialize error message variable
$error_msg = "";

// Check if the form is submitted
$first_name = $_POST['first_name'] ?? ''; // Use null coalescing operator to handle unset variables
$last_name = $_POST['last_name'] ?? '';
$email_address = $_POST['email_address'] ?? '';
$home_address = $_POST['home_address'] ?? '';
$age = $_POST['age'] ?? '';
$gender = $_POST['gender'] ?? '';

// Perform validation
$form_validation = new UserValidation();
$errors = $form_validation->userValidation($first_name, $last_name, $email_address, $age, $home_address, $gender);

if (!empty($errors)) {
    // Concatenate error messages
    foreach ($errors as $error) {
        $error_msg .= "$error <br>"; // Use <br> for line breaks
    }
    echo $error_msg; // Return errors to the AJAX call
} else {
    // Create a new UserData instance
    $add_user = new UserData($first_name, $last_name, $email_address, $home_address, $age, $gender);

    // Attempt to add the user to the database
    if ($add_user->addUser()) {
        echo "User added successfully!"; // Success message
    } else {
        echo "Error adding user."; // Error message for database issue
    }
}
