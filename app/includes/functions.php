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
        // Query SQL para deletar a tarefa
        $query = 
        "DELETE FROM tarefas WHERE id = ?";
        
        // Preparar a declaração
        $stmt = $connect->prepare($query);
        
        if ($stmt === false) {
            die('Erro na preparação da declaração: ' . $connect->error);
        }
        
        // Bind do parâmetro ID
        $stmt->bind_param('i', $id); // 'i' para integer, ajuste se necessário
        
        // Executar a declaração
        if ($stmt->execute()) {
            echo "Tarefa excluída com sucesso!";
        } else {
            echo "Erro ao excluir a tarefa: " . $stmt->error;
        }
        
        // Fechar a declaração e conexão
        $stmt->close();
    }
?>
