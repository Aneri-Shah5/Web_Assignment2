<?php
error_reporting(0);
header('Content-Type: application/json');

require_once 'dbConfig.php';

// Create a New Comment
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['id'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_POST['user_id'];
    $rating = $_POST['rating'];
    $image = $_POST['image'];
    $text = $_POST['text'];

    $sql_query = "INSERT INTO comments(c_product_id, c_user_id, c_rating, c_image, c_text) VALUES ($product_id, $user_id, $rating, '$image', '$text')";
    if ($db_conn->query($sql_query) == TRUE) {
        echo json_encode(["status" => "Success", "message" => "Comment Added Successfully."]);
    } else {
        echo json_encode(["status" => "Error", "error" => "Error while creating comment: " . $db_conn->error]);
    }
}
// Get a Specific Comment by Comment ID
else if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $c_id = $_GET['id'];

    $sql_query = "SELECT * FROM comments WHERE c_id = $c_id";
    $result = $db_conn->query($sql_query);
    if ($result->num_rows > 0) {
        $comment = $result->fetch_assoc();
        echo json_encode($comment);
    } else {
        echo json_encode(["status" => "Success", "message" => "Comment not found."]);
    }
}
// Get all Comments
else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql_query = "SELECT * FROM comments";
    $result = $db_conn->query($sql_query);
    if ($result->num_rows > 0) {
        $comments = [];
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
        echo json_encode($comments);
    } else {
        echo json_encode(["status" => "Success", "message" => "No comments found..!! Please try again or insert new comment."]);
    }
}
// Update a Comment
else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $product_id = $_POST['product_id'];
    $user_id = $_POST['user_id'];
    $rating = $_POST['rating'];
    $image = $_POST['image'];
    $text = $_POST['text'];

    $sql_query = "UPDATE comments SET c_product_id = $product_id, c_user_id = $user_id, c_rating = '$rating', c_image = '$image', c_text = '$text' WHERE c_id = $id";
    if ($db_conn->query($sql_query) == TRUE) {
        echo json_encode(["status" => "Success", "message" => "Comment Updated Successfully."]);
    } else {
        echo json_encode(["status" => "Error", "error" => "Error while updating comment: " . $db_conn->error]);
    }
}
// Delete a Comment
else if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id'])) {
    $c_id = $_GET['id'];

    $sql_query = "DELETE FROM comments WHERE c_id = $c_id";
    if ($db_conn->query($sql_query) == TRUE) {
        echo json_encode(["status" => "Success", "message" => "Comment Deleted Successfully."]);
    } else {
        echo json_encode(["status" => "Error", "error" => "Error while deleting comment: " . $db_conn->error]);
    }
}

$db_conn->close();
?>