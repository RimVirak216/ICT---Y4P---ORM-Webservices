<?php
 header("Access-Control-Allow-Origin: *");
 header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
 header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
 header('Content-Type: application/json');
/*
 * Following code will get single task details
 * A task is identified by task id (taskId)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();

$postdata = json_decode(file_get_contents("php://input"), true);
$q = $postdata['q'];
 
// check for post data
if (isset($q)) {
 
    // get a task from task table
    $result = mysqli_query($db->connect(),"SELECT * FROM posts WHERE title LIKE '%$q%' ");
 
    if (!empty($result)) {
        // check for empty result
        if (mysqli_num_rows($result) > 0) {
 
            $response["posts"] = array();
 
            while ($row = mysqli_fetch_array($result)) {
                // temp tasks array
                $post = array();
                $post["id"] = $row["id"];
                $post["title"] = $row["title"];
                $post["body"] = $row["body"];
                $post["userId"] = $row["userId"];
            
        
                // push single task into final response array
                array_push($response["posts"], $post);
            }
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no task found
            $response["success"] = 0;
            $response["message"] = "No post found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no task found
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