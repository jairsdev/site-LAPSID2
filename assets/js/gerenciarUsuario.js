import { handleError } from "./erroHandler.js";
const entrar = document.getElementById('login-form');

entrar.addEventListener('submit', async function(event) {
    event.preventDefault();
    const email = document.getElementById('email').value;
    const senha = document.getElementById('senha').value; 

    var data = {email : email, senha: senha};

    try {
        const response = await fetch('https://localhost/site-LAPSID/lapsid/usuario?action=login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(data),
        });
    
        if (!response.ok) {
          throw new Error(`Erro: ${response.statusText}`);
        }
    
        const result = await response.json();
        
        if (result.success) {
          window.location.href = "/site-LAPSID/index.php";
        } else {
          handleError(result.message);
        }
      } catch (error) {
        handleError(error);
      }
})
