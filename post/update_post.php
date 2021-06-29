<?php
 header("Access-Control-Allow-Origin: *");
 header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
 header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
 header('Content-Type: application/json');
/*
 * Following code will update a task information
 * A task is identified by task id (taskId)
 */
 
// array for JSON response
$response = array();
 
$postdata = json_decode(file_get_contents("php://input"), true);
$id = $postdata['id'];
$title = $postdata['title'];
$body = $postdata['body'];
$userId = $postdata['userId'];

// check for required fields
if (isset($id) && isset($title) && isset($body) && isset($userId)) {
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql update row with matched pid
    $result = mysqli_query($db->connect(),"UPDATE posts SET title = '$title', body = '$body', userId = '$userId' WHERE id = $id");
 
    // check if row inserted or not
    if ($result) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Post successfully updated.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
 
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>