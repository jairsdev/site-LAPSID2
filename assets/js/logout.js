async function logout() {
    try {
        const response = await fetch('https://localhost/site-LAPSID/lapsid/usuario?action=logout', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          credentials: 'include' 
        });
    
        if (!response.ok) {
          throw new Error(`Erro: ${response.statusText}`);
        }
    
        const result = await response.json();
        
        if (result) {
          console.log('Operação bem-sucedida:', result.message);
          window.location.href = "/site-LAPSID/index.php";
        } else {
          console.log('Falha na operação:', result.message);
        }
      } catch (error) {
        console.error('Erro ao enviar os dados:', error);
      }
}

