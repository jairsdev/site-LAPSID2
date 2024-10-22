<?php 
namespace App\Controllers;
use App\Models\Projeto, PDOException;

class ProjetoController {
    private Projeto $projeto;

    public function __construct() {
        $this->projeto = new Projeto();
        header('Content-Type: application/json; charset=UTF-8');
    }

    public function insert($data) {
        if (empty($data['titulo'])) {
            echo json_encode(['sucess' => false, 'message' => 'O campo título está vazio']);
            return;
        }

        if (empty($data['conteudo'])) {
            echo json_encode(['sucess' => false, 'message' => 'O campo conteúdo está vazio']);
            return;
        }

        $this->projeto->conteudo = $data['conteudo'];
        $this->projeto->titulo = $data['titulo'];
        $this->projeto->autor_id = $data['autor_id'];
        date_default_timezone_set('America/Sao_Paulo');
        $dataAtual = date("Y-m-d H:i:s");
        $this->projeto->data_criacao = $dataAtual;
        $this->projeto->data_atualizacao = $dataAtual;
        try {
            $retorno = $this->projeto->criar_tabela();
        } catch (PDOException $err) {
            echo json_encode(['sucess' => false, 'message' => 'Houve um problema interno, tente novamente mais tarde']);
            return;
        }

        if ($retorno) {
            echo json_encode(['sucess' => true, 'message' => 'Conteúdo da página criada com sucesso']);
            return;
        } else {
            echo json_encode(['sucess' => false, 'message' => 'Erro ao criar o conteúdo da página']);
            return;
        }
    }

    public function index_all() {
        try {
            $data =  $this->projeto->ler_registros();
        } catch (PDOException $err) {
            echo json_encode(['sucess' => false, 'message' => 'Houve um problema interno, tente novamente mais tarde']);
            return;
        }

        if (empty($data)) {
            echo json_encode(['sucess' => false, 'message' => 'Não existe nenhum conteúdo nesse página']);
            return;
        }

        echo json_encode($data);
    }

    public function index($data) {
        $this->projeto->id = $data['id'];
        try {
            $data =  $this->projeto->ler_registro();
        } catch (PDOException $err) {
            echo json_encode(['sucess' => false, 'message' => 'Houve um problema interno, tente novamente mais tarde']);
            return;
        }
        
        if (empty($data)) {
            echo json_encode(['sucess' => false, 'message' => 'Conteúdo não encontrado']);
            return;
        }

        echo json_encode($data);
        return;
    }

    public function delete($data) {
        $this->projeto->id = $data['id'];
        try {
            $data =  $this->projeto->deletar_registro();
        } catch (PDOException $err) {
            echo json_encode(['sucess' => false, 'message' => 'Houve um problema interno, tente novamente mais tarde']);
            return;
        }
        
        if ($data === 0) {
            echo json_encode(['sucess' => false, 'message' => 'Esse conteúdo não existe']);
            return;
        }

        echo json_encode(['sucess' => true, 'message' => 'Conteúdo deletado com sucesso']);
    }

    public function update($data) {
        if (empty($data['titulo'])) {
            echo json_encode(['sucess' => false, 'message' => 'O campo título está vazio']);
            return;
        }

        if (empty($data['conteudo'])) {
            echo json_encode(['sucess' => false, 'message' => 'O campo conteúdo está vazio']);
            return;
        }
        
        $this->projeto->id = $data['id'];
        $this->projeto->titulo = $data['titulo'];
        $this->projeto->conteudo = $data['conteudo'];
        $this->projeto->autor_id = $data['autor_id'];
        date_default_timezone_set('America/Sao_Paulo');
        $dataAtual = date("Y-m-d H:i:s");
        $this->projeto->data_atualizacao = $dataAtual;
        try {
            $data =  $this->projeto->atualizar_registro();
        } catch (PDOException $err) {
            echo json_encode(['sucess' => false, 'message' => 'Houve um problema interno, tente novamente mais tarde']);
            return;
        }
        
        if ($data === 0) {
            echo json_encode(['sucess' => false, 'message' => 'Esse conteúdo não existe']);
            return;
        }

        echo json_encode(['sucess' => true, 'message' => 'Conteúdo atualizado com sucesso']);
    }
}