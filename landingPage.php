<?php ?>
<html>
    <head>
        <title>Home</title>
        <link href="./style/animate.min.css" rel="stylesheet">
        <link href="./style1/landingPage.css" rel="stylesheet">
    </head>
    <body>
        <section class="intro">
            <div class="inner animated zoomIn">
                <div class="content animated rollIn">
                    <h1 class="heading-h1">Welcome</h1>
                    <a class="btn-cls" href="#">Get Started</a>
                    <a class="btn-cls" href="index.php?action=<?php echo urlencode(base64_encode("logout")); ?>">Sign Out</a>
                </div>
            </div>
        </section>
    </body>
</html>
