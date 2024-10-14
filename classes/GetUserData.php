<?php

include "Database.php";

class GetUserData extends Database
{
    // You can keep these properties if you plan to use them for specific purposes.
    private $first_name;
    private $last_name;
    private $email_address;
    private $home_address;
    private $age;
    private $gender;

    // Method to get user data
    public function getUser()
    {
        $sql = "SELECT * FROM user_registration";
        $result = parent::connect()->query($sql);

        $users_data = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users_data[] = $row;
            }
        }

        // Instead of echoing directly, return the data
        return $users_data;
    }

    // Method to return JSON response
    public function getUserAsJson()
    {
        $users_data = $this->getUser();
        header("Content-Type: application/json");
        echo json_encode($users_data);
    }

    public function getUserById($id = null)
    {
        if ($id) {
            // Fetch a single user by ID
            $sql = "SELECT * FROM user_registration WHERE id = ?";
            $stmt = parent::connect()->prepare($sql);
            $stmt->bind_param("i", $id); // Bind the parameter as an integer
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_assoc(); // Return a single user
        } else {
            // Fetch all users
            $sql = "SELECT * FROM user_registration";
            $result = parent::connect()->query($sql);

            $users_data = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $users_data[] = $row;
                }
            }

            return $users_data; // Return all users
        }
    }
    public function getUserByIdAsJson()
    {
        // Check if an ID is provided in the GET request
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;

        // Fetch user data
        $users_data = $this->getUser($id);

        // Set the content type to JSON
        header("Content-Type: application/json");

        // Check if data was returned
        if ($users_data) {
            echo json_encode(['success' => true, 'data' => $users_data]);
        } else {
            echo json_encode(['success' => false, 'message' => 'User not found.']);
        }
    }
}
