async function loadErrorModal() {
    try {
      
      const response = await fetch('/site-LAPSID/pages/modalErro.php');
      const modalHTML = await response.text();
  
      
      document.body.insertAdjacentHTML('beforeend', modalHTML);
      
      
      const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
  
     
      window.showErrorModal = function(message) {
        const errorMessageElement = document.getElementById("errorMessage");
        errorMessageElement.textContent = message;
        errorModal.show();
      };
  
    } catch (error) {
      console.error('Erro ao carregar o modal:', error);
    }
}

document.addEventListener('DOMContentLoaded', loadErrorModal);