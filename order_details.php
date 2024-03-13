<?php
error_reporting(0);
header('Content-Type: application/json');

require_once 'dbConfig.php';

// Create a New Order
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['id'])) {
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $total_amount = $_POST['total_amount'];

    $sql_query = "INSERT INTO order_details(o_user_id, o_product_id, o_quantity, o_total_amount) VALUES ($user_id, $product_id, $quantity, $total_amount)";
    if ($db_conn->query($sql_query) == TRUE) {
        echo json_encode(["status" => "Success", "message" => "Order Added Successfully."]);
    } else {
        echo json_encode(["status" => "Error", "error" => "Error while creating order: " . $db_conn->error]);
    }
}
// Get a Specific Order by Order ID
else if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $o_id = $_GET['id'];

    $sql_query = "SELECT * FROM order_details WHERE o_id = $o_id";
    $result = $db_conn->query($sql_query);
    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
        echo json_encode($order);
    } else {
        echo json_encode(["status" => "Success", "message" => "Order Details not found."]);
    }
}
// Get all Orders
else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql_query = "SELECT * FROM order_details";
    $result = $db_conn->query($sql_query);
    if ($result->num_rows > 0) {
        $order_details = [];
        while ($row = $result->fetch_assoc()) {
            $order_details[] = $row;
        }
        echo json_encode($order_details);
    } else {
        echo json_encode(["status" => "Success", "message" => "No Orders found..!! Please try again or insert new order data."]);
    }
}
// Update a Order
else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $total_amount = $_POST['total_amount'];

    $sql_query = "UPDATE order_details SET o_user_id = $user_id, o_product_id = $product_id, o_quantity = $quantity, o_total_amount = $total_amount WHERE o_id = $id";
    if ($db_conn->query($sql_query) == TRUE) {
        echo json_encode(["status" => "Success", "message" => "Order Details Updated Successfully."]);
    } else {
        echo json_encode(["status" => "Error", "error" => "Error while updating Order: " . $db_conn->error]);
    }
}
// Delete a product
else if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id'])) {
    $o_id = $_GET['id'];

    $sql_query = "DELETE FROM order_details WHERE o_id = $o_id";
    if ($db_conn->query($sql_query) == TRUE) {
        echo json_encode(["status" => "Success", "message" => "Order Deleted Successfully."]);
    } else {
        echo json_encode(["status" => "Error", "error" => "Error while deleting Order: " . $db_conn->error]);
    }
}

$db_conn->close();
?>