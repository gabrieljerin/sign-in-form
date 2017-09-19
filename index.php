<link href="./style/bootstrap.min.css" rel="stylesheet">
<link href="./style/font-awesome.min.css" rel="stylesheet">
<link href="./style/animate.min.css" rel="stylesheet">
<link href="./style1/common.css" media="all" rel="stylesheet">
<link href="./skins/square/blue.css" rel="stylesheet">
<link href="./skins/flat/blue.css" rel="stylesheet">
<link href="./skins/flat/flat.css" rel="stylesheet">
<link href="./style1/cookies.css" rel="stylesheet">
<script type="text/javascript" src="./scripts/jquery-3.1.1.min.js"></script>
<script src="./scripts/bootstrap.min.js"></script>
<script type="text/javascript" src="scripts/bootbox.min.js"></script>
<script type="text/javascript" src="./javascript/common.js"></script>
<script type="text/javascript" src="./scripts/icheck.min.js"></script>
<?php
require_once './modal/modal.php';
blockHistory();
session_start();

//---------------------include other pages---------------------//
function includeContents() {
    if (isset($_REQUEST['page'])) {
        switch (base64_decode(urldecode($_REQUEST['page']))) {
            case "landingPage":
                require_once './landingPage.php';
                break;
        }
    }
}

//--------------------------------------------------------------//
//---------------------LogOut-------------------------------//
if (isset($_REQUEST['action'])) {
    switch (base64_decode(urldecode($_REQUEST['action']))) {
        case "logout":
            unset($_SESSION['userDetails']);
            unset($_SESSION['Active']);
            includeLoginScripts();
            require_once './loader.php';
            require_once './login.php';
            break;
    }
}
//-----------------------------------------------------------//
//----------------------First Login-----------------------------------//
if (!isset($_SESSION['userDetails']) && !isset($_SESSION['Active'])) {
    includeLoginScripts();
    require_once './loader.php';
    require_once './login.php';
}
//--------------------------------------------------------------------//
?>
<?php

function includeLoginScripts() {
    ?>
    <link href="./style1/login.css" rel="stylesheet"/>
    <link href="./style1/loader.css" rel="stylesheet"/>
    <script src="./javascript/login.js"></script>
    <html>
        <head>
            <meta charset="UTF-8">
            <title class="title-cls">Loading...</title>
        </head>
    </html>
<?php } ?>
    <?php

//------------block back button of browser-------------//
function blockHistory() {
    ?>
    <script>
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, document.URL);
        });
    </script>
    <?php
}
?>
