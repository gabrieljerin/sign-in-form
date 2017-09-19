<?php
require_once 'configuration.php';
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
    echo'Could not connect: ' . mysqli_connect_error();
}
?>

