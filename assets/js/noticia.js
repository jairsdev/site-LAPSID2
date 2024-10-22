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

    const bloco_principal = document.querySelector("#bloco_principal");
    bloco_principal.innerHTML = " ";
    result.forEach((noticia) => {
        const ul = document.getElementById("noticiasRef");
        const li = document.createElement("li");
        li.innerHTML = `<li><a href="#${noticia.titulo}" class="card-link">${noticia.titulo}</a></li>`;
        const div = document.createElement("div");

        div.innerHTML = `<h1 class="mb-5">${noticia.titulo}</h1>
                        <div class="mb-5" id="${noticia.titulo}">
                            ${noticia.conteudo}
                        </div>`;

        bloco_principal.appendChild(div);
        ul.appendChild(li);
    });
  } catch (error) {
    console.error("Erro ao enviar os dados:", error);
  }
}

index_all();
