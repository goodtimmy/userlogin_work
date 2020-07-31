$('#registerBtn').on("click", function () {

    disableClass("loginBtns");

    enableClass("userdata");
    enableClass("registerBtns");

});

$('#cancelBtn').on("click", function () {

    disableClass("userdata");
    disableClass("registerBtns");

    enableClass("loginBtns");

});

$('#exitBtn').on("click", function () {

    disableClass("userdata");
    disableClass("registerBtns");
    disableClass("saveBtn");

    enableClass("loginBtns");

});

$('#loginBtn').on("click", function () {

    var login = document.getElementById("login").value;
    var password = document.getElementById("password").value;

    if (login == "" || password == "") {

        alert("enter both login and password");

    } else {

        $.ajax({

            type: 'POST',
            url: 'ajax/login.php',
            data: {login: login, password: password},
            success: function (msg) {

                if (msg) {

                    var res = JSON.parse(msg);

                    disableClass("registerBtns");
                    disableClass("loginBtns");

                    enableClass("userdata");
                    enableClass("saveBtn");

                    var input = document.getElementById('user_email');
                    input.value = input.value = res["email"];

                    var input = document.getElementById('last_name');
                    input.value = input.value = res["last_name"];

                    var input = document.getElementById('first_name');
                    input.value = input.value = res["first_name"];

                    var input = document.getElementById('second_name');
                    input.value = input.value = res["second_name"];

                } else {
                    alert("incorrect username or password");
                }


                // var res = JSON.parse(msg);

            }
        });
    }
});

$('#saveButton').on("click", function () {

    var login = document.getElementById("login").value;
    var password = document.getElementById("password").value;
    var password2 = document.getElementById("password2").value;
    var first_name = document.getElementById("first_name").value;
    var second_name = document.getElementById("second_name").value;
    var last_name = document.getElementById("last_name").value;


    if (login.trim() == "" || password.trim() == "" || first_name.trim() == "" || second_name.trim() == "" || last_name.trim() == "") {

        alert("fill in all the fields");

    } else if (password != password2) {

        alert("passwords do not match");

    } else {

        $.ajax({

            type: 'POST',
            url: 'ajax/save.php',
            data: {
                login: login,
                password: password,
                first_name: first_name,
                second_name: second_name,
                last_name: last_name
            },
            success: function (msg) {

                alert("your data was updated");


                // var res = JSON.parse(msg);

            }
        });
    }
});

$('#registerBtn2').on("click", function () {

    var login = document.getElementById("login").value;
    var password = document.getElementById("password").value;
    var password2 = document.getElementById("password2").value;
    var email = document.getElementById("user_email").value;
    var first_name = document.getElementById("first_name").value;
    var second_name = document.getElementById("second_name").value;
    var last_name = document.getElementById("last_name").value;


    if (login.trim() == "" || password.trim() == "" || first_name.trim() == "" || second_name.trim() == "" || last_name.trim() == "" || email.trim() == "") {

        alert("fill in all the fields");

    } else if (password != password2) {

        alert("passwords do not match");

    } else {

        $.ajax({

            type: 'POST',
            url: 'ajax/registration.php',
            data: {
                login: login,
                password: password,
                email: email,
                first_name: first_name,
                second_name: second_name,
                last_name: last_name
            },
            success: function (msg) {

                if (msg == "0") {

                    alert("this user already exists");

                }
                else {
                    alert("your data was stored. Pretend you have recieved and clicked the confirmation link :) So, you are logged in. ");

                    disableClass("registerBtns");
                    disableClass("loginBtns");

                    enableClass("userdata");
                    enableClass("saveBtn");
                }


            }
        });
    }
});

function disableClass(className) {

    var classToDisable = document.getElementsByClassName(className);

    for (i = 0; i < classToDisable.length; i++) {

        classToDisable[i].style.display = "none";

    }

}

function enableClass(className) {

    var classToEnable = document.getElementsByClassName(className);

    for (i = 0; i < classToEnable.length; i++) {

        classToEnable[i].style.display = "block";

    }

}


