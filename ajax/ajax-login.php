<?php
require_once '../conf/db_connect.php';
$function = $_REQUEST['function'];
switch ($function) {
    case "login":login($conn);
        break;
    case "savePassword":savePassword($conn);
        break;
}

function login($db) {
    if ($db == FALSE) {
        $data = 1;
    } else {
        $password = md5($_REQUEST['login']['password']);
        $query = "select * from tb_user where user_name='" . $_REQUEST['login']['userName'] . "' and password='" . $password . "'";
        $result = mysqli_query($db, $query);
        $data = mysqli_fetch_array($result);
        session_start();
        if ($data != NULL) {
            $_SESSION['userDetails'] = $data;
            $_SESSION['Active'] = "Yes";
            $users;
            if (!empty($_REQUEST['login']['remember'])) {
                $sqlQuery = "insert into tb_user_cookie(fk_user_id,user_name)value('" . $data['Id'] . "','" . $_REQUEST['login']['userName'] . "')";
                mysqli_query($db, $sqlQuery);
                $sqlQuery = "select DISTINCT user_name,fk_user_id from tb_user_cookie";
                $result = mysqli_query($db, $sqlQuery);
                while ($row = mysqli_fetch_assoc($result)) {
                    $users[] = $row;
                }
                $json = json_encode($users);
                setcookie("usernames", $json, time() + (10 * 365 * 24 * 60 * 60), "/");
            } else {
                $deleteQuery = "delete from tb_user_cookie where fk_user_id='" . $data['Id'] . "'";
                mysqli_query($db, $deleteQuery);
                $cookie = $_COOKIE['usernames'];
                $cookie = stripslashes($cookie);
                $cookieArray = json_decode($cookie, true);
                $key = search_for_key($data['Id'], $cookieArray, "fk_user_id");
                $newCookieArray = array_splice($cookieArray, $key, 1);
                $jsonData = json_encode($newCookieArray);
                setcookie("usernames", $jsonData, time() + (10 * 365 * 24 * 60 * 60), "/");
            }
        }
    }
    header('Content-type: application/json');
    echo json_encode($data);
}

function savePassword($db) {
    $flag;
    $settings = $_POST['settings'];
    $changePassword = $settings['changePassword'];
    $id = $changePassword['hidden'];
    $currentPassword = $changePassword['currentPassword'];
    $md5CurrentPassword = md5($currentPassword);
    $confirmPassword = $changePassword['confirmPassword'];
    $md5ConfirmPassword = md5($confirmPassword);
    $sql = "select * from tb_user where Id='" . $id . "'and password='" . $md5CurrentPassword . "'";
    $result = mysqli_query($db, $sql);
    $data = mysqli_fetch_array($result);
    if ($data != NULL) {
        $flag = 1;
        $query = "update tb_user set password='" . $md5ConfirmPassword . "' where Id='" . $id . "'";
        $result = mysqli_query($db, $query);
    } else {
        $flag = 0;
    }
    header('Content-type: application/json');
    echo json_encode($flag);
}

function search_for_key($id, $array, $index) {
    foreach ($array as $key => $val) {
        if ($val[$index] === $id) {
            return $key;
        }
    }
    return null;
}

?>