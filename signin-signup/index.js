const signinbtn = document.querySelector('.signinbtn')
const signupbtn = document.querySelector('.signupbtn')
const formbox = document.querySelector('.form-box')

signupbtn.onclick = function () {
    formbox.classList.add('active');
}
signinbtn.onclick = function () {
    formbox.classList.remove('active');  
}



const signIn = document.querySelector('.form input[value="Sign in"]');


signIn.onclick = () => {
    var formData = new FormData($('form.signin-form')[0]);
    $.ajax({
        type: 'POST',
        url: 'php/signin.php',
        processData: false,
        contentType: false,
        data: formData,
        success: function (data) {
            if (data === 'true') {
                window.location = "../account/account.php";
            } else {
                document.querySelector('.error-signin').innerHTML = data;
                return false;
            }
        }
    });
    return false;
}

const signUp = document.querySelector('.form input[value="Sign up"]');

signUp.onclick = () => {
    var formData = new FormData($('form.signup-form')[0]);

    if(!ValidateEmail(formData.get('email'))) {
        document.querySelector('.error-signup').innerHTML = 'Email không hợp lệ!';
        return false;
    }

    if(formData.get('password').length < 8) {
        document.querySelector('.error-signup').innerHTML = 'Mật khâu ít nhất 8 kí tự!';
        return false;
    }

    if(!(formData.get('password') == formData.get('confirm'))) {
        document.querySelector('.error-signup').innerHTML = 'Mật khâu không khớp!';
        return false;
    }


    $.ajax({
        type: 'POST',
        url: 'php/create-acc.php',
        processData: false,
        contentType: false,
        data: formData,
        success : function(data) {
            if(data === 'true') {
                formbox.classList.remove('active'); 
            } else {
                document.querySelector('.error-signup').innerHTML = data;
                return false;
            }
        }
    });
    return false;
}

function ValidateEmail(mail) {
    var rx = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (mail.match(rx)) {
        return (true)
    }
    return (false)
}

function clearError() {
    document.querySelector('.error-signin').innerHTML = '';
    document.querySelector('.error-signup').innerHTML = '';
};