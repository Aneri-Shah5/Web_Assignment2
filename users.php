<?php
error_reporting(0);
header('Content-Type: application/json');

require_once 'dbConfig.php';

// Create a New User
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['id'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $purchase_history = $_POST['purchase_history'];
    $shipping_address = $_POST['shipping_address'];

    $sql_query = "INSERT INTO users(u_email, u_password, u_username, u_purchase_history, u_shipping_address) VALUES ('$email', '$password', '$username', '$purchase_history', '$shipping_address')";
    if ($db_conn->query($sql_query) == TRUE) {
        echo json_encode(["status" => "Success", "message" => "User Added Successfully."]);
    } else {
        echo json_encode(["status" => "Error", "error" => "Error while creating user: " . $db_conn->error]);
    }
}
// Get a Specific User by User ID
else if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $u_id = $_GET['id'];

    $sql_query = "SELECT * FROM users WHERE u_id = $u_id";
    $result = $db_conn->query($sql_query);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode($user);
    } else {
        echo json_encode(["status" => "Success", "message" => "User not found."]);
    }
}
// Get all Users
else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql_query = "SELECT * FROM users";
    $result = $db_conn->query($sql_query);
    if ($result->num_rows > 0) {
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        echo json_encode($users);
    } else {
        echo json_encode(["status" => "Success", "message" => "No users found..!! Please try again or insert new user."]);
    }
}
// Update a User
else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $purchase_history = $_POST['u_purchase_history'];
    $shipping_address = $_POST['u_shipping_address'];

    $sql_query = "UPDATE users SET u_email = '$email', u_password = '$password', u_username = '$username', u_purchase_history = '$purchase_history', u_shipping_address = '$shipping_address' WHERE u_id = $id";
    if ($db_conn->query($sql_query) == TRUE) {
        echo json_encode(["status" => "Success", "message" => "User Updated Successfully."]);
    } else {
        echo json_encode(["status" => "Error", "error" => "Error while updating user: " . $db_conn->error]);
    }
}
// Delete a User
else if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id'])) {
    $u_id = $_GET['id'];

    $sql_query = "DELETE FROM users WHERE u_id=$u_id";
    if ($db_conn->query($sql_query) == TRUE) {
        echo json_encode(["status" => "Success", "message" => "User Deleted Successfully."]);
    } else {
        echo json_encode(["status" => "Error", "error" => "Error while deleting user: " . $db_conn->error]);
    }
}

$db_conn->close();
?>