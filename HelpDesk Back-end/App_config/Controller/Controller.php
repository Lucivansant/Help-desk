<?php

class Controller
{
    private $conexao;

    public function __construct(Conect $conexao)
    {
        $this->conexao = $conexao->Conectar();
    }

    public function Get_func($email, $senha)
    {
        $query = "SELECT * FROM login_func WHERE email = :email AND senha = :senha";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function Get_adm($email, $senha)
    {
        $query = "SELECT * FROM login_adm WHERE email = :email AND senha = :senha";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function Add_chamados($titulo, $opt_setor, $opt_categoria, $desc, $status, $funcionario)
    {
        $query = "INSERT INTO chamados(titulo, setor, categoria, descr, status_chamado, funcionario) VALUES (:titulo, :setor, :categoria, :descr, :status_chamado, :funcionario)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':titulo', $titulo);
        $stmt->bindValue(':setor', $opt_setor);
        $stmt->bindValue(':categoria', $opt_categoria);
        $stmt->bindValue(':descr', $desc);
        $stmt->bindValue(':status_chamado', $status);
        $stmt->bindValue(':funcionario', $funcionario);

        $stmt->execute();
    }

    public function Select_chamados($funcionario)
    {
        $query = "SELECT * FROM chamados WHERE funcionario = :funcionario ORDER BY id  DESC";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':funcionario', $funcionario);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Select_todos_chamados()
    {
        $query = "SELECT * FROM chamados ORDER BY id DESC";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Update_chamado($status_chamado, $id)
    {
        $query = "UPDATE chamados SET status_chamado = :status_chamado WHERE id = :id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':status_chamado', $status_chamado);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}
