$(document).ready(function () {

  $("#formLogin").on("submit", function (e) {
    e.preventDefault();

    let email = $("#email").val().trim();
    let password = $("#password").val().trim();

    if (email === "" || password === "") {
        Toastify({
            text: "Preencha todos os campos!",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
                background: "#9ADA31",
            },
        }).showToast();
      return;
    }

    $.ajax({
        method: "POST",
        url: "/login",
        data: { 
            email: email, 
            password: password 
        },
        beforeSend: function () {
            $("#entrar").prop("disabled", true);
        },
        success: function (data) {
            try {
                if (!data.success) {
                    Toastify({
                        text: data.message,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        stopOnFocus: true,
                        style: {
                            background: "#DC3545",
                        },
                    }).showToast();

                    return;
                }
                window.location.href = data.redirect;
            } catch (e) {
                Toastify({
                    text: "[1] Houve um erro inesperado, contate a T.I.",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: "#DC3545",
                    },
                }).showToast();
                $("#email").val('');
                $("#password").val('');
            }
        },
        error: function (err) {
            if(!err.responseJSON?.message){
                Toastify({
                    text: "[2] Houve um erro inesperado, contate a T.I.",
                    duration: 6000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: "#DC3545",
                    },
                }).showToast();
                $("#email").val('');
                $("#password").val('');
            }else{
                Toastify({
                    text: err.responseJSON.message,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: "#DC3545",
                    },
                }).showToast();
                $("#password").val('');
            }
        }
    });
  });
});