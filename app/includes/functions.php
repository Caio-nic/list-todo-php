<?php
    require_once __DIR__ . '/config.php';

    function create($nome, $prioridade, $connect) {
        $query = $connect->prepare(
            "INSERT INTO tarefas (nome, prioridade)
            VALUES (?, ?)"
        );
        
        // Verificar se a preparação da declaração foi bem-sucedida
        if ($query === false) {
            die("Erro ao preparar a declaração SQL: " . $connect->error);
        }
        
        // Bind dos parâmetros
        $query->bind_param("ss", $nome, $prioridade);
        
        // Executar a query
        if ($query->execute() === true) {
            $query->close();
            return true;
        } else {
            die("Erro ao inserir dados: " . $query->error);
        }
    }
    function read($connect) {
        $query = $connect->query( 
           "SELECT
                tarefas.id,
                tarefas.nome,
                tarefas.prioridade,
                tarefas.created_at,
                tarefas.done
            FROM
                tarefas
        ");
    
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
        } else {
            return $tarefas; // Retorna um array vazio se não houver tarefas encontradas
        }
    }
    function update($connect, $id, $nome, $prioridade) {
        // Query SQL para atualizar o registro
        $sql = "UPDATE tarefas SET nome=?, prioridade=? WHERE id=?";
       
        // Preparar a declaração
        $stmt = $connect->prepare($sql);
       
        if ($stmt === false) {
            die('Erro na preparação da declaração: ' . $connect->error);
        }
       
        // Bind dos parâmetros e execução da declaração preparada
        $stmt->bind_param('ssi', $nome, $prioridade, $id);
       
        if ($stmt->execute()) {
            echo "Registro atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar o registro: " . $stmt->error;
        }
       
        // Fechar a declaração e a conexão
        $stmt->close();
        $connect->close();
    }
    
    function delete($connect, $id) {
    // Sanitizando id para evitar SQL Injection
        $id = $connect->real_escape_string($id);
        
        echo 'ID a ser excluído: ' . $id;

        $query = $connect->query(
          "DELETE FROM 
                tarefas 
            WHERE 
                id = '$id'
        ");

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
    <!-- function delete($connect, $id) {
    // Sanitizando id para evitar SQL Injection
        $id = $connect->real_escape_string($id);
                    
        $query = $connect->prepare(
        "DELETE FROM 
            tarefas 
        WHERE 
            id = $id");
      
        $query->bind_param("i", $id);
        $query->execute();
        $query->close();


        // if ($query === false) {
        //     die('Erro ao deletar tarefa: ' . $connect->error);
        // }
            
        // // Verificar se uma linha foi deletada com sucesso
        // if ($connect->affected_rows > 0) {
        //     return true; 
        // } else {
        //     return false; // ID não encontrado ou nenhum registro afetado
        // }
    }
    function updateTarefa($connect, $id, $nome, $prioridade) {
        $stmt = $connect->prepare("UPDATE tarefas SET nome = ?, prioridade = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nome, $prioridade, $id);
        $stmt->execute();
        $stmt->close();
    }
    
    function getTarefaById($connect, $id) {
        $stmt = $connect->prepare("SELECT * FROM tarefas WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $tarefa = $result->fetch_assoc();
        $stmt->close();
        return $tarefa;
    } -->