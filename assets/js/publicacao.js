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
  
      const bloco_principal = document.querySelector("#bloco_principal");
      result.forEach((publicacao) => {
        html = `<a href="${publicacao.link}" class="list-group-item list-group-item-action">${publicacao.titulo}</a>`;
        bloco_principal.innerHTML = bloco_principal.innerHTML + html;
      });
    } catch (error) {
      console.error("Erro ao enviar os dados:", error);
    }
  }
  
  index_all();