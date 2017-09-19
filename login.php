<?php
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
    </head>
    <body class="backgroung-img">
        <div class="div-cls table-responsive divAnimate">
            <center>
                <?php
                require_once './cookies.php';
                ?>
                <div class="login-box-cls animated" style="display: none;">
                    <div class="circle-div-cls div-circle">
                        <span class="fa fa-lock title"></span>
                        <span class="fa fa-unlock title" style="display: none;"></span>
                    </div>
                    <p class="p-cls">Start Your Session</p>
                    <form action="#" id="loginFrm">
                        <table style="width: 255px;">
                            <tr>
                                <td colspan="2" class="form-group has-feedback">
                                    <input name="login[userName]" type="text" class="form-control txt-flat txt-transparent u-name" placeholder="Username" value=""/>
                                    <span class="fa fa-user fa-1x form-control-feedback span-icon-cls"></span>
                                </td>
                            </tr>
                            <tr style="height: 16px;">
                            </tr>
                            <tr>
                                <td colspan="2" class="form-group has-feedback">
                                    <input name="login[password]" type="password" class="form-control txt-flat txt-transparent pass-txt" placeholder="Password"/>
                                    <span class="fa fa-key fa-1x form-control-feedback span-icon-cls"></span>
                                </td>
                            </tr>
                            <tr style="height: 16px;">
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <a href="#" style="color:white;font-size: 14px;float: right;"><u>Forgot Password</u></a> 
                                </td>
                            </tr>
                            <tr style="height: 16px;">
                            </tr>
                            <tr>
                                <td class="" style="font-size: 14px;">
                                    <input name="login[remember]" type="checkbox" class="remember-cls"/>&nbsp;Remember Me 
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary button-cls btn-flat login-btn-style animated" data-loading-text="<i class='fa fa-spinner fa-spin'></i>&nbsp;Loading" onclick="login(this)"><span class="fa fa-sign-in fa-1x"></span>&nbsp;Login</button>
                                </td>
                            </tr>
                            <tr style="height: 16px;">
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button type="button" class="btn btn-success btn-flat" onclick="showUsers(this)" data-loading-text="<i class='fa fa-spinner fa-spin'></i>&nbsp;Loading">Choose another Account</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </center>
        </div> 
    </body>
</html>
