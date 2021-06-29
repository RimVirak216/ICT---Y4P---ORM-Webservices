<?php
 header("Access-Control-Allow-Origin: *");
 header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
 header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
 header('Content-Type: application/json');
/*
 * Following code will list all the posts
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// get all tasks from posts table
$result = mysqli_query($db->connect(), "SELECT *FROM posts");
 
// check for empty result
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // post node
    $response["posts"] = array();
 
    while ($row = mysqli_fetch_array($result)) {
        // temp posts array
        $posts = array();
        $post["userId"] = $row["userId"];
        $post["id"] = $row["id"];
        $post["title"] = $row["title"];
        $post["body"] = $row["body"];
 
        // push single post into final response array
        array_push($response["posts"], $task);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no posts found
    $response["success"] = 0;
    $response["message"] = "No posts found";
 
    // echo no posts JSON
    echo json_encode($response);
}
?>