import { insert, update, delete_register } from "./crud.js";
const tabela = "equipe";

async function index_all() {
  try {
    const response = await fetch(
      `https://localhost/site-LAPSID/lapsid/equipe?action=index_all`,
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

    const tableBody = document.querySelector("#integrante-table");
    tableBody.innerHTML = " ";

    result.forEach((integrante) => {
      const row = document.createElement("tr");
      row.innerHTML = `
          <td>${integrante.nome}</td>
          <td>${integrante.email}</td>
          <td>
            <button type="button" class="btn btn-primary btn-sm" 
            data-bs-toggle="modal" data-bs-target="#editarUsuario" 
            data-bs-nome="${integrante.nome}" data-bs-email="${integrante.email}" data-bs-id="${integrante.id}" data-bs-titulo="${integrante.titulo}" data-bs-lattes="${integrante.lattes}">
            Editar
            </button>
            <button type="button" class="deletar btn btn-danger btn-sm" data-bs-id="${integrante.id}">Deletar</button>
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
  const registrosTable = document.getElementById("integrante-table");

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
      const tituloUsuario = button.getAttribute("data-bs-titulo");
      const lattesUsuario = button.getAttribute("data-bs-lattes");

      const modalTitle = modalEditarUsuario.querySelector(".modal-title");
      modalTitle.textContent = `Editar informações de ${nomeUsuario}`;

      const modalNome = modalEditarUsuario.querySelector(".modal-body #nome");
      const modalEmail = modalEditarUsuario.querySelector(".modal-body #email");
      const modalTitulo = modalEditarUsuario.querySelector(".modal-body #titulo");
      const modalLattes = modalEditarUsuario.querySelector(".modal-body #lattes");
      modalNome.value = nomeUsuario;
      modalEmail.value = emailUsuario;
      modalTitulo.value = tituloUsuario;
      modalLattes.value = lattesUsuario;

      const salvar_atualizar = document.getElementById("salvar_atualizar");
      salvar_atualizar.replaceWith(salvar_atualizar.cloneNode(true));
     
      document.getElementById("salvar_atualizar").addEventListener("click", function () {
          const updatedNome = modalNome.value;
          const updatedEmail = modalEmail.value;
          const updateTitulo = modalTitulo.value;
          const updateLattes = modalLattes.value;
          var data = {
            id: idUsuario,
            nome: updatedNome,
            email: updatedEmail,
            titulo : updateTitulo,
            lattes : updateLattes
          };

          data = JSON.stringify(data);
          update(data, tabela, index_all);
        });
      
    });
  }
);

document.addEventListener("DOMContentLoaded", function () {
  const modalCriarUsuario = document.getElementById("adicionarUsuario");

  if (modalCriarUsuario) {
    modalCriarUsuario.addEventListener("show.bs.modal", function () {
      const modalTitle = modalCriarUsuario.querySelector(".modal-title");
      modalTitle.textContent = `Criar integrante`;

      const modalNome = modalCriarUsuario.querySelector(".modal-body #addNome");
      const modalEmail = modalCriarUsuario.querySelector(".modal-body #addEmail");
      const modalTitulo = modalCriarUsuario.querySelector(".modal-body #addTitulo");
      const modalLattes = modalCriarUsuario.querySelector(".modal-body #addLattes");

      const salvar_criar = document.getElementById("salvar_criar");
      salvar_criar.replaceWith(salvar_criar.cloneNode(true));
    
      document.getElementById("salvar_criar").addEventListener("click", function () {
          var data = {
            nome: modalNome.value,
            email: modalEmail.value,
            titulo : modalTitulo.value,
            lattes : modalLattes.value
          };

          data = JSON.stringify(data);
          insert(data, tabela, index_all);
        });
    });
  }
});
