<?php
    require_once './includes/config.php';
    require_once './includes/functions.php';
    // require_once __DIR_  _ . '/config.php';

    $tarefas = read($connect);
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
        $id = $_POST['delete_id'];
        echo 'ID a ser excluído: ' . $id . '<br>'; // Mensagem de depuração
    
        // Chamar a função delete para excluir a tarefa
        $excluiu = delete($connect, $id);
    
        if ($excluiu) {
            echo '<div class="success">Tarefa excluída com sucesso!</div>';
            // Redirecionar ou atualizar a página após a exclusão
            header("Refresh:0");
            exit();
        } else {
            echo '<div class="error">Erro ao excluir tarefa. Por favor, tente novamente.</div>';
        }
    }
    
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