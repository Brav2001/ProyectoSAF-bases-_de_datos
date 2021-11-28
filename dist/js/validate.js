function validateForm()
{
    
    var pass1=document.getElementById("password1").value;
    var pass2=document.getElementById("password2").value;
    if(pass1!=pass2)
    {
        swal("Error!", "Las contraseñas no coinciden", "error");
        return false;
    }
    else
    {
        return true;

    }
}