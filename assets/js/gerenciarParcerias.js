import { insert, update, delete_register } from "./crud.js";
import { toolbarOptions, quillOptions } from "./quillEditor.js";
const tabela = "parcerias";
var quillEditar, quillCriar;

function atualizarImagem(caminhoImagem) {
  const timestamp = new Date().getTime(); 
  var caminhoNovo = `${caminhoImagem}?t=${timestamp}`;
  return caminhoNovo; 
}

async function index_all() {
  try {
    const response = await fetch(
      `https://localhost/site-LAPSID/lapsid/parcerias?action=index_all`,
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

    const tableBody = document.querySelector("#parceria-table");
    tableBody.innerHTML = " ";

    result.forEach((parceria) => {
      const row = document.createElement("tr");
      var escapedDescricao = parceria.descricao
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");

      var doc = new DOMParser().parseFromString(parceria.descricao, "text/html");
      var textodescricao = doc.documentElement.innerText;
      var limite = 80;
      if (textodescricao.length > limite) {
        textodescricao = textodescricao.substring(0, limite) + " ...";
      }

      var novoCaminho = atualizarImagem(parceria.img_caminho);

      row.innerHTML = `
          <td><img src="${novoCaminho}" alt="" class="card-img-top mt-3 mb-3 ms-3"
            style="width: 10rem;"></td>
          </td>
          <td>${textodescricao}</td>
          <td>
            <button type="button" class="btn btn-primary btn-sm" 
            data-bs-toggle="modal" data-bs-target="#editarParceria" 
            data-bs-img="${parceria.img_caminho}" data-bs-descricao="${escapedDescricao}" data-bs-id="${parceria.id}">
            Editar
            </button>
            <button type="button" class="deletar btn btn-danger btn-sm" data-bs-img="${parceria.img_caminho}" data-bs-id="${parceria.id}">Deletar</button>
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
  const registrosTable = document.getElementById("parceria-table");

  registrosTable.addEventListener("click", function (event) {
    if (event.target.classList.contains("deletar")) {
      const idRegistro = event.target.getAttribute("data-bs-id");
      const img_caminho = event.target.getAttribute("data-bs-img");

      if (confirm("Tem certeza que deseja deletar este registro?")) {
        var data = {
          id: idRegistro,
          img_caminho: img_caminho
        }
        data = JSON.stringify(data);
        delete_register(data, tabela, index_all);
      }
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const modalEditarParceria = document.getElementById("editarParceria");

  modalEditarParceria.addEventListener("show.bs.modal", function (event) {
    if (!quillEditar) {
      quillEditar = new Quill("#editorEditar", quillOptions);
    }

    const button = event.relatedTarget;

    const descricao = button.getAttribute("data-bs-descricao");
    const img_caminho = button.getAttribute("data-bs-img");
    const id = button.getAttribute("data-bs-id");

    quillEditar.clipboard.dangerouslyPasteHTML(descricao);
    const salvar_atualizar = document.getElementById("salvar_atualizar");
    salvar_atualizar.replaceWith(salvar_atualizar.cloneNode(true));

    document
      .getElementById("salvar_atualizar")
      .addEventListener("click", function () {
        const modalImagem = modalEditarParceria.querySelector(".modal-body #logo").files[0];
        const updatedDescricao = quillEditar.root.innerHTML;

        const formData = new FormData();
        if (modalImagem != undefined) {
          formData.append("image", modalImagem);
        } 
        
        formData.append("id", id);
        formData.append("descricao", updatedDescricao);
        formData.append("img_caminho", img_caminho);
        update(formData, tabela, index_all);
      });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const modalCriarParceria = document.getElementById("adicionarParceria");

  if (modalCriarParceria) {
    modalCriarParceria.addEventListener("show.bs.modal", function () {
      if (!quillCriar) {
        quillCriar = new Quill("#editorAdicionar", quillOptions);
      }

      const salvar_criar = document.getElementById("salvar_criar");
      salvar_criar.replaceWith(salvar_criar.cloneNode(true));

      document.getElementById("salvar_criar").addEventListener("click", function () {
            const modalImagem = modalCriarParceria.querySelector(".modal-body #addLogo").files[0];

            const formData = new FormData();
            formData.append("descricao", quillCriar.root.innerHTML);
            formData.append("image", modalImagem);
            insert(formData, tabela, index_all);
        });
    });
  }
});
