import { insert, update, delete_register } from "./crud.js";
import { toolbarOptions, quillOptions } from "./quillEditor.js";
const tabela = "publicacao";
var quillEditar, quillCriar;

async function index_all() {
  try {
    const response = await fetch(
      `https://localhost/site-LAPSID/lapsid/publicacao?action=index_all`,
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

    const tableBody = document.querySelector("#publicacao-table");
    tableBody.innerHTML = " ";

    result.forEach((publicacao) => {
      const row = document.createElement("tr");
      var escapedConteudo = publicacao.conteudo
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");

      var doc = new DOMParser().parseFromString(
        publicacao.conteudo,
        "text/html"
      );
      var textoConteudo = doc.documentElement.innerText;
      var limite = 80;
      if (textoConteudo.length > limite) {
        textoConteudo = textoConteudo.substring(0, limite) + " ...";
      }
      row.innerHTML = `
          <td>${publicacao.titulo}</td>
          <td>${textoConteudo}</td>
          <td><a href="${publicacao.link}">${publicacao.link}</a></td>
          <td class="col-sm-3">
              <button type="button" class="btn btn-primary btn-sm"
                  data-bs-toggle="modal" data-bs-target="#editarPublicacao"
                  data-bs-titulo="${publicacao.titulo}" data-bs-link="${publicacao.link}" data-bs-conteudo="${escapedConteudo}" data-bs-id="${publicacao.id}">
                  Editar
                </button>
                <button type="button" class="apagar btn btn-danger btn-sm" data-bs-id="${publicacao.id}">Apagar</button>
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
  const registrosTable = document.getElementById("publicacao-table");

  registrosTable.addEventListener("click", function (event) {
    if (event.target.classList.contains("apagar")) {
      const idRegistro = event.target.getAttribute("data-bs-id");

      if (confirm("Tem certeza que deseja apagar este registro?")) {
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
  const modalEditarPublicacao = document.getElementById("editarPublicacao");

  modalEditarPublicacao.addEventListener("show.bs.modal", function (event) {
    if (!quillEditar) {
      quillEditar = new Quill("#editorEditar", quillOptions);
    }

    const button = event.relatedTarget;

    const titulo = button.getAttribute("data-bs-titulo");
    const conteudo = button.getAttribute("data-bs-conteudo");
    const link = button.getAttribute("data-bs-link");

    const id = button.getAttribute("data-bs-id");

    const modalTitle = modalEditarPublicacao.querySelector(".modal-title");
    modalTitle.textContent = `Editar informações de ${titulo}`;

    const modalTitulo = modalEditarPublicacao.querySelector(
      ".modal-body #titulo"
    );
    modalTitulo.value = titulo;
    const modalLink = modalEditarPublicacao.querySelector(".modal-body #link");
    modalLink.value = link;

    quillEditar.clipboard.dangerouslyPasteHTML(conteudo);
    const salvar_atualizar = document.getElementById("salvar_atualizar");
    salvar_atualizar.replaceWith(salvar_atualizar.cloneNode(true));

    document
      .getElementById("salvar_atualizar")
      .addEventListener("click", function () {
        const updatedtitulo = modalTitulo.value;
        const updatedlink = modalLink.value;
        const updatedconteudo = quillEditar.root.innerHTML;
        var data = {
          id: id,
          titulo: updatedtitulo,
          link: updatedlink,
          conteudo: updatedconteudo,
        };

        data = JSON.stringify(data);
        update(data, tabela, index_all);
      });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const modalCriarPublicacao = document.getElementById("adicionarPublicacao");

  if (modalCriarPublicacao) {
    modalCriarPublicacao.addEventListener("show.bs.modal", function () {
      if (!quillCriar) {
        quillCriar = new Quill("#editorAdicionar", quillOptions);
      }

      const modalTitle = modalCriarPublicacao.querySelector(".modal-title");
      modalTitle.textContent = `Criar publicacao`;

      const modalTitulo = modalCriarPublicacao.querySelector(
        ".modal-body #addTitulo"
      );
      const modalLink = modalCriarPublicacao.querySelector(".modal-body #addLink");

      const salvar_criar = document.getElementById("salvar_criar");
      salvar_criar.replaceWith(salvar_criar.cloneNode(true));

      document
        .getElementById("salvar_criar")
        .addEventListener("click", function () {
          var data = {
            titulo: modalTitulo.value,
            link: modalLink.value,
            conteudo: quillCriar.root.innerHTML,
          };

          data = JSON.stringify(data);
          insert(data, tabela, index_all);
        });
    });
  }
});
