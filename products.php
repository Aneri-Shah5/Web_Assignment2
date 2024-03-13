<?php
error_reporting(0);
header('Content-Type: application/json');

require_once 'dbConfig.php';

// Create a New Product
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['id'])) {
    $description = $_POST['description'];
    $image = $_POST['image'];
    $pricing = $_POST['pricing'];
    $shipping_cost = $_POST['shipping_cost'];

    $sql_query = "INSERT INTO products(p_description, p_image, p_pricing, p_shipping_cost) VALUES ('$description', '$image', $pricing, $shipping_cost)";
    if ($db_conn->query($sql_query) == TRUE) {
        echo json_encode(["status" => "Success", "message" => "Product Added Successfully."]);
    } else {
        echo json_encode(["status" => "Error", "error" => "Error while creating product: " . $db_conn->error]);
    }
}
// Get a Specific Product by Product ID
else if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $p_id = $_GET['id'];

    $sql_query = "SELECT * FROM products WHERE p_id = $p_id";
    $result = $db_conn->query($sql_query);
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        echo json_encode($product);
    } else {
        echo json_encode(["status" => "Success", "message" => "Product not found."]);
    }
}
// Get all Products
else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql_query = "SELECT * FROM products";
    $result = $db_conn->query($sql_query);
    if ($result->num_rows > 0) {
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        echo json_encode($products);
    } else {
        echo json_encode(["status" => "Success", "message" => "No products found..!! Please try again or insert new product."]);
    }
}
// Update a product
else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $pricing = $_POST['pricing'];
    $shipping_cost = $_POST['shipping_cost'];

    $sql_query = "UPDATE products SET p_description = '$description', p_image = '$image', p_pricing = $pricing, p_shipping_cost = $shipping_cost WHERE p_id = $id";
    if ($db_conn->query($sql_query) == TRUE) {
        echo json_encode(["status" => "Success", "message" => "Product Updated Successfully."]);
    } else {
        echo json_encode(["status" => "Error", "error" => "Error while updating product: " . $db_conn->error]);
    }
}
// Delete a product
else if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id'])) {
    $p_id = $_GET['id'];

    $sql_query = "DELETE FROM products WHERE p_id=$p_id";
    if ($db_conn->query($sql_query) == TRUE) {
        echo json_encode(["status" => "Success", "message" => "Product Deleted Successfully."]);
    } else {
        echo json_encode(["status" => "Error", "error" => "Error deleting product: " . $db_conn->error]);
    }
}

$db_conn->close();
?>