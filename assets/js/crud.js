import { handleError } from "./erroHandler.js";
export async function insert(data, tabela, index_all) {
  try {
    const response = await fetch(
      `https://localhost/site-LAPSID/lapsid/${tabela}?action=insert`,
      {
        method: "POST",
        body: data
      }
    );

    if (!response.ok) {
      throw new Error(`Erro: ${response.statusText}`);
    }

    const result = await response.json();

    index_all();
    handleError(result.message);
  } catch (error) {
    handleError(error);
  }
}

export async function update(data, tabela, index_all) {
  try {
    const response = await fetch(
      `https://localhost/site-LAPSID/lapsid/${tabela}?action=update`,
      {
        method: "POST",
        body: data
      }
    );

    if (!response.ok) {
      throw new Error(`Erro: ${response.statusText}`);
    }

    const result = await response.json();
    
    index_all();
    handleError(result.message);
  } catch (error) {
    handleError(error);
  }
}

export async function delete_register(data, tabela, index_all) {
  try {
    const response = await fetch(
      `https://localhost/site-LAPSID/lapsid/${tabela}?action=delete`,
      {
        method: "POST",
        body: data
      }
    );

    if (!response.ok) {
      throw new Error(`Erro: ${response.statusText}`);
    }

    const result = await response.json();
    index_all();
    handleError(result.message);
  } catch (error) {
    handleError(error);
  }
}

export async function update_user(data, tabela, index_all) {
  try {
    const response = await fetch(
      `https://localhost/site-LAPSID/lapsid/${tabela}?action=update_user`,
      {
        method: "POST",
        body: data
      }
    );

    if (!response.ok) {
      throw new Error(`Erro: ${response.statusText}`);
    }

    const result = await response.json();
    
    index_all();
    handleError(result.message);
  } catch (error) {
    handleError(error);
  }
}

export async function update_password(data, tabela, index_all) {
  try {
    const response = await fetch(
      `https://localhost/site-LAPSID/lapsid/${tabela}?action=update_password`,
      {
        method: "POST",
        body: data
      }
    );

    if (!response.ok) {
      throw new Error(`Erro: ${response.statusText}`);
    }

    const result = await response.json();
    
    index_all();
    handleError(result.message);
  } catch (error) {
    handleError(error);
  }
}

export async function create_login(data, tabela, index_all) {
  try {
    const response = await fetch(
      `https://localhost/site-LAPSID/lapsid/${tabela}?action=create_login`,
      {
        method: "POST",
        body: data
      }
    );

    if (!response.ok) {
      throw new Error(`Erro: ${response.statusText}`);
    }

    const result = await response.json();
    
    index_all();
    handleError(result.message);
  } catch (error) {
    handleError(error);
  }
}


