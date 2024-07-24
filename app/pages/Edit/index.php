<?php
require_once '../../includes/config.php';
require_once '../../includes/functions.php';

// se o id tiver na url ele vai armazenar na variavel
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $prioridade = $_POST['prioridade'];
        update($connect, $id, $nome, $prioridade);
        header("Location: /");
        exit();
    }
    $tarefa = read($connect, $id); 
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="../../assets/css/editTask.css">
</head>
<body>
    <div class="container">
        <h1>Editar Tarefa</h1>       
        <form action="index.php?id=<?php echo $id; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="nome">Nome da Tarefa</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($tarefa['nome']); ?>" required>
            </div>
            <div class="form-group">
                <label for="prioridade">Prioridade</label>
                <select id="prioridade" name="prioridade">
                    <option value="Urgente" <?php if ($tarefa['prioridade'] == 'Urgente') echo 'selected'; ?>>Urgente</option>
                    <option value="Normal" <?php if ($tarefa['prioridade'] == 'Normal') echo 'selected'; ?>>Normal</option>
                    <option value="Tranquilo" <?php if ($tarefa['prioridade'] == 'Tranquilo') echo 'selected'; ?>>Tranquilo</option>
                </select>
            </div>
            <button type="submit" class="btn">Salvar Alterações</button>
            <a href="/" class="btn btn-danger">Cancelar</a>
        </form>
        
        <p><a href="/">Voltar para Lista de Tarefas</a></p>
    </div>
</body>
</html>

