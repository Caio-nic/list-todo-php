<?php
    require_once './config.php';

function create ($nome, $prioridade, $connect) {

    {
        $nome = htmlspecialchars($_POST["nome"]);
        $prioridade = htmlspecialchars($_POST["prioridade"]);
        
        $query = $connect -> prepare(
            "INSERT INTO tarefas (nome, prioridade)
                VALUE ( '$nome','$prioridade' )");
        
        //ss significa que são duas strings
        $query->bind_param("ss", $nome, $prioridade);
        
        if ($query->execute() === true) {
            return true; 
        } else {
            die("Erro ao inserir dados: " . $query->error);
        }

        $query->close();
    }

    function read($connect) {
        $query = $connect->query("SELECT * FROM tarefas");
        
        if ($query === false) {
            die('Erro na consulta: ' . $connect->error);
        }
        
        // Inicializar um array para armazenar as tarefas
        $tarefas = [];
        
        // Iterar sobre o resultado da consulta e armazenar em $tarefas
        while ($row = $query->fetch_assoc()) {
            $tarefas[] = $row;
        }
        return $tarefas;
    }
    function delete($connect, $id) {
        // Sanitizar o ID para evitar SQL Injection
        $id = $connect->real_escape_string($id);
        
        $query = $connect->query(
            "DELETE FROM 
            tarefas 
            WHERE id = $id");
        
        if ($query === false) {
            die('Erro ao deletar tarefa: ' . $connect->error);
        }
        
        // Verificar se uma linha foi deletada com sucesso
        if ($connect->affected_rows > 0) {
            return true; 
        } else {
            return false; // ID não encontrado ou nenhum registro afetado
        }
    }
    function updateTarefa($connect, $id, $nome, $prioridade) {
        // Sanitizar os dados para evitar SQL Injection
        $id = $connect->real_escape_string($id);
        $nome = $connect->real_escape_string($nome);
        $prioridade = $connect->real_escape_string($prioridade);
        
        // Query SQL para atualizar a tarefa com o ID especificado
        $query = $connect->query(
            "UPDATE 
            tarefas SET nome = '$nome', prioridade = '$prioridade'
             WHERE id = $id"
             );
        
        if ($query === false) {
            die('Erro ao atualizar tarefa: ' . $connect->error);
        }
        
        // Verificar se uma linha foi afetada (se foi atualizada com sucesso)
        if ($connect->affected_rows > 0) {
            return true; // Atualizado com sucesso
        } else {
            return false; // ID não encontrado ou nenhum registro afetado
        }
    }
}
?>