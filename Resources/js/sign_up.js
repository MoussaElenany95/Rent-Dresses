$(function () {
    var form = $("#register-form");
    vlidateInputs(form);

    $("#register-form").submit( function (event) {

        var name            = $(this).find("#register_name");
        var email           = $(this).find("#register_email");
        var password        = $(this).find("#register_password");
        var confirmPassword = $(this).find("#confirm-password");

        validateNameField(name,event);
        validateEmailField(email,event);
        validatePasswordField(password,event);
        validateConfirmField(password,confirmPassword,event);

    });



    
});
function vlidateInputs(form) {
    var name = form.find("#register_name");
    var email = form.find("#register_email");
    var password= form.find("#register_password");
    var confirmPassword = form.find("#confirm-password");

    name.blur(function (event) {
        validateNameField(name,event);
    });
    email.blur(function (event) {
        validateEmailField(email,event);
    });
    password.blur(function (event) {
        validatePasswordField(password,event);
    });
    confirmPassword.blur(function (event) {
        validateConfirmField(password,confirmPassword,event);
    });
}
//validate name field
function validateNameField(name,event) {
    
    if (!isValidName(name.val())){
        name.css( "box-shadow","0 0 4px #811");
        $("#name_feedback").text("Please enter a valid name ");
        event.preventDefault();
    }else{
        name.css( "box-shadow","0 0 4px #181");
        $("#name_feedback").empty();
    }
    
}
//validate email field
function validatePasswordField(password,event) {

    if (!isValidPassword(password.val())){
        password.css( "box-shadow","0 0 4px #811");
        $("#password_feedback").text("Min Password 6 characters");
        event.preventDefault();
    }else{
        password.css( "box-shadow","0 0 4px #181");
        $("#password_feedback").empty();
    }

}
//confirm validation
function validateConfirmField(password,confirm,event) {

    if (confirm.val() !== password.val() ){
        confirm.css( "box-shadow","0 0 4px #811");
        $("#confirm_feedback").text("password doesn't match");
        event.preventDefault()

    }else {
        confirm.css( "box-shadow","0 0 4px #181");
        $("#confirm_feedback").empty();
    }

}

//validate email field
function validateEmailField(email,event) {
    if (!isValidEmail(email.val())){
        email.css( "box-shadow","0 0 4px #811");
        $("#email_feedback").text("Please enter a valid email address");
        event.preventDefault();
    }else{
        $.ajax({
            url:"../Controllers/user_route.php",
            type:"POST",
            dataType:"JSON",
            data:{"search_email":email.val()},success:function (response) {
                if (response.success){
                    email.css( "box-shadow","0 0 4px #811");
                    $("#email_feedback").text("Email already exist, choose another");
                    event.preventDefault();
                }else {
                    email.css( "box-shadow","0 0 4px #181");
                    $("#email_feedback").empty();
                }
            },

        });
    }

}

//validate name
function isValidName(name) {

    return name.length > 2 && (/^[a-zA-Z]+(([ ][a-zA-Z ])?[a-zA-Z]*)*$/).test(name);
}

//validate email
function isValidEmail(email) {
    return /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email)
}


//validate password
function isValidPassword(password) {
    return password.length > 6 ;
}