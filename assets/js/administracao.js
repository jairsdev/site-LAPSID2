import { update_user, update_password, delete_register } from "./crud.js";
const tabela = "usuario";

async function index_all() {
  try {
    const response = await fetch(
      `https://localhost/site-LAPSID/lapsid/usuario?action=index_all`,
      {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      }
    );

    if (!response.ok) {
      throw new Error(`Erro: ${response.statusText}`);
    }

    const result = await response.json();

    if (!result) {
      console.log("Falha na operação:", result.message);
      return;
    }

    const tableBody = document.querySelector("#usuario-table");
    tableBody.innerHTML = " ";

    result.forEach((usuario) => {
      const row = document.createElement("tr");
      row.innerHTML = `
          <td>${usuario.nome}</td>
          <td>${usuario.email}</td>
           <td>
                            <button type="button" class="btn btn-primary btn-sm me-2" 
                            data-bs-toggle="modal" data-bs-target="#editarUsuario" 
                            data-bs-nome="${usuario.nome}" data-bs-email="${usuario.email}" data-bs-id="${usuario.id}">
                            Editar
                            </button>
                            <button type="button" class="btn btn-primary btn-sm me-2" 
                            data-bs-toggle="modal" data-bs-target="#atualizarSenha" 
                            data-bs-id="${usuario.id}" data-bs-nome="${usuario.nome}">
                            Atualizar senha
                            </button>
                            <button type="button" class="deletar btn btn-danger btn-sm" data-bs-id="${usuario.id}">Deletar</button>
                    </td>
        `;
      tableBody.appendChild(row);
    });
  } catch (error) {
    console.error("Erro ao enviar os dados:", error);
  }
}

index_all();
document.addEventListener("DOMContentLoaded", function () {
  const registrosTable = document.getElementById("usuario-table");

  registrosTable.addEventListener("click", function (event) {
    if (event.target.classList.contains("deletar")) {
      const idRegistro = event.target.getAttribute("data-bs-id");

      if (confirm("Tem certeza que deseja deletar este registro?")) {
        var data = {
          id: idRegistro,
        };

        data = JSON.stringify(data);
        delete_register(data, tabela, index_all);
      }
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const modalEditarUsuario = document.getElementById("editarUsuario");

  modalEditarUsuario.addEventListener("show.bs.modal", function (event) {
    const button = event.relatedTarget;

    const nomeUsuario = button.getAttribute("data-bs-nome");
    const emailUsuario = button.getAttribute("data-bs-email");
    const idUsuario = button.getAttribute("data-bs-id");

    const modalTitle = modalEditarUsuario.querySelector(".modal-title");
    modalTitle.textContent = `Editar informações de ${nomeUsuario}`;

    const modalNome = modalEditarUsuario.querySelector(".modal-body #nome");
    const modalEmail = modalEditarUsuario.querySelector(".modal-body #email");
    modalNome.value = nomeUsuario;
    modalEmail.value = emailUsuario;

    const salvar_atualizar = document.getElementById("salvar_atualizar");
    salvar_atualizar.replaceWith(salvar_atualizar.cloneNode(true));

    document
      .getElementById("salvar_atualizar")
      .addEventListener("click", function () {
        const updatedNome = modalNome.value;
        const updatedEmail = modalEmail.value;
        var data = {
          id: idUsuario,
          nome: updatedNome,
          email: updatedEmail,
        };

        data = JSON.stringify(data);
        update_user(data, tabela, index_all);
      });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const modalCriarUsuario = document.getElementById("adicionarUsuario");

  if (modalCriarUsuario) {
    modalCriarUsuario.addEventListener("show.bs.modal", function () {
      const modalTitle = modalCriarUsuario.querySelector(".modal-title");
      modalTitle.textContent = `Criar usuario`;

      const modalNome = modalCriarUsuario.querySelector(".modal-body #addNome");
      const modalEmail = modalCriarUsuario.querySelector(
        ".modal-body #addEmail"
      );
      const modalSenha = modalCriarUsuario.querySelector(
        ".modal-body #addSenha"
      );
      const modalSenhaNovamente = modalCriarUsuario.querySelector(
        ".modal-body #addSenhaNovamente"
      );

      const salvar_criar = document.getElementById("salvar_criar");
      salvar_criar.replaceWith(salvar_criar.cloneNode(true));

      document
        .getElementById("salvar_criar")
        .addEventListener("click", function () {
          var data = {
            nome: modalNome.value,
            email: modalEmail.value,
            senha: modalSenha.value,
            senha_confirmacao: modalSenhaNovamente.value,
          };

          data = JSON.stringify(data);
          create_login(data, tabela, index_all);
        });
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const modalSenhaUsuario = document.getElementById("atualizarSenha");

  modalSenhaUsuario.addEventListener("show.bs.modal", function (event) {
    const button = event.relatedTarget;

    const idUsuario = button.getAttribute("data-bs-id");
    const nomeUsuario = button.getAttribute("data-bs-nome");

    const modalTitle = modalSenhaUsuario.querySelector(".modal-title");
    modalTitle.textContent = `Atualizar senha de de ${nomeUsuario}`;

    const modalSenha = modalSenhaUsuario.querySelector(".modal-body #senha");
    const modalSenhaNovamente = modalSenhaUsuario.querySelector(
      ".modal-body #senhaNovamente"
    );

    const salvar_senha = document.getElementById("salvar_senha");
    salvar_senha.replaceWith(salvar_senha.cloneNode(true));

    document
      .getElementById("salvar_senha")
      .addEventListener("click", function () {
        const updatedSenha = modalSenha.value;
        const updatedSenhaNovamente = modalSenhaNovamente.value;
        var data = {
          id: idUsuario,
          senha: updatedSenha,
          senha_confirmacao: updatedSenhaNovamente,
        };

        data = JSON.stringify(data);
        update_password(data, tabela, index_all);
      });
  });
});
