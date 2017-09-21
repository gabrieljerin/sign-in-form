<?php

require_once '../conf/db_connect.php';
require_once '../functions/functions_server.php';
$function = $_REQUEST['function'];
switch ($function) {
    case "showUsers":showUsers($conn);
        break;
    case "removeUser":removeUser($conn);
        break;
}

function showUsers($conn) {
    $cookie = $_COOKIE['usernames'];
    $cookie = stripslashes($cookie);
    $cookieArray = json_decode($cookie, true);
    if ($cookieArray != NULL) {
        $query = "select DISTINCT user_name,fk_user_id from tb_user_cookie";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    } else {
        $data = NULL;
        $deleteQuery = "delete from tb_user_cookie";
        mysqli_query($conn, $deleteQuery);
    }
    header('Content-type: application/json');
    echo json_encode($data);
}

function removeUser($conn) {
    $result = delete_data($conn, "tb_user_cookie", "fk_user_id", $_POST['id']);
    header('Content-type: application/json');
    echo json_encode(1);
}
?>

