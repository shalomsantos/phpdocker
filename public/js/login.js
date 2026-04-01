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
    let uri = "/login";
    let data = {
        email: email,
        password: password
    };

    $.ajax({
        method: "POST",
        url: uri,
        dataType: "json",
        data: data,
        beforeSend: function () {
            $("#entrar").prop("disabled", true);
        },
        success: function (data) {
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                alert(data.message);
                $("#entrar").prop("disabled", false);
            }
        },
        error: function (err) {
            console.log(err);
        }
    });
});