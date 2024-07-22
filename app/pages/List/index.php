<?php
    require_once './includes/config.php';
    require_once './includes/functions.php';

    $tarefas = read($connect);
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibir Tarefas</title>
    <?php
        echo '<link rel="stylesheet" href="../../assets/css/listTask.css">';
    ?>
</head>
<body>
    <div class="container">   
        <table>
            <caption><h2>Lista de Tarefas</h2></caption>
            <thead>
                <tr>
                    <th>Tarefa</th>
                    <th>Prioridade</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Comprar leite</td>
                    <td>Urgente</td>
                    <td class="status feita">Feita</td>
                    <td class="actions">
                        <a class="btn" href="editTask.php">Editar</button>
                    </td>
                </tr>
                <?php foreach ($tarefas as $tarefa): ?>
                    <tr>
                        <td><?php echo $tarefa['nome']; ?></td>
                        <td><?php echo $tarefa['prioridade']; ?></td>
                        <td><?php echo $tarefa['created_at']; ?></td>
                        <td><a href="index.php?delete_id=<?php echo $tarefa['id']; ?>
                        " onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')">Excluir</a></td>
                    </tr>

            <?php endforeach; ?>  
            </tbody>
        </table>
        
        <p><a href="./pages/Create/index.php">Criar Nova Tarefa</a></p>
    </div>
</body>
</html>
