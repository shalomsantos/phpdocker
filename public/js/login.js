$("#eyeToggle").on("click", function () {
    let input = $("#password");
    let type = input.attr("type") === "password" ? "text" : "password";
    
    input.attr("type", type);
    
    $(this).find("i").toggleClass("fa-eye fa-eye-slash");
});

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
        dataType: "json",
        data: {
            email: email,
            password: password
        }, beforeSend: () => {
            $("#entrar").prop("disabled", true);
        }, success: function (data) {
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                console.log(data.message);
                Toastify({
                    text: data.message,
                    duration: 3000,
                    close: true,
                    className: "info",
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: "#9ADA31",
                    },
                }).showToast();
            }
        }, error: function (err) {
            Toastify({
                text: err.responseJSON.message,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                style: { background: "#DC3545" },
            }).showToast();
        }, complete: () => {
            $("#entrar").prop("disabled", false);
            $("#password").val("");
            $("#password").focus();
        },
    });
});