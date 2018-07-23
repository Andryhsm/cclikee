/**
 * Created by Chirag on 5/9/2017.
 */
$('#account_form').validate({
    rules: {
        confirm_password: {
            required: {
                depends: function (e) {
                    return ($('#password').val()!='');
                }
            },
            equalTo: "#password"
        },
        first_name:{
            required:true
        },
        last_name:{
            required:true
        },
        password:{
            required:true
        },
        email_address:{
            required:true,
            email:true
        }
    },
    errorPlacement: function (error, element) {
        return error.insertAfter(element);
    } 
});

$('#add-account').click(function () {
    if ($('#account_form').valid()) {
        $('#account_form').submit();
    }
});

$('#login-btn').click(function () {
    if ($('#login_form').valid()) {
        $('#login_form').submit();
    }
});

$('#login_form').validate({
    rules: {
        email:{
            required:true,
            email: true
        },
        password:{
            required:true
        }
    },
    errorPlacement: function (error, element) {
        return error.insertAfter(element);
    }
});


$('#reset_password_form').validate({
    rules: {
        email:{
            required:true,
            email: true
        },
        password:{
            required:true
        },
        password_confirmation: {
            required: {
                depends: function (e) {
                    return ($('#password').val()!='');
                }
            },
            equalTo: "#password"
        }
    },
    errorPlacement: function (error, element) {
        return error.insertAfter(element);
    }
});

$('#forgot_password_form').validate({
    rules: {
        email:{
            required:true,
            email: true
        }
    },
    errorPlacement: function (error, element) {
        return error.insertAfter(element);
    }
});
