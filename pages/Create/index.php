<?php
    require_once './includes/config.php';
    require_once './includes/functions.php';

        if (isset($_POST['submit']))
        {
            $nome = htmlspecialchars($_POST["nome"]);
            $prioridade = htmlspecialchars($_POST["prioridade"]);

            if (create($nome, $prioridade, $connect)) {
                echo "Tarefa criada com sucesso!";
            } 
        }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Tarefa</title>
    <?php
        echo '<link rel="stylesheet" href="../../assets/css/createTask.css">';
    ?>
</head>
<body>
    <div class="container">
        <h1>Criar Nova Tarefa</h1>
        
        <form method="POST" >
            <div class="form-group">
                <label for="nome">Nome da Tarefa</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="prioridade">Prioridade</label>
                <select id="prioridade" name="prioridade">
                    <option value="tranquilo">Tranquilo</option>
                    <option value="normal">Normal</option>
                    <option value="urgente">Urgente</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn">Criar Tarefa</button>
        </form>
        <p><a href="../List/listTask.php">Voltar para Lista de Tarefas</a></p>
    </div>
</body>
</html>