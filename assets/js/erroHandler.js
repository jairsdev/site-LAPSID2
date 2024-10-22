export function handleError(errorMessage) {
    
    if (typeof showErrorModal === "function") {
      showErrorModal(errorMessage);
    } else {
      console.error("showErrorModal não está disponível");
    }
  }
  
