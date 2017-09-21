$(document).ready(function () {
    $(this).scrollTop(0);
});
function removeIcon(dom)
{
    if ($(dom).is(".glyphicon-minus"))
    {
        $(dom).removeClass("glyphicon-minus");
        $(dom).addClass("glyphicon-plus");
        $(dom).attr("title", "Expand");
    } else
    {
        $(dom).removeClass("glyphicon-plus");
        $(dom).addClass("glyphicon-minus");
        $(dom).attr("title", "Collapse");
    }
}
//-------------------------Alert----------------------------//
function alertModalTextCss()
{
    $("#alertTitle").css("color", "white");
    $(".body-txt").css("color", "white");
}
function alertModal(title, body)
{
    if (title == "Error" || title == "error")
    {
        alertModalTextCss();
        $("#modalBgColor").css("background-color", "#D43F3A");
    }
    if (title == "Info" || title == "info" || title == "Information" || title == "information")
    {
        alertModalTextCss();
        $("#modalBgColor").css("background-color", "#46B8DA");
    }
    if (title == "Warning" || title == "warning")
    {
        alertModalTextCss();
        $("#modalBgColor").css("background-color", "#EEA236");
    }
    if (title == "Success" || title == "success")
    {
        alertModalTextCss();
        $("#modalBgColor").css("background-color", "#4CAE4C");
    }
    $("#alertTitle").html(title);
    $(".body-txt").html(body);
    $("#myModal").modal('show');
}
//--------------------------END--------------------------//
function checkBoxRadioStyle()
{
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_flat',
        increaseArea: '20%' // optional
    });
}
function isEmail(email)
{
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
function popLargeDialog(title, body)
{
    $("#dialog-title").html(title);
    $(".dialog-body").html(body);
    $(".dialog-modal").modal('show');
}
function closeLargeDialog()
{
    $(".dialog-modal").modal('hide');
}
function popSmallDialog(title, body)
{
    $("#dialog-sm-title").html(title);
    $(".dialog-sm-body").html(body);
    $(".dialog-modal-sm").modal('show');
}
function closeSmallDialog()
{
    $(".dialog-modal-sm").modal('hide');
}
function clearAllTextField()
{
    $('input[type=text]').val("");
}
function emptyTextFields(dom)
{
    $(dom).val("");
}
function setDropDownVal_zero(dom)
{
    $(dom).val(0);
}
function closePopOverOnFocus(dom)
{
    $(dom).ProvideErrorRemove();
}
function openPopUpDialog(id)
{
    $(id).dialog('open');
}
function closePopUpDialog(id)
{
    $(id).dialog('close');
}
function hideDom(dom)
{
    $(dom).hide();
}
function showDom(dom)
{
    $(dom).show();
}
function getCustomAttr(tblRow, attribute)
{
    var dataAttr = $(tblRow).find("[" + attribute + "]");
    return $(dataAttr).attr(attribute);
}
function showFadeInAnimation(dom)
{
    $(dom).fadeIn(5000);
}
function showSlideToggleAnimation(dom)
{
    $(dom).slideUp(2000).slideDown(2000);
}
function getQueryString(name, url)
{
    if (!url) {
        url = window.location.href;
    }
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
    if (!results)
        return null;
    if (!results[2])
        return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function changeHtmlText(dom, htmlStr)
{
    $(dom).html(htmlStr);
}
function focusField(dom)
{
    $(dom).focus();
}
function ReLoad()
{
    location.reload();
}
function getLastTrFirstTd_value(table)
{
    var lastTr = $(table).find("tr").last();
    var firstTd = $(lastTr).find("td:first");
    return $(firstTd).html();
}
//-----------------------Jquery Extension-----------------------//

jQuery.fn.AcceptNumericOnly = function ()
{
    $(this).keypress(function (e)
    {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
};
jQuery.fn.AllowOnlyNumbers=function()
{
    $(this).on({
        keydown:function(e){
        // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
      // Allow: Ctrl+A,Ctrl+C,Ctrl+V,Ctrl+X, Command+A
      ((e.keyCode == 65 || e.keyCode == 86 || e.keyCode == 67 ||e.keyCode == 88|| e.keyCode==13) && (e.ctrlKey === true || e.metaKey === true)) ||
      // Allow: home, end, left, right, down, up
      (e.keyCode >= 35 && e.keyCode <= 40)) {
      // let it happen, don't do anything
      return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
      e.preventDefault();
    }
    },
    input:function (){
        var o,v=(o=$(this)).val();
        o.val(v.replace(/[^\d]/g,""));
    }
    });
}
jQuery.fn.ReadOnly = function ()
{
    $(this).attr("readonly", true);
};
jQuery.fn.RemoveReadOnly = function ()
{
    $(this).attr("readonly", false);
};
jQuery.fn.Disable = function ()
{
    $(this).attr("disabled", true);
};
jQuery.fn.Enable = function ()
{
    $(this).attr("disabled", false);
};
jQuery.fn.PreventCutCopyPaste = function ()
{
    $(this).bind("cut copy paste", function (e) {
        e.preventDefault();
    });
};
//------------------------END-------------------------//