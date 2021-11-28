function log_out()
{
    $.post("access_CO/log_out",function()
    {
        location.href ("../index.php");
    })
}