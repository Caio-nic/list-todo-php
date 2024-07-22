<?php
    require_once __DIR__ . '/config.php';

    function create ($nome, $prioridade, $connect) {
            
        $query = $connect -> prepare(
            "INSERT INTO tarefas (nome, prioridade)
            VALUES ( ?, ? )");
    
        // ver preparação da declaração foi bem-sucedida
        if ($query === false) {
            die("Erro ao preparar a declaração SQL: " . $connect->error);
        }
        //ss significa que são duas strings
        $query->bind_param("ss", $nome, $prioridade);
        
        if ($query->execute() === true) {
            $query->close();
            return true; 
        } else {
            die("Erro ao inserir dados: " . $query->error);
        }
    }
    function read($connect) {
        $query = $connect->query( "
            SELECT
                tarefas.nome,
                tarefas.prioridade,
                tarefas.created_at
            FROM
                tarefas
        "
        );
        
        if ($query === false) {
            die('Erro na consulta: ' . $connect->error);
        } 
        // array para armazenar as tarefas
        $tarefas = [];
        
        // Iterar sobre o resultado da consulta e armazenar em $tarefas
        if ($query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
                $tarefas[] = $row;
            }
            $query->free_result();
            return $tarefas;
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
                     
                if ($connect->affected_rows > 0) {
                     return true; 
                } else {
                    return false; // ID não encontrado ou nenhum registro afetado
                }
    }
                
    function delete($connect, $id) {
    // Sanitizando id para evitar SQL Injection
        $id = $connect->real_escape_string($id);
                    
        $query = $connect->query(
        "DELETE FROM 
            tarefas 
        WHERE 
            id = $id");
            
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

    ?>