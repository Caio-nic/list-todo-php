<?php
    require_once '../../includes/config.php';
    require_once '../../includes/functions.php';

    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        
        // Chamar a função delete para deletar a tarefa pelo ID
        $deleted = delete($conn, $delete_id);
        
        if ($deleted) {
            echo '<script>alert("Tarefa deletada com sucesso.");</script>';
        } else {
            echo '<script>alert("Erro ao deletar tarefa.");</script>';
        }
    }
    $tarefas = read($conn); 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <?php
        echo '<link rel="stylesheet" href="./assets/css/editTask.css">';
    ?>
</head>
<body>
    <div class="container">
        <h1>Editar Tarefa</h1>       
        <form>
            <div class="form-group">
                <label for="nome">Nome da Tarefa</label>
                <input type="text" id="nome" name="nome" value="Lavar o carro" required>
            </div>
            <div class="form-group">
                <label for="prioridade">Prioridade</label>
                <select id="prioridade" name="prioridade">
                    <option value="urgente">Urgente</option>
                    <option value="normal" selected>Normal</option>
                    <option value="tranquilo">Tranquilo</option>
                </select>
            </div>
            <button type="submit" class="btn">Salvar Alterações</button>
            <button type="button" class="btn btn-danger">Deletar Tarefa</button>
        </form>
        
        <p><a href="tela-exibir-tarefas.html">Voltar para Lista de Tarefas</a></p>
    </div>
</body>
</html>
