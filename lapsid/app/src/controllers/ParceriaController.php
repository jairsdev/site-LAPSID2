<?php

namespace App\Controllers;

use App\Models\Parceria, PDOException;
use Exception, Error;
use \Gumlet\ImageResize;

class ParceriaController
{
    private Parceria $parceria;

    public function __construct()
    {
        $this->parceria = new Parceria();
        header('Content-Type: application/json; charset=UTF-8');
    }

    public function insert($data)
    {

        if (empty($data['descricao'])) {
            echo json_encode(['sucess' => false, 'message' => 'O campo parceria está vazio']);
            return;
        }

        $this->parceria->descricao = $data['descricao'];

        $fileName = $this->definirCaminho($data, 'insert');
        if ($fileName == false) {
            return;
        }

        $this->parceria->img_caminho = "Vazio";

        date_default_timezone_set('America/Sao_Paulo');
        $dataAtual = date("Y-m-d H:i:s");
        $this->parceria->data_criacao = $dataAtual;
        $this->parceria->data_atualizacao = $dataAtual;
        try {
            $retorno = $this->parceria->criar_tabela();
        } catch (PDOException $err) {
            echo json_encode(['sucess' => false, 'message' => 'Houve um problema interno, tente novamente mais tarde']);
            return;
        }

        if ($retorno == false) {
            echo json_encode(['sucess' => false, 'message' => 'Erro ao criar a parceria da página']);
            return;
        }

        $fileInfo = pathinfo($fileName);
        $fileExtension = strtolower($fileInfo['extension']);
        $fileName = $retorno . '.' . $fileExtension;
        $this->adicionarImagem($fileName);
        $this->parceria->id = $retorno;
        $this->parceria->img_caminho = "/site-LAPSID/assets/img/" . $fileName;

        try {
            $data =  $this->parceria->atualizar_caminho();
        } catch (PDOException $err) {
            echo json_encode(['sucess' => false, 'message' => 'Houve um problema interno, tente novamente mais tarde']);
            return;
        }

        if ($data == 0) {
            echo json_encode(['sucess' => false, 'message' => 'Imagem não encontrada.']);
            return;
        }
        echo json_encode(['sucess' => true, 'message' => 'Parceria da página criada com sucesso']);
        return;
    }

    public function index_all()
    {
        try {
            $data =  $this->parceria->ler_registros();
        } catch (PDOException $err) {
            echo json_encode(['sucess' => false, 'message' => 'Houve um problema interno, tente novamente mais tarde']);
            return;
        }

        if (empty($data)) {
            echo json_encode(['sucess' => false, 'message' => 'Não existe nenhuma parceria nesse página']);
            return;
        }

        echo json_encode($data);
    }

    public function index($id)
    {
        $this->parceria->id = $id;
        try {
            $data =  $this->parceria->ler_registro();
        } catch (PDOException $err) {
            echo json_encode(['sucess' => false, 'message' => 'Houve um problema interno, tente novamente mais tarde']);
            return;
        }

        if (empty($data)) {
            echo json_encode(['sucess' => false, 'message' => 'Parceria não encontrada']);
            return;
        }

        echo json_encode($data);
        return;
    }

    public function delete($data)
    {
        $this->parceria->id = $data['id'];

        $file_name = "C:/xampp/htdocs" . $data['img_caminho'];
        if (file_exists($file_name)) {
            if (!unlink($file_name)) {
                echo json_encode(['sucess' => false, 'message' => 'Erro ao deletar a imagem.']);
                return;
            }
        } else {
            echo json_encode(['sucess' => false, 'message' => 'Imagem não encontrada.']);
            return;
        }

        try {
            $data =  $this->parceria->deletar_registro();
        } catch (PDOException $err) {
            echo json_encode(['sucess' => false, 'message' => 'Houve um problema interno, tente novamente mais tarde']);
            return;
        }

        if ($data === 0) {
            echo json_encode(['sucess' => false, 'message' => 'Esse parceria não existe']);
            return;
        }

        echo json_encode(['sucess' => true, 'message' => 'Parceria deletada com sucesso']);
    }

    public function update($data)
    {

        try {
            if (empty($data['descricao'])) {
                echo json_encode(['sucess' => false, 'message' => 'O campo parceria está vazio']);
                return;
            }

            $this->parceria->id = $data['id'];
            $this->parceria->descricao = $data['descricao'];

            if (isset($_FILES['image'])) {
                $fileName = $this->definirCaminho($data, 'update');

                $oldFile = "C:/xampp/htdocs/" . $data['img_caminho'];

                if (file_exists($oldFile)) {
                    if (!unlink($oldFile)) {
                        echo json_encode(['sucess' => false, 'message' => 'Erro ao deletar a imagem antiga']);
                        return;
                    }
                }

                $fileInfo = pathinfo($fileName);
                $fileExtension = strtolower($fileInfo['extension']);
                $fileName = $data['id'] . '.' . $fileExtension;
                $this->adicionarImagem($fileName);
                $this->parceria->img_caminho = "/site-LAPSID/assets/img/" . $fileName;
            } else {
                $this->parceria->img_caminho = $data['img_caminho'];
            }

            
            date_default_timezone_set('America/Sao_Paulo');
            $dataAtual = date("Y-m-d H:i:s");
            $this->parceria->data_atualizacao = $dataAtual;
            try {
                $data =  $this->parceria->atualizar_registro();
            } catch (PDOException $err) {
                echo json_encode(['sucess' => false, 'message' => 'Houve um problema interno, tente novamente mais tarde']);
                return;
            }

            if ($data === 0) {
                echo json_encode(['sucess' => false, 'message' => 'Esse parceria não existe']);
                return;
            }

            echo json_encode(['sucess' => true, 'message' => 'Parceria atualizada com sucesso']);
        } catch (Error $e) {
            echo json_encode(['sucess' => 'false', 'message' => $e->getMessage()]);
        }
    }

    private function adicionarImagem($fileName)
    {
        $uploadDir = "C:/xampp/htdocs/site-LAPSID/assets/img/";
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $maxFileSize = 2 * 1024 * 1024;
            if ($_FILES['image']['size'] > $maxFileSize) {
                echo json_encode(['sucess' => false, 'message' => 'Erro: O arquivo é muito grande. O tamanho máximo permitido é 2MB']);
                return false;
            }

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $uploadFile = $uploadDir . $fileName;

            $image = new ImageResize($_FILES['image']['tmp_name']);
            $image->scale(40, 40);
            $image->save($uploadFile);
        } else {
            echo json_encode(['sucess' => false, 'message' => 'Ocorreu um erro ao fazer o upload do arquivo']);
            return false;
        }
    }

    private function definirCaminho($data, $acao)
    {
        if ($acao == 'update') {
            $fileName = basename($_FILES['image']['name']);
            return $fileName;
        } else {
            if (!isset($_FILES['image'])) {
                echo json_encode(['sucess' => false, 'message' => 'É preciso colocar uma imagem']);
                return false;
            } else {
                $fileName = basename($_FILES['image']['name']);
                return $fileName;
            }
        }
    }
}
