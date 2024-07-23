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
    <link rel="stylesheet" href="../../assets/css/listTask.css">
</head>
<body>
    <div class="container">   
        <table>
            <caption><h2>Lista de Tarefas</h2></caption>
            <caption>
                <a id="buttonMenu" href="./pages/Create/index.php">Criar Nova Tarefa</a>
                <a id="buttonMenu" href="./pages/Create/index.php">Ver Progresso</a>
            </caption>
            <thead>
                <tr>
                    <th>Tarefa</th>
                    <th>Prioridade</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tarefas)) : ?>
                    <?php foreach ($tarefas as $tarefa) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($tarefa['nome']); ?></td>
                            <td><?php echo htmlspecialchars($tarefa['prioridade']); ?></td>
                            <td><?php echo htmlspecialchars($tarefa['done']); ?></td>
                            <td class="actionButtons">
                                <!-- Formulário para excluir -->
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>">
                                    <button type="submit" id="deleteButton" 
                                    onclick="return confirm('Tem certeza que deseja excluir esta tarefa?');">Excluir</button>
                                </form>
                                <button id="editButton">Editar</button>
                                <button id="checkButton">Pronto</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4">Não há tarefas para exibir.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>


