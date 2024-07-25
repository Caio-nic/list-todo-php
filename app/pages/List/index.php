<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibir Tarefas</title>
    <link rel="stylesheet" href="../../assets/css/listTask.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../assets/js/index.js" defer></script> 
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
                            <td><?php echo $tarefa['prioridade']; ?></td>
                            <td><?php echo $tarefa['done']; ?></td>
                            <td>
                                <div class="actionButtons">
                                    <form class="delete-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                        <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>">
                                        <button type="submit" name="delete" class="deleteButton">
                                            <span class="material-icons delete-icon">delete</span>
                                        </button>
                                    </form>

                                    <?php if ($tarefa['done'] != 'concluída') : ?>
                                        <a href="/pages/Edit/index.php?id=<?php echo $tarefa['id']; ?>" class="editButton">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                            <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>">
                                            <button type="submit" name="mark_as_done" class="checkButton">
                                                <i class="material-icons">check</i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td class='noTasks' colspan="4">Não há tarefas para exibir no momento !</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

