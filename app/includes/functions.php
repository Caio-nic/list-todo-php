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
//ss significa que são duas strings
}
?>