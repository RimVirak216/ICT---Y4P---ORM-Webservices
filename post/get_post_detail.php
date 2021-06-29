<?php
 header("Access-Control-Allow-Origin: *");
 header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
 header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
 header('Content-Type: application/json');
/*
 * Following code will get single task details
 * A task is identified by post id (id)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();

$postdata = json_decode(file_get_contents("php://input"), true);
$id = $postdata['id'];
 
// check for post data
if (isset($id)) {
 
    // get a post from post table
    $result = mysqli_query($db->connect(),"SELECT * FROM posts WHERE id = $id");
 
    if (!empty($result)) {
        // check for empty result
        if (mysqli_num_rows($result) > 0) {
 
            $result = mysqli_fetch_array($result);
 
            $post = array();
            $post["id"] = $result["id"];
            $post["title"] = $result["title"];
            $post["body"] = $result["body"];
            $post["userId"] = $result["userId"];
            // success
            $response["success"] = 1;
 
            // user node
            $response["post"] = array();
 
            array_push($response["post"], $post);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no post found
            $response["success"] = 0;
            $response["message"] = "No post found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no post found
        $response["success"] = 0;
        $response["message"] = "No post found";
 
        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>