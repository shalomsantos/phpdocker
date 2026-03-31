// metodos no contexto da página
function onVisible(key) {
    const container = $(`.span-senha-${key}`);

    const senhaTexto = container.find('.senha-show');
    const senhaIconeEscondido = container.find('.senha-hide');

    const btnIcone = $(`.btn-${key} i`);

    if (senhaTexto.hasClass('d-none')) {
        senhaTexto.removeClass('d-none');
        senhaIconeEscondido.addClass('d-none');
        btnIcone.removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
        senhaTexto.addClass('d-none');
        senhaIconeEscondido.removeClass('d-none');
        btnIcone.removeClass('fa-eye-slash').addClass('fa-eye');
    }
}
function deleteUser(id) {
    alert("Id a deletar: " + id);
    return;
    $.ajax({
        method: "DELETE",
        url: "../index.php",
        dataType: 'json',
        data: {
            controller: "user",
            action: 'destroy',
            id: id
        },
        beforeSend: function () {
            modalAddUserSpinner.removeClass("d-none");
            modalAddUser.addClass("d-none");
        },
        success: function (res) {
            try {
                if (!res.success) {
                    console.log(res.message);
                    return;
                }
                console.log(res.message);
                modalAddUserSpinner.addClass("d-none");
                modalAddUser.removeClass("d-none");
                btnLimpar.click();

                let modalEl = document.getElementById('modalAdicionar');
                let modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                modal.hide();

                fetchUsers();
            } catch (e) {
                console.log(res);
            }
        },
        error: function (err) {
            if (err.responseJSON.message) {
                console.log(err.responseJSON.message);
            } else {
                console.log(err);
            }
        }
    });
}
function editUser(id) {
    alert("Id a editar: " + id);
    return;
    $.ajax({
        method: "POST",
        url: "../index.php",
        dataType: 'json',
        data: {
            controller: "user",
            action: 'store',
            name: inputName.val(),
            email: inputEmail.val(),
            tel: inputTel.val(),
            password: inputPassword.val()
        },
        beforeSend: function () {
            modalAddUserSpinner.removeClass("d-none");
            modalAddUser.addClass("d-none");
        },
        success: function (res) {
            try {
                if (!res.success) {
                    console.log(res.message);
                    return;
                }
                console.log(res.message);
                modalAddUserSpinner.addClass("d-none");
                modalAddUser.removeClass("d-none");
                btnLimpar.click();

                let modalEl = document.getElementById('modalAdicionar');
                let modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                modal.hide();

                fetchUsers();
            } catch (e) {
                console.log(res);
            }
        },
        error: function (err) {
            if (err.responseJSON.message) {
                console.log(err.responseJSON.message);
            } else {
                console.log(err);
            }
        }
    });
}
// interações indiretas
$(document).ready(function () {
    //buttons
    const btnSubmit = $("#submit");
    const btnLimpar = $("#limpar");
    const btnSignOut = $("#signOut");
    const btnReload = $("#reload");
    //inputs
    const inputName = $("#name");
    const inputEmail = $("#email");
    const inputTel = $("#tel");
    const inputPassword = $("#password");
    const inputConfirmPassword = $("#confirmPassword");
    // listagem
    const row = $("#user-list");
    //modals
    const modalAddUserSpinner = $("#modalAddUserSpinner");
    const modalAddUser = $("#modalAddUser");

    btnLimpar.on("click", function () {
        inputName.val("");
        inputEmail.val("");
        inputTel.val("");
        inputPassword.val("");
        inputConfirmPassword.val("");
    });
    btnSubmit.on("click", function (e) {
        e.preventDefault();

        if (validateInputsConfirm()) {
            $.ajax({
                method: "POST",
                url: "/user",
                dataType: 'json',
                data: {
                    nome: inputName.val(),
                    email: inputEmail.val(),
                    telefone: inputTel.val(),
                    senha: inputPassword.val(),
                }, beforeSend: function () {
                    modalAddUserSpinner.removeClass("d-none");
                    modalAddUser.addClass("d-none");
                }, success: function (res) {
                    try {
                        if (!res.success) {
                            console.log(res.message);
                            return;
                        }
                        console.log(res.message);
                        modalAddUserSpinner.addClass("d-none");
                        modalAddUser.removeClass("d-none");
                        btnLimpar.click();

                        let modalEl = document.getElementById('modalAdicionar');
                        let modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                        modal.hide();

                        fetchUsers();
                    } catch (e) {
                        console.log(res);
                    }
                }, finally: function (e) {
                    console.log(e)
                }, error: function (err) {
                    if (err.responseJSON.message) {
                        console.log(err.responseJSON.message);
                    } else {
                        console.log(err);
                    }
                }
            });
        }
    });
    btnSignOut.on("click", function (e) {
        e.preventDefault();

        $.ajax({
            method: "GET",
            url: "/logout",
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
                        text: e,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        stopOnFocus: true,
                        style: {
                            background: "#DC3545",
                        },
                    }).showToast();
                }
            },
            error: function (err) {
                Toastify({
                    text: err,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: "#DC3545",
                    },
                }).showToast();
            }
        });
    });
    btnReload.on('click', () =>{
        fetchUsers();
    });
    function fetchUsers() {
        $.ajax({
            method: "GET",
            url: "/users/all",
            dataType: "json",
            success: function (data) {
                row.empty();
                shoCardsUsers(data.data);
            }, error: function (err) {
                console.log(err)
            }
        });
    }
    function shoCardsUsers(users) {
        if (users.length > 0) {
            users.forEach(function (user, index) {
                const col = `
                            <div class="col-4 m-0 p-0">
                                <div class="card m-2">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <p>${user.nome}</p>
                                        <button class="btn btn-light btn-sm btn-${index}" onclick="onVisible(${index})"><i class="fa-solid fa-eye"></i></button>
                                    </div>
                                    <div class="card-body d-flex flex-column gap-2">
                                        <div class="label-content">
                                            <p>E-mail:.</p>
                                            <p class="text-body-secondary">${user.email}</p>
                                        </div>
                                        <div class="label-content">
                                            <p>Telefone:.</p>
                                            <p class="text-body-secondary">${user.telefone}</p>
                                        </div>
                                        <div class="label-content">
                                            <p>Senha:.</p>
                                            <span class="span-senha-${index} d-flex align-items-center">
                                                <p class="text-body-secondary senha-show d-none mb-0">${user.senha}</p>
                                                <i class="fa-solid fa-ellipsis senha-hide"></i>
                                            </span>
                                        </div>
                                        <div class="label-content">
                                            <p>Cargo:.</p>
                                            <p class="text-body-secondary">${user.position_id}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                row.append(col);
            });
        } else {
            row.append(`
                        <div class="alert alert-danger" role="alert">
                            Nenhum registro encontrado
                        </div>
                    `);
        }
    }
    function validateInputsConfirm() {
        if (inputName.val().trim() === '') {
            alert("Pelo menos o nome deve ser preenchido!");
            inputName.focus();
            return false;
        }
        if (inputEmail.val().trim() === '') {
            alert("Pelo menos o email deve ser preenchido!");
            inputEmail.focus();
            return false;
        }

        if (inputTel.val().trim() === '') inputTel.val('');

        if (inputPassword.val().trim() === '') {
            alert("A senha deve ser preenchida!");
            inputPassword.focus();
            return false;
        }
        if (inputConfirmPassword.val().trim() === '') {
            alert("Condirme a senha digitada!");
            inputConfirmPassword.focus();
            return false;
        }

        if (inputPassword.val().trim() !== inputConfirmPassword.val().trim()) {
            alert("As senhas não coincidem!");
            return false;
        }
        return true;
    }
});