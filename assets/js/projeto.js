async function index_all() {
    try {
      const response = await fetch(
        `https://localhost/site-LAPSID/lapsid/projeto?action=index_all`,
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
      var id = 1;
      result.forEach((projeto) => {
          const div = document.createElement("div");
  
          div.innerHTML = `<div class="card card-header mt-4">
                <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#${id}" aria-expanded="false" aria-controls="${id}">
                    ${projeto.titulo}
                </button>
            </div>

            <div class="collapse justify-content-center" id="${id}">
                <div class="card">
                    <div class="card-body">
                        ${projeto.conteudo}
                    </div>
                </div>
            </div>`;
  
          bloco_principal.appendChild(div);
          id += 1;
      });
    } catch (error) {
      console.error("Erro ao enviar os dados:", error);
    }
  }
  
  index_all();
  