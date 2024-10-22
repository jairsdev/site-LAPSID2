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
  
      const bloco_principal = document.querySelector("#bloco_principal");
      bloco_principal.innerHTML = " ";
      let i = 1;
      result.forEach((integrante) => {
        const div = document.createElement("div");
        if (i == 1) {
            div.classList.add("col-sm");
        }else {
            div.classList.add("col");
        }
        if (integrante.lattes == "null") {
            div.innerHTML = `
            <div class="card ms-2 me-2">
                <div class="card-body">
                    <h5 class="card-title">${integrante.nome}</h5>
                    <p class="card-text">${integrante.titulo}</p>
                    <a href="${integrante.email}" class="card-link">Email</a>
                </div>
            </div>
          `;
        } else {
            div.innerHTML = `
            <div class="card ms-2 me-2">
                <div class="card-body">
                    <h5 class="card-title">${integrante.nome}</h5>
                    <p class="card-text">${integrante.titulo}</p>
                    <a href="${integrante.email}" class="card-link">Email</a>
                    <a href="${integrante.lattes}" class="card-link" id='latte'>Lattes</a>
                </div>
            </div>
          `;
        }
        
        bloco_principal.appendChild(div);
        i += 1;
      });
    } catch (error) {
      console.error("Erro ao enviar os dados:", error);
    }
  }

  index_all();