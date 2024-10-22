<?php
namespace App\Models;
use App\Config\Conexao, PDO;

class Parceria {
    public PDO $conn;
    public int $id;
    public string $descricao;
    public string $img_caminho;
    public string $data_criacao;
    public string $data_atualizacao;


    public function __construct() {
        $db = new Conexao();
        $this->conn = $db->getConnection();
    }

    public function criar_tabela() {
        $query = "INSERT INTO parcerias (descricao, img_caminho, data_criacao, data_atualizacao) VALUES (:descricao, :img_caminho, :data_criacao, :data_atualizacao)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":descricao", $this->descricao, PDO::PARAM_STR);
        $stmt->bindValue(":img_caminho", $this->img_caminho, PDO::PARAM_STR);
        $stmt->bindValue(":data_criacao", $this->data_criacao, PDO::PARAM_STR);
        $stmt->bindValue(":data_atualizacao", $this->data_atualizacao, PDO::PARAM_STR);
           
        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function ler_registros() {
        $query = "SELECT * FROM parcerias ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ler_registro() {
        $query = "SELECT * FROM parcerias WHERE id = :id ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar_registro() {
        $query = "UPDATE parcerias SET descricao = :descricao, img_caminho = :img_caminho, data_atualizacao = :data_atualizacao WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
        $stmt->bindValue(":descricao", $this->descricao, PDO::PARAM_STR);
        $stmt->bindValue(":img_caminho", $this->img_caminho, PDO::PARAM_STR);
        $stmt->bindValue(":data_atualizacao", $this->data_atualizacao, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->rowCount();
        }
        return false;
    }

    public function deletar_registro() {
        $query = "DELETE FROM parcerias WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->rowCount();
        }
        return false;
    }

    public function atualizar_caminho() {
        $query = "UPDATE parcerias SET img_caminho = :img_caminho WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
        $stmt->bindValue(":img_caminho", $this->img_caminho, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->rowCount();
        }

        return false;
    }
}