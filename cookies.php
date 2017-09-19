<?php
require_once './conf/db_connect.php';
$cookie = $_COOKIE['usernames'];
$cookie = stripslashes($cookie);
$cookieArray = json_decode($cookie, true);
if ($cookieArray != NULL) {
    $sqlQuery = "select DISTINCT user_name,fk_user_id from tb_user_cookie";
    $result = mysqli_query($conn, $sqlQuery);
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
} else {
    $deleteQuery = "delete from tb_user_cookie";
    mysqli_query($conn, $deleteQuery);
}
?>
<div class="cookies-wrapper animated" style="display: none;">
    <p class="p-cls" style="font-size: 20px;">
        Choose An Account&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button title="Close" type="button" class="btn btn-danger btn-sm" onclick="closeCookieBox(this)">
            <i class="fa fa-times" aria-hidden="true"></i>
        </button>
    </p>
    <?php
    for ($i = 0; $i < sizeof($users); $i++) {
        ?>
        <div class="cookies-holder animated">
            <button data-id="<?php echo $users[$i]['fk_user_id']; ?>" title="Remove" type="button" class="close cookie-close-cls" onclick="removeUser(this)">×</button>
            <div class="cookies-container" onclick="populateAccount(this)">
                &nbsp;&nbsp;&nbsp;<?php echo $users[$i]['user_name']; ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>