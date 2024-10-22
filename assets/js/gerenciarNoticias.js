import { insert, update, delete_register } from "./crud.js";
import { toolbarOptions, quillOptions } from "./quillEditor.js";
const tabela = "noticias";
var quillEditar, quillCriar;
async function index_all() {
  try {
    const response = await fetch(
      `https://localhost/site-LAPSID/lapsid/noticias?action=index_all`,
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

    const tableBody = document.querySelector("#noticia-table");
    tableBody.innerHTML = " ";

    result.forEach((noticia) => {
      const row = document.createElement("tr");
      var escapedConteudo = noticia.conteudo
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
      
      var doc = new DOMParser().parseFromString(noticia.conteudo, "text/html");
      var textoConteudo = doc.documentElement.innerText;
      var limite = 80;
      if (textoConteudo.length > limite) {
        textoConteudo = textoConteudo.substring(0, limite) + " ...";
      }
      row.innerHTML = `
          <td>${noticia.titulo}</td>
          <td>${textoConteudo}</td>
          <td>
            <button type="button" class="btn btn-primary btn-sm" 
            data-bs-toggle="modal" data-bs-target="#editarNoticia" 
            data-bs-titulo="${noticia.titulo}" data-bs-conteudo="${escapedConteudo}" data-bs-id="${noticia.id}">
            Editar
            </button>
            <button type="button" class="deletar btn btn-danger btn-sm" data-bs-id="${noticia.id}">Deletar</button>
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
  const registrosTable = document.getElementById("noticia-table");

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
  const modalEditarNoticia = document.getElementById("editarNoticia");

  modalEditarNoticia.addEventListener("show.bs.modal", function (event) {
  
    if (!quillEditar) {
      quillEditar = new Quill('#editorEditar', quillOptions);
    }
  
    const button = event.relatedTarget;

    const titulo = button.getAttribute("data-bs-titulo");
    const conteudo = button.getAttribute("data-bs-conteudo");

    const id = button.getAttribute("data-bs-id");

    const modalTitle = modalEditarNoticia.querySelector(".modal-title");
    modalTitle.textContent = `Editar informações de ${titulo}`;

    const modalTitulo = modalEditarNoticia.querySelector(".modal-body #titulo");
    modalTitulo.value = titulo;

    quillEditar.clipboard.dangerouslyPasteHTML(conteudo);
    const salvar_atualizar = document.getElementById("salvar_atualizar");
    salvar_atualizar.replaceWith(salvar_atualizar.cloneNode(true));

    document
      .getElementById("salvar_atualizar")
      .addEventListener("click", function () {
        const updatedtitulo = modalTitulo.value;
        const updatedconteudo = quillEditar.root.innerHTML;
        var data = {
          id: id,
          titulo: updatedtitulo,
          conteudo: updatedconteudo,
        };

        data = JSON.stringify(data);
        update(data, tabela, index_all);
      });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const modalCriarNoticia = document.getElementById("adicionarNoticia");

  if (modalCriarNoticia) {
    modalCriarNoticia.addEventListener("show.bs.modal", function () {

      if (!quillCriar) {
        quillCriar = new Quill("#editorAdicionar", quillOptions);
      }

      const modalTitle = modalCriarNoticia.querySelector(".modal-title");
      modalTitle.textContent = `Criar noticia`;

      const modalTitulo = modalCriarNoticia.querySelector(".modal-body #addTitulo");

      const salvar_criar = document.getElementById("salvar_criar");
      salvar_criar.replaceWith(salvar_criar.cloneNode(true));

      document
        .getElementById("salvar_criar")
        .addEventListener("click", function () {
          var data = {
            titulo: modalTitulo.value,
            conteudo: quillCriar.root.innerHTML,
          };

          data = JSON.stringify(data);
          insert(data, tabela, index_all);
        });
    });
  }
});
