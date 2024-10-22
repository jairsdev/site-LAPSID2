<?php
namespace App\Controllers;
use App\Models\Usuario, PDOException;

class UsuarioController {
    private Usuario $usuario;

    public function __construct() {
        header('Content-Type: application/json; charset=UTF-8');
        $this->usuario = new Usuario();
    }

    public function login($data) {
        if (empty($data['email'])) {
            echo json_encode(['sucess' => false, 'message' => 'O campo email está vazio']);
            return;
        }

        if (empty($data['senha'])) {
            echo json_encode(['sucess' => false, 'message' => 'O campo senha está vazio']);
            return;
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['sucess' => false, 'message' => 'O email é inválido']);
            return;
        }

        $this->usuario->email = $data['email'];
        $this->usuario->senha = $data['senha'];

        try {
            $retorno = $this->usuario->autenticar_usuario();
        } catch (PDOException $err) {
            echo json_encode(['sucess' => false, 'message' => 'Houve um problema interno, tente novamente mais tarde']);
            return;
        }

        if ($retorno == false) {
            echo json_encode(['success' => false, 'message' => 'Usuário ou senha inválidos.']);
            return;
        } else {
            session_start();
            $_SESSION['usuario_id'] = $retorno['id'];
            $_SESSION['nome_usuario'] = $retorno['nome'];
            echo json_encode(['success' => true, 'message' => 'Login bem-sucedido']);
            return;
        }
    }

    public function create_login($data) {
        if (empty($data['nome'])) {
            echo json_encode(['sucess' => false, 'message' => 'O campo nome está vazio']);
            return;
        }

        if (empty($data['email'])) {
            echo json_encode(['sucess' => false, 'message' => 'O campo email está vazio']);
            return;
        }

        if (empty($data['senha'])) {
            echo json_encode(['sucess' => false, 'message' => 'O campo senha está vazio']);
            return;
        }

        if (strlen($data['senha']) < 8) {
            echo json_encode(['sucess' => false, 'message' => 'A senha precisa ter 8 digitos']);
            return;
        }

        if (strlen($data['senha']) > 255) {
            echo json_encode(['sucess' => false, 'message' => 'A senha não pode passar de 255 digitos']);
            return;
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['sucess' => false, 'message' => 'O email é inválido']);
            return;
        }

        $this->usuario->nome = $data['nome'];
        $this->usuario->email = $data['email'];
        $this->usuario->senha = $data['senha'];
        date_default_timezone_set('America/Sao_Paulo');
        $dataAtual = date("Y-m-d H:i:s");
        $this->usuario->data_criacao = $dataAtual;
        try {
            $retorno = $this->usuario->criar_usuario();
        } catch (PDOException $err) {
            if ($err->getCode() == 23000) {
                echo json_encode(['sucess' => false, 'message' => 'O email já está cadastrado']);
                return;
            }
            echo json_encode(['sucess' => false, 'message' => 'Houve um problema interno, tente novamente mais tarde ' . $err->getCode()]);
            return;
        }

        if ($retorno) {
            echo json_encode(['sucess' => true, 'message' => 'Usuário criado com sucesso']);
            return;
        } else {
            echo json_encode(['sucess' => false, 'message' => 'Erro ao criar o usuário']);
            return;
        }
    }

    public function index_all()
    {
        try {
            $data =  $this->usuario->ler_registros();
        } catch (PDOException $err) {
            echo json_encode(['sucess' => false, 'message' => 'Houve um problema interno, tente novamente mais tarde']);
            return;
        }

        if (empty($data)) {
            echo json_encode(['sucess' => false, 'message' => 'Não existe nenhum usuário nesse página']);
            return;
        }

        echo json_encode($data);
    }

    public function verify($data) {
        if (empty($data['email'])) {
            echo json_encode(['sucess' => false, 'message' => 'O campo email está vazio']);
            return;
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['sucess' => false, 'message' => 'O email é inválido']);
            return;
        }

        $this->usuario->email = $data['email'];
        $retorno = $this->usuario->consultar_email();

        if ($retorno == 'nao_encontrado') {
            echo json_encode(['sucess' => false, 'message' => 'O email não foi encontrado']);
            return;
        } elseif ($retorno === false) {
            echo json_encode(['sucess' => false, 'message' => 'Houve um problema interno, tente novamente mais tarde ']);
            return;
        } else {
            session_start();
            $_SESSION['temporario_id'] = $retorno['id'];
            echo json_encode($retorno);
        }
    }

    public function update_user($data) {
        if (empty($data['nome'])) {
            echo json_encode(['sucess' => false, 'message' => 'O campo nome está vazio']);
            return;
        }

        if (empty($data['email'])) {
            echo json_encode(['sucess' => false, 'message' => 'O campo email está vazio']);
            return;
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['sucess' => false, 'message' => 'O email é inválido']);
            return;
        }

        $this->usuario->nome = $data['nome'];
        $this->usuario->email = $data['email'];
        $this->usuario->id = $data['id'];

        $retorno = $this->usuario->atualizar_usuario();

        if ($retorno == false) {
            echo json_encode(['sucess' => false, 'message' => 'Houve um problema interno, tente novamente mais tarde ']);
            return;
        } else {
            echo json_encode(['sucess' => true, 'message' => 'Usuário atualizado com sucesso']);
            return;
        }

    }

    public function update_password($data) {

        if (empty($data['senha'])) {
            echo json_encode(['sucess' => false, 'message' => 'O campo senha está vazio']);
            return;
        }

        if (empty($data['senha_confirmacao'])) {
            echo json_encode(['sucess' => false, 'message' => 'O campo da senha de confirmação está vazio']);
            return;
        }

        if ($data['senha'] != $data['senha_confirmacao']) {
            echo json_encode(['sucess' => false, 'message' => 'A confirmação da senha não corresponde. Verifique e tente novamente']);
            return;
        }

        $this->usuario->senha = $data['senha'];
        $this->usuario->id = $data['id'];
        $retorno = $this->usuario->atualizar_senha();
        
        if ($retorno == false) {
            echo json_encode(['sucess' => false, 'message' => 'Houve um problema interno, tente novamente mais tarde ']);
            return;
        } else {
            echo json_encode(['sucess' => true, 'message' => 'Senha atualizada com sucesso']);
            return;
        }
    }

    public function logout() {
        session_start();
        if (isset($_SESSION['usuario_id'])) {
            echo json_encode(['sucess' => true, 'message' => 'Usuário deslogado com sucesso']);
            $_SESSION = array();
            session_destroy();
            return;
        } 

        echo json_encode(['sucess' => true, 'message' => 'O usuário já esta deslogado']);
    }

    public function delete($data) {
        $this->usuario->id = $data['id'];
        try {
            $data =  $this->usuario->deletar_registro();
        } catch (PDOException $err) {
            echo json_encode(['sucess' => false, 'message' => 'Houve um problema interno, tente novamente mais tarde']);
            return;
        }
        
        if ($data === 0) {
            echo json_encode(['sucess' => false, 'message' => 'Usuário não encontrado']);
            return;
        }

        echo json_encode(['sucess' => true, 'message' => 'Usuário deletado com sucesso']);
    }
}