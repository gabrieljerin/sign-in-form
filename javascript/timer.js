var idleTime = 0;
$(document).ready(function () {
    setInterval(timerIncrement, 60000); // 1 minute
    $(this).mousemove(function (e) {
        idleTime = 0;
    });
    $(this).keypress(function (e) {
        idleTime = 0;
    });
    $(this).scroll(function (e) {
        idleTime = 0;
    });
    $(this).load(function (e) {
        idleTime = 0;
    });
});

function timerIncrement() 
{
    idleTime = idleTime + 1;
    if (idleTime > 19) { // 20 minutes
        window.location.href = "index.php?action=bG9nb3V0";
    }
}