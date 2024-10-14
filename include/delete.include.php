<?php

include __DIR__ . "/../classes/DeleteUserData.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $delete_user = new DeleteUserData();
    if ($delete_user->deleteData($id)) {
        header("Location: ../data-tables.php");
        exit();
    } else {
        echo "Error";
    }
}
