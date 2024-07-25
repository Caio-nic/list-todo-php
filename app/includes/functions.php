<?php
    require_once __DIR__ . '/config.php';

    function create($nome, $prioridade, $connect) {
        $query = $connect->prepare(
           "INSERT INTO 
                tarefas (nome, prioridade)
            VALUES 
                (?, ?)
            ");

        $query->bind_param("ss", $nome, $prioridade);
        
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
    
        $tarefas = [];
        
        if ($query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
                $tarefas[] = $row;
            }
                $query->free_result();
            return $tarefas;
        } else {
            return $tarefas;
        }
    }
    
    function update($connect, $id, $nome, $prioridade) {
        $query = 
            "UPDATE 
                    tarefas 
                SET 
                    nome = ?, 
                    prioridade = ? 
                WHERE 
                    id = ?
            ";
        $query = $connect->prepare($query);
        $query->bind_param('ssi', $nome, $prioridade, $id);
       
        $query->execute();   

        $query->close();
        $connect->close();
    }
    
    function delete($connect, $id) {
        $query = 
            "DELETE 
                FROM 
                    tarefas 
                WHERE 
                    id = ?
            ";
        $query = $connect->prepare($query);
        $query->bind_param('i', $id);
        
        $query->execute();
    
        $query->close();
        $connect->close();
    }
    function markAsDone($connect, $id) {
        $query = 
            "UPDATE 
                    tarefas 
                SET 
                    done = 'Concluída' 
                WHERE 
                    id = ?
            ";
        
        $stmt = mysqli_prepare($connect, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $success;
    }
?>
