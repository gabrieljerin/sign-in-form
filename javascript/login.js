$(document).ready(function () {
    animatePage();
    $(".u-name,.pass-txt").PreventCutCopyPaste();
    checkBoxRadioStyle();
    showPreferedPage();
    focusField(".u-name");
    $(".remember-cls").iCheck('check');
});
$(document).bind('keypress', function (e) {
    if (e.keyCode == 13) {
        $('.button-cls').trigger('click');
    }
});
function login(dom)
{
    if ($(".u-name").val() == "")
    {
        $(".u-name").focus();
        alertModal("Info", "Please Enter your User Name.");
        return false;
    }
    if ($(".pass-txt").val() == "")
    {
        $(".pass-txt").focus();
        alertModal("Info", "Please Enter your Password.");
        return false;
    }
    var url = "./ajax/ajax-login.php?function=login";
    var btn = $(dom);
    $(btn).button('loading');
    $.ajax({
        type: "POST",
        url: url,
        datatype: "json",
        data: $("#loginFrm").serialize(),
        success: function (data)
        {
            if (data == null)
            {
                $(btn).button('reset');
                alertModal("Error", "Invalid Login..! Please Check your Username and Password.");
                emptyTextFields(".u-name,.pass-txt");
                $(".u-name").focus();
            } else
            {

                hideDom(".fa-lock");
                showDom(".fa-unlock");
                $(btn).addClass("flipInX");
                $(btn).button('reset');
                window.location.href = "landingPage.php";
            }
        },
        error: function ()
        {
            $(btn).button('reset');
            alertModal("Error", "Could not Connect. Please try again later.");
            emptyTextFields(".u-name,.pass-txt");
        }
    });
}
function animatePage()
{
    $(".loader").show();
    setTimeout(function () {
        $(".loader").hide();
        $(".title-cls").empty();
        $(".title-cls").html("Login");
    }, 3200);
    $(".divAnimate").delay(2750).animate({opacity: 1}, 2500);
}
function showUsers(dom)
{
    var url = "./ajax/ajax-handler.php?function=showUsers";
    var btn = $(dom);
    $(btn).button('loading');
    $.ajax({
        type: 'POST',
        url: url,
        datatype: "json",
        success: function (data)
        {
            if (data != null)
            {
                $(btn).button('reset');
                var cookiesWrapper = $(document).find(".cookies-wrapper");
                var loginBox = $(document).find(".login-box-cls");
                $(cookiesWrapper).empty();
                $(cookiesWrapper).append('<p class="p-cls" style="font-size: 20px;">Choose An Account&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button title="Close" type="button" class="btn btn-danger btn-sm" onclick="closeCookieBox(this)"><i class="fa fa-times" aria-hidden="true"></i></button></p>');
                $.each(data, function (i) {
                    $(cookiesWrapper).append('<div class="cookies-holder animated"><button data-id="' + data[i].fk_user_id + '" title="Remove" type="button" class="close cookie-close-cls" onclick="removeUser(this)">×</button><div class="cookies-container" onclick="populateAccount(this)">&nbsp;&nbsp;&nbsp;' + data[i].user_name + '</div></div>');
                });
                $(loginBox).removeClass("fadeInRight");
                $(loginBox).addClass("fadeOutLeft");
                hideDom(loginBox);
                $(cookiesWrapper).removeClass("fadeOutLeft");
                $(cookiesWrapper).addClass("fadeInRight");
                showDom(cookiesWrapper);
            } else {
                $(btn).button('reset');
                alertModal("Info", "No accounts are available.!");
            }
        }
    });
}
function populateAccount(dom)
{
    var text = $(dom).text();
    var txtUserName = $(document).find(".u-name");
    $(txtUserName).val($.trim(text));
    $(".cookies-wrapper").removeClass("fadeInRight");
    $(".cookies-wrapper").addClass("fadeOutLeft");
    hideDom(".cookies-wrapper");
    $(".login-box-cls").removeClass("fadeOutLeft");
    $(".login-box-cls").addClass("fadeInRight");
    showDom(".login-box-cls");
    $(".pass-txt").focus();
    $(".remember-cls").iCheck('check');
}
function removeUser(dom)
{
    var message = "You are about to delete this Account.! Do you want to proceed?";
    bootbox.confirm({
        message: message,
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-danger'
            },
            cancel: {
                label: 'No',
                className: 'btn-success'
            }
        },
        callback: function (result) {
            if (result == true)
            {
                deleteUserName(dom, "data-id");
            }
        }
    });
}
function closeCookieBox(dom)
{
    var cookiesWrapper = $(document).find(".cookies-wrapper");
    var loginBox = $(document).find(".login-box-cls");
    $(cookiesWrapper).removeClass("fadeInRight");
    $(cookiesWrapper).addClass("fadeOutLeft");
    hideDom(cookiesWrapper);
    $(loginBox).removeClass("fadeOutLeft");
    $(loginBox).addClass("fadeInRight");
    showDom(loginBox);
    emptyTextFields(".u-name,.pass-txt");
    $(".remember-cls").iCheck('uncheck');
    $(".u-name").focus();
}
function deleteUserName(ele, attr)
{
    var id = $(ele).attr(attr);
    var url = "./ajax/ajax-handler.php?function=removeUser";
    $.ajax({
        type: 'POST',
        url: url,
        datatype: "json",
        data: {id: id},
        success: function (data)
        {
            if (data == 1)
            {
                var parentDiv = $(ele).closest("div");
                if ($(".cookies-holder").length == 1)
                {
                    $(parentDiv).addClass("fadeOutDown");
                    $(parentDiv).remove();
                    var cookiesWrapper = $(document).find(".cookies-wrapper");
                    var loginBox = $(document).find(".login-box-cls");
                    $(cookiesWrapper).removeClass("fadeInRight");
                    $(cookiesWrapper).addClass("fadeOutLeft");
                    hideDom(cookiesWrapper);
                    $(loginBox).removeClass("fadeOutLeft");
                    $(loginBox).addClass("fadeInRight");
                    showDom(loginBox);
                    $(".u-name").focus();
                } else {
                    $(parentDiv).addClass("fadeOutDown");
                    $(parentDiv).remove();
                }
            }
        }
    });
}
function showPreferedPage()
{
    var cookieHolder = $(document).find(".cookies-holder");
    var cookiesWrapper = $(document).find(".cookies-wrapper");
    var loginBox = $(document).find(".login-box-cls");
    if ($(cookieHolder).length > 0)
    {
        hideDom(loginBox);
        showFadeInAnimation(cookiesWrapper);
    } else
    {
        hideDom(cookiesWrapper);
        showFadeInAnimation(loginBox);
    }
}