<?php

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
//ss significa que são duas strings
}
?>