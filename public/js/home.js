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
$(document).ready(function () {
    //BUTTONS
    const btnSubmit = $("#submit");
    const btnLimpar = $("#limpar");
    const btnReload = $("#reload");
    //INPUTS
    const inputName            = $("#name");
    const inputEmail           = $("#email");
    const inputTel             = $("#tel");
    const inputPassword        = $("#password");
    const inputConfirmPassword = $("#confirmPassword");
    //LISTAGEM
    const tbody                  = $("#user-list");
    //MODALS
    const modalAddUserSpinner  = $("#modalAddUserSpinner");
    const modalAddUser         = $("#modalAddUser");

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
    btnReload.on('click', () =>{
        fetchUsers();
    });
    function fetchUsers() {
        $.ajax({
            method: "GET",
            url: "/users",
            dataType: "json",
            success: function (data) {
                tbody.empty();
                mountUsersTable(data.data);
            }, error: function (err) {
                console.log(err)
            }
        });
    }
    function mountUsersTable(users) {
        const positions = window.positions;

        if (users.length > 0) {
            users.forEach(function (user) {
                const position = positions.find(function (position) {
                    return Number(position.id) === Number(user.position_id);
                });
                const col = `
                    <tr>
                        <td>${user.nome}</td>
                        <td>${user.email}</td>
                        <td>${user.telefone}</td>
                        <td>${position ? position.description : 'Cargo não encontrado'}</td>
                        <td>${user.senha}</td>
                    </tr>  
                `;
                tbody.append(col);
            });
        } else {
            tbody.append(`
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