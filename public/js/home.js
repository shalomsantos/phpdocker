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
    //buttons
    const btnSubmit            = $("#submit");
    const btnLimpar            = $("#limpar");
    //inputs
    const inputName            = $("#name");
    const inputEmail           = $("#email");
    const inputTel             = $("#tel");
    const inputPassword        = $("#password");
    const inputConfirmPassword = $("#confirmPassword");
    //modals
    const modalAddUserSpinner  = $("#modalAddUserSpinner");
    const modalAddUser         = $("#modalAddUser");

    // função listagem inicial dos usuarios
    fetchUsers();

    btnLimpar.on("click", function () {
        inputName.val("");
        inputEmail.val("");
        inputTel.val("");
        inputPassword.val("");
        inputConfirmPassword.val("");
    });
    btnSubmit.on("click", function (e) {
        e.preventDefault();

        if(validateInputsConfirm()){
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
    });
    function fetchUsers() {
        $.ajax({
            method: "POST",
            url: "../index.php",
            dataType: "json",
            data: {
                controller: "user",
                action: "index",
            }, success: function (data) {
                const tableBody = $("#usersTable tbody");
                tableBody.empty(); // limpa o corpo da tabela

                if (data.data.length > 0) {
                    data.data.forEach(function (user) {
                        const row = `
            <tr>
                <td>${user.id}</td>
                <td>${user.nome}</td>
                <td>${user.email}</td>
                <td>${user.telefone?user.telefone:'***'}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        <button class="btn btn-outline-danger" onclick='deleteUser(${user.id})'">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        <button class="btn btn-outline-secondary" onclick='editUser(${user.id})'">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </div>
                </td>
            </tr>`;
                        tableBody.append(row);
                    });
                } else {
                    tableBody.append(`
            <tr>
            <td colspan="5" class="text-center text-muted">
                Nenhum registro encontrado
            </td>
            </tr>
        `);
                }
            }, error: function (err) {
                console.log(err)
                alert("Erro ao buscar usuários.");
            }
        });
    }
    function validateInputsConfirm() {
        if(inputName.val().trim() === ''){
            alert("Pelo menos o nome deve ser preenchido!");
            inputName.focus();
            return false;
        }
        if(inputEmail.val().trim() === '' ){
            alert("Pelo menos o email deve ser preenchido!");
            inputEmail.focus();
            return false;
        }

        if(inputTel.val().trim() === '') inputTel.val('');

        if(inputPassword.val().trim() === ''){
            alert("A senha deve ser preenchida!");
            inputPassword.focus();
            return false;
        }
        if(inputConfirmPassword.val().trim() === ''){
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