<?php
error_reporting(0);
header('Content-Type: application/json');

require_once 'dbConfig.php';

// Create a New Cart Details
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['id'])) {
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $sql_query = "INSERT INTO cart_details(ca_user_id, ca_product_id, ca_quantity) VALUES ($user_id, $product_id, $quantity)";
    if ($db_conn->query($sql_query) == TRUE) {
        echo json_encode(["status" => "Success", "message" => "Cart Detail Added Successfully."]);
    } else {
        echo json_encode(["status" => "Error", "error" => "Error while creating cart: " . $db_conn->error]);
    }
}
// Get a Specific Cart Details by Cart Detail ID
else if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $ca_id = $_GET['id'];

    $sql_query = "SELECT * FROM cart_details WHERE ca_id = $ca_id";
    $result = $db_conn->query($sql_query);
    if ($result->num_rows > 0) {
        $cart_data = $result->fetch_assoc();
        echo json_encode($cart_data);
    } else {
        echo json_encode(["status" => "Success", "message" => "Cart Detail not found."]);
    }
}
// Get all Cart Details
else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql_query = "SELECT * FROM cart_details";
    $result = $db_conn->query($sql_query);
    if ($result->num_rows > 0) {
        $cart_details = [];
        while ($row = $result->fetch_assoc()) {
            $cart_details[] = $row;
        }
        echo json_encode($cart_details);
    } else {
        echo json_encode(["status" => "Success", "message" => "No Cart Details found..!! Please try again or insert new cart data."]);
    }
}
// Update a Cart Detail
else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $sql_query = "UPDATE cart_details SET ca_user_id = $user_id, ca_product_id = $product_id, ca_quantity = $quantity WHERE ca_id = $id";
    if ($db_conn->query($sql_query) == TRUE) {
        echo json_encode(["status" => "Success", "message" => "Comment Updated Successfully."]);
    } else {
        echo json_encode(["status" => "Error", "error" => "Error while updating cart: " . $db_conn->error]);
    }
}
// Delete a Cart Detail
else if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id'])) {
    $ca_id = $_GET['id'];

    $sql_query = "DELETE FROM cart_details WHERE ca_id = $ca_id";
    if ($db_conn->query($sql_query) == TRUE) {
        echo json_encode(["status" => "Success", "message" => "Cart Detail Deleted Successfully."]);
    } else {
        echo json_encode(["status" => "Error", "error" => "Error while deleting cart: " . $db_conn->error]);
    }
}

$db_conn->close();
?>