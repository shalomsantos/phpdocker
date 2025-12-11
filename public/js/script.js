$(document).ready(function () {

    $("#signOut").on("click", function (e) {
        e.preventDefault();

        $.ajax({
            method: "POST",
            url: "../index.php",
            dataType: 'json',
            data: { 
                controller: "login",
                action: "logout"
            },
            success: function (data) {
                try {
                    if (!data.success) {
                        alert("Erro: " + data.message);
                        return
                    }
                    window.location.href = data.redirect;
                } catch (e) {
                    alert("Erro inesperado no servidor: " + e);
                }
            },
            error: function () {
                alert("Erro na requisição AJAX.");
            }
        });
    });
    
});
