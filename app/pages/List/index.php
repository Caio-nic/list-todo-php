<?php
    require_once './includes/config.php';
    require_once './includes/functions.php';
    // require_once __DIR_  _ . '/config.php';

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
            <p><a href="./pages/Create/index.php">Criar Nova Tarefa</a></p>
            <tbody>
                <?php if (!empty($tarefas)) : ?>
                    <?php foreach ($tarefas as $tarefa) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($tarefa['nome']); ?></td>
                            <td><?php echo htmlspecialchars($tarefa['prioridade']); ?></td>
                            <td>Pendente</td>
                            <td class="actionButtons">
                                <!-- <a href="index.php?delete_id=<?php echo $tarefa['id']; ?>"
                                onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')">Excluir</a> -->
                                <button id="deleteButton">Excluir</button>
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