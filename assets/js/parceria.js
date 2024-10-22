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
  
      const bloco_principal = document.querySelector("#bloco_principal");
      bloco_principal.innerHTML = " ";
      
      result.forEach((parceria) => {
        var novoCaminho = atualizarImagem(parceria.img_caminho);
  
        html = `<img src="${novoCaminho}" alt="" class="card-img-top mt-3 mb-3 ms-3"
                    style="width: 10rem;">
                    <h5 class="card-title ms-3">${parceria.descricao}</h5>`;
        
        bloco_principal.innerHTML = bloco_principal.innerHTML + "\n" + html;
          
      });
    } catch (error) {
      console.error("Erro ao enviar os dados:", error);
    }
  }
  
  index_all();